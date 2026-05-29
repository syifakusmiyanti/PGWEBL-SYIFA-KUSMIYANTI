<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [PageController::class, 'landingpage'])->name('home');

Route::get('/peta', [PageController::class, 'peta'])
->middleware(['auth', 'verified'])
->name('peta');


Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');


// Points
route::post('/store-points', [PointsController::class, 'store'])
    ->name('points.store');
//delete point
route::delete('/delete-points/{id}', [PointsController::class,'destroy'])
->name('points.delete');
//edit point
route::get('/edit-points/{id}', [PointsController::class,'edit'])
->name('points.edit');
//route update point
route::patch('/update-points/{id}', [PointsController::class,'update'])
->name('points.update');



// Polylines
route::post('/store-polylines', [PolylinesController::class, 'store'])
    ->name('polylines.store');
route::delete('/delete-polylines/{id}', [PolylinesController::class, 'destroy'])
->name('polylines.delete');
//edit polyline
route::get('/edit-polylines/{id}', [PolylinesController::class,'edit'])
->name('polylines.edit');
route::patch('/update-polylines/{id}', [PolylinesController::class,'update'])
->name('polylines.update');


// Polygons
route::post('/store-polygons', [PolygonsController::class, 'store'])
    ->name('polygons.store');
route::delete('/delete-polygons/{id}', [PolygonsController::class, 'destroy'])
->name('polygons.delete');
//edit polygon
route::get('/edit-polygons/{id}', [PolygonsController::class,'edit'])
->name('polygons.edit');
route::patch('/update-polygons/{id}', [PolygonsController::class,'update'])
->name('polygons.update');

// Dashboard
Route::get('/dashboard', function() {
    return redirect()->route('peta');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__ . '/settings.php';
