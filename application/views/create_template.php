<html>
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo $title.' | '; ?>  Consumer1st Virtual Personal Assistance [V.P.A] </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

</head>
<?php function page_css(){ ?>
<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>
<?php
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename    = singleDbTableRow($user_id)->rolename;
	$email   	 = singleDbTableRow($user_id)->email;
	
	
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
						<?php 
							$get_temp = $this->db->get('dynamic_invoice');
							if($get_temp->num_rows() > 0){
						?>
							<div class="form-group <?php if(form_error('product_name')) echo 'has-error'; ?>">
								<label for="product_name" class="col-md-3">Existing Templates
									<span class="text-red"></span>
								</label>
								<div class="col-md-9" >
										<select name="existing_template" id="existing_template" class="form-control" style="width:100% auto;" onchange="get_template(this.value)">
											<option value=""> Choose Template </option>
											<?php
												foreach ($get_temp->result() as $v) {
													echo '<option value="'.$v->id.'"> '.$v->template_name.'</option>';
												}
											?>
										</select>
									<?php echo form_error('product_name') ?>
								</div>
							</div>
						<?php
							}
						?>
					
					
					
						<div class="form-group <?php if(form_error('template_name')) echo 'has-error'; ?>">
                            <label for="template_name" class="col-md-3">Template Name
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
									<input class="form-control" name="template_name" id="template_name" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder="Template Name" />
								<?php echo form_error('template_name') ?>
                            </div>
                        </div>
					
						<div class="form-group <?php if(form_error('from_pay_type')) echo 'has-error'; ?>">
							<label for="from_pay_type" class="col-md-3">Main Pay Type
								<span class="text-red"></span>
							</label>
							<div class="col-md-9" >
								<select class="form-control" onchange="get_sub_account(this.value)" style="width:100% auto;">
									<option value="">Choose Option</option>
									<?php
										$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
										foreach($query->result() as $account){
											echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
										}
									?>
								</select>	
								
								<?php echo form_error('from_pay_type') ?>
							</div>
						</div>
							
						<div class="form-group <?php if (form_error('pay_type')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Pay Type
								<span class="text-red">*</span>
							</label>
							<div class="col-md-9">  								

								<select name="pay_type" id="pay_type" class="form-control" style="width:100% auto;">
									<option value=""> Choose option </option>
									
								</select>	                                
								<?php echo form_error('pay_type') ?>

							</div>
						</div> 
						<hr>
						<div class="form-group">
                            <label class="col-md-6" style="font-size:20px;">Default Labels
                                <span class="text-red"></span>
                            </label>
                             <label class="col-md-6" style="font-size:20px;">New Labels
                                <span class="text-red"></span>
                            </label>
                        </div>
						
						<div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                            <label for="title" class="col-md-3">Consumer1st Virtual Personal Assistance [V.P.A]
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
									<input class="form-control" name="title" id="title" type="text" value="<?php echo set_value('title'); ?>" placeholder="Title" />
								<?php echo form_error('title') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('date')) echo 'has-error'; ?>">
                            <label for="date" class="col-md-3">Date
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="date" id="date" type="text" value="<?php echo set_value('date'); ?>" placeholder="Date" />
								
								<?php echo form_error('date') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('sender')) echo 'has-error'; ?>">
                            <label for="sender" class="col-md-3">Sender's Name
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="sender" id="sender" type="text" value="<?php echo set_value('sender'); ?>" placeholder="Sender's Name" />
								
								<?php echo form_error('sender') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('receiver')) echo 'has-error'; ?>">
                            <label for="receiver" class="col-md-3">Receiver's Name
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="receiver" id="receiver" type="text" value="<?php echo set_value('receiver'); ?>" placeholder="Receiver's Name" />
								
								<?php echo form_error('receiver') ?>
                            </div>
                        </div>      
						
						<div class="form-group <?php if(form_error('invoice_no')) echo 'has-error'; ?>">
                            <label for="invoice_no" class="col-md-3">Transaction Reference No
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="invoice_no" id="invoice_no" type="text" value="<?php echo set_value('invoice_no'); ?>" placeholder="Transaction Reference No" />
								
								<?php echo form_error('invoice_no') ?>
                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('qty')) echo 'has-error'; ?>">
                            <label for="qty" class="col-md-3">Qty
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="qty" id="qty" type="text" value="<?php echo set_value('qty'); ?>" placeholder="Qty" />
								
								<?php echo form_error('qty') ?>
                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('trans_remark')) echo 'has-error'; ?>">
                            <label for="trans_remark" class="col-md-3">Transaction Remarks
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="trans_remark" id="trans_remark" type="text" value="<?php echo set_value('trans_remark'); ?>" placeholder="Transaction Remarks" />
								
								<?php echo form_error('trans_remark') ?>
                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('biz_catg')) echo 'has-error'; ?>">
                            <label for="biz_catg" class="col-md-3">Business Category
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="biz_catg" id="biz_catg" type="text" value="<?php echo set_value('biz_catg'); ?>" placeholder="Business Category" />
								
								<?php echo form_error('biz_catg') ?>
                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('price')) echo 'has-error'; ?>">
                            <label for="price" class="col-md-3">Price
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="price" id="price" type="text" value="<?php echo set_value('price'); ?>" placeholder="Price" />
								
								<?php echo form_error('price') ?>
                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('subtotal')) echo 'has-error'; ?>">
                            <label for="subtotal" class="col-md-3">Subtotal
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                
									<input class="form-control" name="subtotal" id="subtotal" type="text" value="<?php echo set_value('subtotal'); ?>" placeholder="Subtotal" />
								
								<?php echo form_error('subtotal') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('total')) echo 'has-error'; ?>">
                            <label for="total" class="col-md-3">Total
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                               
									<input class="form-control" name="total" id="total" type="text" value="<?php echo set_value('total'); ?>" placeholder="Total" />
								
								<?php echo form_error('total') ?>
                            </div>
                        </div>
                       
						
            </div>
					


                        <div class="clearfix"></div>
						<div class="box-footer">
						<button type="button" class="btn btn-success" onclick="check()">
                            <i class="fa fa-eye"></i> View Demo
                        </button>
						 <button type="button" class="btn btn-warning" id="comfirm_btn" onclick="comfirm()"><i class="fa fa-warning"></i> Comfirm</button>
                        <button type="submit" name="submit" id="submit_btn" value="add_template" class="btn btn-primary" style="display:none;">
                            <i class="fa fa-bookmark-o"></i> Create Template
                        </button>
                    </div>
                    </div><!-- /.box-body -->

                    
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->
<div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header text-center">
                   
                </div><!-- /.box-header -->
                <div class="box-body">


                    <!-- Main content -->
                    <section class="content invoice" id="invoice_area" style="border:1px solid gray;">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-globe"></i> <label id="title_label">Consumer1st Virtual Personal Assistance [V.P.A]</label>
                                    <small class="pull-right"><label id="date_label">Date</label>: <?php echo date('d/m/Y'); ?></small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <h4 id="sender_label">Sender's Name</h4>
                                <address>
                                    <strong>
                                        Satish Patil
                                    </strong><br>

                                    <?php echo ''.'<br/>';
                                    echo 'Phone: 9902518232<br/>';
                                    echo 'Email: spremainder@gmail.com<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <h4 id="recv_label">Receiver's Name</h4>
                                <address>
                                    <strong>
                                        Anand Sagar
                                    </strong><br>

                                    <?php echo ''.'<br/>';
                                    echo 'Phone: 9980569960<br/>';
                                    echo 'Email: mr.anandsagar@gmail.com<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b><label id="invoice_no_label">Transaction Reference No</label>: #1234</b><br/>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th id="qty_label">Qty</th>
                                        <th id="trans_remark_label">Transaction Remarks</th>
                                        <th id="biz_catg_label">Business Category</th>
                                        <th id="price_label">Price</th>
                                        <th id="subtotal_label">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td>1</td>
                                        <td>Product 1</td>
                                        <td>Loyality Product Purchase</td>
                                        <td>100.00</td>
                                        <td>100.00</td>
                                    </tr>
									</tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    Your all payment details are available at My Account section.
                                </p>
                            </div><!-- /.col -->
                            <div class="col-xs-6">
                                <br />
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%" id="total_label">Total:</th>
                                            <td>100.00</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->


                        <?php echo get_option('invoice_terms') != ''? '<p style="text-align: center">'.get_option('invoice_terms').'</p>' : ''; ?>

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                <button class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download PDF</button>
                            </div>
                        </div>
                    </section><!-- /.content -->


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    </div>   <!-- /.row -->
</section><!-- /.content -->

    


</body>
</html>
<?php function page_js(){ ?>





<script>
	
	function get_sub_account(id)
	{
		var parent_id = id;
		var mydata = {"parent_id":parent_id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('dynamic_invoice/get_sub_account') ?>",
			data:mydata,
			success:function(response){
				$("#pay_type").html(response);
			}
		});
	}
	
	function get_template(temp_id){
		
		if(temp_id != ""){
			var mydata = {"temp_id":temp_id};
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_temp_name') ?>",
				data:mydata,
				success:function(response){
					$("#template_name").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_title') ?>",
				data:mydata,
				success:function(response){
					$("#title").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_date_label') ?>",
				data:mydata,
				success:function(response){
					$("#date").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_sender_label') ?>",
				data:mydata,
				success:function(response){
					$("#sender").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_receiver_label') ?>",
				data:mydata,
				success:function(response){
					$("#receiver").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_invoice_no_label') ?>",
				data:mydata,
				success:function(response){
					$("#invoice_no").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_qty_label') ?>",
				data:mydata,
				success:function(response){
					$("#qty").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_trans_remark_label') ?>",
				data:mydata,
				success:function(response){
					$("#trans_remark").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_biz_catg_label') ?>",
				data:mydata,
				success:function(response){
					$("#biz_catg").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_price_label') ?>",
				data:mydata,
				success:function(response){
					$("#price").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_subtotal_label') ?>",
				data:mydata,
				success:function(response){
					$("#subtotal").val(response);
				}
			});
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url('dynamic_invoice/get_total_label') ?>",
				data:mydata,
				success:function(response){
					$("#total").val(response);
				}
			});
		}
		else{
			$("#template_name").val('');
			$("#title").val('');
			$("#date").val('');
			$("#sender").val('');
			$("#receiver").val('');
			$("#invoice_no").val('');
			$("#qty").val('');
			$("#trans_remark").val('');
			$("#biz_catg").val('');
			$("#price").val('');
			$("#subtotal").val('');
			$("#total").val('');
		}
	}
	
	
	function check()
	{
		$('#invoice_area').fadeOut('fast');
		
		var title = $('#title').val().trim();
		var date = $('#date').val().trim();
		var sender = $('#sender').val().trim();
		var receiver = $('#receiver').val().trim();
		var invoice_no = $('#invoice_no').val().trim();
		var qty = $('#qty').val().trim();
		var trans_remark = $('#trans_remark').val().trim();
		var biz_catg = $('#biz_catg').val().trim();
		var price = $('#price').val().trim();
		var subtotal = $('#subtotal').val().trim();
		var total = $('#total').val().trim();
		
		if(title != ""){
			$('#title_label').html(title);
		}
		
		if(date != ""){
			$('#date_label').html(date);
		}
		
		if(sender != ""){
			$('#sender_label').html(sender);
		}
		
		if(receiver != ""){
			$('#recv_label').html(receiver);
		}
		
		if(invoice_no != ""){
			$('#invoice_no_label').html(invoice_no);
		}
		
		if(qty != ""){
			$('#qty_label').html(qty);
		}
		
		if(trans_remark != ""){
			$('#trans_remark_label').html(trans_remark);
		}
		
		if(biz_catg != ""){
			$('#biz_catg_label').html(biz_catg);
		}
		
		if(price != ""){
			$('#price_label').html(price);
		}
		
		if(subtotal != ""){
			$('#subtotal_label').html(subtotal);
		}
		
		if(total != ""){
			$('#total_label').html(total);
		}
		
		$('#invoice_area').fadeIn();
		
		$('#submit_btn').hide();
		$('#comfirm_btn').show();
	}
	
	function comfirm(){
		$('#comfirm_btn').hide(500);
		$('#submit_btn').show(500);
	}

</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>