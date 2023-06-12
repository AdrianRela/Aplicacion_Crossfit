<div class="imagen"></div>
<div class="app">

    <h1 class="nombre-pagina">login</h1>
    <p class="descripcion-pagina">Inicia Sesion con tus datos</p>

    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="formulario" action="/AppCrossfit/login" method="POST">
        <div class="campo">
            <label for="email">Email</label>
            <input 
                type="email"
                id="email"
                placeholder="Escribe tu Email"
                name="email"
            />
        </div>
        <div class="campo">
            <label for="password">Contraseña</label>
            <input 
                type="password"
                id="password"
                placeholder="Escribe tu Contraseña"
                name="password"
            />
        </div>
        <input type="submit" class="boton" value="Iniciar Sesión">
    </form>

    <div class="acciones">
        <a href="/AppCrossfit/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
        <a href="/AppCrossfit/olvide">¿Olvidaste tu contraseña? </a>
    </div>
</div>

<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>