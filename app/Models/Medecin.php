<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Patient;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Medecin extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $guard = 'medecin';



    protected $fillable = [
        'nom',
        'email',
        'tel',
        'password',
        'specialite_id',
        
        
        
    ];

    public function specialites()
    {
        return $this->belongsTo(Specialites::class,'specialite_id');
    }
   
    public function patients():HasMany
{
    return $this->hasMany(Patient::class,'medecin_id');
}


public function user()
{
    // Retourner la relation entre le médecin et l'utilisateur
    return $this->belongsTo(User::class, 'email', 'email'); // Spécifiez le nom de la colonne pour la relation avec le modèle User
}

}

