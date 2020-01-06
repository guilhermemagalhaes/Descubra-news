		<div class="row">
			<div class="col-sm-12">
				<section class="panel panel-featured panel-featured-primary">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						</div>
						<h2 class="panel-title">Usuarios</h2>
						<p>Adicione usuarios e gerencie</p>
						<hr>
					</header>
					<div class="panel-body">
						<div class="row" >
							<div class="col" id="mensagemTela">
								
							</div>
						</div>
						<form>
							<div class="row">
								<input type="text" name="idUsuario" id="idUsuario" hidden>
								<div class="col">
									<label>Nome</label>
									<input type="text" class="form-control" placeholder="Nome" id="nomeUsuario">
								</div>
								<div class="col">
									<label>E-mail</label>
									<input type="text" class="form-control" placeholder="E-mail" id="emailUsuario">
								</div>
								<div class="col">
									<label>Senha</label>
									<input type="password" class="form-control" placeholder="Senha" id="senhaUsuario" maxlength="10">
								</div>
								<div class="col">		
									<button style="margin-top: 28px" id="btnGravarUsuario"  type="button" class="btn btn-primary">Gravar</button>
								</div>
							</div>
						</form>
						<br>
						<hr>
						<h2>Lista de Usuarios</h2>
						<p>Gerencie usuarios</p>
						
						<table class="table table-striped" id="dtUsuario" style="width:100%">
							<thead>
								<tr>
									<th scope="col">Ação</th>
									<th scope="col">Nome</th>
									<th scope="col">E-mail</th>
								</tr>
							</thead>
						</div>
					</div>
				</section>
			</div>

		</div>

		<script type="text/javascript" src="../js/administrador/usuarios.js"></script>