		<div class="row">
			<div class="col-sm-12">
				<section class="panel panel-featured panel-featured-primary">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						</div>
						<h2 class="panel-title">Notícias</h2>
						<p>Adicione notícias e gerencie</p>
						<hr>
					</header>
					<div class="panel-body">
						<div class="row" >
							<div class="col" id="mensagemTela">
								
							</div>
						</div>
						
						<div class="row">
							<input type="text" name="numNoticia" id="numNoticia" hidden>
							<div class="col-md-12">
								<label>Título</label>
								<input class="form-control" name="tituloNoticia" id="tituloNoticia" type="text" />
								<br>	
							</div>
							<div class="col-md-6">
								<label>Candidato relacionado</label>
								<select class="form-control" id="ddlCandidato" name="ddlCandidato"></select>
							</div>
							<div class="col-md-6">
								<label>Partido relacionado</label>
								<select class="form-control" id="ddlPartido" name="ddlPartido"></select>
								<br>
							</div>
							<div class="col">
								<label>Autor</label>
								<input class="form-control" id="autorNoticia" name="autorNoticia" type="text" />						
							</div>
							<div class="col">
								<label>Fonte</label>
								<input class="form-control" id="fonteNoticia" name="fonteNoticia" type="text" />
							</div>
							
							<div class="col">
								<label>Link Imagem</label>
								<input class="form-control" id="imagem" name="imagem" type="text" />
								<br>	
							</div>
							
							<br>
							<div class="col-md-12">
								<label>Texto</label>
								<textarea rows="6" class="form-control" id="descricaoNoticia" placeholder="Descreva a notícia..."></textarea>
							</div>
							<div class="col">		
								<button style="margin-top: 28px" id="btnGravarNoticia" type="button" class="btn btn-primary">Gravar</button>									
							</div>								
						</div>
						
						<br>
						<hr>
						<h2>Lista de Notícias</h2>
						<p>Gerencie as notícias</p>
						<div class="table-responsive">
							<table class="table table-striped" id="dtNoticias" style="width:100%">
								<thead>
									<tr>
										<th scope="col">Ação</th>
										<th scope="col">Título</th>
										<th scope="col">Data notícia</th>
										<th scope="col">Texto</th>									
										<th scope="col">Candidato/Partido Candidato</th>
										<th scope="col">Partido Notícia</th>
										<th scope="col">Autor</th>
										<th scope="col">Fonte</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</section>
		</div>

	</div>

	<script type="text/javascript" src="../js/administrador/noticias.js"></script> 