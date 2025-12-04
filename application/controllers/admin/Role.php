<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

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
		$this->load->model('admin/Rolemodel');
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(admin/login);
		}
	}
	public function index()
	{
	    $data['role']=$this->Rolemodel->listroles();
		$this->load->view('admin/includes/header');
		$this->load->view('admin/role/roles',$data);
		$this->load->view('admin/includes/footer');
	}
	public function delete(){
	    $this->Rolemodel->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Role deleted successfully');
	}
	public function add(){
	    $data['role']=$this->Rolemodel->listroles();
	    if(isset($_POST['add']))
		{
		    
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('role', 'Role Name', 'required');
			$this->form_validation->set_rules('status', 'Role Status', 'required');
		
			if($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/role/roles',$data); 
			    $this->load->view('admin/includes/footer');
			}
			else
			{
			    $roledata = array(
			        'rolename' => $this->input->post('role'),
			        'roleDesc' => $this->input->post('desc'),
			        'is_active' => $this->input->post('status'),
			        );
				$this->Rolemodel->insert($roledata);
				$this->session->set_flashdata('success','New record inserted...');
				redirect('admin/role');
			}
		}
		else
		{
		    $this->load->view('admin/includes/header');
			$this->load->view('admin/role/roles',$data); 
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function edit(){
	    if(isset($_POST['edit']))
		{
		    $roleid=$this->input->post('roleid'); //echo $roleid;die();
			$data['roleDet']=$this->Rolemodel->get($roleid);
			$this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('role', 'Role Name', 'required');
			$this->form_validation->set_rules('status', 'Role Status', 'required');
		
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/role/roles',$data); 
			    $this->load->view('admin/includes/footer');
			}
			else
			{
				$roledata = array(
			        'rolename' => $this->input->post('role'),
			        'roleDesc' => $this->input->post('desc'),
			        'is_active' => $this->input->post('status'),
			        );
				$this->Rolemodel->update($roleid,$roledata);
				$this->session->set_flashdata('success','Role details updated...');
				redirect('admin/role');
			}
		}
		else
		{
		    $data['role']=$this->Rolemodel->listroles();
			$roleid=$this->input->post('roleid'); //echo $roleid;die();
			$data['roleDet']=$this->Rolemodel->get($roleid);
			$this->load->view('admin/includes/header');
			$this->load->view('admin/role/roles',$data); 
			$this->load->view('admin/includes/footer');
		}
	}
	
	public function permission(){
		if(isset($_POST['assign']))
		{
			$roleid=$this->input->post('roleid');
			$length_module=$this->input->post('length_module');
			for ($i = 0; $i < $length_module; $i++) { // Assuming 2 rows of checkboxes, update the number as needed
				
					$module_id=$_POST['modulename'.$i];
					$can_view = isset($_POST['checkbox_row_v'.$i]) ? 1 : 0;
					$can_add = isset($_POST['checkbox_row_a'.$i]) ? 1 : 0;
					$can_edit = isset($_POST['checkbox_row_e'.$i]) ? 1 : 0;
					$can_delete = isset($_POST['checkbox_row_d'.$i]) ? 1 : 0;
					$can_approve = isset($_POST['checkbox_row_ap'.$i]) ? 1 : 0;
					
					$data = array(
							'roleid' => $roleid,
							'moduleid' => $module_id,
							'can_add' => $can_add,
							'can_edit' => $can_edit,
							'can_delete' => $can_delete,
							'can_view' => $can_view,
							'can_approve' => $can_approve,
					);
					$check_privilege_exist=$this->Rolemodel->check_privilege_exist($roleid,$module_id);
					if(empty($check_privilege_exist)){
						$this->Rolemodel->insertprivilege($data);
					}else{
						$this->Rolemodel->updateprivilege($data,$check_privilege_exist->privilegeid);
					}		
			}
			$data['roleDet']=$this->Rolemodel->get($roleid);
			$data['modules']=$this->Rolemodel->listmodules();
			$data['permissions']=$this->Rolemodel->fetchaccessmodule($roleid);
            $this->session->set_flashdata('success','Permissions updated successfully');
			$this->load->view('admin/includes/header');
			$this->load->view('admin/role/permissions',$data); 
			$this->load->view('admin/includes/footer'); 
		
		}else{
				$roleid=$this->input->post('roleid');
				$data['roleid']=$roleid;
				$data['roleDet']=$this->Rolemodel->get($roleid);
				$data['modules']=$this->Rolemodel->listmodules();
				$data['permissions']=$this->Rolemodel->fetchaccessmodule($roleid);
				$this->load->view('admin/includes/header');
				$this->load->view('admin/role/permissions',$data); 
				$this->load->view('admin/includes/footer');
			}
	}
}
