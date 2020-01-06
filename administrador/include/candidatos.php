		<div class="row">
			<div class="col-sm-12">
				<section class="panel panel-featured panel-featured-primary">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						</div>
						<h2 class="panel-title">Candidatos</h2>
						<p>Adicione candidatos e gerencie</p>
						<hr>
					</header>
					<div class="panel-body">
						<div class="row" >
							<div class="col-md-12" id="mensagemTela">
								
							</div>
						</div>						
						<div class="form-group">
							<div class="row">
								<input type="text" name="codCandidato" id="codCandidato" hidden>
								<div class="col-md-3">
									<label class="control-label">Nome</label>
									<input type="text" name="nomeCandidato" id="nomeCandidato" class="form-control" placeholder="Nome...">	
								</div>
								<div class="col-md-3">
									<label class="control-label">Data Nascimento</label>
									<input type="text" name="dtNascimentoCandidato" id="dtNascimentoCandidato" class="form-control" placeholder="DD/MM/AAAA">	
								</div>
								<div class="col-md-3">
									<label>Partido</label>
									<select class="form-control" id="ddlPartido">										
									</select>
								</div>								
								<div class="col-md-3">
									<label>Imagem</label>
									<input type="text" name="imagemCandidato" id="imagemCandidato" class="form-control">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<label>Biografia</label>
									<textarea id="bioCandidato" name="bioCandidato" rows="6" class="form-control" placeholder="Descreva o candidato..."></textarea>
								</div>
								
								<div class="col-md-12">
								<br>
									<button type="button" class="btn btn-primary" id="btnGravarCandidato">Gravar</button>
								</div>								
							</div>
						</div>						
						<br>
						<br>
						<br>						
						<br>
						<hr>
						<h2>Lista de Candidatos</h2>
						<p>Gerencie candidatos</p>
						<br>
						<table class="table table-striped" id="dtCandidato" style="width:100%">
							<thead>
								<tr>
									<th scope="col">Ação</th>
									<th scope="col">Nome</th>
									<th scope="col">Partido</th>
									<th scope="col">Data Nascimento</th>
									<th scope="col">Biografia</th>
								</tr>
							</thead>
						</div>
					</div>
				</section>
			</div>

		</div>
		<script type="text/javascript" src="../js/administrador/master.js"></script>
		<script type="text/javascript" src="../js/administrador/candidatos.js"></script>

