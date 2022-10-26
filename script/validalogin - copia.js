/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function limpiar_formulario(){
    let resultado = window.confirm("Seguro que desea reiniciar la captura?");
    
    if (resultado === true){
        document.getElementById("formulario").reset();
    }
}

function mostrarContrasena(){
      var pass = document.getElementById("pass");
      
      if(pass.type === "password"){
          pass.type = "text";
      }else{
          pass.type = "password";
      }
      
 }