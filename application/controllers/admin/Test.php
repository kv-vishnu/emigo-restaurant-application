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

class Test extends CI_Controller {

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
        $this->load->model('admin/Testmodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function index()
	{
        //echo "heressss";exit;
        $controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
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
		$this->load->view('admin/header',$data);
		$this->load->view('admin/test');
		$this->load->view('admin/footer',$data);
	}

    public function saveProductimage(){


        $this->load->library('upload');
        $this->load->library('image_lib');
        
        $uploaded_images = [];
        
        for ($i = 1; $i <= 4; $i++) {
            $input_name = 'image' . $i;
        
            if (!empty($_FILES[$input_name]['name'])) {
                $_FILES['image']['name']     = $_FILES[$input_name]['name'];
                $_FILES['image']['type']     = $_FILES[$input_name]['type'];
                $_FILES['image']['tmp_name'] = $_FILES[$input_name]['tmp_name'];
                $_FILES['image']['error']    = $_FILES[$input_name]['error'];
                $_FILES['image']['size']     = $_FILES[$input_name]['size'];
        
                $config['upload_path']   = './uploads/store/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_name']     = time() . '_' . $i;
        
                $this->upload->initialize($config);
        
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
        
                    // Resize
                    $resize['image_library']  = 'gd2';
                    $resize['source_image']   = $upload_data['full_path'];
                    $resize['maintain_ratio'] = TRUE;
                    $resize['width']          = 500;
                    $resize['height']         = 500;
        
                    $this->image_lib->initialize($resize);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
        
                    // Save image URL
                    $uploaded_images[] = base_url('uploads/store/' . $upload_data['file_name']);
                }
                //  else {
                //     // Stop and return error if any image fails
                //     $error = $this->upload->display_errors();
                //     return $this->output
                //         ->set_content_type('application/json')
                //         ->set_output(json_encode(['status' => 'error', 'message' => $error]));
                // }
            }
        }
        
        // Send success response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'message' => 'Images uploaded and resized!',
                'images' => $uploaded_images
            ]));
        

    }


}