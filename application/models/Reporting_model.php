<?php
class Reporting_model extends MY_Model{
	public function get_orders($id,$start,$end)
	{
		$this->db->select('deliver,received,do.date,u.name')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->where('o.Client',$id)
				 ->where('do.date >=',$start)
				 ->where('do.date <=',$end);
		return $this->db->get()->result_array();
	}
}