


<?php

function page_css() { ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

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
                    <h3 class="box-title">Edit Outward Items</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
						<div class="form-group <?php if(form_error('item_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Item Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="item_name" class="form-control"  value="<?php echo $visitor_entry->item_name; ?>" placeholder="">
                                <?php echo form_error('item_name') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('type_of_item')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type of Item
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="type_of_item" class="form-control"  value="<?php echo $visitor_entry->type_of_item; ?>" placeholder="">
                                <?php echo form_error('type_of_item') ?>

                            </div>
                        </div>
                     
					 
						<div class="form-group <?php if(form_error('item_number')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Item Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="item_number" class="form-control"  value="<?php echo $visitor_entry->item_number; ?>" placeholder="">
                                <?php echo form_error('item_number') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('invoice_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Invoice Id

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="invoice_id" class="form-control"  value="<?php echo $visitor_entry->invoice_id; ?>" placeholder="">
                                <?php echo form_error('invoice_id') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('purpose')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> <span>Purpose*</span></label>
                            <div class="col-md-9"> 
                                <select name="purpose" class="form-control" value="<?php echo $visitor_entry->purpose; ?>" >
								
								<option value="<?php echo $visitor_entry->purpose;?>"> 
									
									<?php
                                        $get = $this->db->get_where('visitors_details',['id'=> $visitor_entry->id]);
                                        foreach($get->result() as $r);
                                        echo $r->purpose;
                                    ?>
								</option>
                                    <option value=""> Select Purpose </option>
                                    <option value ="interview"> Interview </option>
									 <option value ="buisiness proposal"> Buisiness Proposal </option>
									  <option value ="advertisement"> Advertisement </option>
									   <option value ="stock inward"> Stock Inward </option>	
									    <option value ="stock outward"> Stock outward </option>

                                </select>
                                <?php echo form_error('purpose') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('item_value')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Item Value

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="item_value" class="form-control"  value="<?php echo $visitor_entry->item_value; ?>" placeholder="">
                                <?php echo form_error('item_value') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('from_place')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Place

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="from_place" class="form-control"  value="<?php echo $visitor_entry->from_place; ?>" placeholder="">
                                <?php echo form_error('from_place') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('to_whom')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">TO Whom



                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="to_whom" class="form-control"  value="<?php echo $visitor_entry->to_whom; ?>" placeholder="">
                                <?php echo form_error('to_whom') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('from_sender')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Sender

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="from_sender" class="form-control"  value="<?php echo $visitor_entry->from_sender; ?>" placeholder="">
                                <?php echo form_error('from_sender') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('mobile_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Moile Number


                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile_no" class="form-control"  value="<?php echo $visitor_entry->mobile_no; ?>" placeholder="">
                                <?php echo form_error('mobile_no') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Remarks

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control"  value="<?php echo $visitor_entry->remarks; ?>" placeholder="">
                                <?php echo form_error('remarks') ?>

                            </div>
                        </div>
						
					<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload Outward Item Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                        
				
			    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
				
                    <button type="submit" name="submit" value="edit_outward" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update outward Items
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->



<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



