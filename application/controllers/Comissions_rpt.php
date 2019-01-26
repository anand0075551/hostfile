<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comissions_rpt extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Comissions_rpt_model');

		check_auth(); //check is logged in.
	}

	
	public function copy_commissions($id){
		//restricted this area, only for admin
		permittedArea();

		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			
			$where_array = array ('type'=>'role_name', 'active'=>'1');
			$data['roles']		  = $this->db->get_where('role', $where_array);
				
			$data['commissions'] = singleDbTableRow($id,'commissions');
		}
		

		if($this->input->post())
		{
			if($this->input->post('submit') != 'copy_commissions') die('Error! sorry');

			$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim'); 
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim'); 
			$this->form_validation->set_rules('sender_profit', 'Sender Profit Percentage', 'required|trim'); 
			$this->form_validation->set_rules('receiver_profit', 'Receiver Profit Percentage', 'required|trim'); 
			$this->form_validation->set_rules('sender_deduction', 'Sender Deduction Percentage', 'required|trim'); 
			$this->form_validation->set_rules('receiver_deduction', 'Receiver Deduction Percentage', 'required|trim'); 
			$this->form_validation->set_rules('points_mode', 'Points mode', 'required|trim'); 
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 		
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Comissions_rpt_model->copy_commissions($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Transactions Commissions Details 
					copied Successfully...!!!');
					//redirect($_SERVER['HTTP_REFERER']);
					redirect(base_url('Comissions_rpt/Comissions_report_list'));
				}
			}
		}

		theme('copy_commissions', $data);
	}
	
	/****************************Searching starts here************************/
	
	

/*============================================*/
 public function Comissions_report_list() {

        theme('Comissions_report_list');
    }

	
	
	
	  public function view_com_rpt($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('commissions', ['id' => $id]);
        theme('view_com_rpt', $data);
    }

	
	/*============================================*/

	
	public function comissions_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$acct_id = $_POST['acct_id'];
		$sub_acct_id = $_POST['sub_acct_id'];
		$from_role = $_POST['from_role'];
		$to_role = $_POST['to_role'];
		$ded_paytype = $_POST['ded_paytype'];
		$visible = $_POST['visible'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->Comissions_rpt_model->search_comissions_listCount($acct_id,$sub_acct_id,$ded_paytype,$from_role,$to_role,$visible,$sf_time,$st_time);
		
		$query = $this->Comissions_rpt_model->search_comissions_list($limit, $start,$acct_id,$sub_acct_id,$ded_paytype,$from_role,$to_role,$visible,$sf_time,$st_time );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
			$activeStatus = $r->visible;
							switch($activeStatus){
								case 0:
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Active" value="1" onClick="location.reload()">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 1:
					$statusBtn = '<small class="label label-warning">Deactive </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactive" value="0" onClick="location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				
								
							}						
									  
						

			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Comissions_rpt/view_com_rpt/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
							$button .= '<a class="btn btn-warning" href="' . base_url('Comissions_rpt/copy_commissions/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-align-justify"></i> copy</a>';
		
				$button .= $blockUnblockBtn;
						
		      $get_acc_id =$this->db->get_where('acct_categories',['id'=>$r->acct_id]);
			  foreach($get_acc_id->result () as $ii){
				  $acct_id = $ii->name;
				  
				  }
					
					
					 $get_sub_acc_id =$this->db->get_where('acct_categories',['id'=>$r->sub_acct_id]);
			  foreach($get_sub_acc_id->result () as $xs){
				  $sub_acct_id = $xs->name;
				  
				  }				
					
						
						$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

									if ($query2->num_rows() > 0) {
										foreach ($query2->result() as $row) {
											$created_by = $row->first_name.' '.$row->last_name;
										}
									} else {
										 $created_by = $row->first_name.' '.$row->last_name;
									}
									
									  
							$query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

									if ($query3->num_rows() > 0) {
										foreach ($query3->result() as $row) {
											$modified_by = $row->first_name.' '.$row->last_name;
										}
									} else {
										 $modified_by = $row->first_name.' '.$row->last_name;
									}
									
									$fromro = $this->db->get_where('role', ['id' => $r->from_role]);

									if ($fromro->num_rows() > 0) {
										foreach ($fromro->result() as $row) {
											$from_role = $row->rolename;
										}
									} else {
										 $from_role = $row->rolename;
									}
									
									
									$torole = $this->db->get_where('role', ['id' => $r->to_role]);

									if ($torole->num_rows() > 0) {
										foreach ($torole->result() as $row) {
											$to_role = $row->rolename;
										}
									} else {
										 $to_role = $row->rolename;
									}
									
								

			$data['data'][] = array(
				$button,
				$r->identity,
				$r->identity_id,
				$r->type,
				$r->remarks,
				$r->start_date,
				$r->end_date,
				 $acct_id,
				$sub_acct_id,
				$r->ded_paytype,
				$r->amount,
				$r->loy_amt,
				$r->dis_amt,
				$from_role,
				$to_role,
				$r->commission,
                    $r->benefits,
					 $r->slr_ref_pm,
                    $r->slr_ref_level1,
                    $r->slr_ref_level2,
                    $r->slr_ref_level3,
                    $r->slr_ref_level4,
                    $r->slr_ref_level5,
					 $r->clt_ref_pm,
                    $r->clt_ref_level1,
                    $r->clt_ref_level2,
                    $r->clt_ref_level3,
					$r->clt_ref_level4,
                    $r->clt_ref_level5,
					 $r->points_mode,
                    $r->profit_pm,
                    $r->sender_profit,
					 $r->receiver_profit,
                    $r->deduction_pm,
					 $r->sender_deduction,
                    $r->receiver_deduction,
                    $r->transferrable,
					 $r->period,
                    $r->tenure,
					$modified_by,
					date("Y-m-d H:i:s",$r->modified_at),
					date("Y-m-d H:i:s",$r->created_at),
					$created_by,
					$statusBtn

				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	
	public function get_comission_tot(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
	$acct_id = $_POST['acct_id'];
		$sub_acct_id = $_POST['sub_acct_id'];
		$from_role = $_POST['from_role'];
		$to_role = $_POST['to_role'];
		$ded_paytype = $_POST['ded_paytype'];
		$visible = $_POST['visible'];
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$query = $this->Comissions_rpt_model->get_comission_tot($acct_id,$sub_acct_id,$ded_paytype,$from_role,$to_role,$visible,$sf_time,$st_time);
		
				if($query -> num_rows() > 0) 
	  {
		  $amounts = 0;
		 foreach($query->result() as $r)
		{
			$amounts = $amounts + $r->amount;
		}
	  }
	  else
	  {
		  $amounts = 0;
	  }
	  
	  	if($query -> num_rows() > 0) 
	  {
		  $sender_profit = 0;
		 foreach($query->result() as $r)
		{
			$sender_profit = $sender_profit + $r->sender_profit;
		}
	  }
	  else
	  {
		  $sender_profit = 0;
	  }
	  
	  	if($query -> num_rows() > 0) 
	  {
		  $receiver_profit = 0;
		 foreach($query->result() as $r)
		{
			$receiver_profit = $receiver_profit + $r->receiver_profit;
		}
	  }
	  else
	  {
		  $receiver_profit = 0;
	  }
	  
	   echo "<table class='table table-striped'>
	  <tr>
	  
	  <th>No.of Comissions:</th>
	  <td> ".$query -> num_rows()."</td>
	  </tr>
	  <tr>
	  <th>Total Amount:</th>
	  <td>".$amounts."</td>
	  </tr>
	  <tr>
	    <th>Sender's Profit:</th>
		<td>".number_format($sender_profit)."</td>
		</tr>
	  <tr>
		  <th>Receiver's Profit:</th>
		  <td>".number_format($receiver_profit)."</td>
		  </tr>
	  
	  </table> <br><br>
	  ";
	}
	
public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('visible');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		//Now delete permanently

		$this->db->where('id', $id)->update('commissions', ['visible' => $buttonValue]);
		return true;
	}



	 
	 
	
}