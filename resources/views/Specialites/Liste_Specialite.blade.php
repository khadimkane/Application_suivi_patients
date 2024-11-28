@extends('layouts.app1')

@section('content')

<div class="p-6 ">
    <div class="mt-10 ">
        <div class="flex justify-between mb-3">
            <h4 class="mb-2"> Liste des spécialités</h4>
            @if(session('status'))
            <div class="bg-blue-500 text-white">
                {{ session('status') }}
            </div>
            @endif
            @if(session('success'))
            <div class="bg-red-500 text-white">
                {{ session('success') }}
            </div>
            @endif
            <a href="{{route('Ajouter-Specialite')}}" class="text-xs bg-blue-600 p-2 rounded-sm text-white">Ajouter une nouvelle spécialité</a>
        </div>
        <table class="min-w-full">
            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="w-1/3 text-left py-1 px-6 uppercase font-semibold text-sm">#</th>
                    <th class="w-1/3 text-left py-1 px-6 uppercase font-semibold text-sm">Nom-Spécialité</th>
                    <th class="w-1/3 text-left py-1 px-6 uppercase font-semibold text-sm">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
              @php
                $ide=1;
              @endphp
                @foreach($specialites as $specialite)
                <tr>
                    <td class="px-6 py-4">{{ $ide }}</td>
                    <td class="px-6 py-4">{{ $specialite->libelle }}</td>
                    <td class="w-1/3 text-left py-3 px-4 flex space-x-2">
                        
                            <a class="text-left py-2 px-4 uppercase font-semibold text-sm bg-red-600 text-white" title="delete specialite" href="/delete-specialite/{{ $specialite->id}}">
                                <button class="btn-danger btn-sm">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </a>
                            <a class="text-left py-2 px-4 uppercase font-semibold text-sm bg-green-600 text-white" title="update specialite" href="/update-specialite/{{ $specialite->id}}">
                                <button class="btn-success btn-sm">
                                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                </button>
                            </a>
                             
                    
                    </td>
                </tr>
                @php
                $ide +=1;
                @endphp
                @endforeach
            </tbody>
        </table>
        <!-- Afficher les liens de pagination -->
        {{ $specialites->links()}}
    </div>
</div>
@endsection
