<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;


class AuthenticationLayout extends Component
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
        return view('layouts.authentication',  ['companies' => $this->companies]);
    }
}
