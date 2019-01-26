<?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];
$c_user = get_profile();
$currentUserrole = $c_user->rolename;

?>
<!-- Anand Translator -->
<!DOCTYPE html>

<html lang="en-US">
<head>



    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo str_replace('_',' ',$title).' | '; ?>Admin</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	
	
	
	
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <?php if(function_exists('page_css')) page_css() ; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="<?php echo base_url('dashboard'); ?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <?php echo get_option('company_name'); ?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
		
            <ul class="nav navbar-nav">
			
			
			 <!-- Notifications: style can be found in dropdown.less for Switching Menu- ->
			 
			 < ?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentRolename = singleDbTableRow($user_id)->rolename;
if($currentRolename == 11)
{
?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-exclamation-triangle"></i>
              <span class="label label-warning">2</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Switch Left Menu</li>
              <li>
                <!-- inner menu: contains the actual data - ->
                <ul class="menu">
                  <li>
                    <a href="< ?php echo base_url('welcome/default_menu') ?>">
                      <i class="fa fa-warning text-yellow"></i> Default Menu
                    </a>
                  </li>
                  <li>
                    <a href="< ?php echo base_url('welcome/dynamic_menu') ?>">
                      <i class="fa fa-warning text-yellow"></i> Dynamic Menu
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
< ?php } ?> 	-->


	<!-------------------------------Dynamic menu -------------------------------->	
					<?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentRolename = singleDbTableRow($user_id)->rolename;

$get_menu_type = $this->db->get('menu_type');
foreach($get_menu_type->result() as $m);
$menu_type = $m->menu_type;
$admin_switch = $m->admin_switch;

if($currentRolename == 11)
{
?>

					
		          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-exclamation-triangle"></i>
              <span class="label label-warning">4</span>
            </a>
            <ul class="dropdown-menu" >
              <li class="header">Switch Left Menu</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li <?php if($menu_type == "default_menu"){ ?> class="bg-aqua"  <?php } ?>>
                    <a href="<?php echo base_url('welcome/default_menu') ?>" <?php if($menu_type == "default_menu"){ ?> style="font-weight:bold;" <?php } ?>>
                      <i class="fa fa-smile-o bg-maroon"  style="background:red;"></i>Default To All
                    </a>
                  </li>
                  <li <?php if($menu_type == "dynamic_menu"){ ?> class="bg-aqua" <?php } ?>>
                    <a href="<?php echo base_url('welcome/dynamic_menu') ?>" <?php if($menu_type == "dynamic_menu"){ ?> style="font-weight:bold;" <?php } ?>>
                      <i class="fa fa-bell bg-maroon"></i> Dynamic To All
                    </a>
                  </li>
				  
				  <li <?php if($admin_switch == 3){ ?> class="bg-aqua" <?php } ?>>
                    <a href="<?php echo base_url('welcome/default_admin_menu') ?>" <?php if($admin_switch == 3){ ?> style="font-weight:bold;" <?php } ?>>
                      <i class="fa fa-rocket  bg-blue"></i> Default To Admin Only
                    </a>
                  </li>
				  <li <?php if($admin_switch == 4){ ?> class="bg-aqua" <?php } ?>>
                    <a href="<?php echo base_url('welcome/dynamic_admin_menu') ?>" <?php if($admin_switch == 4){ ?> style="font-weight:bold;" <?php } ?>>
                      <i class="fa fa-gear  bg-blue"></i> Dynamic To Admin Only
                    </a>
                  </li>
				  
                </ul>
              </li>
              <li class="footer"><a href="">Close</a></li>
            </ul>
          </li>
		  
<?php } ?> 
<!-------------------------------Dynamic menu close-------------------------------->	  
<!--  CLOCKING  Start-------------------------------------------------------------------------------------------------------------->
<?php
$alert1 = $this->db->get_where('clocking_role',['status'=>'1']);
if ($alert1->num_rows() > 0) {
foreach ($alert1->result() as $role) {
    $g2 = $role->rolename;
	}    ?>

  	<?php	if($currentRolename == $g2)
{		 ?>
		<!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-clock-o"></i>
              <span class="label label-warning">!</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Clock In & Out</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>


	<?php
	$clock = $this->db->get_where('clocking_user',['role_id'=>$user_id]);
	if ($clock->num_rows() > 0) {
		foreach ($clock->result() as $r1){
			?>
			 <a href=" <i class="fa fa-clock-o text-blue" data-toggle="modal" data-target="#myClock" data-backdrop="static" data-keyboard="false"> </i> 
                      <i class="fa fa-clock-o text-blue"></i> Daily Clocking
                    </a>
			<?php
		}
	}else{
		?>
		
				<a href=" <i class="fa fa-clock-o text-blue" data-toggle="modal" data-target="#myClock" data-backdrop="static" data-keyboard="false"> </i> 
                      <i class="fa fa-clock-o text-blue" ></i> Accept Clocking Rules
                    </a>	
		
	<?php	
	}
	?>
					
                  </li>
				    <li>
                    <a href="<?php echo base_url('welcome/clocking_list') ?>">
                      <i class="fa fa-file text-yellow"></i>View All Status
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>  
<?php } }?>
		  <!-- Modal -->
<div id="myClock" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Clock!</h4>
      </div>
      <div class="modal-body" align="center">
	 
        <p>Hi  <?php echo $name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;  ?>, Good Day!</p>
		<canvas id="canvas" width="200" height="200" style="background-color:#333" >
		</canvas>

		 <div class="align-center">
		 <input type="hidden" name="currentRolename" id="currentRolename" class="form-control" value="<?php echo $currentRolename ?>">
		<input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo $user_id ?>">

			<?php
	$clock = $this->db->get_where('clocking_user',['role_id'=>$user_id]);
	if ($clock->num_rows() > 0) {
		foreach ($clock->result() as $r1){
			?>
			
			
			
			
			
	<?php  $status1 = $this->db->get_where('clocking_user',['role_id' =>$user_id]);
		foreach ($status1->result() as $r1) {
												$g1 = $r1->status;
											}
	if ($g1 == '0') {
	?>		
		<a href="" class="btn btn-success btn-block" onclick="clock_in()"  >Clock In</a>
	<?php } else{ ?>
	    <a href="" class="btn btn-danger btn-block"  onclick="clock_out()" >Clock Out</a>
		
	<?php }}	}else{		?>
		<h2>	Clocking Rules & Regulation	</h2>
		<h3>Do's and Don'ts</h3>
		<p>Do's</p>
		<p>1.Please Login Regularly</p>
		<p>2.Logout At Interval Time</p>
		<p>3.Please Login At Office Premises</p>
<br>
		<p>Don'ts</p>
		<p>1.Do Not Forget to logout for the day</p>
		<p>2.Do Not Login using Mobile Device </p>
		<a href="" class="btn btn-success btn-flat" onclick="accept_clocking()" >I Accept</a>

		

	
	<?php	
	}
	?>
         </div>
		<div id="timestamp"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--  CLOCKING ENds --------------------------------------------------------------------------------------------------------->
			<!-----------------Event Management Notification Begins -->
            <?php  if($currentUserrole == 11 || $currentUserrole == 39 ){    ?>
            <?php 
			$EM_cnt = 0;
			$table_name = "em_events";	
			$where_array = " start_date <= (now() + INTERVAL 7 DAY) AND send_notify = 0 ";	
			$query = $this->db->where($where_array )->get($table_name); 
			if (!empty($query) && $query->num_rows() > 0) 
			{
				
			?>
            <li class="dropdown notifications-menu" title="Event Management">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $query->num_rows();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"> <font color="#009900"><?php echo $query->num_rows();?></font> Events Sheduled for tomorrow</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php
				foreach($query->result() as $r)
				{
				$EM_event = $r->event;
				$where_array2 = " event = '".$EM_event."'  ";
				$query2 = $this->db->where($where_array2)->count_all_results('em_users');
				$EM_cnt = $EM_cnt + $query2;
				?>
                   <li>
                    <a href="<?php echo base_url('Event_management/event_view/' . $EM_event);?>">
                      <i class="fa fa-users text-red"></i> <?php echo $query2 ;?> members joined
                    </a>
                  </li>
                  <?php } ?>
                  
                </ul>
              </li>
              <?php  if($EM_cnt != 0 ){ ?>
              <li class="footer"><input type="button" name="bidding_select" id="s1"  class="btn btn-primary form-control" value="Notify Now" onClick="send_notification()"></li>
              <?php } ?>
            </ul>
          </li>
          <?php } } ?>
            <!-----------------*/Event Management Notification/* -->





  <!-- User Account: style can be found in dropdown.less -->
				
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
				<?php  if($currentUser == 'admin' or $currentUser == 'user'){    ?>		
                        <span><?php echo $c_user->first_name .' '.$c_user->last_name; ?>
				<?php }else{ ?>	
						<span><?php echo $c_user->company_name; ?>
				<?php }?>	
                            <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="<?php echo profile_photo_url($c_user->photo, $c_user->email); ?>" class="img-circle" alt="User Image" />
                        
						<p>
						<?php  if($currentUser == 'admin' or $currentUser == 'user'){   	
                                 echo $c_user->first_name .' '.$c_user->last_name. ' <br />'; 
						 }else{ //Displaying Company for Agent Type Users
								echo $c_user->company_name. ' <br />'; ; 
						 }	
                                  //  echo $c_user->profession;
								      	$roleName2 = typeDbTableRow($c_user->rolename)->rolename;
												echo 'User Type-'.$roleName2 ;
                                ?>
                                <small>Member since <?php echo date('M, Y',$c_user->created_at); ?></small>
                            </p>
                        </li>


                        <!-- helper links -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo base_url('activity'); ?>">Activity</a>
               
			  
							</div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo base_url('product'); ?>">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="<?php echo base_url('user/log') ?>">Log</a>
                            </div>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url('user/profile') ?>" class="btn btn-default btn-flat">My Profile</a>
                            </div>
						<?php 
							$user_info = $this->session->userdata('logged_user');
							$user_id = $user_info['user_id'];	
							$user_root_id  = singleDbTableRow($user_id)->root_id;	
							if($user_root_id !=""){
						?>
							<div class="pull-left">
                            <button data-toggle="modal" data-target="#swich_user_modal" class="modal-trigger button btn btn-primary btn-flat" >Switch User</button>
                            </div>
						<?php } ?>
                            <div class="pull-right">
                                <a href="<?php echo base_url('dashboard/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<style>
            #my_img:hover{
                -webkit-transform:scale(3);
                -ms-transform:scale(3);
                webkit-transform:scale(3);
            }
        </style>

		
<div class="wrapper row-offcanvas row-offcanvas-left">

   <!-- Permission to Switch menu -->
		
	<?php 
		
		if($currentRolename == 11){
			if($admin_switch == 0){
				if($menu_type == "default_menu"){
					include('admin_left_menu.php');
				}
				else{
					include('admin_left_menu_dynamic.php');
				}
			}
			elseif($admin_switch == 3){
				include('admin_left_menu_default.php');
			}
			elseif($admin_switch == 4){
				include('admin_left_menu_dy.php');
			}
		}
		else{
			if($menu_type == "default_menu"){
				include('admin_left_menu.php');
			}
			else{
				include('admin_left_menu_dynamic.php');
			}
		}
	?>
			

	<!-------------------------------End of Permission to Switch  menu -------------------------------->


    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php if(isset($title)) echo ucfirst(str_replace('_',' ',$title)); ?>
                <small><?php if(isset($small_title)) echo ucfirst($small_title); ?></small>
            </h1>
            <?php echo breadcrumb(); ?>
        </section>

        <?php echo flash_msg(); ?>
		
		
		
		
		
<?php
	if($user_root_id !=""){
?>	
	<!-- Modal -->
  <div class="modal fade" id="swich_user_modal" role="dialog" style="border-radius:10px;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc; border-radius:5px 5px 0px 0px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><font color="white">Switch To Another User</font></h4>
        </div>
        <div class="modal-body row">
        <?php
		  
		//  echo $user_root_id; 
			$query = $this->db->group_by('rolename')->get_where('users', ['root_id' => $user_root_id]);
			foreach ($query->result() as $user_role)
				{ ?>
					<?php
								$get_user = $this->db->get_where('users', ['rolename' => $user_role->rolename, 'root_id' => $user_root_id]);
								foreach ($get_user->result() as $user){
							?>
				 <div class="col-lg-4">
						<!-- small box -->
						<div class="small-box bg-blue"  style="border-radius: 10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
							
							<div class="inner" style="min-height:75px;">
								<center>
								<?php if($user->photo != ""){?>
								 <img src="<?php echo profile_photo_url($user->photo, $user->email); ?>" style="height:55px; width:55px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" class="img-circle img-responsive" alt="User Image" />
								<?php } else {?>
								<img src="<?php echo base_url('uploads/3d-user-icon-silver.gif'); ?>" class="img-circle img-responsive" style="height:55px; width:55px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" alt="User Image" /> 
						
								<?php }?>
							
								
								</center>
							</div>
							
							<div class="inner" style="height:70px;">
								<h4 class="text-center">
									<?php 
										$get_role = $this->db->get_where('role', ['id' => $user_role->rolename]);
										foreach ($get_role->result() as $r);
										echo $r->rolename; 
									?>
								</h4>
							</div>
							
							<div class="inner text-center">
								<?php echo $user->referral_code.'('.$user->id.')';  ?>
								<br>
								<?php echo $user->email;  ?>
								
							</div>
						
								
							<a href="<?php echo base_url('welcome/switch_user/'.$user->id); ?>" class="small-box-footer"  style="border-radius: 0px 0px 10px 10px;">
								Switch  <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div><!-- ./col -->
				<?php } ?>
					
					
					
			<?php	}
		  ?>
        </div>
        <div class="modal-footer" style="background:lavender;  border-radius:0px 0px 5px 5px;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
<?php } ?>

<!--  CLOCKING JS Script Declarations ------------------------------------------------------>			
				
<script>
function accept_clocking()
	{
		var currentRolename = $("#currentRolename").val();
		var user_id = $("#user_id").val();
		var mydata = {"currentRolename":currentRolename, "user_id":user_id };
	//	alert(user_id);
		$.ajax({
			type:"POST",
			data:mydata,
			url: "<?php echo base_url('welcome/accept_clocking'); ?>",
			success:function(response){
				alert(response);
			}
		})
	}
function clock_in()
	{
		var currentRolename = $("#currentRolename").val();
		var user_id = $("#user_id").val();
		var mydata = {"currentRolename":currentRolename, "user_id":user_id };
	//	alert(user_id);
		$.ajax({
			type:"POST",
			data:mydata,
			url: "<?php echo base_url('welcome/clock_in'); ?>",
			success:function(response){
				alert(response);
			}
		})
	}
	function clock_out()
	{
		var currentRolename = $("#currentRolename").val();
		var user_id = $("#user_id").val();
		var mydata = {"currentRolename":currentRolename, "user_id":user_id };
	//	alert(user_id);
		$.ajax({
			type:"POST",
			data:mydata,
			url: "<?php echo base_url('welcome/clock_out'); ?>",
			success:function(response){
				alert(response);
			}
		})
	}
	
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2 * Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius * 0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius * 0.15 + "px arial";
  ctx.textBaseline = "middle";
  ctx.textAlign = "center";
  for (num = 1; num < 13; num++) {
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius * 0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius * 0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius) {
  var now = new Date();
  var hour = now.getHours();
  var minute = now.getMinutes();
  var second = now.getSeconds();
  //hour
  hour = hour % 12;
  hour = (hour * Math.PI / 6) +
    (minute * Math.PI / (6 * 60)) +
    (second * Math.PI / (360 * 60));
  drawHand(ctx, hour, radius * 0.5, radius * 0.07);
  //minute
  minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
  drawHand(ctx, minute, radius * 0.8, radius * 0.07);
  // second
  second = (second * Math.PI / 30);
  drawHand(ctx, second, radius * 0.9, radius * 0.02);
}

function drawHand(ctx, pos, length, width) {
  ctx.beginPath();
  ctx.lineWidth = width;
  ctx.lineCap = "round";
  ctx.moveTo(0, 0);
  ctx.rotate(pos);
  ctx.lineTo(0, -length);
  ctx.stroke();
  ctx.rotate(-pos);
}
</script>

 