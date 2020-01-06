		<div class="row">
			<div class="col-sm-12">
				<section class="panel panel-featured panel-featured-primary">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						</div>
						<h2 class="panel-title">Propostas</h2>
						<p>Adicione propostas e gerencie</p>
						<hr>
					</header>
					<div class="panel-body">
						<div class="row" >
							<div class="col" id="mensagemTela">
								
							</div>
						</div>
						<form>
							<div class="row">
								<input type="text" name="numProposta" id="numProposta" hidden>
								<div class="col-md-6">
									<label>Candidato</label>
									<select class="form-control" id="ddlCandidato"></select>
								</div>
								<div class="col-md-6">
									<label>Imagem Proposta</label>
									<input type="file" class="form-control" id="imagemProposta">
								</div>
								<br>
								<div class="col-md-12">
									<label>Propostas</label>
									<textarea rows="8" class="form-control" id="descricaoProposta" placeholder="Descreva a prosposta..."></textarea>
								</div>
								<div class="col">		
									<button style="margin-top: 28px" id="btnGravarProposta"  type="button" class="btn btn-primary">Gravar</button>									
								</div>								
							</div>
						</form>
						<br>
						<hr>
						<h2>Lista de Propostas</h2>
						<p>Gerencie as Propostas</p>
						
						<table class="table table-striped" id="dtPropostas" style="width:100%">
							<thead>
								<tr>
									<th scope="col">Ação</th>
									<th scope="col">Partido</th>
									<th scope="col">Candidato</th>
									<th scope="col">Proposta</th>
								</tr>
							</thead>
						</div>
					</div>
				</section>
			</div>

		</div>

		<script type="text/javascript" src="../js/administrador/propostas.js"></script>