
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
                    <h3 class="box-title">User Address List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th> Action </th>

                                <th>Address Type</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>District</th>

                                <th>Location</th>
                                <th>pincode</th>
                                <th>House/Building No</th>
                                <th>Street Name</th>
                                <th>Land Mark</th>

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Address Type</th>
                                <th>Referral Id</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>District</th>

                                <th>Location</th>
                                <th>pincode</th>
                                <th>House/Building No</th>
                                <th>Street Name</th>
                                <th>Land Mark</th>

                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

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
                "ajax": "<?php echo base_url('user_address/userAddressListJson'); ?>"
            });
        });

    </script>




<?php } ?>

