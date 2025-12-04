<?php
class Followupmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
//MARK:Insert New Followup

public function add($data) 
{
$this->db->insert('followup', $data);
}

//MARK: Get All Followup
public function get_all_followup($store_id)
{
$this->db->select('*');
$this->db->from('followup');
$this->db->order_by("follow_up_id", "asc");
$this->db->where('store_id', $store_id);    
$query = $this->db->get();
return $query->result_array();    
}

//MARK:- Get Edit Details

public function get_edit_details($id)
{
    
$this->db->select('*');
$this->db->from('followup');
$this->db->where('follow_up_id', $id);
$query = $this->db->get();
return $query->row_array(); 

}

// MARK: Save Followup
public function updatefollowupdetails($id, $data) 
{
    $this->db->where('follow_up_id', $id);
    $this->db->update('followup', $data);
}
// MARK: Delete Followup
public function delete($id)
{
$this->db->where('store_id', $id);
return $this->db->delete('followup');
}

// MARK: List Followup Users


public function listuser($logged_in_store_id){
$this->db->select('*');  
$this->db->from('users');
$this->db->where('store_id', $logged_in_store_id);
$query = $this->db->get();
return $query->result_array();
}

}
?>