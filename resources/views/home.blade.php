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
                    <div class="contenitore">
                        <div class="card text-center">
                            <div class="front">
                            <p class="text-white py-5">"L'ESG integration è un <br> approccio che utilizza le <br>
                            informazioni e le <br> valutazioni ESG senza <br> dare vita a una vera e <br> proprieta strategica ESG"</p>
                            </div>
                            <div class="back">
                            <p class="back-heading">Back card</p>
                            <p>Follow Me For More</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="contenitore">
                        <div class="card text-center">
                            <div class="front">
                            <p class="text-white py-5">"L'ESG integration è un <br> approccio che utilizza le <br>
                            informazioni e le <br> valutazioni ESG senza <br> dare vita a una vera e <br> proprieta strategica ESG"</p>
                            </div>
                            <div class="back">
                            <p class="back-heading">Back card</p>
                            <p>Follow Me For More</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="contenitore text-center">
                        <div class="card text-center">
                            <div class="front">
                            <p class="text-white py-5">"L'ESG integration è un <br> approccio che utilizza le <br>
                            informazioni e le <br> valutazioni ESG senza <br> dare vita a una vera e <br> proprieta strategica ESG" <br>
                            <span id="dots">...</span><span id="more">Lorem ipsum dolor sit amet consectetur, adipisicing elit. In dolores recusandae provident non maxime et 
                            deleniti eum fugiat nesciunt amet. Temporibus delectus repudiandae quaerat explicabo quae facere vel modi. Molestias.</p>
                            </div>
                            <div class="back">
                            <p class="back-heading">Back card</p>
                            <p>Follow Me For More</p>
                            </div>
                        </div>
                        <br>
                        <br>
                        <button onclick="readMore()" id="myBtn" class="btn btn-primary">Read more</button>
                    </div>
                    
                </div>
            </div>
        </div>

      <!--  <div class="container text-center pt-5" id="testoLibero">
            <div class="pt-5">
                <p class="text-1 pt-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam, placeat nostrum. Quibusdam numquam magnam hic,
                     magni iusto consequatur
                     architecto quos sapiente. Quae, impedit delectus. Deserunt quo veniam laudantium nobis repellat?</p>
            </div>

            <div class="pt-4">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam, placeat nostrum. Quibusdam numquam magnam hic,
                     magni iusto consequatur
                     architecto quos sapiente. Quae, impedit delectus. Deserunt quo veniam laudantium nobis repellat?</p>
            </div>

            <div class="pt-2 pb-5">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam, placeat nostrum. Quibusdam numquam magnam hic,
                     magni iusto consequatur
                     architecto quos sapiente. Quae, impedit delectus. Deserunt quo veniam laudantium nobis repellat?</p>
            </div>


        </div>-->

        
        
    </div>

    <div class="text-center pt-5">
            <img src="/img/immagine-lunga-home2.jpg" alt="" class="contain">
    </div>
    
    



    
@endsection


