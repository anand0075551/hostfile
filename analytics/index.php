<?php
include_once('report.class.php');  
       
$classObj = new ReportClass();


?>
<!DOCTYPE html PUBLIC "">
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporting</title>
<link rel="stylesheet" href="datepicker/jquery-ui.css"><!-- DATE PICKER -->
<!-- Style -->
<style>
.button 
{
    background-color: #0066CC; /* blue */
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
table 
{
    border-collapse: collapse;
	border: 1px solid black;
    width: 100%;
	
}

th, td 
{
	
    text-align: left;
    padding: 8px;
	width:30%;
}

tr:nth-child(even)
{
	background-color: #f2f2f2
}
div 
{
   
    float: left;
	
}
#left 
{
    width:48%;
    margin: 5px;
}

#right 
{
    margin: 5px;
    width: 48%;
}
</style>
<!-- Style Ends -->
<!--****** SCRIPT  ******--> 

<!--BETWEEN TO USER ON ROLE CHANGE-->
<script>
	function select_user(role)
	{
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("btw_user").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","select_user.php?role=" + role ,true);
		
		xmlhttp.send();
	}
</script>
 <!--between user role selection ends-->
<!-- Check SINGLE OR B/W User-->
<script>
	function check_type(type) 
	{
		if(type == 1)
		{
			$('#single').hide();
			$('#between').show();
		}
		if(type == 0)
		{
			$('#single').show();
			$('#between').hide();
		}
	}
</script>
        <!--SINGLE or BETWEEN user DIV ON ROLE CHANGE-->
<script>

	function user_sort(role) 
	{
		if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("sort_user").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","sort_user.php?role=" + role ,true);
			
			xmlhttp.send();
	}
</script>
<!-- NAME or REF.CODE SEARCHING FOR SINGLE USER -->
<script>
function single_sele(sngle)
{
	var role=document.getElementById("sngle_role").value;
	
	$.ajax({
		   type: "POST",
		   url: "name_fetch.php",
		   data: "data="+sngle + "&role=" + role,
		   success: function(msg){	
			if(msg != 0)
			  $("#sele_single").fadeIn("slow").html(msg);
			else
			{
			  $("#sele_single").fadeIn("slow");	
			  $("#sele_single").html('<div style="text-align:left;">No Matches Found</div>');
			}
			$("#loading").css("visibility","hidden");
		   }
		 });
}
</script>
<!-- NAME or REF.CODE SEARCHING FOR B/W FROM USER -->
<script>
function btw_from_sele(btwn)
{
	document.getElementById("r_user").value='';
	var role=document.getElementById("sngle_role").value;
	
	$.ajax({
		   type: "POST",
		   url: "name_fetch_btw.php",
		   data: "data="+btwn + "&role=" + role,
		   success: function(msg){	
			if(msg != 0)
			  $("#sele_frm_btw").fadeIn("slow").html(msg);
			else
			{
			  $("#sele_frm_btw").fadeIn("slow");	
			  $("#sele_frm_btw").html('<div style="text-align:left;">No Matches Found</div>');
			}
			$("#loading").css("visibility","hidden");
		   }
		 });
}
</script>
<!-- NAME or REF.CODE SEARCHING FOR B/W TO USER -->
<script>
function btw_to_sele(btwn)
{
	var role=document.getElementById("role2").value;
	
	$.ajax({
		   type: "POST",
		   url: "name_fetch_btw2.php",
		   data: "data="+btwn + "&role=" + role,
		   success: function(msg){	
			if(msg != 0)
			  $("#btw_user").fadeIn("slow").html(msg);
			else
			{
			  $("#btw_user").fadeIn("slow");	
			  $("#btw_user").html('<div style="text-align:left;">No Matches Found</div>');
			}
			$("#loading").css("visibility","hidden");
		   }
		 });
}
</script>
 <!--FILTERING-->
<script>
	function listUser() 
	{
		var points_mode=document.getElementById("points_mode").value;
		var role=document.getElementById("role").value;
		var pay_type=document.getElementById("pay_type").value;
		var created_at=document.getElementById("created_at").value;
		var created_from=document.getElementById("from_date").value;
		var created_to=document.getElementById("to_date").value;
		var r_user=document.getElementById("r_user").value;
		var f_user=document.getElementById("f_user").value;
		var t_user=document.getElementById("t_user").value;
		
		
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("dvData").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","list_users.php?pm=" + points_mode +"&r=" + role + "&pt=" + pay_type + "&cdt=" + created_at + "&cf=" + created_from + "&ct=" + created_to + "&r_user=" + r_user + "&f_user=" + f_user + "&t_user=" + t_user ,true);
		
		xmlhttp.send();
		//CALL FUNCTION TO CHANGE GRAPH VALUE UPON SEARCH(in graph.php)
		graph_refresh();
	}
</script>
<!--FILTERING Ends-->
<!--PDF EXPORT-->
<script type="text/javascript">
	var doc = new jsPDF();
	var specialElementHandlers = {
	'#editor': function (element, renderer) {
	return true;
	}
	};
	
	$(document).ready(function() {
	$('#btn').click(function () {
	doc.fromHTML($('#dvData').html(), 0, 0, {
	'width': 170,
	'elementHandlers': specialElementHandlers
	});
	doc.save('sample-content.pdf');
	});
	});
</script>
<!--PDF EXPORT Ends-->

<!--****** SCRIPT Ends *******-->  
</head>

<body>

<div id="left">
    <table width="100%">
        <tr>
        <th bgcolor="#66FFCC"></th>
        <th bgcolor="#66FFCC"><font color="#666666">SEARCH FORM</font></th>
        </tr>
        <tr>
            <th>Select Points Mode </th>
            <td>
                <select name="points_mode" id="points_mode">
                 <option value="all">All</option>
                 <?php $res_points_mode=$classObj->List_points_mode();
                 foreach($res_points_mode as $results)
                { 
                    echo '<option value="'.$results['points_mode'].'">'.$results['points_mode'].'</option>';
                } ?>
                 </select>
            </td>
          </tr>
           <tr> <th>Select Role </th>
                <td>
                    <select name="role" id="role" onchange="user_sort(this.value)">
                     <option value="all">All</option>
                     <?php $res_roles=$classObj->List_roles();
                     foreach($res_roles as $results)
                    { 
                        echo '<option value="'.$results['id'].'">'.$results['rolename'].'</option>';
                    } ?>
                     </select>
                </td>
            </tr>
            <!--DO NOT DELETE TR FOR SINGLE OR BETWEEN USER SORTING -->
            <tr id="sort_user">
            
            <input type="hidden" value="" id="r_user"  />
            <input type="hidden" value="" id="f_user"  />
            <input type="hidden" value="" id="t_user"  />
            </tr>
            <tr><th>Division/Pay-Type  </th>
                <td>
                    <select name="pay_type" id="pay_type" >
                     <option value="all">All</option>
                     <?php $pay_type=$classObj->List_pay_type();
                     foreach($pay_type as $results)
                    { 
                        echo '<option value="'.$results['id'].'">'.$results['name'].'</option>';
                    } ?>
                     </select>
                </td>
            </tr>
           <tr> 
               <th>Created At</th>
                <td>
                    <input type="text" name="created_at" id="created_at"  />
                </td>
            </tr>
            <tr> 
                <th>Created Date From</th>
                <td>
                    <input type="text" name="from_date" id="from_date"  />
                
                <b>Created Date To</b>
                
                    <input type="text" name="to_date" id="to_date"  />
                </td>
            </tr>
            <tr><td></td><td><input type="button" name="go" value="Go" onclick="listUser()" class="button"/></td></tr>
    </table>
</div>

<div id="right">
   <?php include('graph.php');?>
</div>

<?php 

//Listing 
$condition="";
$f_user="";
$t_user="";
$r_user="";
$res=$classObj->List_accounts($condition,$r_user,$f_user,$t_user);
?>

  
</body>
</html>
<!--DATE PICKER-->
<script src="datepicker/jquery-1.12.4.js"></script>
<script src="datepicker/jquery-ui.js"></script>
<script>
	$( function() {
	$( "#created_at" ).datepicker();
	$( "#from_date" ).datepicker();
	$( "#to_date" ).datepicker();
	} );
</script>
<!--DATE PICKER ends-->
