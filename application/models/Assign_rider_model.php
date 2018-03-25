<?php
class Assign_rider_model extends MY_Model
{
    
    public function get_assign_rider($id = null)
    {
        // $this->db->select('assign_rider.*,users.name, GROUP_CONCAT(client.Name) as Name')
        // 		 ->from('assign_rider')
        // 		 ->join('users', 'users.id = assign_rider.Rider')
        // 		 ->join('client', "find_in_set(client.id,assign_rider.Client)")
        // 		 ->group_by('assign_rider.id');
        // if ($id != null) {
        //     $this->db->where('assign_rider.user_id', $id);
        // }
        // return $this->db->get()->result_array();
        return $this->db->query("SELECT `assign_rider`.*, `users`.`name`, GROUP_CONCAT(client.Name) as Name FROM `assign_rider` JOIN `users` ON `users`.`id` = `assign_rider`.`Rider` JOIN `client` on find_in_set(client.id,assign_rider.Client) GROUP BY `assign_rider`.`id`")->result_array();
    }
}