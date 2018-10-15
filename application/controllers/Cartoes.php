<?php



class Cartoes extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->library('parser');
		$this->load->library('unidades');
		$this->load->library('setores');
		$this->load->library('enderecos');
		$this->load->library('pedidos');
		$this->load->library('emails');
		$this->load->helper('url');
		$this->load->model('unidades_model');
		$this->load->model('setores_model');
		$this->load->library('session');
    }

    public function index()
    {
        $this->load->helper(array('form', 'url'));
		//Inicializa a tela de cartao, com idioma em Bilingue, Unidade 1, Setor 1, endereco 1
		$unidade = array('idioma' => 1, 'id_unidade' => '');
		$setor = array('id_setor' => '', 'id_unidade' => 1);
		$endereco = array('id_endereco' => '', 'id_unidade' => 1);
		$data = array(
		    'unidades' => $this->unidades->get_unidades($unidade),
		    'setores' => $this->setores->get_setores($setor),
		    'enderecos' => $this->enderecos->get_enderecos($endereco),
		    'cartoes' => $this->pedidos->listar_pedidos($this->session->iduser),
		    'usuario_logado' => $this->session->nome,
			'id_logado' => $this->session->iduser,
			'categoria_logado' => $this->session->categoria,
			'email_logado' => $this->session->email,

		);

		$dataUsuario = array(
			'usuario_logado' => $this->session->nome,
			'id_logado' => $this->session->iduser,
			'categoria_logado' => $this->session->categoria,
			'email_logado' => $this->session->email,
		);
		
		$this->load->view('templates/header');
		$this->parser->parse('templates/menu',$dataUsuario);
		$this->parser->parse('cartoes/index', $data);
		$this->load->view('templates/footer');
    }

    public function listar_setor()
    {
		$setor = array('id_setor' => '', 'id_unidade' => $this->uri->segment(3));
		$data = array(
		    'setores' => $this->setores->get_setores($setor)
		);
		$this->parser->parse('cartoes/lista_setor', $data);
    }

    public function listar_endereco()
    {
		$endereco = array('id_endereco' => '', 'id_unidade' => $this->uri->segment(3));
		$data = array(
		    'enderecos' => $this->enderecos->get_enderecos($endereco)
		);
		$this->parser->parse('cartoes/lista_endereco', $data);
    }

   

    public function pdf($id_usario,$info)
    {
    	
		$dados = explode(",",$info);
		$usuario = $id_usario;
		$unidade =  array('idioma' => '', 'id_unidade' => $dados[0]);
		$setor = array('id_setor' => $dados[1], 'id_unidade' => '');
		$endereco = array('id_endereco' => $dados[5], 'id_unidade' => $dados[0]);
		$data['unidades'] =  $this->unidades->get_unidades($unidade);
		$data['nomes'] = str_replace('%20',' ',$dados[2]);
		$data['setores'] = $this->setores->get_setores($setor);
		$data['id_usuario'] = $usuario;
		if($dados[3]){
			$data['cargo'] = str_replace('%20',' ',$dados[3]);
		}else{ $data['cargo'] = ''; }
		if($dados[4]){
			$data['cargo_en'] = str_replace('%20',' ',$dados[4]);
		}else{ $data['cargo_en'] = ''; }
		$data['enderecos'] = $this->enderecos->get_enderecos($endereco);
		if($dados[7])
		{
			$data['c_andar'] = $dados[6];
			$data['andar'] =  $dados[7];
		}else{ $data['c_andar'] = ''; $data['andar'] =''; }
		if($dados[9])
		{
			$data['c_sala'] = $dados[8];
			$data['sala'] =  $dados[9];

		}else{ $data['c_sala'] = ''; $data['sala'] =''; }
		if($dados[10]){
			$data['telefone_completo'] = str_replace('%20',' ',$dados[10]);
		}else{ $data['telefone_completo'] = ''; }
		if($dados[11]){
			$data['celular_completo'] = str_replace('%20',' ',$dados[11]);
		}else{ $data['celular_completo'] = ''; }
		if($dados[12]){
			$data['fax_completo'] = str_replace('%20',' ',$dados[12]);
		}else{ $data['fax_completo'] = ''; }
		$data['email_prefixo'] = str_replace('%20',' ',$dados[13]);
		$data['email_sufixo'] = str_replace('%20',' ',$dados[14]);
		if(!is_dir($usuario)){
			mkdir("/var/www/html/cartao_fgv/assets/pdf/tmp/".$usuario, 0777);
			chmod("/var/www/html/cartao_fgv/assets/pdf/tmp/".$usuario, 0777);
		}
		$this->load->view('pdf/pdf', $data);
    }

    public function adicionar_cartao()
    {
		$nome = $this->input->post('nome');

		$usuario = $this->input->post('id_usuario');

		//exec("convert -density 300 /var/www/html/cartao_fgv/assets/pdf/tmp/$usuario/'$nome'.pdf /var/www/html/cartao_fgv/assets/pdf/tmp/$usuario/'$nome'.jpg");
		exec("gs -sDEVICE=jpeg -dNOPAUSE -dBATCH -r300 -sOutputFile=/var/www/html/cartao_fgv/assets/pdf/tmp/$usuario/'$nome'.jpg /var/www/html/cartao_fgv/assets/pdf/tmp/$usuario/'$nome'.pdf");
		$data['cartoes'] = $this->pedidos->listar_pedidos($usuario);
		$this->load->view('cartoes/adicionar_cartao',$data);

    }

   public function remover_cartao($usuario,$dados)
   {
   		$arquivo = $dados;
   		$arquivo = str_replace("%20", " ", $arquivo);
   		


   		exec("rm /var/www/html/cartao_fgv/assets/pdf/tmp/$usuario/'$arquivo'*");

   		$data['cartoes'] = $this->pedidos->listar_pedidos($usuario);
		$this->load->view('cartoes/adicionar_cartao',$data);
   }

   public function solicitar_pedido($usuario)
   {

   		$pedido = $this->pedidos->registrar_pedidos($usuario);

   		

   		$data['pedidos'] = $pedido;
   		$dataUsuario = array(
			'usuario_logado' => $this->session->nome,
			'id_logado' => $this->session->iduser,
			'categoria_logado' => $this->session->categoria,
			'email_logado' => $this->session->email,
		);
		if($pedido[0]['idpedido']){
			$email = array(
				'mensagem' => $this->emails->email_mensagem_confirmar_pedido($pedido),
				'titulo' => 'Pedido '.$pedido[0]['idpedido'],
			);

			$this->emails->email_enviar($email);
		}
		
		$this->load->view('templates/header');
		$this->parser->parse('templates/menu',$dataUsuario);
   		$this->load->view('cartoes/confirmacao',$data);
   		$this->load->view('templates/footer');

   }

}
