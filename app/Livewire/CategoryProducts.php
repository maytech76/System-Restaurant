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
        // Obtener solo las categorías con status = 1 (activas)
        $this->categories = Category::where('status', 1)->get(); 
    
        // Verificar si existen categorías activas y seleccionar la primera como predeterminada
        if ($this->categories->isNotEmpty()) {
            $this->selectedCategory = $this->categories->first()->id; // Categoría por defecto
        } else {
            $this->selectedCategory = null; // O maneja una opción por defecto si no hay categorías activas
        }
    
        // Cargar productos relacionados a la categoría seleccionada
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
