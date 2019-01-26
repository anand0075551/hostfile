<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();

if($_REQUEST)
{
	$user_id=$_REQUEST['user_id'];
//Taking account details
$condition="WHERE a.user_id='".$user_id."' ";
$account_result=$classObj->Accounts($condition);
if($account_result)
{
	foreach($account_result as $results)
	{
		$a_id=$results['id'];
		$user_id=$results['user_id'];
		$email=$results['email'];
		$role_id=$results['rolename'];
		$rolename=$results['rname'];
		$account_no=$results['account_no'];
		$debit=$results['debit'];
		$credit=$results['credit'];
		$amount=$results['amount'];
		$challan=$results['challan'];
		$used=$results['used'];
		$paid_to=$results['paid_to'];
		$pay_type_id=$results['pay_type'];
		$tranx_id=$results['tranx_id'];
		$active=$results['active'];
		$created_at=$results['created_at'];
		$modified_at=$results['modified_at'];
		$tran_count=$results['tran_count'];
		$referral_code=$results['referral_code'];
		$contactno=$results['contactno'];
		$division_name=$results['division_name'];
	}
	  
}
echo json_encode(array('a_id' => $a_id, 'user_id' => $user_id, 'email' => $email, 'rolename' => $rolename, 'rname' => $rolename, 'account_no' => $account_no, 'debit' => $debit, 'credit' => $credit, 'amount' => $amount, 'challan' => $challan, 'used' => $used, 'paid_to' => $paid_to, 'pay_type' => $pay_type_id, 'tranx_id' => $tranx_id, 'active' => $active, 'created_at' => $created_at, 'modified_at' => $modified_at, 'tran_count' => $tran_count, 'referral_code' => $referral_code, 'contactno' => $contactno, 'division_name' => $division_name));
//Taking account details ends
}

?>
