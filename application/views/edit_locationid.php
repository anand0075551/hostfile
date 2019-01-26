
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
                    <h3 class="box-title">Edit Area Location:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
						
						
						
						
						
						<div class="form-group <?php if(form_error('location')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Area Location
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="location" class="form-control" value="<?php echo $location_id->location;?>" placeholder="Enter State Name">                                
                                <?php echo form_error('location') ?>
								
							</div>
                        </div>
					<div class="form-group <?php if(form_error('location')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Taluk
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input name="" type="text" readonly class="form-control" value="<?php
									if($location_id->taluk != ''){
									echo $location_id->taluk;

								} else {
                                    echo "Taluk Doesnot Exist";
                                }
									
									?>">                                
                                <?php echo form_error('location') ?>
								
							</div>
                        </div>
						                
												                        
						
												                        
           


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_locationid" class="btn btn-primary">
                            <i class="fa fa-edit"></i>Update
                        </button>
					<a href="<?php echo base_url('location/view_locationid/'.$location_id->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Cancel</a>	
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->



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
        });
    </script>


<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>




	    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
	
	
	<!--pincode search -->
	
	<script>
	function get_state(id)
{
 //   alert(id);
    var mydata = {"country": id};

    $.ajax({
        type: "POST",
		url: "<?php echo base_url('Location/getstate') ?>",
      //  url: "getstate",
        data: mydata,
        success: function (response) {
            $("#state").html(response);
            //alert(response);
        }
    });
}




	function get_districts(id)
{
//  alert(id);
    var mydata = {"state": id};

    $.ajax({
        type: "POST",
		url: "<?php echo base_url('Location/get_districts') ?>",
     //   url: "get_districts",
        data: mydata,
        success: function (response) {
            $("#district").html(response);
            //alert(response);
        }
    });
}

function get_taluk(id)
{  //   alert(id);
    var mydata = {"district": id};

    $.ajax({
        type: "POST",
		url: "<?php echo base_url('Location/get_taluk') ?>",
     //   url: "get_taluk",
        data: mydata,
        success: function (response) {
			$("#taluk").html(response);
        }
    });
}







</script>

	<!-- -->
<?php } ?>

