<div class="app2">
    <?php 
    include_once __DIR__ . "/../templates/header.php";
    ?>
    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>
    <h2 class="h2-contacto">Clases y Horarios</h2>
    <div  class="botones-calendario">
        <button id="btnAnterior" onclick="anteriorSemana()">&lt;</button> <!-- Botón para retroceder una semana -->
        <button id="btnSiguiente" onclick="siguienteSemana()">&gt;</button> <!-- Botón para avanzar una semana -->
    </div>
    <div class="p-4">
        <!-- fondo tabla -->
        <div class="card shadow ">
            <div class="card-body">

                <!-- tabla -->
                <div class="table-responsive formato-tabla">
                <table class="table table-sm table-striped table-hover text-center" id="horarios">
                    <tr>
                        <th>#</th>
                        <th>LUNES</th>
                        <th>MARTES</th>
                        <th>MIÉRCOLES</th>
                        <th>JUEVES</th>
                        <th>VIERNES</th>
                        <th>SÁBADO</th>
                        <th>DOMINGO</th>
                    </tr>
                </table>
            </div>

            </div>
        </div>
    </div>
    

    <form action="/AppCrossfit/dashboard-horarios" method="POST" class="boton-reservar">
        <input type="submit" class="boton" id="reserva" value="RESERVAR"/>
    </form>
</div>

<?php 
    include_once __DIR__ . "/../templates/footer.php";

    $script = "<script src='public/build/js/dashboard.js'></script>";
?>