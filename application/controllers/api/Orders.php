<?php
class Orders extends CI_Controller{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model');
        $this->load->model('Client_model');
    }

    public function index($id)
	{
		$data = $this->Orders_model->get_rider_orders($id,date('Y-m-d'));
		echo json_encode($data);
	}

	public function history($id)
	{
		$data = $this->Orders_model->get_rider_history($id);
		echo json_encode($data);
	}

	public function client($id)
	{
		$today = date("l"); 
		//echo $today;die;
		//$data = $this->Client_model->get_rider_client($id,date('Y-m-d'),$today);
		$data = $this->Client_model->get_rider_client($id,'2018-06-08','Friday');
		//print_r($this->db->last_query());
		echo json_encode($data);
	}

	public function payment($id)
	{
		$client = $this->Orders_model->get_row_single('client',array('main_id'=>$id));
        $id = $client['id'];
		$orders = $this->Client_model->get_payment_history($id);
		$paid = $this->Client_model->get_paid_history($id);
		$data = array_merge($orders,$paid); 
		function compareOrder($a, $b)
		{
		  return strtotime($a['date']) - strtotime($b['date']);
		}
		usort($data, 'compareOrder');
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

	public function form($id,$rider)
	{
		$data = $this->Client_model->get_row_single('client',array('id'=>$id));
		$pending = $this->Orders_model->get_pending($id);
		$data['pending'] = $pending['pending'];
		$peyment = $this->Orders_model->get_peyment($id);
		$price = $this->Orders_model->get_price($id);
		$data['peyment'] = $price['price'] - $peyment['amount'];
		$data['rider'] = $rider;
		$data['date'] = date('Y-m-d');
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

	public function submit_order()
	{
		$data = file_get_contents("php://input");
        $json = json_decode($data,true);
        $data = array(
        	'Client' => $json['client'],
        	'Rider' => $json['rider'],
        	'Quantity' => $json['deliver'],
        	'Price' => $json['price'],
        	'Date' => $json['date'],
        	'remarks' => $json['remarks'],
        	'user_id' => $json['rider'],
        );
        $order_id = $this->Orders_model->insert('orders',$data);
        $data = array(
        	'order_id'=>$order_id,
        	'date'=>$json['date'],
        	'deliver'=>$json['deliver'],
        	'received'=>$json['received'],
        );
        $this->Orders_model->insert('deliver_order',$data);
        $data = array(
        	'client_id'=>$json['client'],
        	'amount'=>$json['amount'],
        );
        $this->Orders_model->insert('payment',$data);
        $data =array(
        	'deliver' => $json['deliver'],
        	'received'=>$json['received'],
        	'price' => $json['price'],
        	'date' => $json['date'],
        	'code' => $json['client'],
        );
        $id = $json['client'];
        $pending = $this->Orders_model->get_pending($id);
		$data['pending'] = $pending['pending'];
		$peyment = $this->Orders_model->get_peyment($id);
		$price = $this->Orders_model->get_price($id);
		$data['peyment'] = $price['price'] - $peyment['amount'];
		$client = $this->Client_model->get_row_single('client',array('id'=>$id));
		$data['name'] = $client['Name'];
		echo json_encode($data);
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