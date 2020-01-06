<?php
require_once("../models/bean/Proposta.php"); // Classe Bean
require_once("../models/dao/PropostaDAO.class.php"); // Classe DAO
require_once("../interfaces/geral.interface.php"); //Classe View
require_once("../models/dao/GeralDAO.class.php"); //Classe View
require_once("../../app/DB.class.php"); //Classe db

//Armazena na variável $acao o que o sistema esta requisitando
$acao = $_REQUEST["acao"];

$PropostaDAO = new PropostaDAO();
$GeralView = new GeralView();
$proposta = new Proposta();
//Baseado no que foi solicitado, chama na classe DAO o método responsável por tal tarefa, e depois manda pra View a resposta, para ser exibida de alguma forma ao usuário
switch($acao){
	
	case 'CadastraProposta':{		
		$proposta->setNumProposta($_REQUEST["numProposta"]);
		$proposta->setDescricaoProposta($_REQUEST["descricaoProposta"]);		
		$proposta->setImagemProposta($_REQUEST["imagem"]);		
		$proposta->setCodCandidato($_REQUEST["codCandidato"]);				
		$resultado = $PropostaDAO->cadastraProposta($proposta);
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'DeleteProposta':{		
		$proposta->setNumProposta($_REQUEST["numProposta"]);		
		$resultado = $PropostaDAO->deletaProposta($proposta);
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'BuscarProposta':{		
		$proposta->setNumProposta($_REQUEST["numProposta"]);		
		$resultado = $PropostaDAO->GetPropostas($proposta);
		$GeralView->respostaDados($resultado);
	}
	break;

	default:
		return null; //Por padrão, esse switch não retorna nada.
		
	}


	?>