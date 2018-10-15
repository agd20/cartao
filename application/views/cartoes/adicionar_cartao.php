<?php

//print_r($dados);

?>
<!--<br>
<p>
<ul>{dados}
  <li>Idioma: {idioma}</li>
  <li>Unidade: {unidades}</li>
  <li>Setor: {setores}</li>
  <li>Nome: {nome}</li>
  <li>Cargo: {cargo}</li>
  <li>Cargo En: {cargo_en}</li>
  <li>Endereco: {enderecos}</li>
  <?php 
  if('{andar}' !== NULL) { ?>
  <li>Andar marcado: {c_andar}
  Andar: {andar}</li>
  <?php } ?>
  <?php
   if('{sala}' !== NULL) { ?>
  <li>Sala Marcado: {c_sala}
  Sala: {sala}</li>
  <?php } ?>
  <li>Telefone: {tel_ddd}
  {tel_prefixo}
  {tel_sufixo}</li>
  <li>Celular: {cel_ddd}
  {cel_numero}</li>
  <li>Fax: {fax_ddd}
  {fax_numero}</li>
  <li>Email: {email_prefixo}
  {email_sufixo}</li>
{/dados} </ul>
</p>-->

<?php 


  foreach ($cartoes as $value) {

    foreach ($value as $key => $value) {
      
      if ($key === "imagem"){
          $imagem = $value;
      }elseif ($key === "valor") {
          $valor = $value;
      }elseif ($key === "id_logado") {
          $id_logado = $value;
      }
    }

        echo "<img src=\"".base_url($imagem)."\" width=\"250px\" height=\"125px\"><a href=\"#\" id=\"remover_cartao\" onclick=\"remover_cartao('$valor',$id_logado);\">x</a><br>";

      

      
  
	}
?>

