<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		//require('Common.php');
		$this->load->model('admin/Productmodel');
		$this->load->model('admin/Storemodel');
		$this->load->model('owner/Ordermodel');
		$this->load->model('owner/Stockmodel');
		$this->load->model('website/Homemodel');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}


	public function supplier_reports()
	{
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$data['store_id'] = $this->session->userdata('logged_in_store_id');

		$role_id = $this->session->userdata('role_id'); // Role id of logged in user
		$user_id = $this->session->userdata('user_id'); // Loged in user id

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

		$this->load->model('website/Homemodel');
		$store_details = $this->Commonmodel->get_store_details_by_id($data['store_id']);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;
		$this->load->view('supplier/includes/header',$data);
		$this->load->view('supplier/includes/supplier-dashboard-menu',$data);
		$this->load->view('supplier/order/supplier-reports');
		$this->load->view('supplier/includes/footer');

	}

}