<?php
class Client_model extends MY_Model{
	public function get_order_history($id,$start=null,$end=null)
	{
		$this->db->select('deliver,received as empty,do.date,u.name,o.Price as amount, p.amount as received')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->join('payment p', 'p.client_id = o.Client and do.date = DATE(p.created_at)', 'left')
				 ->where('o.Client',$id)
				 ->order_by('do.date');
		if ($start != null) {
			$this->db->where('do.date >=',$start);
		}
		if ($end != null) {
			$this->db->where('do.date <=',$end);
		}		 
		return $this->db->get()->result_array();
	}

	public function get_pending($id,$date=null)
	{
		$this->db->select('concat(sum(deliver) - sum(received)) as pending')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->where('o.Client',$id)
				 ->group_by('o.Client');
		if ($date != null) {
			$this->db->where('do.date <=',$date);
		}
		return $this->db->get()->row_array();
	}

	public function get_payment_history($id,$date=null)
	{
		$this->db->select('o.Date as date,o.Price as amount, "Order" as status')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->where('o.Client',$id);
		if ($date != null) {
			$this->db->where('do.date <=',$date);
		}
		return $this->db->get()->result_array();
	}

	public function get_paid_history($id,$date=null)
	{
		$this->db->select('DATE(o.created_at) as date,o.amount, "Paid" as status')
				 ->from('payment o')
				 ->where('o.client_id',$id);
		if ($date != null) {
			$this->db->where('DATE(o.created_at) <=',$date);
		}
		return $this->db->get()->result_array();
	}

	public function get_rider_client($id,$date,$day)
	{
		//return $this->db->query("SELECT `client`.* FROM `assign_rider` JOIN `users` ON `users`.`id` = `assign_rider`.`Rider` JOIN `client` on find_in_set(client.id,assign_rider.Client) where Rider = ".$id." and Date = '".$date."' and ")->result_array();
		return $this->db->query("SELECT `client`.* FROM `assign_rider` JOIN `users` ON `users`.`id` = `assign_rider`.`Rider` JOIN `client` on assign_rider.Day = client.Day and  find_in_set(client.Area,assign_rider.Area) left join orders o on client.id = o.Client and o.Date = '".$date."' where assign_rider.Rider = ".$id." and assign_rider.Date = '".$date."' and assign_rider.Day = '".$day."'")->result_array();
		// $this->db->select('c.*,count(o.id) as total_o')
		// 		 ->from('client c')
		// 		 ->join('orders o',"c.id = o.Client and o.Date = '".$date."'",'left')
		// 		 ->group_by('c.id')
		// 		 ->where('c.Day', $day)
		// 		 ->having('total_o = 0');
		// return $this->db->get()->result_array();
	}


	public function get_peyment($id,$date=null)
	{
		$this->db->select('sum(p.amount) as amount')
				 ->from('payment p')
				 ->where('p.client_id',$id)
				 ->group_by('p.client_id');
		if ($date != null) {
			$this->db->where('DATE(p.created_at) <=',$date);
		}
		return $this->db->get()->row_array();
	}
	public function get_price($id,$date=null)
	{
		$this->db->select('sum(o.Price) as price')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->where('o.Client',$id)
				 ->group_by('o.Client');
		if ($date != null) {
			$this->db->where('do.date <=',$date);
		}
		return $this->db->get()->row_array();
	}

	public function get_area_day($day)
	{
		$this->db->select('area')
				 ->from('client')
				 ->where('Day', $day)
				 ->group_by('area');
		return $this->db->get()->result_array();
	}
}