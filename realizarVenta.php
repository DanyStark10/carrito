<?php 
    error_reporting(0);
        session_start();
        include "conexion.php";
        $total = $_POST['total'];
         $sql = "select producto.cantidad as p_cantidad, carrito.cantidad as c_cantidad from producto, carrito where producto.id = carrito.id_producto and usuario='".$_SESSION['usuario']."'";
         $result = mysqli_query($obj_conexion, $sql);
         $bandera = 1;
         while($fila = mysqli_fetch_assoc($result)){
             if(intval($fila['p_cantidad']) < intval($fila['c_cantidad'])){
                 $bandera = 0;
             }
         }

         if($bandera == 1 && $total != null){
            $sql = "insert into venta values (null, '".$total."', '".$total."','".$_SESSION['usuario']."', NOW());";
            $result = mysqli_query($obj_conexion, $sql);

            $sql = "select max(id) as id from venta";
            $result = mysqli_query($obj_conexion, $sql);
            if ($row = mysqli_fetch_row($result)) 
            {
              $lastId = trim($row[0]);
            }

            $sql = "select producto.id as pid, carrito.id as id, producto.nombre as nombre, producto.precio as precio, carrito.cantidad as cantidad, producto.precio * carrito.cantidad as subtotal from producto, carrito where producto.id = carrito.id_producto and usuario = '".$_SESSION['usuario']."'";
            $result = mysqli_query($obj_conexion, $sql);
         
         }elseif($total == null){
           header("location:carrito_compras.php");
         }else{
           header("location:venta_rechazada.php?id=1");
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
    <link href="estilos/realizarVentaStyle.css" rel="stylesheet" type="text/css"/>
    <title>Resultados</title>
</head>

<body>
    
    <h1>GRACIAS POR TU COMPRA</h1>
    <table>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>SUBTOTAL</th>
            </tr>
            <tbody>
                <?php
                
                    while($filas = mysqli_fetch_assoc($result)){
                    $insertResumen = "insert into resumenVenta values (null, '".$lastId."', '".$filas['pid']."', '".$filas['cantidad']."');";
                    $resultado = mysqli_query($obj_conexion, $insertResumen);
                    $reducirSql = "update producto set cantidad = cantidad - ".$filas['cantidad']." where id = '".$filas['pid']."'";
                    $resultado = mysqli_query($obj_conexion, $reducirSql);
                    $borrarSql = "delete from carrito where id = '".$filas['id']."'";
                    $resultado = mysqli_query($obj_conexion, $borrarSql);
                    
                ?>
                <tr>
                    <td><?php echo $filas['nombre']?></td>
                    <td>$<?php echo number_format(intval($filas['precio']),2)?></td>
                    <td><?php echo $filas['cantidad']?></td>
                    <td>$<?php echo number_format(intval($filas['subtotal']),2)?></td>
                </tr>
            </tbody>

            <?php  } ?>
        </thead>
    </table>    

    <h1>PAGO TOTAL: $<?php echo number_format(intval($total),2)?></h1>

    <a href="principal.php">VOLVER A PÁGINA PRINCIPAL</a>
    
</body>

</html>