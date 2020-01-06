<?php 

Class Candidato {
	
	private $codCandidato;
	private $nomeCandidato;
	private $dtNascto;
	private $legendaPartido;
	private $caminhoImagem;
	private $biografia;
	private $ativo;

	public function getCodCandidato(){
		return $this->codCandidato;
	}

	public function setCodCandidato($codCandidato){
		$this->codCandidato = $codCandidato;
	}

	public function getNomeCandidato(){
		return $this->nomeCandidato;
	}

	public function setNomeCandidato($nomeCandidato){
		$this->nomeCandidato = $nomeCandidato;
	}

	public function getDtNascto(){
		return $this->dtNascto;
	}

	public function setDtNascto($dtNascto){
		$this->dtNascto = $dtNascto;
	}

	public function getLegendaPartido(){
		return $this->legendaPartido;
	}

	public function setLegendaPartido($legendaPartido){
		$this->legendaPartido = $legendaPartido;
	}

	public function getCaminhoImagem(){
		return $this->caminhoImagem;
	}

	public function setCaminhoImagem($caminhoImagem){
		$this->caminhoImagem = $caminhoImagem;
	}

	public function getBiografia(){
		return $this->biografia;
	}

	public function setBiografia($biografia){
		$this->biografia = $biografia;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

}
