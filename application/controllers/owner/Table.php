<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('owner/Tablemodel');
		if (!$this->session->userdata('login_status')) {
			redirect('admin/login');
		}
	}
	public function pending_table_orders($tableid)
	{
		$store_id = $this->session->userdata('logged_in_store_id');
		$data['role_id'] = $this->session->userdata('role_id'); // Role id of logged in user
		$data['user_id'] = $this->session->userdata('user_id'); // Logged in user id
		$data['suppliers'] = $this->Tablemodel->getsuppliers($store_id, $tableid);
		$data['orders'] = $this->Tablemodel->getPendingOrdersByTableId($store_id, $tableid);
		$data['kot_enable'] = $this->Tablemodel->getKotEnabledStatus($store_id);
		$this->load->view('owner/order/pending_orders_by_table',$data);
	}
	//MARK:Completed Table Order
	public function completed_table_orders() {
		$table_id = $this->input->post('table_id');
		$date = $this->input->post('date');
		//echo $table_id;echo $date;
        $data['orders'] = $this->Tablemodel->completed_table_orders($date , $table_id);
		//print_r($data['orders']);exit;
       	$this->load->view('owner/order/completed_table_orders',$data);
    }

	//MARK:Approve Table Order
	public function approve_table_order()
	{
		$date = date('Y-m-d');
		$order_id = $this->input->post('orderId');
		$store_id = $this->session->userdata('logged_in_store_id');
		$selectedsupplier = $this->input->post('selectedsupplier');

		$order_items = $this->Tablemodel->getOrderItems($order_id,$store_id);
		$stockless_items = [];

		foreach ($order_items as $item)
		{
			$product_id = $item['product_id'];
			$variant_id = $item['variant_id'];

			if (!empty($variant_id))
			{
				$product_stock =  $this->Tablemodel->getCurrentStock($product_id, $date, $store_id);
				$ordered_qty =  $this->Tablemodel->getCurrentVariantProductOrderedQuantity($product_id, $date, $store_id,$order_id);
			}
			else
			{
				$ordered_qty = $item['quantity'];
				$product_stock = $availableStock = $this->Tablemodel->getCurrentStock($product_id, $date, $store_id);
			}

			//echo $product_stock;
			//echo $ordered_qty;

			if ($product_stock < $ordered_qty)
			{
				$stockless_items[] = [
					'product_id' => $product_id,
					'product_name' => $this->Tablemodel->getProductName($product_id),
					'ordered_qty' => $ordered_qty,
					'available_stock' => $product_stock
				];
			}
		}

		// If stockless items exist, return them and do not approve the order
		if (!empty($stockless_items)) {
			echo json_encode([
				'status' => 'stock_error',
				'message' => 'Some items have insufficient stock.',
				'stockless_items' => $stockless_items
			]);
			return;
		}


		$updated = $this->Tablemodel->approve_table_order($order_id, $store_id, $selectedsupplier , $order_items );
		
		if ($updated) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Order approved successfully.'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to approve order. Please try again.'
			]);
		}
	}
	
	//Load Products On Load
	public function loadProductsOnLoadNewOrderSelectProduct()
	{
		$products = $this->Tablemodel->loadProductsOnLoadNewOrderSelectProduct();
        echo json_encode($products);
	}

}
































