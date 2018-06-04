<?php
		    class Assign_rider extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Assign_rider_model');
	        $this->module = 'assign_rider';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Assign_rider';
			if ( $this->permission['view_all'] == '1'){$this->data['assign_rider'] = $this->Assign_rider_model->get_assign_rider();}
			elseif ($this->permission['view'] == '1') {$this->data['assign_rider'] = $this->Assign_rider_model->get_assign_rider($this->id);}
			$this->data['permission'] = $this->permission;
			$this->load->template('assign_rider/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Assign_rider';
			$this->data['table_users'] = $this->Assign_rider_model->get_rows('users',array('role'=>'15'));
			$this->data['table_client'] = $this->Assign_rider_model->all_rows('client');
			$this->load->template('assign_rider/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');
			$data['Area'] = implode(',', $data['Area']);
			$id = $this->Assign_rider_model->insert('assign_rider',$data);
			if ($id) {
				redirect('assign_rider');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Assign_rider';
			$this->data['assign_rider'] = $this->Assign_rider_model->get_row_single('assign_rider',array('id'=>$id));$this->data['table_users'] = $this->Assign_rider_model->all_rows('users');$this->data['table_client'] = $this->Assign_rider_model->all_rows('client');$this->load->template('assign_rider/edit',$this->data);
		}

		public function update()
		{
			if ( $this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$id = $data['id'];
			$data['Client'] = implode(',', $data['Client']);
			unset($data['id']);$id = $this->Assign_rider_model->update('assign_rider',$data,array('id'=>$id));
			if ($id) {
				redirect('assign_rider');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Assign_rider_model->delete('assign_rider',array('id'=>$id));
			redirect('assign_rider');
		}}