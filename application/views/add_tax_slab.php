<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
   <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	
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
                    <h3 class="box-title">Add Tax Slab</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
			<!--- add tax id--------------------------------------------------------------------------------------->
                      <div class="form-group">
						<label for="firstName" class="col-md-3">Tax Category
							<span class="text-red">*</span>
                        </label>
					   <div class="col-md-9">
						<select class="form-control" name="tax_id" id="tax_id" style=" width:100% auto; ">
							<option value=""></option>
							<?php 
								$get_users = $this->db->group_by('tax_idname')->get_where('tax_id');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->id.">".$p->tax_idname."</option>";
								}
							?>
						</select>
						</div>
					</div>
					 
			<!--- add tax id end--------------------------------------------------------------------------------------->
			
			         
			<!--- add Business Group----------------------------------------------------------------------------------->
                      <div class="form-group">
						<label for="firstName" class="col-md-3">Business Group
							<span class="text-red">*</span>
                        </label>
					   <div class="col-md-9">
						<select class="form-control" name="business" id="business" style=" width:100% auto; ">
							<option value=""></option>
							<?php 
								$get_users = $this->db->group_by('business_name')->get_where('business_groups');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->id.">".$p->business_name."</option>";
								}
							?>
						</select>
						</div>
					</div>
					 
			<!--- add tax id end--------------------------------------------------------------------------------------->



			
	                    <div class="form-group <?php if(form_error('tax_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Tax Name
								<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="tax_name" class="form-control"  value="<?php echo set_value('tax_name'); ?>" placeholder="">
                                <?php echo form_error('tax_name') ?>

                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('value')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Value
								<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="value" class="form-control"  value="<?php echo set_value('value'); ?>" placeholder="">
                                <?php echo form_error('value') ?>

                            </div>
                        </div>
						
		
						<div class="form-group < ?php if(form_error('sart_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Start Date
								<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sart_date"  placeholder=""/>
                                <?php echo form_error('sart_date') ?> 
								

                            </div>
                        </div>
						<div class="form-group < ?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">End Date
								<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_2" name="end_date"  placeholder=""/>
                                <?php echo form_error('end_date') ?>

                            </div>
                        </div>
					
						
					<!-- Upload file -->
						
				
                        
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="Tax" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add 
                        </button>
                    </div>
                </form>
				</div>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->
   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

    <!-- InputMask -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
	
	
	
   
<!----Datepiker SCRIPT  Files---->
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
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
	
<?php } ?>

