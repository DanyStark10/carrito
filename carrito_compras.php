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
        $url_estilo = "estilos/carrito_compras.css";
    }
    elseif($tema == "oscuro"){
        $url_estilo = "estilos/oscuros/carrito_compras.css";
    }
    elseif($tema == "claro"){
        $url_estilo = "estilos/claros/carrito_compras.css";
    }
    elseif($tema == "tenue"){
        $url_estilo = "estilos/tenues/carrito_compras.css";
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
            <h2><?php echo $usuario ?></h2>
            <a class="log" id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>
            <h1>Onlyshops</h1>
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
        
        <nav class="container_volver">
            <form method="POST" action="principal.php">
                <input type="hidden" name="usuario" value="alan">
                <input type="hidden" name="contrasenya" value="1234">
                <input type="submit" value="Seguir comprando" class="boton_volver">
            </form>
            
        </nav>

        <?php
            include "conexion.php";
            $usuario = $_SESSION['usuario'];
            $sql = "select carrito.id as id, producto.nombre as nombre, producto.ruta_img as fuente, producto.precio as precio, carrito.cantidad as cantidad from producto, carrito where producto.id = carrito.id_producto and usuario = '".$usuario."'";
            $result = mysqli_query($obj_conexion, $sql);

            $sql_cuenta = "select COUNT(*) as cuenta from carrito where usuario = '".$usuario."'";
            $numArticulos = mysqli_query($obj_conexion, $sql_cuenta);
            while($arrayCuenta = mysqli_fetch_assoc($numArticulos)){
                $cuenta = $arrayCuenta['cuenta'];
            }

            $sql_total='select SUM(carrito.cantidad * producto.precio) as total from producto, carrito where carrito.id_producto = producto.id and usuario = "'.$usuario.'"';
            $resultado_total = mysqli_query($obj_conexion, $sql_total);
            while($arrayTotal = mysqli_fetch_assoc($resultado_total)){
                $total = $arrayTotal['total'];
            }
        ?>

        <div class = "principal">
            
            <div class="encabezado_productos">
                <h3>TU CARRITO (<?php echo $cuenta ?>)</h3>
            </div>
            <?php
                while($fila = mysqli_fetch_assoc($result)){
            ?>
            <div class = "producto">
                <div style="flex-basis: 150px">
                <img  src="<?php echo $fila['fuente']?>" alt=""/>
                </div>
                <div>
                <h2><?php echo $fila['nombre']?></h2>      
                </div>
                <div>
                    <h2>$<?php echo number_format(floatval($fila['precio']),2)?></h2>
                </div> 
                <div>
                    <p>  
                        Cantidad: <?php echo $fila['cantidad']?><br><a class="btn-cantidad" href="cambiarCantidad.php?opc=1&id=<?php echo $fila['id']?>">+</a><a class="btn-cantidad"href="cambiarCantidad.php?opc=2&id=<?php echo $fila['id']?>">-</a></br>
                        <a class="btn_eliminar" href="eliminar_carrito.php?id=<?php echo $fila['id']?>">Eliminar</a>       
                    </p>  
                </div>    
            </div>
            <?php } ?>

            <aside id="resumen">
                    <h2>Subtotal: $<?php echo number_format(floatval($total),2); ?></h2>
                    <h2>Estas ahorrando: $0.00</h2>
                    <h2>Costo de envío: $0.00</h2>
                    <br>
                    <h1>TOTAL: $<?php echo number_format(floatval($total),2); ?></h1>
                    <br>
                    <form action="realizarVenta.php" method="POST">
                    <input type="hidden" name = "total" value = "<?php echo $total ?>">
                    <input type="submit" class="button-add" value="Agregar">
                    </form>
                    
            </aside>

            
        </div>

        <div class="clearfix"></div>

        <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>
    </body>
</html>
