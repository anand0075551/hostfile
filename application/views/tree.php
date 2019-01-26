<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu15='class="active"';

$userid=mysql_fetch_array(mysql_query("select * from mlm_register where user_status='0' order by user_id asc"));

?>
<style>
.label.arrowed-in:before
{

padding:10px;
}
.label.arrowed-in-right:after
{
padding:10px;
}

</style>
<style type="text/css">
	.numwraper {
		position: relative;
		width: 65px;
		height: 65px;
	}
	
	.numwraper img {
		width: 100%;
		height: 100%;
	}
	
	.numwraper span {
		position: absolute;
		right: 34%;
		top: 31%;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-weight:bold;
		font-size: 12px;
		background-color: #FFF;
		padding: 0px 2px 0px 2px;
		display: block;
	}
</style>
<style type="text/css">
 a.tooltipp 
 {
 outline:none;
 opacity: 1;
  } 
 a.tooltipp strong 
 {
 line-height:30px;
 } 
 a.tooltipp:hover 
 {
 text-decoration:none;
 } 
 a.tooltipp span 
 {
  z-index:10;display:none; 
  padding:14px 20px;
   margin-top:-30px; 
   margin-left:10px; 
   width:300px;
    line-height:16px;
	 } 
	 a.tooltipp:hover span
	 { 
	 display:inline;
	  position:absolute; 
	 color:#111;
	  border:1px solid #DCA;
	   background:#fffAF0;} 
	   .callout {
	   z-index:20;
	   position:absolute;
	   top:30px;
	   border:0;
	   left:-12px;
	   } 
	   /*CSS3 extras*/
	    a.tooltipp span { 
		border-radius:4px;
		 -moz-border-radius: 4px;
		  -webkit-border-radius: 4px; 
		  -moz-box-shadow: 5px 5px 8px #CCC;
		   -webkit-box-shadow: 5px 5px 8px #CCC;
		    box-shadow: 5px 5px 8px #CCC;
			 }
 </style>
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include("includes/sidebar.php"); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="dashboard.php">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<!--<li>
							<a href="#">binary tree</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>-->
						<li class="active">Binary Tree</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						BINARY  VIEW
						
						</h1>
					</div><!--/.page-header-->

<div class="row-fluid">
					
					
					<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px #3399FF solid; ">
			<tr>
			<td align="center" style="color:#006633; font-size:16px; font-weight:bold; border:1px #3399FF solid;"> BINARY  STRUCTURE</td>
			</tr>
			<tr>
			<td align="center" valign="bottom" style=" border:1px #3399FF solid;"><img src="images/no-blue.jpg" width="64" height="77" /><br />	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="forgotlink tooltipp" >
			
					  <?php 
					  $userid=(isset($_REQUEST['userid']))? $_REQUEST['userid'] :$userid['user_profileid'];
					  
					  $getuser=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$userid'"));
					  
					  echo GetUserNameFromId($userid) ;?><span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNameFromId($userid); ?> Details</div>
					  
					  <div style="padding-top:5px;">
	<div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNameFromId($userid); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $userid; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					
					<div>
					<div style="float:left; width:150px;" align="left"> Sponsor Name : <b> <?php echo $getuser['user_sponsername']; ?> </b></div>
					<div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuser['user_placementid']; ?></b></div>
					<div style="clear:both;">&nbsp;</div>
					</div>
					   
	<div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuser['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuser['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					  </div>
					  </span>
					  
					 </a> <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 0</span></td>
                    </tr>
                    
                   
                    <tr>
                      <td align="center" style=" border:1px #3399FF solid;">
					  <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border-collapse:collapse; ">
                        <tr>
                          <td width="30%" align="right" valign="top"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L1</span></div></td>
                          <td width="32%">&nbsp;</td>
                          <td width="30%" align="left" valign="top"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R1</span></div></td>
                        </tr>
                        <tr>
                          <td height="25" align="right" valign="middle">
						  <div style="width:70px;" align="center">
						  <?php if(GetUserIDPosFromId($userid,"L")=='0')
						  { ?>
						  <a href="add_user1.php?sppid=<?php echo $userid; ?>&pppid=<?php echo $userid;?>">
						  <?php 
						    echo GetUserNamePosFromId($userid,"L") ;
							?>
							</a>
							<?php }
							else {
							
							?>
						  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId($userid,"L");?>" class="forgotlink tooltipp">
						  <?php
						 
                          echo GetUserNamePosFromId($userid,"L") ;
						  $leftid=GetUserIDPosFromId($userid,"L");
		  $getuserleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$leftid'"));
						  
						   ?><span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId($userid,"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId($userid,"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId($userid,"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b> <?php echo $getuserleft['user_sponsername']; ?> </b></div>
					    <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserleft['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					 
					  
					  </div>
					  </span>
						   
						  </a>	
						  <?php } ?>
						  </div>
						  </td>
                          <td>&nbsp;</td>
                          <td align="left" valign="middle">
						   <div style="width:70px;" align="center">
						   <?php if(GetUserIDPosFromId($userid,"R")=='0')
						  { 
						    echo GetUserNamePosFromId($userid,"R");
							}
							else { ?>
						   <a href="binary_tree.php?userid=<?php  echo GetUserIDPosFromId($userid,"R") ;?>" class="forgotlink tooltipp">
						  <?php
						 
                          echo GetUserNamePosFromId($userid,"R") ;
						  
						    $rightid=GetUserIDPosFromId($userid,"R");
		  $getuserright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rightid'"));
						  
						  ?><span style="font-size:12px; margin-left:-150px; margin-top:15px; "><!--<img class="callout" src="images/callout.gif" />-->  <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId($userid,"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId($userid,"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId($userid,"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b> <?php echo $getuserright['user_sponsername']; ?> </b></div>
					    <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserright['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					
					  
					  </div>
					  </span>
						  </a>	
						  <?php } ?>
						  </div>
						  </td>
                        </tr>
                      </table>
					  <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>
					  
					  </td>
                    </tr>
                    
                    <tr>
                      <td align="center" style=" border:1px #3399FF solid;">
					  
					  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td width="25%" align="right" valign="top"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L2</span></div></td>
                          
                          <td width="16%" align="right" style="padding-left:10px;"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L3</span></div></td>
						   <td width="18%">&nbsp;</td>
                          <td width="15%" align="left" valign="top"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R2</span></div></td>
					
                          <td width="15%" align="right" style="padding-right:20px;"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R3</span></div></td>
						  <td width="20%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right" valign="top"><table width="97%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                              <td width="25%" align="right"> 
							   <div style="width:60px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"L") ;
							}
							else { ?>
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L") ;?>" class="forgotlink tooltipp">
							  <?php 
							  echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"L")  ;
							    $lleftid=GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L");
		  $getuserlleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lleftid'")); 
							  ?>	
							 
							   <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserlleft['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserlleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					
					  
					  </div>
					  </span>
							    </a>	 
							   <?php } ?>						 
							  </div> 
							  
							  </td>
                              <td width="20%" align="right">
							   <div style="width:60px;" align="center">
							      <?php if(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"R") ;
							}
							else { ?>
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R") ;?>" class="forgotlink tooltipp">
							  <?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"R") ;
							  
							    $lrightid=GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R");
		  $getuserlright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lrightid'")); 
							  ?>
							  
							  
							   <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"L"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					   <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserlright['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserlright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					   
					  
					  </div>
					  </span>
							    </a>
							  	
							  <?php } ?>	
							  </div>
							  </td>
                              <td width="30%" align="right">
							   <div style="width:60px;" align="center">
							<?php if(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"L") ;
							}
							else { ?>
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L") ;?>" class="forgotlink tooltipp">
							  <?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"L") ;
							   $rleftid=GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L");
		  $getuserrleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rleftid'")); 
							  ?>
							  <span style="font-size:12px; margin-left:-150px; margin-top:20px;">
							  <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					     <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
				<div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserrleft['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserrleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>	 
					  
					 
					  
					  </div>
					  </span>
							    </a>
							  	
							  <?php } ?>	
							  </div>
						      </td>
                              <td width="25%" align="left" style="padding-left:100px">
							  
							   <div style="width:40px;" align="center">
							       <?php if(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"R") ;
							}
							else { ?>
							   
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"R") ;
							$rrightid=GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R");
		                     $getuserrright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rrightid'"));
							   
							   ?>
							   <span style="font-size:12px; margin-left:-220px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($userid,"R"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserrright['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserrright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>	 
					  
					 
					  
					  
					  </div>
					  </span>
							    </a>
							   
							   <?php } ?>
							   </div>
						      </td>
                            </tr>
                          </table> </td>
                          </tr>
                      </table><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 2</span></td>
					    
                    </tr>
                   
                    <tr>
                      <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td width="20%" align="right" style="padding-right:5px;"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L4</span></div></td>
                          <td width="9%" align="right"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L5</span></div></td>
                          <td width="9%" align="right"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L6</span></div></td>
                          <td width="9%" align="right" style="padding-left:15px;"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L7</span></div></td>
						  
						  
                          <td width="14%" align="right"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R4</span></div></td>
                          <td width="11%" align="left" style="padding-left:30px;"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R5</span></div></td>
                          <td width="10%"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R6</span></div></td>
                          <td width="18%"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R7</span></div></td>
                        </tr>
                        <tr>
                          <td colspan="8"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                              <td width="17%" align="right">
							   <div style="width:70px;" align="center">
							   
							      <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L") ;
							
							
							}
							else { ?>
							   
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L") ;?>" class="forgotlink tooltipp"><?php
							  echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L") ;
							  
							  $llleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L");
		                     $getuserllleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$llleftid'"));
							  
							  ?>
							  <span style="font-size:12px; "><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
			          <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserllleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserllleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserllleft['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserllleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>	 
					 
					  
					  
					  </div>
					  </span>
							    </a>
							  <?php } ?>
							  </div>
							  </td>
                              <td width="10%" align="right">
							  
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R") ;
				
							}
							else { ?>
							   
							   <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R") ;?>" class="forgotlink tooltipp"><?php
							   
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R") ;
							   
							   	$llrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R");
		                     $getuserllright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$llrightid'"));
							   
							   ?>
							    <span style="font-size:12px; "><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"L"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserllright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserllright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserllright['user_profileid']); ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserllright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					
					  
					  
					  </div>
					  </span>
							   </a>
							   <?php }?>
							   </div>
							   
							   
						      </td>
                              <td width="10%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L") ;
							}
							else { ?>
							   <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L") ;?>" class="forgotlink tooltipp">
							   <?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L") ;
							   
							   $lrleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L");
							  
		                     $getuserlrleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lrleftid'"));
							   ?>
							    <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					    <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlrleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlrleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					
		<div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserlrleft['user_profileid']); ?> </b></div>
			<div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserlrleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					
					
					  
					  
					  </div>
					  </span>
							   
							   </a>	
							   <?php } ?>
							   </div>	
						      </td>
                              <td width="11%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R") ;
							}
							else { ?>
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R") ;
							   
							   $lrrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R");
		                     $getuserlrright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lrrightid'"));
							   
							   ?>
							    <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					    <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlrright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlrright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserlrright['user_profileid']); ?> </b></div>
			<div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserlrright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					 
					  
					  </div>
					  </span>
							   </a>	
							   <?php } ?>
							   </div>	
						      </td>
                              <td width="13%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L") ;
							}
							else { ?>
							 <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L") ;
							   
							   $rlleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L");
		                     $getuserrlleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rlleftid'"));
							   
							   
							   ?>
							   
							    <span style="font-size:12px; margin-left:-200px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					   <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrlleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrlleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					 
					 <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserrlleft['user_profileid']); ?> </b></div>
			<div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserrlleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					 
					 
					  
					  
					  </div>
					  </span>
							   </a>
							   <?php } ?>
							   </div>	
						      </td>
                              <td width="12%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R") ;
							}
							else { ?>
							  <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R") ;
							     
							 $rlrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R");
		                     $getuserrlright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rlrightid'"));
							   
							   
							   ?>
							   <span style="font-size:12px; margin-left:-200px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"L"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrlright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrlright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
			<div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserrlright['user_profileid']); ?> </b></div>
			<div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserrlright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					  
					  
					  
					
					  
					  </div>
					  </span> 
							   
							   </a>
							   <?php } ?>
							   
							   </div>
							   
						      </td>
                              <td width="8%" align="right">
							   <div style="width:70px;" align="center">
							   
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L") ;
							}
							else { ?>
							 <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L");
							   
							    $rrleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L");
		                     $getuserrrleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rrleftid'"));
							   
							   ?>
							    <span style="font-size:12px; margin-left:-220px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					   <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrrleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrrleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserrrleft['user_profileid']); ?> </b></div>
			<div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserrrleft['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					  
					  
					 
					  
					  </div>
					  </span>
							   </a>
							   <?php } ?>
							   </div>
						      </td>
                              <td width="19%" align="left" style="padding-left:30px;">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R") ;
							}
							else { ?>
							   <a href="binary_tree.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R") ;?>" class="forgotlink tooltipp"><?php
							   
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R") ;
							   
							    $rrrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R");
								
		                     $getuserrrright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rrrightid'"));
							   
							   ?>
							    <span style="font-size:12px; margin-left:-280px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"R"),"R"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					    <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrrright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrrright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
	<div style="float:left; width:150px;" align="left"> Left Count : <b> <?php echo lsponsor_count($getuserrrright['user_profileid']); ?> </b></div>
			<div style="float:left; width:150px;" align="left"> Right Count: <b><?php echo rsponsor_count($getuserrrright['user_profileid']); ?></b></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
					  
					  
					  
					  </div>
					  </span>
							   
							   </a>	
							    <?php } ?>
							    </div>
						      </td>
                            </tr>
                          </table></td>
                          </tr>
                      </table><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 3</span></td>
                    </tr>
			</table>
					
					
					 <!--    <div class="control-group">
						
							<label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">NOMINEE INFORMATION </label>

						  </div>
						  -->
						  

							


								<div class="form-actions">
<!--									<button class="btn btn-info" type="button">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button>
-->				<!--	<a href="user_edit.php?edit=<?php //echo $_REQUEST['detail']; ?>" class="btn btn-info" style="font-weight:bold;">EDIT</a>-->
									

									&nbsp; &nbsp; &nbsp;
									<!--<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										Reset
									</button>-->
									
										<a onclick="javascript: window.history.back();" class="btn" style="font-weight:bold;">BACK</a>
									
								</div>

					
</div>
						  
					</div>

						
		<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/flot/jquery.flot.min.js"></script>
		<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
			
			
			
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaings",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			
			  var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
			
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').slimScroll({
					height: '300px'
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
		</script>

	
	</body>
</html>
