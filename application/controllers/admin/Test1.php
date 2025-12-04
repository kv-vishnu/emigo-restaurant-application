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

class Test1 extends CI_Controller {

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
		$this->load->model('Clientmodel');
		$this->load->model('Projectmodel');
		$this->load->model('Projectormodel');
		$this->load->model('Vehiclemodel');
		$this->load->model('Cordinatormodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}

	
	public function index()
	{
        //echo "heressss";exit;
		//$this->load->view('includes/header');
		$this->load->view('test');
		//$this->load->view('includes/footer');
	}



}