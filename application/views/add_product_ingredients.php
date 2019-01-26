
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
                    <h3 class="box-title">Add Ingredients</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
					
						
							<div class="form-group <?php if (form_error('product_type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="product_type"  class="form-control" style="width:100% auto;" onchange="get_product_prepration_hchef(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($product_name->num_rows() > 0) {
											foreach ($product_name->result() as $c) {

											   echo '<option value="'.$c->product_type.'"> '.$c->id.'-'.$c->product_type.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('product_type') ?>

								</div>
							</div>
							
						<div class="form-group <?php if (form_error('product_preparation')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product Prepration
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="product_preparation" id="to_product_prepration" style="width:100% auto;" class="form-control" >
										<option value=""> Choose option </option>
									
									</select>	                                
									<?php echo form_error('product_preparation') ?>

								</div>
							</div>
							
					   <div class="form-group <?php if(form_error('quantity')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Quantity (kg)
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="quantity" class="form-control" value="<?php echo set_value('quantity'); ?>" placeholder="Enter Quantity.">
									<?php echo form_error('quantity') ?>
								</div>
                        </div>
						
						
						<div class="form-group <?php if (form_error('category')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Category
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="category" id="category"" class="form-control" style="width:100% auto;"onchange="get_user(this.value)">
										<option value=""> Choose option </option>
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
								<label for="firstName" class="col-md-3">Sub Category
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="sub_category" id="to_user" style="width:100% auto;"class="form-control"onchange="get_item(this.value)">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('sub_category') ?>

								</div>
							</div>
							
							 <div class="form-group <?php if (form_error('items')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Item Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="items" id="items" style="width:100% auto;" class="form-control">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('items') ?>

								</div>
							</div>
							<!--This Code Is Given By Akhil-->
							
							<div class="form-group <?php if (form_error('net_weight')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Item Weight(Kg)
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="net_weight" id="net_weight" class="form-control" value="<?php echo set_value('qty'); ?>" placeholder="Enter Item Weight.">                                
									<?php echo form_error('net_weight') ?>

								</div>
							</div>
							<div class="form-group <?php if (form_error('total_declared')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Total Declared Weight(kg)
							
								</label>
								<div class="col-md-9">  								
									<input type="text" name="total_declared" id="total_declared" class="form-control" value="0"readonly placeholder="Enter Total Weight in Kg.">                                
									<?php echo form_error('total_declared') ?>

								</div>
							</div>
							 <!-- Dynamic -->
							<div class="col-md-9" id="itemRows">
<input onClick="addsponsorRow(this.form);" type="button" id="reset"value="Add" class="btn btn-warning"/>(This row will not be saved unless you click on "Add" first)
                               
                            </div>
								<!-- Dynamic -->
							
							
							
							
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
						<button type="submit" name="submit" value="add_product" class="btn btn-primary">
							<i class="fa fa-edit"></i>Submit
						</button>
					</div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<!--This Code Is Given By Akhil-->
<script>
$("#reset").on("click", function () {
    $('#my_select option').prop('selected', function() {
        return this.defaultSelected;
    });
});


</script>
<script>
	function get_product_prepration_hchef(id)
{
	//alert(id);
	var mydata = {"id" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_product_prepration_hchef') ?>",
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
 
		 <script type="text/javascript">
    var rowNum = 0;
    function addsponsorRow(frm) {
        rowNum ++;
        var row = '<p id="rowNum'+rowNum+'">Category '+rowNum+': <input type="text" name="categ[]" value="'+frm.category.value+'"> Sub Category: <input type="text" name="sub_categ[]" size="4" value="'+frm.sub_category.value+'">Item: <input type="text" name="citem[]" size="4" value="'+frm.items.value+'">Weight Kg: <input type="text" name="weight[]" size="4" id="row'+rowNum+'" value="'+frm.net_weight.value+'"> <input type="button" value="Remove" class="btn btn-inform" onclick="removeRow('+rowNum+');"></p>';
        jQuery('#itemRows').append(row);
		if(frm.category.value == 26)
		{
			frm.total_declared.value =  parseFloat(frm.total_declared.value,10) -  parseFloat(frm.net_weight.value,10);
		}
		else
		{
		frm.total_declared.value = parseFloat(frm.net_weight.value,10) + parseFloat(frm.total_declared.value,10);
		
		document.getElementById('net_weight').value = 0;
		
		var mydata = {"category" : 1};
		$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_all_catg') ?>",
		data: mydata,
		success: function (response) {
			//$("#category").html(response);
			//alert(response);
			document.getElementById('category').innerHTML = response;
		}
		//document.getElementById('sub_category').innerHTML = '<option value="">Choose Option</option>';
	});
		
		}
        frm.category.value = '';
        frm.sub_category.value = '';
		 frm.items.value = '';
		 frm.qty.value = '';
		 

		 
    }

    function removeRow(rnum) {
      
		var w = $('#row'+rnum).val();
		//alert(w);
		var td = $('#total_declared').val();
		var z = parseFloat(td,10) -  parseFloat(w,10)
		
		$('#total_declared').val(z);
		
		  jQuery('#rowNum'+rnum).remove();
    }
	
    </script>
<!--This Code Is Given By Akhil-->
<script>
	function total_kg(wastage)
	{
		var item_weight = document.getElementById('item_weight').value;
		var total =  parseFloat(item_weight,10) - parseFloat(wastage,10);
		document.getElementById('net_weight').value = total;
		
	}
	</script> 
	<script src="<?php echo base_url('assets'); ?>/jquery.min.js" type="text/javascript"></script>

 
	