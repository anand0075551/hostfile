
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
                    <h3 class="box-title">Outward Item List</h3>
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="100px">Action</th>
								 <th> Item Name </th>
                                <th> Type Of Item </th>
                                <th> Item Number</th>
                                <th>Invoice Id</th>
								<th>Purpose</th>
								<th>Item Value</th>
								<th>From Place</th>
								<th>To Whoom</th>
								<th>From Sender</th>
								<th>Mobile Number</th>
								<th>Remarks</th>
								<th>Created At</th>
								<th>Created By</th>
								<th>Modified At</th>
								<th>Modified By</th>
								
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="100px">Action</th>
								 <th> Item Name </th>
                                <th> Type Of Item </th>
                                <th> Item Number</th>
                                <th>Invoice Id</th>
								<th>Purpose</th>
								<th>Item Value</th>
								<th>From Place</th>
								<th>To Whoom</th>
								<th>From Sender</th>
								<th>Mobile Number</th>
								<th>Remarks</th>
								<th>Created At</th>
								<th>Created By</th>
								<th>Modified At</th>
								<th>Modified By</th>
								
                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<div class="box-footer" align="center">
    <button name="submit" class="btn btn-warning" value="export" onClick="excelData(this)">
        <i class fa fa-credit-card"></i> Download Details </button>
    <br>
    <br>

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
                    "ajax": "<?php echo base_url('Visitor_entry/outward_itemListJson'); ?>"
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
                    url: "<?php echo base_url('Visitor_entry/deleteAjaxoutward') ?>",
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
            alert("Download...?");
            var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
            location.href = url;
            return false;
        }

    </script>-->


<?php } ?>

