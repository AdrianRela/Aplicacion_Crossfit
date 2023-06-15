<div class="imagen"></div>
<div class="app">

    <h1 class="nombre-pagina">Cuenta Confirmada</h1>
    <p class="descripcion-pagina"> ¡¡COMENCEMOS!!</p>

    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>
    <form class="form-cuenta-conf" action="/AppCrossfit" method="POST">
        <input type="submit" class="boton" id="compra" value="Iniciar Sesión">
    </form>
    
</div>
<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>