<?php
	foreach($users as $user){
		$nome = $user["nome"];
		$sobrenome = $user["sobrenome"];
		$email = $user["email"];
		$telefone = $user["telefone"];
		$departamento = $user["departamento"];
		$iduser = $user["iduser"];
		$senha = $user["senha"];
	}
?>

<div class="container">
	<div class="row col-md-10 col-md-offset-1">
		<?php echo validation_errors(); ?>

		<?php echo form_open('user/user_update'); ?>
			<div class="form-group">
				<label for="nome">*Nome</label>
				<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome; ?>"></input>
			</div>
			<div class="form-group">
				<label for="sobrenome">Sobrenome</label>
				<input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome; ?>"></input>
			</div>
			<div class="form-group">
				<label for="email">*E-mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"></input>
			</div>
			<div class="form-group">
				<label for="senha">*Senha</label>
				<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo $senha; ?>"></input>
			</div>
			<div class="form-group">
				<label for="telefone">Telefone</label>
				<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?php echo $telefone; ?>"></input>
			</div>
			<div class="form-group">
				<label for="departamento">Departamento</label>
				<input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" value="<?php echo $departamento; ?>"></input>
			</div>
			<div class="form-group">
				<label for="unidade">Unidade</label>
				<select class="form-control" name="unidade" id="unidade">
				<?php foreach($unidades as $unidade){ ?>
					<option value="<?php echo $unidade["idunidade"]; ?>"><?php echo $unidade["nome"]; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="permissao">Permissão</label>
				<select class="form-control" name="permissao" id="permissao">
					<option value="1">Super Usuário</option>
					<option value="2">Adminstrativo</option>
					<option value="3">Usuário</option>
				</select>
			</div>
			<?php echo form_hidden('iduser', $iduser); ?>
			<button type="submit" class="btn btn-primary">Atualizar Usuário</button>
		</form>
	</div>
</div>