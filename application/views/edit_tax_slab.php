


<?php

function page_css() { ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
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
                    <h3 class="box-title">Edit Tax Slab</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
					<!--edit tax id----------------------------------------------------------->
					<div class="form-group">
						<label for="firstName" class="col-md-3">Tax Id
							<span class="text-red">*</span>
                        </label>
					   <div class="col-md-9">
						<select class="form-control" name="tax_id" id="tax_id" style=" width:100% auto; ">
						<option value="<?php echo $tax_slabs->tax_id; ?>"><?php 
							 $get_tax_slab = $this->db->get_where('tax_id', ['id'=>$tax_slabs->tax_id]);
					         foreach($get_tax_slab->result() as $uu);
			                 $tax_id = $uu->tax_idname;
							 echo $tax_id; ?>
							<?php 
								$get_users = $this->db->get('tax_id');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->id.">".$p->tax_idname."</option>";
								}
							?>
						</option>
						</select>
						</div>
					</div>
						
					
					
					<!----------------------------------------------------------------------->
					
					<!--edit tax id----------------------------------------------------------->
				<div class="form-group">
						<label for="firstName" class="col-md-3">Business Group
							<span class="text-red">*</span>
                        </label>
					   <div class="col-md-9">
						<select class="form-control" name="business" id="business" style=" width:100% auto; ">
							<option value="<?php echo $tax_slabs->business; ?>"><?php  
								$query2 = $this->db->get_where('business_groups', ['id' => $tax_slabs->business]);

								if ($query2->num_rows() > 0) {
								foreach ($query2->result() as $row2) {
								$business =  $row2->business_name;
								}
								} else {
								$business =  " ";
								} 
										
							echo $business; ?>
							<?php 
								$get_users = $this->db->get('business_groups');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->id.">".$p->business_name."</option>";
								}
							?>
							</option>
						</select>
						</div>
					</div>
						
					
					
					<!----------------------------------------------------------------------->


                        <div class="form-group <?php if(form_error('tax_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Tax Name</label>
                            <div class="col-md-9"  value="<?php echo set_value('tax_name'); ?>">
                                 <input type="text" name="tax_name" class="form-control" value="<?php echo $tax_slabs->tax_name; ?>" placeholder="">
                                <?php echo form_error('tax_name') ?>
                            </div>
                        </div>
						
						
						 <div class="form-group <?php if(form_error('value')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Value</label>
                            <div class="col-md-9"  value="<?php echo set_value('value'); ?>">
                                 <input type="text" name="value" class="form-control" value="<?php echo $tax_slabs->value; ?>" placeholder="">
                                <?php echo form_error('value') ?>
                            </div>
                        </div>
						
						 <div class="form-group <?php if(form_error('sart_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Start Date</label>
                            <div class="col-md-9"  value="<?php echo set_value('sart_date'); ?>">
                                 <input type="text" class="some_class form-control" style="height:30px;" value="<?php echo $tax_slabs->start_date; ?>" id="some_class_1" name="sart_date"  placeholder=""/>
                                <?php echo form_error('sart_date') ?>
                            </div>
                        </div>
						
						 <div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">End Date</label>
                            <div class="col-md-9"  value="<?php echo set_value('end_date'); ?>">
                                 <input type="text" class="some_class form-control" style="height:30px;" value="<?php echo $tax_slabs->end_date; ?>" id="some_class_2" name="end_date"  placeholder=""/> 
                                <?php echo form_error('end_date') ?>
                            </div>
                        </div>
						
      
			    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
				
                    <button type="submit" name="submit" value="edit_transport" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update
                        
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>

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

<?php } ?>

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



