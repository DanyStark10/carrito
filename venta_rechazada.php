<?php
    error_reporting(0);
    $id = $_GET['id'];

    if(isset($id)){

    }else{
        header("location:carrito_compras.php");
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
    <link rel="stylesheet" href="estilos/estilo_ventaRechazada.css">
    <title>Rechazada</title>
</head>

<body>
    
    <h1>LO SENTIMOS</h1>
    <p>EN ESTE MOMENTO NO CONTAMOS CON LAS UNIDADES SUFICIENTES PARA CONCRETAR LA COMPRA</p>
    <p>REDUZCA LA CANTIDAD DE ELEMENTOS EN SU CARRITO O CONSIDERE POSPONER SU COMPRA</p>
    <p>¡SURTIMOS NUESTRA TIENDA CADA DÍA PRIMERO DEL MES!</p>
    <p>GRACIAS POR SU COMPRENSIÓN</p>

    <a href="carrito_compras.php">Volver</a>
   
    
</body>

</html>