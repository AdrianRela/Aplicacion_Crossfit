<div class="imagen"></div>
<div class="app">
    
    <h1 class="Nombre-pagina">Comprar Suscripción</h1>
    <p class="descripcion-pagina">Elige una suspcripción y coloca tus datos</p>

    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <div id="app">

        <nav class="tabs">
            <button class="actual" type="button" data-paso="1">Tarifas</button>
            <button type="button" data-paso="2">Usuario</button>
            <button type="button" data-paso="3">Resumen</button>
        </nav>

        <div id="paso-1" class="seccion">
            <h2>Tarifas</h2>
            <p class="text-center">Elige tus servicios a continuacion</p>
            <div id="servicios" class="listado-servicios"></div>
        </div>

        <div id="paso-2" class="seccion">
            <h2>Tus Datos</h2>
            <p class="text-center">Coloca tus datos</p>

            <form class="formulario">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input 
                        id="nombre"
                        type="text"
                        placeholder="Tu Nombre"
                        value="<?php echo $nombre; ?>"
                        disabled
                    />
                </div>

                <div class="campo">
                    <label for="email">Email</label>
                    <input 
                        id="email"
                        type="email"
                        placeholder="Tu Email"
                        value="<?php echo $email; ?>"
                        disabled
                    />
                </div>

                <div class="campo">
                    <label for="telefono">Teléfono</label>
                    <input 
                        id="telefono"
                        type="telefono"
                        placeholder="Tu Teléfono"
                    />
                </div>
            </form>
        </div>
        
        <div id="paso-3" class="seccion contenido-resumen">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la información sea correcta</p>
        </div>

        <div class="paginacion">
            <button id="anterior" class="boton">&laquo; Anterior</button>
            <button id="siguiente" class="boton">&raquo; Siguiente</button>
        </div>
        
        <div class="compra" style="display:none;">
            <form id="formularioPayPal" action="/AppCrossfit/paypal" method="POST">
                <input type="submit" class="boton" id="compra" value="Comprar">
            </form>
        </div>
        <div class="paginacion">
            <form action="/AppCrossfit/dashboard" method="POST">
                <input type="submit" class="boton" value="Ir al Dashboard">
            </form>
            <form action="/AppCrossfit/logout" method = "GET">
                <input type="submit" class="boton" value="Desconectar"></input>
            </form>
        </div>
    </div>
</div>
<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>