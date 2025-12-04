<?php
class Tablemodel extends CI_Model {
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
	    $this->db->insert('store_table',$data);
	}
	public function delete($id){
		$this->db->where('table_id', $id);
        return $this->db->delete('store_table');
	}
	public function get($id){
	    $this->db->select('*');
		$this->db->from('tax');
		$this->db->where('tax_id',$id );
		$query = $this->db->get();
		return $query->result_array();
	}
	public function update($id,$data){
	    $this->db->where('tax_id', $id);
        $this->db->update('tax', $data);
        return true;
	}
	public function getTablesByStoreId($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_table');
		$this->db->where('store_id',$store_id );
		$this->db->where('ttype', 'tbl');
		//$this->db->where('store_table_token', '');
		$this->db->order_by("table_id", "asc");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}

	public function getTablesAssignedByStoreId($store_id, $user_id) {
		$this->db->select('store_table_assign.*, store_table.table_name,store_table.store_table_name,store_table.table_id,store_table.is_reserved');
		$this->db->from('store_table_assign');
		$this->db->join('store_table', 'store_table_assign.table_id = store_table.table_id', 'left');
		$this->db->where('store_table_assign.store_id', $store_id);
		$this->db->where('store_table_assign.user_id', $user_id);
		$this->db->where('store_table_assign.table_id !=', 0);
		$this->db->where('store_table_assign.type', 'tbl');
		$this->db->order_by('store_table_assign.table_id', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function getDeliveryOrdersByStoreId($store_id){
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('store_id',$store_id );
		$this->db->where('order_type','DL');
		$this->db->where('is_paid', 0 );
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	public function updateTableQRCode($table_id, $data){
		$this->db->where('table_id', $table_id);
        $this->db->update('store_table', $data);
        return true;
	}
	public function updateNumberOfTable($store_id, $data){
		$this->db->where('store_id', $store_id);
		$this->db->update('store', $data);
		return true;
	}
	public function check_tablename_exists($tablename, $store_id)
	{
    	$this->db->where('table_name', $tablename);
    	$this->db->where('store_id', $store_id);
    	$query = $this->db->get('store_table');  // Assuming 'users' is your table name
    	if ($query->num_rows() > 0) {
        	return TRUE;  // Field exists for the store
    	} else {
        	 FALSE; // Field does not exist for the store
    	}
}
public function comp_pickup_count($store_id){
	$this->db->select('*');
	$this->db->from('order');
	$this->db->where('store_id',$store_id );
	$this->db->where('order_type','PK');
	$this->db->where('is_paid', 1);
	$query = $this->db->get();
	return  $query->num_rows();
}
public function pending_pickup_count($store_id){
	$this->db->select('*');
	$this->db->from('order');
	$this->db->where('store_id',$store_id );
	$this->db->where('order_type','PK');
	$this->db->where('is_paid', 0);
	$statuses = [0, 1 , 2];
	$this->db->where_in('order_status', $statuses);
	$query = $this->db->get();
	return  $query->num_rows();
}
public function comp_delivery_count($store_id){
	$this->db->select('*');
	$this->db->from('order');
	$this->db->where('store_id',$store_id );
	$this->db->where('order_type','DL');
	$this->db->where('is_paid', 1);
	$query = $this->db->get();
	return  $query->num_rows();

}
public function pending_delivery_count($store_id){
	$this->db->select('*');
	$this->db->from('order');
	$this->db->where('store_id',$store_id );
	$this->db->where('order_type','DL');
	$this->db->where('is_paid', 0);
	$query = $this->db->get();
	return  $query->num_rows();
}
public function pending_pickup_cooking($store_id){
    $this->db->select('*');
    $this->db->from('order');
    $this->db->where('store_id',$store_id );
    $this->db->where('order_status',2);
	$this->db->where('order_type','PK');
    $this->db->where('is_paid', 0);
    $query = $this->db->get();
    return  $query->num_rows();
}


public function pending_pickup_ready($store_id){
    $this->db->select('*');
    $this->db->from('order');
    $this->db->where('store_id',$store_id );
    $this->db->where('order_type','PK');
    $this->db->where('order_status',3);
    $this->db->where('is_paid',0);
    $query = $this->db->get();
    // echo $this->db->last_query();
    return  $query->num_rows();
}
public function pending_delivery_cooking($store_id){
    $this->db->select('');
    $this->db->from('order');
    $this->db->where('store_id',$store_id );
    $this->db->where('order_status',2);
    $this->db->where('order_type','DL');
    $this->db->where('is_paid', 0);
    $query = $this->db->get();
    return  $query->num_rows();
}

public function pending_delivery_ready($store_id){
    $this->db->select('');
    $this->db->from('order');
    $this->db->where('store_id',$store_id );
    $this->db->where('order_status',3);
    $this->db->where('order_type','DL');
    $this->db->where('is_paid', 0);
    $query = $this->db->get();
    return  $query->num_rows();
}

public function updateTableStatus($checkbox , $whatsappno,$store_id,$tablename){
$this->db->where('store_id',$store_id);
$this->db->where('table_id', $tablename);
 $this->db->update('store_table', [
        'is_whatsapp' => $checkbox,
		'whatsapp_no' => $whatsappno
    ]);
	// echo $this->db->last_query();
	return true;
}

public function updateDeliveryStatus($checkbox , $whatsappno, $store_id){
$this->db->where('store_id',$store_id);
 $this->db->update('store', [
        'delivery_whatsapp_enable' => $checkbox,
		'delivery_whatsapp_no' => $whatsappno
    ]);
	// echo $this->db->last_query();
	return true;
}



public function updatePickupStatus($checkbox , $whatsappno, $store_id){
$this->db->where('store_id',$store_id);
 $this->db->update('store', [
        'pickup_whatsapp_enable' => $checkbox,
		'pickup_whatsapp_no' => $whatsappno
    ]);
	// echo $this->db->last_query();
	return true;
}


public function getwhatsapp($store_id){
	$this->db->select('*');
	$this->db->from('whatsapp_no');
	$this->db->where('store_id', $store_id);
	$query = $this->db->get();
	return $query->result_array();

}

}
?>