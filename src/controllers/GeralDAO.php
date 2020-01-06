<?php
require_once("../models/bean/Candidato.php"); // Classe Bean
require_once("../models/dao/CandidatoDAO.class.php"); // Classe DAO
require_once("../interfaces/geral.interface.php"); //Classe View
require_once("../models/dao/GeralDAO.class.php"); //Classe View
require_once("../../app/DB.class.php"); //Classe db

//Armazena na variável $acao o que o sistema esta requisitando
$acao = $_REQUEST["acao"];

$GeralDAO = new GeralDAO();
$GeralView = new GeralView();
//Baseado no que foi solicitado, chama na classe DAO o método responsável por tal tarefa, e depois manda pra View a resposta, para ser exibida de alguma forma ao usuário
switch($acao){
	
	//dropdowns
	case 'partido':{
		$resultado = $GeralDAO->DropDown($acao);
		$GeralView->respostaDados($resultado);
	}
	break;
	case 'candidato':{
		$resultado = $GeralDAO->DropDown($acao);
		$GeralView->respostaDados($resultado);
	}
	break;


	default:
		return null; //Por padrão, esse switch não retorna nada.
		
	}


	?>