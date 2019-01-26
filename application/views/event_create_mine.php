
<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    <!-- select -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
    <!-- Add Event-->
        <div class="col-md-12" id="add_form">
            <!-- general form elements -->

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3>
                </div><!-- /.box-header -->
                <!-- Add My Stock form start -->
                <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
                    <div class="box-body">
                    <!--Collapsible -->
                    <div>
          <div>
            
            <!-- /.box-header -->
            <div>
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                       Basic Details
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <!-- -->
                      <div class="form-group <?php if (form_error('categ')) echo 'has-error'; ?>">
								<label for="categ" class="col-md-3">Category
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<select name="categ" id="categ" class="form-control" onChange="get_sub_categ(this.value)">
										<option value=""> Choose  </option>
										<?php
										if ($category->num_rows() > 0) 
										{
											foreach ($category->result() as $categ) 
											{
												echo '<option value="'.$categ->id.'"> '.$categ->name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('categ') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('sub_categ')) echo 'has-error'; ?>">
								<label for="sub_categ" class="col-md-3">Sub-Categoty
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9">  
                                	<select name="sub_categ" id="sub_categ" class="form-control" >
										<option value=""> Choose Category First</option>
										
									</select>	
                                                                 
									<?php echo form_error('sub_categ') ?>

								</div>
						</div>
                        <div class="form-group <?php if(form_error('budget')) echo 'has-error'; ?>">
                            <label for="budget" class="col-md-3">Budget
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="budget" id="budget" class="form-control" placeholder="Enter Amount">
                                <?php echo form_error('budget') ?>
                            </div>
                        </div>
                      <!-- -->
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                       Seat Details
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="box-body">
                                  <!-- -->
                                  <div class="form-group <?php if(form_error('participants')) echo 'has-error'; ?>">
                                    <label for="participants" class="col-md-3">Seats
                                        <span class="text-red">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" name="participants" id="participants" class="form-control" placeholder="Enter total number of seats">
                                        <?php echo form_error('participants') ?>
                                    </div>
                                </div>
                                  <!--Seat categ -->
                                      <div class="form-group">
                                        <label for="categ" class="col-md-3">Select Type  <span class="text-red">:</span> </label>
                                        <div class="col-md-9">  								
                                            <select name="seat_categ" id="seat_categ" class="form-control" onChange="get_seat_sub_categ(this.value)" style="width:555px">
                                                <option value=""> Choose  </option>
                                                <?php
                                                if ($seat_category->num_rows() > 0) 
                                                {
                                                    foreach ($seat_category->result() as $seat_categ) 
                                                    {
                                                        echo '<option value="'.$seat_categ->id.'"> '.$seat_categ->name.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>	                                
                                         </div>
                                        </div>
                                      <!--/.seat categ -->
                                      <!--Seat sub categ -->
                                      <div class="form-group">
                                    <label for="sub_categ" class="col-md-3">Sub
                                        <span class="text-red">:</span>
                                    </label>
                                    <div class="col-md-9" id="seat_sub_categ">Select Type First </div><!--Do not Delete -->
                                    </div>
                                    
                                      <!--/.seat sub categ -->
                                      <div class="col-md-12" id="dynamic_seat"></div><!--DO NOT DELETE -->
                                  
                                <div class="form-group">
                            <label for="budget" class="col-md-3">Registration Fee</label>
                            <div class="col-md-9" id="seats">
                             <strong>Seat Name : </strong><input type="text" name="seat_name" class="form-control"/> <br>
							<strong>Seat From : </strong><input type="text" name="seat_from" class="form-control"/> <br>
                           <strong> Seat To :</strong> <input type="text" name="seat_to"  class="form-control"/> <br>
                           <strong> Reg.Fee :</strong><input type="text" name="seat_fee"  class="form-control"/><br><br>
                            <strong> Refund deduction % :</strong><input type="text" name="seat_refund"  class="form-control"/><br><br>
                            <input onClick="addseatsRow(this.form);" type="button" value="Add" class="btn btn-warning"/> 
                            (This row will not be saved unless you click on "Add" first)
                                
                            </div>
                            <!--<div class="col-md-9">
                                <input type="text" name="reg_fee" id="reg_fee" class="form-control" placeholder="Enter Amount" value="0">
                               
                            </div>-->
                        </div>
                                  <!-- -->
                                </div>
                              </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                         Event Details
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      <!-- -->
                      <div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="name" class="col-md-3">Event Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Event Name">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="country" class="col-md-3">Country
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" id="elocation" >  
                                	<select name="country" id="country" class="form-control" onChange="get_state(this.value)" style="width:555px">
										<option value=""> Choose country </option>
										<?php
										if ($countrys->num_rows() > 0) 
										{
											foreach ($countrys->result() as $country) 
											{
												echo '<option value="'.$country->country.'"> '.$country->country.'</option>';
											}
										}
										?>
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="state" class="col-md-3">State
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" id="elocation" >  
                                	<select name="state" id="state" class="form-control" onChange="get_district(this.value)" style="width:555px">
										<option value=""> Choose country First</option>
										
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="district" class="col-md-3">District
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" id="elocation" >  
                                	<select name="district" id="district" class="form-control" onChange="get_location(this.value)" style="width:555px">
										<option value=""> Choose country First</option>
										
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="location" class="col-md-3">Location
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" id="elocation" >  
                                	<select name="location" id="location" class="form-control" style="width:555px">
										<option value=""> Choose Event location </option>
										<?php
										/*if ($locations->num_rows() > 0) 
										{
											foreach ($locations->result() as $location) 
											{
												echo '<option value="'.$location->id.'"> '.$location->pincode.'-'.$location->location.'</option>';
											}
										}*/
										?>
									</select>	

                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if(form_error('venue')) echo 'has-error'; ?>">
                            <label for="venue" class="col-md-3">Event Venue
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea name="venue" id="venue" class="form-control"></textarea>
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group">
								<label for="location" class="col-md-3">Invite
									<span class="text-red">*</span>
								</label>
                                
								<div class="col-md-9">
                                <!-- users -->
                                <div id="in_users">
                                <div class="col-md-3">
                                <strong>Select Users</strong> <input type="radio" id="select_users" name="select_users" value="1"  > : 
                                </div>
                                 
                                <div id="tt">
                                      <select name="my_users[]" id="my_users" class="form-control"  multiple style="width:555px">
										<option value=""> Choose Users </option>
										<?php
										if ($users->num_rows() > 0) 
										{
											foreach ($users->result() as $user) 
											{
												echo '<option value="'.$user->id.'"> '.$user->contactno.'-'.$user->first_name.' '.$user->last_name.'</option>';
											}
										}
										?>
									</select>	
                                    </div>    </div>  <br>         
									<!--open to all -->
                                    <div  id="in_open" style="background-color:#F5F5F5">
                                    <div class="col-md-9">
                                    <strong> Open to all</strong> <input type="radio" id="open_to_all" name="select_users" value="0"  > :</div> <br><br>
                                    <!--Select BG and area -->
                                    
                                     <div class="col-md-4"> 
                                    <select name="bg" id="bg" class="form-control"   style="width:255px" onChange="get_area(this.value)">
										<option value=""> Choose Business Group </option>
										<?php
										if ($bgs->num_rows() > 0) 
										{
											foreach ($bgs->result() as $bg) 
											{
												echo '<option value="'.$bg->id.'"> '.$bg->id.'-'.$bg->business_name.'</option>';
											}
										}
										?>
									</select>
                                    </div>
                                     <div class="col-md-4">
                                    			<select name="area" id="area" class="form-control" style="width:255px">
                                                    <option value="">Area- Select Business group First</option>
                                                    
                                                </select>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <input onClick="addopenRow(this.form);" type="button" value="Add" class="btn btn-warning"/> 
                            (This row will not be saved unless you click on "Add" first)
                                                <!--/.Select BG and area -->
                                                <div class="col-md-9" id="dynamic_open"></div>
                                                <br><br>
                                                <strong> Select Role : </strong><select name="open_role[]" id="open_role" class="form-control" style="width:555px" multiple>
                                    <option value=""> Choose  </option>
                                    <?php
                                    if ($roles->num_rows() > 0) 
                                    {
                                        foreach ($roles->result() as $role) 
                                        {
                                            echo '<option value="'.$role->id.'"> '.$role->id.' -'.$role->rolename.'</option>';
                                        }
                                    }
                                    ?>
                                </select><br><br>
                                </div>
                                    <!-- -->

								</div>
						</div>
                        <div class="form-group">
                            <label for="sms" class="col-md-3">Send SMS</label>
                            <div class="col-md-9">
                                <input type="text" name="send_sms" placeholder="9638527411,147258369,9876543211....." class="form-control">
                             </div>
                        </div>
                      <!-- -->
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                              <div class="box-header with-border">
                                <h4 class="box-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                   Date Details
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseFour" class="panel-collapse collapse">
                                <div class="box-body">
                                 <!-- -->
                                 <div class="form-group <?php if(form_error('rf_time')) echo 'has-error'; ?>">
                            <label for="registration" class="col-md-3">Registration Date 
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                             Start : <input type="text" class="some_class" value="" id="some_class_1" name="rf_time" placeholder="select start date"/>
							End : <input type="text" class="some_class" value="" id="some_class_2" name="rt_time" placeholder="select end date"/>
                               
                                <?php echo form_error('rf_time') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('f_time')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Event Date & Time
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                             From : <input type="text" class="some_class" value="" id="some_class_1" name="f_time" placeholder="select start date"/>
							To : <input type="text" class="some_class" value="" id="some_class_2" name="t_time" placeholder="select end date"/>
                               
                                <?php echo form_error('f_time') ?>
                            </div>
                        </div>
                                 <!-- -->
                                </div>
                              </div>
                            </div>
                            <div class="panel box box-success">
                              <div class="box-header with-border">
                                <h4 class="box-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                   Additional Details
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseFive" class="panel-collapse collapse">
                                <div class="box-body">
                                 <!-- -->
                                 <div class="form-group <?php if (form_error('host')) echo 'has-error'; ?>">
								<label for="host" class="col-md-3">Host
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<select name="host" id="host" class="form-control" style="width:555px">
										<option value=""> Choose Host </option>
										<?php
										if ($users->num_rows() > 0) 
										{
											foreach ($users->result() as $user) 
											{
												echo '<option value="'.$user->id.'"> '.$user->contactno.'-'.$user->first_name.' '.$user->last_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('host') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('guest')) echo 'has-error'; ?>">
								<label for="guest" class="col-md-3">Guest
									<!--<span class="text-red">*</span>-->
								</label>
								<div class="col-md-9">  								
									<select name="guest" id="guest" class="form-control" style="width:555px">
										<option value=""> Choose  </option>
										<?php
										if ($users->num_rows() > 0) 
										{
											foreach ($users->result() as $user) 
											{
												echo '<option value="'.$user->id.'"> '.$user->contactno.'-'.$user->first_name.' '.$user->last_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('guest') ?>

								</div>
						</div>
                        <div class="form-group <?php if(form_error('add_guest')) echo 'has-error'; ?>">
                            <label for="add_guest" class="col-md-3">Additionl Guests
                                <!--<span class="text-red">*</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="add_guest" id="add_guest" class="form-control" placeholder="Enter  Count">
                                <?php echo form_error('add_guest') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('clables')) echo 'has-error'; ?>">
                            <label for="participants" class="col-md-3">Event Activities</label>
                            <div class="col-md-9" id="itemRowsclabel">
                             <input type="text" name="clabel" id="clabel" class="form-control" placeholder="This row will not be saved unless you click on Add"Add row" first"> <input onClick="addclabelRow(this.form);" type="button" value="Add" class="btn btn-warning"/>
                                <?php echo form_error('participants') ?>
                            </div>
                        </div>
                                <!-- -->
                                </div>
                              </div>
                            </div>
                            <div class="panel box box-success">
                              <div class="box-header with-border">
                                <h4 class="box-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                  Invitation card
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseSix" class="panel-collapse collapse">
                                <div class="box-body">
                                 <!-- -->
                                 <div class="form-group">
								<label for="status" class="col-md-3">Invitation Image</label>
								<div class="col-md-9">  								
									<input type="file" name="userfile"  class="form-control"/>                                
								</div>
						</div>
                                 <!-- -->
                                </div>
                              </div>
                            </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
                    <!--Collapsible -->
                    	
                         
                        
				<div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                  		<button type="submit" name="submit" value="create_event" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create Now
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- Register-->
        
        

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

   <!--<script src="< ?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>-->
  <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
 
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

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
     <!-- Dynamic open -->
<script type="text/javascript">
var rowNum = 0;
function addopenRow(frm) {
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'">Business Group '+rowNum+': <input type="text" name="sbg[]"  value="'+frm.bg.value+'"> Area: <input type="text" name="sarea[]" size="4" value="'+frm.area.value+'"><input type="button" value="Remove" class="btn btn-inform" onclick="removeRow('+rowNum+');"></p>';
	jQuery('#dynamic_open').append(row);
	
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
    <!-- Dynamic C lable-->
    <script type="text/javascript">
var rowNum = 0;
function addclabelRow(frm) {
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'">Custom Label '+rowNum+': <input type="text" name="label[]" size="4" class="form-control" value="'+frm.clabel.value+'"> <input type="button" value="Remove" class="btn btn-inform" onclick="removeclabelRow('+rowNum+');"></p>';
	jQuery('#itemRowsclabel').append(row);
	frm.clabel.value = '';
	
}

function removeclabelRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
<!-- Dynamic sponsor -->
<script type="text/javascript">
var rowNum = 0;
function addsponsorRow(frm) {
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'">For '+rowNum+': <input type="text" name="sfor[]"  value="'+frm.sponsor_for.value+'"> Charge: <input type="text" name="scharge[]" size="4" value="'+frm.sponsor_charge.value+'">To: <input type="text" name="sto[]" size="4" value="'+frm.sponsor_to.value+'"> <input type="button" value="Remove" class="btn btn-inform" onclick="removeRow('+rowNum+');"></p>';
	jQuery('#itemRows').append(row);
	frm.sponsor_for.value = '';
	frm.sponsor_charge.value = '';
	
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
<!-- Dynamic Seats -->
<script type="text/javascript">
var rowNum = 0;
function addseatsRow(frm) {
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'">Seat Name '+rowNum+': <input type="text" name="seatname[]"  value="'+frm.seat_name.value+'">Seat From : <input type="text" name="seatfrom[]"  value="'+frm.seat_from.value+'"> Seat To: <input type="text" name="seatto[]" size="4" value="'+frm.seat_to.value+'">Reg.Fee: <input type="text" name="seatfee[]" size="4" value="'+frm.seat_fee.value+'">Refund %: <input type="text" name="seatrefund[]" size="4" value="'+frm.seat_refund.value+'"> <input type="button" value="Remove" class="btn btn-inform" onclick="removeSRow('+rowNum+');"></p>';
	jQuery('#seats').append(row);
	frm.seat_from.value = '';
	frm.seat_to.value = '';
	frm.seat_fee.value = '';
	frm.seat_name.value = '';
	frm.seat_refund.value = '';
	
}

function removeSRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
    <script>
	function get_sub_categ(category)
{
	//alert(id);
	var mydata = {"category": category};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_sub_categ') ?>",
		data: mydata,
		success: function (response) {
			$("#sub_categ").html(response);
			//alert(response);
		}
	});   
	if(category == 1)
	{
		$('#in_users').hide();
		$('#in_open').show();
	}
	else
	{
		$('#in_open').hide();
		$('#in_users').show();
	}
}

</script>
    
    <script type="text/javascript">
	$(document).ready(function () {
    $('#select_users').change(function () {
      $('#tt').show();
	   $('#open_to_all').attr('checked', false); 
    });
});

</script>
  <script type="text/javascript">
	$(document).ready(function () {
    $('#open_to_all').change(function () {
      $('#tt').hide();
	  $('#select_users').attr('checked', false); 
    });
});

</script>
    <script>
	function get_state(country)
{
	//alert(id);
	var mydata = {"country": country};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_state') ?>",
		data: mydata,
		success: function (response) {
			$("#state").html(response);
			//alert(response);
		}
	});   
}

</script>
 <script>
	function get_district(state)
{
	//alert(id);
	var mydata = {"state": state};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_district') ?>",
		data: mydata,
		success: function (response) {
			$("#district").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_location(district)
{
	//alert(id);
	var mydata = {"district": district};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_location') ?>",
		data: mydata,
		success: function (response) {
			$("#location").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_area(bg)
{
	//alert(id);
	var mydata = {"bg": bg};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_area') ?>",
		data: mydata,
		success: function (response) {
			$("#area").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_user_by_role(role)
{
	//alert(id);
	var mydata = {"role": role};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_user_by_role') ?>",
		data: mydata,
		success: function (response) {
			$("#sponsor_to").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_seat_sub_categ(category)
{
	//alert(id);
	var mydata = {"category": category};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/get_seat_sub_categ') ?>",
		data: mydata,
		success: function (response) {
			$("#seat_sub_categ").html(response);
			//alert(response);
		}
	});   
}

</script>
<!-- show_dynamic_seat-->
<script>
function show_dynamic_seat(id)
{
	var seat_num = document.getElementById('participants').value;
	if(seat_num !='')
	{
	var mydata = {"id": id,"seat_num":seat_num};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/show_dynamic_seat') ?>",
		data: mydata,
		success: function (response) {
			$("#dynamic_seat").html(response);
			//alert(response);
		}
	});  
	}
	else
	{
		alert('please enter seat number');
	}
}
</script>
<?php } ?>


