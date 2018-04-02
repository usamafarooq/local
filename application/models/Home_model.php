<?php 

class Home_model extends MY_Model
{
	public function pending($id,$type)
	{
		$this->db->select('concat(sum(deliver) - sum(received)) as pending')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 //->join('users u', 'u.id = o.Rider')
				 ->where('o.'.$type,$id)
				 ->group_by('o.'.$type);
		return $this->db->get()->row_array();
	}

	public function order($id,$type)
	{
		$this->db->select('sum(deliver) as orders')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 //->join('users u', 'u.id = o.Rider')
				 ->where('o.'.$type,$id)
				 ->group_by('o.'.$type);
		return $this->db->get()->row_array();
	}

	public function pending_order($id,$type)
	{
		$this->db->select('sum(o.Quantity) as orders,count(do.id) as sent')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id','left')
				 //->join('users u', 'u.id = o.Rider')
				 ->where('o.'.$type,$id)
				 ->group_by('o.id')
				 ->having('sent < 1');
		return $this->db->get()->result_array();
	}

	public function get_payment_history($id)
	{
		$this->db->select('sum(o.Price) as total')
				 ->from('orders o')
				 ->where('o.Client',$id)
				 ->group_by('o.Client');
		return $this->db->get()->row_array();
	}

	public function get_paid_history($id)
	{
		$this->db->select('sum(o.amount) as total')
				 ->from('payment o')
				 ->where('o.client_id',$id)
				 ->group_by('o.client_id');
		return $this->db->get()->row_array();
	}
}