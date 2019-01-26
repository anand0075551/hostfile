<?php
$ref_count = $this->ledger_model->referralListCount();


foreach( $debits->result() as $debits);
foreach($credits->result() as $credits);
foreach($wallet->result() as $wallet);
foreach($usedwallet->result() as $usedWallet);  //wallet_converted 

 $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
			foreach($ledgerDebit->result() as $ledgerDebit); 
			$totalDebits = $ledgerDebit->debit; 
			
			foreach($ledgerCredit->result() as $ledgerCredit); 
			$totalCredits = $ledgerCredit->credit; 

			$amount = $totalDebits - $totalCredits;
		}

$totalDebits = $debits->debit; 
$totalCredits = $credits->credit; 
$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;  

 $debits = $totalDebits	;   //Total Debits
 $credits = $totalCredits;  //Total Credits
 

 
$wallet  = $totalWallet;   //Company Wealth - Available cash funds
$usedwallet = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet ;
//$balancecash = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet
$balancecash = ($debits + $credits) ; //Cash Points = Company Wealth - Converted wallet



?>
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">My Referral Index List</h3>
                </div><!-- /.box-header -->
 
        </div>
    </div>

</section><!-- /.content -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
<!--
		 <div class="callout callout-info">
                <h4>Note: To search an User, please place User Name into search box.</h4>
            </div>
-->			
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">My Referral List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
				<div class="row">
					<div class="col-md-12">
                            <tr>
							<th width="20%">Action</th>
                            <th>Name</th>  
							<th>Status</th>								
                            <th>Email</th>							
                            <th>Role Name</th>	
                            <th>Phone</th>
                            <th>Referral Code</th>	
													
                            
                        </tr>
                        </thead>
						</div>
						</div>
<!-- Data is fetching from	app/controller/Account.php 
public function referralListJson()-->
                        <tfoot>
                       <div class="row">
					<div class="col-md-12">
                            <tr>
							<th>Action</th>
                            <th>Name</th>  
							<th>Status</th>								
                            <th>Email</th>							
                            <th>Role Name</th>	
                            <th>Phone</th>
                            <th>Referral Code</th>	
														
							
                        </tr>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
                        </tfoot>

                    </table>
					  
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('account/referralListJson'); ?>"
            });
        });

    </script>

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('account/deleteCommission') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });
$('body').on('click', 'button.blockUnblock', function () {
 window.location.reload();
        var agentId = $(this).attr('id');
        var buttonValue = $(this).val();
        //alert(buttonValue);
        //set type of action
        var currentItem = $(this);
        if(buttonValue == 1){
            var status = 'Unblocked';
        }else if(buttonValue == 2){
            var status = 'Blocked';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('account/setBlockUnblock') ?>",
            data: {id: agentId, buttonValue : buttonValue, status : status}
        })
        .done(function (msg) {
            if(buttonValue == 1){
                currentItem.removeClass('btn-success');
                currentItem.addClass('btn-warning');
                currentItem.html('<i class="fa fa-lock"></i>');
                currentItem.attr( 'title','Block');
                currentItem.val(2);
            }else if(buttonValue == 2){
                currentItem.removeClass('btn-warning');
                currentItem.addClass('btn-success');
                currentItem.html('<i class="fa fa-unlock-alt"></i>');
                currentItem.attr( 'title','Unblock');
                currentItem.val(1);
            }
        });
    });

</script>


<?php } ?>

