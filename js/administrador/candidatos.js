var codCandidato = 0;
var erros = [];
var table = "";

$(document).ready(function() {

    table = $('#dtCandidato').dataTable();

    comboPartido($("#ddlPartido"));

    $("#btnGravarCandidato").on('click',function(event) {
        event.preventDefault();
        ValidaCandidato();
        if(erros.length == 0){
            GravarCandidato();    
        }else{            
            MensagemTela($("#mensagemTela"), erros.join("<br>"),"");
        }

    });

    $("#dtCandidato").on('click', '#btnEditarCandidato', function(event) {
        event.preventDefault();
        codCandidato = $(this).attr('data-id');
        GetCandidatos("",codCandidato);
    });

    $("#dtCandidato").on('click', '#btnExcluirCandidato', function(event) {
        event.preventDefault();
        codCandidato = $(this).attr('data-id');
        DeleteCandidato(codCandidato);
    });

    GetCandidatos("table", 0);

});

function ValidaCandidato(){
    erros = [];
    if($("#nomeCandidato").val() == ''){
        erros.push("Digite o nome.");
    }
    if($("#dtNascimentoCandidato").val() == ''){
        erros.push("Digite a data de nascimento.");
    }
    if($("#ddlPartido option:selected").val() == 0){
        erros.push("Selecione o partido.");
    }
    if ($("#bioCandidato").val() == '') {
        erros.push("Descreva a biografia.")
    }
}


function DeleteCandidato(codCandidato) {    
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/CandidatoDAO.php?acao=DeleteCandidato&codCandidato="+codCandidato+"",
        dataType: "html",
        success: function(response, status) {
            MensagemTela($("#mensagemTela"), "Candidato excluido com sucesso !", false);
            GetCandidatos("table",0);
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


function GravarCandidato() {

    codCandidato = $("#codCandidato").val()    
    var nomeCandidato = $("#nomeCandidato").val();
    var dataNascimento = dataInvertida($("#dtNascimentoCandidato").val());
    var legendaPartido = $('#ddlPartido option:selected').val();
    var imagem = $("#imagemCandidato").val();
    var biografia = $("#bioCandidato").val();


    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/CandidatoDAO.php?acao=CadastraCandidato&codCandidato="+codCandidato+"&nomeCandidato="+nomeCandidato+"&dataNascimento="+dataNascimento+"&legendaPartido="+legendaPartido+"&imagem="+ imagem +"&biografia=" + biografia +"",
        dataType: "html",
        success: function(response, status) {
            PopulaFormularioBranco();
            MensagemTela($("#mensagemTela"), "Dados gravados com sucesso !", true);
            GetCandidatos("table", 0);
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

function GetCandidatos(tipo, codCandidato) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/CandidatoDAO.php?acao=BuscarCandidato&codCandidato=" + codCandidato + "",
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
    codCandidato = 0;
    $("#codCandidato").val(0);
    $("#nomeCandidato").val("");
    $("#dtNascimentoCandidato").val("");
    $('#ddlPartido option[value=' + 0 + ']').attr('selected', 'selected').change();    
    $("#imagemCandidato").val("");
    $("#bioCandidato").val("");    
}

function PopulaFormulario(response){
    codCandidato = response.codCandidato;
    $("#codCandidato").val(response.codCandidato);
    $("#nomeCandidato").val(response.nomeCandidato);
    $("#dtNascimentoCandidato").val(ConverteDataNewtonJson(response.dtNascto,'dma'));
    $('#ddlPartido option[value=' + response.legendaPartido + ']').attr('selected', 'selected').change();    
    $("#imagemCandidato").attr('src', response.caminhoImagem);
    $("#bioCandidato").val(response.biografia);    
}

function PopularGrid(response) {
    if ($.fn.DataTable.isDataTable('#dtCandidato')) {
        $('#dtCandidato').DataTable().destroy();
    }

    $('#dtCandidato tbody').empty();
    table = $('#dtCandidato').dataTable({
        dom: '<"top"iBlf>rt<"bottom"ip><"clear">',  
        contentType: "utf-8",         
        data: response,
        columns: [
        { data: "codCandidato" },
        { data: "nomeCandidato" },
        { data: "nomePartido" },           
        { data: "dtNascto" },           
        { data: "biografia" },           
        ],
        columnDefs: [
        {
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {                
                return '<button id="btnEditarCandidato" class="btn btn-success btn-xs" data-id="' + data + '"><i class="fa fa-eye"></i>&nbsp;Editar</button> <button id="btnExcluirCandidato" class="btn btn-danger btn-xs delete-row" data-id="' + data + '"><i class="fa fa-pencil"></i>&nbsp;Excluir</button>';
            }
        },
        {
            'targets': 3,
            'render': function (data, type, full, meta) {                
                return ConverteDataNewtonJson(data,"dma");
            }
        },
        ],
        order: [[0, 'asc']]
    });
}


