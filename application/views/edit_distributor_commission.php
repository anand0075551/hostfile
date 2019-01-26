
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css">


<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

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
                    <h3 class="box-title">Edit Voucher Permission</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
                    <div class="form-group <?php if (form_error('business_group')) echo 'has-error'; ?>">
								<label for="business_groups" class="col-md-3">Business Group
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
<?php 
$get_bg_name = $this->db->get_where('business_groups', ['id'=>$distributor_commission->business_group]);
foreach($get_bg_name->result() as $bg)?>
									<select name="business_group" id="business_group" class="form-control" onchange="get_area(this.value)">
										<option value="<?php echo $distributor_commission->business_group;?>"> <?php echo $distributor_commission->business_group .'-'. $bg->business_name?> </option>
										<?php
										if ($business_groups->num_rows() > 0) {
											foreach ($business_groups->result() as $bgs) {

											   echo '<option value="'.$bgs->id.'"> '.$bgs->id.'-'.$bgs->business_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('business_group') ?>

								</div>
							</div>
					
                    <div class="form-group <?php if (form_error('from_role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">From Role
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="from_role" id="from_role" class="form-control" onchange="get_user(this.value)">
                                <option value="<?php echo $distributor_commission->from_role;?>">

									<?php 
										$get = $this->db->get_where('role', ['id'=>$distributor_commission->from_role]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->rolename;
									?> 



								</option>
                                <?php
                                if ($rolename->num_rows() > 0) {
                                    foreach ($rolename->result() as $c) {

                                       echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('from_role') ?>

                        </div>
                    </div>
					
					
                    <div class="form-group <?php if (form_error('to_role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">To Role
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="to_role"  class="form-control" onchange="get_user(this.value)">
                                <option value="<?php echo $distributor_commission->to_role;?>">

									<?php 
										$get = $this->db->get_where('role', ['id'=>$distributor_commission->to_role]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->rolename;
									?> 



								</option>
                                <?php
                                if ($rolename->num_rows() > 0) {
                                    foreach ($rolename->result() as $c) {

                                       echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('to_role') ?>

                        </div>
                    </div>

                    
					 <div class="form-group <?php if (form_error('to_user')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">To User
                            
                        </label>
                        <div class="col-md-9">  								

                            <select name="to_user" class="form-control" id="to_user">
                                <option value="<?php echo $distributor_commission->to_user;?>"> <?php echo $distributor_commission->to_user;?>

										<?php /*
										$get = $this->db->get_where('users', ['id'=>$distributor_commission->to_user]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->first_name;*/
									?> 

								</option>
                               
                            </select>	                                
                            <?php echo form_error('to_user') ?>

                        </div>
                    </div>
						<div class="form-group <?php if (form_error('area')) echo 'has-error'; ?>">
								<label for="area" class="col-md-3">Area
									<span class="text-red">*</span>
								</label>
<?php  
$get_location = $this->db->get_where('area', ['id'=>$distributor_commission->area]);
foreach($get_location->result() as $l);
$location=$l->location;
$get_location_name = $this->db->get_where('location_id', ['id'=>$location]);
foreach($get_location_name->result() as $ln);?>
								<div class="col-md-9">  								

									<select name="area" id="area" class="form-control" onChange="check_exist()">
										<option value="<?php echo $distributor_commission->area;?>"><?php echo $distributor_commission->area .'-'.$ln->location;?> </option>
										
									</select>	                                
									<?php echo form_error('area') ?>

								</div>
							</div>

                   

                    <div class="form-group <?php if (form_error('percentage')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Percentage
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="percentage" id="percentage" class="form-control"  value="<?php echo $distributor_commission->percentage;?>" placeholder="Enter percentage" onChange="check_value(this.value)">                             
                            <?php echo form_error('percentage') ?>

                        </div>
                    </div>
					
					 
					
					

                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_commission" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
                </button>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->
</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>


<script type="text/javascript">
    $(function() {
//Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
//Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
//Money Euro
            $("[data-mask]").inputmask();
//Date range picker
            $('#reservation').daterangepicker();
//Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//Date range as a button
            $('#daterange-btn').daterangepicker(
    {
    ranges: {
    'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
    },
            startDate: moment().subtract('days', 29),
            endDate: moment()
    },
            function(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
    );
//iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
    });
//Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
    });
//Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
    });
//Colorpicker
            $(".my-colorpicker1").colorpicker();
//color picker with addon
            $(".my-colorpicker2").colorpicker();
//Timepicker
            /*$(".timepicker").timepicker({
             showInputs: false
             });
             });*/
</script>
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
            });</script>


<?php

function page_js() { ?>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
                        $(function() {
                        var oTable = $("#example").dataTable({
                        "processing": true,
                                "serverSide": true,
                                "ajax": {
                                "url": "<?php echo base_url('vouchers/vouchersListJson'); ?>",
                                        "data": function (d) {
                                        d.dateRange = $('[name="searchByNameInput"]').val();
                                        }
                                }
                        });
                                $('button#searchByDateBtn').on('click', function(){
                        oTable.fnDraw();
                        });
                        });</script>

<script>
	function get_user(id)
{
	//alert(id);
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Distributor_commission/get_user') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user").html(response);
			//alert(response);
		}
	});
}
</script>
<script>
	function get_area(bg_id)
{
	//alert(id);
	var mydata = {"bg_id": bg_id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('distributor_commission/get_area') ?>",
		data: mydata,
		success: function (response) {
			$("#area").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
function check_value(perc)
{
	
	 if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
      .test(perc))
	  {
		  if(perc <= 0)
		{
			alert('please enter a valid value');
			document.getElementById('percentage').value ='';
			return false;
		}
	  }
	  else
	  {
		   alert('Please input numeric characters only');
		  document.getElementById('percentage').value ='';  
		  return false;
	  }
      
}
</script>
<script>
	function check_exist()
	{
		var area = document.getElementById('area').value;
		var from_role = document.getElementById('from_role').value;
		var business_group = document.getElementById('business_group').value;
		if(from_role == '')
		{
			document.getElementById('area').value ='';
			alert('Please select from role');
			return false
		}
		else
		{
			var mydata = {"area": area,"from_role": from_role, "business_group": business_group };

			$.ajax({
			type: "POST",
			url: "<?php echo base_url('distributor_commission/check_exist') ?>",
			data: mydata,
			success: function (response) {
				if(response == 1)
				{
					alert('Already exist');
					location.reload(); 
				}
				
			}
			});   
		}
	
	
	}
</script>



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->

    <!-- Page script -->
    <script type="text/javascript">
                        $(function() {
                        //Date range picker
                        $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
                                //Date range picker with time picker
                                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                        });
                        //Date picker
                        $('#datepicker').datepicker({
                autoclose: true
                });
                        //Timepicker
                        $(".timepicker").timepicker({
                showInputs: false
                });</script>
    <!--for multiplication-->

  

	
	   <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>

