<?php
require_once("../models/bean/Candidato.php"); // Classe Bean
require_once("../models/dao/CandidatoDAO.class.php"); // Classe DAO
require_once("../interfaces/geral.interface.php"); //Classe View
require_once("../models/dao/GeralDAO.class.php"); //Classe View
require_once("../../app/DB.class.php"); //Classe db

//Armazena na variável $acao o que o sistema esta requisitando
$acao = $_REQUEST["acao"];

$CandidatoDAO = new CandidatoDAO();
$GeralView = new GeralView();
//Baseado no que foi solicitado, chama na classe DAO o método responsável por tal tarefa, e depois manda pra View a resposta, para ser exibida de alguma forma ao usuário
switch($acao){
	
	case 'CadastraCandidato':{
		$candidato = new Candidato();
		$candidato->setCodCandidato($_REQUEST["codCandidato"]);
		$candidato->setNomeCandidato($_REQUEST["nomeCandidato"]);
		$candidato->setDtNascto($_REQUEST["dataNascimento"]);
		$candidato->setLegendaPartido($_REQUEST["legendaPartido"]);
		$candidato->setCaminhoImagem($_REQUEST["imagem"]);
		$candidato->setBiografia($_REQUEST["biografia"]);				
		$resultado = $CandidatoDAO->cadastraCandidato($candidato);
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'DeleteCandidato':{
		$candidato = new Candidato();
		$candidato->setCodCandidato($_REQUEST["codCandidato"]);		
		$resultado = $CandidatoDAO->deletaCandidato($candidato);
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'BuscarCandidato':{
		$candidato = new Candidato();
		$candidato->setCodCandidato($_REQUEST["codCandidato"]);		
		$resultado = $CandidatoDAO->GetCandidatos($candidato);
		$GeralView->respostaDados($resultado);
	}
	break;

	default:
		return null; //Por padrão, esse switch não retorna nada.
		
	}


	?>