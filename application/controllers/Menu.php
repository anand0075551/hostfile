<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('menu_model');

		check_auth(); //check is logged in.
	}
	
		

	
	
	public function add_left_menu(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_left_menu') die('Error! sorry');

			$this->form_validation->set_rules('left_menu_name', 'Left Menu Name', 'required|trim|is_unique[menu_business_groups.business_name]');


			if($this->form_validation->run() == true)
			{
				$insert = $this->menu_model->add_left_menu();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Left Menu Name Created Successfully');
					redirect(base_url('menu/all_left_menu'));
				}
			}
		}
      
		theme('add_left_menu');
	}

	public function all_left_menu(){
		//restricted this area, only for admin
		permittedArea();
      
		theme('all_left_menu');
	}
public function allLeftMenuListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->menu_model->allLeftMenu_ListCount();
		$query = $this->menu_model->allLeftMenu_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){

			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_left_menu/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';			
			$data['data'][] = array(
				$button,
				$r->business_name

			);
 }
}
		else{
			$data['data'][] = array(
				'Data Noy Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}
		public function deleteAjaxleftmenu(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted Left Menu Label");
		//Now delete permanently
		$this->db->where('id', $id)->delete('menu_business_groups');
		return true;
	}
	
		public function view_left_menu($id){
			//restricted this area, only for admin
		permittedArea();
		$data['menu'] = $this->db->get_where('menu_business_groups', ['id' => $id]);					
		theme('view_left_menu', $data);

	}
	
	 public function edit_left_menu($id) {

       permittedArea();

		$data['leftmenu'] = singleDbTableRow($id, 'menu_business_groups');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_left_menu')
                die('Error! sorry');


          $this->form_validation->set_rules('left_menu_name', 'Left Menu Name', 'required|trim|is_unique[menu_business_groups.business_name]');

            if ($this->form_validation->run() == true) {
                $insert = $this->menu_model->edit_left_menu($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Left Menu Name Updated Successfully...!!!');
                    redirect(base_url('menu/all_left_menu'));
                }
            }
        }

        theme('edit_left_menu',$data);
    }
	
		public function add_business_form(){
		//restricted this area, only for admin
		permittedArea();
		$data['role'] = $this->db->get('role');
		$data['business_name'] = $this->db->get('menu_business_groups');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_business_form') die('Error! sorry');

			$this->form_validation->set_rules('bg_id', 'Business Name', 'required|trim');
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
		//	$this->form_validation->set_rules('sub_category', 'Sub Category Name', 'required|trim');
			$this->form_validation->set_rules('font', 'F', 'required|trim');
			$this->form_validation->set_rules('displayform_name', 'Form Name', 'required|trim|is_unique[menu_bg_forms.displayform_name]');
			$this->form_validation->set_rules('controller', 'Controller Name', 'required|trim');
			//$this->form_validation->set_rules('phpfile_name', 'PHP File Name', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->menu_model->add_business_form();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Left Menu Name Created Successfully');
					redirect(base_url('menu/all_business_forms'));
				}
			}
		}
      
		theme('add_business_form',$data);
	}
		public function all_business_forms(){
		//restricted this area, only for admin
		permittedArea();
      
		theme('all_business_forms');
	}
	public function allLeftFormsListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->menu_model->allLeftForms_ListCount();
		$query = $this->menu_model->allLeftForms_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){

			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_left_forms/'. $r->bgform_id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->bgform_id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';		

		$query2 = $this->db->get_where('menu_business_groups', ['id' => $r->bg_id,]);
                                if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row2) {
                                        $bn = $row2->business_name;
                                    }
                                } else {
                                     $bn =  " ";
                                }
							$query = $this->db->get_where('menu_business_groups', ['id' => $r->category_name,]);
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        $b = $row->business_name;
                                    }
                                } else {
                                     $b =  " ";
                                }			
			$data['data'][] = array(
				$button,
				$bn,
				$b,
				//$r->sub_category,
				$r->controller,
				$r->phpfile_name,
				$r->displayform_name
				

			);
 }
}
		else{
			$data['data'][] = array(
				'Data Noy Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}
		public function deleteAjaxleftforms(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted Left Menu Label");
		//Now delete permanently
		$this->db->where('bgform_id', $id)->delete('menu_bg_forms');
		return true;
	}
	
			public function view_left_forms($bgform_id){
			//restricted this area, only for admin
		permittedArea();
		$data['menu'] = $this->db->get_where('menu_bg_forms', ['bgform_id' => $bgform_id]);					
		theme('view_left_forms', $data);

	}
	
		 public function edit_business_form($bgform_id) {

      // permittedArea();
		$data['menu_bg'] = bgform_id($bgform_id, 'menu_bg_forms');
		$data['leftmenu'] = bgform_id($bgform_id, 'menu_bg_forms');
		$data['business_name'] = $this->db->get('menu_business_groups');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_business_form')
                die('Error! sorry');


         			$this->form_validation->set_rules('bg_id', 'Business Name', 'required|trim');
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
		//	$this->form_validation->set_rules('sub_category', 'Sub Category Name', 'required|trim');
			$this->form_validation->set_rules('displayform_name', 'Form Name', 'required|trim|is_unique[menu_bg_forms.displayform_name]');
			$this->form_validation->set_rules('controller', 'Controller Name', 'required|trim');
		//	$this->form_validation->set_rules('phpfile_name', 'PHP File Name', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->menu_model->edit_business_form($bgform_id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Business Form Updated Successfully...!!!');
                    redirect(base_url('menu/all_business_forms'));
                }
            }
        }

        theme('edit_business_form',$data);
    }
	
	public function assign_menu(){
		//restricted this area, only for admin
		permittedArea();
		$data['business_name'] = $this->db->get('menu_business_groups');
		$data['role'] = $this->db->get('role');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'assign_menu') die('Error! sorry');

			$this->form_validation->set_rules('bg_id', 'Business Name', 'required|trim');
			$this->form_validation->set_rules('role_id', 'Role Name', 'required|trim');

			
			if($this->form_validation->run() == true)
			{
				$insert = $this->menu_model->assign_menu();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Assigned Left Menu To ROle Successfully');
					redirect(base_url('menu/assign_forms'));
				}
			}
		}
      
		theme('assign_menu',$data);
	}
		public function assigned_menus(){
		//restricted this area, only for admin
		permittedArea();
      
		theme('assigned_menus');
	}
	
	public function allAssignedMenuListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->menu_model->allAssigneMenus_ListCount();
		$query = $this->menu_model->allAssigneMenus_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){
			$activeStatus = $r->active_status;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-lock" ></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
					
				case 3 :
					
					$statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactivate" value="0" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_menu_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
			$button .= '<a class="btn btn-info editBtn" href="'.base_url('menu/edit_assigned_menu/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-copy"></i> </a>';
						
						
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';		
			$button .= $blockUnblockBtn;


		$query1 = $this->db->get_where('role', ['id' => $r->role_id,]);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $rn = $row1->rolename;
                                    }
                                } else {
                                     $rn =  " ";
                                }
										$query2 = $this->db->get_where('menu_business_groups', ['id' => $r->bg_id,]);
                                if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row2) {
                                        $bn = $row2->business_name;
                                    }
                                } else {
                                     $bn =  " ";
                                }
								
			$data['data'][] = array(
				$button,
				$statusBtn,
				$rn,
				$bn

				

			);
 }
}
		else{
			$data['data'][] = array(
				'Data Noy Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}
		public function deleteAjaxAssignedmenu(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted Left Menu Label");
		//Now delete permanently
		$this->db->where('id', $id)->delete('menu_bg_assignment');
		return true;
	}
		public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('active_status');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('menu_bg_assignment', ['active_status' => $buttonValue]);
		return true;
	}
	
	
	
	
		public function view_menu_assignment($id){
			//restricted this area, only for admin
		permittedArea();
		$data['menu'] = $this->db->get_where('menu_bg_assignment', ['id' => $id]);					
		theme('view_menu_assignment', $data);

	}
	
		 public function edit_assigned_menu($id) {

       permittedArea();
	   $data['leftmenu'] = singleDbTableRow($id, 'menu_bg_assignment');
	//	$data['menu_bg'] = bgform_id($bgform_id, 'menu_bg_assignment');
		$data['business_name'] = $this->db->get('menu_business_groups');
		$data['role'] = $this->db->get('role');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_assigned_menu')
                die('Error! sorry');


         	$this->form_validation->set_rules('bg_id', 'Business Name', 'required|trim');


            if ($this->form_validation->run() == true) {
                $insert = $this->menu_model->assign_menu();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Business Form Updated Successfully...!!!');
                    redirect(base_url('menu/all_business_forms'));
                }
            }
        }

        theme('edit_assigned_menu',$data);
    }
	
	 public function edit_form_assignment($id) {

       permittedArea();
	   $data['leftmenu'] = singleDbTableRow($id, 'menu_role_permission');
	//	$data['menu_bg'] = bgform_id($bgform_id, 'menu_bg_assignment');
		$data['business_name'] = $this->db->get('menu_business_groups');
		$data['role'] = $this->db->get('role');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_form_assignment')
                die('Error! sorry');


			$this->form_validation->set_rules('role_id', 'Role Name', 'required|trim');
			$this->form_validation->set_rules('bg_id', 'Business Name', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->menu_model->assign_forms();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Business Form Updated Successfully...!!!');
                    redirect(base_url('menu/all_business_forms'));
                }
            }
        }

        theme('edit_form_assignment',$data);
    }
	
	
	
	
	public function assign_forms(){
		//restricted this area, only for admin
		permittedArea();
		$data['business_name'] 		= $this->db->get('menu_business_groups');
		$data['role'] 				= $this->db->get('role');
		$data['displayform_name']   = $this->db->get('menu_bg_forms');
		if($this->input->post())
		{
			

			if($this->input->post('submit') != 'assign_form') die('Error! sorry');
			$this->form_validation->set_rules('role_id', 'Role Name', 'required|trim');
			$this->form_validation->set_rules('bg_id', 'Business Name', 'required|trim');
			
		//	$this->form_validation->set_rules('bgform_id', 'Form Name', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->menu_model->assign_forms();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Assigned Form To ROle Successfully');
					redirect(base_url('menu/assigned_forms'));
				}
			}
		}
      
		theme('assign_forms',$data);
	}
			public function assigned_forms(){
		//restricted this area, only for admin
		permittedArea();
      
		theme('assigned_forms');
	}
	public function allAssignedFormsListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->menu_model->allAssigneForms_ListCount();
		$query = $this->menu_model->allAssigneForms_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){
			$activeStatus = $r->permission;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
					
				case 3 :
					
					$statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactivate" value="0" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_form_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
						        	$button .= '<a class="btn btn-info editBtn" href="'.base_url('menu/edit_form_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-copy"></i> </a>';
						
						
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';	
					
			$button .= $blockUnblockBtn;


$query1 = $this->db->get_where('role', ['id' => $r->role_id,]);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $rn = $row1->rolename;
                                    }
                                } else {
                                     $rn =  " ";
                                }


$query2 = $this->db->get_where('menu_business_groups', ['id' => $r->bg_id,]);
                                if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row2) {
                                        $bn = $row2->business_name;
                                    }
                                } else {
                                     $bn =  " ";
                                }

$query3 = $this->db->get_where('menu_bg_forms', ['bgform_id' => $r->bgform_id,]);
                                if ($query3->num_rows() > 0) {
                                    foreach ($query3->result() as $row3) {
                                        $df = $row3->displayform_name	;
                                    }
                                } else {
                                     $df =  " ";
                                }								
			$data['data'][] = array(
				$button,
				$statusBtn,
				$rn,
				$bn,
				$df,
				

				

			);
 }
}
		else{
			$data['data'][] = array(
				'Data Noy Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}
	
	public function deleteAjaxAssignedForms(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted Left Menu Label");
		//Now delete permanently
		$this->db->where('id', $id)->delete('menu_role_permission');
		return true;
	}
		public function setBlockUnblock2(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('permission');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('menu_role_permission', ['permission' => $buttonValue]);
		return true;
	}
	
			public function view_form_assignment($id){
			//restricted this area, only for admin
		permittedArea();
		$data['menu'] = $this->db->get_where('menu_role_permission', ['id' => $id]);					
		theme('view_form_assignment', $data);

	}
	
	
	
	
			public function check_menu_assignment(){
			//restricted this area, only for admin
		permittedArea();
					$data['role'] 				= $this->db->get('role');
		theme('check_menu_assignment',$data);

	}
	
	
				public function check_form_assignment(){
			//restricted this area, only for admin
		permittedArea();
		$data['role'] 				= $this->db->get('role');				
		theme('check_form_assignment',$data);

	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function get_user(){
        $ref_id = $_POST['ref_id'];
        //echo $ref_id;
        $data = $this->db->get_where('menu_bg_assignment', ['role_id'=>$ref_id]);
	
		
	
        if($data->num_rows()>0){
			$user = "<table class='table table-bordered'><thead><tr><th>Role Name</th><th>Left Menu</th><th>Status</th></tr></thead>";
        $user .= "<tbody>";

        foreach($data->result() as $row)
        {
			$query1 = $this->db->get_where('role', ['id' => $row->role_id,]);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $rn = $row1->rolename;
                                    }
                                } else {
                                     $rn =  " ";
                                }
			
			$query2 = $this->db->get_where('menu_business_groups', ['id' => $row->bg_id,]);
                                if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row2) {
                                        $bn = $row2->business_name;
                                    }
                                } else {
                                     $bn =  " ";
                                }
			if($row->active_status == 1){$status = 'Active';} else{$status = 'InActive';}
			
			$user .="<tr>";
            $user .="<td>".$rn. "</td>";
            $user .= "<td>".$bn."</td>";
            $user .= "<td>".$status."</td>";
            $user .="</tr>";
        }
        $user .="</tbody></table>";
		}
		else{
			$user = "No Results Found..!";
		}
        
        echo $user;
    } 
	
	
	
	
	
	public function get_user2(){
        $ref_id = $_POST['ref_id'];
        //echo $ref_id;
        $data = $this->db->get_where('menu_role_permission', ['role_id'=>$ref_id]);

        if($data->num_rows()>0){
			$user = "<table class='table table-bordered'><thead><tr><th>Role Name</th><th>Left Menu</th><th>Forms</th><th>Status</th></tr></thead>";
        $user .= "<tbody>";

        foreach($data->result() as $row)
        {
						$query1 = $this->db->get_where('role', ['id' => $row->role_id,]);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $rn = $row1->rolename;
                                    }
                                } else {
                                     $rn =  " ";
                                }
								
								
								$query2 = $this->db->get_where('menu_business_groups', ['id' => $row->bg_id,]);
                                if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row2) {
                                        $bn = $row2->business_name;
                                    }
                                } else {
                                     $bn =  " ";
                                }
								if($row->permission == 1){$status = 'Active';} else{$status = 'InActive';}
								
								$query3 = $this->db->get_where(' menu_bg_forms', ['bgform_id' => $row->bgform_id,]);
                                if ($query3->num_rows() > 0) {
                                    foreach ($query3->result() as $row3) {
                                        $dfn = $row3->displayform_name;
                                    }
                                } else {
                                     $dfn =  " ";
                                }
								
								
            $user .="<tr>";
            $user .="<td>".$rn. "</td>";
            $user .= "<td>".$bn."</td>";
            $user .= "<td>".$dfn."</td>";
            $user .= "<td>".$status."</td>";
			$user .="</tr>";
           
        }
        $user .="</tbody></table>";
		}
		else{
			$user = "No Results Found..!";
		}
        
        echo $user;
    } 
	
	
	
	
	
	     public function getforms()
     {
         $forms=$_POST['forms'];
       //  echo $forms;
      $query = $this->db->get_where('menu_bg_forms', ['bg_id'=>$forms]);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value=" . $r->bgform_id . ">" . $r->displayform_name . "</option>";
         }
	
     }
	
	public function menu_shorting(){
		//restricted this area, only for admin
	//	permittedArea();
      $data['menus'] 				= $this->db->order_by('alignment', 'asc')->get('menu_business_groups');
		theme('menu_shorting',$data);
	}
	public function set_order()
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$list_order = $_POST['list_order'];
		$list = explode(',' , $list_order);
		$i = 1 ;
		foreach($list as $id) 
		{
			$data = [
            'alignment'         	=> $i,
            'modified_at'            => time(),
            'modified_by'           => $user_id
        ];

        $query = $this->db->where('bg_id', $id)->update('menu_bg_assignment', $data);
		//
		$data2 = [
            'alignment'         	=> $i,
            'modified_at'            => time(),
            'modified_by'           => $user_id
        ];

        $query2 = $this->db->where('id', $id)->update('menu_business_groups', $data2);
		//
			
			$i++ ;
		}
	}
	public function form_shorting(){
		//restricted this area, only for admin
		permittedArea();
      $data['menus'] 				= $this->db->order_by('alignment', 'asc')->get('menu_bg_forms');
		theme('form_shorting',$data);
	}
	public function set_order2()
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$list_order = $_POST['list_order'];
		$list = explode(',' , $list_order);
		$i = 1 ;
		foreach($list as $id) 
		{
			$data = [
            'alignment'         	=> $i,
            'modified_at'            => time(),
            'modified_by'           => $user_id
        ];

        $query = $this->db->where('id', $id)->update('menu_role_permission', $data);
		//
		$data2 = [
            'alignment'         	=> $i,
            'modified_at'            => time(),
            'modified_by'           => $user_id
        ];

        $query2 = $this->db->where('bgform_id', $id)->update('menu_bg_forms', $data2);
		//
			
			$i++ ;
		}
	}


/*****************************Reporting******************************************************/

public function leftmenu_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$bg_id = $_POST['bg_id'];
		$role_id = $_POST['role_id'];
		
		
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->menu_model->search_leftmenu_listCount($bg_id,$role_id);
		
		$query = $this->menu_model->search_leftmenu_list($limit, $start,$bg_id,$role_id);
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
			$activeStatus = $r->active_status;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-lock" ></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
					
				case 3 :
					
					$statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactivate" value="0" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}
//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_menu_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
			$button .= '<a class="btn btn-info editBtn" href="'.base_url('menu/edit_assigned_menu/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-copy"></i> </a>';
						
						
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';		
			$button .= $blockUnblockBtn;
								
								$query4 = $this->db->get_where('menu_business_groups', ['id' => $r->bg_id,]);
                                if ($query4->num_rows() > 0) {
                                    foreach ($query4->result() as $row2) {
                                        $bg_id = $row2->business_name;
                                    }
                                } else {
                                     $bg_id =  " ";
                                }
							
							$query7 = $this->db->get_where('role', ['id' => $r->role_id]);

									if ($query7->num_rows() > 0) {
										foreach ($query7->result() as $row) {
											$role_id = $row->rolename;
										}
									} else {
										 $role_id = $row->rolename;
									}
									
			
						
					
									
	

			$data['data'][] = array(
				$button,
				$statusBtn,
				$role_id,
				$bg_id
			
					

				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','',''
			);
		
		}
		echo json_encode($data);

	}
	/*****************************assigned forms***************************/


public function leftmenuform_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$bg_id = $_POST['bg_id'];
		$role_id = $_POST['role_id'];
		$bgform_id = $_POST['bgform_id'];
		
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->menu_model->search_leftmenuform_listCount($bg_id,$role_id,$bgform_id);
		
		$query = $this->menu_model->search_leftmenuform_list($limit, $start,$bg_id,$role_id,$bgform_id );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
			$activeStatus = $r->permission;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" ">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2" ">
						<i class="fa fa-lock" ></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" ">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
					
				case 3 :
					
					$statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactivate" value="0" ">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_form_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
						        	$button .= '<a class="btn btn-info editBtn" href="'.base_url('menu/edit_form_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-copy"></i> </a>';
						
						
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';	
					
			$button .= $blockUnblockBtn;
								
								$query4 = $this->db->get_where('menu_business_groups', ['id' => $r->bg_id,]);
                                if ($query4->num_rows() > 0) {
                                    foreach ($query4->result() as $row2) {
                                        $bg_id = $row2->business_name;
                                    }
                                } else {
                                     $bg_id =  " ";
                                }
							
							$query7 = $this->db->get_where('role', ['id' => $r->role_id]);

									if ($query7->num_rows() > 0) {
										foreach ($query7->result() as $row) {
											$role_id = $row->rolename;
										}
									} else {
										 $role_id = $row->rolename;
									}
									
			
						
						
									
									$query4 = $this->db->get_where('menu_bg_forms', ['bgform_id' => $r->bgform_id,]);
                                if ($query4->num_rows() > 0) {
                                    foreach ($query4->result() as $row3) {
                                        $bgform_id = $row3->displayform_name	;
                                    }
                                } else {
                                     $bgform_id =  " ";
                                }		
									
							
	

			$data['data'][] = array(
				$button,
				$statusBtn,
				$role_id,
				$bg_id,
				$bgform_id
				
				
					

				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	
	 public function get_bgform_id()
     {
         $bg_id=$_POST['bg_id'];
        
         $query = $this->Menu_model->bgform_id($bg_id);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->bgform_id."'>".$r->bgform_id."</option>";
         }

     }
/****************************************all menu report******************************************************/
public function allmenu_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$business_name = $_POST['business_name'];
		
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->menu_model->search_allmenu_listCount($business_name);
		
		$query = $this->menu_model->search_allmenu_list($limit, $start,$business_name );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							


			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_left_menu/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';	
			$data['data'][] = array(
				$button,
				
				$r->business_name,
				
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
	
/*******************************all business forms report*******************************************/
public function allform_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$bg_id = $_POST['bg_id'];
		
		
	
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->menu_model->search_allform_listCount($bg_id);
		
		$query = $this->menu_model->search_allform_list($limit, $start,$bg_id);
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
									
								$query4 = $this->db->get_where('menu_business_groups', ['id' => $r->bg_id,]);
                                if ($query4->num_rows() > 0) {
                                    foreach ($query4->result() as $row2) {
                                        $bg_id = $row2->business_name;
                                    }
                                } else {
                                     $bg_id =  " ";
                                }

			//Action Button
			$button = '';			
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('menu/view_left_forms/'. $r->bgform_id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->bgform_id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';	
			$data['data'][] = array(
				$button,
				
				$bg_id,
			
				
				$r->controller,
				$r->phpfile_name,
				$r->displayform_name
				
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','',''
			);
		
		}
		echo json_encode($data);

	}
	

	 
	
	

	


	
}
	

