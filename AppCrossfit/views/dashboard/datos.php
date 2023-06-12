<div class="app2">
    <?php 
    include_once __DIR__ . "/../templates/header.php";
    ?>
    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>
    <h2 class="h2-contacto">Mi Información</h2>

    <div class="contenedor-datos">

        <div class="contendor-izquierda">
            <div class="info-personal">
                <h3 class="h4-datos">Información Personal</h3>
                <form class="formulario-contacto" action="/AppCrossfit/dashboard-misdatos" method="POST">
                    <div class="campo-contacto">
                        <label for="nombre">Nombre</label>
                        <input 
                            id="nombre"
                            type="text"
                            name="nombre";
                            placeholder="Tu Nombre"
                            value="<?php echo $nombreSolo; ?>"
                            disabled
                        />
                    </div>
                    <div class="campo-contacto">
                        <label for="nombre">Apellidos</label>
                        <input 
                            id="nombre"
                            type="text"
                            name="apellidos";
                            placeholder="Tus Apellidos"
                            value="<?php echo $apellidos; ?>"
                            disabled
                        />
                    </div>

                    <div class="campo-contacto">
                        <label for="email">Email</label>
                        <input 
                            id="email"
                            type="email"
                            name="email";
                            placeholder="Tu Email"
                            value="<?php echo $email; ?>"
                            disabled
                        />
                    </div>

                    <div class="campo-contacto">
                        <label for="telefono">Teléfono</label>
                        <input 
                            id="telefono"
                            type="telefono"
                            name="telefono";
                            value="<?php echo $telefono; ?>"
                            placeholder="Tu Teléfono"
                        />
                    </div>
                    <input type="submit" class="boton" value="MODIFICAR"/>
                </form>
            </div>

            <div class="info-suscripcion">
                <h3 class="h4-datos">Información Suscripción</h3>
                <p class="parrafo-suscripcion" id="utilizados"><span>Créditos Utilizados: </span><span class="valor-suscripcion" id="valor-utilizados"></span></p>
                <p class="parrafo-suscripcion" id="disponibles"><span>Créditos Disponibles: </span><span class="valor-suscripcion" id="valor-disponibles"></span></p>
                <p class="parrafo-suscripcion" id="periodo"><span>Período de Créditos: </span><span class="valor-suscripcion" id="valor-periodo"></span></p>
                <p class="parrafo-suscripcion" id="caducidad"><span>Caducidad Suscripción: </span><span class="valor-suscripcion" id="valor-caducidad"></span></p>
            </div>
        </div>

        <div class="contendor-derecha">
            <h3 class="h4-datos">Información Reservas</h3>
            <div id="lista-reservas"></div>
        </div>

    </div>

</div>

<?php 
    include_once __DIR__ . "/../templates/footer.php";

    $script = "<script src='public/build/js/datos.js'></script>";
?>