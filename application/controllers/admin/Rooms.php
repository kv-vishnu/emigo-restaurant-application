<?php
class Rooms extends MY_Controller {
 public function __construct() {
        parent::__construct();
        $this->load->model('admin/Roommodel');
		$this->load->model('admin/Productmodel');
		$this->load->model('admin/Storemodel');
		$this->load->model('admin/Countrymodel');
		$this->load->model('admin/Packagemodel');
		$this->load->model('admin/Taxmodel');
		$this->load->model('admin/Usermodel');
		$this->load->model('admin/Tablemodel');
		$this->load->model('admin/Packagemodel');
		$this->load->model('admin/Commonmodel');
		$this->load->model('owner/Ordermodel');
		$this->load->model('owner/Settingsmodel');
		$this->load->model('owner/Combomodel');
		$this->load->model('website/Homemodel');
    }
 public function index(){
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
		$data['role_id'] = $role_id;
		// print_r($role_id);
		$user_id = $this->session->userdata('loginid'); // Loged in user id

         $store_details = $this->Commonmodel->get_admin_details_by_store_id($logged_in_store_id);
		//   print_r($store_details);exit;
        //  $support_details = $this->Homemodel->get_support_details_by_country_id($store_details->store_country);
        $data['Name'] = $store_details->Name;
		  $data['store_id'] = $this->input->post('store_id');
		 $store_id = $this->input->post('store_id');
		//  print_r($store_id);
		    $data['storeDet'] = $this->Storemodel->get($store_id);
			// print_r($data['storeDet']);
		// print_r($data['storeDet']);
        $data['store_name'] = $data['storeDet'][0]['store_name'];
		// print_r($data['Name']);exit;
        $data['userAddress'] = $store_details->userAddress;
        $data['support_no'] = $store_details->UserPhoneNumber;
         $data['support_email'] = $store_details->userEmail;
		$data['profileimg'] = $store_details->profileimg;
        $data['categories']=$this->Productmodel->listcategories();
        $data['order_index']=$this->Productmodel->getNextOrderIndex();
		$data['rooms']=$this->Roommodel->listrooms($data['store_id']);


		$this->render_admin_header('admin/rooms', $data);
}


// add the room from dropdown
public function add(){
 $store_id = $this->input->post('store_id');
 $selected_room_count=$this->input->post('roomselect');


//  print_r($store_id);
  $this->form_validation->set_error_delimiters('', '');
  $this->form_validation->set_rules('roomselect', 'Room Count', 'required');

            	if($this->form_validation->run() == FALSE)
			{
				$response = [
					'success' => false,
					'errors' => [
						'roomselect' => form_error('roomselect'),
					]
				];

				echo json_encode($response);
			}
			else
			{

				$count_by_rooms= $this->Roommodel->count_rooms($store_id);
                // $end = $count_by_rooms + $selected_room_count;
				// print_r($count_by_rooms);
				// print_r($count_by_table);

				for ($i = $count_by_rooms + 1; $i <=  $selected_room_count + $count_by_rooms; $i++) {
					$data = array(
					'store_id' => $store_id,
			        'table_name' => 'Room' . ' ' . $i,
					'store_table_name'=>'',
					'secret_code' => '',
					'qr_code'=>'',
					'store_table_token'=>0,
					'is_reserved' => 0,
					'ttype'=>'rom',
			        'is_active' => 1,
					'is_whatsapp' => 0,
					'whatsapp_no' => 0
					);
					$this->Roommodel->insert($data);
				}
				echo json_encode(['success' => 'success']);
			}
}

public function DeleteRoom(){
 $id=$this->input->post('id');
 $this->Roommodel->DeleteRoom($id);
}

public function UpdateRoom(){
 $tableid=$this->input->post('tableid');
 $table_name = $this->input->post('tablename');
 $store_table_name=$this->input->post('store_table_name');
 $this->Roommodel->UpdateRoom($tableid,$store_table_name);
 echo json_encode(['status' => 'success','message' =>   $table_name . ' changed to ' . $store_table_name
]);

}





}
?>