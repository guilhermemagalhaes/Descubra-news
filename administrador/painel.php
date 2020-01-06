<?php 
require_once("../include/verificaSessaoInterno.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>DescubraNews - Painel</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="../js/jquery-datatables/media/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="../js/jquery-datatables-bs3/assets/css/datatables.css">	
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../styles/bootstrap4/popper.js"></script>
	<script src="../styles/bootstrap4/bootstrap.min.js"></script>
	<script src="../plugins/parallax-js-master/parallax.min.js"></script>
	<script charset="utf-8" src="../js/jquery-datatables/media/js/jquery.dataTables.js"></script>
	<script charset="utf-8" src="../js/jquery-datatables-bs3/assets/js/datatables.js"></script>
	<script type="text/javascript" src="../js/administrador/master.js"></script>
	<link rel="stylesheet" type="text/css" href="../styles/custom.css"> 
	<style type="text/css">
	body{
		background: #f7f7f7;
	}
	table {
		width: 100% !important;
	}

	table th, td {
		white-space: nowrap !important;
		padding: 5px 5px 5px 5px !important;
	}
</style>
</head>
<body>
	<?php 
	include("../include/menuAdministrador.php");
	?>
	<div class="container" style="margin-top: 3%">
		<?php 
		$pagina = "";
		try{
			$pagina = ($_GET['view']);
		}catch(Exception $e){
			$_GET['view'] = 'home';	
		}
		
		switch ($pagina) {
			case 'home':
			include("include/home.php");
			break;
			case 'usuarios':
			include("include/usuarios.php");
			break;
			case 'candidatos':
			include("include/candidatos.php");
			break;	
			case 'partidos':
			include("include/partidos.php");
			break;
			case 'propostas':
			include("include/propostas.php");
			break;
			case 'noticias':
			include("include/noticias.php");
			break;						
			default:		
			include("include/404.php");		
			break;
		}
		?>
	</div>


</body>
</html>