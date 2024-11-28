@extends('layouts.app1')

@section('content')
    <div class="flex justify-center items-center h-screen w-full">
        <div class="bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Détails du medecin</h1>
            <p class="mb-2"><span class="font-bold">Nom du medecin:</span> {{ $medecin->nom }}</p>
            <p class="mb-2"><span class="font-bold">Email :</span> {{ $medecin->email }}</p>
            <p class="mb-2"><span class="font-bold">Mot de passe  :</span> {{ $medecin->password }}</p>
            <p class="mb-2"><span class="font-bold">Téléphone :</span> {{ $medecin->tel }}</p>
            <p class="mb-2"><span class="font-bold">Nom de la spécialité :</span> {{ $medecin->specialites->libelle }}</p>
            
            <a href="{{ url()->previous() }}" class="text-white bg-blue-500 p-2 rounded mt-4 inline-block">Retour</a>
        </div>
        
    </div>
@endsection