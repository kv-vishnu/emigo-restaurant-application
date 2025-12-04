<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variants extends CI_Controller {

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
		$this->load->model('admin/Variantmodel');
		$this->load->model('admin/Usermodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function index()
	{ $controller = $this->router->fetch_class(); // Gets the current controller name
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
		$data['variants']=$this->Variantmodel->listvariants();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/menudashboard',$data);
		$this->load->view('admin/variant/variants',$data);
		$this->load->view('admin/footer',$data);
	}
	
	
	public function deletevariant(){
	  $id= $this->input->post('id');
	  $this->Variantmodel->delete($id);
		// $this->session->set_flashdata('error','Variant deleted successfully');
	}
	
	public function add(){
		
        $data['variants']=$this->Variantmodel->listvariants();
	    // if(isset($_POST['add']))
		// {
		    
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('variant_name', 'Variant ', 'required|callback_countryname_exists');
			$this->form_validation->set_rules('variant_code', 'code', 'required');

		
			if($this->form_validation->run() == FALSE) 
			{
				$response = [
					'success' => false,
					'errors' => [
						'variant_name' => form_error('variant_name'),
						'variant_code' => form_error('variant_code'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{
                
			    $data = array(
			        'variant_name' => $this->input->post('variant_name'),
					'code' => $this->input->post('variant_code'),
			        'is_active' => 1,
			        );
					// print_r($data);exit;
				$this->Variantmodel->insert($data);
				echo json_encode(['success' => 'success']);
			}
		// }
		
	}


	public function edit(){
		$id = $this->input->post('id');
        $edit_variants = $this->Variantmodel->get_variant_details($id); 
		// print_r($edit_cooking);exit;
        if (!$edit_variants || !is_array($edit_variants)) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
                'variant_name' => $edit_variants['variant_name'] ?? null,
				'code' => $edit_variants['code'],
                'is_active' => 1,
        ];
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
		//  print_r($result);exit;
	}


	public function updatevariantsdetails(){
		$id=$this->input->post('hidden_variant_id');
		$this->form_validation->set_error_delimiters('', ''); 
		$this->form_validation->set_rules('variant_name', 'Variant ', 'required');
		$this->form_validation->set_rules('variant_code', 'code', 'required');

	
		if($this->form_validation->run() == FALSE) 
		{
			$response = [
				'success' => false,
				'errors' => [
					'variant_name' => form_error('variant_name'),
					'variant_code' => form_error('variant_code'),
				]
			];
		
			echo json_encode($response);
		}
		else
		{
			
			$data = array(
				'variant_name' => $this->input->post('variant_name'),
				'code' => $this->input->post('variant_code'),
				'is_active' => 1,
				);
				// print_r($data);exit;
				$this->Variantmodel->update($id,$data);
			echo json_encode(['success' => 'success','data'=>$data]);
		}


	}
	
	// public function edit(){
    //     $data['variants']=$this->Variantmodel->listvariants();
	//     if(isset($_POST['edit']))
	// 	{
            
	// 	    $id=$this->input->post('id'); //echo $id;die();
	// 		$data['variantDet']=$this->Variantmodel->get($id);
	// 		$this->form_validation->set_error_delimiters('', ''); 
	// 		$this->form_validation->set_rules('variant_name', 'Name', 'required');
	// 		$this->form_validation->set_rules('code', 'Code', 'required');
		
	// 		if ($this->form_validation->run() == FALSE) 
	// 		{
	// 			$this->load->view('admin/includes/header');
	// 		    $this->load->view('admin/variant/variants',$data); 
	// 		    $this->load->view('admin/includes/footer');
	// 		}
	// 		else
	// 		{

	// 			$data = array(
	// 		        'variant_name' => $this->input->post('variant_name'),
	// 				'code' => $this->input->post('code'),
	// 		        'is_active' => 1,
	// 		        );
	// 			$this->Variantmodel->update($id,$data);
	// 			$this->session->set_flashdata('success','Variant details updated...');
	// 			redirect('admin/variants');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$id=$this->input->post('id'); //echo $roleid;die();
	// 		$data['variantDet']=$this->Variantmodel->get($id);
	// 		$this->load->view('admin/includes/header');
	// 		$this->load->view('admin/variant/variants',$data); 
	// 		$this->load->view('admin/includes/footer');
	// 	}
	// }

	public function countryname_exists($country)
	{
		if ($this->Variantmodel->check_countryname_exists($country)) {
			$this->form_validation->set_message('countryname_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}
