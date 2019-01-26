
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
                    <h3 class="box-title">Create Business Groups</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
						<div class="form-group <?php if(form_error('business_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Bussiness Group Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="business_name" class="form-control" value="<?php echo set_value('business_name'); ?>" placeholder="Enter Bussiness Group Name">
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
                                                         
									<select name="sub_acct_id" id="sub_acct_id" class="form-control" style="width:100% auto;">
										<option value=""> Sub-Accounts Type </option>
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
										<option value="">Payment Reciever</option>
									</select>		         
							   
                                <?php echo form_error('recv_user') ?>
                            </div>
                        </div>
			
						<div class="form-group <?php if(form_error('points_mode')) echo 'has-error'; ?>">
                            <label for="points_mode" class="col-md-3">Payment Type</label>
                            <div class="col-md-9">
                                 <select name="points_mode" id="points_mode" class="form-control" style="width:100% auto;">
									<option value="">Choose Option</option>
									<option value="wallet">CPA</option>
									<option value="loyality">LPA</option>
									<option value="voucher">Not Applicable</option>
								</select>		         
								<?php echo form_error('points_mode') ?>
                            </div>
                        </div>
					
					<div class="form-group">
                            <div class="col-md-4">
								<button type="button" class="btn btn-info btn-sm" onclick="$('#more_info').slideToggle();"><i class="fa fa-plus-square-o"></i> Add More Information</button>
                            </div>
                        </div>
					
					<div id="more_info" style="display:none;">	
						<div class="form-group <?php if(form_error('voc_permission')) echo 'has-error'; ?>">
                            <label for="voc_permission" class="col-md-3">Is Voucher Applicable?</label>
                            <div class="col-md-9">
                                 <select name="voc_permission" id="voc_permission" onchange="get_voc_type(this.value)" class="form-control" style="width:100% auto;">
									<option value="">Choose Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>		         
								<?php echo form_error('voc_permission') ?>
                            </div>
                        </div>
					<div id="voc_div" style="display:none;">	
						<div class="form-group <?php if(form_error('voc_type')) echo 'has-error'; ?>">
                            <label for="voc_type" class="col-md-3">Voucher Type</label>
                            <div class="col-md-9">
                                 <select name="voc_type" id="voc_type" class="form-control" style="width:100% auto;">
									<option value="">Choose Option</option>
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
									<option value="">Choose Option</option>
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
                                 <select name="vendor_role" id="vendor_role" class="form-control" style="width:100% auto;">
									<option value="">Choose Option</option>
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
                                 <select name="search_type" id="search_type" class="form-control" style="width:100% auto;">
									<option value="">Choose Option</option>
									<option value="1">Type 1 - Category, Sub-Category, Tags, Price.</option>
									<option value="2">Type 2 - Pincode, Vendor.</option>
								</select>		         
								<?php echo form_error('search_type') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('userfile')) echo 'has-error'; ?> ">
							<label for="firstName" class="col-md-3">Business Image
								<span class="text-aqua">(Max size 2MB )</span>
							</label>
							<div class="col-md-9">
								<input id="image" type="file" name="userfile" class="form-control" size="20" />
								<?php echo form_error('userfile') ?>
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
									<input type="text" name="bg_color" class="form-control">

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
									<input type="text" name="search_box_color" class="form-control">

								</div>
								<?php echo form_error('search_box_color') ?>
							</div>
						</div>
				</div>		
           

						<div class="clearfix"></div>
				
				
				    <div class="box-footer">
                        <a href="<?php echo base_url('permission/view_bg') ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
						<button type="submit" name="submit" value="create_groups" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Group
                        </button>
                    </div>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
		</div><!--/.col (left) -->
        <!-- right column -->
 </div>   <!-- /.row -->
    <!-- /.row -->
</section><!-- /.content -->

<script>
function outputValue(item){
    document.getElementById('container').innerHTML = item.value;

}
</script>
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

<?php function page_js(){ ?>
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

