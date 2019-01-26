 <?php
foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 

foreach( $dis_debit->result() 		as $dis_debit);
foreach( $dis_credit->result() 		as $dis_credit);

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
;
$dis_debit			= $dis_debit->debit;
$dis_credit      	= $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;

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
                    <h3 class="box-title">Split Your Benefits Vouchers </h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table BORDER=4 Size="16" id="deposit" class="table table-bordered table-striped table-hover">
						<h4 class="box-title">Available Balance as on <?php echo date('F j, Y, g:i a') ?> to Generate/Purchase Vouchers</h4>
						<div class="box-body">
								<table  class="table table-bordered">
									<tr><th> Cash/Wallet 	  </th> <td> <?php echo amountFormat($wallet_balance );   ?> 	 </td></tr>
									<tr><th> Discount Points  </th> <td id="db"> <?php echo ($discount_balance); ?>	 </td></tr>
								</table>	
						</div>	
					</table>
<br>
						
						
                        <div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="voucher_name" class="form-control" value="<?php echo $commissions->remarks; ?>" readonly="readonly" placeholder="Enter Coupon/Voucher Name">
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>
						<hr />
			<!--			 <div class="form-group < ?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Split Selection
                                <span class="text-red"></span>
                            </label>
							  <title>jQuery UI Autocomplete - Default functionality</title>
						<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
						  <script>
									  $(function(){
									  $('.beneficiary').click(function(){
										if ($(this).is(':checked'))
										{
										  alert($(this).val());
										}
									  });
									});
						
//						  
						  function getpersonname(name)
								{
										document.getElementById("pname").innerHTML="<b>"+name+"</b>";
									
								}
								
								
								function verifytotal(userinput)
								{
										var total = document.getElementById("db").innerHTML;
									
										total = parseFloat(total);
										userinput = parseFloat(userinput);
										if(userinput > total){
										document.getElementById("uamount").style.borderColor="red";
										}else{
											document.getElementById("uamount").style.borderColor="green";
											var availableamount = total - userinput;
											confirm("Your Balance Points will be: " + availableamount +"\n Please confirm...Do You Want TO PROCEED");
										}
								}	
								
								
							</script>
                            <div class="col-md-9">
				

					
							<input type="radio" name="beneficiary" class="beneficiary" value="self" checked id="self"  onclick="hideperson()"/> Self Voucher        
							<input type="radio" name="beneficiary"  class="beneficiary" value="other" id="other"  onclick="hideperson()"/> To Client Voucher
						
							<div class="form-group < ?php if(form_error('to_role')) echo 'has-error'; ?>" id="pselect">
                            <label for="firstName" class="col-md-3">Person Selection</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="to_role" class="form-control" onchange="getpersonname(this.value)">
										<option value=""> Select User </option>
											< ?php foreach($roles->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->first_name.' '.$role->last_name.'</option>';
												}                                        
										?>	
									</select>
									
                                   <label id="pname"></label>									
							   </div>
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>						
				-->			<hr />
							<input type="radio" name="conv_type" value="wallet" checked id="wallet" /> Wallet/Cash   
							<input type="radio" name="conv_type" value="discount" id="discount" /> Discount 
							<input type="number" id="uamount" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Enter Value" onblur="verifytotal(this.value)"> <br>
						<hr />	
									
							
						<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Effective Start Date
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
							<div class="input-group">
																
                               <input type="date"  id="start_date" name="start_date" value="<?php echo date('d-m-Y'); ?>"> <br>
                                <?php echo form_error('start_date') ?>	<br>
                            </div>
                        </div>
					
						</div>
							<div class="col-md-12">
							<label for="firstName" class="col-md-3">Select No of TICKETs</label>
							
                                <div class="input-group"> 
							
									<br>
									<INPUT TYPE="button" NAME="03" VALUE=" 03 " OnClick="02">
									<INPUT TYPE="button" NAME="06" VALUE=" 06 " OnCLick="06">
									<INPUT TYPE="button" NAME="09" VALUE=" 09 " OnClick="09">
									<INPUT TYPE="button" NAME="12" VALUE=" 12 " OnClick="12">
									<INPUT TYPE="button" NAME="18" VALUE=" 18 " OnClick="18">
									<INPUT TYPE="button" NAME="24" VALUE=" 24 " OnCLick="24"><br>
									<INPUT TYPE="button" NAME="05" VALUE=" 05 " OnClick="05">
									<INPUT TYPE="button" NAME="10" VALUE=" 10 " OnClick="10">
									<INPUT TYPE="button" NAME="15" VALUE=" 15 " OnClick="15">
									<INPUT TYPE="button" NAME="20" VALUE=" 20 " OnClick="20">
									<INPUT TYPE="button" NAME="25" VALUE=" 25 " OnClick="22">
									<INPUT TYPE="button" NAME="30" VALUE=" 30 " OnClick="24"><br>

								<br>
						</div></div> 
							<label for="firstName" class="col-md-3">Select Maturity time-gap among the TICKET Series</label>
								 <select name="period" class="input-group">
										<option value=""> Select Series </option>
										<option value="1" <?php echo set_select('period', '1') ?>>Daily / 1 Day</option>
										<option value="7" <?php echo set_select('period', '7') ?>>7 Days / 1 Week</option>
										<option value="15" <?php echo set_select('period', '15') ?>>15 Days / 2 Weeks</option>
										<option value="30" <?php echo set_select('period', '30') ?>>30 Days / 1 Month</option>
										<option value="60" <?php echo set_select('period', '60') ?>>60 Days / 2 Months</option>
										<option value="90" <?php echo set_select('period', '90') ?>>90 Days / 3 Months</option>
										<option value="180" <?php echo set_select('period', '180') ?>>180 Days / 6 Months</option>
								 </select>

							
							  </div>
                        </div>
						<hr />

										
						<hr />
						
	
				<hr />
					<div class="form-group <?php if(form_error('commission')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">List Of Generated Tickets
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								                              <!-- Save Temp   < ?php 
									$start = date('d-m-Y');
									$months = 6;
									$date=new DateTime($start);
									$date->modify('+'.$months.' month');
									echo $date->format('d-m-Y'); ?> 
									<?php 
									$start = date('d-m-Y');
									$months = 14;
									
									$date=new DateTime($start);
									$date->modify('+'.$months.' month');
									echo $date->format('d-m-Y'); ?> <br>-->
									
								<?php 	
								$months = 10;
								for ($x = 1; $x <= $months; $x++) {
								?>	 <br>  <?php 
									
									$date=new DateTime($start);
									$date->modify('+'.$x.' month');
								echo "Ticket Serial No: $x and effective Valid Date  Starts from  " .$date->format('d-m-Y');
									}
									?>  
								</div>
						</div>
				<!--				<div class="form-group <?php if(form_error('benefits')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Benefits to 'Client'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="benefits" step="0.1" min="0.1" class="form-control" value="<?php echo set_value('benefits'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('benefits') ?>
								</div>
								</div>
						</div>			
				-->

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">    <!-- PATH: Vouchers/add_vouchers  Submit to Generate Series Voucher -->
                        <button type="submit" name="submit" value="split_vouchers11" onclick="savemydata()" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Preview
                        </button>
						<button type="submit" name="submit" value="split_vouchers" onclick="savemydata()" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Submit to Create Split Vouchers
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



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
	var name=document.getElementById("100").value;
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
	
	

<?php } ?>

