
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
                    <h3 class="box-title">Company(Business) Loan Schemes List</h3>
                </div><!-- /.box-header -->
				
			
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
						<div class="row">
							<div class="col-md-12">
								<thead>
									<tr>
										<th>Loan Type</th>       
										<th>Name</th>       										
										<th>Value</th>
										<th>Conditions</th>
										<th>Valid From</th>																				
										<th width="20%">Action</th>
									</tr>
								</thead>
							</div>
						</div>
<!-- Data is fetching from	app/controller/bank.php 
public function businessLoansListJson()-->
						<div class="row">
							<div class="col-md-12">
								<tfoot>
									<tr>
										<th>Loan Type</th>       
										<th>Name</th>       										
										<th>Value</th>
										<th>Conditions</th>
										<th>Valid From</th>					
										<th>Action</th>
									</tr>
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
                "ajax": "<?php echo base_url('bank/businessLoansListJson'); ?>"
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
                url: "<?php echo base_url('bank/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>


<?php } ?>

