
<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    <!-- select -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>
<?php foreach ($event->result() as $e)
{
	$get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
	foreach($get_location_name->result() as $l);
	 $location = $l->location;
	 
	  $get_host_name = $this->db->get_where('users', ['id'=>$e->host]);
		foreach($get_host_name->result() as $h);
		$host = $h->first_name.' '.$h->last_name;
		//
		$get_org_name = $this->db->get_where('users', ['id'=>$e->organiser]);
		foreach($get_org_name->result() as $og);
		$organiser = $og->first_name.' '.$og->last_name;
		$organiser_phn = $og->contactno;
		/* BALANCE*/
		$organiser_account_no = singleDbTableRow($e->created_by)->account_no;//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
		$where_array1 = array('points_mode'=>'wallet', 'account_no' =>$organiser_account_no);
		$query1 = $this->db->select_sum('debit')->where($where_array1 )->get("accounts"); 
		foreach( $query1->result() as $wal_debit);
		$wal_debit			= $wal_debit->debit;
		
		$query2 = $this->db->select_sum('credit')->where($where_array1 )->get("accounts"); 
		foreach( $query2->result() 		as $wal_credit); 
		$wal_credit      	= $wal_credit->credit;
		
		$organiser_balance= ( $wal_debit - $wal_credit ) ;
		//
		
		$get_guest_name = $this->db->get_where('users', ['id'=>$e->guest]);
		foreach($get_guest_name->result() as $g);
		$guest = $g->first_name.' '.$g->last_name;
		
?>
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
               
                <?php
				if( $organiser_balance < $e->budget)
				{
					echo '<font color="#FF0000">'.$organiser. ' dont have sufficient balance .Balance is '.$organiser_balance.'</font>';
				}
				 ?>
                <!-- Add My Stock form start -->
                <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
                    <div class="box-body">
                    <div class="form-group <?php if (form_error('categ')) echo 'has-error'; ?>">
								<label for="categ" class="col-md-3">Category
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<select name="categ" id="categ" class="form-control" onChange="get_sub_categ(this.value)">
										<option value="<?php echo $e->category;?>"> <?php echo  singleDbTableRow($e->category, 'em_category')->name;?>  </option>
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
										<option value="<?php echo $e->subcategory;?>"> <?php echo singleDbTableRow($e->subcategory, 'em_category')->name;?></option>
										
									</select>	
                                                                 
									<?php echo form_error('sub_categ') ?>

								</div>
						</div>
                    	<div class="form-group <?php if (form_error('organiser')) echo 'has-error'; ?>">
								<label for="organiser" class="col-md-3">Organising To
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9"> 
                                <input type="hidden" name="organiser" id="organiser" class="form-control" value="<?php echo $e->created_by;?>"> 								
								<input type="text" class="form-control" value="<?php echo $organiser;?>" id="organiser_name">	                                
									<?php echo form_error('organiser') ?>

								</div>
						</div>
                        
                    	<div class="form-group <?php if(form_error('budget')) echo 'has-error'; ?>">
                            <label for="budget" class="col-md-3">Budget
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="budget" id="budget" class="form-control" value="<?php echo $e->budget;?>">
                                <?php echo form_error('budget') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('participants')) echo 'has-error'; ?>">
                            <label for="participants" class="col-md-3">Seats
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="participants" id="participants" class="form-control" value="<?php echo $e->participants;?>">
                                <?php echo form_error('participants') ?>
                            </div>
                        </div>
                        
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
                             <?php if (!empty($seats) && $seats->num_rows() > 0) {?>
                             <table class="table table-striped">
                             <tr>
                             <td>Seat Name</td>
                             <td>Seat From</td>
                             <td>Seat To</td>
                             <td>Reg.Fee</td>
                             <td>Refund deduction %</td>
                             </tr>
								<?php foreach ($seats->result() as $st){
								?>
                                <tr>
                                <td><input type="text" name="seatname[]" class="form-control" value="<?php echo $st->seat;?>"/> </td>
                                <td><input type="text" name="seatfrom[]" class="form-control" value="<?php echo $st->seat_from;?>"/></td>
                                <td><input type="text" name="seatto[]"  class="form-control" value="<?php echo $st->seat_to;?>"/></td>
                                <td><input type="text" name="seatfee[]"  class="form-control" value="<?php echo $st->reg_fee;?>"/></td>
                                <td><input type="text" name="seatrefund[]"  class="form-control" value="<?php echo $st->refund_perc;?>"/></td>
                                </tr>
							<?php }?>
                                    </table>
                                    <?php } ?>
                                    <br>
                            </div>
                            <!--<div class="col-md-9">
                                <input type="text" name="reg_fee" id="reg_fee" class="form-control" placeholder="Enter Amount" value="0">
                               
                            </div>-->
                        </div>
                        
						<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="name" class="col-md-3">Event Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $e->name;?>">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="location" class="col-md-3">Location
									<span class="text-red">*</span>
								</label>
                                
								<div class="col-md-9" id="elocation" >  
                                <input type="hidden" name="location" id="location" class="form-control" value="<?php echo $e->location;?>">
                                <input type="text" class="form-control" value="<?php echo $location;?>">	
                                		<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if(form_error('venue')) echo 'has-error'; ?>">
                            <label for="venue" class="col-md-3">Event Venue
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea name="venue" id="venue" class="form-control"><?php echo $e->venue;?></textarea>
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                        <div class="form-group">
								<label for="location" class="col-md-3">Invite Users
									<span class="text-red">*</span>
								</label>
                                
								<div class="col-md-9">
                                      <?php if($e->category == 1) {?>
									<!--open to all -->
                                    <div  id="in_open" style="background-color:#F5F5F5">
                                    <div class="col-md-9">
                                    <strong> Open to all</strong> <input type="radio" id="open_to_all" name="select_users" value="0" <?php if($e->category == 1) {?> checked <?php }?> > :</div> <br><br>
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
                                               
                                                <div class="col-md-4">
                                                <?php if (!empty($e->selected_bg) && !empty($e->selected_area)) {?>
                                                 <table class="table table-striped">
                                                 <tr>
                                                 <td>Business Group</td>
                                                 </tr>
                                                    <?php $selected_bgs = rtrim($e->selected_bg,", ");
														$explode_bg = explode(',',$selected_bgs);
														foreach($explode_bg as $bgs)
														 {
								 						//$ebg =singleDbTableRow($bgs, 'business_groups')->business_name;
                                                    ?>
                                                    <tr>
                                                    <td><input type="text" name="sbg[]" class="form-control" value="<?php echo $bgs;?>"/></td>
                                                    </tr>
                                                <?php }?>
                                                
                                    </table>
                                    <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                                <?php if (!empty($e->selected_bg) && !empty($e->selected_area)) {?>
                                                 <table class="table table-striped">
                                                 <tr>
                                                 <td>Area</td>
                                                 </tr>
                                                    
                                                <?php $selected_area = rtrim($e->selected_area,", ");
														$e_area = '';
														$explode_area = explode(',',$selected_area);
														foreach($explode_area as $area)
							 								{
														  ?>
                                                          <tr>
                                                    <td><input type="text" name="sarea[]" class="form-control" value="<?php echo $area;?>"/></td>
                                                    </tr>
                                                          <?php } ?>
                                    </table>
                                    <?php } ?>
                                    </div><br>
                                                
                                                <div class="col-md-9" id="dynamic_open"></div>
                                                <br><br>
                                                <strong> Select Role : </strong><select name="open_role[]" id="open_role" class="form-control" style="width:555px" multiple>
                                     <option value="<?php echo $e->selected_roles;?>" selected> <?php echo $e->selected_roles;?>  </option>
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
                               
                                <?php } else { ?>
                                 <!-- users -->
                                <div id="in_users">
                                <div class="col-md-3">
                                <strong>Select Users</strong> <input type="radio" id="select_users" name="select_users" value="1" <?php if($e->category != 1) {?> checked <?php }?> > : 
                                </div>
                                 
                                <div id="tt">
                                      <select name="my_users[]" id="my_users" class="form-control"  multiple style="width:555px">
										<option value="<?php echo $e->selected_users;?>" selected><?php echo $e->selected_users;?> </option>
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
                                    </div>   </div>   <br>  
                                    <?php } ?>
                                    <!-- -->

								</div>
						</div>
                        <div class="form-group">
                            <label for="sms" class="col-md-3">Send SMS</label>
                            <div class="col-md-9">
                                <input type="text" name="send_sms" value="<?php echo $e->sms_numbers;?>" class="form-control">
                             </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('rf_time')) echo 'has-error'; ?>">
                            <label for="registration" class="col-md-3">Registration Date 
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                             Start : <input type="text" class="some_class"  id="some_class_1" name="rf_time" value="<?php echo $e->regstart_date;?>"/>
							End : <input type="text" class="some_class"  id="some_class_2" name="rt_time" value="<?php echo $e->regend_date;?>"/>
                               
                                <?php echo form_error('rf_time') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('f_time')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Event Date & Time
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                             From : <input type="text" class="some_class"  id="some_class_1" name="f_time" value="<?php echo $e->start_date;?>"/>
							To : <input type="text" class="some_class"  id="some_class_2" name="t_time" value="<?php echo $e->end_date;?>"/>
                               
                                <?php echo form_error('f_time') ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if (form_error('host')) echo 'has-error'; ?>">
								<label for="host" class="col-md-3">Host
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9"> 
                                 <input type="text" name="hidden" id="host" class="form-control" value="<?php echo $e->host;?>"> 								
									<input type="text" class="form-control" value="<?php echo $host;?>">		                                
									<?php echo form_error('host') ?>

								</div>
						</div>
                        
                        
                        
                        <div class="form-group <?php if (form_error('guest')) echo 'has-error'; ?>">
								<label for="guest" class="col-md-3">Guest
									<!--<span class="text-red">*</span>-->
								</label>
								<div class="col-md-9"> 
                                <input type="hidden" name="guest" id="guest" class="form-control" value="<?php echo $e->guest;?>">  								
									<input type="text" class="form-control" value="<?php echo $guest;?>">		                                
									<?php echo form_error('guest') ?>

								</div>
						</div>
                        
                        <div class="form-group <?php if(form_error('add_guest')) echo 'has-error'; ?>">
                            <label for="add_guest" class="col-md-3">Additionl Guests
                                <!--<span class="text-red">*</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="add_guest" id="add_guest" class="form-control" value="<?php echo $e->additional_guests;?>">
                                <?php echo form_error('add_guest') ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group <?php if(form_error('clables')) echo 'has-error'; ?>">
                            <label for="participants" class="col-md-3">Custom Labels</label>
                            <div class="col-md-9" id="itemRowsclabel">
                            <?php if (!empty($labels) && $labels->num_rows() > 0) {
								foreach ($labels->result() as $l){
								?>
                             <input type="text" name="clabel" id="clabel" class="form-control" value="<?php echo $l->e_label;?>"> 
                                <?php } } ?>
                                <?php echo form_error('participants') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('clables')) echo 'has-error'; ?>">
                            <label for="participants" class="col-md-3">Sponsor/Contributor </label>
                           <div class="col-md-9" id="itemRows">
                            <strong>For : </strong><input type="text" name="sponsor_for" class="form-control"/> <br>
                           <strong> Charge :</strong> <input type="text" name="sponsor_charge" size="4" class="form-control"/> <br>
                            <strong> Select Role : </strong><select name="role" id="role" class="form-control" onChange="get_user_by_role(this.value)" style="width:555px">
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
                           <strong> To :   </strong><select name="sponsor_to" id="sponsor_to" class="form-control"  style="width:555px"><br>
										<option value=""> Choose Role First </option>
										
									</select><br><br>
                            <input onClick="addsponsorRow(this.form);" type="button" value="Add" class="btn btn-warning"/> 
                            (This row will not be saved unless you click on "Add" first)
                                <?php echo form_error('participants') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
								<label for="status" class="col-md-3">Status
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<select name="status" id="status" class="form-control" >
										<option value="0"> Inactive</option>
                                        <option value="1"> Active</option>
										<option value="2"> Closed</option>	
									</select>	                                
									<?php echo form_error('status') ?>
								<input type="hidden" value="<?php echo $organiser_phn;?>" id="organiser_phn">
                                <input type="hidden" value="<?php echo $e->event;?>" id="ev">
								</div>
						</div>
                        
                        
				<div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <?php
				if( $organiser_balance < $e->budget)
				{?>
                  		<button type="button"  class="btn btn-primary" onClick="send_sms()">
                             Send SMS
                        </button>
                        <?php } else { ?>
                        <button type="submit" name="submit" value="accept_now" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Accept Now
                        </button>
                        <?php } ?>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- Register-->
        
        

    </div>   <!-- /.row -->
</section><!-- /.content -->
<?php } ?>
<?php function page_js(){ ?>

   <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
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
	function show_location()
	{
		$("#elocation").slideToggle(500);
	}
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
function send_sms()
{
	var ev = document.getElementById('ev').value;
	var phn = document.getElementById('organiser_phn').value;
	var name = document.getElementById('organiser_name').value;
	var budget = document.getElementById('budget').value;
	var mydata = {"event": ev,"phn": phn,"budget": budget,"name":name};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/send_sms') ?>",
		data: mydata,
		success: function (response) {
			
			alert(response);
		}
	});  
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
<?php } ?>


