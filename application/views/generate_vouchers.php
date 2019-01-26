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
                    <h3 class="box-title">Verify to Generate Vouchers</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	<div class="box-body">
					<table class="table table-bordered">
								   
								   <tr><th> Available Wallet Points			</th> <td> <?php  echo amountFormat($avaialble_wallet);   ?> 	 </td></tr>
								   	<tr><th> Balance Voucher Points  </th> <td> <?php echo ($voucher_balance );   ?> Points	 </td></tr>
								   
								</table>	
								<hr />
						</div>		
								
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
				        <div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text"  name="voucher_name" class="form-control" value="<?php echo $commissions->remarks; ?>" >
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('identity_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Id
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text"  name="identity_id" class="form-control" value="<?php echo $commissions->identity_id; ?>" >
                                <?php echo form_error('identity_id') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Amount</label>
                            <div class="col-md-9">
                                <input type="number"  name="amount" step="0.1" min="1" class="form-control" value="<?php echo $commissions->amount; ?>" placeholder="Update Amount">
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Start Date</label>
                            <div class="col-md-9">
                                <input type="date"  name="start_date" step="0.1" min="1" class="form-control"  value="<?php echo $commissions->start_date; ?>" >
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>
						
					
                        <div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">End Date</label>
                            <div class="col-md-9">
                                <input type="date"  name="end_date" class="form-control"  value="<?php echo $commissions->end_date; ?>" >
                                <?php echo form_error('end_date') ?>
                            </div>
                        </div>	
						
						
						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Account Id</label>
                            <div class="col-md-9">
								<input type="text"  name="acct_id" class="form-control" value="<?php echo $commissions->acct_id; ?>" >
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Sub-Account Id</label>
                            <div class="col-md-9">
								<input type="text"  name="sub_acct_id" class="form-control" value="<?php echo $commissions->sub_acct_id; ?>" >
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Assigned Role Name</label>
                            <div class="col-md-9">
								<input type="text"  name="to_role" class="form-control" value="<?php echo $commissions->to_role; ?>" >
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>
												

						<div class="form-group <?php if(form_error('commission')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Commisions to 'Seller'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number"  name="commission" step="0.1" min="0.1" class="form-control" value="<?php echo $commissions->commission; ?>" >
									<?php echo form_error('commission') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('benefits')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Benefits to 'Client'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number"  name="benefits" step="0.1" min="0.1" class="form-control" value="<?php echo $commissions->benefits; ?>" >
									<?php echo form_error('benefits') ?>
								</div>
								</div>
						</div>		
						<div class="form-group <?php if(form_error('transferrable')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Transferrable..?
                                <span class="text-red"></span>
                            </label>                        						
								<div class="col-md-9">
								<div class="input-group">
									<input type="text"  name="transferrable" class="form-control" value="<?php echo $commissions->transferrable; ?>" >
									<?php echo form_error('transferrable') ?>
								</div>
								</div>
																
                        </div> 
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="generate_vouchers" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Generate PIN Vouchers
                        </button>
							
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>

