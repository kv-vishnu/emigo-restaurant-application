<?php
class Packagemodel extends CI_Model {
    public function listpackages()
	{
		$this->db->select('*');
		$this->db->from('packages');
		//$this->db->where('is_active', 1);
		$this->db->order_by("package_id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert($data){
	    $this->db->insert('packages',$data);
	}
	public function delete($id){
		$this->db->where('package_id', $id);
        return $this->db->delete('packages');
	}
	public function get($id){
	    $this->db->select('*');
		$this->db->from('packages');
		$this->db->where('package_id',$id );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function update($id,$data){
	    $this->db->where('package_id', $id);
        $this->db->update('packages', $data);
        return true;
	}
	public function check_packagename_exists($countryname)
	{
    	$this->db->where('name', $countryname);
    	$query = $this->db->get('packages'); // Assuming 'users' is your table name
		if ($query->num_rows() > 0) {
        	return TRUE;  // Username exists
    	} else {
        	return FALSE;  // Username does not exist
    	}
	}
}
?>