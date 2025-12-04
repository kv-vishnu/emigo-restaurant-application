<?php
class Categories extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Productmodel');
    }

    //MARK: - List Categories
    public function index()
	{
        $data['categories']=$this->Productmodel->listcategories();
        $data['order_index']=$this->Productmodel->getNextOrderIndex();
        $this->render_admin_header('admin/catalog/categories', $data);
	}

    public function delete(){
	    $this->Productmodel->delete_category($this->input->post('id'));
		$this->session->set_flashdata('error','Category deleted successfully');
	}

    //MARK: - Add Category
    public function add() {
            $order_index=$this->Productmodel->getNextOrderIndex();
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('category_name_ma', 'Malayalam', 'required');
            $this->form_validation->set_rules('category_name_en', 'English', 'required');
            $this->form_validation->set_rules('category_name_hi', 'Hindi', 'required');
            $this->form_validation->set_rules('category_name_ar', 'Arabic', 'required');
            $this->form_validation->set_rules('category_desc_ma', 'Malayalam', 'required');
            $this->form_validation->set_rules('category_desc_en', 'English', 'required');
            $this->form_validation->set_rules('category_desc_hi', 'Hindi', 'required');
            $this->form_validation->set_rules('category_desc_ar', 'Arabic', 'required');


			if($this->form_validation->run() == FALSE)
			{

                $response = [
					'success' => false,
					'errors' => [
						'category_name_ma' => form_error('category_name_ma'),
						'category_name_en' => form_error('category_name_en'),
                        'category_name_hi' => form_error('category_name_hi'),
                        'category_name_ar' => form_error('category_name_ar'),
                        'category_desc_ma' => form_error('category_desc_ma'),
                        'category_desc_en' => form_error('category_desc_en'),
                        'category_desc_hi' => form_error('category_desc_hi'),
                        'category_desc_ar' => form_error('category_desc_ar'),
					]
				];

				echo json_encode($response);
			}
			else
			{
                $data = array(
                    'store_id' => 0, /* If admin store id default 0 */
                    'category_name_ma' => $this->input->post('category_name_ma'),
                    'category_name_en' => $this->input->post('category_name_en'),
                    'category_name_hi' => $this->input->post('category_name_hi'),
                    'category_name_ar' => $this->input->post('category_name_ar'),
                    'category_desc_ma' => $this->input->post('category_desc_ma'),
                    'category_desc_en' => $this->input->post('category_desc_en'),
                    'category_desc_hi' => $this->input->post('category_desc_hi'),
                    'category_desc_ar' => $this->input->post('category_desc_ar'),
                    'order_index' =>$order_index,
                    'is_active' => 1,
                );
                $this->Productmodel->insert_categories_translation($data);
                echo json_encode(['success' => 'success']);
        }
}

    //MARK: - Category disable
	public function disable()
	{
		$id     = $this->input->post('id');
		$type   = $this->input->post('type'); // 'store' or 'product'
		$this->Commonmodel->disable_record('categories', 'is_active', ['category_id' => $id]);
		echo json_encode(['status' => 'success']);
	}

	//MARK: - Category enable
	public function enable()
	{
		$id     = $this->input->post('id');
		$type   = $this->input->post('type'); // 'store' or 'product'
		$this->Commonmodel->enable_record('categories', 'is_active', ['category_id' => $id]);
		echo json_encode(['status' => 'success']);
	}


public function edit(){
    $id = $this->input->post('id');
    $edit_category = $this->Productmodel->get_categories_by_id($id);

    // print_r($edit_category);
    if (!$edit_category || !is_array($edit_category))
    {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid enquiry_details data.'
        ]);
        return;
    }
    $result = [
            'category_code' => $edit_category['category_code'] ?? null,
            'order_index' => $edit_category['order_index'] ?? null,
            // 'category_img' => $edit_category['category_img'] ?? null,
            'category_name_ma' => $edit_category['category_name_ma'],
            'category_name_en' => $edit_category['category_name_en'],
            'category_name_hi' => $edit_category['category_name_hi'],
            'category_name_ar' => $edit_category['category_name_ar'],
            'category_desc_ma' => $edit_category['category_desc_ma'],
            'category_desc_en' => $edit_category['category_desc_en'],
            'category_desc_hi' => $edit_category['category_desc_hi'],
            'category_desc_ar' => $edit_category['category_desc_ar'],
            'is_active' => 1,
    ];
    echo json_encode([
        'success' => 'success',
        'data' => $result
    ]);
    // print_r($result);exit;
}


//MARK: - Update Category
public function updatecategorydetails(){
    $id = $this->input->post('hidden_category_id');
    // $order_index=$this->Productmodel->getNextOrderIndex();
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->form_validation->set_rules('category_name_ma', 'Malayalam', 'required');
    $this->form_validation->set_rules('category_name_en', 'English', 'required');
    $this->form_validation->set_rules('category_name_hi', 'Hindi', 'required');
    $this->form_validation->set_rules('category_name_ar', 'Arabic', 'required');
    $this->form_validation->set_rules('category_desc_ma', 'Malayalam', 'required');
    $this->form_validation->set_rules('category_desc_en', 'English', 'required');
    $this->form_validation->set_rules('category_desc_hi', 'Hindi', 'required');
    $this->form_validation->set_rules('category_desc_ar', 'Arabic', 'required');
    // $this->form_validation->set_rules('category_order', 'Order', 'required');

    if($this->form_validation->run() == FALSE)
    {

        $response = [
            'success' => false,
            'errors' => [
                'category_name_ma' => form_error('category_name_ma'),
                'category_name_en' => form_error('category_name_en'),
                'category_name_hi' => form_error('category_name_hi'),
                'category_name_ar' => form_error('category_name_ar'),
                'category_desc_ma' => form_error('category_desc_ma'),
                'category_desc_en' => form_error('category_desc_en'),
                'category_desc_hi' => form_error('category_desc_hi'),
                'category_desc_ar' => form_error('category_desc_ar'),
            ]
        ];
        echo json_encode($response);
    }
             else
          {
                $data = array(
                    'store_id' => 0, /* If admin store id default 0 */
                    'category_name_ma' => $this->input->post('category_name_ma'),
                    'category_name_en' => $this->input->post('category_name_en'),
                    'category_name_hi' => $this->input->post('category_name_hi'),
                    'category_name_ar' => $this->input->post('category_name_ar'),
                    'category_desc_ma' => $this->input->post('category_desc_ma'),
                    'category_desc_en' => $this->input->post('category_desc_en'),
                    'category_desc_hi' => $this->input->post('category_desc_hi'),
                    'category_desc_ar' => $this->input->post('category_desc_ar'),
                    'order_index' => $this->input->post('category_order'),
                    'is_active' => 1,
                );

         $this->Productmodel->update_categories($id,$data);
         echo json_encode(['success' => 'success']);
}
}


public function DeleteCategory(){
    $id=$this->input->post('id');
    // echo $id;
    $this->Productmodel->DeleteCategory($id);
}


// public function edit(){
//     // if(isset($_POST['edit']))
//     // {
//         $id=$this->input->post('id'); //echo $id;die();
//         $data['categoryDet']=$this->Productmodel->get_categories_by_id($id);//print_r($data['categoryDet']);exit;
//         $this->form_validation->set_error_delimiters('', '');
//         $this->form_validation->set_rules('code', 'Code', 'required');
//         $this->form_validation->set_rules('userfile', 'Image', 'callback_validate_image_dimensions');
//         $this->form_validation->set_rules('category_name_ma', 'Malayalam', 'required');
//         $this->form_validation->set_rules('category_name_en', 'English', 'required');
//         $this->form_validation->set_rules('category_name_hi', 'Hindi', 'required');
//         $this->form_validation->set_rules('category_name_ar', 'Arabic', 'required');
//         $this->form_validation->set_rules('category_desc_ma', 'Malayalam', 'required');
//         $this->form_validation->set_rules('category_desc_en', 'English', 'required');
//         $this->form_validation->set_rules('category_desc_hi', 'Hindi', 'required');
//         $this->form_validation->set_rules('category_desc_ar', 'Arabic', 'required');
//         $this->form_validation->set_rules('order', 'Order Index', 'required');
//         if ($this->form_validation->run() == FALSE)
//         {

//             $response = [
//                 'success' => false,
//                 'errors' => [
//                     // Uncomment the fields you want to validate
//                     // 'user_name' => form_error('user_name'),
//                     // 'user_email' => form_error('user_email'),
//                     // 'user_address' => form_error('user_address'),
//                     // 'user_phoneno' => form_error('user_phoneno'),
//                     'category_code' => form_error('category_code'),
//                     'category_order' => form_error('category_order'),
//                     'userfile' => form_error('userfile'),
//                     'category_name_ma' => form_error('category_name_ma'),
//                     'category_name_en' => form_error('category_name_en'),
//                     'category_name_hi' => form_error('category_name_hi'),
//                     'category_name_ar' => form_error('category_name_ar'),
//                     'category_desc_ma' => form_error('category_desc_ma'),
//                     'category_desc_en' => form_error('category_desc_en'),
//                     'category_desc_hi' => form_error('category_desc_hi'),
//                     'category_desc_ar' => form_error('category_desc_ar'),
//                     // 'role' => form_error('role'),
//                 ]
//             ];

//             echo json_encode($response);
//             //echo "here";exit;
//             // $this->load->view('admin/includes/header');
//             // $this->load->view('admin/catalog/edit_categories',$data);
//             // $this->load->view('admin/includes/footer');
//         }
//         else
//         {
//             //echo "here";exit;
//             if(!empty($_FILES['userfile']['name'])){
//                 $image_path = './uploads/categories/';
// 				unlink($image_path);
//                 $config['upload_path'] = './uploads/categories/';
//                 $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
//                 $config['file_name'] = $_FILES['userfile']['name'];


//                 $this->load->library('upload',$config);
//                 $this->upload->initialize($config);

//                 if($this->upload->do_upload('userfile')){
//                     //echo "uploaded";exit;
//                     $uploadData = $this->upload->data();
//                     $userfile = $uploadData['file_name'];
//                 }else{
//                     //echo "here1";exit;
//                     $error =  $this->upload->display_errors(); echo $error;
//                     $this->load->view('admin/includes/header');
//                     // $this->load->view('admin/catalog/edit_categories',$error);
//                     $this->load->view('admin/includes/footer');
//                 }
//             }else{
//                 // $userfile = $this->security->xss_clean($this->input->post('old_image'));
//             }


//             $data = array(
//                 'category_code' => $this->input->post('code'),
//                 'store_id' => 0, //If admin store id default 0
//                 'category_name_ma' => $this->input->post('category_name_ma'),
//                 'category_name_en' => $this->input->post('category_name_en'),
//                 'category_name_hi' => $this->input->post('category_name_hi'),
//                 'category_name_ar' => $this->input->post('category_name_ar'),
//                 'category_desc_ma' => $this->input->post('category_desc_ma'),
//                 'category_desc_en' => $this->input->post('category_desc_en'),
//                 'category_desc_hi' => $this->input->post('category_desc_hi'),
//                 'category_desc_ar' => $this->input->post('category_desc_ar'),
//                 'category_img' => $userfile,
//                 'order_index' => $this->input->post('order'),
//                 'is_active' => 1,
//             );
//                 //print_r($data);exit;
//             $this->Productmodel->update_categories($id,$data);
//             // $this->session->set_flashdata('success','Category details updated...');
//             // redirect('admin/categories');
//         }
//     // }

// }



public function validate_image_dimensions()
{
    // Get the file from the $_FILES array
    $file = $_FILES['userfile'];

    // Check if a file was uploaded
    if ($file['size'] > 0) {
        // Get image information like width and height
        $image_info = getimagesize($file['tmp_name']);
        //print_r($image_info);exit;
        $width = 786;
        $height = 480;

        // Check if image dimensions meet the criteria
        if (($image_info[0] == 786) && ($image_info[1] == 480)) {
            return TRUE;
        } else {
            // Set a custom error message if validation fails
            $this->form_validation->set_message('validate_image_dimensions', "The image dimensions should be {$width}x{$height} pixels.");
            return FALSE;
        }
    } else {
        // If no file was uploaded, you can choose to return TRUE or handle it differently
        if($this->input->post('existing_userfile') != ''){
            return TRUE;
        }else{
            $this->form_validation->set_message('validate_image_dimensions', 'Please upload an image.');
            return FALSE;
        }
    }
}
public function categoryname_exists($country)
	{
		if ($this->Productmodel->check_categoryname_exists($country)) {
			$this->form_validation->set_message('categoryname_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
    public function categorycode_exists($country)
	{
		if ($this->Productmodel->check_categorycode_exists($country)) {
			$this->form_validation->set_message('categorycode_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
    public function categoryorder_exists($order)
	{
		if ($this->Productmodel->check_categoryorder_exists($order)) {
			$this->form_validation->set_message('categoryorder_exists', 'The {field} is already taken.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

    public function update_order_index(){
        $id = $this->input->post('id');
        $order_index = $this->input->post('order_index');
        $this->Productmodel->update_order_index($id,$order_index);
    }

}
?>
