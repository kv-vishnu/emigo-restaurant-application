<?php
class Deliverymodel extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

       public function get_delivery_orders($store_id,$type) {
            $this->db->select('id,store_id,orderno, total_amount, tax ,tax_amount,order_status,delivery_boy,customer_name,contact_number,approved_by');
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('order_type', $type);
            $this->db->where('is_paid', 0);
            $this->db->order_by('id', 'DESC');
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,variant_value,total_amount,product_id,quantity,category_id,is_approve,is_reorder,is_delete');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $this->get_order_total($order['orderno'],$this->session->userdata('logged_in_store_id')),
                    'tax' => $order['tax'],
                    'tax_amount' => $order['tax_amount'],
                    'order_status' => $order['order_status'],
                    'delivery_boy' => $order['delivery_boy'],
                    'customer_name' => $order['customer_name'],
                    'contact_number' => $order['contact_number'],
                    'approved_by' => $order['approved_by'] ,
                      'is_reorder'=> $this->check_approve_order_exist($order['orderno']),
                    'items' => $items
                ];
            }
            return $orderData;
        }
        public function getKotEnabledStatus($store_id)
        {
            $this->db->select('is_kot_print_enabled');
            $this->db->from('store');
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            $result = $query->row();
            return $result->is_kot_print_enabled;
        }
        public function getsuppliers($store_id)
        {
            $this->db->select('sta.user_id, u.userid, u.Name');
            $this->db->from('store_table_assign sta');
            $this->db->join('users u', 'u.userid = sta.user_id');
            $this->db->where('sta.store_id', $store_id);
            $this->db->where('sta.is_delivery',1);
            $this->db->where('u.is_logged_in', 1 );
            $query = $this->db->get();
            return $query->result_array();
        }
        public function check_approve_order_exist($orderno)
        {
            $this->db->where('is_approve', 1);
            $this->db->where('orderno', $orderno);
            $this->db->where('orderno', $orderno);
            $query = $this->db->get('order_items');
            if ($query->num_rows() > 0) {
                return 1;
            } else {
                return 0;
            }
        }
        public function getProductName($product_id)
        {
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

        public function getVariantName($variant_id)
        {
            $this->db->select('*');
            $this->db->from('variants');
            $this->db->where('variant_id ', $variant_id);
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $code = $result[0]['code'];
            }else{
                return '';
            }
        }
        public function getVariantValue($variant_id,$product_id)
        {
            $this->db->select('*');
            $this->db->from('store_variants');
            $this->db->where('variant_id', $variant_id);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('store_product_id', $product_id);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $result = $query->result_array();

            if(!empty($result)){
                return $code = $result[0]['variant_value'];
            }else{
                return '';
            }
        }
         public function completed_delivery_orders($type) {
            $this->db->select('id,store_id,orderno, total_amount ,tax_amount,customer_name,contact_number');
            $this->db->from('order');
            //$this->db->where('date', $date);
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->where('order_type', $type);
            $this->db->where('is_paid', 1);
            $this->db->order_by('id', 'DESC');
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,total_amount,product_id,quantity');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $this->get_order_total($order['orderno'],$this->session->userdata('logged_in_store_id')),
                    'tax_amount' => $order['tax_amount'],
                    'customer_name' => $order['customer_name'],
                    'contact_number' => $order['contact_number'],
                    // 'is_addno'
                    'items' => $items
                ];
            }
            return $orderData;
        }
        public function get_order_total($order_number, $store_id)
        {
            $this->db->select('SUM(amount) - SUM(return_amount) AS net_total');
            $this->db->from('order_items');
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_number);

            $query = $this->db->get();
            $result = $query->row();

            return $result->net_total;
        }
    }