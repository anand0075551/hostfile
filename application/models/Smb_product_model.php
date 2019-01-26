<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_product_model extends CI_Model {

    /**
     * @return bool
     */	

//--------------------Physical Category------------------------------	
	 
    public function add_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }


        //set all data for inserting into database
        $data = [
            'category_name'         => $this->input->post('category_name'),
			'banner'                 =>$photoName,
			'digital'                 =>"no",
            'created_by'            => $user_id,
            'created_at'            => time()
        ];

       $query = $this->db->insert('smb_category', $data);

        if($query)
        {
            create_activity('Added '.$data['category_name'].' smb_category'); //create an activity
            return true;
        }
        return false;

    }

	public function update_category($id){
		    $user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			$currentUser = singleDbTableRow($user_id)->role;
			$rolename    = singleDbTableRow($user_id)->rolename;
			$email   	 = singleDbTableRow($user_id)->email;
		 
		  if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
			//set all data for inserting into database
			$data = [
				'category_name'         => $this->input->post('category_name'),
				'banner'                 =>$photoName,
				'digital'                 =>"no",
				'modified_by'            => $user_id,
				'modified_at'            => time()
			];
        }
		else{
			$data = [
				'category_name'         => $this->input->post('category_name'),
				'modified_by'            => $user_id,
				'digital'                 =>"no",
				'modified_at'            => time()
			];
		}

        $query = $this->db->where('id', $id)->update('smb_category', $data);

        if($query)
        {
            create_activity('Updated '.$data['category_name'].' smb_category'); //create an activity
            return true;
        }
        return false;

    }
	
	public function phy_product_category_listcount(){
		$query = $this->db->where('digital','no')->count_all_results('smb_category');
        return $query;
    }

    public function phy_product_category_List($limit = 0, $start = 0){
		
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';	
		
		
			if($searchValue != '')																							
				{																												
					$table_name = "smb_category";	
					$where_array = array('category_name' => $searchValue );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_category', ['digital'=>'no']);
				}
		
		
        return $query;
    }
	
//------------Brands------------------------------------------	
	public function brands_ListCount(){
		$query = $this->db->count_all_results('smb_brand');
        return $query;
    }

    public function brands_List($limit = 0, $start = 0)
	{	
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
	
			if($searchValue != '')																							
				{																												
					$table_name = "smb_brand";	
					$where_array = array('name' => $searchValue );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_brand');
				}
		
        return $query;
    }

 public function add_brands(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }


        //set all data for inserting into database
        $data = [
            'name'                  => $this->input->post('brands_name'),
			'logo'                  =>$photoName,
            'created_by'            => $user_id,
            'created_at'            => time()
        ];

       $query = $this->db->insert('smb_brand', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].'smb_brand'); //create an activity
            return true;
        }
        return false;

    }
	 public function update_brands($id){
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id']; 
		 
		  if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
					//set all data for inserting into database
				$data = [
					'name'        			  => $this->input->post('brands_name'),
					'logo'               	  =>$photoName,
					'modified_by'          	  => $user_id,
					'modified_at'          	  => time()
				];
        }
		else{
			//set all data for inserting into database
			$data = [
				'name'         => $this->input->post('brands_name'),
				'modified_by'            => $user_id,
				'modified_at'            => time()
			];
		}

        

        $query = $this->db->where('id', $id)->update('smb_brand', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].'smb_brand'); //create an activity
            return true;
        }
        return false;

    }

//----------------------------Physical Sub_Category------------------------------------------	
		public function sub_ListCount(){
		$query = $this->db->where('digital','no')->count_all_results('smb_sub_category');
        return $query;
    }

    public function sub_List($limit = 0, $start = 0)
	{		
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
			
		
			if($searchValue != '')																							
				{																												
					$table_name = "smb_sub_category";	
					$where_array = array('sub_category_name' => $searchValue );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_sub_category',['digital'=>'no']);
				}
		
        return $query;
    }
	 public function add_subcategory()
	 {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		
			//brand explode 
			if($this->input->post('brand_id') != ""){
				$brand = implode(",", $this->input->post('brand_id') );
			}
			else{
				$brand = ",";
			}
		
        $data = [
            'sub_category_name'         => $this->input->post('category_name'),
			'banner'                    =>$photoName,
            'category'       		    => $this->input->post('category_id'),
            'brand'         		    => $brand,
			'digital'                   =>"no",
            'created_by'           		=> $user_id,
            'created_at'            	=> time()
        ];

       $query = $this->db->insert('smb_sub_category', $data);

        if($query)
        {
            create_activity('Added '.$data['sub_category_name'].'smb_sub_category'); //create an activity
            return true;
        }
        return false;

    }

	 public function update_subcategory($id){
		  $user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
		 
		  if ($_FILES['userfile']['name'] != '') {
				$upload_dir = './smb_uploads/'; //Upload directory
				if (!file_exists($upload_dir))
					mkdir($upload_dir); //create directory if not found.
				$config['upload_path'] = $upload_dir;
				$config['allowed_types']   = 'gif|jpg|png';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					$errorData = implode('<br />', $error);
					$this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
					redirect($_SERVER['HTTP_REFERER']); // redirect with error
				} else {
					$upload_data = $this->upload->data(); //all uploaded data store in variable
					$photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
					$fullPhoto = $upload_dir . $upload_data['file_name'];
					// $this->photoResize($fullPhoto); // resize now
				}
				 $data = [
			   'sub_category_name'          => $this->input->post('category_name'),
				'category'       		    => $this->input->post('category_id'),
				'brand'         		    => $this->input->post('brand_id'),
				'banner'                    =>$photoName,
				'digital'                   =>"no",
				'modified_by'               => $user_id,
				'modified_at'               => time()
				];
			}
			
			else{
				$data = [
			   'sub_category_name'          => $this->input->post('category_name'),
				'category'       		    => $this->input->post('category_id'),
				'brand'         		    => $this->input->post('brand_id'),
				'modified_by'               => $user_id,
				'digital'                   =>"no",
				'modified_at'               => time()
				];
			}

        

        //set all data for inserting into database
       

        $query = $this->db->where('id', $id)->update('smb_sub_category', $data);

        if($query)
        {
            create_activity('Updated '.$data['sub_category_name'].'smb_sub_category'); //create an activity
            return true;
        }
        return false;
		
    }
//-------------------------------Physical Product -------------------
	public function product_ListCount(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role_name = singleDbTableRow($user_id)->rolename;
		
		if($role_name == 11){
			$condition = " download = 'no' ";
		}
		else{
			$condition = " download = 'no' AND from_role LIKE '%".$role_name."%' ";
		}
		
		$query = $this->db->where($condition)->count_all_results('smb_product');
        return $query;
    }

    public function product_List($limit = 0, $start = 0)
	{		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role_name = singleDbTableRow($user_id)->rolename;
		
		if($role_name == 11){
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_product', ['download' =>'no']);
		}
		else{
			$condition = " download = 'no' AND from_role LIKE '%".$role_name."%' ";
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($condition)->get('smb_product');
		}
		
		
		
        return $query;
    }
//add new product
	 public function add_product()
	 {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$current_user = singleDbTableRow($user_id)->role;
		
		
		 if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		else{
			$photoName = "noimage.jpg";
		}
		
		//brand explode 
		if($this->input->post('brand') != ""){
			$brand = implode(",", $this->input->post('brand') );
		}
		else{
			$brand = ",";
		}
		
		//Role explode 
		if($this->input->post('from_role') != ""){
			$from_role = implode(",", $this->input->post('from_role') );
		}
		else{
			$from_role = ",";
		}
		
		//Role explode 
		if($this->input->post('role') != ""){
			$role = implode(",", $this->input->post('role') );
		}
		else{
			$role = ",";
		}
		
		//display vender name
		if($this->input->post('display_name') != ""){
			$display_vender = $this->input->post('display_name');
		}
		else{
			$display_vender = "No";
		}
		
		
		$unit = $this->input->post('unit_type');
		
		if($unit == "0.000001")
		{
			$unit = "Milli Grams";	
		}
		elseif($unit == "0.001")
		{
			$unit = "Grams";
		}
		elseif($unit == "1")
		{
			$unit = "Kilogram";
		}
		elseif($unit == "100")
		{
			$unit = "Quintol";
		}
		elseif($unit == "1000")
		{
			$unit = "Ton";
		}
		elseif($unit == "10000")
		{
			$unit = "Metric Ton";
		}
		
		
		
		$limit = '1';
        $start = '0';
        $result_count = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_product');

        if($result_count -> num_rows() > 0)
        {    foreach ($result_count->result() as $r)
            {
                $value     = $r->tran_count;
            }
            if($value == 0)
            {
                $tran_count = 1;
            }
            else{
                $tran_count = $value + 1;
            }
        }
        else{
            $tran_count = 1;
        } 
		
		
		
       $data = [
            'tran_count'         		=> $tran_count,
            'title'         			=> $this->input->post('product_title'),
            'category'         			=> $this->input->post('category_id'),
            'sub_category'         		=> $this->input->post('sub_category'),
            'brand'         			=> $brand,
            'unit'         				=> $unit,
            'weight'         			=> $this->input->post('weight'),
            'unit_value'         		=> $this->input->post('unit_type'),
			'length'         			=> $this->input->post('length'),
			'breath'         			=> $this->input->post('breath'),
			'height'         			=> $this->input->post('height'),
			'volume'         	 		=> $this->input->post('volume'),
            'tag'         				=> $this->input->post('tag'),
            'featured'         			=> $this->input->post('featured'),
            'description'         		=> $this->input->post('description'),
            'custom1'         			=> $this->input->post('c1'),
            'custom2'         			=> $this->input->post('c2'),
            'custom3'         			=> $this->input->post('c3'),
            'custom4'         			=> $this->input->post('c4'),
            'custom5'         			=> $this->input->post('c5'),
            'sale_price'         		=> $this->input->post('sale_price'),
            'purchase_price'         	=> $this->input->post('purchase_price'),
            'shipping_cost'         	=> $this->input->post('shipping_cost'),
			'tax'         				=> $this->input->post('tax'),
			'sp_tax1'         			=> $this->input->post('sp_tax1'),
			'sp_tax2'         			=> $this->input->post('sp_tax2'),
			'sp_tax3'         			=> $this->input->post('sp_tax3'),
			'sp_tax4'         			=> $this->input->post('sp_tax4'),
			'sp_tax5'         			=> $this->input->post('sp_tax5'),
			'pp_tax1'         			=> $this->input->post('pp_tax1'),
			'pp_tax2'         			=> $this->input->post('pp_tax2'),
			'pp_tax3'         			=> $this->input->post('pp_tax3'),
			'pp_tax4'         			=> $this->input->post('pp_tax4'),
			'pp_tax5'         			=> $this->input->post('pp_tax5'),
            'discount'        			=> $this->input->post('discount'),
            'tax_type'         			=> $this->input->post('tax_type'),
            'discount_type'         	=> $this->input->post('discount_type'),
            'paid_by'         			=> $this->input->post('tax_piad'),
            'payment_type'         		=> $this->input->post('pay_type'),
			'main_image'                => $photoName,
			'business_types'            => $this->input->post('business_types'),
			'hsn_code'           		=> $this->input->post('hsn_code'),
			'sac_code'           		=> $this->input->post('sac_code'),
			'grade'           			=> $this->input->post('grade'),
			'display_vender'            => $display_vender,	
			'from_role'          		=> $from_role,	
			'to_role'          		    => $role,	
			'to_user'          		    => '',	
			'added_by'                	=> $user_id,
            'created_by'           		=> $user_id,
            'download'           		=> "no",
            'status'           			=> "ok",
            'vender_type'           	=> $current_user,
            'num_of_imgs'           	=> "1",
            'add_timestamp'            	=> time(),
            'created_at'            	=> time()
        ];

		$query = $this->db->insert('smb_product', $data);
		
		$p_id = $this->db->insert_id();
		
		$category = str_pad($data['category'], 3, '0', STR_PAD_LEFT);
		$sub_category = str_pad($data['sub_category'], 3, '0', STR_PAD_LEFT);
		$product_id = str_pad($p_id, 4, '0', STR_PAD_LEFT);
		
		$data['product_code'] = $category.$sub_category.$product_id.$data['tran_count'];
		
		$this->db->where('id', $p_id)->update('smb_product', $data);

        if($query)
        {
            create_activity('Added'.$data['title'].'smb_product'); //create an activity
            return true;
        }
        return false;

    }
	
//Update Product 
	
	public function update_product($id){
		  $user_info = $this->session->userdata('logged_user');
		  $user_id = $user_info['user_id'];
		 
			$current_user = singleDbTableRow($user_id)->role;
		 
		  //Role explode 
				if($this->input->post('from_role') != ""){
					$from_role = implode(",", $this->input->post('from_role') );
				}
				else{
					$from_role = ",";
				}
		 
		 
		 //Role explode 
				if($this->input->post('role') != ""){
					$role = implode(",", $this->input->post('role') );
				}
				else{
					$role = ",";
				}
		 //unit type 		
			$unit = $this->input->post('unit_type');
		
			if($unit == "0.000001")
			{
				$unit = "Milli Grams";	
			}
			elseif($unit == "0.001")
			{
				$unit = "Grams";
			}
			elseif($unit == "1")
			{
				$unit = "Kilogram";
			}
			elseif($unit == "100")
			{
				$unit = "Quintol";
			}
			elseif($unit == "1000")
			{
				$unit = "Ton";
			}
			elseif($unit == "10000")
			{
				$unit = "Metric Ton";
			}	
				
		 
		  if ($_FILES['userfile']['name'] != '') {
				$upload_dir = './smb_uploads/'; //Upload directory
				if (!file_exists($upload_dir))
					mkdir($upload_dir); //create directory if not found.
				$config['upload_path'] = $upload_dir;
				$config['allowed_types']   = 'gif|jpg|png';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					$errorData = implode('<br />', $error);
					$this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
					redirect($_SERVER['HTTP_REFERER']); // redirect with error
				} else {
					$upload_data = $this->upload->data(); //all uploaded data store in variable
					$photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
					$fullPhoto = $upload_dir . $upload_data['file_name'];
					// $this->photoResize($fullPhoto); // resize now
				}
				
				
				 $data = [
					'title'         			=> $this->input->post('title'),
					'category'         			=> $this->input->post('category_id'),
					'sub_category'         		=> $this->input->post('sub_category'),
					'unit'         				=> $unit,
					'weight'         			=> $this->input->post('weight'),
					'unit_value'         		=> $this->input->post('unit_type'),
					'length'         			=> $this->input->post('length'),
					'breath'         			=> $this->input->post('breath'),
					'height'         			=> $this->input->post('height'),
					'volume'         	 		=> $this->input->post('volume'),
					'tag'         				=> $this->input->post('tag'),
					'featured'         			=> $this->input->post('featured'),
					'description'         		=> $this->input->post('description'),
					'custom1'         			=> $this->input->post('c1'),
					'custom2'         			=> $this->input->post('c2'),
					'custom3'         			=> $this->input->post('c3'),
					'custom4'         			=> $this->input->post('c4'),
					'custom5'         			=> $this->input->post('c5'),
					'sale_price'         		=> $this->input->post('sale_price'),
					'purchase_price'         	=> $this->input->post('purchase_price'),
					'shipping_cost'         	=> $this->input->post('shipping_cost'),
					'tax'         				=> $this->input->post('tax'),
					'sp_tax1'         			=> $this->input->post('sp_tax1'),
					'sp_tax2'         			=> $this->input->post('sp_tax2'),
					'sp_tax3'         			=> $this->input->post('sp_tax3'),
					'sp_tax4'         			=> $this->input->post('sp_tax4'),
					'sp_tax5'         			=> $this->input->post('sp_tax5'),
					'pp_tax1'         			=> $this->input->post('pp_tax1'),
					'pp_tax2'         			=> $this->input->post('pp_tax2'),
					'pp_tax3'         			=> $this->input->post('pp_tax3'),
					'pp_tax4'         			=> $this->input->post('pp_tax4'),
					'pp_tax5'         			=> $this->input->post('pp_tax5'),
					'discount'        			=> $this->input->post('discount'),
					'tax_type'         			=> $this->input->post('tax_type'),
					'discount_type'         	=> $this->input->post('discount_type'),
					'paid_by'         			=> $this->input->post('tax_piad'),
					'payment_type'         		=> $this->input->post('pay_type'),
					'business_types'            => $this->input->post('business_types'),
					'display_vender'            => $this->input->post('display_name'),
					'hsn_code'           		=> $this->input->post('hsn_code'),
					'sac_code'           		=> $this->input->post('sac_code'),
					'grade'           			=> $this->input->post('grade'),
					'from_role'          		=> $from_role,	
					'to_role'          		    => $role,	
					'to_user'          		    => '',	
					'status'           			=> "ok",
					'download'           		=> "no",
					'vender_type'           	=> $current_user,
					'num_of_imgs'           	=> "1",
					'main_image'                =>$photoName,
					'modified_by'               => $user_id,
					'modified_at'               => time()	
				];
			}
			
			else{
								
				$data = [
					'title'         			=> $this->input->post('title'),
					'category'         			=> $this->input->post('category_id'),
					'sub_category'         		=> $this->input->post('sub_category'),
					'unit'         				=> $unit,
					'weight'         			=> $this->input->post('weight'),
					'unit_value'         		=> $this->input->post('unit_type'),
					'length'         			=> $this->input->post('length'),
					'breath'         			=> $this->input->post('breath'),
					'height'         			=> $this->input->post('height'),
					'volume'         	 		=> $this->input->post('volume'),
					'tag'         				=> $this->input->post('tag'),
					'featured'         			=> $this->input->post('featured'),
					'description'         		=> $this->input->post('description'),
					'custom1'         			=> $this->input->post('c1'),
					'custom2'         			=> $this->input->post('c2'),
					'custom3'         			=> $this->input->post('c3'),
					'custom4'         			=> $this->input->post('c4'),
					'custom5'         			=> $this->input->post('c5'),
					'sale_price'         		=> $this->input->post('sale_price'),
					'purchase_price'         	=> $this->input->post('purchase_price'),
					'shipping_cost'         	=> $this->input->post('shipping_cost'),
					'tax'         				=> $this->input->post('tax'),
					'sp_tax1'         			=> $this->input->post('sp_tax1'),
					'sp_tax2'         			=> $this->input->post('sp_tax2'),
					'sp_tax3'         			=> $this->input->post('sp_tax3'),
					'sp_tax4'         			=> $this->input->post('sp_tax4'),
					'sp_tax5'         			=> $this->input->post('sp_tax5'),
					'pp_tax1'         			=> $this->input->post('pp_tax1'),
					'pp_tax2'         			=> $this->input->post('pp_tax2'),
					'pp_tax3'         			=> $this->input->post('pp_tax3'),
					'pp_tax4'         			=> $this->input->post('pp_tax4'),
					'pp_tax5'         			=> $this->input->post('pp_tax5'),
					'discount'        			=> $this->input->post('discount'),
					'tax_type'         			=> $this->input->post('tax_type'),
					'discount_type'         	=> $this->input->post('discount_type'),
					'paid_by'         			=> $this->input->post('tax_piad'),
					'payment_type'         		=> $this->input->post('pay_type'),
					'business_types'            => $this->input->post('business_types'),
					'display_vender'            => $this->input->post('display_name'),
					'hsn_code'           		=> $this->input->post('hsn_code'),
					'sac_code'           		=> $this->input->post('sac_code'),
					'grade'           			=> $this->input->post('grade'),
					'from_role'          		=> $from_role,	
					'to_role'          		    => $role,	
					'to_user'          		    => '',	
					'status'           			=> "ok",
					'download'           		=> "no",
					'vender_type'           	=> $current_user,
					'num_of_imgs'           	=> "1",
					'modified_by'               => $user_id,
					'modified_at'               => time()			
				];
			}

        //set all data for inserting into database
      
        $query = $this->db->where('id', $id)->update('smb_product', $data);

        if($query)
        {
            create_activity('Updated '.$data['title'].'smb_product'); //create an activity
            return true;
        }
        return false;
		
    }
		
	public function copy_product(){
		  $user_info = $this->session->userdata('logged_user');
		  $user_id = $user_info['user_id'];
		 
			$current_user = singleDbTableRow($user_id)->role;
		 
		  //Role explode 
				if($this->input->post('from_role') != ""){
					$from_role = implode(",", $this->input->post('from_role') );
				}
				else{
					$from_role = ",";
				}
		 
		 
		 //Role explode 
				if($this->input->post('role') != ""){
					$role = implode(",", $this->input->post('role') );
				}
				else{
					$role = ",";
				}
		 //unit type 		
			$unit = $this->input->post('unit_type');
		
			if($unit == "0.000001")
			{
				$unit = "Milli Grams";	
			}
			elseif($unit == "0.001")
			{
				$unit = "Grams";
			}
			elseif($unit == "1")
			{
				$unit = "Kilogram";
			}
			elseif($unit == "100")
			{
				$unit = "Quintol";
			}
			elseif($unit == "1000")
			{
				$unit = "Ton";
			}
			elseif($unit == "10000")
			{
				$unit = "Metric Ton";
			}	
				
		 
		  if ($_FILES['userfile']['name'] != '') {
				$upload_dir = './smb_uploads/'; //Upload directory
				if (!file_exists($upload_dir))
					mkdir($upload_dir); //create directory if not found.
				$config['upload_path'] = $upload_dir;
				$config['allowed_types']   = 'gif|jpg|png';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					$errorData = implode('<br />', $error);
					$this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
					redirect($_SERVER['HTTP_REFERER']); // redirect with error
				} else {
					$upload_data = $this->upload->data(); //all uploaded data store in variable
					$photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
					$fullPhoto = $upload_dir . $upload_data['file_name'];
					// $this->photoResize($fullPhoto); // resize now
				}
				
				
				 $data = [
					'title'         			=> $this->input->post('title'),
					'category'         			=> $this->input->post('category_id'),
					'sub_category'         		=> $this->input->post('sub_category'),
					'unit'         				=> $unit,
					'weight'         			=> $this->input->post('weight'),
					'unit_value'         		=> $this->input->post('unit_type'),
					'length'         			=> $this->input->post('length'),
					'breath'         			=> $this->input->post('breath'),
					'height'         			=> $this->input->post('height'),
					'volume'         	 		=> $this->input->post('volume'),
					'tag'         				=> $this->input->post('tag'),
					'featured'         			=> $this->input->post('featured'),
					'description'         		=> $this->input->post('description'),
					'custom1'         			=> $this->input->post('c1'),
					'custom2'         			=> $this->input->post('c2'),
					'custom3'         			=> $this->input->post('c3'),
					'custom4'         			=> $this->input->post('c4'),
					'custom5'         			=> $this->input->post('c5'),
					'sale_price'         		=> $this->input->post('sale_price'),
					'purchase_price'         	=> $this->input->post('purchase_price'),
					'shipping_cost'         	=> $this->input->post('shipping_cost'),
					'tax'         				=> $this->input->post('tax'),
					'sp_tax1'         			=> $this->input->post('sp_tax1'),
					'sp_tax2'         			=> $this->input->post('sp_tax2'),
					'sp_tax3'         			=> $this->input->post('sp_tax3'),
					'sp_tax4'         			=> $this->input->post('sp_tax4'),
					'sp_tax5'         			=> $this->input->post('sp_tax5'),
					'pp_tax1'         			=> $this->input->post('pp_tax1'),
					'pp_tax2'         			=> $this->input->post('pp_tax2'),
					'pp_tax3'         			=> $this->input->post('pp_tax3'),
					'pp_tax4'         			=> $this->input->post('pp_tax4'),
					'pp_tax5'         			=> $this->input->post('pp_tax5'),
					'discount'        			=> $this->input->post('discount'),
					'tax_type'         			=> $this->input->post('tax_type'),
					'discount_type'         	=> $this->input->post('discount_type'),
					'paid_by'         			=> $this->input->post('tax_piad'),
					'payment_type'         		=> $this->input->post('pay_type'),
					'business_types'            => $this->input->post('business_types'),
					'hsn_code'           		=> $this->input->post('hsn_code'),
					'sac_code'           		=> $this->input->post('sac_code'),
					'display_vender'            => $this->input->post('display_name'),
					'grade'           			=> $this->input->post('grade'),
					'from_role'          		=> $from_role,	
					'to_role'          		    => $role,	
					'to_user'          		    => '',	
					'status'           			=> "ok",
					'download'           		=> "no",
					'vender_type'           	=> $current_user,
					'num_of_imgs'           	=> "1",
					'main_image'                =>$photoName,
					'modified_by'               => $user_id,
					'modified_at'               => time()	
				];
			}
			
			else{
								
				$data = [
					'title'         			=> $this->input->post('title'),
					'category'         			=> $this->input->post('category_id'),
					'sub_category'         		=> $this->input->post('sub_category'),
					'unit'         				=> $unit,
					'weight'         			=> $this->input->post('weight'),
					'unit_value'         		=> $this->input->post('unit_type'),
					'length'         			=> $this->input->post('length'),
					'breath'         			=> $this->input->post('breath'),
					'height'         			=> $this->input->post('height'),
					'volume'         	 		=> $this->input->post('volume'),
					'tag'         				=> $this->input->post('tag'),
					'featured'         			=> $this->input->post('featured'),
					'description'         		=> $this->input->post('description'),
					'custom1'         			=> $this->input->post('c1'),
					'custom2'         			=> $this->input->post('c2'),
					'custom3'         			=> $this->input->post('c3'),
					'custom4'         			=> $this->input->post('c4'),
					'custom5'         			=> $this->input->post('c5'),
					'sale_price'         		=> $this->input->post('sale_price'),
					'purchase_price'         	=> $this->input->post('purchase_price'),
					'shipping_cost'         	=> $this->input->post('shipping_cost'),
					'tax'         				=> $this->input->post('tax'),
					'sp_tax1'         			=> $this->input->post('sp_tax1'),
					'sp_tax2'         			=> $this->input->post('sp_tax2'),
					'sp_tax3'         			=> $this->input->post('sp_tax3'),
					'sp_tax4'         			=> $this->input->post('sp_tax4'),
					'sp_tax5'         			=> $this->input->post('sp_tax5'),
					'pp_tax1'         			=> $this->input->post('pp_tax1'),
					'pp_tax2'         			=> $this->input->post('pp_tax2'),
					'pp_tax3'         			=> $this->input->post('pp_tax3'),
					'pp_tax4'         			=> $this->input->post('pp_tax4'),
					'pp_tax5'         			=> $this->input->post('pp_tax5'),
					'discount'        			=> $this->input->post('discount'),
					'tax_type'         			=> $this->input->post('tax_type'),
					'discount_type'         	=> $this->input->post('discount_type'),
					'paid_by'         			=> $this->input->post('tax_piad'),
					'payment_type'         		=> $this->input->post('pay_type'),
					'business_types'            => $this->input->post('business_types'),
					'hsn_code'           		=> $this->input->post('hsn_code'),
					'sac_code'           		=> $this->input->post('sac_code'),
					'display_vender'            => $this->input->post('display_name'),
					'grade'           			=> $this->input->post('grade'),
					'from_role'          		=> $from_role,	
					'to_role'          		    => $role,	
					'to_user'          		    => '',	
					'status'           			=> "ok",
					'download'           		=> "no",
					'vender_type'           	=> $current_user,
					'num_of_imgs'           	=> "1",
					'modified_by'               => $user_id,
					'modified_at'               => time()			
				];
			}

        //set all data for inserting into database
        $query =  $this->db->insert('smb_product', $data);

        if($query)
        {
            create_activity('Coppied '.$data['title'].'smb_product'); //create an activity
            return true;
        }
        return false;
		
    }	
	
//-----------------------------physical product stock-----------------------------------------------------------------

	public function physical_stock_listcount(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		if ($currentUser == 'admin')
		{
			$total = $this->db->group_by('product')->get('smb_stock');
			$query = $total->num_rows();
		}
		else
		{
			$total = $this->db->group_by('product')->get_where('smb_stock', ['added_by'=>$user_id]);
			$query = $total->num_rows();
		}
        return $query;
    }

    public function physical_stock_list($limit = 0, $start = 0)
	{		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
				
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
		 if ($currentUser == 'admin')
		{
			if($searchValue != '')																							
				{																												
					$table_name = "smb_stock";	
					$where_array = array('type' => $searchValue );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->group_by('product')->limit($limit, $start)->get('smb_stock');
				}
		}
		else
		{
			if($searchValue != '')																							
				{																												
					$table_name = "smb_stock";	
					$where_array = array('type' => $searchValue,  'added_by'=>$user_id);					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->group_by('product')->limit($limit, $start)->get_where('smb_stock', ['added_by'=>$user_id]);
				}
		}
        return $query;
    }
	
	 public function add_stock()
	 {
		 
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			
			$id = $this->input->post('product');
			
			$query = $this->db->get_where('smb_product', ['id'=>$id]);	
			
			foreach($query->result() as $d);	
			$current_stock = $d->current_stock;
			
			$qty = $this->input->post('quantity');
			
			$av_stock = $qty + $current_stock;
			
			$exp_date  = $this->input->post('exp_date');
			
			$exp_date1 = new DateTime($exp_date);
			$exp_date2 = $exp_date1->format('Y/m/d');
			
			
			$product 	= $this->input->post('product');
			$vendor 	= $user_id;
			$location 	= $this->input->post('location');
			
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor]);
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
		
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vendor]);
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
		
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$vendor]);
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
		
			$av_stock1 = $total_added-($total_sold+$total_destroyed);
			
			$current_stock1 = $av_stock1 + $qty;
			
			
		 $data = [
				'active'     				 =>	'1',
				'category'     				 =>	$this->input->post('category_name'),
				'sub_category'     			 =>	$this->input->post('sub_category'),
				'product'     			 	 =>	$this->input->post('product'),
				'quantity'     				 =>	$this->input->post('quantity'),
				'current_stock'     		 =>	$current_stock1,
				'sale_price'     			 =>	$this->input->post('rate'),
				'total'     				 =>	$this->input->post('total'),
				'purchase_price'         	 => $this->input->post('purchase_price'),
				'shipping_cost'         	 => $this->input->post('shipping_cost'),
				'tax'         				 => $this->input->post('tax'),
				'sp_tax1'         			 => $this->input->post('sp_tax1'),
				'sp_tax2'         			 => $this->input->post('sp_tax2'),
				'sp_tax3'         			 => $this->input->post('sp_tax3'),
				'sp_tax4'         			 => $this->input->post('sp_tax4'),
				'sp_tax5'         			 => $this->input->post('sp_tax5'),
				'pp_tax1'         			 => $this->input->post('pp_tax1'),
				'pp_tax2'         			 => $this->input->post('pp_tax2'),
				'pp_tax3'         			 => $this->input->post('pp_tax3'),
				'pp_tax4'         			 => $this->input->post('pp_tax4'),
				'pp_tax5'         			 => $this->input->post('pp_tax5'),
				'discount'        			 => $this->input->post('discount'),
				'tax_type'         			 => $this->input->post('tax_type'),
				'discount_type'         	 => $this->input->post('discount_type'),
				'reason_note'     			 =>	$this->input->post('note'),
				'location'     			 	 =>	$this->input->post('location'),
				'pincode'     			 	 =>	$this->input->post('pincode'),
				'tag'     			 	 	 =>	$this->input->post('tag'),
				'to_role'     			 	 =>	$this->input->post('to_role'),
				'business_types'     		 =>	$this->input->post('business_types'),
				'hsn_code'           		 => $this->input->post('hsn_code'),
				'sac_code'           		 => $this->input->post('sac_code'),
				'created_by'          		 =>	$user_id,
				'added_by'          		 =>	$user_id,
				'type'  	        		 =>	"add",
				'datetime'  	        	 =>	time(),
				'created_at'           		 =>	time()
				]; 
		$data2 = [
				'current_stock'     		 =>$av_stock,//$current_balance
				'modified_by'          		 =>$user_id,
				'modified_at'           	 =>time()
				]; 
				
       
		 $query = $this->db->insert('smb_stock', $data);
		 
		 $query2 = $this->db->where('id', $id)->update('smb_product', $data2);

		 $this->db->where(['product'=>$product, 'location'=>$location, 'added_by'=>$vendor, 'type'=>'add'])->update('smb_stock', ['current_stock'=>$current_stock1]);
		 
        if($query && $query2)
        {
				create_activity('Added '.$data['product'].'smb_stock'); 
			
				create_activity('Updated '.$data['product'].'smb_product');
            return true;
        }
        return false; 
						
    }
	
	
	 public function destroy_stock()
	 {
		 
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			
			$id = $this->input->post('product');
			
			$query = $this->db->get_where('smb_product', ['id'=>$id]);	
			
			foreach($query->result() as $d);	
			$current_stock = $d->current_stock;
			
			$qty = $this->input->post('quantity');
			
			$av_stock = $current_stock - $qty;
			
			$location = $this->input->post('location');
			$get_loc = $this->db->get_where('smb_stock', ['product'=>$id, 'type'=>'add', 'added_by'=>$user_id, 'location'=>$location]); 
			if($get_loc->num_rows() > 0){
				foreach($get_loc->result() as $s);
				$sale_price      = $s->sale_price;
				$shipping_cost   = $s->shipping_cost;
				$tax   			 = $s->tax;
				$total   	 	 = $s->sale_price*$qty;
			}
			else{
				$sale_price      = 0;
				$shipping_cost   = 0;
				$tax   			 = 0;
				$total   	 	 = 0;
			}
			
			$product 	= $this->input->post('product');
			$vendor 	= $user_id;
			$location 	= $this->input->post('location');
			
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor]);
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
		
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vendor]);
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
		
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$vendor]);
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
		
			$av_stock1 = $total_added-($total_sold+$total_destroyed);
			
			$current_stock1 = $av_stock1 - $qty;
			
		$data = [
				'active'     				 =>	'1',
				'category'     				 =>$this->input->post('category_name'),
				'sub_category'     			 =>$this->input->post('sub_category'),
				'product'     			 	 =>$this->input->post('product'),
				'quantity'     				 =>$this->input->post('quantity'),
				'current_stock'     		 =>	$current_stock1,
				'reason_note'     			 =>$this->input->post('note'),
				'location'     			 	 =>$this->input->post('location'),
				'pincode'     			     =>'',
				'sale_price'          		 =>$sale_price,
				'total'          			 =>$total,
				'shipping_cost'          	 =>$shipping_cost,
				'tax'         			 	 =>$tax,
				'created_by'          		 =>$user_id,
				'added_by'          		 =>$user_id,
				'type'  	        		 =>"destroy",
				'tag'     			 	 	 =>	$this->input->post('tag'),
				'to_role'     			 	 =>	$this->input->post('to_role'),
				'business_types'     		 =>	$this->input->post('business_types'),
				'hsn_code'           		 => $this->input->post('hsn_code'),
				'sac_code'           		 => $this->input->post('sac_code'),
				'datetime'  	        	 =>time(),
				'created_at'           		 =>time()
				]; 
		$data2 = [
				'current_stock'     		 =>$av_stock,//$current_balance
				'modified_by'          		 =>$user_id,
				'modified_at'           	 =>time()
				]; 
				
		 
		$query = $this->db->insert('smb_stock', $data);
		 
		$query2 = $this->db->where('id', $id)->update('smb_product', $data2);

		$this->db->where(['product'=>$product, 'location'=>$location, 'added_by'=>$vendor, 'type'=>'add'])->update('smb_stock', ['current_stock'=>$current_stock1]);
		
        if($query && $query2)
        {
				create_activity('Added '.$data['product'].'smb_stock'); 
            return true;
        }
        return false; 
						
    }
	
	
//----------------------------Digital Product Category -----------------------------------------------------------------

	public function digital_product_category_listcount(){
		$query = $this->db->where('digital','ok')->count_all_results('smb_category');
        return $query;
    }

    public function digital_product_category_list($limit = 0, $start = 0){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
			
			if($searchValue != '')																							
				{																												
					$table_name = "smb_category";	
					$where_array = array('category_name' => $searchValue, 'digital'=>'ok' );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_category',  ['digital'=>'ok']);
				}
		
        return $query;
    }
	
	 public function add_digital_product_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		
        $data = [
            'category_name'         => $this->input->post('category_name'),
			'banner'                 =>$photoName,
			'digital'                 =>'ok',
            'created_by'            => $user_id,
            'created_at'            => time()
        ];

       $query = $this->db->insert('smb_category', $data);

        if($query)
        {
            create_activity('Added '.$data['category_name'].' smb_category'); //create an activity
            return true;
        }
        return false;

    }
	
	public function update_digital_category($id){
		    $user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
		 
		  if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
			$config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
			//set all data for inserting into database
			$data = [
				'category_name'         => $this->input->post('category_name'),
				'banner'                 =>$photoName,
				'digital'                 =>"ok",
				'modified_by'            => $user_id,
				'modified_at'            => time()
			];
        }
		else{
			$data = [
				'category_name'         => $this->input->post('category_name'),
				'modified_by'            => $user_id,
				'digital'                 =>"ok",
				'modified_at'            => time()
			];
		}
		
        $query = $this->db->where('id', $id)->update('smb_category', $data);

        if($query)
        {
            create_activity('Updated '.$data['category_name'].' smb_category'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
//----------------------------Digital Sub_Category------------------------------------------	
	public function digital_subcategory_ListCount(){
		$query = $this->db->where('digital','ok')->count_all_results('smb_sub_category');
        return $query;
    }
//listing digital sub_category
    public function digital_subcategory_List($limit = 0, $start = 0)
	{		
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
			if($searchValue != '')																							
				{																												
					$table_name = "smb_sub_category";	
					$where_array = array('sub_category_name' => $searchValue, 'digital'=>'ok' );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_sub_category', ['digital'=>'ok']);
				}
		
        return $query;
    }
//add digital sub category	
	 public function add_digital_subcategory()
	 {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		
		//brand explode 
			if($this->input->post('brand_id') != ""){
				$brand = implode(",", $this->input->post('brand_id') );
			}
			else{
				$brand = ",";
			}
			
        $data = [
            'sub_category_name'         => $this->input->post('category_name'),
			'banner'                    =>$photoName,
            'category'       		    => $this->input->post('category_id'),
            'created_by'           		=> $user_id,
			'brand'					    => $brand,
			'digital'                    =>'ok',
            'created_at'            	=> time()
        ];

       $query = $this->db->insert('smb_sub_category', $data);

        if($query)
        {
            create_activity('Added '.$data['sub_category_name'].'smb_sub_category'); //create an activity
            return true;
        }
        return false;

    }
	
//update digital sub_category		
	 public function update_digital_subcategory($id){
		 
		  $user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
		 
		  if ($_FILES['userfile']['name'] != '') {
				$upload_dir = './smb_uploads/'; //Upload directory
				if (!file_exists($upload_dir))
					mkdir($upload_dir); //create directory if not found.
				$config['upload_path'] = $upload_dir;
				$config['allowed_types']   = 'gif|jpg|png';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					$errorData = implode('<br />', $error);
					$this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
					redirect($_SERVER['HTTP_REFERER']); // redirect with error
				} else {
					$upload_data = $this->upload->data(); //all uploaded data store in variable
					$photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
					$fullPhoto = $upload_dir . $upload_data['file_name'];
					// $this->photoResize($fullPhoto); // resize now
				}
				 $data = [
			   'sub_category_name'          => $this->input->post('category_name'),
				'category'       		    => $this->input->post('category_id'),
				'brand'         		    => $this->input->post('brand_id'),
				'banner'                    =>$photoName,
				'digital'                   =>"ok",
				'modified_by'               => $user_id,
				'modified_at'               => time()
				];
			}
			
			else{
				$data = [
			   'sub_category_name'          => $this->input->post('category_name'),
				'category'       		    => $this->input->post('category_id'),
				'brand'         		    => $this->input->post('brand_id'),
				'modified_by'               => $user_id,
				'digital'                   =>"ok",
				'modified_at'               => time()
				];
			}

        

        //set all data for inserting into database
       

        $query = $this->db->where('id', $id)->update('smb_sub_category', $data);

        if($query)
        {
            create_activity('Updated '.$data['sub_category_name'].'smb_sub_category'); //create an activity
            return true;
        }
        return false;
		
    }
	
//---------------Dgital Product--------------------------------------
	public function digital_product_ListCount(){
		$query = $this->db->where('download','ok')->count_all_results('smb_product');
        return $query;
    }
    public function digital_product_List($limit = 0, $start = 0)
	{		
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';	
		
			if($searchValue != '')																							
				{																												
					$table_name = "smb_product";	
					$where_array = array('title' => $searchValue ,'download'=>'ok' );					
					  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_product',['download'=>'ok']);//Digital Product
				}
		
        return $query;
    }
//add product	
public function add_digital_product()
	 {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$current_user = singleDbTableRow($user_id)->role;
		
		
		if ($_FILES['userfile']['name'] != '')
		 {
            $upload_dir = './smb_uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		
		else{
			$photoName = "noimage.jpg";
		}
		//brand 
		if($this->input->post('brand') != ""){
			$brand = implode(",", $this->input->post('brand') );
		}
		else{
			$brand = ",";
		}
		
		//vender name 
		if($this->input->post('display_name') != ""){
			$display_vender = $this->input->post('display_name');
		}
		else{
			$display_vender = "no";
		}
		
		//Role explode 
		if($this->input->post('role') != ""){
			$role = implode(",", $this->input->post('role') );
		}
		else{
			$role = ",";
		}
		
		
       $data = [
            'title'         			=> $this->input->post('product_title'),
            'category'         			=> $this->input->post('category_id'),
            'sub_category'         		=> $this->input->post('sub_category'),
            'brand'         			=> $brand,
            'unit'         				=> $this->input->post('unit'),
            'tag'         				=> $this->input->post('tag'),
            'featured'         			=> $this->input->post('featured'),
            'description'         		=> $this->input->post('description'),
            'sale_price'         		=> $this->input->post('sale_price'),
            'purchase_price'         	=> $this->input->post('purchase_price'),
            'shipping_cost'         	=> $this->input->post('shipping_cost'),
            'tax'         				=> $this->input->post('tax'),
            'discount'        		 	=> $this->input->post('discount'),
            //'color'         			=> $this->input->post('color'),
            'tax_type'         			=> $this->input->post('tax_format'),
            'discount_type'         	=> $this->input->post('discount_format'),
            'payment_type'         		=> $this->input->post('pay_type'),
			'business_types'            => $this->input->post('business_types'),
			'display_vender'            => $display_vender,
			'to_role'          		    => $role,	
			'to_user'          		    => $this->input->post('user'),
			'main_image'                => $photoName,
			'added_by'                	=> $user_id,
            'created_by'           		=> $user_id,
            'download'           		=> "ok",
            'status'           			=> "ok",
            'vender_type'           	=> $current_user,
            'num_of_imgs'           	=> "1",
            'add_timestamp'            	=> time(),
            'created_at'            	=> time()
        ];

		$query = $this->db->insert('smb_product', $data);

        if($query)
        {
            create_activity('Added'.$data['title'].'smb_product'); //create an activity
            return true;
        }
        return false;

    }

	
//Update Product 
	
	public function update_digital_product($id){
		  $user_info = $this->session->userdata('logged_user');
		  $user_id = $user_info['user_id'];
		 
			$current_user = singleDbTableRow($user_id)->role;
			
		 	//Role explode 
			if($this->input->post('role') != ""){
				$role = implode(",", $this->input->post('role') );
			}
			else{
				$role = ",";
			}
		 
		  if ($_FILES['userfile']['name'] != '') {
				$upload_dir = './smb_uploads/'; //Upload directory
				if (!file_exists($upload_dir))
					mkdir($upload_dir); //create directory if not found.
				$config['upload_path'] = $upload_dir;
				$config['allowed_types']   = 'gif|jpg|png';
				$config['max_size'] = 2048;
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					$errorData = implode('<br />', $error);
					$this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
					redirect($_SERVER['HTTP_REFERER']); // redirect with error
				} else {
					$upload_data = $this->upload->data(); //all uploaded data store in variable
					$photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
					$fullPhoto = $upload_dir . $upload_data['file_name'];
					// $this->photoResize($fullPhoto); // resize now
				}
				
				 $data = [
					'title'         			=> $this->input->post('title'),
					'category'         			=> $this->input->post('category_id'),
					'sub_category'         		=> $this->input->post('sub_category'),
					'unit'         				=> $this->input->post('unit'),
					'tag'         				=> $this->input->post('tag'),
					'featured'         			=> $this->input->post('featured'),
					'description'         		=> $this->input->post('description'),
					'sale_price'         		=> $this->input->post('sale_price'),
					'purchase_price'         	=> $this->input->post('purchase_price'),
					'shipping_cost'         	=> $this->input->post('shipping_cost'),
					'tax'         				=> $this->input->post('tax'),
					'discount'        		 	=> $this->input->post('discount'),
					//'color'         			=> $this->input->post('color'),
					'tax_type'         			=> $this->input->post('tax_format'),
					'discount_type'         	=> $this->input->post('discount_format'),
					'payment_type'         		=> $this->input->post('pay_type'),
					'business_types'            => $this->input->post('business_types'),
					'display_vender'            => $this->input->post('display_name'),
					'to_role'          		    => $role,	
					'to_user'          		    => $this->input->post('user'),
					'status'           			=> "ok",
					'download'           		=> "ok",
					'vender_type'           	=> $current_user,
					'num_of_imgs'           	=> "1",
					'main_image'                => $photoName,
					'modified_by'               => $user_id,
					'modified_at'               => time()	
				];
			}
			
			else{
				$data = [
					'title'         			=> $this->input->post('title'),
					'category'         			=> $this->input->post('category_id'),
					'sub_category'         		=> $this->input->post('sub_category'),
					'unit'         				=> $this->input->post('unit'),
					'tag'         				=> $this->input->post('tag'),
					'featured'         			=> $this->input->post('featured'),
					'description'         		=> $this->input->post('description'),
					'sale_price'         		=> $this->input->post('sale_price'),
					'purchase_price'         	=> $this->input->post('purchase_price'),
					'shipping_cost'         	=> $this->input->post('shipping_cost'),
					'tax'         				=> $this->input->post('tax'),
					'discount'        		 	=> $this->input->post('discount'),
					//'color'         			=> $this->input->post('color'),
					'tax_type'         			=> $this->input->post('tax_format'),
					'discount_type'         	=> $this->input->post('discount_format'),
					'payment_type'         		=> $this->input->post('pay_type'),
					'business_types'            =>$this->input->post('business_types'),
					'display_vender'            =>$this->input->post('display_name'),
					'to_role'          		    =>$role,	
					'to_user'          		    =>$this->input->post('user'),
					'status'           			=> "ok",
					'download'         			=> "ok",
					'vender_type'           	=> $current_user,
					'num_of_imgs'           	=> "1",
					'modified_by'               => $user_id,
					'modified_at'               => time()			
				];
			}

        //set all data for inserting into database
       

        $query = $this->db->where('id', $id)->update('smb_product', $data);

        if($query)
        {
            create_activity('Updated '.$data['title'].'smb_product'); //create an activity
            return true;
        }
        return false;
		
    }
//Order History--------------------------------------

	public function all_sales_ListCount(){
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		 if ($currentUser == 'admin')
		{
			$query = $this->db->count_all_results('smb_sale');
		}
		else{
			$query = $this->db->where( 'buyer' , $user_id  )->count_all_results('smb_sale');	
		}
        return $query;
    }
		
    public function sale_List($limit = 0, $start = 0)
	{		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		
		 if ($currentUser == 'admin')
		{
		if($searchValue != '')																							
			{																												
				$table_name = "smb_sale";	
				$where_array = array('sale_code' => $searchValue );					
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_sale');
			}
		}
		else{
			if($searchValue != '')																							
			{																												
				$table_name = "smb_sale";	
				$where_array = array('sale_code' => $searchValue,  'buyer'=>$user_id);					
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_sale', ['buyer'=>$user_id]);
			}
		}
		
        return $query;
    }

	
	/*
    Get User
    */
    function get_user($to_role)
    {
      $where_array = array( 'rolename' => $to_role );
      $table_name="users";
       $query = $this->db->order_by('first_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    } 	
	
//Dynamic Smb ---------------

	public function dynamic_smb_listcount(){
		$query = $this->db->count_all_results('dynamic_labels');
        return $query;
    }

    public function dynamic_smb_List($limit = 0, $start = 0){
		
												
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('dynamic_labels');
		
        return $query;
    }

 public function add_dynamic_label(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$this->load->library('upload');
			$dataInfo   = array();
			$files      = $_FILES;
			$cpt        = count($_FILES['userfile']['name']);
			for($i=0; $i<$cpt; $i++)
			{           
				$_FILES['userfile']['name']= $files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

				$this->upload->initialize($this->set_upload_options());
				$this->upload->do_upload();
				$dataInfo[] = $this->upload->data();
			}
				
        //set all data for inserting into database
        $data = [
            'business_type'            => $this->input->post('business_types'),
            'sold_by'        		   => $this->input->post('sold_by'),
            'price'       			   => $this->input->post('price'),
            'currency_value' 	       => $this->input->post('currency'),
            'add_to_cart'      		   => $this->input->post('add_to_cart'),
            'items'        			   => $this->input->post('items'),
            'invoice_heading'          => $this->input->post('heading'),
            'available'         	   => $this->input->post('available'),
            'banner1'          		   => $dataInfo[0]['file_name'],
            'banner2'          		   => $dataInfo[1]['file_name'],
            'banner3'          		   => $dataInfo[2]['file_name'],
            'invoice_sub_heading1'     => $this->input->post('sub_heading1'),
            'invoice_sub_heading2'     => $this->input->post('sub_heading2'),
            'created_by'               => $user_id,
            'created_at'               => time()
        ];

       $query = $this->db->insert('dynamic_labels', $data);
	   
        if($query)
        {
            create_activity('Added '.$data['business_type'].' dynamic_labels'); //create an activity
            return true;
        }
        return false;

    }
	
  private function set_upload_options()
	{   
		//upload an image options
		$config = array();
		$config['upload_path']   = './uploads/smb_sales/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 2048;
		$config['overwrite']     = FALSE;
		return $config;
	}
	
	
//update Dynamic Labels

public function update_dynamic_label($id){
	
			  $user_info = $this->session->userdata('logged_user');
			  $user_id = $user_info['user_id'];
			
		
			$this->load->library('upload');
			$dataInfo   = array();
			$files      = $_FILES;
			$cpt   		= count($_FILES['userfile']['name']);
			
			for($i=0; $i<$cpt; $i++)
			{           
				$_FILES['userfile']['name']= $files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

				$this->upload->initialize($this->set_upload_options());
				$this->upload->do_upload();
				$dataInfo[] = $this->upload->data();
			}
		
			//set all data for inserting into database
			$data = [
				'business_type'            => $this->input->post('business_types'),
				'sold_by'        		   => $this->input->post('sold_by'),
				'price'       			   => $this->input->post('price'),
				'currency_value' 	       => $this->input->post('currency'),
				'add_to_cart'      		   => $this->input->post('add_to_cart'),
				'items'        			   => $this->input->post('items'),
				'invoice_heading'          => $this->input->post('heading'),
				'available'         	   => $this->input->post('available'),
				'banner1'          		   => $dataInfo[0]['file_name'],
				'banner2'          		   => $dataInfo[1]['file_name'],
				'banner3'          		   => $dataInfo[2]['file_name'],
				'invoice_sub_heading1'     => $this->input->post('sub_heading1'),
				'invoice_sub_heading2'     => $this->input->post('sub_heading2'),
				'created_by'               => $user_id,
				'created_at'               => time()
			];
	
        //set all data for inserting into database
       

        $query = $this->db->where('id', $id)->update('dynamic_labels', $data);

        if($query)
        {
            create_activity('Updated '.$data['business_type'].'dynamic_labels'); //create an activity
            return true;
        }
        return false;
		
    }

//Vendor Products Activation

 public function vendor_activation_listCount(){
		 
		$total = $this->db->group_by('product')->group_by('added_by')->group_by('location')->get('smb_stock');
		$query = $total->num_rows();
		
        return $query;
    }

    public function vendor_activation_list($limit = 0, $start = 0)
	{		
		$query = $this->db->order_by('id', 'desc')->group_by('product')->group_by('added_by')->group_by('location')->limit($limit, $start)->get('smb_stock');
		
		return $query;
    }
	
	public function block_vendor($product, $vendor, $location)
	{
		$data = [
				'active' => 0
				];
		$get_details = $this->db->get_where('smb_stock', ['product'=>$product, 'added_by'=>$vendor, 'location'=>$location]);
		foreach($get_details->result() as $v){
			$query = $this->db->where(['product'=>$product, 'added_by'=>$vendor, 'location'=>$location])->update('smb_stock', $data);
		}
		 if($query)
        {
          //  create_activity('Updated '.$data['name'].'smb_product'); //create an activity
            return true;
        }
        return false;
	}
	
	public function approve_vendor($product, $vendor, $location)
	{
		$data = [
				'active' => 1
				];
		$get_details = $this->db->get_where('smb_stock', ['product'=>$product, 'added_by'=>$vendor, 'location'=>$location]);
		foreach($get_details->result() as $v){
			$query = $this->db->where(['product'=>$product, 'added_by'=>$vendor, 'location'=>$location])->update('smb_stock', $data);
		}
		 if($query)
        {
          //  create_activity('Updated '.$data['name'].'smb_product'); //create an activity
            return true;
        }
        return false;
	}	
	
	public function view_stock_ListCount($id)
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		if($role == 11){
			$query = $this->db->where('product',$id)->count_all_results('smb_stock'); 
		}
		else{
			$query = $this->db->get_where('smb_stock', ['product'=>$id, 'added_by'=>$user_id])->num_rows();
		}
		
		
		
        return $query;
	}
	public function view_stock_List($limit=10, $start=0, $id)
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		if($role == 11){
			$query = $this->db->order_by('id','desc')->limit($limit,$start)->where('product',$id)->get('smb_stock');
		}
		else{
			$query = $this->db->order_by('id','desc')->limit($limit,$start)->get_where('smb_stock', ['product'=>$id, 'added_by'=>$user_id]);
		}
		
		 
        return $query;
	}
	
	
	
	public function search_product_ListCount($biz_type, $category, $sub_category, $product){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role_name = singleDbTableRow($user_id)->rolename;
		
		if($role_name == 11){
			$condition = " download = 'no' ";
		}
		
		else{
			$condition = " download = 'no' AND from_role LIKE '%".$role_name."%' ";
		}
		
		if($biz_type !='')
		{
			$condition .=" AND business_types = ".$biz_type." ";
		}
		
		if($category !='')
		{
			$condition .=" AND category = ".$category." ";
		}
		
		if($sub_category !='')
		{
			$condition .=" AND sub_category = '".$sub_category."'";
		}
		
		if($product !='')
		{
			$condition .=" AND id = '".$product."'";
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('smb_product'); 
		}
		else
		{
			$query = $this->db->count_all_results('smb_product'); 
		}
        return $query;
		
	}
	
	public function search_product_List($limit, $start, $biz_type, $category, $sub_category, $product){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role_name = singleDbTableRow($user_id)->rolename;
		
		if($role_name == 11){
			$condition = " download = 'no' ";
		}
		
		else{
			$condition = " download = 'no' AND from_role LIKE '%".$role_name."%' ";
		}
		
		if($biz_type !='')
		{
			$condition .=" AND business_types = ".$biz_type." ";
		}
		
		if($category !='')
		{
			$condition .=" AND category = ".$category." ";
		}
		
		if($sub_category !='')
		{
			$condition .=" AND sub_category = '".$sub_category."'";
		}
		
		if($product !='')
		{
			$condition .=" AND id = '".$product."'";
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('smb_product'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_product');	
		}
        
        return $query;
	}
	
	
	
	
	
	//Vendor Activation Search list :: Dillip
	
	public function vendor_activation_searchlistCount($product,$vendor,$location,$status)
	{
		
		$condition="";
		
		if($status !='')
		{	
			if($condition != ""){
			$condition.="active = '".$status."'";
			}
			else{
				$condition.="active = '".$status."'";
			}
		}
		
		if($product !='')
		{	
			if($condition != ""){
			$condition.="AND product = '".$product."'";
			}
			else{
				$condition.="product = '".$product."'";
			}
		}
		
		if($vendor !='')
		{	
			if($condition != ""){
			$condition.="AND added_by = '".$vendor."'";
			}
			else{
				$condition.="added_by = '".$vendor."'";
			}
		}
			
		if($location !='')
		{	
			if($condition != ""){
			$condition.="AND location = '".$location."'";
			}
			else{
				$condition.="location = '".$location."'";
			}
		}
			
		
			
					
	if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->group_by('product')->group_by('added_by')->group_by('location')->count_all_results('smb_stock');
		}
	
		else
		{
			$query = $this->db->count_all_results('smb_stock');
		}
		
        return $query;
	}
	
	/*========Vendor Activation Search======= :: dillip  */ 
	public function vendor_activation_searchlist($limit = 10, $start = 0 , $product, $vendor, $location, $status)
	{
	 $user_info = $this->session->userdata('logged_user');
     $user_id = $user_info['user_id'];
	 $rolename      = singleDbTableRow($user_id)->rolename;
	 $email   = singleDbTableRow($user_id)->email;
	
		
		$condition="";
		
		
		if($status !='')
		{	
			if($condition != ""){
			$condition.="active = '".$status."'";
			}
			else{
				$condition.="active = '".$status."'";
			}
		}
		
		
		if($product !='')
		{	
			if($condition != ""){
			$condition.="AND product = '".$product."'";
			}
			else{
				$condition.="product = '".$product."'";
			}
		}
		
		if($vendor !='')
		{	
			if($condition != ""){
			$condition.="AND added_by = '".$vendor."'";
			}
			else{
				$condition.="added_by = '".$vendor."'";
			}
		}
		
		if($location !='')
		{	
			if($condition != ""){
			$condition.="AND location = '".$location."'";
			}
			else{
				$condition.="location = '".$location."'";
			}
		}
		
		
		
		
	if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'asc')->group_by('product')->group_by('added_by')->group_by('location')->limit($limit,$start)->where($where_array)->get('smb_stock');
		}
		else
		{
			$query = $this->db->order_by('id', 'asc')->group_by('product')->group_by('added_by')->group_by('location')->limit($limit,$start)->get('
			
			
			
			
			
			
			
			
			
			
			
			
			');
		}
        return $query;
	
	}

	
}