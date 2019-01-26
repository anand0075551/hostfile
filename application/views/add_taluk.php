
<?php function page_css(){ ?>

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
                    <h3 class="box-title">Add State:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                     

                        <div class="form-group <?php if(form_error('shipper_pincode')) echo 'has-error'; ?>">
                            <label for="state" class="col-md-3">State <span class="text-red">*</span></label>
                            <div class="col-md-9">
                               <select name="state" id="state" class="form-control" onchange="get_district(this.value)">
                                    <option value=""> Select State </option>
                                    <?php
                                    if($state->num_rows() > 0)
                                    {
                                        foreach($state->result() as $c){
                                           // $selected = ($c->id == 105)? 'selected' : '';
                                            echo '<option value="'.$c->id.'"> '.$c->statename.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('shipper_pincode') ?>
                            </div>
                        </div>
                        

						
						<div class="form-group <?php if(form_error('district')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="districtname" id="district" class="form-control">
                                    <option value=""> Select District </option>
                                    
                                </select>
                                <?php echo form_error('district') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('talukname')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Taluk
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="talukname" class="form-control" value="<?php echo set_value('talukname'); ?>" placeholder="Enter Taluk Name">                                
                                <?php echo form_error('talukname') ?>
								
							</div>
                        </div>
						
					 
												                        
						
												                        
           


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_taluk" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Taluk
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->


<script type="text/javascript">

</script>
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
        });
    </script>


<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('vouchers/vouchersListJson'); ?>",
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
    </script>
	    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
	
	
	
	
	
	
	
	
	
	
<script>




	function get_district(id)
{
  
    var mydata = {"state": id};

    $.ajax({
        type: "POST",
        url: "get_district",
        data: mydata,
        success: function (response) {
            $("#district").html(response);
            //alert(response);
        }
    });
}

							</script>
	
	
	
	
	
	
	
	
<?php } ?>

