<?php
class Client_model extends MY_Model{
	public function get_order_history($id)
	{
		$this->db->select('deliver,received,do.date,u.name')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->where('o.Client',$id);
		return $this->db->get()->result_array();
	}

	public function get_payment_history($id)
	{
		$this->db->select('o.Date as date,o.Price as amount, "Order" as status')
				 ->from('orders o')
				 ->where('o.Client',$id);
		return $this->db->get()->result_array();
	}

	public function get_paid_history($id)
	{
		$this->db->select('DATE(o.created_at) as date,o.amount, "Paid" as status')
				 ->from('payment o')
				 ->where('o.client_id',$id);
		return $this->db->get()->result_array();
	}
}