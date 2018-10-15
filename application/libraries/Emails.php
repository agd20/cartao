<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails {

    protected $CI;

    public function __construct()
    {
		$this->CI =& get_instance();
		$this->CI->load->helper('array');
		$this->CI->load->library('session');
		$this->CI->load->library('email');
    }

    public function email_enviar($params)
    {
     	
    	//$id_endereco = element('id_endereco', $params);
		//$id_unidade = element('id_unidade', $params);
		$mensagem = element('mensagem', $params);
		$titulo = element('titulo', $params);

		

		$config = Array(
        
	        'protocol' => 'smtp',
	        'smtp_host' => 'smtp.boxeprint.com.br',
	        'smtp_port' => 587,
	        'smtp_user' => 'fgv@boxeprint.com.br', // change it to yours
	        'smtp_pass' => 'P3dr0.Luc4s', // change it to yours
	        'mailtype' => 'html',
	        'charset' => 'utf-8',
	        'wordwrap' => FALSE,
	        'validation' => TRUE,
	        'newline' => '\r\n'
      	);
      	$email_logado = $this->CI->session->email;

	    
	    $this->CI->email->initialize($config); 
	    $this->CI->email->from('fgv@boxeprint.com.br', 'Cartões Boxeprint FGV');
	    $this->CI->email->to($email_logado);
	    $this->email->cc('paulo@boxeprint.com.br, renan.agues@fgv.br, bruno@boxeprint.com.br');
	    $this->CI->email->bcc('rodrigo.tornaciole@gmail.com');


	    $this->CI->email->subject($titulo);
	      
	      
	      
	    $this->CI->email->message($mensagem);

	    if($this->CI->email->send())
	    {
	      //echo 'Email sent.';
			//$this->order_model->update_emailEnviado($data['info']['lastpedido']);
	    }
	    else
	    {
	     //  show_error($this->email->print_debugger());
	    }
    
    }

    public function email_mensagem_confirmar_pedido($pedidos)
    {

		$i = 1;

		foreach ($pedidos as $pedido) {
			$idpedido = $pedido['idpedido'];
			$arquivo[$i] = $pedido['arquivo'];
			$nome[$i] = $pedido['nome'];
			$i++;
		}
		$mensagem = "<div class=\"container-fluid\">
			    <div class=\"row justify-content-md-center\" style=\"margin-top:20px\">
					<div class=\"col-6\">
						<div class=\"card  border-success\">
							<div class=\"card-header bg-success text-white\">
								<p class=\"font-weight-bold\"><h2>Cartões solicitados com sucesso!</h2></p>
							</div>
							<div class=\"card-body\">
								<p class=\"font-weight-bold\">Pedido $idpedido</p><br>";
									for($j = 1; $j < $i; $j++)
									{
										$mensagem .= "Cartão $nome[$j] <br>";
									}
							$mensagem .= "</div>
						</div>
					</div>
				</div>
			</div>";
		return $mensagem;
    }
	
}

?>
