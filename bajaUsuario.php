<?php
    error_reporting(0);
    include "conexion.php";
    $id = $_GET['id'];
    if(isset($_GET['id'])){
        $sql = "update usuario set activa = NOT activa where id = '".$id."';";
        mysqli_query($obj_conexion, $sql);
        header("location: gestionUsuarios.php");
    }else{
        header("location:principal.php");
    }
  
?>