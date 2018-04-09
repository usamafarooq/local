<?php
class Daily_sales_report extends MY_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('daily_sales_report_model');
        $this->module = 'daily_sales_report';
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
        $this->data['title'] = 'Daily Sales Report';
        $this->data['date'] = date('Y-m-d',strtotime('-1 day'));
        if ($this->input->post('date')) {
            $this->data['date'] = $this->input->post('date');
        }
        $this->data['detail'] = $this->daily_sales_report_model->get_data($this->data['date']);
        //print_r($this->db->last_query());
        //echo '<pre>';print_r($this->data['detail']);die;
        $this->data['permission'] = $this->permission;
        $this->load->template('daily_sales_report/index',$this->data);
    }

}
