
<?php
//CRIA CONEXÃO COM O BANCO DE DADOS
//LOCALHOST = 127.0.0.1
class DB{
	private static $conn;
	static function getConn(){
		if(is_null(self::$conn)){
			self::$conn = new PDO('mysql:host=localhost;dbname=descubranews','root','');
			self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		return self::$conn;
	}
}


//CRIA LOG DE ERRO EM ARQUIVO TXT 
function logErros($errno){		
	if(error_reporting()==0) return;		
	$exec = func_get_arg(0);		
	
	$errstr = $exec->getMessage();
	$errfile = $exec->getFile();
	$errline = $exec->getLine();
	$err = 'CAUGHT EXCEPTION';		
	if(ini_get('log_errrors')) error_log(sprintf("PHP %s: %s in %s on line %d",$err,$errstr,$errfile,$errline));		
		$strErro = 'erro: '.$err.' no arquivo: '.$errfile.' ( linha '.$errline.' ) :: IP('.$_SERVER['REMOTE_ADDR'].') data:'.date('d/m/y H:i:s')."\n";	
		$arquivo = fopen('logerro.txt','a');
		fwrite($arquivo,$strErro);
		fclose($arquivo);	
		set_error_handler('logErros');	
	}


	function getImageDataFromUrl($url)
	{
		$urlParts = pathinfo($url);
		$extension = $urlParts['extension'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$base64 = 'data:image/' . $extension . ';base64,' . base64_encode($response);
		return $base64;

	}






