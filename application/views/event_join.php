 <?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap-responsive.css" rel="stylesheet"/>
<?php } ?>

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
 <!--SEATS  -->
<section class="content">
    <div class="row">
       
<?php if (!empty($seats) && $seats->num_rows() > 0) {?>

<div class="col-md-6"><!-- SEATS -->
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title" style="color:#03F">Select Your Seats</h3>
        </div>
        <div class="box-body table-responsive no-padding" align="center">
        
            <?php 
		 $seat_no = 1; foreach ($seats->result() as $st)
		 {
			 echo '<h3>'.$st->seat.'</h3><br>';
			$col_num = ($st->seat_to - $st->seat_from) + 1;
			$col_count = $col_num/10;
			$st_num = $st->seat_from;
			for ($row = 1; $row <= $col_count; $row++)
			{
			 for ($col = 1; $col <= 10; $col++)
			  { 
			  	$where_array = " event = '".$event."' AND seat = '".$st->seat."'  AND seat_no = ".$st_num." ";
				$table_name="em_user_seats";
				$querys = $this->db->where($where_array )->get($table_name);
			  ?>
              
			   <?php if($querys->num_rows() > 0) {
							foreach($querys->result() as $re);
				 			$user =$re->user;
							$booked_by_info = singleDbTableRow($user);
							$booked_name = $booked_by_info->first_name.' '. $booked_by_info->last_name;
							
							?>
                        <?php if($user == $user_id) { ?>
                         <img src='../../assets/admin/img/seat2.png' alt='Selected Seat' title="Selected Seat <?php echo $st_num;?>" width="28" height="28" style="background-color:<?php echo $st->seat_color;?>"/>
                        <?php } else {?>
                                <img src='../../assets/admin/img/seat1.png' alt='Booked Seat' title="Booked By <?php echo $booked_name;?>" width="28" height="28" style="background-color:<?php echo $st->seat_color;?>"/>
                                <?php } ?>
                            </a>
                        <?php } else { ?>
                          
                            <a href='#' class='section' title='Available <?php echo $st_num;?>' style="height:28px;width:28px;background: <?php echo $st->seat_color;?> url( ../../assets/admin/img/1.png)  no-repeat;">
                               <input type='checkbox' name='ch<?php echo $st_num;?>' value='<?php echo $st_num;?>' /> 
                                </a>
                            <?php } ?>
			 <?php $st_num ++; }
			   echo "</br>"; ?>
              
			<?php }
	 	}
		?>
         </div>
         <button type="button" class="btn btn-info" style="margin-left:50%;" onClick="validateCheckBox();"><i class="fa fa-thumbs-up"></i> Join</button><br /><br />
    </div>
</div><!-- /.SEATS -->

<div class="col-md-6"><!-- Selection -->
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title" style="color:#03F">SEATS</h3>
        </div>
        <div class="box-body">
        	
            <?php foreach ($seats->result() as $st){ ?>
            <h5>
            <a href='#' class='thumbnail' title='Available' style="height:25px;width:25px; background-color:<?php echo $st->seat_color;?>"></a>
            <strong> <?php echo $st->seat;?></strong> Reg.Fee :<strong> <?php echo $st->reg_fee;?></strong>
            <font color="#FF0000">Cancellation refund deduction  : <strong><?php echo $st->refund_perc;?>%</strong></font>
            </h5>
            <?php } ?>
           <img src='../../assets/admin/img/seat1.png' alt='Booked Seat'/> : <strong>Booked</strong>
           <img src='../../assets/admin/img/seat2.png' alt='Selected Seat'/> : <strong>Selected</strong>
           
         </div>
    </div>
</div><!-- /.Selection -->
<?php } ?>
</div>
 <a href="<?php echo base_url('Event_management/events/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
</section>
<!-- -->

<script type="text/javascript">
function validateCheckBox()
{
	var c = document.getElementsByTagName('input');
	var seats='';
	var events = "<?php echo $event;?>";
	for (var i = 0; i < c.length; i++)
	{
		if (c[i].type == 'checkbox')
		{
			if (c[i].checked) 
			{
				 seats += c[i].value+',';
			}
		}
	}
	if(seats !='')
	{
		
		var mydata = {"event": events,"seats": seats};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Event_management/user_join'); ?>",
			data: mydata,
			success: function (response) {
				var result = response;
				if(result == 0)
				{
					alert('Sorry low balance..Please increase your CPA balance');
					location.reload();
				}
				
				else
				{
				window.location="<?php echo base_url('Event_management/event_user_seats') ?>"+"/"+events;
				}
				
				 
			}
		});	
	}
	else
	{
	alert('Please select seat.');
	return false;
	}
}
</script>



