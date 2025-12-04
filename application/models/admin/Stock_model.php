<?php
class Stock_model extends CI_Model {
    public function liststock()
	{
		$this->db->select('stock.*,consumables.name');
		$this->db->from('stock');
        $this->db->join('consumables','consumables.id=stock.consumable_id');
		$this->db->where('stock.is_active', 1);
        $this->db->where('consumables.is_active', 1);

		$this->db->order_by("stock.id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
    public function listconsumables()
	{
		$this->db->select('*');
		$this->db->from('consumables');
		$this->db->where('is_active', 1);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function insert($data){
	    $this->db->insert('stock',$data);
	}

	public function delete($id){
	    $data = array('is_active' => 0);
        $this->db->where('id', $id);
        $this->db->update('stock', $data);
        return true;
	}
	public function get($roleid){
	    $this->db->select('*');
		$this->db->from('stock');
		$this->db->where('id',$roleid );
		$query = $this->db->get();
		return $query->result_array();echo $this->db->last_query();die;
	}
	public function update($roleid,$roledata){
	    $this->db->where('id', $roleid);
        $this->db->update('stock', $roledata);//echo $this->db->last_query();die;
        return true;
	}
	public function listavailablestock()
	{
		$this->db->select('stock.*,consumables.name,sum(qty) as qtysum');
		$this->db->from('stock');
        $this->db->join('consumables','consumables.id=stock.consumable_id');
		$this->db->where('stock.is_active', 1);
        $this->db->where('consumables.is_active', 1);
		$this->db->group_by('stock.consumable_id');

		$this->db->order_by("stock.id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>