<?php function page_css(){ ?>
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
 <?php
 $user = loggedInUserData();
$userID = $user['user_id'];
$currentRolename   = singleDbTableRow($userID)->rolename;
					
  if(!empty($event)): foreach($event as $view): ?>
  <a href="<?php echo base_url('bidding/bidding_event_report/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> </tr>
  <!-- EVENT DETAILS -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color:#3c8dbc"><strong>Event No: <?php echo $view['event_no'];?></strong> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table" align="center">
						
                        <tr>
							<td width="20%">Location</td>
							<td><?php $get_location_name = $this->db->get_where('pincode', ['id'=>$view['location']]);
                            foreach($get_location_name->result() as $l);
                            echo $location = $view['location'].'-'.$l->location.'-'.$l->pincode;?></td>
						<tr>
						<tr>
							<td width="20%">Created By</td>
							<td><?php echo  singleDbTableRow($view['created_by'])->first_name.' '.singleDbTableRow($view['created_by'])->last_name?></td>
						<tr>
							<td width="20%">Created At</td>
							<td><?php echo $timestamp=date('d/m/Y h:i A',$view['created_at']); ?></td>
						</tr>
						
						<tr>
							<td width="20%">Product</td>
							<td><?php echo $view['title']; ?></td>
						</tr>
                       <tr>
							<td width="20%">Users</td>
							<td><?php 
							$users=explode(',',$view['users']);
							foreach($users as $user )
							{
							echo singleDbTableRow($user)->first_name.' '.singleDbTableRow($user)->last_name.'<br>';
							}
							 ?></td>
						</tr>
                        <tr>
							<td width="20%">Start Time</td>
							<td><?php echo $view['start_time']; ?></td>
						</tr>
                        <tr>
							<td width="20%">End Time</td>
							<td><?php echo $view['end_time']; ?></td>
						</tr>
                        <tr>
							<td width="20%">Status</td>
							<td><?php if($view['status'] ==1) { echo 'Active';} else { echo 'Expired'; } ?></td>
						</tr>
                        <?php if($currentRolename != 39 && $currentRolename != 11){?>
                        <tr>
                        <td>&nbsp;</td>
                        <td><a href="<?php echo base_url('bidding/bidding_events/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a></td>
                        </tr>
                        <?php }?>
                    </table>
                   
                </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
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
</section><!-- /.content -->
<!-- ENDS -->
<!-- -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- users -->
            <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color:#3c8dbc"><strong>Users</strong> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <?php $cnt=1;  if(!empty($event_users)){?>
              <table id="example" class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Name</th>
                           <!-- <th>Email</th>-->
                            <th>Contact No:</th>                           
                            <th>Event name</th>	
						    <th>Bidding</th>
                            <th>Bidding Created At</th>	
                            <th>Buyer/Seller </th>							
                            <th>Approved</th>								
                            <th>Approved By</th> 
                            <th>Approved At</th>
                            <th>Amount</th>
                            <th>Total Quantity</th>
                            <th>Balance Quantity</th>  
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($event_users as $eusers) { ?>
                        <tr>
                        	<td><?php echo $cnt;?></td>
                            <td><?php echo  singleDbTableRow($eusers['user_id'])->first_name.' '.singleDbTableRow($eusers['user_id'])->last_name?></td>
                            <!--<td><?php// echo  singleDbTableRow($eusers['user_id'])->email;?></td>-->
                            <td><?php echo  singleDbTableRow($eusers['user_id'])->contactno;?></td>
                        	<td><?php echo $eusers['bidding_name'];?></td>
                            <td><?php echo $eusers['bidding_no'];?></td>
                            <td><?php  echo $timestamp=date('d/m/Y h:i A',$eusers['created_at']);?></td>
                            <td><?php echo $eusers['user_type'];?></td>
                            <td><?php  if($eusers['approved']==1){ echo 'Approved';}else { echo 'Pending';}?></td>
                           <td><?php  if($eusers['approved_by'] !=0) {echo  singleDbTableRow($eusers['approved_by'])->first_name.' '.singleDbTableRow($eusers['approved_by'])->last_name; }?></td>
                            <td><?php  echo $timestamp=date('d/m/Y h:i A',$eusers['approved_at']);?></td>
                            <td><?php echo $eusers['actual_amount'];?></td>
                            <td><?php echo $eusers['actual_quantity'];?></td>
                            <td><?php echo $eusers['quantity'];?></td>
                        </tr>
                        <?php $cnt ++; } ?>
                        </tbody>
                    </table>
                    <?php } else { echo 'no users'; }?>
                   
                </div><!-- /.box -->
			 </div><!--/.col (left) -->
        </div>
        <!-- users ends -->
        <!-- Chats -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color:#3c8dbc"><strong>Users Chats </strong></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <?php $cnt2=1;  if(!empty($users_chat)){?>
              <table id="example" class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Requested By</th>
                            <th>Requested Amount</th>
                            <th>Requested Quantity</th>
                            <th>Requested At</th>
                            <th>Freezed?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users_chat as $chats) { ?>
                        <tr>
                        	<td><?php echo $cnt2;?></td>
                            <td><?php echo $chats['requested_by'];?></td>
                            <td><?php echo $chats['requested_amount'];?></td>
                            <td><?php echo $chats['requested_quantity'];?></td>
                            <td><?php echo date('d/m/Y h:i A',$chats['requested_at']);?></td>
                            <td><?php
							if($chats['freez'] == 1)
							{
								echo 'Yes';
							}
							else
							{
								echo 'No';
							}
							?></td>
                           
                        </tr>
                        <?php $cnt2 ++; } ?>
                        </tbody>
                    </table>
                    <?php } else { echo 'no chats'; }?>
                   
                </div>
			 </div>
        </div>
        <!-- chats ends -->
        <!-- freez request -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color:#3c8dbc"><strong>Freez Requests </strong></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <?php $cnt3=1;  if(!empty($freez_request)){?>
              <table id="example" class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Freez ID</th>
                            <th>Requested By</th>
                            <th>Requested To</th>
                            <th>Requested Amount</th>
                            <th>Requested Quantity</th>
                            <th>Requested At</th>
                            <th>Request Accept?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($freez_request as $requests) { ?>
                        <tr>
                        	<td><?php echo $cnt3;?></td>
                            <td><?php echo $requests['freez_id'];?></td>
                            <td><?php echo $requests['requested_by'];?></td>
                            <td><?php echo $requests['requested_to'];?></td>
                           <td><?php echo $requests['requested_amount'];?></td>
                           <td><?php echo $requests['requested_quantity'];?></td>
                           <td><?php echo date('d/m/Y h:i A',$requests['requested_at']);?></td>
                           <td><?php  if($requests['request_accept'] == 1)
							{
								echo 'Yes';
							}
							else
							{
								echo 'No';
							}?></td>
                        </tr>
                        <?php $cnt3 ++; } ?>
                        </tbody>
                    </table>
                    <?php } else { echo 'no requests available'; }?>
                   
                </div><!-- /.box -->
			 </div><!--/.col (left) -->
        </div>
        <!-- ends -->
		<!-- TRACK -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="color:#3c8dbc"><strong>Track</strong></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <?php $cnt4=1;  if(!empty($event_track)){?>
              <table id="example" class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Seller</th>
                            <th>Buyer</th>
                            <th>Confirmed By</th>
                            <th>Confirmed Amount</th>
                            <th>Confirmed Quantity</th>
                            <th>Release Fund?</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($event_track as $tracks) { ?>
                        <tr>
                        	<td><?php echo $cnt4;?></td>
                            <td><?php echo $tracks['bidding_user_seller'];?></td>
                            <td><?php echo $tracks['bidding_user_buyer'];?></td>
                            <td><?php echo $tracks['confirmed_user'];?></td>
                           <td><?php echo $tracks['confirmed_amount'];?></td>
                           <td><?php echo $tracks['confirmed_quantity'];?></td>
                           <td><?php echo $tracks['release_fund'];?>
                           <br>
                           Total_quantity :<?php echo $tracks['total_quantity'];?><br>
                           Damaged :<?php echo $tracks['damaged'];?><br>
                           Released Amount :<?php echo $tracks['released_amount'];?><br>
                           
                           </td>
                          
                        </tr>
                        <?php $cnt4 ++; } ?>
                        </tbody>
                    </table>
                    <?php } else { echo 'no results found'; }?>
                   
                </div><!-- /.box -->
			 </div><!--/.col (left) -->
        </div>
        <!-- Ends -->
    </div>   <!-- /.row -->
   
</section><!-- /.content -->
<!-- -->
<?php endforeach; endif;?>
<script>
function get_user_count(product)
{
	//alert(id);
	
	var mydata = {"product": product};

	$.ajax({
		type: "POST",
		url: "get_user_count",
		data: mydata,
		success: function (response) {
			$("#user_count").html(response);
			//alert(response);
		}
	});	
}
</script>
<?php function page_js(){ ?>
 
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});




</script>

<?php } ?>

