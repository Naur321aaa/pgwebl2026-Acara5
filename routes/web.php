<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\PolylinesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landingpage'])->name('home');

Route::get('/peta', [PageController::class, 'peta']) ->middleware(['auth', 'verified'])->name('peta');

Route::get('/tabel', [PageController::class, 'tabel']) ->middleware(['auth', 'verified'])->name('tabel');


// ================= POINTS =================

// Points
Route::post('/store-points', [PointsController::class, 'store'])->name('points.store');

// Route untuk menghapus point berdasarkan id
Route::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('points.delete');

// Route untuk menampilkan form edit point berdasarkan id
Route::get('/edit-point/{id}', [PointsController::class, 'edit'])->name('point.edit');

// Route untuk mengupdate point berdasarkan id
Route::patch('/update-point/{id}', [PointsController::class, 'update'])->name('point.update');


// ================= POLYLINES =================

// Polylines
Route::post('/store-polylines', [PolylinesController::class, 'store'])->name('polylines.store');

// Route untuk menghapus polyline berdasarkan id
Route::delete('/delete-polylines/{id}', [PolylinesController::class, 'destroy'])->name('polylines.delete');

// Route untuk menampilkan form edit polyline berdasarkan id
Route::get('/edit-polyline/{id}', [PolylinesController::class, 'edit'])->name('polyline.edit');

// Route untuk mengupdate polyline berdasarkan id
Route::patch('/update-polyline/{id}', [PolylinesController::class, 'update'])->name('polyline.update');


// ================= POLYGONS =================

// Polygones
Route::post('/store-polygons', [PolygonsController::class, 'store'])->name('polygons.store');

// Route untuk menghapus polygon berdasarkan id
Route::delete('/delete-polygons/{id}', [PolygonsController::class, 'destroy'])->name('polygons.delete');

// Route untuk menampilkan form edit polygon berdasarkan id
Route::get('/edit-polygon/{id}', [PolygonsController::class, 'edit'])->name('polygons.edit');

// Route untuk mengupdate polygon berdasarkan id
Route::patch('/update-polygon/{id}', [PolygonsController::class, 'update'])->name('polygons.update');


// Tentang
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
