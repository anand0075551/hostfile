<?php function page_css(){ ?>
   
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	  <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	
	foreach($root_id->result() as $root); 
?>
		
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
		
			<div class="box-header">
				<h3 class="box-title"> Assign New Root ID </h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
				<div class="box-body">	
					<div class="form-group <?php if(form_error('role_name')) echo 'has-error'; ?>">
						<label for="firstName" class="col-md-4">Role Name
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<?php
									$get_role = $this->db->get_where('role',['id'=>$root->rolename]);
									foreach($get_role->result() as $r_name);
								
							?>
							<input type="text" class="form-control" value="<?php echo $r_name->rolename; ?>" readonly />
						</div>
					</div>
					<div class="form-group <?php if(form_error('user')) echo 'has-error'; ?>">
						<label for="firstName" class="col-md-4">User Name
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" class="form-control" value="<?php echo $root->first_name.''.$root->last_name; ?>"  readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Current Root ID
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" class="form-control" value="<?php echo $root->root_id; ?>"  readonly />
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Assign New Root ID
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
						<input type="text" class="form-control" name="new_root_id" required/>
						</div>
					</div>
				</div><!--End box body----->
				<!---------------Footer------------>
				<input type="hidden" name="role_name" value="<?php echo $root->rolename; ?>" />
				<input type="hidden" name="id" value="<?php echo $root->id; ?>" />
				<input type="hidden" name="ref_id" value="<?php echo $root->referral_code; ?>" />
				<input type="hidden" name="contact_no" value="<?php echo $root->contactno; ?>" />
				<input type="hidden" name="c_root_id" value="<?php echo $root->root_id; ?>" />
				
				<div class="box-footer text-right">
					<button type="submit" name="submit" id="save_root" value="root_id" class="btn btn-primary">
						<i class="fa fa-edit"></i> Save
					</button>
					<button type="button" class="btn btn-drack" data-dismiss="modal" onClick="window.location.reload();">Cancel</button>
				</div>
			</form>
		</div><!-- /.box -->
	</div><!--/.col (left) -->
	<!-- right column -->
</div>


<?php function page_js(){ ?>



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<?php } ?>