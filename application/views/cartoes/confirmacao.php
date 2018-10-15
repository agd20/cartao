<?php

$i = 1;

foreach ($pedidos as $pedido) {
	$idpedido = $pedido['idpedido'];
	$arquivo[$i] = $pedido['arquivo'];
	$nome[$i] = $pedido['nome'];
	$i++;
}

?>
	<div class="container-fluid">
	    <div class="row justify-content-md-center" style="margin-top:20px">
			<div class="col-6">
				<div class="card  border-success">
					<div class="card-header bg-success text-white">
						<p class="font-weight-bold"><h2>Cartões solicitados com sucesso!</h2></p>
					</div>
					<div class="card-body">
						<?php
							echo '<p class="font-weight-bold">Pedido '.$idpedido."</p><br>";
							for($j = 1; $j < $i; $j++)
							{
								
								$imagem = base_url(substr($arquivo[$j],25)).$nome[$j].".jpg";
								echo "Cartão $nome[$j] <img src=\"$imagem\" width=\"250px\" height=\"125px\"> <br>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>