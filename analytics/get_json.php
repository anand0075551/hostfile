<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();
$user_id=2;
$url=file_get_contents('http://localhost/Report/account_json_data.php?user_id='.$user_id);
$json = json_decode($url, true);

echo 'a_id: '.$json['a_id'].'<br>';
echo 'user_id: '.$json['user_id'].'<br>';
echo 'email: '.$json['email'].'<br>';
echo 'rolename: '.$json['rolename'].'<br>';
echo 'account_no: '.$json['account_no'].'<br>';
echo 'debit: '.$json['debit'].'<br>';
echo 'credit: '.$json['credit'].'<br>';
echo 'amount: '.$json['amount'].'<br>';
echo 'challan: '.$json['challan'].'<br>';
echo 'used: '.$json['used'].'<br>';
echo 'paid_to: '.$json['paid_to'].'<br>';
echo 'pay_type: '.$json['pay_type'].'<br>';
echo 'tranx_id: '.$json['tranx_id'].'<br>';

echo 'active: '.$json['active'].'<br>';
echo 'created_at: '.$json['created_at'].'<br>';

?>