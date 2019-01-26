
<?php function page_css(){ ?>
    <!-- datatable css -->
   <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="callout callout-info">
                <h4>Note: To search an invoice, please place invoice id into search box.</h4>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Invoice List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
				<div class="row">
					<div class="col-md-12">
                            <tr>
							<th width="20%">Action</th>
                                <th>Invoice ID</th>
                                <th>Receiver's Name</th>                               
                                <th>Sender's Name</th>
                                <th>Time</th>
                                
                            </tr>
                        </thead>
					</div>
					</div>
                        <tfoot>
						<div class="row">
					<div class="col-md-12">
                            <tr>
							<th>Action</th>
                                <th>Invoice ID</th>
                                <th>Receiver's Name</th>                               
                                <th>Sender's Name</th>
                                <th>Time</th>
                                
                            </tr>
                       
					</div>
					</div> </tfoot>
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
               "paging": true,
				"ordering": true,
                "ajax": "<?php echo base_url('lpa_purchase_redeem/invoiceListJson'); ?>"
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
                url: "<?php echo base_url('category/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>


<?php } ?>

