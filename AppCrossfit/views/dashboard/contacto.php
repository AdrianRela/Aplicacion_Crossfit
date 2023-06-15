<div class="app2">
    <?php 
    include_once __DIR__ . "/../templates/header.php";
    ?>
    <?php 
    include_once __DIR__ . "/../templates/alertas.php";
    ?>
    
    <h2 class="h2-contacto">Formulario de contacto</h2>
    <form class="formulario-contacto" action="/AppCrossfit/dashboard-contacto" method="POST">
        <div class="campo-contacto">
            <span><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="40" height="40"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/></svg></span>
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
            <span><svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="40" height="40"><path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/><path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/></svg></span>
            <label for="apellidos">Apellidos</label>
            <input 
                id="apellidos"
                type="text"
                name="apellidos";
                placeholder="Tus Apellidos"
                value="<?php echo $apellidos; ?>"
                disabled
            />
        </div>

        <div class="campo-contacto">
        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40" height="40" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path d="M448,64H64C28.656,64,0,92.656,0,128v256c0,35.344,28.656,64,64,64h384c35.344,0,64-28.656,64-64V128   C512,92.656,483.344,64,448,64z M342.656,234.781l135.469-116.094c0.938,3,1.875,6,1.875,9.313v256   c0,2.219-0.844,4.188-1.281,6.281L342.656,234.781z M448,96c2.125,0,4,0.813,6,1.219L256,266.938L58,97.219   C60,96.813,61.875,96,64,96H448z M33.266,390.25C32.828,388.156,32,386.219,32,384V128c0-3.313,0.953-6.313,1.891-9.313   L169.313,234.75L33.266,390.25z M64,416c-3.234,0-6.172-0.938-9.125-1.844l138.75-158.563l51.969,44.531   C248.578,302.719,252.297,304,256,304s7.422-1.281,10.406-3.875l51.969-44.531l138.75,158.563C454.188,415.062,451.25,416,448,416   H64z"/></g></svg></span>
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
            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40" height="40" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path d="M256,32c123.5,0,224,100.5,224,224S379.5,480,256,480S32,379.5,32,256S132.5,32,256,32 M256,0C114.625,0,0,114.625,0,256   s114.625,256,256,256s256-114.625,256-256S397.375,0,256,0L256,0z M398.719,341.594l-1.438-4.375   c-3.375-10.062-14.5-20.562-24.75-23.375L334.688,303.5c-10.25-2.781-24.875,0.969-32.405,8.5l-13.688,13.688   c-49.75-13.469-88.781-52.5-102.219-102.25l13.688-13.688c7.5-7.5,11.25-22.125,8.469-32.406L198.219,139.5   c-2.781-10.25-13.344-21.375-23.406-24.75l-4.313-1.438c-10.094-3.375-24.5,0.031-32,7.563l-20.5,20.5   c-3.656,3.625-6,14.031-6,14.063c-0.688,65.063,24.813,127.719,70.813,173.75c45.875,45.875,108.313,71.345,173.156,70.781   c0.344,0,11.063-2.281,14.719-5.938l20.5-20.5C398.688,366.062,402.062,351.656,398.719,341.594z"/></g></svg></span>
            <label for="telefono">Teléfono</label>
            <input 
                id="telefono"
                type="telefono"
                name="telefono";
                placeholder="Tu Teléfono"
            />
        </div>

        <div class="campo-contacto">
            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink" height="40" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 24 24" width="40" xml:space="preserve"><g id="Icon"><path d="M12,3.25l-5,0c-1.26,-0 -2.468,0.5 -3.359,1.391c-0.891,0.891 -1.391,2.099 -1.391,3.359c0,2.713 0,6.287 0,9c-0,1.26 0.5,2.468 1.391,3.359c0.891,0.891 2.099,1.391 3.359,1.391c2.713,0 6.287,0 9,0c1.26,0 2.468,-0.5 3.359,-1.391c0.891,-0.891 1.391,-2.099 1.391,-3.359c0,-2.404 0,-5 0,-5c0,-0.414 -0.336,-0.75 -0.75,-0.75c-0.414,-0 -0.75,0.336 -0.75,0.75c0,-0 0,2.596 0,5c0,0.862 -0.342,1.689 -0.952,2.298c-0.609,0.61 -1.436,0.952 -2.298,0.952c-2.713,0 -6.287,0 -9,0c-0.862,0 -1.689,-0.342 -2.298,-0.952c-0.61,-0.609 -0.952,-1.436 -0.952,-2.298c0,-2.713 0,-6.287 0,-9c-0,-0.862 0.342,-1.689 0.952,-2.298c0.609,-0.61 1.436,-0.952 2.298,-0.952l5,0c0.414,0 0.75,-0.336 0.75,-0.75c0,-0.414 -0.336,-0.75 -0.75,-0.75Z"/><path d="M7.47,11.227l8.171,-8.172c1.074,-1.073 2.815,-1.073 3.889,0c0.455,0.456 0.959,0.96 1.415,1.415c1.073,1.074 1.073,2.815 -0,3.889c-2.667,2.666 -8.172,8.171 -8.172,8.171c-0.141,0.141 -0.331,0.22 -0.53,0.22l-4.243,0c-0.414,0 -0.75,-0.336 -0.75,-0.75l0,-4.243c-0,-0.199 0.079,-0.389 0.22,-0.53Zm7.287,-5.166l-6.007,6.007l0,3.182l3.182,0l6.007,-6.007l-3.182,-3.182Zm4.243,2.121l0.884,-0.884c0.488,-0.488 0.488,-1.28 -0,-1.768c-0.455,-0.455 -0.959,-0.959 -1.414,-1.414c-0.488,-0.488 -1.28,-0.488 -1.768,0l-0.884,0.884l3.182,3.182Z"/></g></svg></span>
            <label for="mensaje">Mensaje</label>
            <textarea 
                id="mensaje"
                type="mensaje"
                name="mensaje";
                placeholder="Escribe aquí Tu Mensaje"
            ></textarea>
        </div>
        <input type="submit" class="boton" value="ENVIAR"/>
    </form>
</div>

<div class="contenedor-footer-contacto">
    <div class="contenedor-footer-info">
        <h5>INFORMACIÓN</h5>
        <p><b>Tel</b>: 949-21-85-95</p>
        <p><b>Correo</b>: CrossFitRelaño@gmail.com</p>
        <p><b>Dir</b>: C/Francisco de Medina y Mendoza, 7</p>
        <p><b>Ciudad</b>: Cabanillas Del Campo, Guadalajara</p>
    </div>
                      
    <div class="contenedor-footer-horario">
        <p>Horario: L - V</p>
        <ul>
            <ol>L : 08:00 - 22:00</ol>
            <ol>M : 07:00 - 22:00</ol>
            <ol>X : 08:00 - 22:00</ol>
            <ol>J : 07:00 - 22:00</ol>
            <ol>V : 08:00 - 22:00</ol>
            <ol>S : 10:00 - 13:00</ol>
            <ol>D : 10:00 - 13:00</ol>
        </ul>
    </div>
        
    <div class="contenedor-footer-mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3028.504263464891!2d-3.2050499999999995!3d40.618759999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd43acee505efd37%3A0xf0ff8d6afacb51b6!2sC.%20Francisco%20de%20Medina%20y%20Mendoza%2C%207%2C%2019171%20Cabanillas%20del%20Campo%2C%20Guadalajara!5e0!3m2!1ses!2ses!4v1678387970856!5m2!1ses!2ses" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>


<?php 
    include_once __DIR__ . "/../templates/footer.php";

    $script = "<script src='public/build/js/contacto.js'></script>";
?>