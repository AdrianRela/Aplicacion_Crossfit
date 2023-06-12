<header class="header">
    <div class="div-header-logo">
        <span class="logo">CROSSFIT RELAÑO</span>
    </div>

    <div class="div-header-logo">
        <a href="http://localhost/AppCrossfit/dashboard"><img src="public/build/img/Logo3.png" alt="Logo" height="150"></a>
    </div>

    <div class="div-header-usuario">
        <div class="row">
            <p class="welcome">Bienvenido, <?php if(isset($nombre)) echo $nombre ?></p>
        </div>
        <div class="row">
            <form action="/AppCrossfit/logout" method = "GET">
                <button type="submit" class="desconectar-button">Desconectar</button>
            </form>
        </div>
    </div>
</header>

<nav class="tabs">
    <a href="http://localhost/AppCrossfit/tarifa">Tarifas</a>
    <a href="http://localhost/AppCrossfit/dashboard-horarios">Horarios</a>
    <a href="http://localhost/AppCrossfit/dashboard-resultados">Resultados</a>
    <a href="http://localhost/AppCrossfit/dashboard-misdatos">Mis Datos</a>
    <a href="http://localhost/AppCrossfit/dashboard-contacto">Contacto</a>
</nav>