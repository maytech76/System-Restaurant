<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProductListController;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use CodersFree\Shoppingcart\Facades\Cart;

use App\Http\Controllers\TableController;
use App\Http\Controllers\WaiterController;

use App\Livewire\Products\AddToCart as ProductsAddToCart;
use App\Livewire\ProductSearch;

use App\Livewire\Menu\CountControl;
use App\Livewire\Menu\CountControlClose;
use App\Livewire\Menu\OrderCreation;
use App\Livewire\Menu\SelectTables;
use App\Livewire\Menu\KitchenControl;
use App\Livewire\Menu\OrderProductsAdd;

use Illuminate\Support\Facades\File;

/* Route::get('/add-to-cart/{productId}', ProductsAddToCart ::class)->name('add-to-cart');

Route::get('/add-to-cart/{productId}', [CartController::class, 'show'])->name('add-to-cart'); */

/* Controlador donde visualizamos la busqueda de producto segun su nombre  */
Route::get('/product-search', ProductSearch ::class)->name('product.search');


/* Route::redirect('/', 'login'); */
Route::get('/', function () {

     // Obtener todos los productos y categorías
     $categories = Category::all();
     $products = Product::all();
     $companyId = 1; // Reemplaza esto con el ID que necesitas buscar

     $companies = Company::find($companyId);

    // Pasar los datos a la vista
    return view('welcome', compact('categories', 'products', 'companies'));

    return view('pages.dashboard', compact('companies'));

});

/* Visualizar publicamente las Productos */
Route::get('/storage/products/{filename}', function ($filename) {
    $path = storage_path('app/public/products/' . $filename);
    
    if (!File ::exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->name('storage.products');


/* Visualizar publicamente las categorias */
Route::get('/storage/categories/{filename}', function ($filename) {
    $path = storage_path('app/public/categories/' . $filename);
    
    if (!File ::exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->name('storage.categories');



/* Ruta para controlador categorias*/
Route::resource('categories', CategoryController::class);


/* Ruta para controlador productos */
Route::resource('products', ProductController::class);

/* Ruta para controlador Mesas */
Route::resource('tables', TableController::class);


/* Ruta para controlador de Meseros */
Route::resource('waiters', WaiterController::class);



/* Ruta para controlador Datos to system */
 Route::resource('companies', CompanyController::class); 



/* Ruta para controlador ProductlistController*/
Route::get('productslist/{product}', [ProductListController::class,  'index'])->name('productslist');




Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Se definie la ruta  para el componente SelectTable->Order-creation
    Route::get('/menu/select-tables', SelectTables::class)->name('select.tables');

     //Se define la ruta que recibira el numero de mesa selecionado, desde SelectTables
     Route::get('/menu/order-creation/{table_id}', OrderCreation::class)->name('order.creation');
 
});   
    
    

Route::get('prueba', function(){
    Cart::instance('shopping');
    return Cart::content();
});
