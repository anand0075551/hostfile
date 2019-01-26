
<style>
.button {
    background-color: #0066CC; /* Green */
    border: none;
    color: white;
    padding: 8px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
	table 
	{
		
		border-collapse: collapse;
	}
	
	table, td, th 
	{
		border: 1px solid black;
		padding: 5px;
	}
	
	th 
	{text-align: left;
	}
	#dleft { float:left }
#dright { float:right }
</style>

<?php 
include_once('report.class.php');  
       
$classObj = new ReportClass();

if(!empty($_GET))
{
	$role = $_GET['role'];
	//Select users under given role
	$condition=($role !='all' ) ? " WHERE rolename = ".$role."" : " " ;
	$res=$classObj->Sort_Users($condition);
	
?>
<table width="100%">
<tr>
<td bgcolor="#CCCCCC">Single User : <input type="radio" name="check_user" value="0" checked onClick="check_user(this.value)"></td>
<td bgcolor="#CCCCCC">Between User : <input type="radio" name="check_user" value="1" onClick="check_user(this.value)"></td>
</tr>
<!--SINGLE USER-->
<tr id="single">

<th><font color="#0000CC"> Select User:</font></th>
<td>search <input type="text" id="realtxt" onkeyup="javascript:searchSel();"/></td>
<td>
<select name="r_user" id="r_user">
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
</td>
</tr>
<!--BETWEEN USER-->
<tr id="between" style="display:none;">

<td><font color="#0000CC">
<b> Select From User: </b></font>
<select name="f_user" id="f_user">
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
</td>
<td>
<font color="#0000CC">
<b>Role : </b></font>
 
<select name="role" id="role">
                 <option value="all">All</option>
                 <?php $res_roles=$classObj->List_roles();
				 foreach($res_roles as $results)
				{ 
					echo '<option value="'.$results['id'].'">'.$results['rolename'].'</option>';
				} ?>
                 </select><br />
                <font color="#0000CC"> <b>To User : </b></font>
                <div id="btw_user">
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
</div>
</td>
</tr>
</table>
<?php } ?>