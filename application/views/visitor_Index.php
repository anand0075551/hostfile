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
                    <h3 class="box-title">Visitors Entry Details</h3>
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="100px">Action</th>
								<th> Visitor Name </th>
                                <th> Type Of Id </th>
                                <th> Proof Number</th>
                                <th>Communication Id / Email</th>
								<th>Purpose</th>
								<th>From Place</th>
								<th>refferer</th>
								<th>Whoom To Meet</th>
								<th>Mobile Number</th>
								<th>Remarks</th>
								<th>Custom 1</th>
								<th>Custom 2</th>
								<th>Custom 3</th>
								<th>Custom 4</th>
								<th>Custom 5</th>
								
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="100px">Action</th>
								 <th> Visitor Name </th>
                                <th> Type Of Id </th>
                                <th> Proof Number</th>
                                <th>Communication Id / Email</th>
								<th>Purpose</th>
								<th>From Place</th>
								<th>refferer</th>
								<th>Whoom To Meet</th>
								<th>Mobile Number</th>
								<th>Remarks</th>
								<th>Custom 1</th>
								<th>Custom 2</th>
								<th>Custom 3</th>
								<th>Custom 4</th>
								<th>Custom 5</th>
								
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
                    "ajax": "<?php echo base_url('Visitor_entry/visitor_entryListJson'); ?>"
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
                    url: "<?php echo base_url('Visitor_entry/deleteAjax') ?>",
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

