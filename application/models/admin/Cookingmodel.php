 <?php
class Cookingmodel extends CI_Model {
    public function listcookings()
	{
		$this->db->select('*');
		$this->db->from('cookings');
		//$this->db->where('is_active', 1);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert($data){
	    $this->db->insert('cookings',$data);
	}
	public function delete($id){
		$this->db->where('id', $id);
         $this->db->delete('cookings');
	}
	public function get_cooking_details($id){
	    $this->db->select('*');
		$this->db->from('cookings');
		$this->db->where('id',$id );
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update($id,$data){
	    $this->db->where('id', $id);
        $this->db->update('cookings', $data);
        return true;
	}
	public function check_countryname_exists($countryname)
	{
    	$this->db->where('name', $countryname);
    	$query = $this->db->get('cookings'); // Assuming 'users' is your table name
		if ($query->num_rows() > 0) {
        	return TRUE;  // Username exists
    	} else {
        	return FALSE;  // Username does not exist
    	}
	}
}
?>