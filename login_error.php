<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="estilos/estilo_login_error.css">
</head>

<body>
<?php 
error_reporting(0);
if(is_null($_POST['usuario']) && is_null($_POST['contrasenya'])){
    header('location: login.php');
}

?>
    <div class = "caja_login">
        <img class="foto_usuario" src="img/foto_usuario.png" alt="foto_usuario">
        <h1>Iniciar Sesión</h1>
        <form method="POST" action="principal.php">
            <label for="username">Usuario</label>
            <input type="text" placeholder="Nombre de usuario" name="usuario">
            <label for="password">Contraseña</label>
            <input type="password" placeholder="Ingresa la contraseña" name="contrasenya"> 
            <input type="submit" value="Entrar">
        </form>
    </div>

    <div class = "error_message"> 
        <h3>Error en la autenticación</h3>

    </div>

    <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>
</body>

</html>