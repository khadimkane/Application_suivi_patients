<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affichage extends Model
{
    use HasFactory;

    protected $fillable = [
    'patients_id',
    'nom',
    'prenom',
    'date',
    'heure',
    'valeur',
];
use HasFactory;
protected $table = 'affichages'; // Nom de la table
protected $primaryKey = 'patients_id'; // Colonne clé primaire
public $timestamps = false; 

public function patient(){
    return $this->belongsTo(Patient::class , 'patients_id');
}

    
}
