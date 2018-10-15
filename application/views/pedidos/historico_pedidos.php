
<table class="table table-hover" style="margin-top:50px;">
	<thead>
		<tr class="table-dark">
			<th scope="col">Id Pedido</th>
			<th scope="col">Data do Pedido</th>
			<th scope="col">Usuário</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$idPedido_atual = 0;
			
			
			foreach ($pedidos as $pedido) {
			if($pedido != ''){	
				if($idPedido_atual != $pedido->idPedido)
				{
					if($idPedido_atual != 0){
						echo "<p style=\"margin-top: 30px;\">
						<a class=\"btn btn-success\" href=\"".site_url('pedido/download_pedidos/'.$idPedido_atual)."\" role=\"button\">Download</a></p>
						</td><td id=\"img$idPedido_atual\"></td></tr>";
					}
					$idPedido_atual = $pedido->idPedido;
			?>
					<tr>
						<th scope="row">
							<a class="btn btn-primary" data-toggle="collapse" href="#collapse<?php echo$pedido->idPedido;?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo$pedido->idPedido;?>">
								<?php echo $pedido->idPedido;?>	
							</a>
							
						</th>
						<td><?php echo $pedido->data_pedido?></td>
						<td><?php echo $pedido->nome_usuario.' '.$pedido->sobrenome_usuario?></td>
					</tr>
					<tr class="collapse" id="collapse<?php echo$pedido->idPedido;?>">
						<td>
							<div>
								<strong>Cartão</strong>
							</div>		

			<?php
				}
			?>
							<div>
								<a href="#cartao" onclick="carregar_imagem('<?php echo base_url($pedido->arquivo); ?>','<?php echo $idPedido_atual; ?>');"><?php echo $pedido->nome?></a>
							</div>
								
		<?php
			}
			}
		?>					<p style="margin-top: 30px;">
							<a class="btn btn-success" href="<?php echo site_url('pedido/download_pedidos/'.$idPedido_atual);?>" role="button">Download</a>
							</p>
						</td>
						<td id="img<?php echo $idPedido_atual;?>">
							
						</td>
					</tr>
					
	</tbody>
</table>
		
<script src="<?php echo base_url('assets/js/pedido.js'); ?>"> </script>
		
	
