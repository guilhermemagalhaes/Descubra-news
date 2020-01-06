<?php

require_once("GeralDAO.class.php");

class PartidoDAO extends Partido {
	public $erro = '';
	
	public function GetPartidos($partido){
		$legendaPartido=$partido->getLegendaPartido();
		try{
			$partidos = DB::getConn()->prepare('CALL getPartidos(:legendaPartido)');			
			$partidos->bindValue(':legendaPartido', $legendaPartido); 
			$partidos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($partidos);
		}catch(PDOException $e){			
			logErros($e);
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetPartidos \n".$e."");
		}
	}

	public function cadastraPartido($partido){				
		$legendaPartido=$partido->getLegendaPartido();
		$nomePartido=$partido->getNomePartido();
		$imagem64=$partido->getCaminhoImagemPartido();
		try{
			$partidos = DB::getConn()->prepare('CALL procCadastroPartido(:legendaPartido,:nomePartido,:imagem64)');			
			$partidos->bindValue(':legendaPartido', $legendaPartido); 		
			$partidos->bindValue(':nomePartido', $nomePartido); 					
			$partidos->bindValue(':imagem64', $imagem64); 			
			$partidos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($partidos);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			logErros($e);			
			$geral->GravarLogErro("Erro function cadastraPartido \n".$e."");
		}
	}	

	public function deletaPartido($partido){
		$legendaPartido=$partido->getLegendaPartido();
		try{
			$partidos = DB::getConn()->prepare('CALL procDeletePartido(:legendaPartido)');			
			$partidos->bindValue(':legendaPartido', $legendaPartido); 
			$partidos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($partidos);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function deletaUsuario \n".$e."");
		}
	}
}


?>