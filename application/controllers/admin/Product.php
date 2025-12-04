<?php
class Product extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Productmodel');
        $this->load->model('admin/Commonmodel');
        $this->load->library('pagination');
    }

    //MARK: - List Products
    public function index()
	{
        $logged_in_store_id = $this->session->userdata('logged_in_store_id');
        $config['total_rows'] = $this->Productmodel->getStoreProductsCountbyadmin($logged_in_store_id);
        $config['base_url'] = site_url('admin/Product/index');
        $config['per_page'] = 6; // number of rows per page
        $config['uri_segment'] = 4; // which URI segment contains the page numberg
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '<span class="pagination-previous">Previous</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = '<span class="pagination-next">Next</span>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        // Custom icons for first and last links
        $config['first_link'] = '<span class="pagination-first">First</span>'; // First link icon
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '<span class="pagination-last">Last</span>'; // Last link icon
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['products'] = $this->Productmodel->listproducts($page,$config['per_page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories']=$this->Commonmodel->listactivecategories();
        $this->render_admin_header('admin/catalog/products', $data);
	}

    //MARK: - Product disable
	public function disable()
	{
		$id     = $this->input->post('id');
		$type   = $this->input->post('type'); // 'store' or 'product'
		$this->Commonmodel->disable_record('product', 'is_active', ['product_id' => $id]);
		echo json_encode(['status' => 'success']);
	}

	//MARK: - Product enable
	public function enable()
	{
		$id     = $this->input->post('id');
		$type   = $this->input->post('type'); // 'store' or 'product'
		$this->Commonmodel->enable_record('product', 'is_active', ['product_id' => $id]);
		echo json_encode(['status' => 'success']);
	}

    //MARK: - Add Product
   public function add()
{
    $this->load->library('upload');

    $max_size = 2 * 1024 * 1024; // 2 MB in bytes
    $upload_images = [];
    $failed_images = [];

    for ($i = 1; $i <= 4; $i++) {

        $input_name = 'image' . $i;

        if (!empty($_FILES[$input_name]['name'])) {

            // Check file size
            if ($_FILES[$input_name]['size'] > $max_size) {
                $failed_images[] = $input_name . ': File size exceeds 2 MB';
                $upload_images[] = null;
                continue; // Skip upload for this file
            }

            // Map file to upload library expected key
            $_FILES['image']['name']     = $_FILES[$input_name]['name'];
            $_FILES['image']['type']     = $_FILES[$input_name]['type'];
            $_FILES['image']['tmp_name'] = $_FILES[$input_name]['tmp_name'];
            $_FILES['image']['error']    = $_FILES[$input_name]['error'];
            $_FILES['image']['size']     = $_FILES[$input_name]['size'];

            $config = [
                'upload_path'   => './uploads/product/',
                'allowed_types' => 'jpg|jpeg|png|webp',
                'file_name'     => $this->input->post('products_name_en') . '_' . $i
            ];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $upload_images[] = $upload_data['file_name'];
            } else {
                $failed_images[] = $input_name . ': ' . $this->upload->display_errors('', '');
                $upload_images[] = null;
            }

        } else {
            $failed_images[] = $input_name . ': No file selected';
            $upload_images[] = null;
        }
    }

    $data = [
        'category_id' => $this->input->post('category_id'),
        'store_id' => 0,
        'image1' => $upload_images[0],
        'image2' => $upload_images[1],
        'image3' => $upload_images[2],
        'image4' => $upload_images[3],

        'product_name_ma' => $this->input->post('products_name_ma'),
        'product_name_en' => $this->input->post('products_name_en'),
        'product_name_hi' => $this->input->post('products_name_hi'),
        'product_name_ar' => $this->input->post('products_name_ar'),

        'product_desc_ma' => $this->input->post('products_desc_ma'),
        'product_desc_en' => $this->input->post('products_desc_en'),
        'product_desc_hi' => $this->input->post('products_desc_hi'),
        'product_desc_ar' => $this->input->post('products_desc_ar'),

        'is_active' => 1
    ];

    if (!empty($failed_images)) {
        echo json_encode([
            "status" => "partial_error",
            "failed_images" => $failed_images,
            "message" => "Some images failed (size or upload issue)"
        ]);

    } else {
        $this->Productmodel->insert_product_translation($data);
        echo json_encode([
            "status" => "success",
            "data" => $data,
            "message" => "Product added successfully"
        ]);
    }
}




    public function add1() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('products_name_ma', 'Malayalam', 'required');
        $this->form_validation->set_rules('products_name_en', 'English', 'required');
        $this->form_validation->set_rules('products_name_hi', 'Hindi', 'required');
        $this->form_validation->set_rules('products_name_ar', 'Arabic', 'required');
        $this->form_validation->set_rules('products_desc_ar', 'Arabic', 'required');
        $this->form_validation->set_rules('products_desc_ma', 'Malayalam', 'required');
        $this->form_validation->set_rules('products_desc_hi', 'Hindi', 'required');
        $this->form_validation->set_rules('products_desc_en', 'English', 'required');
        if (empty($_FILES['image1']['name'])) {
            $this->form_validation->set_rules('image1', 'Image 1', 'required');
        }
        if (empty($_FILES['image2']['name'])) {
            $this->form_validation->set_rules('image2', 'Image 2', 'required');
        }
        if (empty($_FILES['image3']['name'])) {
            $this->form_validation->set_rules('image3', 'Image 3', 'required');
        }
        if (empty($_FILES['image4']['name'])) {
            $this->form_validation->set_rules('image4', 'Image 4', 'required');
        }
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, send errors back to the view
            $response = [
                'success' => false,
                'errors' => [
                    'category_id' => form_error('category_id'),
                    'products_name_ma' => form_error('products_name_ma'),
                    'products_name_en' => form_error('products_name_en'),
                    'products_name_hi' => form_error('products_name_hi'),
                    'products_name_ar' => form_error('products_name_ar'),
                    'products_desc_ma' => form_error('products_desc_ma'),
                    'products_desc_en' => form_error('products_desc_en'),
                    'products_desc_hi' => form_error('products_desc_hi'),
                    'products_desc_ar' => form_error('products_desc_ar'),
                    'image1' => form_error('image1'),
                    'image2' => form_error('image2'),
                    'image3' => form_error('image3'),
                    'image4' => form_error('image4'),

                ]
            ];
            echo json_encode($response);
        } else {


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

                    $config['upload_path']   = './uploads/product/';
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
                        $uploaded_images[] = 'uploads/product/' . $upload_data['file_name'];
                        $upload_images[] = $upload_data['file_name'];

                    }
                }
            }
            $data = array(
                'category_id' => $this->input->post('category_id'),
                'store_id' => 0, //If admin store id default 0
                'image1' => isset($upload_images[0]) ? $upload_images[0] : null,
                'image2' => isset($upload_images[1]) ? $upload_images[1] : null,
                'image3' => isset($upload_images[2]) ? $upload_images[2] : null,
                'image4' => isset($upload_images[3]) ? $upload_images[3] : null,
                'product_name_ma' => $this->input->post('products_name_ma'),
                'product_name_en' => $this->input->post('products_name_en'),
                'product_name_hi' => $this->input->post('products_name_hi'),
                'product_name_ar' => $this->input->post('products_name_ar'),
                'product_desc_ma' => $this->input->post('products_desc_ma'),
                'product_desc_en' => $this->input->post('products_desc_en'),
                'product_desc_hi' => $this->input->post('products_desc_hi'),
                'product_desc_ar' => $this->input->post('products_desc_ar'),
                'is_active' => 1
            );
            $this->Productmodel->insert_product_translation($data);
            echo json_encode(['success' => 'success']);
        }
    }
//MARK: Edit Details Product Popup
public function edit()
{
        $id=$this->input->post('id');
        $data['subcategories']=$this->Productmodel->sublistcategories();
        $data['categories']=$this->Commonmodel->listactivecategories();
        $edit_product=$this->Productmodel->get_product_by_id($id);   //print_r( $edit_product);exit;

        if (!$edit_product || !is_array($edit_product))
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
            'category_id' => $edit_product['category_id'],
            'store_id' => $edit_product['store_id'], //If admin store id default 0
            'image1' => $edit_product['image1'],
            'image2' =>  $edit_product['image2'],
            'image3' =>  $edit_product['image3'],
            'image4' =>  $edit_product['image4'],
            'product_name_ma' => $edit_product['product_name_ma'],
            'product_name_en' => $edit_product['product_name_en'],
            'product_name_hi' =>$edit_product['product_name_hi'],
            'product_name_ar' => $edit_product['product_name_ar'],
            'product_desc_ma' => $edit_product['product_desc_ma'],
            'product_desc_en' => $edit_product['product_desc_en'],
            'product_desc_hi' => $edit_product['product_desc_hi'],
            'product_desc_ar' => $edit_product['product_desc_ar'],
            'is_active' => $edit_product['is_active']
        ];

        // print_r($result); exit;
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
}
public function update_image() {
    $this->load->helper('string');
    $imageData = $this->input->post('image');
    $imageId = $this->input->post('imageId');
    $fileName = random_string('alnum', 16).'cropped-image.jpg';  // Or dynamically generate this based on your logic

    // Ensure correct MIME type (if you are working with PNG or JPEG)
    $mimeType = 'image/jpeg';  // Set based on your choice of format (image/png, image/jpeg)

    // Remove the base64 part and get the image data
    list($type, $data) = explode(';', $imageData);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Define the path to save the image
    $filePath = FCPATH . './uploads/product/' . $fileName;

    // Save the image to a file
    if (file_put_contents($filePath, $data)) {
        echo json_encode(['filename'=>$fileName,'imageId'=> $imageId]);

    } else {
        echo 'Failed to save the image';
    }
}

public function update_image1() {

       // Example of file upload handler in CodeIgniter
$config['upload_path'] = './uploads/product/';
$config['allowed_types'] = 'jpg|png|jpeg';
$this->load->library('upload', $config);

if ($this->upload->do_upload('file')) {
    $data = $this->upload->data();
    echo 'File uploaded successfully!';
} else {
    echo 'File upload failed!';
}

}



public function update(){
    $id = $this->input->post('hidden_products_id');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('category_id', 'Category', 'required');
    $this->form_validation->set_rules('products_name_ma', 'Malayalam', 'required');
    $this->form_validation->set_rules('products_name_en', 'English', 'required');
    $this->form_validation->set_rules('products_name_hi', 'Hindi', 'required');
    $this->form_validation->set_rules('products_name_ar', 'Arabic', 'required');
    $this->form_validation->set_rules('products_desc_ar', 'Arabic', 'required');
    $this->form_validation->set_rules('products_desc_ma', 'Malayalam', 'required');
    $this->form_validation->set_rules('products_desc_hi', 'Hindi', 'required');
    $this->form_validation->set_rules('products_desc_en', 'English', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            $response = [
                'success' => false,
                'errors' => [
                    'category_id' => form_error('category_id'),
                    'products_name_ma' => form_error('products_name_ma'),
                    'products_name_en' => form_error('products_name_en'),
                    'products_name_hi' => form_error('products_name_hi'),
                    'products_name_ar' => form_error('products_name_ar'),
                    'products_desc_ma' => form_error('products_desc_ma'),
                    'products_desc_en' => form_error('products_desc_en'),
                    'products_desc_hi' => form_error('products_desc_hi'),
                    'products_desc_ar' => form_error('products_desc_ar')
                ]
            ];
            echo json_encode($response);
        }
        else
        {
            $this->load->library('upload');
            $this->load->library('image_lib');

            $upload_images = [];

            // Loop to upload multiple images
            for ($i = 1; $i <= 4; $i++) {
                $input_name = 'image' . $i; // corrected name (images1, images2...)

                if (!empty($_FILES[$input_name]['name'])) {
                    $_FILES['image']['name']     = $_FILES[$input_name]['name'];
                    $_FILES['image']['type']     = $_FILES[$input_name]['type'];
                    $_FILES['image']['tmp_name'] = $_FILES[$input_name]['tmp_name'];
                    $_FILES['image']['error']    = $_FILES[$input_name]['error'];
                    $_FILES['image']['size']     = $_FILES[$input_name]['size'];

                    $config['upload_path']   = './uploads/product/';
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
                        $upload_images[$i] = $upload_data['file_name']; // Save uploaded filename
                    }
                }
                else{
                $upload_images[$i] = $this->input->post('imagehidden'.$i);
                }
            }
            $data = array(
                'category_id' => $this->input->post('category_id'),
                'store_id' => 0,
                'product_name_ma' => $this->input->post('products_name_ma'),
                'product_name_en' => $this->input->post('products_name_en'),
                'product_name_hi' => $this->input->post('products_name_hi'),
                'product_name_ar' => $this->input->post('products_name_ar'),
                'product_desc_ma' => $this->input->post('products_desc_ma'),
                'product_desc_en' => $this->input->post('products_desc_en'),
                'product_desc_hi' => $this->input->post('products_desc_hi'),
                'product_desc_ar' => $this->input->post('products_desc_ar'),
                'is_active' => 1,
                'image1'  => $upload_images[1],
                'image2' => $upload_images[2],
                'image3' => $upload_images[3],
                'image4' => $upload_images[4],
            );
            $this->Productmodel->update_product($id, $data);
            echo json_encode(['success' => 'success','data'=>$data]);
        }

    }


public function Deleteproduct(){
    $id=$this->input->post('id');
    $this->Productmodel->delete_product($id);
}

//MARK: - Search Products on admin key up
public function searchProductOnadminKeyUp(){
    $search = $this->input->get('search');
    $searchproducts=$this->Productmodel->shopAssignedProductsByadminKeyUpSearch($search);
    // print_r($searchproducts);
    $html = '';
    $count = 1;
    if (!empty($searchproducts)) {
        $count = 1;
        foreach ($searchproducts as $val) {
            $image = base_url() . 'uploads/product/' . ($val->image1 ?? '');

            $html .= "

             <tr>
     <td>{$count}</td>
     <td>{$val->product_name_en}</td>
      <td>{$this->Productmodel->getCategoryName($val->category_id)}</td>
     <td><img width='100' height='100' src='{$image}' class='img-thumbnail'></td>
     <td class='pb-0 pt-0 d-flex'>
         <input type='hidden' name='id' value='{$val->product_id}'>
         <button class='btn tblEditBtn edit_product pl-0 pr-0' type='button' data-bs-toggle='modal' data-id='{$val->product_id}' data-bs-target='#edit-product'><i class='fa fa-edit'></i></button>
         <a class='btn tblDelBtn pl-0 pr-0 del_product' type='button' data-id='{$val->product_id}' data-bs-toggle='modal' data-bs-target='#delete-product'><i class='fa fa-trash'></i></a>
     </td>
 </tr>
            ";
            $count++;
        }
    } else {
        $html .= "<tr><td colspan='8'>No products found.</td></tr>";
    }

    echo $html;
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