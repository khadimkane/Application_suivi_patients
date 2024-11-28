<?php

namespace App\Models;

use App\Models\Medecin;
use App\Models\Affichage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'prenom',
        'date_nais',
        'sexe',
        'email',
        'telephone',
        'adresse',
        'medecin_id'
    ];

     // Ajoutez cette méthode pour formater le numéro de téléphone
     public function getFormattedPhoneNumberAttribute()
     {
         if (strpos($this->telephone, '+221') === 0) {
             return $this->telephone;
         }
 
         return '+221' . $this->telephone;
     }


    public function appointements()
    {
        return $this->belongsTo(Appointement::class);
    }

    public function medecin()
{
    return $this->belongsTo(Medecin::class,'medecin_id');
}
public function affichages()
{
    return $this->hasMany(Affichage::class);
}
}
