<?php

use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\COSController;
use App\Controllers\LaneController;
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
    
    // LANE
    Route::get('/admin/lane',[LaneController::class,'index'])->name('lane.index');
    Route::get('/admin/lane/getdata',[LaneController::class,'getData'])->name('lane.getdata');
    Route::post('/admin/lane',[LaneController::class,'store'])->name('lane.create');
    Route::put('/admin/lane/{id}',[LaneController::class,'update'])->name('lane.update');
    Route::delete('/admin/lane/{id}',[LaneController::class,'destroy'])->name('lane.destroy');

    // COS
    Route::get('/admin/cos',[COSController::class,'index'])->name('cos.index');
    Route::get('/admin/cos/getdata',[COSController::class,'getData'])->name('cos.getdata');
    Route::post('/admin/cos',[COSController::class,'store'])->name('cos.create');
    Route::put('/admin/cos/{id}',[COSController::class,'update'])->name('cos.update');
    Route::delete('/admin/cos/{id}',[COSController::class,'destroy'])->name('cos.destroy');

    Route::post('/emp',[ApiController::class, 'getEmployee'])->name('getemp');
});
Route::get('/file/secure',function(){
    serve_secure_file();
});