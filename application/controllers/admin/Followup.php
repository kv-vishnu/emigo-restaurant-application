<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Followup extends My_Controller {

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
		$this->load->model('admin/Followupmodel');
		
		require('Common.php');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{
		$store_id = $this->input->post('store_id'); 
		$logged_in_store_id = $this->session->userdata('logged_in_store_id');
		$data['store_id'] = $store_id;
		$data['followup'] = $this->Followupmodel->get_all_followup($store_id);
		$data['listfollowupuser'] = $this->Followupmodel->listuser($logged_in_store_id);
		$this->render_admin_header('admin/followup/list', $data);
	}

	//MARK: Add Followup

	public function add()
    {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('followup_user', 'user', 'required');
			$this->form_validation->set_rules('followup_date', 'date', 'required');
			$this->form_validation->set_rules('followup_remarks', 'remarks', 'required');
			$store_id = $this->input->post('store_id');


	if($this->form_validation->run() == FALSE) 
	{
				$response = [
					 'success' => false,
					 'errors' => [
					 'followup_user' => form_error('followup_user'),
					 'followup_date' => form_error('followup_date'),
					 'followup_remarks' => form_error('followup_remarks')
					]
				];
				echo json_encode($response);
	}
	else
	{
                   
			    $data = array(
			        'entered_user' => $this->input->post('followup_user'),
					'store_id' =>$store_id,
					'date_and_time' => $this->input->post('followup_date'),
			        'remark' =>$this->input->post('followup_remarks'),
			        );
					// print_r($data);
			    $this->Followupmodel->add($data);
			  echo json_encode([
            'success' => 'success',
            'data' => $data
        ]);
	}
	
}


//MARK: Edit Followup
public function edit()
{
$id = $this->input->post('id');
$edit_followup= $this->Followupmodel->get_edit_details($id);
  if (!$edit_followup) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
                'entered_user' => $edit_followup['entered_user'] ?? null,
				'date_and_time' => $edit_followup['date_and_time'],
                'remark' => $edit_followup['remark'],
        ];
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);

}

// MARK: Update Followup

public function update()
{
		$this->form_validation->set_rules('followup_edit_user', 'user', 'required');
		$this->form_validation->set_rules('followup_edit_date', 'date', 'required');
		$this->form_validation->set_rules('followup_edit_remarks', 'remarks', 'required');
		$id = $this->input->post('hidden_followup_id');
		if($this->form_validation->run() == FALSE) 
		{
			$response = [
				'success' => false,
				'errors' => [
					'followup_edit_user' => form_error('followup_edit_user'),
					'followup_edit_date' => form_error('followup_edit_date'),
					'followup_edit_remarks' => form_error('followup_edit_remarks'),
				]
			];
		
			echo json_encode($response);
		}
		else{
			$data = array(
				'entered_user' => $this->input->post('followup_edit_user'),
				'date_and_time' => $this->input->post('followup_edit_date'),
				'remark' => $this->input->post('followup_edit_remarks'),
				);
				$this->Followupmodel->updatefollowupdetails($id,$data);
		$response = (['success' => 'success','data'=>$data]);
		echo json_encode($response);
	
		}
}


// MARK: Delete Followup
public function delete()
{
	$id = $this->input->post('id');
	$this->Followupmodel->delete($id);
	echo json_encode(['success' => 'success']);

}
	

	
}
?>