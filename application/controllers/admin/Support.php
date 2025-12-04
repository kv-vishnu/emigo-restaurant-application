<?php class Support extends My_Controller {
public function __construct() {   
    parent::__construct();
    $this->load->model('admin/Storemodel');
    $this->load->model('admin/Countrymodel');
    $this->load->model('admin/Packagemodel');
    $this->load->model('admin/Taxmodel');
    $this->load->model('admin/Usermodel');
    $this->load->model('admin/Tablemodel');
    $this->load->model('admin/Packagemodel');
    
    require('Common.php');
    if (!$this->session->userdata('login_status')) {
        redirect(login);
    }
}

//MARK: Support
public function index()
{
    $data['title'] = "Support";
    $data['countries']=$this->Countrymodel->listcountries();
    $this->render_admin_header('admin/support', $data);
}



}