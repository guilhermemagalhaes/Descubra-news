var idUsuario = 0;
var erros = [];
var table = "";

$(document).ready(function() {

    table = $('#dtUsuario').dataTable();

    $("#btnGravarUsuario").on('click',function(event) {
        event.preventDefault();
        ValidaUsuario();
        if(erros.length == 0){
            GravarUsuario();    
        }else{
         MensagemTela($("#mensagemTela"), erros.join("<br>"),"");
        }

    });

    $("#dtUsuario").on('click', '#btnEditarUsuario', function(event) {
        event.preventDefault();
        idUsuario = $(this).attr('data-id');
        GetUsuarios("",idUsuario);
    });

    $("#dtUsuario").on('click', '#btnExcluirUsuario', function(event) {
        event.preventDefault();
        idUsuario = $(this).attr('data-id');
        DeleteUsuario(idUsuario);
    });

    GetUsuarios("table", 0);

});

function ValidaUsuario(){
    erros = [];
    if($("#nomeUsuario").val() == ''){
        erros.push("Digite o nome");
    }
    if($("#emailUsuario").val() == ''){
        erros.push("Digite o e-mail");
    }
    if($("#senhaUsuario").val() == ''){
        erros.push("Digite a senha");
    }
}


function DeleteUsuario(idUsuario) {
    console.log(idUsuario);
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/UsuarioDAO.php?acao=DeleteUsuario&idUsuario="+idUsuario+"",
        dataType: "html",
        success: function(response, status) {
            MensagemTela($("#mensagemTela"), "Usuario excluido com sucesso !", false);
            GetUsuarios("table",0);
        },
        failure: function(response) {
            alert("Erro ao buscar dados")
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status)
            alert(thrownError)
        }
    });
}


function GravarUsuario() {
    idUsuario = $("#idUsuario").val();
    var nome = $("#nomeUsuario").val();
    var email = $("#emailUsuario").val();
    var senha = $("#senhaUsuario").val();
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/UsuarioDAO.php?acao=CadastraUsuario&nome="+nome+"&email="+email+"&senha="+senha+"&idUsuario="+idUsuario+"",
        dataType: "html",
        success: function(response, status) {
            PopulaFormularioBranco();
            MensagemTela($("#mensagemTela"), "Dados gravados com sucesso !", true);
            GetUsuarios("table");
        },
        failure: function(response) {
            alert("Erro ao buscar dados")
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status)
            alert(thrownError)
        }
    });
}



function GetUsuarios(tipo, idUsuario) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/UsuarioDAO.php?acao=BuscarUsuarios&idUsuario=" + idUsuario + "",
        dataType: "json",
        success: function(response, status) {
            if(tipo == "table"){
                PopularGrid(response);      
            }else{
                PopulaFormulario(response[0]);
            }
        },
        failure: function(response) {
            alert("Erro ao buscar dados")
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status)
            alert(thrownError)
        }
    });
}

function PopulaFormularioBranco(){
    idUsuario = 0;
    $("#idUsuario").val("");
    $("#nomeUsuario").val("");
    $("#emailUsuario").val("");
    $("#senhaUsuario").val("");
}

function PopulaFormulario(response){
    idUsuario = response.idUsuario;
    $("#idUsuario").val(response.idUsuario);
    $("#nomeUsuario").val(response.nomeUsuario);
    $("#emailUsuario").val(response.email);
}


function PopularGrid(response) {
    if ($.fn.DataTable.isDataTable('#dtUsuario')) {
        $('#dtUsuario').DataTable().destroy();
    }

    $('#dtUsuario tbody').empty();

    table = $('#dtUsuario').dataTable({
        dom: '<"top"iBlf>rt<"bottom"ip><"clear">',  
        contentType: "utf-8",         
        data: response,
        columns: [
        { data: "idUsuario" },
        { data: "nomeUsuario" },
        { data: "email" },           
        ],
        columnDefs: [
        {
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<button id="btnEditarUsuario" class="btn btn-success btn-xs" data-id="' + data + '"><i class="fa fa-eye"></i>&nbsp;Editar</button> <button id="btnExcluirUsuario" class="btn btn-danger btn-xs delete-row" data-id="' + data + '"><i class="fa fa-pencil"></i>&nbsp;Excluir</button>';
            }
        },


        ],
        order: [[0, 'asc']]
    });
}


