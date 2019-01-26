
<?php

function page_css() { ?>
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" /> 
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css">
<style>
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 50px;
    display: none;
}
</style>
<?php } ?>


<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-3 text-center">
			<button class="btn btn-success form-control" id="user_btn" onclick="get_user_form()">Delivered Self</button>
		</div>
		
<?php								 $query = $this->db->get_where('cms_add_receiver', ['cons_no' => $res->cons_no]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) 
                                 
                                   $name =    $row->name;
								   
									if($row != ''){
								} 

?>
		<div class="col-lg-3 text-center">
			<button class="btn btn-danger form-control" id="guest_btn" onclick="get_guest_form()">Delivered Others</button>
		</div>
		
<?php }  ?>
		
		
		
		
		<div class="col-lg-3"></div>
	</div>
	<hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12" id="user_form" >
 <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Delivery Self </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
	
							<!-- this code is for dynamic money assignment for status delivery for delivery executives  -->
		<?php
					$get = $this->db->get_where('cms_deliver', ['cid',$res->cons_no])->num_rows();
					if($get > 0){
						foreach($get->reslut() as $role);
						$from_role = singleDbTableRow($role->assigned_by)->rolename;
						$to_role = singleDbTableRow($role->dbid)->rolename;
					}
					else{
						$currentAuthDta = loggedInUserData();
						$currentUser = $currentAuthDta['role'];
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentRolename = singleDbTableRow($user_id)->rolename;
						$from_role = $currentRolename;
						$to_role = 12;
					}
					?>			
					<?php  if ($currentRolename != '12')  {     ?>									
				

				<?php 

								$res->business_group;							
								$res->smb_weight;							
								$res->qty;							
								$res->smb_volume;							


								$condition ="business_groups   = '".$res->business_group."' 	AND 
								from_role          = '".$from_role."'      						AND 
								to_role            = '".$to_role."'         					AND 
								active             = '1'                    					AND 
								min_kg            <= '".$res->smb_weight."'          			AND 
								max_kg            >= '".$res->smb_weight."'          			AND 
								min_quantity      <= '".$res->qty."'             				AND 
								max_quantity      >= '".$res->qty."'             				AND 
								min_volume        <= '".$res->smb_volume."'      				AND 
								max_volume        >= '".$res->smb_volume."'  ";
								$get_cost = $this->db->where($condition)->get('cms_role_payment');


								if($get_cost->num_rows() > 0){
										foreach($get_cost->result() as $c)
										$shipping_cost = $c->shipment_cost;
								}
								else{
										$shipping_cost = 0;
								}
								 ?>
								

								<?php  }     ?>			
				<!-- this code ends -->
	


<input type="hidden" name="shipping_cost"  class="form-control" value="<?php echo $shipping_cost ?>">

<input type="hidden" name="cons_no" id="cons_no" class="form-control" value="<?php echo $res->cons_no ?>">
<input type="hidden" name="phone" id="phone" class="form-control" value="<?php echo $res->phone ?>">
<input type="hidden" name="ship_name" id="ship_name" class="form-control" value="<?php echo $res->ship_name ?>">
<input type="hidden" name="type" id="type" class="form-control" value="<?php echo $res->type ?>">
<input type="hidden" name="receiver_pincode" id="receiver_pincode" class="form-control" value="<?php echo $res->receiver_pincode ?>">
<input type="hidden" name="r_add" id="r_add" class="form-control" value="<?php echo $res->r_add ?>">


<input type="hidden" name="smb_volume" class="form-control" value="<?php echo $res->smb_volume ?>">
<input type="hidden" name="business_group" class="form-control" value="<?php echo $res->business_group ?>">


<input type="hidden" name="qty" class="form-control" value="<?php echo $res->qty ?>">
<input type="hidden" name="smb_weight" class="form-control" value="<?php echo $res->smb_weight ?>">

<input type="hidden" name="from_role" class="form-control" value="<?php echo $from_role; ?>">
<input type="hidden" name="to_role" class="form-control" value="<?php echo $to_role; ?>">




<input type="hidden" name="to_role" class="form-control" value="<?php echo $res->status; ?>">


		
		
		<?php 
			$get_status = $this->db->get_where('cms_courier', ['cons_no'=>$res->cons_no]);
			foreach($get_status->result() as $s);
			$sts = $s->status;
		?>
						<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="<?php
								if($sts == "Pickup Assigned") {
									$get_user = $this->db->get_where('users', ['id'=>$res->ship_name]);
									foreach($get_user->result() as $u);
									echo $u->first_name." ".$u->last_name;
								}
								else{
									echo $res->rev_name;
								}
								?>" placeholder="Name" readonly>
                                <?php echo form_error('name') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Phone
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="receiver_phone" id="receiver_phone" class="form-control" value="<?php
								if($sts == "Pickup Assigned") {
									echo $res->phone; 
								}
								else{
									echo $res->r_phone;
								}
								?>" placeholder="Phone" readonly>
                                <?php echo form_error('phone') ?>

                            </div>
                        </div>

						
						
						
						
						<div class="form-group <?php if(form_error('relation')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Type/ Relation
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="relation" id="relation" class="form-control" value="Self" placeholder="Self" readonly>
                                <?php echo form_error('relation') ?>

                            </div>
                        </div>
						<hr>
														<div class="form-group <?php if(form_error('shipping_cost')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Shippment Charge
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                 <input type="text" name="shipping_cost"  class="form-control" readonly value="<?php echo $shipping_cost; ?>">
                                <?php echo form_error('shipping_cost') ?>

                            </div>
                        </div>	
						<hr>

						
						    <button type="button" name="submit2" value="add_agent2" class="btn btn-success" onclick="sendopt()" >
                        <i class="fa fa-mobile"></i> Send OTP SMS     </button> 
						
						<hr>
						<div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Enter OTP 
						<span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <input class="form-control" name="referredByCode" id="referredByCode" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder=" OTP " />
                            </div>
                            <p id="referralCodeStatus"></p>
                            <?php echo form_error('referredByCode') ?>
                        </div>
						</div>
						<div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                            <label for="status" class="col-md-3">Status
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="status" id="status" class="form-control" id="status">
									<option value="">-Select Status-</option>
									<option value="150">Pickup Successful</option>
									<option value="15">Delivered</option>
								</select>
								<?php echo form_error('status') ?>
                            </div>
                        </div>						

						<hr>
					<div class="form-group <?php if(form_error('comment')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Remarks
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="comment" id="comment" class="form-control" value="" placeholder="Enter remarks">
                                <?php echo form_error('comment') ?>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
				      <button type="submit" name="submit" id="self_btn" value="delivered" class="btn btn-primary disabled">
                            <i class="fa fa-edit"></i> Change Now
							</button>
							        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div>
				  </div>
                </form>
            </div><!-- /.box -->
            </form>
	
        </div>
		
	<?php								 $query = $this->db->get_where('cms_add_receiver', ['cons_no' => $res->cons_no]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) 
                                 
                                   $name =    $row->name;
								   
									if($row != ''){
								} 

?>	
		   <div class="col-md-12" id="guest_form" style="display:none">
                       <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Delivered Others</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
<?php								 $query = $this->db->get_where('cms_add_receiver', ['cons_no' => $res->cons_no]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                 
                                   $name =    $row->name;
                                   $receiver_phone =    $row->receiver_phone;
                                  $relation =     $row->relation;
                                    $id_type =   $row->id_type;
                                   $id_number =    $row->id_number;
									}
								} else {
                                    echo " Doesnot Exist";
                                }

?>					
				
					<input type="hidden" name="cons_no" id="cons_no" class="form-control" value="<?php echo $res->cons_no ?>">
						<input type="hidden" name="phone" id="phone" class="form-control" value="<?php echo $res->phone ?>">
							<input type="hidden" name="ship_name" id="ship_name" class="form-control" value="<?php echo $res->ship_name ?>">
								<input type="hidden" name="type" id="type" class="form-control" value="<?php echo $res->type ?>">
						    <input type="hidden" name="receiver_pincode" id="receiver_pincode" class="form-control" value="<?php echo $res->receiver_pincode ?>">
							 <input type="hidden" name="r_add" id="r_add" class="form-control" value="<?php echo $res->r_add ?>">
			     	<input type="hidden" name="rev_name" id="ship_name" class="form-control" value="<?php echo $res->rev_name ?>">
						
		
						<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" disabled value="<?php echo $name; ?>" placeholder="Name">
                                <?php echo form_error('name') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Phone
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="receiver_phone" id="receiver_phone" disabled class="form-control" value="<?php echo $receiver_phone; ?>" placeholder="Phone">
                                <?php echo form_error('phone') ?>

                            </div>
                        </div>
												<div class="form-group <?php if(form_error('relation')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Relation
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="relation" id="relation" disabled class="form-control" value="<?php echo $relation; ?>" placeholder="relation">
                                <?php echo form_error('relation') ?>

                            </div>
                        </div>
												<div class="form-group <?php if(form_error('id_type')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">ID Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="id_type" id="id_type" disabled class="form-control" value="<?php echo $id_type; ?>" placeholder="ID Type">
                                <?php echo form_error('id_type') ?>

                            </div>
                        </div>
												<div class="form-group <?php if(form_error('id_number')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">ID Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="id_number" id="id_number" disabled class="form-control" value="<?php echo $id_number; ?>" placeholder="ID Number">
                                <?php echo form_error('id_number') ?>

                            </div>
                        </div>

						
<hr>
								<div class="form-group <?php if(form_error('shipping_cost')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Shippment Charge
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                 <input type="text" name="shipping_cost"  class="form-control" readonly value="<?php echo $shipping_cost; ?>">
                                <?php echo form_error('shipping_cost') ?>

                            </div>
                        </div>	
<hr>
						    <button type="button" name="submit2" value="add_agent2" class="btn btn-danger" onclick="sendotp()" >
                        <i class="fa fa-mobile"></i> Send OTP SMS     </button> 
						
						<hr>
					<div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Enter OTP 
						<span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <input class="form-control" name="referredByCode1" id="referredByCode1" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder=" OTP " />
                            </div>
                            <p id="referralCodeStatus"></p>
                            <?php echo form_error('referredByCode') ?>
                        </div>
						</div>	
						

						

			
						
					<div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                            <label for="status" class="col-md-3">Status
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="status" id="status" class="form-control" id="status">
									<option value="">-Select Status-</option>
									<option value="150">Pickup Successful</option>
									<option value="15">Delivered</option>
								</select>
								<?php echo form_error('status') ?>
                            </div>
                        </div>			
																		<div class="form-group <?php if(form_error('comment')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Remarks
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="comment" id="comment" class="form-control" value="" placeholder="Enter remarks">
                                <?php echo form_error('comment') ?>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
				      <button type="submit" name="submit" id="others_btn" value="delivered2" class="btn btn-primary disabled">
                            <i class="fa fa-edit"></i> Change Now
							</button>
							      
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
				  </div>
                </form>
            </div><!-- /.box -->

								<?php } ?>



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>





  
	
			

<?php

function page_js() { ?>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  
<script>
function get_user_form()
{
	$("#user_form").slideToggle(1000);
	$("#guest_form").slideUp(1000);
}
function get_guest_form()
{
	$("#guest_form").slideToggle(1000);
	$("#user_form").slideUp(1000);
}



</script>

</script>
<script>
    $(function(){
        $('input[name="referredByCode"]').keyup(function(){
			var cons_no = $('#cons_no').val();
			//alert(cons_no);
            var iSelector = $(this);
            var referredByCode = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('courier/uniqueSmsCodeApi'); ?>",
                data : { referredByCode : referredByCode , cons_no : cons_no }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970"> OTP is valid</span>');
                        $('#self_btn').removeClass('disabled');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
						$('#referralCodeStatus').html('<span style="color: red"> OTP is invalid</span>');
                        $('#self_btn').addClass('disabled');
                    }
                    //alert(msg);
                });


        });
    });
	
	
	
	 $(function(){
        $('input[name="referredByCode1"]').keyup(function(){
            var iSelector = $(this);
			var cons_no = $('#cons_no').val();
            var referredByCode1 = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('courier/uniqueSmsCodeApi1'); ?>",
               data : { referredByCode1 : referredByCode1 , cons_no : cons_no }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970"> OTP is valid</span>');
                        $('#others_btn').removeClass('disabled');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
						$('#referralCodeStatus').html('<span style="color: red"> OTP is invalid</span>');
                        $('#others_btn').addClass('disabled');
                    }
                    //alert(msg);
                });


        });
    });
	
	
	function sendopt()
	{
		//alert('k');
		var cons_no = $("#cons_no").val();
		var phone = $("#phone").val();
		var ship_name = $("#ship_name").val();
		var type = $("#type").val();
		var receiver_pincode = $("#receiver_pincode").val();
		var r_add = $("#r_add").val();
		var name = $("#name").val();
		var receiver_phone = $("#receiver_phone").val();
		var relation = $("#relation").val();
		var status = $("#status").val();
		var referredByCode = $("#referredByCode").val();
		var comment = $("#comment").val();
		//alert(cons_no);
		var mydata = {"cons_no":cons_no, "phone":phone, "ship_name":ship_name, "type":type, "receiver_pincode":receiver_pincode, "r_add":r_add, "name":name, "receiver_phone":receiver_phone, "relation":relation, "status":status, "referredByCode":referredByCode, "comment":comment };
		$.ajax({
			type:"POST",
			data:mydata,
				url: "<?php echo base_url('courier/save_otp'); ?>",
			
			success:function(response){
				alert(response);
			}
		})
	}
	
	
	function sendotp()
	{
		//alert('k');
		var cons_no = $("#cons_no").val();
		var phone = $("#phone").val();
		var ship_name = $("#ship_name").val();
		var type = $("#type").val();
		var receiver_pincode = $("#receiver_pincode").val();
		var r_add = $("#r_add").val();
		var name = $("#name").val();
		var receiver_phone = $("#receiver_phone").val();
		var relation = $("#relation").val();
		var id_type = $("#id_type").val();
		var id_number = $("#id_number").val();
		
		
		var status = $("#status").val();
		var referredByCode = $("#referredByCode").val();
		var comment = $("#comment").val();
	//	alert(cons_no);
		var mydata = {"cons_no":cons_no, "phone":phone, "ship_name":ship_name, "type":type, "id_type":id_type, "id_number":id_number, "receiver_pincode":receiver_pincode, "r_add":r_add, "name":name, "receiver_phone":receiver_phone, "relation":relation, "status":status, "referredByCode":referredByCode, "comment":comment };
		
		$.ajax({
			type:"POST",
			data:mydata,
			url: "<?php echo base_url('courier/save_otp_others'); ?>",
		
			success:function(response){
				alert(response);
			}
		})
	}
</script>

	


  

<?php } ?>

