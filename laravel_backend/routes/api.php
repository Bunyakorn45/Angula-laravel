<?php
file_put_contents('/tmp/api-routes-loaded.txt', date('c')."\n", FILE_APPEND);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test_api_login', [AuthenticationController::class, 'callApiLogin']);
Route::post('login_post', [AuthenticationController::class, 'login_post']);

Route::get('test-provider', function () {
    return response()->json(['message' => 'RouteServiceProvider works!']);
});