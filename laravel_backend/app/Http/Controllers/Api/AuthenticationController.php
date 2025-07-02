<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function login_post(Request $request)
    {
        // รับค่าจาก Angular (key เป็นตัวเล็ก)
        $username = $request->input('username');
        $password = $request->input('password');

        Log::info('Login attempt', [
            'username' => $username,
        ]);

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = UserModel::where('Username', $username)->first();

        // ตัวอย่าง: ถ้าเก็บ password เป็น md5
        if (!$user || md5($password) !== $user->Password) {
            Log::error('Login failed', [
                'username' => $username,
                'error' => 'Invalid credentials',
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        Log::info('Login success', [
            'username' => $user->Username,
            'id_user' => $user->Id_User,
        ]);

        return response()->json([
            'success' => true,
            'username' => $user->Username,
            'id_user' => $user->Id_User
        ]);
    }

    public function callApiLogin()
    {
        // เรียกเมธอด login_post ตรงๆ (mock Request)
        $request = new \Illuminate\Http\Request([
            'username' => 'user2',
            'password' => '1234'
        ]);
        $controller = new self();
        return $controller->login_post($request);
    }
}