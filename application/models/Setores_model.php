<?php
class Setores_model extends CI_Model {

    public function __construct()
    {
	$this->load->database();
	$this->load->dbutil();
    }

    public function get_setores()
    {
	$this->db->select('*');
	$this->db->from('setores');
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

    public function get_setores_unidade($id_unidade)
    {
	$this->db->select('setores.*');
	$this->db->from('setores');
	$this->db->join('unidade_setor','fkUnidade = '.$id_unidade);
	$this->db->where('fkSetor = idSetor');
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

    public function get_setor($id_setor)
    {
	$this->db->select('*');
	$this->db->from('setores');
	$this->db->where('idSetor = '.$id_setor);
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
	    return false;
	}
	else
	{
	    return $this->db->error();
	}

    }

}

?>
