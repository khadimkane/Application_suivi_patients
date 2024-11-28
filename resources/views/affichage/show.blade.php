@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="p-6  w-full max-w-md">
        <h4 class="mb-4">Détails du patient</h4>
        <p><strong>Patient ID:</strong> {{ $affiche->patients_id }}</p>
        <p><strong>Nom:</strong> {{ $affiche->nom }}</p>
        <p><strong>Prénom:</strong> {{ $affiche->prenom }}</p>
        <p><strong>Date:</strong> {{ $affiche->date }}</p>
        <p><strong>Heure:</strong> {{ $affiche->heure }}</p>
        <p><strong>Valeur en mV:</strong> {{ $affiche->valeur }}</p>
        <p><strong>Valeur en °C:</strong> {{ $affiche->temperature }}</p>
        <a href="{{ url()->previous() }}" class="text-white bg-blue-500 p-2 rounded mt-4 inline-block">Retour</a>
    </div>
</div>
@endsection
