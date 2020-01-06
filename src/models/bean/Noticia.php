<?php 


Class Noticia {

    private $numNoticia; 
    private $titulo; 
    private $dtNoticia; 
    private $texto; 
    private $fonte; 
    private $codCandidato;
    private $legendaPartido;
    private $idGoogleNews;
    private $caminhoImagem;
    private $autor;
        
    public function getNumNoticia(){
        return $this->numNoticia;
    }

    public function setNumNoticia($numNoticia){
        $this->numNoticia = $numNoticia;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getDtNoticia(){
        return $this->dtNoticia;
    }

    public function setDtNoticia($dtNoticia){
        $this->dtNoticia = $dtNoticia;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function setTexto($texto){
        $this->texto = $texto;
    }

    public function getFonte(){
        return $this->fonte;
    }

    public function setFonte($fonte){
        $this->fonte = $fonte;
    }

    public function getCodCandidato(){
        return $this->codCandidato;
    }

    public function setCodCandidato($codCandidato){
        $this->codCandidato = $codCandidato;
    }

    public function getLegendaPartido(){
        return $this->legendaPartido;
    }

    public function setLegendaPartido($legendaPartido){
        $this->legendaPartido = $legendaPartido;
    }

    public function getIdGoogleNews(){
        return $this->idGoogleNews;
    }

    public function setIdGoogleNews($idGoogleNews){
        $this->idGoogleNews = $idGoogleNews;
    }

    public function getCaminhoImagem(){
        return $this->caminhoImagem;
    }

    public function setCaminhoImagem($caminhoImagem){
        $this->caminhoImagem = $caminhoImagem;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function setAutor($autor){
        $this->autor = $autor;
    }

}
