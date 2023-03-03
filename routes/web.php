<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::view('/','login');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('user-login', [AuthController::class, 'userLogin'])->name('userLogin'); 
Route::get('register', [AuthController::class, 'registration'])->name('register');
Route::post('user-registration', [AuthController::class, 'userRegistration'])->name('userRegister'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('forgotPassword',[AuthController::class,'forgotPasswordPage'])->name('forgotPasswordPage');
Route::post('userForgotPassword',[AuthController::class,'userForgotPassword'])->name('userForgotPassword');
Route::get('passwordResetForm/{token}',[AuthController::class,'resetPasswordForm'])->name('passwordResetForm');
Route::post('resetPassword',[AuthController::class,'resetpassword'])->name('resetPassword');
Route::get('changePasswordForm',[AuthController::class,'changePasswordForm'])->name('changePasswordForm');
Route::post('changePassword',[AuthController::class,'changePassword'])->name('changePassword');
Route::get('userProfile',[UserController::class,'userProfile'])->name('userProfile');
Route::post('userProfileUpdate',[UserController::class,'userProfileUpdate'])->name('userProfileUpdate');
Route::get('users',[UserController::class,'users'])->name('displayUser');
Route::get('user',[UserController::class,'index'])->name('dataTables');
Route::get('user/deleteUser/{id}',[UserController::class,'userSoftDelete'])->name('userSoftDelete');
Route::get('admin/edit/{user}',[UserController::class,'editUserPage'])->name('editUserPage');
Route::post('admin/update/{user}',[UserController::class,'editUser'])->name('editUser');

Route::get('admin/addUser',[UserController::class,'adduserPage'])->name('adminAddUserPage');
Route::post('admin/addUser',[UserController::class,'addUser'])->name('adminAddUser');
//testing Routes for the dataTables
Route::view('testing','testing.adminAccess');
Route::get('ajax-crud-datatable', [DataTableController::class, 'index']);
Route::post('store-company', [DataTableController::class, 'store']);
Route::post('edit-company', [DataTableController::class, 'edit']);
Route::post('delete-company', [DataTableController::class, 'destroy']);







?>