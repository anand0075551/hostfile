<?php function page_css(){ ?>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>
<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box-header">
                    <h3 class="box-title">Edit Role wise shipment details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
									
                    <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="business_group"  class="form-control">
                                <?php
                                if ($cms->business_groups != '') {
                                    ?> <option value="<?php echo $cms->business_groups; ?>"> <?php
                                        echo singleDbTableRow($cms->business_groups, 'business_groups')->business_name; 
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>
                                
                                <?php
								$business_name = $this->db->get('business_groups');
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {
                                       
                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	
                            <?php echo form_error('business_name') ?>                       
                        </div>				
                    </div>
					
					
						<div class="form-group <?php if (form_error('from_role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">From Role<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="from_role" class="form-control" style=" width:100% auto; ">
                     <?php
                                    if ($cms->from_role != "") 
										{
                                    ?> <option value="<?php echo $cms->from_role; ?>"> <?php
                                        echo singleDbTableRow($cms->from_role, 'role')->rolename; 
                                        ?></option>
                                    <?php
                                }
										else {
                                        echo "<option value=''>Select option</option>";
                                    }
									$role = $this->db->get('role');
                                    if ($role->num_rows() > 0) {
                                        foreach ($role->result() as $c) {

                                            echo '<option value="' . $c->id . '"> ' . $c->rolename . '</option>';
                                        }
                                    }
                                    ?>
                            </select>	
                            <?php echo form_error('to_role') ?>                       
                        </div>				
                    </div>

						<div class="form-group <?php if (form_error('to_role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">To Role<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="to_role" class="form-control" style=" width:100% auto; ">
                     <?php
                                    if ($cms->to_role != "") 
										{
                                    ?> <option value="<?php echo $cms->to_role; ?>"> <?php
                                        echo singleDbTableRow($cms->to_role, 'role')->rolename; 
                                        ?></option>
                                    <?php
                                }





										else {
                                        echo "<option value=''>Select option</option>";
                                    }
									$role = $this->db->get('role');
                                    if ($role->num_rows() > 0) {
                                        foreach ($role->result() as $c) {

                                            echo '<option value="' . $c->id . '"> ' . $c->rolename . '</option>';
                                        }
                                    }
                                    ?>
                            </select>	
                            <?php echo form_error('to_role') ?>                       
                        </div>				
                    </div>
					<div class="form-group <?php if (form_error('transport_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Transport type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="transport_type" class="form-control" value="<?php echo $cms->transport_type; ?>">
                            <?php echo form_error('transport_type') ?>
							<option value="Forward" <?php if ($cms->transport_type == 'Forward') echo 'selected'; ?>>Forward</option>
							<option value="Reverse" <?php if ($cms->transport_type == 'Reverse') echo 'selected'; ?>>Reverse</option>
		
							</select>
                        </div>
                    </div>

						<div class="form-group <?php if (form_error('cms_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">CMS type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
							<select class="form-control" name="cms_type" id="cms_type" style=" width:100% auto; " value="">
							    <option value="Local" <?php if ($cms->cms_type == 'Local') echo 'selected'; ?>>Local</option>
							    <option value="Semi-Local" <?php if ($cms->cms_type == 'Semi-Local') echo 'selected'; ?>>Semi-Local</option>
							    <option value="Medium" <?php if ($cms->cms_type == 'Medium') echo 'selected'; ?>>Medium</option>
							    <option value="Long" <?php if ($cms->cms_type == 'Long') echo 'selected'; ?>>Long</option>
							    <option value="Overnight" <?php if ($cms->cms_type == 'Overnight') echo 'selected'; ?>>Overnight</option>

								</select>
                        </div>
                    </div>
					
					
					
					<div class="form-group <?php if (form_error('delivery_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Delivery type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
							<select class="form-control" name="delivery_type" id="delivery_type" style=" width:100% auto; " value="">
							    <option value="Self" <?php if ($cms->delivery_type == 'Self') echo 'selected'; ?>>Self</option>
							    <option value="Counter Delivery" <?php if ($cms->delivery_type == 'Counter Delivery') echo 'selected'; ?>>Counter Delivery</option>
							    <option value="Assign Delivery Executive" <?php if ($cms->delivery_type == 'Assign Delivery Executive') echo 'selected'; ?>>Assign Delivery Executive</option>
							    

								</select>
                        </div>
                    </div>
					
					
										<div class="form-group <?php if (form_error('delivery_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Delivery type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
							<select class="form-control" name="status" id="status" style=" width:100% auto; " value="">
							    <option value="For Delivery" <?php if ($cms->status == 'For Delivery') echo 'selected'; ?>>For Delivery</option>
							    <option value="For Pickup" <?php if ($cms->status == 'For Pickup') echo 'selected'; ?>>For Pickup</option>
							  
							    

								</select>
                        </div>
                    </div>
					
	<!--		 <div class="form-group < ?php if(form_error('max_cost')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Maximum Cost For Vendor Self Delivery
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_cost" class="form-control" value="< ?php echo $cms->max_cost; ?>" placeholder="Enter min quantity">
								< ?php echo form_error('max_cost') ?>
                            </div>
                        </div>
		-->			
					
					
					<div class="form-group <?php if (form_error('cms_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Parcel type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
							<select class="form-control" name="parcel_type" id="parcel_type" style=" width:100% auto; " value="<?php echo $cms->parcel_type; ?>">
										 <option value="Documents" <?php if ($cms->parcel_type == 'Documents') echo 'selected'; ?>>Documents</option>
										 <option value="Parcel" <?php if ($cms->parcel_type == 'Parcel') echo 'selected'; ?>>Parcel</option>
										 <option value="Food Items" <?php if ($cms->parcel_type == 'Food Items') echo 'selected'; ?>>Food Items</option>
										 <option value="Medicines" <?php if ($cms->parcel_type == 'Medicines') echo 'selected'; ?>>Medicines</option>
										 <option value="Goods" <?php if ($cms->parcel_type == 'Goods') echo 'selected'; ?>>Goods</option>
										 <option value="Natural Products" <?php if ($cms->parcel_type == 'Natural Products') echo 'selected'; ?>>Natural Products</option>
										 <option value="Chemical Products" <?php if ($cms->parcel_type == 'Chemical Products') echo 'selected'; ?>>Chemical Products</option>
										 <option value="Carton Box" <?php if ($cms->parcel_type == 'Carton Box') echo 'selected'; ?>>Carton Box</option>

							</select>
                        </div>
                    </div>
					<div class="form-group <?php if (form_error('min_quantity')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Minimum quantity
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="min_quantity" class="form-control" value="<?php echo $cms->min_quantity; ?>">
                            <?php echo form_error('min_quantity') ?>
                        </div>
                    </div>
                            
					<div class="form-group <?php if (form_error('max_quantity')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Maximum quantity
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="max_quantity" class="form-control" value="<?php echo $cms->max_quantity; ?>">
                            <?php echo form_error('max_quantity') ?>
                        </div>
                    </div>
										<div class="form-group <?php if (form_error('min_volume')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Minimum Volume
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="min_volume" class="form-control" value="<?php echo $cms->min_volume; ?>">
                            <?php echo form_error('min_volume') ?>
                        </div>
                    </div>
										<div class="form-group <?php if (form_error('max_volume')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Maximum volume
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="max_volume" class="form-control" value="<?php echo $cms->max_volume; ?>">
                            <?php echo form_error('max_volume') ?>
                        </div>
                    </div>
					<div class="form-group <?php if (form_error('min_km')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Minimum KM
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="min_km" class="form-control" value="<?php echo $cms->min_km; ?>">
                            <?php echo form_error('min_km') ?>
                        </div>
                    </div>
                            
					<div class="form-group <?php if (form_error('max_km')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Maximum KM
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="max_km" class="form-control" value="<?php echo $cms->max_km; ?>">
                            <?php echo form_error('max_km') ?>
                        </div>
                    </div>
					
					
					
						 <div class="form-group <?php if(form_error('min_kg')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Minimum weigth in kg
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="min_kg" class="form-control" value="<?php echo $cms->min_kg; ?>" placeholder="Enter minimum weight in kg">
								<?php echo form_error('min_kg') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('max_kg')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Maximum weigth in kg
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="max_kg" class="form-control" value="<?php echo $cms->max_kg; ?>" placeholder="Enter maximum weight in kg">
								<?php echo form_error('max_kg') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('vehicle_type')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Vehicle type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="vehicle_type" class="form-control" value="<?php echo $cms->vehicle_type; ?>" placeholder="Enter vehicle type">
								<?php echo form_error('vehicle_type') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('shipment_cost')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">Shipment cost
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<input type="text" name="shipment_cost" class="form-control" value="<?php echo $cms->shipment_cost; ?>" placeholder="Enter shipment cost">
								<?php echo form_error('shipment_cost') ?>
                            </div>
                        </div>
                            
  
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="copy_cms_role_payment" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update details
                    </button>
                </div>
                </div>
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