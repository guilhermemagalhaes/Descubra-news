<?php

require_once("GeralDAO.class.php");


class NoticiaDAO extends Noticia {
	public $erro = '';
	

	public function GetNoticiaGeral($tipo){
		try{
			$noticiaGeral = DB::getConn()->prepare('CALL getNoticias(:tipo)');
			$noticiaGeral->bindValue(':tipo', $tipo); 
			$noticiaGeral->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($noticiaGeral);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetNoticiaGeral \n".$e."");
		}
	}

	public function GetNoticiaAdm($noticia){
		$numNoticia=$noticia->getNumNoticia();
		try{
			$noticiaGeral = DB::getConn()->prepare('CALL getNoticiasAdm(:numNoticia)');
			$noticiaGeral->bindValue(':numNoticia', $numNoticia); 
			$noticiaGeral->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($noticiaGeral);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetNoticiaGeral \n".$e."");
		}
	}

	public function GetNoticiaTop3(){
		try{
			$noticiaGeral = DB::getConn()->prepare('CALL getNoticiasTop3');			
			$noticiaGeral->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($noticiaGeral);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetNoticiaGeral \n".$e."");
		}
	}

	public function GravarNoticia($noticia){	
		$codCandidato=$noticia->getCodCandidato();
		$fonte=$noticia->getFonte();				
		$legendaPartido=$noticia->getLegendaPartido();
		$numNoticia=$noticia->getNumNoticia();
		$texto=$noticia->getTexto();
		$titulo=$noticia->getTitulo();
		$imagem=$noticia->getCaminhoImagem();
		$autor=$noticia->getAutor();

		try{			
			$noticia = DB::getConn()->prepare("CALL procCadastroNoticia(:codCandidato,:fonte,:legendaPartido,:numNoticia,:texto,:titulo,:imagem,:autor)");	
			$noticia->bindValue(':codCandidato', $codCandidato); 
			$noticia->bindValue(':fonte',$fonte); 						 								
			$noticia->bindValue(':legendaPartido',$legendaPartido); 						 								
			$noticia->bindValue(':numNoticia',$numNoticia); 						 								
			$noticia->bindValue(':texto',$texto); 						 								
			$noticia->bindValue(':titulo',$titulo); 						 								
			$noticia->bindValue(':imagem',$imagem); 						 								
			$noticia->bindValue(':autor',$autor); 						 								
			$noticia->execute();
			return true;
		} catch (PDOException $e) {
			$this->erro = 'Sistema indisponível';			
			logErros($e);
			return false;
		}
	}

	public function DeleteNoticia($noticia){
		$numNoticia=$noticia->getNumNoticia();
		try{
			$noticiaGeral = DB::getConn()->prepare('CALL procDeleteNoticia(:numNoticia)');
			$noticiaGeral->bindValue(':numNoticia', $numNoticia);
			$noticiaGeral->execute();
			$geral = new GeralDAO();
			return $geral->RetornoLista($noticiaGeral);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function deleteNotica \n".$e."");
		}
	}
}
?>