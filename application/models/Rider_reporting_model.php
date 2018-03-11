<?php
class Rider_reporting_model extends MY_Model{
	public function get_orders($id,$start,$end)
	{
		$this->db->select('deliver,received,do.date,u.name')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->where('o.Rider',$id)
				 ->where('do.date >=',$start)
				 ->where('do.date <=',$end)
				 ->group_by('o.id');
		return $this->db->get()->result_array();
	}
}