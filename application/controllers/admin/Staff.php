<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('application/libraries/dompdf/autoload.inc.php'); 

// excel 
require_once('application/third_party/PHPExcel-1.8/Classes/PHPExcel.php');

use Dompdf\Dompdf; 
use Dompdf\Options; 
use Dompdf\FontMetrics;
class Staff extends CI_Controller {

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
		error_reporting(0);
		$this->load->model('Rolemodel');
		$this->load->model('Staffmodel');

		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{  
		
	    $data['staff']=$this->Staffmodel->liststaff();
		$this->load->view('includes/header');
		$this->load->view('staff/liststaff',$data);
		$this->load->view('includes/footer');
	}
	public function delete(){
	    $this->Staffmodel->delete($this->input->post('id'));
		$this->session->set_flashdata('error','Staff deleted successfully');
	}
	public function add(){
	    $data['role']=$this->Rolemodel->listroles();
	    if(isset($_POST['add']))
		{
		    
		    $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('emp_id', 'Employee id', 'required');
			$this->form_validation->set_rules('userroleid', 'Role', 'required');
			$this->form_validation->set_rules('Name', 'Name', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email|callback_email_exist');
			$this->form_validation->set_rules('UserPhoneNumber', 'Contact number', 'required|callback_ph_exist|callback_valid_phone');
			$this->form_validation->set_rules('userName', 'Username', 'required|callback_username_exist');
			

			if($this->form_validation->run() == FALSE) 
			{
				$this->load->view('includes/header');
			    $this->load->view('staff/addstaff',$data); 
			    $this->load->view('includes/footer');
			}
			else
			{
				$upload=1;
				if(!empty($_FILES['cv']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['cv']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('cv')){
						$uploadData = $this->upload->data();
						$cv = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$cv = '';
				}
				if(!empty($_FILES['frontpage']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['cv']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('frontpage')){
						$uploadData = $this->upload->data();
						$frontpage = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$frontpage = '';
				}
			
				if(!empty($_FILES['backpage']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['backpage']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('backpage')){
						$uploadData = $this->upload->data();
						$backpage = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$backpage = '';
				}
				if(!empty($_FILES['iqamaphoto']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['iqamaphoto']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('iqamaphoto')){
						$uploadData = $this->upload->data();
						$iqamaphoto = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$iqamaphoto = '';
				}
		        if($upload!=0)//no errors in file uploading
                {
			    $staffdata = $this->Staffmodel->insertUser($cv,$frontpage,$backpage,$iqamaphoto);
				$user_name=$staffdata[1];
				$user_email=$staffdata[2];
				$user_password=$staffdata[0];
				$this->load->library('email');
                $this->email->from('deem.makeoverapp.co.in', 'Deem');
                $this->email->to($user_email);
                $loginLink='https://deem.makeoverapp.co.in/';
                $this->email->subject('Deem user Login credentials');
				//echo "your username is : '.$user_name.' and password is : '.$user_password.'";die();
                $this->email->message('your username is : '.$user_name.' and password is : '.$user_password.' Go to the login page '.$loginLink);
					if($this->email->send())
					{
						
						$this->session->set_flashdata('success','New record inserted');
						redirect('staff');

					}
					else
					{
						$this->session->set_flashdata('error','Email sending error');
				     
						redirect('staff');
				 }
				}
				else
				{
					$this->session->set_flashdata('error',$uploaderr);
				     
						redirect('staff');
				}
			}
		}
		else
		{
		    $this->load->view('includes/header');
			$this->load->view('staff/addstaff',$data); 
			$this->load->view('includes/footer');
		}
	}
	
	public function edit(){
	    if(isset($_POST['edit']))
		{
		    $userid=$this->input->post('userid'); 
			$data['role']=$this->Rolemodel->listroles();
			$data['staff']=$this->Staffmodel->get($userid);
			$this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('emp_id', 'Employee id', 'required');
			$this->form_validation->set_rules('userroleid', 'Role', 'required');
			$this->form_validation->set_rules('Name', 'Name', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email|callback_email_exist');
			$this->form_validation->set_rules('UserPhoneNumber', 'Contact number', 'required|callback_ph_exist|callback_valid_phone');
			$this->form_validation->set_rules('userName', 'Username', 'required|callback_username_exist');
			//$this->form_validation->set_rules('userAddress', 'Address', 'required');
		
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('includes/header');
			    $this->load->view('staff/editstaff',$data); 
			    $this->load->view('includes/footer');
			}
			else
			{
				$upload=1;
				if(!empty($_FILES['cv']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['cv']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('cv')){
						$uploadData = $this->upload->data();
						$cv = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$cv = $this->security->xss_clean($this->input->post('old_cv'));
				}

				if(!empty($_FILES['frontpage']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['cv']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('frontpage')){
						$uploadData = $this->upload->data();
						$frontpage = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$frontpage = $this->security->xss_clean($this->input->post('old_frontpage'));
				}
				
				if(!empty($_FILES['backpage']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['backpage']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('backpage')){
						$uploadData = $this->upload->data();
						$backpage = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$backpage = $this->security->xss_clean($this->input->post('old_backpage'));
				}

				if(!empty($_FILES['iqamaphoto']['name'])){
					$config['upload_path'] = 'uploads/staff/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['iqamaphoto']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('iqamaphoto')){
						$uploadData = $this->upload->data();
						$iqamaphoto = $uploadData['file_name'];
					}else{
						$upload=0;
					   $uploaderr=$this->upload->display_errors();
	
					}
				}else{
					$iqamaphoto = $this->security->xss_clean($this->input->post('old_iqamaphoto'));
				}


				if($upload!=0)
				{ 
					$doj=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('dojoining'))));
					$dob=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('dob'))));
					$passportexpirydate=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('passportexpirydate'))));
					$iqamaexpirydate=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('iqamaexpirydate'))));
					$medicalexpirydate=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('medicalexpirydate'))));
		// 			if($doj=='')//if date fields value null then save null insted of default date format start----------------------
		// {
		// 	$doj='';
		// }
		// else
		// {
		// 	$doj=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('dojoining'))));
		// }
		// if($dob=='')
		// {
		// 	$dob='';
		// }
		// else
		// {
		// 	$dob=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('dob'))));
		// }
		// if($passportexpirydate=='')
		// {
		// 	$passportexpirydate='';
		// }
		// else
		// {
		// 	$doj=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('passportexpirydate'))));
		// }
		// if($iqamaexpirydate=='')
		// {
		// 	$iqamaexpirydate='';
		// }
		// else
		// {
		// 	$iqamaexpirydate=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('iqamaexpirydate'))));
		// }
		// if($medicalexpirydate=='')
		// {
		// 	$medicalexpirydate='';
		// }
		// else
		// {
		// 	$medicalexpirydate=$this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('medicalexpirydate'))));
		// }
		//if date fields value null then save null insted of default date format end----------------------
				$staffdata = array(
					'userroleid' => $this->security->xss_clean($this->input->post('userroleid')),
					'emp_id' => $this->security->xss_clean($this->input->post('emp_id')),
					'Name' => $this->security->xss_clean($this->input->post('Name')),
					'gender' => $this->security->xss_clean($this->input->post('gender')),
					'userEmail' => $this->security->xss_clean($this->input->post('userEmail')),
					'userName' => $this->security->xss_clean($this->input->post('userName')),
					'UserPhoneNumber' => $this->security->xss_clean($this->input->post('UserPhoneNumber')),
					'userAddress' => $this->security->xss_clean($this->input->post('userAddress')),
					'updatedBy' => $this->session->userdata('loginid'),
					'dob' => $dob,
					'dojoining' => $doj,
					'userStatus' => $this->security->xss_clean($this->input->post('userStatus')),
					'cv' => $cv,
			        'passportnum' => $this->security->xss_clean($this->input->post('passportnum')),
			        'passportexpirydate' => $passportexpirydate,
			        'frontpage'=>$frontpage,
			        'backpage'=>$backpage,
			        'iqamanum' => $this->security->xss_clean($this->input->post('iqamanum')),
			        'iqamaexpirydate' => $iqamaexpirydate,
			        'iqamaphoto'=>$iqamaphoto,
			        'medicalname' => $this->security->xss_clean($this->input->post('medicalname')),
			        'medicalnum' => $this->security->xss_clean($this->input->post('medicalnum')),
			        'medicalexpirydate' => $medicalexpirydate,
                    'blood'=>$this->security->xss_clean($this->input->post('blood'))
				);
				//echo $userid;print_r($staffdata);exit;
				$this->Staffmodel->update($userid,$staffdata);
				$this->session->set_flashdata('success','Staff details updated...');
				redirect('staff');
			}
			else
			{
					$this->session->set_flashdata('error',$uploaderr);
				     
						redirect('staff');
			}
		}
		}
		else
		{
		    $data['role']=$this->Rolemodel->listroles();
			$userid=$this->input->post('userid'); //echo $roleid;die();
			$data['staff']=$this->Staffmodel->get($userid);
			$this->load->view('includes/header');
			$this->load->view('staff/editstaff',$data); 
			$this->load->view('includes/footer');
		}
	}
	
	public function email_exist()
	{
		
         if ($this->input->post('userEmail'))
		{
			$checkemailexist=$this->Staffmodel->getProfileByEmail($this->input->post('userid'));
		    if($checkemailexist==FALSE)
		
		{
			$error = 'Email Id already exist.';
			$this->form_validation->set_message('email_exist', $error);
			return FALSE;
		}
		else
		{
		return TRUE;
		}
	}
   }
   public function ph_exist()
	{
		
         if ($this->input->post('UserPhoneNumber'))
		{
			$checkphexist=$this->Staffmodel->getProfileByPh($this->input->post('userid'));
		    if($checkphexist==FALSE)
		
		{
			$error = 'Contact number already exist.';
			$this->form_validation->set_message('ph_exist', $error);
			return FALSE;
		}
		else
		{
		return TRUE;
		}
	}
   }
    public function username_exist()
	{
		
         if ($this->input->post('userName'))
		{
			$checkunameexist=$this->Staffmodel->getProfileByusername($this->input->post('userid'));
		    if($checkunameexist==FALSE)
		
		{
			$error = 'Username already exist.';
			$this->form_validation->set_message('username_exist', $error);
			return FALSE;
		}
		else
		{
		return TRUE;
		}
	}
   }
   	//importing
	public function csv()
	{
		$data=$this->Staffmodel->liststaffcsv();
		$fileName="staff.csv";
		header("Content-Description: File Transfer"); 
	    header("Content-Disposition: attachment; filename=$fileName"); 
	    header("Content-Type: application/csv; "); 
	    $file = fopen('php://output', 'w');
	   	$header = array("ID","Employee Id","Name","Gender","Email","Phone Number","Address","Date of Birth","Date of joining","Blood group","Passport Number",
	                  "Expiry Date","Iqama Number","Expiry Date","Medical Name","Medical Number","Expiry Date"); 
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
		$data['data'] = $this->Staffmodel->liststaffcsv();  
		$html = $this->load->view('staff/pdf_view', $data, true);
		$html .= $this->output->get_output();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream("staff.pdf", array("Attachment"=>0));
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
        $objPHPExcel->getActiveSheet()->setCellValue('J1', "BLOOD GROUP");
        $objPHPExcel->getActiveSheet()->setCellValue('K1', "PASSPORT NUMBER");
        $objPHPExcel->getActiveSheet()->setCellValue('L1', "EXPIRY DATE");
        $objPHPExcel->getActiveSheet()->setCellValue('M1', "IQAMA NUMBER");
        $objPHPExcel->getActiveSheet()->setCellValue('N1', "EXPIRY DATE");
        $objPHPExcel->getActiveSheet()->setCellValue('O1', "MEDICAL NAME");
        $objPHPExcel->getActiveSheet()->setCellValue('P1', "MEDICAL NUMBER");
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', "EXPIRY DATE");

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);


        $data = $this->Staffmodel->liststaffcsv();  
        
        // Add data
        $i=0;
	    $k = 2;
        while ( $i <= count($data))  
        {
            if(isset($data[$i]))
            {
                $id=$data[$i]['userid'];
                $emp_id=$data[$i]['emp_id'];
                $name=$data[$i]['Name'];
                $gender=$data[$i]['gender'];
                $email=$data[$i]['userEmail'];
                $ph=$data[$i]['UserPhoneNumber'];
                $address=$data[$i]['userAddress'];
                $dob=$data[$i]['dob'];
				$joining=$data[$i]['dojoining'];
                $blood=$data[$i]['blood'];
                $passportnum=$data[$i]['passportnum'];
				$passportexpirydate=$data[$i]['passportexpirydate'];
				$iqamanum=$data[$i]['iqamanum'];
				$iqamaexpirydate=$data[$i]['iqamaexpirydate'];
				$medicalname=$data[$i]['medicalname'];
				$medicalnum=$data[$i]['medicalnum'];
				$medicalexpirydate=$data[$i]['medicalexpirydate'];
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $k, "$id")
                                            ->setCellValue('B' . $k, "$emp_id")
                                            ->setCellValue('C' . $k, "$name")
                                            ->setCellValue('D' . $k, "$gender")
                                            ->setCellValue('E' . $k, "$email")
                                            ->setCellValue('F' . $k, "$ph")
                                            ->setCellValue('G' . $k, "$address")
                                            ->setCellValue('H' . $k, "$dob")
                                            ->setCellValue('I' . $k, "$joining")
											->setCellValue('J' . $k, "$blood")
											->setCellValue('K' . $k, "$passportnum")
											->setCellValue('L' . $k, "$passportexpirydate")
											->setCellValue('M' . $k, "$iqamanum")
											->setCellValue('N' . $k, "$iqamaexpirydate")
											->setCellValue('O' . $k, "$medicalname")
											->setCellValue('P' . $k, "$medicalnum")
											->setCellValue('Q' . $k, "$medicalexpirydate")

;
            }
            $k++;
            $i++;
        }


        
        // Save Excel xls File
        $filename="staff.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
	}
		public function view()
	{
	   
	    $data['details']=$this->Staffmodel->get($this->input->post('userid'));
		$data['attendence']=$this->Staffmodel->getPunchData($this->input->post('userid'));
		$this->load->view('includes/header');
		$this->load->view('staff/view',$data);
		$this->load->view('includes/footer');
	}
	public function check_idexist(){
		$id=$this->input->post('id');
		$exist = $this->Staffmodel->check_idexist($id);
		echo count($exist);
	}
	public function checkpassword()
	{
		   $password=$this->input->post('oldpass');
		   $userid=$this->input->post('userid');
		   $pass=md5($password);
		   $data=$this->Staffmodel->checkpassword($userid,$password);//echo 'dbpass'.$data['userPassword'];echo 'text'.$pass;die;
		   return $data;
	}
	public function changepass()
	{
		//echo "here";die();
		    $staffdata = array(
				'userPassword' => md5($this->security->xss_clean($this->input->post('newpassword')))
			);
			$user_password = $this->input->post('newpassword');
		    $userid=$this->security->xss_clean($this->input->post('userid'));
			$user=$this->Staffmodel->get_user_details($userid);
			if($this->Staffmodel->updatepw($userid,$staffdata)){
				// mail sending
				$user_email = '';
				$this->load->library('email');
                $this->email->from('deem.makeoverapp.co.in', 'Deem');
                $this->email->to($user_email);
                $loginLink='https://deem.makeoverapp.co.in/';
                $this->email->subject('Deem user Login credentials');
				//echo "your username is : '.$user_name.' and password is : '.$user_password.'";die();
                $this->email->message('your username is : '.$user_name.' and password is : '.$user_password.' Go to the login page '.$loginLink);
				if($this->email->send())
				{
					$this->session->set_flashdata('success','Password updated.Updated password sent to staff email');
					redirect('staff');
				}
				else
				{
					$this->session->set_flashdata('error','Email sending error');
					redirect('staff');
				}
			}

			

	}

	
	public function punchpdf($id) {
		$html='';
		$dompdf = new Dompdf();
		$data['data'] = $this->Staffmodel->listpunchcsv($id); 
		$data['staff'] =$this->Staffmodel->get($id);
		$html = $this->load->view('staff/punch_pdf_view', $data, true);
		$html .= $this->output->get_output();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream("punch.pdf", array("Attachment"=>0));
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

	public function punchexcel($id)
	{
        // Read an Excel File
        $tmpfname = "example.xls";
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $objPHPExcel = $excelReader->load($tmpfname);
        $staff=$this->Staffmodel->get($id);$name=$staff['Name'];
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
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "PUNCHIN TIME");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "PUNCHOUT TIME");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "TOTAL HRS");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "TIMEZONE");
        

        // Hide F and G column
      /*  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setVisible(false);*/

        // Set auto size
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
       


        $data = $this->Staffmodel->listpunchcsv($id);  
        
        // Add data
        $i=0;
	    $k = 2;
        while ( $i <= count($data))  
        {
            if(isset($data[$i]))
            {
                $id=$data[$i]['punch_id'];
				date_default_timezone_set('UTC');
// Set employee time zone
$employee_time_zone = new DateTimeZone($data[$i]['timezone']);
// Set punch-in time
$punchindatetime=new DateTime($data[$i]['punch_in_date'].' '. $data[$i]['punch_in_time']);//combine date time together of punchin
$punchoutdatetime=new DateTime($data[$i]['punch_out_date'].' '. $data[$i]['punch_out_time']);
// Convert punchin and punchout time to employee's time zone
$punchindatetime->setTimezone($employee_time_zone);
$punchoutdatetime->setTimezone($employee_time_zone);
$punchin=$punchindatetime->format('d-m-Y H:i:s T');
$punchout=$punchoutdatetime->format('d-m-Y H:i:s T');

                $emp_id=$data[$i]['emp_id'];
                $hrs=$data[$i]['total_hrs'];
                $timezone=$data[$i]['timezone'];
                
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $k, "$id")
                                            ->setCellValue('B' . $k, "$punchin")
                                            ->setCellValue('C' . $k, "$punchout")
                                            ->setCellValue('D' . $k, "$hrs")
                                            ->setCellValue('E' . $k, "$timezone");
                                           
            }
            $k++;
            $i++;
        }


        
        // Save Excel xls File
        $filename="attendence.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
	}

	public function punchcsv($id)
	{
		$data = $this->Staffmodel->listpunchcsv($id); 
		//$staff=$this->Staffmodel->get($id);$name=$staff['Name'];
		date_default_timezone_set('UTC');

		$fileName="attendence.csv";
		header("Content-Description: File Transfer"); 
	    header("Content-Disposition: attachment; filename=$fileName"); 
	    header("Content-Type: application/csv; "); 
	    $file = fopen('php://output', 'w');
		
	   	$header = array("ID","Punchin Time","Punchout Time ","Total Hrs","Timezone"); 
	   	fputcsv($file, $header);
	   	foreach ($data as $punch){ 
			// Set punch-in time
$punchindatetime=new DateTime($punch['punch_in_date'].' '. $punch['punch_in_time']);//combine date time together of punchin
$punchoutdatetime=new DateTime($punch['punch_out_date'].' '. $punch['punch_out_time']);
// Set employee time zone
$employee_time_zone = new DateTimeZone($punch['timezone']);

// Convert punchin and punchout time to employee's time zone
$punchindatetime->setTimezone($employee_time_zone);
$punchoutdatetime->setTimezone($employee_time_zone);
 $punchin=$punchindatetime->format('d-m-Y H:i:s T');
$punchout= $punchoutdatetime->format('d-m-Y H:i:s T');
$arr=array($punch['punch_id'],$punchin,$punchout,$punch['total_hrs'],$punch['timezone']);

	     fputcsv($file,$arr); 
	   	}
	   	fclose($file); 
	  	exit; 
		
	}

}
