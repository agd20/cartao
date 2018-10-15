<?php
class Unidades_model extends CI_Model {

    public function __construct()
    {
	$this->load->database();
    }

    public function get_unidades($idioma)
    {
		$this->db->select('idUnidade, nome, nome_en, substr(logo,26) as logo, logo_en, ingles');
		$this->db->from('unidades');
		$this->db->where('ingles >= '.$idioma);
		if($query = $this->db->get())
		{
		    if($query->num_rows() > 0)
		    {
			foreach($query->result() as $row)
			{
			    $data[] = $row;
			}
			return $data;
		    }
		    else
		    {
			return $this->db->error();
		    }
		}
		else
		{
		    return $this->db->error();
		}
    }


    public function get_unidade($id_unidade)
    {
		$this->db->select('*');
		$this->db->from('unidades');
		$this->db->where('idUnidade = '.$id_unidade);
		$this->db->order_by('nome', 'ASC');
		if($query = $this->db->get())
		{
		    if($query->num_rows() > 0)
		    {
			foreach($query->result() as $row)
			{
			    $data[] = $row;
			}
			return $data;
		    }
		    else
		    {
			return $this->db->error();
		    }
		}
		else
		{
		    return $this->db->error();
		}
    }

    public function get_unidade_idioma($idioma)
    {



    }

}

?>
