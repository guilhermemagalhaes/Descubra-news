<?php
require_once("../models/bean/Partido.php"); // Classe Bean
require_once("../models/dao/PartidoDAO.class.php"); // Classe DAO
require_once("../interfaces/geral.interface.php"); //Classe View
require_once("../models/dao/GeralDAO.class.php"); //Classe View
require_once("../../app/DB.class.php"); //Classe db

//Armazena na variável $acao o que o sistema esta requisitando
$acao = $_REQUEST["acao"];

$PartidoDAO = new PartidoDAO();
$GeralView = new GeralView();
//Baseado no que foi solicitado, chama na classe DAO o método responsável por tal tarefa, e depois manda pra View a resposta, para ser exibida de alguma forma ao usuário
switch($acao){
	
	case 'CadastraPartido':{
		$partido = new Partido();
		$partido->setLegendaPartido($_REQUEST["legendaPartido"]);		
		$partido->setNomePartido($_REQUEST["nomePartido"]);				
		$partido->setCaminhoImagemPartido($_REQUEST["imagem"]);						
		$resultado = $PartidoDAO->cadastraPartido($partido);
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'DeletePartido':{
		$partido = new Partido();
		$partido->setLegendaPartido($_REQUEST["legendaPartido"]);		
		$resultado = $PartidoDAO->deletaPartido($partido);
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'BuscarPartidos':{
		$partido = new Partido();
		$partido->setLegendaPartido($_REQUEST["legendaPartido"]);		
		$resultado = $PartidoDAO->GetPartidos($partido);
		$GeralView->respostaDados($resultado);
	}
	break;

	default:
		return null; //Por padrão, esse switch não retorna nada.
		
	}


	?>