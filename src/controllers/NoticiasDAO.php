<?php

//Aqui importamos todas as classes que poderão ser usadas baseado nas solicitações que forem feitas.
require_once("../models/bean/Noticia.php"); // Classe Bean
require_once("../models/dao/NoticiaDAO.class.php"); // Classe DAO
require_once("../interfaces/geral.interface.php"); //Classe View
require_once("../../app/DB.class.php"); //Classe db

//Armazena na variável $acao o que o sistema esta requisitando (cadastrar, autenticar, excluir, etc)
$acao = $_REQUEST["acao"];
$NoticiaDAO = new NoticiaDAO();
$GeralView = new GeralView();
$noticia = new Noticia();	
//Baseado no que foi solicitado, chama na classe DAO o método responsável por tal tarefa, e depois manda pra View a resposta, para ser exibida de alguma forma ao usuário
switch($acao){

	case 'BuscarNoticia':{		
		$tipo = $_REQUEST["tipo"];				
		$resultado = $NoticiaDAO->GetNoticiaGeral($tipo);		
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'BuscarNoticiaADM':{		
		$noticia->setNumNoticia($_REQUEST["numNoticia"]);		
		$resultado = $NoticiaDAO->GetNoticiaAdm($noticia);			
		$GeralView->respostaDados($resultado);
	}
	break;

	case 'BuscarNoticiaTop3':{				
		$resultado = $NoticiaDAO->GetNoticiaTop3();			
		$GeralView->respostaDados($resultado);
	}
	break;
	
	case 'GravarNoticia':{	
		$noticia->setCodCandidato($_REQUEST["codCandidato"]);		
		$noticia->setFonte($_REQUEST["fonte"]);		
		$noticia->setLegendaPartido($_REQUEST["legendaPartido"]);		
		$noticia->setNumNoticia($_REQUEST["numNoticia"]);		
		$noticia->setTexto($_REQUEST["texto"]);		
		$noticia->setTitulo($_REQUEST["titulo"]);
		if($_REQUEST["imagem"] != '[sem-imagem]'){
			$noticia->setCaminhoImagem($_REQUEST["imagem"]);						
		}else{
			$noticia->setCaminhoImagem('');			
		}		
		$noticia->setAutor($_REQUEST["autor"]);								
		$resultado = $NoticiaDAO->GravarNoticia($noticia);			
		$GeralView->respostaDados($resultado);

	}
	break;

	case 'DeleteNoticia':{				
		$noticia->setNumNoticia($_REQUEST["numNoticia"]);		
		$resultado = $NoticiaDAO->DeleteNoticia($noticia);			
		$GeralView->respostaDados($resultado);
	}
	break;

	default:
		return null; //Por padrão, esse switch não retorna nada.
		
	}




	?>