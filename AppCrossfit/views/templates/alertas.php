<?php
if($alertas) {

    foreach ($alertas as $key => $mensajes){
        
        foreach ($mensajes as $mensaje){ 
    ?>
            <div id="alert" class="alerta <?php echo $key; ?>">
                <?php echo $mensaje; ?>
            </div>
    <?php        
        }
    }
}
?>