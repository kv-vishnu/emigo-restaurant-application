<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

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
	 * 
	 * Check Stock availability - checkStockAvailability()
	 */
	
	public function __construct()
	{
		parent::__construct();
		require('Common.php');
        $this->load->model('admin/Productmodel');
		$this->load->model('owner/Ordermodel');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{
        $logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
        $data['products']=$this->Productmodel->shopAssignedProducts(); 
        $data['categories']=$this->Productmodel->listcategories();
		$this->load->view('owner/includes/header');
		$this->load->view('owner/stock/stock_entry',$data);
		$this->load->view('owner/includes/footer');
	}

    public function report() {
        $logged_in_store_id = $this->session->userdata('logged_in_store_id');//echo $logged_in_store_id;exit;
        $data['products']=$this->Productmodel->shopAssignedProducts(); 
        $data['categories']=$this->Productmodel->listcategories();
		$this->load->view('owner/includes/header');
		$this->load->view('owner/stock/stock_report',$data);
		$this->load->view('owner/includes/footer');
    }

	public function update() {
		$this->load->model('owner/Stockmodel');
		$products = $this->input->post('products'); //print_r($products);exit;
		$store_id = $this->input->post('store_id');
        $date = $this->input->post('date');
		if(isset($_POST['update'])){
			foreach ($products as $key => $order) {
				 $this->Stockmodel->CheckStockApprove($store_id,$date,$order['store_product_id'],$order['quantity'],$order['minqty'],$order['currentstock']);	
			}
			//exit;
		}
        $this->session->set_flashdata('success','Product details updated...');
        redirect('owner/stock');
	}


    public function getProductByDate() {
        $this->load->model('owner/Stockmodel');
        $this->load->model('owner/Ordermodel');
        $category_id = $this->input->post('category');
        $date = $this->input->post('date');//echo $date;echo $category_id;//exit;
        $products = $this->Stockmodel->getAllStockProducts($category_id);
        if (empty($products)) {
			echo "<p>No Products found for the selected date.</p>";
			return;
		}

		$accordionHtml = '';
		
		$accordionHtml = '<form method="post" action="' . base_url('owner/stock/update') . '">
		<input type="hidden" name="store_id" value="' . $this->session->userdata('logged_in_store_id') . '">
        <input type="hidden" name="date" value="' . $date . '">
		<div class="table-responsive">  
		<table class="table">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th width="25%">Product</th>
                    <th width="10%">Category</th>
					<th width="10%">Quantity</th>
					<th width="10%">Min.Qty</th>
					<th width="10%">Rate</th>	
                    <th width="10%">Current Stock</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($products as $index => $product) {
			$accordionHtml .= '
                <tr>
                    <td>' . $index + 1 . '</td>
                    <td>' . $this->Ordermodel->getProductName($product['store_product_id']) . '</td>
                    <td>' . $product['category_name_en'] . '</td>
					<td>
	<input type="hidden" readonly class="form-control" style="width: 100%;" name="products[' . $index . '][store_product_id]" value="' . $product['store_product_id'] . '">
					<input type="text" class="quantity form-control" name="products[' . $index . '][quantity]" style="width: 100%;" value="" />
					</td>
					<td><input type="text" class="quantity form-control" name="products[' . $index . '][minqty]" style="width: 100%;" value="" /></td>
					<td><input type="text" readonly class="form-control" style="width: 100%;" name="products[' . $index . '][rate]" value="' . $product['rate'] . '"></td>
					<input type="hidden" readonly class="form-control" style="width: 100%;" name="products[' . $index . '][currentstock]" value="' . $this->Ordermodel->getCurrentStock($product['store_product_id'] , $date , $this->session->userdata('logged_in_store_id')) . '">
                    <td>' . $this->Ordermodel->getCurrentStock($product['store_product_id'] , $date , $this->session->userdata('logged_in_store_id')) . '</td>
					
                </tr>';
		}
		$accordionHtml .= '</tbody>
		<tfoot class="table-light">
                <tr>
				    
                    <td colspan="12">
                        <div class="d-flex justify-content-end">
							<button class="btn btn-success" name="update" width="100px" style="margin-right: 10px;">update</button>
                        </div>
                    </td>
					
                </tr>
            </tfoot>
        </table></form>
		</div>';
	
		echo $accordionHtml;
    }


    public function getStockReport() {
        $this->load->model('owner/Stockmodel');
        $this->load->model('owner/Ordermodel');
        $category_id = $this->input->post('category');
        $date = $this->input->post('date');//echo $date;echo $category_id;//exit;
        $products = $this->Stockmodel->getAllStockReport($category_id , $date);
        if (empty($products)) {
			echo "<p>No Products found for the selected date.</p>";
			return;
		}

		$accordionHtml = '';
		
		$accordionHtml = '<form method="post" action="' . base_url('owner/stock/update') . '">
		<input type="hidden" name="store_id" value="' . $this->session->userdata('logged_in_store_id') . '">
        <input type="hidden" name="date" value="' . $date . '">
		<div class="table-responsive">  
		<table class="table">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th width="25%">Product</th>
                    <th width="10%">Category</th>
					<th width="10%">Stock Qty</th>
					<th width="10%">Sale Qty</th>
                    <th width="10%">Balance Qty</th>	
                </tr>
            </thead>
            <tbody>';
            foreach ($products as $index => $product) {
			$accordionHtml .= '
                <tr>
                    <td>' . $index + 1 . '</td>
                    <td>' . $this->Ordermodel->getProductName($product['product_id']) . '</td>
                    <td>' . $this->Ordermodel->getProductCategoryName($product['product_id']) . '</td>
					<td>' . $product['total_pu_qty'] . '</td>
                    <td>' . $product['total_sl_qty'] . '</td>
                    <td>' . $product['bal_qty'] . '</td>
                </tr>';
		}
		$accordionHtml .= '</tbody>
		<tfoot class="table-light">
                <tr>
				    
                    
					
                </tr>
            </tfoot>
        </table></form>
		</div>';
	
		echo $accordionHtml;
    }

	public function checkStockAvailability()
    {
        $product_id = $this->input->post('product_id');
        $quantity = 1;
        $store_id = $this->session->userdata('logged_in_store_id');
        $stock = $this->Ordermodel->getCurrentStock($product_id, date('Y-m-d'), $store_id);
        if ($stock > 0) 
		{
			echo json_encode(['success' => 'success', 'stock' => $stock]);
        } 
		else 
		{     
            $message =  $this->Ordermodel->getProductName($product_id) . ' is out of stock';
			echo json_encode(['success' => 'false', 'message' => $message]);
        }
    }
    
    public function delete_product()
	{
		$this->load->model('owner/Stockmodel');
		$product_id = $this->input->post('product_id');
		$store_id = $this->session->userdata('logged_in_store_id');
		if($this->Stockmodel->deleteProductByID($product_id,$store_id))
		{
			echo json_encode(['success' => 'false', 'message' => 'Product deleted successfully']);
		}
	}

}