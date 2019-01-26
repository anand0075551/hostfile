

 <?php
	foreach($total_wallet->result() as $wallet);  //total_wallet points calc from Ledgr_Model/PF $total_wallet
	foreach($total_wallet_debit->result() as $debit);
	foreach($total_wallet_credit->result() as $credit);
 
$total_wallet 		 = $wallet->amount; //total_wallet
$total_wallet_debit  = $debit->debit;
$total_wallet_credit = $credit->credit;

foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
foreach( $loy_debit->result() 		as $loy_debit);
foreach( $loy_credit->result() 		as $loy_credit);
foreach( $dis_debit->result() 		as $dis_debit);
foreach( $dis_credit->result() 		as $dis_credit);

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$loy_debit			= $loy_debit->debit;
$loy_credit      	= $loy_credit->credit;
$dis_debit			= $dis_debit->debit;
$dis_credit      	= $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

//$wallet  		= $totalWallet;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;

//check $wallet_balance   >= $commissions->amount;
//check $loyality_balance >= $commissions->amount;
//check $discount_balance >= $commissions->amount;
//date_default_timezone_set('Asia/Calcutta');
//echo date('Y-m-d h-i-s'); 
?>


<?php function page_css(){ ?>
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
                    <h3 class="box-title">Transaction to Purchase Business PIN " <i><b>Vouchers Type: <?php echo $commissions->type; ?> </i></b>" </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
				
				
				  	<div class="box-body">
					<h4 class="box-title">Available Balance as on <?php echo date('F j, Y, g:i a') ?> to Generate/Purchase Vouchers</h4>
				<!--	<h4 class="box-title">Available Balance as on <?php echo date('Y-m-d h-i-s') ?> to Generate/Purchase Vouchers</h4>	 -->		
								
						<table class="table table-bordered">
						
							<tr><th> Cash/Wallet 	  </th> <td> <?php echo amountFormat($wallet_balance );   ?> 	 </td></tr>
							<tr><th> Loyality Points  </th> <td> <?php echo ($loyality_balance); ?>	 </td></tr>
							<tr><th> Discount Points  </th> <td> <?php echo ($discount_balance); ?>	 </td></tr>
						</table>	
								
					</div>	
						
                 
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
													
						

								
						<div class="form-group <?php if(form_error('trans_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payment Mode
							<span class="text-red">*</span></label>
                            <div class="col-md-9">    	
										<input type="radio" name="trans_type" <?php if (isset($trans_type) && $trans_type=="wallet") ;?> value="wallet" checked id="wallet" />Wallet       
										<input type="radio" name="trans_type" <?php if (isset($trans_type) && $trans_type=="loyality") ;?> value="loyality" id="loyality" />Loyality        
										<input type="radio" name="trans_type" <?php if (isset($trans_type) && $trans_type=="discount") ;?> value="discount" id="discount" /> Discount 
																		
                                <?php echo form_error('trans_type') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name </label>
                            <div class="col-md-9">
                              
							   <input type="text" name="voucher_name"  id="voucher_name" class="form-control" readonly value="<?php echo $commissions->remarks; ?>" >
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>		
						<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher type </label>
                            <div class="col-md-9">
                              
							   <input type="text" name="voucher_type"  id="voucher_type" class="form-control" readonly value="<?php echo $commissions->type; ?>" >
                                <?php echo form_error('voucher_type') ?>
                            </div>
                        </div>	
						<div class="form-group <?php if(form_error('voucher_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher ID</label>
                            <div class="col-md-9">
                              
							   <input type="text" name="voucher_id"  id="voucher_id" class="form-control" readonly value="<?php echo $commissions->identity_id; ?>" >
                                <?php echo form_error('voucher_id') ?>
                            </div>
                        </div>	
					<!--	< ?php if ($trans_type == 'wallet'	) { ?>
					-->	<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Wallet/Cash
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="amount" min="1"  id="amount" readonly class="form-control" max="<?php echo $wallet_balance; ?>" value="<?php echo $commissions->amount; ?>" >
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>
					<!--	< ?php } elseif ($trans_type== 'loyality'	) { ?>
					-->	<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loyality Points Value
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="loy_amt" min="1"  id="loy_amt" readonly  class="form-control" max="<?php echo $loyality_balance; ?>" value="<?php echo $commissions->loy_amt; ?>" >
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>
					<!--	< ?php } elseif ($trans_type== 'discount'	) { ?>
					-->	<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Discount Points Value
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="dis_amt" min="1"  id="dis_amt" readonly class="form-control" max="<?php echo $discount_balance; ?>" value="<?php echo $commissions->dis_amt; ?>" >
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>		
					<!--	< ?php } ?>
					-->
					<?php if($commissions->transferrable != 'no')	{?>
						 <div class="form-group <?php if(form_error('transferrable')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transferrable Voucher Type 
                                <span class="text-red">?</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="transferrable"  class="form-control" value="<?php echo $commissions->transferrable; ?>" >
                            </select>
                                <?php echo form_error('transferrable') ?>
                            </div>
                        </div> 
						
<!-------******************************************************************************************************************------->		 
					
						<div id="flip"> <h4> "Click here" For Voucher Consumer</h4></div>	
							<div  id="panel"> 	
							<!-- info row -->
							  <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <strong>Customer : </strong>
                                     <!--   <select name="customerID" class="form-control">-->
										 <select name="to_role" class="form-control">
												<option  value="">Select Person</option>
												<?php foreach($users->result() as $user){
													echo '<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
												}                                        
												?>
										</select>
                                    <p id="referralCodeStatus"></p>

                                </div><!-- /.col -->

                                <div class="col-sm-4 invoice-col">
                                    <strong>Customer Name:</strong>
                                    <address>
                                        <strong><span id="customerName"></span></strong><br>
                                        <p id="customerAddress"></p>
                                    </address>
                                </div><!-- /.col -->

                                <div class="clearfix"></div>
                              </div><!-- /.row -->										
							</div>                              
						<?php } ?>
<!-------******************************************************************************************************************------->
									</div>
								</div>											
							</div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">					
                        <button type="submit" name="submit" value="create_vouchers" onclick="savemydata()" class="btn btn-warning">					                           
							<i class="fa fa-edit"></i> Create Voucher </button>						   
                   
						<a href="<?php echo base_url('vouchers/business_voucher_index/') ?>"   class="btn btn-primary"><i class="fa fa-edit"></i> Back </a>
               </div> 
					</form>
            </div><!-- /.box 
					<a href="< ?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Verify Voucher to Generate</a>
                   
  
		<a href="< ?php echo base_url('category/wallet_to_discount') ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Convert Wallet to Benefits Points</a>
		
       -->                                   


        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <!-- Page script -->
    
<script>
	function savemydata()
	{
	alert("Generated Voucher Amount cannot be reverted. Please Confirm..?");
	//var name=document.getElementById("amount").value;
	//var mobile=document.getElementById("mobile").value;
	//var address=document.getElementById("address").value;
	alert(amount+mobile+address);
	
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				alert(xmlhttp.responseText);
            }
        };
       // xmlhttp.open("GET", "savemydata.php?&a="+name+"&b="+mobile+"&c="+address, true);
        xmlhttp.send(); 
	}
    </script>

<!--Anand J-query-->
	
<script>
	

<!-- For Convertion Ratio Flip View -->
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});

$(document).ready(function(){
    $("#hide").click(function(){
        $("#div1").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div1").show();
		// alert("The paragraph is now Showing");
    });
});

$(document).ready(function(){
    $("#hide").click(function(){
        $("#div2").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div2").show();
		// alert("The paragraph is now Showing");
    });
});



</script>

<style>
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 50px;
    display: none;
}
</style>


    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
  
    $(function(){
        $('.boxFormContainer').change(function(){
            var iSelector = $('[name="customerID"]');
            var customerID = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('product/validateCustomerCodeApi'); ?>",
                data : { customerID : customerID }
            })
            .done(function(response){
                var msg = JSON.parse(response);
                if(msg.status == 'true'){
                    $('.referralFa').html('<i class="fa fa-check"></i>');
                    iSelector.closest('.input-group').removeClass('has-error');
                    iSelector.closest('.input-group').addClass('has-success');
                    $('#customerName').text(msg.customerName);
                    $('#customerAddress').html(msg.customerAddress);
                    //$('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                    $('#referralCodeStatus').html('');
                }else{
                    $('.referralFa').html('<i class="fa fa-ban"></i>');
                    iSelector.closest('.input-group').removeClass('has-success');
                    iSelector.closest('.input-group').addClass('has-error');
                    $('#customerName').text('');
                    $('#customerAddress').text('');
                    $('#referralCodeStatus').html('<span style="color: #ff0000">Customer ID is invalid</span>');
                }
                //alert(msg);
            });


            //Get Total Price
            var sum = 0;
            $('.individualPrice').each(function() {
                sum += Number($(this).val());
            });
            $('#totalPrice').text(sum.toFixed(2));

        });



        $('#addTableRow').click(function(e){



            e.preventDefault();

            $('table.newProductTable tbody tr td select').select2('destroy');
            var tableRow = $('table.newProductTable tbody tr.originalRow').html();

            $('table.newProductTable tbody').append('<tr>'+tableRow+'</tr>');
            $('select').select2();


        });
    });

    $(document).on('click', '.removeProductRow', function() {
        $(this).closest('tr').html('');

        var sum = 0;
        $('.individualPrice').each(function() {
            sum += Number($(this).val());
        });
        $('#totalPrice').text(sum.toFixed(2));

    });
</script>

<?php } ?>
