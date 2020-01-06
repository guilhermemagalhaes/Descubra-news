<?php

if(!isset($_SESSION)){
	session_start();
} 

require_once("../src/models/bean/Usuario.php"); // Classe Bean
require_once("../src/models/dao/UsuarioDAO.class.php"); // Classe DAO
require_once("../app/DB.class.php"); // Classe DAO

$objLogin = new UsuarioDAO;//cria o objeto login

if(isset($_GET['sair'])){
	$objLogin->sair();
	session_destroy();
	include('index.php');
	exit();
}

if(!$objLogin->logado()){
	include('index.php');
	exit();
}

$idExtrangeiro = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['descubranews_uid'];
// pega o id do usuario e da pagina de perfil que ele esteja visitando
$dados = $objLogin->getDados($idExtrangeiro);

if(is_null($dados)){
  header('Location: ./');
  exit();
}else{
  extract($dados,EXTR_PREFIX_ALL,'user'); 
}


?>

