<?php
$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];
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
                <p><?php echo $c_user->first_name .' '.$c_user->last_name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
<!--Permissions-->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
			
            <?php
                if($currentUser == 'admin' ){
            ?>


			<li class="treeview <?php echo menu_li_active('ledger'); ?>">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Ledger Accounts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                   
                    <?php echo menu_link('ledger', 'Ledger Overview'); ?>							
                    <?php echo menu_link('ledger/add_ledger', 'Maintain Ledger Accounts'); ?>			                    
					<?php echo menu_link('ledger/transfer_capital', 'B/W Accounts Transfer'); ?>	
					<?php echo menu_link('ledger/add_acct_category', 'Add Accounts Category'); ?>						
					<?php echo menu_link('ledger/add_acct_sub_category', 'Add Sub-Accounts'); ?>
					<?php echo menu_link('ledger/set_commissions', 'Create Commisions & Benefits'); ?>	
					<?php echo menu_link('ledger/commission_index', 'View/Edit Commisions & Benefits '); ?>			
				 </ul>
            </li>
	
			<li class="treeview <?php echo menu_li_active('product'); ?>">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Sales Transactions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('product', 'All Invoice'); ?>					
                    <?php echo menu_link('product/add_sales', 'Recieve Fund'); ?>	
					<?php echo menu_link('product/recharge_mobile', 'Recharge Mobile'); ?>	
					<?php echo menu_link('product/recharge_mobile', 'Book Bus'); ?>						
					<?php echo menu_link('product/recharge_mobile', 'Book Train'); ?>	
					<?php echo menu_link('product/recharge_mobile', 'Book Flight'); ?>	
                </ul>
            </li>
           	
			<li class="treeview <?php echo menu_li_active('category'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Wallet Conversions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('category', 'Wallet Ratio'); ?>
					<?php echo menu_link('category/points_ratio', 'Create Wallet Ratio'); ?>	
					<?php echo menu_link('category/wallet_to_discount', 'Convert/Exchange Wallet Points'); ?>						
                 <!--   < ?php echo menu_link('category/add_category', 'Add Category'); ?> -->							
                </ul>
            </li>
			<li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Generate Voucher PIN's </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                   
                    <?php echo menu_link('vouchers', 'Your Private Vouchers'); ?>	
					<?php echo menu_link('vouchers/business_voucher_index', 'Company Vouchers List'); ?>						
                    <?php echo menu_link('vouchers/add_vouchers', 'Add Business Voucher'); ?>						
					
                </ul>
            </li>	
            <li class="treeview <?php echo menu_li_active('bank'); ?>">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					
					<?php echo menu_link('bank', 'Approve Deposited Amount'); ?>
					<?php echo menu_link('bank/online_payment', 'Deposit Online'); ?>
					<?php echo menu_link('bank/add_bank', 'Deposit Bank/Offline'); ?>
					<?php echo menu_link('bank/business_loans_index', 'View Loan Schemes'); ?>					
					<?php echo menu_link('bank/create_loans', 'Create Loan Schemes'); ?>
					<?php echo menu_link('bank/view_generated_loans', 'Repayment Status'); ?>					
                </ul>
            </li>			
			
            <li class="treeview <?php echo menu_li_active('agent'); ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Channel Partners(Agents)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('agent', 'All Partners'); ?>
                    <?php echo menu_link('agent/add_agent', 'Add New Channel Partners'); ?>
					
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
			 <li class="treeview <?php echo menu_li_active('account'); ?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Wallet</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('account', 'All Company Account Transactions'); ?>
					<?php echo menu_link('account', 'My Account'); ?>
                   <?php echo menu_link('account/my_referrals', 'My Referrals'); ?>					
				<!--	<-?php echo menu_link('account/ledger_details', 'Company Ledger'); ? >	 ->																
              	<-?php echo menu_link('account/make_payment', 'Transfer Amount'); ? > -->
				<?php echo menu_link('account/transaction_commission_index', 'User Transactions Commissions '); ?>	
                    <?php echo menu_link('account/withdrawal_payment', 'Amount Transferred(Pen)'); ?>					
                    <?php echo menu_link('account/withdrawal_payment', 'Recieved Payments(Pend)'); ?>                   
                    <?php echo menu_link('account/requested_payment_list', 'Requested Payment List(Pen)'); ?>
					
                </ul>
            </li>		
			<li class="treeview <?php echo menu_li_active('roles'); ?>">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>User Roles </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">             
					<?php echo menu_link('roles', 'Authorizations List'); ?>	
					<?php echo menu_link('roles/create_authorizations', 'Create Authorizations'); ?>					
					<?php echo menu_link('admin_settings/all_roles', 'List of User Roles'); ?>					
                    <?php echo menu_link('roles/add_permission', 'Create Permission Group'); ?>	
					<?php echo menu_link('roles/add_roles', 'Add Roles To Permission Group'); ?>					
                </ul>
            </li>	
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
            </li>		
			
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
                    <span>Sales Transaction</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('product', 'All Invoice'); ?>
                    <?php echo menu_link('product/add_sales', 'Recieve Fund'); ?>					
                </ul>
            </li>
            <li class="treeview <?php echo menu_li_active('bank'); ?>">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php echo menu_link('bank', 'Approve Deposited Amount'); ?>
					<?php echo menu_link('bank/online_payment', 'Deposit Online'); ?>
					<?php echo menu_link('bank/add_bank', 'Deposit Bank/Offline'); ?>
					<?php echo menu_link('bank/business_loans_index', 'View Loan Schemes'); ?>
                </ul>
            </li>			
			<li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Generate Voucher PIN's </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                   
                    <?php echo menu_link('vouchers', 'Private Vouchers'); ?>	
					<?php echo menu_link('vouchers/business_voucher_index', 'Business Vouchers List'); ?>						
                <!--    <?php echo menu_link('vouchers/add_vouchers', 'Add Business Voucher'); ?>	-->	
				<!--	< ?php echo menu_link('vouchers/create_vouchers', 'Purchase Voucher by Payment'); ?						
					<?php echo menu_link('product/new_product_sell', 'Create Non-Transferrable Voucher)'); ?>	-->				
                </ul>
            </li>		
			  <li class="treeview <?php echo menu_li_active('agent'); ?>">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Channel Partners(Agents)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('agent', 'All Partners'); ?>
                    <?php echo menu_link('agent/add_agent', 'Add New Channel Partners'); ?>
					
                </ul>
            </li>
                <li class="treeview <?php echo menu_li_active('user'); ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>User</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('user/profile', 'Profile'); ?>
                        <?php echo menu_link('user/change_pass', 'Change Password'); ?>
                    </ul>
                </li>

                <li class="treeview <?php echo menu_li_active('account'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>Account</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
						<?php echo menu_link('account', 'Account Summary'); ?>													
						<?php echo menu_link('account/my_referrals', 'My Referrals'); ?>					
				<!--		<?php echo menu_link('product/new_product_sell', 'Request Amount'); ?> 	-->		 														
						<?php echo menu_link('account/withdrawal_payment', 'Recieved Payments'); ?>                   
						<?php echo menu_link('account/requested_payment_list', 'Requested Payment List'); ?>

                    </ul>
                </li>



<!-- ******************************************************************************************************/ 
 *************     User type: user *****************	 
 
 
 
 
 
 
 
 
 ****************************************************************************************************** --> 
          <?php } elseif($currentUser == 'user'){ ?>
             
			<li class="treeview <?php echo menu_li_active('product'); ?>">
                <a href="#">
                    <i class="fa fa-support"></i>
                    <span>Sales & Services</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php echo menu_link('product', 'All Invoice'); ?>					
                    <?php echo menu_link('product/add_sales', 'Recieve Fund'); ?>	
										
					<li class="treeview <?php echo menu_li_active('product'); ?>">
						<a href="#"><i class="fa fa-mobile"></i><span>Recharge Services</span><i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
									<?php echo menu_link('product/recharge_mobile', 'Recharge Mobile'); ?>	
									<?php echo menu_link('product/services_prepaid', 'Recharge All'); ?>																		
							</ul>
					</li>
					
										
					<li class="treeview <?php echo menu_li_active('product'); ?>">
						<a href="#"><i class="fa fa-bus"></i><span>Bus Bookings</span><i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
									<?php echo menu_link('product/booking_bus', 'Select route /Book Bus'); ?>
									<?php echo menu_link('product/', 'Seat Bookings Status'); ?>
									<?php echo menu_link('product/', 'Cancellation'); ?>
									<?php echo menu_link('product/', 'Transactions'); ?>									
							</ul>
					</li>
					
					<?php echo menu_link('product/services_prepaid', 'All in One Services'); ?>						
                </ul>
            </li>
            <li class="treeview <?php echo menu_li_active('bank'); ?>">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Bank Details</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					
					<?php echo menu_link('bank/online_payment', 'Deposit Online'); ?>
					<?php echo menu_link('bank/add_bank', 'Deposit Bank/Offline'); ?>
					<?php echo menu_link('bank/business_loans_index', 'View Loan Schemes'); ?>
                </ul>
            </li>			
                <li class="treeview <?php echo menu_li_active('user'); ?>">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>My Profile</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php echo menu_link('user/profile', 'Profile'); ?>												
                        <?php echo menu_link('user/change_pass', 'Change Password'); ?>
						<?php echo menu_link('user/get_payspec', 'Get Payspec'); ?>
                    </ul>
                </li>
			<li class="treeview <?php echo menu_li_active('category'); ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Wallet Conversion</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  				
					<?php echo menu_link('category/wallet_to_discount', 'Convert/Exchange Wallet Points'); ?>						
                					
                </ul>
            </li>
			<li class="treeview <?php echo menu_li_active('vouchers'); ?>">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>Generate Voucher PIN's </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">                   
                    <?php echo menu_link('vouchers', 'Private Vouchers'); ?>	
					<?php echo menu_link('vouchers/business_voucher_index', 'Business Vouchers List'); ?>							
                </ul>
            </li>
             <li class="treeview <?php echo menu_li_active('account'); ?>">
                    <a href="#">
                        <i class="fa fa-money"></i>
                        <span>My wallet</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">						
						<?php echo menu_link('account', 'My Account'); ?>						
						<?php echo menu_link('account/services_transaction', 'Services Transaction'); ?>
						<?php echo menu_link('account/my_referrals', 'My Referrals'); ?>						
						<?php echo menu_link('user/self_bank', 'Bank Details'); ?>
						<?php echo menu_link('account/account_summary', 'Account Summary'); ?>							
						<?php echo menu_link('product/new_product_sell', 'Transfer Amount'); ?> 																	
						<?php echo menu_link('account/withdrawal_payment', 'Recieved Payments'); ?>                   
						<?php echo menu_link('account/requested_payment_list', 'Requested Payment List'); ?>
                        <!--?php echo menu_link('account/request_payment', 'Request for Payment'); ?>
                        <!--?php echo menu_link('product/new_purchase', 'Transfer to another customer'); ?-->					
						     	
                    </ul>
                </li>

            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar 
< ?php creditsMhs(); ?>-->
<font size="4" color="red">
<?php echo 'Copyrights@MyFairWallet 2017';?> </font>
</aside>
