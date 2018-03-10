<?php
class Reporting extends MY_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Reporting_model');
        $this->module = 'reporting';
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
		$this->data['title'] = 'Clients';
		$this->data['clients'] = $this->Reporting_model->all_rows('client');
		$this->data['permission'] = $this->permission;
		$this->load->template('reporting/index',$this->data);
	}

	public function orders()
	{
		if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
		{
			redirect('home');
		}
		$this->data['title'] = 'Orders';
		$data = $this->input->post();
		$id = $data['Client'];
		$start = $data['start'];
		$end = $data['end'];
		$this->data['client'] = $this->Reporting_model->get_row_single('client',array('id'=>$id));
		$this->data['orders'] = $this->Reporting_model->get_orders($id,$start,$end);
		$this->data['data'] = $data;
		//echo '<pre>';print_r($this->data);die;
		$this->load->template('reporting/orders',$this->data);
	}

}