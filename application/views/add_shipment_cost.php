
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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add Shipment Cost:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        

											<div class="form-group <?php if(form_error('weight')) echo 'has-error'; ?>">
                            <label for="weight" class="col-md-3">Weight
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="weight">
									<input type="text" name="weight" class="form-control" value="<?php echo set_value('weight'); ?>" placeholder="Weight (kg)">
								</div>
								<?php echo form_error('weight') ?>
                            </div>
                        </div>	 

	
						
                        <div class="form-group <?php if(form_error('from_pincode')) echo 'has-error'; ?>">
                            <label for="pincode" class="col-md-3">From Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="from_pincode" class="form-control" onchange="get_shipper_location(this.value)">
                                    <option value=""> Select Pincode </option>
                                    <?php
                                    if($pincode->num_rows() > 0)
                                    {
                                        foreach($pincode->result() as $c){
                                           // $selected = ($c->id == 105)? 'selected' : '';
                                            echo '<option value="'.$c->id.'"> '.$c->pincode.'-'.$c->location.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('from_pincode') ?>
                            </div>
                        </div>
					

					
                        <div class="form-group <?php if(form_error('to_pincode')) echo 'has-error'; ?>">
                            <label for="to_pincode" class="col-md-3">To Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="to_pincode" class="form-control" onchange="get_receiver_location(this.value)">
                                    <option value=""> Select Pincode </option>
                                    <?php
                                    if($pincode->num_rows() > 0)
                                    {
                                        foreach($pincode->result() as $c){
                                           
                                            echo '<option value="'.$c->id.'"> '.$c->pincode.'-'.$c->location.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('to_pincode') ?>
                            </div>
                        </div>
					

						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="amount" class="col-md-3">Amount (Rs.)
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="amount">
									<input type="text" name="amount" class="form-control" value="<?php echo set_value('amount'); ?>" placeholder="Amount">
								</div>
								<?php echo form_error('amount') ?>
                            </div>
                        </div>
						
						
						
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_shipment_cost" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Shipment Cost
                        </button>
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
	

<?php } ?>

