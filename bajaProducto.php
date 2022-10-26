<?php
    error_reporting(0);
    include "conexion.php";
    $id = $_GET['id'];
    if(isset($_GET['id'])){
        $sql = "update producto set estatus = NOT estatus where id = '".$id."';";
        mysqli_query($obj_conexion, $sql);
        header("location: productos.php");
    }else{
        header("location:principal.php");
    }
  
?>