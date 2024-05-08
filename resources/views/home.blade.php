@extends('layouts.app')

@section('content')
    <div class="navBarColor border-top">
        <div class="py-5">
            <div class="py-5">
                <div class="text-uppercase text-center container py-5 jumbotron">
                    <h3 class="text-white">quanto è sostenibile la tua azienda?</h3>
                    <h3 class="text-white">scoprilo gratutamente con</h3>
                    <h3 class="text-dark">esg checkup</h3>
                </div>
            </div>
        </div>
        
    </div>

    <div class="wrapper">
        <div class="container py-5">
            <h3 class="text-uppercase text-dark" id="titoloHome">che cosa <br> significa esg</h3>
            <div class="row">
                
                <div class="col-md-6" >
                    <div id="primoParagrafoHome" class="py-5">
                        <p class="text-1 mb-5">L'acronimo ESG racchiude tre pilastri fondamentali per valutare la condotta di un'azienda: <strong>E</strong> per l'impatto <strong>ambientale</strong>, <strong>S</strong> per l'aspetto <strong>sociale</strong> e <strong>G</strong> per la <strong>governance</strong>.</p>
                        <p class="mb-5">Questi fattori, considerati sempre più cruciali dagli investitori e dai consumatori, misurano l'impegno di un'impresa verso la sostenibilità a lungo termine.</p>
                        <p class="mb-1">In un mondo alle prese con sfide come il cambiamento climatico e le disuguaglianze sociali, le aziende che dimostrano un reale impegno sui principi ESG non solo accrescono la loro reputazione, ma ottengono anche un vantaggio competitivo e aprono nuove opportunità di business.
                        Integrare i criteri ESG nella propria strategia aziendale significa assumere la responsabilità del proprio operato e contribuire a costruire un futuro più equo e sostenibile per tutti.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="py-2 text-end">
                        <img src="/img/foto-1-home.png" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-12 col-lg-4 ">
                    <div class="contenitore text-center">
                        <div class="card text-center">
                            <div class="front px-2">
                                <h3>
                                    Che cosa è ESG Check Up e perchè:
                                </h3>
                                <p class="text-white px-2">
ESG Check Up                        è uno strumento gratuito di autovalutazione per ottimizzare prestazioni aziendali ambientali, sociali e di governance.
                                </p>
                            </div>
                        </div>
                        <br>
                        <br>
                        <a href="/servizi1" class="btn color-esg">Leggi di +</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="contenitore text-center">
                        <div class="card text-center">
                            <div class="front px-2">
                                <h3>
                                    Come funziona:
                                </h3>
                                <p class="text-white px-2">
ESG Check Up                       ESG Check Up utilizza standard internazionali per valutare in dettaglio le prestazioni ESG aziendali, fornendo un punteggio di rischio, valutazioni specifiche e raccomandazioni per migliorare la sostenibilità e la resilienza.
                                </p>
                            </div>
                            
                        </div>
                        <br>
                        <br>
                        <a href="/servizi2" class="btn color-esg">Leggi di +</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="contenitore text-center">
                        <div class="card text-center">
                            <div class="front px-2">
                                <h3>
                                    Come utilizzare i risultati dell’ESG
                                </h3>
                                <p class="text-white px-2">
ESG Check Up                       I risultati di ESG Checkup migliorano la gestione aziendale, mappano rischi, assicurano conformità normativa, potenziano la comunicazione e supportano lo sviluppo di strategie sostenibili.
                                </p>
                            </div>
                        </div>
                        <br>
                        <br>
                        <a href="/servizi3" class="btn color-esg">Leggi di +</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="text-center pt-5">
            <img src="/img/immagine-lunga-home2.jpg" alt="" class="contain">
    </div>
    
    



    
@endsection


