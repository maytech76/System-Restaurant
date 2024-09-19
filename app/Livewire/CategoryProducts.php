<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryProducts extends Component
{

    public $categories;
    public $selectedCategory;
    public $products;

    public function mount()
    {
        $this->categories = Category::all(); // Obtener todas las categorías
        $this->selectedCategory = $this->categories->first()->id; // Categoría por defecto
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Category ::find($this->selectedCategory)->products; // Cargar productos de la categoría seleccionada
    }

    public function updatedSelectedCategory($value)
    {
        $this->loadProducts();
    }

    
    public function setCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->loadProducts();
    }




    

    public function render()
    {
        return view('livewire.category-products');
    }
}
