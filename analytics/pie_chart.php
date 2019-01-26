<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();


$condition="";
$f_user="";
$t_user="";

$res=$classObj->Pie_chart($condition,$f_user,$t_user);
	

?>