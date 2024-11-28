@extends('layouts.app')

@section('content')

<div>
<div class="p-4 ">
<table class="min-w-full mt-8">
@if(session('status'))
    <div class="bg-red-500 text-white">
        {{ session('status') }}
    </div>
@endif
<h4 class="mb-5 text-center uppercase py-3 text-black">Affichage à temps réel des patients</h4>
@if ($affichages->count())
<thead class="bg-green-400 text-white">
    <tr>
        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Patient_id</th>
        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Prenom</th>
        <th class="py-3 px-4 uppercase font-semibold text-sm">Date</th>
        <th class="py-3 px-4 uppercase font-semibold text-sm">Heure</th>
        <th class="py-3 px-4 uppercase font-semibold text-sm">Valeur en mV</th>
        <th class="py-3 px-4 uppercase font-semibold text-sm">Valeur en °C</th>
        <th class="py-3 px-4 uppercase font-semibold text-sm">Action</th>
    </tr>
</thead>
<tbody class="text-gray-700">
    @php
        $ide = 1;
    @endphp

    @foreach($affichages as $affiche)
    <tr>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->patients_id }}</td>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->nom }}</td>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->prenom }}</td>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->date }}</td>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->heure }}</td>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->valeur }}</td>
        <td class="w-1/3 text-left py-3 px-4">{{ $affiche->temperature }}</td>

        <td class="w-1/3 text-left py-3 px-4 flex space-x-2">
        <a class="text-white bg-green-500 p-2 rounded" title="history" href="{{ route('historique') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-history" aria-hidden="true"></i>
                </button>
            </a>
                        <a class="text-white bg-blue-500 p-2 rounded" title="view" href="{{ route('affiche.show', $affiche->patients_id) }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
            </a>
           
        </td> <!-- Ajout de la cellule "view" et "history" -->
    
    </tr>
    @php
        $ide += 1;
    @endphp
    @endforeach
</tbody>
</table>
{{ $affichages->links() }}
@else
<p>Aucun valeur trouve</p>
@endif

</div>
</div>

@endsection
