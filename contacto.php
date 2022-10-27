<?php
    session_start();
    error_reporting(0);
    $usuario = $_SESSION["usuario"];

    if(is_null($usuario)){
        header("location:login.php");
    }

    $tema = $_COOKIE[$usuario . '-mode'];
    $url_estilo = "";

    if($tema == null || $tema == ""){
        $url_estilo = "estilos/estilo_contacto.css";
    }
    elseif($tema == "oscuro"){
        $url_estilo = "estilos/oscuros/estilo_contacto.css";
    }
    elseif($tema == "claro"){
        $url_estilo = "estilos/claros/estilo_contacto.css";
    }
    elseif($tema == "tenue"){
        $url_estilo = "estilos/tenues/estilo_contacto.css";
    }
?>
<html>
    <head>
        <title>Contacto</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href=<?php echo $url_estilo ?> rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>Contacto</header>
        <nav>
          <a  href ="principal.php">Volver a pagina principal</a>
        </nav>
        
        <section>
        <h1>Shopper</h1>
        <h5>Shopper busca satisfacer las necesidades de compra que tenemos todos, a través de bienes de excelencia, originalidad y calidad. Nuestro modelo de negocio se basa en procesos de comercio electrónico, seguros y eficientes. Contamos con un equipo de trabajo altamente capacitado, con la mejor aptitud de servicio, sentido de la responsabilidad y ética, que busca dar un buen servicio y de calidad en el mejor tiempo posible. La innovación constante nos permite llegar al cliente con eficiencia. «Estamos siempre atentos a tus solicitudes y valoramos tus preguntas»</h5>
        
        <form action="enviarMensajeContacto.php" method="POST" >
            <label>Nombre</label>
            <input type="text" class = "field" name="nombre" placeholder="name" required pattern="[a-zA-Z ]{2,254}" id="nombre"></br>          
            <label >Correo</label>
            <input type="email" class = "field" name="email" placeholder="email" required id="email"></br>
           <!--  <label>Mensaje</label>
            <input type="text" class = "field" name="mensaje" placeholder="mensaje" required id="mens"></br>   -->
            <textarea class = "field" name="mensaje" placeholder="mensaje" required id="mens" cols="25" rows="5"></textarea> <br><br>
            &nbsp;&nbsp;&nbsp;<button type="submit" id="mjs">Enviar</button>
        </form>
        </section>
       
        <aside>
                <hr>
                <h2>Domicilio:</h2>
               
                    <div>
                        <h3>Colonia Centro</h3>
                        <h3>AV. Independencia</h3>
                        <h3>Los Mochis</h3>
                        <h3>CP. 81369</h3>
                    </div>
                <br>
                <hr>
                <h2>Telefono:</h2>
              
                    <div>
                        <h3>6681234567</h3>
                    </div>
                <hr>
                <br>
                <h2>Correo:</h2>
              
                    <div>
                        <h3>@shops.com</h3>
                    </div>
                    
                   
       
            
            <br><br><br>
           
        </aside>
        
    </body>
</html>
