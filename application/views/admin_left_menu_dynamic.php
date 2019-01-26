<?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];
$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$email   = singleDbTableRow($user_id)->email;
	$currentRolename   = singleDbTableRow($user_id)->rolename;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo profile_photo_url($c_user->photo,$c_user->email); ?>" class="img-circle" alt="User Image" />
			</div>
			   <div class="pull-left info">
	<?php  if($currentUser == 'admin' or $currentUser == 'user'){    ?>		
            <p><?php echo $c_user->first_name .' '.$c_user->last_name; ?></p>
              <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
			<p><b><?php	echo $roleName2 = typeDbTableRow($c_user->rolename)->rolename; ?></b></p>
			<p><b><?php	echo 'User ID-'.$c_user->referral_code; ?></b></p>
	<!-- Displaying Company for Agent Type Users			-->
	<?php }else{ ?>		 
			 <p><?php echo $c_user->company_name; ?></p>
              <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
			<p><b><?php	echo $roleName2 = typeDbTableRow($c_user->rolename)->rolename; ?></b></p>
			<p><b><?php	echo 'User ID-'.$c_user->referral_code; ?></b></p>	
				
	<?php }?>										
            </div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li>
				<a href="<?php echo base_url('dashboard'); ?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<?php
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentRolename = singleDbTableRow($user_id)->rolename;
							
			/*			<!-- New Logic -->														  <!--
			* Step 1. Table1 'bg_assignment' get bg_id from  role_id and Active status.
			* Step 2. Table2 'role_permission' Get bgform_id , by passing 'role_id' and active 'bg_id' only
			* Step 3. Table 'bg_forms', get following data by passing 'bgform_id' -->
			*/
			$bg_id = "";
			$query = $this->db->order_by('alignment', 'asc')->get_where('menu_bg_assignment', ['role_id' => $currentRolename , 'active_status' => '1']);
			foreach ($query->result() as $perm)
			{
			$bg_id .= $perm->bg_id.",";
			}
			$bg_id1 = "";
			$test = explode("," , $bg_id);
			foreach($test as $t){
			$query2 = $this->db->group_by('bg_id')->get_where('menu_role_permission', ['role_id' => $currentRolename , 'permission' => '1', 'bg_id' => $t]);
			foreach($query2->result() as $d)
			{
			$bg_id1 .= $d->bg_id.",";
			
			}
			}
			$catg_name = "";
			$test1 = explode("," , $bg_id1);
			foreach($test1 as $t1){
			$query3 = $this->db->group_by('bg_id')->get_where('menu_bg_forms', ['bg_id' => $t1]);
			foreach($query3->result() as $d1)
			{?>
			<li class="treeview <?php echo menu_li_active($d1->controller); ?>">
				<a href="#">
					<i class="<?php echo ($d1->font); ?>"></i>
					<span><?php
						
						
						//	echo $d1->category_name
						$query = $this->db->order_by('alignment', 'asc')->get_where('menu_business_groups', ['id' => $d1->category_name]);
									
									if ($query->num_rows() > 0) {
						foreach ($query->result() as $row) {
						echo   $row->business_name;
										}
									} else {
						echo "Category Doesnot Exist";
						}
						
						
					?></span><i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					
					<?php $cat_name = $d1->category_name ?>
					<?php
						$bg_id = "";
						$query = $this->db->get_where('menu_bg_assignment', ['role_id' => $currentRolename , 'active_status' => '1']);
						foreach ($query->result() as $permission)
						{
							$bg_id .= $permission->bg_id.",";
						}
						$bg_id1 = "";
						$test = explode("," , $bg_id);
						foreach($test as $t){
								$query2 = $this->db->get_where('menu_role_permission', ['role_id' => $currentRolename ,  'permission' => '1']);
							foreach($query2->result() as $d)
							{
								if($d->bg_id == $t){
									$bg_id1 .= $d->bgform_id.",";
								}
							}
						}
					?>
					<?php
						$sub_catg = "";
							$get_sub_catg = $this->db->order_by('alignment', 'asc')->get_where('menu_bg_forms', ['category_name' => $cat_name]);
						foreach($get_sub_catg->result() as $catg){
							$bg_id2 = "";
							$test1 = explode("," , $bg_id1);
							foreach($test1 as $t1){
								if($t1 == $catg->bgform_id){
					?>
					
					
					<?php
						$quer = $this->db->get_where('menu_bg_forms', ['displayform_name' => $catg->displayform_name]);
								foreach($quer->result() as $dw)
								{
									foreach($test1 as $t1){
									if($t1 == $dw->bgform_id){
					?>
					
					<?php
					
						echo menu_link($dw->controller.'/'.$dw->phpfile_name,    $dw->displayform_name);
					
					?>
					
					<?php } } } ?>
					<?php
					
					
						}
					} }
					?>
					
					
					
				</ul>
			</li>
			<?php							}
			}          ?>
			
			
	<!-- Extra footer -->
	
	<?php  if($currentRolename != '11'){    ?>				
	 <li class="treeview <?php echo menu_li_active('lpa_purchase_redeem'); ?>">
	      <a href="#">
		<i class="fa fa-credit-card" aria-hidden="true"></i>
		<span>Loyality Gift Zone</span>
		<i class="fa fa-angle-left pull-right"></i>
	      </a>
	<ul class="treeview-menu">
				
<?php echo  "<a href='http://consumer1st.in/lpa_purchase' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Loyality Claims </a>"; ?> <br>	
		<?php echo menu_link('lpa_purchase_redeem/order_history', 'Redeem Voucher'); ?>
		<?php echo menu_link('lpa_purchase_redeem', 'LPA Claimed Invoice'); ?>
        <?php echo menu_link('lpa_purchase_redeem/reedem_invoice', 'LPA Redeemed Vouchers'); ?>
		

	</ul>
</li>
	<!-- Personal Note -->
            <li class="treeview <?php echo menu_li_active('Personal_note'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Personal Note</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <?php echo menu_link('Personal_note/personal_note_create', ' Create'); ?>
                    <?php echo menu_link('Personal_note/personal_note_list', 'List'); ?>

                </ul>

              </li>
            <!-- /Personal Note --> 
			
		
			
			<!--terms -->
            <li class="treeview <?php echo menu_li_active('term&condition'); ?>">	
                        <a href="#">
                            <i class="fa fa-check"></i>
                            <span>Terms & Conditions</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('Term_condition/accepted_term_condition', 'Accepted'); ?>
                         
                        </ul>
             </li>
		
	<li class="treeview <?php echo menu_li_active('support'); ?>">
                    <a href="#">
                        <i class="fa fa-life-ring"></i>
                        <span>Help Desk</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
						
                      <?php echo menu_link('support', 'All Ticket List'); ?>
                       <?php echo menu_link('support/add_support', 'Create New Ticket'); ?>
                       <?php echo menu_link('support/complete_support', 'Completed Ticket List'); ?>
                       <?php echo menu_link('support/not_complete', 'Pending Ticket List'); ?>
                      
                   </ul>
                </li>
	<?php } ?> 
	<!-- End of Footer	-->	
			
			<br><br><br>
			
			
			
		</ul>
	</section>
	<!-- /.sidebar
	< ?php creditsMhs(); ? > -->


<font size="4" color="red">
<?php echo 'Copyrights @ 2017 Consumerfirst Technoservices pvt Ltd';?> </font>
</aside>