
<?php

function page_css() { ?>
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
                    <h3 class="box-title">All Voucher Permission List</h3>
                </div><!-- /.box-header -->
				<div class="row" style="padding:10px;">
					<div class="col-lg-12 text-right" style="padding-right:40px;">
						<a class="btn btn-success" href="<?php echo base_url('Voucher_permission/add_voucher_permission') ?>" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Permission</a>
					</div>
				</div>
                <div  id="excel_table" class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="12%">Action</th>                         
                                <th width="10%">Vocher Name</th>                            
                                <th width="10%">Business Name</th>                            
                                <th width="10%">Pay Type</th>
                                <th width="10%">Pay Type To</th>
                                <th width="10%">For Role</th>
                                <th width="10%">Percentage</th>
                                <th width="10%">Splits</th>
                                <th width="10%">Type</th>
                                <th width="10%">Start Date</th>
                                <th width="10%">End Date</th>
                               

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                              
                                <th>Action</th>                              
                                <th>Vocher Name</th>                            
                                <th>Business Name</th>                            
                                <th>Pay Type</th>
                                <th>Pay Type To</th>
                                <th>For Role</th>
                                <th>Percentage</th>
                                <th>Splits</th>
								<th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<div class="box-footer" align="center">
   

</div>

<?php

function page_js() { ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(function () {
                $("#example").dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('Voucher_permission/VoucherListJson'); ?>"
                });
            });

    </script>

    <script>

        $('body').on('click', 'a.deleteBtn', function () {
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you sure?'); //confirm

            if (verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Voucher_permission/deleteAjax') ?>",
                    data: {id: agentId},
                })
                        .done(function (msg) {
                            currentItem.closest('tr').hide('slow');
                        });
            }
        });

    </script>
    <script>

        function excelData() {
            alert("Hello, Press OK to download...");
            var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
            location.href = url;
            return false;
        }

    </script>


<?php } ?>

