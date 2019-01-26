<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mobile_api extends CI_Controller {
function __construct(){
parent:: __construct();

	$this->load->model('Mobile_api_model');

	//check_auth(); //check is logged in.
	}
	
	
//Api to Check User Balance
 public function check_bal()
    {
    
	$email = $_GET['email'];
	
    $query1  	= $this->Mobile_api_model->total_wallet_debit($email);
    $query2  	= $this->Mobile_api_model->total_wallet_credit($email);
		
    foreach( $query1->result() 		as $wal_debit); 
    $wal_debit		= $wal_debit->debit;
    
    foreach( $query2->result() 		as $wal_credit); 
    $wal_credit      	= $wal_credit->credit;
     
    $wallet_balance     = ( $wal_debit - $wal_credit ) ;
   
    $data = $wallet_balance;
		
		echo json_encode($data);
		
     }
	 
//Login Api
 public function login()
    {
		
		 $email = $_GET['email'];
		 $row_pass = $_GET['pass'];
		 
		 $query1  	= $this->Mobile_api_model->login($email,$row_pass);
		
			 foreach ($query1->result() as $results);
		
				if(!empty($results) && $results)
				{
					echo json_encode(array($results));
				}
	else
	{
		echo "No User Found" ;
	}
		
		/*if($query1->num_rows() >0){
		foreach ($query1-> result() as $r);	
		$data ['data'] = array(
		$r->email
		);
	   
		//$data = $query1;
		}
		else{
		$data ['data'][] = array('No Data Found');
		}
		
		echo json_encode($data);
		//return $data;*/
	}
	
public function userregister()
{

		$insert = $this->Mobile_api_model->userregister();
				if($insert)
				{
					
					$data = $insert;
					echo json_encode($data);
				}
				else
				{
					echo "Sorry not registered ..?";
				}


}


public function validateReferralCodeApi(){
		
		$referredByCode = $this->input->post('referredByCode');
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode, 'role' => 'user', 'active' => '1']);
		if($query->num_rows() > 0){
			$return = 'true';
		}else{
			$return = 'false';
		}
		echo $return;
	}


public function uniqueReferralCodeApi(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$referredByCode = $this->input->post('referredByCode');
		
	if ($referredByCode != $user_referral_code )	
	{
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode,  'active' => '1']);
		if($query->num_rows() > 0 )
		{
			
			$return = 'true';
			
		}else{
			$return = 'false';
		}
	}
		echo $return;
	}
	public function referralCodeCheck($referredByCode){
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode]);
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return FALSE;
		}
	}
		
public function check_balance()
	{
		
		$user_id = $_GET['user_id'];
		
		 $query3  	= $this->Mobile_api_model->check_balance($user_id);
		
			 foreach ($query3->result() as $result);
				if(!empty($result) && $result)
				//if($result != '')
				{
					
			
					echo json_encode(array($result));
				
				}
				else
				{
					echo "No Acount Found" ;
				}
		 
		
		
	/* $email = $_GET['id'];
		
		$query3  	= $this->Mobile_api_model->check_balance($email);
		
		
		
		if($query3->num_rows() >0)
		{
			foreach ($query3-> result() as $r);
	   
			$data ['data'][] = array(
			$r->amount
			);
	   
			//$data = $query1;
		}
		else{
		$data ['data'][] = array('No Data Found');
		}
		
		echo json_encode($data);
		//return $data;
	 */
		
	}
	
	// Account Statement Api
	
			
public function account_statement()
	{
		
		$user_id = $_GET['user_id'];
		 $query4	= $this->Mobile_api_model->account_statement($user_id);
			if ($query4->num_rows() > 0)
			{
				$my_data = "";
				$data = "[";
				 foreach ($query4->result() as $result)
				{
					if(!empty($result) && $result)
					//if($result != '')
					{			
						
						$my_data .= json_encode(($result)).",";
					
					}
				}
				$my_data2 = explode(']', $my_data);
						foreach($my_data2 as $t){
							$data .= $t."null";
						}
				$data .= "]";
						echo $data;
			}
			else
			{
				echo "No Acount Found" ;
			}
	}
	
	public function vouchers()
	{
		
		$id = $_GET['id'];
		 $query4	= $this->Mobile_api_model->vouchers($id);
			if ($query4->num_rows() > 0)
			{
				 foreach ($query4->result() as $result)
				{
					if(!empty($result) && $result)
					//if($result != '')
					{			
						
						echo json_encode(array($result));
					}
				}	
			}
			else
			{
				echo "No vouchers Found" ;
			}
	}
	
	public function states()
	{
		
		$id = $_GET['id'];
		 $query4	= $this->Mobile_api_model->states($id);
			if ($query4->num_rows() > 0)
			{
				 foreach ($query4->result() as $result)
				{
					if(!empty($result) && $result)
					//if($result != '')
					{			
						
						echo json_encode(array($result));
					}
				}	
			}
			else
			{
				echo "No vouchers Found" ;
			}
	}
}