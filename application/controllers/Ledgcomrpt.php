<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ledgcomrpt extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Ledgcomrpt_model');

		check_auth(); //check is logged in.
	}

	
	
	/****************************Searching starts here************************/
	
	
	
/*============================================*/

 public function view_ledger_report() {

        theme('view_ledger_report');
    }
	
/*============================================*/
 public function view_comissions_report() {

        theme('view_comissions_report');
    }

	
	
	/*============================================*/


// ledger view button file


	
	 public function view_ledgrpt($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('ledger', ['id' => $id]);
        theme('view_ledgrpt', $data);
    }
	
	
	
// comissions view button file


	
	 public function view_comrpt($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('commissions', ['id' => $id]);
        theme('view_comrpt', $data);
    }
	

//Ledger  Search
public function ledger_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$pay_type = $_POST['pay_type'];
		$account_no = $_POST['account_no'];
		$rolename = $_POST['rolename'];
		$points_mode = $_POST['points_mode'];
		//$user_id = $_POST['user_id'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->Ledgcomrpt_model->search_ledger_listCount($pay_type,$account_no,$rolename,$points_mode,$sf_time,$st_time);
		
		$query = $this->Ledgcomrpt_model->search_ledger_list($limit, $start,$pay_type,$account_no,$rolename,$points_mode,$sf_time,$st_time );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
									
									  
						

			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Ledgcomrpt/view_ledgrpt/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
			
	$get_paytype = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			foreach($get_paytype->result() as $sc);
			$pay_type = $sc->name;				
								
			
			$query4 = $this->db->get_where('users', ['id' => $r->user_id]);

									if ($query4->num_rows() > 0) {
										foreach ($query4->result() as $row) {
											$user_id = $row->first_name.' '.$row->last_name;
										}
									} else {
										 $user_id = $row->first_name.' '.$row->last_name;
									}
									
									
									$roler = $this->db->get_where('role', ['id' => $r->rolename]);

									if ($roler->num_rows() > 0) {
										foreach ($roler->result() as $as) {
											$rolename = $as->rolename;
										}
									} else {
										 $rolename = $as->rolename;
									}
									
								
					  
					

			$data['data'][] = array(
				$button,
				$user_id,
				$r->email,
				$rolename,
				$r->account_no,
				$r->debit,
				$r->credit,
				$r->amount,
				$r->points_mode,
				$r->challan,
				$r->used,
				$r->paid_to,
				$pay_type,
				$r->tranx_id,
				$r->active,
				date("Y-m-d H:i:s",$r->created_at),
				date("Y-m-d H:i:s",$r->modified_at),
				$r->tran_count
				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	public function get_ledger_total(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$pay_type = $_POST['pay_type'];
		$account_no = $_POST['account_no'];
		$rolename = $_POST['rolename'];
		$points_mode = $_POST['points_mode'];
		//$user_id = $_POST['user_id'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$query = $this->Ledgcomrpt_model->get_ledger_total($pay_type,$account_no,$rolename,$points_mode,$sf_time,$st_time);
			if($query -> num_rows() > 0) 
	  {
		  $credit = 0;
		   $debit = 0;
		    $amountt = 0;
		 foreach($query->result() as $r)
		{
			if($r->pay_type == 24 || $r->pay_type == 25 || $r->pay_type == 29)
			{
				
		  $credit = 0;
		  $debit = 0;
		  $amountt = 0;
		
			}
			else{
			
		  
		  	$credit = $credit + $r->credit;
			$debit = $debit + $r->debit;
			$amountt = $debit - $credit;
			}
		}
	  }
	  else
	  {
		  $credit = 0;
		  $debit = 0;
		  $amountt = 0;
	  }
	  
	  
	   echo "<table class='table table-striped'>
	  <tr>
	  
	  <th>Total Accounts:</th>
	  <td> ".$query -> num_rows()."</td>
	  </tr>
	  <tr>
	   <tr>
	    <th>Total Dedit:</th>
		<td>".number_format($debit)."</td>
		</tr>
		 <tr>
	    <th>Total Crebit:</th>
		<td>".number_format($credit)."</td>
		</tr>
	  <tr>
	    <th>Total Amount:</th>
		<td>".number_format($amountt)."</td>
		</tr>
	  </table> <br><br>
	  ";
	}

	
	/**********************Comissions Report**************************/
	
	
	public function comissions_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$identity = $_POST['identity'];
		$acct_id = $_POST['acct_id'];
		$from_role = $_POST['from_role'];
		$to_role = $_POST['to_role'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->Ledgcomrpt_model->search_comissions_listCount($identity,$acct_id,$from_role,$to_role,$sf_time,$st_time);
		
		$query = $this->Ledgcomrpt_model->search_comissions_list($limit, $start,$identity,$acct_id,$from_role,$to_role,$sf_time,$st_time );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
									
									  
						

			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Ledgcomrpt/view_comrpt/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
						$get_rolename = $this->db->get_where('role', ['id'=>$r->to_role]);
			foreach($get_rolename->result() as $sc);
			$to_role = $sc->rolename;
							
							$query7 = $this->db->get_where('role', ['id' => $r->from_role]);

									if ($query7->num_rows() > 0) {
										foreach ($query7->result() as $row) {
											$from_role = $row->rolename;
										}
									} else {
										 $from_role = $row->rolename;
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
	

			$data['data'][] = array(
				$button,
				$r->identity,
				$r->identity_id,
				$r->type,
				$r->remarks,
				$r->start_date,
				$r->end_date,
				$r->acct_id,
				$r->sub_acct_id,
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
					$r->visible

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
	
	public function get_comissions_total(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$identity = $_POST['identity'];
		$acct_id = $_POST['acct_id'];
		$from_role = $_POST['from_role'];
		$to_role = $_POST['to_role'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$query = $this->Ledgcomrpt_model->get_comissions_total($identity,$acct_id,$from_role,$to_role,$sf_time,$st_time);
		
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
}
