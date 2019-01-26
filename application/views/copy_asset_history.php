
<?php

function page_css() { ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	<!-- Date-Time Picker -->
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
                    <h3 class="box-title"> Asset History </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
						<div class="form-group <?php if(form_error('visitor_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Visitor Id
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="visitor_id" class="form-control"  value="<?php echo $visitor_entry->visitor_id; ?>" placeholder="">
                                <?php echo form_error('visitor_id') ?>

                            </div>
                        </div>
						
						</div>
					
					
					 <div class="form-group <?php if (form_error('role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Name Role
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="role"  class="form-control" >
                                <option value="<?php echo $visitor_entry->role;?>">

									<?php
                                        $get = $this->db->get_where('assests_history',['id'=> $visitor_entry->id]);
                                        foreach($get->result() as $r);
                                        echo $r->role;
                                    ?>



								</option>
                                <?php
								
								$get_name = $this->db->get_where('role');
								foreach($get_name->result() as $p)
								{
									$name = $p->rolename;
									
									echo "<option value=".$name.">".$p->rolename."</option>";
								}
                                ?>
                            </select>	                                
                            <?php echo form_error('role') ?>

                        </div>
                    </div>
						
				
					  <div class="form-group <?php if (form_error('user')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Name Role
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="user"  class="form-control" >
                                <option value="<?php echo $visitor_entry->user;?>">

									<?php
                                        $get = $this->db->get_where('assests_history',['id'=> $visitor_entry->id]);
                                        foreach($get->result() as $r);
                                        echo $r->user;
                                    ?>



								</option>
                                <?php
								
								$get_name = $this->db->get_where('users');
								foreach($get_name->result() as $p)
								{
									$name = $p->first_name;
									
									echo "<option value=".$name.">".$p->first_name. ' '.$p->last_name."</option>";
								}
                                ?>
                            </select>	                                
                            <?php echo form_error('user') ?>

                        </div>
                    </div>
					
					<div class="form-group <?php if(form_error('cost_value_of_asset')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Cost Values of Asset 

									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="cost_value_of_asset" id="cost_value_of_asset" class="form-control"  value="<?php echo $visitor_entry->cost_value_of_asset;?>" placeholder="">
									<?php echo form_error('cost_value_of_asset') ?>

								</div>
					</div>
					
					<div class="form-group <?php if(form_error('condition_of_asset')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> <span> Condition of Asset</span></label>
                            <div class="col-md-9"> 
                                <select name="condition_of_asset" class="form-control" >
								<option value="<?php echo $visitor_entry->condition_of_asset;?>"> 
									
									<?php
                                        $get = $this->db->get_where('assests_history',['id'=> $visitor_entry->id]);
                                        foreach($get->result() as $r);
                                        echo $r->condition_of_asset;
                                    ?>
								</option>
                                 
										<option value=""> Select Condition of Asset </option>
										<option value ="Good"> Good </option>
										 <option value ="Normal"> Normal </option>
										 <option value ="Bad"> Bad</option>
										  <option value ="Poor"> Poor </option>
										  <option value ="Average"> Average </option>
										  
									</select>
                                <?php echo form_error('condition_of_asset') ?>
                            </div>
                        </div>
						
						<!--<div class="form-group < ?php if(form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Status

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="status" class="form-control"  value="< ?php echo $visitor_entry->status; ?>" placeholder="">
                                < ?php echo form_error('status') ?>

                            </div>
                        </div>-->
						
						<div class="form-group <?php if(form_error('next_renewal_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Next Renewal Date

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name=" next_renewal_date" id="next_renewal_date" class=" some_class form-control"  value="<?php echo $visitor_entry->next_renewal_date; ?>"  placeholder="">
                                <?php echo form_error('next_renewal_date') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Start Date

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name=" start_date" id="start_date" class=" some_class form-control"  value="<?php echo $visitor_entry->start_date; ?>"  placeholder="">
                                <?php echo form_error('start_date') ?>

                            </div>
                        </div>
						
						
						
						<div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">End Date

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="end_date"  id="end_date" class=" some_class form-control"  value="<?php echo $visitor_entry->end_date; ?>" placeholder="">
                                <?php echo form_error('end_date') ?>

                            </div>
                        </div>
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                        
				
			    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
				
                    <button type="submit" name="submit" value="copy_asset" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Insert Asset History
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->


<?php function page_js() { ?>

<!----Datepiker SCRIPT  Files---->

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
	
	<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>

<?php } ?>





