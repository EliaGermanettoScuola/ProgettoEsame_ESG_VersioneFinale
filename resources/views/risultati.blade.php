@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 p-5">
                    <h3>E</h3>
                    <div class="svg-container ">
                        <svg viewBox="0 0 250 250" class="circular-progress" data-progress="{{$punteggioTipo1}}" preserveAspectRatio="xMidYMid meet">
                            <circle class="bg"></circle>
                            <circle class="fg"></circle>
                        </svg>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-5">
                    <h3>S</h3>
                    <div class="svg-container">
                        <svg viewBox="0 0 250 250" class="circular-progress" data-progress="{{$punteggioTipo2}}" preserveAspectRatio="xMidYMid meet">
                            <circle class="bg"></circle>
                            <circle class="fg"></circle>
                        </svg>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-5">
                    <h3>G</h3>
                    <div class="svg-container">
                        <svg viewBox="0 0 250 250" class="circular-progress" data-progress="{{$punteggioTipo3}}" preserveAspectRatio="xMidYMid meet">
                            <circle class="bg"></circle>
                            <circle class="fg"></circle>
                        </svg>
                     </div>
                </div>
            </div>
        </div>
          
       </div>
    </div>
    

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleziona tutti gli elementi della progress bar
        var progressBars = document.querySelectorAll('.circular-progress');

        // Per ogni progress bar
        progressBars.forEach(function(progressBar) {
            // Leggi il valore del progresso dai dati dell'elemento
            var progressValue = progressBar.getAttribute('data-progress');

            // Seleziona il cerchio di primo piano
            var fgCircle = progressBar.querySelector('.fg');

            // Imposta il valore del progresso come variabile CSS sul cerchio di primo piano
            fgCircle.style.setProperty('--progress', progressValue);

            // Imposta il colore in base al valore del progresso
            if (progressValue <= 25) {
                fgCircle.style.stroke = '#ff0000'; // Rosso per i valori <= 25
            } else if (progressValue <= 50) {
                fgCircle.style.stroke = '#ff8000'; // Arancione per i valori <= 50
            } else if (progressValue <= 75) {
                fgCircle.style.stroke = '#ffff00'; // Giallo per i valori <= 75
            } else {
                fgCircle.style.stroke = '#008079'; // Verde per i valori > 75
            }
        });
    });
</script>