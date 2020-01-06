<?php 

Class Log {
	
	
	private $idLog;
	private $dataErro;
	private $descricaoErro;


	public function getIdLog(){
		return $this->idLog;
	}

	public function setIdLog($idLog){
		$this->idLog = $idLog;
	}

	public function getDataErro(){
		return $this->dataErro;
	}

	public function setDataErro($dataErro){
		$this->dataErro = $dataErro;
	}

	public function getDescricaoErro(){
		return $this->descricaoErro;
	}

	public function setDescricaoErro($descricaoErro){
		$this->descricaoErro = $descricaoErro;
	}
	
}
