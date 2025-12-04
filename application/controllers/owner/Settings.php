<?php class Settings extends CI_Controller {
public function __construct() {
    parent::__construct();
    $this->load->model('admin/Productmodel');
        $this->load->model('admin/Storemodel');
        $this->load->model('admin/Tablemodel');
        $this->load->model('owner/Ordermodel');
        $this->load->model('owner/Settingsmodel');
        $this->load->model('owner/Combomodel');
        $this->load->model('website/Homemodel');
}
public function index()
{
    $controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $store_id = $this->session->userdata('logged_in_store_id');

        $store_details = $this->Commonmodel->get_store_details_by_id($store_id);//print_r($store_details);exit;
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['is_table_tab'] = $store_details->is_table_tab;
        $data['is_room_tab'] = $store_details->is_room_tab;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
        $data['store_logo'] = $store_details->store_logo_image;
        $data['todayDate'] = date('m-d-Y');
        $data['todayTime'] = date('H:i:s');
        $data['store_id'] = $this->session->userdata('logged_in_store_id');

        //print_r($store_details);exit;
        $this->db->select('store_opening_time,store_closing_time');
        $this->db->from('store');
        $this->db->where('store_id', $store_id);
        $query = $this->db->get();
        $row = $query->row();
        if (!empty($row->today_opening_time) && !empty($row->today_closing_time)) {
            $opening_time = $row->today_opening_time;
            $closing_time = $row->today_closing_time;
        } else {
            $opening_time = $row->store_opening_time;
            $closing_time = $row->store_closing_time;
        }

        $data['display_name'] = $this->session->userdata('user_name');
        $role_id = $this->session->userdata('role_id');

			switch ($role_id) {
				case 1:
					$data['role'] = "Admin";
					break;

				case 2:
					$data['role'] = "Shop Owner";
					break;

				case 5:
					$data['role'] = "Supplier";
					break;
				case 5:
					$data['role'] = "Kitchen";
					break;

				default:
					$data['role'] = "User";
					break;
			}

    $data['openingTime'] = $opening_time;
    $data['closingTime'] = $closing_time;
    $data['is_online_order_status'] = $store_details->is_order_close;
    $data['is_kot_print_enabled'] = $store_details->is_kot_print_enabled;
    $this->load->view('owner/includes/header',$data);
    $this->load->view('owner/includes/owner-dashboard-menu',$data);
    $this->load->view('owner/settings',$data);
    $this->load->view('owner/includes/footer');
}

public function addHoliday(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('holiday_date', 'date', 'required');
    $this->form_validation->set_rules('holiday_name', ' name', 'required');
    if ($this->form_validation->run() == FALSE)
    {
        $response = [
            'success' => false,
            'errors' => [
                'holiday_date' => form_error('holiday_date'),
                'holiday_name' => form_error('holiday_name')
            ]
        ];
        echo json_encode($response);
    }
    else
    {

        $store_id = $this->session->userdata('logged_in_store_id');
        $data=array(
        'store_id' => $store_id,
        'holiday_date' => $this->input->post('holiday_date'),
        'holiday_name' => $this->input->post('holiday_name'),
        'holiday_description' => $this->input->post('holiday_description'),
        );

        $this->load->model('owner/Ordermodel');
        $this->Ordermodel->AddHoliday($data);
        echo json_encode(['success' => 'success', 'message' => 'Holiday added successfully']);
    }
}


public function whatsapp(){
      $this->load->model('admin/Tablemodel');
     $controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $store_id = $this->session->userdata('logged_in_store_id');

        $store_details = $this->Commonmodel->get_store_details_by_id($store_id);
        $support_details = $this->Commonmodel->get_country_details_by_country_id($store_details->store_country);
        $data['store_disp_name'] = $store_details->store_disp_name;
        $data['store_address'] = $store_details->store_address;
        $data['support_no'] = $support_details->support_number;
        $data['support_email'] = $support_details->support_email;
        $data['store_logo'] = $store_details->store_logo_image;
        $data['todayDate'] = date('m-d-Y');
        $data['todayTime'] = date('H:i:s');
        $data['store_id'] = $this->session->userdata('logged_in_store_id');
        $data['whatsappno'] = $this->Tablemodel->getwhatsapp($store_id);
        //  print_r($data['whatsapp_no']);
    $this->load->view('owner/includes/header',$data);
    // $this->load->view('owner/includes/owner-dashboard',$data);
    $this->load->view('owner/whatsapp',$data);
    $this->load->view('owner/includes/footer');
}


public function addwhatsappno(){
  $this->load->library('form_validation');
    $this->form_validation->set_rules('whatsapp_no', 'whatsapp no', 'required');

    if ($this->form_validation->run() == FALSE)
    {
        $response = [
            'success' => false,
            'errors' => [
                'whatsapp_no' => form_error('whatsapp_no'),

            ]
        ];
        echo json_encode($response);
    }
    else{
     $store_id = $this->session->userdata('logged_in_store_id');
        $data=array(
        'store_id' => $store_id,
        'whatsapp_no' => $this->input->post('whatsapp_no'),
        );
        $this->Ordermodel->AddWhatsapp($data);
        echo json_encode(['success' => 'success']);
    }
}

public function deletewhatsappno(){
    $id=$this->input->post('id');
    // echo $id;
    $this->Productmodel->DeleteWhatsappno($id);
    echo json_encode(['success' => 'success']);

}


   public function getHolidaysByStoreId(){
        $store_id = $this->session->userdata('logged_in_store_id');
        $this->load->model('owner/Ordermodel');
        $getholidaydays=$this->Ordermodel->GetHolidaysByStoreId($store_id);
        echo json_encode($getholidaydays);
}

public function load_store_tables() {
    $store_id = $this->session->userdata('logged_in_store_id');
    $tables = $this->Tablemodel->getTablesByStoreId($store_id);
    echo json_encode($tables);
}

public function DeleteHoliday(){
    $this->load->model('owner/Ordermodel');
    $orderId = $this->input->post('id');
    $deleted = $this->Ordermodel->Delete_Holiday($orderId);
    // Attempt to delete the holiday
    if ($deleted) {
        echo json_encode(['success' => true, 'message' => 'Holiday deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete the holiday']);
    }
}

public function editstoreTime(){
    $store_id = $this->session->userdata('logged_in_store_id');
    $data=array(
        'today_opening_time' => $this->input->post('opening_time'),
        'today_closing_time' => $this->input->post('closing_time'),
        );
        $this->Ordermodel->EditStoreTime($data, $store_id);
        echo json_encode(['success' => 'success']);

}
//MARK: Store Users
public function listStoreUsers(){
    $store_id= $this->session->userdata('logged_in_store_id');
    $data['listusers']=$this->Combomodel->listStoreUsers($store_id);
    $data['tables'] = $this->Tablemodel->getTablesByStoreId($store_id);
    $data['rooms'] = $this->Commonmodel->getActiveRoomsByStoreId($store_id);
    $this->load->view('owner/store_users',$data);
}
public function GetAlreadyAssignedTables(){
    $store_id= $this->session->userdata('logged_in_store_id');
    $user_id= $this->input->post('user_id');
    //echo $store_id;echo $user_id;exit;
    $assignedTables = $this->Settingsmodel->getAssignedTables($store_id, $user_id); // Fetch assigned tables
    $enable_delivery = $this->Settingsmodel->getEnableDelivery($store_id,$user_id); // Fetch enable delivery
    $enable_pickup = $this->Settingsmodel->getEnablePickup($store_id,$user_id);     // Fetch enable pickup

    echo json_encode(['status' => true, 'assignedTables' => $assignedTables , 'enable_delivery' => $enable_delivery, 'enable_pickup' => $enable_pickup]);
}
public function GetAlreadyAssignedRooms(){
    $store_id= $this->session->userdata('logged_in_store_id');
    $user_id= $this->input->post('user_id');
    //echo $store_id;echo $user_id;exit;
    $assignedTables = $this->Settingsmodel->getAssignedTables($store_id, $user_id); // Fetch assigned tables
    $enable_delivery = $this->Settingsmodel->getEnableDelivery($store_id,$user_id); // Fetch enable delivery
    $enable_pickup = $this->Settingsmodel->getEnablePickup($store_id,$user_id);     // Fetch enable pickup

    echo json_encode(['status' => true, 'assignedTables' => $assignedTables , 'enable_delivery' => $enable_delivery, 'enable_pickup' => $enable_pickup]);
}
public function addUserValidation(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('user_name', 'name', 'required');
    $this->form_validation->set_rules('user_email', ' email', 'required|valid_email');
    $this->form_validation->set_rules('user_address', ' address', 'required');
    $this->form_validation->set_rules('user_phoneno', ' phone', 'required|regex_match[/^\d{10}$/]');
    $this->form_validation->set_rules('user_username', ' username', 'required');
    $this->form_validation->set_rules('user_password', ' password', 'required');
    $this->form_validation->set_rules('role', ' role', 'required');

    if ($this->form_validation->run() == FALSE) {
        $response = [
            'success' => false,
            'errors' => [
                'user_name' => form_error('user_name'),
                'user_email' => form_error('user_email'),
                'user_address' => form_error('user_address'),
                'user_phoneno' => form_error('user_phoneno'),
                'user_username' => form_error('user_username'),
                'user_password' => form_error('user_password'),
                'role' => form_error('role')
            ]
        ];
        echo json_encode($response);
    } else {
        $store_id = $this->session->userdata('logged_in_store_id');
        $name   = $this->input->post('user_name');
        $phone  = $this->input->post('user_phoneno');
        $exists = $this->Ordermodel->checkUserExists($name, $phone, $store_id);

        if ($exists) {
            echo json_encode([
                'success' => false,
                 'errors' => [
            'user_name' => 'User with name or phone number already exists'
        ]
            ]);
            return;
        }

        $data = [
            'userroleid' => $this->input->post('role'),
            'store_id' => $store_id,
            'Name' => $name,
            'userEmail' => $this->input->post('user_email'),
            'userName' => $this->input->post('user_username'),
            'userPassword' => md5(trim($this->input->post('user_password'))),
            'UserPhoneNumber' => $phone,
            'UserAddress' => $this->input->post('user_address'),
            'is_active' => 1,
        ];

        $this->Ordermodel->AddUser($data);
        echo json_encode(['success' => 'success']);
    }
}

public function UpdateEditUser(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('edit_user_email', 'Email Address', 'required|valid_email');
    $this->form_validation->set_rules('edit_user_phoneno', 'Phone Number', 'required|regex_match[/^\d{10}$/]'); // 10 digits only
    if ($this->form_validation->run() === FALSE) {
        // Validation failed, reload the form with errors
        $response = [
            'success' => false,
            'errors' => [
                'edit_user_email' => form_error('edit_user_email'),
                'edit_user_phoneno' => form_error('edit_user_phoneno'),
            ]
        ];
        echo json_encode($response);
    } else{
        $user_id= $this->input->post('user_id');
        $data=array(
      'userid'=> $user_id,
        'userroleid'=> $this->input->post('edit_user_role'),
        'store_id'=> $this->session->userdata('logged_in_store_id'),
        'Name'=> $this->input->post('edit_user_name'),
        'userName'=> $this->input->post('edit_user_username'),
        'userEmail'=> $this->input->post('edit_user_email'),
        'userPhoneNumber'=> $this->input->post('edit_user_phoneno')
        );
        $edituseritem=$this->Ordermodel->EditUserList($data,$user_id);
        echo json_encode(['success' => 'success']);
    }
}
public function DeleteUser(){
    $this->Ordermodel->DeleteUser($this->input->post('id'));
    $this->session->set_flashdata('error','User deleted successfully');
}

public function ChangePassword(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('password_changes', 'Password', 'required|min_length[8]|max_length[20]|callback_valid_password');

    if ($this->form_validation->run() === FALSE) {
        $response = [
            'success' => false,
            'errors' => [
                'password_changes' => form_error('password_changes'),
            ]
        ];
        echo json_encode($response);
    } else{

        $user_id= $this->input->post('user_id_change');
        $data=array(
            'userid'=> $user_id,
            'userPassword'=>md5(trim($this->input->post('password_changes')))
        );
 $passwordchanges= $this->Ordermodel->ChangePassword($data,$user_id);
 echo json_encode(['success' => 'success', 'message' => 'Success']);
    }
}

public function update_table()
{
    $tableId = $this->input->post('tableid');
    $table_name = $this->input->post('table_name');
    $store_table_name = $this->input->post('store_table_name');
    $secret_code = $this->input->post('secret_code');
    $this->Settingsmodel->update_table($tableId,$table_name,$store_table_name,$secret_code);
    echo json_encode(['status' => 'success', 'message' => 'Success']);
}

public function clearStoreStock(){
    $store_id = $this->session->userdata('logged_in_store_id');
    $this->Settingsmodel->clearStoreStock($store_id);
    echo json_encode(['status' => 'success', 'message' => 'Success']);
}
public function ChangeOnlineOrderStatus(){
    $status = $this->input->post('status');
    $store_id = $this->session->userdata('logged_in_store_id');
    $this->Settingsmodel->ChangeOnlineOrderStatus($status,$store_id);
    echo json_encode(['status' => 'success', 'message' => 'Success']);
}

public function kotPrintEnable(){
    $store_id = $this->session->userdata('logged_in_store_id');
    $is_kot_print_enable = $this->input->post('is_kot_print_enable');
    $this->Settingsmodel->update_kotprintenable($store_id,$is_kot_print_enable);
    if($is_kot_print_enable == 1){
        echo json_encode(['success' => 'success', 'message' => 'KOT Print Is Enabled']);
    } else{
        echo json_encode(['success' => 'success', 'message' => 'KOT Print Is Disabled']);
    }
}

public function valid_password($password) {
    if (empty($password)) {
        $this->form_validation->set_message('valid_password', 'The {field} field is required.');
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one uppercase letter.');
        return false;
    }
    if (!preg_match('/[a-z]/', $password)) {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one lowercase letter.');
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one numeric digit.');
        return false;
    }
    if (!preg_match('/[\W]/', $password)) {  // Corrected here: added underscore in preg_match
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one special character.');
        return false;
    }

    return true; // Password meets all criteria
}

public function TableAssign(){
    $store_id = $this->session->userdata('logged_in_store_id');
    $data = json_decode(file_get_contents("php://input"), true);

    $user_id = $data['user_id'];
    $selectedTables = $data['selectedTables'];
    $isPickup = $data['isPickup'];
    $isDelivery = $data['isDelivery'];
    $this->Settingsmodel->TableAssign('tbl',$store_id,$user_id,$selectedTables,$isPickup,$isDelivery);
}
public function RoomAssign(){
    $store_id = $this->session->userdata('logged_in_store_id');
    $data = json_decode(file_get_contents("php://input"), true);

    $user_id = $data['user_id'];
    $selectedRooms = $data['selectedRooms'];
    $isPickup = $data['isPickup'];
    $isDelivery = $data['isDelivery'];
    $this->Settingsmodel->TableAssign('rom',$store_id,$user_id,$selectedRooms,$isPickup,$isDelivery);
}
public function user_log_out()
{
    $user_id = $this->input->post('user_id');
    $store_id = $this->session->userdata('logged_in_store_id');
    $this->db->set('logout_time', date('Y-m-d H:i:s'))
        ->where('user_id', $user_id)
        ->where('store_id', $store_id)
        ->update('user_login_logout');

		$this->db->set('is_logged_in', 0 )
        ->where('userid', $user_id)
        ->where('store_id', $store_id)
        ->update('users');

    echo json_encode(['status' => 'success', 'message' => 'Success']);
}




}