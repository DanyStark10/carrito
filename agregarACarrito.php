<?php 
    error_reporting(0);
    include "conexion.php";
    session_start();
    $id = $_GET['id'];
    $cantidad = $_GET['cantidad'];
    $usuario = $_SESSION['usuario'];
       
    if($cantidad!=null && $id!=null && $usuario!=null){
        $sql = 'insert into carrito values (null, "'.$id.'", "'.$cantidad.'", "'.$usuario.'");';
        mysqli_query($obj_conexion, $sql);
        if($id = 1){
            header("location:principal.php");
        }
    }else{
        header("location:principal.php");
    }


?>