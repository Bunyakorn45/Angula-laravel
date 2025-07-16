<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Rules\UniqueMydb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;


class LoginController extends Controller
{   

    public function showLoginForm()
    {
        return view('login');
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ]);
        
        $user = UserModel::where('Username', $request->Username)->first();
        
        if (!$user || md5($request->Password) !== $user->Password) {
            Log::error('Login failed', [
                'Username' => $request->Username,
                'Error' => 'Invalid credentials',
            ]);
            // เพิ่ม response json สำหรับ Postman
            return response()->json([
                'success' => false,
                'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
            ], 401);
        }   
        Log::info('Login success', [
            'Username' => $user->Username,
            'Id_User' => $user->Id_User,
        ]);

        $request->session()->put('user', $user);

        return response()->json([
            'success' => true,
            'username' => $user->Username,
            'id_user' => $user->Id_User
        ]);
    }

    public function dashboard()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the dashboard');
        }
        
        return view('dashboard', compact('user'));
    }

    public function getUser($id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response(['message' => 'User not found'], 404);
        }

        return response([
            'Id_User' => $user->Id_User,
            'Username' => $user->Username,
            'Employee_Id' => $user->Employee_Id,
            'Hospital_Id' => $user->Hospital_Id,
            'Permission_Id' => $user->Permission_Id,
        ], 200);
    }

    public function showRegisterForm()
    {   
        $user = new UserModel();

        log::info('Showing register form', [
            'user' => $user,
        ]);

        return view('register');
    }

    public function register_post(Request $request)
    {
        try {
            $request->validate([
                'Username' => ['required', new UniqueMydb('User', 'Username')],
                'Password' => 'required',
                'Employee_Id' => 'required',
                'Hospital_Id' => 'required',
                'Permission_Id' => 'required',
            ]);

            $user = UserModel::create([
                'Username' => $request->Username,
                'Password' => md5($request->Password),
                'Employee_Id' => $request->Employee_Id,
                'Hospital_Id' => $request->Hospital_Id,
                'Permission_Id' => $request->Permission_Id,
            ]);

            return redirect()->route('login')->with('success', 'Register success');
        } catch (\Exception $e) {
            \Log::error('Register error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);
            return view('login', ['error' => 'Register failed: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    
}