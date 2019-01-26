<?php
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
                    <h3 class="box-title">Transaction List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered">
					<div class="col-md-12">
                        <tr>
                            <th>Company Wealth</th>
                            <th>Total Debits</th>
                            <th>Total Credits</th>
							<th>Total Assets</th>
                            
                        </tr>
                        <tr>
                          <td>
                              <?php  echo amountFormat($balancecash); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($debits); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($credits); ?>
                            </td>
                            <td>
                                 <?php  echo amountFormat($assets); ?> 
                            </td>
                            

							</tr>
							</div>
						</table>                  
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

		 <!-- form start -->
				
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>		
<!--
					<table id="deposit" class="table table-bordered table-striped table-hover">
					<div class="form-group < ?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Main Account/Category Type</label>
                            <div class="col-md-9">
												<!-- info row -- >
							  <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                                            
									<select name="acct_id" class="form-control">
										<option value=""> Select Main Account </option>
												< ?php foreach($ledger1->result() as $ledger){
													echo '<option value="'.$ledger->id.'">'.$ledger->name.'</option>';
												}                                        
												?>
										</select>
                                   </div>
                              </div><!-- /.row -- >		
							      < ?php echo form_error('acct_id') ?>
							    </div>
                        </div>  						
						</table> 
		
						
					<table id="deposit" class="table table-bordered table-striped table-hover">
					<div class="form-group <?php if(form_error('pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub-Account/Pay Specification</label>
                            <div class="col-md-9">
												<!-- info row -- >
							  <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                                            
									<select name="pay_type" class="form-control">
										<option value=""> Select Sub-Account </option>
												<?php foreach($ledger2->result() as $ledger){
													echo '<option value="'.$ledger->id.'">'.$ledger->name.'</option>';
												}                                        
												?>
										</select>
                                   </div>
                              </div><!-- /.row -- >		
							      <?php echo form_error('pay_type') ?>
							    </div>
                        </div>  						
						</table>					
					
						<div class="box-footer">
                        <button type="submit" name="submit" value="payspec_accounts" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Summary
                        </button>
                    </div>
						
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

		<input type="button" value="export" onClick="excelData()"/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pay Specifications Accounts Transaction</h3>
                </div><!-- /.box-header -->
                <div id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
						<div class="row">
							<div class="col-md-12">
								<thead> <div class="col-md-12">
									<tr>
										<th>Action</th>
										<th>Pay Spec's</th>                           
										<th>Total Debit</th>
										<th>Total Credit</th>											
										<th>Balance </th>														
										
										
									</tr> </div>
								</thead>
							</div>
						</div>
<!-- Data is fetching from	app/controller/ledger.php 
public function payspecListJson()-->
						<div class="row">
							<div class="col-md-12">
                        <tfoot><div class="col-md-12">
									<tr>
										<th>Action</th>
										<th>Pay Spec's</th>                           
										<th>Debit</th>
										<th>Credit</th>											
										<th>Amount</th>															
										
									</tr></div>
                        </tfoot>
						</div>
						</div>
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
              //  "ajax": "<?php echo base_url('ledger/ledgerListJson'); ?>"
				"ajax": "<?php echo base_url('ledger/payspecListJson'); ?>"
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
                url: "<?php echo base_url('ledger/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });
	
	function excelData() {
		alert("hi");
                                                var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
                                                location.href = url;
                                                return false;
                                            }

</script>


<?php } ?>

