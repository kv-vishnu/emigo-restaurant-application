<?php
class Modulemodel extends CI_Model {
    public function listmodules()
	{
		$this->db->select('*');
		$this->db->from('module');
		$this->db->where('is_active', 1);
		$this->db->order_by("moduleid", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function insert($data){
	    $this->db->insert('module',$data);
	}
	public function delete($id){
	    $data = array('is_active' => 0);
        $this->db->where('moduleid', $id);
        $this->db->update('module', $data);
        return true;
	}
	public function get($moduleid){
	    $this->db->select('*');
		$this->db->from('module');
		$this->db->where('moduleid',$moduleid );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function update($moduleid,$moduledata){
	    $this->db->where('moduleid', $moduleid);
        $this->db->update('module', $moduledata);
        return true;
	}
}
?>