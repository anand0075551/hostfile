
<?php

function page_css() { ?>
   <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	

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
                    <h3 class="box-title">Product Packing</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body table-responsive">
				
				 <table class="table table-striped ">
				 
				 <tr>
				 
				
				 
				 
				 

				 <input type="hidden" name="status" value="packed">
			<!--	 <div class="form-group <?php if (form_error('product_preparation')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Assistant
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							<!--===================--
							onchange="get_total_output(this.value)"
							<!--===================						
							<select class="form-control" name="prepaired_by" id="prepaired_by" onchange="get_product(this.value)" style=" width:100% auto; ">
							<option value="">Choose Assistant</option>
							<?php /*
								$get_product1 = $this->db->group_by('created_by')->get_where('product_ingredients_used');
								foreach($get_product1->result() as $p){
									$user_name = $p->created_by;
								$get_declared_name = $this->db->get_where('users', ['id'=>$user_name]);
									foreach($get_declared_name->result() as $p);
									$declared_name = $p->first_name.' '.$p->last_name;
									
									echo "<option value='".$p->id."'>".$declared_name."</option>";
								}*/
							?>
						</select>   
									<?php echo form_error('product_preparation') ?>

								</div>
							</div>
							
				 
				 
				 
				 
				 
				 </tr>
				 
				 <!--=================================-->
				  <tr>
				 
				 	<div class="form-group <?php if (form_error('prepaired_by')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Product For Packing
								<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							
									<select name="product_prep" id="product_prep" style="width:100% auto;" onchange="get_unique(this.value)" class="form-control">
										<option value=""> Choose Product </option>
										<?php 
										
										$user_info = $this->session->userdata('logged_user');
                                        $user_id = $user_info['user_id'];
										
								$get_product1 = $this->db->group_by('product_id')->get_where('product_assign_packing',['assigned_to_name' => $user_id]);
								foreach($get_product1->result() as $p){
									$user_name = $p->product_id;
									$unique_prep = $p->unique_prep;
								$get_declared_name = $this->db->get_where('product_preparation', ['id'=>$user_name]);
									foreach($get_declared_name->result() as $p);
									$declared_name = $p->product_name;
									
									echo "<option value='".$user_name."'>".$declared_name."</option>";
								}
							?>
									</select>

									<!--	<select name="product_prep" id="product_prep" style="width:100% auto;" onchange="get_total_output(this.value)" class="form-control">
										<option value=""> Choose option </option>
										
									</select>	  -->                               
									<?php echo form_error('prepaired_by') ?>

								</div>
							</div>
							
				 
				 <input type="hidden" name="product_name" id="prod_name">
				 
				 
				 
				 </tr>
				 
				 
				 
				 	 	<div class="form-group <?php if (form_error('product_preparation')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Prepaired By
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							<!--===================--
							onchange="get_total_output(this.value)"
							<!--===================-->							
							<select class="form-control" name="Unique" id="Unique" onchange="get_total_output(this.value)" style=" width:100% auto; ">
							<option value="">Choose Prepaired By</option>
							
						</select>   
									<?php echo form_error('product_preparation') ?>

								</div>
							</div>
				 
				
				 
				 <!--This Code Is Given By Akhil-->
				 
				<input type="hidden" name="prep_by" id="prep_by">
						<tr>					
						<td><h4><b>Prepaired  Weight (Kg)<b></h4></td>
						<td><input type="text" name="total_weight" id="total_weight" onkeyup="get_total()" class="form-control"  placeholder="Total Weight in Kg"readonly ></td>
						
						<td></td>
						<td><input type="text" name="status_box" id="status_box" class="form-control"   readonly></td>
						<td><h4><b>Packed Weight:</b></h4></td>
						<td><input type="text" name="packed_weight" id="packed_weight" class="form-control"   readonly></td>
						</tr>
						
						<td><h4><b>Weight still To Be Packed:</b></h4></td>
						<td><input type="text" name="to_pack" id="to_pack" class="form-control"   readonly></td>
						<!--<td><input type="text" name="balance_weight" id="balance_weight" value="<?php/* echo $balance*/?>" class="form-control"   readonly></td>-->
					
						</tr>
					
			<!--		<?php/* if (!empty ($pack_now) && $pack_now->num_rows() > 0)
					{
						
						
						echo 'hi';
						
						
						
					}	else{
						
						echo 'bye';
					}					
					*/
					?> -->

                   				
						
						
						<tr>					
							<th><b><h4>Package No</b></h4></th>
							<th><b><h4>Package Name</b></h4></th>
							<th><b><h4>Quantity (Kg)</b></h4></th>
							<th><b><h4>No of Pieces</b></h4></th>		
							<th><b><h4>Weight(Kg)</b></h4></th>		
							<th><b><h4>Wastage (Kg)</b></h4></th>
						</tr>
						
						<tr>
							<td>1</td>
							<td><input type="text" name="package_name_small" value="small" class="form-control" readonly></td>
							<td><input type="text" name="pre_def_small" id="pre_def_small" onkeyup="get_total()" class="form-control" value="0.3"readonly></td>
							<td><input type="text" name="pieces_small" id="pieces_small" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>" placeholder="Enter No. Of Pieces"></td>
							<td><input type="text" name="weight_small" id="weight_small" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td>
							<td><input type="text" name="wastage_small" id="wastage_small" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly ></td>
					
						</tr>
						
						
						<tr>
							<td>2</td>
							<td><input type="text" name="package_name_medium" value="medium" class="form-control" readonly></td>
							<td><input type="text" name="pre_def_medium" id="pre_def_medium" onkeyup="get_total()" class="form-control" value="0.4"readonly></td>
							<td><input type="text" name="pieces_medium"  id="pieces_medium" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>" placeholder="Enter No. Of Pieces"></td>
							<td><input type="text" name="weight_medium" id="weight_medium" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td>
							<td><input type="text" name="wastage_medium"  id="wastage_medium"class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td>
						</tr>
						
						
						<tr>
							<td>3</td>
							<td><input type="text" name="package_name_large" value="large" class="form-control" readonly></td>
							<td><input type="text" name="pre_def_large" id="pre_def_large" onkeyup="get_total()" class="form-control" value="0.5"readonly></td>
							<td><input type="text" name="pieces_large" id="pieces_large"  onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>" placeholder="Enter No. Of Pieces"></td>
							<td><input type="text" name="weight_large" id="weight_large" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td>
							<td><input type="text" name="wastage_large" id="wastage_large" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td> 
					
						</tr>
						
						<tr>
							<td>4</td>
							<td><input type="text" name="package_name_family" value="family" class="form-control" readonly></td>
							<td><input type="text" name="pre_def_family" id="pre_def_family" onkeyup="get_total()" class="form-control" value="0.8"readonly></td>
							<td><input type="text" name="pieces_family" id="pieces_family" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>" placeholder="Enter No. Of Pieces"></td>
							<td><input type="text" name="weight_family" id="weight_family" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td>
							<td><input type="text" name="wastage_family" id="wastage_family" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td> 
					
						</tr>
						
						<tr>
							<td>5</td>
							<td><input type="text" name="package_name_combo" value="combo" class="form-control" readonly></td>
							<td><input type="text" name="pre_def_combo" id="pre_def_combo" onkeyup="get_total()" class="form-control" value="0.9"readonly></td>
							<td><input type="text" name="pieces_combo" id="pieces_combo" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>" placeholder="Enter No. Of Pieces"></td>
							<td><input type="text" name="weight_combo" id="weight_combo" onkeyup="get_total()" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td>
						<td><input type="text" name="wastage_combo" id="wastage_combo" class="form-control" value="<?php echo set_value('product_name'); ?>"readonly></td> 
					
						</tr>
						<tr>
						<td><h4><b>Remaining Weight (Kg)</b></h4></td>
						<td><input type="text" name="balance_weight" id="Remaining_weight"  class="form-control" value="0"  readonly></td>
						
						</tr>
						
			
            </form>
			 </table>
        </div><!-- /.box -->

			 <div class="box-footer">
                <button type="submit" name="submit" id="submit" value="add_packing" class="btn btn-primary">
                    <i class="fa fa-th"></i> Save Packed
                </button>
            </div>

    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>
  

   
   

    <!-- Page script -->
	
    <!--This Code Is Given By Akhil-->
    

	 <script type="text/javascript">
    var rowNum = 0;
    function addsponsorRow(frm) {
        rowNum ++;
        var row = '<p id="rowNum'+rowNum+'">Category '+rowNum+': <input type="text" name="categ[]" value="'+frm.category.value+'"> Sub Category: <input type="text" name="sub_categ[]" size="4" value="'+frm.sub_category.value+'">Item: <input type="text" name="citem[]" size="4" value="'+frm.items.value+'">Weight Kg: <input type="text" name="weight[]" size="4" value="'+frm.qty.value+'"> <input type="button" value="Remove" class="btn btn-inform" onclick="removeRow('+rowNum+');"></p>';
        jQuery('#itemRows').append(row);
		frm.total_weight.value =  parseInt(frm.total_weight.value,10);
        frm.category.value = '';
        frm.sub_category.value = '';
		 frm.items.value = '';
		 frm.qty.value = '';
		 
    }

    function removeRow(rnum) {
        jQuery('#rowNum'+rnum).remove();
    }
    </script>
	
	
	<script>
	/*
	document.getElementById("Remaining_weight").style.color ="red"; */
	</script>
	

	
	<script>
	function get_total(){
		var p_small = $("#pieces_small").val();
		$("#wastage_small").val(p_small)
		
		var p_medium = $("#pieces_medium").val();
		$("#wastage_medium").val(p_medium)
		
		var p_large = $("#pieces_large").val();
		$("#wastage_large").val(p_large)
		
		var p_family = $("#pieces_family").val();
		$("#wastage_family").val(p_family)
		
		var p_combo = $("#pieces_combo").val();
		$("#wastage_combo").val(p_combo)
		
		
	
		var weight_small = $("#weight_small").val();
		var pre_def_small = $("#pre_def_small").val();
		
		var weight_medium = $("#weight_medium").val();
		var pre_def_medium = $("#pre_def_medium").val();
		
		
		
		var weight_large = $("#weight_large").val();
		var pre_def_large = $("#pre_def_large").val();
		
		
		var weight_family = $("#weight_family").val();
		var pre_def_family = $("#pre_def_family").val();
		
		var weight_combo = $("#weight_combo").val();
		var pre_def_combo = $("#pre_def_combo").val();
		
		
		var pieces_small = $("#pieces_small").val() * $("#pre_def_small").val();
		var pieces_medium = $("#pieces_medium").val() * $("#pre_def_medium").val();
		var pieces_large = $("#pieces_large").val() * $("#pre_def_large").val();
		var pieces_family = $("#pieces_family").val() * $("#pre_def_family").val();
		var pieces_combo = $("#pieces_combo").val() * $("#pre_def_combo").val();
		var wastage_small = $("#wastage_small").val() * 0;
		var wastage_medium = $("#wastage_medium").val() * 0;
		var wastage_large = $("#wastage_large").val() * 0;
		var wastage_family = $("#wastage_family").val() * 0;
		var wastage_combo = $("#wastage_combo").val() * 0;
		var total_weight = $("#total_weight").val();
		var packed_weight = $("#packed_weight").val();
		
		var to_pack = $("#to_pack").val();
		
		var Remaining_weight = $("#Remaining_weight").val();
		 
		 var weight_for_small = parseFloat(pieces_small,10);
		 var weight_for_medium = parseFloat(pieces_medium,10);
		 var weight_for_large = parseFloat(pieces_large,10);
		 var weight_for_family = parseFloat(pieces_family,10);
		 var weight_for_combo = parseFloat(pieces_combo,10);
		 
		 var wastage_for_small = parseFloat(wastage_small,10);
		 var wastage_for_medium = parseFloat(wastage_medium,10);
		 var wastage_for_large = parseFloat(wastage_large,10);
		 var wastage_for_family = parseFloat(wastage_family,10);
		 var wastage_for_combo = parseFloat(wastage_combo,10);
		 
		 var status = document.getElementById('status_box').value 
		 
			var total_wastage = parseFloat(wastage_small,10)+parseFloat(wastage_medium,10)+parseFloat(wastage_large,10)+parseFloat(wastage_family,10)+parseFloat(wastage_combo,10);
			 
	 /*
		
			if(Remaining_weight<0){
				alert('a');
				
			}
		
		else{*/
		
		

			var Remaining_total = parseFloat(total_weight,10)-parseFloat(packed_weight,10)-parseFloat(pieces_small,10)-parseFloat(pieces_medium,10)-parseFloat(pieces_large,10)-parseFloat(pieces_family,10)-parseFloat(pieces_combo,10)-parseFloat(total_wastage,10);
			 if(Remaining_total < 0)
			 {
				 //alert('l');
				 document.getElementById('Remaining_weight').value ="Invalid";
				 alert('Remaining Weight Can Not Be In Negative.\nPlease Reselect The Number of Pieces.\n\nThank You. !!!');
				 $('#submit').addClass('disabled');
				 return false;
				
				 //$("#Remaining_weight").val=0;
			 }
			 else
			 {
				  $('#submit').removeClass('disabled');
		
		
		//	var new_total = parseInt(total,10)-parseInt(weight,10);
		
		$("#Remaining_weight").val(Remaining_total.toFixed(2));
		$("#weight_small").val(weight_for_small);
		$("#weight_medium").val(weight_for_medium);
		$("#weight_large").val(weight_for_large);
		$("#weight_family").val(weight_for_family);
		$("#weight_combo").val(weight_for_combo);
		$("#wastage_small").val(wastage_for_small);
		$("#wastage_medium").val(wastage_for_medium);
		$("#wastage_large").val(wastage_for_large);
		$("#wastage_family").val(wastage_for_family);
		$("#wastage_combo").val(wastage_for_combo);
			 }
		
		
		
	}
</script>
<script>
/*function get_total_output(id)

	{
		//alert(id);
		var mydata = {"product":id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_total_output') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				$("#total_weight").val(response);
			}
		});	
}*/

</script>
<script>
	function get_product(id)

	{
		//alert(id);
		var mydata = {"product":id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_product') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				$("#product_prep").html(response);
			}
		});	
}

</script>

<script>
	function get_unique(id)

	{
		//alert(id);
		var mydata = {"unique_prep":id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_unique1') ?>",
			data:mydata,
			success:function(response){
		 //alert(response);
			$("#Unique").html(response);
			}
		});	
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/product_name') ?>",
			data:mydata,
			success:function(response){
			 //alert(response);
			$("#prod_name").val(response);
			}
		});	
		
		
		
}

</script>



<script>
	function get_total_output(id)

	{
		//alert(id);
		var product_id = document.getElementById('product_prep').value;
		var Unique = document.getElementById('Unique').value;
		var mydata = {"product":id,"product_id":product_id,"Unique":Unique};
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_total_output') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				$("#total_weight").val(response);
			}
		});	
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_status') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				if (response =='packed')
				{
					 $('#submit').addClass('disabled');
				}else{
					 $('#submit').removeClass('disabled');
				}
				
				$("#status_box").val(response);
			}
		});	
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_prep_by') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				$("#prep_by").val(response);
			}
		});	
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_balance') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				
				$("#packed_weight").val(response);
			}
		});	
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/to_pack') ?>",
			data:mydata,
			success:function(response){
				//alert(response);
				
				$("#to_pack").val(response);
			}
		});	
		
		
}

</script>


 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>

<?php } ?>

