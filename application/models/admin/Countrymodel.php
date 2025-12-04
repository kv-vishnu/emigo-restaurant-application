<?php
class Countrymodel extends CI_Model {
    public function listcountries()
	{
		$this->db->select('*');
		$this->db->from('countries');
		//$this->db->where('is_active', 1);
		$this->db->order_by("country_id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert($data){
	    $this->db->insert('countries',$data);
	}
	public function delete($id){
		$this->db->where('country_id', $id);
        return $this->db->delete('countries');
	}
	public function get($id){
	    $this->db->select('*');
		$this->db->from('countries');
		$this->db->where('country_id',$id );
		$query = $this->db->get();
		return $query->row_array();
	}
	public function updatecountrydetails($id,$data){
	    $this->db->where('country_id', $id);
        $this->db->update('countries', $data);
        return true;
	}

	public function DeleteUser($id) {
		$this->db->where('country_id', $id);
		$this->db->delete('countries');
	}

	
	public function check_countryname_exists($countryname)
	{
    	$this->db->where('name', $countryname);
    	$query = $this->db->get('countries'); // Assuming 'users' is your table name
		if ($query->num_rows() > 0) {
        	return TRUE;  // Username exists
    	} else {
        	return FALSE;  // Username does not exist
    	}
	}
}
?>