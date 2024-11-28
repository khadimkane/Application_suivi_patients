@extends('layouts.app')

@section('content')
<div class="m-8 items-center">
    <h4>Modifiez un rendez-vous</h4>
    @if(session('status'))
        <div class="bg-blue-600 text-white p-4 rounded">
            {{ session('status') }}
        </div>
    @endif

   <form id="appointmentForm" method="POST" action="{{ route('update-appointement.traitement', ['id' => $appointements->id]) }}">

        @csrf
        <input type="hidden" name="id" value="{{ $appointements->id }}">
        <div class="bg-white p-4 shadow-sm w-full">
            <div class="flex justify-between">
                <div>
                    <label for="patientCode">Code Patient</label>
                    <input type="text" id="patientCode" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="patientCode" value="{{ $appointements->patient_id }}" readonly>
                </div>
                <div>
                    <label for="date">Date Rendez-Vous</label>
                    <input type="date" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="date" value="{{ $appointements->date }}">
                </div>
                <div>
                    <label for="time">Heure Rendez-Vous</label>
                    <input type="time" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="time" value="{{ $appointements->time }}">
                </div>
            </div>
            <div class="w-full mt-4">
                <label for="currentPatient">Patient Trouvé</label>
                <input type="text" id="currentPatient" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="currentPatient" readonly value="{{ $appointements->patient->prenom }} {{ $appointements->patient->nom }}">
            </div>
            <div class="mt-5">
                <button type="submit" class="bg-green-500 p-2 text-white w-full">Enregistrer les modifications</button>
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



@endsection
