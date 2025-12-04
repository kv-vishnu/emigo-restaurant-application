<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller {

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
		$this->load->model('admin/Commonmodel');
		$this->load->model('website/Homemodel');
		$this->load->model('admin/Storemodel');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	//MARK: Shop Owner Dashboard
	public function index()
	{
		$logged_in_store_id = $this->session->userdata('logged_in_store_id');
		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');
		$data['store_details'] = $this->Commonmodel->get_store_details_by_id($logged_in_store_id);
		$this->session->set_userdata('store_name',$data['store_details']->store_name);
		$this->render_kitchen_header('kitchen/dashboard', $data);
	}
}