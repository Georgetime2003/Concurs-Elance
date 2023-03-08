<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as Usuaris;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * *Aquesta Funció es crida quan es fa un post a la ruta /login, i comprova que les credencials siguin correctes. Llavors comprovara el seu rol i redirigira a la ruta corresponent.
     */
    public function login(Request $request){
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->jutge == 1){
                return redirect()->route('jutges');
            } else {
                return redirect()->route('inici');
            }
            return dd($user);
        }
        return redirect()->route('index')->with('error', 'El Usuari o contrasenya incorrectes');
    }
}
