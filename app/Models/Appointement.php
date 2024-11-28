<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointement extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
        'time',
        'patient_id',
        'medecin_id',
        
        
        
    ];
    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        $appointmentDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->date . ' ' . $this->time);
        return $appointmentDateTime < Carbon::now() ? 'Passé' : 'En attente';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    

    // public function medecins()
    // {
    //     return $this->belongsTo(Medecin::class,'medecin_id');
    // }

    
}
