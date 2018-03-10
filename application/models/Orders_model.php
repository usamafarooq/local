<?php
class Orders_model extends MY_Model{
	public function get_orders($id = null)
	{
		$this->db->select('orders.*,client.Name,client.Address,users.name,count(deliver_order.id) as sent')
				 ->from('orders')
				 ->join('deliver_order', 'deliver_order.order_id = orders.id', 'left')
				 ->join('client', 'client.id = orders.Client')
				 ->join('users', 'users.id = orders.Rider')
				 ->group_by('orders.id'); 
		if ($id != null) {
			$this->db->where('orders.user_id', $id);
		}
		return $this->db->get()->result_array();
	}

	
}