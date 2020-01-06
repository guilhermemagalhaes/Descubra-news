<?php

require_once("GeralDAO.class.php");

class VotacaoDAO extends Candidato {
	public $erro = '';

	public function InsereVoto($candidato){
		$codCandidato=$candidato->getCodCandidato();
		try{
			$candidatos = DB::getConn()->prepare('CALL procVotacao(:codCandidato)');			
			$candidatos->bindValue(':codCandidato', $codCandidato); 
			$candidatos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($candidatos);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function InsereVoto \n".$e."");
		}
	}

	public function GetVotacao(){		
		try{
			$votacao = DB::getConn()->prepare('CALL getVotacao()');						
			$votacao->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($votacao);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function InsereVoto \n".$e."");
		}
	}
}


?>