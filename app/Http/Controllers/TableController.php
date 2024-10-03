<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;



class TableController extends Controller
{
    /**Listado de mesas activas**/
    public function index(){

        // Filtrar para obtener solo los registros con status = 1
        $tables = Table::where('status', 1) // Condición para mostrar solo los activos
        ->paginate(4);

      return view('tables.index', compact('tables'));
    }

    /**Visualizamo el formulario Crear mesa**/
    public function create(){

        // Obtener la última Mesa registrada
        $lastTable = Table::latest()->first();
    
       return view('tables.create',  compact('lastTable'));
    }

    /* Insertamos en ls DB nuevo registro */
    public function store(Request $request){

        $request->validate([

            'name' => 'required',
            'chairs' =>  'required',

        ]);

        $table = new Table();
        $table->name = $request->input('name');
        $table->chairs = $request->input('chairs');
        $table->save();

        session()->flash('swal', [
            
            'title' => "Buen Trabajo",
            'text'=> "Registro Exitoso..!!",
            'icon' => "success",
            'showConfirmButton'=> false,
            'timer'=> 1700
         ]);

         return redirect()->route('tables.index')->with('success', 'Mesa Creada');
    }

  
    /* Visualizamos Registro especifico */
    public function show(Table $table){

        return view('tables.show', compact('table'));
    }

    
    public function edit(Table $table){
        return view('tables.edit', compact('table'));
    }

    
    public function update(Request $request, Table $table){
        
        $request->validate([

            'name' => 'required',
            'chairs' =>  'required',

        ]);

        $table->name = $request->input('name');
        $table->chairs = $request->input('chairs');
        $table->save();

        session()->flash('swal', [
            
            'title' => "Buen Trabajo",
            'text'=> "Registro Actualizado..!!",
            'icon' => "success",
            'showConfirmButton'=> false,
            'timer'=> 1700
         ]);


         return redirect()->route('tables.index')->with('success', 'Mesa Actualizada');
    }

    
    public function destroy(Table $table){
        // Verificar si el registro tiene status = 1
        if ($table->status != 1) {

            // Si el status no es 1, mostrar un mensaje de error
            return redirect()->route('tables.index');

            session()->flash('swal', [
                
                'title' => "Error Mesa no Disponible",
                'text'=> "No procede la eliminación del registro..!!",
                'icon' => "error",
                'showConfirmButton'=> false,
                'timer'=> 2000
            ]);

        }

        // Eliminar la tabla si el status es 1
        $table->delete();

      

        session()->flash('swal', [
                
            'title' => "Buen Trabajo",
            'text'=> "Registro Eliminado, Proceso Inrebersible..!!",
            'icon' => "warning",
            'showConfirmButton'=> false,
            'timer'=> 2000
        ]);


          // Mensaje de éxito
          return redirect()->route('tables.index');


    }
}
