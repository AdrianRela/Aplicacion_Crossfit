<div class="imagen"></div>
<div class="app">

    <h1 class="nombre-pagina">Olvide Password</h1>
    <p class="descripcion-pagina">Reestablece tu Password</p>

    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="formulario" action="/AppCrossfit/olvide" method="POST">
        <div class="campo">
            <label for="email">Email</label>
            <input 
                type="email"
                id="email"
                placeholder="Escribe tu Email"
                name="email"
            />
        </div>
        <input type="submit" class="boton" value="Recuperar Contraseña">
    </form>

    <div class="acciones">
        <a href="/AppCrossfit">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/AppCrossfit/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
    </div>
</div>

<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>