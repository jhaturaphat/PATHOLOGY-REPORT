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

Route::get('/pathology-a/index', [pathologyController::class, 'index'])->name('pathology-a.index');
Route::get('/pathology-a/report', [pathologyController::class, 'report']);
Route::get('/pathology-a/show', [pathologyController::class, 'show'])->name('show');
Route::get('/pathology-a/edit/{id}', [pathologyController::class, 'edit'])->name('pathology-a.edit');
Route::post('/pathology-a', [pathologyController::class, 'store']);


Route::post('/upload-image', [ImageController::class, 'uploadImage'])->name('upload-image');
