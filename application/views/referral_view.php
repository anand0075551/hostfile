<!-- < ?php foreach($profile_Details->result() as $profile); ? -->
<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        <?php echo $profile->first_name.' '. $profile->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
								
						
												
                                    <div class="box-body">
					
                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Full Name</th>
                                                <th><?php echo $profile->first_name.' '. $profile->last_name; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $profile->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td><?php echo $profile->row_pass; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td><?php echo $profile->contactno; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td><?php echo $profile->gender; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date of birth</td>
                                                <td><?php echo $profile->date_of_birth; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Myfair's Account No</td>
                                                <td><?php echo $profile->account_no; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Loyality Points</td>
                                                <td><?php 
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'loyality');												
												$query = $this->db->select_sum('credit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$credit = $r->credit; }
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'loyality');												
												$query = $this->db->select_sum('debit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$debit = $r->debit;   }
												echo $amount = ($credit - $debit); 
														?></td>
											
											</tr>
											<tr>
                                                <td>Total Discount Points</td>
                                                <td><?php 
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'discount');												
												$query = $this->db->select_sum('credit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$credit = $r->credit; }
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'discount');												
												$query = $this->db->select_sum('debit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$debit = $r->debit;   }
												echo $amount = ($credit - $debit); 
														?></td> 
                                            </tr>
											<tr>
                                                <th>Total Balance Amount</th>
                                                <th><?php 
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'wallet');												
												$query = $this->db->select_sum('credit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$credit = $r->credit; }
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'wallet');												
												$query = $this->db->select_sum('debit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$debit = $r->debit;   }
												echo $amount = ($credit - $debit); 
														?></th>
                                            </tr>	
											<tr>
                                                <th>Total Voucher Value</th>
                                                <th><?php 
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'voucher');												
												$query = $this->db->select_sum('credit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$credit = $r->credit; }
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'voucher');												
												$query = $this->db->select_sum('debit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$debit = $r->debit;   }
												echo $amount = ($credit - $debit); 
														?></th>
                                            </tr>	
											<tr>
                                                <th>Alotted Loan Amount</th>
                                                <td><?php 
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'voucher');												
												$query = $this->db->select_sum('credit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$credit = $r->credit; }
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'voucher');												
												$query = $this->db->select_sum('debit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$debit = $r->debit;   }
												echo $amount = ($credit - $debit); 
														?></td>
                                            </tr>	
											<tr>
                                                <td>Pending Loan yet to Recover</td>
                                                <td><?php 
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'discount');												
												$query = $this->db->select_sum('credit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$credit = $r->credit; }
												$where = array ('account_no' => $profile->account_no, 'points_mode' => 'discount');												
												$query = $this->db->select_sum('debit')->where($where)->get('accounts');
												foreach($query->result() as $r)
												{
												$debit = $r->debit;   }
												echo $amount = ($credit - $debit); 
														?></td> 
                                            </tr>
                                            <tr>
                                                <td>Street Address</td>
                                                <td><?php echo $profile->street_address; ?></td>
                                            </tr>
                                            <tr>                                            
                                                <td>City/Village Name</td>
                                                <td><?php echo $profile->city; ?></td>
                                            </tr>
                                            <tr>											
                                                <td>Country</td>
                                                <td><?php echo $profile->country; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Postal Code</td>
                                                <td><?php echo $profile->postal_code; ?></td>
                                            </tr>
                                            <tr>
                                                <td>User Role</td>
                                                <td><?php echo ucwords($profile->role); ?></td>
                                            </tr>
                                            <tr>
                                                <td>User Type</td>
                                                
												 <td><?php 												 
												$roleName = typeDbTableRow($profile->rolename)->rolename;												
												if ( $roleName != Null ) {
													echo ($roleName);  
												}else
												{
													echo ('User type is Not yet Asigned');  
												}?></td>
                                            </tr>											
                                            <tr>
                             <!--                   <td>Total Refers</td>
                                                <td><?php echo $profile->referralCount; ?></td>
                                            </tr>
                                            <tr> -->
                                                <td>Referral Code</td>
                                                <td><?php echo $profile->referral_code; ?></td>
                                            </tr>
											                                            <tr>
                                                <td>Referred By Member ID</td>
                                                <td><?php echo $profile->referredByCode; ?></td>
                                            </tr>


                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
								<?PHP 	$id = $profile->id; ?>
                                      <a href="<?php echo base_url('user/profile_edit/'.$profile->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                     <!--      <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                       <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
										 <a href="<?php echo base_url('account/referral_balance_sheet/'.$profile->account_no) ?>" class="label label-success"><i class="fa fa-money"></i> Commission Report</a>
                                   --> <a href="<?php echo base_url('account/my_referrals/' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>	
									</div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
				
	

                  
					
						               
             		
				
				
				
				
				
				
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('account/commissionListJson'); ?>"
            });
        });

    </script>