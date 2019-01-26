
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
                    <h3 class="box-title">Edit Business Loan Schemes</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
				        <div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Business Loan Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="type" class="form-control" value="<?php echo $loan_type = typeDbTablerow($commissions->type)->rolename; ?>" readonly >
                                <?php echo form_error('type') ?>
                            </div>
                        </div>
						
				        <div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control" value="<?php echo $commissions->remarks; ?>" placeholder="Update Vouchers Name">
                                <?php echo form_error('remarks') ?>
                            </div>
                        </div>						

                        <div class="form-group <?php if(form_error('tenure')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Tenure for Repayment</label>
                            <div class="col-md-9">
                                <input type="number" name="tenure" step="0.1" min="1" class="form-control" value="<?php echo $commissions->tenure; ?>" placeholder="Update Amount">
                                <?php echo form_error('tenure') ?>
                            </div>
                        </div>
			
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Amount/Value</label>
                            <div class="col-md-9">
                                <input type="number" name="amount"  value="<?php echo $commissions->amount; ?>" placeholder="Loan Sanction Amount" >
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>					
						<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loans Valid From</label>
                            <div class="col-md-9">
								<input type="text" readonly name="start_date" class="form-control" value="<?php echo $commissions->start_date; ?>" >
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('end_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loans Valid Till</label>
                            <div class="col-md-9">
								<input type="text" readonly name="end_date" class="form-control" value="<?php echo $commissions->end_date; ?>" >
                                <?php echo form_error('end_date') ?>
                            </div>
                        </div>
														

								
						
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_loan_schemes" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Loans
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

<?php } ?>

