<?php

namespace App\Http\Controllers;

use App\Models\Affichage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffichageController extends Controller
{
    //
    public function index(){
        $medecinId =Auth::id();

        //$affichages = Affichage::all();
        //$affichages = Affichage::paginate(5);
        $affichages = Affichage::whereHas('patient' , function($query) use ($medecinId){
            $query->where('medecin_id' , $medecinId);

        })->paginate(5);


        return view('affichage.index', compact('affichages'));
    }
    //
    public function view_affiche($patient_id)
{
    
    $affiche = Affichage::findOrFail($patient_id);
    //$affichage = Affichage::find($id); // Trouvez le patient par ID
    return view('affichage.show', compact('affiche')); // Passez le patient à la vue
}

}
