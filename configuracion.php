<?php
    session_start();
    error_reporting(0);
    $usuario = $_SESSION["usuario"];

    if(is_null($usuario)){
        header("location:login.php");
    }

    $tema = $_COOKIE[$usuario . '-mode'];
    $url_estilo = "";

    if($tema == null || $tema == ""){
        $url_estilo = "estilos/estilo_configuracion.css";
    }
    elseif($tema == "oscuro"){
        $url_estilo = "estilos/oscuros/estilo_configuracion.css";
    }
    elseif($tema == "claro"){
        $url_estilo = "estilos/claros/estilo_configuracion.css";
    }
    elseif($tema == "tenue"){
        $url_estilo = "estilos/tenues/estilo_configuracion.css";
    }
?>
<html>
    <head>
        <title>Carrito de compras</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link href=<?php echo $url_estilo ?> rel="stylesheet" type="text/css"/>
        <style> a:link{ text-decoration: none!important; cursor: pointer;}</style>
    </head>
    <body>
        <div class = "page_nav">
            <h2><?php echo $usuario; ?></h2>
            <a class="log" id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>
            <h1>OnlyShops</h1>
        </div>
    
        <div class = "menu_container">
            <ul class = "menu">
                <li><a href="principal.php">Inicio</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="configuracion.php">Configuración</a></li>
                <?php
                if($_SESSION['usuario'] == "admin"){
                    echo '<li><a href="productos.php">Productos</a></li>';
                    echo '<li><a href="gestionUsuarios.php">Gestion de Usuarios</a></li>';
                    echo '<li><a href="estadisticas.php">Estadísticas</a></li>';
                    echo '<li><a href="consultaVentas.php">Ventas</a></li>';
                    echo ' <li><a href="notificaciones.php">Notificaciones</a></li>';
                }
                ?>
            </ul>
        </div>
                <br><br><br>

        <div class="contenido">
                <div class="dark"><button onclick= "aplicar('<?php echo $usuario ?>', 'oscuro')">MODO OSCURO</button></div>
                <div class="light"><button  onclick= "aplicar('<?php echo $usuario ?>', 'claro')">MODO CLARO</button></div>
                <div class="greeen"><button  onclick= "aplicar('<?php echo $usuario ?>', 'tenue')">MODO GREEN</button></div>
                <div class="blu"><button  onclick= "deleteCookie('<?php echo $usuario ?>' + '-mode')">DEFAULT</button></div>
        </div>

        <script src="script/crearCookie.js"></script>
        
       <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>
    </body>
</html>
