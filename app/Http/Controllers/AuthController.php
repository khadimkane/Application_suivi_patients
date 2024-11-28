<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  

    public function login(Request $request)
{
    // Validation des champs de la requête
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'type' => 'required|in:Admin,Medecin', // Assurez-vous que le type est Admin ou Medecin
    ]);

    $type = $credentials['type'];

    if ($type === 'Admin') {
        // Authentifiez l'utilisateur en utilisant la table users
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Si l'authentification réussit et que le type est Admin, redirigez vers le tableau de bord Admin
            return redirect()->intended('dashboard-admin');
        }
    } elseif ($type === 'Medecin') {
        // Authentifiez l'utilisateur en utilisant la table medecins
        if (Auth::guard('medecin')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Si l'authentification réussit et que le type est Medecin, redirigez vers le tableau de bord Medecin
            return redirect()->intended('dashboard');
        }
    }

    // Si l'authentification échoue ou si le type est incorrect, retournez avec une erreur
    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        return back()->withErrors([
            'type' => 'Le type que vous avez choisi ne correspond pas aux informations. Veuillez choisir le bon  type.'
        ]);
    } else {
        return back()->withErrors([
            'email' => 'Mot de passe ou Email non reconnu'
        ]);
    }
}




}