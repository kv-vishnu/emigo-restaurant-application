<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooking extends CI_Controller {

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
		$this->load->model('admin/Cookingmodel');
		
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
		$data['profileimg'] = $store_details->profileimg;$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;

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
	    $data['cookings']=$this->Cookingmodel->listcookings();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menudashboard',$data);
		$this->load->view('admin/cooking/cookings',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	public function Deletecooking(){
		$id=$this->input->post('id');
		// echo $id;
	     $this->Cookingmodel->delete($id);
		// $this->session->set_flashdata('error','Cooking deleted successfully');
	}
	
	public function add(){
        $data['cookings']=$this->Cookingmodel->listcookings();
	    // if(isset($_POST['add']))
		// {
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('cooking_name_ma', 'Malayalam', 'required');
			$this->form_validation->set_rules('cooking_name_en', 'English', 'required');
			$this->form_validation->set_rules('cooking_name_hi', 'Hindi', 'required');
			$this->form_validation->set_rules('cooking_name_ar', 'Arabic', 'required');

		
			if($this->form_validation->run() == FALSE) 
			{
				$response = [
					'success' => false,
					'errors' => [
						'cooking_name_ma' => form_error('cooking_name_ma'),
						'cooking_name_en' => form_error('cooking_name_en'),
						'cooking_name_hi' => form_error('cooking_name_hi'),
						'cooking_name_ar' => form_error('cooking_name_ar'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{ 
			    $data = array(
			        'name_ma' => $this->input->post('cooking_name_ma'),
					'name_en' => $this->input->post('cooking_name_en'),
					'name_hi' => $this->input->post('cooking_name_hi'),
					'name_ar' => $this->input->post('cooking_name_ar'),
			        'is_active' => 1,
			        );
				$this->Cookingmodel->insert($data);
				// print_r($data); exit;
				echo json_encode(['success' => 'success']);
			}
		// }
		
	}


	public function edit(){
		$data['cookings']=$this->Cookingmodel->listcookings();
		$id = $this->input->post('id');
        $edit_cooking = $this->Cookingmodel->get_cooking_details($id); 
		// print_r($edit_cooking);exit;
        if (!$edit_cooking || !is_array($edit_cooking)) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
                'name_ma' => $edit_cooking['name_ma'] ?? null,
				'name_en' => $edit_cooking['name_en'],
                'name_hi' => $edit_cooking['name_hi'],
                'name_ar' => $edit_cooking['name_ar'],
                'is_active' => 1,
        ];
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
		// print_r($result);exit;
	}


	public function updatecookingdetails(){
	  $id=$this->input->post('hidden_cooking_id');
		$data['cookings']=$this->Cookingmodel->listcookings();
		$this->form_validation->set_error_delimiters('', ''); 
		$this->form_validation->set_rules('cooking_name_ma', 'Malayalam', 'required');
		$this->form_validation->set_rules('cooking_name_en', 'English', 'required');
		$this->form_validation->set_rules('cooking_name_hi', 'Hindi', 'required');
		$this->form_validation->set_rules('cooking_name_ar', 'Arabic', 'required');


		if($this->form_validation->run() == FALSE) 
		{
			$response = [
				'success' => false,
				'errors' => [
					'cooking_name_ma' => form_error('cooking_name_ma'),
					'cooking_name_en' => form_error('cooking_name_en'),
					'cooking_name_hi' => form_error('cooking_name_hi'),
					'cooking_name_ar' => form_error('cooking_name_ar'),
				]
			];
		
			echo json_encode($response);
		}
		else
		{ 
			$data = array(
				'name_ma' => $this->input->post('cooking_name_ma'),
				'name_en' => $this->input->post('cooking_name_en'),
				'name_hi' => $this->input->post('cooking_name_hi'),
				'name_ar' => $this->input->post('cooking_name_ar'),
				'is_active' => 1,
				);
				$this->Cookingmodel->update($id,$data);
			//  print_r($data); exit;
			echo json_encode (['success' => 'success', 'data'=>$data]);
		}

	}


	
	// public function edit(){
    //     $data['cookings']=$this->Cookingmodel->listcookings();
	//     if(isset($_POST['edit']))
	// 	{
            
	// 	    $id=$this->input->post('id'); //echo $id;die();
	// 		$data['cookingDet']=$this->Cookingmodel->get($id);
	// 		$this->form_validation->set_error_delimiters('', ''); 
	// 		$this->form_validation->set_rules('name_ma', 'Malayalam Name', 'required');
	// 		$this->form_validation->set_rules('name_en', 'English Name', 'required');
	// 		$this->form_validation->set_rules('name_hi', 'Hindi Name', 'required');
	// 		$this->form_validation->set_rules('name_ar', 'Arabic Name', 'required');
		
	// 		if ($this->form_validation->run() == FALSE) 
	// 		{
	// 			$this->load->view('admin/includes/header');
	// 		    $this->load->view('admin/cooking/cookings',$data); 
	// 		    $this->load->view('admin/includes/footer');
	// 		}
	// 		else
	// 		{

	// 			$data = array(
	// 		        'name_ma' => $this->input->post('name_ma'),
	// 				'name_en' => $this->input->post('name_en'),
	// 				'name_hi' => $this->input->post('name_hi'),
	// 				'name_ar' => $this->input->post('name_ar'),
	// 		        'is_active' => 1,
	// 		        );
	// 			$this->Cookingmodel->update($id,$data);
	// 			$this->session->set_flashdata('success','Cooking request details updated...');
	// 			redirect('admin/cooking');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$id=$this->input->post('id'); //echo $roleid;die();
	// 		$data['cookingDet']=$this->Cookingmodel->get($id);
	// 		$this->load->view('admin/includes/header');
	// 		$this->load->view('admin/cooking/cookings',$data); 
	// 		$this->load->view('admin/includes/footer');
	// 	}
	// }

	public function countryname_exists($country)
	{
		if ($this->Cookingmodel->check_countryname_exists($country)) {
			$this->form_validation->set_message('countryname_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}