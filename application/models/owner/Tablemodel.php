<?php
class Tablemodel extends CI_Model {

        public function __construct() {
            $this->load->database();
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
        public function getPendingOrdersByTableId($store_id,$table_id)
        {
            $this->db->select('id,store_id,orderno, total_amount ,tax,tax_amount,order_status,delivery_boy,approved_by');
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('order_type', 'D');
            $this->db->where('table_id', $table_id);
            $this->db->where('is_paid', 0);
            $this->db->order_by('id', 'DESC');
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,variant_value,total_amount,product_id,quantity,is_approve,is_reorder,is_delete,return_qty,replace_qty,return_amount');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $order['total_amount'],
                    'total_amount_after_return' => $this->total_amount_after_return($order['orderno']),
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

        public function total_amount_after_return($orderno)
        {
            $this->db->select('SUM(amount) as total_amount, SUM(return_amount) as total_return_amount');
            $this->db->from('order_items');
            $this->db->where('orderno', $orderno);
            $query = $this->db->get();
            $result = $query->row_array();
            $total_amount = $result['total_amount'];
            $total_return = $result['total_return_amount'];
            return $total_amount - $total_return;
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

        public function approve_table_order($order_id, $store_id, $selectedsupplier , $order_items)
        {
            foreach ($order_items as $key => $order)
            {
				$tax_amount = $order['quantity'] * $order['rate'] * $order['tax'] / 100;
				$total_amount = $order['quantity'] * $order['rate'] + $tax_amount;
				$order_sl  = $order['id'];
				$product_id  = $order['product_id'];
                $variant_value  = $order['variant_value'];
				$this->CheckOrderApprove($order_sl,$store_id,$order_id,$selectedsupplier,$product_id,$variant_value,$order['quantity'],$order['rate'],$tax_amount,$total_amount);
			}
			return true;
        }
        public function CheckOrderApprove($order_sl, $store_id, $order_id,$selectedsupplier, $product_id, $variant_value, $quantity, $rate, $tax_amount, $total_amount)
        {
            $user_id = $this->session->userdata('user_id'); // Loged in user id
            $role_id = $this->session->userdata('role_id');

            $this->db->set('quantity', $quantity);
            $this->db->set('rate', $rate);
            $this->db->set('tax_amount', $tax_amount);
            $this->db->set('total_amount', $total_amount);
            $this->db->set('is_approve', 1); //Approved status
            $this->db->where('id', $order_sl);
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->where('product_id', $product_id);
            $this->db->update('order_items');

            // Recalculate total order amount and tax
            $this->db->select('sum(total_amount) as total_amount, sum(tax_amount) as tax_amount');
            $this->db->from('order_items');
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $query = $this->db->get();
            $result = $query->result_array();

            $total_amount = $result[0]['total_amount'];
            $tax_amount = $result[0]['tax_amount'];

            $this->db->set('total_amount', $total_amount);
            $this->db->set('tax_amount', $tax_amount);
            $this->db->set('order_status', 1); // Changed to cooking status
            $this->db->set('approved_by', $selectedsupplier);  // Selected supplier
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order');

            $final_quantity = $variant_value * $quantity;

            $this->db->insert('store_stock', array(
                    'ttype' => 'SL',
                    'store_id' => $store_id,
                    'tr_date' => date('Y-m-d'),
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'is_combo' => 0, // This is not a combo item
                    'pu_qty' => 0,
                    'sl_qty' => $final_quantity, // Adjusted for variants or normal quantity
                    'created_by' => $user_id,
                    'created_date' => date('Y-m-d H:i:s'),
                    'modified_by' => $user_id,
                    'modified_date' => date('Y-m-d H:i:s')
            ));
        }
        public function completed_table_orders($date,$tableId) {
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
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,total_amount,product_id,quantity,(quantity - return_qty) AS quantity');
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

        public function getOrderItems($order_id,$store_id)
        {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,variant_value,total_amount,product_id,quantity,order_type,table_id,is_return,return_qty');
                $this->db->from('order_items');
                $this->db->where('orderno', $order_id);
                $this->db->where('store_id', $store_id);
                $this->db->where('is_approve', 0 );
                $itemsQuery1 = $this->db->get();
                return $items = $itemsQuery1->result_array();
        }

        public function getCurrentStock($product_id,$date,$store_id) {
            $this->db->select('(SUM(pu_qty) - SUM(sl_qty)) as bal_qty');
            $this->db->from('store_stock');
            $this->db->where('product_id', $product_id);
            //$this->db->where('tr_date', $date);
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result[0]['bal_qty'];
        }
        public function getCurrentVariantProductOrderedQuantity($product_id, $date, $store_id,$order_id)
        {
            $this->db->select('SUM(oi.quantity * oi.variant_value) AS total_variant_qty');
            $this->db->from('order_items oi');
            $this->db->where('oi.store_id', $store_id);
            $this->db->where('oi.product_id', $product_id);
            $this->db->where('orderno', $order_id);
            $query = $this->db->get();
            return $query->row()->total_variant_qty ?? 0;
        }

        // Get all products with their variants
    public function loadProductsOnLoadNewOrderSelectProduct()
    {
        $this->db->select('store_product_id as product_id, store_product_name_en as product_name,rate');
        $this->db->from('store_wise_product_assign');
        $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));

        $productsData = $this->db->get()->result_array();

        $products = [];

        foreach ($productsData as $product) {

            $product_rate = $product['rate'];
            $variants = $this->getVariantsByProductId($product['product_id'] , $product_rate);

            $products[] = [
                'product_id' => $product['product_id'],
                'name' => $product['product_name'],
                'variants' => $variants
            ];
        }
        //print_r($products);
        return $products;
    }


    public function getVariantsByProductId($productId , $product_rate)
    {
        $this->db->select('v.variant_name, sv.rate,sv.variant_value');
        $this->db->from('store_variants sv');
        $this->db->join('variants v', 'v.variant_id = sv.variant_id', 'left');
        $this->db->where('sv.store_product_id', $productId);

        $rows = $this->db->get()->result_array();

        $variants = [];

        foreach ($rows as $row) {
            if (!empty($row['variant_name'])) {
                $variants[$row['variant_name']] = (float)$row['rate'];
                $variants['variant_value'] = $row['variant_value'];
            }
        }

        // No variants → return single price
        if (empty($variants)) {

            $this->db->select('rate');
            $this->db->from('store_variants');
            $this->db->where('store_product_id', $productId);

            $single = $this->db->get()->row_array();

            $variants['price'] = isset($single['rate']) ? (float)$single['rate'] : $product_rate;
        }
        return $variants;
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
