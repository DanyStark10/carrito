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
        <h2><?php  echo $_SESSION['usuario']  ?></h2>
        <a class="log" id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>
        <h1>OnlyShops</h1>
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

    <form style="margin-left:10px;"action="agregarProducto.php" method="POST" enctype="multipart/form-data">
        <label>Nombre</label></br>
        <input type="text" name="nombre" required></br>
        <label>Descripcion</label></br>
        <textarea cols="20" rows="10" name="descripcion" style="resize: none;" required></textarea><br>
        <label>Precio</label></br>
        <input type="number" name="precio" step=0.01 min = 1 required></br>
        <label>Cantidad</label></br>
        <input type="number" name = "cantidad" min = 1 pattern= ^\d+$ required></br>
        <label>Foto</label></br>
        <input type="file" name = "foto" accept="image/*" required></br></br>
        <input type="submit"  style="border-radius:10px; margin-left:30px; color:white; background: black; margin-bottom:10px; padding:10px" value = "Agregar">
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>DESCRIPCIÓN</th>
                <th>CANTIDAD</th>
                <th>ESTATUS</th>
                <th>ACCIÓN</th>
            </tr>
            <tbody>
                <?php
                    while($filas = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $filas['id']?></td>
                    <td><?php echo $filas['nombre']?></td>
                    <td>$<?php echo number_format(intval($filas['precio']),2)?></td>
                    <td><?php echo $filas['descripcion']?></td>
                    <td><?php echo $filas['cantidad']?></td>
                    <td><?php if($filas['estatus'] === '1'){echo 'Alta';}else{echo 'Baja';}?></td>
                    <td>
                        <a href="modificarProducto.php?id=<?php echo $filas['id']?>">Modificar</a>/
                        <a href="bajaProducto.php?id=<?php echo $filas['id']?>">Deshabilita-habilita</a>
                    </td>
                </tr>
            </tbody>

            <?php  } ?>
        </thead>
    </table>

    <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>
    
    
</body>

</html>