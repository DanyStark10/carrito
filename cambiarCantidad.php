<?php
    error_reporting(0);
    include "conexion.php";
    $opc = $_GET['opc'];
    $id = $_GET['id'];


    if(isset($_GET['opc']) && isset($_GET['id'])){
        if($opc == "1"){
            $sql = "update carrito set cantidad =  cantidad + 1 where id = '".$id."';";
        }else{
            $sql = "update carrito set cantidad = cantidad - 1 where cantidad > 1 and id = '".$id."';";
        }
        
        mysqli_query($obj_conexion, $sql);
        header("location: carrito_compras.php");
    }else{
        header("location:principal.php");
    }
   
?>
