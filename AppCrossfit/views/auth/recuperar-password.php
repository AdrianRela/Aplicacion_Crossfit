<div class="imagen"></div>
<div class="app">
    <h1 class="nombre-pagina">Recuperar Contraseña</h1>
    <p>Coloca tu nueva Contraseña a continuación</p>

    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <?php if($error) return; ?>
    <form class="formulario" method="POST">
        <div class="campo">
            <label for="password">Password</label>
            <input 
                type="password"
                id="password"
                name="password"
                placeholder="Tu nueva Contraseña"/>
        </div>
        <input type="submit" class="boton" value="Guardar Nueva Contraseña">
    </form>

    <div class="acciones">
        <a href="/AppCrossfit">¿Ya tienes cuenta? Iniciar Sesión</a>
    </div>
</div>

<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>