<?php
    error_reporting(0);
    /* $cons_usuario="epiz_31843143";
    $cons_contra="VEJD551fRe";
    $cons_base_datos="epiz_31843143_carrito";
    $cons_equipo="sql307.epizy.com"; */
    $cons_usuario="root";
    $cons_contra="";
    $cons_base_datos="carrito";
    $cons_equipo="localhost";

    $obj_conexion = 
    mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
    if(!$obj_conexion)
    {
        echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
    }
?>