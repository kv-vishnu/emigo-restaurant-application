<?php class Settings extends My_Controller {
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

public function index()
{
    $data['taxes']=$this->Taxmodel->listtaxes();  //print_r($data['taxes']);
    $data['countries']=$this->Countrymodel->listcountries();
    $data['stores']=$this->Storemodel->liststores();
    $this->render_admin_header('admin/settings/settings', $data);
}


public function Support(){
    $data['page'] = "support";
    $data['countries']=$this->Countrymodel->listcountries();
    $this->render_admin_header('admin/country/countries', $data); 
}
}