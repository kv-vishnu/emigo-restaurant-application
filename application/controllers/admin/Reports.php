<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('application/libraries/dompdf/autoload.inc.php'); 
require_once('application/third_party/PHPExcel-1.8/Classes/PHPExcel.php');

use Dompdf\Dompdf; 
use Dompdf\Options; 
use Dompdf\FontMetrics; 
class Reports extends CI_Controller {

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
		$this->load->model('Reportmodel');
        $this->load->model('Clientmodel');
        $this->load->model('Cordinatormodel');

		require('Common.php');
		
        if (!$this->session->userdata('login_status')) {
			redirect(login);
		}

	}
	public function index()
	{  
	    $data['timesheet']=$this->Reportmodel->timesheet_reports();
        $data['client']=$this->Clientmodel->listclients();
        $data['technicians']=$this->Cordinatormodel->listtechnicians();
		$this->load->view('includes/header');
		$this->load->view('Report/timesheet_report',$data);
		$this->load->view('includes/footer');
	}

	public function filter_timesheet_pdf() {
		$client_id = $this->input->get('client_id');
		$technician_id = $this->input->get('technician_id');
		$criteria = $this->input->get('criteria');
		$criteria_value = $this->input->get('criteria_value');
		//echo $client_id;echo $technician_id;exit;
		$html='';
		$dompdf = new Dompdf();
		$data['data'] = $this->Reportmodel->filter_timesheet($client_id,$technician_id,$criteria,$criteria_value);  
		//print_r($data['data']);exit;
		$html = $this->load->view('Report/timesheet_filter_pdf', $data, true);
		$html .= $this->output->get_output();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream("timesheet.pdf", array("Attachment"=>0));
	}

	public function filter_timesheet_csv() {
		$client_id = $this->input->get('client_id');
		$technician_id = $this->input->get('technician_id');
		$criteria = $this->input->get('criteria');
		$criteria_value = $this->input->get('criteria_value');
		$data=$this->Reportmodel->filter_timesheet($client_id,$technician_id,$criteria,$criteria_value);
		$fileName="timesheets.csv";
		header("Content-Description: File Transfer"); 
	    header("Content-Disposition: attachment; filename=$fileName"); 
	    header("Content-Type: application/csv; "); 
	    $file = fopen('php://output', 'w');
	   	$header = array("ID","Number","Client","Technician","Date"); 
	   	fputcsv($file, $header);
	   	foreach ($data as $key=>$line){ 
	     fputcsv($file,$line); 
	   	}
	   	fclose($file); 
	  	exit; 
	}

	public function filter_timesheet_excel()
	{
        // Read an Excel File
		$client_id = $this->input->get('client_id');
		$technician_id = $this->input->get('technician_id');
		$criteria = $this->input->get('criteria');
		$criteria_value = $this->input->get('criteria_value');
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
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "TIMESHEET NO");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "CLIENT");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "TECHNICIAN");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "DATE");

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

        $data=$this->Reportmodel->filter_timesheet($client_id,$technician_id,$criteria,$criteria_value);  
        
        // Add data
        $i=0;
	    $k = 2;
        while ( $i <= count($data))  
        {
            if(isset($data[$i]))
            {
                $id=$data[$i]['timesheet_id'];
                $name=$data[$i]['timesheet_no'];
                $email=$data[$i]['cl_name'];
                $phone=$data[$i]['tech_name'];
                $address=$data[$i]['date'];

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $k, "$id")
                                            ->setCellValue('B' . $k, "$name")
                                            ->setCellValue('C' . $k, "$email")
                                            ->setCellValue('D' . $k, "$phone")
                                            ->setCellValue('E' . $k, "$address");
            }
            $k++;
            $i++;
        }
        
        // Save Excel xls File
        $filename="timesheet.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
	}

	public function filter_timesheet(){
		$client_id =  $this->input->post('client_id');
		$technician_id =  $this->input->post('technician_id');
		$criteria =  $this->input->post('criteria');
		$criteria_value =  $this->input->post('criteria_value');
		$report = $this->Reportmodel->fetchReport($client_id,$technician_id,$criteria,$criteria_value);
		?>


		<!-- ajax response -->
		<thead>
                          <tr>
                            <th>No</th>
                            <th>Timesheet ID</th>
                            <th>Timesheet No</th>
                            <th>Client</th>
                            <th>Technician</th>
                            <th>Date</th>
                           
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php //print_r($timesheet);exit;
                       if(!empty($report)){
                       $count = 1;
                       foreach($report as $val){ ?>
                       
                       <tr>
                           
                           
                            <td><?php echo $count; ?></td>
                            <td><?php echo $val['timesheet_id'];?></td>
                            <td><?php echo $val['timesheet_no'];?></td>
                            <td><?php echo $val['cl_name']; ?></td>
                            <td><?php echo $val['tech_name']; ?></td>
                            <td><?php echo $val['date'];?></td>
                            
                            <td> 
                              <ul class="action">
                                 
                                
                                <li class="delete">
                                    <form action="<?php echo base_url();?>cordinator/task_view" method="post">
                                      <input type="hidden" name="id" value="<?php echo $val['id']; ?>"> 
                                        <button class="" type="submit" data-bs-toggle="tooltip" data-id="<?php echo $val['id']; ?>" data-bs-original-title="Task details"><i class="fa fa-eye"></i></button>
                                    </form>
                                </li>
                                
                              </ul>
                            </td>
                            
                          </tr>
                          
                       <?php $count++; }} ?>
                        </tbody>
						<!-- ajax response -->
		<?php
	}
}
