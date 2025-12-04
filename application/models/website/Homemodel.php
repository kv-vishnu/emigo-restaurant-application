<?php
class Homemodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get product with translation in selected language
    public function get_product($product_id, $language) {
        // Get product details from products table
        $this->db->select('p.id, p.sku, p.price, pt.title, pt.description');
        $this->db->from('products p');
        $this->db->join('product_translations pt', 'p.id = pt.product_id');
        $this->db->where('p.id', $product_id);
        $this->db->where('pt.language', $language);
        
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function getCustomizeProductDefaultPrice($store_product_id,$store_id){
        $this->db->select('rate');
          $this->db->from('store_variants');
          $this->db->where('store_product_id', $store_product_id);
          $this->db->where('store_id', $store_id);
          $this->db->where('is_default', 1);
          $query = $this->db->get();
          $result = $query->row();
          if(empty($result->rate)){
            return 0;
          }else{
          return $result->rate;
          }
      }

      public function isWhatsappEnableCheck($store_id){
        $this->db->select('whatsapp_enable');
        $this->db->from('store');
        $this->db->where('store_id', $store_id);
        $query = $this->db->get();
        return $query->row()->whatsapp_enable; // Return is_whatsapp value
      }


    public function getDeliveryTypePhone($store_id,$type){
        //echo $type;exit;
        if ($type == 'PK') {
            $getType = 'pickup_number';
        } elseif ($type == 'DL') {
            $getType = 'delivery_number';
        } else {
            $getType = 'dining_number';
        }
        
        $this->db->select($getType);
        $this->db->from('store');
        $this->db->where('store_id', $store_id);
        $query = $this->db->get();// Useful for debugging
        //exit;
        
        $row = $query->row_array(); // Fetch a single row as an associative array
        return isset($row[$getType]) ? $row[$getType] : null; // Return the value or null if not found
        
    }
    public function get_prevous_orders($orderno , $store_id){
        $this->db->select('*');
        $this->db->from('order_items');
        $this->db->where('orderno', $orderno);
        $this->db->where('store_id', $store_id);
        $this->db->where('is_paid', '0');
        $query = $this->db->get();
        return $query->result_array();
    }
    
     public function getProductName($product_id) {
        $this->db->select('product_id');
	    $this->db->from('store_wise_product_assign');
		$this->db->where('store_product_id ', $product_id);
		$query = $this->db->get();
        $result = $query->result_array();
        $product_id1 = $result[0]['product_id'];
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_id', $product_id1);
        $product_query = $this->db->get();
        $row =  $product_query->result_array();
        return $row[0]['product_name_en'];
    }

    public function get_prevous_orders_whatsapp($orderno , $store_id){
         $this->db->select('*');
        $this->db->from('order_items');
        $this->db->where('orderno', $orderno );
        $this->db->where('store_id', $store_id );
        $this->db->where('is_paid', '0');
        $query = $this->db->get();
        
        $orders = $query->result_array();
        $previousOrders = [];
        $currentOrders = [];
        
        foreach ($orders as $order) {
            $orderData = [
                'product_id' => $order['product_id'],
                'name' => $this->getProductName($order['product_id']), // Fetch product name
                'orderno' => $order['orderno'],
                'quantity' => $order['quantity'],
                'rate' => $order['rate'],
                'amount' => $order['amount'],
                'is_reorder' => $order['is_reorder']
            ];
        
            if ($order['is_reorder'] == 0) {
                $previousOrders[] = $orderData;
            } else {
                $currentOrders[] = $orderData;
            }
        }
        
        $response = [
            'previous_orders' => $previousOrders,
            'current_orders' => $currentOrders
        ];
        
        return $response;


    }
     public function get_prevous_order_summary($orderno , $store_id){
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where('orderno', $orderno);
        $this->db->where('store_id', $store_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // public function get_products() {
    //     $query = $this->db->get('products');  // Assuming a table named 'products'
    //     return $query->result();
    // }

    public function get_product_by_id($id) {
        $query = $this->db->get_where('products', array('id' => $id));
        return $query->row();
    }
    
    public function changeStoreProductStatusInactive($store_id,$is_active){
        $this->db->where('store_id', $store_id);
        $this->db->update('store_wise_product_assign',['is_active' => $is_active]);
        //echo $this->db->last_query();exit;
    }

    public function get_products() {
        $language = $this->session->userdata('language') ?: 'en';

        // Join the products and product_translations tables to get product details in the selected language
        $this->db->select('p.id, p.sku, p.price, pt.title, pt.description');
        $this->db->from('products p');
        $this->db->join('product_translations pt', 'p.id = pt.product_id');
        $this->db->where('pt.language', $language);
        
        $query = $this->db->get();
        return $query->result_array(); // Return the result as an array
    }

    public function get_store_details_by_store_id($store_id){
        $query = $this->db->get_where('store', array('store_id' => $store_id));
        return $query->row();
    }
    
    public function get_support_details_by_country_id($country_id){
        $this->db->select('support_no,support_email');
        $this->db->from('countries');
        $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    
     public function get_store_tax_by_store_id($tax_id){
        $query = $this->db->get_where('tax', array('tax_id' => $tax_id));
        return $query->row();
    }
    public function get_store_details_by_token($token){
        $query = $this->db->get_where('store_table', array('store_table_token' => $token));
        return $query->row();
    }
    public function isTodayHoliday($date) {
        $this->db->where('holiday_date', $date);
        $query = $this->db->get('holidays');
        return $query->num_rows() > 0;
    }
    public function disableProductsByStoreId($store_id) {
        $this->db->where('store_id', $store_id);
        $this->db->update('store_wise_product_assign', ['is_active' => 1]); // Assuming 1 = Disabled
    }

    public function isWhatsappEnable($store_id, $store_details_from_tokens){
        $this->db->select('is_whatsapp,whatsapp_no');
        $this->db->where('store_table_token',$store_details_from_tokens);
        $this->db->where('store_id', $store_id);
        $this->db->from('store_table');
        $query = $this->db->get();
        return $query->row_array();

    }

public function isWhatsappDeliveryEnable($store_id)
{
    if ($this->session->userdata('delivery_type') === 'PK') {
        $this->db->select('pickup_whatsapp_enable, pickup_whatsapp_no');
    } else {
        $this->db->select('delivery_whatsapp_enable, delivery_whatsapp_no');
    }

    $this->db->from('store');
    $this->db->where('store_id', $store_id);
    $query = $this->db->get();

    return $query->row_array(); // Returns associative array with whatsapp enable and number
}

}
?>