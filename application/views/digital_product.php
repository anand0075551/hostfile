
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Product ( Digital )</h3>
                </div><!-- /.box-header -->
				<div class="row">
					<div class="col-lg-10"></div>
					<div class="col-lg-2">
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#create" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create Product</a>
					</div>
				</div>
				<div class="box-body">
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
						    <th  width="38%">Action</th>
							<th>Image</th>
							<th>Title</th>
							<th>Category</th>
							<th>Sub Category</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr> 
							<th  width="38%">Action</th>
							<th>Image</th>
							<th>Title</th>
							<th>Category</th>
							<th>Sub Category</th>
                        </tr>
                        </tfoot>

                    </table>
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
<br>-->
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
										<option value="">Choose Option</option>
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
											$query = $this->db->order_by('category_name','asc')->get_where('smb_category',['digital'=>'ok']);
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
								<font size="4"> Product Details </font><br><br>
							</div><hr>
							<div class="form-group <?php if(form_error('product_title')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-4">Product Title
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="product_title" class="form-control"  placeholder="Product Title">
									<?php echo form_error('product_title') ?>
								</div>
							</div>
							<div class="form-group  <?php if(form_error('brand')) echo 'has-error'; ?>">
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
							<div class="form-group">
								<label for="firstName" class="col-md-4">Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<input type="text" name="unit" class="form-control"  placeholder="unit (e.g. Kg, Pc Etc.)">
								</div>
							</div>
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
							<div class="form-group  <?php if(form_error('userfile')) echo 'has-error'; ?> ">
								<label for="firstName" class="col-md-4">Image
									<span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
								</label>
								<div class="col-md-8">
									<input type="file" name="userfile" class="form-control" size="20" />
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
							<div class="form-group">
								<label for="firstName" class="col-md-4">Payment Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="pay_type" class="form-control" style="width:100%;">
										<option value=''>Choose Option</option>
										<option value='CPA Deduction'>CPA</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Sale Price
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="sale_price" class="form-control"  placeholder="Sale Price">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							<div class="form-group ">
								<label for="firstName" class="col-md-4">Purchase Price
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="purchase_price" class="form-control"  placeholder="Purchase Price">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Shipping Cost
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="shipping_cost" class="form-control"  placeholder="Shipping Cost">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Product Tax
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="tax" class="form-control"  placeholder="Product Tax">
										<div class="input-group-addon" style="padding:0px;">
											<select name="tax_format" style="height:30px">
												<option value='percent'>%</option>
												<option value='rupee'>&#8377;</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-4">Product Discount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<div class="input-group">
										<input type="number" name="discount" class="form-control"  placeholder="Product Discount">
										<div class="input-group-addon" style="padding:0px;">
											<select name="discount_format" style="height:30px">
												<option value='percent'>%</option>
												<option value='rupee'>&#8377;</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-4">To Role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									<select name="role[]" class="form-control" style="width:100%;" onchange="get_user(this.value)" multiple="">
										<option value=''>Choose Option</option>
										<?php 
											$query = $this->db->order_by('roleid','asc')->get('role');
											foreach ($query->result() as $c) {
												
											   echo '<option value="'.$c->roleid.'"> '.$c->roleid.'-'.$c->rolename.'</option>';
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
								<label for="firstName" class="col-md-4">Display Vender Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-8">
									 <label class="checkbox-inline"><input type="radio" name="display_name" value="Yes"> Yes</label>
									 <label class="checkbox-inline"><input type="radio" name="display_name" value="No"> No</label>
								</div>
							</div>
							<div class="box-footer text-right">
								<button type="button" id="prev_business" class="btn btn-primary btn-sm">
									<i class="fa fa-hand-o-left"></i>  Previous 
								</button>
							</div>
						</div>
					</div>				
				<div class="box-footer text-right">
					<button type="submit" name="submit" id="create_product" style="display:none;" value="digital_create_product" class="btn btn-primary">
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
<!--End Create Category -->



<!----------------------------------------Create stock----------------------------------------------->
<div class="modal fade" id="create_stock" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px; margin-top:50px;">
 
		</div>
	</div>
</div>
<!-------------------------------------------End_create_stock --------------------------->

<!----------------------------------------Destroy Stock----------------------------------------------->
<div class="modal fade" id="destroy_stock" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px; margin-top:50px;">

		</div>
	</div>
</div>
<!-------------------------------------------End Destroy--------------------------->



<?php function page_js(){ ?>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,	
                "ajax": "<?php echo base_url('Smb_product/digital_product_ListJson'); ?>"
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
			$("#create_product").fadeIn();
		});
		$("#prev_business").click(function(){
			$("#customer_choice_option").slideUp(1000);
			$("#business_details").slideDown(1000);
			$("#create_product").fadeOut();
		});
	});
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

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
<?php } ?>

