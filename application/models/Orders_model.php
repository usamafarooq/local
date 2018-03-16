<?php
class Orders_model extends MY_Model{
	public function get_orders($id = null)
	{
		$this->db->select('orders.*,client.Name,client.Address,users.name,count(deliver_order.id) as sent')
				 ->from('orders')
				 ->join('deliver_order', 'deliver_order.order_id = orders.id', 'left')
				 ->join('client', 'client.id = orders.Client')
				 ->join('users', 'users.id = orders.Rider','left')
				 ->group_by('orders.id'); 
		if ($id != null) {
			$this->db->where('orders.user_id', $id);
		}
		return $this->db->get()->result_array();
	}

	public function get_rider_orders($id,$date)
	{
		$this->db->select('orders.*,client.Name,client.Address,users.name,count(deliver_order.id) as sent')
				 ->from('orders')
				 ->join('deliver_order', 'deliver_order.order_id = orders.id', 'left')
				 ->join('client', 'client.id = orders.Client')
				 ->join('users', 'users.id = orders.Rider')
				 ->group_by('orders.id')
				 ->where('Rider',$id)
				 ->where('orders.Date',$date); 
		return $this->db->get()->result_array();
	}

	public function get_client_orders($id)
	{
		$this->db->select('orders.*,client.Name,client.Address,users.name,count(deliver_order.id) as sent')
				 ->from('orders')
				 ->join('deliver_order', 'deliver_order.order_id = orders.id', 'left')
				 ->join('client', 'client.id = orders.Client')
				 ->join('users c','c.id = client.main_id')
				 ->join('users', 'users.id = orders.Rider','left')
				 ->group_by('orders.id')
				 ->where('c.id',$id); 
		return $this->db->get()->result_array();
	}

	public function get_detail($id)
	{
		$this->db->select('orders.*,client.Name,client.Address,users.name,count(deliver_order.id) as sent')
				 ->from('orders')
				 ->join('deliver_order', 'deliver_order.order_id = orders.id', 'left')
				 ->join('client', 'client.id = orders.Client')
				 ->join('users', 'users.id = orders.Rider')
				 ->group_by('orders.id')
				 ->where('orders.id',$id); 
		return $this->db->get()->row_array();
	}

	public function get_pending($id)
	{
		$this->db->select('concat(sum(deliver) - sum(received)) as pending')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->where('o.Client',$id)
				 ->group_by('o.Client');
		return $this->db->get()->row_array();
	}

	public function get_peyment($id)
	{
		$this->db->select('sum(p.amount) as amount')
				 ->from('payment p')
				 ->where('p.client_id',$id)
				 ->group_by('p.client_id');
		return $this->db->get()->row_array();
	}
	public function get_price($id)
	{
		$this->db->select('sum(o.Price) as price')
				 ->from('orders o')
				 ->where('o.Client',$id)
				 ->group_by('o.Client');
		return $this->db->get()->row_array();
	}
}