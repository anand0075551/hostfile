
<?php

function page_css() { ?>
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" /> 
    <!-- datatable css -->


<?php } ?>

<?php include('header.php'); ?>



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
					
					<input type="hidden" name="ship_name" id="ship_name" class="form-control" value="<?php echo $res->ship_name ?>">
						
		
						<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="" placeholder="Name">
                                <?php echo form_error('name') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Phone
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="receiver_phone" id="receiver_phone" class="form-control" value="" placeholder="Phone">
                                <?php echo form_error('phone') ?>

                            </div>
                        </div>

						<div class="form-group <?php if(form_error('relation')) echo 'has-error'; ?>">
                            <label for="relation" class="col-md-3">Relation
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="relation" class="form-control" id="relation" onchange="get_subcategory(this.value)">
									<option value="">-Select Relation Type-</option>
									<option value="Family Member">Family Member</option>
									<option value="Neighbour">Neighbour</option>
									<option value="Friend">Friend</option>
									<option value="Relative">Relative</option>
								</select>
								<?php echo form_error('relation') ?>
                            </div>
                        </div>	
						<div class="form-group <?php if(form_error('id_type')) echo 'has-error'; ?>">
                            <label for="id_type" class="col-md-3">ID Type
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="id_type" class="form-control" id="id_type" onchange="get_subcategory(this.value)">
									<option value="">-Select ID Type-</option>
									<option value="Voter ID">Voter ID</option>
									<option value="Adhar Card">Adhar Card</option>
									<option value="Passport">Passport</option>
									<option value="Pancard">Pancard</option>
								</select>
								<?php echo form_error('id_type') ?>
                            </div>
                        </div>					
						<div class="form-group <?php if(form_error('id_number')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">ID Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="id_number" id="id_number" class="form-control" value="" placeholder="Id Number">
                                <?php echo form_error('id_number') ?>

                            </div>
                        </div>
<hr>



		
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
				      <button type="submit" name="submit" value="add_receiver" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Receiver
							</button>

       
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
			url:"save_otp_others",
			success:function(response){
				alert(response);
			}
		})
	}
</script>