
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
                    <h3 class="box-title">Edit Category ( Physical Product )</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

						<div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub Category Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" class="form-control"  value="<?php echo $sub_category->sub_category_name; ?>" placeholder=" Category Name">
                                <?php echo form_error('category_name') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';     ?>">
							<label for="firstName" class="col-md-3">Sub Category Banner
								<span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
							</label>
							<div class="col-md-2">
								<img src ="<?php echo base_url('smb_uploads/'.$sub_category->banner); ?>" width="100" height="80" >
							</div>
							<div class="col-md-7">
								<input type="file" name="userfile" class="form-control"  size="20" />
							</div>
						</div> 
						
						<div class="form-group <?php if(form_error('category_id')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Category
                                <span class="text-red">*</span>
                            </label>							
								<div class="col-md-9">
								<?php 
									$category_id = $sub_category->category;
									$get_category = $this->db->get_where('smb_category', ['id' => $category_id]);
									foreach($get_category->result() as $c){
										$category_name = $c->category_name;
									}
								?>
									<select name="category_id" class="form-control" onchange="get_value(this.value)">
									<option value='<?php echo $category_id ?>'><?php echo $category_name ?></option>
										<?php
											$query = $this->db->order_by('category_name','asc')->get('smb_category');
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->category_name."</option>";
												}
										?>
									</select>
									<?php echo form_error('category_id') ?>
								</div>
                        </div>
						
						<div class="form-group <?php if(form_error('brand_id')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Brands
                                <span class="text-red">*</span>
                            </label>								
								<div class="col-md-9">
								<?php 
									$brand_id = $sub_category->brand;
									$get_category = $this->db->get_where('smb_brand', ['id' => $brand_id]);
									foreach($get_category->result() as $b){
										$brand_name = $b->name;
									}
								?>
									<select name="brand_id" class="form-control" onchange="get_value(this.value)">
									<option value='<?php echo $sub_category->brand; ?>'><?php echo $brand_name; ?></option>
										<?php
											
											// Get brand  ID
												$query = $this->db->order_by('id','desc')->get('smb_brand');
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->name."</option>";
												}
										?>
									</select>
									<?php echo form_error('brand_id') ?>
								</div>
                        </div>
						
                    <div class="box-footer">
                        <button type="submit" name="submit" value="update_subcategory" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Category
                        </button>
						<a href="<?php echo base_url('Smb_product/physical_product_subcategory/') ?>" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } 