<?php

class Authentication extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
		$this->load->model('user_model');
        $this->load->helper('url_helper');
		$this->load->library('session');
		$this->load->helper('url');
    }
	
	public function index()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		
		/*
		$cnt = $this->session->cnt;
		
		
		for($i=1;$i<=$this->session->cnt;$i++){
			$fpi = "full_path_session".$i;
			$cni = "client_name_session".$i;
			$qtdpgi = "qtdpg".$i;
			$fp = $this->session->$fpi;
			$cn = $this->session->$cni;
			$qtd = $this->session->$qtdpgi;
			
			$this->session->unset_userdata($fp);
			$this->session->unset_userdata($cn);
			$this->session->unset_userdata($qtd);
			$this->session->unset_userdata("full_path_session".$i);
			$this->session->unset_userdata("client_name_session".$i);
			$this->session->unset_userdata("qtdpg".$i);
		}
		$this->session->unset_userdata('cnt');
		*/
		$this->form_validation->set_rules('email', 'Email', 'callback_email_check|valid_email|required', array('required'=>'O %s deve ser preenchido.'));
		$this->form_validation->set_rules('password', 'Senha', 'trim|required', array('required'=>'A %s deve ser preenchida.'));
		
		if (($this->form_validation->run() == TRUE) or ($this->session->nome <> '')) 
		{
			/*($this->load->view('templates/header');
			$this->load->view('templates/menu');
			if($this->session->categoria == 4){
				redirect('cartoes/index');
			}else{
				$this->load->view('cartoes/index');
			}
			$this->load->view('templates/footer');	*/
			redirect('/cartoes/index');
		}
		else
		{			
	
			$this->load->view('templates/header');
			$this->load->view('auth.php');
			$this->load->view('templates/footer');
			
		}
	}
	
	public function email_check($str)
	{
		if(($str == '') or ($this->auth_model->auth_validation()))
    {
      //$this->load->library('session');
      $row = $this->auth_model->auth_validation();
      $idUser = $row['idUsuario'];
      $nome = $row['nome'];
      $email = $row['email'];
      $categoria = $row['fkPermissao'];
      $this->auth_session($idUser,$nome,$categoria,$email);
      return TRUE;
    }
    else
    {
      $row = $this->auth_model->nopassword();
      $password = $row['senha'];
      if($password == ""){
        
        
        $idUser = $row['idUsuario'];
        $nome = $row['nome'];
        $email = $row['email'];
        $categoria = $row['fkPermissao'];
        $this->auth_session($idUser,$nome,$categoria,$email);
        $this->user_model->update_password($this->input->post('password'),$idUser);
        return TRUE;
      }
      else{
        $this->form_validation->set_message('email_check','O Email ou Senha não é valido.');
        return FALSE;
      }
    }
	
	}
	
	public function auth_session($idUser,$nome,$categoria,$email)
	{
		$data = array(
		  'iduser' => $idUser,
		  'nome' => $nome,
		  'categoria' => $categoria,
		  'email' => $email,
		  'logged_in' => TRUE
		);
		
		$this->session->set_userdata($data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('templates/logout');
	}
	
	public function sendForgetEmail()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', array('required'=>'A %s deve ser preenchida.'));
		
		if (($this->form_validation->run() == FALSE)){
				
			$this->load->view('templates/header');
			$this->load->view('forgetpassword.php');
			$this->load->view('templates/footer');
				
				
			
		}else
		{
			$email = $this->input->post('email');
			$users = $this->user_model->get_email($email);
			foreach($users as $user){ 
			if ($user->iduser)
			{
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
				
				
				$this->load->library('email');
				$this->email->initialize($config); 
				$this->email->from('fgv@boxeprint.com.br', 'Boxeprint Cartões FGV');
				$this->email->to($email);
				//$this->email->cc('paulo@boxeprint.com.br, renan.agues@fgv.br');
				//$this->email->bcc('rodrigo.tornaciole@gmail.com');
				$novaSenha = $this->geraSenha(15, true, true, true);
				$senha = $this->user_model->update_password($novaSenha,$user->iduser);
				
				$this->email->subject('Cartões FGV - Nova Senha');
				
				$message = "Foi gerado uma senha temporária. Sua senha é ".$novaSenha;
				
				$this->email->message($message);

				if($this->email->send())
				{
				  //echo 'Email sent.';
				 }
				 else
				{
				 show_error($this->email->print_debugger());
				}
				$data['confirmacao'] = "Sua Senha foi atualizada e enviada para seu e-mail";
			}}
			
			$this->load->view('templates/header');
			$this->load->view('forgetpassword.php',$data);
			$this->load->view('templates/footer');
		}
	}
	
	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;	
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}
	
}
?>