<?php
class Roommodel extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function listrooms($store_id){
        $this->db->select('*');
        $this->db->from('store_table');
        $this->db->where('ttype','rom');
        $this->db->where('is_active', 1);
        $this->db->where('store_id',$store_id);
        $this->db->order_by("table_id", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

        public function getsuppliers($store_id,$tableid)
        {
            $this->db->select('sta.user_id, u.userid, u.Name');
            $this->db->from('store_table_assign sta');
            $this->db->join('users u', 'u.userid = sta.user_id');
            $this->db->where('sta.store_id', $store_id);
            $this->db->where('sta.table_id', $tableid);
            $this->db->where('u.is_logged_in', 1 );
            $query = $this->db->get();
            return $query->result_array();
        }
        public function pending_room_orders($store_id,$table_id)
        {
            $this->db->select('id,store_id,orderno, total_amount ,tax,tax_amount,order_status,delivery_boy,approved_by');
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('order_type', 'rom');
            $this->db->where('table_id', $table_id);
            $this->db->where('is_paid', 0);
            $this->db->order_by('id', 'DESC');
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,variant_value,total_amount,product_id,quantity,is_approve,is_reorder,is_delete');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $this->get_order_total($order['orderno'],$this->session->userdata('logged_in_store_id')),
                    'tax_amount' => $order['tax_amount'],
                    'tax' => $order['tax'],
                    'delivery_boy' => $order['delivery_boy'],
                    'order_status' => $order['order_status'],
                    'approved_by' => $order['approved_by'],
                    'is_reorder'=> $this->check_approve_order_exist($order['orderno']),
                    'items' => $items
                ];
            }
            return $orderData;
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

        public function getKotEnabledStatus($store_id)
        {
            $this->db->select('is_kot_print_enabled');
            $this->db->from('store');
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            $result = $query->row();
            return $result->is_kot_print_enabled;
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

        public function approve_table_order($order_no, $store_id, $update_data)
        {
            return $this->db->where('orderno', $order_no)
                            ->where('store_id', $store_id)
                            ->update('order', $update_data);
        }
        public function completed_room_orders($date,$tableId) {
            $this->db->select('id,store_id,orderno, total_amount ,tax_amount');
            $this->db->from('order');
            $this->db->where('date', $date);
            $this->db->where('table_id', $tableId);
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
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
                    'items' => $items
                ];
            }
            return $orderData;
        }
        public function getVariantValue($variant_id,$product_id) {
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