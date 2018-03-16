<?php
class Orders extends CI_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model');
    }

    public function index($id)
	{
		$data = $this->Orders_model->get_rider_orders($id,date('Y-m-d'));
		echo json_encode($data);
	}

	public function client_order($id)
	{
		$data = $this->Orders_model->get_client_orders($id);
		echo json_encode($data);
	}

	public function detail($id)
	{
		$data = $this->Orders_model->get_detail($id);
		$pending = $this->Orders_model->get_pending($data['Client']);
		$data['pending'] = $pending['pending'];
		$peyment = $this->Orders_model->get_peyment($data['Client']);
		$price = $this->Orders_model->get_price($data['Client']);
		$data['peyment'] = $price['price'] - $peyment['amount'];
		echo json_encode($data);
	}

	public function deliver()
	{
		$data = file_get_contents("php://input");
        $dataJsonDecode = json_decode($data,true);
        $data = array();
        $data['deliver'] = $dataJsonDecode['deliver'];
        $data['received'] = $dataJsonDecode['received'];
        $data['order_id'] = $dataJsonDecode['id'];
        $data['date'] = date('Y-m-d');
        $id = $this->Orders_model->insert('deliver_order',$data);
	}

	public function create_order()
	{
		$data = file_get_contents("php://input");
        $dataJsonDecode = json_decode($data,true);
        print_r($dataJsonDecode);
        $data = array();
        $data['Quantity'] = $dataJsonDecode['quantity'];
        $data['Date'] = date('Y-m-d',strtotime($dataJsonDecode['date']));
        $id = $dataJsonDecode['id'];
        $client = $this->Orders_model->get_row_single('client',array('main_id'=>$id));
        $data['Client'] = $client['id'];
        $price = $client['Price'];
		$price = $price * $data['Quantity'];
		$data['Price'] = $price;
		$data['user_id'] = $id;
		$id = $this->Orders_model->insert('orders',$data);
	}
}