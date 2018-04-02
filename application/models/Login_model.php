<?php 

class Login_model extends MY_Model
{
	public function check_user($email,$password){
		$this->db->select('*')
				 ->from('users')
				 ->where('email',$email)
				 ->where('password', md5($password))
				 ->where('(role = 15 or role = 16)');
		return $this->db->get()->row_array();
	}
}