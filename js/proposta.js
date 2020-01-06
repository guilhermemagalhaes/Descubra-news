

//busca as 4 ultimas noticias de acordo com a data
GetNoticiaTop3('lateral');

$(document).ready(function() {    
    GetProposta(0);
});

//funcao para loading nas noticias
function Load(tipo) {
    if (tipo == true) {
        $("#erro").css('display', 'none');
        $("#loaging").css('display', 'block');
    } else if (tipo == false) {
        $("#carregar-mais").css('display', 'block');
        $("#erro").css('display', 'none');
        $("#loaging").css('display', 'none');
    } else if (tipo == "erro") {
        $("#carregar-mais").css('display', 'none');
        $("#loaging").css('display', 'none');
        $("#erro").css('display', 'block');
        $(".loader-erro").css('display', 'block');
    }
}

//busca as noticias mais recentes
function GetProposta(numProposta) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/PropostasDAO.php?acao=BuscarProposta&numProposta=" + numProposta + "",
        dataType: "json",
        success: function(response, status) {             
            PopulaProposta(response);
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

function GetNoticiaTop3(tipo) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=BuscarNoticiaTop3",
        dataType: "json",
        success: function(response, status) {
            if (response != 99) {
                if(tipo == 'banner'){
                    PopulaNoticiaTop3(response);    
                }else{
                    PopulaNoticiasLateral(response);
                }                
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

function PopulaNoticiasLateral(response){

    var htmlLateral = '';
    $("#noticiaLateral").empty();

    for (var i = 0; i < response.length; i++) {
        var titulo = response[i].titulo;
        var numNoticia = response[i].numNoticia;
        var data = ConverteDataNewtonJson(response[i].dtNoticia, 'dma');
        var autor = response[i].autor;
        var imagem = 'images/sem-imagem.jpg';
        if(response[i].caminhoImagem != ""){
            imagem = response[i].caminhoImagem;
        }

        htmlLateral = '<div class="side_post">'+
        '<a href="noticia.php?id='+numNoticia+'">'+
        '<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">'+        
        '<div class="side_post_image"><div><img src="'+imagem+'" alt=""></div></div>'+
        '<div class="side_post_content">'+
        '<div class="side_post_title">'+titulo+'</div>'+
        '<small class="post_meta">'+autor+'<span>'+data+'</span></small>'+
        '</div>'+
        '</div>'+
        '</a>'+
        '</div>';

        $("#noticiaLateral").append(htmlLateral);
    }
}

function PopulaProposta(response){

    var top = '';    
    var corpo = '';    
    var tags = '';
    var tagAux = '';
    var i;
    for (i = 0;  i < response.length; i++) {
        var numProposta = response[i].numProposta;
        var descricaoProposta = response[i].descricaoProposta;
        var codCandidato = response[i].codCandidato;
        var nomeCandidato = response[i].nomeCandidato;
        var nomePartido = response[i].nomePartido;        
        
        corpo += '<div style="font-size: 25px; text-align: center">Proposta de '+ nomeCandidato +'</div><br>'+
        '<p class="post_p">'+ descricaoProposta +'</p>';
        
        if(codCandidato != null){
            tagAux += '<a style="" href="candidato.php?id='+ codCandidato +'"><li class="post_tag">'+ nomeCandidato +'</li></a>';
        }        

        tags = '<div class="post_tags">'+
        '<ul>'+    
        tagAux
        '</ul>'+
        '</div><br><hr>';    
        corpo += tags;
        corpo += '<br><hr>';

        tagAux = '';
    }

    $("#top").empty();
    $("#top").append(top);
    $("#corpo").empty();
    $("#corpo").append(corpo);
}
