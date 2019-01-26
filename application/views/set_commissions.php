<!-- check Ledger/public function set_commissions -->
<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>


<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />

		
		
<!-- Main content -->
<section class="content">
    <div class="vertical">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create Business Commisions </h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					

						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Accounts Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="acct_id" class="form-control">
										<option value="">Accounts Type </option>
										
										<?php foreach($main_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>		
				
									</select>		         
							   </div>
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>						
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Sub-Account Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="sub_acct_id" class="form-control">
										<option value="">Sub-Accounts Type </option>
										<?php foreach($sub_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>	
									</select>		         
							   </div>
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						<hr />
						<div class="form-group <?php if(form_error('from_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Seller Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="from_role" class="form-control">
										<option value=""> Seller - Role Type </option>										
										<?php foreach($roles->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->rolename.'</option>';
												}                                        
										?>	
									</select>		         
							   </div>
                                <?php echo form_error('from_role') ?>
                            </div>
                        </div>						
						
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Client Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="to_role" class="form-control">
										<option value=""> Client - Role Type </option>
										<?php foreach($roles->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->rolename.'</option>';
												}                                        
										?>	
									</select>		         
							   </div>
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>
						<hr />
						<div class="form-group <?php if(form_error('slr_ref_level1')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Seller's Referral Commissions Level 1
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level1" step="0.1" min="0" class="form-control" value="<?php echo set_value('slr_ref_level1'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level1') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('slr_ref_level2')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Seller's Referral Commissions Level 2
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level2" step="0.1" min="0" class="form-control" value="<?php echo set_value('slr_ref_level2'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level2') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('slr_ref_level3')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Seller's Referral Commissions Level 3
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level3" step="0.1" min="0" class="form-control" value="<?php echo set_value('slr_ref_level3'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level3') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('slr_ref_level4')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Seller's Referral Commissions Level 4
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level4" step="0.1" min="0" class="form-control" value="<?php echo set_value('slr_ref_level4'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level4') ?>
								</div>
								</div>
						</div>	
												<div class="form-group <?php if(form_error('slr_ref_level5')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Seller's Referral Commissions Level 5
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level5" step="0.1" min="0" class="form-control" value="<?php echo set_value('slr_ref_level5'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level5') ?>
								</div>
								</div>
						</div>	
						<hr />
						<div class="form-group <?php if(form_error('clt_ref_level1')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> client's Referral Commissions Level 1
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level1" step="0.1" min="0" class="form-control" value="<?php echo set_value('clt_ref_level1'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level1') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('clt_ref_level2')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> client's Referral Commissions Level 2
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level2" step="0.1" min="0" class="form-control" value="<?php echo set_value('clt_ref_level2'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level2') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('clt_ref_level3')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> client's Referral Commissions Level 3
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level3" step="0.1" min="0" class="form-control" value="<?php echo set_value('clt_ref_level3'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level3') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('clt_ref_level4')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> client's Referral Commissions Level 4
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level4" step="0.1" min="0" class="form-control" value="<?php echo set_value('clt_ref_level4'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level4') ?>
								</div>
								</div>
						</div>	
												<div class="form-group <?php if(form_error('clt_ref_level5')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> client's Referral Commissions Level 5
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level5" step="0.1" min="0" class="form-control" value="<?php echo set_value('clt_ref_level5'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level5') ?>
								</div>
								</div>
						</div>	
						<hr />
						<div class="form-group <?php if(form_error('commission')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Business 'Commissions' to Organization
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="commission" step="0.1" min="0" class="form-control" value="<?php echo set_value('commission'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('commission') ?>
								</div>
								</div>
						</div>
						<div class="form-group <?php if(form_error('benefits')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Business Tax 'Benefits' to Organization
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="benefits" step="0.1" min="0" class="form-control" value="<?php echo set_value('benefits'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('benefits') ?>
								</div>
								</div>
						</div>					
						<hr />
						<div class="form-group <?php if(form_error('seller_loyality')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> loyality to 'Seller'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="seller_loyality" step="0.1" min="0" class="form-control" value="<?php echo set_value('seller_loyality'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('seller_loyality') ?>
								</div>
								</div>
						</div>							
						<div class="form-group <?php if(form_error('client_loyality')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> loyality to 'Client'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="client_loyality" step="0.1" min="0" class="form-control" value="<?php echo set_value('client_loyality'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('client_loyality') ?>
								</div>
								</div>
						</div>					
						<hr />						
						 <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select the Date range:
                                <span class="text-red"></span>
                            </label>
							<!-- div class="example-container">		//Date $ Time Picker		
							<div>
								<input type="text" value="" id="basic_example_1" name="basic_example_1" />
							</div>					
							</div     -->
			
                            <div class="col-md-9">
									<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													
									   <input type="date" class="form-control" id="start_date" name="start_date">
									   <input type="date" class="form-control" id="end_date" name="end_date">
										<?php echo form_error('start_date') ?>
									</div>
							</div>
						</div>
						
					    <div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Comments/Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="remarks" class="form-control" value="<?php echo set_value('remarks'); ?>" placeholder="Enter Comments/Remarks">
									<?php echo form_error('remarks') ?>

								</div>
						</div> 
						 

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
</table>
                    <div class="box-footer"> <!--PATH: ledger/set_commissions and commissionListJson-->
                        <button type="submit" name="submit" value="add_commission" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Create Commissions
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('ledger/commissionListJson'); ?>",
                    "data": function ( d ) {
                        d.dateRange = $('[name="searchByNameInput"]').val();
                    }
                }
            });

            $('button#searchByDateBtn').on('click', function(){
                oTable.fnDraw();
            });

        });

    </script>
<!--*********************************************************************************************************** 

Anand Code for Date and time Pick										-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="jquery-ui-sliderAccess.js"></script>
		<script type="text/javascript" src="script.js"></script>
		
<!--
  jQuery Document ready
--> <script>
$(function()
{
	$('#basic_example_1').datetimepicker(
	{
		/*
			timeFormat
			Default: "HH:mm",
			A Localization Setting - String of format tokens to be replaced with the time.
		*/
		timeFormat: "hh:mm tt",
		/*
			hourMin
			Default: 0,
			The minimum hour allowed for all dates.
		*/
		hourMin: 8,
		/*
			hourMax
			Default: 23, 
			The maximum hour allowed for all dates.
		*/
		hourMax: 16,
		/*
			numberOfMonths
			jQuery DatePicker option
			that will show two months in datepicker
		*/
		numberOfMonths: 2,
		/*
			minDate
			jQuery datepicker option 
			which set today date as minimum date
		*/
		minDate: 0,
		/*
			maxDate
			jQuery datepicker option 
			which set 30 days later date as maximum date
		*/
		maxDate: 30
	});
	
	/*
		below code just enable time picker.
	*/	
	$('#basic_example_2').timepicker();
});		
		</script>
<!--*********************************************************************************************************** -->

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


<?php } ?>

