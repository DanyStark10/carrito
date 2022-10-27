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
        $sql = "select * from usuario";
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

    <form style="margin-left:10px"action="agregarUsuario.php" method="POST" enctype="multipart/form-data">
        <label>Nombre</label></br>
        <input type="text" name="nombre" required pattern="[a-zA-Z ]{2,254}"></br>
        <label>Edad</label></br>
        <input type="number" name="edad" min = 18 max = 99 required></br>
        <label>Email</label></br>
        <input type="email" name="email"  required></br>
        <label>Usuario</label></br>
        <input type="text"  name = "usuario" required pattern ="[a-zA-Z0-9]{5,100}"></br>
        <label title="La contraseña debe contener de 8 a 18 caracteres, una mayúscula, una minúscula y un caracter especial" >Contraseña</label></br>
        <input type="password" name = "contrasenya"  required pattern = "(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,18}"></br></br>
        <input type="submit" style="border-radius:10px; margin-left:30px; color:white; background: black; margin-bottom:10px; padding:10px" value = "Agregar">
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>EDAD</th>
                <th>EMAIL</th>
                <th>USUARIO</th>
                <th>CONTRASEÑA</th>
                <th>ACTIVA</th>
                <th>ACCIÓN</th>
            </tr>
            <tbody>
                <?php
                    while($filas = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $filas['id']?></td>
                    <td><?php echo $filas['nombre']?></td>
                    <td><?php echo $filas['edad']?></td>
                    <td><?php echo $filas['email']?></td>
                    <td><?php echo $filas['usuario']?></td>
                    <td><?php echo $filas['pswd']?></td>
                    <td><?php echo $filas['activo']?></td>
                    <td>
                        <a href="modificarUsuario.php?id=<?php echo $filas['id']?>">Modificar</a>/
                        <a href="bajaUsuario.php?id=<?php echo $filas['id']?>">Deshabilita-habilita</a>
                    </td>
                </tr>
            </tbody>

            <?php  } ?>
        </thead>
    </table>

    <form action="reporteUsuarios.php" method="POST">
        <input type="hidden" name="nombreReporte" value="reporte.txt">
        <input type="submit" style="border-radius:10px; background: white; color: black; font-weight: bold; padding: 10px; width: 500px; margin-left: calc(50% - 250px); margin-top: 10px;" value="Generar reporte">
    </form>

    <footer class="ct blue">© 2022 Shopper All Rights Reserved</footer><br><br><br>
    
    
</body>

</html>