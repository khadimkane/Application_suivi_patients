<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Medecin;
use App\Models\Specialites;


class UserController extends Controller
{
    public $specialites;
  
    public function home(){
      
        return view('dashboard');

    }

    public function home_admin(){
      
        return view('dashboard-admin');

    }
  
    public function form_patient(){
        return view('patients.create');



    }
    public function form_medecin(){

        
    

        $this->specialites = Specialites::all();

        return view('medecins.create',[
            'specialites' => $this->specialites,
        ]);



    }
    public function ChangePassword(){
        return view('change-password');
    }

    public function update_password(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed', //assure que new_password_confirmation correspond à new_password
    ]);

   // dd($request->all());

    $medecin = Auth::guard('medecin')->user(); // Utilisation de l'authentification pour le modèle Medecin

    if (!Hash::check($request->current_password, $medecin->password)) {
        return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect']);
    }

    $medecin->password = Hash::make($request->new_password);
   // dd($medecin);
    $medecin->save(); // Utilisation de save() pour enregistrer les changements

    return redirect()->route('change-password')->with('status', 'mot de passe changé avec succés');
}


 
  


   

    
    

    



    

    
}
