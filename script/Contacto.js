

function validarEmail(elemento){

  var texto = document.getElementById(elemento.id).value;
  var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  
  if (!regex.test(texto)) {
      document.getElementById("resultado").innerHTML = "Correo invalido";
  } else {
    document.getElementById("resultado").innerHTML = "";
  }
}

function validar_opciones(){
      //Valores
      let nombre = document.getElementById("nombre").value;
      let email = document.getElementById("email").value;
      let mens = document.getElementById("mens".value);
      let faltan_datos = false;
      
      if (nombre === ""|| email === "" || mens === ""){
          faltan_datos = true;
      }
      
      if (faltan_datos === true) {
          alert("Aun faltan datos por llenar");
      }else{
          alert("Mensaje enviado con exito");
      }
  }