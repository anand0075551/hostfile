<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
<?php
$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser = singleDbTableRow($user_id)->role;
		$current_ref = singleDbTableRow($user_id)->referral_code;
		
?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Assigned Role</h3>
                </div><!-- /.box-header -->
				
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<div>
						<table id="example" class="table table-bordered table-striped table-hover print_div">
							<thead>
							<tr>
								<th>Date & Time</th>
								<th>Assigned By</th>
								<th>Assigned Role</th>
								<th>Assigned To</th>
								<th>Assigned Amount</th>
								<th>Chargeable Amount</th>
								<th>Confirmation</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th>Date & Time</th>
								<th>Assigned By</th>
								<th>Assigned Role</th>
								<th>Assigned To</th>
								<th>Requested Amount</th>
								<th>Chargeable Amount</th>
								<th>Confirmation</th>
							</tr>
							</tfoot>
						</table>
					</div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section><!-- /.content -->
<div class="box-footer" align="right">

</div>


<!---------------Accept role pop up------------------->
<div class="modal fade" id="accept_role" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:50px; margin-top:50px;">
 
		</div>
	</div>
</div>
<!--------------End_Accept role	--pop up------------>




<!--End Create Category -->
<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">
	$(function() {
		$("#example").DataTable({
		  "paging": true,
		  "destory": true,
		  "ordering": true,
		  "info": true,
			"ajax": "<?php echo base_url('Ref_info/assign_role_listjson'); ?>"
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
                url: "<?php echo base_url('Ref_info/cancel_role') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>

<?php } ?>

