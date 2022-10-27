<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="estilos/estilo_login.css">
</head>

<body>
    
    <div class = "caja_login">
        <h1>Iniciar Sesión</h1>
        <script src="script/validalogin.js"></script>
        <form method="POST" action="crear_sesion.php" id="formulario">
            <label for="username">Usuario</label>
            <input type="text" placeholder="Nombre de usuario" name="usuario" class="cl" required>
            <label for="password">Contraseña</label>
            <input type="password" id="pass" placeholder="Ingresa la contraseña" class="cl" name="contrasenya" required> 
            
            <input type="submit" value="Entrar">
            <input type="submit" onclick="limpiar_formulario()" value="Reiniciar">

            <a href="registro.php">¿No tienes una cuenta?</a>
        </form>
    </div>

    <footer class="ct black">© 2022 Shopper cart</footer><br><br><br>
</body>

</html>