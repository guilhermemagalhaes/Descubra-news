		<div class="row">
			<div class="col-sm-12">
				<section class="panel panel-featured panel-featured-primary">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						</div>
						<h2 class="panel-title">Partidos</h2>
						<p>Adicione partidos e gerencie</p>
						<hr>
					</header>
					<div class="panel-body">
						<div class="row" >
							<div class="col" id="mensagemTela">
								
							</div>
						</div>
						<form>
							<div class="row">
								<input type="text" name="idLegenda" id="idLegenda" hidden>
								<div class="col">
									<label>Legenda</label>
									<input type="text" class="form-control" placeholder="Legenda" id="legendaPartido">
								</div>
								<div class="col">
									<label>Imagem</label>
									<input type="file" class="form-control" placeholder="E-mail" id="imagemPartido">
								</div>								
								<div class="col">		
									<button style="margin-top: 28px" id="btnGravarPartido"  type="button" class="btn btn-primary">Gravar</button>
								</div>
							</div>
						</form>
						<br>
						<hr>
						<h2>Lista de partidos</h2>
						<p>Gerencie partidos</p>
						
						<table class="table table-striped" id="dtPartidos" style="width:100%">
							<thead>
								<tr>
									<th scope="col">Ação</th>
									<th scope="col">Legenda</th>									
								</tr>
							</thead>
						</div>
					</div>
				</section>
			</div>

		</div>

		<script type="text/javascript" src="../js/administrador/partidos.js"></script>