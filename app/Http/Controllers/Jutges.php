<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Jutges extends Controller
{
    public function crearJutges(Request $request)
    {
        try {
            if (User::where('jutge', '=', 1)->count() != 0) {
                User::destroy(User::where('jutge', '=', 1)->pluck('id'));
            } 
            $jutges = $request->input('nJutges');
                for ($i = 0; $i < $jutges; $i++) {
                    $user = new User();
                    $user->name = 'Jutge ' . ($i + 1);
                    $user->password = bcrypt('jutge' . ($i + 1));
                    $user->jutge = 1;
                    $user->save();
                }
                $jutges = User::where('jutge', '>', 0)->get();
                return view('crearJutges', ['jutges' => $jutges]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index(){
        $jutges = User::where('jutge', '>', 0)->get();
        if (count($jutges) == 0) {
            return view('crearJutges');
        } else {
            return view('crearJutges', ['jutges' => $jutges]);
        }
    }

    public function votacionsIndex(){
        return view('votacions');
    }
}
