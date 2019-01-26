<?php

//check category/public function wallet_to_discount()

foreach( $usedwallet->result() 		as $usedWallet);  //wallet points 
foreach( $wallet->result() 			as $wallet);

foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
foreach( $loy_debit->result() 		as $loy_debit);
foreach( $loy_credit->result() 		as $loy_credit);
foreach( $dis_debit->result() 		as $dis_debit);
foreach( $dis_credit->result() 		as $dis_credit);

foreach( $convertWallet->result() 	as $converWallet);  //Convert Wallet Ratio 

$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;
$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$loy_debit			= $loy_debit->debit;
$loy_credit      	= $loy_credit->credit;
$dis_debit			= $dis_debit->debit;
$dis_credit      	= $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

$wallet  		= $totalWallet;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;

//Getting Ratio from Points Ratio Table
$ratio_wallet     = '1'; 
$ratio_loyality   = $converWallet->alpha; 
$ratio_discount   = $converWallet->beta;

/* Converting Wallet to loyality and Discount Points Ratio  */
$loyality = (($ratio_loyality * $wallet_balance) ); 
$discount = (($ratio_discount * $wallet_balance)); 

$wallet_for_loyality = (($wallet_balance / $ratio_loyality)); 
$wallet_for_discount = (($wallet_balance / $ratio_discount)); 


?>
<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

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
                    <h3 class="box-title">Values Exchange/Conversion</h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					 
								<table class="table table-bordered">
									 <h4 class="box-title" color="red" >Balance Account Sheet </h4>									
								   <tr><th> V P A Values 		</th> <td> <?php echo amountFormat($wallet_balance); ?>	 </td></tr>
								   <tr><th> Loyality Values		</th> <td> <?php echo ($loyality_balance); ?>	 </td></tr>
								   <tr><th> Discount Values		</th> <td> <?php echo ($discount_balance); ?>	 </td></tr>
								   
								</table>	

								<hr />

 


							<div id="flip"> <h4>Click here to See the Conversion Ratio</h4></div>
								<div  id="panel"> 
								<table class="table table-bordered">
																  
								   
								  <tr> <th>  Below Convertion Ratio Values are calculated based on your Available Balance V P A </th></tr>
							    <tr><th> Loyality...( V P A    ' 1 =   <?php echo ($ratio_loyality ) ; ?> ') Values  		</th> <td> Maximum Eligible for ' <?php echo number_format($loyality, 2);   ?> ' Loyality Values	 </td></tr>
								   <tr><th> Discount..( V P A  ' 1 =   <?php echo ($ratio_discount ) ; ?> ') Values 		</th> <td>Maximum Eligible for ' <?php echo number_format($discount, 2);   ?>	' Discount Values </td></tr>
						</table>
							</div>
							<hr />

                  <div class="form-group <?php if(form_error('conv_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Type of  Values
                            <span class="text-red">*</span>
                        </label>
						<div class="col-md-9">
                       
							<input type="radio" name="conv_type"  <?php if (isset($conv_type) && $conv_type=="wallet") ;?> value="wallet" checked id="wallet" /> V P A        
							<input type="radio" name="conv_type"  <?php if (isset($conv_type) && $conv_type=="loyality") ;?> value="loyality" id="loyality" /> Loyality
							<input type="radio" name="conv_type"  <?php if (isset($conv_type) && $conv_type=="discount") ;?> value="discount" id="discount" /> Discount 
							
                            <?php echo form_error('conv_type') ?>
                        </div>
                    </div>
							<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount to Convert
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="amount" step="0.01" min="1"  max="<?php  echo ($wallet_balance); ?>" value="<?php echo set_value('amount');  ?>" class="form-control" placeholder="Enter Cash Points">
									<?php echo form_error('amount') ?>
								</div>
						</div>					
						<div class="form-group <?php if(form_error('trans_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Convert To
							<span class="text-red"></span></label>
                            <div class="col-md-9">    
							
							<input type="radio" name="trans_type"  <?php if (isset($trans_type) && $trans_type=="wallet") ;?> value="wallet" id="wallet" /> V P A 		 
							<input type="radio" name="trans_type"  <?php if (isset($trans_type) && $trans_type=="loyality") ;?> value="loyality" checked id="loyality" />Loyality        
							<input type="radio" name="trans_type"  <?php if (isset($trans_type) && $trans_type=="discount") ;?> value="discount" id="discount" /> Discount 
							
							
                             <?php echo form_error('trans_type') ?>
                            </div>							
                        </div>							
					
					    <div class="form-group <?php if(form_error('tranx_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Transaction Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="tranx_id" class="form-control" value="<?php echo set_value('tranx_id'); ?>" placeholder="Enter Transaction Remarks Convertion Details">
									<?php echo form_error('tranx_id') ?>

								</div>
						</div> 

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
</table>
<!--
<div id="div22" style="width:80px;height:80px;display:none;background-color:green;"></div><br>
<div id="div3" style="width:80px;height:80px;display:none;background-color:blue;"></div> -->
                    <div class="box-footer">      <!-- PATH: //check category/public function wallet_to_discount() && category_model->wallet_to_discount(); -->
                    <!--      <button type="submit" name="submit" value="wallet_to_discount" class="btn btn-primary">
                                  <i class="fa fa-edit"></i> Proceed To Convert Values      
     </button>--> 
   
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('category/categoryListJson'); ?>",
                    "data": function ( d ) {
                        d.dateRange = $('[name="searchByNameInput"]').val();
                    }
                }
            });

            $('button#searchByDateBtn').on('click', function(){
                oTable.fnDraw();
            });

        });

    </script>



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
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
$(document).ready(function(){
     $("button").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
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
</head>

<?php } ?>

