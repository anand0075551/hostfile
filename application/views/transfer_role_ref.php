<?php function page_css(){ ?>
   
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	  <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$role = singleDbTableRow($user_id)->rolename;
	$referral_code = singleDbTableRow($user_id)->referral_code;
	
	//users table
	foreach($transfer->result() as $trans); 
?>
		
<?php

//counting limitation....

$count=0;

$get_total = $this->db->get_where('role_transfer',['role'=>$trans->rolename]);
foreach($get_total->result()  as $t){
	
	$count++;
							
}


$get_limit = $this->db->get_where('role_refrral_declaration',['to_role'=>$trans->rolename]);
foreach($get_limit->result()  as $lim);
	
$limit = $lim->limit;




?>		
		
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<?php
	if($limit <= $count){
	?>		
		<div class="box box-success">
			<div class="box-header">
				<h3 class="box-title"> Transfer Role </h3>
			</div>
				<h4 class="text-red text-center">Your Not Eligable To Transfer The Role....!</h4>
			<div class="col-md-10"></div>
			<div class="col-md-2">
			<button type="button" class="btn btn-drack text-right" data-dismiss="modal" onClick="window.location.reload();" >Cancel</button>
			</div>
		</div>
	<?php	
	}else{
	?>	
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"> Transfer Role </h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
			<div class="box-body">				
				<input type="hidden" name="sender_id" value="<?php echo $trans->id; ?>" />
				<div class="form-group" <?php if(form_error('referredByCode')) echo 'has-error'; ?>>
					<label for="firstName" class="col-md-4">Transfer To
						<span class="text-red">*</span>
					</label>
					<div class="col-md-8">
						<div class="input-group">
							<div class="input-group-addon" style="padding:1px;">
							   <button type="button" style="width:100%; height:30px;" value="show" id="show"><i class="fa fa-search"></i></button>
							</div>
							<div class="input-group-addon referralFa">
								<i class="fa fa-warning"></i>
							</div>
							<input class="form-control" name="referredByCode" id="referredByCode" type="text" value="<?php echo set_value('referredByCode'); ?>" min="10"  placeholder="Consumer Code" required/>
						</div>
						<p id="referralCodeStatus"></p>	
						 <?php echo form_error('referredByCode') ?>
					</div>
				</div>
				<div class="form-group">
					<div id="users" style="display:none"></div>
				</div>
				<div id="div">
					<div class="form-group">
						<label for="firstName" class="col-md-4">Role Name
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="hidden" readonly name="role_id" id="role_id" style="width:100%;" class="form-control" value="<?php echo $trans->rolename; ?>" >
							
							<input type="text" readonly style="width:100%;" class="form-control" value="<?php echo singleDbTableRow($trans->rolename,'role')->rolename; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Requested Cost <br> (Non Refundable)
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<?php
								
								//$get_amt = $this->db->get_where('role_refrral_declaration', ['from_role'=>$role,'to_role'=>$trans->rolename]);
								
								
								$get_amt = $this->db->get_where('role_refrral_declaration', ['to_role'=>$trans->rolename]);
								foreach($get_amt->result() as $amt);								
							?>
							<input type="number" readonly class="form-control" name="req_cost" id="req_cost" value="<?php echo $amt->f_role_points; ?>" placeholder="Enter Your Cost" required />
						</div>
					</div>
					<div class="form-group" style="display:none;">
						<label for="firstName" class="col-md-4">Chargeable Amount
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="number" readonly class="form-control" name="charge_amt" id="charge_amt" value="<?php echo $amt->t_role_points; ?>" placeholder="Enter Your Request Amount" required />
							
							<input type="hidden" name="points_mode" value="<?php echo $amt->points_mode; ?>" />
						</div>
					</div>
				</div>
			</div><!--End box body----->
			
			<div class="box-footer text-right">
				<button type="submit" name="submit" id="role_transfer" value="role_transfer" class="btn btn-primary disabled">
					<i class="fa fa-edit"></i> Submit
				</button>
				<button type="button" class="btn btn-drack" data-dismiss="modal" onClick="window.location.reload();" >Cancel</button>
			</div>
		</form>
	</div>
	<?php
	   }
	?>
	</div><!--/.col (left) -->
	<!-- right column -->
</div>


<?php function page_js(){ ?>

<script>
    $(function(){
        $('input[name="referredByCode"]').keyup(function(){
            var iSelector = $(this);
            var referredByCode = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('Ref_info/uniqueReferralCodeApi'); ?>",
                data : { referredByCode : referredByCode }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
						//$("#div").slideDown(1000);
						$("#role_transfer").removeClass('disabled');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#referralCodeStatus').html('<span style="color: #ff0000">Referral code is Invalid/Inactive</span>');
						//$("#div").slideUp(1000);
						$("#role_transfer").addClass('disabled');
                    }
                    //alert(msg);
                });
			
        });
				
    });
	
	$(document).ready(function(){
		 $("#show").click(function(){
			var ref_id = $("#referredByCode").val();
			if (ref_id!=""){
				var mydata = {"ref_id":ref_id};
				$.ajax({
						type : "POST",
						url : "<?php echo base_url('Ref_info/get_user'); ?>",
						data : mydata,
						success : function(response){
							$("#users").html(response);
						}
					})
			}
			else{
				$("#users").html("<font color='red'>Please Enter Consumer ID..!</font>");
			}
			
			$("#users").slideToggle();
		});
	});

</script>



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>



<?php } ?>