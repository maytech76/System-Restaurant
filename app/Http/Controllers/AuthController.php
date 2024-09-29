<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Si la validación falla, devuelve un error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
        ]);

        // Generar un token de acceso para el usuario
        $token = $user->createToken('API Token')->plainTextToken;

        // Devolver una respuesta con el usuario y su token
        return response()->json(['data' =>  $user, 'access_token' => $token, 'token_type' => 'Bearer' ]);
       

    }

    public function login(Request $request){

         //Verificamos que el email y password son escrito correctos
        if (!Auth::attempt($request->only('email', 'password'))) {

            // Si no existen o esta errados , devolvemos un error
            return response()->json(['message' => 'Acceso Invalido por Credenciales Erroneas'], 401);
        }

        //consultamos en DB usuario segun email, mostrar el primero encontrado
        $user = User::where('email', $request->email)->firstOrFail();

        // Generar el token
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([

            'message'=>  'Bienvenido '. $user->name,
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',

        ], 200);

    }
    
    public function logout(){
        
        // Verificar si hay un usuario autenticado
    if (auth()->check()) {
        // Eliminar todos los tokens del usuario autenticado
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Te desconectaste con éxito, todos los tokens generados fueron borrados'], 200);
    }

    return response()->json(['message' => 'No estás autenticado'], 401);
    }
}

    


