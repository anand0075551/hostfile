<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <!--<h3 class="box-title">Events</h3>-->
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php if(!empty($events)) { ?>
				<?php
				$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		?>
                    <table id="example" class="table table-bordered table-striped table-hover">
<!-- ***** check sams_02\application\controllers\User.php Line no 140 for chnaging data retrieval values ***** -->
                        <thead>
                        <tr>
							<th>Action</th>
                            <th>Event No.</th>
                            <th>Event Location</th>
                            <th>Created By</th>
                            <th>Product</th>
							<th>Users</th>
                           <!-- <th>Event Date</th>-->
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
						<tbody>
                        <?php 
						if(!empty($events)): foreach($events as $event): ?>
                        <tr>
                       <?php 
					    $get_product_name = $this->db->get_where('smb_product', ['id'=>$event['product']]);
                            foreach($get_product_name->result() as $p);
                             $product = $p->title;
							
					    $button = '';
					   $eno=$event['event_no'];
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bidding/bidding_event_view/'. $eno).'" data-toggle="modal" title="View">
						<i class="fa fa-eye"></i> </a>';?>
                        
                        <td><?php echo $button ;?></td>
                        <td><?php echo $event['event_no'] ?></td>
                        <td><?php echo $event['location'] ?></td>
                        <td><?php echo  singleDbTableRow($event['created_by'])->first_name.' '.singleDbTableRow($event['created_by'])->last_name ;?></td>
                        <td><?php echo $product ?></td>
                        <td><?php 
						
						$selected_users = rtrim($event['users'],", ");
						$users = '';
						$explode_users = explode(',',$selected_users);
						 foreach($explode_users as $usrs)
						 {
							 $users =singleDbTableRow($usrs, 'users')->first_name.' '.singleDbTableRow($usrs, 'users')->last_name.','. $users;
						 }
						 echo $users;
						 ?></td>
                       <!-- <td><?php// echo $event['event_date'] ?></td>-->
                        <td><?php echo $event['start_time'] ?></td>
                         <td><?php echo $event['end_time'] ?></td>
                          <td><?php echo $event['status'] ?></td>
                        </tr>
                        <?php endforeach; endif; ?>
                        </tbody>
                        <tfoot>
                        <tr>
						 <th>Action</th>
                            <th>Event No.</th>
                            <th>Event Location</th>
                            <th>Created By</th>
                            <th>Product</th>
							<th>Users</th>
                            <!--<th>Event Date</th>-->
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>

                    </table>
					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <?php } else { echo 'No events ';}?>
<div class="container">

  <!-- Trigger the modal with a button -->


  <!-- View Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>Slow Internet please wait.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
 <!-- Approve Modal -->
  
</div> 
</section><!-- /.content -->

<?php function page_js(){ ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('user/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });


    $('body').on('click', 'button.blockUnblock', function () {
        var agentId = $(this).attr('id');
        var buttonValue = $(this).val();
        //alert(buttonValue);
        //set type of action
        var currentItem = $(this);
        if(buttonValue == 1){
            var status = 'Unblocked';
        }else if(buttonValue == 2){
            var status = 'Blocked';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('user/setBlockUnblock') ?>",
            data: {id: agentId, buttonValue : buttonValue, status : status}
        })
        .done(function (msg) {
            if(buttonValue == 1){
                currentItem.removeClass('btn-success');
                currentItem.addClass('btn-warning');
                currentItem.html('<i class="fa fa-lock"></i>');
                currentItem.attr( 'title','Block');
                currentItem.val(2);
            }else if(buttonValue == 2){
                currentItem.removeClass('btn-warning');
                currentItem.addClass('btn-success');
                currentItem.html('<i class="fa fa-unlock-alt"></i>');
                currentItem.attr( 'title','Unblock');
                currentItem.val(1);
            }
        });
    });



</script>


<?php } ?>

