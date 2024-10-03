<x-app-layout>

    
    <div class="px-4 sm:px-6 lg:px-8 py-2 w-full max-w-9xl mx-auto">

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-2">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Mesas</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <x-datepicker />
            </div>

        </div>

     <div class="flex items-center justify-center px-4 sm:px-6 lg:px-8 py-2 w-full max-w-9xl mx-auto">
         {{-- Formulario de registro --}}
        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">

          

            <form class="max-w-lg mx-auto" action="{{route('tables.update', $table->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="name" name="name" value="{{$table->name}}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                         />
                </div>

                <div class="mb-5">
                    <label for="chairs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de Sillas</label>
                    <input type="text" id="chairs" name="chairs" value="{{$table->chairs}}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                         />
                </div>

               
                 {{-- Botones --}}
               <div class="items-center gap-6">
                    <button type="submit"
                        class="mx-6 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        Actualizar
                    </button>

                 <button class="text-gray-800 bg-red-200 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    <a href="{{route('tables.index')}}">Regresar</a>
                 </button>
                    
                </div>

            </form>


        </div>
     </div>

    </div>


</x-app-layout>