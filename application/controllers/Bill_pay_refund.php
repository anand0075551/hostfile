<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bill_pay_refund extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Bill_pay_refund_model');
		$this->load->model('ledger_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');
		
		check_auth(); //check is logged in.
	}

/* event lists */
	public function bill_pay_refund_list()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		$datas['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$datas['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$datas['total_amount']  	= $this->Bill_pay_refund_model->total_amount();
		$datas['total_earning']  	= $this->Bill_pay_refund_model->total_earning();
		$datas['total_refund']  	= $this->Bill_pay_refund_model->total_refund();
		$datas['total_paid']  	= $this->Bill_pay_refund_model->total_paid();
		if($currentUser != 11 and $currentUser != 38)
		{
			permittedArea();
		}
		else
		{
			if($this->input->post())
			{
				if($this->input->post('submit') == 'import_data')
				{
					$this->form_validation->set_rules('fileToUpload','fileToUpload','required');
					
					$target_file = $_FILES["fileToUpload"]["name"];
					$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
					if($fileType != "csv")  //  checking for the file extension.  not allowing othre then (.csv) extension .
					{
						$this->session->set_flashdata('errorMsg', 'Sorry, only CSV file is allowed!');
						redirect(base_url('Bill_pay_refund/bill_pay_refund_list'));
						
					}
					else
					{
						$handle = fopen($_FILES['fileToUpload']['tmp_name'], "r");
						if ($handle !== FALSE) 
						{
						   fgetcsv($handle);   
						   while (($data = fgetcsv($handle)) !== FALSE) 
						   {
							 $fieldCount = count($data);
							 for ($c=0; $c < $fieldCount; $c++) 
							 {
							  $columnData[$c] = $data[$c];
							 }
							 $order_id = $columnData[0];
							 $string1 = $columnData[1];
							 $usertxn= preg_replace('/[^A-Za-z0-9\-]/', '', $string1);
							 $username = $columnData[2];
							 $amount = $columnData[3];
							 $status = $columnData[4];
							 $txn_time = $columnData[5];
							 $earning = $columnData[6];
							 $exist = $this->db->get_where('bill_pay_refund', ['usertxn'=>$usertxn]);
							if($exist -> num_rows()>0)
							{
							}
							else
							{
							 $create = $this->Bill_pay_refund_model->import_data($order_id,$usertxn,$username,$amount,$status,$txn_time,$earning);// SQL Query to insert data into DataBase
							}
						   }
						 
						 fclose($handle);
					   }
				   }
				}
			}
			
			theme('bill_pay_refund_list',$datas);
		}
	}
	public function RefundListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Bill_pay_refund_model->RefundListCount();
		$query = $this->Bill_pay_refund_model->RefundList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 $cnt = 1;
			 foreach ($query->result() as $funds) 
			 {
				 
				 //
				 $get_user_id = $this->db->get_where('billpay_status', ['usertxn'=>$funds->usertxn]);
				 if($get_user_id -> num_rows()>0)
				 {
					foreach($get_user_id->result() as $u);
					$user = $u->user_id;
					//
					$get_user_details = $this->db->get_where('users', ['id'=>$user]);
					if($get_user_details -> num_rows()>0)
					{
						foreach($get_user_details->result() as $ud);
						$user_name = $ud->first_name.' '.$ud->last_name;
						$referral_code = $ud->referral_code;
					}
					else
					{
						$user_name = '';
						$referral_code = '';
					}
					//
				 }
				 else
				 {
					 	$user_name = '';
						$referral_code = '';
				 }
				 //
				 $earning = str_replace( "'", "", $funds->earning );
				$amount = $funds->amount;
				$refund = $funds->amount - $earning;
				$id = $funds->id;
				 //Action Button
				  $button = '';
				  if($funds->paid == 1)
				  {
					 $button .= '<a class="btn btn-primary editBtn" href="" data-toggle="tooltip" title="Paid" disabled><i class="fa fa-thumbs-up"></i> </a> ';
				  }
				  else
				  {
					  $button = '<a class="btn btn-primary editBtn" onClick="pay_now('.$cnt.','.$amount.','.$referral_code.','.$id.')" title="Get it" >
						<i class="fa fa-money"> </i> </a>';
					   
				  }
				 
				 $data['data'][] = array(
                    $funds->order_ID,
					$funds->usertxn,
					$funds->txn_time,
					$user_name,
					$referral_code,
					$funds->amount,
					$earning,
					$refund,
					$button
                );
				$cnt ++;
			 }
			 
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', '', ''
            );
		 }
		  echo json_encode($data);
	}
/* ends */
public function Pay_now()
    {
		 $refund_amount=$_POST['refund'];
		 $receiver_referral_code=$_POST['referral_code'];
		 $refund_id=$_POST['id'];
		 
		 
		$pay=$this->Bill_pay_refund_model->Pay_now($refund_amount,$receiver_referral_code,$refund_id);
		if($pay)
		{
			echo "Transaction Successfull";
		}
		else
		{
			echo "Sorry...Transaction Failed";
		}
	}
}
?>