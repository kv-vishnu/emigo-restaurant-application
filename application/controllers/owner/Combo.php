<?php class Combo extends CI_Controller {

public function __construct() {   
    parent::__construct();
    $this->load->model('admin/Productmodel');
    $this->load->model('admin/Storemodel');
    $this->load->model('owner/Ordermodel');
    $this->load->model('owner/Combomodel');
    $this->load->model('website/Homemodel');
}
public function index()
{
    $controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $data['products1']=$this->Productmodel->shopAssignedComboProducts();


        $store_details = $this->Homemodel->get_store_details_by_store_id($this->session->userdata('logged_in_store_id'));
        $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_no;
        $data['support_email'] = $support_details->support_email;
        $data['store_logo'] = $store_details->store_logo_image;
        
    // Update combo product statuses before rendering the view
    foreach ($data['products1'] as $key => $value) {
        $store_id = $value['store_id'];
        $store_product_id = $value['store_product_id']; // combo product ID
        $combo_items = $this->Combomodel->getComboItems($store_id, $store_product_id);
        $is_active = 0;
        if (empty($combo_items)) 
        {
            $this->Combomodel->updateStoreProductStatus($store_id, $store_product_id, 1); // Set to inactive
            continue; // Skip further processing for this combo product
        } 

        $is_active = 0;
        foreach ($combo_items as $item) 
        {
                $item_id = $item['item_id'];
                $required_quantity = $item['quantity'];
                $current_stock = $this->Ordermodel->getCurrentStock($item_id, date('Y-m-d'), $this->session->userdata('logged_in_store_id'));
                if ($current_stock < $required_quantity) {
                    $is_active = 1;
                    break;
                } 
        }
        $this->Combomodel->updateStoreProductStatus($store_id, $store_product_id, $is_active); 
        
    }

    // Fetch the date and logged-in store ID
    $data['products']=$this->Productmodel->shopAssignedComboProducts();
    $date = date('Y-m-d');
    $logged_store_id = $this->session->userdata('logged_in_store_id');
    $data['date'] = $date;

    // Load the views
    $this->load->view('owner/includes/header', $data);
    $this->load->view('owner/includes/owner-dashboard',$data);
    $this->load->view('owner/catalog/combo', $data);
    $this->load->view('owner/includes/footer');
}


public function deleteComboItems(){
    $this->Combomodel->deleteComboItems($this->input->post('id'));
}

public function load_combo($store_product_id) {
    $data['store_product_id'] = $store_product_id;
    $data['products']=$this->Combomodel->shopAssignedActiveProducts();
    $store_id= $this->session->userdata('logged_in_store_id');
    $data['comboItems']=$this->Combomodel->getComboItems($store_id,$store_product_id);
    $this->load->view('owner/catalog/assigned_combo',$data);
}
public function addComboItems() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('combo_id', ' product', 'required|greater_than[0]');
    $this->form_validation->set_rules('quanitity_id', 'Quanitity', 'required|greater_than[0]');
    if ($this->form_validation->run() == FALSE) 
    {
        $response = [
            'errors' => false,
            'errors' => [
                'combo_id' => form_error('combo_id'),
                'quanitity_id' => form_error('quanitity_id')
            ]
        ];
        echo json_encode($response);
    }
    else
    {
        $response = [
            'success' => true,
            'message' => 'Form validated successfully!'
        ];
        $productId = $this->input->post('store_product_id');
        $store_id=$this->session->userdata('logged_in_store_id');
        $combo_id = $this->input->post('combo_id');
        $quanitity = $this->input->post('quanitity_id'); 
        $result = $this->Combomodel->addComboItems($productId, $combo_id, $quanitity, $store_id);
        echo json_encode($response);
    }
}
public function UpdateComboItems(){
    $combo_item_id= $this->input->post('combo_item_id');
    $quantity= $this->input->post('qty');
    $result=$this->Combomodel->UpdateComboItems($combo_item_id,$quantity);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Item updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update item.']);
    }
}


}