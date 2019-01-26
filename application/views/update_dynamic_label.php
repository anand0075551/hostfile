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
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?><div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create Dynamic Labels</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
						<div class="form-group <?php if(form_error('business_type')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-4">Business Type
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<select name="business_types" id="business_types" class="form-control"  style="width:100%;">
									<option value="<?php echo $update_labels->business_type; ?>" >
										<?php 
										$query1 = $this->db->get_where('business_groups',['id'=>$update_labels->business_type]);
										foreach($query1->result() as $res);
										
										$buss_name = $res->business_name;
										echo $buss_name;
										?>
									</option>
									<?php
										$query = $this->db->order_by('business_name','asc')->get('business_groups');
											foreach($query->result() as $res)
											{
												echo "<option value='$res->id'>" .$res->business_name."</option>";
											}
									?>
								</select>
								<?php echo form_error('business_type') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Banner 1
								<span class="text-aqua">(Min 3 Banner , Max size 2MB )</span>
							</label>
							<div class="col-md-8">
								<input type="file" class="form-control" name="userfile[]" Value="<?php $update_labels->banner1; ?>" multiple="multiple">
								<br>
								<img src ="<?php echo base_url('banner/'.$update_labels->banner1); ?>">
								<img src ="<?php echo base_url('banner/'.$update_labels->banner2); ?>">
								<img src ="<?php echo base_url('banner/'.$update_labels->banner3); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Sold By Label
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="sold_by" class="form-control" value="<?php echo $update_labels->sold_by; ?>" placeholder="Sold By">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Price Label
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="price" class="form-control" value="<?php echo $update_labels->price; ?>" placeholder="Price Label">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Currency Value
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="currency" class="form-control" value="<?php echo $update_labels->currency_value; ?>" placeholder="Currency Value e.g CPA, LPA">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Add To Cart Label
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="add_to_cart" class="form-control"  value="<?php echo $update_labels->add_to_cart; ?>" placeholder="Add To Cart Label">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Items Label
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="items" class="form-control" value="<?php echo $update_labels->items; ?>"  placeholder="Items Label">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Stock Available Label
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="available" class="form-control" value="<?php echo $update_labels->available; ?>"  placeholder="Items Label">
							</div>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Invoice Heading
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="heading" class="form-control" value="<?php echo $update_labels->invoice_heading; ?>"  placeholder="Invoice Heading">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Invoice Sub Heading 1
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="sub_heading1" class="form-control"  value="<?php echo $update_labels->invoice_sub_heading1; ?>"  placeholder="Invoice Sub Heading 1">
							</div>
						</div>
						<div class="form-group">
							<label for="firstName" class="col-md-4">Invoice Sub Heading 2
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" name="sub_heading2" class="form-control" value="<?php echo $update_labels->invoice_sub_heading2; ?>"  placeholder="Invoice Sub Heading 2">
							</div>
						</div>
					</div>
					
                    <div class="box-footer">
                        <button type="submit" name="submit" value="dynamic_update" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Labels                        </button>
						<a href="<?php echo base_url('Smb_product/dynamic_smb') ?>" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } 