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

class Store extends CI_Controller {

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
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function edit( $store_id = NULL){
        //echo $store_id;exit;
		$data['countries']=$this->Countrymodel->listcountries();
	    if(isset($_POST['edit']))
		{
		    $id=$this->input->post('id'); //echo $roleid;die();
			$data['storeDet']=$this->Storemodel->get($store_id);
			$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($this->input->post('hiddencountry')); //when edit get country tax rates using hidden country 
			$this->form_validation->set_rules('disp_name', 'Display Name', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('store_opening_time', 'Opening Time', 'required');
			$this->form_validation->set_rules('store_closing_time', 'Closing Time', 'required');
			// $this->form_validation->set_rules('no_of_tables', 'No of Tables', 'required');
			$this->form_validation->set_rules('store_trade_license', 'Trade License', 'required');
			$this->form_validation->set_rules('store_location', 'Location', 'required');
			//$this->form_validation->set_rules('gst_or_tax', 'Tax rate', 'required');
			//$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('language', 'Language', 'required');
            //$this->form_validation->set_rules('currency', 'Currency', 'required');

			if ($this->form_validation->run() == FALSE) 
			{
				//echo "here";exit;
				$this->load->view('owner/includes/header');
			    $this->load->view('owner/store/edit',$data); 
			    $this->load->view('owner/includes/footer');
			}
			else
			{
				//echo "here1";exit;
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
					'store_disp_name' => $this->input->post('disp_name'),
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
					'store_language' => $this->input->post('language'),
					'store_selected_languages' => $checkbox_string,
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
				redirect('owner/store/edit/'.$store_id);
			}
		}
		else
		{
			$data['storeDet']=$this->Storemodel->get($store_id);//print_r($data['storeDet']);exit;
			$data['tax_rates']=$this->Taxmodel->getTaxRatesByCountryId($data['storeDet'][0]['store_country']); //when edit get country tax rates using hidden country id
			$this->load->view('owner/includes/header');
			$this->load->view('owner/store/edit',$data); 
			$this->load->view('owner/includes/footer');
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
