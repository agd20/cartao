    
	<div class="container-fluid">
	    <div class="row" style="margin-top:20px">
			<div class="col-4">
				<div class="card border-primary border-right-0 border-bottom-0 border-left-0">
					<div class="card-header">
						<p class="font-weight-bold">Dados do Cartão</p>
					</div>
					<div class="card-body">
						<?php echo form_open('cartoes/form_cartao', 'id="form_cartao"'); ?>
							<div class="form-group">
								<label for="idioma">Idioma* </label>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="idioma" id="idioma_b" value="1" checked> Bilingue </input>
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" name="idioma" id="idioma_i" value="2"> Inglês</input>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="unidades">Unidade* </label>
								<select name="unidades" id="unidades" class="form-control" onclick="listarSetor(this.value);listarEndereco(this.value);">
									{unidades}
										<option value="{idUnidade}">{nome}</option>
									{/unidades}
								</select>
							</div>
							<div class="form-group">
								<label for="setores">Setor* </label>
								<select name="setores" id="setores" class="form-control">
									{setores}
										<option value="{idSetor}">{nome}</option>
									{/setores}
								</select>
							</div>
							<div class="form-group">
								<label for="nome">Nome* </label>
								<input type="text" name="nome" id="nome" onblur="ativarVisualizar();" class="form-control" placeholder="Nome Sobrenome"></input>
								
								<div id="error_nome" class="alert alert-danger" role="alert" style="display:none"> </div>
							</div>
							<div class="form-group">
								<label for="cargo">Cargo</label>
								<input type="text" name="cargo" id="cargo" class="form-control"></input>
							</div>
							<div class="form-group">
								<label for="cargo_en">Cargo (en)</label>
								<input type="text" name="cargo_en" id="cargo_en" class="form-control"></input>
							</div>
							<div class="form-group">
								<label for="enderecos">Endereço* </label>
								<select name="enderecos" id="enderecos" class="form-control">
									{enderecos}
										<option value="{idEndereco}">{logradouro}, {numero}, {bairro}, {estado} - {uf}, {cep}</option>
									{/enderecos}
								</select>	
							</div>
							<div class="form-group">
								<div class="form-check form-check-inline">
									<div class="row">
										<div class="col-4">
											<label class="form-check-label">
												Andar <input type="checkbox" name="c_andar" id="c_andar" onclick="ativarAndar()" value="Andar/Floor" />
											</label>
										</div>
										<div class="col">
											<input type="text" class="form-control" name="andar" id="andar" disabled></input>
										</div>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="row">
										<div class="col-4">
											<label class="form-check-label">
												Sala <input type="checkbox" name="c_sala" id="c_sala" onclick="ativarSala()" value="Sala/Room" />
											</label>
										</div>
										<div class="col">
											<input type="text" class="form-control" name="sala" id="sala" disabled></input>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="telefone">Telefone</label>
								<div class="row" id="telefone">
									<div class="col">
										<input type="text" name="tel_ddd" id="tel_ddd" class="form-control" maxlength="2" onchange="tel()" />
									</div>
									<div class="col">
										<select name="tel_prefixo" id="tel_prefixo" class="form-control" onchange="tel()">
											<option value="3799">3799</option>
											<option value="3083">3083</option>
										</select>
									</div>
									<div class="col">
										<input type="text" name="tel_sufixo" id="tel_sufixo" class="form-control" maxlength="4" onchange="tel()" />
									</div>
									<input type="text" name="telefone_completo" id="telefone_completo" hidden />

								</div>
							</div>
							<div class="form-group">
								<label for="celular">Celular</label>
								<div class="row" id="celular">
									<div class="col-4">
										<input type="text" name="cel_ddd" id="cel_ddd" class="form-control" maxlength="2" onchange="cel()" />
									</div>
									<div class="col">
										<input type="text" name="cel_numero" id="cel_numero" class="form-control" maxlength="10" onchange="cel()"></input>
									</div>
								</div>
								<input type="text" name="celular_completo" id="celular_completo" hidden />
							</div>
							<div class="form-group">
								<label for="fax">Fax</label>
								<div class="row" id="fax">
									<div class="col-4">
										<input type="text" name="fax_ddd" id="fax_ddd" class="form-control" maxlength="2" onchange="fx()"></input>
									</div>
									<div class="col">
										<input type="text" name="fax_numero" id="fax_numero" class="form-control" maxlength="9" onchange="fx()"></input>
									</div>
								</div>
								<input type="text" name="fax_completo" id="fax_completo" hidden />
							</div>
							<div class="form-group">
								<label for="email">Email*</label>
								<div class="row" id="email">
									<div class="col-7">
										<input type="text" name="email_prefixo" id="email_prefixo" onchange="mail()" onblur="ativarVisualizar();" class="form-control"></input>
									</div>
									<div class="col">
										<select name="email_sufixo" id="email_sufixo" class="form-control" onchange="mail()">
											<option value="@fgv.br">@fgv.br</option>
											<option value="@gvmail.br">@gvmail.br</option>
											<option value="@fgvmail.br">@fgvmail.br</option>
										</select>
									</div>
									<input type="text" name="email_completo" id="email_completo" hidden />
								</div>
							</div>
							<input type="hidden" name="id_usuario" value="{id_logado}">
						</form>
					</div>
				</div>
			</div>
			<div class="col-5">
				<div class="card border-success border-right-0 border-bottom-0 border-left-0">
					<div class="card-header">
						<button type="button" name="btn_visualizar" id="btn_visualizar" class="btn btn-success text-white" onclick="ativarAprovacao();visualizarPDF({id_logado});" disabled><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Visualizar</button>
					</div>
					<div class="card-body">
						<!--<iframe src="<?php echo site_url("/cartoes/pdf");?>" id="pdf" height="500px" width="500px"></iframe>-->
						<iframe src="" id="pdf" height="500px" width="500px"></iframe>
						<input type="checkbox" id="aprovar" onclick="aprovar();" name="aprovar" disabled>Sim, eu aprovo este documento.</input>
						<button type="button" id="btn_aprovar" onclick="adicionarCartoes();" class="btn btn-warning text-white float-right" disabled><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>Adicionar ao pedido</button>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card border-info border-right-0 border-bottom-0 border-left-0">
					<div class="card-header">
						<p class="font-weight-bold">Listagem de Itens</p>
					</div>
					<div class="card-body">
						<div id="cartoes">{cartoes}<img src="<?php echo base_url('{imagem}');?>" width="250px" height="125px"><a href="#" id="remover_cartao" onclick="removerCartao('{valor}', {id_logado});">x</a>{/cartoes}</div>
						<?php if ($cartoes){ ?>
						<button type="button" id="btn_solicitar" class="btn btn-primary text-white" onclick="solicitarCartoes({id_logado});" ><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Solicitar Cartões</button>
						<?php }else{ ?>
						<button type="button" id="btn_solicitar" class="btn btn-primary text-white" onclick="solicitarCartoes({id_logado});" disabled><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Solicitar Cartões</button>
						<?php } ?>
						<div id="respteste"></div>
					</div>
				</div>
			</div>
	    </div>
	
	<script src="<?php echo base_url('assets/js/cartao.js'); ?>"> </script>

    
