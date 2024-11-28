<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('date_nais');
            $table->string('sexe');
            $table->string('email');
            $table->string('telephone');
            $table->string('adresse');
            $table->foreignId('medecin_id')->constrained('medecins')->onDelete('cascade');
            $table->timestamps();
        
           
           
        });
    }
        
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
