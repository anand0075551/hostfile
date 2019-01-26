<?php



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
                    <h3 class="box-title">Your Referrral User's Accounts Balance Sheet</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

            
			
					<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transaction Statement</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th>Date & Time </th>                           
                            <th>Name</th>
							<th>Invoice Id</th>
							<th>MyFair's Account No</th>
                            <th>Amount</th>							
                            <th>Points Mode</th>								
                            <th>Transaction Remarks</th>                            
                        </tr>
                        </thead>
<!-- Data is fetching from	app/controller/account.php 
public function userAccountListJsony()-->
                        <tfoot>
                        <tr>
                            <th>Date & Time </th>                           
                            <th>Name</th>
                            <th>Invoice Id</th>
							<th>MyFair's Account No</th>
                            <th>Amount</th>							
                            <th>Points Mode</th>								
                            <th>Transaction Remarks</th>
                        </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
						
                </div><!-- /.box-body --><br> <br> 
				<div class="box-footer">
						
											         
					
                        <button  name="submit"  class="btn btn-primary">
                            <i class="fa fa-credit-card"></i> Download Statement
                        </button>
                    </div>
					
					
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
                "ajax": "<?php echo base_url('account/commissionListJson'); ?>"
			//	"ajax": "<?php echo base_url('account/ledgerListJson'); ?>"
            });
        });

    </script>

<?php } ?>

