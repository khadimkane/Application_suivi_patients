
@extends('layouts.app')

@section('content')
    <div class="w-full h-full overflow-x-hidden border-t flex flex-col">
        <main class="w-full h-full flex-grow p-6">    
            <div class="flex flex-wrap mt-6 bg-white">
                <div class="w-full md:w-full"> <!-- Laissez la largeur à pleine largeur -->
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-check mr-3"></i> Historique du capteur
                    </p>
                    <div class="p-6 h-full">
                        <canvas id="chartTwo" style="width: 100%; height: 400px;"></canvas> <!-- Ajuster la taille du canvas -->
                        <a href="{{ url()->previous() }}" class="text-white bg-blue-500 p-2 rounded mt-4 inline-block">Retour</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Extraire les heures depuis les données passées par le contrôleur
    var labels = [
        @foreach($firstPatientData as $item)
            '{{ $item->heure }}',
        @endforeach
    ];

    // Extraire les valeurs du capteur et de la température depuis les données passées par le contrôleur
    var values = [
        @foreach($firstPatientData as $item)
            {{ $item->valeur }},
        @endforeach
    ];

    var temperatures = [
        @foreach($firstPatientData as $item)
            {{ $item->temperature }},
        @endforeach
    ];

    // Configurer et afficher le graphique
    var ctx = document.getElementById('chartTwo').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Valeur du capteur',
                data: values,
                fill: false,
                borderColor: 'blue',
                backgroundColor: 'black',
                borderWidth: 1
            },{
                label: 'Température',
                data: temperatures,
                fill: false,
                borderColor: 'red',
                backgroundColor: 'black',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Heure'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valeur'
                    }
                }
            }
        }
    });

    // Fonction pour mettre à jour les données du graphique
    function updateChart(chart) {
        $.ajax({
            url: '/historique',
            method: 'GET',
            success: function(data) {
                var labels = [];
                var values = [];
                var temperatures = [];

                data.forEach(function(item) {
                    labels.push(item.heure);
                    values.push(item.valeur);
                    temperatures.push(item.temperature);
                });

                chart.data.labels = labels;
                chart.data.datasets[0].data = values;
                chart.data.datasets[1].data = temperatures;
                chart.update();
            }
        });
    }

    // Mettre à jour le graphique toutes les 5 secondes
    setInterval(function() {
        updateChart(myLineChart);
    }, 5000);

    // Mise à jour initiale du graphique
    updateChart(myLineChart);
</script>

@endsection
