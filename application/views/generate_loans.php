<?php

	foreach($total_wallet->result() as $wallet);  //total_wallet points calc from Ledgr_Model/PF $total_wallet
	foreach($total_wallet_debit->result() as $debit);
	foreach($total_wallet_credit->result() as $credit);
 
$total_wallet 		 = $wallet->amount; //total_wallet
$total_wallet_debit  = $debit->debit;
$total_wallet_credit = $credit->credit;

$avaialble_wallet = ($total_wallet_debit - $total_wallet_credit);
?>
<?php function page_css(){ ?>


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
                    <h3 class="box-title">Verify to Generate Loan Schemes</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	<div class="box-body">
					<table class="table table-bordered">
								   
								   <tr><th> Available Wallet Points			</th> <td> <?php  echo amountFormat($avaialble_wallet);   ?> 	 </td></tr>
								   
								</table>	
								<hr />
						</div>		
								
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
				        <div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="voucher_name" class="form-control" value="<?php echo $commissions->remarks; ?>" >
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('identity_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Id
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="identity_id" class="form-control" value="<?php echo $commissions->identity_id; ?>" >
                                <?php echo form_error('identity_id') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Amount</label>
                            <div class="col-md-9">
                                <input type="number" readonly name="amount" step="0.1" min="1" class="form-control" value="<?php echo $commissions->amount; ?>" placeholder="Update Amount">
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>

					    <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Scheme Valid From</label>
                            <div class="col-md-9">
                                <input type="date" readonly name="start_date"  class="form-control"  value="<?php echo $commissions->start_date; ?>" >
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>
					
                        <div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">End Date</label>
                            <div class="col-md-9">
                                <input type="date" readonly name="end_date" class="form-control"  value="<?php echo $commissions->end_date; ?>" >
								       <?php echo form_error('end_date') ?>
                            </div>
                        </div>
						
                        <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan EMI Start Date</label>
                            <div class="col-md-9">
                                <input type="date" readonly name="emi_start_date"  class="form-control"  value="<?php $start = date('d-m-Y') ?>" >
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>
						
                        <div class="form-group ">
                            <label for="firstName" class="col-md-3">Loan EMI Tenures</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control"  name="tenure" readonly value="<?php echo $commissions->tenure; ?>" >
								      
                            </div>
                        </div>							
                        <div class="form-group ">
                            <label for="firstName" class="col-md-3">Loan Period (1-Daily, 7-Weekly, 30-Monthly)</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control"  name="period" readonly value="<?php echo $commissions->period; ?>" >
								      
                            </div>
                        </div>						
						 <div class="form-group ">
                            <label for="firstName" class="col-md-3">Repayment Tenures</label>
                            <div class="col-md-12">
                               <?php $start = date('d-m-Y');
								if ($commissions->period == '1')			//daily repayment
								{ 	$z = 'day';	 
								}elseif ($commissions->period == '7')    //weekly repayent
								{	$z = 'week';
								}elseif ($commissions->period == '30')   //monthly repayment
								{	$z = 'month';									
								}
								
								$tenure = $commissions->tenure -1 ;  //Total Tenure of Repayment
								$tenure_bal = 0;
								$i = 1;
									
								for ($x = 0; $x <= $tenure; $x++) {
														
									$date=new DateTime($start);
									$date->modify('+'.$x.$z);								
									
									$tenure_amt = ($commissions->amount / $commissions->tenure);
									if ($tenure_bal == null)
									{
										$tenure_bal = 0;
									}	
									
									$tenure_bal = $tenure_bal  + $tenure_amt;
									$balance_amt = ($commissions->amount - $tenure_bal);
									
							//	echo " $x 's EMI = $tenure_amt  Balance to be Paid = $balance_amt effective Valid Date " .$date->format('d-m-Y') ;
									?>
									
										<table>		
										  <tr>											    
											<td><?php echo " Deduction Date " .$date->format('d-m-Y') ?><br></td>
											<td><?php echo " $i-EMI  Rs.<b>$tenure_amt</b> "  ?><br> </td>
											<td><?php echo " Next Balance to be Paid Rs. <b> $balance_amt </b>"  ?><br></td>
										  </tr>
										</table> 
									
								<?php $i++;	}?> 
                           </div>
                        </div>
								
                 
						
						
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Assigned Role Name</label>
                            <div class="col-md-9">
								<input type="text"  name="to_role" class="form-control" readonly value="<?php echo $rolename = typeDbtablerow($commissions->to_role)->rolename; ?>" >
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>
												
						<!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <strong>Client User : </strong>

                                    <select name="customerID" class="form-control">

                                        <option value=""> Select Client</option>
                                        <?php foreach($client->result() as $user){
											if ($user->rolename == $commissions->to_role)
											{
                                            echo '<option value="'.$user->id.'"> '.user_full_name($user).' </option>';
											}
                                        }
                                        ?>

                                    </select>
                                    <p id="referralCodeStatus"></p>

                                </div><!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <strong>Client Name:</strong>
                                    <address>
                                        <strong><span id="customerName"></span></strong><br>
                                        <p id="customerAddress"></p>
                                    </address>
                                </div><!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Date: <?php echo date('d/m/Y') ?><br/>
                                </div><!-- /.col -->
                                <div class="clearfix"></div>
                                <hr />
                            </div><!-- /.row -->
							
					<br><br>
<br>	<br>					
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="generate_loans" class="btn btn-primary">
						<!-- PATH: Bank/public generate_loans -->
                            <i class="fa fa-edit"></i> Generate Loan Scheme
                        </button>
						<a href="<?php echo base_url('bank/view_loan_schemes/'.$commissions->id) ?>"  class="btn btn-warning"><i class="fa fa-bar-return"></i> Back </a>	
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

   <style>
table, th, td {
    border: 1px solid red;
}
</style>     

<?php } ?>
