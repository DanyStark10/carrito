<?php
    error_reporting(0);
    include "conexion.php";
    $id = $_GET['id'];

    if(isset($_GET['id'])){
        $sql = "delete from carrito where id = '".$id."'";
        mysqli_query($obj_conexion, $sql);
        header("location: carrito_compras.php");
    }else{
        header("location:principal.php");
    }
    
?>