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

class Qrcodes extends CI_Controller {

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
		$this->load->model('admin/Taxmodel');
		$this->load->model('admin/Tablemodel');

		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}


	public function index()
	{
	    $data['stores']=$this->Storemodel->liststores();
		$this->load->view('admin/includes/header');
		$this->load->view('admin/qrcode/qrcodes',$data);
		$this->load->view('admin/includes/footer');
	}

	public function pdf($storeID)
	{

		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id

         $store_details = $this->Commonmodel->get_admin_details_by_store_id($logged_in_store_id);
		//   print_r($store_details);exit;
        //  $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['Name'] = $store_details->Name;
		// print_r($data['Name']);exit;
        $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
         $data['support_email'] = $store_details->userEmail;
		$data['profileimg'] = $store_details->profileimg;$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;

		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id

         $store_details = $this->Commonmodel->get_admin_details_by_store_id($logged_in_store_id);
		//   print_r($store_details);exit;
        //  $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['Name'] = $store_details->Name;
		// print_r($data['Name']);exit;
        $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
         $data['support_email'] = $store_details->userEmail;
		$data['profileimg'] = $store_details->profileimg;
		//$store_id =  $this->input->post('store_id_hidden');
		$data['storeId'] = $storeID;
		$data['tableQrCodes'] = $this->Tablemodel->getTablesByStoreId($storeID);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/qrcode/listqrcodes',$data);
		$this->load->view('admin/footer',$data);
	}

	public function generatePdf($storeID) {

    $html = '';
    $dompdf = new Dompdf();

    // Load data for the PDF
    $data['tableQrCodes'] = $this->Tablemodel->getTablesByStoreId($storeID);
	// print_r($data['tableQrCodes']);exit;

    // Generate HTML content
    $html = $this->load->view('admin/qrcode/pdf-qrcodes4', $data, true);

    // Ensure images use absolute paths or URLs
    $html = str_replace('src="uploads/qr_codes/', 'src="' . base_url('uploads/qr_codes/'), $html);

    // Load HTML into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Enable remote access for images, if needed
    $options = $dompdf->getOptions();
    $options->set('isRemoteEnabled', true);
    $dompdf->setOptions($options);

    // Render and stream the PDF
    $dompdf->render();
    $dompdf->stream("QRCODE.pdf", array("Attachment" => 0));

	}

    public function generatePickupNumber() {
		$pickup_number = $this->input->post('pickup_number_hidden'); //echo $pickup_number;exit;
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = $pickup_number;
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}
	public function generatePickupQrCode() {
		$store_id = $this->session->userdata('last_insert_store_id');
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = base_url() . 'website/products/shop/' . $store_id.'/PK/0';
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}

	public function generatePickupQrCode1($store_id) {
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = base_url() . 'website/products/shop/' . $store_id.'/PK/0';
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}

	public function generateDiningNumber() {
		$pickup_number = $this->input->post('dining_number_hidden'); //echo $pickup_number;exit;
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = $pickup_number;
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}


		public function generateDiningQrCode() {
		$store_id = $this->session->userdata('last_insert_store_id');
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = base_url() . 'website/products/shop/' . $store_id.'/D';
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}

	public function generateDeliveryNumber() {
		$pickup_number = $this->input->post('delivery_number_hidden'); //echo $pickup_number;exit;
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = $pickup_number;
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}
	public function generateDeliveryQrCode1($store_id) {
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = base_url() . 'website/products/shop/' . $store_id.'/DL/0';
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}

	public function generateLocationQRCode() {
		$pickup_number = $this->input->post('location_hidden'); //echo $pickup_number;exit;
		 // Load the PHPQRCode library
		 require BASEPATH . 'libraries/phpqrcode/qrlib.php';
		 //$codeContents = 'https://www.example.com';
		 $codeContents = $pickup_number;
		 // Output image directly to browser
		 QRcode::png($codeContents, false, QR_ECLEVEL_L, 10, 2);
	}



	public function generateTableQRCode() {
		$store_id = $this->input->post('store_id_hidden');
		$store_name = $this->input->post('store_name_hidden');
		$table_id = $this->input->post('table_id_hidden');
		$year = date('Y');  // Get current year
		$month = date('m'); // Get current month
		$day = date('d');   // Get current day
		$token = $year . $month . $day . $table_id;

		require_once BASEPATH . 'libraries/phpqrcode/qrlib.php';   // Ensure correct path to QR code library

		$codeContents = base_url() . 'website/products/' . $token.'/0';  // e.g., URL http://localhost/codeigniter/website/home/token

		// Set the upload directory
		$qrCodeDir = FCPATH . 'uploads/qr_codes/';  // Use FCPATH to refer to the project root

		// Check if directory exists, if not create it
		if (!file_exists($qrCodeDir)) {
			mkdir($qrCodeDir, 0755, true);
		}

		// Path where the QR code will be saved
		$qrCodeFileName = $store_name . '_' . $table_id . '.png';
		$qrCodePath = $qrCodeDir . $qrCodeFileName;

		QRcode::png($codeContents, $qrCodePath, QR_ECLEVEL_L, 10, 2);
		$qrCodeUrl = base_url('uploads/qr_codes/' . $qrCodeFileName);

		$data = array(
			'qr_code' => $qrCodeUrl,
			'store_table_token' => $token
		);
		$this->Tablemodel->updateTableQRCode($table_id, $data);

		$this->session->set_flashdata('success','QR Code generated successfully');
		redirect('admin/table/load_store_tables_iframe/' . $store_id);
	}


	public function generateRoomQRCode() {
		$store_id = $this->input->post('store_id');
		$store_name = $this->input->post('store_name');
		$table_id = $this->input->post('table_id');
		$year = date('Y');  // Get current year
		$month = date('m'); // Get current month
		$day = date('d');   // Get current day
		$token = $year . $month . $day . $table_id;



		require_once BASEPATH . 'libraries/phpqrcode/qrlib.php';   // Ensure correct path to QR code library

		$codeContents = base_url() . 'website/products/' . $token.'/0';  // e.g., URL http://localhost/codeigniter/website/home/token

		// Set the upload directory
		$qrCodeDir = FCPATH . 'uploads/qr_codes/';  // Use FCPATH to refer to the project root

		// Check if directory exists, if not create it
		if (!file_exists($qrCodeDir)) {
			mkdir($qrCodeDir, 0755, true);
		}

		// Path where the QR code will be saved
		$qrCodeFileName = $store_name . '_' . $table_id . '.png';
		$qrCodePath = $qrCodeDir . $qrCodeFileName;

		QRcode::png($codeContents, $qrCodePath, QR_ECLEVEL_L, 10, 2);
		$qrCodeUrl = base_url('uploads/qr_codes/' . $qrCodeFileName);

		$data = array(
			'qr_code' => $qrCodeUrl,
			'store_table_token' => $token
		);

		$this->Tablemodel->updateTableQRCode($table_id, $data);
		echo json_encode(['status' => 'success','message' => 'QR Code generated successfully','table_id'=>$table_id]);
	}




	public function delete(){
	    $this->Storemodel->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Store deleted successfully');
	}

	public function download_vcf($phone_number) {
        // Set headers for VCF file download
        header('Content-Type: text/vcard; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$phone_number.'.vcf"');

        // VCF format
        $vcf = "BEGIN:VCARD\r\n";
        $vcf .= "VERSION:3.0\r\n";
//$vcf .= "FN:".$contactName."\r\n"; // Full name
        $vcf .= "TEL;TYPE=CELL:".$phoneNumber."\r\n"; // Phone number
        //$vcf .= "EMAIL:".$email."\r\n"; // Email address (optional)
        $vcf .= "END:VCARD\r\n";

        // Output VCF content
        echo $vcf;
        exit;
    }

	public function add(){
		$data['countries']=$this->Countrymodel->listcountries();
	    if(isset($_POST['add']))
		{

		    $this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('store_opening_time', 'Opening Time', 'required');
			$this->form_validation->set_rules('store_closing_time', 'Closing Time', 'required');
			$this->form_validation->set_rules('no_of_tables', 'No of Tables', 'required');
			$this->form_validation->set_rules('trade_license', 'Trade License', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('gst_or_tax', 'Tax rate', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('language', 'Language', 'required');
            $this->form_validation->set_rules('currency', 'Currency', 'required');


			if($this->form_validation->run() == FALSE)
			{
				//echo "here";exit;
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/store/add',$data);
			    $this->load->view('admin/includes/footer');
			}
			else
			{
				//echo "here1";exit;
                if(!empty($_FILES['store_logo_image']['name'])){
					$config['upload_path'] = './uploads/store/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['store_logo_image']['name'];


					$this->load->library('upload',$config);
					$this->upload->initialize($config);

					if($this->upload->do_upload('store_logo_image')){
						$uploadData = $this->upload->data();
						$store_logo_image = $uploadData['file_name'];
					}else{
					   $uploaderr=$this->upload->display_errors();
                       //echo $uploaderr;exit;
					}
				}else{
					$store_logo_image = '';
				}

				$checkbox_values = $this->input->post('checkbox');
        		$checkbox_string = implode(",", $checkbox_values);// Convert array to comma-separated values if needed

				$checkbox_pickup_or_take_away = $this->input->post('checkbox_pickup_or_take_away'); //if checked 1 else 0
				$checkbox_dining = $this->input->post('checkbox_dining');
				$checkbox_delivery = $this->input->post('checkbox_delivery');

				$txt_pickup_or_take_away = $this->input->post('txt_pickup_or_take_away'); //if checked 1 else 0
				$txt_dining = $this->input->post('txt_dining');
				$txt_delivery = $this->input->post('txt_delivery');

			    $data = array(
			        'store_name' => $this->input->post('name'),
			        'store_desc' => $this->input->post('store_desc'),
			        'store_email' => $this->input->post('email'),
			        'store_phone' => $this->input->post('phone'),
                    'store_address' => $this->input->post('address'),
                    'store_opening_time' => $this->input->post('store_opening_time'),
					'store_closing_time' => $this->input->post('store_closing_time'),
					'no_of_tables' => $this->input->post('no_of_tables'),
					'store_trade_license' => $this->input->post('trade_license'),
                    'store_location' => $this->input->post('location'),
                    'store_country' => $this->input->post('country'),
					'gst_or_tax' => $this->input->post('gst_or_tax'),
					'store_language' => $this->input->post('language'),
					'store_selected_languages' => $checkbox_string,
					'store_currency' => $this->input->post('currency'),
					'is_pickup' => $checkbox_pickup_or_take_away,
					'pickup_number' => $txt_pickup_or_take_away,
					'is_dining' => $checkbox_dining,
					'dining_number' => $txt_dining,
					'is_delivery' => $checkbox_delivery,
					'delivery_number' => $txt_delivery,
					'store_logo_image' => $store_logo_image,
			        'is_active' => 1,
			        );
				//print_r($data);exit;
				$last_insert_store_id = $this->Storemodel->insert($data);

				for ($i = 1; $i <= $this->input->post('no_of_tables'); $i++) {
					$data = array(
						'store_id' => $last_insert_store_id,
						'table_name' => 'Table '.$i,
						'qr_code' => '',
						'is_active' => 1,
					);
					$this->Storemodel->insert_store_table($data);
				}

				$this->session->set_flashdata('success','New record inserted...');
				redirect('admin/store');
			}
		}
		else
		{
		    $this->load->view('admin/includes/header');
			$this->load->view('admin/store/add',$data);
			$this->load->view('admin/includes/footer');
		}
	}

	public function edit(){
		//print_r($data['tax_rates']);exit;
		$data['countries']=$this->Countrymodel->listcountries();
	    if(isset($_POST['edit']))
		{
		    $id=$this->input->post('id'); //echo $roleid;die();
			$data['storeDet']=$this->Storemodel->get($id);
			$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('hiddencountry')); //when edit get country tax rates using hidden country
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('store_opening_time', 'Opening Time', 'required');
			$this->form_validation->set_rules('store_closing_time', 'Closing Time', 'required');
			$this->form_validation->set_rules('no_of_tables', 'No of Tables', 'required');
			$this->form_validation->set_rules('store_trade_license', 'Trade License', 'required');
			$this->form_validation->set_rules('store_location', 'Location', 'required');
			$this->form_validation->set_rules('gst_or_tax', 'Tax rate', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('language', 'Language', 'required');
            $this->form_validation->set_rules('currency', 'Currency', 'required');
			$this->form_validation->set_rules('is_active', 'Status', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				//echo "here";exit;
				$this->load->view('admin/includes/header');
			    $this->load->view('admin/store/edit',$data);
			    $this->load->view('admin/includes/footer');
			}
			else
			{
				//echo "here";exit;
				if(!empty($_FILES['store_logo_image']['name'])){
					$image_path = './uploads/store/' . $this->input->post('old_image');
					//echo $image_path;exit;
					unlink($image_path);
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

				$data = array(
					'store_name' => $this->input->post('name'),
			        'store_desc' => $this->input->post('store_desc'),
			        'store_email' => $this->input->post('email'),
			        'store_phone' => $this->input->post('phone'),
                    'store_address' => $this->input->post('address'),
                    'store_opening_time' => $this->input->post('store_opening_time'),
					'store_closing_time' => $this->input->post('store_closing_time'),
					'no_of_tables' => $this->input->post('no_of_tables'),
					'store_trade_license' => $this->input->post('store_trade_license'),
                    'store_location' => $this->input->post('store_location'),
                    'store_country' => $this->input->post('country'),
					'gst_or_tax' => $this->input->post('gst_or_tax'),
					'store_language' => $this->input->post('language'),
					'store_selected_languages' => $checkbox_string,
					'store_currency' => $this->input->post('currency'),
					'is_pickup' => $checkbox_pickup_or_take_away,
					'pickup_number' => $txt_pickup_or_take_away,
					'is_dining' => $checkbox_dining,
					'dining_number' => $txt_dining,
					'is_delivery' => $checkbox_delivery,
					'delivery_number' => $txt_delivery,
					'store_logo_image' => $store_logo_image,
			        'is_active' => $this->input->post('is_active'),
			        );
					//print_r($data);exit;
				$this->Storemodel->update($id,$data);
				$this->session->set_flashdata('success','Store details updated...');
				redirect('admin/store');
			}
		}
		else
		{
			//echo "this1=" . $this->input->post('id1');exit;
			$id=$this->input->post('id');
			$data['storeDet']=$this->Storemodel->get($id);//print_r($data['storeDet']);exit;
			$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($data['storeDet'][0]['store_country']); //when edit get country tax rates using hidden country id
			$this->load->view('admin/includes/header');
			$this->load->view('admin/store/edit',$data);
			$this->load->view('admin/includes/footer');
		}
	}

	public function getTaxRates(){
		$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('country_id'));
		echo '<option value="">Select Rate</option>';
            foreach($data['tax_rates'] as $rate) { ?>
                <option value="<?php echo $rate['tax_id']; ?>"><?php echo $rate['tax_rate']; ?></option>
            <?php }
	}

	public function valid_phone($phone_number) {
		$pattern = "/^\+?\d{1,3}?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/";
        $clean_phone_number = preg_replace('/\D/', '', $phone_number);
        if (preg_match('#[^0-9]#',$phone_number)) {
            $this->form_validation->set_message('valid_phone', 'The %s field must be digits.');
            return FALSE;
        }
		return TRUE;
    }
}
