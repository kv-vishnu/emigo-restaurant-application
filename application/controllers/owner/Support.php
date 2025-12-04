<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

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
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{
	    $this->load->model('website/Homemodel');

		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
        $logged_in_store_id = $this->session->userdata('logged_in_store_id');  //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id

        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
		$data['store_logo'] = $store_details->store_logo_image;

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
			
    $this->load->view('owner/includes/header',$data);
    $this->load->view('owner/includes/owner-dashboard-menu',$data);
    $this->load->view('owner/support',$data);
    $this->load->view('owner/includes/footer');

	}



}