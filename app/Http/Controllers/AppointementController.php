<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointement;
use App\Models\Medecin;
use App\Models\Specialites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Auth;

class AppointementController extends Controller
{
    public $patientCode;
    public $currentPatient ;
    public $specialites;
    public $date;
   // public $speciality_id;
    //public $medecin_id;

   // public $selectedSpecialites='';
    public $medecinList;
    public $patientList;



    public function getPatient($id) {
      $patient = Patient::find($id);
      if ($patient) {
          return response()->json([
              'success' => true, 
              'prenom' => $patient->prenom,
              'nom' => $patient->nom
          ]);
      } else {
          return response()->json([
              'success' => false, 
              'message' => 'Patient non trouvé'
          ]);
      }
  }

  //methode pour recuperer les medecins associes a une specialite

  public function getMedecinsBySpecialite($specialiteId) {
      $medecins = Medecin::where('specialite_id', $specialiteId)->get();
  
      // Log pour le débogage
      foreach ($medecins as $medecin) {
          Log::info('ID: ' . $medecin->id . ', Nom: ' . $medecin->nom);
      }
  
      return response()->json($medecins);
  }
  
    public function store(){
      
   
        //$this->currentPatient = 'Not Found';
      // if($this->patientCode!=''  ){

      //   $query = Patient::where('id', $this->patientCode)->get();
      //    if(count($query) >= 1){
      //       foreach($query as $q){
            
      //            $this->currentPatient = $q->prenom;
      //      }
      //    } else{
      //      $this->currentPatient = 'Not Found 4';
      //   }
      // }

      $selectedSpecialites = '';
    

       $this->specialites = Specialites::all();

      // dd($this->specialites);
     //  $selectedSpecialites = '';
      //$this->patientList = Patient::all();
      // $this->medecinList = Medecin::all();

    
          return view('Rendez_Vous.AjouterRV', [
            'specialites' => $this->specialites,
            //'selectedSpecialites' => $this->selectedSpecialites,
            'selectedSpecialites' => $selectedSpecialites,
            'currentPatient' => 'Non trouvé'

          ]);
       
    }
    public function index(){
        // Obtenir le médecin authentifié
        $medecin = Auth::guard('medecin')->user();
        
        // Vérifier si l'utilisateur est authentifié en tant que médecin
        if (!$medecin) {
            Log::debug('Utilisateur non authentifié');
            return redirect('/create')->withErrors(['error' => 'Erreur d\'authentification. Utilisateur non authentifié.']);
        }
    
        // Récupérer tous les rendez-vous associés à ce médecin
        $appointements = Appointement::with('patient')
            ->where('medecin_id', $medecin->id)
            ->orderBy('date', 'asc')
            ->paginate(6);
    
        return view('Rendez_Vous.ListeRV', [
            'appointements' => $appointements ]);
    }
    
    // public function index(){
    //     $appointements=Appointement::all();
    //     return view('Rendez_Vous.ListeRV', compact('appointements'));
    // }
    public function validation(Request $request)
    {
        $request->validate([
            'patientCode' => 'required|integer|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);
    
        // Récupérer le patient
        $patient = Patient::find($request->patientCode);
    
        // Vérifier si le patient existe
        if (!$patient) {
            return redirect()->back()->with('error', 'Patient non trouvé');
        }
    
        // Obtenir le médecin authentifié
        $medecin = Auth::guard('medecin')->user();
    
        // Vérifier si l'utilisateur est authentifié en tant que médecin
        if (!$medecin) {
            Log::debug('Utilisateur non authentifié');
            return redirect('/create')->withErrors(['error' => 'Erreur d\'authentification. Utilisateur non authentifié.']);
        }
    
        // Vérifier que le patient est associé au médecin authentifié
        if ($patient->medecin_id !== $medecin->id) {
            return redirect('/create')->withErrors(['error' => 'Vous n\'êtes pas autorisé à ajouter des rendez-vous pour ce patient.']);
        }
    
        // Créer un nouveau rendez-vous
        $appointment = new Appointement();
        $appointment->patient_id = $patient->id;
        $appointment->medecin_id = $medecin->id;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->save();
    
        return redirect()->route('Rv_Ajouter')->with('status', 'Rendez-vous enregistré avec succès');
    
    

    // $appointement = new Appointement();
    // $appointement->patient_id = $patient->id;
    // $appointement->date = $request->date;
    // $appointement->time = $request->time;
    // // $appointement->medecin_id = $request->medecin;
    
    // $appointement->save();

    // return redirect()->route('Rv_Ajouter')->with('status', 'Rendez-vous enregistré avec succès');
   
    }

    public function delete_appointement($id){
        $appointement = Appointement::find($id);
        $appointement->delete();
        return redirect()->route('appointements.index')->with('status','Rendez-vous supprimé avec succès' );
        }
   
        public function update_appointement($id){
            $appointements = Appointement::find($id);
            if (!$appointements) {
                return redirect()->back()->with('status', 'Rendez-vous non trouvé');
            }
        
            return view('Rendez_Vous.update', compact('appointements'));
        }
        


        public function update_appointement_traitement(Request $request){
            $request->validate([
                'id' => 'required|integer|exists:appointements,id',
                'patientCode' => 'required|integer|exists:patients,id',
                'date' => 'required|date',
                'time' => 'required',
                'currentPatient' => 'required',
            ]);
              // Récupérer l'identifiant de l'appointement
              $id = $request->id;
            
            // Récupérer l'objet existant
            $appointement = Appointement::find($request->id);
            if (!$appointement) {
                return redirect()->back()->with('status', 'Rendez-vous non trouvé');
            }
            
            // Mettre à jour les propriétés de l'objet
            $appointement->patient_id = $request->patientCode; // Assuming the actual column is 'patient_id'
            $appointement->date = $request->date;
            $appointement->time = $request->time;
            
            // Vous pouvez ne pas avoir besoin de 'currentPatient' dans votre modèle Appointement
            // $appointement->currentPatient = $request->currentPatient; 
            
            // Sauvegarder les modifications
            $appointement->save();
            
            return redirect()->route('update-appointement', ['id' => $id])->with('status', 'Rendez-vous modifié avec succès');

        }
        
        
    

}







