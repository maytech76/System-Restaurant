<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**Listar Productos*/
    public function index(){
        // Obtener solo las categorías con status = 1 (activas)
        $products = Product::where('status', 1)->get();

        return response()->json($products);
    }


    /**Crear Nuevo Productos */
    public function store(Request $request){

          //Validar datos del formulario
          $request->validate([

            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'user_id' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

         //si pasa la validacion creamos el registro
         $product = new Product();
         $product->name = $request->name;
         $product->description = $request->description;
         $product->category_id = $request->category_id;
         $product->price = $request->price;
         $product->stock = $request->stock;
         $product->user_id = $request->user_id; // Guardar el ID del usuario autenticado


         if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;   
        }

        $product->save();

        return response()->json([$product, 'Producto Creado Exitosamente'], 201);
    }

    /* Visualizar Producto Especifico*/
    public function show(string $id){
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /* Actualización de Producto text-Image*/
    public function updateByProduct(Request $request){

         //Validar datos del formulario
          $request->validate([

            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'product_id' => 'required',
            'category_id' => 'required',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_url' => 'nullable|url',
            'status' => 'required|integer'    
        ]);

       // Obtener el producto relacionado con  Product_id
       $product =Product::findOrFail($request->product_id);

        // Si se ha proporcionado una imagen, se sube al servidor
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        } 


        // Si se ha proporcionado una URL de imagen
        elseif ($request->filled('image_url')) {
           $product->image_path = $request->image_url;
        }


        // Actualizar campos
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->status = $request-> status; // Actualizamos el campo status
        $product->user_id = $request-> user_id; // Guardar el ID del usuario autenticado


        // Guardar los cambios
        $product->save();


        // Responder con la categoría actualizada
        return response()->json([
            'product' =>$product,
            'message' => 'Producto Actualizado con Exito..!',
        ], 201);
    }

    /* Eliminar producto e Imagen Vinculada*/
    public function destroy(string $id){

         // Buscar producto por ID
         $product = Product::findOrFail($id);

         // Si existe Imagen, eliminar la imagen asociada al producto
         if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // posterior de eliminada la imagen, eliminar el producto
        $product->delete();

        return response()->json([
            'message' => 'Producto Eliminado  con Exito..!'
        ], 200);
    }
}
