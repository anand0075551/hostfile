<?php include('header.php'); ?>
<?php function page_css()
	{ ?>
		<link href="<?php echo base_url('assets/admin'); ?>/css/dashboard_external/dashboard.css" type="text/css"  rel="stylesheet">
	<?php 
	} ?>
<div class="panel_content">
<div class="container-fluid-full">
 <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php 
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
		    $currentUser = singleDbTableRow($user_id)->role;
			if($currentUser=='admin')
			{
			?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="panel panel-primary product-size">
							<div class="panel-heading main_head" style="background:#DB7093">
								<h3 class="panel-title">Administrator</h3>
								<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico"></i></span>
							</div>
							<div class="panel-body main_body" style="display:none;">
							<ul class="panel_product_type" style="list-style:none">
                                <li class="sub"> 
								      <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Menu permission</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										        <ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/all_left_menu') ?>">All Menu Names</a></li>
												</ul>
										
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/add_left_menu') ?>">Add Menu Names</a></li>
												</ul>
										
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/assign_menu') ?>">Assign Menu</a></li>
										        </ul>
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/add_business_form') ?>">Add Forms</a></li>
												</ul>
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/all_business_forms') ?>">All Forms</a></li>
												</ul>
										
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/assign_forms') ?>">Assign Forms</a></li>
												</ul>
										
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/assigned_menus') ?>">Assigned Menu list</a></li>
										        </ul>
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/assigned_forms') ?>">Assigned Forms list</a></li>
												</ul>
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/check_form_assignment') ?>">Check Form Assignments</a></li>
												</ul>
										
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/check_menu_assignment') ?>">Check Menu Assignment</a></li>
												</ul>
										
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/menu_shorting') ?>">Menu Alignment</a></li>
										        </ul>
												<ul class="panel_product_type">
													<li><a href="<?php echo base_url('menu/form_shorting') ?>">Forms Alignment</a></li>
												</ul>
									   </div>
								</li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Points mode</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('points_mode/points_mode') ?>">Points Mode List</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('points_mode/create_points_mode') ?>">create Points Mode</a></li>
										</ul>
									  </div>
                                </li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Business status</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('business_status/all_business_status') ?>">All Status List</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('business_status/add_business_status') ?>">Add status</a></li>
										</ul>
									  </div>
                                </li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Personal Note</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Personal_note/personal_note_create') ?>">Create</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Personal_note/personal_note_list') ?>">List</a></li>
										</ul>
                                      </div>
									  </li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Users list</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									  <ul class="panel_product_type">
											<li><a href="<?php echo base_url('referTree/user_report') ?>">Users list</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Users Documents</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Generate_doc/generated_doc_list') ?>">All Generate Doc</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Generate_doc/generate_doc') ?>">Generate Doc</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Dashboard alert</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Dashboard_alert/add_dashboard_alert') ?>">Add Dashboard Alert</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Dashboard_alert/dashboard_alert_Index') ?>">All Dashboard Alert</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Users Ratings</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Star_ratings/star_ratings_index') ?>">Users Ratings Review</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Star_ratings/star_ratings') ?>">Rate Us</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Users Address</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									  <ul class="panel_product_type">
											<li><a href="<?php echo base_url('User_address_report/view_user_address_list') ?>">Users Address Report</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Notification alerts</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Dashbord_alert/add_dashbord_alert') ?>">Add Notification</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Dashbord_alert/dashbord_alert_Index') ?>">List of Alerts</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Business Modules</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('permission/view_bg') ?>">All Business Groups</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('permission/create_groups') ?>">Add Business Groups</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Business Roles</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('role/all_role') ?>">Existing Roles</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('role/add_role') ?>">Create New Roles</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Admin Settings</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('admin_settings') ?>">Benefits Settings</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('admin_settings/addAdmin') ?>">Add Admin</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('admin_settings/all_admin') ?>">Admin List</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('admin_settings/all_roles') ?>">List of Users Roles</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('admin_settings/authorizations') ?>">Check Permissions</a></li>
										</ul>
									  </div>
                                </li>
                            </ul>
							</div>
					</div>
                </div>
			<?php } ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="panel panel-primary product-type">
                        <div class="panel-heading main_head" style="background:#AFEEEE">
                            <h3 class="panel-title">Accounts</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico"></i></span>
                        </div>
                        <div class="panel-body main_body" style="display:none;">
                            <ul class="panel_product_type" style="list-style:none">
                                <li class="sub"> 
								      <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">TAX</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Tax_slab/add_tax_idname') ?>">Tax Category</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Tax_slab/tax_idname_index') ?>">View Tax Categories</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Tax_slab/add_tax_slab') ?>">Add Tax Slab</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Tax_slab/tax_slab_index') ?>">View Tax Slab</a></li>
										</ul>
									  </div>
								</li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Pay through vouchers</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('voucher_redeem/make_payment') ?>">Make Payments</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('voucher_redeem/accept_voucher_payment') ?>">Receive Payment</a></li>
										</ul>
									  </div>
								</li><br>
											<li class="sub"> <div class="panel-heading sub_head" style="background:black">
													<h3 class="panel-title" style="color:white">Account Report</h3>
													<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
												  </div>
												  <div class="panel-body sub_body" style="display:none;">
												  <ul class="panel_product_type">
														<li><a href="<?php echo base_url('Account_report/accounts_report') ?>">Account Report</a></li>
													</ul>
												  </div>
											</li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Ledger Account</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('reports') ?>">All Reports</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger') ?>">Ledger Overview</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/add_ledger') ?>">Maintain Ledger Accounts</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/payspec_accounts') ?>">Payspec Accounts</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/rolewise_payspec') ?>">Rolewise Accounts</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/userwise_payspec') ?>">Otherwise Accounts</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('instant_payment/instant_payment') ?>">Recovery payments</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/transfer_capita') ?>">B/W Accounts Transfer</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/add_commissions') ?>">Create Commission</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/commission_index') ?>">View Commission</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Ledger/Commission report</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									  <ul class="panel_product_type">
											<li><a href="<?php echo base_url('reports') ?>">Ledger/Commission report</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Company Balance Sheet</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									  <ul class="panel_product_type">
											<li><a href="<?php echo base_url('payspec_accounts/index') ?>">CB Sheet</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Sales Transaction</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('product/verify_payee') ?>">Transfer Values</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('product/recieve_verify_payee') ?>">Receive Values</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('product/payee_payments') ?>">Process Payee Payments</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('products') ?>">All Invoice</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('dev/ecommerce') ?>">Shop My Basket</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('dev/shopomers/index.php/login') ?>">Shopomers for Retailers</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('stocks/ware/Upload/index.php?module=auth&view=login') ?>">POS Services</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('prozoomer.in') ?>">Self Accounting Services</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('logistics') ?>">Logistics Service</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('nammakrushi') ?>">Nammakrushi</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('realestate') ?>">Real Estate Service</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('dev/vehicle/en/auth') ?>">Transportation Services</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('ledger/add_ledger') ?>">Maintain Ledger Accounts</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('dev/postal/login.php') ?>">Courier Service</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('myprosumer.net/login') ?>">Project Management</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('myprosumer.com/index.php/en/144/sale_and_rent') ?>">Free Adds</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Distributor commission</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Distributor_commission/add_distributor_commission') ?>">Add Distributer Commission</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Distributor_commission/commission_index') ?>">List Distributer Commission</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Distributor_commission/distributor_get_commission') ?>">Get Commission</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Payspec category</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('category/payspec_list') ?>">Payspec List</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('category/add_acct_category') ?>">Add Main-Account</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('category/add_acct_sub_category') ?>">Add Sub-Account</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('category') ?>">VPA Ratio</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Distributor_commission/commission_index') ?>">Create VPA Ratio</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('category/user_values_conversion') ?>">Convert/Exchange VPA values</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Office transaction</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('transaction') ?>">All Transactions</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('transaction/add_transaction') ?>">Create New Transaction</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">SMB details report</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Smb_allreports/smb_sales_report') ?>">Sales Report</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Smb_allreports/smb_stock_report') ?>">Stock Report</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Bank Details</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank') ?>">Bank Transaction</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/add_bankdeposit') ?>">Bank Deposit-NEFT/RTGS</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/PayUMoney_form') ?>">Bank Deposit in Testing</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/cash_withdrawl') ?>">Cash Withdrawl</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/cash_reimbursement') ?>">Cash Reimbursement</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/business_loans_index') ?>">View Loan Scheme</a></li>
										</ul>
										 <ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/create_loans') ?>">Create Loan Scheme</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('bank/self_bank') ?>">Self Bank Details</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Bank/report_bank') ?>">Bank Details Reports</a></li>
										</ul>
									  </div>
                                </li><br>
								<li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Consumers Transactions</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Smb_allreports/smb_sales_report') ?>">Sales Report</a></li>
										</ul>
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Smb_allreports/smb_stock_report') ?>">Stock Report</a></li>
										</ul>
									  </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="panel panel-primary product-size">
                        <div class="panel-heading main_head" style="background:#FFE4E1">
                            <h3 class="panel-title">Business</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico"></i></span>
                        </div>
                        <div class="panel-body main_body" style="display:none;">

                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 product-use">
                    <div class="panel panel-primary">
                        <div class="panel-heading main_head" style="background:skyblue">
                            <h3 class="panel-title">Personal</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico"></i></span>
                        </div>
                        <div class="panel-body main_body" style="display:none;">

                        </div>
                    </div>
                </div>
				 <div class="col-lg-12 col-md-12 col-sm-12 product-use">
                    <div class="panel panel-primary">
                        <div class="panel-heading main_head" style="background:orange">
                            <h3 class="panel-title">Help desk</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico"></i></span>
                        </div>
                        <div class="panel-body main_body" style="display:none;">

                        </div>
                    </div>
                </div>
				 <div class="col-lg-12 col-md-12 col-sm-12 product-use">
                    <div class="panel panel-primary">
                        <div class="panel-heading main_head" style="background:pink">
                            <h3 class="panel-title">Report</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico"></i></span>
                        </div>
                        <div class="panel-body main_body" style="display:none;">
							<ul class="panel_product_type" style="list-style:none">
                                <li class="sub"> 
								      <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Accounts</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Account_report/accounts_report') ?>">Account report</a></li>
										</ul>
                                      </div>
						        </li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Users</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('referTree/user_report') ?>">Users report</a></li>
										</ul>
									  </div>
                                </li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Family Details</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('family_contr/familyinfo_index') ?>">Family report</a></li>
										</ul>
									  </div>
                                </li><br>
                                <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Star Ratings</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div>
									  <div class="panel-body sub_body" style="display:none;">
										<ul class="panel_product_type">
											<li><a href="<?php echo base_url('Star_ratings/star_ratings_index') ?>">Star Ratings report</a></li>
										</ul>
                                      </div>
									  </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">CMS</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Courier/cms_role_payment_list') ?>">CMS report</a></li>
										</ul>
									  </div>
									 </li><br>
									 <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Bidding</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('bidding/bidding_event_report') ?>">Bidding Event report</a></li>
											<li><a href="<?php echo base_url('bidding/bidding_product_wise') ?>">Bidding Product Wise report</a></li>
										</ul>
									  </div>
									 </li><br>
									 <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Event Management</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('event_management/event_search_report') ?>">Event Search report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Visitor Entry</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Visitor_entry/visitor_entry_report_list') ?>">Visitor Entry report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">User Address</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('User_address_report/view_user_address_list') ?>">User Address report</a></li>
										</ul>
									  </div>
									 </li><br>
									 <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Commission</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Ledgcomrpt/view_comissions_report') ?>">Commission report</a></li>
										</ul>
									  </div>
									 </li><br>
									 <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Product Preparation</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Product_preparation/product_prepration_report') ?>">Product Declared report</a></li>
											<li><a href="<?php echo base_url('Product_preparation/product_used_report') ?>">Product Used report</a></li>
											<li><a href="<?php echo base_url('Product_preparation/report_product_packing') ?>">Product Packing report</a></li>
										</ul>
									  </div>
									 </li><br>
									 <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Inventory Stock</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Inventory_stocks/report_inventory_stocks') ?>">Inventory Stock report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Role</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Role_report/role_report_list') ?>">Role report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Pincode</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('pincodes/pincodes_report_list') ?>">Pincode report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Vouchers</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('vouchers/all_voucher_report') ?>">Vouchers report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">SMB</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('smb_reports/sales_report') ?>">SMB Sale report</a></li>
											<li><a href="<?php echo base_url('smb_reports/stock_report') ?>">SMB Stock report</a></li>
											<li><a href="<?php echo base_url('Smb_payments/all_vendor_payments') ?>">SMB Vendor Payments report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Support</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('Support_report/assigned_list_report') ?>">Assigned List report</a></li>
										</ul>
									  </div>
									 </li><br>
									  <li class="sub"> <div class="panel-heading sub_head" style="background:black">
										<h3 class="panel-title" style="color:white">Pincode</h3>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-plus-sign collapse-ico" style="color:white"></i></span>
									  </div><div class="panel-body sub_body" style="display:none;">
									    <ul class="panel_product_type">
											<li><a href="<?php echo base_url('pincodes/pincodes_report_list') ?>">Pincode report</a></li>
										</ul>
									  </div>
									 </li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php function page_js(){ ?>
<script>
   $(document).on('click', '.main_head span.clickable', function(e){
            var $this = $(this);
            if(!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.main_body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon glyphicon-minus-sign').addClass('glyphicon glyphicon-plus-sign');
            } else {
                $this.parents('.panel').find('.main_body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon glyphicon-plus-sign').addClass('glyphicon glyphicon-minus-sign');
            }
        });
		$('.sub').on('click', '.sub_head span.clickable', function(e){
            var $this = $(this);
            if(!$this.hasClass('panel-collapsed')) {
                $this.parents('.sub').find('.sub_body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon glyphicon-minus-sign').addClass('glyphicon glyphicon-plus-sign');
            } else {
                $this.parents('.sub').find('.sub_body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon glyphicon-plus-sign').addClass('glyphicon glyphicon-minus-sign');
            }
        });
</script>
<?php } ?>