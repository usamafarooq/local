<?php
class Daily_sales_report_model extends MY_Model{
	public function get_data($date)
	{
		$this->db->select('concat(sum(deliver) - sum(received)) as pending, o.Client')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('users u', 'u.id = o.Rider')
				 ->where('do.date <=',$date)
				 ->group_by('o.Client');
		$pending = $this->db->get_compiled_select();

		$this->db->select('sum(p.amount) as amount,p.client_id')
				 ->from('payment p')
				 ->where('DATE(p.created_at) <=',$date)
				 ->group_by('p.client_id');
		$payment = $this->db->get_compiled_select();

		$this->db->select('sum(o.Price) as price,o.Client')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->where('do.date <=',$date)
				 ->group_by('o.Client');
		$price = $this->db->get_compiled_select();

		$this->db->select('deliver,received as empty,c.Name,c.Address,o.Price as amount, p.amount as received,pe.pending as balance,concat(pr.price - pa.amount) as balance_amount')
				 ->from('orders o')
				 ->join('deliver_order do', 'do.order_id = o.id')
				 ->join('client c', 'c.id = o.Client')
				 ->join('payment p', 'p.client_id = c.id and do.date = DATE(p.created_at)', 'left')
				 ->join('('.$pending.') pe', 'pe.Client = c.id', 'left' )
				 ->join('('.$payment.') pa', 'pa.client_id = c.id', 'left' )
				 ->join('('.$price.') pr', 'pr.Client = c.id', 'left' )
				 ->where('do.date',$date)
				 ->group_by('o.id');
		return $this->db->get()->result_array();
	}
}