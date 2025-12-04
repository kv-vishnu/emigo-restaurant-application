<?php
Class Commonmodel extends CI_Model
{

	public function __construct()
	{
        parent::__construct();
    }
    //MARK: - Get Store Details by ID
    public function get_store_details_by_id($id){
        $this->db->select('*');
        $this->db->from('store');
        $this->db->where('store_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //MARK: - Get Product Details by ID
    public function get_product_details_by_id($id){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //MARK: - Get Store Product Details by ID
    public function get_store_product_details_by_id($id){
        $this->db->select('*');
        $this->db->from('store_wise_product_assign');
        $this->db->where('store_product_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //MARK: - Get Country Details by Country ID
    public function get_country_details_by_country_id($country_id){
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    //MARK: - Delete Record
    public function delete_record($table, $where)
    {
        if ($this->db->where($where)->delete($table)) {
            return true;
        }
        return false;
    }
    //MARK: - Update Record
    public function update($table, $where, $data)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
    //MARK: - Get Active Records
    public function get_records($table, $only_active = false, $status_field = 'is_active', $extra_where = [], $order_by = null, $order_dir = 'ASC')
    {
        if ($only_active) {
            $this->db->where($status_field, 1);
        }

        if (!empty($extra_where)) {
            $this->db->where($extra_where);
        }

        if ($order_by) {
            $this->db->order_by($order_by, $order_dir);
        }

        return $this->db->get($table)->result_array();
    }
    //MARK: - Get Inactive Records
    public function get_inactive_records($table)
    {
        $this->db->where('is_active', 0);
        $this->db->order_by('store_id', 'DESC');
        return $this->db->get($table)->result_array();
    }

    //MARK: - Get Inactive Records
    public function get_unapproved_records($table)
    {
        $this->db->where('is_approve', 0);
        $this->db->order_by('store_id', 'DESC');
        return $this->db->get($table)->result_array();
    }
    //MARK: - Approve Record
    public function approve_record($table,$field, $where)
    {
        $data = array($field => 1);
        if($table == 'store'){
            $data['is_active'] = 1;
        }
        $this->db->where($where);
        if ($this->db->update($table, $data)) {
            return true;
        }
        return false;
    }
    //MARK: - Disable Record
    public function disable_record($table, $status_field, $where, $value = 0)
    {
        $data = [$status_field => $value];
        return $this->db->where($where)->update($table, $data);
    }
    //MARK: - Enable Record
    public function enable_record($table, $status_field, $where, $value = 1)
    {
        $data = [$status_field => $value];
        return $this->db->where($where)->update($table, $data);
    }
    //MARK: - List Active Categories
    public function listactivecategories()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('is_active', 1);
        $this->db->order_by('category_name_en', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    //MARK: - List Store products
    public function shopAssignedProductsbyPagination() {
        $store_id = $this->session->userdata('logged_in_store_id');
		$type = '';
		$products_by_category_active = [];
        $category_ids_order = $this->getAllCategoriesOrderByStore($store_id);
		//  print_r($category_ids_order);
        foreach ($category_ids_order as $cat_order) {
               $category_id = $cat_order['category_id'];
               $allproducts = $this->getAllProductsByStoreOrderByType($store_id, $category_id,$type);

			//  print_r($allproducts);
               $products_by_category_active[$category_id] = $allproducts;
			//    print_r($products_by_category_active);
        }
        $allproducts = array_merge_recursive($products_by_category_active);
        $inactiveProducts = [];
        $activeProducts = [];

        // Separate products by status
        foreach ($allproducts as $category_id => $products) {
            foreach ($products as $product) {
                if ($product['status'] == 0) {
                    $inactiveProducts[] = $product;
                } elseif ($product['status'] == 1) {
                    $activeProducts[] = $product;
                }
            }
        }
        // Merge the arrays
        $results = array_merge($inactiveProducts, $activeProducts);
        return $results;
    }
    public function getAllCategoriesOrderByStore($store_id){
        $this->db->select('category_id');
        $this->db->from('categories');
        $this->db->order_by('order_index', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllProductsByStoreOrderByType($store_id, $category_id , $type) {
        $this->db->select(
            's.product_id,
             s.store_product_id,
             s.is_active,
             s.availability,
             s.remarks,
             IFNULL(s.image, "default.png") as store_image,
             s.store_product_desc_en,
             s.store_product_name_en,
             s.store_product_desc_ma,
             s.store_product_name_ma,
             s.store_product_desc_hi,
             s.store_product_name_hi,
             s.store_product_desc_ar,
             s.store_product_name_ar,
             p.product_name_en,
             p.product_desc_en,
             p.product_name_ma,
             p.product_desc_ma,
             p.product_name_hi,
             p.product_desc_hi,
             p.product_name_ar,
             p.product_desc_ar,
             s.rate,
             s.is_customizable,
             p.category_id'
        );
        $this->db->from('store_wise_product_assign s');
		// echo $this->db->last_query();exit;
        $this->db->join('product p', 'p.product_id = s.product_id');
        $this->db->where('s.store_id', $store_id);
        $this->db->where('s.category_id', $category_id);

        if ($type != '') {
            $this->db->where('p.product_veg_nonveg', $type);
        }

        $query = $this->db->get();
        $products = $query->result_array();
		//  print_r($products);exit;

        $result = [];

        foreach ($products as $product) {
            //print_r($product);exit;
            if ($product['category_id'] == 23) {
                // Check stock for combo products
                $combo_items = $this->getComboItems($store_id,$product['store_product_id']);
                $combo_available = true;

                $availability = $this->getCurrentProductAvailability($product['store_product_id'],$store_id);

                if (empty($combo_items) || $availability == 1) {
                    $combo_available = false;
                }
                else
                {
                    foreach ($combo_items as $item)
                    {
                        $stock = $this->getCurrentStock($item['item_id'], date('Y-m-d'), $store_id);
                        $availability = $this->getCurrentProductAvailability($item['item_id'],$store_id);
                        if ($stock < $item['quantity'] || $availability == 1)
                        {
                            $combo_available = false;
                            break;
                        }
                    }
                }



                // $product['status'] = $combo_available ? '0' : '1';
                $product['status'] = ($combo_available && $product['is_active'] == 0) ? '0' : '1';
            } else {
                // Check stock for individual products
                $stock1 = $this->getCurrentStock($product['store_product_id'], date('Y-m-d'), $store_id);
                //$product['status'] = $stock > 0 ? '0' : '1';
                $product['status'] = ($stock1 > 0 && $product['is_active'] == 0 && $product['availability'] == 0) ? '0' : '1';
            }

            $result[] = $product;
        }

        return $result;
    }
    //MARK: - Get Current stock
    public function getCurrentStock($product_id,$date,$store_id) {
        $this->db->select('(SUM(pu_qty) - SUM(sl_qty)) as bal_qty');
        $this->db->from('store_stock');
        $this->db->where('product_id', $product_id);
        //$this->db->where('tr_date', $date);
        $this->db->where('store_id', $store_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['bal_qty'];
    }

    public function get_store_product_details($store_id,$productId)
    {
        $this->db->select('*');
        $this->db->from('store_wise_product_assign');
        $this->db->where('store_id', $store_id);
        $this->db->where('store_product_id', $productId);
        $query = $this->db->get();
        return $query->row_array();
    }

    //MARK: Get product images
    public function getProductImages($product_id) {
		$this->db->select('product_id,image');
		$this->db->from('store_wise_product_assign');
		$this->db->where('store_product_id', $product_id);
		$query = $this->db->get();
		$row = $query->result_array();
		$product_id1 = $row[0]['product_id'];
		$product_image = $row[0]['image'];

		$this->db->select('image1,image2,image3,image4');
		$this->db->from('product');
		$this->db->where('product_id', $product_id1);
		$query = $this->db->get();
		$row = $query->row_array();
		$productImages[] = [
			'default_image' => $product_image ? $product_image : $row['image'],
			'image1' => $row['image1'],
			'image2' => $row['image2'],
			'image3' => $row['image3'],
			'image4' => $row['image4']
		];
		return $productImages;
	}
    //MARK: Get default image
    public function get_default_image($product_id)
    {
        $this->db->select('image');   // column that stores product's main image
        $this->db->from('store_wise_product_assign');          // change table name if yours is different
        $this->db->where('store_product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->image;
        }
        return null;
    }

    //MARK: Search product on keyup
    public function shopAssignedProductsByKeyUpSearch($search = null)
    {
        $store_id = $this->session->userdata('logged_in_store_id');

        $this->db->select('
            store_wise_product_assign.*,
            product.product_id,
            product.product_name_en,
            product.image1 as store_image,
            categories.category_name_en,
            categories.category_id,
            store_stock.pu_qty,
            store_stock.minqty,
            (store_stock.pu_qty - store_stock.sl_qty) as balance_stock
        ');
        $this->db->from('store_wise_product_assign');
        $this->db->join('product', 'product.product_id = store_wise_product_assign.product_id', 'left');
        $this->db->join('categories', 'categories.category_id = store_wise_product_assign.category_id', 'left');
        $this->db->join('store_stock', 'store_stock.product_id = store_wise_product_assign.store_product_id', 'left');

        $this->db->where('store_wise_product_assign.store_id', $store_id);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('product.product_name_en', $search);
            $this->db->or_like('store_wise_product_assign.store_product_name_en', $search);
            $this->db->group_end();
        }
        $this->db->group_by('store_wise_product_assign.store_product_id');
        $query = $this->db->get();
        return $query->result();
    }

    //MARK:Load all addons
    public function list_all_addons() {
		$store_id = $this->session->userdata('logged_in_store_id');
		$this->db->select('swpa.*,p.*'); // Select all swpa fields and product name
		$this->db->from('store_wise_product_assign swpa');
		$this->db->join('product p', 'swpa.product_id = p.product_id'); // Correct join with product table
		$this->db->where('swpa.store_id', $store_id);
		$this->db->where('swpa.is_addon', 1);
		$query = $this->db->get();
		return $query->result_array();
	}
    //MARK: Get store product details
    public function getProductDetailsById($id,$store_id){
		$this->db->select('
    swa.store_product_desc_ma,
    swa.store_product_desc_en,
    swa.store_product_desc_hi,
    swa.store_product_desc_ar,
    swa.store_product_name_ma,
    swa.store_product_name_en,
    swa.store_product_name_hi,
    swa.store_product_name_ar,
    swa.is_customizable,
    swa.is_addon,
    swa.type,
    swa.rate,
    p.product_name_ma,
    p.product_name_en,
	p.product_name_hi,
	p.product_name_ar,
	p.product_desc_ma,
    p.product_desc_en,
	p.product_desc_hi,
	p.product_desc_ar
');
$this->db->from('product p');
$this->db->join('store_wise_product_assign swa', 'swa.product_id = p.product_id', 'left'); // Replace 'product_id' with the actual column name if it's different
$this->db->where('swa.store_product_id', $id);
$this->db->where('swa.store_id', $store_id);
$query = $this->db->get();
$row = $query->row_array();
return $row;
	}

    //MARK: Load recipes assigned to store
    public function StoreRecipes($product_id,$store_id) {
        $this->db->select('*');
        $this->db->from('store_recipe sr');
        $this->db->where('sr.store_product_id', $product_id);
        $this->db->where('sr.store_id', $store_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function SaveReciepe($data) {
            $this->db->insert('store_recipe', $data);
            return $this->db->insert_id();
    }

    //MARK: Get Active Rooms
    public function getActiveRoomsByStoreId($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_table');
		$this->db->where('store_id',$store_id );
		$this->db->where('ttype', 'rom');
        $this->db->where('store_table_token !=', 0);
		$this->db->order_by("table_id", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}



    public function get_base_quantity_product($store_id, $productId) {
        $this->db->select('GREATEST(FLOOR(MIN(variant_value)), 1) AS variant_value'); // Ensure min value is at least 1
        $this->db->from('store_variants');
        $this->db->where([
            'store_id' => $store_id,
            'store_product_id' => $productId
        ]);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->variant_value; // Return the minimum variant_value
        }
        return null; // Return null if no record found
    }


	public function fetchtopmenu()
	{

		$query		= "SELECT module.modulecode, module.moduleid, module.modulename,module.icon
                       FROM module
		               WHERE module.moduletype = 'Topmenu' AND module.is_active = 1";

		$query = $this->db->query($query);
		$rows=$this->db->affected_rows();
        if($rows >0)
        {
            return $query->result_array();
        }
        else
        {
            return ;
        }
	}
    public function fetcleftmenu()
	{

		$query		= "SELECT module.modulecode, module.moduleid, module.modulename,module.icon
                       FROM module
		               WHERE module.moduletype = 'Leftmenu' AND module.is_active = 1";

		$query = $this->db->query($query);
		$rows=$this->db->affected_rows();
        if($rows >0)
        {
            return $query->result_array();
        }
        else
        {
            return ;
        }
	}

    public function fetchaccessmodules($roleid)
    {
        // $query		= "SELECT privilege.mainModules
        //                FROM privilege
        //                WHERE privilege.roleid = '".$roleid."'";
        $query		= "SELECT module.modulecode, module.moduleid, module.modulename,module.icon
        FROM module
        WHERE module.moduletype = 'Topmenu' AND module.is_active = 1";
        $query = $this->db->query($query);
        $rows=$this->db->affected_rows();
        if($rows >0)
        {
        return $query->result_array();
        }
        else
        {
        return ;
        }
    }

    public function fetchuserDetails($roleID,$loginID)
    {
        $query="SELECT * from users";
        $query.=" WHERE userid='".$this->loginID."'";
        $query = $this->db->query($query);
        $rows = $this->db->affected_rows();

            if($rows!=0)
            {
                return $query->result_array();
            }
            else
            {
                return;

            }
    }


    public function fetch_notifications($login_user){
        $this->db->select('id,title');
		$this->db->from('notification');
		$this->db->where('reciever',$login_user );
		$this->db->where('status',0 );
		 $this->db->order_by('id','desc');

		$query = $this->db->get();
        return $query->result_array();
    }

    public function productsCount(){
        $query = $this->db->query("SELECT COUNT(*) AS product_count FROM product");
        $result = $query->row();
        return $result->product_count;
    }
    public function Clientscount(){
        $query = $this->db->query("SELECT COUNT(*) AS store_count FROM store");
        $result = $query->row();
        return $result->store_count;
    }

    public function pendingfollowup(){
        $today = date('Y-m-d');
        $after_30_days = date('Y-m-d', strtotime('+30 days'));
        // print_r( $after_30_days); exit;
        $this->db->select('store_id, store_name, next_followup_date'); // Select relevant columns
        $this->db->from('store');
        $this->db->where('next_followup_date =',$after_30_days);
        $query = $this->db->get();
        return $query->result_array();


        $this->db->select('id, name, email, next_followup_date');
        $this->db->from('clients');
        $this->db->where('next_followup_date >=', date('Y-m-d'));
        $this->db->where('next_followup_date <=', date('Y-m-d', strtotime('+30 days')));
        $query = $this->db->get();
        return $query->result_array();

        // $result = $query->row();
        // return $result->store_count;
    }



    public function completedOrder(){
         // Filter for completed orders
        $this->db->from('order'); // Specify the table
        $this->db->where('is_paid', 1);
        return $this->db->count_all_results();
    }


    public function todayOrder($logged_in_store_id){
        $today = date('Y-m-d');
        // Filter for completed orders
       $this->db->from('order'); // Specify the table
       $this->db->where('store_id',$logged_in_store_id);
       $this->db->where('Date(date)',$today);
       return $this->db->count_all_results();
   }

   public function totalAmount($logged_in_store_id){
    // $today = date('Y-m-d');
    // Filter for completed orders
    $this->db->select_sum('total_amount');
   $this->db->from('order'); // Specify the table
   $this->db->where('store_id',$logged_in_store_id);
   $query = $this->db->get();
   $result = $query->row();

   return $result->total_amount ?? 0;
//    $this->db->where('Date(date)',$today);
//    return $this->db->count_all_results();
}


public function todayAmount($logged_in_store_id){
    $today = date('Y-m-d');
    // Filter for completed orders
    $this->db->select_sum('total_amount');
   $this->db->from('order'); // Specify the table
   $this->db->where('store_id',$logged_in_store_id);
   $this->db->where('Date(date)',$today);
   $query = $this->db->get();
   $result = $query->row();

   return $result->total_amount ?? 0;
//    $this->db->where('Date(date)',$today);
//    return $this->db->count_all_results();
}


    public function pendingOrder(){
        // Filter for completed orders
       $this->db->from('order'); // Specify the table
       $this->db->where('is_paid', 0);
       return $this->db->count_all_results();
   }

    public function get_clients_total(){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('is_active',1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_admin_details_by_store_id($logged_in_store_id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('store_id', $logged_in_store_id);
        $query = $this->db->get();
           return $query->row();
    }

}
?>