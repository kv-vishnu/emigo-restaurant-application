<?php
class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Productmodel');
    }

    public function index()
	{
        $data['categories']=$this->Productmodel->liststorecategories(0,$this->session->userdata('logged_in_store_id')); //store id 0(Added by admin),current login store id
		$this->load->view('owner/includes/header');
		$this->load->view('owner/catalog/categories',$data);
		$this->load->view('owner/includes/footer');
	}

    public function delete(){
	    $this->Productmodel->delete_category($this->input->post('id'));
		$this->session->set_flashdata('error','Category deleted successfully');
	}

    // Function to add a product with translations
    public function add() {
        if(isset($_POST['add']))
		{

            $this->form_validation->set_error_delimiters('', ''); 
			$this->form_validation->set_rules('code', 'Code', 'required|callback_categorycode_exists');
            $this->form_validation->set_rules('userfile', 'Image', 'callback_validate_image_dimensions');
            $this->form_validation->set_rules('category_name_ma', 'Malayalam', 'required');
            $this->form_validation->set_rules('category_name_en', 'English', 'required|callback_categoryname_exists');
            $this->form_validation->set_rules('category_name_hi', 'Hindi', 'required');
            $this->form_validation->set_rules('category_name_ar', 'Arabic', 'required');
            $this->form_validation->set_rules('category_desc_ma', 'Malayalam', 'required');
            $this->form_validation->set_rules('category_desc_en', 'English', 'required');
            $this->form_validation->set_rules('category_desc_hi', 'Hindi', 'required');
            $this->form_validation->set_rules('category_desc_ar', 'Arabic', 'required');
            $this->form_validation->set_rules('order', 'Order Index', 'required|callback_categoryorder_exists');
			
		
			if($this->form_validation->run() == FALSE) 
			{
				//echo "here";exit;
				$this->load->view('owner/includes/header');
			    $this->load->view('owner/catalog/add_categories'); 
			    $this->load->view('owner/includes/footer');
			}
			else
			{
                if(!empty($_FILES['userfile']['name'])){
                    //echo "here";exit;
					$config['upload_path'] = './uploads/categories/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
					$config['file_name'] = $_FILES['userfile']['name'];
					
					
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('userfile')){
                        //echo "uploaded";exit;
						$uploadData = $this->upload->data();
						$userfile = $uploadData['file_name'];
					}else{
                        //echo "here1";exit;
                        $error =  $this->upload->display_errors(); echo $error;
                        $this->load->view('owner/includes/header');
			            $this->load->view('owner/catalog/add_categories',$error); 
			            $this->load->view('owner/includes/footer');
					}
				}else{
                    //echo "here2";exit;
					$userfile = '';
				}

                $data = array(
                    'category_code' => $this->input->post('code'),
                    'store_id' => $this->session->userdata('logged_in_store_id'), //If admin store id default 0 otherwise store id
                    'category_name_ma' => $this->input->post('category_name_ma'),
                    'category_name_en' => $this->input->post('category_name_en'),
                    'category_name_hi' => $this->input->post('category_name_hi'),
                    'category_name_ar' => $this->input->post('category_name_ar'),
                    'category_desc_ma' => $this->input->post('category_desc_ma'),
                    'category_desc_en' => $this->input->post('category_desc_en'),
                    'category_desc_hi' => $this->input->post('category_desc_hi'),
                    'category_desc_ar' => $this->input->post('category_desc_ar'),
                    'category_img' => $userfile,
                    'order_index' => $this->input->post('order'),
                    'is_active' => 1,
                );
            

                $this->Productmodel->insert_categories_translation($data);
            

            // Redirect or display success message
            redirect('owner/categories');
        }
    }
    else
    {
        $this->load->view('owner/includes/header');
        $this->load->view('owner/catalog/add_categories');
        $this->load->view('owner/includes/footer'); 
    }
}


public function edit(){
    if(isset($_POST['edit']))
    {
        //echo $this->session->userdata('logged_in_store_id');exit;
        $id=$this->input->post('id'); //echo $id;die();
        $data['categoryDet']=$this->Productmodel->get_categories_by_id($id);//print_r($data['categoryDet']);exit;
        $this->form_validation->set_error_delimiters('', ''); 
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('userfile', 'Image', 'callback_validate_image_dimensions');
        $this->form_validation->set_rules('category_name_ma', 'Malayalam', 'required');
        $this->form_validation->set_rules('category_name_en', 'English', 'required');
        $this->form_validation->set_rules('category_name_hi', 'Hindi', 'required');
        $this->form_validation->set_rules('category_name_ar', 'Arabic', 'required');
        $this->form_validation->set_rules('category_desc_ma', 'Malayalam', 'required');
        $this->form_validation->set_rules('category_desc_en', 'English', 'required');
        $this->form_validation->set_rules('category_desc_hi', 'Hindi', 'required');
        $this->form_validation->set_rules('category_desc_ar', 'Arabic', 'required');
        $this->form_validation->set_rules('order', 'Order Index', 'required');
        if ($this->form_validation->run() == FALSE) 
        {
            //echo "here";exit;
            $this->load->view('owner/includes/header');
            $this->load->view('owner/catalog/edit_categories',$data); 
            $this->load->view('owner/includes/footer');
        }
        else
        {
            //echo "here";exit;
            if(!empty($_FILES['userfile']['name'])){
                $image_path = './uploads/categories/' . $this->input->post('old_image');
				unlink($image_path);
                $config['upload_path'] = './uploads/categories/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
                $config['file_name'] = $_FILES['userfile']['name'];
                
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('userfile')){
                    //echo "uploaded";exit;
                    $uploadData = $this->upload->data();
                    $userfile = $uploadData['file_name'];
                }else{
                    //echo "here1";exit;
                    $error =  $this->upload->display_errors(); echo $error;
                    $this->load->view('owner/includes/header');
                    $this->load->view('owner/catalog/edit_categories',$error); 
                    $this->load->view('owner/includes/footer');
                }
            }else{
                $userfile = $this->security->xss_clean($this->input->post('old_image'));
            }

            $data = array(
                'category_code' => $this->input->post('code'),
                'store_id' => $this->session->userdata('logged_in_store_id'), //If admin store id default 0 otherwise store id
                'category_name_ma' => $this->input->post('category_name_ma'),
                'category_name_en' => $this->input->post('category_name_en'),
                'category_name_hi' => $this->input->post('category_name_hi'),
                'category_name_ar' => $this->input->post('category_name_ar'),
                'category_desc_ma' => $this->input->post('category_desc_ma'),
                'category_desc_en' => $this->input->post('category_desc_en'),
                'category_desc_hi' => $this->input->post('category_desc_hi'),
                'category_desc_ar' => $this->input->post('category_desc_ar'),
                'category_img' => $userfile,
                'order_index' => $this->input->post('order'),
                'is_active' => 1,
            );
                //print_r($data);exit;
            $this->Productmodel->update_categories($id,$data);
            $this->session->set_flashdata('success','Category details updated...');
            redirect('owner/categories');
        }
    }
    else
    {
        //echo "this1=" . $this->input->post('id1');exit;
        $id=$this->input->post('id'); 
        $data['categoryDet']=$this->Productmodel->get_categories_by_id($id);//print_r($data['categoryDet']);exit;
        $this->load->view('owner/includes/header');
        $this->load->view('owner/catalog/edit_categories',$data); 
        $this->load->view('owner/includes/footer');
    }
}



public function validate_image_dimensions($file)
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
        if($this->input->post('old_image') != ''){
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

}
?>
