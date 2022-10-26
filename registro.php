<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <title>Contenedor de tareas</title>
        <link rel="stylesheet" href = "estilos/estilo_validacion.css"/>
        <link rel="stylesheet" href = "estilos/estilo_validacion.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <p id="titulo">Regístrate</p>

        <a href="login.php">Regresar</a>
        <form action= "crear_usuario.php" method = "POST">
            <p>Nombre*</p>
            <input type="text" class = "field"name="nombre" placeholder="Nombre" required pattern="[a-zA-Z ]{2,254}" id="nombre"><br/> 
            
            <p>Edad*</p>
            <input type="number" class = "field" name="edad" placeholder="Edad" required min = "18" max = "99" id = "edad"><br/>
            
            <p>Email*</p>
            <input type="email" class = "field" name = "email" placeholder="Correo electrónico" required id="email"><br/>
            
            <p>Nombre de usuario*</p>
            <input type="text" class = "field" name = "usuario" placeholder="Nombre de usuario" required pattern ="[a-zA-Z0-9]{5,100}"id="email"><br/>
            
            <p title="La contraseña debe contener de 8 a 18 caracteres, una mayúscula, una minúscula y un caracter especial">Contraseña* ?</p>
            <input type="password" class = "field" name = "contrasenya" placeholder="Contraseña" required pattern = "(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,18}" id = "passwd"><br/>
            
            <p>Confirma tu contraseña</p>
            <input type="password" class = "field" name = "ConfirmContrasenya" placeholder="Confirma tu contraseña" required id = "Confirmpasswd"><br/>
            <br/>

            <p class="center_content">
                <input type="submit" class="btn btn-blue" value = "Registrarme">
            </p>

        </form>
     <script src="validacionScript.js"></script>
    </body>
</html>