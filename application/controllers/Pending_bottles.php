<?php
class Pending_bottles extends MY_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Pending_bottles_model');
        $this->module = 'pending_bottles';
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
        $this->data['detail'] = $this->Pending_bottles_model->get_data();
        $this->data['permission'] = $this->permission;
        $this->load->template('pending_bottles/index',$this->data);
    }

}