<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	public function __construct()
	{
		parent::__construct();
		//require('Common.php');

		$this->load->model('owner/Deliverymodel');
		if (!$this->session->userdata('login_status')) {
			redirect('admin/login');
		}
	}
	public function pending_delivery_orders($tableid)
	{

		$store_id = $this->session->userdata('logged_in_store_id');

		$data['role_id'] = $this->session->userdata('role_id');
		$data['user_id'] = $this->session->userdata('user_id'); // Logged in user id
		$data['suppliers'] = $this->Deliverymodel->getsuppliers($store_id);
		$data['orders'] = $this->Deliverymodel->get_delivery_orders($store_id , 'DL');
		$data['kot_enable'] = $this->Deliverymodel->getKotEnabledStatus($store_id);
		$this->load->view('owner/order/pending_delivery_orders',$data);
	}
	public function completed_delivery_orders($tableid){
		$data['orders'] = $this->Deliverymodel->completed_delivery_orders('DL');
		$this->load->view('owner/order/completed_delivery_orders',$data);
	}
	//MARK:Approve Table Order
}
































