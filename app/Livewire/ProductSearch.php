<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductSearch extends Component
{

    use WithPagination;

    public $search = ''; // Campo de búsqueda

    // Función para actualizar los resultados en tiempo real
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //---------------------------------------------------------
    // Redirigir a la vista "add-to-cart" con el ID del producto
    public function addToCart($productId)
    {
        // Redirigir con el ID del producto
        return redirect()->route('add-to-cart', ['productId' => $productId]);
    }
    //---------------------------------------------------------



    public function render()
    {
        // Verifica si hay texto en la búsqueda
        $products = Product::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate(6); // Si no hay búsqueda, paginar todos los productos

        return view('livewire.product-search', compact('products'));
    }
}
