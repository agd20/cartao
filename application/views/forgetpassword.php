<div class="container">
	<div class="row" style="padding-top:150px;padding-bottom:150px;">
		<div class="col-md-5 col-md-offset-4">
			<?php if($confirmacao) { ?><span style="font-size:15px; color:red;"><strong><?php echo $confirmacao; ?></strong></span><?php } ?>
			<?php echo validation_errors(); ?>
			<?php echo form_open('authentication/sendForgetEmail'); ?>
				<div class="for-group" style="padding-bottom:50px;">
					<strong>Por favor, preencha seu e-mail cadastrado</strong>
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
				</div>
				<button type="submit" class="btn btn-primary btn-block">Atualizar</button>
			</form>	
			</br>
			<p>
			<a class="btn btn-primary btn-block" href="http://www.boxeprint.com.br" role="button">Voltar</a>
			</p>
		</div>
	</div>
</div>