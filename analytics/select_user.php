<?php 
include_once('report.class.php');  
       
$classObj = new ReportClass();

if(!empty($_GET))
{
	$role = $_GET['role'];
	//Select users under given role
	$condition=($role !='all' ) ? " WHERE rolename = ".$role."" : " " ;
	$res=$classObj->Sort_Users($condition);
}
?>
 To User : 
<select name="t_user" id="t_user">
<option value="" >All</option>
<?php 
if($res)
	{
		foreach($res as $results) 
		{
			echo '<option value="'.$results['id'].'">'.$results['name'].'</option>';
		}
	}
	else
	{
		echo '<option value=" ">No users</option>';
	}

?>
</select>