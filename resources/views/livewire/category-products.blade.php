<div>
    <div>
        {{-- categorias --}}
        <div class="flex justify-center shadow-md w-full h-[150px] my-6 rounded-lg gap-4 overflow-x-auto">
            @foreach ($categories as $category)
                <div class="gap-2 text-center flex-shrink-0">
                    <a href="#" wire:click.prevent="setCategory({{ $category->id }})">
                        <img src="{{ $category->image_path ? asset($category->image_path) : asset('default.jpg') }}"
                             class="w-20 sm:w-[150px] h-15 sm:h-[100px] object-cover">
                        <p class="text-gray-300">{{ $category->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    
        {{-- Session de Menu --}}
        <div class="mt-10">
            <div>
                <div class='p-1'>
                    <h4 class="text-gray-200 font-semibold uppercase">{{ $categories->find($selectedCategory)->name }}</h4>
                    <ul class='grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 md:p-2 xl:p-4'>
                        @foreach ($products as $product)
                            <li class='relative bg-gradient-to-r from-gray-800 to-gray-900 flex w-full gap-4 border border-red-600 rounded hover:transition shadow-md hover:border-red-900 hover:shadow-red-600'>
                                <Link class='w-full overflow-hidden rounded' href="{{ route('products.show', $product->id) }}">
                                    <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('default.jpg') }}" alt="{{ $product->name }}" class='object-cover rounded w-28 h-full' />
                                </Link>
                                <div class='flex flex-col justify-between flex-grow gap-3 px-2'>
                                    <div class='w-full'>
                                        <span class='font-semibold md:text-xl text-gray-200'>{{ $product->name }}</span>
                                        <p class='pt-1 text-sm text-gray-300'>{{ $product->description ?? 'Descripción no disponible.' }}</p>
                                    </div>
                                    <div class='flex items-center justify-between gap-1 mb-2'>
                                        <div class='text-sm text-gray-400'>
                                            <div class="flex items-center gap-1 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="12" height="12">
                                                    <path fill="#ffffff" d="M12,24C5.383,24,0,18.617,0,12S5.383,0,12,0s12,5.383,12,12-5.383,12-12,12Zm0-21C7.038,3,3,7.037,3,12s4.038,9,9,9,9-4.037,9-9S16.962,3,12,3Zm4.265,8.472l-1.505-2.596-1.76,1.021v-3.896h-3V15.104l6.265-3.632Z"/>
                                                </svg>
                                                {{ $product->preparation_time ?? 'No establecido' }}
                                                <span> Minutos</span>
                                            </div>
                                        </div>
                                        <div class='flex items-center gap-1 px-2 py-1 text-gray-700 rounded'>
                                            <div class='text-sm text-red-700'>{{ number_format($product->price, 0, ',', '.') }} CLP</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>
