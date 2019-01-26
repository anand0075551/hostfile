
<?php function page_css(){ ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>
		

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add Role:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
						<!---->
						  <div class="form-group <?php if(form_error('product_type')) echo 'has-error'; ?>">
										<label for="firstName" class="col-md-3">Product Type
											<span class="text-red">*</span>
										</label>
									
										<div class="col-md-9">
											<select name="role_groups" id="product_type" style="width:100% auto;" class="form-control">
										<option value=""> Choose Type </option>
										<option value="1">Management </option>
										<option value="2"> Managers</option>
										<option value="3">Agents</option>
										
										
										
									</select>	                 
										</div>
							 </div>
						<!---->
						
					
						
						<div class="form-group <?php if(form_error('rolename')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Role Name Description
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="rolename"  class="form-control" value="<?php echo set_value('rolename'); ?>" placeholder="Enter Role Name">                                
                                <?php echo form_error('rolename') ?>
								
							</div>
                        </div>
						
						
							<div class="form-group <?php if(form_error('fees')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Registration Fees
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="fees"  class="form-control" value="<?php echo set_value('fees'); ?>" placeholder="Enter Registration Fees">                                
                                <?php echo form_error('fees') ?>
								
							</div>
                        </div>
							<div class="form-group <?php if(form_error('from_pay_type')) echo 'has-error'; ?>">
											<label for="from_pay_type" class="col-md-3">Main Pay Type
												<span class="text-red"></span>
											</label>
											<div class="col-md-9" >
												<select class="form-control" onchange="get_sub_account(this.value)">
													<option value="">Choose Option</option>
													<?php
														$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
														foreach($query->result() as $account){
															echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
														}
													?>
												</select>	
												
												<?php echo form_error('from_pay_type') ?>
											</div>
								</div>
								
							<div class="form-group <?php if (form_error('pay_type')) echo 'has-error';  ?>">
								<label for="firstName" class="col-md-3">Payspec for Business Commission Deduction from this Role
									<span class="text-red">*</span>
								</label>
									<div class="col-md-9">  								

										<select name="dedfees_payspec" id="pay_type" class="form-control" >
										
											<option value=""> Choose option </option>
											
										</select>	                                
										<?php echo form_error('pay_type') ?>

									</div>
							</div> 
							
						<div class="form-group <?php if(form_error('from_pay_type')) echo 'has-error'; ?>">
									<label for="from_pay_type" class="col-md-3">Main Pay Type
										<span class="text-red"></span>
									</label>
											<div class="col-md-9" >
												<select class="form-control" onchange="get_sub_account1(this.value)">
													<option value="">Choose Option</option>
													<?php
														$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
														foreach($query->result() as $account){
															echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
														}
													?>
												</select>	
												
												<?php echo form_error('from_pay_type') ?>
											</div>
					</div>
								
							<div class="form-group <?php if (form_error('pay_type')) echo 'has-error';  ?>">
								<label for="firstName" class="col-md-3">Payspec for Registration Fees Collection
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="comfees_payspec" id="pay_type1" class="form-control" >
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('pay_type') ?>

								</div>
							</div> 
						
						

					

							<div class="form-group <?php if(form_error('com_per')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Commission Percentage from this Role
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="com_per"  class="form-control" value="<?php echo set_value('com_per'); ?>" placeholder="Enter Com Per">                                
                                <?php echo form_error('com_per') ?>
								
							</div>
                        </div>
	<!---
							<div class="form-group <?php if(form_error('parent')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Parent
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="parent"  class="form-control" value="<?php echo set_value('parent'); ?>" placeholder="Parent">                                
                                <?php echo form_error('parent') ?>
								
							</div>
								
                        </div>
						
					
							<div class="form-group <?php if(form_error('active')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Active
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="active"  class="form-control" value="<?php echo set_value('active'); ?>" placeholder="Enter Status">                                
                                <?php echo form_error('active') ?>
								
							</div>
                        </div>	
							
							<div class="form-group <?php if(form_error('permission_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Permission Id
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="permission_id"  class="form-control" value="<?php echo set_value('permission_id'); ?>" placeholder="Enter Permission Id">                                
                                <?php echo form_error('permission_id') ?>
								
							</div>
                        </div>	
						
					----*********************************************************-->
					<div class="form-group < ?php if(form_error('active')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type Status(Check '✓' to Activate)
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="checkbox" name="active" class="form-control" value='1' checked placeholder="Select Edit Permission">
                                <?php echo form_error('active') ?>
                            </div>
                        </div>  						
                                
                       
				   		<div class="form-group <?php if(form_error('permission_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Available for Referral ? 
                                <span class="text-red">*</span>
                            </label>
							
                            <div class="col-md-9">
                               
								 <input type="checkbox" checked name="permission_id" class="form-control" value='1' placeholder="Select Edit Permission">
                                <?php echo form_error('permission_id ') ?>
                            </div>
                        </div> 		
						<!-------*********************************************************-->
					<!--	<div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="type"  class="form-control" value="<?php echo set_value('type'); ?>" placeholder="Enter Type">                                
                                <?php echo form_error('type') ?>
								
							</div>
                        </div>	-->	
						
									     <div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Activity Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="type" class="form-control">
                                <option value=""> Select Activity Type </option>
                                                          
								<option value="loan_type" 	 <?php echo set_select('type', 'Loan Type') 	?>>	Loan Type	</option>								
								<option value="account_type" <?php echo set_select('type', 'Account Type')  ?>>	Account Type </option>
								<option value="voucher_type" <?php echo set_select('type', 'Voucher Type') 	?>>	Voucher Type	</option>
								<option value="role_name" 	 <?php echo set_select('type', 'Role Name') 	?>>	Role/User Type	</option>   
								<option value="withdraw" 	 <?php echo set_select('type', 'withdraw') 		?>>	Withdraw	</option>   				
								<option value="reimbursement" 	 <?php echo set_select('type', 'reimbursement') 	?>>	Reimbursement	</option>   												
                            </select>
                                <?php echo form_error('type') ?>
                            </div>
                        </div> 
						
						
						
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_role" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Role
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->



<!-- Validation -->

<!-- Mobile number Validation -->
<script>
function maxLengthCheck(object)
{
if (object.value.length > object.maxLength)
object.value = object.value.slice(0, object.maxLength)
}
</script>
<script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>


<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>
	
	<script>
	function get_sub_account(id)
	{
		var parent_id = id;
		var mydata = {"parent_id":parent_id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Role_report/get_sub_account') ?>",
			data:mydata,
			success:function(response){
				$("#pay_type").html(response);
			}
		});
	}
</script>
	<script>
	function get_sub_account1(id)
	{
		var parent_id = id;
		var mydata = {"parent_id":parent_id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Role_report/get_sub_account') ?>",
			data:mydata,
			success:function(response){
				$("#pay_type1").html(response);
			}
		});
	}
</script>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>

