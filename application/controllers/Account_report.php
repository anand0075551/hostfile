<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_report extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Account_report_model');

        check_auth(); //check is logged in.
    }
public function account_view()
	{
	  theme('account_view');
    }	
public function account_view_json()
	{
		$id          = $_POST['id'];
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');
		$queryCount  = $this->Account_report_model->view_account_ListCount($id);
		$query       = $this->Account_report_model->view_account_List($limit, $start ,$id);
		

		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			
			$get_user_id = $this->db->get_where('users', ['id'=>$r->user_id]);
			foreach($get_user_id->result() as $p);
			if($p->company_name!='')
			{
				$user_id = $p->first_name.' '.$p->last_name.'('.$p->company_name.')';
			}
			else
			{
				$user_id = $p->first_name.' '.$p->last_name;
			}
			$get_rolename = $this->db->get_where('role', ['id'=>$r->rolename]);
			foreach($get_rolename->result() as $sc);
			$rolename = $sc->rolename;
			
			$get_pay_type = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			foreach($get_pay_type->result() as $c);
			$pay_type = $c->name;
			
			$get_paid_to = $this->db->get_where('users', ['id'=>$r->paid_to]);
			foreach($get_paid_to->result() as $p);
			$paid_to = $p->first_name.' '.$p->last_name;
             
				$button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Account/balancesheet_view/'.$r->user_id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                  
		$data['data'][] = array(	
				$button,
                $user_id,
                $r->email,
                $rolename,
                $r->account_no,
				number_format($r->debit,2),
				number_format($r->credit,2),
				number_format($r->amount,2),
                $r->points_mode,
                $r->challan,
                $r->used,
                $paid_to,
                $pay_type,
                $r->tranx_id,
                $r->active,
                date('d-m-Y', $r->created_at),   
				$r->tran_count
				);
		     }
          }
			
		else{
			$data['data'][] = array(
				'Accounts are not Available' , '', '','', '','','', '', '','', '','','', '', '','', ''
			);
		
		}
		echo json_encode($data);
	}
 public function accounts_report()
	{

		theme('accounts_report');
	}
public function accounts_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$user_id     = $_POST['user_id'];
		$rolename    = $_POST['rolename'];
		$pay_type    = $_POST['pay_type'];
		$points_mode = $_POST['points_mode'];
		$sf_time     = $_POST['sf_time'];
		$st_time     = $_POST['st_time'];
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');


		$queryCount = $this->Account_report_model->search_account_ListCount($user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time);
		$query = $this->Account_report_model->search_account_List($limit, $start ,$user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time);
		
		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
				
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			

		    //Action Button
			$button = '';
			$button .= '<a class="btn btn-info editBtn" href="' . base_url('Account_report/account_view/?id='.$r->user_id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-align-left"></i> </a>';

               
			
			$get_user_id = $this->db->get_where('users', ['id'=>$r->user_id]);
			foreach($get_user_id->result() as $p);
			if($p->company_name!='')
			{
				$user_id = $p->first_name.' '.$p->last_name.'('.$p->company_name.')';
			}
			else
			{
				$user_id = $p->first_name.' '.$p->last_name;
			}
			$get_rolename = $this->db->get_where('role', ['id'=>$r->rolename]);
			foreach($get_rolename->result() as $sc);
			$rolename = $sc->rolename;
			
			$get_pay_type = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			foreach($get_pay_type->result() as $c);
			$pay_type = $c->name;
			
			$get_paid_to = $this->db->get_where('users', ['id'=>$r->paid_to]);
			foreach($get_paid_to->result() as $p);
			$paid_to = $p->first_name.' '.$p->last_name;
			
			
			if($points_mode!=""){
				$condition = " points_mode = '".$points_mode."' AND user_id = '".$r->user_id."' ";
				$p_mode = $points_mode;
			}
			else{
				$condition = " user_id = '".$r->user_id."' ";
				$p_mode = "All";
			}
			
			$query2 = $this->db->where($condition)->get('accounts');
			if($query2 -> num_rows() > 0) 
			  {
				  $debit = 0;
				  $credit = 0;
				  $amount =0;
				 foreach($query2->result() as $r)
				{
					if($r->pay_type == 24 || $r->pay_type == 25)
					{
						
					}
					else
					{
						$debit   = $debit + $r->debit;
						$credit  = $credit + $r->credit;
						$amount  = $debit - $credit;
					}
				}
			  }
			  else
			  {
				  $debit  = 0;
				  $credit = 0;
				  $amount = 0;
			  }
			
	
		$data['data'][] = array(	     
                $button,
                $user_id,
                $r->email,
                $rolename,
                $r->account_no,
				number_format($debit,2),
			    number_format($credit,2),
				number_format($amount,2),
                $p_mode,
                $r->challan,
                $r->used,
                $paid_to,
                $pay_type,
                $r->tranx_id,
                $r->active,
                date('d-m-Y', $r->created_at),   
				$r->tran_count
				);
		     }
          }
			
		else{
			$data['data'][] = array(
				'Accounts are not Available' , '', '','', '','','', '', '','', '','','', '', '','', ''
			);
		
		}
		echo json_encode($data);
	  }
	  
public function get_total()
	{
		$user_info     = $this->session->userdata('logged_user');
		$user_id       = $user_info['user_id'];
		$role          = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$user_id       = $_POST['user_id'];
		$rolename      = $_POST['rolename'];
		$pay_type      = $_POST['pay_type'];
		$points_mode   = $_POST['points_mode'];
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
	
		
		$query = $this->Account_report_model->get_total($user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time);
		if($query -> num_rows() > 0) 
	  {
		  $debit = 0;
		  $credit = 0;
		  $amount =0;
		 foreach($query->result() as $r)
		{
			if($r->pay_type == 24 || $r->pay_type == 25)
			{
				
			}
			else
			{
				$debit   = $debit + $r->debit;
				$credit  = $credit + $r->credit;
				$amount  = $debit - $credit;
			}
		}
	  }
	  else
	  {
		  $debit  = 0;
		  $credit = 0;
		  $amount = 0;
	  }
	/*  echo "<table class='table table-striped'>
				<tr>
				<th>Total Debit:</th>
				<td>".number_format($debit,2)."</td>
				</tr>
				<tr>
				<th>Total Credit:</th>
				<td>".number_format($credit,2)."</td>
				</tr>
				<tr>
				<th> Amount:</th>
				<td>".number_format($amount,2)."</td>
				</tr>
				</table><br><br>";
				
				*/
	}
	  
}