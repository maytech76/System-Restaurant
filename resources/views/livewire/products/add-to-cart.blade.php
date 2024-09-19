<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Agregar a Comanda</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Imagen del producto -->
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover" />

        <!-- Información del producto -->
        <div class="p-4">
            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
            <p class="text-sm text-gray-600">{{ $product->description }}</p>
            <p class="text-xl font-bold mt-2 text-gray-900">${{ number_format($product->price, 2) }}</p>
        </div>

        <!-- Botón para confirmar la acción de agregar a comanda -->
        <div class="p-4 bg-gray-100">
            <button 
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
                wire:click="addToCart"
            >
                Agregar a Comanda
            </button>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if (session()->has('success'))
        <div class="mt-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif
</div>
