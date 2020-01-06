
$(document).ready(function() {

	var url = new URL(window.location);
	numNoticia = url.searchParams.get("id");    
	GetCandidato(numNoticia);


});

function GetCandidato(codCandidato) {
	$.ajax({
		type: "POST",
		url: "/descubranews/src/controllers/CandidatoDAO.php?acao=BuscarCandidato&codCandidato=" + codCandidato + "",
		dataType: "json",
		success: function(response, status) {            			
			PopulaCandidato(response[0]);         	
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
	$("#imageCandidato").attr('src', response.caminhoImagem);
	$("#nomeCandidatoTittle").val(response.nomeCandidato);	
	var html = '';
	html += '<div style="font-size: 25px; text-align: center">Biografia '+ response.nomeCandidato +'</div><br>';
	html += '<p class="post_p">'+response.biografia+'</p>'
	$("#post").empty();
	$("#post").append(html);
}
