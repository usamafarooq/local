<?php
class Invoice extends MY_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_model');
        $this->load->model('Client_model');
        $this->module = 'invoice';
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
        $this->data['client'] = $this->invoice_model->all_rows('client');
        $this->data['permission'] = $this->permission;
        $this->load->template('invoice/index',$this->data);
    }

    public function orders()
    {
        if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
        {
            redirect('home');
        }
        $this->data['title'] = 'Orders';
        $data = $this->input->post();
        $id = $data['client'];
        $start = $data['start'];
        $end = $data['end'];
        $this->data['client'] = $this->Client_model->get_row_single('client',array('id'=>$id));
        $this->data['orders'] = $this->Client_model->get_order_history($id,$start,$end);
        for ($i=0; $i < sizeof($this->data['orders']); $i++) { 
            $this->data['orders'][$i]['balance'] = $this->Client_model->get_pending($id,$this->data['orders'][$i]['date'])['pending'];
            $payment = $this->Client_model->get_price($id,$this->data['orders'][$i]['date']);
            $paid = $this->Client_model->get_peyment($id,$this->data['orders'][$i]['date']);
            $this->data['orders'][$i]['balance_amount'] = $payment['price'] -  $paid['amount'];
        }
        //echo '<pre>';print_r($this->data['orders']);die;
        $this->load->template('client/order',$this->data);
    }

}
