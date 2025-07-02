<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestApiController extends Controller
{
    public function callApiLogin()
    {
        // เรียกเมธอด login_post ตรงๆ (mock Request)
        $request = new \Illuminate\Http\Request([
            'username' => 'user2',
            'password' => '1234'
        ]);
        $controller = new \App\Http\Controllers\Api\AuthenticationController();
        return $controller->login_post($request);
    }
}
