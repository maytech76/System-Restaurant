<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Waiter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WaiterController extends Controller
{
  
    public function index(){
         // Obtener solo los waiter con status = 1 (activas) y paginar 4 por página
         $waiters = Waiter::where('status', 1)->paginate(4);

         //Retornamos  la vista con la información de los waiters con status=1
        return view('waiters.index', compact('waiters'));
    }

  
    public function create(){
        //Consultamos toda la lista de usuarios
        $listUsers = User::all();

        //Retornamos a la vista Create con la lista de usuarios
        return view('waiters.create', compact('listUsers'));
    }

  
    public function store(Request $request){

        //Validar datos del formulario
        $request->validate([

            'name'=>'required',
            'user_id'=> 'required',
            'image_path'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('waiters', 'public');
            
        }

        $waiter = new Waiter();
        $waiter->name = $request->input('name');
        $waiter->user_id = $request->input('user_id');
        $waiter->image_path = $imagePath;
    
        $waiter->save();

        session()->flash('swal', [
            
            'title' => "Buen Trabajo",
            'text'=> "Registro Exitoso..!!",
            'icon' => "success",
            'showConfirmButton'=> false,
            'timer'=> 1700
         ]);

          //Redirecionamos a products.index
        return redirect()->route('waiters.index')->with('success', 'Mesero Creado');
        
    }

    
    public function show(Waiter $waiter){
        $user = $waiter->user;

        return view('waiters.show', compact('waiter', 'user'));
    }

   

    public function edit(Waiter $waiter){
        return view('waiters.edit', compact('waiter'));
    }

    

    public function update(Request $request, Waiter $waiter){

         //Validar datos del formulario
         $request->validate([

            'name'=>'required',
            'user_id'=> 'required',
            'image_path'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);

         // Manejo de la imagen
       if ($request->hasFile('image')) {

        // Si hay una nueva imagen, la guardamos y eliminamos la imagen anterior si existe
        if ($waiter->image_path) {
            Storage::disk('public')->delete($waiter->image_path);
        }

        // Guardar la nueva imagen
        $imagePath = $request->file('image')->store('waiters', 'public');
        $waiter->image_path = $imagePath;

       }

       $waiter->save();

        session()->flash('swal', [
            
            'title' => "Buen Trabajo",
            'text'=> "Registro Exitoso..!!",
            'icon' => "success",
            'showConfirmButton'=> false,
            'timer'=> 1700
         ]);

          //Redirecionamos a products.index
        return redirect()->route('waiters.index')->with('success', 'Mesero Editado');
        
    }

  
    public function destroy(Waiter $waiter){

        // Verificar si la categoría tiene productos relacionados
        if ($waiter->users()->count() > 0) {
            // Si tiene productos, solo se desactiva cambiando el estado a 0
            $waiter->status = 0;
            $waiter->save();

            // Mostrar mensaje de desactivación con SweetAlert
            session()->flash('swal', [
                'title' => "Mesero Desactivada",
                'text' => "Este Mesero ha sido desactivada porque tiene productos asociados.",
                'icon' => "warning",
                'showConfirmButton' => false,
                'timer' => 2000,
            ]);

            // Redireccionar a la lista de categorías
            return redirect()->route('waiters.index')->with('success', 'Mesero desactivado.');
        } else {
            // Si no tiene productos, eliminar la imagen si existe
            if ($waiter->image_path && Storage::disk('public')->exists($waiter->image_path)) {
                Storage::disk('public')->delete($waiter->image_path);
            }

            // Luego eliminar la categoría
            $waiter->delete();

            // Mostrar mensaje de eliminación con SweetAlert
            session()->flash('swal', [
                'title' => "Registro Eliminado",
                'text' => "Eliminado, Proceso Irreversible..!!",
                'icon' => "warning",
                'showConfirmButton' => false,
                'timer' => 2000,
            ]);

            // Redireccionar a la lista de categorías
            return redirect()->route('waiters.index')->with('success', 'Mesero eliminado.');
        }
    }
}
