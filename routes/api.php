<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

/* Actualizar Productos */
Route::post('/products/update', [ProductController::class, 'updateByCategory']);

/* Actualizar categorias */
Route::post('/categories/update', [CategoryController::class, 'updateByCategory']);

/* Desactivar categoria - Eliminar */
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
