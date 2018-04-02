<?php
class Users extends CI_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index($id)
	{
		$data = $this->user_model->get_row_single('users',array('id'=>$id));
		echo json_encode($data);
	}

}