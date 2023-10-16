<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blocs as ModelBlocs;
use App\Models\Categoria as ModelCategoria;
use App\Models\Participacions as ModelParticipacions;
use App\Models\User as ModelJutges;
use App\Models\Blocs_Jutges as ModelBlocs_Jutges;
use Dflydev\DotAccessData\Data;
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
        $blocs->nom = "Bloc " . ($length + 1);
        $blocs->categoria_id = null;
        $blocs->save();
        for ($i = 0; $i < 3; ++ $i){
            $bloc_jutges = new ModelBlocs_Jutges();
            $bloc_jutges->bloc_id = $blocs->id;
            $bloc_jutges->posicio = $i;
            $bloc_jutges->jutge_id = null;
            $bloc_jutges->save();
        }
        $blocs = ModelBlocs::all();
        return response()->json($blocs, 200);
    }

    public function mostrarBloc(Request $request){
        try{
        $bloc = ModelBlocs::find($request->id);
        $categoria = ModelCategoria::find($bloc->categoria_id);
        $jutges = ModelBlocs_Jutges::where('bloc_id', $bloc->id)->with('jutge')->get();
        $bloc->categoria = $categoria;
        $bloc->jutges = $jutges;
        return response()->json($bloc, 200);
        }catch(Exception $e){
            return response()->json($$bloc, 500);
        }
    }

    public function obtenirBlocsActius(Request $request){
        $idJutge = $request->id;
        $blocs = ModelBlocs::where('actiu', '1')->with('categoria')->get();
        $blocsActius = [];
        foreach($blocs as $bloc){
            $blocJutge = ModelBlocs_Jutges::where('bloc_id', $bloc->id)->where('jutge_id', $idJutge);
            $pases = ModelParticipacions::where('categoria_id', $bloc->categoria_id)->get();
            $bloc->pases = $pases;
            $bloc->jutge = $blocJutge;
            if($blocJutge != null){
                $blocsActius[] = $bloc;
            }
        }
        return response()->json($blocsActius, 200);
    }

    public function esborrarBloc(Request $request){
        $id = $request->id;
        $bloc = ModelBlocs::find($id);
        $blocJutges = ModelBlocs_Jutges::where('bloc_id', $id)->get();
        foreach($blocJutges as $blocJutge){
            $blocJutge->delete();
        }
        $bloc->delete();
        $blocs = ModelBlocs::all();
        return response()->json($blocs, 200);
    }

    public function updateCategoriaBloc(Request $request){
        $bloc = ModelBlocs::find($request->id);
        $bloc->categoria_id = Blocs::obtenirCategoriaID($request);
        $bloc->save();
        return response()->json($bloc, 200);
    }

    public function obtenirCategoriaID($request){
        $categoria = $request->categoria;
        $modalitat = $request->modalitat;
        $estils = $request->estils;
        $subcategoria = $request->subcategoria;

        if ($categoria == 1){
            $categoria = "Amateur";
        } else if ($categoria == 2){
            $categoria = "Pre-Professional";
        } else {
            throw new \Exception("Categoria no trobada");
        }

        if ($modalitat == 1){
            $modalitat = "Solo";
        } else if ($modalitat == 2){
            if ($categoria == "Amateur"){
                $modalitat = "Duos/Trios";
            } else {
                $modalitat = "Duet";
            }
        } else if ($modalitat == 3){
            if ($categoria == "Amateur"){
                $modalitat = "Grupal";
            } else {
                throw new \Exception("Modalitat no trobada");
            }
        } else {
            throw new \Exception("Modalitat no trobada");
        }

        if ($estils == 1) {
            $estils = "Clàssic";
        } else if ($estils == 2) {
            $estils = "Contemporani";
        } else if ($estils == 3) {
            if ($categoria == "Amateur"){
                $estils = "Fusió";
            } else {
                $estils = "Dues Variacions";
            }
        } else if ($estils == 4) {
            if ($categoria == "Amateur"){
                $estils = "Jazz";
            } else {
                throw new \Exception("Estil no trobat");
            }
        }

        $nSubcategoria = (intval($subcategoria));
        $nSubcategoria--;
        $subcategoria = "C" . $nSubcategoria;

        $idCategoria = ModelCategoria::where('categoria', $categoria)->where('modalitat', $modalitat)->where('estils', $estils)->where('subcategoria', $subcategoria)->first()->id;

        return $idCategoria;
    }

    public function activarBloc(Request $request){
        $bloc = ModelBlocs::find($request->id);
        $bloc->actiu = 1;
        $bloc->save();
        $response = [
            "success" => true,
            "data" => "S'ha habilitat el bloc"
        ];
        return response()->json($response, 200);
    }
    
    public function desactivarBloc(Request $request){
        $bloc = ModelBlocs::find($request->id);
        $bloc->actiu = 0;
        $bloc->save();
        $response = [
            "success" => true,
            "data" => "S'ha deshabilitat el bloc"
        ];
        return response()->json($response, 200);
    }

    public function actualitzarBlocCategoria(Request $request){
        $bloc = ModelBlocs::find($request->id);
        switch($request->categoria){
            case 1:
                $categoria = "Amateur";
                break;
            case 2:
                $categoria = "Pre-Professional";
                break;
            default:
                $categoria = null;
                break;
        } switch($request->modalitat){
            case 1:
                $modalitat = "Solo";
                break;
            case 2:
                if ($categoria == "Amateur"){
                    $modalitat = "Duos/Trios";
                } else {
                    $modalitat = "Duet";
                }
                break;
            case 3:
                if ($categoria == "Amateur"){
                    $modalitat = "Grupal";
                } else {
                    $modalitat = null;
                }
                break;
            default:
                $modalitat = null;
                break;
        } switch($request->estils){
            case 1:
                $estils = "Clàssic";
                break;
            case 2:
                $estils = "Contemporani";
                break;
            case 3:
                if ($categoria == "Amateur"){
                    $estils = "Fusió";
                } else {
                    $estils = "Dues Variacions";
                }
                break;
            case 4:
                if ($categoria == "Amateur"){
                    $estils = "Jazz";
                } else {
                    $estils = null;
                }
                break;
            default:
                $estils = null;
                break;
        }
        $subcategoria = "C" . ($request->subcategoria - 1); 
        $categoria_id = ModelCategoria::where('categoria', $categoria)->where('modalitat', $modalitat)->where('estils', $estils)->where('subcategoria', $subcategoria)->first()->id;
        if ($categoria_id == null){
            $response = [
                "success" => false,
                "data" => "No s'ha trobat la categoria"
            ];
            return response()->json($response, 500);
        }
        $bloc->categoria_id = $categoria_id;
        $bloc->save();
        $response = [
            "success" => true,
            "data" => "S'ha actualitzat la categoria del bloc"
        ];
        return response()->json($response, 200);
    }

    public function assignarJutge(Request $request){
            $bloc = ModelBlocs::find($request->id);
            $blocJutge = ModelBlocs_Jutges::where('bloc_id', $bloc->id)->where('posicio', $request->pos)->first();
            $blocJutge->jutge_id = $request->jutge_id != 0 ? $request->jutge_id : null;
            $blocJutge->save();
            $response = [
                "success" => true,
                "data" => "Jutge ". $request->jutge_id - 1 ." assignat al " . $bloc->nom
            ];
            return response()->json($response, 200);
    }
}
