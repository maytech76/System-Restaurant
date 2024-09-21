<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Aplicamos la Paginacion por 8 items las cuales se reflejaran en la vista index
        $categories = Category::paginate(6);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener la última categoría registrada
        $lastCategory = Category::latest()->first();

        return view('categories.create', compact('lastCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(Category $category){
        // Obtenemos la información del usuario que creó la categoría
         $user = $category->user;

        return view('categories.show', compact('category', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

            // Eliminar la imagen si existe
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }
        
        $category->delete();

        session()->flash('swal', [
            
            'title' => "Registro",
            'text'=> "Eliminado, Proceso Inrebersible..!!",
            'icon' => "warning",
            'showConfirmButton'=> false,
            'timer'=> 2000
         ]);

        //Redirecionamos a categories.index
        return redirect()->route('categories.index')->with('success', 'Categoria Eliminada');
    }
}
