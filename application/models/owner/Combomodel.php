<?php
class Combomodel extends CI_Model {
    public function shopAssignedActiveProducts() {
		$store_id = $this->session->userdata('logged_in_store_id');
$this->db->select('
    swpa.*,
    p.product_id,
    p.product_name_en,
    p.is_addon AS product_is_addon,
    p.is_customizable AS product_is_customizable,
    p.product_veg_nonveg,
    p.image,
    c.category_name_en,
    c.category_id,
    ss.pu_qty,
    ss.minqty,
    (ss.pu_qty - ss.sl_qty) AS balance_stock
');
$this->db->from('store_wise_product_assign AS swpa');
$this->db->join('product AS p', 'p.product_id = swpa.product_id', 'left');
$this->db->join('categories AS c', 'c.category_id = swpa.category_id', 'left');
$this->db->join('store_stock AS ss', 'ss.product_id = p.product_id', 'left');
$this->db->where('swpa.store_id', $store_id);
$this->db->where('swpa.is_active', 0);
$this->db->group_by('swpa.store_product_id');
$query = $this->db->get();
$products = $query->result_array();
$available_products = [];
foreach ($products as $product) {
	$stock = $this->Ordermodel->getCurrentStock($product['store_product_id'], date('Y-m-d'), $store_id);
    if ($stock > 0) {
        $available_products[] = $product;
    }
}
return $available_products;
	}

    public function addComboItems($productId, $combo_id, $quanitity, $store_id) {
        $data = array( 
            'product_id' => $productId,
            'item_id' => $combo_id, //Combo item id
            'quantity' => $quanitity,
            'store_id' => $store_id,
        ); 
        $this->db->insert('combo_items', $data);
    }

    public function deleteComboItems($id){
        $this->db->where('combo_item_id ', $id);
        return $this->db->delete('combo_items');
    }
    public function getComboItems($store_id,$productId) {      
        $this->db->select('*'); // Fetch all columns
        $this->db->from('combo_items'); // Specify the table
        $this->db->where('product_id', $productId); // Filter by product_id
        $this->db->where('store_id', $store_id); // Filter by store_id
        $query = $this->db->get(); // Execute the query
       // echo $this->db->last_query();exit;
        return $query->result_array(); // Return the result as an array
        
}
public function UpdateComboItems($combo_product_id,$quantity){
    $this->db->set('quantity', $quantity);
    $this->db->where('combo_item_id', $combo_product_id);
    return $this->db->update('combo_items');
}
public function listStoreUsers($store_id){
        $this->db->select('*');
        $this->db->from('users'); 
        $this->db->where('store_id', $store_id); 
        $query = $this->db->get(); 
        return $query->result_array(); 
}

public function updateStoreProductStatus($store_id, $store_product_id, $is_active ){
    $this->db->set('is_active', $is_active);
    $this->db->where('store_id', $store_id);
    $this->db->where('store_product_id', $store_product_id);
    return $this->db->update('store_wise_product_assign');
}

}