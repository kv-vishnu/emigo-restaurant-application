<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

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
		$this->load->model('admin/Taxmodel');
        $this->load->model('admin/Countrymodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function index()
	{

		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$data['Clientscount']=$this->Commonmodel->Clientscount();
		$data['completedOrder']=$this->Commonmodel->completedOrder();

		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
        
         $store_details = $this->Commonmodel->get_admin_details_by_store_id($logged_in_store_id);
		//   print_r($store_details);exit;
        //  $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['Name'] = $store_details->Name;
		// print_r($data['Name']);exit;
        $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
         $data['support_email'] = $store_details->userEmail;
		$data['profileimg'] = $store_details->profileimg;
	    $data['taxes']=$this->Taxmodel->listtaxes();  //print_r($data['taxes']);
        $data['countries']=$this->Countrymodel->listcountries();
		//  print_r($data['countries']);exit;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menudashboard',$data);
		$this->load->view('admin/tax/taxes',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	public function delete(){
	    $this->Taxmodel->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Tax deleted successfully');
	}
	
	public function add(){
		$data['taxes']=$this->Taxmodel->listtaxes();
		// print_r($data['taxes']);
        $data['countries']=$this->Countrymodel->listcountries();

		$this->load->library('form_validation');
		// $this->form_validation->set_error_delimiters('', ''); 
		$this->form_validation->set_rules('country_name', ' name', 'required');
		$this->form_validation->set_rules('country_tax', 'tax', 'required');
		$this->form_validation->set_rules('country_amount', 'amount', 'required');


	
		if($this->form_validation->run() == FALSE) 
		{
			$response = [
				'success' => false,
				'errors' => [
					'country_name' => form_error('country_name'),
					'country_tax' => form_error('country_tax'),
					'country_amount' => form_error('country_amount')
				]
			];
		
			echo json_encode($response);
		}
		else
		{
			
			$data = array(
				'country_id' => $this->input->post('country_name'),
				'tax_type' => $this->input->post('country_tax'),
				'tax_rate' => $this->input->post('country_amount'),
				'is_active' => 1,
				);

				$this->Taxmodel->insert($data);
				// print_r($data);
			echo json_encode(['success' => 'success']);
		}

	}
	
	public function edit(){
		$data['taxes']=$this->Taxmodel->listtaxes();
        $data['countries']=$this->Countrymodel->listcountries();

		$id = $this->input->post('id');
		// echo $id;
		$edit_tax = $this->Taxmodel->get($id); 
		// print_r($edit_tax);
        if (!$edit_tax || !is_array($edit_tax)) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
                'country_id' => $edit_tax['country_id'] ?? null,
				'tax_type' => $edit_tax['tax_type'],
                'tax_rate' => $edit_tax['tax_rate'],
                'is_active' => 1,
        ];

		// print_r($result);
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
	  
	}

	public function updatetaxdetails(){

	$this->form_validation->set_rules('country_name', ' name', 'required');
		 $this->form_validation->set_rules('country_tax', 'tax', 'required');
		 $this->form_validation->set_rules('country_amount', 'amount', 'required');
		$id = $this->input->post('hidden_tax_id');
		// echo $id; exit;
		if ($this->form_validation->run() == FALSE) {
			$response = [
				'success' => false,
				'errors' => [
					'country_name' => form_error('country_name'),
					'country_tax' => form_error('country_tax'),
					'country_amount' => form_error('country_amount')
				]
			];
			echo json_encode($response);
		} 
		else {
			$data = array(
				'country_id' => $this->input->post('country_name'),
				'tax_type' => $this->input->post('country_tax'),
				'tax_rate' => $this->input->post('country_amount'),
				'is_active' => 1,
			);
			$this->Taxmodel->updatetaxdetails($id,$data);
		
			// Debug
			//  print_r($data); // remove or comment this in production
		
			$response = ['success' => 'success'];
			echo json_encode($response);
		}
		
	}

	public function DeleteUser(){
        $id=$this->input->post('id'); 
        $this->Taxmodel->DeleteUser($id);
        // $this->session->set_flashdata('error','User deleted successfully');
    }
}
