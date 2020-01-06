var numNoticia = 0;
var erros = [];
var table = "";

$(document).ready(function() {

    table = $('#dtNoticias').dataTable();

    comboCandidato($("#ddlCandidato"));
    comboPartido($("#ddlPartido"));

    $("#btnGravarNoticia").on('click',function(event) {
        event.preventDefault();
        ValidaNoticia();
        if(erros.length == 0){
            GravarNoticia();    
        }else{
           MensagemTela($("#mensagemTela"), erros.join("<br>"),"");
       }
   });

    $("#dtNoticias").on('click', '#btnEditarNoticia', function(event) {
        event.preventDefault();
        numNoticia = $(this).attr('data-id');
        GetNoticias("",numNoticia);
    });

    $("#dtNoticias").on('click', '#btnExcluirNoticia', function(event) {
        event.preventDefault();
        numNoticia = $(this).attr('data-id');
        DeleteNoticia(numNoticia);
    });

    GetNoticias("table", 0);

});

function ValidaNoticia(){
    erros = [];

    if($("#tituloNoticia").val() == ''){
        erros.push("Digite o título.");
    }    
    if($("#autorNoticia").val() == ''){
        erros.push("Digite o autor.");
    }    
    if($("#fonteNoticia").val() == ''){
        erros.push("Digite a fonte.");
    }    
    if($("#descricaoNoticia").val() == ''){
        erros.push("Digite o texto.");
    }    
}

function GetNoticias(tipo, numNoticia) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=BuscarNoticiaADM&numNoticia=" + numNoticia + "",
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


function DeleteNoticia(numNoticia) {    
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=DeleteNoticia&numNoticia="+numNoticia+"",
        dataType: "html",
        success: function(response, status) {
            MensagemTela($("#mensagemTela"), "Noticia excluida com sucesso !", false);
            GetNoticias("table",0);
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



function GravarNoticia() {    

    var numNoticia = $("#numNoticia").val();
    var codCandidato = $("#ddlCandidato option:selected").val();    
    var fonte = $("#fonteNoticia").val();
    var legendaPartido = $("#ddlPartido option:selected").val();
    var texto = $("#descricaoNoticia").val();
    var titulo = $("#tituloNoticia").val();
    var imagem = ($("#imagem").val() != '' ? $("#imagem").val() : '[sem-imagem]'  );
    var autor = $("#autorNoticia").val();

    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=GravarNoticia&numNoticia="+ numNoticia +"&codCandidato=" + codCandidato +"&fonte="+ fonte+"&legendaPartido="+ legendaPartido +"&texto="+ texto +"&titulo="+ titulo +"&imagem="+ imagem +"&autor="+ autor +"",
        dataType: "html",        
        success: function(response, status) {                                
            PopulaFormularioBranco();
            GetNoticias("table",0);
            if(response != 99){
                MensagemTela($("#mensagemTela"), "Dados gravados com sucesso!", true);    
            }else{
                MensagemTela($("#mensagemTela"), "Erro ao gravar dados!", false);    
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
    numNoticia = 0;
    $("#numNoticia").val(0);
    $("#tituloNoticia").val("");    
    $('#ddlCandidato option[value=' + 0 + ']').attr('selected', 'selected').change();    
    $('#ddlPartido option[value=' + 0 + ']').attr('selected', 'selected').change();    
    $("#autorNoticia").val("");
    $("#fonteNoticia").val("");    
    $("#imagem").attr('src', "");    
    $("#descricaoNoticia").val("");    
}

function PopulaFormulario(response){    
    numNoticia = response.numNoticia;
    $("#numNoticia").val(response.numNoticia);
    $("#tituloNoticia").val(response.titulo);    
    $('#ddlCandidato option[value=' + response.codCandidato + ']').attr('selected', 'selected').change();    
    $('#ddlPartido option[value=' + response.legendaPartido + ']').attr('selected', 'selected').change();    
    $("#autorNoticia").val(response.autor);
    $("#fonteNoticia").val(response.fonte);    
    $("#imagem").attr('src', response.caminhoImagem);    
    $("#descricaoNoticia").val(response.texto);    
}


function PopularGrid(response) {
    if ($.fn.DataTable.isDataTable('#dtNoticias')) {
        $('#dtNoticias').DataTable().destroy();
    }

    $('#dtNoticias tbody').empty();

    table = $('#dtNoticias').dataTable({
        dom: '<"top"iBlf>rt<"bottom"ip><"clear">',  
        contentType: "utf-8",         
        data: response,
        columns: [
        { data: "numNoticia" },
        { data: "titulo" },
        { data: "dtNoticia" },
        { data: "texto" },        
        { data: "nomeCandidato" },
        { data: "nomePartidoNoticia" },
        { data: "autor" },
        { data: "fonte" },        
        ],
        columnDefs: [
        {
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<button id="btnEditarNoticia" class="btn btn-success btn-sm" data-id="' + data + '"><i class="fa fa-eye"></i>&nbsp;Editar</button> <button id="btnExcluirNoticia" class="btn btn-danger btn-sm delete-row" data-id="' + data + '"><i class="fa fa-pencil"></i>&nbsp;Excluir</button>';
            }
        },
        {
            'targets': 0,
            'render': function (data, type, full, meta) {
                return ConverteDataNewtonJson(data, 'dmahms');
            }
        },


        ],
        order: [[0, 'asc']]
    });
}


