<?php
     error_reporting(0);
 function subirFoto($nombre_foto, $temp){
    $directorio = 'img/';
    $subir_archivo = $directorio.$nombre_foto;
    move_uploaded_file($temp, $subir_archivo);
 }
  
?>