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
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Stock_model');
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{
        $data['consumables']=$this->Stock_model->listconsumables();
	    $data['stock']=$this->Stock_model->liststock();
		$data['available']=$this->Stock_model->listavailablestock();

		$this->load->view('includes/header');
		$this->load->view('stock/stock',$data);
		$this->load->view('includes/footer');
	}
	public function delete(){
	    $this->Stock_model->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Stock deleted successfully');
	}
	public function add(){
        $data['consumables']=$this->Stock_model->listconsumables();
	    $data['stock']=$this->Stock_model->liststock();
		$data['available']=$this->Stock_model->listavailablestock();

	    if(isset($_POST['add']))
		{
		    
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('consumable', 'Consumable', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');

			//$this->form_validation->set_rules('status', 'Stock Status', 'required');
		
			if($this->form_validation->run() == FALSE) 
			{
				$this->load->view('includes/header');
                $this->load->view('stock/stock',$data);
			    $this->load->view('includes/footer');
			}
			else
			{
			    $stockdata = array(
			        'consumable_id' => $this->input->post('consumable'),
			        'qty' => $this->input->post('quantity'),
                    'stock_add_date' => date('Y-m-d',strtotime($this->input->post('stock_add_date'))),
			        'is_active' => 1
			        );
				$this->Stock_model->insert($stockdata);
				$this->session->set_flashdata('success','New record inserted...');
				redirect('stock');
			}
		}
		else
		{
		    $this->load->view('includes/header');
            $this->load->view('stock/stock',$data);
			$this->load->view('includes/footer');
		}
	}
	
	public function edit(){
	    if(isset($_POST['edit']))
		{
		    $id=$this->input->post('id');
            $data['consumables']=$this->Stock_model->listconsumables();
            $data['stock']=$this->Stock_model->liststock();
			$data['StockDet']=$this->Stock_model->get($id);
			$data['available']=$this->Stock_model->listavailablestock();

			$this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('consumable', 'Consumable', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');

			$this->form_validation->set_rules('status', 'Stock Status', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('includes/header');
                $this->load->view('stock/stock',$data);
			    $this->load->view('includes/footer');
			}
			else
			{
                $stockdata = array(
			        'consumable_id' => $this->input->post('consumable'),
			        'qty' => $this->input->post('quantity'),
                    'stock_add_date' => date('Y-m-d',strtotime($this->input->post('stock_add_date'))),
			        'is_active' => $this->input->post('status')
			        );
				$this->Stock_model->update($id,$stockdata);
				$this->session->set_flashdata('success','Stock details updated...');
				redirect('stock');
			}
		}
		else
		{
            $data['consumables']=$this->Stock_model->listconsumables();
            $data['stock']=$this->Stock_model->liststock();
			$id=$this->input->post('id'); //echo $roleid;die();
			$data['StockDet']=$this->Stock_model->get($id);
			$data['available']=$this->Stock_model->listavailablestock();

			$this->load->view('includes/header');
            $this->load->view('stock/stock',$data);
			$this->load->view('includes/footer');
		}
	}
	
	
}
