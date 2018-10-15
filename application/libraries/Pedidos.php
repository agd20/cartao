<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos {

    protected $CI;

    public function __construct()
    {
		$this->CI =& get_instance();
		$this->CI->load->model('pedidos_model');
		$this->CI->load->helper('array');
    }

    public function get_pedidos($usuario, $permissao, $mes, $ano)
    {
    	return $this->CI->pedidos_model->listar_pedidos($usuario, $permissao, $mes, $ano);
    }

    public function get_pedido($pedido)
    {
    	return $this->CI->pedidos_model->pedido($pedido);
    }

	public function listar_pedidos($usuario)
	{
		$cartao = "assets/pdf/tmp/$usuario/";
		$diretorio = FCPATH."assets/pdf/tmp/$usuario/";

		if(is_dir($diretorio))
		{
			$arquivos = array_diff(scandir($diretorio), array('..', '.')); 
		}



		$cartoes = array();
		if(!empty($arquivos)){
			foreach ($arquivos as $value) {
				$files[$value] = filemtime($diretorio.$value);
			}	
				asort($files);

			$files = array_keys($files);
			foreach ($files as $value){

				$extensao = substr($value, -4);
				if($extensao === '.jpg'){
					
					array_push($cartoes, ["imagem" => $cartao.$value, "valor" => $value, "id_logado" => $usuario]);
					

			
				}
			}
		}
		
		
		return $cartoes;
	}

	public function registrar_pedidos($usuario)
	{

		$cartoes = $this->listar_pedidos($usuario);

		
		$this->CI->pedidos_model->registrar_pedido($usuario);
		
		$pedido = $this->ultimo_pedido($usuario);

		$this->criar_local_armazenamento($usuario,$pedido->idPedido);
		
		$datas = array();
		foreach ($cartoes as $cartao) {

			
			

			$origem = FCPATH.substr($cartao['imagem'], 0,-4);
			$destino = FCPATH."assets/pdf/$usuario/$pedido->idPedido/";
			$dados = (object) array(
				'fkPedido' => $pedido->idPedido,
				'arquivo' => $destino.substr($cartao['valor'], 0,-4),
				'nome' => substr($cartao['valor'],0,-4),
				'data' => date('Y-m-d H:i:s')
			);

			
			array_push($datas,["idpedido"=>$dados->fkPedido,"arquivo"=>$destino,"nome"=>$dados->nome]);

			$this->CI->pedidos_model->registrar_item_pedido($dados);

			$origem = str_replace(" ", "\ ", $origem);
			$origem = $origem.'*';

			exec("cp $origem $destino");
			
			if( file_exists($destino.$dados->nome.'.pdf')){
				exec("rm $origem");
			}
			
			
		}

		
		return $datas;
		
	}


	public function criar_local_armazenamento($usuario,$pedido)
	{
		
		$diretorio = FCPATH."assets/pdf/$usuario";
		
		if(! is_dir($diretorio) )
		{
			mkdir($diretorio);
			chmod($diretorio, 0777);
		}

		mkdir($diretorio.'/'.$pedido);
		chmod($diretorio.'/'.$pedido, 0777);

	}

	public function ultimo_pedido($usuario)
	{
		$ultimo_pedido = $this->CI->pedidos_model->ultimo_pedido($usuario);
		return $ultimo_pedido;
	}
	

}

?>
