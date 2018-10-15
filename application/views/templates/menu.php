<?php
	$mes = date('m');
	$ano = date('Y');
?>
<div class="row">
	<div class="col">
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3c8dbc;">
			<a class="navbar-brand" href="#">FGV</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url(); ?>">Início</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url('pedido/historico_pedidos/'.$mes.'/'.$ano); ?>">Histórico de pedidos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Modelos Salvos</a>
					</li>
				</ul>
			</div>
			<span class="navbar-text" style="margin-right: 30px;">
    			{usuario_logado}
  			</span>
  			<span class="navbar-text">
    			<a href="<?php echo site_url("Authentication/logout"); ?>"><button type="button" class="btn btn-outline-danger">Sair</button></a>
  			</span>
		</nav>

	</div>
</div>