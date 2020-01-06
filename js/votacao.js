$(document).ready(function() {
    GetCandidatos(0);


    $(document).on('click', "#insereVotacao", function(e){
        var codCandidato = $(this).attr('data-id');
        InsereVotacao(codCandidato);
    });

});

function InsereVotacao(codCandidato) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/VotacaoDAO.php?acao=InsereVotacao&codCandidato=" + codCandidato + "",
        dataType: "html",
        success: function(response, status) {       
            MensagemTela($("#mensagemTela"),'Voto computado com suceeso', true);

            if(response[0].status == 'true'){
                
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


function GetCandidatos(codCandidato) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/CandidatoDAO.php?acao=BuscarCandidato&codCandidato=" + 0 + "",
        dataType: "json",
        success: function(response, status) {       
            if(response != 99){
                PopulaCandidato(response)   ;
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


function PopulaCandidato(response){  
    var html = '';    
    for (var i = 0; i < response.length; i++) {        
        html += '<a id="insereVotacao" data-id="'+response[i].codCandidato+'"><div class="wrapper">'+
        '<div class="hovereffect" > <img class="img-responsive" src="'+response[i].caminhoImagem+'" > '+
        '<div class="overlay">'+
        '<h2>'+ response[i].nomeCandidato +'</h2>'+
        '<p>VOTE</p>'+
        '</div>'+
        '</div>'+
        '</div></a>';
    }
    $(".divVotacao").empty();
    $(".divVotacao").append(html);
}