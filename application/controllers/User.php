<?php

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('unit_model');
        $this->load->helper('url_helper');
		$this->load->library('session');
		$this->load->library('cart');
    }
	
	public function user()
	{
		$data['users'] = $this->user_model->getall_user();
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('user/user',$data);
		$this->load->view('templates/footer');	
	}
	
	public function user_create()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome', 'Nome', 'required', array('required'=>'O %s deve ser preenchido.'));
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required', array('required'=>'O %s deve ser preenchido.'));
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required', array('required'=>'A %s deve ser preenchida.'));
		
		if ($this->form_validation->run() == TRUE) 
		{
			$this->user_model->create_user();
			$this->user();
		}
		else
		{
			$data['unidades'] = $this->unit_model->getall_unit();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('user/user_create',$data);
			$this->load->view('templates/footer');	
		}
	}
	
	public function user_update()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nome', 'Nome', 'required', array('required'=>'O %s deve ser preenchido.'));
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required', array('required'=>'O %s deve ser preenchido.'));
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required', array('required'=>'A %s deve ser preenchida.'));
		
		if ($this->form_validation->run() == TRUE) 
		{
			$this->user_model->update_user();
			$this->user();
		}
		else
		{
	
			$data['users'] = $this->user_model->get_user($this->uri->segment(3));
			$data['unidades'] = $this->unit_model->getall_unit();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('user/user_update',$data);
			$this->load->view('templates/footer');	
		}
	}
	
	public function user_delete()
	{
		$this->user_model->delete_user($this->uri->segment(3));
		$this->user();
	}
	
	public function update_password()
	{
		$this->load->helper(array('form','url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('password', 'senhaAtual', 'trim|required', array('required'=>'A %s deve ser preenchida.'));
		
		if (($this->form_validation->run() == FALSE)){
				
				
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('user/password');
			$this->load->view('templates/footer');	
				
			
		}else
		{
			$this->user_model->update_password($this->input->post('password'),$this->session->iduser);
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('user/password');
			$this->load->view('templates/footer');	
		}
		
	}
}
?>