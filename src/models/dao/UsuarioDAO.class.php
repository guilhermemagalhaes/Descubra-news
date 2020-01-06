<?php

//Como iremos usar nesta classe o que foi setado para a classe Bean, � necess�rio importar a classe Bean aqui.

//CLASSE INCLUIDA PARA GRAVAÇÃO DE LOG
require_once("GeralDAO.class.php");


class UsuarioDAO extends Usuario {

	private $tabela = 'usuario';
	private $prefix = 'descubranews_';
	private $cookie = true;
	public $erro = '';
	
	private function crip($senha){
		try{
			$senha .= "descubranews" . "V38$217052790@75@678972417+74+8+42";
			return  base64_encode(md5($senha)) ;
		}catch(PDOException $e){
			$Geral->GravarLogErro("Erro function crip \n".$e."");
		}
	}

	function cadastraUsuario($usuario){
		$idUsuario=$usuario->getIdUsuario();
		$nome=$usuario->getNomeUsuario();
		$email=$usuario->getEmail();
		$senha=$this->crip($usuario->getSenha());
		
		try {
			$cadastrar = DB::getConn()->prepare("CALL procCadastroUsuario(:nome,:email,:senha,:idUsuario)");
			$cadastrar->bindValue(':nome',$nome); 
			$cadastrar->bindValue(':email',$email); 
			$cadastrar->bindValue(':senha',$senha); 
			$cadastrar->bindValue(':idUsuario',$idUsuario); 
			$cadastrar->execute();
			$dados = "true";
			return $dados;
		} catch (PDOException $e) {
			$this->erro = 'Sistema indispon�vel';
			$Geral = new GeralDAO;
			$Geral->GravarLogErro("Erro function cadastraRefugiado \n".$e."");
			logErros($e);
		}
	}

	function DeleteUsuario($usuario){
		$idUsuario=$usuario->getIdUsuario();
		try {
			$cadastrar = DB::getConn()->prepare("CALL procDeleteUsuario(:idUsuario)");
			$cadastrar->bindValue(':idUsuario',$idUsuario); 
			$cadastrar->execute();
			$dados = "true";
			return $dados;
		} catch (PDOException $e) {
			$this->erro = 'Sistema indispon�vel';
			$Geral = new GeralDAO;
			$Geral->GravarLogErro("Erro function cadastraRefugiado \n".$e."");
			$dados = "false";
			return $dados;
			logErros($e);
		}
	}

	public function GetUsuario($idUsuario){
		try{
			$usuario = DB::getConn()->prepare('CALL getUsuarios(:idUsuario)');
			$usuario->bindValue(':idUsuario', $idUsuario); 
			$usuario->execute();			
			$geral = new GeralDAO();
			return $geral->RetornoLista($usuario);
		}catch(PDOException $e){
			$geral = new GeralDAO();
			$geral->GravarLogErro("Erro function GetNoticiaGeral \n".$e."");
		}
	}


	private function validar($usuario,$senha){
		$senha = $this->crip($senha);
		try{
			
			$validar = DB::getConn()->prepare('CALL procValidaLogin(:email,:senha)');
			$validar->bindValue(':email',$usuario); 
			$validar->bindValue(':senha',$senha); 
			$validar->execute();			
			if($validar->rowCount()==1){
				$asValidar = $validar->fetch(PDO::FETCH_ASSOC);
				$_SESSION[$this->prefix.'uid'] = $asValidar['idUsuario'];								
				return true;
			}else{
				return false;
			}						
		}catch(PDOException $e){
			$this->erro = 'Sistema indispon�vel';
			$Geral = new GeralDAO();
			$Geral->GravarLogErro("Erro function validar \n".$e."");
			logErros($e);
			return false;
		}
	}

	function autenticaUsuario($usuario,$lembrar=true){	
		$usuarioAutentica = $usuario->getEmail();
		$senhaAutentica = $usuario->getSenha(); 
		if($this->validar($usuarioAutentica,$senhaAutentica)){				
			if(!isset($_SESSION)){
				session_start();
			}				
			$_SESSION[$this->prefix.'usuario'] = $usuario->getEmail();
			$_SESSION[$this->prefix.'logado'] = true;				
			if($this->cookie){
				$valor = join('#',array($usuario->getEmail(),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']));
				$valor = md5($valor);
				setcookie($this->prefix.'token',$valor,0,'');
			}
			if($lembrar){
				$this->lembrardados($usuarioAutentica,$senhaAutentica);
			}
			return true;
		}else{				
			$this->erro=  "";	
			$Geral = new GeralDAO;
			$Geral->GravarLogErro("Erro function autenticaUsuario");			
			return false;
		}
	}	

	function VerificaSessao(){
		if(!isset($_SESSION)){
			session_start();
		}	
		if(!isset($_SESSION[$this->prefix.'logado']) AND !isset($_SESSION[$this->prefix.'logado'])){
			if($cookei){
				return true;
			}else{
				$this->erro = 'Voc� n�o esta logado';
				return false;
			}
		}	
		if($this->cookie){
			if(!isset($_COOKIE[$this->prefix.'token'])){
				$this->erro = 'Voc� n�o est� logado';
				return false;
			}else{
				$valor = join('#',array($_SESSION[$this->prefix.'usuario'],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']));
				$valor = md5($valor);					
				if($_COOKIE[$this->prefix.'token'] !== $valor){
					$this->erro = 'Voc� n�o est� logado';
					return false;
				}
			}
		}
		return true;
	}

	function logado($cookei=true){
		if(!isset($_SESSION)){
			session_start();
		}		
		if(!isset($_SESSION[$this->prefix.'logado']) AND !isset($_SESSION[$this->prefix.'logado'])){
			if($cookei){
				return $this->dadosLembrados();
			}else{
				$this->erro = 'Voc� n�o esta logado';
				return false;
			}
		}			
		if($this->cookie){
			if(!isset($_COOKIE[$this->prefix.'token'])){
				$this->erro = 'Voc� n�o est� logado';
				return false;
			}else{
				$valor = join('#',array($_SESSION[$this->prefix.'usuario'],$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']));
				$valor = md5($valor);					
				if($_COOKIE[$this->prefix.'token'] !== $valor){
					$this->erro = 'Voc� n�o est� logado';
					return false;
				}
			}
		}
		return true;			
	}

	function sair($cookie=true){
		if(!isset($_SESSION)){
			session_start();
		}			
		unset($_SESSION[$this->prefix.'usuario']);
		unset($_SESSION[$this->prefix.'uid']);
		$_SESSION[$this->prefix.'logado'] = false;			
		if($this->cookie AND isset($_COOKIE[$this->prefix.'token'])){
			setcookie($this->prefix.'token',false,(time()-3600),'/');
			unset($_COOKIE[$this->prefix.'token']);
		}			
		if($cookie){
			$this->limparLembrados();
		}		
		return !$this->logado(false);
	}		

	function getDados($uid){
		try{
			if($this->logado()){
				$dados = DB::getConn()->prepare('CALL getDadosUsuario(:idUsuario)');
				$dados->bindValue(':idUsuario',$uid); 
				$dados->execute();
				return $dados->fetch(PDO::FETCH_ASSOC);
			}
		}catch(PDOException $e){
			$Geral = new GeralDAO;
			$Geral->GravarLogErro("Erro function getDados \n".$e."");
		}
	}	

	function limparLembrados(){
		if(isset($_COOKIE[$this->prefix.'login_user'])){
			setcookie($this->prefix.'login_user',false,(time()-3600),'/');
			unset($_COOKIE[$this->prefix.'login_user']);
		}			
		if(isset($_COOKIE[$this->prefix.'login_pass'])){
			setcookie($this->prefix.'login_pass',false,(time()-3600),'/');
			unset($_COOKIE[$this->prefix.'login_pass']);
		}
	}	

	private function dadosLembrados(){
		if(isset($_COOKIE[$this->prefix.'login_user']) AND isset($_COOKIE[$this->prefix.'login_pass'])){
			$usuarioDadosLembrados = base64_decode(substr($_COOKIE[$this->prefix.'login_user'],1));
			$senhaDadosLembrados = base64_decode(substr($_COOKIE[$this->prefix.'login_pass'],1));	
			//models
			$usuario = new Usuario();	
			$usuario->setEmail($usuarioDadosLembrados);
			$usuario->setSenha($senhaDadosLembrados);					
			return $this->autenticaUsuario($usuario,true);
		}
		return false;
	}	
	
	private function lembrardados($usuario,$senha){
		$tempo = strtotime('+7 day',time());		
		$usuario = rand(1,9).base64_encode($usuario);
		$senha = rand(1,9).base64_encode($senha);		
		setcookie($this->prefix.'login_user',$usuario,$tempo,'/');
		setcookie($this->prefix.'login_pass',$senha,$tempo,'/');
	}
}

?>