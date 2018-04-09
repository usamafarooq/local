<?php
class Pending_bottles_model extends MY_Model{
	public function get_data()
	{
		$this->db->select('sum(deliver) as deliver,sum(received) as received,do.date,c.Name')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('client c', 'o.Client = c.id')
				 ->group_by('o.Client');
		return $this->db->get()->result_array();
	}
}