<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	public function __construct()
	{
		parent::__construct();
		//require('Common.php');

		$this->load->model('owner/Pickupmodel');
		if (!$this->session->userdata('login_status')) {
			redirect('admin/login');
		}
	}
	public function pending_pickup_orders($tableid)
	{

		$store_id = $this->session->userdata('logged_in_store_id');

		$data['role_id'] = $this->session->userdata('role_id');
		$data['user_id'] = $this->session->userdata('user_id'); // Logged in user id
		$data['suppliers'] = $this->Pickupmodel->getsuppliers($store_id); 
		$data['orders'] = $this->Pickupmodel->get_pickup_orders($store_id , 'PK');
		$data['kot_enable'] = $this->Pickupmodel->getKotEnabledStatus($store_id);
		$this->load->view('owner/order/pending_pickup_orders',$data);
	}
	//MARK:Completed Pickup Orders
	public function completed_pickup_orders($tableid){
		$data['orders'] = $this->Pickupmodel->completed_pickup_orders('PK');
		$this->load->view('owner/order/completed_pickup_orders',$data);
	}
}
































