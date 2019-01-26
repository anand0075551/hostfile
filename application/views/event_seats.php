  <style>
    article { border: 4px double black; padding: 5mm 10mm; border-radius: 3mm }
  </style>
 <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
 <!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
<?php 
include('header.php'); 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
?>
 <!--Details  -->
<section class="content">
    <div class="row">
     <?php 
	 $user_seats ='';
	 $user_fee =0;
	 if (!empty($seats) && $seats->num_rows() > 0) {
	foreach ($seats->result() as $st)
	{
		$user_seats = 'Seat<strong>'.$st->seat_no.'</strong> , '.$user_seats;
		$user_fee = $user_fee + $st->reg_fee;
	}
	
	?>
<!-- Details -->
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title" style="color:#03F">Seats</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <ul>
        <li><strong>Total Seats : </strong><?php  echo $seats->num_rows()?></li>
        <li><strong>Seats :</strong> <?php  echo $user_seats;?></li>
        <li><strong>Total Amount :</strong> <?php  echo $user_fee;?></li>
        </ul>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<?php } ?>  
<?php if (!empty($event) && $event->num_rows() > 0) {
	foreach ($event->result() as $e);
	$get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
	foreach($get_location_name->result() as $l);
	 $location = $l->location;
	?>
<!-- Details -->
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title" style="color:#03F">Event</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        <ul>
        <li><strong>Name : </strong><?php  echo $e->name;?></li>
        <li><strong>Location :</strong> <?php  echo $location;?></li>
        <li><strong>Start Date :</strong> <?php  echo $e->start_date;?></li>
        <li><strong>End Date :</strong> <?php  echo $e->end_date;?></li>
        </ul>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<?php } ?>
 <!--/Details -->
  <!--Seats -->
    <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
  <?php if (!empty($seats) && $seats->num_rows() > 0) {
	  foreach ($seats->result() as $ust)
	{
	  ?>
<div class="col-md-4">
    <!-- general form elements -->
    <div class="box box-primary">
       <div class="box-body">
    	<article style="background:#DEEEFE;">
            <h4><strong><?php echo $ust->seat .' : Seat'.$ust->seat_no; ?></strong></h4>
            <p>Reg:Fee : <?php echo $ust->reg_fee;?></p>
            
            <p>Holder Name : <?php echo $ust->seat_holder_name;?></p>
            
            <h4>&yen; Event</h4>
            <ul>
            <li>Name: <?php  echo $e->name;?></li>
            <li>Place: <?php  echo $location;?></li>
            <li>Start Date: <?php  echo $e->start_date;?></li>
            <li>End Date: <?php  echo $e->start_date;?></li>
            </ul>
            <?php
			$get_refund_perc = $this->db->get_where('em_seats', ['event' => $ust->event,'seat' => $ust->seat]);
			foreach($get_refund_perc->result() as $rf);
			?>
            <h5>
            <input type='checkbox' name='cn<?php echo $ust->id;?>' value='<?php echo $ust->id;?>' />
             <strong>Cancel</strong></h5>
             <h5><font color="#FF0000">Cancellation refund deduction  : <strong><?php echo $rf->refund_perc;?>%</strong></font></h5>
             <h5><font color="#FF0000">Deduction Value  : <strong><?php $am =(($ust->reg_fee)/100) * ($rf->refund_perc); echo $am; ?></strong></font></h5>
            <input type='hidden' name='rf<?php echo $ust->id;?>' id='rf<?php echo $ust->id;?>' value='<?php echo $am;?>' />
            <input type='hidden' name='rrf<?php echo $ust->id;?>' id='rrf<?php echo $ust->id;?>' value='<?php echo $ust->reg_fee;?>' />
        </article>
	</div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<?php } ?>
</div>
<div style="margin-left:30%;">

	<input type='hidden' name='t_fee' id='t_fee' value='<?php echo $user_fee;?>' />
    <button type="button" class="btn btn-primary"  onClick="return validateCheckBox();"><i class="fa fa-trash"></i> Cancel</button>
</div>
<!--/seats -->
<?php } ?>
</form>

 <a href="<?php echo base_url('Event_management/events/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
</section>
<!-- -->

<script type="text/javascript">
function validateCheckBox()
{
	var c = document.getElementsByTagName('input');
	var total_fee = document.getElementById('t_fee').value;
	var seats='';
	var total = 0;
	var total1 = 0;
	var events = "<?php echo $e->event;?>";
	for (var i = 0; i < c.length; i++)
	{
		if (c[i].type == 'checkbox')
		{
			if (c[i].checked) 
			{
				 seats += c[i].value+',';
				 total =total + parseFloat(document.getElementById('rf'+c[i].value).value);
				 total1 =total1 + parseFloat(document.getElementById('rrf'+c[i].value).value);
			}
		}
		
		
	}
	if(seats !='')
	{
		var tt = total.toFixed(2);
		var tt1 = total1.toFixed(2);
		 if (confirm(tt + 'CPA value will deduct from your account')) 
		 {
			var mydata = {"event": events,"seats": seats,"deduction": tt,"total":tt1};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Event_management/user_seat_cancel'); ?>",
			data: mydata,
			success: function (response) {
				alert(response);
				location.reload();
				 
			}
		});	
		 }
	}
	else
	{
	alert('Please select seat');
	return false;
	}
}
</script>


