<?php
foreach($profile_Details->result() as $profile); //Customer Bank Deposit Details


//$avaialble_wallet = ($total_wallet_debit - $total_wallet_credit);

foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

$wallet_balance    = ( $wal_debit - $wal_credit ) ;

$actual_amount = $profile->amount;
$ded_amt = 0;
if ($profile->ifsc_code == 'payumoney')
{
$ded_amt = (($actual_amount * 2.5) /100 );
$amount  = $actual_amount - $ded_amt;
}else{
$amount  = $actual_amount;
}

?>
<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary boxFormContainer">
                <div class="box-header">
                    <h3 class="box-title">Transfer Amount</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body"> 
					<!-- Account Dispatcher View-->
								<table class="table table-bordered">
								   
								   <tr><th> Cash Dispatcher Available Wallet Points			</th> <td> <?php  echo amountFormat($wallet_balance);   ?> 	 </td></tr>
								   <hr />
								 </table>
								<br> <br>
								   <th width="20%"> Beneficiary Details</th>
								   <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Full Name</th>
                                                <th><?php echo $profile->first_name .'  '.$profile->last_name; ?></th> 
                                            </tr>
                                             <tr>
                                                <th  width="20%"> C.P.A Account No</th>
                                                <th><?php $client_account_no = singleDbTableRow($profile->created_by)->account_no;	
												echo $client_account_no; ?> </th> 
											</tr>                                           										
											 <tr>
												<th width="20%"> <font size="3" color="red">Approval Amount</th>
												
                                                <th width="20%"> <font size="3" color="red"> <?php echo amountFormat ($amount); ?>
												
												</th>
													
                                            </tr>
											<tr>
												<th width="20%"> <font size="3" color="red">Deduction Amount</th>
												
                                                <th width="20%"> <font size="3" color="red"> <?php echo amountFormat ($ded_amt); ?>
												
												</th>
													
                                            </tr>
										</table>	
										<hr />
										<th width="20%"> Validate Details</th>
										<div class="form-group <?php if(form_error('account_no')) echo 'has-error'; ?>">
											<label for="firstName" class="col-md-3">C.P.A Account No
												<span class="text-red">*</span>
											</label>
												<div class="col-md-9">
													<input type="text" readonly name="account_no" min="6" max="6" value="<?php echo ($client_account_no); ?>" class="form-control" placeholder="<?php echo amountFormat ($profile->account_no); ?>">
													<?php echo form_error('account_no') ?>
												</div>
										</div> 
										<div class="form-group <?php if(form_error('ifsc_code')) echo 'has-error'; ?>">
											<label for="firstName" class="col-md-3">Payment Through
											<span class="text-red">*</span>
											</label>
												<div class="col-md-9">
					<input type="text" readonly name="ifsc_code" min="6" max="6" value="<?php echo ($profile->ifsc_code); ?>" class="form-control" placeholder="<?php echo $profile->ifsc_code; ?>">
													<?php echo form_error('ifsc_code') ?>
												</div>
										</div> 		
										<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
											<label for="firstName" class="col-md-3">Deposit Amount
												<span class="text-red">*</span>
											</label>
												<div class="col-md-9">
													<input type="text" readonly name="amount" min="6" max="6" value="<?php echo ($amount); ?>" class="form-control" ">
													<?php echo form_error('amount') ?>
												</div>
										</div> 
	<div class="form-group <?php if(form_error('ded_amt')) echo 'has-error'; ?>">
											<label for="firstName" class="col-md-3">Deduction Amount
												<span class="text-red">*</span>
											</label>
												<div class="col-md-9">
													<input type="text" readonly name="ded_amt" min="6" max="6" value="<?php echo ($ded_amt); ?>" class="form-control" ">
													<?php echo form_error('ded_amt') ?>
												</div>
										</div>  

										

						<div hidden class="form-group <?php if(form_error('trans_type')) echo 'has-error'; ?>">
                            <label  for="firstName" class="col-md-3">Deposit/Transaction Type
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
									 
							<input type="radio" name="trans_type"  <?php if (isset($trans_type) && $trans_type=="44") echo "checked";?> value="44" id="online" />Online Deposit      
							<input type="radio" name="trans_type"  <?php if (isset($trans_type) && $trans_type=="45") ?> checked value="45" id="offline" /> Offline/Bank Deposit
		
                             <?php echo form_error('trans_type') ?>
                            </div>							
                        </div>	
						
						<div class="form-group <?php if(form_error('invoice_id')) echo 'has-error'; ?>">
											<label for="firstName" class="col-md-3"> Transaction Remarks
												<span class="text-red">*</span>
											</label>
								<div class="col-md-9">
							     <input type="text" readonly name="invoice_id" min="6" max="6" value="<?php echo ($profile->tranx_id); ?>" class="form-control" placeholder="<?php echo $profile->tranx_id; ?>">
								<?php echo form_error('invoice_id') ?>
							</div>
						</div>  
						
								
						<div class="form-group <?php if(form_error('transaction_type')) echo 'has-error'; ?>">
											<label for="firstName" class="col-md-3">Transaction Type
												<span class="text-red">*</span>
											</label>
								<div class="col-md-9">
							     <input type="text" readonly name="transaction_type" min="6" max="6" value="<?php echo ($profile->transaction_type); ?>" class="form-control" placeholder="<?php echo $profile->transaction_type; ?>">
								<?php echo form_error('transaction_type') ?>
							</div>
						</div> 											
						 <div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Approval Remarks
								<span class="text-red">*</span>
							</label>
								<div class="col-md-9">
									<input type="text" name="remarks" value="<?php echo set_value('challan'); ?>" class="form-control" placeholder="Enter Approval Remarks and NEFT/RTGS Payment details from Bank">
									<?php echo form_error('remarks') ?>
								</div>
						</div>                                            


                                        
								   
								
                           

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="addbank_balance" class="btn btn-primary"> 
						<!-- PATH:	Account/ public function addbank_balance($id) and Bank_model->addbank_balance-->
                            <i class="fa fa-edit"></i> Agreed for terms & conditions...Proceed for Transaction </i>
							   </button>
						
						
                         <a href="<?php echo base_url('bank/') ?>" class="label label-warning"><i class="fa fa-edit"></i> Decline</a>
                      
                       
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<script>
    $(function(){
        $('.boxFormContainer').change(function(){
            var iSelector = $('[name="customerID"]');
            var customerID = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('product/validateCustomerCodeApi'); ?>",
                data : { customerID : customerID }
            })
            .done(function(response){
                var msg = JSON.parse(response);
                if(msg.status == 'true'){
                    $('.referralFa').html('<i class="fa fa-check"></i>');
                    iSelector.closest('.input-group').removeClass('has-error');
                    iSelector.closest('.input-group').addClass('has-success');
                    $('#customerName').text(msg.customerName);
                    $('#customerAddress').html(msg.customerAddress);
                    //$('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                    $('#referralCodeStatus').html('');
                }else{
                    $('.referralFa').html('<i class="fa fa-ban"></i>');
                    iSelector.closest('.input-group').removeClass('has-success');
                    iSelector.closest('.input-group').addClass('has-error');
                    $('#customerName').text('');
                    $('#customerAddress').text('');
                    $('#referralCodeStatus').html('<span style="color: #ff0000">Customer ID is invalid</span>');
                }
                //alert(msg);
            });


            //Get Total Price
            var sum = 0;
            $('.individualPrice').each(function() {
                sum += Number($(this).val());
            });
            $('#totalPrice').text(sum.toFixed(2));

        });



        $('#addTableRow').click(function(e){



            e.preventDefault();

            $('table.newProductTable tbody tr td select').select2('destroy');
            var tableRow = $('table.newProductTable tbody tr.originalRow').html();

            $('table.newProductTable tbody').append('<tr>'+tableRow+'</tr>');
            $('select').select2();


        });
    });

</script>

<script>
    $(document).on('click', '.removeProductRow', function() {
        $(this).closest('tr').html('');

        var sum = 0;
        $('.individualPrice').each(function() {
            sum += Number($(this).val());
        });
        $('#totalPrice').text(sum.toFixed(2));

    });
</script>

<?php } ?>

