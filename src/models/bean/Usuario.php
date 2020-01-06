<?php 

Class Usuario {
	
	private $idUsuario;
	private $nomeUsuario;
	private $email;
	private $senha;

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getNomeUsuario(){
		return $this->nomeUsuario;
	}

	public function setNomeUsuario($nomeUsuario){
		$this->nomeUsuario = $nomeUsuario;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

}
