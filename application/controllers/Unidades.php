<?php

class Unidades extends CI_Controller {

    public function __construct()
    {
	parent::__construct();
	$this->load->model('unidades_model');
    }

    public function unidades()
    {


    }

    public function get_unidades()
    {
	$data = array(
	    'unidades' => $UN->unidades_model->get_unidades();
	);
	return $data;

    }

    public function set_unidades()
    {

    }

    public function delete_Unidades()
    {

    }


}
