<div class="container">
	<div class="row" style="padding-top:150px;padding-bottom:150px;">
		<div class="col-md-5 col-md-offset-4">
			<?php echo validation_errors(); ?>
			<?php echo form_open('user/update_password'); ?>
				<div class="for-group" style="padding-bottom:50px;">
					<strong>Por favor, ATUALIZE a sua Senha</strong>
				</div>
				<div class="form-group">
					<label for="password">Senha</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Senha">
				</div>
				<button type="submit" class="btn btn-primary btn-block">Atualizar</button>
			</form>	
		</div>
	</div>
</div>