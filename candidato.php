<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Candidato</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Demo project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
	<link rel="stylesheet" type="text/css" href="styles/post.css">
	<link rel="stylesheet" type="text/css" href="styles/post_responsive.css">
	<link rel="icon" href="images/author.jpg" type="image">

</head>
<body>
	<div class="super_container">
		<?php
		//adiciona o menu atraves de include
		include("include/menu.php");
		?>
		<div class="home" style="height: 350px;background-color: rgba(0, 0, 0, 0.4)">
			<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/brasil-sem-eleicao.jpg" data-speed="0.8"></div>
			<div class="home_content">
				<br>
				<br>
				<br>
				<img id="imageCandidato"> 				
			</div>
		</div>
		<div class="page_content">
			<div class="container">
				<div class="row row-lg-eq-height">
					<div class="col-lg-9">
						<br>
						<br>
						<div class="post_content">
							<div class="post_body" id="post">								
							</div>		
							<br>
							<br>
						</div>
						<br>
						<br>
						<div class="row row-lg-eq-height" style="margin-left: 10px">
							<div class="col-md-12">
								<a href="Votacao.php">
									<img src="images/anuncio-grande.jpg" style="width: 95%">
								</a>
							</div>
						</div>								
						<br>
						<br>
					</div>
					<div class="col-lg-3">
						<?php
						// top noticias via include
						include("include/topDireita.php");
						?>
						<br>
						<a href="Votacao.php">
							<?php
							// anucio via include
							include("include/anuncio.php");
							?>
						</a>
						<br>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<?php 
	//inclui o footer atraves de include
	include("include/footer.php");
	?>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="styles/bootstrap4/popper.js"></script>
	<script src="styles/bootstrap4/bootstrap.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="plugins/easing/easing.js"></script>
	<script src="plugins/masonry/masonry.js"></script>
	<script src="plugins/parallax-js-master/parallax.min.js"></script>
	<script src="js/custom.js"></script>
	<script type="text/javascript" src="js/candidatos.js"></script>
	
</body>
</html>