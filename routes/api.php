<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\AuthController;


/* Listado general de Categorias con status = 1 (activos) */
Route::get('categories', [CategoryController::class, 'index']);


/* Listado general de productos con status = 1 (activos) */
Route::get('products', [ProductController::class, 'index']);


/* Visualizar un producto especifico por su id */
Route::get('/products/{id}', [ProductController::class, 'show']);



/* Registro de Nuevo Usuario */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


/*****  Grupo Middleware para  proteger las rutas sensibles ******/
Route::middleware(['auth:sanctum'])->group(function(){
    
    
    Route::get('logout', [AuthController::class, 'logout']);

    /* Actualizar Productos */
    Route::post('/products/update', [ProductController::class, 'updateByProduct']);

    /* Eliminar - Producto e Imagen*/
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    /* Actualizar categorias */
    Route::post('/categories/update', [CategoryController::class, 'updateByCategory']);

    /* Desactivar categoria - Eliminar */
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
