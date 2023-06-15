<div class="imagen"></div>
<div class="app">

    <h1 class="nombre-pagina">Crear Cuenta</h1>
    <p class="descripcion-pagina">LLena el siguiente formulario para crear una cuenta</p>

    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form class="formulario" action="/AppCrossfit/crear-cuenta" method="POST">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input 
                type="text"
                id="nombre"
                placeholder="Escribe tu Nombre"
                name="nombre"
                value="<?php echo s($usuario->nombre); ?>"
            />
        </div>

        <div class="campo">
            <label for="apellido">Apellido</label>
            <input 
                type="text"
                id="apellido"
                placeholder="Escribe tu Apellido"
                name="apellido"
                value="<?php echo s($usuario->apellido); ?>"
            />
        </div>

        <div class="campo">
            <label for="telefono">Telefono</label>
            <input 
                type="tel"
                id="telefono"
                placeholder="Escribe tu Telefono"
                name="telefono"
                value="<?php echo s($usuario->telefono); ?>"
            />
        </div>

        <div class="campo">
            <label for="email">Email</label>
            <input 
                type="email"
                id="email"
                placeholder="Escribe tu Email"
                name="email"
                value="<?php echo s($usuario->email); ?>"
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
        <input type="submit" class="boton" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a href="/AppCrossfit/">¿Ya tienes una cuenta? Inicia Sesión</a>
    </div>
</div>

<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>