var numNoticia = 0;

//busca as 4 ultimas noticias de acordo com a data
GetNoticiaTop3('lateral');


$(document).ready(function() {
    
    var url = new URL(window.location);
    numNoticia = url.searchParams.get("id");    
    GetNoticias(numNoticia);


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
function GetNoticias(numNoticia) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=BuscarNoticiaADM&numNoticia=" + numNoticia + "",
        dataType: "json",
        success: function(response, status) {            
            PopulaNoticia(response[0]);
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

function PopulaNoticia(response){
    //html
    var top = '';    
    var corpo = '';    
    var tags = '';
    var figura = '<figure>'+
    '<img src="images/post_image.jpg" alt="">'+
    '<figcaption>Lorem Ipsum Dolor Sit Amet</figcaption>'+
    '</figure>';
    // parametros
    var autor = response.autor;
    var titulo = response.titulo;
    var texto = response.texto;
    var codCandidato = response.codCandidato;
    var candidato = response.nomeCandidato;
    var codCandidato = response.codCandidato;
    var partidoCandidato = response.nomePartidoCandidato;
    var nomePartidoNoticia = response.nomePartidoNoticia;
    var data = ConverteDataNewtonJson(response.dtNoticia, 'dmahms');
    top =  '<div class="post_meta"><a href="#">'+autor+'</a><span>'+data+'</span></div>';    
    
    corpo = '<div style="font-size: 25px; text-align: center">'+ titulo +'</div><br>'+
    '<p class="post_p">'+ texto +'</p>';

    
    var tagAux = '';


    if(candidato != null){
        tagAux += '<a style="" href="candidato.php?id='+ codCandidato +'"><li class="post_tag">'+ candidato +'</li></a>';

    }
    if(partidoCandidato != null){
        tagAux += '<li class="post_tag retira">'+ partidoCandidato +'</li>';   
    }
    if(nomePartidoNoticia != null){
        tagAux += '<li id="retira" class="post_tag retira">'+ nomePartidoNoticia +'</li>';   
    }

    if(partidoCandidato == null && nomePartidoNoticia == null){
        tagAux += '<li class="post_tag">Eleições 2018</li>';  
        $(".retira").addClass('hidden');
    }




   tags = '<div class="post_tags">'+
   '<ul>'+    
   tagAux
   '</ul>'+
   '</div>';

   corpo += tags;

   $("#top").empty();
   $("#top").append(top);
   $("#corpo").empty();
   $("#corpo").append(corpo);
}
