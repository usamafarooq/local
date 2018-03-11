<?php
class Rider_reporting extends MY_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Rider_reporting_model');
        $this->module = 'rider_reporting';
        $this->user_type = $this->session->userdata('user_type');
        $this->id = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module,$this->user_type);
    }

    public function index()
	{
		if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Riders';
		$this->data['riders'] = $this->Rider_reporting_model->get_rows('users',array('role'=>'15'));
		$this->data['permission'] = $this->permission;
		$this->load->template('rider_reporting/index',$this->data);
	}

	public function orders()
	{
		if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Orders';
		$data = $this->input->post();
		$id = $data['Rider'];
		$start = $data['start'];
		$end = $data['end'];
		$this->data['rider'] = $this->Rider_reporting_model->get_row_single('users',array('id'=>$id));
		$this->data['orders'] = $this->Rider_reporting_model->get_orders($id,$start,$end);
		//print_r($this->db->last_query());die;
		$this->data['data'] = $data;
		//echo '<pre>';print_r($this->data);die;
		$this->load->template('rider_reporting/orders',$this->data);
	}

}