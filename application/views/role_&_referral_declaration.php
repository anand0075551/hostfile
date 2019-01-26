<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
	$root_id    = singleDbTableRow($user_id)->root_id;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Role and Referral Declaration</h3>
                </div><!-- /.box-header -->
				
				<div class="row" style="padding:10px;">
					<div class="col-lg-12 text-right" style="padding-right:40px;">
						<a class="btn btn-success" href="#" data-toggle="modal" data-target="#create" data-toggle="modal" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add </a>
					</div>
				</div>
					
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<table id="example" class="table table-bordered table-striped table-hover">
						<thead>
						<tr>
							<th>Activity Type</th>
							<th>From Role</th>
							<th>To Role</th>
							<th>Points For From Role</th>
							<th>Points For To Role</th>
							<th>Points Mode</th>
							<th>Limit</th>
						</tr>
						</thead>

						<tfoot>
						<tr> 
							<th>Activity Type</th>
							<th>From Role</th>
							<th>To Role</th>
							<th>Points For From Role</th>
							<th>Points For To Role</th>
							<th>Points Mode</th>
							<th>Limit</th>
						</tr>
						</tfoot>
					</table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section>
</div>

<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px;">
			 <div class="row">
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Role and Referral Declaration</h3>
						</div>
						<!-- form start -->
						<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
							<div class="box-body">
								<div id="product_details">
									<div class="row text-center">
										<font size="4"></font>
									</div><hr>
									<div class="form-group">
										<label for="firstName" class="col-md-4">Activity Types
											<span class="text-red">*</span>
										</label>
										<div class="col-md-8">
											<select name="activity_type" id="activity_type" class="form-control" style="width:100%;" required>
												<option value="">Choose Option</option>
												<option value="Change Role">Change Role</option>
												<option value="Change Referral">Change Referral</option>
											</select>
										</div>
									</div>
									<div class="form-group ">
										<label for="firstName" class="col-md-4">From Role
											<span class="text-red">*</span>
										</label>
										<div class="col-md-8">
											<input type="hidden" name="f_role" id="f_role" class="form-control" value="12"/>
											<input type="text" readonly class="form-control" value="Consumer"/>
											<p id="category_sts" style="color:red"></p>
										</div>
									</div>
									<div class="form-group">
										<label for="invoiceid" class="col-md-4">To Role
											<span class="text-red">*</span>
										</label>							
										<div class="col-md-8">
											<select name="t_role" id="t_role" style="width:100%;" class="form-control" required>
											<option value='' class="form-control">Choose One</option>
												<?php
													$query = $this->db->group_by('rolename')->get_where('users');
														foreach($query->result() as $t)
														{
															echo "<option value='$t->rolename'>" .singleDbTableRow($t->rolename,'role')->rolename."</option>";
														}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="invoiceid" class="col-md-4">Points For From Role
											<span class="text-red">*</span>
										</label>							
										<div class="col-md-8">
											<input type="number" name="points_f" style="width:100%;" class="form-control" placeholder="Points For From Role" required />
										</div>
									</div>
									<div class="form-group">
										<label for="invoiceid" class="col-md-4">Points For To Role
											<span class="text-red">*</span>
										</label>							
										<div class="col-md-8">
											<input type="number" name="points_t" style="width:100%;" class="form-control" placeholder="Points For To Role" required />
										</div>
									</div>
									<div class="form-group">
										<label for="invoiceid" class="col-md-4">Points Mode
											<span class="text-red">*</span>
										</label>							
										<div class="col-md-8">
											<select name="points_mode" id="points_mode" style="width:100%;" class="form-control" required>
												<option value="">Choose One</option>
												<option value="CPA">CPA</option>
												<option value="LPA">LPA</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="invoiceid" class="col-md-4">Limit of Transfer Role
											<span class="text-red">*</span>
										</label>							
										<div class="col-md-8">
											<input type="number" name="limit" style="width:100%;" placeholder="limit For Transfer" class="form-control" required />
										</div>
									</div>
								</div>
							</div>
						<div class="box-footer text-right">
							<button type="submit" name="submit" value="role_referral" id="role_referral" class="btn btn-primary">
								<i class="fa fa-edit"></i> Submit
							</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
						</form>
					</div><!-- /.box -->
				</div><!--/.col (left) -->
			<!-- right column -->
			</div>
		</div>
	</div>
</div>

<!--End Create Category -->
<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#example").DataTable({
		  "paging": true,
		  "ordering": true,
		  "info": true,
			"ajax": "<?php echo base_url('Ref_info/role_referral_ListJson'); ?>"
		});
	});

</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

