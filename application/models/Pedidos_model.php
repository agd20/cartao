<?php
class Pedidos_model extends CI_Model {

    public function __construct()
    {
	$this->load->database();
	$this->load->dbutil();
    }

    public function listar_pedidos($usuario, $permissao, $mes, $ano)
    {
		$this->db->select('p.idPedido, p.fkUsuario, p.data as data_pedido, ip.idItem_Pedido, ip.nome, SUBSTR(ip.arquivo,26) as arquivo, ip.data as data_item_pedido, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario');
		$this->db->from('pedido as p');
		$this->db->where('MONTH(p.data)',$mes);
		$this->db->where('YEAR(p.data)',$ano);
		$this->db->join('item_pedido as ip', 'p.idPedido = ip.fkPedido');
		$this->db->join('usuario as u','u.idUsuario = p.fkUsuario');
		if($permissao == 4)
		{
			$this->db->where('idUsuario = '.$usuario);
		}

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

    public function registrar_pedido($usuario)
    {
    	
    	$pedido = array(
    		'fkUsuario' => $usuario,
    		'data' => date('Y-m-d H:i:s')
    	);
    	$this->db->insert('pedido',$pedido);
    }

    public function registrar_item_pedido($dados)
    {
    	$this->db->insert('item_pedido',$dados);
    }

    public function ultimo_pedido($usuario)
    {
    	$this->db->select('max(idPedido) as idPedido');
		$this->db->from('pedido');
		$this->db->where('fkUsuario ='.$usuario);
		if($query = $this->db->get())
		{
		    if($query->num_rows() > 0)
		    {
				foreach($query->result() as $row)
				{
			   		$data = $row;
				}
				return $data;
		    }
		    else
		    {
				return 0;
		    }
		}
		else
		{
		    return $this->db->error();
		}
    }
    
    public function pedido($pedido)
   	{
   		$this->db->select('p.idPedido, p.fkUsuario, p.data as data_pedido, ip.idItem_Pedido, ip.nome, SUBSTR(ip.arquivo,26) as arquivo, ip.data as data_item_pedido, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario');
		$this->db->from('pedido as p');
		$this->db->where('p.idPedido',$pedido);
		$this->db->join('item_pedido as ip', 'p.idPedido = ip.fkPedido');
		$this->db->join('usuario as u','u.idUsuario = p.fkUsuario');
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
}

?>
