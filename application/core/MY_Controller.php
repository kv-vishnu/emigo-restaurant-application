<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class MY_Controller extends CI_Controller {



    public function __construct() {

        parent::__construct();

    }



    //MARK: - Render Admin Header

    public function render_admin_header($view, $data = []) {

        $this->load->model('website/Homemodel');

		$controller = $this->router->fetch_class(); /* Gets the current controller name */

		$method = $this->router->fetch_method();    /* Gets the current method name */

		$data['controller'] = $controller;

		$data['method'] = $method;

		$data['Clientscount']=$this->Commonmodel->Clientscount();

		$data['completedOrder']=$this->Commonmodel->completedOrder();

		$logged_in_store_id = $this->session->userdata('logged_in_store_id');   /* echo $logged_in_store_id;exit; */

		$role_id = $this->session->userdata('roleid');  /* Role id of logged in user */

		$user_id = $this->session->userdata('loginid');  /* Loged in user id */

        $store_details = $this->Commonmodel->get_admin_details_by_store_id($logged_in_store_id);

        $data['Name'] = $store_details->Name;

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

        $data['userAddress'] = $store_details->userAddress;

        $data['support_no'] = $store_details->UserPhoneNumber;

        $data['support_email'] = $store_details->userEmail;

		$data['profileimg'] = $store_details->profileimg;



		$this->load->view('admin/header',$data);

		$this->load->view('admin/menudashboard',$data);

		$this->load->view($view, $data);

	    $this->load->view('admin/footer',$data);

    }



	//MARK: - Render Shop owner Header

    public function render_shopowner_header($view, $data = []) {

       	$controller = $this->router->fetch_class(); // Gets the current controller name

		$method = $this->router->fetch_method();   // Gets the current method name

		$data['controller'] = $controller;

        $logged_in_store_id = $this->session->userdata('logged_in_store_id');  //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user

		$user_id = $this->session->userdata('loginid'); // Loged in user id



        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);

        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);

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

        $data['store_disp_name'] = $store_details->store_disp_name;

        $data['store_address'] = $store_details->store_address;

        $data['support_no'] = $support_details->support_number;

        $data['support_email'] = $support_details->support_email;

		$data['store_logo'] = $store_details->store_logo_image;



		$this->load->view('owner/includes/header',$data);

		$this->load->view('owner/includes/owner-dashboard-menu',$data);

		$this->load->view($view, $data);

	    $this->load->view('owner/includes/footer');

    }

	public function render_supplier_header($view, $data = []) {

       	$controller = $this->router->fetch_class(); // Gets the current controller name

		$method = $this->router->fetch_method();   // Gets the current method name

		$data['controller'] = $controller;

        $logged_in_store_id = $this->session->userdata('logged_in_store_id');  //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user

		$user_id = $this->session->userdata('loginid'); // Loged in user id



        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);

        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);

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

        $data['store_disp_name'] = $store_details->store_disp_name;

        $data['store_address'] = $store_details->store_address;

        $data['support_no'] = $support_details->support_number;

        $data['support_email'] = $support_details->support_email;

		$data['store_logo'] = $store_details->store_logo_image;



		$this->load->view('supplier/includes/header',$data);

		$this->load->view('supplier/includes/supplier-dashboard-menu',$data);

		$this->load->view($view, $data);

	    $this->load->view('supplier/includes/footer');

    }

	public function render_kitchen_header($view, $data = []) {

       	$controller = $this->router->fetch_class(); // Gets the current controller name

		$method = $this->router->fetch_method();   // Gets the current method name

		$data['controller'] = $controller;

        $logged_in_store_id = $this->session->userdata('logged_in_store_id');  //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user

		$user_id = $this->session->userdata('loginid'); // Loged in user id



        $store_details = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);

        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);

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
				case 6:
					$data['role'] = "Kitchen";
					break;

				default:
					$data['role'] = "User";
					break;
			}

        $data['store_disp_name'] = $store_details->store_disp_name;

        $data['store_address'] = $store_details->store_address;

        $data['support_no'] = $support_details->support_number;

        $data['support_email'] = $support_details->support_email;

		$data['store_logo'] = $store_details->store_logo_image;



		$this->load->view('kitchen/includes/header',$data);

		$this->load->view('kitchen/includes/kitchen-dashboard-menu',$data);

		$this->load->view($view, $data);

	    $this->load->view('kitchen/includes/footer');

    }

}

