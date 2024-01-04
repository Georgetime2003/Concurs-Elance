<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blocs as ModelBlocs;
use App\Models\Categoria as ModelCategoria;
use App\Models\Participacions as ModelParticipacions;
use App\Models\User as ModelJutges;
use App\Models\Blocs_Jutges as ModelBlocs_Jutges;
use App\Models\Sistema_Puntuacio as ModelSistema_Puntuacio;
use App\Models\Grups as ModelGrups;
use App\Models\Participants as ModelParticipants;
use Illuminate\Support\Facades\Auth;
use Dflydev\DotAccessData\Data;
use Exception;

use function Laravel\Prompts\error;

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
        $blocs_jutge = ModelBlocs_Jutges::where('jutge_id',$idJutge)->get();
        if (!$blocs_jutge){
            return response("", 404);
        };
        foreach($blocs_jutge as $bloc_jutge){
            $pases = 0;
            $bloc = ModelBlocs::where('id', $bloc_jutge->bloc_id)->first();
            if ($bloc->actiu == 1){
                $participants = ModelParticipacions::where('categoria_id', $bloc->categoria_id)->orderBy('grup_id')->get();
                $grups = [];
                foreach($participants as $participant){
                    $grup = ModelGrups::where('id', $participant->grup_id)->first()->toArray();
                    if(!isset($grups[$grup['id']])){
                        if(isset($edat) && isset($nParticipants) && isset($idGrup)){
                            $grups[$idGrup]['edat'] = $edat / $nParticipants;
                        }
                        $edat = 0;
                        $nParticipants = 0;
                        $idGrup = $grup['id'];
                        $grups[$grup['id']] = $grup;
                        $grups[$grup['id']]['participants'] = [];
                        $pases++;
                    }
                    $grups[$grup['id']]['participants'][] = ModelParticipants::where('id', $participant->participant_id)->first()->toArray();
                    $edat = $edat + ModelParticipants::where('id', $participant->participant_id)->first()->edat;
                    $nParticipants++;
                }
                $bloc->grups = array_values($grups);
                $bloc->pases = $pases;
                $categoria = ModelCategoria::where('id', $bloc->categoria_id)->first();
                $bloc->categoria = $categoria;
                $sistemaPuntuacio1 = ModelSistema_Puntuacio::where('id', $categoria->sistema_puntuacio_id1)->first()->nom;
                $bloc->sistema_puntuacio1 = $sistemaPuntuacio1;
                $sistemaPuntuacio2 = ModelSistema_Puntuacio::where('id', $categoria->sistema_puntuacio_id2)->first()->nom;
                $bloc->sistema_puntuacio2 = $sistemaPuntuacio2;
                $sistemaPuntuacio3 = ModelSistema_Puntuacio::where('id', $categoria->sistema_puntuacio_id3)->first()->nom;
                $bloc->sistema_puntuacio3 = $sistemaPuntuacio3;
                $sistemaPuntuacio4 = ModelSistema_Puntuacio::where('id', $categoria->sistema_puntuacio_id4)->first()->nom;
                $bloc->sistema_puntuacio4 = $sistemaPuntuacio4;
                $sistemaPuntuacio5 = ModelSistema_Puntuacio::where('id', $categoria->sistema_puntuacio_id5)->first()->nom;
                $bloc->sistema_puntuacio5 = $sistemaPuntuacio5;
                $bloc->nJutge = ModelBlocs_Jutges::where('bloc_id', $bloc->id)->where('jutge_id', $idJutge)->first()->posicio + 1;
                $blocs[] = $bloc;
            }
        };
        return response()->json($blocs, 200);
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
        $participants = ModelParticipacions::all();
        $nPase = ModelGrups::orderBy('nPase', 'desc')->first()->nPase;
        if ($nPase == null){
            $nPase = 1;
        } else {
            $nPase++;
        }
        foreach($participants as $participant){
            $grup = ModelGrups::where('id', $participant->grup_id)->first();
            if ($grup->nPase == null){
                $grup->nPase = $nPase;
                $grup->save();
                $nPase++;
            }
        }
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

    public function enviarVotacio(Request $request){
        $bloc = ModelBlocs::find($request->idBloc)->first();
        $grup = ModelGrups::where('id', $request->idPase)->first();
        $blocJutge = ModelBlocs_Jutges::where('bloc_id', $bloc->id)->where('posicio', $request->nJutge)->where('jutge_id', Auth::user()->id)->first();
        if (!isset($blocJutge)){
            $response = [
                "error" => "forbidden",
                "bloc" => $bloc,
                "grup" => $grup,
                "blocJutge" => $blocJutge
            ];
            return response()->json($response, 403);
        }
        switch ($request->nJutge){
            case 0:
                $grup->puntuacio1_1 = $request->puntuacio1;
                $grup->puntuacio2_1 = $request->puntuacio2;
                $grup->puntuacio3_1 = $request->puntuacio3;
                $grup->puntuacio4_1 = $request->puntuacio4;
                $grup->puntuacio5_1 = $request->puntuacio5;
                break;
            case 1:
                $grup->puntuacio1_2 = $request->puntuacio1;
                $grup->puntuacio2_2 = $request->puntuacio2;
                $grup->puntuacio3_2 = $request->puntuacio3;
                $grup->puntuacio4_2 = $request->puntuacio4;
                $grup->puntuacio5_2 = $request->puntuacio5;
                break;
            case 2:
                $grup->puntuacio1_3 = $request->puntuacio1;
                $grup->puntuacio2_3 = $request->puntuacio2;
                $grup->puntuacio3_3 = $request->puntuacio3;
                $grup->puntuacio4_3 = $request->puntuacio4;
                $grup->puntuacio5_3 = $request->puntuacio5;
                break;
            default:
                return error(500, "No s'ha pogut enviar la votació, " . $request->nJutge);
        }
        if ($grup->puntuacio1_1 != null && $grup->puntuacio1_2 != null && $grup->puntuacio1_3 != null && $grup->puntuacio2_1 != null && $grup->puntuacio2_2 != null && $grup->puntuacio2_3 != null && $grup->puntuacio3_1 != null && $grup->puntuacio3_2 != null && $grup->puntuacio3_3 != null && $grup->puntuacio4_1 != null && $grup->puntuacio4_2 != null && $grup->puntuacio4_3 != null && $grup->puntuacio5_1 != null && $grup->puntuacio5_2 != null && $grup->puntuacio5_3 != null) {
            $puntuaciofinal1 = ($grup->puntuacio1_1 + $grup->puntuacio2_2 + $grup->puntuacio3_1 + $grup->puntuacio4_1 + $grup->puntuacio5_1) / 5;
            $puntuaciofinal2 = ($grup->puntuacio1_2 + $grup->puntuacio2_2 + $grup->puntuacio3_2 + $grup->puntuacio4_2 + $grup->puntuacio5_2) / 5;
            $puntuaciofinal3 = ($grup->puntuacio1_3 + $grup->puntuacio2_3 + $grup->puntuacio3_3 + $grup->puntuacio4_3 + $grup->puntuacio5_3) / 5;
            $grup->puntuaciofinal = ($puntuaciofinal1 + $puntuaciofinal2 + $puntuaciofinal3) / 3;
        }
        $grup->save();
        $response = [
            "success" => true,
            "data" => "Votació enviada",
            "grup" => $grup
        ];
        return response()->json($response, 200);
    }
}
