
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
                    <h3 class="box-title">All Events</h3>
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Action</th>
                                 <th>Status</th>
                                <th>Event</th>
                                <th>Name </th>
								 <th>Budget</th>
                                 <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Requested By</th>
                                <th>Requested At</th>
                                
                             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Event</th>
                                <th>Name </th>
								<th>Budget</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Requested By</th>
                                <th>Requested At</th>
                            </tr>
                        </tfoot>

                    </table>
                     <?php echo form_open_multipart('', ['approve' => 'form', 'class' => 'form-horizontal']); ?>
               <button type="submit" name="submit" value="csv" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Export to CSV </button>
                <button type="submit" name="submit" value="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Export to PDF </button>
                 </form>
               
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
                    "ajax": "<?php echo base_url('Event_management/Event_requestListJson'); ?>"
                });
            });

    </script>

    <script>
		/*$('body').on('click', 'a.deleteBtn', function () {
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you sure?'); //confirm

            if (verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php// echo base_url('Event_management/deleteAjax') ?>",
                    data: {id: agentId},
                })
                        .done(function (msg) {
                            currentItem.closest('tr').hide('slow');
                        });
            }
        });*/
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

