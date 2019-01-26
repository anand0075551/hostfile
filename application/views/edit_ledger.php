
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
                    <h3 class="box-title">Edit/Update Ledger Accounts</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('pay_type')) echo 'has-error'; ?>">

                            <label for="firstName" class="col-md-3">Pay Specifications
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="pay_type" step="0.1" min="1" class="form-control" disabled value="<?php echo $ledger->pay_type; ?>" placeholder="Update pay_type">
                                <?php echo form_error('pay_type') ?>
                            </div>
                        </div>
						
						 <div class="form-group <?php if(form_error('debit')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Debits</label>
                            <div class="col-md-9">
                                <input type="number" name="debit" step="0.1" min="1" class="form-control" disabled value="<?php echo $ledger->debit; ?>" placeholder="Update Debits">
                                <?php echo form_error('debit') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('credit')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Credits</label>
                            <div class="col-md-9">
                                <input type="number" name="credit" class="form-control" disabled value="<?php echo $ledger->credit; ?>" ">
                                <?php echo form_error('credits') ?>
                            </div>
                        </div> 

                  <!--      <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transaction Start Date</label>
                            <div class="col-md-9">
                                <input type="number" name="start_date" class="form-control"  value="<?php echo date($ledger->created_at); ?>" ">
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div> -->
						
						<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Remarks/Comments
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
									<input type="text" name="remarks" class="form-control" value="<?php echo $ledger->remarks; ?>" placeholder="Update Comments">
									<?php echo form_error('remarks') ?>

								</div>
						</div>
						
				<!-- 	<div class="form-group <?php if(form_error('modified_by')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Last Modified By
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<input type="number" name="modified_by" step="0.1" min="1" class="form-control" value="<?php echo $ledger->modified_by; ?>" >
									<?php echo form_error('modified_by') ?>

								</div>
						</div>
                    
					 					<div class="form-group < ?php if(form_error('modified_at')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Last Modified Time
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<input type="number" name="modified_at" step="0.1" min="1" class="form-control" value="< ?php echo $ledger->modified_at; ?>" >
									< ?php echo form_error('modified_at') ?>

								</div>
						</div>-->
						
               	          <div class="form-group <?php if(form_error('challan')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Challan</label>
                            <div class="col-md-9">
                               <input type="file" name="userfile" class="form-control"  value="<?php echo $ledger->challan; ?>" ">
                                <?php echo form_error('challan') ?>
                            </div>
                        </div>
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: -->
                        <button type="submit" name="submit" value="edit_ledger" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Ledger
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

