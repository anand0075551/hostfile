<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();

$condition=$_POST['c'];

// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "consucgr_ccb";

$csv_filename = 'account_export_'.date('Y-m-d').'.csv';

// Database connecten voor alle services
mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());
					
mysql_select_db($database)
or die ('Could not select database ' . mysql_error());
// create empty variable to be filled with export data
$csv_export = '';
// query to get data from database
$export = mysql_query("SELECT CONCAT(u.first_name,' ', u.last_name) AS Name,a.email AS EMAIL,u.referral_code AS CustomerCode,u.contactno AS PhoneNumber,ac.name as DivisionName,a.points_mode AS PointsMode,a.debit AS DEPOSIT,a.credit AS Deduction,a.amount AS Balance FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition." ORDER BY a.id DESC LIMIT 50");

$header='';
$data='';
$fields = mysql_num_fields ( $export );

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . "\t";
}

while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}

$res=$classObj->pdf_accounts($condition);
$deposit=0;
$deduction=0;
$balance=0;
foreach($res as $row) 
{
		$deposit = $deposit + $row['DEPOSIT'];
		 $deduction = $deduction + $row['Deduction'];
		 $balance = $balance + $row['Balance'];
	
}
$amount = $deposit - $deduction;
$data .="\n";
$data .="Total Deposit : ".round($deposit, 3);
$data .="\n";
$data .="Total Deduction : ".round($deduction, 3);
$data .="\n";
$data .="Total Balance Amount : ".round($balance, 3);

 $data = str_replace( "\r" , "" , $data );
if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename='$csv_filename'");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

?>

