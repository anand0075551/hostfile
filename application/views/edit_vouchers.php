
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
                    <h3 class="box-title">Edit Business Vouchers</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
				        <div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="type" class="form-control" value="<?php echo $Voucher_type = typeDbTablerow($commissions->type)->rolename; ?>" readonly >
                                <?php echo form_error('type') ?>
                            </div>
                        </div>
						
				        <div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="voucher_name" class="form-control" value="<?php echo $commissions->remarks; ?>" placeholder="Update Vouchers Name">
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>						

                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Amount</label>
                            <div class="col-md-9">
                                <input type="number" name="amount" step="0.1" min="1" class="form-control" value="<?php echo $commissions->amount; ?>" placeholder="Update Amount">
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Start Date</label>
                            <div class="col-md-9">
                                <input type="date" name="start_date"  value="<?php echo $commissions->start_date; ?>" placeholder="YYYY-MM-DD" >
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>
						
                        <div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">End Date</label>
                            <div class="col-md-9">
                                <input type="date" name="end_date"  value="<?php echo $commissions->end_date; ?>" placeholder="YYYY-MM-DD" >
                                <?php echo form_error('end_date') ?>
                            </div>
                        </div>					
						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Account Id</label>
                            <div class="col-md-9">
								<input type="text" readonly name="acct_id" class="form-control" value="<?php echo $Voucher_acct = ledgerDbTablerow($commissions->acct_id)->name; ?>" >
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Sub-Account Id</label>
                            <div class="col-md-9">
								<input type="text" readonly name="sub_acct_id" class="form-control" value="<?php echo $Voucher_sub_acct = ledgerDbTablerow($commissions->sub_acct_id)->name; ?>" >
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Assigned Role Name</label>
                            <div class="col-md-9">
								<input type="text" readonly name="to_role" class="form-control" value="<?php echo $role = typeDbTablerow($commissions->to_role)->rolename; ?>" >
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
									<input type="number" name="commission" step="0.1" min="0.1" class="form-control" value="<?php echo $commissions->commission; ?>" >
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
									<input type="number" name="benefits" step="0.1" min="0.1" class="form-control" value="<?php echo $commissions->benefits; ?>" >
									<?php echo form_error('benefits') ?>
								</div>
								</div>
						</div>			
						<div class="form-group <?php if(form_error('transferrable')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Transferrable  Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="transferrable" class="form-control"  value="<?php echo $commissions->transferrable; ?>" >
                                <option value=""> Select Transferrable  Type </option>
                                <option value="yes" <?php echo set_select('type', 'yes') ?>>Yes</option>
                                <option value="no" <?php echo set_select('type', 'no') ?>>No</option>
                            </select>
                                <?php echo form_error('transferrable') ?>
                            </div>
                        </div> 
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_vouchers" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Vouchers
           </button>

	<a href="<?php echo base_url('vouchers/business_voucher_index/') ?>"  class="btn btn-warning"><i class="fa fa-bar-return"></i> Back </a>
	             
                    </div>
                </form>
            </div><!-- /.box -->

        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>

