var noticia3 = '';
var noticia8 = '';


GetNoticiaTop3('banner');
//GetNoticiaTop3('lateral');

$(document).ready(function() {

    //busca as 4 ultimas noticias de acordo com a data


    //seleciona o filtro deseja e aplica efeito de ativo na opção
    $("#filtroNoticia").on('click', 'li', function(event) {
        event.preventDefault();
        var filtro = $(this).attr('data-id');
        switch (filtro) {
            case "1":
            $("#f2").removeClass('active');
            $("#f3").removeClass('active');
            $("#f1").addClass('active');
            break;
            case "2":
            $("#f1").removeClass('active');
            $("#f3").removeClass('active');
            $("#f2").addClass('active');
            break;
            case "3":
            $("#f1").removeClass('active');
            $("#f2").removeClass('active');
            $("#f3").addClass('active');
            break;
        }
        GetNoticias(filtro);
    });

    //traz dados iniciais (geral)
    $("#f1").addClass('active');
    GetNoticias(1);

    GetCandidatos(0);

    



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
function GetNoticias(tipo) {
    Load(true);
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=BuscarNoticia&tipo=" + tipo + "",
        dataType: "json",
        success: function(response, status) {
            if (response != 99) {
                PopulaNoticias(response);
            }else{
                $(".limpa").empty();
                Load("erro");
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
                    //PopulaNoticiasLateral(response);
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

function GetCandidatos(codCandidato) {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/CandidatoDAO.php?acao=BuscarCandidato&codCandidato=" + codCandidato + "",
        dataType: "json",
        success: function(response, status) {            
            if(response != 99){
                PopulaCandidato(response)    ;
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
        var imagem = 'images/sem-imagem.jpg';    
        if(response[i].caminhoImagem != ''){
            imagem = response[i].caminhoImagem;
        }
        var nomePartido = response[i].nomeCandidato + '<hr>' + response[i].nomePartido;

        html += '<a style="color:black;" href="candidato.php?id='+response[i].codCandidato +'">'+
        '<div class="card" style="width: 10rem; margin-right: 10px">'+
        '<img style="height: 151px;"class="card-img-top" src="'+ imagem +'" alt="Card image cap">'+

        '<div class="card-body">'+
        '<h5 class="card-title">'+nomePartido+'</h5>'+
        '</div>'+
        '</div></a>';
    }
    $("#listaCandidatos").empty();
    $("#listaCandidatos").append(html);
}

function PopulaNoticiaTop3(response) {
    var noticia = '';
    for (var i = 0; i < response.length; i++) {
        var titulo = response[i].titulo;
        var numNoticia = response[i].numNoticia;
        //preeche a noticia principal
        if (i == 0) {
            //preeche o tipo da noticia
            if (response[i].codCandidato != null) {
                $("#tipoNoticia").append("Candidatos");
            } else if (response[i].legendaPartido != null) {
                $("#tipoNoticia").append("Partidos");
            } else {
                $("#tipoNoticia").text("Eleições 2018");
            }
            $("#noticiaPrincipal").empty();
            $("#noticiaPrincipal").append('<a href="noticia.php?id=' + numNoticia + '" style="color: #fff; font-size: 30px">' + titulo + '</a>');
        } else {
            noticia += '<div class="col-lg-3 col-md-6 similar_post_col">' +
            '<div class="similar_post trans_200">' +
            '<a href="noticia.php?id=' + numNoticia + '">' + titulo + '</a>' +
            '</div>' +
            '</div>';            
        }
    }    
    $("#listaTop3").append(noticia);
}




function PopulaNoticias(response) {

    noticia3 = '';
    noticia8 = '';

    if (response != 99) {
        //percorre o array de noticias para tratamento e inserção na tela    
        for (var i = 0; i < response.length; i++) {
            var caminhoImagem = response[i].caminhoImagem;
            if (response[i].caminhoImagem != " ") {
                var imagem = '<img style="width: 100%;" class="card-img" src="' + response[i].caminhoImagem + '">';
            }
            var numNoticia = response[i].numNoticia;
            var titulo = response[i].titulo;
            var fonte = response[i].fonte;
            var texto = response[i].texto;
            var data = ConverteDataNewtonJson(response[i].dtNoticia, "dma");
            var color = '';
            if (response[i].codCandidato != null) {
                color = '#38673B';
            } else if (response[i].legendaPartido == null && response[i].codCandidato == null ) {
                color = '#31568C';
            }
            if (response[i].caminhoImagem == "") {
                noticia3 += '<div style="background:'+color+';width:100%;" data-id="' + numNoticia + '" class="card card_default card_small_no_image grid-item">' +
                '<div class="card-body">' +
                '<div class="card-title card-title-small"><a style="color:white" href="noticia.php?id=' + numNoticia + '">' + titulo + '</a></div>' +
                '<small class="post_meta"><a style="color:white" href="#">' + fonte + '</a><span style="color:white">' + data + '</span></small>' +
                '</div>' +
                '</div>';
            } else if (response[i].caminhoImagem != "") {
                texto = texto.substring(0,100);    
                noticia8 += '<div style="width:100%;background:'+color+'" data-id="' + numNoticia + '" class="card card_largest_with_image grid-item">' +
                imagem +
                '<div class="card-body">' +
                '<div class="card-title"><a style="color:white" href="noticia.php?id=' + numNoticia + '">' + titulo + '</a></div>' +
                '<p class="card-text" style="color:white">' + texto + ' ...</p>' +
                '<small class="post_meta"><a href="#" style="color:white">' + fonte + '</a><span style="color:white">' + data + '</span></small>' +
                '</div>' +
                '</div>';
            }
        }

        //$(".limpa").empty();
        Load(false);
        $(".limpa").empty();
        if (noticia8.length == 0 && noticia3.length != 0) {
            $("#listaNoticias-8").append(noticia3);
        } else if (noticia3.length != 0 || noticia8.length != 0) {
            $("#listaNoticias-8").append(noticia8);            
            $("#listaNoticias-3").append(noticia3);                

        } else {
            Load("erro");
        }
    } else {
        $(".limpa").empty();
        Load("erro");
    }

}