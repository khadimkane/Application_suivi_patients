<?php

namespace App\Http\Controllers;

use App\Models\Affichage;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    //
    public function index(){
        // Récupérer toutes les données triées par heure
        $data = Affichage::orderBy('heure', 'asc')->get();
    
        // Identifier le premier patient
        if ($data->isNotEmpty()) {
            $firstPatientId = $data->first()->patient_id;
    
            // Filtrer les données pour n'inclure que celles du premier patient
            $firstPatientData = $data->where('patient_id', $firstPatientId);
        } else {
            $firstPatientData = collect(); // Si aucune donnée, renvoyer une collection vide
        }
    
        // Passer les données du premier patient à la vue
        return view('historique.index', compact('firstPatientData'));
      //public function getData()
     // {
        //  $data = Affichage::orderBy('heure', 'asc')->get();
  
       //return response()->json($data);
       //return view('historique.index', compact('data'));
      // return view('historique.index' , ['data' => $this->data]);
         //}
  
      //}
}
}