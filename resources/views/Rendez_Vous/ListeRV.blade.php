
 @extends('layouts.app')


@section('content')

<div>
<div class="p-6 ">
<table class="min-w-full mt-2 ">
 {{-- @if(session('status'))
                        <div class="bg-red-500 text-white">
                            
                            {{ session('status') }}

                        </div>
                        @endif --}}
                        <div class="flex justify-between mb-3">
                        <h4 class="mb-4"> Liste des rendez vous</h4>
                         @if ($appointements->count())
                          @if(session('status'))
                            <div class="bg-red-600 text-white">
                            
                               {{ session('status') }}

                            </div>
                          @endif
                        {{-- <a href="{{route('Rv_Ajouter')}}" class="text-xs bg-blue-600 p-2 rounded-sm text-white">Ajouter un nouveau rendez vous</a> --}}

                        </div>
                            <thead class="bg-green-400 text-black ">

                                <tr>
                                     {{-- <th class="w-1/3 text-left py-1 px-1 uppercase font-semibold text-sm">#</th> --}}
                                    <th class="w-1/3 text-left py-1 px-6 uppercase font-semibold text-sm">#</th>
                                    <th class="w-1/3 text-left py-1 px-6 uppercase font-semibold text-sm">Patient</th>
                                    {{-- <th class="w-1/3 text-left py-1 px-6 uppercase font-semibold text-sm">Medecin</th> --}}
                                    {{-- <th class="text-left py-1px-6 uppercase font-semibold text-sm">Specialité</th> --}}
                                    <th class="text-left py-1 px-6 uppercase font-semibold text-sm">Date RDV</th>
                                    <th class="text-left py-1 px-6 uppercase font-semibold text-sm">Heure RDV</th>
                                    
                                      <th class="text-left py-1 px-2 uppercase font-semibold text-sm">Status</th>
                                       <th class="text-left py-1 px-6 uppercase font-semibold text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                              @php
                                $ide=1;
                              @endphp
                             
                                @foreach($appointements as $appointement )
                                   
                                 
                                  <tr>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $ide}}</td>
                                    <td class="w-1/3 text-left py-3 px-4"> {{ $appointement->patient->prenom }} {{ $appointement->patient->nom }}</td>
                                    {{-- <td class="w-1/3 text-left py-3 px-4">{{ $appointement->medecins->nom }}</td> --}}
                                    {{-- <td class="w-1/3 text-left py-3 px-4">{{ $appointement->medecins->specialites->libelle }}</td> --}}
                                    <td class="w-1/3 text-left py-3 px-4">{{ $appointement->date }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $appointement->time }}</td>
                                    {{-- <td class="w-1/3 text-left py-3 px-4 {{ $appointement->date < now() ? 'text-blue-500' : 'text-red-500' }}">
                                             {{ $appointement->date < now() ? 'Passé' : 'En attente' }}
                                    </td> --}}
                                    <td class="w-1/3 text-left py-3 px-4 {{ $appointement->status == 'Passé' ? 'text-blue-800' : 'text-red-800' }}">
                                         {{ $appointement->status }}
                                    </td>
                                    
                                    <td class="w-1/3 text-left py-3 px-4 flex space-x-2">
                                     <a class="text-left py-3 px-2 uppercase font-semibold text-sm bg-red-600 text-white" title="delete RDV" href="/delete-appointement/{{ $appointement->id}}">
                                        <button class="btn-danger btn-sm">
                                           <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                      </a>
                                      <a class="text-left py-3 px-2 uppercase font-semibold text-sm bg-blue-600 text-white" title="update RDV" href="/update-appointement/{{ $appointement->id}}">
                                        <button class="btn-success btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                      </a>
                                      <a class="text-left py-3 px-2 uppercase font-semibold text-sm bg-green-600 text-white" title="Send SMS" href="{{ route('send-sms-form', $appointement->id) }}">
                                        <button class="btn-success btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i></button>
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
                               {{ $appointements->links()}}
                                @else
                                  <p>Aucun rendez-vous trouvé.</p>
                                @endif

                    
</div>
</div>
 @endsection