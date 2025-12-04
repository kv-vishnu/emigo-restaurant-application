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

class User extends My_Controller {

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
		$this->load->model('admin/Usermodel');
		$this->load->model('admin/Storemodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function index()
	{

		
		$data['users']=$this->Usermodel->listusers();
		$data['stores']=$this->Storemodel->liststores();
		$this->render_admin_header('admin/user/users',$data);
	}
	
	public function Deleteuser(){
		$id= $this->input->post('id');
		echo $id;
	     $this->Usermodel->delete($id);
		// $this->session->set_flashdata('error','User deleted successfully');
	}
	
	public function add(){
		$data['stores']=$this->Storemodel->liststores();
		// print_r($data['stores']);exit;
	    // if(isset($_POST['add']))
		// {
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('add_user', 'Name', 'required');
			$this->form_validation->set_rules('add_user_phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
			// $this->form_validation->set_rules('add_user_phone', 'Phone', 'required |callback_validate_phone');
			$this->form_validation->set_rules('add_user_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('add_user_role', 'Role', 'required');
			$this->form_validation->set_rules('add_user_address', 'Address', 'required');
			$this->form_validation->set_rules('add_user_shop', 'Store', 'required');
			$this->form_validation->set_rules('add_user_username', 'Username', 'required');
			$this->form_validation->set_rules('add_user_password', 'Password', 'required');
	
			if($this->form_validation->run() == FALSE) 
			{
				$response = [
					'success' => false,
					'errors' => [
						'add_user' => form_error('add_user'),
						'add_user_phone' => form_error('add_user_phone'),
						'add_user_email' => form_error('add_user_email'),
						'add_user_address' => form_error('add_user_address'),
						'add_user_username' => form_error('add_user_username'),
						'add_user_password' => form_error('add_user_password'),
						'add_user_role' => form_error('add_user_role'),
						'add_user_shop' => form_error('add_user_shop'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{
			    $data = array(
			        'userroleid' => $this->input->post('add_user_role'),
                    'store_id' => $this->input->post('add_user_shop'),
					'Name' => $this->input->post('add_user'),
			        'userEmail' => $this->input->post('add_user_email'),
					'userName' => $this->input->post('add_user_username'),
					'userPassword' => md5(trim($this->input->post('add_user_password'))),
					'userPhoneNumber' => $this->input->post('add_user_phone'),
					'userAddress' => $this->input->post('add_user_address'),
			        'is_active' => 1,
			        );

					$this->db->where('Name', $data['Name']);
					$this->db->or_where('userName', $data['userName']);
					$query = $this->db->get('users');
				
					if ($query->num_rows() > 0) {
						echo json_encode(['success' => false, 'errors' => 'name or username exists']);
					} 
					else{
						$this->Usermodel->insert($data);
				echo json_encode(['success' => 'success']);
					}


					// print_r($data);exit;
				
			}
		// }
		
	}


	public function edit(){
		$id = $this->input->post('id');
        $edit_user = $this->Usermodel->get_user_details($id); 
		// print_r($edit_cooking);exit;
        if (!$edit_user || !is_array($edit_user)) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
                'Name' => $edit_user['Name'],
				'userEmail' => $edit_user['userEmail'],
				'userName' => $edit_user['userName'],
				'userPassword' => $edit_user['userPassword'],
				'UserPhoneNumber' => $edit_user['UserPhoneNumber'],
				'userAddress' => $edit_user['userAddress'],
				'userroleid' => $edit_user['userroleid'],
				'store_id' => $edit_user['store_id'],
                'is_active' => 1,
        ];
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
		//   print_r($result);exit;
	}



	public function updateuserdetails(){
	$id=$this->input->post('hidden_user_id');
	// echo $id;
	$this->form_validation->set_error_delimiters('', ''); 
	$this->form_validation->set_rules('add_user', 'Name', 'required');
	$this->form_validation->set_rules('add_user_phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
	$this->form_validation->set_rules('add_user_email', 'Email', 'required|valid_email');
	$this->form_validation->set_rules('add_user_role', 'Role', 'required');
	$this->form_validation->set_rules('add_user_address', 'Address', 'required');
	$this->form_validation->set_rules('add_user_shop', 'Store', 'required');
	$this->form_validation->set_rules('add_user_username', 'Username', 'required');
	// $this->form_validation->set_rules('add_user_password', 'Password', 'required');

	if($this->form_validation->run() == FALSE) 
	{
		$response = [
			'success' => false,
			'errors' => [
				'add_user' => form_error('add_user'),
				'add_user_phone' => form_error('add_user_phone'),
				'add_user_email' => form_error('add_user_email'),
				'add_user_address' => form_error('add_user_address'),
				'add_user_username' => form_error('add_user_username'),
				// 'add_user_password' => form_error('add_user_password'),
				'add_user_role' => form_error('add_user_role'),
				'add_user_shop' => form_error('add_user_shop'),
			]
		];
	
		echo json_encode($response);
	}
	else
	{
		$data = array(
			'userroleid' => $this->input->post('add_user_role'),
			'store_id' => $this->input->post('add_user_shop'),
			'Name' => $this->input->post('add_user'),
			'userEmail' => $this->input->post('add_user_email'),
			'userName' => $this->input->post('add_user_username'),
			// 'userPassword' => md5(trim($this->input->post('add_user_password'))),
			'userPhoneNumber' => $this->input->post('add_user_phone'),
			'userAddress' => $this->input->post('add_user_address'),
			'is_active' => 1,
			);
			// print_r($data);exit;
			 $this->Usermodel->update($id,$data);
		echo json_encode(['success' => 'success','data'=>$data]);
	}
	}
	

	// public function edit(){
	// 	$data['stores']=$this->Storemodel->liststores();
	// 	$data['userroleid']=$this->Storemodel->listuserroleid();
    // //   print_r($data['userroleid']);
	//     if(isset($_POST['edit']))
	// 	{
	// 	    $id=$this->input->post('id'); //echo $roleid;die();
	// 		$data['userDet']=$this->Usermodel->get($id);//print_r($data['userDet']);exit;
	// 		$this->form_validation->set_error_delimiters('', ''); 
	// 		$this->form_validation->set_rules('name', 'Name', 'required');
	// 		$this->form_validation->set_rules('phone', 'Phone', 'required');
	// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    //         $this->form_validation->set_rules('role', 'Role', 'required');
	// 		$this->form_validation->set_rules('address', 'Address', 'required');
	// 		$this->form_validation->set_rules('store_id', 'Store', 'required');
	// 		$this->form_validation->set_rules('username', 'Username', 'required');
	// 		$this->form_validation->set_rules('password', 'Password', 'required');
	// 		$this->form_validation->set_rules('is_active', 'Status', 'required');
	// 		if ($this->form_validation->run() == FALSE) 
	// 		{
	// 			$this->load->view('admin/includes/header');
	// 		    $this->load->view('admin/user/edit',$data); 
	// 		    $this->load->view('admin/includes/footer');
	// 		}
	// 		else
	// 		{
	// 			if(!empty($_FILES['user_logo_image']['name'])){
	// 				$image_path = './uploads/user/' . $this->input->post('old_image');
	// 				//echo $image_path;exit;
	// 				unlink($image_path);
	// 				$config['upload_path'] = './uploads/user/';
	// 				$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
	// 				$config['file_name'] = $_FILES['user_logo_image']['name'];
					
					
	// 				$this->load->library('upload',$config);
	// 				$this->upload->initialize($config);
					
	// 				if($this->upload->do_upload('user_logo_image')){
	// 					$uploadData = $this->upload->data();
	// 					$user_logo_image = $uploadData['file_name'];
	// 				}else{
	// 					$upload=0;
	// 				   $uploaderr=$this->upload->display_errors();
	
	// 				}
	// 			}else{
	// 				$user_logo_image = $this->security->xss_clean($this->input->post('old_image'));
	// 			}

	// 			$data = array(
	// 		        'userroleid' => $this->input->post('role'),
    //                 'store_id' => $this->input->post('store_id'),
	// 				'Name' => $this->input->post('name'),
	// 		        'userEmail' => $this->input->post('email'),
	// 				'userName' => $this->input->post('username'),
	// 				'userPassword' => md5(trim($this->input->post('password'))),
	// 				'userPhoneNumber' => $this->input->post('phone'),
	// 				'userAddress' => $this->input->post('address'),
	// 				'profileimg' => $user_logo_image,
	// 		        'is_active' => $this->input->post('is_active'),
	// 		        );
	// 			$this->Usermodel->update($id,$data);
	// 			$this->session->set_flashdata('success','User details updated...');
	// 			redirect('admin/user');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$id=$this->input->post('id'); 
	// 		$data['userDet']=$this->Usermodel->get($id);//print_r($data['storeDet']);exit;
	// 		$this->load->view('admin/includes/header');
	// 		$this->load->view('admin/user/edit',$data); 
	// 		$this->load->view('admin/includes/footer');
	// 	}
	// }

	
	public function valid_phone($phone_number) {
		$pattern = "/^\+?\d{1,3}?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/";
        $clean_phone_number = preg_replace('/\D/', '', $phone_number);
        if (preg_match('#[^0-9]#',$phone_number)) {
            $this->form_validation->set_message('valid_phone', 'The %s field must be digits.');
            return FALSE;
        } 
		return TRUE;
    }



	//importing
	public function csv()
	{
		$data=$this->Usermodel->listclientscsv();
		$fileName="clients.csv";
		header("Content-Description: File Transfer"); 
	    header("Content-Disposition: attachment; filename=$fileName"); 
	    header("Content-Type: application/csv; "); 
	    $file = fopen('php://output', 'w');
	   	$header = array("ID","Name","Email","Number","Address"); 
	   	fputcsv($file, $header);
	   	foreach ($data as $key=>$line){ 
	     fputcsv($file,$line); 
	   	}
	   	fclose($file); 
	  	exit; 
		
	}
	public function pdf() {
		$html='';
		$dompdf = new Dompdf();
		$data['data'] = $this->Usermodel->listclientscsv();  
		$html = $this->load->view('admin/pdf_view', $data, true);
		$html .= $this->output->get_output();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream("clients.pdf", array("Attachment"=>0));
	}
	public function excel()
	{
        // Read an Excel File
        $tmpfname = "example.xls";
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $objPHPExcel = $excelReader->load($tmpfname);
        
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Furkan Kahveci")
							 ->setLastModifiedBy("Furkan Kahveci")
							 ->setTitle("Office 2007 XLS Test Document")
							 ->setSubject("Office 2007 XLS Test Document")
							 ->setDescription("Description for Test Document")
							 ->setKeywords("phpexcel office codeigniter php")
							 ->setCategory("Test result file");

        // Create a first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "ID");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "EMPLOYEE ID");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "NAME");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "GENDER");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "EMAIL");
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "PHONE NUMBER");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "ADDRESS");
        $objPHPExcel->getActiveSheet()->setCellValue('H1', "DATE OF BIRTH");
        $objPHPExcel->getActiveSheet()->setCellValue('I1', "DATE OF JOINING");

        // Hide F and G column
      /*  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setVisible(false);*/

        // Set auto size
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $data = $this->Usermodel->listclientscsv();  
        
        // Add data
        $i=0;
	    $k = 2;
        while ( $i <= count($data))  
        {
            if(isset($data[$i]))
            {
                $id=$data[$i]['id'];
                $name=$data[$i]['name'];
                $email=$data[$i]['email'];
                $phone=$data[$i]['phone'];
                $address=$data[$i]['address'];

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $k, "$id")
                                            ->setCellValue('B' . $k, "$name")
                                            ->setCellValue('C' . $k, "$email")
                                            ->setCellValue('D' . $k, "$phone")
                                            ->setCellValue('G' . $k, "$address");
            }
            $k++;
            $i++;
        }


        // Set Font Color, Font Style and Font Alignment code edit by vishnu
        // $stil=array(
        //     'borders' => array(
        //       'allborders' => array(
        //         'style' => PHPExcel_Style_Border::BORDER_THIN,
        //         'color' => array('rgb' => '000000')
        //       )
        //     ),
        //     'alignment' => array(
        //       'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //     )
        // );
        // $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($stil);



        // Merge Cells
        //$objPHPExcel->getActiveSheet()->mergeCells('A5:E5');
        //$objPHPExcel->getActiveSheet()->setCellValue('A5', "MERGED CELL");
        //$objPHPExcel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($stil);
        
        // Save Excel xls File
        $filename="clients.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
	}
	
	








}