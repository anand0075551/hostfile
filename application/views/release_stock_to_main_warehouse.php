
<?php function page_css(){ ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
	


<?php 
	foreach($inventory_stocks->result() as $inventory_stocks);
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"> Release Stocks</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
					 <div class="box-footer" id="complete_order_div">
						<button type="submit" name="submit"  id="submit" value="rel_stock" onclick="clicked();" class="btn btn-info">
							<i class="fa fa-arrows"></i> Release Stock
						</button>
					</div>
					
					</div>
					
					<div class="row text-center" id="warn_msg" style="font-size:18px; display:none;">
						<label>
							<font color="green">Thank You For submit</font>
							<br>
							
						</label>
					</div>
					
                      <div class="row" style="padding:10px;">   
		                  <div  <?php if (form_error('type')) echo 'has-error'; ?>>
								
 								<div class="col-md-4" style="display:none">  
                               						
                                  <p><label for="firstName" >Type <span class="text-red">*</span>		</label></p>
									<input type="text" name="type"  id="type" class="form-control" value="2">
									
								</div>
							</div>
							
		  <div  <?php if (form_error('type')) echo 'has-error'; ?>>
								
 								<div class="col-md-4">  
                               						
                                  <p><label for="firstName" >Type <span class="text-red">*</span>		</label></p>
									<input type="text" name="2"  id="2" class="form-control" value="Outward" readonly>
									
								</div>
							</div>
                        <input type ="hidden" name="store_id" value="<?php echo $inventory_stocks->store_id; ?>" >
					<div  <?php if (form_error('store_id')) echo 'has-error'; ?>>
								
								
								
								
							<?php
										$store_id= $this->db->get_where('inventory_store_id',['id'=>$inventory_stocks->store_id]);
										foreach($store_id->result() as $t)
										{
											 
										}
										?>
										
								<div class="col-md-4">  								
                                       <p><label>Store ID <span class="text-red">*</span></label></p>
									<input type ="text" name="dd"  class="form-control" 
										 value="<?php echo $t->store_name.' '.$t->area ?>" readonly> 
										
								

								</div>
							</div>
						
						
					<div class="col-md-4">  
                               <p><label>Remarks</label></p> 								
									<textarea name="remarks" id="remarks"  class="form-control" placeholder="<?php echo $inventory_stocks->remarks; ?>" readonly ></textarea>                         
									<?php echo form_error('remarks') ?>

								</div>
				
						</div><!-- Sec 1 !-->
						
						<div class="row" style="padding:10px;" >   
						<div <?php if (form_error('category')) echo 'has-error'; ?>>
								
									<?php
										$get = $this->db->get_where('smb_category', ['id'=>$inventory_stocks->category]);
										foreach($get->result() as $ac);
										$ac->category_name;
										
									?>
								<div class="col-md-4">  								
                 <p><label> Category</label></p>
									<input type ="text" name="fgvb"  class="form-control" value="<?php echo $ac->category_name;?>" readonly>
										
								
							                                
									<?php echo form_error('category') ?>

								</div>
							</div>
							
								<?php
										$get = $this->db->get_where('smb_sub_category', ['id'=>$inventory_stocks->sub_category]);
										foreach($get->result() as $ac);
										$ac->sub_category_name;
										
										?>
							<div  <?php if (form_error('sub_category')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  								
                           <p><label>Sub Category</label></p>
									<input type="text" name="sda" id="to_user"  value="<?php echo $ac->sub_category_name;?>" class="form-control" readonly>
										
										
										
										
									
										
										
									
								

								</div>
							</div>
								<?php
											$get = $this->db->get_where('smb_product', ['id'=>$inventory_stocks->product]);
											foreach($get->result() as $ac);
											$ac->title;
										
										?>
							 <div <?php if (form_error('aa')) echo 'has-error'; ?> >
								
								<div class="col-md-4">  								
                       <p><label>Item Name</label></p>
									<input type="text" name="dfdfe" id="items" value="<?php echo $ac->title;?>" class="form-control" readonly>
									<?php echo form_error('aa') ?>

								</div>
							</div>
							</div><!-- Sec 1 !-->
							
							
							
							
							<div class="row" style="padding:10px;">   
							<!--This Code Is Given By Akhil-->
							
							
								<div <?php if (form_error('quantity')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                 <p><label>Quantity(Pieces)</label></p> 	 								
									<input type="text" name="quantity" onkeyup="get_total()" id="quantity" class="form-control" value="<?php echo $inventory_stocks->quantity; ?>"   readonly>                                
									<?php echo form_error('quantity') ?>

								</div>
							</div>
							 
							
							
							<div  <?php if (form_error('product_unique_code')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                                     <p><label> Batch No</label></p> 								
									<input type="text" name="product_unique_code" id="product_unique_code" class="form-control" value="<?php echo $inventory_stocks->product_unique_code; ?>"readonly>                                
									<?php echo form_error('product_unique_code') ?>

								</div>
							</div>
							<!-----==========================-->
							<?php
							
							$get_prod_id = $this->db->get_where('product_packing',['unique_small'=>$inventory_stocks->product_unique_code]);
							foreach($get_prod_id->result () as $pro_name);
							$pro_name->product;
							
							?>
							<!-----==========================-->
							
							<input type="hidden" name="product_id" value="<?php echo $pro_name->product; ?>">
							
							
							
							<div  <?php if (form_error('product_manufacturing_date')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
								 <p><label>Product Manufacturing Date</label></p> 	
									<input type="text" name="product_manufacturing_date" id="product_manufacturing_date" value="<?php echo $inventory_stocks->product_manufacturing_date; ?>" class="form-control"placeholder="Choose Date."readonly>                                
									<?php echo form_error('product_manufacturing_date') ?>

								</div>
							</div>
							
							</div><!-- Sec 1 !-->
							
							 <div class="row" style="padding:10px;"> 					
					
								<div  <?php if (form_error('weight_per_piece')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                        <p><label>weight (Kg)</label></p> 									
									<input type="text" name="weight_per_piece" onkeyup="get_total()" id="weight_per_piece" class="form-control" value="<?php echo $inventory_stocks->weight_per_piece; ?>" readonly>                                
									<?php echo form_error('weight_per_piece') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('sub_total_price')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                   <p><label>Sub Total Price</label></p> 								
									<input type="text" name="sub_total_price" id="sub_total_price" class="form-control" value="<?php echo $inventory_stocks->sub_total_price; ?>"readonly >                                
									<?php echo form_error('sub_total_price') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('grand_total')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                           <p><label>Grand Total Price</label></p> 								
									<input type="text" name="grand_total" id="grand_total" class="form-control" value="<?php echo $inventory_stocks->grand_total; ?>"  readonly>                                
									<?php echo form_error('grand_total') ?>

								</div>
							</div>
							
					</div><!-- Sec 1 !-->	
							
							<div class="row" style="padding:10px;"> 
							
								
							<div  <?php if (form_error('items')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  								
                      <p><label>Brand</label></p>
									<input type="text" name="brand" id="brand"  class="form-control" value="<?php echo $inventory_stocks->brand; ?>"readonly>
									

								</div>
							</div>
							
							
							
								
							<div <?php if (form_error('price_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                                    <p><label>Price Per Unit</label></p> 								
									<input type="text" name="price_per_unit" id="price_per_unit"  value="<?php echo $inventory_stocks->price_per_unit;?>"  class="form-control" readonly>                                
									<?php echo form_error('price_per_unit') ?>

								</div>
							</div>
							
							
					<div  <?php if (form_error('product_expiry_date')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                                        <p><label>Product Expiry Date</label></p> 									
									<input type="text" name="product_expiry_date" id="product_expiry_date" class="form-control" value="<?php echo $inventory_stocks->exp_date; ?>"readonly>                                
									<?php echo form_error('product_expiry_date') ?>

								</div>
							</div>
							
							
							</div><!-- Sec 1 !-->
							
							
					<div class="row" style="padding:10px;"> 
					
							<input type="hidden" name="inward1" id="inward1" value="0">
							<input type="hidden" name="outward1" id="outward1" value="<?php echo $inventory_stocks->quantity; ?>">
							
								<div  <?php if (form_error('tax1_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                           <p><label>Tax 1 Per Unit</label></p> 									
									<input type="text" name="tax1_per_unit" onkeyup="get_total()" id="tax1_per_unit" class="form-control"  value="<?php echo $inventory_stocks->tax1_per_unit; ?>"readonly>                                
									<?php echo form_error('tax1_per_unit') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('tax2_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                                  <p><label>Tax 2 Per Unit</label></p> 								
									<input type="text" name="tax2_per_unit" onkeyup="get_total()" id="tax2_per_unit" class="form-control" value="<?php echo $inventory_stocks->tax2_per_unit; ?>"readonly >                                
									<?php echo form_error('tax2_per_unit') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('tax3_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                             <p><label>Tax 3 Per Unit</label></p> 								
									<input type="text" name="tax3_per_unit"  id="tax3_per_unit" class="form-control" value="<?php echo $inventory_stocks->tax3_per_unit; ?>"readonly>                                
									<?php echo form_error('tax3_per_unit') ?>

								</div>
							</div>
							
					</div><!-- Sec 1 !-->
							
							
					<div class="row" style="padding:10px;"> 
								
						
							
							<div  <?php if (form_error('shipping1_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  

                                    <p><label>shipping1 Per Unit</label></p> 								
									<input type="text" name="shipping1_per_unit"  id="shipping1_per_unit" class="form-control" value="<?php echo $inventory_stocks->shipping1_per_unit; ?>"readonly>                                
									<?php echo form_error('shipping1_per_unit') ?>

								</div>
							</div>
							
							
							   <?php 
										$get = $this->db->get_where('role', ['id'=>$inventory_stocks->supplier_name]);
										foreach($get->result() as $ac);
										$ac->rolename;
									?> 
							<div <?php if (form_error('supplier_name')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  
                            <p><label>Supplier Name</label></p> 									

									<input type="text" name="cbhrf"  class="form-control" value="<?php echo $ac->rolename;?>" readonly>
						
								</div>
							</div>

							
							<?php 
										$get = $this->db->get_where('users', ['id'=>$inventory_stocks->supplier_id]);
										foreach($get->result() as $ac);
									$ac->first_name.' '.$ac->last_name;
									?> 
							
							
							
							 <div  <?php if (form_error('supplier_id')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  	
                                 <p><label>Supplier Id</label></p> 									

									<input type="text" name="ddf"  id="to_user1" class="form-control" value="<?php echo $ac->first_name.' '.$ac->last_name;?>" readonly>
										
								</div>
							</div>
							
							
							
							
							
							
							
							
						</div><!-- Sec 1 !-->	
					
                    
					
					
			 
			 
			 	
					 
					  <div class="row" style="padding:10px;"> 	
					  
								<div  <?php if (form_error('supplier_invoice_no')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  
                            <p><label>Supplier Invoice No</label></p> 											
									<input type="text" name="supplier_invoice_no" id="supplier_invoice_no" class="form-control" value="<?php echo $inventory_stocks->supplier_invoice_no; ?>"readonly>                                
									<?php echo form_error('supplier_invoice_no') ?>

								</div>
							</div>
							
							
							
								<div  <?php if (form_error('compartment1')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  	
                           <p><label>Compartment 1</label></p> 									
									<input type="text" name="compartment1" id="compartment1" class="form-control" value="<?php echo $inventory_stocks->compartment1; ?>"readonly>                                
									<?php echo form_error('compartment1') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('compartment2')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
								        <p><label>Compartment 2</label></p> 	
 								
									<input type="text" name="compartment2" id="compartment2" class="form-control" value="<?php echo $inventory_stocks->compartment2; ?>"readonly>                                
									<?php echo form_error('compartment2') ?>

								</div>
							</div>
					</div><!-- Sec 1 !-->	
					
                <div class="row" style="padding:10px;"> 						
							<div  <?php if (form_error('compartment3')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                  <p><label>Compartment 3</label></p> 	 								
									<input type="text" name="compartment3" id="compartment3" class="form-control" value="<?php echo $inventory_stocks->compartment3; ?>"readonly>                                
									<?php echo form_error('compartment3') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('compartment4')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  
                                     <p><label>Compartment 4</label></p> 	 									
									<input type="text" name="compartment4" id="compartment4" class="form-control" value="<?php echo $inventory_stocks->compartment4; ?>"readonly>                                
									<?php echo form_error('compartment4') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('compartment5')) echo 'has-error'; ?>>
								
								<div class="col-md-4" style="display:none">  
                                    <p><label>Compartmsent 5</label></p> 
									
									<input type="text" name="compartment5" id="compartment5" class="form-control" value="<?php echo $inventory_stocks->compartment5; ?>" readonly>                                
									

								</div>
							</div>
							
								<div  <?php if (form_error('remarks')) echo 'has-error'; ?>>
								
								
							</div>
				</div><!-- Sec 1 !-->				
							
						 <div class="row" style="padding:10px;"style="display:none"> 	
						<div  <?php if(form_error('state')) echo 'has-error'; ?>>
						
                           
                            <div class="col-md-4" style="display:none">
							          <p><label>State</label></p> 	
                                <select name="state" id="state" style="width:100% auto;" class="form-control" onchange="get_district(this.value)">
                                    <option value="0"> Select State </option>
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
						
						<div <?php if(form_error('district')) echo 'has-error'; ?>>
                           
                            <div class="col-md-4"style="display:none">
							
							<p><label>District</label></p> 	
                                <select name="district" id="district" style="width:100% auto;" class="form-control" onchange="get_location_id(this.value)">
                                    <option value="0"> Select District </option>
                                    
                                </select>
                                <?php echo form_error('district') ?>
                            </div>
                        </div>


		
						<div  <?php if(form_error('area_location_name')) echo 'has-error'; ?>>
                            
                            <div class="col-md-4"style="display:none">
							<p><label>Select Location</label></p> 	
                                <select name="area_location_name" style="width:100% auto;" id="location_id" class="form-control" onchange="get_pincode(this.value)">
                                    <option value="0"> Select location </option>
                                   
                                </select>
                                <?php echo form_error('area_location_name') ?>
                            </div>
                        </div>

		
			 </div><!-- Sec 1 !-->
							
						 <div class="row" style="padding:10px;"style="display:none"> 	
						<div  <?php if(form_error('location_pincode')) echo 'has-error'; ?>>
                          
                            <div class="col-md-4"style="display:none">
							<p><label>Pincode</label></p> 	
                                <select name="location_pincode" style="width:100% auto;" id="pincode" class="form-control">
                                    <option value="0"> Select Pincode </option>
                                    
                                </select>
                                <?php echo form_error('location_pincode') ?>
                            </div>
                        </div>
							
							
							
							<div  <?php if (form_error('shipping2_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4"style="display:none">  
                               <p><label>shipping2 Per Unit</label></p> 									
									<input type="text" name="shipping2_per_unit" value="0" onkeyup="get_total()" id="shipping2_per_unit" class="form-control" placeholder="Enter shipping cost Per Unit">                                
									<?php echo form_error('shipping2_per_unit') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('shipping3_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4"style="display:none">  
                     <p><label>shipping3 Per Unit</label></p> 									
									<input type="text" name="shipping3_per_unit" value="0" onkeyup="get_total()" id="shipping3_per_unit" class="form-control" placeholder="Enter shipping cost Per Unit">                                
									<?php echo form_error('shipping3_per_unit') ?>

								</div>
							</div>

					 </div><!-- Sec 1 !-->		
							
							 
							
							<input type="hidden" name="assigned_by"  value ="0" id="assigned_by">
							<input type="hidden" name="assigned_to"  value="0" id="assigned_to">
							<input type="hidden" name="supplier_id" value="<?php echo $inventory_stocks->supplier_id;  ?>">
							<input type ="hidden" name="supplier_name" value="<?php echo $inventory_stocks->supplier_name; ?>">
							
							<input type="hidden" name="item"  value="<?php echo $inventory_stocks->product; ?>">
							<input type="hidden" name="sub_category"  value="<?php echo $inventory_stocks->sub_category; ?>">
							<input type="hidden" name="category"  value="<?php echo $inventory_stocks->category; ?>">
							</div>
							
							
							
							
							
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                   
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
       
			url: "<?php echo base_url('Inventory_stocks/get_district') ?>",
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
      
		url: "<?php echo base_url('Inventory_stocks/get_location_id') ?>",
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
       
		url: "<?php echo base_url('Inventory_stocks/get_pincode') ?>",
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

<script>
	function get_dis_reassign(id)
{
	//alert(id);
	
	var mydata = {"unique_preparation" : id};


	 $.ajax({
                type: "POST",
				url: "<?php echo base_url('product_preparation/get_dis_reassign') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
						alert('Batch Already Assigned . Thank You');
                        document.getElementById("submit").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("submit").disabled = false;
                    }

                }
            });
	
	
}





</script>

<script>
	function get_mfr_date(id)
{
	//alert(id);
	var mydata = {"unique_batch": id};

	

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_mfr_date') ?>",
		data: mydata,
		success: function (response) {
			$("#product_manufacturing_date").val(response);
			//alert(response);
		}
	});
	
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_quantity') ?>",
		data: mydata,
		success: function (response) {
			$("#quantity").val(response);
			//alert(response);
		}
	});
	
	
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_weight_per_piece') ?>",
		data: mydata,
		success: function (response) {
			$("#weight_per_piece").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_unique_code') ?>",
		data: mydata,
		success: function (response) {
			$("#product_unique_code").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_assigned_by') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_by").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_assigned_to') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_to").val(response);
			//alert(response);
		}
	});
	
	
		$.ajax({
                type: "POST",
				url: "<?php echo base_url('product_preparation/get_dis_reassign') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
						alert('Product Already In Stock . Thank You');
                        document.getElementById("submit").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("submit").disabled = false;
                    }

                }
            });
	
	
	
	
	
}





</script>
	<script>
	function get_total(){
		
		
	
		var quantity = $("#quantity").val();
		var tax1_per_unit = $("#tax1_per_unit").val();
		var tax2_per_unit = $("#tax2_per_unit").val();
		var tax3_per_unit = $("#tax3_per_unit").val();
		
		var type = $("#type").val();
		
		
		
		var shipping1_per_unit = $("#shipping1_per_unit").val();
		var shipping2_per_unit = $("#shipping2_per_unit").val();
		var shipping3_per_unit = $("#shipping3_per_unit").val();

		
		var action = $("#action").val();
	
		
		var weight_per_piece = $("#weight_per_piece").val() ;
		
		var price_per_unit = $("#price_per_unit").val() * $("#quantity").val();
		
		var inward1 = $("#inward1").val();
		
		var outward1 = $("#outward1").val();
		
		
		 
	var type1 = parseFloat(type,10);
	 var Remaining_total = parseFloat(weight_per_piece,10);
	 
	 
	 var sub_total = parseFloat(price_per_unit,10);
	 
	 var grand_total1 = parseFloat(price_per_unit,10)+parseFloat(tax1_per_unit,10)+parseFloat(tax2_per_unit,10)+parseFloat(tax3_per_unit,10)+parseFloat(shipping1_per_unit,10)+parseFloat(shipping2_per_unit,10)+parseFloat(shipping3_per_unit,10);
	 
	  $("#sub_total_price").val(sub_total);
		 $("#grand_total").val(grand_total1);
	 
	 if(type1 == 1)
	 { 
		 $("#inward1").val(Remaining_total);
		 $("#outward1").val();
	 }else
	 {
		 $("#inward1").val();
		 $("#outward1").val(Remaining_total);
	 }
	 return true;
		 
		
		 
		 
		 
		 

		
		
	}
</script>

 <script type="text/javascript">
function clicked() {
	$("#complete_order_div").hide('slow');
	$("#warn_msg").fadeIn('slow');
	//alert('Please do not Reload the page or Click the Button again to Avoid Double Payment. Thank You!');
}
</script>

<!--This Code Is Given By Akhil-->

	<script src="<?php echo base_url('assets'); ?>/jquery.min.js" type="text/javascript"></script>

 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	