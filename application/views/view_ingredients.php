
<?php include('header.php'); ?>
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                    <table class="table table-striped">
					
							<tr>
                            <td><h4><b>Catagaory</b></h4></td>
                            <td><h4><b>Sub catagory</b></h4></td>
                            <td><b><h4>Items</b></h4></td>
                            <td><b><h4>Declared Weights(Kg)</b></h4></td>
                            <td><b><h4>Add Weight To Use(kg)</b></h4></td>
                            <td><b><h4>Available Stock</b></h4></td>
                           
                            
                        </tr>
					
										<?php
										$cnt =1;
										$t_cnt = $view_assistant->num_rows();
										
foreach ($view_assistant->result() as $profile)
{
?>
						
					  

						<tr>
                           
                            
							 <td><?php 
											$query1 = $this->db->get_where('smb_category', ['id' => $profile->category,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->category_name;
													}
												} else {
													 echo  "error";
												}?></td>
							 <td><?php 
											$query1 = $this->db->get_where('smb_sub_category', ['id' => $profile->sub_category,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->sub_category_name;
													}
												} else {
													 echo  "error";
												}?></td>
							 <td><?php 
											$query1 = $this->db->get_where('smb_product', ['id' => $profile->item,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->title;
													}
												} else {
													 echo  "no-data";
												}?></td>
							 <td><?php echo $profile->qty; ?></td>
							 
							 <?php //$cnt=1;?>
							 
							 <td><input type="text" name='<?php echo $cnt;?>usedweight' id='<?php echo $cnt;?>usedweight' onkeyup="get_total(<?php echo $t_cnt;?>)"class="form-control" value="0"></td>
							 
							  <!--========================================-->
						<td> <?php
						
						$user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
						
		$get_store_id = $this->db->get_where('inventory_stocks');
							
        foreach($get_store_id->result () as $str_id)	
		{
			$store_id = $str_id->store_id;
			
		}		
		
		//
		$get_store_id = $this->db->get_where('product_assign', ['product_id' => $profile->product_preparation, 'assigned_to_name' => $user_id]);
							
        foreach($get_store_id->result () as $str_id)	
		{
			$store_id_assigned = $str_id->store_id;
		}		
		//
						
									$query2 = $this->db->get_where('inventory_stocks', ['product' => $profile->item, 'store_id' => $store_id_assigned]);
									if ($query2->num_rows() > 0) {
													foreach ($query2->result() as $row) ;
														echo $balance_qty = $row->balance_qty;
													
												} else {
													 echo $balance_qty = 0 ;
												}
							 
							 ?> </td>
							
							
							
							 <input type="hidden" name="store_id_assigned" id="store_id_assigned" value ="<?php echo $store_id_assigned;?>"class="form-control">
							 
							 <input type='hidden' name='<?php echo $cnt;?>balance_qty' id='<?php echo $cnt;?>balance_qty' value='<?php echo $balance_qty;?>'>
							<input type='hidden' name='<?php echo $cnt;?>product' id='<?php echo $cnt;?>product' value='<?php echo $profile->product_preparation	;?>'>
			                <input type='hidden' name='<?php echo $cnt;?>category' id='<?php echo $cnt;?>category' value='<?php echo $profile->category;?>'>
							
							
							
							<!--<input type='hidden' name='<?php echo $cnt;?>usedingr' id='<?php echo $cnt;?>usedingr' value='<?php echo $profile->ingredient;?>'> -->
							
							<input type='hidden' name='<?php echo $cnt;?>prod_id' id='<?php echo $cnt;?>prod_id' value='<?php echo $profile->item;?>'>
							 
                        </tr> 
						
					
					<input type='hidden' name='<?php echo $cnt;?>sub_category' id='<?php echo $cnt;?>sub_category' value='<?php echo $profile->sub_category;?>'>
						
						
					
                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name.' '.singleDbTableRow($profile->created_by)->last_name;?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $profile->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name.' '.singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
                        <?php } $cnt++; }?>
						
					
					
					<b><h3><?php 
											$query1 = $this->db->get_where('product_preparation', ['id' => $profile->product_preparation,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->product_name;
													}
												} else {
													 echo  "no data";
												}?></b></h3>
					
					
					
						<tr>
						<th></th>
						<th><b><h4>Expiry Date:<input type="text" name="exp_date" id="exp_date" class="some_class form-control" placeholder="Exp Date"></b></h4></th><th></th>
						<th><b><h4>Total Declared Weight(Kg):</b></h4><?php 
											 echo $profile->total_declared?></th>
						<th><b><h4>Total Output(Kg):<input type="text" name="total_output" id="total_output" class="form-control"readonly></b></h4></th>
						</tr>
                    </table>
					
				
			
<!--<button type="button" id="btn" onclick="get_total()">click</button> -->
                </div><!-- /.box-body -->

              		
						  <div class="box-footer">
			<button type="button" name="submit" id="submit"  value="submit" class="btn btn-primary" onclick="Used_weight(<?php echo $t_cnt;?>)" ></i>Submit</button>
               
            </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->


<script>
	function get_total(){
		var category = $("#category").val();
		var weight = $("#weight").val();
		var total = $("#total").val();
		 
		if(category!=26){
			var new_total = parseInt(total,10)+parseInt(weight,10);
		}
		else{
			var new_total = parseInt(total,10)-parseInt(weight,10);
		}
		$("#total").val(new_total);
		$("#weight").val("");
	}
</script>

<script>
	function Used_weight(cnt)
	
	{
		var i =1
		var used_weight = '';
		//var used_ingredeint = '';
		var product = '';
		var category = '';
		var prod_id = '';
		var sub_category = '';
		var total_output = document.getElementById('total_output').value;
		var exp_date = document.getElementById('exp_date').value;
		var store_id_assigned = document.getElementById('store_id_assigned').value;
		
		for(i=1; i<=cnt; i++)
		{
				used_weight += document.getElementById(i+'usedweight').value + ",";
				//used_ingredeint += document.getElementById(i+'usedingr').value + ",";
				product += document.getElementById(i+'product').value + ",";
				category += document.getElementById(i+'category').value + ",";
				prod_id += document.getElementById(i+'prod_id').value + ",";
				sub_category += document.getElementById(i+'sub_category').value + ",";
		}
		
		//alert(used_weight);
		//alert(used_ingredeint);
		//alert(category);
			var mydata = {"used_weight":used_weight,"product":product,"category":category,"sub_category":sub_category,"prod_id":prod_id,"total_output":total_output,"exp_date":exp_date,"store_id_assigned":store_id_assigned};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/add_used_ingredients') ?>",
			data:mydata,
			success:function(response){
				var result = response;
				//$("#Used_weight").html(response);
				window.location="<?php echo base_url('Product_preparation/list_prepaired_food') ?>"+"/"+result;
				//alert(result);
			}
		});
	}
	</script>
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
	function get_total(cnt){
		
		
		
	
		var i =1
		var sum = 0;
		
		for(i=1; i<=cnt; i++)
		{
				used_weight = document.getElementById(i+'usedweight').value ;
				balance_qty = document.getElementById(i+'balance_qty').value ;
				category = document.getElementById(i+'category').value ;
				
				if( parseFloat(used_weight,10) > parseFloat(balance_qty,10) && category != 26 )
				{
                alert('Weight Can Not Be Greater Than Available Stock.\n\nPlease Re-Enter weight.\n\nThank You. !!!');
				$('#submit').addClass('disabled');
				 return false;
            }
			else{
				$('#submit').removeClass('disabled');
				
				if(category == 26)
            {
                sum=parseFloat(sum,10)-parseFloat(used_weight,10);
            }else
			{
				sum=parseFloat(used_weight,10)+parseFloat(sum,10);
			}
				
				//sum=parseInt(used_weight,10)+parseInt(sum,10);
		}
		}
		document.getElementById('total_output').value =sum
		
	}
</script>