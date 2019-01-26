
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>


<!-- List content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Event</th>
                                <th>Location</th>
								 <th>Event Date</th>
                                 <th>Status</th>
                                  <th>Seats</th>
                                  <th>Sponsored?</th>
                                   <th>Joined Date</th>
                             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>Event</th>
                                <th>Location</th>
								 <th>Event Date</th>
                                 <th>Status</th>
                                  <th>Seats</th>
                                   <th>Sponsored?</th>
                                   <th>Joined Date</th>
                            </tr>
                        </tfoot>

                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<!-- Form content -->

<!--Popup --->

<!-- -->
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
                    "ajax": "<?php echo base_url('Event_management/joined_eventsListJson'); ?>"
                });
            });

    </script>

<?php } ?>

