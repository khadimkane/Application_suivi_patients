@extends('layouts.app1')

@section('content')
<div class="p-6 ">
    @if(session('status'))
        <div class="bg-blue-600 text-white p-4 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif
    <h4 class="m-8">Liste des médecins</h4>
    <table class="min-w-full ">
        <thead class="bg-blue-800 text-white shadow-sm">
            <tr>
                <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Médecin</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Téléphone</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Mot De Passe</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Spécialité</th>
                <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @php
                $ide = 1;
            @endphp
            @foreach($medecins as $medecin)
                <tr>
                    <td class="w-1/12 text-left py-3 px-4">{{ $ide }}</td>
                    <td class="w-2/12 text-left py-3 px-4">{{ $medecin->nom }}</td>
                    <td class="w-2/12 text-left py-3 px-4">{{ $medecin->email }}</td>
                    <td class="w-2/12 text-left py-3 px-4">{{ $medecin->tel }}</td>
                    <td class="w-2/12 text-left py-3 px-4">{{ Str::limit($medecin->password, 10) }}{{-- Limiter à 10 caractères --}}</td>
                    <td class="w-2/12 text-left py-3 px-4">{{ $medecin->specialites->libelle }}</td>
                    <td class="w-1/12 text-left py-3 px-4 flex space-x-2">
                        <a href="/update-medecin/{{ $medecin->id}}" class="text-green-600">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a href="/delete-medecin/{{ $medecin->id }}"  class="text-red-600">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a href="{{ route('medecins.show', $medecin->id) }}" class="text-blue-600">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>      
                </tr>
                @php
                    $ide += 1;
                @endphp
            @endforeach
        </tbody>
    </table>
    {{ $medecins->links() }}
</div>
@endsection

{{-- /update-medecin/{{ $medecin->id }} --}}


 