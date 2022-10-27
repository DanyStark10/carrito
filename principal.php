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
        $url_estilo = "estilos/estilo_principal.css";
    }
    elseif($tema == "oscuro"){
        $url_estilo = "estilos/oscuros/estilo_principal.css";
    }
    elseif($tema == "claro"){
        $url_estilo = "estilos/claros/estilo_principal.css";
    }
    elseif($tema == "tenue"){
        $url_estilo = "estilos/tenues/estilo_principal.css";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <style> a:link{ text-decoration: none!important; cursor: pointer;}</style>
    <title>Carrito de compras</title>
    <link rel="stylesheet" href= <?php echo $url_estilo ?>>
</head>

<body>

    <?php
        include "conexion.php";
        $sql = "select * from producto";
        $result = mysqli_query($obj_conexion, $sql);
    ?>

    <div class = "page_nav">
        <h2><?php  echo $_SESSION['usuario']?></h2>
        <a class="log" id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>
        <h1>Shopper</h1>
        <a href="carrito_compras.php">
            <img src="img/carrito.png" alt="">
        </a>
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

    <div class="clearfix"></div>
                <div style="width: 420px; margin-left: auto; margin-right: auto;" class="">
                    
                    <input type="text" id="search" placeholder="Search"> &nbsp;Buscar
                </div>
    <div class = "contenedor_principal">
        <?php
            while($filas = mysqli_fetch_assoc($result)){
                if($filas['estatus'] == "1"){
        ?>
        <div class = "contenedor_producto">
            <h3><?php echo $filas['nombre']?></h3>
            <img src=<?php echo $filas['nombre_foto']?> alt="">
            <h1>$<?php echo number_format(intval($filas['precio']))?></h1>

            <form action="agregarACarrito.php">
            <input type="hidden" name="id" value="<?php echo $filas['id']?>">
            <label>Cantidad</label>
            <input type="number" name="cantidad" value="1" style ="width: 40px" required min = 1 max = 30>
            <input type="submit" class="button-add" value="Agregar">
            </form>

        </div>
        
        <?php } }?>
    </div>
    <footer class="ct blue">© 2022 Shopper cart</footer><br><br><br>
</body>

</html>