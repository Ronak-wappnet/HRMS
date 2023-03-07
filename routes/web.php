<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//login and registration
Route::get('/',[AuthController::class,'login'])->name('login');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/loginForm',[AuthController::class,'loginAction'])->name('loginAction');
Route::get('/registration',[AuthController::class,'registration'])->name('registration');
Route::post('/registraionForm',[AuthController::class,'registrationAction'])->name('registrationAction');
Route::get('/singout',[AuthController::class,'signOut'])->name('singOut');
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

//user forgot password 
Route::get('/forgotPassword',[AuthController::class,'forgotPassword'])->name('forgotPassword');
Route::post('/forgotPassword/resetPasswordForm',[AuthController::class,'forgotPasswordAction'])->name('forgotPasswordAction');

//user reset password
Route::get('/resetPasswordForm/{token}',[AuthController::class,'resetPasswordForm'])->name('resetPasswordForm');
Route::post('/resetPassword',[AuthController::class,'resetPasswordFormAction'])->name('resetPasswordFormAction');

//user profile and change password
Route::get('/user-profile',[UserController::class,'profile'])->name('profile');
Route::post('/update-profile',[UserController::class,'profileAction'])->name('profileAction');
Route::get('/change-password',[UserController::class,'changePassword'])->name('changePassword');
Route::post('/change-password-action',[UserController::class,'changePasswordAction'])->name('changePasswordAction');