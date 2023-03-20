<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use App\Models\Holiday;

Route::group(["middleware" => "guest"], function () {

    //login and registration
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login1');
    Route::post('/loginForm', [AuthController::class, 'loginAction'])->name('loginAction');
    Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
    Route::post('/registraionForm', [AuthController::class, 'registrationAction'])->name('registrationAction');

    //user forgotPassword 
    Route::get('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgotPassword/resetPasswordForm', [AuthController::class, 'forgotPasswordAction'])->name('forgotPasswordAction');

    //user resetPassword
    Route::get('/resetPasswordForm/{token}', [AuthController::class, 'resetPasswordForm'])->name('resetPasswordForm');
    Route::post('/resetPassword', [AuthController::class, 'reguestsetPasswordFormAction'])->name('resetPasswordFormAction');
});

Route::group((['middleware' => 'auth']), function () {

    //singout dashboard
    Route::get('/singout', [AuthController::class, 'signOut'])->name('singOut');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');


    //user profile and change password
    Route::group(["prefix" => "users"], function () {

        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/update-profile', [UserController::class, 'profileAction'])->name('profileAction');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
        Route::post('/change-password-action', [UserController::class, 'changePasswordAction'])->name('changePasswordAction');
    });

    //admin action on Employee
    Route::group(["prefix" => "Employee"], function () {

        Route::get('/list', [EmployeeController::class, 'index'])->name('index');
        Route::get('/list-action', [EmployeeController::class, 'indexAction'])->name('indexAction');
        Route::get('/add', [EmployeeController::class, 'add'])->name('add');
        Route::post('/add-action', [EmployeeController::class, 'addAction'])->name('addAction');
        Route::get('/edit-/{user}', [EmployeeController::class, 'edit'])->name('edit');
        Route::post('/edit-action/{user}', [EmployeeController::class, 'editAction'])->name('editAction');
        Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
    });
    
    //holidays
    Route::group(['prefix' => 'Holiday'], function () {

        Route::get('/list', [HolidayController::class, 'index'])->name('holiday-index');
        Route::get('/list-action', [HolidayController::class, 'indexAction'])->name('holiday-indexAction');
        Route::get('/create', [HolidayController::class, 'createHoliday'])->name('createHoliday');
        Route::post('/create-Action', [HolidayController::class, 'createHolidayAction'])->name('createHolidayAction');        
        Route::get('/edit/{id}',[HolidayController::class,'edit'])->name('holiday-edit');
        Route::post('/editAction',[HolidayController::class,'editAction'])->name('holiday-edit-action');
        Route::get('/delete/{id}',[HolidayController::class,'delete'])->name('holiday-delete');
    });

    //leaves
    Route::group(['prefix' => 'leave'],function(){

       
        
    });


});

Route::post('add-Action',[LeaveController::class,'addAction'])->name('leave-add-action');
Route::view('test','leave.add_leave');