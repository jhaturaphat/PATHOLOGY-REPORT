<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabOrderImageController;
use App\Http\Controllers\pathologyController;
use App\Http\Controllers\ImageController;

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

Route::get('/laborderimage/index', [LabOrderImageController::class, 'index']);
Route::get('/laborderimage/findlaborder', [LabOrderImageController::class, 'findLabOrder'])->name('findlaborder');

Route::get('/pathology-a/index', [pathologyController::class, 'index']);
Route::post('/pathology-a', [pathologyController::class, 'crerate']);

Route::post('/upload-image', [ImageController::class, 'uploadImage']);
