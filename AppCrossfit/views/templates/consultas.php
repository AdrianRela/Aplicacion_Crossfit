<?php
if($datosCliente) {

    foreach ($datosCliente as $key => $dato){
        
    ?>
        <div>
            <p><span><b><?php echo $key . ": "; ?></b></span><span><?php echo $dato; ?></span></p>
        </div>
    <?php        
        
    }
}

if($datosActualizar) { ?>

    <form action="/AppCrossfit/admin-actualiza" method="POST" class="form-admin-actualizar">
        <input type='hidden' name='tabla' value='<?php echo $tabla; ?>'><br>
    <?php
    foreach ($datosActualizar as $key => $dato){

    ?>

        <label for=""><?php echo $key; ?></label> 
        <input type='text' name='<?php echo $key; ?>' id='<?php echo $key; ?>' value='<?php echo $dato; ?>'>

    <?php

    }
    ?>
        
        <button type="submit" class="boton">Actualizar</button>
    </form>
    <?php
}
?>