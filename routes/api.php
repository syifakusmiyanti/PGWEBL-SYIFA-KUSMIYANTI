<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//GeoJSON
Route::get('/points', [ApiController::class, 'geojson_points'])
    ->name('api.geojson.points');
//GeoJSON
Route::get('/point/{id}', [ApiController::class, 'geojson_point'])
    ->name('api.geojson.point');

//GeoJSON
Route::get('/polylines', [ApiController::class, 'geojson_polylines'])
    ->name('api.geojson.polylines');
Route::get('/polyline/{id}', [ApiController::class, 'geojson_polyline'])
    ->name('api.geojson.polyline');


//GeoJSON
Route::get('/polygons', [ApiController::class, 'geojson_polygons'])
    ->name('api.geojson.polygons');
Route::get('/polygon/{id}', [ApiController::class, 'geojson_polygon'])
    ->name('api.geojson.polygon');

