<?php

//Aqui importamos todas as classes que poderão ser usadas baseado nas solicitações que forem feitas.
require_once("../models/bean/Usuario.php"); // Classe Bean
require_once("../models/dao/UsuarioDAO.class.php"); // Classe DAO
require_once("../interfaces/geral.interface.php"); //Classe View
require_once("../models/dao/GeralDAO.class.php"); //Classe View
require_once("../../app/DB.class.php"); //Classe db

//Armazena na variável $acao o que o sistema esta requisitando (cadastrar, autenticar, excluir, etc)
$acao = $_REQUEST["acao"];


//Baseado no que foi solicitado, chama na classe DAO o método responsável por tal tarefa, e depois manda pra View a resposta, para ser exibida de alguma forma ao usuário
switch($acao){

	case 'autenticar':{

		//Primeiro instanciamos um objeto da classe Bean, para setar os valores informados no formulário
		$usuario = new Usuario();	
		
		/* Agora setamos para a Bean os valores informados,pois serão validados na camada DAO*/ 

		$usuario->setEmail($_REQUEST["login"]);
		$usuario->setSenha($_REQUEST["senha"]);
		
		/* Agora vamos instanciar um objeto da classe DAO e um da View, e passaremos para a View o que for retornado pela DAO */		
		$usuarioDAO = new UsuarioDAO();
		$usuarioView = new GeralView();
		
		//Passaremos para o método de autenticação da DAO um objeto da classe Usuário. Armazenaremos na variável $resultado o que este método retornar. 
		$resultado = $usuarioDAO->autenticaUsuario($usuario);

		
		//Agora chamamos um método da View passando para o mesmo o que foi retornado pela DAO.
		$usuarioView->respostaAutenticacao($resultado);
		
	}
	break;
	
	case 'CadastraUsuario':{
		
		$usuario = new Usuario();
		$usuario->setIdUsuario($_REQUEST["idUsuario"]);
		$usuario->setNomeUsuario($_REQUEST["nome"]);
		$usuario->setEmail($_REQUEST["email"]);
		$usuario->setSenha($_REQUEST["senha"]);
		$usuarioDAO = new UsuarioDAO();
		$usuarioView = new GeralView();
		$resultado = $usuarioDAO->cadastraUsuario($usuario);
		$usuarioView->respostaDados($resultado);
	}
	break;

	case 'DeleteUsuario':{
		$usuario = new Usuario();
		$usuario->setIdUsuario($_REQUEST["idUsuario"]);
		$usuarioDAO = new UsuarioDAO();
		$usuarioView = new GeralView();
		$resultado = $usuarioDAO->DeleteUsuario($usuario);
		$usuarioView->respostaDados($resultado);
	}
	break;

	case 'BuscarUsuarios':{
		$usuario = new UsuarioDAO;//cria o objeto login
		$usuarioView = new GeralView();	
		$idUsuario =  $_REQUEST["idUsuario"];
		$resultado = $usuario->GetUsuario($idUsuario);
		$usuarioView->respostaDados($resultado);
	}
	break;

	case 'BuscarDadosUsuario':{
		if(!isset($_SESSION)){
			session_start();
		} 
		$usuario = new UsuarioDAO;
		$usuarioView = new GeralView();	
		$idUsuario = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['descubranews_uid'];
		$resultado = $usuario->getDados($idUsuario);
		$usuarioView->respostaDados($resultado);
	}
	break;

	

	case 'ValidaEmail':{
		
		$usuario = new Usuario();
		$usuarioDAO = new UsuarioDAO();
		$usuarioView = new GeralView();

		$usuario->setEmail($_REQUEST["email"]);
		
		$resultado = $usuarioDAO->validarEmail($usuario);
		$usuarioView->respostaDados($resultado);
	}	
	break;		
	default:
		return null; //Por padrão, esse switch não retorna nada.
		
	}


	?>