<?php function page_css(){ ?>
    <!-- datatable css -->
     <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-header">
					
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
							<th width="15%">Action</th>
                            <th width="15%">Invoice ID</th>
                            <th width="15%">Date</th>
                            <th width="15%">Products</th>                            
                            <th width="15%">Total</th>
                            <th width="15%">Delivery Status</th>                            
                            
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
							<th>Action</th>
                            <th>Invoice ID</th>
                            <th>Date</th>
                            <th>Products</th> 
                            <th>Total</th>
                            <th>Delivery Status</th>                            
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<div class="modal fade" id="token_box" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding-bottom:15px; padding-top:25px; padding-left:25px; padding-right:25px; border-radius:10px; margin-top:50px;">
		</div>
	</div>
</div>


<?php function page_js(){ ?>



    <!-- DATA TABES SCRIPT -->
   <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
				"paging": true,
				"ordering": true,
				"ajax": "<?php echo base_url('lpa_purchase_redeem/saleListJson'); ?>"
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
                url: "<?php echo base_url('agent/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>


<?php } ?>

