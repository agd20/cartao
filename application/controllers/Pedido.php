<?php



class Pedido extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->library('parser');
		$this->load->library('pedidos');
		$this->load->library('downloads');
		$this->load->helper('url');
		$this->load->library('session');
    }

    public function historico_pedidos($mes, $ano)
    {
		$dataUsuario = array(
			'usuario_logado' => $this->session->nome,
			'id_logado' => $this->session->iduser,
			'categoria_logado' => $this->session->categoria,
			'email_logado' => $this->session->email,
		);
		
		$pedidos = $this->pedidos->get_pedidos(
			$this->session->iduser, 
			$this->session->categoria, 
			$mes, 
			$ano
		);
		
		
		

		$data['pedidos'] = $pedidos;
		

		$this->load->view('templates/header');
		$this->parser->parse('templates/menu',$dataUsuario);
		$this->load->view('pedidos/historico_pedidos', $data);
		$this->load->view('templates/footer');
    }

   public function download_pedidos()
   {
   		$pedidos = $this->pedidos->get_pedido($this->uri->segment(3));
   		$this->downloads->download_arquivo($pedidos);

   }

}
