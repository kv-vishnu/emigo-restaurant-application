<?php
class Stockmodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAllStockReport($category_id , $date) {
        $this->db->select('ss.store_id, ss.tr_date, ss.product_id, 
        SUM(pu_qty) as total_pu_qty, 
        SUM(sl_qty) as total_sl_qty, 
        (SUM(pu_qty) - SUM(sl_qty)) as bal_qty');
    $this->db->from('store_stock as ss');
    $this->db->join('store_wise_product_assign swpa', 'swpa.store_product_id = ss.product_id');
    $this->db->where('ss.tr_date', $date);
    $this->db->where('ss.store_id', $this->session->userdata('logged_in_store_id'));

    if (!empty($category_id)) {
        $this->db->where('swpa.category_id', $category_id);
    }
    
    $this->db->group_by(['ss.store_id', 'ss.tr_date', 'ss.product_id']);
    $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $result = $query->result_array(); // Fetch the result as an array

    }
    
     public function deleteProductByID($product_id,$store_id)
    {
       
        $this->db->where('store_product_id', $product_id);
        $this->db->where('store_id', $store_id);
        $this->db->delete('store_wise_product_assign'); 

          // Delete product variants first, if they exist
          $this->db->where('store_product_id', $product_id);
          $this->db->where('store_id', $store_id);
          $this->db->delete('store_variants');
        return true;
    }
    
    public function getUpcomingStockoutProducts(){
        $upcoming_stockout = [];
        $this->db->select('store_product_id');
        $this->db->from('store_wise_product_assign');
        $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
        $query = $this->db->get();
        $stocks = $query->result_array();
        foreach($stocks as $stock){
            $this->db->select('product_id,minqty, SUM(pu_qty) - SUM(sl_qty) AS current_stock');
            $this->db->from('store_stock');
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->where('product_id', $stock['store_product_id']);
            $query = $this->db->get();
            $row = $query->row_array();
            if (!empty($row)) 
            {
                if ($row['current_stock'] != '' && $row['current_stock'] > 0) 
                {
            
                    $upcoming_stockout[] = [
                        'product_id' => $row['product_id'],
                        'current_stock' => $row['current_stock'],
                        'minqty' => $row['minqty']
                    ];
                }
            }
        }
        return $upcoming_stockout;
    }
    
    public function getStockoutProducts(){
        $stockout = [];
        $this->db->select('store_product_id');
        $this->db->from('store_wise_product_assign');
        $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
        $query = $this->db->get();
        $stocks = $query->result_array();
        foreach($stocks as $stock){
            $this->db->select('product_id,minqty, SUM(pu_qty) - SUM(sl_qty) AS current_stock');
            $this->db->from('store_stock');
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->where('product_id', $stock['store_product_id']);
            $query = $this->db->get();
            $row = $query->row_array();
            if (!empty($row)) 
            {
               
            
                    if ($row['current_stock'] <= 0) 
                    {
                        $stockout[] = [
                            'product_id' => $stock['store_product_id'],
                            'current_stock' => 0,
                            'minqty' => ''
                        ];
                    }
                
            }
        }
        
        return $stockout;
    }

    public function getAllStockProducts($category_id) {
        //echo "here";exit;
        $this->db->select('*');
	    $this->db->from('store_wise_product_assign');
        $this->db->join('product', 'product.product_id = store_wise_product_assign.store_product_id', 'left'); // Left join
		$this->db->join('categories', 'categories.category_id = store_wise_product_assign.category_id', 'left'); // Left join
        $this->db->where('store_wise_product_assign.store_id', $this->session->userdata('logged_in_store_id'));
        if ($category_id != '') {
            $this->db->where('store_wise_product_assign.category_id', $category_id);
        }
        $this->db->order_by('store_wise_product_assign.store_product_id', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function CheckStockApprove($store_id,$date,$product_id,$quantity,$minqty,$currentstock)
    {
        $result='';
        //echo $currentstock;
        if($quantity > 0)
        {
            $this->db->select('*');
            $this->db->from('store_stock');
            $this->db->where('store_id', $store_id);
            $this->db->where('product_id', $product_id);
            $this->db->where('tr_date', $date);
            $this->db->where('ttype', 'SK');
            $this->db->where('order_id', 0);
            $query = $this->db->get();
            $result = $query->row();

            if(empty($result))
            {
                $this->db->set('store_id', $store_id);
                $this->db->set('product_id', $product_id);
                $this->db->set('ttype', 'SK');
                $this->db->set('order_id', 0);
                $this->db->set('pu_qty', $quantity);
                $this->db->set('minqty', $minqty);
                $this->db->set('tr_date', $date);
                $this->db->set('created_by', $this->session->userdata('loginid'));
                $this->db->set('created_date', date('Y-m-d H:i:s'));
                $this->db->set('modified_by', $this->session->userdata('loginid'));
                $this->db->set('modified_date', date('Y-m-d H:i:s'));
                $this->db->insert('store_stock');
            }
            else
            {


            if ($quantity != '') 
            {
                $quantity = (int)$result->pu_qty + (int)$quantity;
            }
             else 
            {
                $quantity = (int)$result->pu_qty; // Convert both to integers and then add
            }

            $this->db->set('pu_qty', $quantity);
            $this->db->set('minqty', $minqty);
            $this->db->set('created_by', $this->session->userdata('loginid'));
            $this->db->set('created_date', date('Y-m-d H:i:s'));
            $this->db->set('modified_by', $this->session->userdata('loginid'));
            $this->db->set('modified_date', date('Y-m-d H:i:s'));
            $this->db->where('store_id', $store_id);
            $this->db->where('product_id', $product_id);
            $this->db->where('tr_date', $date);
            $this->db->where('ttype', 'SK');
            $this->db->where('order_id', 0);
            $this->db->where('id', $result->id);
            $this->db->update('store_stock');    

        } 
        $this->db->set('is_active', 0);
        $this->db->where('store_id', $store_id);
        $this->db->where('store_product_id', $product_id);
        $this->db->update('store_wise_product_assign');
    }
    else
    { 
        if($currentstock > 0)
        {
            $this->db->set('is_active', 0);
            $this->db->where('store_id', $store_id);
            $this->db->where('store_product_id', $product_id);
            $this->db->update('store_wise_product_assign');
        }
        else
        {
            $this->db->set('is_active', 1);
            $this->db->where('store_id', $store_id);
            $this->db->where('store_product_id', $product_id);
            $this->db->update('store_wise_product_assign');
        }
        
    }
    
}
    
}
?>
