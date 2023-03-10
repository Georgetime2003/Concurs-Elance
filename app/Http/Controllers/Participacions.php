<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participacions as ParticipacionsModel;
use App\Models\Participants as ParticipantsModel;
use App\Models\Categoria as CategoriaModel;
use App\Models\Grups as GrupsModel;

class participacions extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);
        $csv = array();
        $duetprepro = false;
        $timestamp = time();
        foreach ($rows as $row) {
            $csv[] = array_combine($header, $row);
        }
        foreach ($csv as $row) {
            try {

                //Separem les categories pels guions i comprovem la seva longitud
                $categoria = explode("-", $row['Categoría/Opción']);
                //Comprovem que el format de categoria és correcte, sino ho és, passem a la següent iteració
                if (count($categoria) != 4) {
                    //Aquesta condició és per si hi han duets de preprofessional
                    if (count($categoria) == 3) {
                        $categoria[3] = "Categoria 0";
                    } else {
                        continue;
                    }
                }
                //Formatem les categories
                $categoria[0] = trim($categoria[0]);
                $categoria[1] = trim($categoria[1]);
                $categoria[2] = trim($categoria[2]);
                $categoria[3] = trim($categoria[3]);
                $categoria[0] = strtolower($categoria[0]);
                $categoria[0] = ucfirst($categoria[0]);
                $categoria[1] = strtolower($categoria[1]);
                $categoria[1] = ucfirst($categoria[1]);
                $categoria[2] = strtolower($categoria[2]);
                $categoria[2] = ucfirst($categoria[2]);
                $categoria[3] = strtolower($categoria[3]);
                $categoria[3] = ucfirst($categoria[3]);
                //Obtenim el valor numeric del string $categoria[3]
                $categoria[3] = preg_replace('/[^0-9]/', '', $categoria[3]);
                $categoria[3] = "C" . $categoria[3];

                //Formatem Nombre i Apellidos
                $row['Nombre'] = trim($row['Nombre']);
                $row['Nombre'] = strtolower($row['Nombre']);
                $row['Nombre'] = ucwords($row['Nombre']);

                $row['Apellidos'] = trim($row['Apellidos']);
                $row['Apellidos'] = strtolower($row['Apellidos']);
                $row['Apellidos'] = ucwords($row['Apellidos']);

                //Realitzem correccions de categories perquè coincideixin amb la base de dades
                if ($categoria[0] == "Amater") {
                    $categoria[0] = "Amateur";
                }
                if ($categoria[1] == "Individual") {
                    $categoria[1] = "Solo";
                }
                if ($categoria[0] == "Pre professional") {
                    $categoria[0] = "Pre-Professional";
                }
                if ($categoria[2] == "Contempo") {
                    $categoria[2] = "Contemporani";
                }
                if ($categoria[1] == "Duo/trio") {
                    $categoria[1] = "Duos/Trios";
                }

                //Cerquem si el participant existeix a la base de dades, sinó existeix, el creem
                $participant = ParticipantsModel::where('nom', $row['Nombre'])->where('cognoms', $row['Apellidos'])->first();
                if (!$participant) {
                    $participant = ParticipantsModel::create([
                        'nom' => $row['Nombre'],
                        'cognoms' => $row['Apellidos'],
                        'edat' => $row['Edad en fecha evento'],
                    ]);
                    $participant = ParticipantsModel::where('nom', $row['Nombre'])->where('cognoms', $row['Apellidos'])->first();
                }

                //Cerquem si el grup de participants existeix a la base de dades, sinó existeix, el creem
                $grupId = GrupsModel::where('nomgrup', $row['Grupo'])->first();
                if (!$grupId) {
                    GrupsModel::create([
                        'nomgrup' => $row['Grupo'],
                        'descripcio' => $row['Grupo'],
                    ]);
                    $grupId = GrupsModel::where('nomgrup', $row['Grupo'])->first();
                }

                //Cerquem si la categoria existeix a la base de dades, sinó existeix, fem un throw exception
                $categoriaId = CategoriaModel::where('categoria', $categoria[0])->where('modalitat', $categoria[1])->where('estils', $categoria[2])->where('subcategoria', $duetprepro == true ? "C0" : $categoria[3])->first();

                if (!$categoriaId) {
                    throw new \Exception("Categoria no trobada: " . $categoria[0] . " - " . $categoria[1] . " - " . $categoria[2] . " - " . $categoria[3]);
                }

                //Afegim la participació a la base de dades
                ParticipacionsModel::create([
                    'participant_id' => $participant->id,
                    'categoria_id' => $categoriaId->id,
                    'grup_id' => $grupId->id,
                ]);
            } catch (\Exception $e) {
                revertirCanvis($timestamp);
                return view('importacio')->with('error', $e->getMessage());
            }
        }
        return view('importacio')->with('success', 'Importació realitzada correctament');
    }
    public function indexparticipants(){
        $participants = ParticipantsModel::all();
        $categories = CategoriaModel::all();
        $grups = GrupsModel::all();
        return view('afegir', ['participants' => $participants], ['categories' => $categories], ['grups' => $grups]);
    }

    public function store(Request $request){
        
    }

    public function obtenirGrups(Request $request){
        //Obtenim els grups on la categoria coincideixi amb una participació
        $grups = GrupsModel::whereHas('participacions', function($query) use ($request){
            $query->where('categoria_id', $request->categoria_id);
        })->get();
        return response()->json($grups);    }
}

function revertirCanvis($timestamp) {
    $participacions = ParticipacionsModel::where('created_at', '>=', $timestamp)->get();
    foreach ($participacions as $participacio) {
        $participacio->delete();
    }
    $participants = ParticipantsModel::where('created_at', '>=', $timestamp)->get();
    foreach ($participants as $participant) {
        $participant->delete();
    }
    $grups = GrupsModel::where('created_at', '>=', $timestamp)->get();
    foreach ($grups as $grup) {
        $grup->delete();
    }
}
