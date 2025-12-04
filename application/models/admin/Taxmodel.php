<?php
class Taxmodel extends CI_Model {
    public function listtaxes()
	{
		$this->db->select('countries.name,tax.tax_id,tax.tax_type,tax.tax_rate');
		$this->db->from('tax');
		$this->db->join('countries', 'countries.country_id = tax.country_id', 'left'); // Using a LEFT JOIN
		$this->db->order_by("tax.tax_id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	public function insert($data){
	    $this->db->insert('tax',$data);
	}
	public function DeleteUser($id){
		$this->db->where('tax_id', $id);
        return $this->db->delete('tax');
	}
	public function get($id){
	    $this->db->select('*');
		$this->db->from('tax');
		$this->db->where('tax_id',$id );
		$query = $this->db->get();
		return $query->row_array();
	}
	public function updatetaxdetails($id,$data){
	    $this->db->where('tax_id', $id);
        $this->db->update('tax', $data);
		// echo $this->db->last_query();exit;
        return true;
	}
	public function getTaxRatesByCountryId($country_id){
		$this->db->select('*');
		$this->db->from('tax');
		$this->db->where('country_id',$country_id );
		$this->db->order_by("tax_id", "desc");
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		return $query->result_array();
	}
}
?>