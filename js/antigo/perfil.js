
var dadosUsuario = new Object();

$(document).ready(function() {        
   dadosUsuario = JSON.parse(localStorage.getItem("hpUsuario")); // Converte string para objeto
    //localStorage.removeItem("bmLembrar");
   console.log(dadosUsuario);
});


