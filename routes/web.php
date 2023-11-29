<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\DashboardContrller;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardContrller::class, 'index'])->name('dashboard');

Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');

Route::get('/bobot', [BobotController::class, 'index'])->name('bobot.index');
Route::post('/bobot', [BobotController::class, 'store'])->name('bobot.store');

Route::get('/result', [ResultController::class, 'index'])->name('result.index');
Route::post('/result', [ResultController::class, 'store'])->name('result.store');
Route::delete('/result/{id}', [ResultController::class, 'destroy'])->name('result.destroy');

Route::get('/matrix-keputusan', [ViewController::class, 'viewMatrixKeputusan'])->name('view.matrixKeputusan');
Route::get('/maximum-value-of-kriteria', [ViewController::class, 'maximumValue'])->name('view.maximumValue');
Route::get('/normalisasi', [ViewController::class, 'viewNormalisasi'])->name('view.normalisasi');
Route::get('/pra-rangking', [ViewController::class, 'viewPraRangking'])->name('view.prarangking');
Route::get('/rangking', [ViewController::class, 'viewRangking'])->name('view.rangking');
