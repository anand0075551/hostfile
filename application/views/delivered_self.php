
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		<div class="box-body">

                <table class="table table-bordered">
						<div class="col-md-12">
							
								
						</div>
				</table>                  
            </div><!-- /.box-body -->
				
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Courier Stage </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
	
						
				


					<input type="hidden" name="cons_no" id="cons_no" class="form-control" value="<?php echo $res->cons_no ?>">
						<input type="hidden" name="phone" id="phone" class="form-control" value="<?php echo $res->phone ?>">
							<input type="hidden" name="ship_name" id="ship_name" class="form-control" value="<?php echo $res->ship_name ?>">
								<input type="hidden" name="type" id="type" class="form-control" value="<?php echo $res->type ?>">
						    <input type="hidden" name="receiver_pincode" id="receiver_pincode" class="form-control" value="<?php echo $res->receiver_pincode ?>">
							 <input type="hidden" name="r_add" id="r_add" class="form-control" value="<?php echo $res->r_add ?>">
		
		
		
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

						
						    <button type="button" name="submit2" value="add_agent2" class="btn btn-danger" onclick="sendopt()" >
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
									<option value="Pickup Successful">Pickup Successful</option>
									<option value="Delivered">Delivered</option>
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
				      <button type="submit" name="submit" value="delivered" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Change Now
							</button>
							        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
				  </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->
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
<script>
    $(function(){
        $('input[name="referredByCode"]').keyup(function(){
            var iSelector = $(this);
            var referredByCode = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('courier/uniqueSmsCodeApi'); ?>",
                data : { referredByCode : referredByCode }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970"> OTP is valid</span>');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#referralCodeStatus').html('<span style="color: #ff0000"> OTP is invalid</span>');
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
			url:"save_otp",
			success:function(response){
				alert(response);
			}
		})
	}
</script>