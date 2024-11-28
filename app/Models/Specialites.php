<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialites extends Model
{
    use HasFactory;


    protected $fillable = [
        'libelle'
       
    ];

    public function medecins()
    {
        return $this->belongsTo(Medecin::class);
    }
}

