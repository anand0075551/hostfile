<?php function page_css(){ ?>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>
<?php include('header.php'); ?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add CMS role payment</h3>
                </div><!-- /.box-header -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
					<div class="box-body">
											 <div class="form-group <?php if(form_error('business_group')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Business group
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
								<select class="form-control" name="business_group" id="business_group" style=" width:100% auto; ">
								<option value="">Choose option</option>
								<?php 
										$query1 = $this->db->get('business_groups');
										foreach ($query1->result() as $row) 
										{
											echo "<option value='".$row->id."'>".$row->business_name."</option>";
										}
									
								?>
							    </select>
                            </div>
                        </div>
							 <div class="form-group <?php if(form_error('from_role')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">From Role
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<select class="form-control" name="from_role" id="from_role" style=" width:100% auto; ">
							<option value="">Choose option</option>
							<?php 
									$query1 = $this->db->get('role');
										foreach ($query1->result() as $row) 
										{
									echo "<option value='".$row->id."'>".$row->rolename."</option>";
										}
								
							?>
						</select>
                        </div>
                        </div>
												
					 <div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">To Role
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
								<select class="form-control" name="to_role" id="to_role" style=" width:100% auto; ">
								<option value="">Choose option</option>
								<?php 
										$query1 = $this->db->get('role');
											foreach ($query1->result() as $row) 
											{
										echo "<option value='".$row->id."'>".$row->rolename."</option>";
											}
									
								?>
							</select>
                        </div>
                        </div>
					 <div class="form-group <?php if(form_error('transport_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Trasport type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
								<select class="form-control" name="transport_type" id="transport_type" style=" width:100% auto; ">
								<option value="">Choose option</option>
								<option value="Forward">Forward</option>
								<option value="Reverse">Reverse</option>
								</select>
                            </div>
                        </div>

						 <div class="form-group <?php if(form_error('cms_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">CMS type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
								<select class="form-control" name="cms_type" id="cms_type" style=" width:100% auto; ">
								<option value="">Choose option</option>
								<option value="Local">Local</option>
								<option value="Semi-Local">Semi-Local</option>
								<option value="Medium">Medium</option>
								<option value="Long">Long</option>
								<option value="Overnight">Overnight</option>
								</select>
                            </div>
                        </div>
		<div class="form-group <?php if(form_error('delivery_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Delivery type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
								<select class="form-control" name="delivery_type" id="delivery_type" style=" width:100% auto; ">
								<option value="">Choose option</option>
								<option value="Self">Self</option>
								<option value="Counter Delivery">Counter Delivery</option>
								<option value="Assign Delivery Executive">Assign Delivery Executive</option>
								</select>
                            </div>
                        </div>
								<div class="form-group <?php if(form_error('delivery_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">For Status
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
								<select class="form-control" name="status" id="status" style=" width:100% auto; ">
								<option value="">Choose option</option>
								<option value="For Delivery">For Delivery</option>
								<option value="For Pickup">For Pickup</option>
								
								</select>
                            </div>
                        </div>
		<!--      <div class="form-group < ?php if(form_error('max_cost')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Maximum Cost For Vendor Self Delivery
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_cost" class="form-control" value="< ?php echo set_value('max_cost'); ?>" placeholder="Enter min quantity">
								< ?php echo form_error('max_cost') ?>
                            </div>
                        </div>
		-->				
						
						
						 <div class="form-group <?php if(form_error('parcel_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Parcel type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
							<select class="form-control" name="parcel_type" id="parcel_type" style=" width:100% auto; ">
									<option value="">Choose option</option>									
                                        <option value="Documents">Documents</option>
                                        <option value="Parcel">Parcel</option>
                                        <option value="Food Items">Food Items</option>
                                        <option value="Medicines">Medicines</option>
                                        <option value="Goods">Goods</option>
                                        <option value="Natural Products">Natural Products</option>
                                        <option value="Chemical Products">Chemical Products</option>
                                        <option value="Carton Box">Carton Box</option>
							</select>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('min_quantity')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Minimum quantity
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="min_quantity" class="form-control" value="<?php echo set_value('min_quantity'); ?>" placeholder="Enter min quantity">
								<?php echo form_error('min_quantity') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('max_quantity')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Maximum quantity
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_quantity" class="form-control" value="<?php echo set_value('max_quantity'); ?>" placeholder="Enter max quantity">
								<?php echo form_error('max_quantity') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('min_km')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Minimum KM
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="min_km" class="form-control" value="<?php echo set_value('min_km'); ?>" placeholder="Enter minimum km">
								<?php echo form_error('min_km') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('max_km')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Maximum KM
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_km" class="form-control" value="<?php echo set_value('max_km'); ?>" placeholder="Enter max km">
								<?php echo form_error('max_km') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('min_volume')) echo 'has-error'; ?>">
                            <label for="min_volume" class="col-md-3">Minumum Volume
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="min_volume" class="form-control" value="<?php echo set_value('min_volume'); ?>" placeholder="Enter min volume">
								<?php echo form_error('min_volume') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('max_volume')) echo 'has-error'; ?>">
                            <label for="max_volume" class="col-md-3">Maximum Volume
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_volume" class="form-control" value="<?php echo set_value('max_volume'); ?>" placeholder="Enter max Volume">
								<?php echo form_error('max_volume') ?>
                            </div>
                        </div>
						

					
						 <div class="form-group <?php if(form_error('min_kg')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Minimum weigth in kg
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="min_kg" class="form-control" value="<?php echo set_value('min_kg'); ?>" placeholder="Enter minimum weight in kg">
								<?php echo form_error('min_kg') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('max_kg')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Maximum weigth in kg
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_kg" class="form-control" value="<?php echo set_value('max_kg'); ?>" placeholder="Enter maximum weight in kg">
								<?php echo form_error('max_kg') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('vehicle_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Vehicle type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="vehicle_type" class="form-control" value="<?php echo set_value('vehicle_type'); ?>" placeholder="Enter vehicle type">
								<?php echo form_error('vehicle_type') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('shipment_cost')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Shipment cost
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="shipment_cost" class="form-control" value="<?php echo set_value('shipment_cost'); ?>" placeholder="Enter shipment cost">
								<?php echo form_error('shipment_cost') ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                     </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_payment" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add payment
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
<?php }?> 