<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

	public function check_login()
	{
		$data               = file_get_contents("php://input");
        $dataJsonDecode     = json_decode($data);
        $email            = $dataJsonDecode->email;
        $password            = $dataJsonDecode->password;
		//$user = $this->Login_model->get_row_single('users',array('email'=>$email,'password'=>md5($password),"(role = 15 OR role = 16)"));
		$user = $this->Login_model->check_user($email,$password);
		//print_r($this->db->last_query());die;
		if (!empty($user)) {
			echo json_encode($user);
		}
		else{
			echo '2';
		}
	}
}