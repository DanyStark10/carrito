<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <title>Contenedor de tareas</title>
        <link rel="stylesheet" href = "estilos/estilo_validacion.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <p id="titulo">Regístrate</p>

        <a href="login.php">Volver</a>
        
        <form method="POST" id="registro" action="crear_usuario.php">
            
            <p>Nombre de usuario*</p>
            <input type="text" class = "field" name = "usuario" placeholder="Nombre de usuario" required pattern ="[a-zA-Z0-9]{5,100}" id="user"><br/>
            
            <p title="La contraseña debe contener de 8 a 18 caracteres, una mayúscula, una minúscula y un caracter especial" class="titulo">Contraseña* (?)</p>
            <input type="password" class = "field" name = "contrasenya" placeholder="Contraseña" required  id = "pass"><br/>
            

            <p class="center_content">
                <input type="submit" class="btn btn_blue" value = "Registrarme">
            </p>

        </form>

     <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>

    </body>
</html>