
<?php

function page_css() { ?>
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
                    <h3 class="box-title">Select Product</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				
				
				<!--=============================-->
					<div class="form-group <?php if (form_error('product_preparation')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="product_preparation"  class="form-control" style="width:100% auto;" onchange="get_product_prepration(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($type->num_rows() > 0) {
											foreach ($type->result() as $c) {

											$product =$c->product_id;
											
											
				$get_product_type = $this->db->group_by('product_name','desc')->get_where('product_preparation',['id'=>$product]);
											foreach ($get_product_type->result() as $pro_type)
											
											$pro_type_name= $pro_type->product_type;
											
											
											
											   echo '<option value="'.$product.'"> '.$pro_type_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('product_preparation') ?>

								</div>
							</div>
				<!--=============================-->
					<div class="form-group <?php if (form_error('product_preparation')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Prepration
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="product_preparation" id="to_product_prepration" style="width:100% auto;" class="form-control">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('product_preparation') ?>

								</div>
							</div>
						
           
           
                    
                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="select_product" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit Now
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

   <script>
	function get_product_prepration(id)
{
	//alert(id);
	var mydata = {"id" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_product_prepration') ?>",
		data: mydata,
		success: function (response) {
			$("#to_product_prepration").html(response);
			//alert(response);
		}
	});
}





</script>

 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>

<?php } ?>

