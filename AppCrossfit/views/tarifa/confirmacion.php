<div class="imagen"></div>
<div class="app">
<?php 
if(isset($num_clases)) { ?>
    <div>
        <h1>Ya Tiene Suscripción</h1>
    </div>

    <div class="contenido-resumen">
        <div class="info-resumen">
            <h2>Detalles de su Tarifa:</h2>
            <p><span>Nº Clases restantes: </span><?php echo $num_clases; ?></p>
            <p><span>Fecha de Creación: </span><?php echo $fecha_suscripcion; ?></p>
            <p><span>Fecha de Finalización: </span><?php echo $fecha_finalizacion; ?></p>
        </div>
    </div>

    <form action="/AppCrossfit/dashboard" method="POST">
        <input type="submit" class="boton" name="Dashboard" value="Ir al Dashboard">
    </form>
<?php
}
else{ ?>
    <div>
        <h1>Pago Completado</h1>
    </div>
    
    <div class="contenido-resumen">
        <div class="info-resumen">
            <h2>Detalles de la Transacción:</h2>
            <p><span>Tarifa: </span><?php echo $nombre; ?></p>
            <p><span>Fecha de Creación: </span><?php echo $fechaCreacion; ?></p>
            <p><span>Precio Total: </span><?php echo $precioTotal; ?></p>
            <p><span>ID de Transacción: </span><?php echo $idTransaccion; ?></p>
        </div>
    </div>

    <form class="form-cuenta-conf" action="/AppCrossfit/dashboard" method="POST">
        <input type="submit" class="boton" name="Dashboard" value="Ir al Dashboard">
    </form>
<?php
}
?>
</div>

<?php 
    $script = "<script src='public/build/js/app.js'></script>";
?>