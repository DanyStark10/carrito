<?php
    session_start();
    error_reporting(0);
    include "conexion.php";
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
    <script src= "libreria/plotly-2.1.0.min.js"></script>
    <style> a:link{ text-decoration: none!important; cursor: pointer;}</style>
    <link rel="stylesheet" href= <?php echo $url_estilo ?>>
    <title>Carrito de compras</title>
</head>

<body>
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

    <div style = "font-family: 'Open Sans Condensed', sans-serif; margin:10px; border: 1px solid darkblue; border-radius: 10px; padding: 10px;">
        <h2> CONSULTA TUS ESTADÍSTICAS </h2>
        <form method="POST">
                <input type="radio" name = "tipo" value="1" checked>
                <label>PRODUCTOS MÁS VENDIDOS</label>

                <input type="radio" name = "tipo" value="2" >
                <label>PRODUCTOS MENOS VENDIDOS</label>
               
                <input type="radio" name = "tipo" value="3">
                <label>PRODUCTOS CON MÁS RECAUDACIÓN</label>

                <input type="radio" name = "tipo" value="4">
                <label>PRODUCTOS CON MENOS RECAUDACIÓN</label>
               
                <input type="radio" name = "tipo" value="5">
                <label>CLIENTES CON MÁS PRODUCTOS COMPRADOS</label>
                
                <input type="radio" name = "tipo" value="6">
                <label>CLIENTES CON MAYOR APORTACIÓN</label></br></br>

                <input style="color:white; background:black; padding: 10px"type="submit" value="CONSULTAR"></br></br>
        </form>
    </div>


    <?php
        $tipo = $_POST['tipo'];

        switch($tipo){
            case 1: 
                $sql = "select producto.id, producto.nombre, sum(resumenVenta.cantidad) as cantidad from producto,
                         resumenVenta where resumenVenta.id_producto = producto.id group by producto.id order by (sum(resumenVenta.cantidad)) desc limit ";
                $columna1 = "nombre";
                $columna2 = "cantidad";       
                break;
            case 2: 
                $sql = "select producto.id, producto.nombre, sum(resumenVenta.cantidad) as cantidad from producto,
                            resumenVenta where resumenVenta.id_producto = producto.id group by producto.id order by (sum(resumenVenta.cantidad)) limit ";
                $columna1 = "nombre";
                $columna2 = "cantidad";
                break;
            case 3: 
                $sql = "select producto.id, producto.nombre, resumenVenta.cantidad * producto.precio as total from producto,
                             resumenVenta where producto.id = resumenVenta.id_producto group by producto.nombre order by (resumenVenta.cantidad * producto.precio) desc limit ";
                $columna1 = "nombre";
                $columna2 = "total";
                break;
            case 4: 
                $sql = "select producto.id, producto.nombre, resumenVenta.cantidad * producto.precio as total from producto,
                                resumenVenta where producto.id = resumenVenta.id_producto group by producto.nombre order by (resumenVenta.cantidad * producto.precio)  limit ";
                $columna1 = "nombre";
                $columna2 = "total";
                break;
            case 5: 
                $sql = "select usuario.id, usuario.usuario, sum(resumenVenta.cantidad) as cantidad from usuario, resumenVenta, 
                            venta where usuario.usuario = venta.usuario and venta.id = resumenVenta.id_venta group by usuario.usuario order by(sum(resumenVenta.cantidad)) desc limit ";
                $columna1 = "usuario";
                $columna2 = "cantidad";
                break;
            case 6:
                $sql = "select usuario.id, venta.usuario, sum(venta.total) as total from  venta, 
                            usuario where usuario.usuario = venta.usuario group by usuario order by(sum(venta.total)) desc limit ";
                $columna1 = "usuario";
                $columna2 = "total";
                break;
        }
        
        $result=mysqli_query($obj_conexion, $sql."5");
        $valoresY = array();
        $valoresX = array();

        while($fila = mysqli_fetch_row($result)){
            $valoresY[] = $fila[2];
            $valoresX[] = $fila[1];
        }
        $dataY = json_encode($valoresY);
        $dataX = json_encode($valoresX);

        $result2=mysqli_query($obj_conexion,$sql."10");
    ?>

    <div style = "height: 600px; width: 100%;">
        <div style = "height: 500px; width: 40%; float:left;" id = "cargaBarras"></div>
        <div style = "height: 500px; width: 60%; float:right;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo strtoupper($columna1)?></th>
                        <th><?php echo strtoupper($columna2)?></th>
                    </tr>
                    <tbody>
                        <?php
                            while($filas = mysqli_fetch_assoc($result2)){
                        ?>
                        <tr> 
                            <td><?php echo $filas['id']?></td>
                            <td><?php echo $filas[$columna1]?></td>
                            <td><?php if($tipo == 3 || $tipo == 4 || $tipo == 6){echo "$".number_format(intval($filas[$columna2]),2);}else{ echo $filas[$columna2]; }?></td>
                        </tr>
                    </tbody>

                    <?php  } ?>
                </thead>
            </table>
        </div>
    </div>
   

    

    <footer class="ct blue">© 2022 Shopper All Rights Reserved</footer><br><br><br>

    <script type="text/javascript">
        function crearCadenaBarras(json){
            var parsed =JSON.parse(json);
            var arr = [];
            for(var x in parsed){
                arr.push(parsed[x]);
            }
            return arr; 
        }
    </script>

    <script type="text/javascript">
        datosX = crearCadenaBarras('<?php echo $dataX ?>');
        datosY = crearCadenaBarras('<?php echo $dataY ?>');
        var data = [
        {
            x: datosX,
            y: datosY,
            type: 'bar'
        }
        ];
        Plotly.newPlot('cargaBarras', data);
    </script>
    
    
</body>

</html>