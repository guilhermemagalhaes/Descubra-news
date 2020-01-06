$(document).ready(function() {
	GetVotacao();
	//GraphGoogle();
});

function GetVotacao(){
	$.ajax({
		type: "POST",
		url: "/descubranews/src/controllers/VotacaoDAO.php?acao=GetVotacao",
		dataType: "json",
		success: function(response, status) {
			console.log(response);
			ResultVotacao(response);
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

function ResultVotacao(response){

	$("#resultado-votacao").empty();
	var html = "";
	for (var i = 0; i < response.length; i++) {
		html += '<span style="font-size:30px; margin-bottom:10px" class="badge badge-success"><br>'+ response[i].qtdVotos +'</span>&nbsp;&nbsp;&nbsp;<label style="color:black;font-size:20px">'+ response[i].nomeCandidato +'</label>&nbsp;&nbsp;&nbsp;<br>';
	}
	
$("#resultado-votacao").html(html);
}