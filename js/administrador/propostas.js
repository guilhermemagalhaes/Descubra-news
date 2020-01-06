var numProposta = 0;
var erros = [];
var table = "";

$(document).ready(function() {

    table = $('#dtPropostas').dataTable();

    comboCandidato($("#ddlCandidato"));



    $("#btnGravarProposta").on('click',function(event) {
        event.preventDefault();
        ValidaProposta();
        if(erros.length == 0){
            GravarProposta();    
        }else{
         MensagemTela($("#mensagemTela"), erros.join("<br>"),"");
     }
 });

    $("#dtPropostas").on('click', '#btnEditarProposta', function(event) {
        event.preventDefault();
        numProposta = $(this).attr('data-id');
        GetPropostas("",numProposta);
    });

    $("#dtPropostas").on('click', '#btnExcluirProposta', function(event) {
        event.preventDefault();
        numProposta = $(this).attr('data-id');
        DeleteProposta(numProposta);
    });

    GetPropostas("table", 0);

});

function ValidaProposta(){
    erros = [];
    if($("#ddlCandidato").val() == 0){
        erros.push("Selecione o candidato");
    }    
    if($("#descricaoProposta").val() == ''){
        erros.push("Digite a propostas");
    }    
}


function DeleteProposta(numProposta) {    
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PropostasDAO.php?acao=DeleteProposta&numProposta="+numProposta+"",
        dataType: "html",
        success: function(response, status) {
            MensagemTela($("#mensagemTela"), "Proposta excluida com sucesso !", false);
            GetPropostas("table",0);
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


function GravarProposta() {
    numProposta = $("#numProposta").val();
    var codCandidato = $("#ddlCandidato option:selected").val();    
    var descricaoProposta = $("#descricaoProposta").val();
    var imagem = "";
    // var imagem = $("#imagemProposta").val();
    // todo :: upload imagens
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PropostasDAO.php?acao=CadastraProposta&numProposta="+numProposta+"&descricaoProposta="+descricaoProposta+"&imagem="+imagem+"&codCandidato="+codCandidato+"",
        dataType: "html",
        success: function(response, status) {
            PopulaFormularioBranco();
            MensagemTela($("#mensagemTela"), "Dados gravados com sucesso !", true);
            GetPropostas("table",0);
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



function GetPropostas(tipo, numProposta) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PropostasDAO.php?acao=BuscarProposta&numProposta=" + numProposta + "",
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
    numProposta = 0;
    $("#numProposta").val(0);
    $('#ddlCandidato option[value=' + 0 + ']').attr('selected', 'selected').change();    
    $("#imagemProposta").attr('src', "");    
    $("#descricaoProposta").val("");
}

function PopulaFormulario(response){    
    numProposta = response.numProposta;
    $("#numProposta").val(response.numProposta);
    $('#ddlCandidato option[value=' + response.codCandidato + ']').attr('selected', 'selected').change();    
    $("#imagemProposta").attr('src', response.imagemProposta);    
    $("#descricaoProposta").val(response.descricaoProposta);    
}


function PopularGrid(response) {
    if ($.fn.DataTable.isDataTable('#dtPropostas')) {
        $('#dtPropostas').DataTable().destroy();
    }

    $('#dtPropostas tbody').empty();

    table = $('#dtPropostas').dataTable({
        dom: '<"top"iBlf>rt<"bottom"ip><"clear">',  
        contentType: "utf-8",         
        data: response,
        columns: [
        { data: "numProposta" },
        { data: "nomePartido" },
        { data: "nomeCandidato" },
        { data: "descricaoProposta" },
        ],
        columnDefs: [
        {
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<button id="btnEditarProposta" class="btn btn-success btn-xs" data-id="' + data + '"><i class="fa fa-eye"></i>&nbsp;Editar</button> <button id="btnExcluirProposta" class="btn btn-danger btn-xs delete-row" data-id="' + data + '"><i class="fa fa-pencil"></i>&nbsp;Excluir</button>';
            }
        },


        ],
        order: [[0, 'asc']]
    });
}


