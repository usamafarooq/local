<?php
class Home extends CI_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function detail($id,$role)
	{
		if ($role == 16) {
			$client = $this->home_model->get_row_single('client',array('main_id'=>$id));
        	$id = $client['id'];
			$data['pending_bottles'] = $this->home_model->pending($id,'Client');
			$data['pending_bottles'] = $data['pending_bottles']['pending'];
			$data['total_order'] = $this->home_model->order($id,'Client');
			$data['total_order'] = $data['total_order']['orders'];
			$pending_order = $this->home_model->pending_order($id,'Client');
			$pe = array();
			for ($i=0; $i < sizeof($pending_order); $i++) { 
				$pe[] = $pending_order[$i]['orders'];
			}
			$data['pending_order'] = array_sum($pe);
			$orders = $this->home_model->get_payment_history($id);
			$paid = $this->home_model->get_paid_history($id);
			$data['pending_payment'] = $orders['total'] - $paid['total'];
			//print_r($data['pending_order']);
			//print_r($this->db->last_query());die;
		}
		elseif ($role == 15) {
			$data['pending_bottles'] = $this->home_model->pending($id,'Rider');
			$data['pending_bottles'] = $data['pending_bottles']['pending'];
			$data['total_order'] = $this->home_model->order($id,'Rider');
			$data['total_order'] = $data['total_order']['orders'];
			$pending_order = $this->home_model->pending_order($id,'Rider');
			$pe = array();
			for ($i=0; $i < sizeof($pending_order); $i++) { 
				$pe[] = $pending_order[$i]['orders'];
			}
			$data['pending_order'] = array_sum($pe);
		}
		echo json_encode($data);
	}

}