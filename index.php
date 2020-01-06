<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Descubra News</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Descubra News">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
	<link rel="stylesheet" type="text/css" href="styles/custom.css">
	<link rel="icon" href="images/author.jpg" type="image">
</head>
<body>
	<div class="super_container">	
		<?php
		//adiciona o menu atraves de include
		include("include/menu.php");
		?>

		<div class="home" style="height: 500px;background-color: rgba(0, 0, 0, 0.7)">			
			<div class="home_slider_background" style="background-image:url(images/brasil-fundo.jpg);"></div>			
			<div class="home_slider_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_slider_content">
								<div class="home_slider_item_category trans_200"><a id="tipoNoticia" href="#" class="trans_200"></a></div>
								<div class="home_slider_item_title">
									<!-- TEXTO NOTICIAS NO BANNER -->
									<div id="noticiaPrincipal">

									</div>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="similar_posts_container">
				<div class="container">
					<div class="row d-flex flex-row align-items-end" id="listaTop3">

					</div>
				</div>
			</div>
		</div>
		<div class="page_content" style="margin-top: 0px">
			<div class="container">
				<div class="row row-lg-eq-height">					
					<div class="col-lg-9" style="min-height: 500px; height: auto; width: 100%">						
						<div class="main_content">

							<div class="blog_section">								
								<h1>Últimas Notícias</h1>
								<hr>
								<div class="section_panel d-flex flex-row align-items-center justify-content-start">
									<div class="section_title">Categorias</div>
									<div class="section_tags ml-auto">										
										<!-- data-id serão utilizado para busca no jquery ajax -->
										<ul style="cursor: pointer;" id="filtroNoticia">
											<li style="background: #FDC816; color: white" id="f1" data-id="1"><a>Todas</a></li>
											<li style="background: #38673B; color: white" id="f2" data-id="2"><a>Candidatos</a></li>
											<li style="background: #31568C; color: white" id="f3" data-id="3"><a>Eleições 2018</a></li>
										</ul>
									</div>
								</div>
								<div class="section_content">
									<div class="row">
										<div class="col-md-12 center-block" >
											<div class="loader center-block" id="loaging"></div>
											<div id="erro">
												<div class="loader-erro">
													<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160-64c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm-80 128c-40.2 0-78 17.7-103.8 48.6-8.5 10.2-7.1 25.3 3.1 33.8 10.2 8.5 25.3 7.1 33.8-3.1 16.6-19.9 41-31.4 66.9-31.4s50.3 11.4 66.9 31.4c4.8 5.7 11.6 8.6 18.5 8.6 5.4 0 10.9-1.8 15.4-5.6 10.2-8.5 11.5-23.6 3.1-33.8C326 321.7 288.2 304 248 304z"/></svg>	
												</div>																			<p id="erro-texto">Nenhuma notícias encontrada.</p>					
											</div>
										</div>
										
										<div class="col limpa" id="listaNoticias-8">

										</div>
										<div class="col limpa" id="listaNoticias-3">
											
										</div>	


									</div>

								</div>
							</div>										
						</div>
						<!-- todo: pagina noticias 5 por pagina apenas 1 com imagem -->
						<!-- <div class="load_more" style="margin-bottom: -10px">
							<div  class="load_more_button text-center trans_200">Carregue mais</div>
						</div> -->
						<br>
						<br>
						<div class="row row-lg-eq-height">
							<div class="col-md-12">
								<a href="Votacao.php">
									<img src="images/anuncio-grande.jpg" style="width: 95%">
								</a>
							</div>
						</div>								
						<br>
						<br>
						<br>
						<br>

						<div class="row row-lg-eq-height" id="aquiCandidato" style="display: inline;">
							<h1>Pré-Candidatos Governo São Paulo</h1>
							<hr>
							<div class="row" id="listaCandidatos">

							</div>
						</div>
						<br>
						<br>

						<div class="row row-lg-eq-height" style="margin-bottom: 80px; width: 100%; display: inline;">
							<h1>Resultado Pesquisa</h1>
							<hr>
							<div class="row" id="pesquisa">
								<div id="resultado-votacao">
									
								</div>								
							</div>
						</div>
						<br>
						<br>
					</div>

					<div class="col-lg-3">
						<?php
						include("include/topDireita.php");
						?>
						<br>
						<a href="Votacao.php">
							<?php
							include("include/anuncio.php");
							?>
						</a>
						<br>
					</div>					
				</div>

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
<script type="text/javascript" src="js/noticia.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>
<script src="js/custom.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="js/graficoVotacao.js"></script>



</body>
</html>