var legendaPartido = 0;
var erros = [];
var table = "";

$(document).ready(function() {

    table = $('#dtPartidos').dataTable();

    $("#btnGravarPartido").on('click',function(event) {
        event.preventDefault();
        ValidaPartido();
        if(erros.length == 0){
            GravarPartido();    
        }else{
         MensagemTela($("#mensagemTela"), erros.join("<br>"),"");
        }

    });

    $("#dtPartidos").on('click', '#btnEditarPartido', function(event) {
        event.preventDefault();
        legendaPartido = $(this).attr('data-id');
        GetPartidos("",legendaPartido);
    });

    $("#dtPartidos").on('click', '#btnExcluirPartido', function(event) {
        event.preventDefault();
        legendaPartido = $(this).attr('data-id');
        DeletePartido(legendaPartido);
    });

    GetPartidos("table", 0);

});

function ValidaPartido(){
    erros = [];
    if($("#legendaPartido").val() == ''){
        erros.push("Digite a legenda do partido");
    }    
}


function DeletePartido(legendaPartido) {    
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PartidosDAO.php?acao=DeletePartido&legendaPartido="+legendaPartido+"",
        dataType: "html",
        success: function(response, status) {
            MensagemTela($("#mensagemTela"), "Partidos excluido com sucesso !", false);
            GetPartidos("table",0);
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


function GravarPartido() {
    legendaPartido = $("#idLegenda").val();
    var nomePartido = $("#legendaPartido").val().toUpperCase();    
    var imagem = "";
    // var imagem = $("#imagemPartido").val();
    // todo :: upload imagens
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PartidosDAO.php?acao=CadastraPartido&legendaPartido="+legendaPartido+"&nomePartido="+nomePartido+"&imagem="+imagem+"",
        dataType: "html",
        success: function(response, status) {
            PopulaFormularioBranco();
            MensagemTela($("#mensagemTela"), "Dados gravados com sucesso !", true);
            GetPartidos("table",0);
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



function GetPartidos(tipo, legendaPartido) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PartidosDAO.php?acao=BuscarPartidos&legendaPartido=" + legendaPartido + "",
        dataType: "json",
        success: function(response, status) {
            console.log(response)
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
    legendaPartido = 0;
    $("#idLegenda").val("");
    $("#legendaPartido").val("");
    $("#imagemPartido").attr('src', '');
    
}

function PopulaFormulario(response){
    legendaPartido = response.legendaPartido;
    $("#idLegenda").val(response.legendaPartido);
    $("#legendaPartido").val(response.nomePartido);
    $("#imagemPartido").attr('src', response.caminhoImagemPartido);    
}


function PopularGrid(response) {
    if ($.fn.DataTable.isDataTable('#dtPartidos')) {
        $('#dtPartidos').DataTable().destroy();
    }

    $('#dtPartidos tbody').empty();

    table = $('#dtPartidos').dataTable({
        dom: '<"top"iBlf>rt<"bottom"ip><"clear">',  
        contentType: "utf-8",         
        data: response,
        columns: [
        { data: "legendaPartido" },
        { data: "nomePartido" },
        ],
        columnDefs: [
        {
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<button id="btnEditarPartido" class="btn btn-success btn-xs" data-id="' + data + '"><i class="fa fa-eye"></i>&nbsp;Editar</button> <button id="btnExcluirPartido" class="btn btn-danger btn-xs delete-row" data-id="' + data + '"><i class="fa fa-pencil"></i>&nbsp;Excluir</button>';
            }
        },


        ],
        order: [[0, 'asc']]
    });
}


