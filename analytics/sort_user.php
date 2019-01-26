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
<td>
	Single User : <input type="radio" name="check_user" value="0" checked onClick="check_type(this.value)"><br />
    Between User : <input type="radio" name="check_user" value="1" onClick="check_type(this.value)">
</td>
<!--SINGLE USER-->
<td id="single">
    <table>
    <tr>
    <td>Enter Name /Ref.Code :<input type="text" name="single_sele" id="single_sele" onkeyup="single_sele(this.value)"/>
    	<input type="hidden" name="sngle_role" id="sngle_role" value="<?php echo $role;?>"/>
    </td>
    </tr>
    <tr id="sele_single"> 
    <td>
    Users: 
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
    </table>
</td>
<!--BETWEEN USER-->
<td id="between" style="display:none;">
	<table>
    <tr>
    <td>Enter Name /Ref.Code :<input type="text" name="btw_from" id="btw_from" onkeyup="btw_from_sele(this.value)"/></td>
    <td id="sele_frm_btw">Select From User:
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
    </tr>
    <tr>
    <td>
    	Role :<select name="role2" id="role2" onchange="select_user(this.value)">
                 <option value="all">All</option>
                 <?php $res_roles=$classObj->List_roles();
				 foreach($res_roles as $results)
				{ 
					echo '<option value="'.$results['id'].'">'.$results['rolename'].'</option>';
				} ?>
                 </select>
                 Enter Name /Ref.Code :<input type="text" name="btw_to" id="btw_to" onkeyup="btw_to_sele(this.value)"/>
                 
    </td>
     <td id="btw_user">
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
    </td>
    </tr>
    </table>
	
</td>
<?php } ?>