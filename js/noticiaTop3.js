
GetNoticiaTop3();

function GetNoticiaTop3() {
    $.ajax({
        type: "POST",
        url: "/descubranews/src/controllers/NoticiasDAO.php?acao=BuscarNoticiaTop3",
        dataType: "json",
        success: function(response, status) {                  
            if (response != 99) {
                PopulaNoticiasLateral(response);
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
    //$("#noticiaLateral").empty();
    for (var i = 0; i < response.length; i++) {        
        var numNoticia = response[i].numNoticia;
        var data = ConverteDataNewtonJson(response[i].dtNoticia, 'dma');
        var autor = response[i].autor;
        var imagem = 'images/sem-imagem.jpg';
        if(response[i].caminhoImagem != ""){
            imagem = response[i].caminhoImagem;
        }

        var titulo = response[i].titulo;
        if(titulo.length > 25){
            titulo = titulo.substring(0,33);    
        }
 
        
        htmlLateral += '<div class="side_post">'+
        '<a href="noticia.php?id='+numNoticia+'">'+
        '<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">'+        
        '<div class="side_post_image"><div><img  src="'+imagem+'" alt=""></div></div>'+
        '<div class="side_post_content">'+
        '<div class="side_post_title">'+titulo+'</div>'+
        '<small class="post_meta">'+autor+'</small>'+
        '</div>'+
        '</div>'+
        '</a>'+
        '</div>';        
    }
    $("#noticiaLateral").html(htmlLateral);
}
