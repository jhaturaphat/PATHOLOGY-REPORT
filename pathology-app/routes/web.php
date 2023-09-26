<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabOrderImageController;
use App\Http\Controllers\pathologyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OpduserController;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()){
        return redirect('/pathology-a/index');
    }
    return redirect('/login');
})->name('home');

// Route::group(['middleware' => 'auth'], function () {
    Route::get('/laborderimage/index', [LabOrderImageController::class, 'index']);
    Route::get('/laborderimage/synctoimage', [LabOrderImageController::class, 'syncToImageHis'])->name('synctoimage');
    Route::get('/laborderimage/findlaborder', [LabOrderImageController::class, 'findLabOrder'])->name('findlaborder');

    Route::get('/pathology-a/index', [pathologyController::class, 'index'])->name('pathology-a.index');
    Route::get('/pathology-a/report', [pathologyController::class, 'report']);
    Route::get('/pathology-a/find-id', [pathologyController::class, 'findId'])->name('find-id');
    Route::get('/pathology-a/edit/{id}', [pathologyController::class, 'edit'])->name('pathology-a.edit');
    Route::post('/pathology-a', [pathologyController::class, 'store']);
    // Route::put('/pathology-a', [pathologyController::class, 'update']);
    Route::PATCH('/pathology-a/{id}', [pathologyController::class, 'release'])->name('release');
    Route::delete('/pathology-a/{id}', [pathologyController::class, 'destroy'])->name('delete');
    Route::post('/logout', [UserController::class,'logout'])->name('logout');
    // Route::get('/register',[UserController::class,'registerForm'])->name('register');
    //Route::post('/register',[UserController::class,'register']);
// });

Route::get('/register',[UserController::class,'registerForm'])->name('register');
Route::post('/register',[UserController::class,'register']);

Route::get('/login', [UserController::class,'loginForm'])->name('login');
Route::post('/login', [UserController::class,'login']);








