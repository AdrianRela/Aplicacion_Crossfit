<div class="app2">
    <?php 
    include_once __DIR__ . "/../templates/header.php";
    ?>
    
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <div class="carousel-inner " style="text-align: center;">

            <div class="carousel-item active" >
                <img style="height: 350px; width: 100%" src="public/build/img/Foto-2-Carrusel.jpg" class="img-fluid d-block " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>1ª FOTO</h5>
                    <p>Esta es la primera Imagen.</p>
                </div>
            </div>

            <div class="carousel-item" >
                <img style="height: 350px; width: 100%" src="public/build/img/Foto-1-Carrusel.jpg" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>2ª FOTO</h5>
                    <p>Esta es la segunda Imagen.</p>
                </div>
            </div>

            <div class="carousel-item" >
                <img style="height: 350px; width: 100%" src="public/build/img/Foto-3-Carrusel.jpg" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>3ª FOTO</h5>
                    <p>Esta es la tercera Imagen.</p>
                </div>
            </div>
            
            <div class="carousel-item" >
                <img style="height: 350px; width: 100%" src="public/build/img/Foto-4-Carrusel.jpg" class="d-block " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>4ª FOTO</h5>
                    <p>Esta es la Cuarta Imagen.</p>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>


    <div class="container p-5">
        <div class="row">
            <div class="col-lg-6">
                <!-- acordeon -->
                <div class="accordion" id="accordionExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            HALTEROFILIA
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>Halterofilia integrada en el Crossfit.</strong> La halterofilia se considera el deporte de máxima potencia de un atleta, teniendo efectos prácticos para mejorar multitud de ejercicios, no solo en el ámbito del crossfit sino en cualquier otra disciplina deportiva.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            GIMNÁSTICOS
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>Gimnásticos integrados en el Crossfit.</strong> Estas clases ayudan a tener una mejor técnica en los ejercicios gimnásticos, a adqurir un mayor dominio del cuerpo y a fortalecer todos la musculatura de todo el cuerpo. Algunos de los ejercicios que se pueden encontrar en estas clases son el pino, los muscle up o las dominadas
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                AERÓBICOS
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>Resistencia aplicada al Crossfit.</strong> Estos ejercicios te ayudarán a tener una mejor capacidad de realizar actividad física de intensidad media, estos nos ayudará en nuestra vida diaria en multitud de actividades. Algunos ejercicios que se realizan son carrera, remo y bici.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- tarjeta con informacion -->
            <div class="col-lg-6">
                <div class="col-12 col-lg-6 mx-auto text-center text-lg-left"> 
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <div class="card tablet-ancho" >
                            <div class="card-header">
                                <img src="public/build/img/FotoCarné.png" height="300px" alt="foto.png" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Adrián Relaño Oter (Entrenador)</h5>
                                <p class="card-text">Licenciado en Ciencias de la Actividad Física y Deporte.</p>
                                <a class="card-link" href="#">Saber más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
<!-- circulos con animaciones -->
    <div class="container-fluid">
        <div class="container mb-2 p-2">
            <div class="row featurette">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 justify-content-center d-flex">
                    <div class="row justify-content-between mx-4">
                        <div class=" circulo border-5 hover col-md-4 d-flex justify-content-center align-items-center rounded-circle" style="width: 300px; height: 300px; ">
                            <div class="text-center">
                                <img src="public/build/img/Flexibilidad.png" alt="foto.png" style="width: 150px;height: 120px;" class="rounded-circle mx-2">
                                <p class="text-white pt-2">FLEXIBILIDAD</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 justify-content-center d-flex">
                    <div class="row justify-content-between mx-4">
                        <div class=" circulo border-5 hover col-md-4 d-flex justify-content-center align-items-center rounded-circle" style="width: 300px; height: 300px; ">
                            <div class="text-center ">
                                <img src="public/build/img/Fuerza.png" alt="foto.png" style="width: 150px;height: 150px;" class="rounded-circle mx-2">
                                <p class="text-white">FUERZA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 justify-content-center d-flex">
                    <div class="row justify-content-between mx-4">
                        <div class=" circulo border-5 hover col-md-4 d-flex justify-content-center align-items-center rounded-circle" style="width: 300px; height: 300px; ">
                            <div class="text-center ">
                                <img src="public/build/img/Equilibrio.png" alt="foto.png" style="width: 150px;" class="rounded-circle mx-2">
                                <p class="text-white">EQUILIBRIO</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
    include_once __DIR__ . "/../templates/footer.php";

    $script = "<script src='bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js'></script>";
?>