<?php

require_once("GeralDAO.class.php");

class CandidatoDAO extends Candidato {
	public $erro = '';
	
	public function GetCandidatos($candidato){
		$codCandidato=$candidato->getCodCandidato();
		try{
			$candidatos = DB::getConn()->prepare('CALL getCandidatos(:codCandidato)');			
			$candidatos->bindValue(':codCandidato', $codCandidato); 
			$candidatos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($candidatos);
		}catch(PDOException $e){			
			logErros($e);
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetCandidatos \n".$e."");
		}
	}

	public function cadastraCandidato($candidato){
		$codCandidato=$candidato->getCodCandidato();
		$nomeCandidato=$candidato->getNomeCandidato();
		$dataNascimento=$candidato->getDtNascto();
		$legendaPartido=$candidato->getLegendaPartido();
		$imagem64=$candidato->getCaminhoImagem();
		$biografia=$candidato->getBiografia();			
		try{
			$candidatos = DB::getConn()->prepare('CALL procCadastraCandidato(:codCandidato,:nome,:dataNascimento,:legendaPartido,:imagem64,:biografia)');			
			$candidatos->bindValue(':codCandidato', $codCandidato); 
			$candidatos->bindValue(':nome', $nomeCandidato); 
			$candidatos->bindValue(':dataNascimento', $dataNascimento); 
			$candidatos->bindValue(':legendaPartido', $legendaPartido); 
			$candidatos->bindValue(':imagem64', $imagem64); 
			$candidatos->bindValue(':biografia', $biografia); 
			$candidatos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($candidatos);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			logErros($e);			
			$geral->GravarLogErro("Erro function cadastraCandidato \n".$e."");
		}
	}	

	public function deletaCandidato($candidato){
		$codCandidato=$candidato->getCodCandidato();
		try{
			$candidatos = DB::getConn()->prepare('CALL procDeleteCandidato(:codCandidato)');			
			$candidatos->bindValue(':codCandidato', $codCandidato); 
			$candidatos->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($candidatos);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function deletaUsuario \n".$e."");
		}
	}
}


?>