<?php

use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use Bpjs\Framework\Helpers\AuthMiddleware;
use Bpjs\Framework\Helpers\Route;
use Bpjs\Framework\Helpers\View;

Route::get('/', function(){
    $title = 'JOUHOU BOARD';
    return view('home/home',compact('title'));
});
Route::get('/login', [AuthController::class,'index'])->name('auth.index.login');
Route::post('/login',[AuthController::class,'login'])->limit(10)->name('auth.login');
Route::post('/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::group([AuthMiddleware::class], function(){
    Route::get('/admin', function(){
        return view('home/dashboard',[],'layout/app');
    });
    // USER
    Route::get('/admin/user',[UserController::class,'index'])->name('user.index');
    Route::get('/admin/user/getdata',[UserController::class,'getData'])->name('user.getdata');
    Route::post('/admin/user',[UserController::class,'store'])->name('user.create');
    Route::put('/admin/user/{id}',[UserController::class,'update'])->name('user.update');
    Route::delete('/admin/user/{id}',[UserController::class,'destroy'])->name('user.destroy');
    
    Route::post('/emp',[ApiController::class, 'getEmployee'])->name('getemp');
});