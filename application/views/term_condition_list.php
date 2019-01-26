
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
                    
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body table-responsive no-padding">
                
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Term ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Valid From</th>
                                <th>Valid To</th>
                                <th>Status</th>
                                <th>OTP</th>
                                <th>Created By </th>
								<th>Created At</th>
                              </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>Term ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Valid From</th>
                                <th>Valid To</th>
                                <th>Status</th>
                                <th>OTP</th>
                                <th>Created By </th>
								<th>Created At</th>
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
                    "ajax": "<?php echo base_url('Term_condition/ListJson'); ?>"
                });
            });

    </script>


<?php } ?>

