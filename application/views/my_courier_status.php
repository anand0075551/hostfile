<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>


<?php foreach($cid->result() as $sts); ?>
<!-- Main content -->
<section class="content">
	
	<div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Reciever </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table" align="center">

						<tr>
							<td><b>Name</b></td>
							<td><?php echo $sts->rev_name; ?></td>
						</tr>
						<tr>
							<td><b>Phone</b></td>
							<td><?php echo $sts->r_phone; ?></td>
						</tr>
						<tr>
							<td><b>Pincode</b></td>
							<td>
							<?php 
								$pin = $sts->receiver_pincode;
								$query = $this->db->get_where('pincode', ['id' => $pin]);
								foreach($query->result() as $row)
								{
									echo $row->pincode;
								}
							?>
							
							</td>
						</tr>
						<tr>
							<td><b>Address</b></td>
							<td><?php echo $sts->r_add; ?></td>
						</tr>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>





    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Courier Status </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th width="20%">Date</th>
                            <th width="20%">Location</th>
							<th width="20%">Status</th>
						
							<th width="20%">Comments</th>
							<th width="20%">Currently With</th>
						</tr>
                        </thead>
						
						<tbody>
							<?php
								$id = $sts->cons_no;
								$query = $this->db->get_where('cms_courier_status', ['cons_no' => $id]);
								foreach($query->result() as $row)
								{
									echo "<tr>";
									           
									echo "<td>".date('d M-Y h:i:s A', $row->modified_at)."</td>";
									echo "<td>".$row->current_location."</td>";
									
									$query3 = $this->db->get_where('status', ['id' => $row->status,]);
																if ($query3->num_rows() > 0) {
																foreach ($query3->result() as $row3) {
																	$status = $row3->status;
																}
																} else {
																    $status =  "NO DATA";
																}
									echo "<td>".$status."</td>";
									
									
									
									
									
										
									echo "<td>".$row->comments."</td>";
									?>
									<td>
										<?php
											
											$user_id = $row->done_by;
											$query = $this->db->get_where('users', ['id' => $user_id]);
											foreach($query->result() as $row)
											{
												echo $row->first_name." ".$row->last_name."( ".$row->contactno." )";
											echo	"<br>";
									$query = $this->db->get_where('role', ['id' => $row->rolename,]);
									if ($query->num_rows() > 0) {
									foreach ($query->result() as $row) {
									$pm = $row->rolename;
									}
									} else {
									$pm =  " ";
									}
												echo $pm;
											}
										?>
									</td>
									<?php
									
									echo "</tr>";
								}
								
							?>
						</tbody>
                        
						<tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Location</th>
							<th>Status</th>
							
							<th>Comments</th>
							<th>Currently With</th>
						</tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
				                      <div class="box-footer">
                                        
										<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    </div>
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <!-- <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "< ?php echo base_url('courier/view_courier_status'); ?>"
            });
        });

    </script> -->

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('courier/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });


  


</script>


<?php } ?>

