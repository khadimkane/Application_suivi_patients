<?php

use App\Models\Appointement;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SmsController;

use App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\LoginController;
use App\Http\Controllers\AffichageController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\AppointementController;

 Route::get('/', function () {
   return view('welcome');
 });
   
 Route::post('/login', [AuthController::class,'login'])->name('submit_login');

Route::get('/dashboard',[UserController::class,'home'])->name('dashboard');
Route::get('/dashboard-admin',[UserController::class,'home_admin'])->name('dashboard-admin');
//Route::post('/dashboard',[UserController::class,'connexion'])->name('submit_login');
//Route::get('/appointement',[UserController::class,'index'])->name('rv');
Route::get('/Ajouter-RV',[AppointementController::class,'store'])->name('Rv_Ajouter');
Route::get('/Ajouter-Specialite',[ConnexionController::class,'Ajouter_Specialite'])->name('Ajouter-Specialite');
Route::post('/Ajouter-Specialite',[ConnexionController::class,'store_Specialite'])->name('specialite');
Route::get('/Liste-Specialite',[ConnexionController::class,'Liste_Specialite'])->name('Liste-Specialite');
//Route::post('/traitement',[AppointementController::class,'store'])->name('traitement');
///Route::post('/dashboard',[AuthController::class,'login_traitement'])->name('submit_login');

//Route::get('/connexion', [ConnexionController::class,'formulaire'])->name('login');
//Route::post('/connexion/traitement', [ConnexionController::class,'traitement'])->name('submit_login');
 Route::get('/create', [UserController::class,'form_patient'])->name('create');
Route::get('/create-medecin', [UserController::class,'form_medecin'])->name('create-medecin');
Route::get('/liste-medecin', [ConnexionController::class,'liste_medecin'])->name('liste-medecin');
//  Route::post('/ajouter/traitement', [ConnexionController::class,'ajouter_traitement']);
 Route::post('/ajouter/medecin', [ConnexionController::class,'ajouter_medecin_traitement']);
//   Route::prefix('liste')->group(function(){
//      Route::get('', [ConnexionController::class,'liste_patient'])->name('liste');

//  });

Route::get('/update-patient/{id}',[ConnexionController::class,'update_patient']);
Route::get('/delete-patient/{id}',[ConnexionController::class,'delete_patient']);
Route::post('/update/traitement', [ConnexionController::class,'update_traitement']);

// routes/web.php
Route::get('/get-patient/{id}', [AppointementController::class, 'getPatient']);


Route::get('/get-medecins-by-specialite/{specialiteId}', [AppointementController::class,'getMedecinsBySpecialite']);
// Route::post('/appointements', [AppointementController::class, 'validation'])->name('appointements.store');
// Route::get('/appointements', [AppointementController::class, 'index'])->name('appointements.index');
Route::get('/delete-appointement/{id}',[AppointementController::class,'delete_appointement']);
Route::get('/update-appointement/{id}',[AppointementController::class,'update_appointement'])->name('update-appointement');;
Route::post('/update-appointement/{id}/traitement', [AppointementController::class,'update_appointement_traitement'])->name('update-appointement.traitement');

Route::get('/send-sms/{appointement}', [SmsController::class, 'showForm'])->name('send-sms-form');

Route::post('/send-sms',[SmsController::class,'sendSms'])->name('sendSms');

//Route::prefix('affichage')->group(function(){

 
    //Route::get('/affichage' , [AffichageController::class, 'index'])->name('affichage');


//});

//  Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');



Route::get('/change-password', [UserController::class, 'ChangePassword'])->name('change-password');
Route::post('/update-password', [UserController::class, 'update_password'])->name('update_password');

// Middleware avec les routes acces 

//  Route::group(['middleware' => ['auth', 'medecin']], function () {
//      Route::get('/create', [UserController::class,'form_patient'])->name('create');
//      Route::post('/ajouter/traitement', [ConnexionController::class,'ajouter_traitement']);
//      Route::prefix('liste')->group(function(){
//          Route::get('', [ConnexionController::class,'liste_patient'])->name('liste');
    
//     });
//     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [AuthController::class,'login'])->name('submit_login');
//     Route::get('/', function () {
//         return view('welcome');
//     });
//  });

// Route::get('/dashboard', function () {
//     // Cette route ne peut être accédée que par des médecins authentifiés
// })->middleware('auth', 'medecin');

Route::middleware(['auth:medecin'])->group(function () {
  Route::post('/ajouter/traitement', [ConnexionController::class,'ajouter_traitement']);
  Route::prefix('liste')->group(function(){
    Route::get('/liste/{medecinId}', [ConnexionController::class,'liste_patient'])->name('liste');

});
Route::post('/appointements', [AppointementController::class, 'validation'])->name('appointements.store');
Route::get('/appointements', [AppointementController::class, 'index'])->name('appointements.index');

//affichage en temps reel
Route::prefix('affichage')->group(function(){

 
  Route::get('/' , [AffichageController::class, 'index'])->name('affichage');
  Route::get('/view_affiche/{patient_id}', [AffichageController::class, 'view_affiche'])->name('affiche.show');;
  



});
//historique des patient
Route::prefix('historique')->group(function(){


  Route::get('/' , [HistoriqueController::class, 'index'])->name('historique');

});
});




//view patient
Route::get('/patients/{id}', [ConnexionController::class, 'show'])->name('patients.show');
//delete specialite
Route::get('/delete-specialite/{id}',[ConnexionController::class,'delete_specialite']);
//update specialite 
Route::get('/update-specialite/{id}', [ConnexionController::class, 'update_specialite'])->name('update-specialite');
Route::post('/update/traitement/specialite', [ConnexionController::class, 'update_traitement_specialite'])->name('update-traitement-specialite');
//delete medecin
Route::get('/delete-medecin/{id}',[ConnexionController::class,'delete_medecin']);

//view medecin
Route::get('/medecins/{id}', [ConnexionController::class, 'show_medecin'])->name('medecins.show');

//update medecin
Route::get('/update-medecin/{id}', [ConnexionController::class, 'update_medecin'])->name('update-medecin');
Route::post('/update/traitement/medecin', [ConnexionController::class, 'update_traitement_medecin'])->name('update-traitement-medecin');



//reset_password_medecin

Route::get('/reset-password-medecin',[ConnexionController::class,'Forgot_Medecin'])->name('reset-password-medecin');

Route::post('send-reset-link', [ConnexionController::class, 'sendResetLink'])->name('send-reset-link');
Route::get('reset-password/{token}', [ConnexionController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ConnexionController::class, 'resetPassword'])->name('password.update');


