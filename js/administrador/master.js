$(document).ready(function() {
	GetDadosUsuario();
});

function GetDadosUsuario() {
	$.ajax({
		type: "POST",
		url: "/descubranews/src/controllers/UsuarioDAO.php?acao=BuscarDadosUsuario",
		dataType: "json",
		success: function(response, status) {
			$("#nomeUsuario").text(response.nomeUsuario);
			$("#data").text(GetDate());
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

function GetDate() {
	var tdate = new Date();
   var dd = tdate.getDate(); //yields day
   var MM = tdate.getMonth(); //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var currentDate= dd + "/" +( MM+1) + "/" + yyyy;
   return currentDate;
}

function MensagemTela(objeto,mensagem, tipo){
	objeto.empty();
	var html = "";
	var estilo = "primary";
	if(tipo == true){
		estilo = "success";
	}else{
		estilo = "danger";
	}
	html = '<div class="alert alert-'+estilo+'" role="alert">'+
	mensagem +
	'</div>';
	objeto.append(html);
}

function ConverteDataNewtonJson(data, formato) {
	if (data == '0001-01-01T00:00:00') return '';
	if (data == null) return '';
	switch (formato) {
		case 'dma':
		return data.substring(8, 10) + "/" + data.substring(5, 7) + "/" + data.substring(0, 4);
		break;
		case 'hms':
		return data.substring(11, 13) + ":" + data.substring(14, 16) + ":" + data.substring(17, 19);
		break;
		case 'hm':
		return data.substring(11, 13) + ":" + data.substring(14, 16);
		break;
		case 'dmahms':
		return data.substring(8, 10) + "/" + data.substring(5, 7) + "/" + data.substring(0, 4) + " " + data.substring(11, 13) + ":" + data.substring(14, 16) + ":" + data.substring(17, 19);
		break;
	}
}

function imageToBase64(url, callback) {
	var xhr = new XMLHttpRequest();
	xhr.onload = function() {
		var reader = new FileReader();
		reader.onloadend = function() {
			callback(reader.result);
		}
		reader.readAsDataURL(xhr.response);
	};
	xhr.open('GET', url);
	xhr.responseType = 'blob';
	xhr.send();
}


function dataInvertida(dataInput) {
    return dataInput.substring(6, 10).toString() + "/" + dataInput.substring(3, 5).toString() + "/" + dataInput.substring(0, 2).toString();
}


function replaceCaracters(texto) {
    //não utilizar para dinheiro
    return texto = texto.replace(/\^|~|\?|,|\*|\.|\-|\/|\(|\)|\s/g, '');
}


// DROPDOWN
function comboPartido(objeto){
	GetDropDown(objeto, 'partido');
}

function comboCandidato(objeto){
	GetDropDown(objeto, 'candidato');
}

function GetDropDown(objeto,tipo) {    
	$.ajax({
		type: "POST",
		url: "/descubranews/src/controllers/GeralDAO.php?acao="+ tipo +"",
		dataType: "json",
		success: function(response, status) {			
			if(response != 99){				
				PopulaDrop(objeto,response);
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

function PopulaDrop(objeto,response){
	objeto.empty();
	objeto.append('<option value="0">Selecione...</option>');
	for (var i = response.length - 1; i >= 0; i--) {
		objeto.append('<option value="'+ response[i].id +'">'+ response[i].texto +' </option>');
	}
}
