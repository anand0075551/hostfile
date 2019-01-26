 <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
 <!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
<?php include('header.php'); 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
?>
<?php

foreach ($event->result() as $e)
{
	
?>
<!-- Main content -->
<div  id="print_div" >
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F"><strong><?php  echo $e->event;?></strong>
                    <?php if($e->invitation !='') {?>
                    <a href="<?php echo  base_url('Event_management/event_invitation/' . $e->invitation) ;?>" data-toggle="modal" data-target="#myModal" title="View"><img src="../../invitation/<?php echo $e->invitation;?>" / width="45" height="45"> </a>
                    <?php } ?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
    
                    <table class="table table-hover">
                         <tr>
                            <th>Event : </th>
                            <td> <?php  echo $e->event;?></td>
                            <th>Name : </th>
                            <td> <?php  echo $e->name;?></td>
                         </tr>
                        <tr>
                            <th>Budget : </th>
                            <td><font color="#FF0000"><strong> Rs. <?php  echo $e->budget;?></strong></td>
                       		<th>Location : </th>
                            <td> <font color="#000099"><strong><?php  
                            $get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
                            foreach($get_location_name->result() as $l);
                            echo $location = $l->location;?></strong></font> </td>
                        </tr>
                        <tr>
                            <th>Registration Start date : </th>
                            <td><font color="#009900"><strong><?php  echo $e->regstart_date;?></strong></font></td>
                        
                            <th>Registration End Date : </th>
                            <td><font color="#009900"><strong><?php  echo $e->regend_date;?></font> </td>
                        </tr>
                        <tr>
                            <th>Event Start date : </th>
                            <td><font color="#009900"><strong><?php  echo $e->start_date;?></strong></font></td>
                        
                            <th>Event End Date : </th>
                            <td><font color="#009900"><strong><?php  echo $e->end_date;?></font> </td>
                        </tr>
                        <tr>
                            <th>Host : </th>
                            <td><?php  
                            $get_host_name = $this->db->get_where('users', ['id'=>$e->host]);
                            foreach($get_host_name->result() as $h);
                            echo $host = $h->first_name.' '.$h->last_name;?></td>
                        
                            <th>Organising to : </th>
                            <td><?php  
                            $get_org_name = $this->db->get_where('users', ['id'=>$e->organiser]);
                            foreach($get_org_name->result() as $og);
                            echo $organiser = $og->first_name.' '.$og->last_name;?> </td>
                        </tr>
                        <tr>
                       		<th>Guest</th>
                            <td><?php  
                            $get_guest_name = $this->db->get_where('users', ['id'=>$e->guest]);
                            foreach($get_guest_name->result() as $g);
                            echo $guest = $g->first_name.' '.$g->last_name;?></td>
                            <th>Additional Guest : </th>
                            <td><?php  echo $e->additional_guests;?></td>
                        </tr>
                        <tr>
                        <th>Participants : </th>
                        <td><font color="#FF0000"><strong><?php  echo $e->participants;?></strong></font> </td>
                        <th>Open to all ? : </th>
                        <td><?php
							if($e->open_to_all == 1)
							{
								 echo 'Yes';
							}
							else
							{
								echo 'No';
							}
						 ?></td>
                        </tr>
                         <tr>
                         <th>
                            Seats Left : <font color="#F86105"><strong>
                            <?php if($e->participants >$reg_count )
							{
								$seat = $e->participants - $reg_count;
								echo $seat;
							}
							else
							{
							echo 0;
							}?>
                            </strong></font>
                        </th>
                        <th>Regitration :  <font color="#F86105"><strong><?php  echo $reg_count;?></strong></font> </th>
                        <th>Sponsors :   <font color="#F86105"><strong><?php  echo $sponsorship_count;?></strong></font></th>
                        <th>Requets : <font color="#F86105"><strong><?php  echo $request_count;?></strong></font></th>
                        
                        <th></th>
                        </tr>
                        <tr>
                        <th>Registration Fee : </th>
                        <td><?php  echo $e->reg_fee;?></td>
                        <th>Venue : </th>
                        <td><?php  echo $e->venue;?></td>
                        <td></td><td></td>
                        </tr>
                        <tr>
                            <th>Approved : </th>
                            <td>
                            <?php 
							if($e->approved ==1)
							{
								echo "Yes";
							}
							else
							{
								echo "No";
							}
							?>
                            </td>
                            <?php if($e->approved ==1)
							{ ?>
                            <th>Organising By : </th>
                            <td><?php  
                            $get_orgd_name = $this->db->get_where('users', ['id'=>$e->organised_by]);
                            foreach($get_orgd_name->result() as $ogd);
                            echo $organised = $ogd->first_name.' '.$ogd->last_name;?> </td>
                            <?php } ?>
                        </tr>
                      </table>
    
                </div><!-- /.box-body -->
    
               
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
 <?php } ?>
<!-- -->
<section class="content">
    <div class="row">
   		<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                    <h3 class="box-title" style="color:#03F">Details</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                	<table class="table table-hover">
                        <tr>
                            <th>Event</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Organising To</th>
                            <th>Organising By </th>
                            <th>Budget </th>
                        </tr>
                        <tr>
                        	<td><?php  echo $e->event;?></td>
                            <td>
								<?php  
                            $get_crd_name = $this->db->get_where('users', ['id'=>$e->created_by]);
                            foreach($get_crd_name->result() as $cr);
                            echo $crd = $cr->first_name.' '.$cr->last_name;?>
                            </td>
                            <td><?php  echo date('Y-m-d h:m:i',$e->created_at);?></td>
                            <td><?php  echo $organiser;?></td>
                            <td><?php  echo $organised;?></td>
                            <td><?php  echo $e->budget;?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- -->
<section class="content">
    <div class="row">
        
<?php if (!empty($sponsors) && $sponsors->num_rows() > 0){?>
		 <!-- Sponsorship -->
		<div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Contractors & payment</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
                        <tr>
                        <th>View Details</th>
                        <th>For</th>
                        <th>Charge</th>
                        <th>Sponsored </th>
                        <th>Required </th>
                        <th>Contractor </th>
                        <th>Transferred </th>
                        <th>Balance </th>
                        <th></th>
                        </tr>
					    <?php
						$count = 1;
						 foreach ($sponsors->result() as $s)
						 {
							//
							
							$table_name = "em_user_sponsorship";	
							$where_array = " event ='". $e->event."' AND sponsorship = '".$s->sponsorship."' ";								
							$query = $this->db->where($where_array )->get($table_name);
							$sum = 0 ;
							if ($query->num_rows() > 0) 
							{
								foreach ($query->result() as $r)
								{
									$sum = $sum + $r->amount;
								}
								if($sum < $s->charge)
								{
									$required = ($s->charge) - $sum;
								}
								else
								{
									$required = 0;
								}
								
							}
							else
							{
								$required = $s->charge ;
							}
							//
							?>
                        <tr>
                        <td>
                         <input type="hidden" name="<?php echo $count;?>sponsorship" id="<?php echo $count;?>sponsorship" value="<?php  echo $s->sponsorship;?>">
                        <button type="button" align="center" class="btn btn-primary" onClick="show_details(<?php echo $count;?>)" ><i class="fa fa-list"></i></button>
                        </td>
                            <td><?php  echo $s->title;?></td>
                            <td><?php  echo $s->charge;?></td>
                            <td><?php  echo $sum;?></td>
                            <td><?php  echo $required;?></td>
                            <td>
								<?php 
                                $get_name = $this->db->get_where('users', ['id'=>$s->give_to]);
                                foreach($get_name->result() as $gn);
                                echo $give_to = $gn->first_name.' '.$gn->last_name; ?>
                                </td>
                                <?php
								$where_array6 =" sponsorship = '".$s->sponsorship."'";
							    $table_name6="em_fund_transfer";
							   $query6 = $this->db->order_by('id')->where($where_array6 )->get($table_name6);
							   if($query6 -> num_rows() > 0) 
								{
									$tamnt = 0;
									foreach ($query6->result() as $tamount) 
									{
										$tamnt = $tamnt + $tamount->transferred_amount;
									}
								}
								else
								{
									$tamnt = 0;
								}
								 ?>
                                 <td><?php echo $tamnt;?> </td>
                                  <td><?php  echo $tblnc = ($s->charge)-$tamnt;?>
                                  <input type="hidden" name="<?php echo $count;?>tblnc" id="<?php echo $count;?>tblnc" value="<?php  echo $tblnc;?>"/>
                                  </td>
                                <td>
                               <!-- <?php//  if($s->transfer ==0) { ?>-->
                               <input type="text" name="<?php echo $count;?>ad_amount" id="<?php echo $count;?>ad_amount" placeholder="Enter Amount"/>
                                <input type="hidden" name="<?php echo $count;?>amount" id="<?php echo $count;?>amount" value="<?php  echo $s->charge;?>">
                            <input type="hidden" name="<?php echo $count;?>sponsor" id="<?php echo $count;?>sponsor" value="<?php  echo $s->sponsorship;?>">
                             <input type="hidden" name="<?php echo $count;?>event" id="<?php echo $count;?>event" value="<?php  echo $e->event;?>">
                             <input type="hidden" name="<?php echo $count;?>give_to" id="<?php echo $count;?>give_to" value="<?php  echo $s->give_to;?>">
                                <button type="button" align="center" class="btn btn-primary" id="balance_check_btn<?php  echo $count;?>" onClick="take_confirmation(<?php  echo $count;?>)" ><i class="fa fa-money"></i> Transfer Now</button>
                            
                    <a href="<?php echo base_url('Event_management/event_payments/') ?>" class="btn btn-secondary" id="cancel_order<?php  echo $count;?>" style="display:none;">Cancel</a>
                                
                                <button type="button" align="center" class="btn btn-success" id="complete_order_btn<?php  echo $count;?>" onClick="transfer_now(<?php  echo $count;?>)" style="display:none;"><i class="fa fa-money"></i> Transfer Now</button>
                                <!--<?php// } else { ?>
                                <button type="button" align="center" class="btn btn-primary" disabled="disabled" ><i class="fa fa-thumbs-up"></i> Transferred</button>
                                <?php// }?>-->
                            </td>
                        </tr>
                        <?php $count++; } ?>
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.sponsorship -->
       
        
       
<?php } ?>
    </div>   <!-- /.row -->
</section>
 <!-- result div -->
<section class="content">
    <div class="row">
       <div class="col-md-12" id="p_details"></div>
    </div>
</section>
<!--Request Form -->

<?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
<input type="hidden" name="r_event" id="r_event">
<input type="hidden" name="r_sponsor" id="r_sponsor">
<section class="content">
    <div class="row">
    <!-- SEND Amount -->
    <div class="col-md-12" id="send_message_div" style="display:none;">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title" style="color:#03F">Send Message</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
             
                <div class="form-group <?php if(form_error('m_msg')) echo 'has-error'; ?>">
                    <label for="m_msg" class="col-md-3">Message  <span class="text-red">*</span></label>
                    <div class="col-md-9">
                        <textarea name="m_msg" id="m_msg" class="form-control" placeholder="Write Message"></textarea>
                        <?php echo form_error('m_msg') ?>
                    </div>
                </div>
                <div class="box-footer">
                  		<button type="submit" name="send_message" value="send_message" class="btn btn-warning"> Send Now </button>
                 </div>
            
            </div>
        </div>
    </div>
    <!-- ends-->
    <!-- SEND REQUEST -->
    <div class="col-md-12" id="send_request_div" style="display:none;">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title" style="color:#03F">Send Request</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
             <div class="form-group <?php if(form_error('r_amount')) echo 'has-error'; ?>">
                    <label for="r_amount" class="col-md-3">Amount
                        <span class="text-red">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="r_amount" id="r_amount" class="form-control" placeholder="Enter Amount">
                        <?php echo form_error('r_amount') ?>
                    </div>
                </div>
                <div class="form-group <?php if(form_error('r_desc')) echo 'has-error'; ?>">
                    <label for="r_desc" class="col-md-3">Description</label>
                    <div class="col-md-9">
                        <textarea name="r_desc" id="r_desc" class="form-control" placeholder="Write Description"></textarea>
                        <?php echo form_error('r_desc') ?>
                    </div>
                </div>
                <div class="box-footer">
                  		<button type="submit" name="send_request" value="send_request" class="btn btn-warning"> Send Now </button>
                 </div>
            
            </div>
        </div>
    </div>
    <!-- ends -->
                    <!-- UPLOAD Receipt -->
    <div class="col-md-12" id="upload_receipt_div" style="display:none;">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title" style="color:#03F">Upload Receipt</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            <div class="form-group <?php if (form_error('userfile')) echo 'has-error'; ?>">
								<label for="status" class="col-md-3">Invitation Image
                                <span class="text-red">*</span>
                                </label>
								<div class="col-md-9">  								
									<input type="file" name="userfile"  class="form-control"/>
                                    <?php echo form_error('userfile') ?>                                
								</div>
			</div>
            <div class="form-group">
								<label for="status" class="col-md-3">Description</label>
								<div class="col-md-9">  								
									<textarea name="re_desc" id="re_desc" class="form-control"></textarea>                             
								</div>
			</div>
                        <div class="box-footer">
                  		<button type="submit" name="upload_img" value="upload_img" class="btn btn-primary">
                            <i class="fa fa-up"></i> Upload Now
                        </button>
                    </div>
            
            </div>
        </div>
    </div>
    <!-- ends-->
    <!-- OUTBOX -->
    <div class="col-md-12" id="outbox_div" style="display:none;">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title" style="color:#03F">OutBox</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            	<div id="request_div"></div><!-- for requests -->
                <div id="receipt_div"></div><!-- for receipts -->
            	<div id="message_div"></div><!-- for messages -->
                
            </div>
        </div>
    </div>
    <!-- ends-->
    <!-- INBOX -->
    <div class="col-md-12" id="inbox_div" style="display:none;">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title" style="color:#03F">InBox</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            	<div id="inrequest_div"></div><!-- for requests -->
                <div id="inreceipt_div"></div><!-- for receipts -->
            	<div id="inmessage_div"></div><!-- for messages -->
                
            </div>
        </div>
    </div>
    <!-- ends-->
    </div>
</section>
 <!-- / -->
<?php if (!empty($contribution) && $contribution->num_rows() > 0) 
{?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Contributions</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                    <tr>
                    <th>Sl No:</th>
                    <th>Sponsored For</th>
                    <th>Sponsored By</th>
                    <th>Sponsored Amount</th>
                    </tr>
					    <?php $cnt =1; 
						foreach ($contribution->result() as $cn)
						{
							$get_sponsor_name = $this->db->get_where('users', ['id'=>$cn->user]);
                            foreach($get_sponsor_name->result() as $sp);
                            $spn = $sp->first_name.' '.$sp->last_name;
							$get_title = $this->db->get_where('em_sponsorship', ['sponsorship'=>$cn->sponsorship]);
                            foreach($get_title->result() as $st);
                            $title = $st->title;
							?>
							<tr>
                            	<td><?php  echo $cnt;?></td>
                                <td><?php  echo $title;?></td>
                                <td><?php  echo $spn;?></td>
                                <td>Rs. <?php  echo $cn->amount;?></td>
							</tr>
                                    
                        <?php $cnt++; } ?>
                    </table>

                </div><!-- /.box-body -->

               
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        
    </div>   <!-- /.row -->
</section>
<?php } ?>



</div>
					<table class="table table-hover">

                        <tr>
                        <td> 
                       <!-- <button type="submit" name="submit" value="pdf" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Export to PDF </button>-->
                         <a href="<?php echo base_url('Event_management/event_payments/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        </td>
                        <td><button type="button" class="btn btn-warning " id="create_pdf"><i class="fa fa-file-pdf-o"></i> Export to PDF</button></td>
                        
                         <td></td>
                        </tr>
				</table>
                 </form>
                 <!--Popup --->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- -->
<div class="box-footer"></div>
     
<script>
	$(document).ready(function(){
	var form = $('#print_div'),
	//	cache_width = form.width(),
		a4  =[ 830,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('events_report.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>
<script>
function take_confirmation(cnt)
{
	var amount = parseInt(document.getElementById(cnt+'ad_amount').value);
	$("#balance_check_btn"+cnt).hide();
	$("#complete_order_btn"+cnt).fadeIn();
	$("#cancel_order"+cnt).fadeIn();
	$("#complete_order_btn"+cnt).html("Comfirm Your Order By Deducting "+amount+" Values");
	
}
</script>
<script>
function transfer_now(cnt)
{
	$("#complete_order_btn"+cnt).fadeOut();
	$("#cancel_order"+cnt).fadeOut();
	<!--var tblnc =  parseInt("<//?php echo $tblnc;?>");-->
	var tblnc =  parseInt(document.getElementById(cnt+'tblnc').value);
	var amount = parseInt(document.getElementById(cnt+'ad_amount').value);
	/*if(confirm(amount + "CPA value will deduct from your account"))
	{*/
	
	if(amount > tblnc)
	{
		alert("Balance amount is "+ tblnc +"only");
		location.reload();
		return false;
		
	}
	else
	{
	var sponsor = document.getElementById(cnt+'sponsor').value;
	var events = document.getElementById(cnt+'event').value;
	var give_to = document.getElementById(cnt+'give_to').value;
	
	
		//alert('Please wait..');
		var mydata = {"amount": amount,"sponsor": sponsor,"event": events,"give_to": give_to};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Event_management/transfer_now') ?>", 
			data: mydata,
			success: function (response) {
				//$("#reg_product_id").html(response);
				alert(response);
				location.reload(); 
			}
		});	
	}
	/*}*/
}
</script>
<script>
	function show_details(cnt)
	{
		var sponsorship = document.getElementById(cnt+'sponsorship').value;
		var events =" <?php echo $e->event;?>";
		var mydata = {"sponsorship": sponsorship, "event" :events };

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/payment_details') ?>",
		data: mydata,
		success: function (response) {
			$("#p_details").html(response);
			//alert(response);
		}
	});   
	}

</script>
<script>
function show_send_request()
{
	
	document.getElementById('r_event').value = document.getElementById('re_event').value;
	document.getElementById('r_sponsor').value = document.getElementById('re_sponsor').value;
	$("#send_request_div").toggle();
	//$("#send_message_div").hide();
	
	
}
</script>
<script>
function show_send_message()
{
	
	document.getElementById('r_event').value = document.getElementById('re_event').value;
	document.getElementById('r_sponsor').value = document.getElementById('re_sponsor').value;
	$("#send_message_div").toggle();
	//$("#send_request_div").hide();
	
	
}
</script>
<script>
function show_upload_receipt()
{
	
	document.getElementById('r_event').value = document.getElementById('re_event').value;
	document.getElementById('r_sponsor').value = document.getElementById('re_sponsor').value;
	$("#upload_receipt_div").toggle();
	//$("#send_request_div").hide();
	
	
}
</script>
<script>
function show_outbox()
{
	
	var events = document.getElementById('re_event').value;
	var sponsorship = document.getElementById('re_sponsor').value;
	var mydata = {"event": events, "sponsorship":sponsorship};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/organiser_message_outbox') ?>",
		data: mydata,
		success: function (response) {
			$("#message_div").html(response);
			//alert(response);
		}
	});	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/organiser_receipt_outbox') ?>",
		data: mydata,
		success: function (response) {
			$("#receipt_div").html(response);
			//alert(response);
		}
	});	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/organiser_request_outbox') ?>",
		data: mydata,
		success: function (response) {
			$("#request_div").html(response);
			//alert(response);
		}
	});	
	$("#outbox_div").toggle();
	
	
	
}
</script>
<script>
function show_inbox()
{
	
	var events = document.getElementById('re_event').value;
	var sponsorship = document.getElementById('re_sponsor').value;
	var mydata = {"event": events, "sponsorship":sponsorship};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/organiser_message_inbox') ?>",
		data: mydata,
		success: function (response) {
			$("#inmessage_div").html(response);
			//alert(response);
		}
	});	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/organiser_receipt_inbox') ?>",
		data: mydata,
		success: function (response) {
			$("#inreceipt_div").html(response);
			//alert(response);
		}
	});	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/organiser_request_inbox') ?>",
		data: mydata,
		success: function (response) {
			$("#inrequest_div").html(response);
			//alert(response);
		}
	});	
	$("#inbox_div").toggle();
	
	
	
}
</script>
