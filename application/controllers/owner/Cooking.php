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
	    $data['cookings']=$this->Cookingmodel->listcookings();
		$this->load->view('admin/includes/header');
		$this->load->view('admin/cooking/cookings',$data);
		$this->load->view('admin/includes/footer');
	}
	
	
	public function delete(){
	    $this->Cookingmodel->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Cooking deleted successfully');
	}
	
	public function add(){
        $data['cookings']=$this->Cookingmodel->listcookings();
	    if(isset($_POST['add']))
		{
		    
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('name_ma', 'Malayalam Name', 'required');
			$this->form_validation->set_rules('name_en', 'English Name', 'required');
			$this->form_validation->set_rules('name_hi', 'Hindi Name', 'required');
			$this->form_validation->set_rules('name_ar', 'Arabic Name', 'required');

		
			if($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/cooking/cookings',$data); 
			    $this->load->view('admin/includes/footer');
			}
			else
			{
                
			    $data = array(
			        'name_ma' => $this->input->post('name_ma'),
					'name_en' => $this->input->post('name_en'),
					'name_hi' => $this->input->post('name_hi'),
					'name_ar' => $this->input->post('name_ar'),
			        'is_active' => 1,
			        );
					//print_r($data);exit;
				$this->Cookingmodel->insert($data);
				$this->session->set_flashdata('success','New record inserted...');
				redirect('admin/cooking');
			}
		}
		else
		{
		    $this->load->view('admin/includes/header');
			$this->load->view('admin/cooking/cookings',$data); 
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function edit(){
        $data['cookings']=$this->Cookingmodel->listcookings();
	    if(isset($_POST['edit']))
		{
            
		    $id=$this->input->post('id'); //echo $id;die();
			$data['cookingDet']=$this->Cookingmodel->get($id);
			$this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('name_ma', 'Malayalam Name', 'required');
			$this->form_validation->set_rules('name_en', 'English Name', 'required');
			$this->form_validation->set_rules('name_hi', 'Hindi Name', 'required');
			$this->form_validation->set_rules('name_ar', 'Arabic Name', 'required');
		
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/cooking/cookings',$data); 
			    $this->load->view('admin/includes/footer');
			}
			else
			{

				$data = array(
			        'name_ma' => $this->input->post('name_ma'),
					'name_en' => $this->input->post('name_en'),
					'name_hi' => $this->input->post('name_hi'),
					'name_ar' => $this->input->post('name_ar'),
			        'is_active' => 1,
			        );
				$this->Cookingmodel->update($id,$data);
				$this->session->set_flashdata('success','Cooking request details updated...');
				redirect('admin/cooking');
			}
		}
		else
		{
			$id=$this->input->post('id'); //echo $roleid;die();
			$data['cookingDet']=$this->Cookingmodel->get($id);
			$this->load->view('admin/includes/header');
			$this->load->view('admin/cooking/cookings',$data); 
			$this->load->view('admin/includes/footer');
		}
	}

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
