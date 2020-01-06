<?php
class GeralView{
	//CONVERTE TODOS OS DADOS RECEBIDO EM JSON PARA TRATAMENTO NO AJAX JQUERY 
	function respostaDados($respostaDados){
		if(count($respostaDados) !=0){
			echo json_encode($respostaDados);
		}else{
			//QUANDO ENCONTRAR ALGUM ERRO RETORNA STATUS 99 QUE DEVER SER TRATADO NO JS
			echo 99;
		}
	}

	function respostaAutenticacao($resposta){	
		/*Se a variável $resposta estiver neste momento como TRUE, então os dados estão corretos e podemos 
		exibir uma mensagem de sucesso. Caso contrário, irá cair no else, que irá alertar que os dados são inválidos.*/
		if($resposta){
			echo 'index.php';
		}
		else{
			echo 99;
		}
	}
}

?>