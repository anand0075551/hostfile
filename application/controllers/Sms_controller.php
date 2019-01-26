<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_controller extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('product_model');
		$this->load->model('ledger_model');
		check_auth(); //check is logged in.
	}

	/**
	 * Listing all product
	 */

	public function index()
	{
		//restricted this area, only for admin
	//	permittedArea();

		theme('all_invoice');
	}
	

	
/************************************************************************************/
// * Pay wallet to Other Partners
/************************************************************************************/

	public function sms_pay_wallet( $key_id, $otp, $sms_no, $c_name){
		
	
			
			$activity = 'Agent Referral';
			
			
			include 'sendsms.php';		
			$message=" Your OTP ".$otp." for Org/Comp name".$c_name." SMS reference Id ".$key_id.".  'Team Consumer1st'.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');

			
		/*	if($sellProduct){
				redirect(base_url('product/invoice/'.$sellProduct));
			}
			else{
				setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
			}
*/
			//print_r($this->input->post());
		}

			theme('pay_wallet', $data);
	}

	
	
}
?>