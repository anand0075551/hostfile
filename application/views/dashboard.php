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
 foreach( $deposit->result() as $deposit);
  $totalDeposit = $deposit->debit; 
  foreach( $deposit2->result() as $deposit2);
  $totalDeposit2 = $deposit2->debit; 
   foreach( $deposit3->result() as $deposit3);
  $totalDeposit3 = $deposit3->debit; 
     foreach( $deposit4->result() as $deposit4);
  $totalDeposit4 = $deposit4->debit;
  foreach( $deposit5->result() as $deposit5);
  $totalDeposit5 = $deposit5->credit;
  
   $bal_cpa = ($totalDeposit - $totalDeposit2) ; //Total Assets = Total Debits - Total Credits
   
  //SMB Payment
  foreach( $smb_deposit->result() as $smb_deposit);
  $total_dep_smb = $smb_deposit->credit;
 
  //Restro Payment 
  foreach( $restro_deposit->result() as $restro_deposit);
  $total_dep_restro = $restro_deposit->credit;
  
  //Prepaid  Payment 
  foreach( $billpay_deposit->result() as $billpay_deposit);
  $total_dep_billpay = $billpay_deposit->credit;
   

   //Prepaid  Payment 
  foreach( $consumer_sponsorship->result() as $consumer_sponsorship);
  $consumer_sponsorship = $consumer_sponsorship->credit;
   
   //Joining_offers
  foreach( $joining_offers->result() as $joining_offers);
  $joining_offers = $joining_offers->debit;

 
 
 
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
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($totalDeposit); ?>
										</font>
                                    </h3>
                                    <p>
                                        Cash Deposit @ SBI Basava Nagar
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
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($totalDeposit2); ?>
										</font>
                                    </h3>
                                    <p>
                                        Cash Withdrawl @ SBI Basava Nagar
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
                                        <?php  echo amountFormat($bal_cpa); ?>
										</font>
                                    </h3>
                                    <p>
                                        Balance Cash @ SBI Basava Nagar
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
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($totalDeposit3); ?>
										</font>
                                    </h3>
                                    <p>
                                        Eligible CPA Request 
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
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($totalDeposit4); ?>
										</font>
                                    </h3>
                                    <p>
                                        Spent Promotional Offers
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
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($totalDeposit5); ?>
										</font>
                                    </h3>
                                    <p>
                                        Distributor Commission
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
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php  echo amountFormat($total_dep_smb); ?>
										</font>
                                    </h3>
                                    <p>
                                        SMB Payment to Company
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
                                        <?php   echo amountFormat($total_dep_restro); ?>
										</font>
                                    </h3>
                                    <p>  
                                        Restro Payment to Company
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
                                        <?php  echo amountFormat($total_dep_billpay); ?>
										</font>
                                    </h3>
                                    <p>  <font size="4" color=""> 
                                        Prepaid Recharge to Company 
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
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo amountFormat($consumer_sponsorship); ?>
										</font>
                                    </h3>
                                    <p>  <font size="4" color=""> 
                                        Consumer Sponsorship 
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
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php  echo amountFormat($joining_offers); ?>
										</font>
                                    </h3>
                                    <p>  <font size="4" color=""> 
                                        Joining Offers 
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
						
						
					
						
						
                    </div><!-- /.row -->
				<?php } ?><!---End of Display Only For Admin-->  
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
                                        Pre-paid Balance
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
				
                   
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                        <?php   ?> Voucher Points
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
						
					</div><!-- /.row -->
					
                    
                    




               
						
						
						
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

  </div><!-- /.row -->

                </section><!-- /.content -->


<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Morris.js charts -- >
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="< ?php echo base_url('assets/admin'); ?>/js/plugins/morris/morris.min.js" type="text/javascript"></script>


    <script>
        Morris.Area({
            element: 'areaSales',
            data: < ?php echo $salesGraphJson; ?>,
            parseTime: false,
            xkey: 'm',
            ykeys: ['amount'],
            labels: ['Sales Amount']
        });
    </script> -->

 <?php 
	$currentAuthDta = loggedInUserData();
	$currentUser = $currentAuthDta['role'];
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentRolename = singleDbTableRow($user_id)->rolename;
	$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
	?>
  <!--Terms & conditions -->
  <?php
  $today = date('Y/m/d');
  $where_array = " role = ".$currentRolename." AND status = 20 AND DATE(valid_from) <= '".$today."' AND DATE(valid_to) >= '".$today."' ";
  //$where_array = " role = ".$currentRolename." AND status = 20 ";
  $terms = $this->db->order_by('id', 'asc')->where($where_array)->get('term_condition');
  if($terms->num_rows() >0)
  {
	  foreach ($terms->result() as $t);
	  $valid_from = $t->valid_from;
	  $valid_to = $t->valid_to;
	  $file_data = $t->file_data;
	  $file_name = $t->file_name;
	  $otp = $t->otp;
	  $term_ID = $t->term_ID;
	  
	  $where_array2 = " user_id = ".$user_id." AND role = ".$currentRolename." AND DATE(read_at) >= DATE('".$valid_from."') AND DATE(read_at) <= DATE('".$valid_to."') AND terms_read =1 ";
  	  $user_terms = $this->db->order_by('id', 'asc')->where($where_array2)->get('term_condition_user');
	  if($user_terms->num_rows() >0)
	  {
  ?>
 
  <!-- Ramesh -->
<?php
$alert1 = $this->db->get('dashbord');
foreach ($alert1->result() as $r1) {
    $g1 = $r1->status;
}
//	echo $g1;

if ($g1 == 1) {
    ?>
    <div id="myModal1" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="background-color:<?php
        $color = $this->db->get('dashbord');
        foreach ($color->result() as $c) {
            echo $c->color;
        }
        ?>;>
             <!--  <div class="modal-content" style="background-image:url('./uploads/popup/cards10.png'); height:550px; width:460px;>-->
             <div class="modal-content" >
                <div class="modal-header" style="border-bottom: solid black 1px;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" align="center"><?php
                        //echo $c1;

                        $alert2 = $this->db->get_where('dashbord', ['status' => '1']);
                        foreach ($alert2->result() as $r2) {
                            echo $g2 = $r2->templet_name;
                        }
                        ?></h4>
                </div>
                <div class="modal-body" >
                             <!--<img id="my_img" src="cards10.png" class="img-thumbnail"  width="30%" height="60%">-->
                    <!--	< ?php echo $last_log."---".$today; ?> -->
                    <?php
					
                    $alert = $this->db->get_where('dashbord', ['status' => '1']);

                    foreach ($alert->result() as $r) {
                        echo "<h2> $r->title    </h2>";
                        echo "<p>  $r->content  </p>";
                    }
                    ?>
                    <button type="button" class="btn btn-default" align ="center" data-dismiss="modal">Ok</button>

                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Ramesh -->
<?php } else { ?>
<div id="myModal1" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" >
             <div class="modal-content" >
                <div class="modal-header" style="border-bottom: solid black 1px;">
                    <h4 class="modal-title" align="center"><?php echo $file_name;?></h4>
                </div>
                <div class="modal-body" >
                
                    <?php 
					$labels = $this->db->order_by('id','desc')->get_where('term_condition_labels', ['term_ID' => $term_ID]);
					if($labels ->num_rows() >0)
					{
						$replace  = '';
						$find     = '';
						$string = $t->file_data;
						foreach ($labels->result() as $l) 
						{ 
							 
							$field = $l->t_field;
							$field_value =  singleDbTableRow($user_id)->$field;
							$string   = str_replace($l->t_label,$field_value,$string);
						 	
						}
							
					 } 
					 else
					 { 
					 
						$string = $t->file_data;
					 }
					echo $string;
					?>
                    <?php if($otp ==1) { ?>
                    <button type="button" class="btn btn-primary" align ="center"  onClick="send_otp();"  id="snd_otp">Get OTP</button>
                    <button type="button" class="btn btn-success" align ="center" data-dismiss="modal" onClick="accept_terms();" style="display:none" id="done">Accept</button>
 					<?php } else { ?>
                    <button type="button" class="btn btn-success" align ="center" data-dismiss="modal" onClick="accept_terms();">Accept</button>
                    <?php } ?>
                    <a href="<?php echo base_url('dashboard/logout') ?>" class="btn btn-default btn-flat"> Decline</button></a>
                </div>
            </div>
        </div>
    </div>
      <?php }}?>
      <!--OTP -->
      <div id="myModal2" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" >
             <div class="modal-content" >
                <div class="modal-header" style="border-bottom: solid black 1px;">
                    <h4 class="modal-title" align="center">Enter OTP</h4>
                </div>
                <div class="modal-body" >
                    <input type="text" name="user_otp" id="user_otp" class="form-control">
                    <br><br>
                     <button type="button" class="btn btn-primary" align ="center"  onClick="check_otp();">Enter</button>
                </div>
            </div>
        </div>
    </div>
      <!-- /.OTP -->
 <!--/.Terms & conditions -->
   
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


<script type="text/javascript">
	$(document).ready(function(){
		$("#myModal1").modal('show');
	});
</script>
<script>
function send_otp()
{
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Dashboard/send_otp') ?>",
		success: function (response) {
			 $("#myModal2").modal('show'); 
		}
		
	}); 
}
</script>
<script>
	function check_otp()
{
	var otp = document.getElementById('user_otp').value;
	var mydata = {"otp": otp};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Dashboard/check_otp') ?>",
		data: mydata,
		success: function (response) {
			
			if(response == 1)
			{
				$("#myModal2").modal('hide'); 
				$('#done').show();
				$('#snd_otp').hide();
			}
			else
			{
				 document.getElementById('user_otp').value='';
				alert('Invalid OTP..Try again');
			}
		}
	});   
}

</script>

<script>
function accept_terms()
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('Dashboard/accept_terms') ?>",
        success: function (response) {
            //alert(response);
            location.reload();
        }

    });
}
</script>



