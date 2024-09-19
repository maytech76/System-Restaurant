<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Método para mostrar el producto en la vista add-to-cart
    public function show($productId)
    {
        // Obtener el producto por su ID
        $product = Product ::findOrFail($productId);

        // Pasar el producto a la vista
        return view('livewire.products.add-to-cart', compact('product'));
    }
}
