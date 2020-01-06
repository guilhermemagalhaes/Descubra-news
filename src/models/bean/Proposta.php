<?php 

Class Proposta {

	private $numProposta;
    private $descricaoProposta;
    private $imagemProposta;
    private $codCandidato;

    public function getNumProposta(){
        return $this->numProposta;
    }

    public function setNumProposta($numProposta){
        $this->numProposta = $numProposta;
    }

    public function getDescricaoProposta(){
        return $this->descricaoProposta;
    }

    public function setDescricaoProposta($descricaoProposta){
        $this->descricaoProposta = $descricaoProposta;
    }

    public function getImagemProposta(){
        return $this->imagemProposta;
    }

    public function setImagemProposta($imagemProposta){
        $this->imagemProposta = $imagemProposta;
    }

    public function getCodCandidato(){
        return $this->codCandidato;
    }

    public function setCodCandidato($codCandidato){
        $this->codCandidato = $codCandidato;
    }
    
}
