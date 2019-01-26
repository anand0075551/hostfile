<?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];

$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];	
		$currentRolename   = singleDbTableRow($user_id)->rolename;


//user@example.com
//123456
//http://chaitanyatrust.com/mywallet/dashboard		

/*
		$currentFname   = singleDbTableRow($user_id)->first_name;
		$currentLname   = singleDbTableRow($user_id)->last_name;
		$currentEmail   = singleDbTableRow($user_id)->email;
		
*/

$loginName = 'user@example.com';
$pass      = '123456';
	
		
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
<!--Permissions
< ?php
/*
Roles
1- 	Supreme Administrator
2-	Manager Finance	
3-	Cash Dispatcher	

*/? -->

<!-- Language Selection-- >
				
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
			
                   <!--     <span>< ?php echo 'Language'; ?>
						<i class="caret"></i> </span>
				<div id="google_translate_element"></div>  -- >
                  
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -- >                     
                    </ul>
                </li> 
				End of Lang selection -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
			
			



 <!---- Product Preparation -->
 <?php  if ($currentRolename == '83' or $currentRolename == '11' or $currentRolename == '82' or $currentRolename == '84' )  {     ?> 	<!-- Main and Assistant  Chef -->
<!-- for Assistant-->
			
			  <li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
							
							
						<?php echo menu_link('Product_preparation/assistant_view_products', 'Start Production '); ?>				
						<?php echo menu_link('Product_preparation/add_product_packing_assign', 'Assign Packing'); ?>
							<?php echo menu_link('Product_preparation/list_assigned_products', ' List Assigned Product'); ?>
							
							<?php /* echo menu_link('Product_preparation/product_packaging', 'Pack Products ');  */?>
							<?php echo menu_link('Product_preparation/packing_advance', 'Packing Advance'); ?>
							<?php echo menu_link('Product_preparation/list_assigned_packs', 'List Assigned Packing '); ?>
							<?php echo menu_link('Product_preparation/product_prepared_report', 'Report on Product Prepared '); ?>
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
						
						</ul>
				
            </li>	
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-gavel"></i>
                    <span>Assign</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                           		<?php echo menu_link('Product_preparation/add_product_assign', 'Assign Product'); ?>
					 			<?php echo menu_link('Product_preparation/add_product_packing_assign', 'Assign Packing'); ?>
				                <?php echo menu_link('Product_preparation/assign_movement_products', 'Assign Movenent'); ?>
							 <?php echo menu_link('Product_preparation/assign_to_warehouse', 'Assign To Main Warehouse'); ?>
							 <?php echo menu_link('Product_preparation/assign_to_other_warehouse', 'Assign To Other Warehouse'); ?>
                </ul>
				
				
            </li>
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>List Assigned</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                           <?php echo menu_link('Product_preparation/list_assigned_products', ' List Assigned Product'); ?>
						   <?php echo menu_link('Product_preparation/list_assigned_packs', 'List Assigned Packing '); ?>
						   <?php echo menu_link('Product_preparation/list_assigned_movement', ' List Assign Movenent'); ?>
						   <?php echo menu_link('Product_preparation/list_assigned_warehouse', ' Main WareHouse'); ?>
						   <?php echo menu_link('Product_preparation/list_assigned_other_warehouse', 'Assigned Other ware house'); ?>
						  <?php echo menu_link('Product_preparation/report_warehouse', 'Available stock Warehouse'); ?>
                </ul>
				
				
            </li>
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa  fa-share"></i>
                    <span>Move To Inventory</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                            <?php echo menu_link('Product_preparation/add_moved_to_inventory', ' add_moved_to_inventory'); ?>
				
                </ul>
				
				
            </li>
		
			
			<li class="treeview <?php echo menu_li_active('inventory_stock'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Inventory Stock</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Inventory_stocks/add_inventory_stocks', ' Add Inventory Stocks'); ?>
							
							<?php echo menu_link('Inventory_stocks/report_inventory_stocks', ' Rerport Inventory Stocks'); ?>
						</ul>
            </li>
			
 <?php } ?>
 
 
  <?php  if ($currentRolename == '85' )  {     ?> 	<!--  Packer(Resto) -->
<!-- for Assistant-->
			
			  <li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
							
							<?php /* echo menu_link('Product_preparation/product_packaging', 'Pack Products '); */ ?>
							<?php echo menu_link('Product_preparation/packing_advance', 'Packing Advance'); ?>
							<?php echo menu_link('Product_preparation/list_assigned_packs', 'List Assigned Packing '); ?>
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
						
						</ul>
				
            </li>	
			
			
			
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-gavel"></i>
                    <span>Assign</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                           		
				                <?php echo menu_link('Product_preparation/assign_movement_products', 'Assign Movenent'); ?>
							
                </ul>
				
				
            </li>
				<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>List Assigned</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                         
						   
						   <?php echo menu_link('Product_preparation/list_assigned_movement', ' List Assign Movenent'); ?>
						  
						  
                </ul>
				
				
            </li>
		
			
			
 <?php } ?>
 
 <?php  if ($currentRolename == '88' )  {     ?> 	

<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
			
			
			
				
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-gavel"></i>
                    <span>Assign</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                           		
							 <?php echo menu_link('Product_preparation/assign_to_warehouse', 'Assign To Main Warehouse'); ?>
							
                </ul>
				
				
            </li>
			
		
	
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa  fa-share"></i>
                    <span>Move To Inventory</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                            <?php echo menu_link('Product_preparation/add_moved_to_inventory', ' add_moved_to_inventory'); ?>
                            <?php echo menu_link('Product_preparation/available_stock_inventory', ' available_stock_inventory'); ?>
				 <?php /* echo menu_link('Product_preparation/list_assigned_movement', ' List Assign Movenent'); */ ?>
				 <?php echo menu_link('Product_preparation/list_of_assigned_mainwarehouse', 'list Assigned Mainwarehouse'); ?>
                </ul>
				
				
            </li>
			
		
			
			
		
			
			
			
				
				         
													
						</ul>				
            </li>			
			
			
 <?php } ?>
 
 
 
 
 <?php  if ($currentRolename == '87' )  {     ?> 	<!-- Main Ware House Keeper -->

			
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-gavel"></i>
                    <span>Assign</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                           		
							 <?php echo menu_link('Product_preparation/assign_to_other_warehouse', 'Assign To Other Warehouse'); ?>
                </ul>
				
				
            </li>
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>List Assigned</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                          
						   <?php echo menu_link('Product_preparation/list_assigned_warehouse', ' Main WareHouse'); ?>
						 
						  <?php echo menu_link('Product_preparation/report_warehouse', 'Available stock Warehouse'); ?>
						  <?php echo menu_link('Product_preparation/list_of_assigned_otherwarehouse', 'list_of_assigned_otherwarehouse'); ?>
                </ul>
				
				
            </li>
		
		
			
		
 <?php } ?>  <!--  End Main Ware House Keeper -->
 
 
 <?php  if ($currentRolename == '89' )  {     ?> 	<!-- Other Ware House Keeper -->

			
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-gavel"></i>
                    <span>Assign</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                           		
							 <?php echo menu_link('Product_preparation/assign_to_other_warehouse', 'Assign To Other Warehouse'); ?>
                </ul>
				
				
            </li>
			<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>List Assigned</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                          
						   <?php echo menu_link('Product_preparation/list_assigned_other_warehouse', 'Assigned Other ware house'); ?>
						   <?php echo menu_link('Product_preparation/report_warehouse', 'Available stock Warehouse'); ?>
                </ul>
				
				
            </li>
		
		
			
		
 <?php } ?>  <!-- Other Ware House Keeper -->
<!----- End of Product Preparation New style --> 
           <!-- BIDDING -->
            <li class="treeview <?php echo menu_li_active('bidding'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Bidding</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php /*AM  EM */  if ($currentRolename == '18' || $currentRolename == '39')  {     ?> 
                <ul class="treeview-menu">
				
					<?php echo menu_link('bidding/bidding_list', ' Pending Requests'); ?>
					<?php echo menu_link('bidding/bidding_events', 'Events'); ?> 						
									
                </ul> 
                <?php } ?>
                <?php /*FM */ if ($currentRolename == '40')  {     ?> 
                <ul class="treeview-menu">
				
					<?php echo menu_link('bidding/confirm_bidding_list', ' Pending Requests'); ?>
                    <?php echo menu_link('bidding/bidding_fund_release', ' Pending to fund release'); ?>
				</ul> 
                <?php } ?>
                <?php /*Admin */ if ($currentRolename == '11')  {     ?> 
                <ul class="treeview-menu">
                	<?php echo menu_link('bidding/add_bidding', 'Add Bidding'); ?>
					<?php echo menu_link('bidding/bidding_list', ' New Bidding'); ?>
					<?php echo menu_link('bidding/bidding_events', 'Events'); ?>
					<?php echo menu_link('bidding/confirm_bidding_list', ' Courier Pending Requests'); ?>
                    <?php echo menu_link('bidding/bidding_event_report', 'Event Report'); ?>
                     <?php echo menu_link('bidding/bidding_product_wise', 'Product Wise Report'); ?>
				</ul> 
                <?php } ?>
                <ul class="treeview-menu">
				
					<?php echo menu_link('bidding/add_bidding', 'Add Bidding'); ?>
                    <?php echo menu_link('bidding/my_biddings', 'My Biddings'); ?>
					<?php echo menu_link('bidding/my_bidding_events', 'Events'); ?>
                    <?php echo menu_link('bidding/bidding_user_report', 'Report'); ?> 						
									
                </ul>
            </li>
            <!-- /BIDIING -->
			
			
			
	<!-- Voucher Payments -->
			
	<li class="treeview <?php echo menu_li_active('voucher_redeem'); ?>">
		<a href="#">
			<i class="fa fa-credit-card" aria-hidden="true"></i>
			<span>Pay Through Voucher</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php if ($currentRolename != '12')  {     ?> 
				<?php echo menu_link('voucher_redeem/make_payment', 'Make Payment'); ?>
				<?php echo menu_link('voucher_redeem/accept_voucher_payment', 'Recieve Payment'); ?>
			<?php } else{ ?>
				<?php echo menu_link('voucher_redeem/make_payment', 'Make Payment'); ?>
			<?php }  ?>
		</ul>
	</li>
<?php if ($currentRolename != '12')  {     ?> 	
	<li class="treeview <?php echo menu_li_active('lpa_purchase_redeem'); ?>">
	<a href="#">
		<i class="fa fa-credit-card" aria-hidden="true"></i>
		<span>Loyality Purchase Redeem</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	
		<?php echo menu_link('lpa_purchase_redeem/index', 'Loyality Purchase Invoice'); ?>
		<?php echo menu_link('lpa_purchase_redeem/redeem_values', 'Loyality Purchase Redeem'); ?>
		
	</ul>
</li>
<?php }  ?>



<!-- Voucher Payments -->
  <!------------------------------------------->	
							<li class="treeview <?php echo menu_li_active('generate_doc'); ?>">	
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span>User Documents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">	
					<?php echo menu_link('Generate_doc/generated_doc_list', 'All Generate Doc'); ?>
					<?php echo menu_link('Generate_doc/generate_doc', 'Generate Doc'); ?>
					
                </ul>
            </li>	
	<!---------------------Event Management------------------------->
            <li class="treeview <?php echo menu_li_active('event_management'); ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Event Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php /*Admin  EM */  if ($currentRolename == '11' || $currentRolename == '39')  {     ?> 
                <ul class="treeview-menu">
                <?php echo menu_link('event_management/event_dashboard', ' Dashboard'); ?>
                    <li class="treeview <?php echo menu_li_active('event_management'); ?>">
                                <a href="#">
                                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                                    <span>Event Category</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('event_management/event_category', ' Add Category'); ?>
									<?php echo menu_link('event_management/event_category_list', ' List Category'); ?>
                                    <?php echo menu_link('event_management/event_sub_category', ' Add Sub-Category'); ?>
                                    <?php echo menu_link('event_management/event_sub_category_list', ' List Sub-Category'); ?>	
                                </ul>
                    </li>
                    <li class="treeview <?php echo menu_li_active('event_management'); ?>">
                                <a href="#">
                                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                                    <span>Seat Category</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('event_management/event_seat_category', ' Add Seat Category'); ?>
									<?php echo menu_link('event_management/event_seat_category_list', ' List Seat Category'); ?>
                                      <?php echo menu_link('event_management/event_seat_sub_category', ' Add Seat Sub-Category'); ?>
                                      <?php echo menu_link('event_management/event_seat_sub_category_list', ' List Seat Sub-Category'); ?>	
                                </ul>
                    </li>
                	<?php echo menu_link('event_management/event_create', ' Create Events'); ?>
                    <?php echo menu_link('event_management/event_send_invitation', ' Send Notification'); ?>
                    <?php echo menu_link('event_management/event_requests', 'Event Requests'); ?>
					<?php echo menu_link('event_management/event_list', 'Event List'); ?> 	
                    <?php echo menu_link('event_management/events', 'Events'); ?>
                     <?php echo menu_link('event_management/event_payments', 'Payments'); ?>
                     <?php echo menu_link('event_management/event_search_report', 'Report'); ?>					
									
                </ul> 
                <?php } else {?>
                <ul class="treeview-menu">
				<?php echo menu_link('event_management/event_dashboard', ' Dashboard'); ?>
					<?php echo menu_link('event_management/events', 'Events'); ?>
                    <?php echo menu_link('event_management/event_joined_events', 'Joined Events'); ?>
                    <?php echo menu_link('event_management/event_my_contributions', 'My Contributions'); ?>
                     <?php echo menu_link('event_management/event_create_mine', 'Create My Event'); ?>
                     <?php echo menu_link('event_management/event_list', 'My Events'); ?> 
                     <?php echo menu_link('event_management/event_contractor_payments', 'Payments'); ?>	
				</ul>
                <?php } ?>
               
            </li>
            <!---------------------Event Management------------------------->	

<!-- ********* Visitor Entry By Lokesh ******** --->
		 <?php if($currentUser == 'admin'){ ?>
		 
		 
		  <li class="treeview <?php echo menu_li_active('welcome'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Assign Clocking</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php echo menu_link('welcome/Assign_clocking_to_role', 'Add Role'); ?>  
					<?php echo menu_link('welcome/role_clocking', 'All list'); ?> 
					<?php echo menu_link('welcome/clocking_list', 'Clocking list'); ?> 
				</ul>
            </li>
			
			
	<!-- ********  Dashboard consolidation ********* :  -->
			<li class="treeview <?php echo menu_li_active('Dashboard1'); ?>">
            <a href="#">
            <i class="fa fa-globe"></i>
            <span>Quick View</span>
            <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
               <?php echo  menu_link('Quick_view/quick_view', 'Quick View');?>
			</ul>
			</li>
			 <!-------------------------------------------> 	 
		 
		 
	 <li class="treeview <?php echo menu_li_active('Dashbord_alert'); ?>">
					<a href="#">
						<i class="fa fa-truck"></i>
						<span> Dashboard Alert </span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
							<?php echo menu_link('Dashbord_alert/add_dashbord_alert', 'Add Dashboard_Alert'); ?>
						   <?php echo menu_link('Dashbord_alert/dashbord_alert_Index', 'All Dashboard_Alert'); ?>
					</ul>
	</li>
	
	
	<!--Food & Voucher----------------------------->

<li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Voucher Schemes </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        
			
				<!--	<?php echo menu_link('vouchers/vouchers_eligible', 'Eligible Vouchers'); ?>	-->	
				<?php echo menu_link('Voucher_permission/add_voucher_permission', 'Add Voucher Permission'); ?>	
<?php echo menu_link('Voucher_permission/all_voucher_permission', 'View Voucher Permissions'); ?>	
					<?php echo menu_link('vouchers', 'Generated Vouchers'); ?>	
										
<?php echo menu_link('vouchers/transfer_vouchers', 'Transfer Vouchers'); ?>						
<?php echo menu_link('vouchers/transferred_vouchers', 'Transferred Vouchers'); ?>	



<?php echo menu_link('vouchers/all_voucher_report', 'All Vouchers Report'); ?>						
                </ul>
            </li>

<li class="treeview <?php echo menu_li_active('foodvocher'); ?>">
	<a href="#">
	<i class="fa fa-cutlery"></i>
	<span>Multi Coupon Generation</span>
	<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	   <?php echo menu_link('Food_voucher/add_food_voucher', 'Create Multi Coupon Permission'); ?>
	   <?php echo menu_link('Food_voucher', 'All Multi Coupon Permissions'); ?>		   
	   <?php echo menu_link('Food_voucher/add_discount', 'Add Coupon Discount'); ?>
	   <?php echo menu_link('Food_voucher/voucher_discounts', 'Coupon Discounts'); ?>	
	   <?php echo menu_link('Food_voucher/create_food_voucher', 'Create  Coupon'); ?>		   
	   <?php echo menu_link('Food_voucher/my_food_coupons', 'My Coupons'); ?>		   
	</ul>
 </li>
 
 
	<li class="treeview <?php echo menu_li_active('Voucher_redeem'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Redeem Vouchers </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('voucher_redeem/recieve_values', 'Voucher Redeem'); ?>	
					<?php echo menu_link('voucher_redeem/index', 'Voucher Payments invoice'); ?>	
				
									
                </ul>
            </li>
   			<li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Generate Voucher PIN's </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">           
					<?php echo menu_link('vouchers/check_pin_status', 'Check PIN Status'); ?>				
                    <?php echo menu_link('vouchers', 'Your Private Vouchers'); ?>	
					<?php echo menu_link('vouchers/business_voucher_index', 'Company Vouchers List'); ?>						
                    <?php echo menu_link('vouchers/add_vouchers', 'Add Business Voucher'); ?>	
					<?php echo menu_link('vouchers/transfer_vouchers', 'Transfer Vouchers'); ?>
					<?php echo menu_link('vouchers/transferred_vouchers', 'Transferred Vouchers'); ?>	
					<?php echo menu_link('vouchers/all_voucher_report', 'All Vouchers Report'); ?>						
                </ul>
            </li>    


					<li class="treeview <?php echo menu_li_active('generate_doc'); ?>">	
						<a href="#">
							<i class="fa fa-file"></i>
							<span>Email & SMS</span>
							<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">	
							<?php echo menu_link('email', 'All Content & Template'); ?>
							<?php echo menu_link('email/add_email', 'Insert Content & Template');?>
							<?php echo menu_link('email/consumer_email', 'Email'); ?>
							<?php echo menu_link('email/consumer_sms', 'SMS'); ?>

						</ul>
					</li>	
					
					
	<!-- ********Dashboard_alert end   -->
			<!--terms -->
            <li class="treeview <?php echo menu_li_active('term&condition'); ?>">	
                        <a href="#">
                            <i class="fa fa-check"></i>
                            <span>Terms & Conditions</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('Term_condition/accepted_term_condition', 'Accepted'); ?>
                            <?php echo menu_link('Term_condition/term_condition_list', 'List'); ?>
                            <?php echo menu_link('Term_condition/term_condition_upload', 'Upload'); ?>
                            <?php echo menu_link('Term_condition/term_condition_report', 'Report'); ?>


                        </ul>
             </li>
            <!--/.Terms -->
 <li class="treeview <?php echo menu_li_active('Star_ratings'); ?>">	
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>Users Rating</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">	
					<?php echo menu_link('Star_ratings/star_ratings_index', 'Users Ratings Review'); ?>
					<?php echo menu_link('Star_ratings/star_ratings', 'Rate Us'); ?>
                </ul>
            </li>				
		<li class="treeview <?php echo menu_li_active('Visitor_entry'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Visitors/Others Entry</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Visitor_entry/add_visitors', 'Add Visitor Entry'); ?>
							<?php echo menu_link('Visitor_entry/visitor_Index', 'All Visitors Details'); ?>
							<?php echo menu_link('Visitor_entry/add_inward_items', 'Add Inward Item'); ?>
							<?php echo menu_link('Visitor_entry/inward_list', 'Inward Item List'); ?>
							<?php echo menu_link('Visitor_entry/add_outward_items', 'Add Outward Item'); ?>
							<?php echo menu_link('Visitor_entry/outward_item_list', 'Outwad Item List'); ?>
							<?php echo menu_link('Visitor_entry/visitor_entry_report_list', 'Visitor entry Report'); ?>
							<?php echo menu_link('Visitor_entry/assete_history_report', 'Assete History Report'); ?>
					
				</ul>
				
            </li>		
		 <?php } ?> 

		 
            <?php
                if($currentUser == 'admin' ){
            ?>
			
			<li class="treeview <?php echo menu_li_active('user_address_report'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Users Address</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
					<?php echo menu_link('User_address_report/view_user_address_list', 'User Address Report'); ?>
							
				</ul>
    </li>	
	
	
	 <?php
    if($currentUser == 'admin'){
?>
		<li class="treeview <?php echo menu_li_active('referTree'); ?>">
            <a href="#">
            <i class="fa fa-money"></i>
            <span>Users List</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
			  
			    <?php echo menu_link('referTree/user_report', 'Users list'); ?> 	
              <!--  < ?php echo menu_link('referTree/userTrack_index', 'Blocked List'); ?>  -->
            </ul>
         </li>
<?php }?>

<?php  if ($currentRolename == '11' or $currentRolename == '2')  {     ?>  

<li class="treeview <?php echo menu_li_active('Account_report'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Accounts Report</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php echo menu_link('Account_report/accounts_report', 'Accounts Report'); ?>  
				</ul>
     </li>

	 <li class="treeview <?php echo menu_li_active('dynamic_invoice'); ?>">
	<a href="#">
		<i class="fa fa-bookmark"></i>
		<span>Dynamic Invoice</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
		<?php echo menu_link('dynamic_invoice', 'Create Template'); ?>
		<?php echo menu_link('dynamic_invoice/all_templates', 'All Templates'); ?>
	</ul>
   </li>


       <!-- ********  Tax_slabs****amit ********* :  -->
	
	 <li class="treeview <?php echo menu_li_active('Tax_slab'); ?>">
					<a href="#">
						<i class="fa fa-truck"></i>
						<span> Tax </span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						   <?php echo menu_link('Tax_slab/add_tax_idname', 'Add Tax Category'); ?>
						   <?php echo menu_link('Tax_slab/tax_idname_index', 'View Tax Categories'); ?>
						   <?php echo menu_link('Tax_slab/add_tax_slab', 'Add Tax Slab'); ?>
						   <?php echo menu_link('Tax_slab/tax_slab_index', 'View Tax Slabs'); ?>
						  
					</ul>
	</li>
	
	<!-- ********tac_slabs*****end amit   -->
			<li class="treeview <?php echo menu_li_active('ledger'); ?>">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Ledger Accounts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">       
<?php echo  "<a href='http://consumer1st.in/ccb/reports/' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp All Reports </a>"; ?> <br>

									
                    <?php echo menu_link('ledger', 'Ledger Overview'); ?>							
                    <?php echo menu_link('ledger/add_ledger', 'Maintain Ledger Accounts'); ?>		
				<?php echo menu_link('ledger/payspec_accounts', 'Payspec Accounts'); ?>	
			<?php echo menu_link('ledger/rolewise_payspec', 'Rolewise Accounts'); ?>
			<?php echo menu_link('ledger/userwise_payspec', 'Userwise Accounts'); ?>
<?php echo menu_link('instant_payment/instant_payment', 'Recovery Payment'); ?>													
					<?php echo menu_link('ledger/transfer_capital', 'B/W Accounts Transfer'); ?>	
		<!--			<?php echo menu_link('ledger/cash_2wallet', 'Transfer Cash to Wallet'); ?>	
					<?php echo menu_link('ledger/payspec_list', 'Sub-Accounts Index List'); ?> 
					<?php echo menu_link('ledger/add_acct_category', 'Add Main-Accounts '); ?>						
					<?php echo menu_link('ledger/add_acct_sub_category', 'Add Sub-Accounts'); ?>
		-->			<?php echo menu_link('ledger/add_commissions', 'Create Commissions'); ?>	
					<?php echo menu_link('ledger/commission_index', 'View Commisions'); ?>			
				 </ul>
            </li>
		<li class="treeview <?php echo menu_li_active('Comissions_report'); ?>">

		<a href="#">
			<i class="fa fa-file-text"></i>
			<span>Comissions Report</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
			
			<ul class="treeview-menu">
			
						
				<?php echo menu_link('Comissions_rpt/Comissions_report_list', 'Comissions Report'); ?>
				
			</ul>
	</li>		
			
				 <li class="treeview <?php echo menu_li_active('Ledgcomrpt'); ?>">
					<a href="#">
						<i class="fa fa-user"></i>
						<span>Ledger & Commission Rpt</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
							
						   <?php echo menu_link('Ledgcomrpt/view_ledger_report', 'Ledger Report'); ?>
                            <?php echo menu_link('Ledgcomrpt/view_comissions_report', 'Comissions Report'); ?>
					</ul>
	</li>
<li class="treeview <?php echo menu_li_active('points_mode'); ?>">
                    <a href="#">
                        <i class="fa fa-life-ring"></i>
                        <span>Points Mode</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
					 <?php echo menu_link('points_mode/points_mode', 'Points Mode List'); ?>
					 <?php echo menu_link('points_mode/create_points_mode', 'Create Points Mode'); ?>
                       
                      
                       
                      
                   </ul>
                </li>			
<li class="treeview <?php echo menu_li_active('payspec_accounts'); ?>">
	<a href="#">
		<i class="fa fa-money"></i>
		<span>Company Balance Sheet</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
		<?php echo menu_link('payspec_accounts/index', 'CB Sheet'); ?> 							
	</ul>
</li>
			
			
	<?php }?>		
			<li class="treeview <?php echo menu_li_active('product'); ?>">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Sales Transactions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                   
			<!-- < ?php echo menu_link('product/pay_wallet', 'Pay Wallet'); ?>	 -->	
					
					<?php echo menu_link('product/verify_payee', 'Transfer Values'); ?>
					<?php echo menu_link('product/recieve_verify_payee', 'Recieve Values'); ?>
					 <?php echo menu_link('product/payee_payments', 'Process Payee Payments'); ?> 	
					 
<?php  if ($currentRolename == '11')  {     ?> 	
				  <?php echo menu_link('product', 'All Invoice'); ?>					
                <!--   < ?php echo menu_link('product/add_sales', 'Recieve Wallet'); ?> -->
					<?php echo menu_link('product/recharge_mobile', 'Recharge Mobile'); ?>	
					<?php echo menu_link('product/recharge_mobile', 'Book Bus'); ?>						
					<?php echo menu_link('product/recharge_mobile', 'Book Train'); ?>	
					<?php echo menu_link('product/recharge_mobile','Book Flight'); ?>	  <br>	
				<!--	<?php echo  "<a href='http://chaitanyatrust.com/mywallet/' target='_blank'>  >> New site link</a>"; ?> -->
				<?php echo  "<a href='http://consumer1st.in/dev/ecommerce' target='_blank'>  >> Shop My Basket</a>"; ?> <br>	<br>				
					<?php echo  "<a href='http://consumer1st.in/dev/shopomers/index.php' target='_blank'>   >> Shopomers for Retailors </a>"; ?> <br> <br>
				<?php echo  "<a href='http://myfairservice.com/stocks/ware/Upload/index.php?module=auth&view=login' target='_blank'>  >> POS Services </a>"; ?> <br> <br>
				<!-- Anand -->
				
				<?php echo  "<a href='http://prozoomer.in/' target='_blank'>  >> Self Accounting Services </a>"; ?> <br>	 <br>
				<?php echo  "<a href='http://consumer1services.in/logistics/' target='_blank'>  >> Logistics Service </a>"; ?> <br>	 <br>
				<?php echo  "<a href='http://consumer1services.in/nammakrushi/' target='_blank'>     >> Nammakrushi </a>"; ?> <br>	<br>
				<?php echo  "<a href='http://consumer1services.in/realestate/' target='_blank'>   >> Real Estate Service </a>"; ?> 	<br> <br>
				<?php echo  "<a href='http://consumer1st.in/dev/vehicle/en/auth' target='_blank'>    >> Transportation Services </a>"; ?> <br> <br>
				<?php echo  "<a href='http://consumer1st.in/dev/postal' target='_blank'>    >> Courrier Service </a>"; ?> <br>	<br>
				<?php echo  "<a href='http://myprosumer.net/admin/project/project_details/1	' target='_blank'>    >> Project Management </a>"; ?> <br> <br>
				<?php echo  "<a href='http://myprosumer.com/index.php/en/144/sale_and_rent' target='_blank'>     >> Free adds </a>"; ?> <br> <br>
	<?php }?>						
                </ul>
            </li>
 			
            <?php
                if($currentUser == 'admin' ){
            ?>

<!---- Product Preparation -->


<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
								<?php echo menu_link('Product_preparation/product_prep_dashboard', 'Dashboard'); ?>
							<?php echo menu_link('Product_preparation/add_product', 'Add Product '); ?>
							<?php echo menu_link('Product_preparation/add_product_ingredients', 'Add Product Preparation'); ?>
							<?php echo menu_link('Product_preparation/add_product_assign', 'Assign Product'); ?>
							<?php echo menu_link('Product_preparation/add_product_packing_assign', 'Assign Packing'); ?>
							<?php echo menu_link('Product_preparation/list_assigned_products', ' List Assigned Product'); ?>
							
							<?php echo menu_link('Product_preparation/product_packaging', 'Pack Products '); ?>
							<?php echo menu_link('Product_preparation/list_assigned_packs', 'List Assigned Packing '); ?>
							<?php echo menu_link('Product_preparation/product_prepration_report', 'Report Product Declared '); ?>
							
							<?php echo menu_link('Product_preparation/product_prepared_report', 'Report on Product Prepared '); ?>
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
													
						</ul>				
            </li>			
			
			<li class="treeview <?php echo menu_li_active('inventory_stock'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Inventory Stock</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Inventory_stocks/add_inventory_stocks', ' Add Inventory Stocks'); ?>
							
							<?php echo menu_link('Inventory_stocks/report_inventory_stocks', ' Rerport Inventory Stocks'); ?>
						</ul>
            </li>

    <!---------------------Food Production-------------------------> 	
    <!--- Begin Of Agri -->  
                    <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                        <a href="#">
                            <i class="fa fa-tree"></i>
                            <span>Agriculture</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

					
						<li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Create Agri Project</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
								<?php echo menu_link('Agriculture/agriculture_dashboard', 'agriculture dashboard'); ?>
                                    <?php echo menu_link('Agriculture/add_agriculture_project', 'Create Agri Projects'); ?>
                                    <?php echo menu_link('Agriculture/all_agriculture_project', 'View All Agri Projects'); ?>
				    <?php echo menu_link('Agriculture/view_report_agriculture', ' Farm maintainence'); ?>					


                                </ul>


                            </li>
							
							
                            <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Land Details</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/agriculture_land', 'Add land'); ?>
                                    <?php echo menu_link('Agriculture/all_agriculture_land', 'Land Lists '); ?>
                                </ul>
                            </li>	

                   <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Work Estimations</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/add_land_estimated', 'Declare Estimations'); ?>
                                    <?php echo menu_link('Agriculture/all_land_estimate', 'Estimation Lists'); ?>
                                </ul>
                            </li>

                            <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Labour Accounts</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/add_labour_account', 'Assign Labour type to Land ID'); ?>
                                    <?php echo menu_link('Agriculture/all_labour_account', 'All Labour Account'); ?>
                                    <?php echo menu_link('Agriculture/add_labour_type', 'Add Labour/Machinaries Charges'); ?>
                                    <?php echo menu_link('Agriculture/list_labour_type', 'View Labour/Machinaries Type'); ?>

                                </ul>
                            </li>




                            <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Base Materials</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/add_base_materials', 'Add Base Materials'); ?>
                                    <?php echo menu_link('Agriculture/list_base_materials', 'List Base Materials'); ?>
                                </ul>
                            </li>


                            <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Land Inputs</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/add_Agriculture_input_materials', 'Add Agri Materials'); ?>
                                    <?php echo menu_link('Agriculture/list_Agriculture_input_materials', 'List Agri Materials'); ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Land Machinaries</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">

                              
									<?php echo menu_link('Machinaries/add_machinaries', 'Add Machinaries'); ?>
						   <?php echo menu_link('Machinaries/machinaries_Index', 'List Machinaries'); ?>
						  <?php echo menu_link('Machinaries/machinaries_report', 'Machinaries Report'); ?>
                                </ul>


                            </li>


                            <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Land Advisable</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/add_advisable', 'Add Advisable'); ?>
                                    <?php echo menu_link('Agriculture/list_agri_advisable', 'View Advisable'); ?>

                                </ul>

                            </li>


                        </ul>

                    </li>

	<!-- End of Agri --> 
	
							<!-- Begin of Transport details -->
<li class="treeview <?php echo menu_li_active('user'); ?>">
                        <a href="#">
                            <i class="fa fa-car"></i>
                            <span>Vechicles</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

						
						<li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-truck"></i>
                                    <span>Transport</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
								<?php echo menu_link('Transport_report/transport_report_list', 'Transport Report'); ?>
                                    <?php echo menu_link('transport/add_transportmodule', 'Add Transport Module'); ?>
									<?php echo menu_link('transport/transport_index', 'Transport Module List'); ?>
									<?php echo menu_link('Transport/add_make', 'Make & Model'); ?>
									


                                </ul>


                        </li>
							
							
                            <li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-bus"></i>
                                    <span>vehicle Types</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                     <?php echo menu_link('transport/add_vehicletype', 'Add Vehicle Type'); ?>			   
									<?php echo menu_link('transport/vehicle_index', 'Vehicle Types List'); ?>
                                </ul>
                            </li>	

            




                            <li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-truck"></i>
                                    <span>vehicle capacity</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('transport/add_capacityperson', 'Add Capacity Person'); ?>			   
									<?php echo menu_link('transport/capacityperson_index', 'Capacity Person List'); ?>
                                </ul>
                            </li>


                            <li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-bus"></i>
                                    <span>vehicle Load</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                     <?php echo menu_link('transport/add_capacityload', 'Add Capacity Load'); ?>			   
									 <?php echo menu_link('transport/capacityload_index', 'Capacity Load List'); ?>	
                                </ul>
                            </li>
							
			
                        </ul>

                    </li>
						<!-- End of Transport details -->    
	

            
            
            
            <li class="treeview <?php echo menu_li_active('permission'); ?>">
                <a href="#">
                    <i class="fa fa-suitcase"></i>
                    <span>Business Modules </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                 <ul class="treeview-menu">  
                     <?php echo menu_link('permission/view_bg', 'All Business Group'); ?> 
                     <?php  echo menu_link('permission/create_groups', 'Add Business Group'); ?>
                  </ul>
            </li>	
			
				
		 <li class="treeview <?php echo menu_li_active('Business Group'); ?>">
					<a href="#">
						<i class="fa fa-eye"></i>
						<span>Business Group Report</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
							
						 
					<?php echo menu_link('Business_groups_rpt/business_groups_report_index', 'Business Groups Report'); ?>
					</ul>
	</li>
        <li class="treeview <?php echo menu_li_active('Business_status'); ?>">	
                        <a href="#">
                            <i class="fa fa-check"></i>
                            <span>Business Status</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('business_status/all_business_status', 'All Status List'); ?>
                            <?php echo menu_link('business_status/add_business_status', 'Add Status'); ?>

                        </ul>
                    </li>  

 <li class="treeview <?php echo menu_li_active('Status Report'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Status Report</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
							
				<?php echo menu_link('Status_rpt/status_report_index', 'Status Report'); ?>
							   
						
						</ul>
				
            </li>					
              
            <?php } ?>
            
            		
<?php  if ($currentRolename == '11')  {     ?> 		

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
				
<!-- ******** Distributer Commissions ********* -->

                 <li class="treeview <?php echo menu_li_active('user_address'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Distributer Commission</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                            <?php echo menu_link('Distributor_commission/add_distributor_commission', 'Add Distributer Commission'); ?>
                           <?php echo menu_link('Distributor_commission/commission_index', 'List Distributer Commission'); ?>
                            <?php echo menu_link('Distributor_commission/distributor_get_commission', 'Get Commission'); ?>
							
                    </ul>
                </li>
            <!-- ******** Distributer Commissions ********* --> 	
 <li class="treeview <?php echo menu_li_active('Distribution Comissions'); ?>">
					<a href="#">
						<i class="fa fa-eye"></i>
						<span>Distribution Comissions Report</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						
					<?php echo menu_link('Distribution_comissions_rpt/Distribution_report_index', 'Distribution Comissions Report'); ?>
					</ul>
	</li>			

			
			<li class="treeview <?php echo menu_li_active('category'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Payspecs Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('category/payspec_list', 'Payspec List'); ?> 
					<?php echo menu_link('category/add_acct_category', 'Add Main-Accounts '); ?>						
					<?php echo menu_link('category/add_acct_sub_category', 'Add Sub-Accounts'); ?>
                    <?php echo menu_link('category', 'V P A  Ratio'); ?>
					<?php echo menu_link('category/points_ratio', 'Create V P A Ratio'); ?>	
				<!--	< ?php echo menu_link('category/wallet_to_discount', 'Convert/Exchange V P A Values'); ?>		chenged theme -->
				<?php echo menu_link('category/user_values_conversion', 'Convert/Exchange V P A Values'); ?>						
                 <!--   < ?php echo menu_link('category/add_category', 'Add Category'); ?> -->							
                </ul>
            </li>
			
			<li class="treeview <?php echo menu_li_active('Role'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Business Roles</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				
					<?php echo menu_link('Role/all_role', 'Existing Roles'); ?>
					<?php echo menu_link('Role/add_role', 'Create New Roles'); ?> 						
									
                </ul>
            </li>
			
			<li class="treeview <?php echo menu_li_active('Role_report'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Business Roles Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				
					<?php echo menu_link('Role_report/role_report_list', 'Roles Report'); ?>
										
									
                </ul>
            </li>
			
			<li class="treeview <?php echo menu_li_active('Transaction'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Office Transactions </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				
					<?php echo menu_link('Transaction', 'All Transactions'); ?>
					<?php echo menu_link('Transaction/add_transaction', 'Create New Transaction'); ?> 						
									
                </ul>
            </li>
			
     
            	<!------------------------------SMB Project-------------------------------------------------------->	
<?php  if ($currentRolename == '11' )  {     ?> 					
			<li class="treeview <?php echo menu_li_active('billpay'); ?>">
					<a href="#">
						  <i class="fa fa-globe"></i>
						<span>SMB Shopping Zone</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
						
					<ul class="treeview-menu">                 				
						<li class="treeview <?php echo menu_li_active('users'); ?>">
							<a href="#">
								<i class="fa fa-list-ul" aria-hidden="true"></i>
								<span>P r o d u c t s</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">		
								<?php echo menu_link('smb_product/smb_dashboard', 'All Sales Overview'); ?>	
								<?php echo menu_link('smb_product/shop_my_basket_dashboard', 'SMB Sales Only'); ?>
								<?php echo menu_link('smb_product/physical_product_brands', 'Brands'); ?>
								<?php echo menu_link('smb_product/physical_product_category', 'Category'); ?>
								<?php echo menu_link('smb_product/physical_product_subcategory', ' Sub_Category '); ?>			
								<?php echo menu_link('smb_product/physical_products', ' All products'); ?>	
                                <?php echo menu_link('smb_product/vendor_activation', 'Vendor Activation'); ?> 
                                <?php echo menu_link('smb_product/dynamic_smb', 'Dynamic SMB'); ?>
							</ul>
						</li>
						
						<?php echo menu_link('smb_product/physical_product_stock','products Stock'); ?>	
						<?php echo menu_link('smb_product/order_history', 'Consumer Sales'); ?>
						<?php echo menu_link('smb_sales/index', 'Vendor Sales'); ?> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;				 
							<a href="<?php echo base_url('Smb_home/home'); ?>" > Purchase Product </a>
						
					</ul>
					
             </li>	
			  <li class="treeview <?php echo menu_li_active('smb_sales'); ?>">
                        <a href="#">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            <span>SMB Reports</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('smb_reports/sales_report', 'Sale Report'); ?>
                            <?php echo menu_link('smb_reports/stock_report', 'Stock Report'); ?>
                        </ul>
                    </li> 
                    
                    
                    <li class="treeview <?php echo menu_li_active('Smb_payments'); ?>">
	<a href="#">
		<i class="fa fa-money" aria-hidden="true"></i>
		<span>SMB Payments</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	
		<?php echo menu_link('Smb_payments/vendor_payment', 'Pay To Vendor'); ?> 
		<?php echo menu_link('Smb_payments/all_vendor_payments', 'All Vendor Payments'); ?> 
		
	</ul>
</li>


</li>	
				<li class="treeview <?php echo menu_li_active('Smb_allreports'); ?>">
					<a href="#">
						<i class="fa fa-file-text" aria-hidden="true"></i>
						<span>SMB Detail Reports</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php echo menu_link('Smb_allreports/smb_sales_report', 'Sale Report'); ?>
						<?php echo menu_link('Smb_allreports/smb_stock_report', 'Stock Report'); ?>
						<?php echo menu_link('Smb_allreports/smb_tax_report', 'Taxwise Sales'); ?>
						<?php echo menu_link('Smb_allreports/smb_product_tax_report', 'Taxwise Products'); ?>
					</ul>
				</li> 

			 <?php }?>
<!-----------------------------------end ------------------------------------------------------>	

	<li class="treeview <?php echo menu_li_active('Ref_info'); ?>">
                <a href="#">
                    <i class="fa fa-info" aria-hidden="true"></i>
                    <span>Referral Information</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                 <ul class="treeview-menu">  
                     <?php echo menu_link('Ref_info/ref_infomation', 'Change Referral Info'); ?> 
                     <?php echo menu_link('Ref_info/assigned_root_list', 'Assigned List'); ?> 
					 <?php echo menu_link('Ref_info/role_referral', 'Role & Referral Declaration'); ?> 
					 <?php echo menu_link('Ref_info/role_transfer', 'Role Transfer'); ?> 
					 <?php echo menu_link('Ref_info/assign_role', 'Assigned Role'); ?> 
                  </ul>
            </li>		
	<!--End of Food & Voucher----------------------------->		
	 <li class="treeview <?php echo menu_li_active('defect_product'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Old Shop My Basket</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                 				

					<?php echo  "<a href='http://consumer1st.in/smb/index.php/admin' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Admin Portal </a>"; ?> <br>
					<?php echo  "<a href='http://consumer1st.in/smb/reports/' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp SMB Reports </a>"; ?> <br>
					<?php echo menu_link('defect_product', 'List of Defect Products'); ?> <!--rajat  -->
	
					<?php echo menu_link('custom_sales', 'Add Custom Sales'); ?>
					<?php echo menu_link('custom_sales/custom_sales_list', 'View Custom Sales'); ?>					
					</ul>
             </li>	
	 		<!-- smb product defect -->
			
		<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-table"></i>
                    <span>Restaurant</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  				

<?php echo  "<a href='http://consumer1st.in/login/store/signup' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Order Food </a>"; ?> <br>
<?php echo  "<a href=' http://consumer1st.in/login/admin/login' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Admin portal </a>"; ?> <br>
<?php echo  "<a href='http://consumer1st.in/login/merchant' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Restro Vendor Login </a>"; ?> <br>

				</ul>
             </li>		
<!--- Begin Of CMS -->
<li class="treeview <?php echo menu_li_active('courier'); ?>">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Courrier Services</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier/cms_dashboard', 'Dashboard'); ?>
					<?php echo menu_link('courier', 'All Shipments'); ?>					
				<?php echo menu_link('courier/add_courier', 'Add Shipment'); ?>
					
			<li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Status & Assignment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier/new_added_courier_list', 'New Shipment'); ?>
					<?php echo menu_link('courier/pending_courier_list', 'Moving Shipment'); ?>
					<?php echo menu_link('courier/assign_deliveryboy', 'Assign Delivery Executive'); ?>
					<?php echo menu_link('courier/courier_delivered', 'Self Shipment Delivery'); ?>
                </ul>
            </li>
	
                 					
			<li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Shipment Cost</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier/shipment_cost_list', 'Shipment Costs'); ?>
						<?php echo menu_link('courier/add_shipment_cost', 'Add Shipment Costs'); ?>
					
                </ul>
            </li>
			<li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Courier Status Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				  <?php echo menu_link('courier/pickup_assigned_shipment_list', 'Pickup Assigned'); ?>
                  <?php echo menu_link('courier/in_transit_shipment_list', 'Shipment In Transit'); ?>
				  <?php echo menu_link('courier/pickup_successful_shipment_list', 'Pickup Successful'); ?>
				  <?php echo menu_link('courier/delivery_assigned_shipment_list', 'Transefer To Delivery Boy'); ?>
				  <?php echo menu_link('courier/completed_courier_list', 'Delivered'); ?>
                </ul>
            </li>
		
		
	
            
            		  
		 <li class="treeview <?php echo menu_li_active('Courier_report_detials'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>New Courier Detail Reports</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Courier_report_detials/view_courier_report_detials', 'Courier Report Detials'); ?>
					<?php echo menu_link('Courier_report_detials/report_pending_courier_list', 'CMS Status Report'); ?>
			
				</ul>
  
                </ul>
            </li>
			
			
			<li class="treeview <?php echo menu_li_active('Courier'); ?>">	
	<a href="#">
		<i class="fa fa-truck"></i>
		<span>Courier Courier Payment</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">	
		<?php echo menu_link('Courier/add_cms_role_payment', 'Add CMS role payment'); ?>
		<?php echo menu_link('Courier/cms_role_payment_list', 'CMS role payment list'); ?>
	</ul>
</li>
        
		
		
<!--- End Of CMS -->

			 <li class="treeview <?php echo menu_li_active('billpay'); ?>">

                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Classifieds</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
<?php echo  "<a href='http://www.consumer1st.in/dev/classified/index.php/admin' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Admin/Agent portal </a>"; ?> <br>
                   <?php echo  "<a href='http://www.consumer1st.in/dev/classified/index.php' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Classified Services </a>"; ?> <br>
                </ul>
             </li> 	


<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Bill Payments & Recharge</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <?php echo menu_link('billpay/recharge', 'Recharge'); ?> 
                   <?php echo menu_link('billpay/recharge_mobile', 'Prepaid Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_datacard', 'Datacard Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_dth', 'DTH Recharge'); ?>
                

                   <?php echo menu_link('billpay/recharge_payments', 'Pending Bill Payments'); ?>
                   <?php echo menu_link('billpay/billpay_status', 'Bill Payments Status'); ?>
		   <?php echo menu_link('Bill_pay_refund/bill_pay_refund_list', 'Refund Bill pay'); ?>
		   <?php echo menu_link('Billpayment_Status/report_billpayment_status', 'Billpayment Status Report'); ?>
		   
                </ul>
             </li> 		 
	 			 
	
			
			
			
			<!--Business address------------------------------>	
			 <li class="treeview <?php echo menu_li_active('Business_address'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Address Type</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php echo menu_link('Business_address/add_business_address', 'Add Address Type'); ?>  
					<?php echo menu_link('Business_address/business_address_list', 'Address Type list'); ?> 
					
				</ul>
            </li>
			
			
			
						<li class="treeview <?php echo menu_li_active('Business Modules'); ?>">
                <a href="#">
                    <i class="fa fa-suitcase"></i>
                    <span>My User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                   
                    <?php echo menu_link('Business_module', 'User Index'); ?>	
					<?php echo menu_link('Business_module/profile', 'Profile'); ?>
                    <?php echo menu_link('Business_module/change_pass', 'Change Password'); ?>					
					
                </ul>
            </li>	
			
			
	<?php }?>			
            <li class="treeview <?php echo menu_li_active('bank'); ?>">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('Bank/report_bank', 'Bank Details Report'); ?>		
					<?php echo menu_link('bank', 'Bank Transactions'); ?>									
					<?php echo menu_link('bank/add_bankdeposit', 'Cash Deposit - NEFT/RTGS'); ?>
						
						<?php echo menu_link('bank/PayUMoney_form', 'Direct Deposite in Testing'); ?>
					<?php echo menu_link('bank/cash_withdrawl', 'Cash Withdrawl'); ?>
					<?php echo menu_link('bank/cash_reimbursement', 'Cash Reimbursement'); ?>
<?php  if ($currentRolename == '11')  {     ?>   	
								
					<?php echo menu_link('bank/business_loans_index', 'View Loan Schemes'); ?>					
					<?php echo menu_link('bank/create_loans', 'Create Loan Schemes'); ?>
					<?php echo menu_link('bank/self_bank', 'Self Bank Details'); ?>	
				<!--	<?php echo menu_link('bank/view_generated_loans', 'Repayment Status'); ?>	 -->
<?php }?>						
                </ul>
            </li>	
<?php  if ($currentRolename == '11')  {     ?>  
<li class="treeview <?php echo menu_li_active('Bank_transaction'); ?>">	
						<a href="#">
							<i class="fa fa-money"></i>
							<span>Bank Transaction</span>
							<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">	
							<?php echo menu_link('Bank_transaction/add_bank_transaction', 'Add Bank Transactions');?>
							<?php echo menu_link('Bank_transaction/all_bank_transaction', 'Bank Transaction Report');?>

						</ul>
					</li>	
<?php }?>						
<?php  if ($currentRolename == '11')  {     ?>  			
            <li class="treeview <?php echo menu_li_active('agent'); ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                  <span>My Referrals/Earnings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('agent', 'All Partners'); ?>
					<?php echo menu_link('agent/verify_agent', 'New Referral'); ?>
					 <?php echo menu_link('agent/referral_payments', 'Referral Payments'); ?> 
               <!--   <?php echo menu_link('agent/add_agent', 'Add New Channel Partners'); ?>
				-->	
                </ul>
            </li>

            <li class="treeview <?php echo menu_li_active('user'); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Customers(User)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('user', 'All user'); ?>
                    <?php echo menu_link('user/profile', 'Profile'); ?>
                    <?php echo menu_link('user/change_pass', 'Change Password'); ?>
<?php echo menu_link('user_address/address_Index', 'All User Address'); ?>							
						   <?php echo menu_link('user_address/addAddress', 'Add User Address'); ?>
					
                </ul>
            </li>
	<!-- Begin of Location Menu -->
<li class="treeview <?php echo menu_li_active('location'); ?>">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>Location Points</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
				<ul class="treeview-menu">
						<li class="treeview <?php echo menu_li_active('location'); ?>">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>Pincodes</span>	
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
					<ul class="treeview-menu">
					<?php echo menu_link('location/all_pincodes', 'View All Pincodes'); ?>	
					 <?php echo menu_link('location/add_pincode', 'Add Pincode'); ?>
                    								
					</ul>
					</li>
		<li class="treeview <?php echo menu_li_active('location'); ?>">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>Cfirst Location</span>	
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
					<ul class="treeview-menu">
					<?php echo menu_link('location/all_locationid', 'View All Area Location'); ?>	
					 <?php echo menu_link('location/add_locationid', 'Add Area Location'); ?>
                    								
					</ul>
					</li>
					
                 <li class="treeview <?php echo menu_li_active('location'); ?>">
                <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>Area(Pincode Grouping) </span>	
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
					<ul class="treeview-menu">
					<?php echo menu_link('location/all_area', 'View All Area'); ?>	
					 <?php echo menu_link('location/add_area', 'Add Area '); ?>
                    								
					</ul>
					</li>						
					
                </ul>
				</li>
				<!-- End of Location Menu -->
				
				<li class="treeview <?php echo menu_li_active('Pincodes'); ?>">

		<a href="#">
			<i class="fa fa-file-text"></i>
			<span>Pincodes Report</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
			
			<ul class="treeview-menu">
			
						
				<?php echo menu_link('pincodes/pincodes_report_list', 'Pincodes  Report'); ?>
				
			</ul>
	</li>		

            <li class="treeview <?php echo menu_li_active('admin_settings'); ?>">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Admin Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('admin_settings', 'Benefits Settings'); ?>
                    <?php /*echo menu_link('admin_settings/settingsLog', 'Settings Changed Log');*/ ?>
                    <?php echo menu_link('admin_settings/addAdmin', 'Add Admin'); ?>
                    <?php echo menu_link('admin_settings/all_admin', 'Admin List'); ?>               
					<?php echo menu_link('admin_settings/all_roles', 'List of User Roles'); ?>
					<?php echo menu_link('admin_settings/authorizations', 'Check Permissions'); ?>
                </ul>
            </li>
			
<?php }?>				
			 <li class="treeview <?php echo menu_li_active('account'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Consumers Transactions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				
					<?php echo menu_link('account', 'All Account Details'); ?>
<?php echo menu_link('instant_payment/instant_payment', 'Recovery Payment'); ?>
					
<?php  if ($currentRolename == '11')  {     ?> 						
                   <?php echo menu_link('account/my_referrals', 'My Referrals'); ?>					
				   																			
<?php }?>						 
                </ul>
            </li>	
<?php  if ($currentRolename == '11')  {     ?> 			
			<li class="treeview <?php echo menu_li_active('roles'); ?>">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>User Roles </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">             
				<!--	<?php echo menu_link('roles', 'Authorizations List'); ?>	
					<?php echo menu_link('roles/create_authorizations', 'Create Authorizations'); ?>					
					<?php echo menu_link('admin_settings/all_roles', 'List of User Roles'); ?>					
                    <?php echo menu_link('roles/add_permission', 'Create Permission Group'); ?>	-->
					<?php echo menu_link('roles/add_roles', 'Add Roles To Permission Group'); ?>					
                </ul>
            </li>	
		<li class="treeview <?php echo menu_li_active('account'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Loyality Gift Zone </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        
			
<?php echo  "<a href='http://consumer1st.in/lpa_purchase/dashboard/auth/login' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Loyality Upload Products </a>"; ?> <br>				
<?php echo  "<a href='http://consumer1st.in/lpa_purchase' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Loyality Gift Zone </a>"; ?> <br>						
                </ul>
            </li>	
			 
		<li class="treeview <?php echo menu_li_active('support'); ?>">
                    <a href="#">
                        <i class="fa fa-life-ring"></i>
                        <span>Help Desk</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
						<?php echo menu_link('support/dashboard', 'Dashboard'); ?>
				<?php echo menu_link('Support_report/assigned_list_report', 'All Assigned Ticket'); ?>
                      <?php echo menu_link('support', 'All Ticket List'); ?>
                       <?php echo menu_link('support/add_support', 'Create New Ticket'); ?>
                       <?php echo menu_link('support/complete_support', 'Completed Ticket List'); ?>
                       <?php echo menu_link('support/not_complete', 'Pending Ticket List'); ?>
                      
                   </ul>
                </li>
				
			<!--
            <li class="treeview <?php echo menu_li_active('admin_settings'); ?>">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <?php echo menu_link('admin_settings/settingsLog', 'Commissions Updated Log'); ?>
                    <?php echo menu_link('admin_settings/tree', 'Geonology report'); ?>
                    <?php echo menu_link('admin_settings/all_admin', 'Reports List'); ?>
					<?php echo menu_link('account/agents_sales', 'C & F Admin\'s Sales'); ?>
					<?php echo menu_link('Reports/accountStatement', 'Account Statement');?>
		
                </ul>
            </li>		 -->
<?php }?>				
<!-- ******************************************************************************************************/ 
 *************    User type: Agent   *****************	 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 ****************************************************************************************************** --> 
				<?php } elseif($currentUser == 'agent'){ ?>

           <!--     <li class="treeview <?php echo menu_li_active('product'); ?>">
                    <a href="#">
                        <i class="fa fa-support"></i>
                        <span>Product</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        < ?php echo menu_link('product', 'All Invoice'); ?>
                        <!--<-?php echo menu_link('product/new_product_sell', 'New product sell'); ?> ->
						 < ?php echo menu_link('product/sales', 'New product sell'); ?>
                    </ul>
                </li> -->
			<li class="treeview <?php echo menu_li_active('product'); ?>">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Pay Values</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                 			
					<?php echo menu_link('product/verify_payee', 'Transfer Values'); ?>
					
				
					  <!-- 	< ?php echo menu_link('product/recieve_verify_payee', 'Receive Values'); ?> -->
					 <?php echo menu_link('product/payee_payments', 'Process Payee Payments'); ?> 					
				                				
                </ul>
            </li>
	
		<?php  if ($currentRolename == '39' or $currentRolename == '21')  {     ?> 				
			 <li class="treeview <?php echo menu_li_active('Instant_payment'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Event Payment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        	
						 <?php echo menu_link('instant_payment/instant_payment', 'TA/DA/Refund Payment'); ?>
					
				</ul>
             </li>	
	<?php } ?>
	
<!---- Product Preparation -->
<?php  if ($currentRolename == '82' )  {     ?> 	

<li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
								<?php echo menu_link('Product_preparation/product_prep_dashboard', 'Dashboard'); ?>
							<?php echo menu_link('Product_preparation/add_product', 'Add Product '); ?>
							<?php echo menu_link('Product_preparation/add_product_ingredients', 'Add Product Preparation'); ?>
							<?php echo menu_link('Product_preparation/add_product_assign', 'Assign Product'); ?>
							<?php echo menu_link('Product_preparation/add_product_packing_assign', 'Assign Packing'); ?>
							<?php echo menu_link('Product_preparation/list_assigned_products', ' List Assigned Product'); ?>
							
							<?php echo menu_link('Product_preparation/product_packaging', 'Pack Products '); ?>
							<?php echo menu_link('Product_preparation/list_assigned_packs', 'List Assigned Packing '); ?>
							<?php echo menu_link('Product_preparation/product_prepration_report', 'Report Product Declared '); ?>
							<?php echo menu_link('Product_preparation/product_prepared_report', 'Report on Product Prepared '); ?>
							<!-- < ?php echo menu_link('Product_preparation/product_used_report', 'Report on Product used '); ?> -->
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
													
						</ul>				
            </li>			
			
			<li class="treeview <?php echo menu_li_active('inventory_stock'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Inventory Stock</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Inventory_stocks/add_inventory_stocks', ' Add Inventory Stocks'); ?>
							
							<?php echo menu_link('Inventory_stocks/report_inventory_stocks', ' Rerport Inventory Stocks'); ?>
						</ul>
            </li>
 <?php } ?>
 
 	
 
 <?php  if ($currentRolename == '83' or $currentRolename == '84' )  {     ?> 	<!-- Main and Assistant  Chef -->
<!-- for Assistant-->
			
			  <li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
							
							
						<?php echo menu_link('Product_preparation/assistant_view_products', 'Start Production '); ?>				
						<?php echo menu_link('Product_preparation/add_product_packing_assign', 'Assign Packing'); ?>
							<?php echo menu_link('Product_preparation/list_assigned_products', ' List Assigned Product'); ?>
							
							<?php echo menu_link('Product_preparation/product_packaging', 'Pack Products '); ?>
							<?php echo menu_link('Product_preparation/product_prepared_report', 'Report on Product Prepared '); ?>
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
						
						</ul>
				
            </li>	
		
			
			<li class="treeview <?php echo menu_li_active('inventory_stock'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Inventory Stock</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Inventory_stocks/add_inventory_stocks', ' Add Inventory Stocks'); ?>
							
							<?php echo menu_link('Inventory_stocks/report_inventory_stocks', ' Rerport Inventory Stocks'); ?>
						</ul>
            </li>
 <?php } ?>
 
  <?php  if ($currentRolename == '85' )  {     ?> 	<!--  Packer(Resto) -->
<!-- for Assistant-->
			
			  <li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
							
							<?php echo menu_link('Product_preparation/product_packaging', 'Pack Products '); ?>
							<?php echo menu_link('Product_preparation/list_assigned_packs', 'List Assigned Packing '); ?>					
						
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
						
						</ul>
				
            </li>	
		
			
			
 <?php } ?>
 
 
    <!---------------------Food Production-------------------------> 	
  		  
	<?php  if ($currentRolename == '38')  {     ?> 	
<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Bill Payments & Recharge</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <?php echo menu_link('billpay/recharge_mobile', 'Prepaid Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_datacard', 'Datacard Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_dth', 'DTH Recharge'); ?>


                   <?php echo menu_link('billpay/recharge_payments', 'Pending Bill Payments'); ?>
                   <?php echo menu_link('billpay/billpay_status', 'Bill Payments Status'); ?>
		   <?php echo menu_link('Bill_pay_refund/bill_pay_refund_list', 'Refund Bill pay'); ?>
		   <?php echo menu_link('Billpayment_Status/report_billpayment_status', 'Billpayment Status Report'); ?>
                </ul>
             </li> 		 
<?php } ?>

		<!------------------------------SMB Project-------------------------------------------------------->	
<?php  if ($currentRolename == '26' or $currentRolename == '13'  or $currentRolename == '42' or $currentRolename == '48')  {     ?> 					
			<li class="treeview <?php echo menu_li_active('billpay'); ?>">
					<a href="#">
						  <i class="fa fa-globe"></i>
						<span>SMB Shopping Zone</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">                 				
						<li class="treeview <?php echo menu_li_active('smb_product'); ?>">
							<a href="#">
								<i class="fa fa-list-ul" aria-hidden="true"></i>
								<span>Physical Products</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
										
								<?php echo menu_link('smb_product/physical_products', ' All products'); ?>	
							</ul>
						</li>
						
						<?php echo menu_link('smb_product/physical_product_stock','products Stock'); ?>	
						<?php echo menu_link('smb_product/order_history', 'Order History'); ?>
						<?php echo menu_link('smb_sales/index', 'Sales'); ?> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;				 
							<a href="<?php echo base_url('Smb_home/home'); ?>" > Purchase Product </a>
						
					</ul>
					
             </li>	
			  <li class="treeview <?php echo menu_li_active('smb_sales'); ?>">
                        <a href="#">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            <span>SMB Reports</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('smb_reports/sales_report', 'Sale Report'); ?>
                            <?php echo menu_link('smb_reports/stock_report', 'Stock Report'); ?>
                        </ul>
                    </li> 
                    
              <li class="treeview <?php echo menu_li_active('Smb_allreports'); ?>">
					<a href="#">
						<i class="fa fa-file-text" aria-hidden="true"></i>
						<span>SMB Detail Reports</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php echo menu_link('Smb_allreports/smb_sales_report', 'Sale Report'); ?>
						<?php echo menu_link('Smb_allreports/smb_stock_report', 'Stock Report'); ?>
					</ul>
				</li> 
      
                    
        
             
             
             
             <li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>SMB Courrier Status </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier/new_added_courier_list', 'New Shipment'); ?>
					<?php echo menu_link('courier/pending_courier_list', 'Intransit Shipment'); ?>
					  <?php echo menu_link('courier/completed_courier_list', 'Delivered'); ?>
					
                </ul>
            </li>
			
             
			 <?php }?>
			 
			 <li class="treeview <?php echo menu_li_active('courrier'); ?>">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Own Pickups & Delivery</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  		<?php echo menu_link('courier/add_courier', 'Add Shipment'); ?>
					<?php echo menu_link('courier', 'All Shipments'); ?>				


				</ul>
             </li>	
<!-----------------------------------end ------------------------------------------------------>		
	<?php  if ($currentRolename == '26' or $currentRolename == '35')  {     ?> 				
			 <li class="treeview <?php echo menu_li_active('defect_product'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Old Shop My Basket</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        	
					<?php echo  "<a href='http://consumer1st.in/smb/index.php/vendor/sales' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Sales </a>"; ?> <br>
					<?php echo  "<a href='http://consumer1st.in/smb/index.php/vendor' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >> &nbsp &nbsp Products Upload </a>"; ?> 


					<?php echo menu_link('defect_product', 'List of Defect Products'); ?> 
	
					<?php echo menu_link('custom_sales', 'Add Custom Sales'); ?>
					<?php echo menu_link('custom_sales/custom_sales_list', 'View Custom Sales'); ?>					
					</ul>
			
				
             </li>	
	<?php } ?>	
<?php  if ($currentRolename == '36' or $currentRolename == '76')  {     ?> 		
	<!--*************    User type: Agent   *****************	--> 
					<li class="treeview <?php echo menu_li_active('support'); ?>">
                    <a href="#">
                        <i class="fa fa-life-ring"></i>
                        <span>Support Assistance</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
					  
					   <?php echo menu_link('support/assigned_list', 'All Assigned Ticket'); ?>
					   <?php echo menu_link('support', 'All Ticket List'); ?>
                       <?php echo menu_link('support/add_support', 'Create New Ticket'); ?>
                       <?php echo menu_link('support/complete_support', 'Complete Ticket'); ?>
                       <?php echo menu_link('support/not_complete', 'Pending Ticket'); ?>
                   </ul>
					</li>
					
					
				<!--	*******************User type: User************** -->
<?php } ?>
	
	<?php  if ($currentRolename == '21')  {     ?> 				
			 <li class="treeview <?php echo menu_li_active('defect_product'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Recovery Payment </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        	
					<?php echo menu_link('instant_payment/instant_payment', 'Recovery Payment'); ?>	
					
				</ul>
             </li>	
	<?php } ?>
	
	
	<?php  if ($currentRolename == '21')  {     ?> 	
	
	
	 </li>	
			  <li class="treeview <?php echo menu_li_active('smb_sales'); ?>">
                        <a href="#">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            <span>SMB Reports</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('smb_reports/sales_report', 'Sale Report'); ?>
                            <?php echo menu_link('smb_reports/stock_report', 'Stock Report'); ?>
                        </ul>
                    </li> 
                    
                    
                    <li class="treeview <?php echo menu_li_active('Smb_payments'); ?>">
	<a href="#">
		<i class="fa fa-money" aria-hidden="true"></i>
		<span>SMB Payments</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	
		<?php echo menu_link('Smb_payments/vendor_payment', 'Pay To Vendor'); ?> 
		<?php echo menu_link('Smb_payments/all_vendor_payments', 'All Vendor Payments'); ?> 
		
	</ul>
</li>


		
			 <li class="treeview <?php echo menu_li_active('defect_product'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Shop My Basket</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        	
					<?php echo  "<a href='http://consumer1st.in/smb/index.php/admin' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Check Accounts </a>"; ?> <br>
					<?php echo  "<a href='http://consumer1st.in/smb/reports/' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp SMB Reports </a>"; ?> <br>
					
				</ul>
             </li>	
	<?php } ?>	
	    
		 <?php  if ($currentRolename == '27')  {     ?> 	
<!--- Begin Of CMS -->
<li class="treeview <?php echo menu_li_active('courier'); ?>">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Courrier Delivery</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier', 'All Shipments'); ?>
				<?php echo menu_link('courier/add_courier', 'Add Shipment'); ?>
					
			<li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Status & Assignment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier/new_added_courier_list', 'New Shipment'); ?>
					<?php echo menu_link('courier/pending_courier_list', 'Moving Shipment'); ?>
					<?php echo menu_link('courier/assign_deliveryboy', 'Assign Delivery Executive'); ?>
					<?php echo menu_link('courier/courier_delivered', 'Self Shipment Delivery'); ?>
                </ul>
            </li>
	
                 					
			<li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Shipment Cost</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('courier/shipment_cost_list', 'Shipment Costs'); ?>
						<?php echo menu_link('courier/add_shipment_cost', 'Add Shipment Costs'); ?>
					
                </ul>
            </li>
			<li class="treeview <?php echo menu_li_active('courier2'); ?>">	
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Courier Status Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				  <?php echo menu_link('courier/pickup_assigned_shipment_list', 'Pickup Assigned'); ?>
                  <?php echo menu_link('courier/in_transit_shipment_list', 'Shipment In Transit'); ?>
				  <?php echo menu_link('courier/pickup_successful_shipment_list', 'Pickup Successful'); ?>
				  <?php echo menu_link('courier/delivery_assigned_shipment_list', 'Transefer To Delivery Boy'); ?>
				  <?php echo menu_link('courier/completed_courier_list', 'Delivered'); ?>
                </ul>
            </li>
				  
			<?php echo  "<a href='http://consumer1st.in/cms/login.php' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Courrier Services </a>"; ?> <br>	  
				  

                </ul>
            </li>
<?php } ?>	
<!--- End Of CMS -->
 <?php  if ($currentRolename == '28')  {     ?> 	
<!--- Begin Of CMS -->

	
                 					
			
	<li class="treeview <?php echo menu_li_active('courier'); ?>">	
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Courier Status</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				
                  <?php echo menu_link('courier/shipment_delivery', 'Pending Delivery'); ?>
		  <?php echo menu_link('courier/courier_delivered', 'Pending Pickups'); ?>
		  <?php echo menu_link('courier/completed_courier_list', 'Delivered'); ?>
                </ul>
            </li>
				  
			

               
<?php } ?>	
<!--- End Of CMS -->
<?php  if ($currentRolename == '33')  {     ?> 	

<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-table"></i>
                    <span>Restaurant</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  				

<?php echo  "<a href='http://consumer1st.in/login/merchant' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Restro Vendor Login </a>"; ?> <br>


				</ul>

<?php } ?>

<!-- ******** Distributer Commissions ********* -->
<?php  if ($currentRolename == '14' or $currentRolename == '15' )  {     ?> 	
                 <li class="treeview <?php echo menu_li_active('user_address'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Your Commissions</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                          
                            <?php echo menu_link('Distributor_commission/distributor_get_commission', 'Get Commission'); ?>
                    </ul>
                </li>
				<?php } ?>
            <!-- ******** Distributer Commissions ********* --> 		


 <!--Food & Voucher----------------------------->           
            
<?php  if ($currentRolename == '13' or $currentRolename == '33' or $currentRolename == '41')  {     ?> 	
<li class="treeview <?php echo menu_li_active('Voucher_redeem'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Redeem Vouchers </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('voucher_redeem/recieve_values', 'Voucher Redeem'); ?>	
					<?php echo menu_link('voucher_redeem/index', 'Voucher Payments invoice'); ?>	
				
									
                </ul>
            </li>		
<?php } ?>

            <li class="treeview <?php echo menu_li_active('bank'); ?>">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php echo menu_link('bank', 'Bank Transaction Summary'); ?>
				<!--	<?php echo menu_link('bank/online_payment', 'Deposit Online'); ?> -->
					<?php echo menu_link('bank/add_bankdeposit', 'Cash Deposit'); ?>
					<?php echo menu_link('bank/cash_withdrawl', 'Cash Withdrawl'); ?>
					<!--	<?php echo menu_link('bank/cash_reimbursement', 'Cash Reimbursement'); ?> -->
					<?php echo menu_link('bank/self_bank', 'Self Bank Details'); ?>	
					<?php echo menu_link('bank/business_loans_index', 'View Loan Schemes'); ?>
                </ul>
            </li>	
			

<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Bill Payments & Recharge</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
           <!--
                   <?php echo menu_link('billpay/recharge_mobile', 'Prepaid Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_datacard', 'Datacard Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_dth', 'DTH Recharge'); ?>
               

                   <?php echo menu_link('billpay/recharge_payments', 'Pending Bill Payments'); ?>
                    -->
                   <?php echo menu_link('billpay/billpay_status', 'Bill Payments Status'); ?>
                </ul>
             </li> 	 
	          
             <!-- New Shopping Zone -->           
             <li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>New Shopping Zone</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;				 
				<a href="<?php echo base_url('Smb_home/home'); ?>" > Purchase Product </a>
				<?php echo menu_link('smb_product/order_history', 'Order History'); ?>
								
				

				</ul>
             </li>		
             
             
             </li>
              <!-- New Shopping Zone --> 	
            <li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Voucher Schemes </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        
			
					<!--	<?php echo menu_link('vouchers/vouchers_eligible', 'Eligible Vouchers'); ?>	-->		
					<?php echo menu_link('vouchers', 'Generated Vouchers'); ?>						
                </ul>
            </li>

			<li class="treeview <?php echo menu_li_active('user'); ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>My Profile</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                   <!--     < ?php echo menu_link('user/profile', 'View Profile'); ?> -->
						
                        <?php echo menu_link('user/change_pass', 'Change Password'); ?>
<?php echo menu_link('user_address/address_Index', ' Address'); ?>
							
						   <?php echo menu_link('user_address/addAddress', 'Add Address'); ?>
					<?php  if ($currentRolename == '15')  {     ?> 		
							<?php echo menu_link('user/search_user_form', 'search user in your Location'); ?> 
					<?php } ?>
                    </ul>
                </li>			
    		  <li class="treeview <?php echo menu_li_active('agent'); ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>My Referrals/Earnings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                
				 	<?php echo menu_link('account/my_referrals', 'My Referrals'); ?>	
                    <?php echo menu_link('agent/verify_agent', 'New Referral'); ?>
					<?php echo menu_link('agent/referral_payments', 'Proceed Referral Payments'); ?> 
					
                </ul>    
				
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
			  
			  
<li class="treeview <?php echo menu_li_active('account'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Loyality Gift Zone </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        
			
				
<?php echo  "<a href='http://consumer1st.in/lpa_purchase' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Loyality Gift Zone </a>"; ?> <br>						
                </ul>
            </li>       
	<li class="treeview <?php echo menu_li_active('food_vocher'); ?>">
	<a href="#">
	<i class="fa fa-cutlery"></i>
	<span>Multi Coupons</span>
	<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	   <?php echo menu_link('Food_voucher/create_food_voucher', 'Create Multi Coupon'); ?>		   
	   <?php echo menu_link('Food_voucher/my_food_coupons', 'My Coupons'); ?>		   
	</ul>
 </li>
                <li class="treeview <?php echo menu_li_active('account'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>My Accounts</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
					   <?php echo menu_link('product', 'All Invoice'); ?>		
						<?php echo menu_link('account', 'CPA Account Summary'); ?>													
						<?php echo menu_link('account/balance_sheet_offers', 'Offers Account Summary'); ?>								
                    </ul>
                </li>
	<!--terms -->
            <li class="treeview <?php echo menu_li_active('term&condition'); ?>">	
                        <a href="#">
                            <i class="fa fa-check"></i>
                            <span>Terms & Conditions</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('Term_condition/accepted_term_condition', 'Accepted'); ?>
                            <?php echo menu_link('Term_condition/term_condition_list', 'List'); ?>
                            <?php echo menu_link('Term_condition/term_condition_upload', 'Upload'); ?>
                            <?php echo menu_link('Term_condition/term_condition_report', 'Report'); ?>


                        </ul>
             </li>
			 
			 <li class="treeview <?php echo menu_li_active('lpa_purchase_redeem'); ?>">
	<a href="#">
		<i class="fa fa-credit-card" aria-hidden="true"></i>
		<span>Loyality Purchase & Redeem</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	
		
				<?php echo menu_link('lpa_purchase_redeem/order_history', 'Order History'); ?>
<?php echo  "<a href='http://consumer1st.in/lpa_purchase' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Loyality Gift Zone </a>"; ?> <br>	
		<?php echo menu_link('lpa_purchase_redeem/redeem_values', 'Loyality Purchase Redeem'); ?>
		
	</ul>
</li>



            <!--/.Terms -->	
			  <li class="treeview <?php echo menu_li_active('Star_ratings'); ?>">	
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>Rate Us</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">	
					
					<?php echo menu_link('Star_ratings/star_ratings', 'Rate Us'); ?>
                </ul>
               </li>		
	           <li class="treeview <?php echo menu_li_active('support'); ?>">
                    <a href="#">
                        <i class="fa fa-life-ring"></i>
                        <span>Contact Support</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
						
                      <?php echo menu_link('support', 'All Ticket List'); ?>
                       <?php echo menu_link('support/add_support', 'Create New Ticket'); ?>
                       <?php echo menu_link('support/complete_support', 'Completed Ticket List'); ?>
                       <?php echo menu_link('support/not_complete', 'Pending Ticket List'); ?>
                      
                   </ul>
                </li>


<!-- ******************************************************************************************************/ 

 *************     User type: user *****************	 
 
 
 
 
 
 
 
 
 ****************************************************************************************************** --> 
          <?php } elseif($currentUser == 'user'){ ?>
             
			<li class="treeview <?php echo menu_li_active('product'); ?>">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Pay Values</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                 <!--     < ?php echo menu_link('product', 'All Invoice'); ?>					
                  < ?php echo menu_link('product/add_sales', 'Recieve Fund'); ? >
					< ?php echo menu_link('product/pay_wallet', 'Pay Wallet'); ?>	 -->	
					
					<?php echo menu_link('product/verify_payee', 'Transfer Values'); ?>
				
				
				  <!-- 	< ?php echo menu_link('product/recieve_verify_payee', 'Recieve Values'); ?> -->
					 <?php echo menu_link('product/payee_payments', 'Approve Payments'); ?> 	
				
            </ul>
             </li>
             
             <!-- New Shopping Zone -->           
             <li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>New Shopping Zone</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;				 
				<a href="<?php echo base_url('Smb_home/home'); ?>" > Purchase Product </a>
				<?php echo menu_link('smb_product/order_history', 'Order History'); ?>
								
				

				</ul>
             </li>		
             
             
             </li>
			 
			 
			 	<!-- for assistant-->
		
		
		 <li class="treeview <?php echo menu_li_active('Product_preparation'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Product Preparation</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Product_preparation/assistant_view_products', 'Product Preparation'); ?>
							<?php echo menu_link('Product_preparation/product_packaging', 'Pack Products '); ?>
							
							<?php echo menu_link('Product_preparation/product_prepared_report', 'Report on Product Prepared '); ?>
							<?php echo menu_link('Product_preparation/report_product_packing', ' Report On Packed Products '); ?>
							   
						
						</ul>
				
            </li>
		<li class="treeview <?php echo menu_li_active('inventory_stock'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Inventory Stock</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
							<?php echo menu_link('Inventory_stocks/add_inventory_stocks', ' Add Inventory Stocks'); ?>
							
							<?php echo menu_link('Inventory_stocks/report_inventory_stocks', ' Rerport Inventory Stocks'); ?>
							
							
							   
						
						</ul>
				
            </li>	
			
              <!-- New Shopping Zone --> 
              
              

			 <li class="treeview <?php echo menu_li_active('defect_product'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Shop My Basket</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  				

<?php echo  "<a href='http://consumer1st.in/smb/index.php/home/others_product/todays_deal' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Purchase Products </a>"; ?> <br>
<?php echo  "<a href='http://consumer1st.in/smb/index.php/home/others_product/latest' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Latest Products </a>"; ?> <br>

<!-- <?php echo menu_link('defect_product/add_defect', 'Return Product'); ?> -->

				</ul>
             </li>	
<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Bill Payments & Recharge</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <!--
                   <?php echo menu_link('billpay/recharge_mobile', 'Prepaid Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_datacard', 'Datacard Recharge'); ?>
                    <?php echo menu_link('billpay/recharge_dth', 'DTH Recharge'); ?>
               

                   <?php echo menu_link('billpay/recharge_payments', 'Pending Bill Payments'); ?>
                    -->
					 <?php echo menu_link('billpay/recharge', 'Recharge'); ?> 
                   <?php echo menu_link('billpay/billpay_status', 'Bill Payments Status'); ?>
                </ul>
             </li> 
						 
			     <li class="treeview <?php echo menu_li_active('courrier'); ?>">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Cfirst Delivery</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  		<?php echo menu_link('courier/add_courier', 'Add Shipment'); ?>
					<?php echo menu_link('courier', 'All Shipments'); ?>				


				</ul>
             </li>	

 	<li class="treeview <?php echo menu_li_active('billpay'); ?>">
                <a href="#">
                    <i class="fa fa-table"></i>
                    <span>Restaurant</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  				

<?php echo  "<a href='http://consumer1st.in/login/store/signup' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Order Food </a>"; ?> <br>


		
             <!--Food & Voucher----------------------------->


 
 		</ul>
             </li>
	<li class="treeview <?php echo menu_li_active('food_vocher'); ?>">
	<a href="#">
	<i class="fa fa-cutlery"></i>
	<span>Multi Coupons</span>
	<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	   <?php echo menu_link('Food_voucher/create_food_voucher', 'Create Multi Coupon'); ?>		   
	   <?php echo menu_link('Food_voucher/my_food_coupons', 'My Coupons'); ?>		   
	</ul>
 </li>
	<!--End of Food & Voucher-----------------------------> 
<li class="treeview <?php echo menu_li_active('billpay'); ?>">

                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Classifieds</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                   <?php echo  "<a href='http://www.consumer1st.in/dev/classified/index.php' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Free Add Services </a>"; ?> <br>
                </ul>
             </li> 	


          <li class="treeview <?php echo menu_li_active('bank'); ?>">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('bank', 'Bank Transaction Summary'); ?>					
					<?php echo menu_link('bank/add_bankdeposit', 'Cash Deposit'); ?>
					<?php echo menu_link('bank/cash_withdrawl', 'Cash Withdrawl'); ?>
				<!--	<?php echo menu_link('bank/cash_reimbursement', 'Cash Reimbursement'); ?> -->
					<?php echo menu_link('bank/self_bank', 'Self Bank Details'); ?>	
					<?php echo menu_link('bank/business_loans_index', 'View Loan Schemes'); ?>
                </ul>
            </li>	
			  <li class="treeview <?php echo menu_li_active('agent'); ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>My Referrals/Earnings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                 
					<?php echo menu_link('account/my_referrals', 'My Referrals'); ?>	
                    <?php echo menu_link('agent/verify_agent', 'New Referral'); ?>
					 <?php echo menu_link('agent/referral_payments', 'Proceed Referral Payments'); ?> 
					
					
                </ul>
            </li>			
                <li class="treeview <?php echo menu_li_active('user'); ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>My Profile & Address</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                     <!--   < ?php echo menu_link('user/profile', 'Profile'); ?>	-->										
                        <?php echo menu_link('user/change_pass', 'Change Password'); ?>
						<?php echo menu_link('user_address/address_Index', ' List of Addresses'); ?>
						<?php echo menu_link('user_address/addAddress', 'Add Address Details'); ?>
						
					
                    </ul>
                </li>
                
   
	
	
			<li class="treeview <?php echo menu_li_active('category'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>CPA Values Conversion</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  				
					<?php echo menu_link('category/user_values_conversion', 'Convert/Exchange C P A Values'); ?>						
                					
                </ul>
            </li>
<li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Voucher Schemes </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">        
			
				<!--	<?php echo menu_link('vouchers/vouchers_eligible', 'Eligible Vouchers'); ?>	-->	
					<?php echo menu_link('vouchers', 'Generated Vouchers'); ?>
										
<?php echo menu_link('vouchers/transfer_vouchers', 'Transfer Vouchers'); ?>						
<?php echo menu_link('vouchers/transferred_vouchers', 'Transferred Vouchers'); ?>	



<?php echo menu_link('vouchers/all_voucher_report', 'All Vouchers Report'); ?>							
                </ul>
            </li>  
            
<!--- Begin Of Agri -->  
                    <li class="treeview <?php echo menu_li_active('agriculture'); ?>">
                        <a href="#">
                            <i class="fa fa-tree"></i>
                            <span>Agriculture</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

						
						<li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Agricultural Maintenance</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
								
                                <?php echo menu_link('Agriculture/agriculture_dashboard', 'agriculture dashboard'); ?>
                                <?php echo menu_link('Agriculture/add_agriculture_project', 'Create Agri Projects'); ?>
                                <?php echo menu_link('Agriculture/all_agriculture_project', 'View All Agri Projects'); ?>
				   			
							


                                </ul>


                            </li>
							
							
                            <li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Land Details</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('Agriculture/agriculture_land', 'Add land'); ?>
                                    <?php echo menu_link('Agriculture/all_agriculture_land', 'Land Lists '); ?>
                                </ul>
                            </li>	

                  
                            <li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-tree"></i>
                                    <span>Land Machinaries</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">

                                    <?php echo menu_link('Machinaries/add_machinaries', 'Add Machinaries'); ?>
                                    <?php echo menu_link('Machinaries/machinaries_Index', 'List Machinaries'); ?>
                                </ul>


                            </li>


                           


                        </ul>

                    </li>

	<!-- End of Agri -->  
 
 
	
	


				
<li class="treeview <?php echo menu_li_active('account'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>My Accounts</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">			
						<?php echo menu_link('product', 'All Invoice'); ?>						
						<?php echo menu_link('account', 'CPA Account Summary'); ?>													
						<?php echo menu_link('account/balance_sheet_offers', 'Offers Account Summary'); ?>						
					<!--	< ?php echo menu_link('account/services_transaction', 'Services Transaction'); ?>	-->										     	
                    </ul>
                </li>
<!-- ******** persnal info amit   -->
	 <li class="treeview <?php echo menu_li_active('Personal_info'); ?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Personal Information</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				     <?php echo menu_link('Personal_info/add_personal_info', 'Add Personal Info'); ?>
					
					 <?php echo menu_link('Personal_info/list_personal_info', 'list Personal info'); ?>	
                     <?php echo menu_link('Personal_info/list_business_info', 'list Business info'); ?>	
                     <?php echo menu_link('Personal_info/list_utilities1', 'list Utilities1'); ?>	
					 <?php echo menu_link('Personal_info/list_utilities2', 'list Utilities2'); ?>	
                     <?php echo menu_link('Personal_info/list_medical', 'list medical'); ?>
					<?php echo menu_link('Personal_info/list_insurance', 'list insurance'); ?>	  
                    <?php echo menu_link('Personal_info/list_hobbies', 'list hobbies'); ?>
				    <?php echo menu_link('Personal_info/list_education', 'list Education'); ?>
					 <?php echo menu_link('Personal_info/list_family_nominee', 'list Family nominee'); ?>	
					 <?php echo menu_link('Personal_info/list_pet_animal', 'list Pet Animal'); ?>
					 <?php echo menu_link('Personal_info/list_alumni_information', 'list Alumni Information'); ?>		
					 <?php echo menu_link('Personal_info/list_sports_information', 'list Sports Information'); ?>			   
					 <?php echo menu_link('Personal_info/list_arts_information', 'list Arts Information'); ?>
					 <?php echo menu_link('Personal_info/list_favourite_places', 'list Favourite Places'); ?>
					 <?php echo menu_link('Personal_info/list_food_habits', 'list Food Habits'); ?>
				</ul>
				
            </li>				
				<li class="treeview <?php echo menu_li_active('user_address_report'); ?>">
				<a href="#">
					<i class="fa fa-file-text"></i>
					<span>Search Retailer</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
				
					<?php echo menu_link('User_address_report/view_user_address_list', 'Nearby Retailer'); ?>
							
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
			
		
			<li class="treeview <?php echo menu_li_active('user'); ?>">
                                <a href="#">
                                    <i class="fa fa-truck"></i>
                                    <span>Transport & Personal Vehicle</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php echo menu_link('transport/add_transportmodule', 'Add Vehicle Records'); ?>
									<?php echo menu_link('transport/transport_index', 'Vehicle List'); ?>
								
									


                                </ul>


                        </li>
		<!-- ********Dashboard_alert end   -->
			<!--terms -->
            <li class="treeview <?php echo menu_li_active('term&condition'); ?>">	
                        <a href="#">
                            <i class="fa fa-check"></i>
                            <span>Terms & Conditions</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php echo menu_link('Term_condition/accepted_term_condition', 'Accepted'); ?>
                            <?php echo menu_link('Term_condition/term_condition_list', 'List'); ?>
                            <?php echo menu_link('Term_condition/term_condition_upload', 'Upload'); ?>
                            <?php echo menu_link('Term_condition/term_condition_report', 'Report'); ?>


                        </ul>
             </li>
			 <li class="treeview <?php echo menu_li_active('lpa_purchase_redeem'); ?>">
	<a href="#">
		<i class="fa fa-credit-card" aria-hidden="true"></i>
		<span>Loyality Gift Zone</span>
		<i class="fa fa-angle-left pull-right"></i>
	</a>
	<ul class="treeview-menu">
	
		
				<?php echo menu_link('lpa_purchase_redeem/order_history', 'Redeem Voucher'); ?>
<?php echo  "<a href='http://consumer1st.in/lpa_purchase' target='_blank'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp >>  &nbsp &nbsp Loyality Purchases </a>"; ?> <br>	
		
		<?php echo menu_link('lpa_purchase_redeem', 'LPA Claimed Invoice'); ?>
        <?php echo menu_link('lpa_purchase_redeem/reedem_invoice', 'LPA Redeemed Vouchers'); ?>
		
	</ul>
</li>

<li class="treeview <?php echo menu_li_active('Ref_info'); ?>">
                <a href="#">
                    <i class="fa fa-info" aria-hidden="true"></i>
                    <span>Referral Information</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                 <ul class="treeview-menu">  
                    
					 <?php echo menu_link('Ref_info/assign_role', 'Assigned Role'); ?> 
					  <?php echo menu_link('Ref_info/role_transfer', 'Role Transfer Request'); ?> 
                  </ul>
            </li>	
			
			
            <!--/.Terms -->	
			  <li class="treeview <?php echo menu_li_active('Star_ratings'); ?>">	
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>Rate Us</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">	
					
					<?php echo menu_link('Star_ratings/star_ratings', 'Rate Us'); ?>
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
        </ul>
    </section>
    <!-- /.sidebar 
< ?php creditsMhs(); ?>-->
<font size="4" color="red">
<?php echo 'Copyrights @ 2017 Consumerfirst Technoservices pvt Ltd';?> </font>
</aside>

<!-- helper links -- >
                        
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                            <script type="text/javascript">
							function googleTranslateElementInit() {
							  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
							}
							</script>
                 -->           
