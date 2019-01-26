<?php

function page_css() { ?>
    
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>
<?php
foreach ($foodvoucher_Details->result() as $profile);
?>

<?php include('header.php'); ?>





<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Voucher Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
					<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
						<label for="firstName" class="col-md-3">Voucher Type
							<span class="text-red">*</span>
						</label>
						<div class="col-md-9">
							<select name="voucher_type" id="voucher_type" class="form-control" style="width:100% auto;">
								<option value="<?php echo $profile->voucher_type ?>">
								<?php 
								if($profile->voucher_type != 0){
								echo singleDbTableRow($profile->voucher_type, 'status')->status;
								}
								else{
									echo "Choose Option";
								}
								?>
							   </option>
								<?php
								$get_voc = $this->db->get_where('status', ['business_name'=>20]);
								if ($get_voc->num_rows() > 0) {
									foreach ($get_voc->result() as $v) {

										echo '<option value="'.$v->id.'"> '.$v->status.'</option>';
									}
								}
								?>
							</select>
							<?php echo form_error('voucher_type') ?>
						</div>
					</div>
					
                   <div class="form-group <?php if(form_error('food_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="food_type" class="form-control" value="<?php echo $food_voucher_scheme->food_type; ?>" placeholder="">
                                <?php echo form_error('food_type') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('actual_price')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Price</label>
                            <div class="col-md-9"  value="<?php echo set_value('actual_price'); ?>">
                                 <input type="text" name="actual_price" id="actual_price" class="form-control" value="<?php echo $food_voucher_scheme->actual_value; ?>" placeholder="">
                                <?php echo form_error('actual_price') ?>
                            </div>
                        </div>
					
						<div class="form-group <?php if(form_error('mainbussiness_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Main Pay Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" value="<?php echo set_value('mainbussiness_type')?>";>
								 <select name="mainbussiness_type" class="form-control" onchange="paytype(this.value)" style="width:100% auto;">
                                <option value="">Choose option</option>
								<?php
								if($acct_categories->num_rows()>0)
								{
									foreach ($acct_categories->result() as $c) {

                                        echo '<option value="' . $c->id . '">' . $c->id."-".$c->name . '</option>';
                                    }
								}
								?>
								</select>
                                <?php echo form_error('mainbussiness_type') ?>

                        </div>
						
                        </div><div class="form-group <?php if(form_error('pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pay Type
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-9" value="<?php echo set_value('pay_type')?>";>
								 <select name="pay_type" id="pay_type" class="form-control" style="width:100% auto;">
                                <option value="<?php echo $profile->pay_type ?>">
								<?php 
								$get_role = $this->db->get_where('acct_categories', ['id'=>$profile->pay_type]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->name;
									}
								} else {
									 echo  "";
								}
							    ?>
								
								</option>
								
								</select>
                                <?php echo form_error('pay_type') ?>

                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Main Pay Type To
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<select class="form-control" onchange="get_paytype(this.value)" style="width:100% auto;">
                                <option value="">Choose option</option>
								<?php
								if($acct_categories->num_rows()>0)
								{
									foreach ($acct_categories->result() as $c) {

                                        echo '<option value="' . $c->id . '">' . $c->id."-".$c->name . '</option>';
                                    }
								}
								?>
								</select>
                                <?php echo form_error('mainbussiness_type') ?>

                            </div>
                        </div>
						 
						<div class="form-group <?php if(form_error('pay_type_to')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pay Type To
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-9" value="<?php echo set_value('pay_type')?>";>
								<select name="pay_type_to" id="pay_type_to" class="form-control" style="width:100% auto;">
                                <option value="<?php echo $profile->paytype_to ?>">
									<?php 
									if($profile->paytype_to != 0){
									echo singleDbTableRow($profile->paytype_to, 'acct_categories')->name;
									}
									else{
										echo "Choose Option";
									}
									?>
							   </option>
								
								</select>
                                <?php echo form_error('pay_type_to') ?>

                            </div>
                        </div>

						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>" >
                            <label for="firstName" class="col-md-3">Voucher Owner Role
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-9" value="<?php echo set_value('to_role')?>";>
								<select name="to_role" id="to_role" class="form-control" onchange="get_user(this.value)" style="width:100% auto;">
                                <option value="<?php echo $profile->pay_to_role ?>">
								<?php 
								$get_role = $this->db->get_where('role', ['roleid'=>$profile->pay_to_role]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->rolename;
									}
								} else {
									 echo  "";
								}
							    ?>
						       </option>
								<?php
								if($rolename->num_rows()>0)
								{
									foreach ($rolename->result() as $c) {

                                        echo '<option value="' . $c->id . '">'.$c->id. '-' . $c->rolename . '</option>';
                                    }
								}
								?>
								</select>
                                <?php echo form_error('to_role') ?>

                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('receiver_role')) echo 'has-error'; ?>" >
                            <label for="firstName" class="col-md-3">Voucher Reciever Role
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-9" value="<?php echo set_value('receiver_role')?>";>
								<select name="receiver_role" id="receiver_role" class="form-control" style="width:100% auto;">
                                <option value="<?php echo $profile->receiver_role ?>">
								<?php 
								$get_role = $this->db->get_where('role', ['roleid'=>$profile->receiver_role]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->rolename;
									}
								} else {
									 echo  "Choose Option";
								}
							    ?>
						       </option>
								<?php
								if($rolename->num_rows()>0)
								{
									foreach ($rolename->result() as $c) {

                                        echo '<option value="' . $c->id . '">'.$c->id. '-' . $c->rolename . '</option>';
                                    }
								}
								?>
								</select>
                                <?php echo form_error('receiver_role') ?>

                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('to_user')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">To User
                                <span class="text-red"></span>
                            </label>
                             <div class="col-md-9" value="<?php echo set_value('to_user')?>";>
								<select name="to_user" id="to_user" class="form-control" style="width:100% auto;">
                                <option value="<?php echo $profile->pay_to_user ?>">
								<?php 
								$get_role = $this->db->get_where('users', ['id'=>$profile->pay_to_user]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->first_name." ".$row->last_name;
									}
								} else {
									 echo  "";
								}
                               ?>
							   </option>
								
								</select>
                                <?php echo form_error('to_user') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('transferrable')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Transferrable
								<span class="text-red">*</span>
							</label>
							<?php 
									$comm1 = $profile->transferrable; 
							?>
								<label class="col-md-2"><input type="radio" name="transferrable" <?php if($comm1=="yes"){ ?> checked <?php } ?> value="yes"> Yes</label>
								<label class="col-md-2"><input type="radio" name="transferrable" <?php if($comm1=="no"){ ?> checked <?php } ?> value="no"> No</label>
								<?php echo form_error('transferrable') ?>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-3">Define End Date
								<span class="text-red"></span>
							</label>
							<div class="col-md-9">  								
								<select name="end_date_opt" id="end_date_opt" onchange="get_end_date_opt(this.value)" class="form-control" style="width:100% auto;">
									<option value=""> Choose option </option>
									<option value="1"> Yes </option>
									<option value="0"> No </option>
								</select>	                                
							</div>
						</div>
							
						<div class="form-group" id="hrs_gap_div" <?php if($profile->validity==0){?>style="display:none"<?php } ?>>
							<label for="firstName" class="col-md-3">Hours Gap From Start Date
								<span class="text-red">*</span>
							</label>
							<div class="col-md-9">
								<select name="hrs_gap" id="hrs_gap" class="form-control" style="width:100% auto;">
									<option value="<?php echo $profile->validity ?>"> <?php echo ($profile->validity/24)." Day (".$profile->validity." Hours)"; ?> </option>
									<option value="24">    1 Day (24 Hours)    </option>
									<option value="48">    2 Day (48 Hours)    </option>
									<option value="72">    3 Day (72 Hours)    </option>
									<option value="96">    4 Day (96 Hours)    </option>
									<option value="120">   5 Day (120 Hours)   </option>
									<option value="144">   6 Day (144 Hours)   </option>
									<option value="168">   7 Day (168 Hours)   </option>
									<option value="192">   8 Day (192 Hours)   </option>
									<option value="216">   9 Day (216 Hours)   </option>
									<option value="240">   10 Day (240 Hours)  </option>
									<option value="360">   15 Day (360 Hours)  </option>
									<option value="720">   30 Day (1 Month)    </option>
									<option value="1440">  60 Day (2 Month)    </option>
									<option value="2160">  90 Day (3 Month)    </option>
									<option value="2880">  120 Day (4 Month)   </option>
									<option value="3600">  150 Day (5 Month)   </option>
									<option value="4320">  180 Day (6 Month)   </option>
									<option value="8760">  12 Month (1 Year)   </option>
								</select>
							</div>
						</div>
						
						<div class="form-group <?php if(form_error('voc_type')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Voucher Period
								<span class="text-red">*</span>
							</label>
							<?php 
									$comm2 = $profile->period; 
							?>
							<label class="col-md-2"><input type="radio" name="voc_type" <?php if($comm2=="month" || $comm2==0){ ?> checked <?php } ?> value="month"> Monthly </label>
							<label class="col-md-2"><input type="radio" name="voc_type" <?php if($comm2=="week"){ ?> checked <?php } ?> value="week"> Weekly </label>
							<label class="col-md-2"><input type="radio" name="voc_type" <?php if($comm2=="day"){ ?> checked <?php } ?>  value="day"> Daily </label> &nbsp;&nbsp;
							<?php echo form_error('voc_type') ?>
						</div>
				
			    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
				
                    <button type="submit" name="submit" value="edit_foodvoucher" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update Voucher Details
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>

	
<script>
    function abcd()
	{
		var actualprice = Number($("#actual_price").val().trim());
		var discount_per = Number($("#discount_per").val().trim());
		  
		var discountvalue = (actualprice/100);
		 
		var discountvalue = discountvalue*discount_per;
		

		var price_after_discount = actualprice-discountvalue;
		
		$("#discount_value").val(discountvalue);
		$("#price_discount").val(price_after_discount);
	}
</script>
	
<script>
	function paytype(id)
	{
		var mydata = {"parentid": id};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/paytype') ?>",
			data: mydata,
			success: function (response) {
			   $("#pay_type").html(response);
			}
		});
	}
</script>
<script>
function get_paytype(id)
{
	var mydata = {"parentid": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Food_voucher/paytype') ?>",
		data: mydata,
		success: function (response) {
		   $("#pay_type_to").html(response);
		}
	});
}

</script>
	
<script>
	function get_user(id)
	{
		var mydata = {"pay_to" : id };

		$.ajax({
			type: "POST",
			url:  "<?php echo base_url('Food_voucher/getuser') ?>",
			data: mydata,
			success: function (response) {
			 $("#to_user").html(response);
			}
		});
	}
</script>

<script>
	function get_end_date_opt(id)
	{
		if(id == 1){
			$('#hrs_gap_div').slideDown();
		}
		else{
			$('#hrs_gap_div').slideUp();
		}
	}
</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
	
	
<?php } ?>

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



