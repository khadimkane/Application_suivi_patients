<?php

namespace App\Http\Controllers;

 use App\Models\Medecin;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Specialites;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ConnexionController extends Controller
{


  
  public function liste_patient($medecinId){
    // Utiliser le guard 'medecin'
    $medecin = Auth::guard('medecin')->user();

    // Vérifiez si l'utilisateur est authentifié
    if (!$medecin) {
        Log::debug('Utilisateur non authentifié');
        return redirect('/create')->withErrors(['error' => 'Erreur d\'authentification. Utilisateur non authentifié.']);
    }

    // Récupère tous les patients associés à ce médecin
    $medecin = Medecin::findOrFail($medecinId);
    $patients = $medecin->patients()->paginate(5);
   

    return view('patients.liste_patient', compact('patients'));
}

public function liste_medecin(){
  $medecins = Medecin::paginate(5);
  return view('medecins.liste_medecin',compact('medecins'));
  
}

public function Ajouter_Specialite(){

  return view ('Specialites.Ajouter_Specialite');
}

public function Liste_Specialite(){
  $specialites= Specialites::paginate(4);
  return view ('Specialites.Liste_Specialite',compact('specialites'));
}

public function ajouter_traitement(Request $request){
  $request->validate([
      'nom' => 'required',
      'prenom' => 'required',
      'date_nais' => 'required',
      'sexe' => 'required',
      'email' => 'required|email',
      'telephone' => 'required|string|regex:/^\+221\d{9}$/',
      'adresse' => 'required',
  ]);

  // Utiliser le guard 'medecin'
  $medecin = Auth::guard('medecin')->user();

  // Vérifiez si l'utilisateur est authentifié
  if (!$medecin) {
      Log::debug('Utilisateur non authentifié');
      return redirect('/create')->withErrors(['error' => 'Erreur d\'authentification. Utilisateur non authentifié.']);
  }

  // Vérifiez si l'utilisateur est une instance de Medecin
  if (!$medecin instanceof Medecin) {
      Log::debug('Utilisateur authentifié n\'est pas un médecin', ['user' => $medecin]);
      return redirect('/create')->withErrors(['error' => 'Erreur d\'authentification. Utilisateur authentifié n\'est pas un médecin.']);
  }

  // Créer un nouveau patient et assigner l'ID du médecin
  $patient = new Patient();
  $patient->nom = $request->nom;
  $patient->prenom = $request->prenom;
  $patient->date_nais = $request->date_nais;
  $patient->sexe = $request->sexe;
  $patient->email = $request->email;
  $patient->telephone = $request->telephone;
  $patient->adresse = $request->adresse;
  $patient->medecin_id = $medecin->id; // Assigner l'ID du médecin
  $patient->save();

  return redirect('/create')->with('status', 'Le patient a bien été ajouté avec succès');
}

  public function ajouter_medecin_traitement(Request $request){
    $request->validate([
        'nom' => 'required',
        'email' => 'required|email',
        'tel' => 'required|string|regex:/^\+221\d{9}$/',
        'password' => 'required',
        'specialite_id' => 'required|Integer',
    
        
    ]);

    $medecin = new Medecin();
    $medecin->nom = $request->nom;
    $medecin->email = $request->email;
    $medecin->tel = $request->tel;
    $medecin->password = bcrypt($request->input('password'));
    $medecin->specialite_id = $request->specialite_id;
    $medecin->save();

    return redirect()->route('create-medecin')->with('status', 'Le médecin a bien été ajouté avec succès');
}

    

  
public function update_patient($id){
  $patients= Patient::find($id);

  return view('patients.update', compact('patients'));
}

public function update_traitement(Request $request){
  $request->validate([
    'nom' => 'required' ,
   'prenom' => 'required' ,
   'date_nais' => 'required' ,
    'sexe' => 'required' ,
    'email' => 'required | email' ,
    'telephone' => 'required' ,
    'adresse' => 'required' ,
    

]);

$patient =  Patient::find($request->id);
$patient->nom = $request->nom;
$patient->prenom = $request->prenom;
$patient->date_nais = $request->date_nais;
$patient->sexe= $request->sexe;
$patient->email = $request->email;
$patient->telephone = $request->telephone;
$patient->adresse = $request->adresse;
$patient->update();

return redirect('/liste')->with('status', 'Le patient a bien ete modifié avec success');
 




}
public function delete_patient($id){
  $patient = Patient::find($id);
  $patient->delete();
  return redirect('/liste')->with('status', 'Le patient a bien ete supprimé  avec success');
  }



  public function store_Specialite(Request $request){
    $request->validate([
      'libelle' => 'required'


    ]);

    $specialite= new Specialites();
    $specialite->libelle = $request->libelle;
    $specialite->save();
    return redirect()->route('Ajouter-Specialite')->with('status', 'La spécialité a bien été ajouté avec succés');


  }


// voir la liste des patients
  public function show($id)
  {
      $patient = Patient::findOrFail($id);
      return view('show-patient', compact('patient'));
  }

  // delete specialite
  public function delete_specialite($id){
      $specialite = Specialites::find($id);
      $specialite->delete();
      return redirect('/Liste-Specialite')->with('success', 'La spécialité a bien été supprimé avec succés');
  }

  //update specialite
  public function update_specialite($id){
    $specialites = Specialites::find($id);

    return view('specialites.update', compact('specialites'));
}


  public function update_traitement_specialite(Request $request){
    $request->validate([
        'libelle' => 'required',
        'id' => 'required|exists:specialites,id', // Assurez-vous que l'id fourni  existe dans la base de données
    ]);

    $specialite = Specialites::find($request->id);
    $specialite->libelle = $request->libelle;
    $specialite->save(); // Enregistrez l'instance mise à jour

    return redirect()->route('Ajouter-Specialite')->with('status', 'La spécialité a bien été modifiée avec succès');
}


//delete medecin
public function delete_medecin($id){
  $medecin = Medecin::find($id);
  $medecin->delete();
  return redirect('/liste-medecin')->with('status', 'Le medecin a bien ete supprimé  avec success');
  }


  //view medecins
  public function show_medecin($id){
    $medecin = Medecin::findOrFail($id);
    return view('show-medecin', compact('medecin'));

  }

 
//update medecin

public function update_medecin($id){
  $medecins = Medecin::find($id);
  $specialites = Specialites::all(); 
  return view('medecins.update', compact('medecins', 'specialites'));
}
//traitement modif medecin
public function update_traitement_medecin(Request $request){
  $request->validate([
      'nom' => 'required',
      'email' => 'required|email',
      'tel' => 'required|string|regex:/^\+221\d{9}$/',
      // 'password' => 'required',
      'specialite_id' => 'required|Integer',
  ]);

  $medecin = Medecin::find($request->id);
  $medecin->nom = $request->nom;
  $medecin->email = $request->email;
  $medecin->tel = $request->tel;
 // $medecin->password = bcrypt($request->input('password'));
  $medecin->specialite_id = $request->specialite_id;
  $medecin->save();

  return redirect()->route('update-medecin', ['id' => $medecin->id])->with('status', 'Le médecin a bien été modifié avec succès');
}


//affiche le form password oublié

public function Forgot_Medecin(){

  return view('reintialiser_password_medecin');
}

//traitement forgot password

public function sendResetLink(Request $request)
{
    $request->validate([
        'medecinEmail' => 'required|email|exists:medecins,email',
    ]);

    $token = Str::random(60);

    DB::table('password_resets')->insert([
        'email' => $request->medecinEmail,
        'token' => $token,
        'created_at' => Carbon::now(),
    ]);

    Mail::send('mail_reinitialisation', ['token' => $token], function ($message) use ($request) {
        $message->to($request->medecinEmail);
        $message->subject('Réinitialisation de mot de passe');
        $message->from('akassistm@gmail.com', 'ADMIN');
    });

    return back()->with('message', 'Un lien de réinitialisation a été envoyé à votre adresse email.');
}

public function showResetForm($token)
{
    return view('reset-password-medecin', ['token' => $token]);
}


public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:medecins,email',
        'password' => 'required|string|min:8|confirmed',
        'token' => 'required'
    ]);

    $updatePassword = DB::table('password_resets')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])
        ->first();

    if (!$updatePassword) {
        return back()->withInput()->with('error', 'Invalid token!');
    }

    $medecin = Medecin::where('email', $request->email)->first();
    $medecin->password = Hash::make($request->password);
    $medecin->save();

    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    return redirect('/')->with('message', 'Votre mot de passe a été changé avec succès!');
}


}



