<?php

require_once("GeralDAO.class.php");

class PropostaDAO extends Proposta {
	public $erro = '';
	
	public function GetPropostas($proposta){
		$numProposta=$proposta->getNumProposta();
		try{
			$propostas = DB::getConn()->prepare('CALL getPropostas(:numProposta)');			
			$propostas->bindValue(':numProposta', $numProposta); 
			$propostas->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($propostas);
		}catch(PDOException $e){			
			logErros($e);
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetProposta \n".$e."");
		}
	}

	public function cadastraProposta($proposta){		
		$numProposta = $proposta->getNumProposta();
		$descricaoProposta = $proposta->getDescricaoProposta();		
		$imagem = $proposta->getImagemProposta();		
		$codCandidato = $proposta->getCodCandidato();		
		try{
			$propostas = DB::getConn()->prepare('CALL procCadastraProposta(:numProposta,:descricaoProposta,:imagem,:codCandidato)');			
			$propostas->bindValue(':numProposta', $numProposta); 			
			$propostas->bindValue(':descricaoProposta', $descricaoProposta); 
			$propostas->bindValue(':imagem', $imagem); 
			$propostas->bindValue(':codCandidato', $codCandidato); 
			$propostas->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($propostas);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			logErros($e);			
			$geral->GravarLogErro("Erro function cadastraCandidato \n".$e."");
		}
	}	

	public function deletaProposta($proposta){
		$numProposta=$proposta->getNumProposta();
		try{
			$propostas = DB::getConn()->prepare('CALL procDeleteProposta(:numProposta)');			
			$propostas->bindValue(':numProposta', $numProposta); 
			$propostas->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($propostas);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function deletaUsuario \n".$e."");
		}
	}
}


?>