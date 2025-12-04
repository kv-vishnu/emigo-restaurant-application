<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('application/libraries/dompdf/autoload.inc.php');

// excel
require_once('application/third_party/PHPExcel-1.8/Classes/PHPExcel.php');
// require_once ('application/libraries/phpexcel/autoload.php');
// use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Style\Fill;
// use PhpOffice\PhpSpreadsheet\Style\Border;
// use PhpOffice\PhpSpreadsheet\Style\Alignment;

use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;

class Store extends My_Controller {

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
		$this->load->model('admin/Countrymodel');
		$this->load->model('admin/Packagemodel');
		$this->load->model('admin/Taxmodel');
		$this->load->model('admin/Usermodel');
		$this->load->model('admin/Tablemodel');
		$this->load->model('admin/Packagemodel');
		$this->load->model('admin/Commonmodel');

		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	//MARK: - Add store view
	public function addstore(){
		$data['countries']=$this->Countrymodel->listcountries();
		$data['packages']=$this->Packagemodel->listpackages();
		$this->render_admin_header('admin/store/addstore', $data);
	}
	//MARK: - Edit store view
	public function editstore($id){
		$data['countries']=$this->Countrymodel->listcountries();
		$data['storeDet']=$this->Storemodel->get($id);
		$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($data['storeDet'][0]['store_country']);
		$data['packages']=$this->Packagemodel->listpackages();
		$this->render_admin_header('admin/store/editstore', $data);
	}

	//MARK: - Store list
	public function all()
	{
		$data['taxes']=$this->Taxmodel->listtaxes();  //print_r($data['taxes']);
        $data['countries']=$this->Countrymodel->listcountries();
		$data['stores']= $this->Commonmodel->get_records('store', true, 'is_active');/* if false return all datas */
		$data['storeDet']=$this->Storemodel->get(63);
		$this->render_admin_header('admin/store/stores', $data);
	}

	//MARK: - Pending stores
	public function pending()
    {
        $data['pendingstores']=$this->Commonmodel->get_unapproved_records($table='store');
        $this->render_admin_header('admin/pendingstores', $data);
    }

	//MARK: - Disabled list
	public function disabled()
	{
		$data['taxes']=$this->Taxmodel->listtaxes();
        $data['countries']=$this->Countrymodel->listcountries();
		$data['stores']= $this->Commonmodel->get_inactive_records('store');
		$data['storeDet']=$this->Storemodel->get(63);
		$this->render_admin_header('admin/store/disabled_stores', $data);
	}

	//MARK: - Delete store
	public function delete(){
		$id = $this->input->post('id');
		$store_details = $this->Commonmodel->get_store_details_by_id($id);
		unlink('./uploads/store/'.$store_details->store_logo_image);
		$this->Commonmodel->delete_record('store', ['store_id' => $id]);
	}

	//MARK: - Approve store
	public function approve()
	{
        $id=$this->input->post('id');
        $this->Commonmodel->approve_record('store','is_approve',['store_id' => $id]);
        $this->Commonmodel->approve_record('users','is_active',['userid' => $id]);
		$this->create_login_qr_code($id);
    }
	public function create_login_qr_code($id)
	{
		$store_id = $id;
		//$hash = md5($store_id);
		$hash = $store_id;
		require_once BASEPATH . 'libraries/phpqrcode/qrlib.php';
		$codeContents = base_url() . 'admin/login/' . $hash;
		$qrCodeDir = FCPATH . 'uploads/admin_login_qr_codes/';
		if (!file_exists($qrCodeDir)) {
			mkdir($qrCodeDir, 0755, true);
		}
		$qr_name = 'store_' . $store_id . '.png';
		$qrCodePath = $qrCodeDir . $qr_name;
		QRcode::png($codeContents, $qrCodePath, QR_ECLEVEL_L, 10, 2);
		$qrCodeUrl = base_url('uploads/admin_login_qr_codes/' . $qr_name);
		$data = array(
			'admin_login_qr' => $qrCodeUrl,
		);
		$this->Commonmodel->update('store', ['store_id' => $store_id], $data);
	}
	//MARK: - Store disable
	public function disable()
	{
		$id     = $this->input->post('id');
		$type   = $this->input->post('type'); // 'store' or 'product'
		if ($type == 'store') {
			$this->Commonmodel->disable_record('store', 'is_active', ['store_id' => $id]);
		} elseif ($type == 'product') {
			$this->Commonmodel->disable_record('products', 'is_active', ['product_id' => $id]);
		}
		echo json_encode(['status' => 'success']);
	}

	//MARK: - Enable store
	public function enable()
	{
		$id     = $this->input->post('id');
		$type   = $this->input->post('type'); // 'store' or 'product'
		if ($type == 'store') {
			$this->Commonmodel->enable_record('store', 'is_active', ['store_id' => $id]);
		} elseif ($type == 'product') {
			$this->Commonmodel->enable_record('products', 'is_active', ['product_id' => $id]);
		}
		echo json_encode(['status' => 'success']);
	}


	public function add(){
		if ($this->session->userdata('last_insert_store_id')) {
			$data['store_details'] = $this->Storemodel->get($this->session->userdata('last_insert_store_id'));
		}
		$data['packages']=$this->Packagemodel->listpackages();
		$data['countries']=$this->Countrymodel->listcountries();
		$this->load->view('admin/includes/header');
		$this->load->view('admin/store/add',$data);
		$this->load->view('admin/includes/footer');
	}
	public function add_store(){
		$data['packages']=$this->Packagemodel->listpackages();
		$data['countries']=$this->Countrymodel->listcountries();
		if ($this->input->method() === 'post') {

				// echo "here1";exit;
                if(!empty($_FILES['store_logo_image']['name'])){
					$config['upload_path'] = './uploads/store/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['store_logo_image']['name'];
					// print_r($config['file_name']); exit;

					// echo "image here"; exit;


					$this->load->library('upload',$config);
					$this->upload->initialize($config);

				if($this->upload->do_upload('store_logo_image')){
						$uploadData = $this->upload->data();
						$store_logo_image = $uploadData['file_name'];
						// echo $store_logo_image;exit;
				}else{
					   $uploaderr=$this->upload->display_errors();
                    //    echo $uploaderr;exit;
					}
				}else{
					$store_logo_image = '';
				}




				if($this->input->post('bill_no') == ''){  //GST Registration number
					$bill_no = 0;
				}else{
					$bill_no = $this->input->post('bill_no'); //GST Registration number
				}

				// print_r($store_logo_image);exit;

				$checkbox_values = $this->input->post('checkbox');
        		$checkbox_string = implode(",", $checkbox_values);// Convert array to comma-separated values if needed

				$checkbox_pickup_or_take_away = $this->input->post('checkbox_pickup_or_take_away'); //if checked 1 else 0
				$checkbox_dining = $this->input->post('checkbox_dining');
				$checkbox_delivery = $this->input->post('checkbox_delivery');

				$pickup_country_code = $this->input->post('pickup_country_code');
                $dining_country_code =  $this->input->post('dining_country_code');
                $delivery_country_code =  $this->input->post('delivery_country_code');

				$txt_pickup_or_take_away = $this->input->post('txt_pickup_or_take_away'); //if checked 1 else 0
				$txt_dining = $this->input->post('txt_dining');
				$txt_delivery = $this->input->post('txt_delivery');

				  // Concatenate the values
				  $combinedPickupNumber = $pickup_country_code . $txt_pickup_or_take_away;
				  $combinedDiningNumber = $dining_country_code . $txt_dining;
				  $combinedDeliveryNumber =  $delivery_country_code . $txt_delivery;
				  $is_whatsapp = $this->input->post('is_whatsapp_check');

			    $data = array(
					'store_disp_name' => $this->input->post('disp_name'),
			        'store_name' => $this->input->post('name'),
			        'store_desc' => $this->input->post('store_desc'),
			        'store_email' => $this->input->post('email'),
			        'store_phone' => $this->input->post('phone'),
                    'store_address' => $this->input->post('address'),
					'contact_person_name' => $this->input->post('contact_person_name'),
                	'contact_person_phone' => $this->input->post('contact_person_phone'),
                	'contact_person_designation' => $this->input->post('contact_person_designation'),
                    'store_opening_time' => 0,
					'store_closing_time' =>0,
					'contract_start_date' => $this->input->post('contract_start_date'),
					'contract_end_date' => $this->input->post('contract_end_date'),
					'next_followup_date' => $this->input->post('next_followup_date'),
					'no_of_tables' => $this->input->post('no_of_tables'),
					'store_trade_license' => $this->input->post('trade_license'),
                    'store_location' => $this->input->post('location'),
                    'store_country' => $this->input->post('country'),
					'gst_or_tax' => $this->input->post('gst_or_tax'),
					'registration_no' => $bill_no,
					'store_language' => $this->input->post('language'),
					'is_table_tab' => $this->input->post('is_table_tab') ?? 0,
					'is_pickup_tab' => $this->input->post('is_pickup_tab') ?? 0,
					'is_delivery_tab' => $this->input->post('is_delivery_tab') ?? 0,
					'is_room_tab' => $this->input->post('is_room_tab') ?? 0,
					'store_selected_languages' => $checkbox_string,
					'is_pickup' => 0,
					'pickup_number' => 0,
					'is_dining' => 0,
					'dining_number' => 0,
					'is_delivery' => 0,
					'delivery_number' => 0,
					'store_logo_image' => $store_logo_image,
					'whatsapp_enable' => 0,
			        'is_active' => 1,
					'is_approve'=> 1
			        );

				//print_r($data);exit;

				$package_details = $this->Packagemodel->get($this->input->post('no_of_tables'));
				// print_r($package_details); exit;

				//When add store select packege id then find no_of_quantity in the package table
				$last_insert_store_id = $this->Storemodel->insert($data);
				$this->session->set_userdata('last_insert_store_id', $last_insert_store_id);
				$this->session->set_userdata('last_insert_store_name', $this->input->post('name'));


				for ($i = 1; $i <= $package_details[0]['no_of_quantity']; $i++) {
					$data = array(
						'store_id' => $last_insert_store_id,
						'table_name' => 'Table '.$i,
						'qr_code' => '',
						'store_table_token' => '',
						'ttype'=> 'tbl',
						'is_active' => 1,
					);
					$this->Storemodel->insert_store_table($data);
				}




					$data = array(
						'userroleid' => 2,
						'store_id' => $last_insert_store_id,
						'Name' => $this->input->post('name'),
						'userEmail' => $this->input->post('email'),
						'userName' => $this->input->post('username'),
						'userPassword' => md5(trim($this->input->post('password'))),
						'userPhoneNumber' => $this->input->post('phone'),
						'userAddress' => $this->input->post('address'),
						'profileimg' => '',
						'is_active' => 1,
			        );
					$this->Usermodel->insert($data);

					$data = array(
						'userroleid' => 2,
						'store_id' => $last_insert_store_id,
						'Name' => $this->input->post('name'),
						'userEmail' => $this->input->post('email'),
						'userName' => $this->input->post('user_username'),
						'userPassword' => md5(trim($this->input->post('user_password'))),
						'userPhoneNumber' => $this->input->post('phone'),
						'userAddress' => $this->input->post('address'),
						'profileimg' => '',
						'is_active' => 1,
			        );
					$this->Usermodel->insert($data);
		}
	}

	//MARK: - Edit store
	public function edit(){
		$data['countries']=$this->Countrymodel->listcountries();
	    if(isset($_POST['edit']))
		{
		    $id=$this->input->post('id');    /* echo $id;die(); */
			$data['storeDet']=$this->Storemodel->get($id);
			$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('hiddencountry'));    /* when edit get country tax rates using hidden country */
			$this->form_validation->set_rules('disp_name', 'Display Name', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|callback_validate_phone');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('contract_start_date', 'Contract Start Date', 'required');
			/* $this->form_validation->set_rules('store_trade_license', 'Trade License', 'required');
			$this->form_validation->set_rules('store_location', 'Location', 'required'); */
			$this->form_validation->set_rules('gst_or_tax', 'Tax rate', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('language', 'Language', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->render_admin_header('admin/store/editstore', $data);
			}
			else
			{
				//echo "here1";exit;
				if(!empty($_FILES['store_logo_image']['name'])){
					$image_path = './uploads/store/' . $this->input->post('old_image');
					if (file_exists($image_path)) {
						unlink($image_path);
					}
					$config['upload_path'] = './uploads/store/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['store_logo_image']['name'];


					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('store_logo_image')){
						$uploadData = $this->upload->data();
						$store_logo_image = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();

					}
				}else{
					$store_logo_image = $this->security->xss_clean($this->input->post('old_image'));
				}

				$checkbox_values = $this->input->post('checkbox');
        		$checkbox_string = implode(",", $checkbox_values);// Convert array to comma-separated values if needed

				$checkbox_pickup_or_take_away = $this->input->post('checkbox_pickup_or_take_away'); //if checked 1 else 0
				$checkbox_dining = $this->input->post('checkbox_dining');
				$checkbox_delivery = $this->input->post('checkbox_delivery');

				$txt_pickup_or_take_away = $this->input->post('txt_pickup_or_take_away'); //if checked 1 else 0
				$txt_dining = $this->input->post('txt_dining');
				$txt_delivery = $this->input->post('txt_delivery');

				$taxRate= $this->input->post('gst_or_tax');
				$is_whatsapp = $this->input->post('is_whatsapp_check');
				//  print_r($taxRate); exit;

				if($taxRate == 1){
					$bill_no = 0;

				}else{
					$bill_no = $this->input->post('bill_no');
				}

				$data = array(
					'store_disp_name' => $this->input->post('disp_name'),
					'store_name' => $this->input->post('name'),
			        'store_desc' => $this->input->post('store_desc'),
			        'store_email' => $this->input->post('email'),
			        'store_phone' => $this->input->post('phone'),
                    'store_address' => $this->input->post('address'),
					'contact_person_name' => $this->input->post('contact_person_name'),
                	'contact_person_phone' => $this->input->post('contact_person_phone'),
                	'contact_person_designation' => $this->input->post('contact_person_designation'),
					'contract_start_date' => $this->input->post('contract_start_date'),
					'contract_end_date' => $this->input->post('contract_end_date'),
					'next_followup_date' => $this->input->post('next_followup_date'),
					'no_of_tables' => $this->input->post('no_of_tables'),
					'store_trade_license' => $this->input->post('store_trade_license'),
                    'store_location' => $this->input->post('store_location'),
                    'store_country' => $this->input->post('country'),
				    'gst_or_tax' => $taxRate,
					'registration_no' => $bill_no,
					'store_language' => $this->input->post('language'),
					'is_table_tab' => $this->input->post('is_table_tab'),
					'is_pickup_tab' => $this->input->post('is_pickup_tab'),
					'is_delivery_tab' => $this->input->post('is_delivery_tab'),
					'is_room_tab' => $this->input->post('is_room_tab'),
					'store_selected_languages' => $checkbox_string,
					'is_pickup' => 0,
					'pickup_number' => 0,
					'is_dining' => 0,
					'dining_number' =>0,
					'is_delivery' => 0,
					'delivery_number' => 0,
					'store_logo_image' => $store_logo_image,
					'whatsapp_enable' =>0,
			        'is_active' => $this->input->post('is_active'),
			    );

				$this->Storemodel->update($id,$data);

				$data = array(
						'userroleid' => 2,
						'store_id' => $id,
						'Name' => $this->input->post('name'),
						'userEmail' => $this->input->post('email'),
						'userName' => $this->input->post('username'),
						'userPassword' => md5(trim($this->input->post('password'))),
						'userPhoneNumber' => $this->input->post('phone'),
						'userAddress' => $this->input->post('address'),
						'profileimg' => '',
						'is_active' => 1,
			    );
				$this->Usermodel->insert($data);

				$data = array(
						'userroleid' => 3,
						'store_id' => $id,
						'Name' => $this->input->post('name'),
						'userEmail' => $this->input->post('email'),
						'userName' => $this->input->post('user_username'),
						'userPassword' => md5(trim($this->input->post('user_password'))),
						'userPhoneNumber' => $this->input->post('phone'),
						'userAddress' => $this->input->post('address'),
						'profileimg' => '',
						'is_active' => 1,
			        );
				$this->Usermodel->insert($data);

				$this->session->set_flashdata('success','Store details updated...');
				if($this->input->post('is_active') == 0)
				{
					redirect('admin/store/pending');
				}
				else
				{
					redirect('admin/store/all');
				}
			}
		}
	}

//MARK:  - Get Tax Rates
	public function getTaxRates(){
		$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('country_id'));
		echo '<option value="0">Not Applicable</option>';
            foreach($data['tax_rates'] as $rate) { ?>
				<option value="<?php echo $rate['tax_id']; ?>" data-type="<?php echo $rate['tax_type']; ?>">Applicable</option>
			<?php }
	}






	public function validate_phone($phone)
	{
		if (preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
			return true;
		} else {
			$this->form_validation->set_message('validate_phone', 'The {field} field must be a valid phone number.');
			return false;
		}
	}
}