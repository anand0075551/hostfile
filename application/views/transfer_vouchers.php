

	<?php function page_css(){ ?>
		
		
		
	<?php } ?>

	<?php 
		
		foreach($voucher->result() as $v); 
		
	?>
		
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"> Transfer Voucher </h3>
				</div><!-- /.box-header -->
				<hr>
				<!-- form start -->
				<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
					<div class="box-body">
						
						<div class="form-group">
							<label for="firstName" class="col-md-3">Voucher Name
								<span class="text-red"></span>
							</label>
							<div class="col-md-9">
								<input type="text" value="<?php echo $v->voucher_name; ?>" class="form-control" readonly>
							</div>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-3">Voucher ID
								<span class="text-red"></span>
							</label>
							<div class="col-md-9">
								<input type="text" value="<?php echo $v->voucher_id; ?>" class="form-control" readonly>
							</div>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-3">Voucher Amount
								<span class="text-red"></span>
							</label>
							<div class="col-md-9">
								<input type="text" value="<?php echo number_format($v->amount,2); ?>" class="form-control" readonly>
							</div>
						</div>
						<hr>
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>" >
                            <label for="firstName" class="col-md-3">To Role
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-9" >
								<select name="to_role" id="to_role" class="form-control" onchange="get_user(this.value)" style="width:100% auto;">
                                <option value="">Choose option</option>
								<?php
								$rolename = $this->db->get('role');
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
						
						<div class="form-group <?php if(form_error('to_user')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">To User
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-9" value="<?php echo set_value('to_user')?>";>
								<select name="to_user" id="to_user" class="form-control" style="width:100% auto;">
                                <option value="">Choose option</option>
								
								</select>
                                <?php echo form_error('to_user') ?>

                            </div>
                        </div>
						
					<input type="hidden" name="voucher_name" value="<?php echo $v->voucher_name; ?>">
					<input type="hidden" name="voucher_description" value="<?php echo $v->voucher_description; ?>">
					<input type="hidden" name="voucher_id" value="<?php echo $v->voucher_id; ?>">
					<input type="hidden" name="pay_type" value="<?php echo $v->pay_type; ?>">
					<input type="hidden" name="paytype_to" value="<?php echo $v->paytype_to; ?>">
					<input type="hidden" name="amount" value="<?php echo $v->amount; ?>">
					<input type="hidden" name="points_mode" value="<?php echo $v->points_mode; ?>">
					<input type="hidden" name="loy_amt" value="<?php echo $v->loy_amt; ?>">
					<input type="hidden" name="dis_amt" value="<?php echo $v->dis_amt; ?>">
					
					<input type="hidden" name="start_date" value="<?php echo $v->start_date; ?>">
					<input type="hidden" name="end_date" value="<?php echo $v->end_date; ?>">
					<input type="hidden" name="benefits" value="<?php echo $v->benefits; ?>">
					<input type="hidden" name="commission" value="<?php echo $v->commission; ?>">
					<input type="hidden" name="to_role" value="<?php echo $v->to_role; ?>">
					
						
					</div><!--End box body----->
					<!---------------Footer------------>
					<div class="box-footer text-right">
						<button type="submit" name="submit" value="transfer" class="btn btn-success btn-sm">
							<i class="fa fa-gift"></i> Transfer
						</button>
						<a type="button" class="btn btn-danger btn-sm" href="<?php echo base_url('vouchers/transfer_vouchers')  ?>">Cancel</a>
					</div>
				</form>
			</div><!-- /.box -->
		</div><!--/.col (left) -->
		<!-- right column -->
	</div>


	<?php function page_js(){ ?>

		
<script>
	function get_user(id)
{
    //alert(id);
    var mydata = {"pay_to" : id };

    $.ajax({
        type: "POST",
        url:  "<?php echo base_url('vouchers/getuser') ?>",
        data: mydata,
        success: function (response) {
         $("#to_user").html(response);
            //alert(response);
        }
    });
}
</script>



	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
	<script>
		$('select').select2();
	</script>





	<?php } ?>