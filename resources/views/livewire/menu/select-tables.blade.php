<div>
  
    <div class="mt-5 mb-5 max-w-2xl mx-auto p-6 rounded-lg shadow-md bg-white dark:bg-slate-600 dark:shadow-slate-750">
        <h2 class="text-xl font-bold mb-4 text-gray-950 dark:text-white">Selecciona una Mesa</h2>
    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($tables as $table)
                <div 
                    wire:click="selectTable({{ $table->id }})" 
                    class="p-4 border rounded-lg text-center cursor-pointer shadow-md 
                        @if($table->status == 1) bg-green-300 border dark:border-slate-600 @elseif($table->status == 2) bg-red-300 border dark:border-slate-600 @elseif($table->status == 3) bg-orange-300 border dark:border-slate-600 @endif
                        @if($table->status != 1) opacity-70 cursor-not-allowed @endif"
                    @if($table->status != 1) disabled @endif>
                    <h3 class="text-lg font-semibold contain-content uppercase text-gray-900">{{ $table->name }}</h3>
                    <p class="font-light text-gray-900">
                        @if($table->status == 1)
                            Disponible
                        @elseif($table->status == 2) 
                            Ocupada
                        @elseif($table->status == 3) 
                            Reservada
                        @endif
                    </p>
                    <p class="font-light text-gray-900">N° de Sillas: {{ $table->chairs }}</p>
                </div>
            @endforeach
        </div>
    </div>
    
    
</div>

