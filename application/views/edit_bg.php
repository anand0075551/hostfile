
<?php function page_css(){ ?>
<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	 <link href="<?php echo base_url('assets/admin/css/colorpicker/bootstrap-colorpicker.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Business Group</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        

                        <div class="form-group <?php if(form_error('business_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Business Group Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="business_name" class="form-control" value="<?php echo $business_groups->business_name; ?>" placeholder="Enter Business Group Name">
                                <?php echo form_error('business_name') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Main Accounts Type</label>
                            <div class="col-md-9">
                                                        
									<select name="acct_id" class="form-control" onchange="get_sub_account(this.value)" style="width:100% auto;">
										<option value="">main Accounts Type </option>
										
										<?php 
											$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
											foreach($query->result() as $account){
											echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
										}											
										?>		
				
									</select>		         
							   
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>						
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub-Account Type</label>
                            <div class="col-md-9">
                                 
											<?php $get = $this->db->get_where('acct_categories', ['id'=>$business_groups->pay_type]);
													if($get->num_rows()>0){
														foreach($get->result() as $g);
														$payment_acc = $g->name;
													}
													else{
														$payment_acc = "Not Mentioned";
													} 
													?>								
									<select name="sub_acct_id" id="sub_acct_id" class="form-control" style="width:100% auto;">
										<option value="<?php echo $business_groups->pay_type; ?>"> <?php echo $payment_acc; ?> </option>
									</select>		         
							  
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Payment Reciever Role</label>
                            <div class="col-md-9">
                               <select name="recv_role" class="form-control" onchange="get_user(this.value)" style="width:100% auto;">
									<option value="">Payment Reciever Role </option>
									
									<?php 
										$query2 = $this->db->get('role');
										foreach($query2->result() as $r){
										echo '<option value="'.$r->id.'">'.$r->id.'-'.$r->rolename.'</option>';
									}											
									?>		
			
								</select>		         
							</div>
                        </div>						
						
						<div class="form-group <?php if(form_error('recv_user')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payment Reciever</label>
                            <div class="col-md-9">                        
									<select name="recv_user" id="recv_user" class="form-control" style="width:100% auto;">
										<option value="<?php echo $business_groups->payment_reciever; ?>"><?php 
													$get_reciever = $this->db->get_where('users', ['referral_code'=>$business_groups->payment_reciever]);
													if($get_reciever->num_rows()>0){
														foreach($get_reciever->result() as $rr);
														$payment_reciever = $rr->first_name.' '.$rr->last_name;
													}
													else{
														$payment_reciever = "Not Mentioned";
													}
													echo $payment_reciever;
												?></option>
									</select>		         
							  
                                <?php echo form_error('recv_user') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('points_mode')) echo 'has-error'; ?>">
                            <label for="points_mode" class="col-md-3">Payment Type</label>
                            <div class="col-md-9">
								<?php
									if($business_groups->points_mode == 'wallet'){
									$pt_mode = "CPA";
									}
									elseif($business_groups->points_mode == 'loyality'){
										$pt_mode = "LPA";
									}
									else{
										$pt_mode = "Not Applicable";
									}
								?>
							
                                 <select name="points_mode" id="points_mode" class="form-control" style="width:100% auto;">
									<option value="<?php echo $business_groups->points_mode ?>"><?php echo $pt_mode; ?></option>
									<option value="wallet">CPA</option>
									<option value="loyality">LPA</option>
									<option value="voucher">Not Applicable</option>
								</select>		         
								<?php echo form_error('points_mode') ?>
                            </div>
                        </div>
			<?php if($business_groups->voc_permission == ''){ ?>
				<div class="form-group">
					<div class="col-md-4">
						<button type="button" class="btn btn-info btn-sm" onclick="$('#more_info').slideToggle();"><i class="fa fa-plus-square-o"></i> Add More Information</button>
					</div>
				</div>		
			<?php } ?>
			<div id="more_info" <?php if($business_groups->voc_permission == ''){ ?> style="display:none;" <?php } ?>>	
					<div class="form-group <?php if(form_error('voc_permission')) echo 'has-error'; ?>">
                            <label for="voc_permission" class="col-md-3">Is Voucher Applicable?</label>
                            <div class="col-md-9">
								<?php
									if($business_groups->voc_permission != ''){
										$voc_permission = $business_groups->voc_permission;
									}
									else{
										$voc_permission = "Not Mentioned";
									}
								?>
                                 <select name="voc_permission" id="voc_permission" onchange="get_voc_type(this.value)" class="form-control" style="width:100% auto;">
									<option value="<?php echo $business_groups->voc_permission; ?>"><?php echo $voc_permission; ?></option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>		         
								<?php echo form_error('voc_permission') ?>
                            </div>
                        </div>
			<div id="voc_div" <?php if($business_groups->voc_permission == '' || $business_groups->voc_permission == 'no'){ ?>style="display:none;" <?php } ?>>				
						<div class="form-group <?php if(form_error('voc_type')) echo 'has-error'; ?>">
                            <label for="voc_type" class="col-md-3">Voucher Type</label>
                            <div class="col-md-9">
                                 <select name="voc_type" id="voc_type" class="form-control" style="width:100% auto;">
								 <?php if($business_groups->voc_type != 0 ){ ?>
									<option value="<?php echo $business_groups->voc_type; ?>"><?php echo singleDbTableRow($business_groups->voc_type, 'status')->status; ?></option>
								<?php } else{ ?>	
									<option value="">Choose Option</option>
								<?php } ?>
									
									<?php
										$get_voc_type = $this->db->get_where('status', ['business_name'=>20]);
										if($get_voc_type->num_rows() > 0){
											foreach($get_voc_type->result() as $voc){
												echo "<option value='".$voc->id."'>".$voc->id."-".$voc->status."</option>";
											}
										}
									?>
								</select>		         
								<?php echo form_error('voc_type') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('voc_limit')) echo 'has-error'; ?>">
                            <label for="voc_limit" class="col-md-3">Voucher Limit</label>
                            <div class="col-md-9">
                                 <select name="voc_limit" id="voc_limit" class="form-control" style="width:100% auto;">
									<option value="<?php echo $business_groups->voc_limit; ?>">
										<?php 
											if($business_groups->voc_limit != 0){
												echo $business_groups->voc_limit;
											}
											else{
												echo "Null";
											}
										?>
									</option>
									<option value="0">Null</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>		         
								<?php echo form_error('voc_limit') ?>
                            </div>
                        </div>
				</div>		
						<div class="form-group <?php if(form_error('vendor_role')) echo 'has-error'; ?>">
                            <label for="vendor_role" class="col-md-3">Vendor Role</label>
                            <div class="col-md-9">
								<?php 
									if($business_groups->vendor_role != 0){
										$vendor_role = singleDbTableRow($business_groups->vendor_role, 'role')->rolename;
									}
									else{
										$vendor_role = "Not Mentioned";
									}
								?>
                                 <select name="vendor_role" id="vendor_role" class="form-control" style="width:100% auto;">
									<option value="<?php echo $business_groups->vendor_role; ?>"><?php echo $vendor_role; ?></option>
									<?php 
										$get_roles = $this->db->get('role');
										foreach($get_roles->result() as $r){
											echo '<option value="'.$r->id.'">'.$r->id.'-'.$r->rolename.'</option>';
										}											
									?>
								</select>		         
								<?php echo form_error('vendor_role') ?>
                            </div>
                        </div>
     
						<div class="form-group <?php if(form_error('search_type')) echo 'has-error'; ?>">
                            <label for="search_type" class="col-md-3">Search Type</label>
                            <div class="col-md-9">
								<?php 
									if($business_groups->search_type == 1){
										$search_type = "Type 1 - Category, Sub-Category, Tags, Price.";
									}
									elseif($business_groups->search_type == 2){
										$search_type = "Type 2 - Pincode, Vendor.";
									}
									else{
										$search_type = "Not Mentioned";
									}
								?>
                                 <select name="search_type" id="search_type" class="form-control" style="width:100% auto;">
									<option value="<?php echo $business_groups->search_type; ?>"><?php echo $search_type; ?></option>
									<option value="1">Type 1 - Category, Sub-Category, Tags, Price.</option>
									<option value="2">Type 2 - Pincode, Vendor.</option>
								</select>		         
								<?php echo form_error('search_type') ?>
                            </div>
                        </div>
						
						<div class="form-group ">
							<label for="firstName" class="col-md-3">Business Image
							  <span class="text-red">*</span>
								<span class="text-aqua">(Max size 2MB )</span>
							</label>
							<div class="col-md-2">
								<img src ="<?php echo base_url('assets/theme/img/'.$business_groups->image) ?>"  class="img-thumbnail" alt="Cinque Terre" width="160" height="120" >	
							</div>
							<div class="col-md-7">
								<input type="file" name="userfile" class="form-control"  size="20" />
							</div>
						</div>
						
						<div class="form-group <?php if(form_error('bg_color')) echo 'has-error'; ?> ">
							<label for="firstName" class="col-md-3">Background Color
								<span class="text-aqua"></span>
							</label>
							<div class="col-md-9">
								<div class="input-group my-colorpicker2">
									<div class="input-group-addon" style="padding:5px;">
										<i style="width:20px; height:20px;"></i>
									</div>
									<input type="text" name="bg_color" value="<?php echo $business_groups->bg_color; ?>" class="form-control">

								</div>
								<?php echo form_error('bg_color') ?>
							</div>
						</div> 
						
						<div class="form-group <?php if(form_error('search_box_color')) echo 'has-error'; ?> ">
							<label for="firstName" class="col-md-3">Search Box Color
								<span class="text-aqua"></span>
							</label>
							<div class="col-md-9">
								<div class="input-group my-colorpicker2">
									<div class="input-group-addon" style="padding:5px;">
										<i style="width:20px; height:20px;"></i>
									</div>
									<input type="text" name="search_box_color" value="<?php echo $business_groups->search_box_color; ?>" class="form-control">

								</div>
								<?php echo form_error('search_box_color') ?>
							</div>
						</div>
			</div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
						<a href="<?php echo base_url('permission/view_bg') ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" name="submit" value="edit_bg" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Business Group name
                        </button>
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
			url:"<?php echo base_url('permission/get_sub_account'); ?>",
			data:mydata,
			success:function(response){
				$("#sub_acct_id").html(response);
			}
		});
	}

	function get_user(id)
	{
		var role = id;
		var mydata = {"role":role};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('permission/get_user'); ?>",
			data:mydata,
			success:function(response){
				$("#recv_user").html(response);
			}
		});
	}
	
	function get_voc_type(id)
	{
		if(id == 'yes'){
			$('#voc_div').slideDown();
		}
		else{
			$('#voc_div').slideUp();
			$('#voc_type').val('');
		}
	}
</script>
<script src="<?php echo base_url('assets/admin/js/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
	
	  //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();
	
</script>
<?php } ?>

