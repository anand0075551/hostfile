<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution_comissions_rpt extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Distribution_comissions_rpt_model');

		check_auth(); //check is logged in.
	}

	
	
	/****************************Searching starts here************************/
	
	

/*============================================*/
 public function Distribution_report_index() {

        theme('Distribution_report_index');
    }

	
	
	
	
	/*============================================*/

	
	public function distribution_comissions_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$business_group = $_POST['business_group'];
		
		$from_role = $_POST['from_role'];
		$to_user = $_POST['to_user'];
		
		$status = $_POST['status'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->Distribution_comissions_rpt_model->search_distribution_comissions_listCount($business_group,$from_role,$to_user,$status,$sf_time,$st_time);
		
		$query = $this->Distribution_comissions_rpt_model->search_distribution_comissions_list($limit, $start,$business_group,$from_role,$to_user,$status,$sf_time,$st_time );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
			$activeStatus = $r->status;
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
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Distribution_comissions_rpt/view_menu_assignment/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
			
						
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a>';		
			$button .= $blockUnblockBtn;

			
		


				$get_tprole = $this->db->get_where('role', ['id'=>$r->to_role]);
			foreach($get_tprole->result() as $sc);
			$to_role = $sc->rolename;	
								
							
							$query7 = $this->db->get_where('role', ['id' => $r->from_role]);

									if ($query7->num_rows() > 0) {
										foreach ($query7->result() as $row) {
											$from_role = $row->rolename;
										}
									} else {
										 $from_role = $row->rolename;
									}
									
										$rr = $this->db->get_where('users', ['id' => $r->created_by]);

									if ($rr->num_rows() > 0) {
										foreach ($rr->result() as $row) {
											$created_by = $row->first_name.' '.$row->last_name;
										}
									} else {
										 $created_by = $row->first_name.' '.$row->last_name;
									}
									
										$md = $this->db->get_where('users', ['id' => $r->modified_by]);

									if ($md->num_rows() > 0) {
										foreach ($md->result() as $row) {
											$modified_by = $row->first_name.' '.$row->last_name;
										}
									} else {
										 $modified_by = $row->first_name.' '.$row->last_name;
									}
							
							
									$touser = $this->db->get_where('users', ['id' => $r->to_user]);

									if ($touser->num_rows() > 0) {
										foreach ($touser->result() as $row) {
											$to_user = $row->first_name.' '.$row->last_name;
										}
									} else {
										 $to_user = $row->first_name.' '.$row->last_name;
									}
							

			$data['data'][] = array(
				$button,
				$to_role,
				$to_user,
				$r->root_id,
				$from_role,
				$r->from_date,
				$r->end_date,
				$r->no_of_users,
				
				$r->total_sales,
				$r->total_commission,
				$statusBtn,
				$r->invoice_number,
				$r->business_group,
					$created_by,
					$modified_by,
					date("Y-m-d H:i:s",$r->created_at),
					
					date("Y-m-d H:i:s",$r->modified_at)
					
					
					

				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('status');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		//Now delete permanently

		$this->db->where('id', $id)->update('upper_commission', ['status' => $buttonValue]);
		return true;
	}

	public function deleteAjaxcommissions(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted Left Menu Label");
		//Now delete permanently
		$this->db->where('id', $id)->delete('upper_commission');
		return true;
	}
	 
	
}