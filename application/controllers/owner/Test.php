<?php
class Test extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Storemodel');
        $this->load->model('admin/Productmodel');
		// $this->load->model('admin/Countrymodel');
		// $this->load->model('admin/Packagemodel');
		// $this->load->model('admin/Taxmodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	} 

    public function index()
	{
        $data['products']=$this->Productmodel->shopAssignedProducts();

        

       
        //  print_r($data['productss']); exit;


		$this->load->view('owner/includes/header');
		$this->load->view('owner/catalog/test',$data);
		$this->load->view('owner/includes/footer');


	}

    public function getlikes(){
        $search = $this->input->get('search',true);
        $store_id = $this->session->userdata('logged_in_store_id')?? 0;
        $productss=$this->Productmodel->getlikemethod($search,$store_id);
        if (!empty($productss)) {
            foreach ($productss as $product) {
                echo '<div>' . htmlspecialchars($product['product_name_en']) . '</div>';
            }
        } else {
            echo '<div>No products found.</div>';
        }
        
        
    }



}
?>