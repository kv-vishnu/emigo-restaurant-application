<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {

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
		$this->load->model('admin/Taxmodel');
        $this->load->model('admin/Countrymodel');
        $this->load->model('admin/Tablemodel');
        $this->load->model('admin/Storemodel');
		$this->load->model('admin/Packagemodel');

		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}


    public function load_store_tables_iframe($store_id) {
        $data['store_id'] = $store_id; // Pass the store_id to the view
        $data['storeDet'] = $this->Storemodel->get($store_id);
		// print_r($data['storeDet']);
        $data['store_name'] = $data['storeDet'][0]['store_name'];
		$data['packages'] = $this->Packagemodel->listpackages();
        $data['tables'] = $this->Tablemodel->getTablesByStoreId($data['store_id']);//print_r($data['tables']);

		$data['whatsappNo']=$this->Tablemodel->getwhatsapp($store_id);

		// $data['store']
		$this->load->view('admin/table/qrcode',$data);
        $this->load->view('admin/table/tables',$data);
    }

	public function load_store_Qr_code_tables_iframe($store_id){
		$data['store_id'] = $store_id; // Pass the store_id to the view
		// print_r($data['store_id']);
        $data['storeDet'] = $this->Storemodel->get($store_id);
        $data['store_name'] = $data['storeDet'][0]['store_name'];
		$data['packages'] = $this->Packagemodel->listpackages();
        $data['tables'] = $this->Tablemodel->getTablesByStoreId($store_id);
		// $data['whatsappNo']=$this->Tablemodel->getwhatsapp($store_id);

		// echo $data['whatsappNo'];
		$this->load->view('admin/table/tables',$data);


	}


	public function updateTableStatus(){
	$store_id = $this->session->userdata('logged_in_store_id');
	// echo $store_id;
	$checkbox = $this->input->post('isChecked');
	$whatsappno = $this->input->post('selectedVal');
	$tablename = $this->input->post('tablename');
	$store_id= $this->input->post('storeid');
	$tabletype= $this->input->post('tableType');
	echo json_encode(['checkbox' => $checkbox, 'whatsappno' => $whatsappno, 'tablename' => $tablename, 'storeid' => $store_id, 'tableType' => $tabletype]);
	if($tabletype == 'delivery'){
	$this->Tablemodel->updateDeliveryStatus($checkbox , $whatsappno, $store_id );
	}
	else if($tabletype == 'pickup'){
	$this->Tablemodel->updatePickupStatus($checkbox , $whatsappno, $store_id );
	}
	else if($tabletype == 'table'){
     $this->Tablemodel->updateTableStatus($checkbox , $whatsappno, $store_id, $tablename);
	}
	// echo $whatsappno;
	// echo $checkbox;



	}




	public function delete(){
		//echo "here";exit;
		$store_id = $this->input->post('store_id');
	    $this->Tablemodel->delete($this->input->post('id'));
		$data['storeDet'] = $this->Storemodel->get($store_id);//deduct no of table count when delete table using store id
		$updatedTableNumber = $data['storeDet'][0]['no_of_tables']-1;
		$updatedNuOfTables = array(
			'no_of_tables' => $updatedTableNumber
		);
		//echo "here";exit;
		$this->Tablemodel->updateNumberOfTable($store_id , $updatedNuOfTables);
		$this->session->set_flashdata('error','Table deleted successfully');
		redirect('admin/table/load_store_tables_iframe/'.$store_id);
	}

	public function add(){
		$data['packages'] = $this->Packagemodel->listpackages();
		$data['tables']=$this->Tablemodel->getTablesByStoreId($this->input->post('current_store_id_hidden'));//print_r($data['tables']);exit();
        $data['store_id'] = $this->input->post('current_store_id_hidden');
        $data['storeDet'] = $this->Storemodel->get($data['store_id']);//print_r($data['storeDet']);
		$old_Package_quantity_row = $this->Packagemodel->get($data['storeDet'][0]['no_of_tables']); //This return Package id
		$old_Package_quantity = $old_Package_quantity_row[0]['no_of_quantity']; //Return Old package quantity(no_of_tables) when change package
		//print_r($current_Package_quantity);exit;
        $data['store_name'] = $data['storeDet'][0]['store_name'];
	    if(isset($_POST['add']))
		{

		    $this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('package_name', 'Package ', 'required|callback_tablename_exists');


			if($this->form_validation->run() == FALSE)
			{
			    $this->load->view('admin/table/tables',$data);
			}
			else
			{
				$current_Package_quantity_row = $this->Packagemodel->get($this->input->post('package_name'));
				$current_Package_quantity = $current_Package_quantity_row[0]['no_of_quantity']; //Return Current package quantity(no_of_tables) when change package
				//echo $old_Package_quantity;echo $current_Package_quantity;exit;
				if($old_Package_quantity < $current_Package_quantity)
				{
					$new_row_count = $current_Package_quantity - $old_Package_quantity; //Retaurn new row inserted (Difference))
					$table_count = count($data['tables'])+1;//exit; Total number o table count for continue table names using loop

					for($i=0;$i<$new_row_count;$i++){
						$data = array(
							    'store_id' => $this->input->post('current_store_id_hidden'),
								'table_name' => 'Table ' . $table_count++,
							    'qr_code' => '',
							    'store_table_token' => '',
							    'is_active' => 1,
							    );
								$this->Tablemodel->insert($data);
					}
					$updatePackage = array(
						'no_of_tables' => $this->input->post('package_name')
					);
					$this->Tablemodel->updateNumberOfTable($this->input->post('current_store_id_hidden') , $updatePackage); //Update package id in store table when change package through change no of tables
					$this->session->set_flashdata('success','Package changed successfully...');
					redirect('admin/table/load_store_tables_iframe/'.$this->input->post('current_store_id_hidden'));
				}else
				{
					$this->session->set_flashdata('error','Current package quantity is less than old package quantity...');
					redirect('admin/table/load_store_tables_iframe/'.$this->input->post('current_store_id_hidden'));
				}
			}
		}
		else
		{
			$this->load->view('admin/table/tables',$data);
		}
	}

	public function edit(){
        $data['tables'] = $this->Tablemodel->getTablesByStoreId($store_id);
	    if(isset($_POST['edit']))
		{

		    $id=$this->input->post('id'); //echo $id;die();
			$data['taxDet']=$this->Taxmodel->get($id);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('country_id', 'Country name', 'required');
			$this->form_validation->set_rules('tax_type', 'Tax type', 'required');
			$this->form_validation->set_rules('tax_rate', 'Tax rate', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/tax/taxes',$data);
			    $this->load->view('admin/includes/footer');
			}
			else
			{

				$data = array(
			        'country_id' => $this->input->post('country_id'),
					'tax_type' => $this->input->post('tax_type'),
			        'tax_rate' => $this->input->post('tax_rate'),
			        'is_active' => 1,
			        );
				$this->Taxmodel->update($id,$data);
				$this->session->set_flashdata('success','Tax details updated...');
				redirect('admin/tax');
			}
		}
		else
		{
			$id=$this->input->post('id'); //echo $roleid;die();
			$data['taxDet']=$this->Tablemodel->get($id);
			$this->load->view('admin/table/tables',$data);
		}
	}

	public function tablename_exists($country)
	{
		$store_id = $this->input->post('current_store_id_hidden');
		if ($this->Tablemodel->check_tablename_exists($country , $store_id)) {
			$this->form_validation->set_message('tablename_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}