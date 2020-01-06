<!DOCTYPE html>
<html lang="en">
<head>
	<title>Votação</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Demo project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="styles/Votacao_governador.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
	<link rel="stylesheet" type="text/css" href="styles/regular.css">
	<link rel="stylesheet" type="text/css" href="styles/regular_responsive.css">

</head>
<body>

	<div class="super_container"   data-parallax="scroll" data-image-src="images/brasil-sem-eleicao.jpg" style="height: 974px;">
		<?php
		//adiciona o menu atraves de include
		include("include/menu.php");
		?>

		<div class="home">				
			<div class="page-content">				
				<div class="container">
					<div>
						<h1>Pesquisa Governador de São Paulo</h1>	
						<p id="p-branco">Escolha um dos candidados e vote !</p>
					</div>
					<hr id="hr-branco">
					<div id="mensagemTela">
						
					</div>
					<div class="row row-lg-eq-height divVotacao">

					</div>
				</div>
				<br>			
			</div>
		</div>			
	</div>


</div>




<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/regular.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/votacao.js"></script>
</body>
</html>