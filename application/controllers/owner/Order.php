<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	public function __construct()
	{
		parent::__construct();
		//require('Common.php');
		$this->load->model('admin/Productmodel');
		$this->load->model('admin/Storemodel');
		$this->load->model('owner/Ordermodel');
		$this->load->model('owner/Settingsmodel');
		$this->load->model('owner/Stockmodel');
		$this->load->model('website/Homemodel');
		$this->load->model('admin/Roommodel');
		$this->load->model('admin/Tablemodel');
		if (!$this->session->userdata('login_status')) {
			redirect('admin/login');
		}
	}

	public function index()
	{
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;

        $logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('role_id'); // Role id of logged in user
		$user_id = $this->session->userdata('user_id'); // Loged in user id
		$loginName = $this->session->userdata('user_name');
		$data['name'] = $loginName;

		$data['display_name'] = $this->session->userdata('user_name');
        $role_id = $this->session->userdata('role_id');

			switch ($role_id) {
				case 1:
					$data['role'] = "Admin";
					break;

				case 2:
					$data['role'] = "Shop Owner";
					break;

				case 5:
					$data['role'] = "Supplier";
					break;
				case 5:
					$data['role'] = "Kitchen";
					break;

				default:
					$data['role'] = "User";
					break;
			}

        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;
		$data['tables']=$this->Tablemodel->getTablesByStoreId($logged_in_store_id);
		$data['rooms']=$this->Roommodel->getRoomTableIdsWithOrders($logged_in_store_id);
		$data['storeDetails']=$this->Storemodel->get($logged_in_store_id);
		$data['ready_orders']=$this->Ordermodel->getReadyOrders($logged_in_store_id,$role_id,$user_id);
		$data['delivered_orders']=$this->Ordermodel->getDeliveredOrders($logged_in_store_id);
		$data['pending_delivery_cooking']=$this->Tablemodel->pending_delivery_cooking($logged_in_store_id);
		$data['pending_delivery_ready']=$this->Tablemodel->pending_delivery_ready($logged_in_store_id);
		$data['pending_pickup_cooking']=$this->Tablemodel->pending_pickup_cooking($logged_in_store_id);
		$data['pending_pickup_ready']=$this->Tablemodel->pending_pickup_ready($logged_in_store_id);
		$data['comp_pickup_count']=$this->Tablemodel->comp_pickup_count($logged_in_store_id);
		$data['comp_delivery_count']=$this->Tablemodel->comp_delivery_count($logged_in_store_id);
		$data['pending_pickup_count']=$this->Tablemodel->pending_pickup_count($logged_in_store_id);
		$data['pending_delivery_count']=$this->Tablemodel->pending_delivery_count($logged_in_store_id);
		$this->load->view('owner/includes/header',$data);
		$this->load->view('owner/includes/owner-dashboard-menu',$data);
		$this->load->view('owner/orderdashboard',$data);
		$this->load->view('owner/includes/footer');
	}

	//MARK:Pending Table Orders
	public function pending_table_orders($tableid)
	{
		$logged_in_store_id = $this->session->userdata('logged_in_store_id');
		$data['role_id'] = $this->session->userdata('roleid'); // Role id of logged in user
		$data['user_id'] = $this->session->userdata('loginid'); // Logged in user id
		$data['suppliers'] = $this->Ordermodel->getsuppliers($logged_in_store_id, $tableid);
		$data['orders'] = $this->Ordermodel->getPendingOrdersByTableId($logged_in_store_id, $tableid);
		$data['kot_enable'] = $this->Ordermodel->getKotEnabledStatus($logged_in_store_id);
		$this->load->view('owner/order/pending_orders_by_table',$data);
	}

	//MARK:Approve Table Order
	public function approve_table_order()
	{
		$order_id = $this->input->post('orderId');
		$store_id = $this->session->userdata('logged_in_store_id');
		$selectedsupplier = $this->input->post('selectedsupplier');

	}
	public function get_Pending_Orders_Count()
	{
        $user_id = $this->session->userdata('user_id'); // Loged in user id
		$role_id = $this->session->userdata('role_id'); // Role id
		$logged_in_store_id = $this->session->userdata('logged_in_store_id');

		$pending_order_count_for_alert = $this->Ordermodel->get_pending_orders_count_for_alert($this->session->userdata('logged_in_store_id'),$role_id,$user_id);
		$ready_order_count_for_alert = $this->Ordermodel->get_ready_orders_count_for_alert($this->session->userdata('logged_in_store_id'),$role_id,$user_id);

		$ready_orders_db=$this->Ordermodel->getReadyOrders($this->session->userdata('logged_in_store_id'),$role_id,$user_id);
		$delivered_orders_db=$this->Ordermodel->getDeliveredOrdersByUser($this->session->userdata('logged_in_store_id'),$role_id,$user_id);
        $dining_count = $this->Ordermodel->get_Pending_Orders_Count_db('D',$logged_in_store_id,$role_id,$user_id);

        $pickup_count = $this->Ordermodel->get_Pending_Orders_Count_db('PK',$logged_in_store_id,$role_id,$user_id);
        $delivery_count = $this->Ordermodel->get_Pending_Orders_Count_db('DL',$logged_in_store_id,$role_id,$user_id);
		$room_count = $this->Ordermodel->get_Pending_room_Orders_Count_db('rom',$logged_in_store_id,$role_id,$user_id);

		$ready_order_count = $this->Ordermodel->get_Ready_Orders_Count_user_assigned($logged_in_store_id,$role_id,$user_id);
        $pending_order_table_ids = $this->Ordermodel->get_pending_order_table_ids();
        $pending_reorder_table_ids = $this->Ordermodel->get_pending_reorder_table_ids();
		$pending_order_room_ids = $this->Ordermodel->get_pending_order_rooms();

        $data = array(
			'pending_order_count' => $pending_order_count_for_alert,
			'ready_order_count' => $ready_order_count_for_alert,
            'ready-orders-db' => $ready_orders_db,
			'delivered-orders-db' => $delivered_orders_db,
            'dining'   => $dining_count,
            'pickup'   => $pickup_count,
            'delivery' => $delivery_count,
			'ready_order' => $ready_order_count,
			'rom' => $room_count,
            'table_ids' => $pending_order_table_ids,
            'reorder_table_ids' => $pending_reorder_table_ids,
			'room_ids' => $pending_order_room_ids
        );

        echo json_encode($data);
    }
// 	public function get_Pending_Orders_Count()
// 	{
//         $user_id = $this->session->userdata('user_id'); // Loged in user id
// 		$role_id = $this->session->userdata('role_id'); // Role id
// 		$logged_in_store_id = $this->session->userdata('logged_in_store_id');

// 		$ready_orders_db=$this->Ordermodel->getReadyOrders($this->session->userdata('logged_in_store_id'),$role_id,$user_id);
// 		$delivered_orders_db=$this->Ordermodel->getDeliveredOrdersByUser($this->session->userdata('logged_in_store_id'),$role_id,$user_id);
//         $dining_count = $this->Ordermodel->get_Pending_Orders_Count_db('D',$logged_in_store_id,$role_id,$user_id);
// 		//echo "here";exit;
//         $pickup_count = $this->Ordermodel->get_Pending_Orders_Count_db('PK',$logged_in_store_id,$role_id,$user_id);
//         $delivery_count = $this->Ordermodel->get_Pending_Orders_Count_db('DL',$logged_in_store_id,$role_id,$user_id);
// 		$room_count = $this->Ordermodel->get_Pending_room_Orders_Count_db('rom',$logged_in_store_id,$role_id,$user_id);

// 		$ready_order_count = $this->Ordermodel->get_Ready_Orders_Count_user_assigned($logged_in_store_id,$role_id,$user_id);
//         $pending_order_table_ids = $this->Ordermodel->get_pending_order_table_ids();
//         $pending_reorder_table_ids = $this->Ordermodel->get_pending_reorder_table_ids();

//         $data = array(
//             'ready-orders-db' => $ready_orders_db,
// 			'delivered-orders-db' => $delivered_orders_db,
//             'dining'   => $dining_count,
//             'pickup'   => $pickup_count,
//             'delivery' => $delivery_count,
// 			'ready_order' => $ready_order_count,
// 			'rom' => $room_count,
//             'table_ids' => $pending_order_table_ids,
//             'reorder_table_ids' => $pending_reorder_table_ids
//         );

//         echo json_encode($data);
//     }
	//MARK:Ready Order Details
	public function ready_order_details($orderId)
	{
		$data['orders']=$this->Ordermodel->order_details($this->session->userdata('logged_in_store_id') , $orderId);
		$data['kot_enable'] = $this->Ordermodel->getKotEnabledStatus($this->session->userdata('logged_in_store_id'));
		$this->load->view('owner/order/ready_order_details',$data);
	}
	//MARK:Delivered Order Details
	public function delivered_order_details($orderId)
	{
		$data['orders']=$this->Ordermodel->order_details($this->session->userdata('logged_in_store_id') , $orderId);
		$data['kot_enable'] = $this->Ordermodel->getKotEnabledStatus($this->session->userdata('logged_in_store_id'));
		$order_total = $this->Ordermodel->get_order_total($orderId, $this->session->userdata('logged_in_store_id'));
		$tax_percent = 5; // 5%
		$tax_amount  = ($order_total * $tax_percent) / 100;
		$data['order_total'] = $order_total;
		$data['tax_amount'] = $tax_amount;
		$data['order_total_paid'] = $order_total + $tax_amount;
		$this->Ordermodel->update_order_total_tax_amount($orderId,$this->session->userdata('logged_in_store_id'),$data['order_total'],$data['tax_amount'],$data['order_total_paid']);
		$this->load->view('owner/order/delivered_order_details',$data);
	}
	public function update_order_status_and_delivery_time(){
		$orderId = $this->input->post('orderId');
		$status = $this->input->post('status');
		$this->Ordermodel->update_order_status_and_delivery_time($orderId,$status);
		echo json_encode(['status' => $status,'orderId' => $orderId]);
	}
	public function pay_order(){
		$order_id = $this->input->post('orderId');
		$store_id = $this->session->userdata('logged_in_store_id');
		$this->Ordermodel->pay_order($store_id,$order_id);
		echo json_encode(['status' => 'success']);
	}
	public function print_order(){
		$orderno = $this->input->post('orderId');
		$data['order_no'] = $orderno;
		$data['storeDet']=$this->Storemodel->get($this->session->userdata('logged_in_store_id'));
		$data['order']=$this->Ordermodel->getOrderSummary($orderno);//print_r($data['order']);exit;
		$data['order_items']=$this->Ordermodel->getOrderItems($orderno);
		$data['order_type'] = $data['order_items'][0]['order_type'];
		$data['table_name'] = $this->Ordermodel->get_table_name($data['order_items'][0]['table_id']);
		echo $this->load->view('owner/order/print_order',$data,TRUE);
	}
	public function delete_order() {
		$orderId = $this->input->post('orderId');
		$this->Ordermodel->delete_order($orderId);
		echo json_encode(['status' => 'success']);
	}
	public function current_stock(){
		$date = date('Y-m-d');
		$product_id = $this->input->post('product_id');
		$store_id = $this->session->userdata('logged_in_store_id');
		$availableStock = $this->Ordermodel->getCurrentStock($product_id, $date, $store_id);
		echo $availableStock;
	}
	public function check_stock_availability_when_increment()
	{
		$date = date('Y-m-d');
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$order_number = $this->input->post('order_number');
		$order_item_id = $this->input->post('order_item_id');
		$order_item_rate = $this->input->post('order_item_rate');
		$order_item_tax_amount = $this->input->post('order_item_tax_amount');
		$variant_total = $this->input->post('variant_total');
		$store_id = $this->session->userdata('logged_in_store_id');
		$availableStock = $this->Ordermodel->getCurrentStock($product_id, $date, $store_id);
		$is_customizable = $this->Ordermodel->Check_product_is_customizable($product_id,$store_id);
		//NORMAL PRODUCT
		if($is_customizable == 0)
		{
			if ($availableStock >= $quantity)
			{
				$this->update_order_item($order_item_id,$product_id,$quantity,$order_number,$store_id,$order_item_rate,$order_item_tax_amount);
				$order_total = $this->Ordermodel->get_order_total($order_number,$store_id);
				echo json_encode(['status' => 'success', 'variant_total' => $variant_total,'stock' => $availableStock,'order_total' => $order_total]);
        	}
			else
			{
				echo json_encode(['status' => 'error','message' => 'Unsufficient Stock']);
        	}
		}
		//CUSTOMIZABLE PRODUCT
		if($is_customizable == 1)
		{
			if ($availableStock >= $variant_total)
			{
				$this->update_order_item($order_item_id,$product_id,$quantity,$order_number,$store_id,$order_item_rate,$order_item_tax_amount);
				$order_total = $this->Ordermodel->get_order_total($order_number,$store_id);
				echo json_encode(['status' => 'success', 'variant_total' => $variant_total,'stock' => $availableStock,'order_total' => $order_total]);
        	}
			else
			{
				echo json_encode(['status' => 'error', 'variant_total' => $variant_total,'stock' => $availableStock,'message' => 'Unsufficient Stock']);
        	}
		}
	}

	public function check_stock_availability_when_decrement()
	{
		$date = date('Y-m-d');
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$order_number = $this->input->post('order_number');
		$order_item_id = $this->input->post('order_item_id');
		$order_item_rate = $this->input->post('order_item_rate');
		$order_item_tax_amount = $this->input->post('order_item_tax_amount');
		$variant_total = $this->input->post('variant_total');
		$store_id = $this->session->userdata('logged_in_store_id');
		$availableStock = $this->Ordermodel->getCurrentStock($product_id, $date, $store_id);
		$is_customizable = $this->Ordermodel->Check_product_is_customizable($product_id,$store_id);
		//NORMAL PRODUCT
		if($is_customizable == 0)
		{
				if ($quantity == 0)
				{
        			$this->Ordermodel->delete_order_item($order_item_id, $store_id);
					$order_total = $this->Ordermodel->get_order_total($order_number,$store_id);
					echo json_encode(['status' => 'deleted', 'variant_total' => $variant_total,'stock' => $availableStock,'order_total' => $order_total]);
				}
				else
				{
					$this->update_order_item($order_item_id,$product_id,$quantity,$order_number,$store_id,$order_item_rate,$order_item_tax_amount);
					$order_total = $this->Ordermodel->get_order_total($order_number,$store_id);
					echo json_encode(['status' => 'success', 'variant_total' => $variant_total,'stock' => $availableStock,'order_total' => $order_total]);
				}
		}
		//CUSTOMIZABLE PRODUCT
		if($is_customizable == 1)
		{
				if ($quantity == 0)
				{
        			$this->Ordermodel->delete_order_item($order_item_id, $store_id);
					$order_total = $this->Ordermodel->get_order_total($order_number,$store_id);
					echo json_encode(['status' => 'deleted', 'variant_total' => $variant_total,'stock' => $availableStock,'order_total' => $order_total]);
				}
				else
				{
					$this->update_order_item($order_item_id,$product_id,$quantity,$order_number,$store_id,$order_item_rate,$order_item_tax_amount);
					$order_total = $this->Ordermodel->get_order_total($order_number,$store_id);
					echo json_encode(['status' => 'success', 'variant_total' => $variant_total,'stock' => $availableStock,'order_total' => $order_total]);
				}
		}
	}

	//MARK:Update Order Item
	public function update_order_item($order_item_id,$product_id,$quantity,$order_number,$store_id,$order_item_rate,$order_item_tax_amount)
	{
		$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
		$rate = $productDetails[0]['rate'];
		$tax_amount = $quantity * $rate * $productDetails[0]['tax'] / 100;
		$this->Ordermodel->update_order_item($store_id,$order_number,$order_item_id,$product_id,$quantity,$order_item_rate,$order_item_tax_amount);
	}
	//Sales Report ID
	public function getSalesReportByStoreId() {
		$store_id = $this->input->post('store_id');
		$date = $this->input->post('date');
		$salesReports = $this->Ordermodel->getSalesReportByStoreId($store_id , $date);
		//print_r($salesReports);exit;
		// Initialize the table structure
		$table = '';
		$table .= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
		$table .= '<thead>';
		$table .= '<tr>';
		$table .= '<th>Date</th>';
		$table .= '<th>Dine In</th>';
		$table .= '<th>Pickup</th>';
		$table .= '<th>Delivery</th>';
		$table .= '<th>Room</th>';
		$table .= '</tr>';
		$table .= '</thead>';
		$table .= '<tbody>';

		// Assume $salesReports is an array containing multiple rows of sales report data
		if (!empty($salesReports)) {
			foreach ($salesReports as $salesReport) {
				$table .= '<tr>';
				$table .= '<td>' . htmlspecialchars($salesReport['sale_date']) . '</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['dinein_count']) . ' (' . htmlspecialchars($salesReport['dinein_total_amount']) . ')</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['pickup_count']) . ' (' . htmlspecialchars($salesReport['pickup_total_amount']) . ')</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['delivery_count']) . ' (' . htmlspecialchars($salesReport['delivery_total_amount']) . ')</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['rom_count']) . ' (' . htmlspecialchars($salesReport['rom_total_amount']) . ')</td>';
				$table .= '</tr>';
			}
		} else {
			// Handle the case where there's no data
			$table .= '<tr>';
			$table .= '<td colspan="4" class="text-center">No sales data available.</td>';
			$table .= '</tr>';
		}

		// Close the table structure
		$table .= '</tbody>';
		$table .= '</table>';

		// Echo the table
		echo $table;
	}

//MARK:NEW ORDER
public function new_order(){
		$table_id = $this->input->post('table_id');
		$order_type = $this->input->post('order_type');
		$order_no = $this->Productmodel->getOrderNo();
		$day = date("d");
		$month = date("m");
		$year = date("y");
		$order_number = $order_no.$day.$month.$year;
		$data['order_number'] = $order_number;
		$data['table_id'] = $table_id;
		$data['order_type'] = $order_type;
		$data['products']=$this->Productmodel->storeAssignedProducts();

		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;

		 $logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('role_id'); // Role id of logged in user
		$user_id = $this->session->userdata('user_id'); // Loged in user id
		$loginName = $this->session->userdata('user_name');
		$data['name'] = $loginName;

		$data['display_name'] = $this->session->userdata('user_name');
        $role_id = $this->session->userdata('role_id');

			switch ($role_id) {
				case 1:
					$data['role'] = "Admin";
					break;

				case 2:
					$data['role'] = "Shop Owner";
					break;

				case 5:
					$data['role'] = "Supplier";
					break;
				case 5:
					$data['role'] = "Kitchen";
					break;

				default:
					$data['role'] = "User";
					break;
			}

        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;
		//echo "here";exit;
		$this->load->view('owner/includes/header',$data);
		$this->load->view('owner/includes/owner-dashboard-menu',$data);
		$this->load->view('owner/order/newOrder',$data);
		$this->load->view('owner/includes/footer');
	}
	public function getVariantValue()
	{
		$variant = $this->input->post('variant');
		$product_id = $this->input->post('product_id');
		$store_id = $this->session->userdata('logged_in_store_id');
		if($variant == 'Quarter')
		{
			$variant_id = 4;
		}
		if($variant == 'Half')
		{
			$variant_id = 3;
		}
		if($variant == 'Full')
		{
			$variant_id = 2;
		}
		$this->db->select('variant_id,variant_value,rate');
		$this->db->from('store_variants');
		$this->db->where('store_id', $store_id);
		$this->db->where('store_product_id', $product_id);
		$this->db->where('variant_id', $variant_id);
		$query = $this->db->get();
		$row = $query->row();

		if ($row)
		{
			$variant_value = $row->variant_value;
		} else
		{
			$variant_value = 0;
		}
		echo json_encode(['variant_id' => $row->variant_id,'variant_value' => $variant_value,'rate' => $row->rate ]);
	}

	//MARK:New Order Stock checking
	public function check_stock_availability_when_new_order_add()
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$item_quantity = $this->input->post('item_quantity');
		$order_number = $this->input->post('order_number');
		$variant_total = $this->input->post('variant_total');
		$store_id = $this->session->userdata('logged_in_store_id');
		$availableStock = $this->Ordermodel->getCurrentStock($product_id, $date, $store_id);
		$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
		if ($availableStock >= $quantity)
		{
			$rate = $this->input->post('order_item_rate');
			$amount = $quantity * $rate;
			$tax_percentage = 5;     // Fixed tax 5%
			$tax_amount = ($amount * $tax_percentage) / 100;
			$total_amount = $amount + $tax_amount;
				$orderItems = [
						'orderno' => $order_number,
						'date' => date('Y-m-d'),
						'store_id' => $store_id,
						'product_id' => $product_id,
						'quantity' => $item_quantity,
						'vat_id' => $productDetails[0]['vat_id'],
						'rate' => $rate,
						'amount' => $amount,
						'tax' => 5,
						'tax_amount' => $tax_amount,
						'total_amount' => $total_amount,
						'item_remarks' => null,
						'variant_id' => $this->input->post('variant_id') ?? null,
						'variant_value' => $this->input->post('variant_value') ?? 0,
						'category_id' => $productDetails[0]['category_id'], // optional timestamp
						'is_addon' => $productDetails[0]['is_addon'],
						'is_customisable' => $productDetails[0]['is_customizable'],
						'table_id' => $this->input->post('table_id'),
						'order_type' => $this->input->post('order_type'),
						'is_paid' => 8,
						'is_reorder' => 0
					];

					$this->db->insert('order_items', $orderItems);

					$orderExists = $this->Ordermodel->isOrderExists($order_number);
					if($orderExists)
					{
								$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_number);
								$order_data = [
									'amount' => $updatedTotalAmt[0]['total_rate'],
									'tax_amount' => $updatedTotalAmt[0]['total_tax'],
									'total_amount' => $updatedTotalAmt[0]['total_amount']
								];
									$this->db->where('orderno', $order_number);
									$this->db->update('order', $order_data);
					}
					else
					{
						$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_number);
						$order_data = [
							'orderno' => $order_number,
							'order_token' => $this->Productmodel->getOrderNo(),
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'amount' => $updateTotalAmountFromItems[0]['total_rate'],
							'tax' => $productDetails[0]['tax'],
							'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
							'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
							'is_paid'   => 8,
							'table_id' => $this->input->post('table_id'),
							'order_type' => $this->input->post('order_type'),
							'order_status' => 8, // Not conform order before stock checking
							'customer_name	' => '',
							'contact_number' => '',
							'location' => '',
							'modified_by'=>0,
							'modified_date'=> date('Y-m-d H:i:s')
						];
						$this->db->insert('order', $order_data);
					}
				echo json_encode(['status' => 'success', 'stock' => $availableStock]);
        }
		else
		{
				echo json_encode(['status' => 'error','stock'=> $availableStock ]);
        }
	}

	//MARK:Save New Order
	public function save_new_order()
	{
		$order_number = $this->input->post('order_number');
		$store_id = $this->session->userdata('logged_in_store_id');
		$this->Ordermodel->updateOrderNo();
		$data = array('order_status' => 0 , 'is_paid' => 0);
		$this->Ordermodel->change_order_status($store_id,$order_number,$data);
		echo json_encode(['status' => 'success']);
	}
	//MARK: Return Order
	public function returnOrderItem(){

		$is_return = 0;
		$is_replace = 0;
		$return_quantity = (int) $this->input->post('return_quantity') ?: 0;
		$replace_quantity = (int) $this->input->post('replace_quantity') ?: 0;
		$order_item_id = (int) $this->input->post('return_order_item_id'); //Return order item id (Primary key order items table)
		$return_item_variant_id=$this->input->post('return_item_variant_id');//Variant id !=0 is customizable otherwise normal product(If variant id not exist 0 else variant id )
		$return_reason = $this->input->post('return_reason');
		if ($return_quantity > 0) {
			$is_return = 1;
		}

		if ($replace_quantity > 0) {
			$is_replace = 1;
		}

		if($return_reason == 'other'){
			$return_reason = $this->input->post('return_order_custom_reason');
		}else{
			$return_reason = $return_reason;
		}

		$already_returned = $this->Ordermodel->getReturnedQty($order_item_id);
    	$already_replaced = $this->Ordermodel->getReplacedQty($order_item_id);


		$data = [
			'is_return' => $is_return,
			'is_replace' => $is_replace,
			'return_qty' => $return_quantity + $already_returned,
			'replace_qty' => $replace_quantity + $already_replaced,
			'return_reason' => $return_reason
		];

		$this->Ordermodel->updateOrderItemReturn($order_item_id, $data);
		$productId = $this->input->post('return_order_item_product_id');
        $date = date('Y-m-d');
        $store_id=$this->session->userdata('logged_in_store_id');
		$return_order_id=$this->input->post('return_order_id');
		if($is_replace == 1){
			$this->Ordermodel->InsertReplaceOrderToStock($replace_quantity, $store_id, $productId, $date ,$return_order_id);
		}
		if($is_return == 1){
			$total_return_qty = (int)$return_quantity + (int)$already_returned;
			$return_amount = $total_return_qty * $this->Ordermodel->getItemRate($store_id,$productId , $return_item_variant_id);
			$this->Ordermodel->updateReturnAmount($return_amount, $order_item_id,$store_id);
		}
		echo json_encode(['status' => 'success']);

	}

public function display_all_rooms()
	{
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;

        $logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('role_id'); // Role id of logged in user
		$user_id = $this->session->userdata('user_id'); // Loged in user id
		$loginName = $this->session->userdata('user_name');
		$data['name'] = $loginName;

		$data['display_name'] = $this->session->userdata('user_name');
        $role_id = $this->session->userdata('role_id');

			switch ($role_id) {
				case 1:
					$data['role'] = "Admin";
					break;

				case 2:
					$data['role'] = "Shop Owner";
					break;

				case 5:
					$data['role'] = "Supplier";
					break;
				case 5:
					$data['role'] = "Kitchen";
					break;

				default:
					$data['role'] = "User";
					break;
			}

        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;
		$data['rooms']=$this->Roommodel->getRoomsByStoreId($logged_in_store_id); //print_r($data['rooms']);
		//$data['storeDetails']=$this->Storemodel->get($logged_in_store_id);
		$this->load->view('owner/includes/header',$data);
		$this->load->view('owner/includes/owner-dashboard-menu',$data);
		$this->load->view('owner/all_rooms',$data);
		$this->load->view('owner/includes/footer');
	}

	//MARK:NEW ORDER Item
public function new_order_item(){
		$table_id = 0;
		$order_type = 0;
		$order_number = $this->input->post('order_number');
		$data['order_number'] = $order_number;
		$data['table_id'] = $table_id;
		$data['order_type'] = $order_type;
		$data['products']=$this->Productmodel->storeAssignedProducts();

		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;

		 $logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('role_id'); // Role id of logged in user
		$user_id = $this->session->userdata('user_id'); // Loged in user id
		$loginName = $this->session->userdata('user_name');
		$data['name'] = $loginName;

		$data['display_name'] = $this->session->userdata('user_name');
        $role_id = $this->session->userdata('role_id');

			switch ($role_id) {
				case 1:
					$data['role'] = "Admin";
					break;

				case 2:
					$data['role'] = "Shop Owner";
					break;

				case 5:
					$data['role'] = "Supplier";
					break;
				case 5:
					$data['role'] = "Kitchen";
					break;

				default:
					$data['role'] = "User";
					break;
			}

        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;
		//echo "here";exit;
		$this->load->view('owner/includes/header',$data);
		$this->load->view('owner/includes/owner-dashboard-menu',$data);
		$this->load->view('owner/order/newOrder',$data);
		$this->load->view('owner/includes/footer');
	}

//MARK:Delete Order Item
	public function delete_order_item()
	{
		$order_number = $this->input->post('order_number');
		$order_item_id = $this->input->post('order_item_id');
		$store_id = $this->session->userdata('logged_in_store_id');
		$this->Ordermodel->delete_order_item($order_item_id, $store_id);
		echo json_encode(['status' => 'success']);
	}



































	public function reports(){
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$data['method'] = $method;
		$data['store_id'] = $this->session->userdata('logged_in_store_id');

		$this->load->model('website/Homemodel');
		$store_details = $this->Homemodel->get_store_details_by_store_id($data['store_id']);
        $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_no;
        $data['support_email'] = $support_details->support_email;

		$this->load->view('owner/includes/header',$data);
		$this->load->view('owner/includes/owner-dashboard',$data);
		$this->load->view('owner/order/reports');
		$this->load->view('owner/includes/footer');
	}

	public function salesReport($store_id){
		$data['store_id'] = $store_id;  //In this case type return table id
		$this->load->view('owner/order/sales_report',$data);
	}
	public function supplierSalesReport($store_id){
		$data['store_id'] = $store_id;  //In this case type return table id
		$this->load->view('owner/order/supplier_sales_report',$data);
	}




	public function getSupplierSalesReportByStoreId() {
		$store_id = $this->input->post('store_id');
		$date = $this->input->post('date');
		$salesReports = $this->Ordermodel->getSupplierSalesReportByStoreId($store_id , $date);
		// print_r($salesReports);exit;
		// Initialize the table structure
		$table = '';
		$table .= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
		$table .= '<thead>';
		$table .= '<tr>';
		$table .= '<th>Date</th>';
		$table .= '<th>Dine In</th>';
		$table .= '<th>Pickup</th>';
		$table .= '<th>Delivery</th>';
		$table .= '<th>Room</th>';

		$table .= '</tr>';
		$table .= '</thead>';
		$table .= '<tbody>';

		// Assume $salesReports is an array containing multiple rows of sales report data
		if (!empty($salesReports)) {
			foreach ($salesReports as $salesReport) {
				$table .= '<tr>';
				$table .= '<td>' . htmlspecialchars($salesReport['sale_date']) . '</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['dinein_count']) . ' (' . htmlspecialchars($salesReport['dinein_total_amount']) . ')</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['pickup_count']) . ' (' . htmlspecialchars($salesReport['pickup_total_amount']) . ')</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['delivery_count']) . ' (' . htmlspecialchars($salesReport['delivery_total_amount']) . ')</td>';
				$table .= '<td>' . htmlspecialchars($salesReport['rom_count']) . ' (' . htmlspecialchars($salesReport['rom_total_amount']) . ')</td>';
				$table .= '</tr>';
			}
		} else {
			// Handle the case where there's no data
			$table .= '<tr>';
			$table .= '<td colspan="4" class="text-center">No sales data available.</td>';
			$table .= '</tr>';
		}

		// Close the table structure
		$table .= '</tbody>';
		$table .= '</table>';

		// Echo the table
		echo $table;
	}

	public function userReport($store_id){
		$data['store_id'] = $store_id;  //In this case type return table id
		$this->load->view('owner/order/user_report',$data);
	}
	public function SupplierUserReport($store_id){
		$data['store_id'] = $store_id;  //In this case type return table id
		$this->load->view('owner/order/supplier_user_report',$data);
	}

	public function getUserReportByStoreId() {
		$store_id = $this->input->post('store_id');
		$date = $this->input->post('date');
		$user_id= $this->session->userdata('loginid');
		$roleid= $this->session->userdata('roleid');
		$userReports = $this->Ordermodel->getUserReportByStoreId($store_id , $date, $roleid,$user_id);

		$table = '';
		$table .= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
		$table .= '<thead>';
		$table .= '<tr>';
		$table .= '<th>Date</th>';
		$table .= '<th>User</th>';
		$table .= '<th>Login</th>';
		$table .= '<th>Logout</th>';
		$table .= '</tr>';
		$table .= '</thead>';
		$table .= '<tbody>';

		// Assume $userReports is an array containing multiple rows of user report data
		if (!empty($userReports)) {
			foreach ($userReports as $userReport) {
				$table .= '<tr>';
				$table .= '<td>' . htmlspecialchars($userReport['date']) . '</td>';
				$table .= '<td>' . htmlspecialchars($userReport['Name']) . '</td>';
				$table .= '<td>' . htmlspecialchars($userReport['login_time']) . '</td>';
				$table .= '<td>' . (isset($userReport['logout_time']) && $userReport['logout_time'] ? htmlspecialchars($userReport['logout_time']) : 'Still logged in') . '</td>';

				$table .= '</tr>';
			}
		} else {
			// Handle the case where there's no data
			$table .= '<tr>';
			$table .= '<td colspan="4" class="text-center">No user login data available.</td>';
			$table .= '</tr>';
		}

		// Close the table structure
		$table .= '</tbody>';
		$table .= '</table>';

		// Echo the table
		echo $table;
	}

	public function getSupplierUserReportByStoreId() {
		$store_id = $this->input->post('store_id');
		$date = $this->input->post('date');
		$userReports = $this->Ordermodel->getSupplierUserReportByStoreId($store_id , $date);

		$table = '';
		$table .= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
		$table .= '<thead>';
		$table .= '<tr>';
		$table .= '<th>Date</th>';
		$table .= '<th>User</th>';
		$table .= '<th>Login</th>';
		$table .= '<th>Logout</th>';
		$table .= '</tr>';
		$table .= '</thead>';
		$table .= '<tbody>';

		// Assume $userReports is an array containing multiple rows of user report data
		if (!empty($userReports)) {
			foreach ($userReports as $userReport) {
				$table .= '<tr>';
				$table .= '<td>' . htmlspecialchars($userReport['date']) . '</td>';
				$table .= '<td>' . htmlspecialchars($userReport['Name']) . '</td>';
				$table .= '<td>' . htmlspecialchars($userReport['login_time']) . '</td>';
				$table .= '<td>' . (isset($userReport['logout_time']) && $userReport['logout_time'] ? htmlspecialchars($userReport['logout_time']) : 'Still logged in') . '</td>';

				$table .= '</tr>';
			}
		} else {
			// Handle the case where there's no data
			$table .= '<tr>';
			$table .= '<td colspan="4" class="text-center">No user login data available.</td>';
			$table .= '</tr>';
		}

		// Close the table structure
		$table .= '</tbody>';
		$table .= '</table>';

		// Echo the table
		echo $table;
	}

	public function deliveryReport($store_id){
		$data['store_id'] = $store_id;  //In this case type return table id
		$this->load->view('owner/order/delivery_report',$data);
	}


	public function pending_reports($store_id){
		$data['store_id'] = $store_id;  //In this case type return table id
		$this->load->view('owner/order/pending_reports',$data);
	}
	public function getDeliveryReportByStoreId() {
		$store_id = $this->input->post('store_id');
		$date = $this->input->post('date');
		$deliveryReports = $this->Ordermodel->getDeliveryReportByStoreId($store_id , $date);
		// Initialize the table structure
		$table = '';
		$table .= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
		$table .= '<thead>';
		$table .= '<tr>';
		$table .= '<th>ORDER NO.</th>';
		$table .= '<th>Customer Name</th>';
		$table .= '<th>Customer MOB</th>';
		$table .= '<th>Location</th>';
		$table .= '<th>Payment Mode</th>';
		$table .= '<th>Total Amount</th>';
		$table .= '<th>Status</th>';
		$table .= '<th>Out For Delivery Time</th>';
		$table .= '<th>Delivered Time</th>';
		$table .= '<th>Delivery Boy</th>';
		$table .= '</tr>';
		$table .= '</thead>';
		$table .= '<tbody>';

		// Assume $deliveryReports is an array containing multiple rows of sales report data
		if (!empty($deliveryReports)) {
			foreach ($deliveryReports as $salesReport) {
				$table .= '<tr>';
				$table .= '<td>' .$salesReport['orderno'] . '</td>';
				$table .= '<td>' .$salesReport['customer_name'] . '</td>';
				$table .= '<td>' .$salesReport['contact_number'] . '</td>';
				$table .= '<td>' .$salesReport['location'] . '</td>';
				$table .= '<td>' .$salesReport['payment_mode'] . '</td>';
				$table .= '<td>' .$salesReport['total_amount'] . '</td>';
				$table .= '<td>' .$salesReport['order_status'] . '</td>';
				$table .= '<td>' .$salesReport['out_for_delivery_time'] . '</td>';
				$table .= '<td>' .$salesReport['delivered_time'] . '</td>';
				$table .= '<td>' .$this->Ordermodel->getDeliveryBoyName($salesReport['delivery_boy']) . '</td>';
				$table .= '</tr>';
			}
		} else {
			// Handle the case where there's no data
			$table .= '<tr>';
			$table .= '<td colspan="4" class="text-center">No sales data available.</td>';
			$table .= '</tr>';
		}

		// Close the table structure
		$table .= '</tbody>';
		$table .= '</table>';

		// Echo the table
		echo $table;
	}


	// public function getallpendingreports(){
	// 	$store_id = $this->input->post('store_id');
	// 	$date = $this->input->post('date');
	// 	 $deliveryReports = $this->Ordermodel->getDeliveryReportByStoreId($store_id , $date);
	// 	// Initialize the table structure
	// 	$table = '';
	// 	$table .= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
	// 	$table .= '<thead>';
	// 	$table .= '<tr>';
	// 	$table .= '<th>ORDER NO.</th>';
	// 	$table .= '<th>Customer Name</th>';
	// 	$table .= '<th>Customer MOB</th>';
	// 	$table .= '<th>Location</th>';
	// 	$table .= '<th>Payment Mode</th>';
	// 	$table .= '<th>Total Amount</th>';
	// 	$table .= '<th>Status</th>';
	// 	$table .= '<th>Out For Delivery Time</th>';
	// 	$table .= '<th>Delivered Time</th>';
	// 	$table .= '<th>Delivery Boy</th>';
	// 	$table .= '</tr>';
	// 	$table .= '</thead>';
	// 	$table .= '<tbody>';

	// 	// Assume $deliveryReports is an array containing multiple rows of sales report data
	// 	if (!empty($deliveryReports)) {
	// 		foreach ($deliveryReports as $salesReport) {
	// 			$table .= '<tr>';
	// 			$table .= '<td>' .$salesReport['orderno'] . '</td>';
	// 			$table .= '<td>' .$salesReport['customer_name'] . '</td>';
	// 			$table .= '<td>' .$salesReport['contact_number'] . '</td>';
	// 			$table .= '<td>' .$salesReport['location'] . '</td>';
	// 			$table .= '<td>' .$salesReport['payment_mode'] . '</td>';
	// 			$table .= '<td>' .$salesReport['total_amount'] . '</td>';
	// 			$table .= '<td>' .$salesReport['order_status'] . '</td>';
	// 			$table .= '<td>' .$salesReport['out_for_delivery_time'] . '</td>';
	// 			$table .= '<td>' .$salesReport['delivered_time'] . '</td>';
	// 			$table .= '<td>' .$this->Ordermodel->getDeliveryBoyName($salesReport['delivery_boy']) . '</td>';
	// 			$table .= '</tr>';
	// 		}
	// 	} else {
	// 		// Handle the case where there's no data
	// 		$table .= '<tr>';
	// 		$table .= '<td colspan="4" class="text-center">please select criteria</td>';
	// 		$table .= '</tr>';
	// 	}

	// 	// Close the table structure
	// 	$table .= '</tbody>';
	// 	$table .= '</table>';

	// 	// Echo the table
	// 	echo $table;
	// }

/*************  ✨ Codeium Command ⭐  *************/
/**
 * Loads the view for creating a new order with the order number
 * and a list of products assigned to the shop.
 *
 * The order number is generated by appending the current day,
 * month, and year to a base order number fetched from the
 * Productmodel.
 */

/******  1b850f36-69c8-4792-ba6b-1b055e8e8358  *******/
public function newOrder(){
		$order_no = $this->Productmodel->getOrderNo(); //Generate order number
        $day = date("d");
        $month = date("m");
        $year = date("y");
		$data['heading'] = "";
		$order_no_with_date = $order_no.$day.$month.$year;
		$data['order_number'] = $order_no_with_date;
		$data['products']=$this->Productmodel->shopAssignedProducts();

		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;

		$logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
		$loginName = $this->session->userdata('loginName');
		$data['name'] = $loginName;

        $store_details = $this->Homemodel->get_store_details_by_store_id($logged_in_store_id);
        $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_no;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;

		$this->load->view('owner/includes/header',$data);
		$this->load->view('owner/includes/owner-dashboard',$data);
		$this->load->view('owner/order/newOrder',$data);
		$this->load->view('owner/includes/footer');
	}

	public function newDiningOrder($order_number){
		$store_id = $this->session->userdata('logged_in_store_id');
        $role_id = $this->session->userdata('roleid'); // Role id of logged in user
        $user_id = $this->session->userdata('loginid'); // Loged in user id
		$data['order_number'] = $order_number;
		$data['activeTables']=$this->Ordermodel->getActiveTablesByStoreId($store_id,$user_id,$role_id);
		$data['products']=$this->Productmodel->shopAssignedActiveProducts();
		$data['heading'] = "Dining";
		$data['orderType'] = "D";
		$this->load->view('owner/order/newDiningOrder',$data);
	}

	public function newDeliveryOrder($order_number){
		$data['heading'] = "Delivery";
		$data['order_number'] = $order_number;
		$data['orderType'] = "DL";
		$data['products']=$this->Productmodel->shopAssignedActiveProducts();
		$this->load->view('owner/order/newDeliveryOrder',$data);
	}

	public function newPickupOrder($order_number){
		$data['heading'] = "Pickup";
		$data['order_number'] = $order_number;
		$data['orderType'] = "PK";
		$data['products']=$this->Productmodel->shopAssignedActiveProducts();
		$this->load->view('owner/order/newPickupOrder',$data);
	}

	public function setTableReserved(){
		$isReserved = $this->input->post('isReserved');
		$tableId = $this->input->post('tableId');
		$this->Ordermodel->setTableReserved($tableId,$isReserved);
		echo json_encode(array('status' => 'success'));
	}

	public function SaveConfirmOrder() {
		$order_id = $this->input->post('order_id');
		$orders = $this->Ordermodel->getOrderItems($order_id);
		$date = date('Y-m-d');
		$outOfStockProducts = [];
		$productQuantities = [];

		foreach ($orders as $product) {
            $product_id = $product['product_id'];
            if (!isset($productQuantities[$product_id]))
            {
                $productQuantities[$product_id] = 0;
            }
            if($product['variant_value'] == 0)
            {
                $productQuantities[$product_id] += $product['quantity'];
            }
            else
            {
            $productQuantities[$product_id] += $product['quantity'] * $product['variant_value'];
            }
        }
        //print_r($productQuantities);exit;

		foreach ($orders as $product) {
			$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product['product_id']);
	        //print_r($productDetails);exit;
			if (empty($productDetails)) {
				continue; // Skip if product details are not found
			}

			// Get store ID
			$store_id = $this->session->userdata('logged_in_store_id');

			// Check if product is a Combo
			if ($productDetails[0]['category_id'] == 23) {
				$comboItems = $this->Productmodel->getComboItems($store_id, $product['product_id']);

				foreach ($comboItems as $item) {
					$availableStock = $this->Ordermodel->getCurrentStock($item['item_id'], $date, $store_id);
					$requiredQuantity = $product['quantity'] * $item['quantity'];

					if ($requiredQuantity > $availableStock) {
						$outOfStockProducts[] = [
							'product_name' => $this->Ordermodel->getProductName($item['item_id']),
							'requested_quantity' => $requiredQuantity,
							'available_stock' => $availableStock ?? 0
						];
					}
				}
			}
			else {
				//echo "here";
				$availableStock = $this->Ordermodel->getCurrentStock($product['product_id'], $date, $store_id);//exit;
				$product['quantity'];
				if ($productQuantities[$product['product_id']] > $availableStock){
					$outOfStockProducts[] = [
						'product_name' => $this->Ordermodel->getProductName($product['product_id']),
						'requested_quantity' => $productQuantities[$product['product_id']],
						'available_stock' => $availableStock ?? 0
					];
				}
			}
		}

	//exit;
		// If any product is out of stock, return an error message
		if (!empty($outOfStockProducts)) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Some products are out of stock.',
				'out_of_stock' => $outOfStockProducts
			]);
			return;
		}
		else
		{
			// If all products are available, update the order
			$orderno = $this->Ordermodel->updateOrderNo($order_id);
			$this->Ordermodel->changeOrderStatus($order_id,0);

			echo json_encode([
				'status' => 'success',
				'orderno' => $orderno
			]);
		}


	}

	public function deleteOrderItem() {
		$orderId = $this->input->post('orderId');
		$store_id= $this->session->userdata('logged_in_store_id');

		if ($this->Ordermodel->deleteOrderItem($orderId,$store_id)) {
			echo json_encode(['success' => true]);
		}
	}

	public function deleteOrderItemWithUpdateRemark() {
		$orderId = $this->input->post('orderId');
		$delete_reason = $this->input->post('delete_reason');
		$is_delete = 1;  //1 for delete display orders using condition is_delete != 1
		if ($this->Ordermodel->deleteOrderItemWithUpdateRemark($orderId,$delete_reason,$is_delete)) {
			echo json_encode(['success' => true]);
		}
	}



	public function changeOrderStatus(){
		$orderId = $this->input->post('orderId');
		$status = $this->input->post('status');
		$this->Ordermodel->changeOrderStatus($orderId,$status);
		echo json_encode(['status' => $status,'orderId' => $orderId]);
	}



	public function changeDeliveryBoy(){
		$orderId = $this->input->post('orderId');
		$delivery_boy = $this->input->post('delivery_boy');
		$this->Ordermodel->changeDeliveryBoy($orderId,$delivery_boy);
		echo json_encode(['status' => $delivery_boy]);
	}



	public function SaveNewDiningOrder() {
		$this->load->model('owner/Ordermodel');
		$order_id = $this->input->post('order_id');
		$store_id = $this->input->post('store_id');
		$product_id = $this->input->post('product_id');
		$tableId = $this->input->post('tableID');
		$qty = $this->input->post('qty');

		$date = date('Y-m-d');
		$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
		$is_combo = $this->productIsCombo($product_id);
		if($is_combo)
		{
					$combo_items = $this->Ordermodel->getComboItems($store_id,$product_id);
					foreach ($combo_items as $item)
					{
						$stock = $this->Ordermodel->getCurrentStock($item['item_id'], date('Y-m-d'), $store_id);
						if ($stock < ($qty * $item['quantity'])) {
							// echo json_encode(['status' => 'error', 'message' => 'Not enough stock for product: ' . $item['item_id']]);
							echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($item['item_id']) . " Not available</div>";
							return;
						}
					}
					$orderItems = [
						'orderno' => $order_id,
						'date' => date('Y-m-d'),
						'store_id' => $store_id,
						'product_id' => $product_id,
						'quantity' => $qty,
						'vat_id' => $productDetails[0]['vat_id'],
						'rate' => $this->input->post('rate'),
						'amount' => $qty * $this->input->post('rate'),
						'tax' => $this->input->post('tax'),
						'tax_amount' => $this->input->post('tax_amount'),
						'total_amount' => $this->input->post('total_amount'),
						'item_remarks' => $product['recipe'] ?? null,
						'variant_id' => $this->input->post('variant_id') ?? null,
						'variant_value' => $this->input->post('variant_value') ?? 0,
						'category_id' => $productDetails[0]['category_id'], // optional timestamp
						'is_addon' => $productDetails[0]['is_addon'],
						'is_customisable' => $productDetails[0]['is_customizable'],
						'table_id' => $tableId,
						'order_type' => $this->input->post('orderType'),
						'is_paid' => 0,
						'is_reorder' => 0
					];

					$this->db->insert('order_items', $orderItems);

					$orderExists = $this->Ordermodel->isOrderExists($order_id);
					if($orderExists)
					{
						//echo "here";exit;
						$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
								$order_data = [
									'amount' => $updatedTotalAmt[0]['total_rate'],
									'tax_amount' => $updatedTotalAmt[0]['total_tax'],
									'total_amount' => $updatedTotalAmt[0]['total_amount']
								];
									$this->db->where('orderno', $order_id);
									$this->db->update('order', $order_data);
					}
					else
					{
						$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
						$order_data = [
							'orderno' => $order_id,
							'order_token' => $this->Productmodel->getOrderNo(),
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'amount' => $updateTotalAmountFromItems[0]['total_rate'],
							'tax' => $productDetails[0]['tax'],
							'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
							'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
							'is_paid'   => 0,
							'table_id' => $tableId,
							'order_type' => $this->input->post('orderType'),
							'order_status' => 8, // Not conform order before stock checking
							'customer_name	' => '',
							'contact_number' => '',
							'location' => '',
							'modified_by'=>0,
							'modified_date'=> date('Y-m-d H:i:s')
						];
						$this->db->insert('order', $order_data);
					}

		}
		else
		{
				if( $this->input->post('variant_value') > 0)  //Check if variant product or not enter if variant
				{
					$variantValue =  $this->input->post('variant_value'); //echo $variantValue; // Ensure it's a number
					$qty = (int) $qty;
					$availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
					if ($availableStock < $qty * $variantValue) {
						echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($product_id) . " Not available </div>";
					}
					else
					{

						$orderItems = [
							'orderno' => $order_id,
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'product_id' => $product_id,
							'quantity' => $qty,
							'vat_id' => $productDetails[0]['vat_id'],
							'rate' => $this->input->post('rate'),
							'amount' => $qty * $this->input->post('rate'),
							'tax' => $this->input->post('tax'),
							'tax_amount' => $this->input->post('tax_amount'),
							'total_amount' => $this->input->post('total_amount'),
							'item_remarks' => $product['recipe'] ?? null,
							'variant_id' => $this->input->post('variant_id') ?? null,
							'variant_value' => $this->input->post('variant_value') ?? 0,
							'category_id' => $productDetails[0]['category_id'], // optional timestamp
							'is_addon' => $productDetails[0]['is_addon'],
							'is_customisable' => $productDetails[0]['is_customizable'],
							'table_id' => $tableId,
							'order_type' => $this->input->post('orderType'),
							'is_paid' => 0,
							'is_reorder' => 0
						];

						$this->db->insert('order_items', $orderItems);

						$orderExists = $this->Ordermodel->isOrderExists($order_id);
						if($orderExists)
						{
							//echo "here";exit;
							$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
									$order_data = [
										'amount' => $updatedTotalAmt[0]['total_rate'],
										'tax_amount' => $updatedTotalAmt[0]['total_tax'],
										'total_amount' => $updatedTotalAmt[0]['total_amount']
									];
										$this->db->where('orderno', $order_id);
										$this->db->update('order', $order_data);
						}
						else
						{
							$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
							$order_data = [
								'orderno' => $order_id,
								'order_token' => $this->Productmodel->getOrderNo(),
								'date' => date('Y-m-d'),
								'store_id' => $store_id,
								'amount' => $updateTotalAmountFromItems[0]['total_rate'],
								'tax' => $productDetails[0]['tax'],
								'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
								'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
								'is_paid'   => 0,
								'table_id' => $tableId,
								'order_type' => $this->input->post('orderType'),
								'order_status' => 8, // Not conform order before stock checking
								'customer_name	' => '',
								'contact_number' => '',
								'location' => '',
								'modified_by'=>0,
								'modified_date'=> date('Y-m-d H:i:s')
							];
							$this->db->insert('order', $order_data);
						}
					}
				}
				else //Check if variant product or not enter if not variant
				{
					//echo "not variant";
					$availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
					if ($availableStock < $qty) {
						echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($product_id) . " Not available</div>";
					}

					else
					{

							$orderItems = [
								'orderno' => $order_id,
								'date' => date('Y-m-d'),
								'store_id' => $store_id,
								'product_id' => $product_id,
								'quantity' => $qty,
								'vat_id' => $productDetails[0]['vat_id'],
								'rate' => $this->input->post('rate'),
								'amount' => $qty * $this->input->post('rate'),
								'tax' => $this->input->post('tax'),
								'tax_amount' => $this->input->post('tax_amount'),
								'total_amount' => $this->input->post('total_amount'),
								'item_remarks' => $product['recipe'] ?? null,
								'variant_id' => $this->input->post('variant_id') ?? null,
								'variant_value' => $this->input->post('variant_value') ?? 0,
								'category_id' => $productDetails[0]['category_id'], // optional timestamp
								'is_addon' => $productDetails[0]['is_addon'],
								'is_customisable' => $productDetails[0]['is_customizable'],
								'table_id' => $tableId,
								'order_type' => $this->input->post('orderType'),
								'is_paid' => 0,
								'is_reorder' => 0
							];

							$this->db->insert('order_items', $orderItems);

							$orderExists = $this->Ordermodel->isOrderExists($order_id);
							if($orderExists)
							{
								//echo "here";exit;
								$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
										$order_data = [
											'amount' => $updatedTotalAmt[0]['total_rate'],
											'tax_amount' => $updatedTotalAmt[0]['total_tax'],
											'total_amount' => $updatedTotalAmt[0]['total_amount']
										];
											$this->db->where('orderno', $order_id);
											$this->db->update('order', $order_data);
							}
							else
							{
								$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
								$order_data = [
									'orderno' => $order_id,
									'order_token' => $this->Productmodel->getOrderNo(),
									'date' => date('Y-m-d'),
									'store_id' => $store_id,
									'amount' => $updateTotalAmountFromItems[0]['total_rate'],
									'tax' => $productDetails[0]['tax'],
									'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
									'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
									'is_paid'   => 0,
									'table_id' => $tableId,
									'order_type' => $this->input->post('orderType'),
									'order_status' => 8, // Not conform order before stock checking
									'customer_name	' => '',
									'contact_number' => '',
									'location' => '',
									'modified_by'=>0,
									'modified_date'=> date('Y-m-d H:i:s')
								];
								$this->db->insert('order', $order_data);
							}
					}
				}
	}


		$orders = $this->Ordermodel->getOrderItems($order_id);
if (!empty($orders)) {
		$accordionHtml = '';
		$total_amount = 0;
		$accordionHtml = '<form method="post" action="' . base_url('owner/order/update') . '">
		<input type="hidden" name="store_id" value="' . $this->session->userdata('logged_in_store_id') . '">
		<input type="hidden" name="order_id" value="' . $order_id . '">
		<div class="table-responsive">
		<table class="table">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th width="25%">Product</th>
					<th width="10%">Quantity</th>
					<th width="10%">Rate</th>
					<th width="10%">Amount</th>
					<th width="5%">Vat(%)</th>

					<th width="10%">Total-Amt</th>
					<th width="10%">Is Addon</th>
					<th width="20%">Recipe Details</th>
                </tr>
            </thead>
            <tbody>';
		foreach ($orders as $index => $order) {
			$productName = $this->Ordermodel->getProductName($order['product_id']);
   			$variantName = $this->Ordermodel->getVariantName($order['variant_id']);
   			$variantValue = $this->Ordermodel->getVariantValue($order['variant_id'], $order['product_id']);
			$variantValue = $variantValue ? $variantValue : 1;
   			$productDisplay = $variantName ? $productName . ' (' . $variantName . ')' : $productName;
			$accordionHtml .= '
                <tr id="order-row-' . $order['id'] . '">
                    <td>' . $index + 1 . '</td>
                    <td>' . $productDisplay .'</td>
					<td>
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][tax]" value="' . $order['tax'] . '">
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][id]" value="' . $order['id'] . '">
	<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][product_id]" value="' . $order['product_id'] . '">
					<div class="input-group" style="width:110px;">
                        <button class="btn btn-danger decrement" data-variant_value="' . $variantValue . '" data-tax="' . $order['tax'] . '"  data-orderno="'.$order['orderno'].'" data-rate="' . $order['rate'] . '" data-id="' . $order['id'] . '" data-product-id="' . $order['product_id'] . '" type="button" >-</button>
                        <input type="text" class="form-control text-center quantity" name="quantity" value="'.$order['quantity'].'" min="1" readonly>
                        <button class="btn btn-danger increment" data-variant_value="' . $variantValue . '" data-tax="' . $order['tax'] . '" data-orderno="'.$order['orderno'].'" data-rate="' . $order['rate'] . '" data-id="' . $order['id'] . '" data-product-id="' . $order['product_id'] . '" type="button" >+</button>
                    </div>
					</td>
					<td><input type="text" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][rate]" value="' . $order['rate'] . '"></td>
					<td class="amount">' . $order['rate'] * $order['quantity'] . '</td>
					<td>' . $order['tax'] . '</td>
					<td class="total-amount">' . $order['total_amount'] . '</td>
					<td><input type="checkbox" class="form-check-input" disabled name="orders[' . $index . '][is_addon]" value="1" ' . ($order['is_addon'] == 1 ? 'checked' : '') . '></td>
                    <td>' . $order['item_remarks'] . '</td>
					<td><button type="button" class="btn btn-danger delete-order" data-id="' . $order['id'] . '">Delete</button></td>
                </tr>';
				$item_total = $order['quantity'] * $order['total_amount'];
        		$total_amount += $item_total;
		}
		$accordionHtml .= '</tbody>
		<tfoot class="table-light">
                <tr>
				<td colspan="6">
                        <div class="d-flex justify-content-left">
                            <label class="btn text-black bg-b-cyan" width="100px" style="margin-right: 10px;">Order No : '.$order['orderno'].'</label>
                        </div>
                    </td>
					<td colspan="6">
                        <div class="d-flex justify-content-end">
							<a class="btn btn-danger" id="saveConfirmOrder" style="margin-right: 10px;">SAVE ORDER</a>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table></form>
		</div>';



		echo $accordionHtml;
	}
	}








	// Save New Pickup Order
		public function SaveNewPickupOrder() {
			$this->load->model('owner/Ordermodel');
			$order_id = $this->input->post('order_id');
			$store_id = $this->input->post('store_id');
			$product_id = $this->input->post('product_id');
			$tableId = $this->input->post('tableID');
			$qty = $this->input->post('qty');
			//echo $order_id;echo $store_id;echo $product_id;exit;

			$date = date('Y-m-d');
			$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
			$is_combo = $this->productIsCombo($product_id);
			if($is_combo)
			{
					$combo_items = $this->Ordermodel->getComboItems($store_id,$product_id);
					foreach ($combo_items as $item)
					{
						$stock = $this->Ordermodel->getCurrentStock($item['item_id'], date('Y-m-d'), $store_id);
						if ($stock < ($qty * $item['quantity'])) {
							// echo json_encode(['status' => 'error', 'message' => 'Not enough stock for product: ' . $item['item_id']]);
							echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($item['item_id']) . " Not available</div>";
							return;
						}
					}
					$orderItems = [
						'orderno' => $order_id,
						'date' => date('Y-m-d'),
						'store_id' => $store_id,
						'product_id' => $product_id,
						'quantity' => $qty,
						'vat_id' => $productDetails[0]['vat_id'],
						'rate' => $this->input->post('rate'),
						'amount' => $qty * $this->input->post('rate'),
						'tax' => $this->input->post('tax'),
						'tax_amount' => $this->input->post('tax_amount'),
						'total_amount' => $this->input->post('total_amount'),
						'item_remarks' => $product['recipe'] ?? null,
						'variant_id' => $this->input->post('variant_id') ?? null,
						'variant_value' => $this->input->post('variant_value') ?? 0,
						'category_id' => $productDetails[0]['category_id'], // optional timestamp
						'is_addon' => $productDetails[0]['is_addon'],
						'is_customisable' => $productDetails[0]['is_customizable'],
						'table_id' => $tableId,
						'order_type' => $this->input->post('orderType'),
						'is_paid' => 0,
						'is_reorder' => 0
					];

					$this->db->insert('order_items', $orderItems);

					$orderExists = $this->Ordermodel->isOrderExists($order_id);
					if($orderExists)
					{
						//echo "here";exit;
						$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
								$order_data = [
									'amount' => $updatedTotalAmt[0]['total_rate'],
									'tax_amount' => $updatedTotalAmt[0]['total_tax'],
									'total_amount' => $updatedTotalAmt[0]['total_amount']
								];
									$this->db->where('orderno', $order_id);
									$this->db->update('order', $order_data);
					}
					else
					{
						$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
						$order_data = [
							'orderno' => $order_id,
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'amount' => $updateTotalAmountFromItems[0]['total_rate'],
							'tax' => $productDetails[0]['tax'],
							'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
							'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
							'is_paid'   => 0,
							'table_id' => $tableId,
							'order_type' => $this->input->post('orderType'),
							'order_status' => 8,
							'customer_name	' => $this->input->post('name'),
							'contact_number' => $this->input->post('number'),
							'time' => $this->input->post('time'),
							'location' => '',
							'modified_by'=>0,
							'modified_date'=> date('Y-m-d H:i:s')
						];
						$this->db->insert('order', $order_data);
					}


			}
			else
		{
				if( $this->input->post('variant_value') > 0)  //Check if variant product or not enter if variant
				{
					$variantValue =  $this->input->post('variant_value'); // Ensure it's a number
					$qty = (int) $qty;
					echo $availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
					if ($availableStock < $qty * $variantValue) {
						echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($product_id) . " Not available </div>";
					}
					else
					{

						$orderItems = [
							'orderno' => $order_id,
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'product_id' => $product_id,
							'quantity' => $qty,
							'vat_id' => $productDetails[0]['vat_id'],
							'rate' => $this->input->post('rate'),
							'amount' => $qty * $this->input->post('rate'),
							'tax' => $this->input->post('tax'),
							'tax_amount' => $this->input->post('tax_amount'),
							'total_amount' => $this->input->post('total_amount'),
							'item_remarks' => $product['recipe'] ?? null,
							'variant_id' => $this->input->post('variant_id') ?? null,
							'variant_value' => $this->input->post('variant_value') ?? 0,
							'category_id' => $productDetails[0]['category_id'], // optional timestamp
							'is_addon' => $productDetails[0]['is_addon'],
							'is_customisable' => $productDetails[0]['is_customizable'],
							'table_id' => $tableId,
							'order_type' => $this->input->post('orderType'),
							'is_paid' => 0,
							'is_reorder' => 0
						];

						$this->db->insert('order_items', $orderItems);

						$orderExists = $this->Ordermodel->isOrderExists($order_id);
						if($orderExists)
						{
							//echo "here";exit;
							$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
									$order_data = [
										'amount' => $updatedTotalAmt[0]['total_rate'],
										'tax_amount' => $updatedTotalAmt[0]['total_tax'],
										'total_amount' => $updatedTotalAmt[0]['total_amount']
									];
										$this->db->where('orderno', $order_id);
										$this->db->update('order', $order_data);
						}
						else
						{
							$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
							$order_data = [
								'orderno' => $order_id,
								'order_token' => $this->Productmodel->getOrderNo(),
								'date' => date('Y-m-d'),
								'store_id' => $store_id,
								'amount' => $updateTotalAmountFromItems[0]['total_rate'],
								'tax' => $productDetails[0]['tax'],
								'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
								'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
								'is_paid'   => 0,
								'table_id' => $tableId,
								'order_type' => $this->input->post('orderType'),
								'order_status' => 8,
								'customer_name	' => '',
								'contact_number' => '',
								'location' => '',
								'modified_by'=>0,
								'modified_date'=> date('Y-m-d H:i:s')
							];
							$this->db->insert('order', $order_data);
						}
					}
				}
				else //Check if variant product or not enter if not variant
				{
					//echo "not variant";
					$availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
					if ($availableStock < $qty) {
						echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($product_id) . " Not available</div>";
					}

					else
					{

							$orderItems = [
								'orderno' => $order_id,
								'date' => date('Y-m-d'),
								'store_id' => $store_id,
								'product_id' => $product_id,
								'quantity' => $qty,
								'vat_id' => $productDetails[0]['vat_id'],
								'rate' => $this->input->post('rate'),
								'amount' => $qty * $this->input->post('rate'),
								'tax' => $this->input->post('tax'),
								'tax_amount' => $this->input->post('tax_amount'),
								'total_amount' => $this->input->post('total_amount'),
								'item_remarks' => $product['recipe'] ?? null,
								'variant_id' => $this->input->post('variant_id') ?? null,
								'variant_value' => $this->input->post('variant_value') ?? 0,
								'category_id' => $productDetails[0]['category_id'], // optional timestamp
								'is_addon' => $productDetails[0]['is_addon'],
								'is_customisable' => $productDetails[0]['is_customizable'],
								'table_id' => $tableId,
								'order_type' => $this->input->post('orderType'),
								'is_paid' => 0,
								'is_reorder' => 0
							];

							$this->db->insert('order_items', $orderItems);

							$orderExists = $this->Ordermodel->isOrderExists($order_id);
							if($orderExists)
							{
								//echo "here";exit;
								$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
										$order_data = [
											'amount' => $updatedTotalAmt[0]['total_rate'],
											'tax_amount' => $updatedTotalAmt[0]['total_tax'],
											'total_amount' => $updatedTotalAmt[0]['total_amount']
										];
											$this->db->where('orderno', $order_id);
											$this->db->update('order', $order_data);
							}
							else
							{
								$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
								$order_data = [
									'orderno' => $order_id,
									'order_token' => $this->Productmodel->getOrderNo(),
									'date' => date('Y-m-d'),
									'store_id' => $store_id,
									'amount' => $updateTotalAmountFromItems[0]['total_rate'],
									'tax' => $productDetails[0]['tax'],
									'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
									'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
									'is_paid'   => 0,
									'table_id' => $tableId,
									'order_type' => $this->input->post('orderType'),
									'order_status' => 8,
									'customer_name	' => '',
									'contact_number' => '',
									'location' => '',
									'modified_by'=>0,
									'modified_date'=> date('Y-m-d H:i:s')
								];
								$this->db->insert('order', $order_data);
							}
					}
				}
	}


			$orders = $this->Ordermodel->getOrderItems($order_id);
	if(!empty($orders)) {

			$accordionHtml = '';
			$total_amount = 0;
			$accordionHtml = '<form method="post" action="' . base_url('owner/order/update') . '">
			<input type="hidden" name="store_id" value="' . $this->session->userdata('logged_in_store_id') . '">
			<input type="hidden" name="order_id" value="' . $order_id . '">
			<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th width="5%">Sl</th>
						<th width="25%">Product</th>
						<th width="10%">Quantity</th>
						<th width="10%">Rate</th>
						<th width="10%">Amount</th>
						<th width="5%">Vat(%)</th>

						<th width="10%">Total-Amt</th>
						<th width="10%">Is Addon</th>
						<th width="20%">Recipe Details</th>
					</tr>
				</thead>
				<tbody>';
			foreach ($orders as $index => $order) {
				$productName = $this->Ordermodel->getProductName($order['product_id']);
				$variantName = $this->Ordermodel->getVariantName($order['variant_id']);
				$variantValue = $this->Ordermodel->getVariantValue($order['variant_id'], $order['product_id']);
                $variantValue = $variantValue ? $variantValue : 1;
				$productDisplay = $variantName ? $productName . ' (' . $variantName . ')' : $productName;
				$accordionHtml .= '
					<tr id="order-row-' . $order['id'] . '">
						<td>' . $index + 1 . '</td>
						<td>' . $productDisplay . '</td>
						<td>
						<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][tax]" value="' . $order['tax'] . '">
						<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][id]" value="' . $order['id'] . '">
		<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][product_id]" value="' . $order['product_id'] . '">
						<div class="input-group" style="width:110px;">
                        <button class="btn btn-danger decrement" data-variant_value="' . $variantValue . '" data-tax="' . $order['tax'] . '"  data-orderno="'.$order['orderno'].'" data-rate="' . $order['rate'] . '" data-id="' . $order['id'] . '" data-product-id="' . $order['product_id'] . '" type="button" >-</button>
                        <input type="text" class="form-control text-center quantity" name="quantity" value="'.$order['quantity'].'" min="1" readonly>
                        <button class="btn btn-danger increment" data-variant_value="' . $variantValue . '" data-tax="' . $order['tax'] . '" data-orderno="'.$order['orderno'].'" data-rate="' . $order['rate'] . '" data-id="' . $order['id'] . '" data-product-id="' . $order['product_id'] . '" type="button" >+</button>
                    </div>
						</td>
						<td><input type="text" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][rate]" value="' . $order['rate'] . '"></td>
						<td class="amount">' . $order['rate'] * $order['quantity'] . '</td>
						<td>' . $order['tax'] . '</td>
						<td class="total-amount">' . $order['total_amount'] . '</td>
						<td><input type="checkbox" class="form-check-input" disabled name="orders[' . $index . '][is_addon]" value="1" ' . ($order['is_addon'] == 1 ? 'checked' : '') . '></td>
						<td>' . $order['item_remarks'] . '</td>
						<td><button type="button" class="btn btn-danger delete-order" data-id="' . $order['id'] . '">Delete</button></td>
					</tr>';
					$item_total = $order['quantity'] * $order['total_amount'];
					$total_amount += $item_total;
			}
			$accordionHtml .= '</tbody>
			<tfoot class="table-light">
					<tr>
					<td colspan="6">
							<div class="d-flex justify-content-left">
								<label class="btn text-black bg-b-cyan" width="100px" style="margin-right: 10px;">Order No : '.$order['orderno'].'</label>
							</div>
						</td>
						<td colspan="6">
							<div class="d-flex justify-content-end">
								<a class="btn btn-danger" id="saveConfirmOrder" style="margin-right: 10px;">SAVE ORDER</a>
							</div>
						</td>
					</tr>
				</tfoot>
			</table></form>
			</div>';

			echo $accordionHtml;
		}
		}









		// Save New Delivery Order
	public function SaveNewDeliveryOrder() {
		$this->load->model('owner/Ordermodel');
		$order_id = $this->input->post('order_id');
		$store_id = $this->input->post('store_id');
		$product_id = $this->input->post('product_id');
		$tableId = $this->input->post('tableID');
		$qty = $this->input->post('qty');


		$date = date('Y-m-d');
		$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
		$is_combo = $this->productIsCombo($product_id);
		if($is_combo)
		{
					$combo_items = $this->Ordermodel->getComboItems($store_id,$product_id);
					foreach ($combo_items as $item)
					{
						$stock = $this->Ordermodel->getCurrentStock($item['item_id'], date('Y-m-d'), $store_id);
						if ($stock < ($qty * $item['quantity'])) {
							// echo json_encode(['status' => 'error', 'message' => 'Not enough stock for product: ' . $item['item_id']]);
							echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($item['item_id']) . " Not available</div>";
							return;
						}
					}

					$orderItems = [
						'orderno' => $order_id,
						'date' => date('Y-m-d'),
						'store_id' => $store_id,
						'product_id' => $product_id,
						'quantity' => $qty,
						'vat_id' => $productDetails[0]['vat_id'],
						'rate' => $this->input->post('rate'),
						'amount' => $qty * $this->input->post('rate'),
						'tax' => $this->input->post('tax'),
						'tax_amount' => $this->input->post('tax_amount'),
						'total_amount' => $this->input->post('total_amount'),
						'item_remarks' => $product['recipe'] ?? null,
						'variant_id' => $this->input->post('variant_id') ?? null,
						'variant_value' => $this->input->post('variant_value') ?? 0,
						'category_id' => $productDetails[0]['category_id'], // optional timestamp
						'is_addon' => $productDetails[0]['is_addon'],
						'is_customisable' => $productDetails[0]['is_customizable'],
						'table_id' => $tableId,
						'order_type' => $this->input->post('orderType'),
						'is_paid' => 0,
						'is_reorder' => 0
					];

					$this->db->insert('order_items', $orderItems);

					$orderExists = $this->Ordermodel->isOrderExists($order_id);
					if($orderExists)
					{
						//echo "here";exit;
						$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
								$order_data = [
									'amount' => $updatedTotalAmt[0]['total_rate'],
									'tax_amount' => $updatedTotalAmt[0]['total_tax'],
									'total_amount' => $updatedTotalAmt[0]['total_amount']
								];
									$this->db->where('orderno', $order_id);
									$this->db->update('order', $order_data);
					}
					else
					{
						$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
						$order_data = [
							'orderno' => $order_id,
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'amount' => $updateTotalAmountFromItems[0]['total_rate'],
							'tax' => $productDetails[0]['tax'],
							'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
							'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
							'is_paid'   => 0,
							'table_id' => $tableId,
							'order_type' => $this->input->post('orderType'),
							'order_status' => 8,
							'customer_name	' => $this->input->post('name'),
							'contact_number' => $this->input->post('number'),
							'location' => $this->input->post('address'),
							'time' => $this->input->post('time'),
							'payment_mode' => $this->input->post('paymentMode'),
							'modified_by'=>0,
							'modified_date'=> date('Y-m-d H:i:s')
						];
						$this->db->insert('order', $order_data);
					}

		}
		else
		{
				if( $this->input->post('variant_value') > 0)  //Check if variant product or not enter if variant
				{
					$variantValue =  $this->input->post('variant_value'); // Ensure it's a number
					$qty = (int) $qty;
					$availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
					if ($availableStock < $qty * $variantValue) {
						echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($product_id) . " Not available </div>";
					}
					else
					{

						$orderItems = [
							'orderno' => $order_id,
							'date' => date('Y-m-d'),
							'store_id' => $store_id,
							'product_id' => $product_id,
							'quantity' => $qty,
							'vat_id' => $productDetails[0]['vat_id'],
							'rate' => $this->input->post('rate'),
							'amount' => $qty * $this->input->post('rate'),
							'tax' => $this->input->post('tax'),
							'tax_amount' => $this->input->post('tax_amount'),
							'total_amount' => $this->input->post('total_amount'),
							'item_remarks' => $product['recipe'] ?? null,
							'variant_id' => $this->input->post('variant_id') ?? null,
							'variant_value' => $this->input->post('variant_value') ?? 0,
							'category_id' => $productDetails[0]['category_id'], // optional timestamp
							'is_addon' => $productDetails[0]['is_addon'],
							'is_customisable' => $productDetails[0]['is_customizable'],
							'table_id' => $tableId,
							'order_type' => $this->input->post('orderType'),
							'is_paid' => 0,
							'is_reorder' => 0
						];

						$this->db->insert('order_items', $orderItems);

						$orderExists = $this->Ordermodel->isOrderExists($order_id);
						if($orderExists)
						{
							//echo "here";exit;
							$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
									$order_data = [
										'amount' => $updatedTotalAmt[0]['total_rate'],
										'tax_amount' => $updatedTotalAmt[0]['total_tax'],
										'total_amount' => $updatedTotalAmt[0]['total_amount']
									];
										$this->db->where('orderno', $order_id);
										$this->db->update('order', $order_data);
						}
						else
						{
							$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
							$order_data = [
								'orderno' => $order_id,
								'order_token' => $this->Productmodel->getOrderNo(),
								'date' => date('Y-m-d'),
								'store_id' => $store_id,
								'amount' => $updateTotalAmountFromItems[0]['total_rate'],
								'tax' => $productDetails[0]['tax'],
								'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
								'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
								'is_paid'   => 0,
								'table_id' => $tableId,
								'order_type' => $this->input->post('orderType'),
								'order_status' => 8,
								'customer_name	' => '',
								'contact_number' => '',
								'location' => '',
								'modified_by'=>0,
								'modified_date'=> date('Y-m-d H:i:s')
							];
							$this->db->insert('order', $order_data);
						}
					}
				}
				else //Check if variant product or not enter if not variant
				{
					//echo "not variant";
					$availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
					if ($availableStock < $qty) {
						echo "<div class='alert alert-danger' role='alert'>". $qty .' '. $this->Ordermodel->getProductName($product_id) . " Not available</div>";
					}

					else
					{

							$orderItems = [
								'orderno' => $order_id,
								'date' => date('Y-m-d'),
								'store_id' => $store_id,
								'product_id' => $product_id,
								'quantity' => $qty,
								'vat_id' => $productDetails[0]['vat_id'],
								'rate' => $this->input->post('rate'),
								'amount' => $qty * $this->input->post('rate'),
								'tax' => $this->input->post('tax'),
								'tax_amount' => $this->input->post('tax_amount'),
								'total_amount' => $this->input->post('total_amount'),
								'item_remarks' => $product['recipe'] ?? null,
								'variant_id' => $this->input->post('variant_id') ?? null,
								'variant_value' => $this->input->post('variant_value') ?? 0,
								'category_id' => $productDetails[0]['category_id'], // optional timestamp
								'is_addon' => $productDetails[0]['is_addon'],
								'is_customisable' => $productDetails[0]['is_customizable'],
								'table_id' => $tableId,
								'order_type' => $this->input->post('orderType'),
								'is_paid' => 0,
								'is_reorder' => 0
							];

							$this->db->insert('order_items', $orderItems);

							$orderExists = $this->Ordermodel->isOrderExists($order_id);
							if($orderExists)
							{
								//echo "here";exit;
								$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
										$order_data = [
											'amount' => $updatedTotalAmt[0]['total_rate'],
											'tax_amount' => $updatedTotalAmt[0]['total_tax'],
											'total_amount' => $updatedTotalAmt[0]['total_amount']
										];
											$this->db->where('orderno', $order_id);
											$this->db->update('order', $order_data);
							}
							else
							{
								$updateTotalAmountFromItems = $this->Ordermodel->updateTotalAmountFromItems($order_id);
								$order_data = [
									'orderno' => $order_id,
									'order_token' => $this->Productmodel->getOrderNo(),
									'date' => date('Y-m-d'),
									'store_id' => $store_id,
									'amount' => $updateTotalAmountFromItems[0]['total_rate'],
									'tax' => $productDetails[0]['tax'],
									'tax_amount' => $updateTotalAmountFromItems[0]['total_tax'],
									'total_amount' => $updateTotalAmountFromItems[0]['total_amount'],
									'is_paid'   => 0,
									'table_id' => $tableId,
									'order_type' => $this->input->post('orderType'),
									'order_status' => 8,
									'customer_name	' => '',
									'contact_number' => '',
									'location' => '',
									'modified_by'=>0,
									'modified_date'=> date('Y-m-d H:i:s')
								];
								$this->db->insert('order', $order_data);
							}
					}
				}
	}


		$orders = $this->Ordermodel->getOrderItems($order_id);
if(!empty($orders)) {
		$accordionHtml = '';
		$total_amount = 0;
		$accordionHtml = '<form method="post" action="' . base_url('owner/order/update') . '">
		<input type="hidden" name="store_id" value="' . $this->session->userdata('logged_in_store_id') . '">
		<input type="hidden" name="order_id" value="' . $order_id . '">
		<div class="table-responsive">
		<table class="table">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th width="25%">Product</th>
					<th width="10%">Quantity</th>
					<th width="10%">Rate</th>
					<th width="10%">Amount</th>
					<th width="5%">Vat(%)</th>

					<th width="10%">Total-Amt</th>
					<th width="10%">Is Addon</th>
					<th width="20%">Recipe Details</th>
                </tr>
            </thead>
            <tbody>';
		foreach ($orders as $index => $order) {
			$productName = $this->Ordermodel->getProductName($order['product_id']);
			$variantName = $this->Ordermodel->getVariantName($order['variant_id']);
			$variantValue = $this->Ordermodel->getVariantValue($order['variant_id'], $order['product_id']);
            $variantValue = $variantValue ? $variantValue : 1;
			$productDisplay = $variantName ? $productName . ' (' . $variantName . ')' : $productName;
			$accordionHtml .= '
                <tr id="order-row-' . $order['id'] . '">
                    <td>' . $index + 1 . '</td>
                    <td>' . $productDisplay . '</td>
					<td>
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][tax]" value="' . $order['tax'] . '">
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][id]" value="' . $order['id'] . '">
	<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][product_id]" value="' . $order['product_id'] . '">
					<div class="input-group" style="width:110px;">
                        <button class="btn btn-danger decrement" data-variant_value="' . $variantValue . '" data-tax="' . $order['tax'] . '"  data-orderno="'.$order['orderno'].'" data-rate="' . $order['rate'] . '" data-id="' . $order['id'] . '" data-product-id="' . $order['product_id'] . '" type="button" >-</button>
                        <input type="text" class="form-control text-center quantity" name="quantity" value="'.$order['quantity'].'" min="1" readonly>
                        <button class="btn btn-danger increment" data-variant_value="' . $variantValue . '" data-tax="' . $order['tax'] . '" data-orderno="'.$order['orderno'].'" data-rate="' . $order['rate'] . '" data-id="' . $order['id'] . '" data-product-id="' . $order['product_id'] . '" type="button" >+</button>
                    </div>
					</td>
					<td><input type="text" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][rate]" value="' . $order['rate'] . '"></td>
					<td class="amount">' . $order['rate'] * $order['quantity'] . '</td>
					<td>' . $order['tax'] . '</td>
					<td class="total-amount">' . $order['total_amount'] . '</td>
					<td><input type="checkbox" class="form-check-input" disabled name="orders[' . $index . '][is_addon]" value="1" ' . ($order['is_addon'] == 1 ? 'checked' : '') . '></td>
                    <td>' . $order['item_remarks'] . '</td>
					<td><button type="button" class="btn btn-danger delete-order" data-id="' . $order['id'] . '">Delete</button></td>
                </tr>';
				$item_total = $order['quantity'] * $order['total_amount'];
        		$total_amount += $item_total;
		}
		$accordionHtml .= '</tbody>
		<tfoot class="table-light">
                <tr>
				<td colspan="6">
                        <div class="d-flex justify-content-left">
                            <label class="btn text-black bg-b-cyan" width="100px" style="margin-right: 10px;">Order No : '.$order['orderno'].'</label>
                        </div>
                    </td>
					<td colspan="6">
                        <div class="d-flex justify-content-end">
							<a class="btn btn-danger" id="saveConfirmOrder" style="margin-right: 10px;">SAVE ORDER</a>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table></form>
		</div>';

		echo $accordionHtml;
	}
	}





	// end







    public function tableOrders($tableId) {
        $data['tableId'] = $tableId;
        $this->load->view('owner/order/table_orders',$data);
    }
	public function pickupOrderDetails($orderNo) {
		$data['orderNo'] = $orderNo;
		$this->load->view('owner/order/pickup_order_details',$data);
    }
	public function completedOrdersPKDL($type){
		$data['type'] = $type;
		$this->load->view('owner/order/completed_orders',$data);
	}

	public function ordersPKDL($type){
		$data['type'] = $type;
		$this->load->view('owner/order/pending_orders',$data);
	}




		public function RoomOrdersPendingPKDL($table_id){
		$data['table_id'] = $table_id;  //In this case type return table id
		// print_r($data['table_id']);
		$this->load->view('owner/order/pending_room_orders',$data);
	}

	public function AddOrderItems($orderno){
		$data['type'] = $orderno;
		$data['products']=$this->Productmodel->shopAssignedActiveProducts();
		$this->load->view('owner/order/addOrderItem',$data);
	}




	public function getKotPrintOrderItems(){
		$order_no = $this->input->post('order_no');
		$data['order_no'] = $order_no;
		$data['storeDet']=$this->Storemodel->get($this->session->userdata('logged_in_store_id'));
		//$data['order']=$this->Ordermodel->getOrderSummary($order_no);
		$data['order_items']=$this->Ordermodel->getOrderItems($order_no); //print_r($data['order']);print_r($data['order_items']);exit;
		$this->load->view('owner/order/kotPrintOrderItem',$data);
	}

	public function getProductRates(){
		$this->load->model('owner/Ordermodel');
		$qty = $this->input->post('qty');
		 $store_id = $this->input->post('store_id');
		 $product_id = $this->input->post('product_id');
		 $variant_id = $this->input->post('variant_id');
		 $rates = $this->Ordermodel->getProductRatesDb($store_id,$product_id,$variant_id);
		 $tax_amount = $qty * $rates->rate * 5 / 100;
		 $total_amount = $qty * $rates->rate + $tax_amount;
		 echo json_encode(['rate' => $rates->rate , 'tax' => 5 , 'tax_amount' => $tax_amount,'total_amount' => $total_amount , 'variant_id' => $variant_id]);
	}

	public function getProductRatesNotCustomize(){
		$this->load->model('owner/Ordermodel');
		$qty = $this->input->post('qty');
		$store_id = $this->input->post('store_id');
		$product_id = $this->input->post('product_id');
		$rates = $this->Ordermodel->getProductRatesNotCustomizeDb($store_id,$product_id);
		$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
		$tax_amount = $qty * $rates->rate * $productDetails[0]['tax']  / 100;
		$total_amount = $qty * $rates->rate + $tax_amount;
		echo json_encode(['rate' => $rates->rate , 'tax' => $productDetails[0]['tax'] , 'tax_amount' => $tax_amount,'total_amount' => $total_amount]);
	}

	public function update() {
		$this->load->model('owner/Ordermodel');
		$orders = $this->input->post('orders');
		$store_id = $this->input->post('store_id');
		$order_id = $this->input->post('order_id');
		if(isset($_POST['approve'])){
			$tax_amount = 0;
			$total_amount = 0;
			foreach ($orders as $key => $order) {
				$tax_amount = $order['quantity'] * $order['rate'] * $order['tax'] / 100;
				$total_amount = $order['quantity'] * $order['rate'] + $tax_amount;
				$order_sl  = $order['id'];
				$product_id  = $order['product_id'];
				$this->Ordermodel->CheckOrderApprove($order_sl,$store_id,$order_id,$product_id,$order['quantity'],$order['rate'],$tax_amount,$total_amount);
			}
		}
		else if(isset($_POST['pay'])){
			$this->Ordermodel->CheckOrderPaid($store_id,$order_id);
		}
		else
		{
			echo "Print";
		}
	}


	public function update_order() {
		$this->load->model('owner/Ordermodel');
		$order_id = $this->input->post('orderId');
		$category_id = $this->input->post('category');
    	$orders = $this->input->post('items');
		$selectedsuppliers = $this->input->post('selectedsupplier');
	   $role_id = $this->session->userdata('roleid');
		// print_r($selectedsuppliers);exit;

		// print_r($orders);exit;
		$store_id = $this->session->userdata('logged_in_store_id');

		$productQuantities = [];
		//Get each ordered item quantity within multidimensional array like array push if repeat same product with multi variant
        foreach ($orders as $product)
        {
            $product_id = $product['store_product_id'];
            if (!isset($productQuantities[$product_id]))
            {
                $productQuantities[$product_id] = 0;
            }
            if($product['variant_value'] == 0)
            {
                $productQuantities[$product_id] += $product['quantity'];
            }
            else
            {
            $productQuantities[$product_id] += $product['quantity'] * $product['variant_value'];
            }
        }

            $outOfStockProducts = [];
			if (!empty($orders))
			{
				  foreach ($orders as $product) {
					  $date = date('Y-m-d');
					  $productDetails = $this->Ordermodel->get_store_wise_product_by_id($product['store_product_id']);

					  if (empty($productDetails)) {
						  continue; // Skip if product details are not found
					  }

					  // Check if product is a Combo
					  if ($productDetails[0]['category_id'] == 23) {
						  //echo "combo";
						  // Get combo components
						  $comboItems = $this->Productmodel->getComboItems($store_details_from_token->store_id, $product['store_product_id']);
						  foreach ($comboItems as $item) {
							  $availableStock = $this->Productmodel->getCurrentStock($item['item_id'], $date, $store_details_from_token->store_id);

							  if ($product['quantity'] * $item['quantity'] > $availableStock) {
								  $outOfStockProducts[] = [
									  'product_name' => $this->Ordermodel->getProductName($item['item_id']),
									  'requested_quantity' => $product['quantity'] * $item['quantity'],
									  'available_stock' => isset($availableStock) ? $availableStock : 0
								  ];
							  }
						  }
					  }
					  // Check if product has variants
					  else
					   {
					  //echo "here";
					    $availableStock = $this->Ordermodel->getCurrentStock($product['store_product_id'], $date, $store_id);//exit;


					  if ($productQuantities[$product['store_product_id']] > $availableStock){
						  $outOfStockProducts[] = [
							  'product_name' => $this->Ordermodel->getProductName($product['store_product_id']),
							  'requested_quantity' => $productQuantities[$product['store_product_id']],
							  'available_stock' => $availableStock ?? 0
						  ];
					  }
					  }
				  }

				  //print_r($outOfStockProducts);exit;

				  // Return out-of-stock response
				  if (!empty($outOfStockProducts))
				  {
					  $Response = [
						  'status' => 'error',
						  'message' => 'Some products are out of stock.',
						  'outOfStockProducts' => $outOfStockProducts
					  ];
					  echo json_encode($Response);
					  return;
				  }
				  else
				  {
				        $tax_amount = 0;
            			$total_amount = 0;
            			$this->db->delete('store_stock', array('ttype' => 'SL', 'store_id' => $store_id, 'order_id' => $order_id,'tr_date' => date('Y-m-d')));
            			foreach ($orders as $key => $order) {
            				$tax_amount = $order['quantity'] * $order['rate'] * $order['tax'] / 100;
            				$total_amount = $order['quantity'] * $order['rate'] + $tax_amount;
            				$order_sl  = $order['id'];
            				$product_id  = $order['store_product_id'];
            				$this->Ordermodel->CheckOrderApprove($order_sl,$store_id,$order_id,$product_id,$order['quantity'],$order['rate'],$tax_amount,$total_amount,$category_id,$order['variant_value'],$selectedsuppliers,$role_id);
            			}
            			echo json_encode(['status' => 'success']);
				  }
			}

	}



/*************  ✨ Codeium Command ⭐  *************/
/**
 * Removes stock associated with a specific order item.
 *
 * This function deletes the stock entry for a given product item
 * from the order based on the provided inputs. It interacts with
 * the Ordermodel to perform the deletion.
 *
 * Inputs:
 * - 'product_id': The ID of the product whose stock is to be removed.
 * - 'item_id': The ID of the order item to be removed.
 * - 'orderstatus': The status of the order.
 *
 * Uses session data to obtain:
 * - 'logged_in_store_id': The ID of the store for the current session.
 */

/******  cd027bc9-ed1e-4de0-a94e-efd4afb6e233  *******/
	public function deleteOrderItemStockRemove(){
		$this->load->model('owner/Ordermodel');
		$product_id = $this->input->post('product_id');
		$item_id = $this->input->post('item_id');
		$orderstatus = $this->input->post('orderstatus'); // Order status
		$store_id = $this->session->userdata('logged_in_store_id');
		$this->Ordermodel->deleteOrderItemStockRemove($store_id,$item_id,$orderstatus,$product_id);
	}

	// public function pay_order(){
	// 	$this->load->model('owner/Ordermodel');
	// 	$order_id = $this->input->post('orderId');
	// 	$store_id = $this->session->userdata('logged_in_store_id');
	// 	$this->Ordermodel->CheckOrderPaid($store_id,$order_id);
	// 	echo json_encode(['status' => 'success']);
	// }
	public function out_for_delivery_order(){
		$this->load->model('owner/Ordermodel');
		$order_id = $this->input->post('orderId');
		$store_id = $this->session->userdata('logged_in_store_id');
		$this->Ordermodel->out_for_delivery_order($store_id,$order_id);
		echo json_encode(['status' => 'success']);
	}

	public function SaveOrderWIthExisting(){
		$this->load->model('owner/Ordermodel');
		$order_id = $this->input->post('order_id');
		$store_id = $this->input->post('store_id');
		$product_id = $this->input->post('product_id');
		$qty = $this->input->post('qty');
		$date = date('Y-m-d');
		$productDetails = $this->Ordermodel->get_store_wise_product_by_id($product_id);
		$is_combo = $this->productIsCombo($product_id);
		if($is_combo)
		{
			$combo_items = $this->Ordermodel->getComboItems($store_id,$product_id);
			foreach ($combo_items as $item)
			{
				$stock = $this->Ordermodel->getCurrentStock($item['item_id'], date('Y-m-d'), $store_id);
				if ($stock < ($qty * $item['quantity'])) {
					echo json_encode(['status' => 'error', 'message' => 'Not enough stock for product: ' . $item['item_id']]);
					return;
				}
			}
					$data = [
						'orderno' => $order_id,
						'date' => date('Y-m-d'),
						'store_id' => $store_id,
						'product_id' => $product_id,
						'quantity' => $qty,
						'vat_id' => $productDetails[0]['vat_id'],
						'rate' => $this->input->post('rate'),
						'tax' => $this->input->post('tax'),
						'tax_amount' => $this->input->post('tax_amount'),
						'total_amount' => $this->input->post('total_amount'),
						'item_remarks' => $product['recipe'] ?? null,
						'variant_id' => $this->input->post('variant_id') ?? null,
						'category_id' => $productDetails[0]['category_id'], // optional timestamp
						'is_addon' => $productDetails[0]['is_addon'],
						'is_customisable' => $productDetails[0]['is_customizable'],
						'table_id' => $this->Ordermodel->getOrderTableId($order_id),
						'order_type' => 'D',
						'is_paid' => 0,
						'is_reorder' => 1
					];
					//print_r($data);exit;
					$this->db->insert('order_items', $data);
					$this->Ordermodel->changeOrderStatus($order_id,0);

					$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
						$data = [
							'amount' => $updatedTotalAmt[0]['total_rate'],
							'tax_amount' => $updatedTotalAmt[0]['total_tax'],
							'total_amount' => $updatedTotalAmt[0]['total_amount']
								];
							$this->db->where('orderno', $order_id);
							$this->db->update('order', $data);

							echo json_encode(['status' => 'success', 'table_id' => $this->Ordermodel->getOrderTableId($order_id)]);

		}
		else
		{
				$availableStock = $this->Ordermodel->getCurrentStock($product_id , $date , $store_id);
				if ($availableStock < $qty) {
					echo json_encode(['status' => 'error', 'message' => 'Not enough stock']);
				}
				else
				{
					$data = [
						'orderno' => $order_id,
						'date' => date('Y-m-d'),
						'store_id' => $store_id,
						'product_id' => $product_id,
						'quantity' => $qty,
						'vat_id' => $productDetails[0]['vat_id'],
						'rate' => $this->input->post('rate'),
						'tax' => $this->input->post('tax'),
						'tax_amount' => $this->input->post('tax_amount'),
						'total_amount' => $this->input->post('total_amount'),
						'item_remarks' => $product['recipe'] ?? null,
						'variant_id' => $this->input->post('variant_id') ?? null,
						'category_id' => $productDetails[0]['category_id'], // optional timestamp
						'is_addon' => $productDetails[0]['is_addon'],
						'is_customisable' => $productDetails[0]['is_customizable'],
						'table_id' => $this->Ordermodel->getOrderTableId($order_id),
						'order_type' => 'D',
						'is_paid' => 0,
						'is_reorder' => 1
					];
					//print_r($data);exit;
					$this->db->insert('order_items', $data);
					$this->Ordermodel->changeOrderStatus($order_id,0);
					$updatedTotalAmt = $this->Ordermodel->updateTotalAmount($order_id);
						$data = [
							'amount' => $updatedTotalAmt[0]['total_rate'],
							'tax_amount' => $updatedTotalAmt[0]['total_tax'],
							'total_amount' => $updatedTotalAmt[0]['total_amount']
								];
							$this->db->where('orderno', $order_id);
							$this->db->update('order', $data);

							echo json_encode(['status' => 'success', 'table_id' => $this->Ordermodel->getOrderTableId($order_id)]);
				}
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
    /**
     * Save a new order with details provided from the POST request.
     *
     * This function retrieves order details from the POST request, such as order ID, store ID,
     * product ID, and quantity. It then fetches product details and constructs an associative array
     * representing the order item. The order item is inserted into the 'order_items' table.
     *
     * If an order already exists with the given order ID, it updates the total amount, tax amount,
     * and amount fields in the 'order' table. Otherwise, it calculates the total amounts from the
     * order items and inserts a new entry into the 'order' table with additional order information
     * such as customer name, contact number, and location if available.
     */



    public function getOrderByDate() {
        $this->load->model('owner/Ordermodel');
		$UnPaidorders = $this->Ordermodel->getUnPaidOrderByDate($this->input->post('date') , $this->input->post('tableId'));
        $orders = $this->Ordermodel->getPaidOrderByDate($this->input->post('date') , $this->input->post('tableId'));
        if (empty($orders) && empty($UnPaidorders)) {
			echo "<div class='alert alert-danger' role='alert'>No orders found for the selected date.</div>";
			return;
		}

		$accordionHtml = '';



		// Build accordion HTML
		$accordionHtml .= '<div class="accordion"><h5 class="text-center">Completed Orders</h5><hr>';

		foreach ($orders as $index => $order) {
			$isFirst = $index === 0 ? ' ' : ''; // Keep the first accordion open
			$accordionHtml .= '
				<div class="accordion-item">
					<h2 class="accordion-header" id="heading' . $order['id'] . '">
						<button class="accordion-button' . ($index !== 0 ? ' collapsed' : '') . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $order['id'] . '" aria-expanded="' . ($index === 0 ? 'true' : 'false') . '" aria-controls="collapse' . $order['id'] . '">
							' . $index + 1 . ' : Order No: ' . $order['orderno'] . ' - Amount: ' . $order['total_amount'] - $order['tax_amount'] .  ' - Vat: ' . $order['tax_amount'] . ' - Total: ' . $order['total_amount'] . '
						</button>
					</h2>
					<div id="collapse' . $order['id'] . '" class="accordion-collapse collapse' . $isFirst . '" aria-labelledby="heading' . $order['id'] . '" data-bs-parent="#ordersAccordion">

					<div class="accordion-body">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th width="25%">Product</th>
					<th width="10%">Quantity</th>
					<th width="10%">Rate</th>
					<th width="10%">Amount</th>
					<th width="5%">Vat(%)</th>
					<th width="10%">Vat-Amt</th>
					<th width="10%">Total-Amt</th>
					<th width="10%">Is Addon</th>
					<th width="20%">Recipe Details</th>
                </tr>
            </thead>
            <tbody>';
foreach ($order['items'] as $key => $item) {
    $accordionHtml .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $this->Ordermodel->getProductName($item['product_id']) . '</td>
					<td>' . $item['quantity'] . '</td>
					<td>' . $item['rate'] . '</td>
					<td>' . $item['rate'] * $item['quantity'] . '</td>
					<td>' . $item['tax'] . '</td>
					<td>' . $item['tax_amount'] . '</td>
					<td>' . $item['total_amount'] . '</td>
					<td><input type="checkbox" class="form-check-input" disabled name="orders[' . $index . '][is_addon]" value="1" ' . ($item['is_addon'] == 1 ? 'checked' : '') . '></td>
                    <td>' . $item['item_remarks'] . '</td>
                </tr>';
}
$accordionHtml .= '
            </tbody>
        </table>
    </div>
</div>

					</div>
				</div>';
		}
		$accordionHtml .= '</div>';

		echo $accordionHtml;
    }






	public function getPickupOrderDetails() {
		// echo "here" ;
        $this->load->model('owner/Ordermodel');
        $pickuporder = $this->Ordermodel->getPickupOrderDetails($this->input->post('orderId'));
		// print_r($pickuporder);exit;
        if (empty($pickuporder)) {
			echo "<p>No orders found for the selected datee.</p>";
			return;
		}

		$accordionHtml = '';


		$total_amount = 0;

		$accordionHtml = '<form method="post" action="' . base_url('owner/order/update') . '">
		<input type="hidden" name="store_id" value="' . $this->session->userdata('logged_in_store_id') . '">
		<input type="hidden" name="order_id" value="' . $this->input->post('orderId') . '">
		<div class="table-responsive">
		<table class="table">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th width="25%">Product</th>
					<th width="10%">Quantity</th>
					<th width="10%">Rate</th>
					<th width="10%">Amount</th>
					<th width="5%">Vat(%)</th>
					<th width="10%">Vat-Amt</th>
					<th width="10%">Total-Amt</th>
					<th width="10%">Is Addon</th>
					<th width="20%">Recipe Details</th>
                </tr>
            </thead>
            <tbody>';
		foreach ($pickuporder as $index => $order) {
			$accordionHtml .= '
                <tr>
                    <td>' . $index + 1 . '</td>
                    <td>' . $this->Ordermodel->getProductName($order['product_id']) . '</td>
					<td>
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][tax]" value="' . $order['tax'] . '">
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][id]" value="' . $order['id'] . '">
	<input type="hidden" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][product_id]" value="' . $order['product_id'] . '">
					<input type="text" class="quantity form-control" name="orders[' . $index . '][quantity]" style="width: 100%;" value="' . $order['quantity'] . '" />
					</td>
					<td><input type="text" readonly class="form-control" style="width: 100%;" name="orders[' . $index . '][rate]" value="' . $order['rate'] . '"></td>
					<td>' . $order['rate'] * $order['quantity'] . '</td>
					<td>' . $order['tax'] . '</td>
					<td>' . $order['tax_amount'] . '</td>
					<td>' . $order['total_amount'] . '</td>
					<td><input type="checkbox" class="form-check-input" disabled name="orders[' . $index . '][is_addon]" value="1" ' . ($order['is_addon'] == 1 ? 'checked' : '') . '></td>
                    <td>' . $order['item_remarks'] . '</td>
                </tr>';
				$item_total = $order['quantity'] * $order['total_amount'];
        		$total_amount += $item_total;
		}
		$accordionHtml .= '</tbody>
		<tfoot class="table-light">
                <tr>
				<td colspan="3">
                        <div class="d-flex justify-content-left">
                            <label class="btn text-black bg-b-cyan" width="100px" style="margin-right: 10px;">Order No : '.$order['orderno'].'</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-secondary" name="approve" width="100px" style="margin-right: 10px;">Approve</button>
                            <button class="btn btn-info" name="pay" width="100px" style="margin-right: 10px;">Paid</button>
							<button class="btn btn-info" name="pay" width="100px" style="margin-right: 10px;">Delete</button>

                        </div>
                    </td>
					<td colspan="6">
                        <div class="d-flex justify-content-end">
							<button class="btn btn-danger" style="margin-right: 10px;">Total Amount : ' . $total_amount . '</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table></form>
		</div>';

		echo $accordionHtml;
    }





//MARK: pickup orders
	public function getOrdersByType() {
		$this->load->model('owner/Ordermodel');
		$logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		// print_r($role_id);
		$user_id = $this->session->userdata('loginid'); // Loged in user id
		// print_r($user_id);
		$tableid = 0;
		$suppliers = $this->Ordermodel->getsuppliersByType($logged_in_store_id, $this->input->post('order_type'));
		// print_r($suppliers);
		$orders=$this->Ordermodel->getOrdersByType($this->session->userdata('logged_in_store_id') , $this->input->post('order_type'),$this->session->userdata('loginid'),);

		// print_r($orders);

		// print_r($orders);exit;
		$deliveryBoys=$this->Ordermodel->getDeliveryBoysByStoreID($this->session->userdata('logged_in_store_id'));
		$kot_enable = $this->Ordermodel->getKotEnabledStatus($this->session->userdata('logged_in_store_id'));

		$accordionHtml = '';

		if (!empty($orders)) {

			// Build accordion HTML
			$accordionHtml .= '';

			foreach ($orders as $index => $order) {
				$isFirst = $index === 0 ? ' ' : ''; // Keep the first accordion open
				$selectedDeliveryBoy = $order['delivery_boy'];
				// print_r($selectedDeliveryBoy);
				$accordionHtml .= '<form>
				<input type="hidden" name="product_name" value="'.$order['orderno'].'">
				<input type="hidden" id="order_type" name="order_type" value="'.$this->input->post('order_type').'">
					<div class="accordion-item">
						<h2 class="accordion-header" id="heading' . $order['id'] . '" style="overflow-x: auto;
    white-space: nowrap;">
							<button style="background:#eeeef9" class="accordion-button' . ($index !== 0 ? ' collapsed' : '') . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $order['id'] . '" aria-expanded="' . ($index === 0 ? 'true' : 'false') . '" aria-controls="collapse' . $order['id'] . '">
								' . $index + 1 . ' . <strong>ORDER NUMBER : </strong> ' . $order['orderno'] .' ,  <strong> NAME:</strong> '. $order['customer_name'] .', <strong> PHONE:</strong> '. $order['contact_number'] .
								' , <strong>AMOUNT:</strong> <span id="order-amount-'.$order['orderno'].'">' . $order['total_amount'] - $order['tax_amount'] .
								' ,</span> <strong>VAT : </strong> <span class="tax">' . $order['tax'] .
								' ,</span> <strong>TOTAL : </strong> <span id="order-amount-include-tax-'.$order['orderno'].'">' . round($order['total_amount'], 2) . '
							</span></button>
						</h2>
						<div id="collapse' . $order['orderno'] . '" class="accordion-collapse collapse show' . $isFirst . '" aria-labelledby="heading' . $order['id'] . '" data-bs-parent="#ordersAccordion" style="overflow:scroll">

						<div class="accordion-body product-item">
			<table class="delivery-pickup-orders table">
				<thead>
					<tr>
						<th>Sl</th>
<th>Product</th>
<th>Quantity</th>
<th>Rate</th>
<th>Amount</th>
<th>Total-Amt</th>
<th>Is Addon</th>
<th>Recipe Details</th>
					</tr>
				</thead>
				<tbody>';
				foreach ($order['items'] as $key => $item) {
					$total_amount = 0;
					$backgroundColor = '#ffffff'; // Default color
					$deleted_entry_button_disable = '';
					if ($item['is_delete'] == 1)
					{
						$backgroundColor = '#f8d7da'; // Red color Deleted item color
						$deleted_entry_button_disable = 'disabled'; // If deleted entry buttons should be disable
					}
					elseif ($item['is_reorder'] == 1)
					{
						$backgroundColor = '#86d7cf'; // Green color Reordered item color
					}

					$display_none = $order['order_status'] > 2 ? 'd-none' : ''; //If order status till ready can delete after ready cannot delete
					$disabled = $order['order_status'] > 2 ? 'disabled' : ''; //If order status till ready can change qty after ready cannot change
					$check_approve_order_exist = $this->Ordermodel->check_approve_order_exist($order['orderno']);
					$display_none_order_delete = $check_approve_order_exist == 1 ? 'd-none' : '';
					$productName = $this->Ordermodel->getProductName($item['product_id']);
					$variantName = $this->Ordermodel->getVariantName($item['variant_id']);
					$variant_id = isset($item['variant_id']) ? $item['variant_id'] : 0;
					$variantValue = $this->Ordermodel->getVariantValue($variant_id, $item['product_id']);
					$variantValue = $variantValue ? $variantValue : 1;

					$accordionHtml .= '
							<tr id="order-row-' . $item['id'] . '" style="background-color: ' . $backgroundColor . ';">
								<td>' . ($key + 1) . '</td>
								<td style="width:200px;">' .
						$productName .
						($variantName != null ? ' (' . $variantName . ')' : '') .
					'</td>
								<td style="width:120px;">
								<input type="hidden" class="form-control variant_value" style="width: 100%;" value="' . $variantValue . '">
								<input type="hidden" class="form-control tax" style="width: 100%;" value="' . $item['tax'] . '">
								<input type="hidden" class="form-control id" style="width: 100%;" value="' . $item['id'] . '">
								<input type="hidden" class="form-control store_product_id" style="width: 100%;" value="' . $item['product_id'] . '">
								<div class="input-group" style="width:100;">
						<button class="btn btn-danger decrement" data-variant_value="' . $variantValue . '" data-tax="' . $item['tax'] . '" data-orderstatus="'.$order['order_status'].'" data-orderno="'.$order['orderno'].'" data-rate="' . $item['rate'] . '" data-id="' . $item['id'] . '" data-product-id="' . $item['product_id'] . '" type="button" ' . $disabled . '>-</button>
						<input type="text" class="form-control text-center quantity" name="quantity" value="'.$item['quantity'].'" min="1" readonly>
						<button class="btn btn-danger increment" data-variant_value="' . $variantValue . '" data-tax="' . $item['tax'] . '" data-orderstatus="'.$order['order_status'].'" data-orderno="'.$order['orderno'].'" data-rate="' . $item['rate'] . '" data-id="' . $item['id'] . '" data-product-id="' . $item['product_id'] . '" type="button" ' . $disabled . '>+</button>
					     </div>
								</td>

								<td style="width:80px;"><input type="text" disabled class="form-control rate" style="width: 100%;" value="' . $item['rate'] . '"></td>
								<td class="amount">' . $item['rate'] * $item['quantity'] . '</td>
								<td class="total-amount">' . $item['total_amount'] . '</td>
								<td><input type="checkbox" class="form-check-input" disabled name="is_addon" value="1" ' . ($item['is_addon'] == 1 ? 'checked' : '') . '></td>
								<td style="width:150px;">' . $item['item_remarks'] . '</td>
								<td><input type="hidden" class="'.$item['product_id'].'total_stock" value="'.$item['quantity'] * $item['variant_value'].'"></td>
								<td class="d-flex gap-2">
								<button type="button" '.$deleted_entry_button_disable.' class="btn btn-danger delete-order ' . $display_none . '" data-id="' . $item['id'] . '" data-status="' . $order['order_status'] . '" data-quantity="' . $item['quantity'] . '">Delete</button>
								<button type="button" class="btn btn-secondary return-order" '.$deleted_entry_button_disable.' data-variant-id='.$variant_id.' data-order-id='.$order['orderno'].' data-item-id="' . $item['product_id'] . '" data-qty="' . $item['quantity'] . '" data-order-item-id="' . $item['id'] . '" data-item="' .
						$productName .
						($variantName != null ? ' (' . $variantName . ')' : '') . '">Return</button>
								</td>

						</tr>';

							$item_total = $item['quantity'] * $item['total_amount'];
							$total_amount += $item_total;
				}




				$approveOrderClass = ($order['order_status'] == 0) ? 'btn8-small approve_order' : 'btn6-small approve_order ';
				$payOrderClass = ($order['order_status'] == 4) ? 'btn8-small pay_order' : 'btn6-small pay_order ';

	$accordionHtml .= '</tbody>

		<tfoot class="table-light">

                <tr>
					<td colspan="1">';


						$accordionHtml .= '<button class="btn btn-success dropdown-toggle" type="button" id="orderStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">';
						$accordionHtml .= (($order['order_status'] == "0") ? "Pending" : (($order['order_status'] == "1") ? "Approved" : (($order['order_status'] == "2") ? "Cooking" : (($order['order_status'] == "3") ? "Ready" :(($order['order_status'] == "4") ? "Out For Delivery" : "Select Status")))));
						$accordionHtml .= '</button>';

//MARK: supplier Boy

$accordionHtml .= '<td colspan="1">';
$accordionHtml .= '<td colspan="3">';



if ($role_id == 1 || $role_id == 2) {
    // Admins → selectable dropdown
    $accordionHtml .= '<select class="form-select delivery_boyy"
                            data-order-id="' . $order['orderno'] . '"
                            id="delivery_boyy">';
    $accordionHtml .= '<option value="">Select supplier</option>';

    foreach ($suppliers as $item) {
        $selected = ($item['userid'] == $order['approved_by']) ? 'selected' : '';
        $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>'
                        . htmlspecialchars($item['Name']) . '</option>';
    }

    $accordionHtml .= '</select>';
} else {
    // Non-admins → read-only dropdown
    $accordionHtml .= '<select class="form-select delivery_boyy" disabled name="assigned_supplier">';
    foreach ($suppliers as $item) {
		$selectedUserId = !empty($order['approved_by']) ? $order['approved_by'] : $user_id;
        $selected = ($item['userid'] == $selectedUserId) ? 'selected' : '';
        $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>'
                        . htmlspecialchars($item['Name']) . '</option>';
    }
    $accordionHtml .= '</select>';
}



$accordionHtml .= '</td>';



if ($this->input->post('order_type') == 'DL') {

if ($order['order_status'] == 3) {
$accordionHtml .= '<td colspan="2"><select class="form-select delivery_boy" data-order-id="' . $order['orderno'] . '"
        id="delivery_boy">';
        $accordionHtml .= '<option value="">Select Delivery Boy</option>';

        foreach ($deliveryBoys as $item) {
        $selected = ($item['userid'] == $selectedDeliveryBoy) ? 'selected' : '';
        $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>' . $item['Name'] . '</option>';
        }

        $accordionHtml .= '</select></td>';
}
}


$accordionHtml .= '<td colspan="3">
    <div class="d-flex justify-content-center">
        <!--<button data-bs-toggle="modal" data-id="2" data-name="fgdfg" data-bs-target="#recipe" class="btn btn-secondary add_order_item" name="approve" width="100px" style="margin-right: 10px;">Add</button>-->
        <button type="button" class="'.$approveOrderClass.'" data-order-id="' . $order['orderno'] . '"
            data-kot-enable="'.$kot_enable.'" '.(($order['approved_by'] && $order['is_reorder'] !=1) ||
            $order['order_status']==1 ? 'disabled' : '' ).'>Approve</button>

        <button class="'.$payOrderClass.' d-none" data-order-id="' . $order['orderno'] . '" width="100px"
            style="margin-left: 10px;">Pay</button>
        <button type="button" data-bs-toggle="modal" data-id="2" data-name="fgdfg" data-bs-target="#printModal"
            data-order-id="' . $order['orderno'] . '" class="btn6-small pay_order_print" width="100px"
            style="margin-left: 10px;">Print</button>
        <a class="btn6-small ' . $display_none_order_delete . ' delete-full-order"
            data-order-id="' . $order['orderno'] . '" width="100px" style="margin-left: 10px;">Delete</a>
    </div>
</td>
<td colspan="6">
    <div class="d-flex justify-content-end">
        <button class="btn6-small" id="order-amount-include-tax-footer-'.$order['orderno'].'"
            style="margin-right: 10px;">Total : ' . round($order['total_amount'], 2) . '</button>
    </div>
</td>
</tr>
<tr class="msgContainer'.$order['orderno'].' d-none">
    <td colspan="12">
        <div class="alert alert-success dark d-none" role="alert" id="ordermsg'.$order['orderno'].'">Order</div>
    </td>
</tr>
</tfoot>
</table>
</form>
</div>';
$accordionHtml .= '
</tbody>
</table>
</div>
</div>

</div>



<div class="modal fade" id="recipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body tt">
                <iframe id="table_iframe_recipe1" height="600px" width="100%"></iframe>
            </div>
        </div>
    </div>
</div>


</div>';
}
$accordionHtml .= '</div>';



echo $accordionHtml;
}
else
{
echo "<div class='alert alert-danger' role='alert'>No orders!</div>";
}
}





public function getPendingOrdersByTableID() {
$this->load->model('owner/Ordermodel');
$logged_in_store_id = $this->session->userdata('logged_in_store_id');
$data['role_id'] = $this->session->userdata('roleid'); // Role id of logged in user
$data['user_id'] = $this->session->userdata('loginid'); // Logged in user id
$tableid = $this->input->post('table_id');
$suppliers = $this->Ordermodel->getsuppliers($logged_in_store_id, $tableid);
$data['orders'] = $this->Ordermodel->getPendingOrdersByTableId($logged_in_store_id, $tableid);
$data['kot_enable'] = $this->Ordermodel->getKotEnabledStatus($logged_in_store_id);
$this->load->view('owner/order/pending_orders_by_table', $data);

// $accordionHtml = '';
// 		if (!empty($orders)) {
// 			// Build accordion HTML
// 			$accordionHtml .= '';
// 			foreach ($orders as $index => $order) {
// 				$isFirst = $index === 0 ? ' ' : ''; // Keep the first accordion open
// 				$selectedDeliveryBoy = $order['delivery_boy'];
// 				// print_r($selectedDeliveryBoy);
// 				$accordionHtml .= '<form>
// 				<input type="hidden" name="product_name" value="'.$order['orderno'].'">

// 					<div class="accordion-item">
// 						<h2 class="accordion-header" id="heading' . $order['id'] . '"  style="overflow-x: auto;
//     white-space: nowrap;">
// 							<button style="background:#eeeef9" class="accordion-button' . ($index !== 0 ? ' collapsed' : '') . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $order['id'] . '" aria-expanded="' . ($index === 0 ? 'true' : 'false') . '" aria-controls="collapse' . $order['id'] . '">
// 								' . $index + 1 . ' : <strong>ORDER NUMBER : </strong> ' . $order['orderno'] . '
// 								<strong>, AMOUNT : </strong> <span id="order-amount-'.$order['orderno'].'">' . $order['total_amount'] - $order['tax_amount'] .
// 								'</span> <strong>, VAT : </strong> <span class="tax">' . $order['tax'] . '</span> <strong>, TOTAL : </strong> <span id="order-amount-include-tax-'.$order['orderno'].'">' . round($order['total_amount'], 2) . '
// 							</span></button>
// 						</h2>
// 						<div id="collapse' . $order['orderno'] . '" class="accordion-collapse collapse show' . $isFirst . '" aria-labelledby="heading' . $order['id'] . '" data-bs-parent="#ordersAccordion" style="overflow: scroll;">

// 			 <div class="accordion-body product-item">
// 			<table class="pending-table-orders-restaurant table pending-orders-by-table-id">
// 				<thead>
// 					<tr>
// 						<th>Sl</th>
// <th>Product</th>
// <th>Quantity</th>
// <th>Rate</th>
// <th>Amount</th>
// <th>Total-Amt</th>
// <th>Is Addon</th>
// <th>Recipe Details</th>
// 					</tr>
// 				</thead>
// 				<tbody>';
// 				foreach ($order['items'] as $key => $item) {
// 					$total_amount = 0;
// 					$backgroundColor = '#ffffff'; // Default color
// 					$deleted_entry_button_disable = '';
// 					if ($item['is_delete'] == 1)
// 					{
// 						$backgroundColor = '#f8d7da'; // Red color Deleted item color
// 						$deleted_entry_button_disable = 'disabled'; // If deleted entry buttons should be disable
// 					}
// 					elseif ($item['is_reorder'] == 1)
// 					{
// 						$backgroundColor = '#86d7cf'; // Green color Reordered item color
// 					}

// 					$display_none = $order['order_status'] > 2 ? 'd-none' : ''; //If order status till ready can delete after ready cannot delete
// 					$disabled = $order['order_status'] > 2 ? 'disabled' : ''; //If order status till ready can change qty after ready cannot change
// 					// print_r($order['order_status']);
// 					$check_approve_order_exist = $this->Ordermodel->check_approve_order_exist($order['orderno']);
// 					$display_none_order_delete = $check_approve_order_exist == 1 ? 'd-none' : '';
// 					$productName = $this->Ordermodel->getProductName($item['product_id']);
// 					$variantName = $this->Ordermodel->getVariantName($item['variant_id']);
// 					$variant_id = isset($item['variant_id']) ? $item['variant_id'] : 0;
// 					$variantValue = $this->Ordermodel->getVariantValue($variant_id, $item['product_id']);
// 					$variantValue = $variantValue ? $variantValue : 1;

// 					$accordionHtml .= '
// 							<tr id="order-row-' . $item['id'] . '" style="background-color: ' . $backgroundColor . ';">
// 								<td>' . ($key + 1) . '</td>
// 								<td style="width:200px;">' .
// 						$productName .
// 						($variantName != null ? ' (' . $variantName . ')' : '') .
// 					'</td>
// 								<td style="width:120px;">
// 								<input type="hidden" class="form-control variant_value" style="width: 100%;" value="' . $variantValue . '">
// 					<input type="hidden" class="form-control tax" style="width: 100%;" value="' . $item['tax'] . '">
// 					<input type="hidden" class="form-control id" style="width: 100%;" value="' . $item['id'] . '">
// 					<input type="hidden" class="form-control store_product_id" style="width: 100%;" value="' . $item['product_id'] . '">
// 						<div class="input-group" style="width:100">
// 						<button class="btn btn-danger decrement" data-variant_value="' . $variantValue . '" data-tax="' . $item['tax'] . '" data-orderstatus="'.$order['order_status'].'" data-orderno="'.$order['orderno'].'" data-rate="' . $item['rate'] . '" data-id="' . $item['id'] . '" data-product-id="' . $item['product_id'] . '" type="button" ' . $disabled . '>-</button>
// 						<input type="text" class="form-control text-center quantity" name="quantity" value="'.$item['quantity'].'" min="1" readonly>
// 						<button class="btn btn-danger increment" data-variant_value="' . $variantValue . '" data-tax="' . $item['tax'] . '" data-orderstatus="'.$order['order_status'].'" data-orderno="'.$order['orderno'].'" data-rate="' . $item['rate'] . '" data-id="' . $item['id'] . '" data-product-id="' . $item['product_id'] . '" type="button" ' . $disabled . '>+</button>
// 					    </div>
// 								</td>

// 								<td style="width:80px;"><input type="text" disabled class="form-control rate" style="width: 100%;" value="' . $item['rate'] . '"></td>
// 								<td class="amount">' . $item['rate'] * $item['quantity'] . '</td>
// 								<td class="total-amount">' . $item['total_amount'] . '</td>
// 								<td><input type="checkbox" class="form-check-input" disabled name="is_addon" value="1" ' . ($item['is_addon'] == 1 ? 'checked' : '') . '></td>
// 								<td style="width:150px;">' . $item['item_remarks'] . '</td>
// 								<td><input type="hidden" class="'.$item['product_id'].'total_stock" value="'.$item['quantity'] * $item['variant_value'].'"></td>
// 								<td class="d-flex gap-2">
// 								<button type="button" '.$deleted_entry_button_disable.' class="btn btn-danger delete-order ' . $display_none . '" data-id="' . $item['id'] . '" data-status="' . $order['order_status'] . '" data-quantity="' . $item['quantity'] . '">Delete</button>
// 								<button type="button" class="btn btn-secondary return-order" '.$deleted_entry_button_disable.' data-variant-id='.$variant_id.' data-order-id='.$order['orderno'].' data-item-id="' . $item['product_id'] . '" data-qty="' . $item['quantity'] . '" data-order-item-id="' . $item['id'] . '" data-item="' .
// 						$productName .
// 						($variantName != null ? ' (' . $variantName . ')' : '') . '">Return</button>
// 								</td>

// 						</tr>';

// 							$item_total = $item['quantity'] * $item['total_amount'];
// 							$total_amount += $item_total;
// 				}




// 				$approveOrderClass = ($order['order_status'] == 0) ? 'btn8-small approve_table_order' : 'btn6-small approve_table_order ';
// 				$payOrderClass = ($order['order_status'] == 4) ? 'btn8-small pay_order' : 'btn6-small pay_order ';

// 	$accordionHtml .= '</tbody>

// 		<tfoot class="table-light">

//                 <tr>
// 					<td colspan="1">';


// 						$accordionHtml .= '<button class="btn btn-success dropdown-toggle" type="button" id="orderStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">';
// 						$accordionHtml .= (($order['order_status'] == "0") ? "Pending" : (($order['order_status'] == "1") ? "Approved" : (($order['order_status'] == "2") ? "Cooking" : (($order['order_status'] == "3") ? "Ready" :(($order['order_status'] == "4") ? "Out For Delivery" : "Select Status")))));
// 						$accordionHtml .= '</button>';

// //MARK: supplier Boy

// $accordionHtml .= '<td colspan="1">';
// $accordionHtml .= '<td colspan="3">';



// if ($role_id == 1 || $role_id == 2) {
//     // Admins → selectable dropdown
//     $accordionHtml .= '<select class="form-select delivery_boy"
//                             data-order-id="' . $order['orderno'] . '"
//                             id="delivery_boy">';
//     $accordionHtml .= '<option value="">Select supplier</option>';

//     foreach ($suppliers as $item) {
//         $selected = ($item['userid'] == $order['approved_by']) ? 'selected' : '';
//         $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>'
//                         . htmlspecialchars($item['Name']) . '</option>';
//     }

//     $accordionHtml .= '</select>';
// } else {
//     // Non-admins → read-only dropdown
//     $accordionHtml .= '<select class="form-select delivery_boy" disabled name="assigned_supplier">';
//     foreach ($suppliers as $item) {
// 		$selectedUserId = !empty($order['approved_by']) ? $order['approved_by'] : $user_id;
//         $selected = ($item['userid'] ==   $selectedUserId) ? 'selected' : '';
//         $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>'
//                         . htmlspecialchars($item['Name']) . '</option>';
//     }
//     $accordionHtml .= '</select>';
// }



// $accordionHtml .= '</td>';



// if ($this->input->post('order_type') == 'DL') {

// if ($order['order_status'] == 3) {
// $accordionHtml .= '<td colspan="2"><select class="form-select delivery_boy" data-order-id="' . $order['orderno'] . '"
//         id="delivery_boy">';
//         $accordionHtml .= '<option value="">Select Delivery Boy</option>';

//         foreach ($deliveryBoys as $item) {
//         $selected = ($item['userid'] == $selectedDeliveryBoy) ? 'selected' : '';
//         $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>' . $item['Name'] . '</option>';
//         }

//         $accordionHtml .= '</select></td>';
// }
// }


// $accordionHtml .= '<td colspan="3">
//     <div class="d-flex justify-content-center">
//         <!--<button data-bs-toggle="modal" data-id="2" data-name="fgdfg" data-bs-target="#recipe" class="btn btn-secondary add_order_item" name="approve" width="100px" style="margin-right: 10px;">Add</button>-->
//         <button type="button" class="'.$approveOrderClass.'" data-order-id="' . $order['orderno'] . '"
//             data-kot-enable="'.$kot_enable.'" '.(($order['approved_by'] && $order['is_reorder'] !=1) ||
//             $order['order_status']==1 ? 'disabled' : '' ).'>Approve</button>

//         <button class="'.$payOrderClass.' d-none" data-order-id="' . $order['orderno'] . '" width="100px"
//             style="margin-left: 10px;">Pay</button>
//         <button type="button" data-bs-toggle="modal" data-id="2" data-name="fgdfg" data-bs-target="#printModal"
//             data-order-id="' . $order['orderno'] . '" class="btn6-small pay_order_print" width="100px"
//             style="margin-left: 10px;">Print</button>
//         <a class="btn6-small ' . $display_none_order_delete . ' delete-full-order"
//             data-order-id="' . $order['orderno'] . '" width="100px" style="margin-left: 10px;">Delete</a>
//     </div>
// </td>
// <td colspan="6">
//     <div class="d-flex justify-content-end">
//         <button class="btn6-small" id="order-amount-include-tax-footer-'.$order['orderno'].'"
//             style="margin-right: 10px;">Total : ' . round($order['total_amount'], 2) . '</button>
//     </div>
// </td>
// </tr>
// <tr class="msgContainer'.$order['orderno'].' d-none">
//     <td colspan="12">
//         <div class="alert alert-success dark d-none" role="alert" id="ordermsg'.$order['orderno'].'">Order</div>
//     </td>
// </tr>
// </tfoot>
// </table>
// </form>
// </div>';
// $accordionHtml .= '
// </tbody>
// </table>
// </div>
// </div>

// </div>



// <div class="modal fade" id="recipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
//     <div class="modal-dialog modal-xl">
//         <div class="modal-content">
//             <div class="modal-header">
//                 <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span></h1>
//                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//             </div>
//             <div class="modal-body tt">
//                 <iframe id="table_iframe_recipe1" height="600px" width="100%"></iframe>
//             </div>
//         </div>
//     </div>
// </div>


// </div>';
// }
// $accordionHtml .= '</div>';



// echo $accordionHtml;
// } else {
// echo "<div class='alert alert-danger' role='alert'>No orders!</div>";
// }
}


//MARK: table orders





public function getPendingOrdersByRoomID() {
$this->load->model('owner/Ordermodel');
$orders=$this->Ordermodel->getPendingOrdersByRoomId($this->session->userdata('logged_in_store_id') ,
$this->input->post('table_id'));
// print_r($orders);exit;
$role_id = $this->session->userdata('roleid'); // Role id of logged in user
$user_id = $this->session->userdata('loginid'); // Logged in user id
$tableid = $this->input->post('table_id');
$suppliers = $this->Ordermodel->getsuppliers($this->session->userdata('logged_in_store_id'), $tableid);
// print_r($orders);exit;
$kot_enable = $this->Ordermodel->getKotEnabledStatus($this->session->userdata('logged_in_store_id'));
$accordionHtml = '';

// Build accordion HTML
if(!empty($orders)){

$accordionHtml .= '';

foreach ($orders as $index => $order) {
$isFirst = $index === 0 ? ' ' : ''; // Keep the first accordion open
$accordionHtml .= '<form>
    <input type="hidden" name="product_name" value="'.$order['orderno'].'">
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading' . $order['id'] . '" style="overflow-x: auto;
    white-space: nowrap;">
            <button style="background:#eeeef9" class="accordion-button' . ($index !== 0 ? ' collapsed' : '') . '"
                type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $order['id'] . '"
                aria-expanded="' . ($index === 0 ? 'true' : 'false') . '" aria-controls="collapse' . $order['id'] . '">
                ' . $index + 1 . ' : <strong>ORDER NUMBER : </strong> ' . $order['orderno'] . ' <strong>, AMOUNT : </strong> <span
                    id="order-amount-'.$order['orderno'].'">' . $order['total_amount'] - $order['tax_amount'] . '</span>
                <strong>, VAT : </strong> <span class="tax">' . $order['tax'] . '</span> <strong>, TOTAL : </strong> <span
                    id="order-amount-include-tax-'.$order['orderno'].'">' . round($order['total_amount'], 2) . '
                </span></button>
        </h2>

        <div id="collapse' . $order['orderno'] . '" class="accordion-collapse collapse show' . $isFirst . '"
            aria-labelledby="heading' . $order['id'] . '" data-bs-parent="#ordersAccordion" style="overflow: scroll;">

            <div class="accordion-body product-item">
                <table class="pending-room-orders-restaurant table order_details_table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Total-Amt</th>
                            <th>Is Addon</th>
                            <th>Recipe Details</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($order['items'] as $key => $item) {


                        $total_amount = 0;
                        $backgroundColor = '#ffffff'; // Default color
                        $deleted_entry_button_disable = '';
                        if ($item['is_delete'] == 1)
                        {
                        $backgroundColor = '#f8d7da'; // Red color Deleted item color
                        $deleted_entry_button_disable = 'disabled'; // If deleted entry buttons should be disable
                        }
                        elseif ($item['is_reorder'] == 1)
                        {
                        $backgroundColor = '#86d7cf'; // Green color Reordered item color
                        }
                        $display_none = $order['order_status'] > 2 ? 'd-none' : ''; //If order status till ready can
                        //delete after ready cannot delete
                        $disabled = $order['order_status'] > 2 ? 'disabled' : ''; //If order status till ready can
                        // change qty after ready cannot change
                        $check_approve_order_exist = $this->Ordermodel->check_approve_order_exist($order['orderno']);
                        $display_none_order_delete = $check_approve_order_exist == 1 ? 'd-none' : '';
                        $productName = $this->Ordermodel->getProductName($item['product_id']);
                        $variantName = $this->Ordermodel->getVariantName($item['variant_id']);
                        $variant_id = isset($item['variant_id']) ? $item['variant_id'] : 0;
                        $variantValue = $this->Ordermodel->getVariantValue($variant_id, $item['product_id']);
                        $variantValue = $variantValue ? $variantValue : 1;
                        $accordionHtml .= '
                        <tr id="order-row-' . $item['id'] . '" style="background-color: ' . $backgroundColor . ';">
                            <td>' . $key + 1 . '</td>
                            <td style="width:200px;">' .
                                $productName .
                                ($variantName != null ? ' (' . $variantName . ')' : '') .
                                '</td>
                            <td style="width:120px;">
                                <input type="hidden" class="form-control variant_value" style="width: 100%;"
                                    value="' . $variantValue . '">
                                <input type="hidden" class="form-control tax" style="width: 100%;"
                                    value="' . $item['tax'] . '">
                                <input type="hidden" class="form-control id" style="width: 100%;"
                                    value="' . $item['id'] . '">
                                <input type="hidden" class="form-control store_product_id" style="width: 100%;"
                                    value="' . $item['product_id'] . '">
                                <div class="input-group" style="width: 100;">
                                    <button class="btn btn-danger decrement" data-variant_value="' . $variantValue . '"
                                        data-tax="' . $item['tax'] . '" data-orderstatus="'.$order['order_status'].'"
                                        data-orderno="'.$order['orderno'].'" data-rate="' . $item['rate'] . '"
                                        data-id="' . $item['id'] . '" data-product-id="' . $item['product_id'] . '"
                                        type="button" ' . $disabled . '>-</button>
                                    <input type="text" class="form-control text-center quantity" name="quantity"
                                        value="'.$item['quantity'].'" min="1" readonly>
                                    <button class="btn btn-danger increment" data-variant_value="' . $variantValue . '"
                                        data-tax="' . $item['tax'] . '" data-orderstatus="'.$order['order_status'].'"
                                        data-orderno="'.$order['orderno'].'" data-rate="' . $item['rate'] . '"
                                        data-id="' . $item['id'] . '" data-product-id="' . $item['product_id'] . '"
                                        type="button" ' . $disabled . '>+</button>
                                </div>

                            </td>
                            <td style="width:80px;"><input type="text" class="form-control rate" disabled
                                    style="width: 100%;" value="' . $item['rate'] . '"></td>
                            <td class="amount">' . $item['rate'] * $item['quantity'] . '</td>
                            <td class="total-amount">' . $item['total_amount'] . '</td>

                            <td style="width:150px;">' . $item['item_remarks'] . '</td>
                            <td><input type="hidden" class="' .$item['product_id'].'total_stock"
                                    value="'.$item['quantity'] * $item['variant_value'].'"></td>
                            <td class="d-flex gap-2">
                                <button type="button" '.$deleted_entry_button_disable.'
                                    class="btn btn-danger delete-order ' . $display_none . '"
                                    data-id="' . $item['id'] . '" data-status="' . $order['order_status'] . '"
                                    data-quantity="' . $item['quantity'] . '">Delete</button>
                                <button type="button"
                                    class="btn btn-secondary return-order" '.$deleted_entry_button_disable.'
                                    data-variant-id='.$variant_id.' data-orderno="'.$order['orderno'].'"
                                    data-item-id="' . $item['product_id'] . '" data-qty="' . $item['quantity'] . '"
                                    data-order-item-id="' . $item['id'] . '" data-item="' .
            $productName .
            ($variantName != null ? ' (' . $variantName . ')' : '') . '">Return</button>
                            </td>
                        </tr>';
                        $item_total = $item['quantity'] * $item['total_amount'];
                        $total_amount += $item_total;
                        }

                        $approveOrderClass = ($order['order_status'] == 0) ? 'btn8-small approve_table_order' :
                        'btn6-small approve_table_order ';
                        $payOrderClass = ($order['order_status'] == 4) ? 'btn8-small pay_table_order' : 'btn6-small
                        pay_table_order ';
                        $diningOrderClass = ($order['order_status'] == 3) ? 'btn8-small dining_order' : 'btn6-small
                        dining_order ';

                        $accordionHtml .= '
                    </tbody>






                    <tfoot class="table-light order-details_buttons">
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-success dropdown-toggle" type="button" id="orderStatusDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">'
                                    .(($order['order_status']=="0")?"Pending":(($order['order_status']=="1")?"Approved":(($order['order_status']=="2")?"Cooking":(($order['order_status']=="3")?"Ready":(($order['order_status']=="4")?"Dining":"Select
                                    Status")))))
                                    .'</button>
                            </td>

                            <td colspan="2">
                                <select class="form-select delivery_boy" '.(($role_id != 1 && $role_id != 2) ? '
                                    disabled' : '' ).'>';
                                    $accordionHtml .= '<option value="">Select supplier</option>';
                                    foreach ($suppliers as $item) {
										 if (!empty($order['approved_by'])) {
        $selected = ($item['userid'] == $order['approved_by']) ? 'selected' : '';
    } else
	{
		$selectedUserId = !empty($order['approved_by']) ? $order['approved_by'] : $user_id;
        $selected = ($item['userid'] == $selectedUserId) ? 'selected' : '';
    }
	 $accordionHtml .= '<option value="' . $item['userid'] . '" ' . $selected . '>'
                    . htmlspecialchars($item['Name']) . '</option>';
                                    // $selected = ($item['userid'] == $order['approved_by']) ? 'selected' : '';
                                    // $accordionHtml .= '<option value="'.$item['userid'].'" '.$selected.'>
                                    //     '.$item['Name'].'</option>';
                                    }
                                    $accordionHtml .= '</select>
                            </td>

                            <td colspan="5">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="'.$approveOrderClass.'"
                                        data-order-id="'.$order['orderno'].'"
                                        data-kot-enable="'.$kot_enable.'" '.(($order['approved_by'] &&
                                        $order['is_reorder'] !=1) || $order['order_status']==1 ? 'disabled' : ''
                                        ).'>Approve</button>

                                    <button type="button" data-order-id="'.$order['orderno'].'"
                                        class="'.$diningOrderClass.' d-none" style="margin-left:10px;">Dining</button>
                                    <button type="button" class="'.$payOrderClass.' d-none"
                                        data-order-id="'.$order['orderno'].'" style="margin-left:10px;">Pay</button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#printModal"
                                        data-order-id="'.$order['orderno'].'" class="btn6-small pay_order_print"
                                        style="margin-left:10px;">Print</button>
                                    <a class="btn6-small '.$display_none_order_delete.' delete-full-order"
                                        data-order-id="'.$order['orderno'].'" style="margin-left:10px;">Delete</a>
                                </div>
                            </td>

                            <td colspan="5">
                                <div class="d-flex justify-content-end">
                                    <button class="btn6-small"
                                        id="order-amount-include-tax-footer-'.$order['orderno'].'"
                                        style="margin-right:10px;">Total : '.round($order['total_amount'],2).'</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="msgContainer'.$order['orderno'].' d-none">
                            <td colspan="12">
                                <div class="alert alert-success dark d-none" role="alert"
                                    id="ordermsg'.$order['orderno'].'">Order</div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
</form>
</div>';
$accordionHtml .= '
</tbody>
</table>
</div>
</div>

</div>



<div class="modal fade" id="recipe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body tt">
                <iframe id="table_iframe_recipe1" height="600px" width="100%"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recipe1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body tt">
                <iframe id="table_iframe_recipe2" height="600px" width="100%"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


</div>';
}
$accordionHtml .= '</div>';
echo $accordionHtml;
}
else
{
echo "<div class='alert alert-danger' role='alert'>No orders!</div>";
}
}


public function getCompletedOrdersByType() {
$this->load->model('owner/Ordermodel');
$orders = $this->Ordermodel->getCompletedOrdersByType($this->input->post('date') , $this->input->post('order_type'));
//print_r($orders);exit;
if (empty($orders)) {
echo "<div class='alert alert-danger' role='alert'>No orders!</div>";
return;
}

$accordionHtml = '';

// Build accordion HTML
$accordionHtml .= '<div class="accordion">
    <h5 class="text-center">Completed Orders</h5>
    <hr>';

    foreach ($orders as $index => $order) {
    $isFirst = $index === 0 ? ' ' : ''; // Keep the first accordion open
    $accordionHtml .= '
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading' . $order['id'] . '">
            <button class="accordion-button' . ($index !== 0 ? ' collapsed' : '') . '" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse' . $order['id'] . '"
                aria-expanded="' . ($index === 0 ? 'true' : 'false') . '" aria-controls="collapse' . $order['id'] . '">
                ' . $index + 1 . ' : Order No: ' . $order['orderno'] . ' - Amount: ' . $order['total_amount'] -
                $order['tax_amount'] . ' - Vat: ' . $order['tax_amount'] . ' - Total: ' . $order['total_amount'] . ' - '
                . $order['customer_name'] .'('.$order['contact_number'].')
            </button>
        </h2>
        <div id="collapse' . $order['id'] . '" class="accordion-collapse collapse' . $isFirst . '"
            aria-labelledby="heading' . $order['id'] . '" data-bs-parent="#ordersAccordion">

            <div class="accordion-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">Sl</th>
                            <th width="25%">Product</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Rate</th>
                            <th width="10%">Amount</th>
                            <th width="5%">Vat(%)</th>
                            <th width="10%">Vat-Amt</th>
                            <th width="10%">Total-Amt</th>
                            <th width="10%">Is Addon</th>
                            <th width="20%">Recipe Details</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($order['items'] as $key => $item) {
                        $accordionHtml .= '
                        <tr>
                            <td>' . $key + 1 . '</td>
                            <td>' . $this->Ordermodel->getProductName($item['product_id']) .
                                (!empty($this->Ordermodel->getVariantName($item['variant_id'])) ?
                                ' (' . $this->Ordermodel->getVariantName($item['variant_id']) . ')' : '') . '</td>

                            <td>' . $item['quantity'] . '</td>
                            <td>' . $item['rate'] . '</td>
                            <td>' . $item['rate'] * $item['quantity'] . '</td>
                            <td>' . $item['tax'] . '</td>
                            <td>' . $item['tax_amount'] . '</td>
                            <td>' . $item['total_amount'] . '</td>
                            <td><input type="checkbox" class="form-check-input" disabled
                                    name="orders[' . $index . '][is_addon]" value="1" ' . ($item['is_addon']==1
                                    ? 'checked' : '' ) . '></td>
						<td>' . $item['item_remarks'] . '</td>
					</tr>' ; } $accordionHtml .='
				</tbody>
			</table>
		</div>
	</div>

						</div>
					</div>' ; } $accordionHtml .='</div>' ; echo $accordionHtml; } public function
                                    getProductRatesWithIsCustomizeNewDiningOrder(){
                                    $is_customise=$this->Ordermodel->checkCustomizable($this->input->post('product_id'));

                                $html = '';
                                if($is_customise == 1){
                                $variantsList =
                                $this->Ordermodel->getVariants($this->input->post('product_id'),$this->session->userdata('logged_in_store_id'));
                                $html .= '
                                <div class="col">
                                    <input type="hidden" id="store_id"
                                        value="'.$this->session->userdata('logged_in_store_id').'">
                                    <input type="hidden" id="tableId" value="'.$this->input->post('table_id').'">
                                    <input type="hidden" id="orderType" value="'.$this->input->post('orderType').'">
                                    <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                    <input type="hidden" id="ratenew">
                                    <input type="hidden" id="taxnew">
                                    <input type="hidden" id="taxamtnew">
                                    <input type="hidden" id="totalnew">
                                    <input type="hidden" id="qty">
                                    <input type="hidden" id="variantnew_id">

                                    <label for="productId" class="form-label">Variant</label>
                                    <select class="form-select" name="variant_id" id="variant_id">'; // Default
                                        // placeholder option
                                        foreach ($variantsList as $variant1) {
                                        $html .= '<option data-variant_value="' . $variant1['variant_value'] . '"
                                            value="' . htmlspecialchars($variant1['variant_id']) . '">' .
                                            htmlspecialchars($variant1['variant_name']) . '</option>';
                                        }
                                        $html .= '</select>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="product_quantity"
                                            id="productQuantity" placeholder="Enter Quantity" autofocus>
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Rate</label>
                                        <input type="text" disabled class="form-control" id="rate">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Tax Amount</label>
                                        <input type="text" disabled class="form-control" id="tax_amount" placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="productQuantity" class="form-label">Total Amount</label>
                                        <input type="text" disabled class="form-control" id="total_amount"
                                            placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary mt-4" type="button" id="saveOrder">ADD</button>
                                    </div>
                                </div>
                                <hr>
                                </hr>
                                ';
                                }
                                if($is_customise == 0){
                                $html = '
                                <input type="hidden" id="store_id"
                                    value="'.$this->session->userdata('logged_in_store_id').'">
                                <input type="hidden" id="tableId" value="'.$this->input->post('table_id').'">
                                <input type="hidden" id="orderType" value="'.$this->input->post('orderType').'">
                                <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                <input type="hidden" id="ratenew">
                                <input type="hidden" id="taxnew">
                                <input type="hidden" id="taxamtnew">
                                <input type="hidden" id="totalnew">
                                <input type="hidden" id="qty">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="product_quantity"
                                            id="productQuantityNotCustomize" placeholder="Enter Quantity" autofocus />
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Rate</label>
                                        <input type="text" disabled class="form-control" id="rate1">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Tax Amount</label>
                                        <input type="text" disabled class="form-control" id="tax_amount1"
                                            placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="productQuantity" class="form-label">Amount</label>
                                        <input type="text" disabled class="form-control" id="total_amount1"
                                            placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary mt-4" type="button" id="saveOrder">ADD</button>
                                    </div>
                                </div>
                                <hr>
                                </hr>
                                ';
                                }
                                echo $html;
                                }






                                // Pickup New Order
                                public function getProductRatesWithIsCustomizeNewPickupOrder(){
                                $is_customise = $this->Ordermodel->checkCustomizable($this->input->post('product_id'));

                                $html = '';
                                if($is_customise == 1){
                                $variantsList =
                                $this->Ordermodel->getVariants($this->input->post('product_id'),$this->session->userdata('logged_in_store_id'));
                                $html .= '<div class="col">
                                    <input type="hidden" id="store_id"
                                        value="'.$this->session->userdata('logged_in_store_id').'">
                                    <input type="hidden" id="name" value="'.$this->input->post('name').'">
                                    <input type="hidden" id="number" value="'.$this->input->post('number').'">
                                    <input type="hidden" id="time" value="'.$this->input->post('time').'">
                                    <input type="hidden" id="tableId" value="'.$this->input->post('table_id').'">
                                    <input type="hidden" id="orderType" value="'.$this->input->post('orderType').'">
                                    <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                    <input type="hidden" id="ratenew">
                                    <input type="hidden" id="taxnew">
                                    <input type="hidden" id="taxamtnew">
                                    <input type="hidden" id="totalnew">
                                    <input type="hidden" id="qty">
                                    <input type="hidden" id="variantnew_id">

                                    <label for="productId" class="form-label">Variant</label>
                                    <select class="form-select" name="variant_id" id="variant_id">'; // Default
                                        // placeholder option
                                        foreach ($variantsList as $variant1) {
                                        $html .= '<option data-variant_value="' . $variant1['variant_value'] . '"
                                            value="' . htmlspecialchars($variant1['variant_id']) . '">' .
                                            htmlspecialchars($variant1['variant_name']) . '</option>';
                                        }
                                        $html .= '</select>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="product_quantity"
                                            id="productQuantity" placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Rate</label>
                                        <input type="text" disabled class="form-control" id="rate">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Tax Amount</label>
                                        <input type="text" disabled class="form-control" id="tax_amount" placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="productQuantity" class="form-label">Total Amount</label>
                                        <input type="text" disabled class="form-control" id="total_amount"
                                            placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary mt-4" type="button" id="saveOrder">ADD</button>
                                    </div>
                                </div>
                                <hr>
                                </hr>
                                ';
                                }
                                if($is_customise == 0){
                                $html = '
                                <input type="hidden" id="store_id"
                                    value="'.$this->session->userdata('logged_in_store_id').'">
                                <input type="hidden" id="name" value="'.$this->input->post('name').'">
                                <input type="hidden" id="number" value="'.$this->input->post('number').'">
                                <input type="hidden" id="time" value="'.$this->input->post('time').'">
                                <input type="hidden" id="tableId" value="'.$this->input->post('table_id').'">
                                <input type="hidden" id="orderType" value="'.$this->input->post('orderType').'">
                                <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                <input type="hidden" id="ratenew">
                                <input type="hidden" id="taxnew">
                                <input type="hidden" id="taxamtnew">
                                <input type="hidden" id="totalnew">
                                <input type="hidden" id="qty">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="product_quantity"
                                            id="productQuantityNotCustomize" placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Rate</label>
                                        <input type="text" disabled class="form-control" id="rate1">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Tax Amount</label>
                                        <input type="text" disabled class="form-control" id="tax_amount1"
                                            placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="productQuantity" class="form-label">Amount</label>
                                        <input type="text" disabled class="form-control" id="total_amount1"
                                            placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary mt-4" type="button" id="saveOrder">ADD</button>
                                    </div>
                                </div>

                                <hr>
                                </hr>
                                ';
                                }
                                echo $html;
                                }







                                // Delivery New Order
                                public function getProductRatesWithIsCustomizeNewDeliveryOrder(){
                                $is_customise = $this->Ordermodel->checkCustomizable($this->input->post('product_id'));

                                $html = '';
                                if($is_customise == 1){
                                $variantsList =
                                $this->Ordermodel->getVariants($this->input->post('product_id'),$this->session->userdata('logged_in_store_id'));
                                $html .= '<div class="col">
                                    <input type="hidden" id="store_id"
                                        value="'.$this->session->userdata('logged_in_store_id').'">
                                    <input type="hidden" id="name" value="'.$this->input->post('name').'">
                                    <input type="hidden" id="number" value="'.$this->input->post('number').'">
                                    <input type="hidden" id="time" value="'.$this->input->post('time').'">
                                    <input type="hidden" id="address" value="'.$this->input->post('address').'">
                                    <input type="hidden" id="paymentMode" value="'.$this->input->post('paymentMode').'">
                                    <input type="hidden" id="tableId" value="'.$this->input->post('table_id').'">
                                    <input type="hidden" id="orderType" value="'.$this->input->post('orderType').'">
                                    <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                    <input type="hidden" id="ratenew">
                                    <input type="hidden" id="taxnew">
                                    <input type="hidden" id="taxamtnew">
                                    <input type="hidden" id="totalnew">
                                    <input type="hidden" id="qty">
                                    <input type="hidden" id="variantnew_id">

                                    <label for="productId" class="form-label">Variant</label>
                                    <select class="form-select" name="variant_id" id="variant_id">'; // Default
                                        // placeholder option
                                        foreach ($variantsList as $variant1) {
                                        $html .= '<option data-variant_value="' . $variant1['variant_value'] . '"
                                            value="' . htmlspecialchars($variant1['variant_id']) . '">' .
                                            htmlspecialchars($variant1['variant_name']) . '</option>';
                                        }
                                        $html .= '</select>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="product_quantity"
                                            id="productQuantity" placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Rate</label>
                                        <input type="text" disabled class="form-control" id="rate">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Tax Amount</label>
                                        <input type="text" disabled class="form-control" id="tax_amount" placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="productQuantity" class="form-label">Total Amount</label>
                                        <input type="text" disabled class="form-control" id="total_amount"
                                            placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary mt-4" type="button" id="saveOrder">ADD</button>
                                    </div>
                                </div>
                                <hr>
                                </hr>
                                ';
                                }
                                if($is_customise == 0){
                                $html = '
                                <input type="hidden" id="store_id"
                                    value="'.$this->session->userdata('logged_in_store_id').'">
                                <input type="hidden" id="name" value="'.$this->input->post('name').'">
                                <input type="hidden" id="number" value="'.$this->input->post('number').'">
                                <input type="hidden" id="time" value="'.$this->input->post('time').'">
                                <input type="hidden" id="address" value="'.$this->input->post('address').'">
                                <input type="hidden" id="paymentMode" value="'.$this->input->post('paymentMode').'">
                                <input type="hidden" id="tableId" value="'.$this->input->post('table_id').'">
                                <input type="hidden" id="orderType" value="'.$this->input->post('orderType').'">
                                <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                <input type="hidden" id="ratenew">
                                <input type="hidden" id="taxnew">
                                <input type="hidden" id="taxamtnew">
                                <input type="hidden" id="totalnew">
                                <input type="hidden" id="qty">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="product_quantity"
                                            id="productQuantityNotCustomize" placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Rate</label>
                                        <input type="text" disabled class="form-control" id="rate1">
                                    </div>
                                    <div class="col-3">
                                        <label for="productQuantity" class="form-label">Tax Amount</label>
                                        <input type="text" disabled class="form-control" id="tax_amount1"
                                            placeholder="">
                                    </div>
                                    <div class="col-2">
                                        <label for="productQuantity" class="form-label">Amount</label>
                                        <input type="text" disabled class="form-control" id="total_amount1"
                                            placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary mt-4" type="button" id="saveOrder">ADD</button>
                                    </div>
                                </div>

                                <hr>
                                </hr>
                                ';
                                }
                                echo $html;
                                }



                                public function getProductRatesWithIsCustomizeExistingOrder(){
                                $is_customise = $this->Ordermodel->checkCustomizable($this->input->post('product_id'));
                                //echo $this->input->post('product_id');echo
                                $this->session->userdata('logged_in_store_id');exit;

                                $html = '';
                                if($is_customise == 1){
                                $variantsList =
                                $this->Ordermodel->getVariants($this->input->post('product_id'),$this->session->userdata('logged_in_store_id'));
                                $html .= '<div class="col">
                                    <input type="hidden" id="store_id"
                                        value="'.$this->session->userdata('logged_in_store_id').'">
                                    <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                    <input type="hidden" id="ratenew" value="">
                                    <input type="hidden" id="taxnew" value="">
                                    <input type="hidden" id="taxamtnew" value="">
                                    <input type="hidden" id="totalnew" value="">
                                    <input type="hidden" id="qty" value="">
                                    <input type="hidden" id="variantnew_id" value="">

                                    <label for="productId" class="form-label">Variant</label>
                                    <select class="form-select" name="variant_id" id="variant_id">'; // Default
                                        // placeholder option
                                        foreach ($variantsList as $variant1) {
                                        $html .= '<option data-variant_value="' . $variant1['variant_value'] . '"
                                            value="' . htmlspecialchars($variant1['variant_id']) . '">' .
                                            htmlspecialchars($variant1['variant_name']) . '</option>';
                                        }

                                        $html .= '</select>
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity" id="productQuantity"
                                        placeholder="Enter Quantity">
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Rate</label>
                                    <input type="text" class="form-control" id="rate">
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Tax Amount</label>
                                    <input type="text" class="form-control" id="tax_amount" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Total Amount</label>
                                    <input type="text" class="form-control" id="total_amount"
                                        placeholder="Enter Quantity">
                                </div>
                                <div class="row mt-2">
                                    <button class="btn btn-primary" type="button" id="saveOrder">Save</button>
                                </div>';
                                }
                                if($is_customise == 0){
                                $html = '
                                <input type="hidden" id="store_id"
                                    value="'.$this->session->userdata('logged_in_store_id').'">
                                <input type="hidden" id="product_id" value="'.$this->input->post('product_id').'">
                                <input type="hidden" id="ratenew" value="1">
                                <input type="hidden" id="taxnew" value="2">
                                <input type="hidden" id="taxamtnew" value="2">
                                <input type="hidden" id="totalnew" value="3">
                                <input type="hidden" id="qty" value="3">
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity"
                                        id="productQuantityNotCustomize" placeholder="Enter Quantity">
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Rate</label>
                                    <input type="text" class="form-control" id="rate1">
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Tax Amount</label>
                                    <input type="text" class="form-control" id="tax_amount1" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="productQuantity" class="form-label">Total Amount</label>
                                    <input type="text" class="form-control" id="total_amount1"
                                        placeholder="Enter Quantity">
                                </div>
                                <div class="row mt-2">
                                    <button class="btn btn-primary" type="button" id="saveOrder">Save</button>
                                </div>';
                                }
                                echo $html;
                                }







                                }