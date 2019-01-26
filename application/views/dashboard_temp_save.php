
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
 
 foreach( $assets->result() as $assets);
foreach( $debits->result() as $debits);
foreach($credits->result() as $credits);
foreach($wallet->result() as $wallet);
foreach( $usedwallet->result() as $usedWallet);  //wallet_converted 

 $totalAssets = $assets->amount; 
 $totalDebits = $debits->debit; 
$totalCredits = $credits->credit; 
$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;  

 $debits = $totalDebits	;   //Total Debits
 $credits = $totalCredits;  //Total Credits
 $assets = ($debits - $credits) ; //Total Assets = Total Debits - Total Credits
$wallet  = $totalWallet;   //Company Wealth - Available cash funds
$usedwallet = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet ;
//$balancecash = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet
$balancecash = ($debits + $credits) ; //Cash Points = Company Wealth - Converted wallet
} ?>

<?php
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($withdrawal->result() as $withdraws);


$totalEarning = $earning->amount;
$refEarning = $referralEarning->amount;
$withdraw = $withdraws->amount;

$rowEarning = $totalEarning - $refEarning;
$credit     = $totalEarning - $withdraw;

/* Standard data Retrieval*/
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

$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;


$loggedInUser = loggedInUserData();
?>

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

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($assets); ?>
										</font>
                                    </h3>
                                    <p>
                                        Company Assets
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo base_url('ledger'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						  <div  class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div   class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php   echo amountFormat($debits); ?>
										</font>
                                    </h3>
                                    <p>  
                                        Company Debits
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('ledger'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo amountFormat($credits); ?>
										</font>
                                    </h3>
                                    <p>  <font size="4" color=""> 
                                        Company Credits
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('ledger'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($balancecash); ?>
										</font>
                                    </h3>
                                    <p>
                                        Company Wealth
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('ledger'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						                       <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($wallet); ?>
										</font>
                                    </h3>
                                    <p>
                                        Wallet-Cash in Company
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('ledger'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
				<?php } ?><!---End of Display Only For Admin-->  
				
				
				
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo $rowEarning; ?> Points
										</font>
                                    </h3>
                                    <p>
                                        Total Benefits Points
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('vouchers/business_voucher_index'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo $rowEarning; ?> Points
										</font>
                                    </h3>
                                    <p>
                                        Total Commission Points
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('vouchers/business_voucher_index'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo $rowEarning; ?> Points
										</font>
                                    </h3>
                                    <p>
                                        Available Business Voucher's List
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('vouchers/business_voucher_index'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo $refEarning; ?> Points
										</font>
                                    </h3>
                                    <p>
                                        Self/Private Generated Voucher's List
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo base_url('vouchers'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						
						
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo $loyality_balance; ?> Points
										</font>
                                    </h3>
                                    <p>
                                        Loyality Total Earnings
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('category/wallet_to_discount'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo $discount_balance; ?> Points
										</font>
                                    </h3>
                                    <p>
                                        Discount Total Earnings
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('category/wallet_to_discount'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->




                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo amountFormat($wallet_balance); ?>
										</font>
                                    </h3>
                                    <p>
                                        Balance Wallet-Cash
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-cart-outline"></i>
                                </div>
                                <a href="<?php echo base_url('category/wallet_to_discount'); ?>" class="small-box-footer">
							<!--	<a href="<?php echo base_url('account/withdrawal_payment'); ?>" class="small-box-footer"> -->
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php echo $totalInvoice; ?>
										</font>
                                    </h3>
                                    <p>
                                        <?php
                                            if($loggedInUser['role'] == 'admin')
                                            {
                                                echo 'Total Invoice';
                                            }
                                            elseif($loggedInUser['role'] == 'agent')
                                            {
                                                echo 'Total Sales Invoice';
                                            }
                                            elseif($loggedInUser['role'] == 'user')
                                            {
                                                echo 'Total Purchase Invoice';
                                            }

                                        ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-briefcase-outline"></i>
                                </div>
                                <a href="<?php echo base_url('product'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php if($loggedInUser['role'] == 'admin') { ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php echo $totalAgent; ?>
										</font>
                                    </h3>
                                    <p>
                                        Total Agents
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-alarm-outline"></i>
                                </div>
                                <a href="<?php echo base_url('agent'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php echo $totalUser; ?>
										</font>
                                    </h3>
                                    <p>
                                        Total Users
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-pricetag-outline"></i>
                                </div>
                                <a href="<?php echo base_url('user'); ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php } ?>

                    </div><!-- /.row -->



                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Cash Turnover <?php echo date('Y'); ?></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <div id="areaSales" style="height: 300px;"></div>
                                </div>
                            </div><!-- /.nav-tabs-custom -->
                        </section>
                    </div>



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



