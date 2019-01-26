
 <?php


foreach( $voc_debit->result() 		as $voc_debit);
foreach( $voc_credit->result() 		as $voc_credit); 


$voc_debit			= $voc_debit->debit;
$voc_credit      	= $voc_credit->credit;

/* Available Balance Wallet,loyality and Discount Points */

//$wallet  		= $totalWallet;
$voucher_balance    = ( $voc_debit - $voc_credit ) ;

?>


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
                    <h3 class="box-title">Create Private PIN Vouchers</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
				
				
				  	<div class="box-body">
					<h4 class="box-title">Voucher Balance to Generate Private Vouchers</h4>
						<table class="table table-bordered">
						
							<tr><th> Balance Voucher Points  </th> <td> <?php echo ($voucher_balance );   ?> Points	 </td></tr>
							
						</table>	
								<hr />
					</div>	
						
                 
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
									
						<div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Transferrable Voucher Name</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="voucher_name" class="form-control">
										<option value="">Select Voucher Name </option>
										
										<?php foreach($voucher->result() as $voucher){
                                            echo '<option value="'.$voucher->id.'">"'.$voucher->remarks.'"</option>';
                                        } ?>			
				
									</select>		         
							   </div>
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>						
								
						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Value
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="amount"  id="amount" max="<?php echo $voucher_balance ?>" class="form-control" value="<?php echo set_value('amount'); ?>" >
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>
						<hr />
						<div class="form-group <?php if(form_error('trans_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payment Mode
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										<input type="radio" name="trans_type"  value="voucher" id="voucher" />Voucher Points      
										
																				
                                <?php echo form_error('trans_type') ?>
                            </div>
                        </div>						
					
					  <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="private_vouchers" onclick="savemydata()" class="btn btn-primary">
					
					                           
							<i class="fa fa-edit"></i> Generate Personal Voucher
								    </button>
                    </div> 
					</form>
            </div>
           



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <!-- Page script -->
    
<?php } ?>

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