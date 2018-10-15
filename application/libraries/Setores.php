<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setores {

    protected $CI;

    public function __construct()
    {
	$this->CI =& get_instance();
	$this->CI->load->model('setores_model');
	$this->CI->load->helper('array');
    }

    public function get_setores($params)
    {
	$id_setor = element('id_setor',$params);
	$id_unidade = element('id_unidade',$params);
	//Se o Setor estiver vazio busca todos os setores
	if(( ! $id_setor ) and ( ! $id_unidade ))
	{
	    $data = $this->CI->setores_model->get_setores();
	}
	else if(( ! $id_setor ) and ($id_unidade))
	{
	    $data = $this->CI->setores_model->get_Setores_unidade($id_unidade);
	}
	else if($id_setor)
	{
	    $data = $this->CI->setores_model->get_setor($id_setor);
	}
	return $data;

    }

}
?>
