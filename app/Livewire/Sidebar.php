<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;

class Sidebar extends Component
{
    public $companies;

    // Utilizamos el constructor para inicializar la propiedad
    public function __construct()
    {
        // Cargar todas las compañías
        $this->companies = Company::all();

        // Si no hay compañías, puedes manejarlo como prefieras
        if ($this->companies->isEmpty()) {
            $this->companies = null; // O manejar este caso de otra manera
        }
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        return view('livewire.sidebar',  ['companies' => $this->companies]);
    }
}
