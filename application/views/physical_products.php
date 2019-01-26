<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
?>
<!-- Main content -->
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Products</h3>
                </div><!-- /.box-header -->
				
				
				<div class="row" style="padding:10px;">
					<div class="col-sm-3">
						<select class="form-control" name="biz_type" id="biz_type" style=" width:100% auto; ">
							<option value="">All Business Types</option>
							<?php 
								if($rolename == 11){
									$get_biz = $this->db->group_by('business_types')->get('smb_product');
								}
								else{
									$condition = $condition = " from_role LIKE '%".$rolename."%'";
									$get_biz = $this->db->group_by('business_types')->where($condition)->get('smb_product');
								}
								
								foreach($get_biz->result() as $b){
									echo "<option value='".$b->business_types."'>".singleDbTableRow($b->business_types, 'business_groups')->business_name."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3" id="s_catg_div">
						<select class="form-control" name="category" id="s_category" onChange="get_sub_catg(this.value)" style=" width:100% auto; ">
							<option value="">All Categories</option>
							<?php 
								$get_product = $this->db->get('smb_category');
								
								foreach($get_product->result() as $p){
									echo "<option value='".$p->id."'>".$p->category_name."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3" id="s_sub_catg_div" style="display:none;">
						<select class="form-control" name="sub_category" id="s_sub_category" onChange="get_product(this.value)"  style=" width:100% auto; ">
							<option value="">Sub Categories</option>
						</select>
					</div>
					<div class="col-sm-3" id="s_product_div" style="display:none;">
						<select class="form-control" name="product" id="s_product"  style=" width:100% auto; ">
							<option value="">Products</option>
						</select>
					</div>
					<div class="col-sm-2 text-center">
							
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-search"></i> Search </button>
						
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>	
				<?php if($rolename == 11){ ?>
				<div class="row" style="padding:10px;">
					<div class="col-lg-12 text-right" style="padding-right:40px;">
						<a class="btn btn-success" href="#" data-toggle="modal" data-target="#create" data-toggle="modal" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Product</a>
					</div>
				</div>
				<?php } ?>
					
				
				
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<div id="tab1">
						<table id="example" class="table table-bordered table-striped table-hover">
							<thead>
							<tr>
								<th width="35%">Action</th>
								<th>Image</th>
								<th>Title</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Business Type</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th width="35%">Action</th>
								<th>Image</th>
								<th>Title</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Business Type</th>
							</tr>
							</tfoot>
						</table>
					</div>
					<div id="tab2" style="display:none">
						<table id="example2" class="table table-bordered table-striped table-hover">
							<thead>
							<tr>
								<th width="35%">Action</th>
								<th>Image</th>
								<th>Title</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Business Type</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th width="35%">Action</th>
								<th>Image</th>
								<th>Title</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Business Type</th>
							</tr>
							</tfoot>
						</table>
					</div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section><!-- /.content -->
<div class="box-footer" align="right">
<!--<button name="submit" class="btn btn-warning" value="export" onClick="excelData(this)">
<i class fa fa-credit-card"></i> Download  Details </button>
<br>
<br>
---->
</div>

<!-- Create Category -->
<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px;">
			
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add New Product</h3>
                </div>
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
						<div id="product_details">
							<div class="row text-center">
								<font size="4"></font>
							</div><hr>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Business Types
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="business_types" id="business_types" class="form-control" style="width:100%;">
										<option value=>Choose Option</option>
										<?php
											$query = $this->db->order_by('business_name','asc')->get('business_groups');
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->business_name."</option>";
												}
										?>
									</select>
									<p id="biz_sts" style="color:red"></p>
								</div>
							</div>
							<div class="form-group ">
								<label for="firstName" class="col-md-4">Category
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="category_id" id="category" class="form-control" style="width:100%;" onchange="get_sub_category(this.value)">
										<option value=''>Choose Option</option>
										<?php
											$query = $this->db->order_by('category_name','asc')->get_where('smb_category',['digital'=>'no']);
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->category_name."</option>";
												}
										?>
									</select>
									<p id="category_sts" style="color:red"></p>
								</div>
							</div>
							<div class="form-group">
								<label for="invoiceid" class="col-md-4">Sub-Category
									<span class="text-red">*</span>
								</label>							
								<div class="col-md-8">
									<select name="sub_category" id="sub_category" style="width:100%;" class="form-control">
									<option value='' class="form-control">Choose One</option>
										
									</select>
									<p id="sub_category_sts" style="color:red"></p>
									<?php echo form_error('sub_category') ?>
								</div>
							</div>
							
						<div class="box-footer text-right">
							<button type="button" id="next_business" class="btn btn-primary btn-sm">
								Next <i class="fa fa-hand-o-right"></i> 
							</button>
						</div>
						</div>
					
						<div id="business_details" style="display:none">
							<div class="row text-center">
								<font size="4">Product Details</font><br><br>
							</div><hr>
							<div class="form-group <?php if(form_error('product_title')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-4">Product Title
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="product_title" id="title" class="form-control"  placeholder="Product Title" onkeyup="get_grade_status()">
									<?php echo form_error('product_title') ?>
								</div>
							</div>
							<div class="form-group <?php if(form_error('brand')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-4">Brands
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="brand[]" class="form-control" style="width:100%;" multiple="">
										<option value=''>Choose Option</option>
										<?php
											$query = $this->db->order_by('name','asc')->get('smb_brand');
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->name."</option>";
												}
										?>
									</select>
									<?php echo form_error('brand') ?>
								</div>
							</div>
							
							<!---->
							<div class="form-group">
								<label for="firstName" class="col-md-4">Unit Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="unit_type" id="unit" class="form-control" style="width:100%;" onchange="get_unit(this.value)">
										<option value=""> Choose Units </option>
										<option value="0.000001"> Milli_Grams </option>
										<option value="0.001"> Grams </option>
										<option value="1"> Kilogram</option>
										<option value="100"> Quintol</option>
										<option value="1000"> Ton</option>
										<option value="10000"> Metric_Ton</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4"> Units Value
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="number" name="unit_value" id="unit_value" min="0" class="form-control"  placeholder="Product Units" onkeyup="get_con_value()" >
								</div>	
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-4">Weight( Kg )
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="text" name="weight"  id="con_value" readonly class="form-control">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly name="con_unit" value="kg" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Grade
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="grade" id="grade" class="form-control" style="width:100% auto;" onchange="get_grade_status()">
										<option value=''>Choose Option</option>
										<option value='A'>Grade A</option>
										<option value='B'>Grade B</option>
										<option value='C'>Grade C</option>
										<option value='D'>Grade D</option>
										<option value='E'>Grade E</option>
										<option value='F'>Grade F</option>
										<option value='G'>Grade G</option>
									</select>
									<p id="product_status"></p>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Length
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="length" id="length" class="form-control" min="0" onkeyup="calc()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Breath
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="breath" id="breath" class="form-control" min="0" onkeyup="calc()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">height
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number"  name="height" id="height" class="form-control" min="0" onkeyup="calc()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Volume
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" readonly name="volume" id="volume" class="form-control" min="0">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm 3" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group">
								<label for="firstName" class="col-md-4">Tags
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="tag" class="form-control"  placeholder="Tags">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Featured
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="featured" class="form-control" style="width:100%;">
										<option value='no'>Choose Option</option>
										<option value='yes'>Yes</option>
										<option value='no'>No</option>
									</select>
								</div>
							</div>
							<div class="form-group <?php if(form_error('userfile')) echo 'has-error'; ?> ">
								<label for="firstName" class="col-md-4">Product Image
									<span class="text-aqua">(Max size 2MB )</span>
								</label>
								<div class="col-md-8">
									<input id="image" type="file" name="userfile" class="form-control" size="20" />
									<?php echo form_error('userfile') ?>
								</div>
							</div> 
							<div class="form-group">
								<label for="firstName" class="col-md-4">Description
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<textarea name="description" class="form-control"  placeholder="Description"></textarea>
								</div>
							</div>
							<div class="box-footer text-right">
								<button type="button" id="prev_product" class="btn btn-primary btn-sm">
									<i class="fa fa-hand-o-left"></i>  Previous 
								</button>
								<button type="button" id="next_customer" class="btn btn-primary btn-sm">
									Next <i class="fa fa-hand-o-right"></i> 
								</button>
							</div>
						</div>
						<div id="customer_choice_option" style="display:none">
							<div class="row text-center">
								<font size="4">Business Details</font><br><br>
							</div><hr>
							<div class="form-group"  style="dispaly:none">
								<label for="firstName" class="col-md-4">Payment Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="pay_type" class="form-control" style="width:100%;">
										<option value=''>Choose Option</option>
										<option value='wallet'>CPA</option>
										<option value='loyality'>LPA</option>
									</select>
								</div>
							</div>
							<div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-4">Stock Creator Role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="from_role[]" class="form-control" style="width:100%;" multiple="">
										<option value=''>Choose Option</option>
										<?php 
											$query = $this->db->order_by('id','asc')->get('role');
											foreach ($query->result() as $c) {
												
											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										?>
									</select>
									<?php echo form_error('role') ?>
								</div>
							</div>
							<div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-4">Purchaser Role 
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="role[]" class="form-control" style="width:100%;" onchange="get_user(this.value)" multiple="">
										<option value=''>Choose Option</option>
										<?php 
											$query = $this->db->order_by('id','asc')->get('role');
											foreach ($query->result() as $c) {
												
											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										?>
									</select>
									<?php echo form_error('role') ?>
								</div>
							</div>
							<div class="form-group" style="display:none">
								<label for="invoiceid" class="col-md-4">To User
									<span class="text-red">*</span>
								</label>							
								<div class="col-md-8">
									 <input type="hidden" name="user" id="to_user" class="form-control" style="width:100%;">      
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">HSN Code
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="hsn_code" class="form-control"  placeholder="HSN Code">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">SAC Code
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="sac_code" class="form-control"  placeholder="SAC Code">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Display Vender Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									 <label class="checkbox-inline"><input type="radio" name="display_name" value="Yes"> Yes</label>
									 <label class="checkbox-inline"><input type="radio" name="display_name" value="No"> No</label>
								</div>
							</div><hr>
							<div class="row text-center">
								<font size="4">Custom Details</font>
							</div><hr>
							
							<div class="form-group">
								<label for="firstName" class="col-md-4">Custom 1
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="c1" class="form-control"  placeholder="Custom 1">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Custom 2
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="c2" class="form-control"  placeholder="Custom 2">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Custom 3
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="c3" class="form-control"  placeholder="Custom 3">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Custom 4
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="c4" class="form-control"  placeholder="Custom 4">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Custom 5
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="c5" class="form-control"  placeholder="Custom 5">
								</div>
							</div>
						
							<div class="box-footer text-right">
								<button type="button" id="prev_business" class="btn btn-primary btn-sm">
									<i class="fa fa-hand-o-left"></i>  Previous 
								</button>
								<button type="button" id="payment_details" class="btn btn-primary btn-sm">
									Next <i class="fa fa-hand-o-right"></i> 
								</button>
							</div>
						</div>
						<div id="payment_option" style="display:none">
							<div class="row text-center">
								<font size="4">Payment Details</font><br><br>
							</div><hr>
							<?php
								$get_tax_slabs = $this->db->order_by('value', 'asc')->get('tax_slabs');
								$option = '<option value="">Choose Option</option>';
								if($get_tax_slabs->num_rows() > 0){
									foreach($get_tax_slabs->result() as $tax_slab){
										$option .= '<option value="'.$tax_slab->value.'">'.$tax_slab->tax_name.'</option>';
									}
								}
							?>
							<div class="form-group">
								<label for="firstName" class="col-md-12 text-center">Purchase Tax</label>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Purchase Price Tax1
								</label>
								<div class="col-md-8">
									<select class="form-control" name="pp_tax1" id="pp_tax1" style="width:100% auto;">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Purchase Price Tax2
								</label>
								<div class="col-md-8">
									<select class="form-control" name="pp_tax2" id="pp_tax2" style="width:100% auto;">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Purchase Price Tax3
								</label>
								<div class="col-md-8">
									<select class="form-control" name="pp_tax3" id="pp_tax3" style="width:100% auto;">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Purchase Price Tax4
								</label>
								<div class="col-md-8">
									<select class="form-control" name="pp_tax4" id="pp_tax4" style="width:100% auto;">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Purchase Price Tax5
								</label>
								<div class="col-md-8">
									<select class="form-control" name="pp_tax5" id="pp_tax5" style="width:100% auto;">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-12 text-center">Sale Tax</label>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-4">Sale Price Tax1
								</label>
								<div class="col-md-8">
									<select class="form-control" name="sp_tax1" id="sp_tax_a" style="width:100% auto;" onchange="get_sp_tax()">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Sale Price Tax2
								</label>
								<div class="col-md-8">
									<select class="form-control" name="sp_tax2" id="sp_tax_b" style="width:100% auto;" onchange="get_sp_tax()">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Sale Price Tax3
								</label>
								<div class="col-md-8">
									<select class="form-control" name="sp_tax3" id="sp_tax_c" style="width:100% auto;" onchange="get_sp_tax()">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Sale Price Tax4
								</label>
								<div class="col-md-8">
									<select class="form-control" name="sp_tax4" id="sp_tax_d" style="width:100% auto;" onchange="get_sp_tax()">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Sale Price Tax5
								</label>
								<div class="col-md-8">
									<select class="form-control" name="sp_tax5" id="sp_tax_e" style="width:100% auto;" onchange="get_sp_tax()">
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Product Tax
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" readonly name="tax" class="form-control" id="total_sp_tax" min="0" placeholder="Product Tax" step="0.01" min="0.00" max="30.00" onkeyup="sts()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="hidden" name="tax_type" value="percent" >
											<input type="text" readonly name="tax_type" value="%" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-4">Shipping Cost
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="shipping_cost" id="s_cost" class="form-control" min="0" placeholder="Shipping Cost">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-4">Tax Paid By 
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="tax_piad" id="tax_piad" class="form-control" style="width:100%;" onchange="get_details(this.value)" >
										<option value=''>Choose Option</option>
										<option value='1'>Company</option>
										<option value='2'>Vendor</option>
									</select>
									<p id="paid_sts" style="color:red"></p>									
								</div>
							</div>
							
							
							
							<div id="div" style="display:none;">
								<div class="form-group ">
									<label for="firstName" class="col-md-4">Purchase Price
										<span class="text-red">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-group">
											<input type="number" name="purchase_price" id="p_price" class="form-control" min="0"   placeholder="Purchase Price" onkeyup="sts()">
											<div class="input-group-addon">&#8377;/</div>
										</div>
									</div>
								</div>
								
								<div class="form-group" >
									<label for="firstName" class="col-md-4">Sale Price
										<span class="text-red">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-group">
											<input type="number" name="sale_price" id="sale_price" class="form-control" min="0"  placeholder="Sale Price" onkeyup="sts()">
											<div class="input-group-addon">&#8377;/</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label for="firstName" class="col-md-4">Product Discount
										<span class="text-red">*</span>
									</label>
									<div class="col-md-8">
										<div class="input-group">
											<input type="number" name="discount" class="form-control" id="discount" min="0" placeholder="Product Discount" onkeyup="sts()">
											<div class="input-group-addon" style="padding:0px;">
												<select name="discount_type" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
													<option value='percent'>%</option>
													<option value='rupee'>&#8377;</option>
												</select>
											</div>
										</div>
										<p id="v_sts" style="color:red"></p>
									</div>
								</div>
							</div>
							<!----Dillip----->
							<div class="box-footer text-right">
								<button type="button" id="prev_payment" class="btn btn-primary btn-sm">
									<i class="fa fa-hand-o-left"></i>  Previous 
								</button>
							</div>
						</div>
					</div>				
				<div class="box-footer text-right">
					<button type="submit" name="submit" value="create_product" id="create_product" class="btn btn-primary" style="display:none;">
						<i class="fa fa-edit"></i> Add Product
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->

		</div> 
			</div>
		</div>
	</div>
</div>


<!----------------------------------------Create stock----------------------------------->
<div class="modal fade" id="create_stock" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:20px; margin-top:50px;">
 
		</div>
	</div>
</div>
<!-------------------------------------------End_create_stock --------------------------->

<!----------------------------------------Destroy Stock---------------------------------->
<div class="modal fade" id="destroy_stock" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:20px; margin-top:50px;">

		</div>
	</div>
</div>
<!-------------------------------------------End Destroy--------------------------->



<!--End Create Category -->
<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#example").DataTable({
		  "paging": true,
		  "ordering": true,
		  "ordering": true,
		  "info": true,
			"ajax": "<?php echo base_url('Smb_product/product_ListJson'); ?>"
		});
	});

</script>

<script>                         
    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Smb_product/product_delete') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>
<script>		
	function excelData() {
		alert("Download...?");
		var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
		location.href = url;
		return false;
	}
	
</script>

<script>
	function get_sub_category(cat_id)
	{
		var mydata = {"cat_id":cat_id};
	   
		$.ajax({
		   type:"POST",
		   url:"<?php echo base_url('Smb_product/getsubcategory') ?>",
		   data:mydata,
		   success:function(response){
			 //alert(response);
			 $("#sub_category").html(response);
		   }
	   }); 
	}
</script>


<script>
	$(document).ready(function(){
		$("#next_business").click(function(){
			var biz_name = $("#business_types").val().trim();
			var category = $("#category").val().trim();
			var sub_category = $("#sub_category").val().trim();
			//alert('k');
			if(biz_name==""){
				$("#biz_sts").html('Please Select a Business/Purchase Type');
			}
			else if(category==""){
				$("#category_sts").html('Please Select a Category');
			}
			else if(sub_category==""){
				$("#sub_category_sts").html('Please Select a Sub Category');
			}
			
			
			else{
				$("#product_details").slideUp(1000);
				$("#business_details").slideDown(1000);
				$("#create_product").fadeOut();
			}
				
		
		});

		
		$("#prev_product").click(function(){
			$("#business_details").slideUp(1000);
			$("#product_details").slideDown(1000);
			$("#create_product").fadeOut();
		});
		$("#next_customer").click(function(){
			$("#business_details").slideUp(1000);
			$("#customer_choice_option").slideDown(1000);
			$("#create_product").fadeOut();
		});
		$("#prev_business").click(function(){
			$("#customer_choice_option").slideUp(1000);
			$("#business_details").slideDown(1000);
			$("#create_product").fadeOut();
		});
		
		$("#payment_details").click(function(){
			$("#customer_choice_option").slideUp(1000);
			$("#payment_option").slideDown(1000);
			$("#create_product").fadeIn();
		});
		
		$("#prev_payment").click(function(){
			$("#payment_option").slideUp(1000);
			$("#customer_choice_option").slideDown(1000);
			$("#create_product").fadeOut();
		});
		
	});
</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<script>
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='30' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
</script>

<script>
function get_user(id)
	{
		var mydata = {"to_role": id};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('smb_product/get_user') ?>",
			data: mydata,
			success: function (response) {
				$("#to_user").html(response);
			}
		});
	}
</script>

<script>
	function get_sub_catg(id){
		
		if(id == ""){
			$("#s_sub_catg_div").fadeOut();
			$("#s_sub_category").val('');
			$("#s_product").val('');
		}
		else{
			var mydata = {"category": id};
				$.ajax({
				type: "POST",
				url: "<?php echo base_url('smb_product/get_sub_category'); ?>",
				data: mydata,
				success: function (response) {
					$("#s_sub_category").html(response);
				}
			});	
			$("#s_sub_catg_div").fadeIn();
		}
		
	}
	
	function get_product(id){
		if(id == ""){
			$("#s_product_div").fadeOut();
			$("#s_product").val('');
		}
		else{
			$("#s_catg_div").removeClass('col-sm-3');
			$("#s_catg_div").addClass('col-sm-2');
			$("#s_sub_catg_div").removeClass('col-sm-3');
			$("#s_sub_catg_div").addClass('col-sm-2');
			$("#s_product_div").removeClass('col-sm-3');
			$("#s_product_div").addClass('col-sm-2');
			
			var mydata = {"sub_catg": id};
				$.ajax({
				type: "POST",
				url: "<?php echo base_url('smb_product/get_products'); ?>",
				data: mydata,
				success: function (response) {
					$("#s_product").html(response);
				}
			});	
			$("#s_product_div").fadeIn();
		}
	}
	
	function search_result()
	{
		$("#tab1").fadeOut('fast');
		$("#tab2").fadeIn();
		
		var biz_type         = $("#biz_type").val();
		var category         = $("#s_category").val();
		var sub_category	 = $("#s_sub_category").val();
		var product			 = $("#s_product").val();
		
		var mydata = {"biz_type" : biz_type, "category" : category, "sub_category" : sub_category, "product" : product};
		
		$(function() {
            $("#example2").DataTable({
				 "paging": true,
				  "ordering": true,
				  "ordering": true,
				   "destroy": true,
				  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('smb_product/product_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });
		
	}
</script>

<script>
	function get_con_value()
	{		
		var unit_value = $("#unit_value").val();
		var unit = $("#unit").val();
		var total_con = unit_value*unit;
		 $("#con_value").val(total_con);
		 
		var grade = $('#grade').val();
		var product = $('#title').val();
		var weight = $('#con_value').val();
		if(grade != "" && product != "" && weight != ""){
			var mydata = {"grade": grade, "product": product, "weight": weight};
				$.ajax({
				type: "POST",
				url: "<?php echo base_url('smb_product/get_grade_status'); ?>",
				data: mydata,
				success: function (response) {
					if(response == "true"){
						$("#product_status").html('');
						$("#next_customer").removeClass('disabled');
					}
					else{
						$("#product_status").html(response);
						$("#next_customer").addClass('disabled');
					}
				}
			});	
		}
		 
	}
</script>

<script>
function get_unit(unit)
	{
		
		var unit_value = $("#unit_value").val();
		var total_con = unit_value*unit;
		 $("#con_value").val(total_con);
		
	}
</script>


<script>
function calc() {
    var textValue1 = document.getElementById('length').value;
    var textValue2 = document.getElementById('breath').value;
    var textValue3 = document.getElementById('height').value;
    document.getElementById('volume').value = textValue1 * textValue2* textValue3 ;
}
</script>  



<script>
function get_details(id)
	{
		//alert(id); 	
		if(id == 1)
		{
			$("#div").slideDown(1000);
			$("#create_product").addClass('disabled');
			
		}
		if(id == 2)
		{
			$("#div").slideUp(1000);
			 $("#sale_price").val("");
			 $("#p_price").val("");
			// $("#total_sp_tax").val("");
			//$("#s_cost").val("");
			 $("#discount").val("");
			 $("#create_product").removeClass('disabled');
		}
		
	}
</script>

<script>
function sts() {
	
		var sale_price   = $("#sale_price").val();	
		var p_price		 = $("#p_price").val();	
		var tax			 = $("#total_sp_tax").val();	
		var s_cost		 = $("#s_cost").val();	
		var discount	 = $("#discount").val();	
		
		
		if(sale_price != "" && p_price != ""  && s_cost !="" && discount != ""){
			
			 $("#create_product").removeClass('disabled');
			 $("#v_sts").html('');
			
		}else{
			$("#create_product").addClass('disabled');
			 $("#v_sts").html('Please Fill All Details');
		}
			
}
</script>  


<script>
	function get_sp_tax()
	{
		var sp_tax1 = $("#sp_tax_a").val();
		var sp_tax2 = $("#sp_tax_b").val();
		var sp_tax3 = $("#sp_tax_c").val();
		var sp_tax4 = $("#sp_tax_d").val();
		var sp_tax5 = $("#sp_tax_e").val();
		
		if(sp_tax1 != ""){
			tax1 = sp_tax1;
		}
		else{
			tax1 = 0;
		}
		
		if(sp_tax2 != ""){
			tax2 = sp_tax2;
		}
		else{
			tax2 = 0;
		}
		
		if(sp_tax3 != ""){
			tax3 = sp_tax3;
		}
		else{
			tax3 = 0;
		}
		
		if(sp_tax4 != ""){
			tax4 = sp_tax4;
		}
		else{
			tax4 = 0;
		}
		
		if(sp_tax5 != ""){
			tax5 = sp_tax5;
		}
		else{
			tax5 = 0;
		}
		
		var total_tax = parseFloat(tax1) + parseFloat(tax2) + parseFloat(tax3) + parseFloat(tax4) + parseFloat(tax5);
		
		$("#total_sp_tax").val(total_tax);
	}
	
	function get_grade_status(){
		var grade = $('#grade').val();
		var product = $('#title').val();
		var weight = $('#con_value').val();
		if(grade != "" && product != "" && weight != ""){
			var mydata = {"grade": grade, "product": product, "weight": weight};
				$.ajax({
				type: "POST",
				url: "<?php echo base_url('smb_product/get_grade_status'); ?>",
				data: mydata,
				success: function (response) {
					if(response == "true"){
						$("#product_status").html('');
						$("#next_customer").removeClass('disabled');
					}
					else{
						$("#product_status").html(response);
						$("#next_customer").addClass('disabled');
					}
				}
			});	
		}
	}
	
	
</script>


<?php } ?>

