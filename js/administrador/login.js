$("#btn-entrar").on('click', function(event) {
	event.preventDefault();    
    ValidaLogin()
    if (erros.length == 0) {        
        Logar();    
    }else{
        ErrosLogin();            
    }

});
function ValidaLogin(){
    erros = [];
    login = $('#input-login');
    senha = $('#input-senha');    
    if(login.val() == ""){        
        erros.push("Informe o email");
    }
    if(senha.val() == ""){        
        erros.push("Informe a senha");
    }    
}

function ErrosLogin(){
    $("#mensagem-erro").empty();
    var html = "";
    html = '<div class="alert alert-danger" role="alert">'+
    erros.join("<br>") +
    '</div>';
    $("#mensagem-erro").css("display", "block");
    $("#mensagem-erro").append(html);
}


function Logar() {    
    login = $('#input-login');
    senha = $('#input-senha');        
    $.post("/descubranews/src/controllers/UsuarioDAO.php?acao=autenticar", {login: login.val(), senha: senha.val()}, 
      function(retorno){
      console.log(retorno);  
        if(retorno != 99){
            window.location.assign("../administrador/painel.php?view=home");                
        }else{            
            erros.push("Erro ao efetuar o login. Dados incorretos!");   
            ErrosLogin();
        }        
      } //function(retorno)
    ); //$.post()
}

