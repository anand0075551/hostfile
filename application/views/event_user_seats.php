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
    	<article style="background:#DFDFDF;">
            <h4><strong><?php echo $ust->seat .' : Seat'.$ust->seat_no; ?></strong></h4>
            <p>Reg:Fee : <?php echo $ust->reg_fee;?></p>
            
            <h4><strong>Seat Holder Name:<font color="#FF0000">*</font></strong></h4>
            <p><?php if (form_error($ust->id)) echo '<font color="#FF0000">Please enter  Name</font>'; ?><input type="text" name="<?php echo $ust->id;?>" placeholder="Enter name here"><?php echo form_error($ust->id) ?></p>
            
            <h4>&yen; Event</h4>
            <ul>
            <li>Name: <?php  echo $e->name;?></li>
            <li>Place: <?php  echo $location;?></li>
            <li>Start Date: <?php  echo $e->start_date;?></li>
            <li>End Date: <?php  echo $e->start_date;?></li>
            </ul>
        </article>
	</div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<?php } ?>
</div>
    <div class="box-footer" align="center">
    <button type="button" align="center" class="btn btn-primary" id="balance_check_btn" onClick="take_confirmation()" ><i class="fa fa-money"></i> pay</button>
        <button type="submit" name="submit" value="pay_now" class="btn btn-success" id="complete_order_btn" style="display:none;">
            <i class="fa fa-money"></i> Submit & Pay
        </button>
        
    </div>

<!--/seats -->
<?php } ?>
</form>

 
</section>
<!-- -->
<script>
function take_confirmation()
{
	var amount = "<?php  echo $user_fee;?>";
	$("#balance_check_btn").hide();
	$("#complete_order_btn").fadeIn();
	
	$("#complete_order_btn").html("Comfirm Your Order By Deducting "+amount+" Values");
	
}
</script>
<!--<script>
function validate() 
{

    return confirm("< ?php  echo $user_fee;?> CPA value will deduct from your account");
   
}
</script>-->


