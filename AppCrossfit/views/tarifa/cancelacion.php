<div class="imagen"></div>
<div class="app">

    <h1 class="nombre-pagina">Compra Cancelada</h1>
    <p class="descripcion-pagina"> Compre una suscripción para poder comenzar</p>
    <?php 
        include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="form-cuenta-conf" action="/AppCrossfit/tarifa" method="POST">
        <input type="submit" class="boton" id="compra" value="Comprar Suscripción">
    </form>

</div>

<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>