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
                    <h3 class="box-title">Add New Role</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
						
		
                        <div class="form-group <?php if(form_error('role_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Role Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="rolename" class="form-control" value="<?php echo $role->rolename; ?>" placeholder="Enter Role Name">
                                <?php echo form_error('role_name') ?>
                            </div>
                        </div>
<!--
                    <div class="form-group <?php if(form_error('roleid')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Role ID</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> # </div>
                                    <input type="number" name="roleid" step="0.01" min="0" class="form-control" value="<?php echo $role->roleid; ?>" placeholder="Enter Role ID">
                                </div>
                                <?php echo form_error('roleid') ?>
                            </div>
                        </div>
			 		
-->
						                        <div class="form-group <?php if(form_error('fees')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Referral/Registration Fees for this Role</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> CPA </div>
                                    <input type="number" name="fees" step="0.01" min="0" class="form-control" value="<?php echo $role->fees; ?>" placeholder="Enter Fees">
                                </div>
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
								<label for="firstName" class="col-md-3">Payspec for Registration Fees Collection
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
								<label for="firstName" class="col-md-3">Payspec for Sponsorship offers for the commission %
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="comfees_payspec" id="pay_type1" class="form-control" >
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('pay_type') ?>

								</div>
							</div> 
					<!--	<div class="form-group <?php if(form_error('dedfees_payspec')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payspec for Registration Fees Collection</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> Payspec ID </div>
                                    <input type="number" name="dedfees_payspec" step="0.01" min="0" class="form-control" value="<?php echo $role->dedfees_payspec; ?>" placeholder="Enter DedFees">
                                </div>
                                <?php echo form_error('dedfees_payspec') ?>
                            </div>
                        </div> -->
						
						<div class="form-group <?php if(form_error('comfees_payspec')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payspec for Sponsorship offers for the commission %</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> Payspec ID </div>
                                    <input type="number" name="comfees_payspec" step="0.01" min="0" class="form-control" value="<?php echo $role->comfees_payspec; ?>" placeholder="Payspec for Business Commission Deduction from this Role">
                                </div>
                                <?php echo form_error('comfees_payspec') ?>
                            </div>
                        </div>
						
												                        <div class="form-group <?php if(form_error('com_per')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Commission Percent from this Role</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-addon"> % </div>
                                    <input type="number" name="com_per" step="0.01" min="0" class="form-control" value="<?php echo $role->com_per; ?>" placeholder="Enter Com percent">
                                </div>
                                <?php echo form_error('com_per') ?>
                            </div>
                        </div>
						
						<!--
						<div class="form-group <?php if(form_error('parent')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Parent</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                     <div class="input-group-addon"> # </div>
                                    <input type="number" name="parent" step="0.01" min="0" class="form-control" value="<?php echo $role->parent; ?>" placeholder="Enter Parent">
                                </div>
                                <?php echo form_error('parent') ?>
                            </div>
                        </div>
						-->
						
						
										                        <div class="form-group <?php if(form_error('active')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Activate Role ?</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                  <div class="input-group-addon"> 0 is for Inactive Role</div>
                                    <input type="number" name="active" step="0.01" min="0" class="form-control" value="<?php echo $role->active; ?>" placeholder="Active">
                                </div>
                                <?php echo form_error('Active') ?>
                            </div>
                        </div>
						
								<div class="form-group <?php if(form_error('permission_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Available for Referral ?</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                  <div class="input-group-addon"> 1 is for Yes </div>
                                    <input type="number" name="permission_id" step="0.01" min="0" class="form-control" value="<?php echo $role->permission_id; ?>" placeholder="Enter Permission_id">
                                </div>
                                <?php echo form_error('permission_id') ?>
                            </div>
                        </div>
<!--						
						<div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                  <div class="input-group-addon"> # </div>
                                    <input type="text" name="type" step="0.01" min="0" class="form-control" value="<?php echo $role->type; ?>" placeholder="Enter Type">
                                </div>
                                <?php echo form_error('type') ?>
                            </div>	
                        </div>
-->						
            
					


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_role" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update User Role
                        </button>
						<a href="<?php echo base_url('Role_report/role_report_list/'.$role->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Cancel</a>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
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

