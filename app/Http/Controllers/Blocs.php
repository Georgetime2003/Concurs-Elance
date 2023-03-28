<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blocs as ModelBlocs;
use App\Models\Categoria as ModelCategoria;
use App\Models\Participacions as ModelParticipacions;
use App\Models\User as ModelJutges;
use App\Models\Blocs_Jutges as ModelBlocs_Jutges;
use Exception;

class Blocs extends Controller
{
    public function index()
    {
        $blocs = ModelBlocs::all();
        return response()->json($blocs, 200);
    }
    public function crearBloc(){
        $length = ModelBlocs::all()->count();
        $blocs = new ModelBlocs();
        $blocs->id = $length + 1;
        $blocs->categoria_id = null;
        $blocs->save();
        $blocs = ModelBlocs::all();
        return response()->json($blocs, 200);
    }

    public function mostrarBloc(Request $request){
        try{
        $bloc = ModelBlocs::find($request->id);
        $categoria = ModelCategoria::find($bloc->categoria_id);
        $jutges = ModelJutges::find($bloc->jurats);
        $bloc->categoria = $categoria;
        $bloc->jutges = $jutges;
        return response()->json($bloc, 200);
        }catch(Exception $e){
            return response()->json($$bloc, 500);
        }
    }

    public function obtenirBlocsActius(Request $request){
        $idJutge = $request->id;
        $blocs = ModelBlocs::all();
        $blocsActius = [];
        foreach($blocs as $bloc){
            $blocJutge = ModelBlocs_Jutges::where('bloc_id', $bloc->id)->where('jutge_id', $idJutge)->where('actiu', 1)->first();
            if($blocJutge != null){
                $blocsActius[] = $bloc;
            }
        }
    }
}
