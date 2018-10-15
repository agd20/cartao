<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades {

    protected $CI;

    public function __construct()
    {
	$this->CI =& get_instance();
	$this->CI->load->model('unidades_model');
	$this->CI->load->helper('array');
    }

    public function get_unidades($params)
    {
	
        $idioma = element('idioma',$params);
        $id_unidade = element('id_unidade',$params);
        //Se o Setor estiver vazio busca todos os setores
        if((  $idioma ) and ( ! $id_unidade ))
        {
            $data = $this->CI->unidades_model->get_unidades($idioma);
        }
        else if(( ! $idioma ) and ($id_unidade))
        {
            $data = $this->CI->unidades_model->get_unidade($id_unidade);
        }
        /*else if($idioma)
        {
            $data = $this->CI->unidades_model->get_unidade_idioma($idioma);
        }*/

        return $data;
    }

    public function set_unidade($params)
    {

    }
}

?>
