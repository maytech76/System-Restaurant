<div>
    <div>
        <div class="mt-10 max-w-2xl mx-auto p-6 rounded-lg shadow-md bg-white">
          
        
           <!-- Búsqueda de Productos -->
           <div class="mb-6">
            <label for="searchProduct" class="block text-lg font-bold">Buscar Productos</label>
            <input id="searchProduct" wire:model.live="searchProduct" type="text" placeholder="Buscar producto" class="w-full border-gray-300 rounded-md" />
           </div>
    
            <!-- Lista de Productos -->
            @if($products)
                <div class="mb-4 mx-2">
                    <h3 class="font-bold text-lg">Resultados de búsqueda:</h3>
                    <ul class="border rounded-lg p-4">
                        @foreach ($products as $product)
                            <li class="mb-2 flex justify-between items-center">
                                <span>{{ $product->name }} - ${{ number_format($product->price, 2) }}</span>
                                <button wire:click="addProduct({{ $product->id }})" class="bg-green-500 text-white px-2 py-1 rounded">Añadir</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <!-- Tabla de Orden de Pedido -->
            <table class="w-full bg-white border py-6">
                <thead>
                    <tr>
                        <th class="p-2 border">Producto</th>
                        <th class="p-2 border">Cantidad</th>
                        <th class="p-2 border">Notas</th>
                        <th class="p-2 border">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $index => $item)
                        <tr>
                            <td class="p-2 border">{{ $item['name'] }}</td>
                            <td class="flex justify-center py-4">
                                <button wire:click="updateQuantity({{ $item['id'] }}, -1)" class="bg-red-500 text-white px-2 mx-2 rounded">-</button>
                                {{ $item['quantity'] }}
                                <button wire:click="updateQuantity({{ $item['id'] }}, 1)" class=" bg-green-500 px-2 mx-2 rounded">+</button>
                            </td>
                            <td class="p-2 border text-center">
                                <button wire:click="openModal({{ $index }})" class="bg-blue-500 text-white px-3 py-1 rounded">
                                    Petición
                                </button>
                            </td>
                            <td class="p-2 border text-center">
                                <button wire:click="removeProduct({{ $item['id'] }})" class="justify-center py-2 px-4 bg-red-500 text-white rounded-full"> - </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <!-- Modal para agregar notas -->
            @if($showModal)
                <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-40">
                    <div class="bg-white p-6 rounded shadow-lg w-1/2">
                        <h2 class="text-lg font-bold mb-4">{{ $orderItems[$currentProductIndex]['name'] }}</h2>
                        
                        <textarea wire:model="currentNote" rows="4" class="w-full border p-2 mb-4" placeholder="Agregar detalles al pedido"></textarea>
                        
                        <div class="flex justify-center gap-3">
                            <button wire:click="$set('showModal', false)" class="bg-red-500 text-white px-4 py-2 rounded">Cancelar</button>
                            <button wire:click="saveNote" class="bg-green-500 text-white px-4 py-2 rounded">Guardar</button>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Totales y Botones -->
            <div class="flex justify-between items-center pt-4 mt-4">
                <div class="sm:text-xs md:text-sm font-light">
                    Subtotal: ${{ number_format($subtotal, 2) }} <br>
                    IVA: ${{ number_format($iva, 2) }} <br>
                    Total: ${{ number_format($total, 2) }}
                </div>
                <div class="space-x-4">
                    <button onclick="window.location='{{ route('select.tables') }}'" class="bg-blue-500 text-white px-4 py-2 rounded">Mesas</button>
                    {{-- <button wire:click="clearOrder" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button> --}}
                    <button wire:click="saveOrder" class="bg-green-500 text-white px-4 py-2 rounded">Pedir</button>
                </div>
            </div>
    
        </div>
    </div>
    
</div>
