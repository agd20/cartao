<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enderecos {

    protected $CI;

    public function __construct()
    {
	$this->CI =& get_instance();
	$this->CI->load->model('enderecos_model');
	$this->CI->load->helper('array');
    }

    public function get_enderecos($params)
    {
	$id_endereco = element('id_endereco', $params);
	$id_unidade = element('id_unidade', $params);
	//Se o Endereco estiver vazio busca todas os Enderecos
	if(( ! $id_endereco ) and ( ! $id_unidade ))
	{
	    $data = $this->CI->enderecos_model->get_enderecos();
	}
	else if(( ! $id_endereco ) and ($id_unidade))
	{
	    $data = $this->CI->enderecos_model->get_enderecos_unidade($id_unidade);
	}
	else if($id_endereco)
	{
	    $data = $this->CI->enderecos_model->get_endereco($id_endereco, $id_unidade);
	}
	return $data;
    }

}

?>
