@extends('layouts.app1')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8  shadow-lg rounded-lg">
        <h4 class="text-center mb-6">Ajoutez une spécialité</h4>
          @if(session('status'))
            <div class="bg-blue-500 text-white p-4 rounded">
                {{ session('status') }}
            </div>
            @endif
        <form id="appointmentForm" method="POST" action="{{route('specialite')}}">
            @csrf
            <div class="mb-4">
                <label for="libelle" class="block text-gray-700">Nom de la spécialité</label>
                <input type="text" id="libelle" class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" name="libelle" placeholder="Entrer le nom de la spécialité">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 p-2 text-white w-full rounded">Enregistrer la Spécialité</button>
            </div>
        </form>
    </div>
</div>
@endsection
