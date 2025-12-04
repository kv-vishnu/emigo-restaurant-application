<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_assign extends CI_Controller {

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
		$this->load->model('admin/Storemodel');
        $this->load->model('admin/Productmodel');
        $this->load->model('admin/Commonmodel');
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

    //MARK: - Load Products for Assign to Store
    public function load_products_for_assign($store_id)
    {
        $data['categories'] = $this->Commonmodel->listactivecategories();
        $data['store_id']   = $store_id;
        $data['products']   = $this->getProducts($store_id);
        $this->load->view('admin/catalog/store_assigned_products', $data);
    }
    private function getProducts($store_id, $category_id = null)
{
    $sql = "
        SELECT p.product_id, p.product_name_en, c.category_name_en,
               CASE WHEN sp.product_id IS NOT NULL THEN 1 ELSE 0 END AS is_assigned
        FROM product p
        JOIN categories c
             ON c.category_id = p.category_id
            AND c.is_active = 1   -- ✅ only active categories
        LEFT JOIN store_wise_product_assign sp
               ON sp.product_id = p.product_id
              AND sp.store_id = ?
        WHERE p.is_active = 1
    ";

    $params = [$store_id];

    if (!empty($category_id)) {
        $sql .= " AND p.category_id = ? ";
        $params[] = $category_id;
    }

    $sql .= " ORDER BY c.category_name_en, p.product_name_en";

    return $this->db->query($sql, $params)->result_array();
}


    public function filter()
    {
        $category_id = $this->input->post('category_id');
        $store_id    = $this->input->post('store_id');

        $products = $this->getProducts($store_id, $category_id);

        $html = $this->load->view('admin/partials/product_list', [
            'products' => $products
        ], true);

        echo $html;
    }

    public function save()
{
    $store_id     = $this->input->post('store_id');
    $selected     = $this->input->post('product_ids') ?? [];
    $category_id  = $this->input->post('category_id');

    // get already assigned
    $this->db->select('product_id, category_id')
             ->from('store_wise_product_assign')
             ->where('store_id', $store_id);

    if (!empty($category_id)) {
        $this->db->where('category_id', $category_id);
    }

    $already = $this->db->get()->result_array();
    $already_ids = array_column($already, 'product_id');

    // insert new
    foreach ($selected as $pid) {
        $product_details = $this->Commonmodel->get_product_details_by_id($pid);

        if (!in_array($pid, $already_ids)) {
            $this->db->insert('store_wise_product_assign', [
                'store_id' => $store_id,
                'product_id' => $pid,
                'subcategory_id' => 0,
                'vat_id' => 0,
                'type' => '',
                'rate' => '',
                'tax' => '',
                'tax_amount' => '',
                'total_amount' => '',
                'category_id' => $product_details->category_id,
                'is_addon' => '',
                'is_customizable' => '',
                'image' =>  $product_details->image1,
                'store_product_name_ma' =>  $product_details->product_name_ma,
                'store_product_name_en' =>  $product_details->product_name_en,
                'store_product_name_hi' =>  $product_details->product_name_hi,
                'store_product_name_ar' =>  $product_details->product_name_ar,
                'store_product_desc_ma' =>  $product_details->product_desc_ma,
                'store_product_desc_en' =>  $product_details->product_desc_en,
                'store_product_desc_hi' =>  $product_details->product_desc_hi,
                'store_product_desc_ar' =>  $product_details->product_desc_ar,
                'is_admin' => 1,
                'date_created' => date('Y-m-d H:i:s'),
                'created_by' => 'admin',
                'date_modified' => date('Y-m-d H:i:s'),
                'modified_by' => 'admin',
                'is_active' => 1
            ]);
        }
    }

    // delete unchecked
    foreach ($already_ids as $pid) {
        if (!in_array($pid, $selected)) {
            $where = [
                'store_id'   => $store_id,
                'product_id' => $pid
            ];
            if (!empty($category_id)) {
                $where['category_id'] = $category_id; // only for selected category
            }
            $this->db->delete('store_wise_product_assign', $where);
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Assignments updated']);
}



// 	public function load_products_for_assign($store_id) {
//         $data['store_id'] = $store_id;//exit; // Pass the store_id to the view
//         $data['storeDet'] = $this->Storemodel->get($store_id);
//         $data['store_name'] = $data['storeDet'][0]['store_name'];
//         $data['categories']=$this->Productmodel->listcategories();
//         $data['already_assigned_products_ids'] = $this->Productmodel->already_assigned_products_ids($store_id); //print_r($data['already_assigned_products_ids']);
//         $this->load->library('pagination');

// // Configuration (put this before using $config['per_page'])
// $config['per_page'] = 102;  // <--- THIS MUST EXIST
// $config['uri_segment'] = 0;
// $this->pagination->initialize($config);
// // Get current page offset
// $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// // Now safe to use:
// $data['products'] = $this->Productmodel->listproducts($page, $config['per_page']);
// $data['pagination'] = $this->pagination->create_links();
//         $page = ($this->uri->segment(0)) ? $this->uri->segment(0) : 0;
//         $limit = $config['per_page']; // must be defined before this line
//         $data['products'] = $this->Productmodel->listproducts($page,$limit);
//         $this->load->view('admin/catalog/store_assigned_products',$data);
//     }


    // public function update(){
    //     if(isset($_POST['update']))
    //     {
    //         $data['store_id']=$this->input->post('store_id_hidden'); //echo $id;die();
    //         $category_id=$this->input->post('category_id');
    //         $selected_items = $this->input->post('selected_items');  //print_r($selected_items);exit;
    //         $data['categories']=$this->Productmodel->listcategories();
    //         $data['already_assigned_products_ids'] = $this->Productmodel->already_assigned_products_ids($data['store_id']);
    //         $this->load->library('pagination');
    //         // Configuration (put this before using $config['per_page'])
    //         $config['per_page'] = 102;  // <--- THIS MUST EXIST
    //         $config['uri_segment'] = 0;
    //         $this->pagination->initialize($config);
    //         // Get current page offset
    //         $page = ($this->uri->segment(0)) ? $this->uri->segment(0) : 0;
    //         $data['products'] = $this->Productmodel->listproducts($page, $config['per_page']);
    //         $this->Productmodel->delete_update_assigned_products($data['store_id'],$category_id,$selected_items);
    //         //$this->load->view('admin/catalog/store_assigned_products',$data);
    //         redirect('admin/product_assign/load_products_for_assign/'.$data['store_id']);
    //     }
    //     else
    //     {
    //         $data['store_id']=$this->input->post('store_id_hidden'); //echo $id;die();
    //         $category_id=$this->input->post('category_id');
    //         $data['categories']=$this->Productmodel->listcategories();
    //         $data['already_assigned_products_ids'] = $this->Productmodel->already_assigned_products_ids($data['store_id']);
    //         if($category_id != ''){
    //             $data['products'] = $this->Productmodel->listproducts_category_wise($category_id);
    //         }else{
    //             $data['products'] = $this->Productmodel->listproducts();
    //         }
    //         //redirect('admin/product_assign/load_products_for_assign/'.$data['store_id']);
    //         $this->load->view('admin/catalog/store_assigned_products',$data);
    //     }
    // }


}