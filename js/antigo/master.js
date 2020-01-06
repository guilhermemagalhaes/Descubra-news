

$(document).ready(function() {    
    GetDados();
});

function GetDados() { 
    $.ajax({
        type: "POST",
        url: "/helpme/src/controllers/NoticiaDAO.php?acao=BuscarNoticia",
        dataType : "json",              
        success: function (response, status) {                           
            localStorage.setItem('hpUsuario', JSON.stringify(response));
        },
        failure: function (response) {
            alert("Erro ao buscar dados")
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status)
            alert(thrownError)
        }
    });
}


