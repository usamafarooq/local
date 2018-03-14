<?php
class Orders extends MY_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model');
        $this->module = 'orders';
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
		$this->data['title'] = 'Orders';
		if ( $this->permission['view_all'] == '1'){$this->data['orders'] = $this->Orders_model->get_orders();}
		elseif ($this->permission['view'] == '1') {$this->data['orders'] = $this->Orders_model->get_orders($this->id);}
		$this->data['permission'] = $this->permission;
		$this->load->template('orders/index',$this->data);
	}

	public function create()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Create Orders';
		$this->data['table_client'] = $this->Orders_model->all_rows('client');
		$this->data['table_users'] = $this->Orders_model->get_rows('users',array('role'=>'15'));
		$this->load->template('orders/create',$this->data);
	}

	public function insert()
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$client = $this->Orders_model->get_row_single('client',array('id'=>$data['Client']));
		$price = $client['Price'];
		$price = $price * $data['Quantity'];
		$data['Price'] = $price;
		$data['user_id'] = $this->session->userdata('user_id');$id = $this->Orders_model->insert('orders',$data);
		if ($id) {
			redirect('orders');
		}
	}

	public function edit($id)
	{
		if ($this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$this->data['title'] = 'Edit Orders';
		$this->data['orders'] = $this->Orders_model->get_row_single('orders',array('id'=>$id));$this->data['table_client'] = $this->Orders_model->all_rows('client');$this->data['table_users'] = $this->Orders_model->get_rows('users',array('role'=>'15'));$this->load->template('orders/edit',$this->data);
	}

	public function update()
	{
		if ( $this->permission['edit'] == '0') 
		{
			redirect('home');
		}
		$data = $this->input->post();
		$id = $data['id'];
		unset($data['id']);$id = $this->Orders_model->update('orders',$data,array('id'=>$id));
		if ($id) {
			redirect('orders');
		}
	}

	public function delete($id)
	{
		if ( $this->permission['deleted'] == '0') 
		{
			redirect('home');
		}
		$this->Orders_model->delete('orders',array('id'=>$id));
		redirect('orders');
	}

	public function deliver($id)
	{
		if ( $this->permission['created'] == '0') 
		{
			redirect('home');
		}
		if ($this->input->post()) {
			$data = $this->input->post();
			$data['order_id'] = $id;
			$id = $this->Orders_model->insert('deliver_order',$data);
			if ($id) {
				redirect('orders');
			}
		}
		$this->data['title'] = 'Deliver Orders';
		$this->data['order'] = $this->Orders_model->get_row_single('orders',array('id'=>$id));
		$this->load->template('orders/deliver',$this->data);
	}
}