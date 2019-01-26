<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();


	
	$points_mode = $_GET['pm'];
	$role = $_GET['r'];
	$pay_type = $_GET['pt'];
	$created_at = $_GET['cdt'];
	$created_from = $_GET['cf'];
	$created_to = $_GET['ct'];
	$r_user = $_GET['r_user'];
	$f_user = $_GET['f_user'];
	$t_user = $_GET['t_user'];
	
	$condition="";
	if($points_mode !='all')
	{
		$condition.="WHERE a.points_mode = '".$points_mode."'";
	}
	if($role !='all')
	{
		$condition.=($condition !='' ) ? " AND a.rolename = '".$role."'" : "WHERE a.rolename = '".$role."'" ;
		
	}
	if($pay_type !='all')
	{
		$condition.=($condition !='' ) ? " AND a.pay_type = '".$pay_type."'" : "WHERE a.pay_type = '".$pay_type."'" ;
		
	}
	if($created_at !='')
	{
		$newDate = date("Y-m-d", strtotime($created_at));
		$condition.=($condition !='' ) ? " AND  DATE(FROM_UNIXTIME(a.created_at)) = '".$newDate."'" : "WHERE    DATE(FROM_UNIXTIME(a.created_at)) = '".$newDate."'" ;
		
	}
	if($created_from !='' && $created_to !='')
	{
		$created_from = date("Y-m-d", strtotime($created_from));
		$created_to = date("Y-m-d", strtotime($created_to));
		//DATE(FROM_UNIXTIME(a.created_at)) >= '2016-11-18' and DATE(FROM_UNIXTIME(a.created_at)) <= '2016-11-25'
		$condition.=($condition !='' ) ? " AND  DATE(FROM_UNIXTIME(a.created_at)) >= '".$created_from."' and DATE(FROM_UNIXTIME(a.created_at)) <= '".$created_to."'" : "WHERE DATE(FROM_UNIXTIME(a.created_at)) >= '".$created_from."' and DATE(FROM_UNIXTIME(a.created_at)) <= '".$created_to."'" ;
	}
	if($r_user !='')
{
	$condition.=($condition !='' ) ? " AND a.user_id = '".$r_user."'" : "WHERE a.user_id = '".$r_user."'" ;
	
}

$res=$classObj->Bar_chart($condition,$f_user,$t_user);
	

?>