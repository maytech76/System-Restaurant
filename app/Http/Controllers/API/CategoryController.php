<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
   
    /* Listar Categorias */
    public function index(){

        // Obtener solo las categorías con status = 1 (activas)
        $categories = Category::where('status', 1)->get();

        return response()->json($categories);
    }

    /* Ingresar Nueva Categoria */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->user_id = $request->user_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category->image_path = $path;
        }

        $category->save();

        return response()->json($category, 201);
    }

    /* Visualizar Catrgoria especifica segun id */
    public function show(string $id){
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /* Actualizar registro Campos Text/image */
    public function updateByCategory(Request $request){
        
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_url' => 'nullable|url',
            'status' => 'required|integer'
        ]);

        // Obtener la categoría relacionada por category_id
        $category = Category::findOrFail($request->category_id);

        // Si se ha proporcionado una imagen, se sube al servidor
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image_path = $imagePath;
        } 
        // Si se ha proporcionado una URL de imagen
        elseif ($request->filled('image_url')) {
            $category->image_path = $request->image_url;
        }

        // Actualizar el campo name
        $category->name = $request->name;
        $category->status = $request->status;  // Actualizamos el campo status

        // Guardar los cambios
        $category->save();

        // Responder con la categoría actualizada
        return response()->json([
            'category' => $category,
            'message' => 'Categoria Actualizada con Exito..!',
        ]);
    }


    /* Eliminar o Desactivar Categoria */
    public function destroy($id){
        // Buscar la categoría por ID
        $category = Category::findOrFail($id);

        // Verificar si la categoría tiene productos relacionados
        if ($category->products()->count() > 0) {
            // Si tiene productos, solo se desactiva cambiando el estado a 0
            $category->status = 0;
            $category->save();

            return response()->json([
                'message' => 'Categoria  Desactivada con Exito..!',
                'category' => $category,
            ], 200);
        } else {
            // Si no tiene productos, eliminar la imagen asociada
            if ($category->image_path && Storage::disk('public')->exists($category->image_path)) {
                Storage::disk('public')->delete($category->image_path);
            }

            // posterior de eliminada la imagen, eliminar la categoría
            $category->delete();

            return response()->json([
                'message' => 'Categoria Eliminada  con Exito..!',
            ], 200);
        }
    }

   
       
}
