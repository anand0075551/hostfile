<?php

//check category/public function wallet_to_discount()


?>
<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

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
                    <h3 class="box-title">Points Exchange/Conversion</h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					 
							
					<div class="form-group <?php if(form_error('usertype')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">User Type</label>
							<div class="col-md-9">
								<select name="usertype" class="form-control">
									<option value=""> Select User Type </option>
									<option value="user" 	<?php echo set_select('usertype', 'user')   ?>>Customer</option>
									<option value="agent" 	<?php echo set_select('usertype', 'agent')  ?>>Agent</option>   							
								</select>
								 	<?php echo form_error('usertype') ?>
							</div>
						</div>
						

 				<div class="form-group <?php if(form_error('rolename')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Role Name</label>
							<div class="col-md-9">
								 <select name="rolename" class="form-control">
												<option  value="">Select Role Name</option>
												<?php foreach($rolename->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->rolename.'</option>';
												}                                        
												?>
										</select>
								 <!-- <input type="text" name="rolename" class="form-control" value="<?php echo set_value('rolename'); ?>" placeholder="Eg: Distributor/Retailor">
							-->	<?php echo form_error('rolename') ?>
							</div>
						</div>


					</table>	
							 
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Screen Menu </label>
										
											<div class="col-md-9">		
												<table class="table table-bordered">											
													<tr>
															<td><b>	Ledger Accounts <input type="checkbox" readonly  name="identity_id" checked value="ledger"  ></b><hr />
																Ledger Overview	 
																<br> Maintain Ledger	 
																<br> Transfer between Accounts</td> 
																<th> View 	 <hr /> 
																	<input type="radio" name="ledg_01" value="0">
															<br>	<input type="radio" name="ledg_02" value="0">
															<br>	<input type="radio" name="ledg_03" value="0">
															</th>
																<th> Edit	<hr /> 
																	<input type="radio" name="ledg_01" value="1">
															<br>	<input type="radio" name="ledg_02" value="1">
															<br>	<input type="radio" name="ledg_03" value="1">
															</th>
																<th> No Access 	<br> <hr /> 
																	<input type="radio" name="ledg_01" value="2">
															<br>	<input type="radio" name="ledg_02" value="2">
															<br>	<input type="radio" name="ledg_03" value="2">
															</th>
																</tr>														
																								
																<tr>
															<td><b> Sales Transactions <input type="checkbox" readonly  name="identity_id" checked value="sales"  ></b><hr />
																Recieve Funds	
																<br> Recharge Mobile	 
																<br> Train Tickets Booking	 
																<br> Flight Tickets Booking	 
																<br> Bus Tickets Booking	</td> 
																<th> View 	 <hr /> 
																	<input type="radio" name="sales_01" value="0">
															<br>	<input type="radio" name="sales_02" value="0">
															<br>	<input type="radio" name="sales_03" value="0">
															<br>	<input type="radio" name="sales_04" value="0">
															<br>	<input type="radio" name="sales_05" value="0">
															</th>
																<th> Edit	<hr /> 
																	<input type="radio" name="sales_01" value="1">
															<br>	<input type="radio" name="sales_02" value="1">
															<br>	<input type="radio" name="sales_03" value="1">
															<br>	<input type="radio" name="sales_04" value="1">
															<br>	<input type="radio" name="sales_05" value="1">
															</th>
																<th> No Access 	<br> <hr /> 
																	<input type="radio" name="sales_01" value="2">
															<br>	<input type="radio" name="sales_02" value="2">
															<br>	<input type="radio" name="sales_03" value="2">
															<br>	<input type="radio" name="sales_04" value="2">
															<br>	<input type="radio" name="sales_05" value="2">
															</th>
													</tr>														
											</table>
											</div>
								</div>	
															
							
																	
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->


                    <div class="box-footer">      <!-- PATH: //check category/public function wallet_to_discount() -->
                        <button type="submit" name="submit" value="create_authorizations" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Create New Authorizations
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
                    "url": "<?php echo base_url('category/categoryListJson'); ?>",
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

<!--Anand J-query-->
	
<script>
<!-- For Convertion Ratio Flip View -->
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});




$(document).ready(function(){
    $("#hide").click(function(){
        $("#div1").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div1").show();
		// alert("The paragraph is now Showing");
    });
});

$(document).ready(function(){
    $("#hide").click(function(){
        $("#div2").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div2").show();
		// alert("The paragraph is now Showing");
    });
});
$(document).ready(function(){
     $("button").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
    });
});


</script>

<style>
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 50px;
    display: none;
}
</style>
</head>

<?php } ?>

