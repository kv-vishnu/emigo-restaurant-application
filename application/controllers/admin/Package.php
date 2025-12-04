<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

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
		$this->load->model('admin/Packagemodel');
		$this->load->model('admin/Packagemodel');
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function index()
	{
	    $data['packages']=$this->Packagemodel->listpackages();
		$this->load->view('admin/includes/header');
		$this->load->view('admin/package/packages',$data);
		$this->load->view('admin/includes/footer');
	}
	
	
	public function delete(){
	    $this->Packagemodel->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Package deleted successfully');
	}
	
	public function add(){
        $data['packages']=$this->Packagemodel->listpackages();
	    if(isset($_POST['add']))
		{
		    
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('package_name', 'Package name', 'required|callback_packagename_exists');
            $this->form_validation->set_rules('qty', 'Quantity', 'required');
            $this->form_validation->set_rules('remarks', 'Remarks', 'required');

		
			if($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/package/packages',$data); 
			    $this->load->view('admin/includes/footer');
			}
			else
			{
                
			    $data = array(
			        'name' => $this->input->post('package_name'),
                    'no_of_quantity' => $this->input->post('qty'),
                    'remarks' => $this->input->post('remarks'),
			        'is_active' => 1,
			        );
					//print_r($data);exit;
				$this->Packagemodel->insert($data);
				$this->session->set_flashdata('success','New record inserted...');
				redirect('admin/package');
			}
		}
		else
		{
		    $this->load->view('admin/includes/header');
			$this->load->view('admin/package/packages',$data); 
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function edit(){
        $data['packages']=$this->Packagemodel->listpackages();
	    if(isset($_POST['edit']))
		{
            
		    $id=$this->input->post('id'); //echo $id;die();
			$data['packageDet']=$this->Packagemodel->get($id);
			$this->form_validation->set_error_delimiters('', ''); 
            $this->form_validation->set_rules('package_name', 'Package name', 'required');
            $this->form_validation->set_rules('qty', 'Quantity', 'required');
            $this->form_validation->set_rules('remarks', 'Remarks', 'required');
		
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/package/packages',$data); 
			    $this->load->view('admin/includes/footer');
			}
			else
			{

				$data = array(
			        'name' => $this->input->post('package_name'),
                    'no_of_quantity' => $this->input->post('qty'),
                    'remarks' => $this->input->post('remarks'),
			        'is_active' => 1,
			        );
				$this->Packagemodel->update($id,$data);
				$this->session->set_flashdata('success','Package details updated...');
				redirect('admin/package');
			}
		}
		else
		{
			$id=$this->input->post('id'); //echo $roleid;die();
			$data['packageDet']=$this->Packagemodel->get($id);
			$this->load->view('admin/includes/header');
			$this->load->view('admin/package/packages',$data); 
			$this->load->view('admin/includes/footer');
		}
	}

	public function packagename_exists($package)
	{
		if ($this->Packagemodel->check_packagename_exists($package)) {
			$this->form_validation->set_message('packagename_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}
