<div class="app2">
    <?php 
    include_once __DIR__ . "/../templates/header.php";
    ?>
    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>
    
    <h2 class="h2-contacto">Administrador</h2>


    <div class="contenedor-admin">
        <div >
            <h2>Tablas</h2>
            <div class="izquierda">
                <button class="boton" onclick="seleccionarTabla('Clases')">Clases</button>
                <button class="boton" onclick="seleccionarTabla('Usuario')">Clientes</button>
                <button class="boton" onclick="seleccionarTabla('Cupon')">Cupones</button>
                <button class="boton" onclick="seleccionarTabla('Ejercicios')">Ejercicios</button>
                <button class="boton" onclick="seleccionarTabla('Resultados')">Resultados</button>
                <button class="boton" onclick="seleccionarTabla('Tarifas')">Tarifas</button>
            </div>
        </div>
  
        <div class="columna1">
            <h2>Opciones</h2>
            <div class="central">
                <button class="boton" onclick="accionCRUD('borrar')">Borrar</button>
                <button class="boton" onclick="accionCRUD('consultar')">Consultar</button>
                <button class="boton" onclick="accionCRUD('insertar')">Insertar</button>
                <button class="boton" onclick="accionCRUD('actualizar')">Actualizar</button>
            </div>
        </div>
  
        <div class="columna2">
            <h2>Datos</h2>
            <div class="derecha">
                <form id="formulario-admin" method="POST" action="/AppCrossfit/admin" >
                 
                </form>
            </div>
        </div>
    </div>

</div>

<?php 
    $script = "<script src='public/build/js/admin.js'></script>";
?>