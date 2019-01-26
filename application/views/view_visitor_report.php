<?php include('header.php'); ?>
	
<?php function page_css(){ ?>

	 <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
   <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
   
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>

<?php } ?>

	
<?php
foreach ($visitor->result() as $profile);
?>



<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
			<div class="row" style="padding:10px;">
					
	<div class="container"> 
					 <!--<a href="< ?php echo base_url('Visitor_entry/add_assigned_to/'.$profile->id) ?>"--><center><button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-lg"> Hand Over To </button></center><!--</a>-->
					 
					
					  <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Hand Over To</h4>
					</div>
					 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
        
					<div class="modal-body">
						<div class="clearfix">
						 <input type ="hidden" name="visitor_id" value="<?php echo $profile->id;  ?>">
							
							
							<div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Role<span class="text-red">*</span></label>
								<div class="col-md-9">
									<select name="role" class="form-control" >
									 <option value="">Choose user</option>
								
								<?php 
									$get_name = $this->db->get_where('role');
									foreach($get_name->result() as $p)
									{
										$name = $p->rolename;
										
										echo "<option value=".$name.">".$p->rolename."</option>";
									}
								?>
									</select>
									<?php echo form_error('role') ?>
								</div>
							</div>
							
							<div class="form-group <?php if(form_error('user')) echo 'has-error'; ?>">
									<label for="firstName" class="col-md-3">User<span class="text-red">*</span></label>
									<div class="col-md-9">
										<select name="user" class="form-control" >
										 <option value="">Choose user</option>
									
									<?php 
										$get_name = $this->db->get_where('users');
										foreach($get_name->result() as $p)
										{
											$name = $p->first_name;
											
											echo "<option value=".$name.">".$p->first_name. ' ' .$p->last_name."</option>";
										}
									?>
										</select>
										<?php echo form_error('user') ?>
									</div>
							</div>
							
							
							<div class="form-group <?php if(form_error('cost_value_of_asset')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Cost Values of Asset 

									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="cost_value_of_asset" id="cost_value_of_asset" class="form-control"  value="<?php echo set_value('start_date'); ?>" placeholder="Enter Cost Value of Asset">
									<?php echo form_error('cost_value_of_asset') ?>

								</div>
							</div>
							
							<div class="form-group <?php if(form_error('next_renewal_date')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Next Renewal Date

									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="date" name="next_renewal_date" id="next_renewal_date" class="some_class form-control"  value="<?php echo set_value('next_renewal_date'); ?>" placeholder="Enter Start Date">
									<?php echo form_error('next_renewal_date') ?>

								</div>
							</div>
							
							<div class="form-group <?php if(form_error('condition_of_asset')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Condition Of Asset <span class="text-red">*</span></label>
								<div class="col-md-9">
									<select name="condition_of_asset" class="form-control" >
										<option value=""> Select Condition of Asset </option>
										<option value ="Good"> Good </option>
										 <option value ="Normal"> Normal </option>
										 <option value ="Bad"> Bad</option>
										  <option value ="Poor"> Poor </option>
										  <option value ="Average"> Average </option>
										  
									</select>
									<?php echo form_error('condition_of_asset') ?>
								</div>
							</div>
							
							<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Start Date

									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="date" name="start_date" id="start_date" class="some_class form-control"  value="<?php echo set_value('start_date'); ?>" placeholder="Enter Start Date">
									<?php echo form_error('start_date') ?>

								</div>
							</div>
							
							
							<div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">End Date

									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="date" name="end_date"  id="end_date" class="some_class form-control"  value="<?php echo set_value('end_date'); ?>" placeholder="Enter End Date" id="some_class_1">
									<?php echo form_error('end_date') ?>

								</div>
							</div>
							
							
							<div class="row">
							   <div class="col-xs-12">
									<div class="col-xs-6 col-xs-push-2 my-responsive-button" style="text-align:right; margin-bottom:15px">
										<button type="submit" name="submit" value="handover" id="handover" class="btn btn-primary">
											<i class="fa fa-edit"></i> Assigned
									</div>
									
							   </div>
							</div>
							</form>
        
							
						</div> <!-- clear fix -->
					</div>
								<div class="modal-footer">

									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
				</div>
				  
				</div>
			</div>
	<style>
	
	
	</style>
	
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
	</div>
					 
					 
					 
			
			
				<!--<div class="col-md-12">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <!--<button type="submit" name="submit" value="assign" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Assign

                        </button>
				</div>-->
				
            </div>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-striped">
					    <tr>
                            <td>Visitor Name</td>
                            <td><?php echo $profile->visitor_name; ?></td>
                        </tr>
						
						<tr>
                            <td>Type Of Selection</td>
                            <td><?php echo $profile->type_of_selection; ?></td>
                        </tr>
						<tr>
                            <td>Item Name</td>
                            <td><?php echo $profile->item_name; ?></td>
                        </tr>
								
									<tr>
										<td>Type Of Id</td>
										<td><?php echo $profile->type_of_id; ?></td>
									</tr>
						<tr>
										<td>Type Of Item</td>
										<td><?php echo $profile->type_of_item; ?></td>
									</tr>
									
									<tr>
										<td>Invoice Id</td>
										<td><?php echo $profile->invoice_id; ?></td>
									</tr>
									
									<tr>
										<td>Proof Number</td>
										<td><?php echo $profile->proof_number; ?></td>
									</tr>
                
						
							
									<tr>
										<td>Email Id</td>
										<td><?php echo $profile->email_id; ?></td>
									</tr>
									
									<tr>
										<td>Purpose</td>
										<td><?php echo $profile->purpose; ?></td>
									</tr>
									
									<tr>
										<td>Item Value</td>
										<td><?php echo $profile->item_value; ?></td>
									</tr>
									
									<tr>
										<td>From Place</td>
										<td><?php echo $profile->from_place; ?></td>
									</tr>
									<tr>
										<td>To Receiver</td>
										<td><?php echo $profile->to_reciver; ?></td>
									</tr>
									
									<tr>
										<td>Refferer</td>
										<td><?php echo $profile->refferer; ?></td>
									</tr>
									
									<tr>
										<td>Whom to Meet</td>
										<td><?php echo $profile->whom_to_meet; ?></td>
									</tr>
									
									
									<tr>
										<td>To Whom </td>
										<td><?php echo $profile->to_whom; ?></td>
									</tr>
									
									<tr>
										<td>From Whom</td>
										<td><?php echo $profile->from_whom; ?></td>
									</tr>
									
									<tr>
										<td>From Sender</td>
										<td><?php echo $profile->from_sender; ?></td>
									</tr>
									
									<tr>
										<td>Mobile Number</td>
										<td><?php echo $profile->mobile_no; ?></td>
									</tr>
									
									<tr>
										<td>Remarks</td>
										<td><?php echo $profile->remarks; ?></td>
									</tr>
									
										<tr>
											<td>Visitor Photo</td>
                                               <td> 
										<!--   <img src="< ?php echo profile_photo_url($profile->photo,$c_user->email); ?>"  -->
										<img src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" class="img-thubnail" width="40%" height="60%">
										</td>
										</tr> 
						
						
						<?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
							
							  <tr>
                                <td>Created By</td>
                                <td><?php
                                    if ($profile->created_by == '0') {
                                        echo $name = 'no';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $profile->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'No Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

               <div class="box-footer">
                    <a href="<?php echo base_url('Visitor_entry/visitor_entry_report_list') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->

	
<!----Datepiker SCRIPT  Files---->

<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>

<script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
</script>

	
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>