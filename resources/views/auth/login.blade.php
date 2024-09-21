<x-authentication-layout>
    <h1 class=" text-center text-2xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Bienvenido de nuevo!') }}</h1>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif   
    <!-- Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />                
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />                
            </div>
        </div>
        <div class="items-center mt-6">
            {{-- @if (Route::has('password.request'))
                <div class="mr-1">
                    <a class="text-sm underline hover:no-underline" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tus credenciales?') }}
                    </a>
                </div>
            @endif        --}}     
            <x-button class="w-full">
                {{ __('Acceder') }}
            </x-button>            
        </div>
    </form>
    <x-validation-errors class="mt-4" />   
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        {{-- <div class="text-sm">
            {{ __('Si no cuentas con una cuenta, Ingresa y registrate') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
        </div> --}}
        <!-- Warning -->
        <div class="mt-1 text-center bg-green-100 rounded-md">
            <a href="https://maydev.tech" target="_blank"><p class="block text-md text-green-800">Sistema Desarrollado por la empresa: <br> Maydev Spa Servicios de Ingeniería</p>
            
            </a>
        </div>

    </div>
</x-authentication-layout>
