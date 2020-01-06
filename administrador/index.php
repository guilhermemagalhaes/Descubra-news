<?php 
error_reporting(0);
require_once("../include/verificaSessao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DescubraNews - Login</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../styles/contact.css">
</head>
<body>

	<div class="super_container">
		<div class="home">
			<div class="home_background parallax-window" data-parallax="scroll" data-image-src="../images/post_5.jpg" data-speed="0.8"></div>
			<div class="home_content">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 offset-lg-3">						
							<div class="post_comment">
								<div class="contact_form_container">
									<form action="#">									
										<div class="form-group">
											<div class="col-md-12">
												<h3>Login <img src="../images/nomeelogo.png" style="width: 30%; height: 30%"></h3>
											</div>
										</div>
										<div class="col-md-12">
											<div id="mensagem-erro">
												
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" id="input-login" class="form-control" placeholder="Email">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<input type="password" id="input-senha" class="form-control" placeholder="Senha" >
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-2 offset-lg-9">
												<button id="btn-entrar" type="button" class="btn btn-primary">Acessar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>

		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../styles/bootstrap4/popper.js"></script>
		<script src="../styles/bootstrap4/bootstrap.min.js"></script>
		<script src="../plugins/parallax-js-master/parallax.min.js"></script>
		<script type="text/javascript" src="../js/administrador/login.js"></script>
	</body>
	</html>