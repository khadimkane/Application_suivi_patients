@extends('layouts.app')

@section('content')

<div>
<div class="p-4 ">
<table class="min-w-full mt-8  ">
@if(session('status'))
                        <div class="bg-red-500 text-white " >
                            
                            {{ session('status') }}

                        </div>
                        @endif
                        <h4 class="mb-1">Listes  des patients</h4>
                        {{-- <div class="search">
                            <input type="text" class="w-full px-5 py-1 text-gray-700 uppercase bg-white rounded shadow-sm"
                            placeholder="Recherche Patients" wire:model='search'>
                        </div> --}}
                            <thead class="bg-green-400 text-black">
                                <tr>
                               
                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Patient_id</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Prenom</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">Date</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm">heure</th>

                                    <th class=" py-3 px-4 uppercase font-semibold text-sm">Valeur</td>
                                  
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                            @php
                            $ide = 1;
                             @endphp
                                
                            @foreach($affichages as $affiche)

                                <tr>
                                   
                                   
                                    <td class="w-1/3 text-left py-3 px-4">{{ $affiche->patients_id}}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $affiche->nom}}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $affiche->prenom}}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $affiche->date}}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $affiche->heure}}</td>
                                    
                                    <td class="w-1/3 text-left py-3 px-4">{{ $affiche->valeur}}</td>
                                    
                                </tr>
                                @php
                                $ide +=1;
                                @endphp
                                @endforeach
                               
                                

                            
                                

                                
                            </tbody>
                        </table>
                        {{ $affichages->links()}}
                        
</div>
</div>


@endsection