<?php
include_once('report.class.php');  
$classObj = new ReportClass();

$keyword = $_POST['data'];
$role = $_POST['role'];

$res=$classObj->User($keyword,$role);
	
		echo 'Select To User: <select name="t_user" id="t_user">';
		if($res)
		{
			foreach($res as $result)
			{
				$name=$result['first_name'].' '.$result['last_name'];
				$str = strtolower($name);
				$start = strpos($str,$keyword); 
				$end   = similar_text($str,$keyword); 
				$last = substr($str,$end,strlen($str));
				$first = substr($str,$start,$end);
				
				$final = '<span class="bold">'.$first.'</span>'.$last;
			
				echo '<option value="'.$result['id'].'">'.$final.'</option>"';
				
				
			}
		}
		else
		{
			echo '<option value="">No matches found</option>';
		}
		echo "</select>";
	
?>	   
