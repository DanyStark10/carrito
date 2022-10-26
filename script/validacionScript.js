
//Cada uno de los input del HTML tiene un identificador (id). El atributo required de la etiqueta especifica que es un campo obligatorio.
//El atributo pattern representa la expresión regular la cual debe cumplirse, si no se cumple se considera "invalid".

//En el archivo CSS se encuentra el diseño que adoptarán los cuadros de texto (input) en caso de que sean invalid. 
//  Esto se puede notar viendo la etiqueta input:invalid en CSS.
//      Las características que adoptarán los input en caso de estar vacíos se pueden ver dentro de la etiqueta input:invalid:required del CSS. 

//Dentro de JavaScript, el atributo de inválido se representa con .oninvalid. Así que primero se asigna un objeto del HTML a una variable
//  como en el ejemplo de abajo y dicha variable puede representar ya sea .onvalid (válido) o .oninvalid (inválido). En el ejemplo de abajo si la variable
//      input a la cual se le asignó el objeto edad es inválido, entonces mostrará una alerta con la palabra "Hola" (Obviamente esto deberá
//          cambiarse a lo que el profesor pide). 

var input = document.getElementById('edad');
//input.oninvalid = alert("hola");

function limpiar_formulario(){
    let resultado = window.confirm("Seguro que desea volver al menú principal?");
    
    if (resultado === true){
        document.getElementById("registro").reset();
    }
}

function cerrar_formulario(){
    let resultado = window.confirm("Seguro que desea cancelar el registro y volver al menú principal?");
    
    if (resultado === true){
        location.href = '';
    }
}

//Crea un bojeto del tipo input del documento y modifica el atributo type
function mostrarContrasena(){
      var pass = document.getElementById("pass");
      var cpass = document.getElementById("confirmpass");
      let pass_value =document.getElementById("pass").value;
      let cpass_value = document.getElementById("confirmpass").value;
      if(pass.type === "password" || cpass.type === "password"){
          pass.type = "text";
          cpass.type = "text";
      }else{
          pass.type = "password";
          cpass.type = "password";
      }
      
      if (pass_value !== "" || cpass_value !== ""){
        alert("Contraseña descifrada: " + pass_value);  
        cipher();
      }
  }
  
  function validar_opciones(){
      //Valores
      let nombre = document.getElementById("nombre").value;
      let edad = document.getElementById("edad").value;
      let email = document.getElementById("email").value;
      let usuario = document.getElementById("user").value;
      let pass = document.getElementById("pass").value;
      let confirm_pass = document.getElementById("confirmpass").value;
      
      let faltan_datos = false;
      
      if (nombre === "" || edad === "" || email === "" || usuario === "" || pass === "" || confirm_pass === ""){
          faltan_datos = true;
      }
      
      if (faltan_datos === true) {
          alert("Aun faltan datos por llenar");
      }else{
          alert("Registrado con exito");
      }
  }
  
  function pass_correcto(){
      let confirm_pass = document.getElementById("confirmpass").value;
      let pass = document.getElementById("pass").value;
      if (pass === confirm_pass) {
          alert("Las contraseñas coinciden");
      }else{
          alert("Error, las contraseñas no coinciden");
          document.getElementById("confirmpass").value = "";
      }
  } 
  
  function cipher (){
	
	var newTxt = ""; 
	var txt = document.getElementById("pass").value;

		for (var i =0; i < 26; i++){

				var findLetter = txt.charCodeAt(i);						// Obtiene el código ASCII de las letras del texto.
				if ((findLetter >= 65) && (findLetter <= 90)){			// Si son mayúsculas
					findLetter = (((findLetter-65)+33)%26) + 65;		// Aplica la fórmula (x + n) % 26.
					newTxt += String.fromCharCode(findLetter);			// Obtiene la letra en las posiciones halladas.
				}

				if ((findLetter >= 97) && (findLetter <= 122)){			// Si son minúsculas
					findLetter = (((findLetter-97)+33)%26) + 97;		// Aplica la fórmula (x + n) % 26.
					newTxt += String.fromCharCode(findLetter);			// Obtiene la letra en las posiciones halladas.
				}														
				
				if (txt[i] === " "){										// Muestra los mismos espacios vacios
					newTxt += " ";
				}
				
		}
		alert ("El texto cifrado es: " + newTxt);
                
}

function decipher (){
	
	var newTxt = ""; 
	var txt = document.getElementById("pass").value;

		for (var j =0; j < 26; j++){

				var findLetter = txt.charCodeAt(j);						// Obtiene el código ASCII de las letras del texto.
				if ((findLetter >= 65) && (findLetter <= 90)){			// Si son mayúsculas
					findLetter = (((findLetter-65)-7+52)%26) + 65;		// Aplica la fórmula (x + n) % 26.
					newTxt += String.fromCharCode(findLetter);			// Obtiene la letra en las posiciones halladas.
				}

				if ((findLetter >= 97) && (findLetter <= 122)){			// Si son minúsculas
					findLetter = (((findLetter-97)-7+52)%26) + 97;		// Aplica la fórmula (x + n) % 26.
					newTxt += String.fromCharCode(findLetter);			// Obtiene la letra en las posiciones halladas.
				}
				
				if (txt[j] === " "){										// Muestra los mismos espacios vacios
					newTxt += " ";
				}	
		}
		alert ("El texto cifrado es: " + newTxt);
}