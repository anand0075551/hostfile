
<?php $loggedInUser = loggedInUserData();
if($loggedInUser['role'] == 'admin') { 
/*
<!-- foreach( $assets->result() as $assets);
foreach( $debits->result() as $debits);
foreach($credits->result() as $credits);
foreach($wallet->result() as $wallet);
foreach( $usedwallet->result() as $usedWallet);  //wallet_converted 

 $totalAssets = $assets->amount; 
 $totalDebits = $debits->debit; 
$totalCredits = $credits->credit; 
$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;  

$debits = $totalDebits	;
$credits = $totalCredits;
$wallet  = $totalWallet;
$usedwallet = $usedwallet ;
$balancecash = $wallet  - $usedwallet ;
 $assets = ($debits - $credits) ;
--> */
 
 


 
} ?>



<?php function page_css(){ ?>
    <!-- Morris chart -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
					<!----Temp Top row Box----->
					  <?php if($loggedInUser['role'] == 'admin') { ?><!---Start of Display Only For Admin-->    

                        <div class="col-lg-3 col-xs-8">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="5" color=""> 
									Declared Products
									  
                                       
										</font>
                                    </h3>
									 <h3>  <font size="5" color=""> 
									       &nbsp;
                                       
										</font>
                                    </h3>
                                  
                                </div> 
                                <div class="icon">
                                    <i class="ion ion-speakerphone"></i>
                                </div>
                                <a href="<?php echo base_url('Product_preparation/product_prepration_report'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						  <div  class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="5" color=""> 
									Used Products
									  
                                       
										</font>
                                    </h3>
									 <h3>  <font size="5" color=""> 
									       &nbsp;
                                       
										</font>
                                    </h3>
                                  
                                </div>
                                <div class="icon">
                                    <i class="ion ion-coffee"></i>
                                </div>
								<a href="<?php echo base_url('Product_preparation/product_used_report'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                               
                                 
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
							
							  <div class="inner">
                                    <h3>  <font size="5" color=""> 
									Product Packing
									  
                                       
										</font>
                                    </h3>
									 <h3>  <font size="5" color=""> 
									       &nbsp;
                                       
										</font>
                                    </h3>
                                  
                                </div>
                              
                                <div class="icon">
                                    <i class="ion ion-cube"></i>
                                </div>
                                <a href="<?php echo base_url('Product_preparation/report_product_packing'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
							
							<div class="inner">
                                    <h3>  <font size="5" color=""> 
									Inventory Stock
									  
                                       
										</font>
                                    </h3>
									 <h3>  <font size="5" color=""> 
									       &nbsp;
                                       
										</font>
                                    </h3>
                                  
                                </div>
                               
                                <div class="icon">
                                    <i class="ion ion-briefcase"></i>
                                </div>
                                <a href="<?php echo base_url('Inventory_stocks/report_inventory_stocks'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
					 
						
					
						
						
                    </div><!-- /.row -->
				<?php } ?><!---End of Display Only For Admin-->  
				     <!-- Small boxes (Stat box) -->
                   
					
                    
                    




               
						
						
						
							
                     
                  



                  

  </div><!-- /.row -->

                </section><!-- /.content -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Morris.js charts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/morris/morris.min.js" type="text/javascript"></script>


    <script>
        Morris.Area({
            element: 'areaSales',
            data: <?php echo $salesGraphJson; ?>,
            parseTime: false,
            xkey: 'm',
            ykeys: ['amount'],
            labels: ['Sales Amount']
        });
    </script>



