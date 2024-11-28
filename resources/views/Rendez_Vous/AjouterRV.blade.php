@extends('layouts.app')

@section('content')
<div class="m-8 items-center">
    <h4>Ajoutez un rendez-vous</h4>
    @if(session('status'))
            <div class="bg-blue-600 text-white p-4 rounded">
                {{ session('status') }}
            </div>
            @endif
        
    
    <form id="appointmentForm" method="POST" action="{{ route('appointements.store') }}">
       @csrf
        <div class=" p-4 shadow-sm w-full">
            <div class="flex justify-between">
                <div>
                    <label for="patientCode">Code Patient</label>
                    <input type="text" id="patientCode" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="patientCode"> 
                </div>
                <div>
                    <label for="date">Date Rendez-Vous</label>
                    <input type="date" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="date">
                </div>
                <div>
                    <label for="date">Heure Rendez-Vous</label>
                    <input type="time" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="time">
                </div>
            </div>

            <div class="w-full mt-4">
                <label for="currentPatient">Patient Trouvé</label>
                <input type="text" id="currentPatient" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="currentPatient" readonly value='Non Trouvé'>
            </div>

            {{-- <div class="flex justify-between mt-4">
                <div>
                    <label for="selectedSpecialites">Spécialité</label>
                    <select name="selectedSpecialites" id="selectedSpecialites" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded">
                        <option value=""></option>
                        @foreach ($specialites as $specialite)
                            <option value="{{ $specialite->id }}">{{ $specialite->libelle }}</option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- <div>
                    <label for="medecin">Choisissez Médecin</label>
                    <select name="medecin" id="medecin" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded">
                        <!-- Options pour les médecins seront ajoutées dynamiquement -->
                    </select>
                </div>
            </div> --}}

            <div class="mt-5">
                <button type="submit" class="bg-green-500 p-2 text-white w-full">Enregistrer le RDV</button>
            </div>
        </div>
    </form>
</div>






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#patientCode').on('change', function() {
            var patientCode = $(this).val();
            if (patientCode) {
                $.ajax({
                    url: '/get-patient/' + patientCode,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#currentPatient').val(response.prenom + ' ' + response.nom);
                        } else {
                            $('#currentPatient').val('Non trouvé');
                        }
                    },
                    error: function() {
                        $('#currentPatient').val('Non trouvé');
                    }
                });
            } else {
                $('#currentPatient').val('Non trouvé');
            }
        
    });
    });



   
      




</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#selectedSpecialites').on('change', function() {
            var specialiteId = $(this).val();
            console.log('Selected Specialite ID:', specialiteId);
            if (specialiteId) {
                $.ajax({
                    url: '/get-medecins-by-specialite/' + specialiteId,
                    type: 'GET',
                    success: function(response) {
                        console.log('Response:', response);
                        $('#medecin').empty();
                        if (response.length > 0) {
                            $.each(response, function(index, medecin) {
                                $('#medecin').append('<option value="' + medecin.id + '">' + medecin.nom + '</option>');
                            });
                        } else {
                            $('#medecin').append('<option value="">Aucun médecin trouvé</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Erreur:', error);
                        console.log('Statut:', status);
                        console.log('XHR:', xhr);
                    }
                });
            } else {
                $('#medecin').empty();
            }
        });
    });
</script>








@endsection









