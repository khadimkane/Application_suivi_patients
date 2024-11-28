@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen w-full">
        <div class="bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Détails du patient</h1>
            <p class="mb-2"><span class="font-bold">Nom :</span> {{ $patient->nom }}</p>
            <p class="mb-2"><span class="font-bold">Prénom :</span> {{ $patient->prenom }}</p>
            <p class="mb-2"><span class="font-bold">Date de naissance :</span> {{ $patient->date_nais }}</p>
            <p class="mb-2"><span class="font-bold">Sexe :</span> {{ $patient->sexe }}</p>
            <p class="mb-2"><span class="font-bold">Email :</span> {{ $patient->email }}</p>
            <p class="mb-2"><span class="font-bold">Téléphone :</span> {{ $patient->telephone }}</p>
            <p class="mb-2"><span class="font-bold">Adresse :</span> {{ $patient->adresse }}</p>
            <a href="{{ url()->previous() }}" class="text-white bg-blue-500 p-2 rounded mt-4 inline-block">Retour</a>
        </div>
        
    </div>
@endsection