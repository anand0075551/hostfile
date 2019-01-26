
<?php function page_css(){ ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
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
                    <h3 class="box-title"> Add Inventory Stocks</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
					<div class="form-group <?php if (form_error('inward')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Action type(inward Or Outward)
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type"  class="form-control" style="width:100% auto;">
										<option value="<?php echo $inventory_stocks->type;?>">  
										
										<?php
										$get = $this->db->get_where('inventory_inward_outward', ['id'=>$inventory_stocks->type]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->inward_outward;
										
									?>
										
										
										
										</option>
										
										<?php 
										$get_product = $this->db->get_where('inventory_inward_outward');
										foreach($get_product->result() as $p){
											echo "<option value='".$p->id."'>".$p->id.'-'.$p->inward_outward."</option>";
										}
							      ?>
										
										
									</select>	                                
									<?php echo form_error('inward') ?>

								</div>
					</div>
						
						
				
				
						
						<div class="form-group <?php if (form_error('category')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Catagory
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="category"  class="form-control" style="width:100% auto;"onchange="get_user(this.value)">
										<option value="<?php echo $inventory_stocks->category;?>"> 
									<?php
										$get = $this->db->get_where('smb_category', ['id'=>$inventory_stocks->category]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->category_name;
										
									?>
										</option>
										<?php
										if ($category_name->num_rows() > 0) {
											foreach ($category_name->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->category_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('category') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('sub_category')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Sub Catagory
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="sub_category" id="to_user" style="width:100% auto;"class="form-control"onchange="get_item(this.value)">
										<option value="<?php echo $inventory_stocks->sub_category;?>"> 
										
										
										<?php
										$get = $this->db->get_where('smb_sub_category', ['id'=>$inventory_stocks->sub_category]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->sub_category_name;
										
										?>
										
										
										</option>
										
									</select>	                                
									<?php echo form_error('sub_category') ?>

								</div>
							</div>
							
							 <div class="form-group <?php if (form_error('item')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Item Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="item" id="items" style="width:100% auto;" class="form-control">
										<option value="<?php echo $inventory_stocks->product;?>">
										
										<?php
											$get = $this->db->get_where('smb_product', ['id'=>$inventory_stocks->product]);
											foreach($get->result() as $ac);
											echo $ac->id."-".$ac->title;
										
										?>


										</option>
										
									</select>	                                
									<?php echo form_error('item') ?>

								</div>
							</div>
							<!--This Code Is Given By Akhil-->
							
							 <div class="form-group <?php if (form_error('items')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Brand
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="brand" id="brand" style="width:100% auto;" class="form-control">
										<option value="<?php echo $inventory_stocks->brand;?>"> 

													<?php echo $inventory_stocks->brand;?>




										</option>
										<option value="cfirst"> Cfirst </option>
										<option value="cfirst"> smb </option>
										
										
									</select>	                                
									<?php echo form_error('items') ?>

								</div>
							</div>
							
							
							<div class="form-group <?php if (form_error('product_unique_code')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Unique Code
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="product_unique_code" id="product_unique_code" class="form-control" value="<?php echo $inventory_stocks->product_unique_code;?>">                                
									<?php echo form_error('product_unique_code') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('product_manufacturing_date')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Manufacturing Date
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="product_manufacturing_date" id="product_manufacturing_date" class="some_class form-control" value="<?php echo $inventory_stocks->product_manufacturing_date;?>">                                
									<?php echo form_error('product_manufacturing_date') ?>

								</div>
							</div>
							
							
							
							
							<div class="form-group <?php if (form_error('product_expiry_date')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Expiry Date
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="product_expiry_date" id="product_expiry_date" class="some_class form-control" value="<?php echo $inventory_stocks->exp_date;?>">                                
									<?php echo form_error('product_expiry_date') ?>

								</div>
							</div>
							
							
								
							<div class="form-group <?php if (form_error('price_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Price Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="price_per_unit" id="price_per_unit" class="form-control" value="<?php echo $inventory_stocks->price_per_unit;?>">                                
									<?php echo form_error('price_per_unit') ?>

								</div>
							</div>
							
							
							<div class="form-group <?php if (form_error('quantity')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Quantity(Pieces)
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="quantity" id="quantity" class="form-control" value="<?php echo $inventory_stocks->quantity;?>">                                
									<?php echo form_error('quantity') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('weight_per_piece')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">weight Per Piece (Kg)
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="weight_per_piece" id="weight_per_piece" class="form-control" value="<?php echo $inventory_stocks->weight_per_piece;?>">                                
									<?php echo form_error('weight_per_piece') ?>

								</div>
							</div>
							
								<div class="form-group <?php if (form_error('tax1_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Tax 1 Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="tax1_per_unit" id="tax1_per_unit" class="form-control" value="<?php echo $inventory_stocks->tax1_per_unit;?>">                                
									<?php echo form_error('tax1_per_unit') ?>

								</div>
							</div>
							
								<div class="form-group <?php if (form_error('tax2_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Tax 2 Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="tax2_per_unit" id="tax2_per_unit" class="form-control" value="<?php echo $inventory_stocks->tax2_per_unit;?>">                                
									<?php echo form_error('tax2_per_unit') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('tax3_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Tax 3 Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="tax3_per_unit" id="tax3_per_unit" class="form-control" value="<?php echo $inventory_stocks->tax3_per_unit;?>">                                
									<?php echo form_error('tax3_per_unit') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('shipping1_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">shipping1 Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="shipping1_per_unit" id="shipping1_per_unit" class="form-control" value="<?php echo $inventory_stocks->shipping1_per_unit;?>">                                
									<?php echo form_error('shipping1_per_unit') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('shipping2_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">shipping2 Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="shipping2_per_unit" id="shipping2_per_unit" class="form-control" value="<?php echo $inventory_stocks->shipping2_per_unit;?>">                                
									<?php echo form_error('shipping2_per_unit') ?>

								</div>
							</div>
							
							
								<div class="form-group <?php if (form_error('shipping3_per_unit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">shipping2 Per Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="shipping3_per_unit" id="shipping3_per_unit" class="form-control" value="<?php echo $inventory_stocks->shipping3_per_unit;?>">                                
									<?php echo form_error('shipping3_per_unit') ?>

								</div>
							</div>
							
							
								<div class="form-group <?php if (form_error('sub_total_price')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Sub Total Price
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="sub_total_price" id="sub_total_price" value="<?php echo $inventory_stocks->sub_total_price;?>" class="form-control" >                                
									<?php echo form_error('sub_total_price') ?>

								</div>
							</div>
							
								<div class="form-group <?php if (form_error('grand_total')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Grand Total Price
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="grand_total" id="grand_total" value="<?php echo $inventory_stocks->grand_total;?>" class="form-control" >                                
									<?php echo form_error('grand_total') ?>

								</div>
							</div>
							
							
												 <div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="state" id="state" class="form-control" onchange="get_district(this.value)">
                                    <option value=""> Select State </option>
                                      <?php
                                    if($country->num_rows() > 0)
                                    {
                                        foreach($country->result() as $c){
                                            //$selected = ($c->id == 105)? 'selected' : '';
                                            echo '<option value="'.$c->state.'"> '.$c->state.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('state') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('district')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="district" id="district" class="form-control" onchange="get_location_id(this.value)">
                                    <option value=""> Select District </option>
                                    
                                </select>
                                <?php echo form_error('district') ?>
                            </div>
                        </div>


		
						<div class="form-group <?php if(form_error('area_location_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select Location<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="area_location_name" id="location_id" class="form-control" onchange="get_pincode(this.value)">
                                    <option value="<?php echo $inventory_stocks->area_location_name;?>"> 
									
									<?php echo $inventory_stocks->area_location_name;?>
								
									
									
									
									</option>
                                   
                                </select>
                                <?php echo form_error('area_location_name') ?>
                            </div>
                        </div>

		
			
						<div class="form-group <?php if(form_error('location_pincode')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="location_pincode" id="pincode" class="form-control">
                                    <option value="<?php echo $inventory_stocks->pincode;?>"> 
									
									<?php echo $inventory_stocks->pincode;?>
									
									
									</option>
                                    
                                </select>
                                <?php echo form_error('location_pincode') ?>
                            </div>
                        </div>
							
							
							
							<div class="form-group <?php if (form_error('supplier_name')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Supplier Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="supplier_name"  class="form-control" onchange="get_user1(this.value)">
										<option value="<?php echo $inventory_stocks->supplier_name;?>"> 

<?php 
										$get = $this->db->get_where('role', ['id'=>$inventory_stocks->supplier_name]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->rolename;
									?> 


										</option>
										<?php
										if ($rolename->num_rows() > 0) {
											foreach ($rolename->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('supplier_name') ?>

								</div>
							</div>

							
							 <div class="form-group <?php if (form_error('supplier_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Supplier Id
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="supplier_id" id="to_user1" class="form-control">
										<option value="<?php echo $inventory_stocks->supplier_id;?>"> 
										
										
										<?php 
										$get = $this->db->get_where('users', ['id'=>$inventory_stocks->supplier_id]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->first_name.' '.$ac->last_name;
									?> 
										
										
										</option>
										
									</select>	                                
									<?php echo form_error('supplier_id') ?>

								</div>
							</div>

							
								<div class="form-group <?php if (form_error('supplier_invoice_no')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Supplier Invoice No
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="supplier_invoice_no" id="supplier_invoice_no" class="form-control" value="<?php echo $inventory_stocks->supplier_invoice_no;?>">                                
									<?php echo form_error('supplier_invoice_no') ?>

								</div>
							</div>
							
							
							
								<div class="form-group <?php if (form_error('compartment1')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Compartment 1
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="compartment1" id="compartment1" class="form-control" value="<?php echo $inventory_stocks->compartment1;?>">                                
									<?php echo form_error('compartment1') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('compartment2')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Compartment 2
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="compartment2" id="compartment2" class="form-control" value="<?php echo $inventory_stocks->compartment2;?>">                                
									<?php echo form_error('compartment2') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('compartment3')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Compartment 3
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="compartment3" id="compartment3" class="form-control" value="<?php echo $inventory_stocks->compartment3;?>">                                
									<?php echo form_error('compartment3') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('compartment4')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Compartment 4
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="compartment4" id="compartment4" class="form-control" value="<?php echo $inventory_stocks->compartment4;?>">                                
									<?php echo form_error('compartment4') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('compartment5')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Compartment 5
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="compartment5" id="compartment5" class="form-control" value="<?php echo $inventory_stocks->compartment5;?>">                                
									<?php echo form_error('compartment5') ?>

								</div>
							</div>
							
							
							<div class="form-group <?php if (form_error('remarks')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $inventory_stocks->remarks;?>">                                
									<?php echo form_error('remarks') ?>

								</div>
							</div>
							
							
							
							
							
							
							
							</div>
							
							
							
							
							
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
						<button type="submit" name="submit" value="edit_inventory" class="btn btn-primary">
							<i class="fa fa-edit"></i>Update
						</button>
					</div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<!--This Code Is Given By Akhil-->
<!----Datepiker SCRIPT  Files---->
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
</script>
<script>
	function get_product_prepration(id)
{
	//alert(id);
	var mydata = {"id" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_product_prepration') ?>",
		data: mydata,
		success: function (response) {
			$("#to_product_prepration").html(response);
			//alert(response);
		}
	});
}





</script>
	<script>
	function get_item(id)
{
	//alert(id);
	var mydata = {"category" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_item') ?>",
		data: mydata,
		success: function (response) {
			$("#items").html(response);
			//alert(response);
		}
	});
}





</script>

<script>
	function get_user(id)
{
	//alert(id);
	var mydata = {"category" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_user') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user").html(response);
			//alert(response);
		}
	});
}





</script>

<script>
function get_district(id)
{
//   alert(id);
    var mydata = {"state": id};

    $.ajax({
        type: "POST",
        url: "get_district",
        data: mydata,
        success: function (response) {
            $("#district").html(response);
            //alert(response);
        }
    });
}

function get_location_id(id)
{  //   alert(id);
    var mydata = {"district": id};

    $.ajax({
        type: "POST",
        url: "get_location_id",
        data: mydata,
        success: function (response) {
			$("#location_id").html(response);
        }
    });
}

function get_pincode(id)
{
    var mydata = {"location": id};

    $.ajax({
        type: "POST",
        url: "get_pincode",
        data: mydata,
        success: function (response) {
			$("#pincode").html(response);
        }
    });
}


</script>
<script>
	function get_user1(id)
{
	//alert(id);
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Inventory_stocks/get_user1') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user1").html(response);
			//alert(response);
		}
	});
}





</script>

 

<!--This Code Is Given By Akhil-->

	<script src="<?php echo base_url('assets'); ?>/jquery.min.js" type="text/javascript"></script>

 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	