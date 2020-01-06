<?php 

Class Partido {

	private $legendaPartido;
    private $nomePartido;
    private $caminhoImagemPartido;


    public function getLegendaPartido(){
        return $this->legendaPartido;
    }

    public function setLegendaPartido($legendaPartido){
        $this->legendaPartido = $legendaPartido;
    }

    public function getNomePartido(){
        return $this->nomePartido;
    }

    public function setNomePartido($nomePartido){
        $this->nomePartido = $nomePartido;
    }

    public function getCaminhoImagemPartido(){
        return $this->caminhoImagemPartido;
    }

    public function setCaminhoImagemPartido($caminhoImagemPartido){
        $this->caminhoImagemPartido = $caminhoImagemPartido;
    }

}
