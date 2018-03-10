<?php
		    class Client extends MY_Controller{

		    	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Client_model');
	        $this->module = 'client';
	        $this->user_type = $this->session->userdata('user_type');
	        $this->id = $this->session->userdata('user_id');
	        $this->permission = $this->get_permission($this->module,$this->user_type);
	    }public function index()
		{
			if ( $this->permission['view'] == '0' && $this->permission['view_all'] == '0' ) 
			{
				redirect('home');
			}
			$this->data['title'] = 'Client';
			if ( $this->permission['view_all'] == '1'){$this->data['client'] = $this->Client_model->all_rows('client');}
			elseif ($this->permission['view'] == '1') {$this->data['client'] = $this->Client_modelget_rows('client',array('user_id'=>$this->id));}
			$this->data['permission'] = $this->permission;
			$this->load->template('client/index',$this->data);
		}public function create()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Create Client';$this->load->template('client/create',$this->data);
		}
		public function insert()
		{
			if ( $this->permission['created'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$data['user_id'] = $this->session->userdata('user_id');$id = $this->Client_model->insert('client',$data);
			if ($id) {
				redirect('client');
			}
		}public function edit($id)
		{
			if ($this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$this->data['title'] = 'Edit Client';
			$this->data['client'] = $this->Client_model->get_row_single('client',array('id'=>$id));$this->load->template('client/edit',$this->data);
		}

		public function update()
		{
			if ( $this->permission['edit'] == '0') 
			{
				redirect('home');
			}
			$data = $this->input->post();
			$id = $data['id'];
			unset($data['id']);$id = $this->Client_model->update('client',$data,array('id'=>$id));
			if ($id) {
				redirect('client');
			}
		}public function delete($id)
		{
			if ( $this->permission['deleted'] == '0') 
			{
				redirect('home');
			}
			$this->Client_model->delete('client',array('id'=>$id));
			redirect('client');
		}}