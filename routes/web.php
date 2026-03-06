<?php

use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\COSController;
use App\Controllers\FourMController;
use App\Controllers\HomeController;
use App\Controllers\LaneController;
use App\Controllers\LsController;
use App\Controllers\PointSkillController;
use App\Controllers\UserController;
use Bpjs\Framework\Helpers\AuthMiddleware;
use Bpjs\Framework\Helpers\Route;
use Bpjs\Framework\Helpers\View;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/login', [AuthController::class,'index'])->name('auth.index.login');
Route::post('/login',[AuthController::class,'login'])->limit(10)->name('auth.login');
Route::post('/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::group([AuthMiddleware::class], function(){
    Route::get('/admin', function(){
        return view('home/dashboard',[],'layout/app');
    })->name('admin');
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

    // Layout Sheet
    Route::get('/admin/layout-sheet',[LsController::class,'index'])->name('ls.index');
    Route::get('/admin/layout-sheet/getdata',[LsController::class,'getData'])->name('ls.getdata');
    Route::post('/admin/layout-sheet',[LsController::class,'store'])->name('ls.create');
    Route::put('/admin/layout-sheet/{id}',[LsController::class,'update'])->name('ls.update');
    Route::delete('/admin/layout-sheet/{id}',[LsController::class,'destroy'])->name('ls.destroy');

    // 4M
    Route::get('/admin/4m',[FourMController::class,'index'])->name('4m.index');
    Route::get('/admin/4m/getdata',[FourMController::class,'getData'])->name('4m.getdata');
    Route::post('/admin/4m',[FourMController::class,'store'])->name('4m.create');
    Route::put('/admin/4m/{id}',[FourMController::class,'update'])->name('4m.update');
    Route::delete('/admin/4m/{id}',[FourMController::class,'destroy'])->name('4m.destroy');

    // Point Skill
    Route::get('/admin/point-skill',[PointSkillController::class,'index'])->name('ps.index');
    Route::get('/admin/point-skill/getdata',[PointSkillController::class,'getData'])->name('ps.getdata');
    Route::post('/admin/point-skill',[PointSkillController::class,'store'])->name('ps.create');
    Route::put('/admin/point-skill/{id}',[PointSkillController::class,'update'])->name('ps.update');
    Route::delete('/admin/point-skill/{id}',[PointSkillController::class,'destroy'])->name('ps.destroy');

    Route::post('/emp',[ApiController::class, 'getEmployee'])->name('getemp');
});
Route::get('/file/secure',function(){
    serve_secure_file();
});
Route::get('/cos/{id}',[COSController::class,'getCosByLane'])->name('cos.lane');
Route::get('/layout/{id}',[LsController::class,'getLayoutByLane'])->name('layout.lane');
Route::get('/4m/{id}',[FourMController::class,'get4mByLane'])->name('4m.lane');
Route::get('/point-skill/{id}',[PointSkillController::class,'getPointByLane'])->name('point.lane');
Route::get('/dashboard/{laneid}',[HomeController::class,'dashboard'])->name('dashboard');