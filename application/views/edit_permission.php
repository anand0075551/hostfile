
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
                    <h3 class="box-title">Edit Epin:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                                <div class="form-group <?php if(form_error('userrole')) echo 'has-error'; ?>">
                    <label for="firstName" class="col-md-3">Select User Roles</label>
                    <div class="col-md-9">
                        <select name="userrole" class="form-control"  >
                            <option value=""> Select User Role </option>
                            <?php
                            if($role->num_rows() > 0)
                            {
                            foreach($role->result() as $c){
                            $selected = ($c->id == 105)? 'selected' : '';

						    echo '<option value=" '.$c->id.' " '.$selected.'> '.$c->rolename. '</option>';	
								
                            }
                            }
                            ?>
                        </select>
                        <?php echo form_error('userrole') ?>
				
            </div>
						
				</div>
				
				
            <div class="form-group <?php if(form_error('business_name')) echo 'has-error'; ?>">
                    <label for="firstName" class="col-md-3">Select Left Menu Name</label>
                    <div class="col-md-9">
                        <select name="business_name" class="form-control"  >
                            <option value=""> Select Label</option>
                            <?php
                            if($bussiness_name->num_rows() > 0)
                            {
                            foreach($bussiness_name->result() as $c){
                           

						    echo '<option value=" '.$c->id.' " '.$selected.'>'.$c->id. '- '.$c->bussiness_name. '-'.$c->comments. '</option>';		
								
                            }
                            }
                            ?>
                        </select>
                        <?php echo form_error('business_name') ?>
				
            </div>
						
				</div>
						
					            <div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                <label for="firstName" class="col-md-3"> Permission
                    <span class="text-red">*</span>
                </label>
                <!--                        <div class="col-md-9">
                    <input type="text" name="profession" class="form-control" value="<-?php echo set_value('profession'); ?>" placeholder="Select the Member type">
                    <-?php echo form_error('profession') ?>
                </div>
                **********Profession and Role fields are considered same for time being/Sync with App\view\add_agent***********
                -->                     <div class="col-md-9">
                        <select name="status" class="form-control">
                            <option value="0"> Please Select Your Permission  </option>
							
						    <option value="1"<?php if($permission->status == '1') echo 'selected'; ?> >Active</option>
							<option value="0"<?php if($permission->status == '0') echo 'selected'; ?> >InActive</option>
                        </select>
                        <?php echo form_error('status') ?>

                </div>
            </div>	
						
					
					
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_permission" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit Permission
                        </button>
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
	
	<script>
	function get_to_user(id)
	{
		 var mydata = {"parentid": id};

		$.ajax({
			type: "POST",
			url: "get_to_user",
			data: mydata,
			success: function (response) {
				$("#to_user").html(response);
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

