<div class="app2">
    <?php 
    include_once __DIR__ . "/../templates/header.php";
    ?>
    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>

    <h2 class="h2-contacto">Mis Resultados</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="p-3">
                    <!-- fondo tabla -->
                    <div class="card shadow ">
                        <div class="card-body">
                            <!-- tabla -->
                            <div class="table-responsive formato-tabla">
                                <table class="table table-sm table-striped table-hover text-center" id="horarios">
                                    <tr>
                                        <th>EJERCICIO</th>
                                        <th>RESULTADO</th>
                                        <th>FECHA</th>
                                        <th>RM</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="form-insertar" style="display:none">
                <h3 class="h2-resultado"></h3>
                <form class="formulario-resultado" action="/AppCrossfit/dashboard-resultados" method = "POST" >

                    <div class="campo-resultado">
                        <label for="series">Series</label>
                        <input 
                            id="series"
                            type="number"
                            name="series";
                            placeholder="Introduce las Series"
                            
                        />
                    </div>
                    <div class="campo-resultado">
                        <label for="reps">Repeticiones</label>
                        <input 
                            id="reps"
                            type="number"
                            name="reps";
                            placeholder="Introduce las Repeticiones"
                            
                        />
                    </div>

                    <div class="campo-resultado">
                        <label for="peso">Peso</label>
                        <input 
                            id="peso"
                            type="number"
                            name="peso";
                            placeholder="Introduce tu Peso"
                        
                        />
                    </div>

                    <div class="campo-resultado">
                        <label for="telefono">Fecha de Realización</label>
                        <input 
                            id="fecha_realizacion"
                            type="date"
                            name="fecha_realizacion";
                            placeholder="Introduce la fecha de realización"
                            max="<?php echo date('Y-m-d'); ?>"
                        />
                    </div>
                    <input type="submit" class="boton" value="INSERTAR"/>
                </form>
            </div>
        </div>
    </div> 
</div>

<?php 
    include_once __DIR__ . "/../templates/footer.php";

    $script = "<script src='public/build/js/resultados.js'></script>";
?>
   