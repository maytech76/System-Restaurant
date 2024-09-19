<div>
    <div class="container mx-auto p-4">
        <!-- Input de búsqueda -->
        <div class="mb-6">
            <input 
                type="text" 
                wire:model.live.500ms="search" 
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Buscar productos por nombre..."
            />
        </div>
    
        <!-- Resultados de la búsqueda en una grid -->
        @if($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Imagen del producto -->
                        <img 
                            src="{{ asset('storage/' . $product->image_path)}}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-48 object-cover"
                        />
    
                        <!-- Información del producto -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $product->description }}</p>
                            <p class="text-xl font-bold mt-2 text-gray-900">${{ number_format($product->price, 2) }}</p>
                        </div>
    
                        <!-- Footer con el botón de "Agregar a Comanda" -->
                        <div class="p-4 bg-gray-100">
                            <button 
                                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
                                wire:click="addToCart({{ $product->id }})"
                            >
                                Agregar a Comanda
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <!-- Paginación -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center text-gray-500">
                No se encontraron productos.
            </div>
        @endif
    </div>
</div>
