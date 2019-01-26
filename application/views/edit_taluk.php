
<?php function page_css(){ ?>


<?php } ?>

<?php include('header.php'); ?>
		<link href="<?php echo base_url('assets/admin'); ?>/lib_val/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('assets/admin'); ?>/lib_val/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>
		
        <link href="<?php echo base_url('assets/admin'); ?>/lib_val/spry/passwordvalidation/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('assets/admin'); ?>/lib_val/spry/passwordvalidation/SpryValidationPassword.js" type="text/javascript"></script>
		
        <link href="<?php echo base_url('assets/admin'); ?>/lib_val/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('assets/admin'); ?>/lib_val/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>
		
        <link href="<?php echo base_url('assets/admin'); ?>/lib_val/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('assets/admin'); ?>/lib_val/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>
		
        <link href="<?php echo base_url('assets/admin'); ?>/lib_val/spry/confirmvalidation/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('assets/admin'); ?>/lib_val/spry/confirmvalidation/SpryValidationConfirm.js" type="text/javascript"></script>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Taluk:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
						
						
						
						<div class="form-group <?php if(form_error('districtname')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">District
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" readonly name="districtname" class="form-control" value="<?php  $taluk->districtname; 
												 												 
												$table_name = 'taluk';
												$where_array = array('talukname' => $taluk->talukname);
												$query1 = $this->db->where($where_array)->get($table_name);
												if ($query1->num_rows() > 0)
												{	foreach($query1->result() as $row1)
														{
															$district_id = $row1->districtname;
															
															$table_name = 'district';
															$where_array = array('id' => $district_id);
															$query2 = $this->db->where($where_array)->get($table_name);
															foreach($query2->result() as $row2)
															{
																$district_name = $row2->districtname;
																
															}
														}
														
															echo $district_name; 
												}
												else{
													echo "State Doesnot Exist";
												 }
														?>" placeholder="Enter District Name">                                
                                <?php echo form_error('districtname') ?>
								
							</div>
                        </div>
						
					 
						
						
						<div class="form-group <?php if(form_error('talukname')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Taluk
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="talukname" class="form-control" value="<?php echo $taluk->talukname;?>" placeholder="Enter District Name">                                
                                <?php echo form_error('talukname') ?>
								
							</div>
                        </div>
						
					 
												                        
						
												                        
           


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_taluk" class="btn btn-primary">
                            <i class="fa fa-edit"></i>Update
                        </button>
					<a href="<?php echo base_url('location/view_taluk/'.$taluk->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Cancel</a>	
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->


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
$(".timepicker").timepicker({
showInputs: false
});
});
</script>
<!-- Validation -->
<script type="text/javascript">
<!--
//Firstname
var sprytf_firstname = new Spry.Widget.ValidationTextField("sprytf_firstname", 'none', {validateOn:["blur", "change"]});
//Lastname
var sprytf_lastname = new Spry.Widget.ValidationTextField("sprytf_lastname", 'none', {validateOn:["blur", "change"]});
//Password
/*var sprypass1 = new Spry.Widget.ValidationPassword("sprypwd", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});*/
//Confirm Password
/*var spryconf1 = new Spry.Widget.ValidationConfirm("sprycpwd", "sprypwd", {minChars:6, maxChars: 12, validateOn:["blur", "change"]});*/
//Email ID
var spryemail = new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
//Phone Number
var spryphone = new Spry.Widget.ValidationTextField("sprytf_phone", 'phone_number', {minChars:10, maxChars: 10,useCharacterMasking: true, validateOn:["blur", "change"]});
//Date of Birth
var sprypickupdate = new Spry.Widget.ValidationTextField("sprytf_pickupdate", 'date', {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
//Gender
var sprygender = new Spry.Widget.ValidationSelect("spryselect_gender");
//address
var spry_ad = new Spry.Widget.ValidationTextarea("spryta_address", {isRequired:true});
//city
var sprytf_city = new Spry.Widget.ValidationTextField("sprytf_city", 'none', {validateOn:["blur", "change"]});
//State
var sprytf_state = new Spry.Widget.ValidationTextField("sprytf_state", 'none', {validateOn:["blur", "change"]});
//ZipCode
var sprytf_zip = new Spry.Widget.ValidationTextField("sprytf_zip", 'integer', {minChars:6, maxChars: 6, validateOn:["blur", "change"]});
//Account Type
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect_acctype");
//Account Number
var spry_accno = new Spry.Widget.ValidationTextField("sprytf_accno", 'integer', {minChars:8, maxChars: 12, validateOn:["blur", "change"]});
var spry_pin = new Spry.Widget.ValidationTextField("sprytf_pin", 'integer', {minChars:6, maxChars: 6, validateOn:["blur", "change"]});
var spry_pin = new Spry.Widget.ValidationTextField("sprytf_mob", 'integer', {minChars:10, maxChars: 10, validateOn:["blur", "change"]});
var sprymobile = new Spry.Widget.ValidationTextField("sprytf_receivermob", 'integer', {minChars:10, maxChars: 15, validateOn:["blur", "change"]});
var spryconsignment = new Spry.Widget.ValidationTextField("sprytf_consignment", 'integer', {minChars:6, maxChars:6 , validateOn:["blur", "change"]});
var spryweight = new Spry.Widget.ValidationTextField("sprytf_weight", 'integer', {minChars:0, maxChars:6 , validateOn:["blur", "change"]});
var sprytf_add = new Spry.Widget.ValidationTextField("sprytf_add", 'none', {validateOn:["blur", "change"]});
var sprytf_address = new Spry.Widget.ValidationTextField("sprytf_address", 'none', {validateOn:["blur", "change"]});
var sprytf_quantity = new Spry.Widget.ValidationTextField("sprytf_quantity", 'none', {validateOn:["blur", "change"]});
var sprytf_length = new Spry.Widget.ValidationTextField("sprytf_length", 'none', {validateOn:["blur", "change"]});
var sprytf_width = new Spry.Widget.ValidationTextField("sprytf_width", 'none', {validateOn:["blur", "change"]});
var sprytf_height = new Spry.Widget.ValidationTextField("sprytf_height", 'none', {validateOn:["blur", "change"]});
//Confirm Password
//-->
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
                    "url": "<?php echo base_url('location/stateListJson'); ?>",
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

<?php } ?>

