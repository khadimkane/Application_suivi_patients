
 @extends('layouts.app')


@section('content')

<div>
<div class="p-6">
<table class="min-w-full mt-2">
 @if(session('status'))
                        <div class="bg-red-500 text-white">
                            
                            {{ session('status') }}

                        </div>
                        @endif
                        <h4 class="mb-4"> Listes des Patients</h4>
                        @if ($patients->count())
                        
                            <thead class="bg-green-500 text-white shadow-sm appearence-none border rounded w-full p-1">

                                <tr>
                                     <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Prenom</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Date_Naissance</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">sexe</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">telephone</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">adresse</th>
                                      <th class="text-left py-3 px-6 uppercase font-semibold text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                              @php
                                  $ide=1;
                              @endphp


                               @foreach($patients as $patient)
                                <tr>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $ide }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->nom }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->prenom }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->date_nais }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->sexe }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->email }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->telephone }}</td>
                                    <td class="w-1/3 text-left py-3 px-4">{{ $patient->adresse }}</td>

                                    <td class="w-1/3 text-left py-3 px-4 flex space-x-2">

                                  {{-- <td>  <a href="/update-patient/{{ $patient->id}}" class="border-2 border-blue-600 p-1 rounded-md text-xs">Update</a></td>

                                  <td>  <a href="/delete-patient/{{ $patient->id}}" class="border-2 border-red-600 p-1 rounded-md text-xs">Delete</span></td> --}}
                                    
                                     <a class="text-left py-3 px-2 uppercase font-semibold text-sm bg-red-600 text-white" title="delete patient" href="/delete-patient/{{ $patient->id}}">
                                        <button class="btn-danger btn-sm">
                                           <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                      </a>
                                      <a class="text-left py-3 px-2 uppercase font-semibold text-sm bg-green-600 text-white" title="update patient" href="/update-patient/{{ $patient->id}}">
                                        <button class="btn-success btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                                      </a>
                                      <a class="text-white bg-blue-500 text-left py-3 px-2 uppercase font-semibold text-sm" title="view patient" href="{{ route('patients.show', $patient->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                          <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                       </a>
                                           
                                  
                                    </td
                                    
                                
                                   
                                    
                                </tr>
                                @php
                                    $ide +=1;
                                @endphp

                                @endforeach
                                

                                
                            </tbody>
</table>

                          {{ $patients->links()}}
                        @else
                           <p>Aucun patient trouvé.</p>
                        @endif
</div>
</div>
<script>
    function deletePatient(patientId) {
        if (confirm("Voulez-vous vraiment supprimer ce patient ?")) {
            window.location.href = "/delete-patient/" + patientId;
        }
    }
</script>
 @endsection