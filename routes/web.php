<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
// 会員登録
Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// ログイン
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

// パスワード再設定
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');
