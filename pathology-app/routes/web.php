<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabOrderImageController;
use App\Http\Controllers\SurgicalController;
use App\Http\Controllers\CytologicalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OpduserController;
use App\Http\Controllers\TestController;
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
        return redirect('/surgical/index');
    }
    return redirect('/login');
})->name('home');

// cytological
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laborderimage/index', [LabOrderImageController::class, 'index']);
    Route::get('/laborderimage/synctoimage', [LabOrderImageController::class, 'syncToImageHis'])->name('synctoimage');
    Route::get('/laborderimage/findlaborder', [LabOrderImageController::class, 'findLabOrder'])->name('findlaborder');
    Route::get('/laborderimage/countImage', [LabOrderImageController::class, 'countImage'])->name('count-image');

    Route::get('/surgical/index', [SurgicalController::class, 'index'])->name('surgical.index');
    Route::get('/surgical/view/{id}', [SurgicalController::class, 'view'])->name('surgical.view');
    Route::get('/surgical/report', [SurgicalController::class, 'report']);
    Route::get('/surgical/find-id', [SurgicalController::class, 'findId'])->name('find-id');
    Route::get('/surgical/edit/{id}', [SurgicalController::class, 'edit'])->name('surgical.edit');
    Route::post('/surgical', [SurgicalController::class, 'store']);
    Route::put('/surgical', [SurgicalController::class, 'update']);
    Route::PATCH('/surgical/{id}', [SurgicalController::class, 'release'])->name('sur.confirm');
    Route::delete('/surgical/{id}', [SurgicalController::class, 'destroy'])->name('delete');

    Route::get('/cytological/index', [CytologicalController::class, 'index'])->name('cytological.index');
    Route::get('/cytological/report', [CytologicalController::class, 'report']);
    Route::get('/cytological/find-id', [CytologicalController::class, 'findId'])->name('find-id');
    Route::get('/cytological/edit/{id}', [CytologicalController::class, 'edit'])->name('cytological.edit');
    Route::post('/cytological', [CytologicalController::class, 'store']);
    Route::put('/cytological', [CytologicalController::class, 'update']);
    Route::PATCH('/cytological/{id}', [CytologicalController::class, 'release'])->name('cyt.confirm');
    Route::delete('/cytological/{id}', [CytologicalController::class, 'destroy'])->name('delete');

    Route::post('/logout', [UserController::class,'logout'])->name('logout');
    // Route::get('/register',[UserController::class,'registerForm'])->name('register');
    // Route::post('/register',[UserController::class,'register']);

    Route::post('/profile', [UserController::class, 'chPassword'])->name('profile.password');
});

Route::get('/register',[UserController::class,'registerForm'])->name('register');
Route::post('/register',[UserController::class,'register']);

Route::get('/login', [UserController::class,'loginForm'])->name('login');
Route::post('/login', [UserController::class,'login']);

Route::get('/test/drag', [TestController::class, 'drag']);
Route::get('/test/accept', [TestController::class, 'accept']);
Route::get('/test/card', [TestController::class, 'card']);






