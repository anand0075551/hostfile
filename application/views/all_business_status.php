
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
                    <h3 class="box-title">Status List</h3>
                </div><!-- /.box-header -->
                <div id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="20%">Action</th>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Business Name</th>
                                <th>To Role</th>
                                <th>Language</th>
                                <th>Status</th>

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th width="20%">Action</th>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Business Name</th>
                                <th>To Role</th>
                                <th>Language</th>
                                <th>Status</th>

                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<div class="box-footer" align="center">

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
                "ajax": "<?php echo base_url('Business_status/statusListJson'); ?>"
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
                    url: "<?php echo base_url('Business_status/deleteAjax5') ?>",
                    data: {id: agentId},
                })
                        .done(function (msg) {
                            currentItem.closest('tr').hide('slow');
                        });
            }
        });

    </script>
    <script>

        $('body').on('click', 'button.blockUnblock', function () {
            var agentId = $(this).attr('id');
            var buttonValue = $(this).val();
            //alert(buttonValue);
            //set type of action
            var currentItem = $(this);
            if (buttonValue == 1) {
                var status = 'Unblocked';
            } else if (buttonValue == 0) {
                var status = 'Blocked';
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Business_status/setBlockUnblock') ?>",
                data: {id: agentId, buttonValue: buttonValue, status: status}
            })
                    .done(function (msg) {
                        if (buttonValue == 1) {
                            currentItem.removeClass('btn-success');
                            currentItem.addClass('btn-warning');
                            currentItem.html('<i class="fa fa-lock"></i>');
                            currentItem.attr('title', 'Block');
                            currentItem.val(0);
                        } else if (buttonValue == 0) {
                            currentItem.removeClass('btn-warning');
                            currentItem.addClass('btn-success');
                            currentItem.html('<i class="fa fa-unlock-alt"></i>');
                            currentItem.attr('title', 'Unblock');
                            currentItem.val(1);
                        }
                    });
        });





    </script>


<?php } ?>

