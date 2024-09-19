<?php

namespace App\Livewire\Products;

use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Product;


class addToCart extends Component
{
    public $productId;
    public $qty = 1;

    

   // Este método se ejecuta al montar el componente, obteniendo el producto por ID
   public function mount($productId)
   {
       $this->productId = Product::findOrFail($productId);
   }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

       /*  Cart::instance('shopping'); */

       if ($product) {

         Cart::instance('shopping');
           
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $this->qty,
                'image' => $product->image_path,
            ]);

           /*  session()->flash('message', 'Producto añadido al carrito.'); */

       }
        
    }

    public function render()
    {
        return view('prueba');
    }
}
