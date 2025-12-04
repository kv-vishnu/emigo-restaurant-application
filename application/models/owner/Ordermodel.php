<?php
class Ordermodel extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        //MARK:ORDER DETAILS
        public function order_details($store_id,$orderno) {
            $this->db->select('id,store_id,orderno, total_amount ,tax,tax_amount,order_status,delivery_boy,order_type,approved_by,is_paid');
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $orderno);
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,total_amount,product_id,quantity,is_approve,is_reorder,is_delete,return_qty,replace_qty,return_amount');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $order['total_amount'],
                    'tax_amount' => $order['tax_amount'],
                    'tax' => $order['tax'],
                    'delivery_boy' => $order['delivery_boy'],
                    'order_type' => $order['order_type'],
                    'order_status' => $order['order_status'],
                    'approved_by' => $order['approved_by'],
                    'is_paid' => $order['is_paid'],
                    'items' => $items
                ];
            }
            return $orderData;
        }
        //MARK:KOT ENABLE
        public function getKotEnabledStatus($store_id)
        {
            $this->db->select('is_kot_print_enabled');
            $this->db->from('store');
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            $result = $query->row();
            return $result->is_kot_print_enabled;
        }
        //MARK:Change Order Status
        public function change_order_status($store_id,$order_id,$data)
        {
                $this->db->where('orderno', $order_id);
                $this->db->where('store_id', $store_id);
                $this->db->update('order', $data);
        }
        public function update_order_status_and_delivery_time($orderId,$status){
                $this->db->set('order_status', $status);
                $this->db->set('delivered_time', date('H:i:s'));
                $this->db->where('orderno', $orderId);
                $this->db->update('order');
        }
        public function change_order_status_with_ofd($store_id,$order_id,$data){
                $this->db->where('orderno', $order_id);
                $this->db->where('store_id', $store_id);
                $this->db->update('order', $data);
        }
        public function getOutForDeliveryOrders($store_id){
           $this->db->where_in('order_status', [ 4 ]);
            $this->db->where('store_id', $store_id);
            $this->db->order_by('date', 'DESC');
            $this->db->order_by('orderno', 'DESC');

            $orders = $this->db->get('order')->result_array();

            // Loop through orders and add table name with its ID
            foreach ($orders as &$order) {
                $order['table_name'] = $this->get_table_name($order['table_id']);
                $order['approved_by_name'] = $this->get_user_name($order['approved_by']);
                $order['out_for_delivery_time'] = $order['out_for_delivery_time'];
            }

            return $orders;
        }

        public function pay_order($store_id,$order_id)
        {
            $this->db->set('is_paid', 1);
            $this->db->set('paid_by', $this->session->userdata('user_name'));
            $this->db->where('orderno', $order_id);
            $this->db->where('store_id', $store_id);
            $this->db->update('order');
        }
        public function get_table_name($table_id) {
            $this->db->select('table_name, store_table_name');
            $this->db->from('store_table');
            $this->db->where('table_id', $table_id);
            $query = $this->db->get();
            $row = $query->row_array();

            return !empty($row['store_table_name']) ? $row['store_table_name'] : ($row['table_name'] ?? '');
        }
         public function getOrderItems($orderno){
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,variant_value,total_amount,product_id,quantity,order_type,table_id,is_return,return_qty');
                $this->db->from('order_items');
                $this->db->where('orderno', $orderno);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery1 = $this->db->get();
                return $items = $itemsQuery1->result_array();

        }

        public function getOrderSummary($orderno){
            $this->db->select('id,store_id,tax,orderno, amount ,total_amount,tax_amount');
            $this->db->from('order');
            $this->db->where('orderno', $orderno);
            $itemsQuery = $this->db->get();
            return $order = $itemsQuery->row();
        }
        public function delete_order($orderId) {
            $this->db->where('orderno', $orderId);
            $this->db->delete('order_items');
            $this->db->where('orderno', $orderId);
            $this->db->delete('order');
            return true;
        }
        public function Check_product_is_customizable($product_id,$store_id){
            $this->db->select('is_customizable');
            $this->db->from('store_wise_product_assign');
            $this->db->where('store_product_id', $product_id);
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            $row = $query->row_array();
            return $row['is_customizable'];
        }
        public function update_order_item($store_id,$order_number,$order_item_id,$product_id,$quantity,$rate,$tax_amount){
            $amount = $quantity * $rate;
            $total_amnt = $quantity * $rate + $tax_amount;
             $this->db->set('quantity', $quantity);
             $this->db->set('rate', $rate);
             $this->db->set('amount', $amount);
             $this->db->set('tax_amount', $tax_amount);
             $this->db->set('total_amount', $total_amnt);
             $this->db->where('id', $order_item_id);
             $this->db->where('store_id', $store_id);
             $this->db->where('orderno', $order_number);
             $this->db->where('product_id', $product_id);
             $this->db->update('order_items');

             // Recalculate total order amount and tax
             $this->db->select('sum(total_amount) as total_amount, sum(tax_amount) as tax_amount');
             $this->db->from('order_items');
             $this->db->where('store_id', $store_id);
             $this->db->where('orderno', $order_number);
             $query = $this->db->get();
             $result = $query->result_array();

             $total_amount = $result[0]['total_amount'];
             $tax_amount = $result[0]['tax_amount'];

             $this->db->set('total_amount', $total_amount);
             $this->db->set('tax_amount', $tax_amount);
             $this->db->where('store_id', $store_id);
             $this->db->where('orderno', $order_number);
             $this->db->update('order');
            return true;
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
        public function update_order_total_tax_amount($order_number, $store_id,$order_total,$tax_amount,$total_amount)
        {
            $this->db->set('amount', $order_total);
            $this->db->set('tax_amount', $tax_amount);
            $this->db->set('total_amount', $total_amount);
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_number);
            $this->db->update('order');
        }
        public function get_store_wise_product_by_id($product_id) {
            $this->db->where('store_product_id', $product_id);
            $query = $this->db->get('store_wise_product_assign');
            return $query->result_array();
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
        public function getSalesReportByStoreId($store_id, $date) {
            $this->db->select('DATE(date) as sale_date,
            SUM(CASE WHEN order_type = "D" THEN 1 ELSE 0 END) as dinein_count,
            SUM(CASE WHEN order_type = "DL" THEN 1 ELSE 0 END) as delivery_count,
            SUM(CASE WHEN order_type = "PK" THEN 1 ELSE 0 END) as pickup_count,
             SUM(CASE WHEN order_type = "rom" THEN 1 ELSE 0 END) as rom_count,
            SUM(CASE WHEN order_type = "D" THEN total_amount ELSE 0 END) as dinein_total_amount,
            SUM(CASE WHEN order_type = "DL" THEN total_amount ELSE 0 END) as delivery_total_amount,
            SUM(CASE WHEN order_type = "PK" THEN total_amount ELSE 0 END) as pickup_total_amount,
            SUM(CASE WHEN order_type = "rom" THEN total_amount ELSE 0 END) as rom_total_amount,
            COUNT(*) as total_sales,
            SUM(total_amount) as total_amount'); // Total amount for all orders
    $this->db->from('order');
    $this->db->where('store_id', $store_id); // Filter by store ID
    $this->db->where('DATE(date)', $date);  // Filter by specific date
    $this->db->where('is_paid', 1);
    $this->db->group_by('DATE(date)');
    $this->db->order_by('sale_date', 'DESC');

    $query = $this->db->get();

            //echo $this->db->last_query();exit;
            return $query->result_array();
        }

         public function delete_order_item($orderItemId,$store_id)
         {
            // Retrieve the order number associated with the item
            $this->db->select('orderno');
            $this->db->from('order_items');
            $this->db->where('id', $orderItemId);
            $query = $this->db->get();
            $result = $query->row();

            if($result)
            {
                $orderNumber = $result->orderno;

                $this->db->where('id', $orderItemId);
                $this->db->delete('order_items');

                // Check if there are any remaining items for this order
                $this->db->where('orderno', $orderNumber);
                $remainingItems = $this->db->count_all_results('order_items');

                // If no items remain, delete the order
                if ($remainingItems == 0) {
                    $this->db->where('orderno', $orderNumber);
                    $this->db->delete('order');
                }

                $this->db->select('sum(total_amount) as total_amount, sum(tax_amount) as tax_amount');
                $this->db->from('order_items');
                $this->db->where('store_id',$store_id);
                $this->db->where('orderno', $orderNumber);
                $query = $this->db->get();
                $result = $query->result_array();

                $total_amount = $result[0]['total_amount'];
                $tax_amount = $result[0]['tax_amount'];
                $this->db->set('total_amount', $total_amount);
                $this->db->set('tax_amount', $tax_amount);
                $this->db->where('store_id', $store_id);
                $this->db->where('orderno', $orderNumber);
                $this->db->update('order');
            }
            return true;
        }
        public function updateOrderNo(){

            $this->db->select('token_id');
            $this->db->from('token_generation');
            $this->db->where('id ', 1);
            $query = $this->db->get();
            $result = $query->result_array();
            $token_id = $result[0]['token_id'];

            $newOrderNumber = $token_id + 1;
            $this->db->set('token_id', $newOrderNumber);
            $this->db->where('id', 1);
            $this->db->update('token_generation');

            $this->db->select('token_id');
            $this->db->from('token_generation');
            $this->db->where('id ', 1);
            $query = $this->db->get();
            $result = $query->result_array();
            return $token_id = $result[0]['token_id'];
        }
        public function updateOrderItemReturn($order_item_id,$data) {
            $this->db->where('id', $order_item_id);
            $this->db->update('order_items', $data);
            return $this->db->affected_rows() > 0;
        }
        public function InsertReplaceOrderToStock($replace_quantity, $store_id, $productId, $date,$order_id)
        {
            $this->db->insert('store_stock', array(
                'ttype' => 'SL',
                'store_id' => $store_id,
                'tr_date' => date('Y-m-d'),
                'order_id' => $order_id,
                'product_id' => $productId,
                'is_combo' => 1,
                'pu_qty' => 0,
                'sl_qty' => $replace_quantity,
                'created_by' => 1,
                'created_date' => date('Y-m-d H:i:s'),
                'modified_by' => 1,
                'modified_date' => date('Y-m-d H:i:s')
            ));
        }
        public function updateReturnAmount($return_amount, $order_item_id,$store_id){
            $this->db->set('return_amount', $return_amount);
            $this->db->where('store_id', $store_id);
            $this->db->where('id', $order_item_id);
            $this->db->update('order_items');
        }
        public function getReturnedQty($order_item_id)
        {
            return $this->db->select('return_qty')
                            ->from('order_items')
                            ->where('id', $order_item_id)
                            ->get()->row()->return_qty;
        }

        public function getReplacedQty($order_item_id)
        {
            return $this->db->select('replace_qty')
                            ->from('order_items')
                            ->where('id', $order_item_id)
                            ->get()->row()->replace_qty;
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



        public function getPendingTableOrderCount($table_id){
            $this->db->from('order'); // Specify the table
            $this->db->where('is_paid', 0);
            $this->db->where('order_type', 'D');
            $statuses = [0, 1 , 2, 3, 4]; // Pending and Approved statuses
            $this->db->where_in('order_status', $statuses);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('table_id',$table_id);
            return $this->db->count_all_results();
        }

                public function getPendingRoomOrderCount($table_id){
            $this->db->from('order'); // Specify the table
            $this->db->where('is_paid', 0);
            $this->db->where('order_type', 'rom');
            $statuses = [0, 1 , 2, 3, 4]; // Pending and Approved statuses
            $this->db->where_in('order_status', $statuses);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('table_id',$table_id);
            return $this->db->count_all_results();
        }
        public function getUnpaidOrderCount($table_id){
            $this->db->from('order'); // Specify the table
            $this->db->where('is_paid', 0);
            $this->db->where('order_type', 'D');
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('table_id',$table_id);
            return $this->db->count_all_results();
        }
        public function getUnpaidOrderCountWithoutReady($table_id){
            $this->db->from('order'); // Specify the table
            $this->db->where('is_paid', 0);
            $this->db->where('order_type', 'D');
            $this->db->where('order_status!=', 3);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('table_id',$table_id);
            return $this->db->count_all_results();
        }

        public function getApprovedTableOrderCount($table_id){
            $this->db->from('order'); // Specify the table
            $this->db->where('is_paid', 0);
            $this->db->where('order_type', 'D');
            $statuses = [1]; // Pending and Approved statuses
            $this->db->where_in('order_status', $statuses);
            $this->db->where('order_status!=', 3);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('table_id',$table_id);
            return $this->db->count_all_results();
        }

        public function get_pending_orders_count_for_alert($store_id,$role_id,$user_id)
        {
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('order_status', 0);
            if($role_id != 1 && $role_id != 2)
            {
                $this->db->where('approved_by', $user_id);
            }
            return $this->db->count_all_results();
        }
        public function get_ready_orders_count_for_alert($store_id,$role_id,$user_id)
        {
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('order_status', 3);
            if($role_id != 1 && $role_id != 2)
            {
                $this->db->where('approved_by', $user_id);
            }
            return $this->db->count_all_results();
        }

        public function get_Pending_Orders_Count_db($type,$store_id,$role_id,$user_id) {
            // echo $role_id;
            $this->db->select('table_id');
            $this->db->where('store_id', $store_id);
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('store_table_assign');
            // echo $this->db->last_query();


            $tables = $query->result_array();
            // print_r($tables);
            $table_ids = array();
            foreach ($tables as $table) {
                $table_ids[] = $table['table_id']; //Already assigned table ids
            }

            //echo $type;exit;
            $this->db->where('order_type', $type);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('is_paid', 0); // Assuming '0' is the status for pending orders
            if ($role_id != 1 && $role_id != 2 && !empty($table_ids)) {
                $this->db->where_in('table_id', $table_ids);
            }
            return $this->db->count_all_results('order'); // Replace 'orders' with your actual table name
        }

        //MARK:Get Order count
        public function get_Pending_room_Orders_Count_db($type,$store_id,$role_id,$user_id) {
            // echo $role_id;
            $this->db->select('table_id');
            $this->db->where('store_id', $store_id);
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('store_table_assign');
            // echo $this->db->last_query();


            $tables = $query->result_array();
            // print_r($tables);
            $table_ids = array();
            foreach ($tables as $table) {
                $table_ids[] = $table['table_id']; //Already assigned table ids
            }

            //echo $type;exit;
            $this->db->where('order_type', $type);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('order_status', 0); // Assuming '0' is the status for pending orders
            if ($role_id != 1 && $role_id != 2 && !empty($table_ids)) {
                $this->db->where_in('table_id', $table_ids);
            }
            return $this->db->count_all_results('order'); // Replace 'orders' with your actual table name
        }

        public function get_Approved_Orders_Count($type) {
            $this->db->where('order_type', $type);
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('order_status', 1); // Assuming '1' is the status for approved orders
            return $this->db->count_all_results('order'); // Replace 'orders' with your actual table name
        }

        public function get_Ready_Orders_Count()
        {
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->where_in('order_status', [3]);
            $this->db->where('is_paid', 0);
            return $this->db->count_all_results('order');
        }
        public function get_Ready_Orders_Count_user_assigned($store_id,$role_id,$user_id){
            //echo $store_id;echo $role_id;echo $user_id;exit;
            $this->db->where('store_id',$store_id);
            $this->db->where('order_status', 3); // Assuming '1' is the status for approved orders
            if ($role_id != 1 && $role_id != 2) {
                $this->db->where('approved_by', $user_id);
            }
            return $this->db->count_all_results('order');
        }

        public function get_pending_order_table_ids(){
            $this->db->select('table_id,COUNT(*) as pending_orders'); // Adjust based on your database structure
            $this->db->from('order');
            $this->db->where_in('order_type',  ['D', 'rom'] );
            $this->db->where('is_paid', '0'); // Adjust as needed
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->group_by('table_id');
            $query = $this->db->get();
            return $query->result_array();

        }

        // public function get_pending_order_rooms1()
        // {
        //     $store_id = $this->session->userdata('logged_in_store_id');

        //     $this->db->select('o.table_id, o.orderno, o.order_token, st.table_name, COUNT(*) as pending_orders');
        //     $this->db->from('`order` o'); // Alias + escape
        //     $this->db->join('store_table st', 'st.table_id = o.table_id', 'left');
        //     $this->db->where('o.order_type', 'rom');        // fixed
        //     $this->db->where('o.order_status', '0');
        //     $this->db->where('o.store_id', $store_id);
        //     $this->db->group_by(['o.table_id', 'o.orderno', 'o.order_token', 'st.table_name']);

        //     return $this->db->get()->result_array();
        // }
        public function get_pending_order_rooms()
        {
            $store_id = $this->session->userdata('logged_in_store_id');

            $this->db->select("
                store_table.*,

                (SELECT COUNT(*)
                FROM `order` o1
                WHERE o1.table_id = store_table.table_id
                AND o1.store_id = $store_id
                AND o1.order_status = 0
                ) AS pending_count,
                 (SELECT COUNT(*)
                FROM `order` o1
                WHERE o1.table_id = store_table.table_id
                AND o1.store_id = $store_id
                AND o1.order_status = 2
                ) AS cooking_count
            ");

            $this->db->from('store_table');
            $this->db->join('`order` AS o', 'o.table_id = store_table.table_id', 'inner');
            $this->db->where('store_table.store_id', $store_id);
            $this->db->where('store_table.ttype', 'rom');
            $this->db->where('o.is_paid', 0);
            $this->db->group_by('store_table.table_id');

            $query = $this->db->get();
            return $query->result_array();
        }


        public function get_pending_reorder_table_ids(){
            // $this->db->select('orderno,table_id'); // Adjust based on your database structure
            // $this->db->from('order');
            // $this->db->where('order_type', 'D');
            // $this->db->where('order_status', '0'); // Adjust as needed
            // $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            // $query = $this->db->get();
            // $rows = $query->result_array();
            // foreach ($rows as $row) {
            //     echo "Order No: " . $row['orderno'] . " - Table ID: " . $row['table_id'] . "<br>";
            //     $this->db->select('id');
            //     $this->db->from('order_items');
            //     $this->db->where('orderno', $row['orderno']);
            //     $this->db->where('is_reorder', 1);
            //     $exists = $this->db->count_all_results();

            //     if ($exists > 0) {
            //         echo " - Reorder Exists";
            //     }
            // }
            $this->db->select('o.table_id, COUNT(DISTINCT o.orderno) AS total_orders, COUNT(oi.id) AS reorder_exists');
            $this->db->from('order o');
            $this->db->join('order_items oi', 'o.orderno = oi.orderno AND oi.is_reorder = 1', 'left');
            $this->db->where('o.order_type', 'D');
            $this->db->where('o.order_status', '0');
            $this->db->where('o.store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->group_by('o.table_id'); // Group by table ID only to avoid duplicates
            $this->db->having('reorder_exists >', 0);
            $query = $this->db->get();
            $row = $query->result_array();
            return $row;
            //print_r($row);

        }

        public function get_approved_order_table_ids(){
            $this->db->select('table_id'); // Adjust based on your database structure
            $this->db->from('order');
            $this->db->where('order_type', 'D');
            $this->db->where('order_status', '1'); // Adjust as needed
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getOrderTableId($order_id){
            $this->db->select('table_id');
            $this->db->from('order');
            $this->db->where('orderno ', $order_id);
            $query = $this->db->get();
            $row = $query->row();
            return $row->table_id;
        }
        public function getPendingTableOrderCookingCount($table_id){
            $this->db->from('order'); // Specify the table
            $this->db->where('is_paid', 0);
            $this->db->where('order_type', 'D');
            $this->db->where('store_id',$this->session->userdata('logged_in_store_id'));
            $this->db->where('table_id',$table_id);
            $statuses = [2]; // Pending and Approved statuses
            $this->db->where_in('order_status',$statuses);
            return $this->db->count_all_results();
        }

        public function getVariantName($variant_id){
            $this->db->select('*');
            $this->db->from('variants');
            $this->db->where('variant_id ', $variant_id);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $result = $query->result_array();
            if(!empty($result)){
                return $code = $result[0]['code'];
            }else{
                return '';
            }
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

        public function getProductCategoryName($product_id) {
            $this->db->select('category_id');
            $this->db->from('store_wise_product_assign');
            $this->db->where('store_product_id ', $product_id);
            $query = $this->db->get();
            $result = $query->result_array();
            $product_id1 = $result[0]['category_id'];
            $this->db->select('*');
            $this->db->from('categories');
            $this->db->where('category_id', $product_id1);
            $product_query = $this->db->get();
            $row =  $product_query->result_array();
            return $row[0]['category_name_en'];
        }

        public function getOrdersByType($store_id,$type) {
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
                    'total_amount' => $order['total_amount'],
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

        public function getPendingOrdersByType($store_id,$type) {
            $this->db->select('id,store_id,orderno, total_amount ,tax_amount,order_status,delivery_boy,customer_name,contact_number');
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('order_type', $type);
            $this->db->where('is_paid', 0);
            $this->db->where('order_status!=', 3);
            $this->db->order_by('id', 'DESC');
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,total_amount,product_id,quantity,category_id,is_approve,is_reorder,is_delete');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $order['total_amount'],
                    'tax_amount' => $order['tax_amount'],
                    'order_status' => $order['order_status'],
                    'delivery_boy' => $order['delivery_boy'],
                    'customer_name' => $order['customer_name'],
                    'contact_number' => $order['contact_number'],
                    'items' => $items
                ];
            }
            return $orderData;
        }



        public function check_approve_order_exist($orderno){
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

        public function getPendingOrdersByTableId($store_id,$table_id) {
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
                $this->db->select('id,orderno,rate,tax,tax_amount,is_addon,item_remarks,variant_id,variant_value,total_amount,product_id,quantity,is_approve,is_reorder,is_delete,return_qty,replace_qty');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $order['total_amount'],
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


                public function getPendingOrdersByRoomId($store_id,$table_id) {
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
                    'total_amount' => $order['total_amount'],
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



        public function isOrderExists($order_id)
        {
            $this->db->where('orderno', $order_id);
            $query = $this->db->get('order');
            return $query->num_rows() > 0;
        }


        public function getProductRatesDb($store_id,$product_id,$variant_id){
            $this->db->select('*');
            $this->db->from('store_variants');
            $this->db->where('store_product_id', $product_id);
            $this->db->where('store_id', $store_id);
            $this->db->where('variant_id', $variant_id);
            $query = $this->db->get();
            return $query->row();
        }

        public function getProductRatesNotCustomizeDb($store_id,$product_id){
            $this->db->select('*');
            $this->db->from('store_wise_product_assign');
            $this->db->where('store_product_id', $product_id);
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            return $query->row();
        }

        public function updateTotalAmount($orderNo){
            $this->db->select('SUM(total_amount) as total_amount, SUM(amount) as total_rate, SUM(tax_amount) as total_tax');
            $this->db->where('orderno', $orderNo);
            $query = $this->db->get('order_items');
            $result = $query->result_array();
            return $result;  // Access the sum of total_amount
        }

        public function updateTotalAmountFromItems($orderNo){
            $this->db->select('SUM(total_amount) as total_amount, SUM(amount) as total_rate, SUM(tax_amount) as total_tax');
            $this->db->where('orderno', $orderNo);
            $query = $this->db->get('order_items');
            $result = $query->result_array();
            return $result;  // Access the sum of total_amount
        }

        public function checkCustomizable($product_id){
            $this->db->select('is_customizable');
            $this->db->from('store_wise_product_assign');
            $this->db->where('store_product_id', $product_id);
            $query = $this->db->get();
            $result = $query->row();
            return $result->is_customizable;
        }
        public function getVariants($product_id,$store_id) {
            $this->db->select('v.*, sv.*');
            $this->db->from('store_variants sv');
            $this->db->join('variants v', 'v.variant_id = sv.variant_id');
            $this->db->where('sv.store_id', $store_id);
            $this->db->where('sv.store_product_id', $product_id);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            return $query->result_array();

        }

        public function getCompletedOrdersByType($date,$type) {
            $this->db->select('id,store_id,orderno, total_amount ,tax_amount,customer_name,contact_number');
            $this->db->from('order');
            $this->db->where('date', $date);
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
                    'total_amount' => $order['total_amount'],
                    'tax_amount' => $order['tax_amount'],
                    'customer_name' => $order['customer_name'],
                    'contact_number' => $order['contact_number'],
                    // 'is_addno'
                    'items' => $items
                ];
            }
            return $orderData;
        }

        public function getPaidOrderByDate($date,$tableId) {
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
                    'total_amount' => $order['total_amount'],
                    'tax_amount' => $order['tax_amount'],
                    'items' => $items
                ];
            }
            return $orderData;
        }

        public function getUnPaidOrderByDate($date,$tableId) {
            $this->db->select('id,store_id,orderno, total_amount , tax_amount');
            $this->db->from('order');
            $this->db->where('date', $date);
            $this->db->where('table_id', $tableId);
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->where('is_paid', 0);
            $this->db->order_by('id', 'DESC');
            $orderQuery = $this->db->get();
            //echo $this->db->last_query();exit;
            $orders = $orderQuery->result_array();

            $orderData = [];

            foreach ($orders as $order) {
                $this->db->select('id,orderno,rate,tax,tax_amount,item_remarks,variant_id,is_addon,total_amount,product_id,quantity');
                $this->db->from('order_items');
                $this->db->where('orderno', $order['orderno']);  // Ensure `orderno` exists in both tables and matches datatype
                $itemsQuery = $this->db->get();
                $items = $itemsQuery->result_array();
                $orderData[] = [
                    'id' => $order['id'],
                    'orderno' => $order['orderno'],
                    'total_amount' => $order['total_amount'],
                    'tax_amount' => $order['tax_amount'],
                    'items' => $items
                ];
            }
            return $orderData;
        }



        public function changeDeliveryBoy($orderId,$delivery_boy){
                $this->db->set('delivery_boy', $delivery_boy);
                $this->db->set('order_status', 4);
                $this->db->set('out_for_delivery_time', date('H:i:s'));
                $this->db->where('orderno', $orderId);
                $this->db->update('order');
        }



        public function CheckOrderApprove($order_sl, $store_id, $order_id, $product_id, $quantity, $rate, $tax_amount, $total_amount, $category_id , $variant_value, $selectedsuppliers,$role_id)
        {
            $user_id = $this->session->userdata('loginid'); // Loged in user id
            $role_id = $this->session->userdata('roleid');
            // Update order item details
            $this->db->set('quantity', $quantity);
            $this->db->set('rate', $rate);
            $this->db->set('tax_amount', $tax_amount);
            $this->db->set('total_amount', $total_amount);
            // if($role_id == 2 ) {
            //     $this->db->set('is_approve', 0); // Approved status for admin
            // } else {
            //     $this->db->set('is_approve', 1); // Pending status for other roles
            // }
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
            // if($role_id == 2 ) {
            //     $this->db->set('order_status', 0); // Pending status for admin
            // } else {
            //     $this->db->set('order_status', 1); // Approved status for other roles
            // }
            $this->db->set('order_status', 1); // Changed to cooking status
            $this->db->set('approved_by', $selectedsuppliers);  // Selected supplier
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order');

            $is_combo = $this->productIsCombo($product_id);

            if ($is_combo)
            {
                // Process combo items
                $combo_items = $this->getComboItems($store_id, $product_id);
                foreach ($combo_items as $item)
                {
                    $combo_product_id = $item['item_id'];
                    $combo_quantity = $item['quantity'] * $quantity; // Adjust quantity based on the combo quantity
                    $this->db->insert('store_stock', array(
                        'ttype' => 'SL',
                        'store_id' => $store_id,
                        'tr_date' => date('Y-m-d'),
                        'order_id' => $order_id,
                        'product_id' => $combo_product_id,
                        'is_combo' => 1,
                        'pu_qty' => 0,
                        'sl_qty' => $combo_quantity,
                        'created_by' => 1,
                        'created_date' => date('Y-m-d H:i:s'),
                        'modified_by' => 1,
                        'modified_date' => date('Y-m-d H:i:s')
                    ));
                }
            }
            else
            {

                if($variant_value > 0){
                    $final_quantity = $variant_value * $quantity;
                }else{
                    $final_quantity = $quantity;
                }


                // Insert stock for normal or variant product
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
        }


    public function productIsCombo($product_id){
        $this->db->select('category_id');
        $this->db->from('store_wise_product_assign');
        $this->db->where('store_product_id', $product_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return ($result->category_id == 23); // Returns true if category_id is 23, false otherwise
        }
        return false;
    }


        // public function CheckOrderApprove($order_sl,$store_id,$order_id,$product_id,$quantity,$rate,$tax_amount,$total_amount,$category_id){

        //         $this->db->set('quantity', $quantity);
        //         $this->db->set('rate', $rate);
        //         $this->db->set('tax_amount', $tax_amount);
        //         $this->db->set('total_amount', $total_amount);
        //         $this->db->where('id', $order_sl);
        //         $this->db->where('store_id', $store_id);
        //         $this->db->where('orderno', $order_id);
        //         $this->db->where('product_id', $product_id);
        //         $this->db->update('order_items');

        //         $this->db->select('sum(total_amount) as total_amount, sum(tax_amount) as tax_amount');
        //         $this->db->from('order_items');
        //         $this->db->where('store_id', $store_id);
        //         $this->db->where('orderno', $order_id);
        //         $query = $this->db->get();
        //         $result = $query->result_array();

        //         $total_amount = $result[0]['total_amount'];
        //         $tax_amount = $result[0]['tax_amount'];
        //         $this->db->set('total_amount', $total_amount);
        //         $this->db->set('tax_amount', $tax_amount);
        //         $this->db->set('order_status', 1 ); //Changed to cooking status
        //         $this->db->where('store_id', $store_id);
        //         $this->db->where('orderno', $order_id);
        //         $this->db->update('order');



        //         $this->db->delete('store_stock', array('ttype' => 'SL','store_id' => $store_id, 'order_id' => $order_id, 'product_id' => $product_id , 'tr_date' => date('Y-m-d')));
        //         $this->db->insert('store_stock', array( 'ttype' => 'SL','store_id' => $store_id,'tr_date' => date('Y-m-d'), 'order_id' => $order_id, 'product_id' => $product_id, 'pu_qty' => 0 , 'sl_qty' => $quantity , 'created_by' => 1 , 'created_date' => date('Y-m-d H:i:s') , 'modified_by' => 1 , 'modified_date' => date('Y-m-d H:i:s')));
        //         $stock = $this->getCurrentStock($product_id,date('Y-m-d'),$store_id);
        //         if($stock == 0)
        //         {
        //             $this->db->set('is_active', 1);
        //             $this->db->where('store_id', $store_id);
        //             $this->db->where('store_product_id', $product_id);
        //             $this->db->update('store_wise_product_assign');
        //         }
        // }

        public function getDeliveryBoyName($user_id){
            $this->db->select('Name');
            $this->db->from('users');
            $this->db->where('userid', $user_id);
            $query = $this->db->get();
            $result = $query->row();
            return $result->Name ?? '';

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
                echo 0;
            }else{
            echo $result->rate;
            }
        }
        public function getItemRate($store_id,$order_item_id , $item_variant_id)
        {
            if($item_variant_id == 0) //normal product
            {
                $rates = $this->getProductRatesNotCustomizeDb($store_id,$order_item_id);
                return $rates->rate;
            }
            else //customisable product varient id != 0
            {
                $rates = $this->getProductRatesDb($store_id,$order_item_id,$item_variant_id);
                return $rates->rate;
            }
        }
        public function getCustomizeProductDefaultPriceOnSearch($store_product_id,$store_id){
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

        // public function getApprovedOrders($store_id){
        //     $statuses = [1, 2];
        //     $this->db->where_in('order_status', $statuses);
        //     $this->db->where('store_id', $store_id);
        //     $this->db->order_by('date', 'DESC');
        //     $this->db->order_by('orderno', 'DESC');

        //     $orders = $this->db->get('order')->result_array();

        //     // Loop through orders and add table name
        //     foreach ($orders as &$order) {
        //         $order['table_name'] = $this->get_table_name($order['table_id']);
        //     }

        //     return $orders;
        // }


        public function getApprovedOrders($store_id){
    $statuses = [1, 2];
    $this->db->select('o.*, u.Name as approved_by_name'); // fetch approver name
    $this->db->from('order o');
    $this->db->join('users u', 'u.userid = o.approved_by', 'left'); // join with users table
    $this->db->where_in('o.order_status', $statuses);
    $this->db->where('o.store_id', $store_id);
    $this->db->order_by('o.date', 'DESC');
    $this->db->order_by('o.orderno', 'DESC');

    $orders = $this->db->get()->result_array();

    // Loop through orders and add table name
    foreach ($orders as &$order) {
        $order['table_name'] = $this->get_table_name($order['table_id']);
    }

    return $orders;
}

// public function getReadyOrders($store_id, $role_id, $user_id)
// {
//     $this->db->select('o.*, sta.user_id as assigned_user, sta.is_pickup');
//     $this->db->from('`order` o');
//     $this->db->join('store_table_assign sta', 'sta.table_id = o.table_id', 'left');

//     $this->db->where_in('o.order_status', [3, 4]); // Ready / Pickup
//     $this->db->where('o.is_paid', 0);
//     $this->db->where('o.store_id', $store_id);

//     // Non-admin restrictions
//     if ($role_id != 1 && $role_id != 2) {
//         $this->db->group_start();

//             // ✅ Ready orders: all assigned users can see
//             $this->db->group_start();
//                 $this->db->where('o.order_status', 3);
//                 $this->db->where('sta.user_id', $user_id);
//             $this->db->group_end();

//             // ✅ Pickup orders: only pickup-enabled user sees
//             $this->db->or_group_start();
//                 $this->db->where('o.order_status', 3);
//                 $this->db->where('sta.user_id', $user_id);
//                 $this->db->where('sta.is_pickup', 1);
//             $this->db->group_end();

//         $this->db->group_end();
//     }

//     $this->db->order_by('o.date', 'DESC');
//     $orders = $this->db->get()->result_array();

//     foreach ($orders as &$order) {
//         $order['table_name'] = $this->get_table_name($order['table_id']);
//     }

//     return $orders;
// }


// foreach ($orders as &$order) {
//     $order['table_name'] = $this->get_table_name($order['table_id']);
// }



//  public function getReadyOrders($store_id, $role_id, $user_id)
// {
//     $this->db->where_in('order_status', [3, 4]);
//     $this->db->where('is_paid', 0);
//     $this->db->where('store_id', $store_id);
//     if ($role_id != 1 && $role_id != 2) {
//         $this->db->where('approved_by', $user_id);
//     }
//     $this->db->order_by('date', 'DESC');

//     $orders = $this->db->get('order')->result_array();

//     $filtered_orders = [];
// foreach ($orders as $order) {
//     if ($role_id == 1 || $role_id == 2) {
//         // Admin sees all
//         $order['table_name'] = $this->get_table_name($order['table_id']);
//         $filtered_orders[] = $order;
//         continue;
//     }
//     // Only non-admin users get filtered by table assignment
//     $this->db->where('user_id', $user_id);
//     $this->db->where('table_id', $order['table_id']);
//     $assigned = $this->db->get('store_table_assign')->row_array();

//     if ($assigned) {
//         $order['table_name'] = $this->get_table_name($order['table_id']);
//         $filtered_orders[] = $order;
//     }
// }




//     // Filter orders based on tables assigned to the user
//     // foreach ($orders as $order) {
//     //     $this->db->where('user_id', $user_id);
//     //     $this->db->where('table_id', $order['table_id']);
//     //     $assigned = $this->db->get('store_table_assign')->row_array();

//     //     if ($assigned) {
//     //         $order['table_name'] = $this->get_table_name($order['table_id']);
//     //         $filtered_orders[] = $order;
//     //     }
//     // }

//     return $filtered_orders;
// }


public function getReadyOrders($store_id, $role_id, $user_id)
{


    // Common filters
    $this->db->select('o.*');
    $this->db->from('order o');

    // Common filters
    $this->db->where_in('o.order_status', [3, 4 , 5]);
    $this->db->where('o.is_paid', 0);
    $this->db->where('o.store_id', $store_id);

    if ($role_id != 1 && $role_id != 2) {
        // Non-admin → only their approved orders and assigned tables
        $this->db->join(
            'store_table_assign sta',
            'sta.table_id = o.table_id AND sta.user_id = ' . (int)$user_id,
            'inner'
        );
        $this->db->where('o.approved_by', $user_id);
    }

    $this->db->order_by('o.date', 'DESC');
    $orders = $this->db->get()->result_array();

    foreach ($orders as &$order) {
        $order['table_name'] = $this->get_table_name($order['table_id']);
        $order['approved_by_name'] = $this->get_user_name($order['approved_by']);
    }

    return $orders;
}


        public function getReadyOrdersKitchen($store_id, $role_id, $user_id) {
            $this->db->where('order_status', 3);
            $this->db->where('is_paid', 0);
            $this->db->where('store_id', $store_id);
            $this->db->order_by('date', 'DESC');

            $orders = $this->db->get('order')->result_array();

            foreach ($orders as &$order) {
                $order['table_name'] = $this->get_table_name($order['table_id']);
                $order['approved_by_name'] = $this->get_user_name($order['approved_by']);
            }

            return $orders;
        }

        public function getReadyOrdersUserAssigned($store_id,$user_id){
            $this->db->where('order_status', 3);
            $this->db->where('is_paid', 0);
            $this->db->where('store_id', $store_id);
            $this->db->where('approved_by', $user_id);
            $this->db->order_by('date', 'DESC');
            $this->db->order_by('orderno', 'DESC');
            return $this->db->get('order')->result_array();
        }


        public function get_user_name($user_id)
        {
            $this->db->select('Name');
            $this->db->where('userid', $user_id);
            $query = $this->db->get('users')->row_array();
            return $query ? $query['Name'] : '';
        }

        public function getDeliveredOrders($store_id){
            $this->db->where('order_status', 5);
            $this->db->where('store_id', $store_id);
            $this->db->order_by('date', 'DESC');
            $this->db->order_by('orderno', 'DESC');
            $orders = $this->db->get('order')->result_array();
            // Loop through orders and add table name with its ID
            foreach ($orders as &$order) {
                $order['table_name'] = $this->get_table_name($order['table_id']);
                $order['approved_by_name'] = $this->get_user_name($order['approved_by']);
            }
            return $orders;
        }
        public function getDeliveredOrdersBySupplier($store_id,$user_id){
            $this->db->where('order_status', 5);
            $this->db->where('store_id', $store_id);
            $this->db->where('approved_by', $user_id);
            $this->db->order_by('date', 'DESC');
            $this->db->order_by('orderno', 'DESC');
            $orders = $this->db->get('order')->result_array();
            // Loop through orders and add table name with its ID
            foreach ($orders as &$order) {
                $order['table_name'] = $this->get_table_name($order['table_id']);
                $order['approved_by_name'] = $this->get_user_name($order['approved_by']);
            }
            return $orders;
        }
        public function getDeliveredOrdersByUser($store_id){
            $this->db->where('order_status', 5);
            $this->db->where('store_id', $store_id);
            $this->db->order_by('date', 'DESC');
            $this->db->order_by('orderno', 'DESC');
            $orders = $this->db->get('order')->result_array();
            // Loop through orders and add table name with its ID
            foreach ($orders as &$order) {
                $order['table_name'] = $this->get_table_name($order['table_id']);
                $order['approved_by_name'] = $this->get_user_name($order['approved_by']);
            }
            return $orders;
        }

        public function CheckOrderPaid($store_id,$order_id){
            $this->db->set('is_paid', 1);//changed to paid
            $this->db->set('order_status', 5);//changed to delivered
            $this->db->set('delivered_time',date('h:i A'));
            $this->db->set('modified_by', 1);
            $this->db->set('modified_date', date('Y-m-d h:i:s'));
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order');

            $this->db->set('is_paid', 1);
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order_items');
        }

        public function accept_order($store_id,$order_id){
            $this->db->set('order_status', 2);//changed to delivered
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order');
        }

        public function out_for_delivery_order($store_id,$order_id){
            $this->db->set('order_status', 4);//changed to delivered
            $this->db->set('out_for_delivery_time',date('h:i A'));
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order');
        }

        public function ready_order($store_id,$order_id){
            $this->db->set('order_status', 3);//changed to ready
            $this->db->where('store_id', $store_id);
            $this->db->where('orderno', $order_id);
            $this->db->update('order');
        }

        public function getPickupOrderDetails($orderId){
            $this->db->select('*');
            $this->db->from('order_items');
            $this->db->where('orderno', $orderId);
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $result = $query->result_array();
            return $result;
        }

        public function SaveReciepe($data) {
            $this->db->insert('cookings', $data);
            return $this->db->insert_id();
        }

        public function deleteOrderItem($orderItemId,$store_id) {
            // Retrieve the order number associated with the item
            $this->db->select('orderno');
            $this->db->from('order_items');
            $this->db->where('id', $orderItemId);
            $query = $this->db->get();
            $result = $query->row();

            if($result)
            {
                $orderNumber = $result->orderno;

                $this->db->where('id', $orderItemId);
                $this->db->delete('order_items');

                // Check if there are any remaining items for this order
                $this->db->where('orderno', $orderNumber);
                $remainingItems = $this->db->count_all_results('order_items');

                // If no items remain, delete the order
                if ($remainingItems == 0) {
                    $this->db->where('orderno', $orderNumber);
                    $this->db->delete('order');
                }

                $this->db->select('sum(total_amount) as total_amount, sum(tax_amount) as tax_amount');
                $this->db->from('order_items');
                $this->db->where('store_id',$store_id);
                $this->db->where('orderno', $orderNumber);
                $query = $this->db->get();
                $result = $query->result_array();
                //print_r($result);exit;

                $total_amount = $result[0]['total_amount'];
                $tax_amount = $result[0]['tax_amount'];
                $this->db->set('total_amount', $total_amount);
                $this->db->set('tax_amount', $tax_amount);
                $this->db->where('store_id', $store_id);
                $this->db->where('orderno', $orderNumber);
                $this->db->update('order');
            }
            return true;
        }

        public function deleteOrderItemStockRemove($store_id,$orderItemId,$orderstatus,$product_id) {
            // Retrieve the order number associated with the item
            $this->db->select('orderno');
            $this->db->from('order_items');
            $this->db->where('id', $orderItemId);
            $query = $this->db->get();
            $result = $query->row();

            if($result)
            {
                $orderNumber = $result->orderno;

                $this->db->where('id', $orderItemId);
                $this->db->delete('order_items');

                // Check if there are any remaining items for this order
                $this->db->where('orderno', $orderNumber);
                $remainingItems = $this->db->count_all_results('order_items');

                // If no items remain, delete the order
                if ($remainingItems == 0) {
                    $this->db->where('orderno', $orderNumber);
                    $this->db->delete('order');
                }

                $this->db->select('sum(total_amount) as total_amount, sum(tax_amount) as tax_amount');
                $this->db->from('order_items');
                $this->db->where('store_id', 41);
                $this->db->where('orderno', $orderNumber);
                $query = $this->db->get();
                $result = $query->result_array();
                //print_r($result);exit;

                $total_amount = $result[0]['total_amount'];
                $tax_amount = $result[0]['tax_amount'];
                $this->db->set('total_amount', $total_amount);
                $this->db->set('tax_amount', $tax_amount);
                $this->db->where('store_id', 41);
                $this->db->where('orderno', $orderNumber);
                $this->db->update('order');
            }
            if($orderstatus==1){
                $this->db->insert('store_stock', array(
                    'ttype' => 'SK',
                    'store_id' => $store_id,
                    'tr_date' => date('Y-m-d'),
                    'order_id' => 0,
                    'product_id' => $product_id,
                    'is_combo' => 0, // This is not a combo item
                    'pu_qty' => 1,
                    'sl_qty' => 0,
                    'created_by' => 1,
                    'created_date' => date('Y-m-d H:i:s'),
                    'modified_by' => 1,
                    'modified_date' => date('Y-m-d H:i:s')
                ));
            }
            return true;
        }



        public function deleteOrderItemWithUpdateRemark($orderId,$delete_reason,$is_delete){
            $this->db->set('delete_remark', $delete_reason);
            $this->db->set('is_delete', $is_delete);
            $this->db->where('id', $orderId); //Primary key order_items table
            $this->db->update('order_items');
            return true;
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


        public function getActiveTablesByStoreId($store_id,$user_id,$role_id) {

        if($role_id == 1 || $role_id == 2){

            $this->db->select('*');
            $this->db->from('store_table');
            $this->db->where('store_id',$store_id );
            $this->db->where('is_reserved', 0 );
            $this->db->where('is_active', 1 );
            $this->db->order_by("table_id", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            return $query->result_array();
        }

        else{
            $this->db->select('store_table.table_id, store_table.table_name, store_table.store_table_name, store_table_assign.user_id');
            $this->db->from('store_table');
            $this->db->join('store_table_assign', 'store_table.table_id = store_table_assign.table_id', 'left');
            $this->db->where('store_table_assign.table_id !=', 0);
            $this->db->where('store_table_assign.user_id', $user_id);
            $query = $this->db->get();
            return $query->result_array();


        }
    }

        public function setTableReserved($tableId,$isReserved){
            $this->db->set('is_reserved', $isReserved);
            $this->db->where('table_id', $tableId);
            $this->db->where('store_id', $this->session->userdata('logged_in_store_id'));
            $this->db->update('store_table');
        }

        public function AddHoliday($data) {
            $this->db->insert('holidays', $data);
            return $this->db->insert_id();
        }
        public function GetHolidaysByStoreId($store_id) {
            $this->db->select('*');
            $this->db->from('holidays');
            $this->db->where('store_id', $store_id);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }

        public function Delete_Holiday($id) {
            $this->db->where('id', $id);
            return $this->db->delete('holidays');
        }


        public function getSupplierSalesReportByStoreId($store_id, $date) {
            $user_id = $this->session->userdata('user_id'); // Loged in user id
            $this->db->select('DATE(date) as sale_date,
            SUM(CASE WHEN order_type = "D" THEN 1 ELSE 0 END) as dinein_count,
            SUM(CASE WHEN order_type = "DL" THEN 1 ELSE 0 END) as delivery_count,
            SUM(CASE WHEN order_type = "PK" THEN 1 ELSE 0 END) as pickup_count,
             SUM(CASE WHEN order_type = "rom" THEN 1 ELSE 0 END) as rom_count,
            SUM(CASE WHEN order_type = "D" THEN total_amount ELSE 0 END) as dinein_total_amount,
            SUM(CASE WHEN order_type = "DL" THEN total_amount ELSE 0 END) as delivery_total_amount,
            SUM(CASE WHEN order_type = "PK" THEN total_amount ELSE 0 END) as pickup_total_amount,
            SUM(CASE WHEN order_type = "rom" THEN total_amount ELSE 0 END) as rom_total_amount,
            COUNT(*) as total_sales,
            SUM(total_amount) as total_amount'); // Total amount for all orders
    $this->db->from('order');
    $this->db->where('store_id', $store_id); // Filter by store ID
    $this->db->where('DATE(date)', $date);  // Filter by specific date
    $this->db->where('is_paid', 1);
    $this->db->where('approved_by', $user_id); //Supplier id
    $this->db->group_by('DATE(date)');
    $this->db->order_by('sale_date', 'DESC');

    $query = $this->db->get();

            //echo $this->db->last_query();exit;
            return $query->result_array();
        }

        public function getDeliveryReportByStoreId($store_id, $date) {
            $this->db->select("
                orderno,
                customer_name,
                contact_number,
                location,
                payment_mode,
                total_amount,
                CASE
                    WHEN order_status = 0 THEN 'Pending'
                    WHEN order_status = 1 THEN 'Cooking'
                    WHEN order_status = 2 THEN 'Ready'
                    WHEN order_status = 3 THEN 'Out for Delivery'
                    WHEN order_status = 4 THEN 'Delivered'
                    ELSE 'Unknown'
                END AS order_status,
                out_for_delivery_time,
                delivered_time,
                delivery_boy
            ");
            $this->db->from('order');
            $this->db->where('store_id', $store_id);
            $this->db->where('date', $date);
            $this->db->where('order_type', 'DL');
            $query = $this->db->get();
            return $query->result_array();
        }

    public function getUserReportByStoreId($store_id , $date, $role_id, $user_id){
         $this->db->select('uli.*, users.Name, users.userroleid');
    $this->db->from('user_login_logout as uli');
    $this->db->join('users', 'users.userid = uli.user_id');

    $this->db->where('uli.store_id', $store_id);
    $this->db->where('uli.date', $date);

    // If NOT admin or manager, limit to only own data
    if ($role_id != 1 && $role_id != 2) {
        $this->db->where('uli.user_id', $user_id);
    }

    $query = $this->db->get();
    return $query->result_array();
    }

    public function getSupplierUserReportByStoreId($store_id , $date){
        $user_id = $this->session->userdata('loginid'); // Loged in user id
        $this->db->select('uli.*, users.Name'); // Select user login/logout fields and user name
        $this->db->from('user_login_logout as uli'); // Alias for user_login_logout table
        $this->db->join('users', 'users.userid = uli.user_id'); // Use alias 'uli'
        $this->db->where('uli.store_id', $store_id);
        $this->db->where('uli.date', $date);
        $this->db->where('uli.user_id', $user_id);
        // Execute the query
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDeliveryBoysByStoreID($store_id){
        $this->db->select('userid,Name');
        $this->db->from('users');
        $this->db->where('store_id', $store_id);
        $this->db->where('userroleid', 4);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getStoreTimings($store_id) {
        $this->db->select('store_id, store_opening_time, store_closing_time,today_opening_time,today_closing_time');
        $this->db->from('store');
        $this->db->where('store_id', $store_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    public function EditStoreTime($data,$store_id) {
        $this->db->where('store_id', $store_id);
        $this->db->update('store', $data);
        return $this->db->affected_rows() > 0;
    }
    public function AddUser($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
    public function EditUserList($data,$user_id) {
        $this->db->where('userid', $user_id);
        $this->db->update('users', $data);
        return $this->db->affected_rows() > 0;
    }
    public function DeleteUser($id){
        $this->db->where('userid ', $id);
        return $this->db->delete('users');
    }
    public function ChangePassword($data,$user_id) {
        $this->db->where('userid', $user_id);
        $this->db->update('users', $data);
        return $this->db->affected_rows() > 0;
    }
    public function SaveAvialableTime($store_product_id,$store_id,$data) {
        $this->db->where('store_product_id', $store_product_id);
            $this->db->where('store_id', $store_id);
            $this->db->update('store_wise_product_assign', $data);
            return $this->db->affected_rows() > 0;

    }


    public function AddWhatsapp($data) {
        $this->db->insert('whatsapp_no', $data);
        return $this->db->insert_id();
    }

    //MARK:  check name and phone no already exist in adding user

    public function checkUserExists($name, $phone, $store_id) {
    $this->db->where('Name', $name);
    $this->db->where('UserPhoneNumber', $phone);
    $this->db->where('store_id', $store_id);
    $query = $this->db->get('users'); // replace 'users' with your actual table name
    return $query->num_rows() > 0;
}


public function getsuppliers($store_id,$tableid)
{
    $this->db->select('sta.user_id, u.userid, u.Name');
    $this->db->from('store_table_assign sta');
    $this->db->join('users u', 'u.userid = sta.user_id');
    $this->db->where('sta.store_id', $store_id);
    $this->db->where('sta.table_id', $tableid);
    $query = $this->db->get();
    //echo $this->db->last_query();exit;
    return $query->result_array();
}
public function getsuppliersByType($store_id,$type)
{
    $this->db->select('sta.user_id, u.userid, u.Name');
    $this->db->from('store_table_assign sta');
    $this->db->join('users u', 'u.userid = sta.user_id');
    $this->db->where('sta.store_id', $store_id);
    if($type == 'PK'){
        $this->db->where('sta.is_pickup', 1);
    }
    if($type == 'DL'){
        $this->db->where('sta.is_delivery', 1);
    }
    $query = $this->db->get();
    return $query->result_array();
}


}



?>