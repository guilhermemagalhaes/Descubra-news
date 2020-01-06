<?php
//CLASE ONDE FOCA FUNÇÕES DE USO COMUM EM TODO PROJETO
class GeralDAO {	
	
	public function RetornoLista($retorno){
		$results = array();
		while ($row = $retorno->fetch(PDO::FETCH_OBJ)) {
			$results[] = $row;
		}
		return $results;
	}

	public function GravarLogErro($descricao){		
		$data = date('y/m/d H:i:s');
		try{
			$LogErro = DB::getConn()->prepare("CALL procCadastroLogErro(:dataErro,:descricaoErro)");	
			$LogErro->bindValue(':dataErro', $data); 
			$LogErro->bindValue(':descricaoErro',$descricao); 			
			$LogErro->execute();
			return true;
		} catch (PDOException $e) {
			$this->erro = 'Sistema indisponível';			
			logErros($e);
		}
	}

	public function DropDown($tipo){		
		try{
			$dropdown = DB::getConn()->prepare('CALL procDropDown(:tipo)');			
			$dropdown->bindValue(':tipo', $tipo); 
			$dropdown->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($dropdown);
		}catch(PDOException $e){
			var_dump($e);
			logErros($e);
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function DropDown \n".$e."");
		}
	}
}
?>