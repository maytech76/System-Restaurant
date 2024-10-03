<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
   
    public function index()
    {
         // Obtener solo las categorías con status = 1 (activas) y paginar 4 por página
         $categories = Category::where('status', 1)->paginate(4);

         //Retornamos  la vista con la información de las categorías con status=1
        return view('categories.index', compact('categories'));
    }

    
    public function create(){
        // Obtener la última categoría registrada
        $lastCategory = Category::latest()->first();

        return view('categories.create', compact('lastCategory'));
    }

   
    public function store(Request $request){
        //Validar datos del formulario
        $request->validate([
            'name'=>'required',
            'image_path'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->user_id = Auth::id(); // Guardar el ID del usuario autenticado
        $category->image_path = $imagePath; 
        $category->save();


        session()->flash('swal', [
            
            'title' => "Buen Trabajo",
            'text'=> "Registro Exitoso..!!",
            'icon' => "success",
            'showConfirmButton'=> false,
            'timer'=> 1700
         ]);


        //Redirecionamos a products.index
        return redirect()->route('categories.index')->with('success', 'Categoria Creada');
    }

   
    public function show(Category $category){
        // Obtenemos la información del usuario que creó la categoría
         $user = $category->user;

        return view('categories.show', compact('category', 'user'));
    }

    
    public function edit(Category $category){
        return view('categories.edit', compact('category'));
    }

    
    public function update(Request $request, Category $category){
         //Validar datos del formulario
         $request->validate([

            'name'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);

         // Manejo de la imagen
       if ($request->hasFile('image')) {

        // Si hay una nueva imagen, la guardamos y eliminamos la imagen anterior si existe
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }

        // Guardar la nueva imagen
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image_path = $imagePath;
       

       }

        
        $category->name = $request->input('name');
        $category->status = $request->status;  // Actualizamos el campo status
        $category->save();


        session()->flash('swal', [
            
            'title' => "Buen Trabajo",
            'text'=> "Registro Actualizado",
            'icon' => "success",
            'showConfirmButton'=> false,
            'timer'=> 1700
         ]);

        //Redirecionamos a products.index
        return redirect()->route('categories.index')->with('success', 'Producto Actualizado');
    }

    
    public function destroy(Category $category){
        // Verificar si la categoría tiene productos relacionados
        if ($category->products()->count() > 0) {
            // Si tiene productos, solo se desactiva cambiando el estado a 0
            $category->status = 0;
            $category->save();

            // Mostrar mensaje de desactivación con SweetAlert
            session()->flash('swal', [
                'title' => "Categoría Desactivada",
                'text' => "Esta categoría ha sido desactivada porque tiene productos asociados.",
                'icon' => "warning",
                'showConfirmButton' => false,
                'timer' => 2000,
            ]);

            // Redireccionar a la lista de categorías
            return redirect()->route('categories.index')->with('success', 'Categoría desactivada.');
        } else {
            // Si no tiene productos, eliminar la imagen si existe
            if ($category->image_path && Storage::disk('public')->exists($category->image_path)) {
                Storage::disk('public')->delete($category->image_path);
            }

            // Luego eliminar la categoría
            $category->delete();

            // Mostrar mensaje de eliminación con SweetAlert
            session()->flash('swal', [
                'title' => "Registro Eliminado",
                'text' => "Eliminado, Proceso Irreversible..!!",
                'icon' => "warning",
                'showConfirmButton' => false,
                'timer' => 2000,
            ]);

            // Redireccionar a la lista de categorías
            return redirect()->route('categories.index')->with('success', 'Categoría eliminada.');
        }
    }
}
