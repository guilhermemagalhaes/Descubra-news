<!DOCTYPE html>
<html lang="en">
<head>
	<title>Post</title>
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
	<link rel="stylesheet" type="text/css" href="styles/custom.css">
</head>
<body>

	<div class="super_container">
		<?php
		//adiciona o menu atraves de include
		include("include/menu.php");
		?>
		<div class="home" style="height: 380px;">
			<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/brasil-fundo.jpg" data-speed="0.8"></div>
		</div>
		
		<!-- Page Content -->

		<div class="page_content">
			<div class="container">
				<div class="row row-lg-eq-height">
					<!-- Post Content -->
					<div class="col-lg-9" style="margin-bottom: 50px">
						<div class="post_content">
							<!-- Top Panel -->
							<div id="top" class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
								
							</div>

							<!-- Post Body -->

							<div class="post_body" id="corpo">
																							
								
								
								
							</div>
						</div>
					</div>				
					<div class="col-lg-3">
						<?php
						include("include/topDireita.php");
						?>
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
	<script type="text/javascript" src="js/custom.js"></script>
	<script src="js/noticiaUnica.js"></script>
	
</body>
</html>