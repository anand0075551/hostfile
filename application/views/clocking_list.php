
<?php
			$currentAuthDta = loggedInUserData();
			$currentUser = $currentAuthDta['role'];
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			$currentRolename = singleDbTableRow($user_id)->rolename;
			
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
                    <h3 class="box-title">Clock List</h3>
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Clock IN</th>
                                <th>Clock OUT</th>
                                <th>Total Hours</th>
			<?php	if($currentRolename == 11)	{	?>
								<th>Status</th>
								<th>System Ip</th>
			<?php } ?>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr> 
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Clock IN</th>
                                <th>Clock OUT</th>
                                <th>Total Hours</th>
<?php	if($currentRolename == 11){	?>
								<th>Status</th>
								<th>System Ip</th>
			<?php } ?>
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
                    "ajax": "<?php echo base_url('welcome/clockingListJson'); ?>"
                });
            });

    </script>



<?php } ?>

