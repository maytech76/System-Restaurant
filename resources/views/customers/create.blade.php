<x-app-layout>

        <!-- Header General -->
        <div class="w-[590px] sm:w-[630px] sm:mb-10 md:w-[1240px] justify-center bg-white rounded-md shadow mt-4 mx-auto p-2">
            <div class="flex flex-col sm:flex-row sm:items-center w-[170px] sm:w-[700px] md:w-[1200px] justify-between mx-auto my-2">
        
                <!-- Left: Title -->
                <div class="my-1 sm:mb-0 sm:mr-8">
                    <h3 class="text-sm md:text-2xl text-gray-800 dark:text-gray-100 font-normal">Registros de Clientes</h3>
                </div>
        
                <!-- Right: Actions -->
                <div class="sm:ml-6 sm:mx-0 grid grid-flow-col justify-center sm:justify-between md:justify-end gap-2">
                    <x-datepicker />
                </div>
        
            </div>
        </div>
    
    
        <div class="bg-white p-8 rounded-lg shadow m-4">
          <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="vehicle_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria :</label>
                    <select name="customertype_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Selecionar</option>
                            @foreach ($customertype as $type)    
                            <option value="{{$type->id}}">{{$type->name}} </option>
                            @endforeach
                    </select>
                </div>
                

                 <!-- Primer input -->
                 <div class="mb-5">
                    <label for="rut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RUT :</label>
                    <input type="text" name="rut" id="rut" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>
                
                <!-- Repite los divs como este para los 14 inputs -->
                <div class="mb-5">
                    <label for="input2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres :</label>
                    <input name="name" type="text" id="input2" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>

                 <!-- Repite los divs como este para los 14 inputs -->
                 <div class="mb-5">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono :</label>
                    <input name="phone" type="text" id="phone" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>

                 

               <div class="sm:flex gap-6 items-center">
                        <!-- Primer input -->
                    <div class="mb-5">
                        <label for="input1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección :</label>
                        <input name="address" type="text" id="input1" class="sm:w-[580px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    
                


                    <!-- Input tipo file -->
                    <div class="mb-5">
                        <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo de Cliente :</label>
                        <input name="image" type="file" id="file" class=" sm:w-[580px] text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                    </div>
               </div>

                <!-- Botones -->
                <div class="sm:col-span-2 lg:col-span-4 flex justify-center">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mx-2">Registrar</button>
                    <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-400 dark:hover:bg-red-500 dark:focus:ring-red-600 mx-2">
                        <a href="{{route('customers.index')}}">Regresar</a>
                     </button>
                </div>

                
            </form>
        </div>
    
</x-app-layout>