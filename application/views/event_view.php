<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap-responsive.css" rel="stylesheet"/>
<?php } ?>

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

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F"><strong><?php  echo $e->event;?></strong>
                     <?php if($e->invitation !='') {?>
                    <a href="<?php echo  base_url('Event_management/event_invitation/' . $e->invitation) ;?>" data-toggle="modal" data-target="#myModal" title="View"><img src ="<?php echo profile_photo_url('/invitation/'.$e->invitation); ?>"  width="45" height="45" > </a>
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
                            <td><font color="#FF0000"><strong> <?php  echo $e->budget;?></strong></td>
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
                        <th>Seats : </th>
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
                        <th>Registration Fee : </th>
                        <td>
						<?php if($e->reg_fee ==1)
						{
							$reg = 'Yes';
						}else
						{
							$reg = 'No';
						}
						echo $reg;?>
                        </td>
                        <th>Venue : </th>
                        <td><?php  echo $e->venue;?></td>
                        <td></td>
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
                        <tr>
                        
                        <?php if($e->open_to_all ==1) {?>
                        <td><strong>Business Groups : </strong>
						<?php 
							$selected_bgs = rtrim($e->selected_bg,", ");
							$ebg = '';
							$explode_bg = explode(',',$selected_bgs);
							 foreach($explode_bg as $bgs)
							 {
								 $ebg =singleDbTableRow($bgs, 'business_groups')->business_name.','. $ebg;
							 }
							 echo $ebg;
							?>
                        </td>
                        <td><strong>Roles :</strong> 
							<?php 
							$selected_roles = rtrim($e->selected_roles,", ");
							$er = '';
							$explode_role = explode(',',$selected_roles);
							 foreach($explode_role as $erole)
							 {
								 $er =singleDbTableRow($erole, 'role')->rolename.','. $er;
							 }
							 echo $er;
							?>
                        </td>
                        <td><strong>Areas :</strong>
						<?php 
							$selected_area = rtrim($e->selected_area,", ");
							$e_area = '';
							$explode_area = explode(',',$selected_area);
							 foreach($explode_area as $area)
							 {
								 $er =singleDbTableRow($area, 'area')->location;
								 $e_area =singleDbTableRow($er, 'location_id')->location.','.$e_area;
							 }
							 echo $e_area;
							?>
                        </td>
                         <?php  } else {?>
                         <td><strong>Selected Users : </strong>
						 <?php 
						 $selected = rtrim($e->selected_users,", ");
						 $selected_user_name = '';
						 if($selected !='')
						 {
							 $explode_user = explode(',',$selected);
							 foreach($explode_user as $euser)
							 {
								 
								$user_info1 = singleDbTableRow($euser);
								  $selected_user_name = $user_info1->first_name.' '. $user_info1->last_name.','.$selected_user_name; 
							 }
						 }
						 echo $selected_user_name;
						 ?>
                         </td>
                        <?php } ?>
                        <td><strong>SMS Numbers : </strong><?php echo $e->sms_numbers;?></td>
                        </tr>
                       
                      </table>
   
                </div><!-- /.box-body -->
    
               
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
 <?php } ?>
 <!--SEATS  -->
<section class="content">
    <div class="row">
       
<?php if (!empty($seats) && $seats->num_rows() > 0) {?>
        
        <div class="col-md-6"><!-- SEATS -->
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title" style="color:#03F">Your Seats</h3>
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
			  	$where_array = " event = '".$e->event."' AND seat = '".$st->seat."'  AND seat_no = ".$st_num." ";
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
                            <img src='../../assets/admin/img/seat3.png' alt='Available' title="Available <?php echo $st_num;?>" width="28" height="28" style="background-color:<?php echo $st->seat_color;?>"/>
                            <?php } ?>
			 <?php $st_num ++; }
			   echo "</br>"; ?>
              
			<?php }
	 	}
		?>
            
         </div>
         
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
            <img src='../../assets/admin/img/seat3.png' alt='Selected Seat'/> : <strong>Available</strong>
           <img src='../../assets/admin/img/seat2.png' alt='Selected Seat'/> : <strong>Selected</strong>
           <img src='../../assets/admin/img/seat1.png' alt='Booked Seat'/> : <strong>Booked</strong>
           
           
         </div>
    </div>
</div>
<?php } ?>
<!-- -->
<!--JOINED USERS -->
<?php if($currentUser ==11 || $currentUser ==39)
	{?>
<section class="content">
    <div class="row">
       
<?php if (!empty($joined_users) && $joined_users->num_rows() > 0) {?>
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Joined Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
                        <tr>
                        	 <th>Sl:No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>No: of seats </th>
                             <th>Seats </th>
                        </tr>
					    <?php 
						$num =1 ;
						foreach ($joined_users->result() as $ju)
						 {
							$user_info = singleDbTableRow($ju->user);
							$user_email = $user_info->email;
							$user_name = $user_info->first_name.' '. $user_info->last_name;
							$user_phn = $user_info->contactno;
							//
							$get_seat_nos = $this->db->get_where('em_user_seats', ['event'=>$e->event,'user'=>$ju->user]);
                           $user_seats ='';
						    foreach($get_seat_nos->result() as $stn)
							{
								$user_seats = $stn->seat.' : Seat<strong>'.$stn->seat_no.'</strong> , '.$user_seats;
							}
                           
							//
						?>
                        <tr>
                            <td><?php echo $num;?></td>
                            <td><?php echo $user_name;?></td>
                            <td><?php echo $user_email;?></td>
                            <td><?php echo $user_phn;?></td>
                            <td><?php echo $ju->no_of_seats;?></td>
                             <td><?php echo $user_seats;?></td>
                        </tr>
                         
                        <?php  $num++; } ?>
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
<?php } }?>
<!-- -->
<section class="content">
    <div class="row">
        <!-- Custom labels -->
<?php if (!empty($labels) && $labels->num_rows() > 0) {?>
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Event Activities</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<ul>
					    <?php foreach ($labels->result() as $l)
						{?>
							<li><?php  echo $l->e_label;?></li>
                        <?php } ?>
                    </ul>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->
<?php } ?>
<?php if($currentUser ==11 || $currentUser ==39)
	{
		if (!empty($sponsors) && $sponsors->num_rows() > 0){?>
		 <!-- Sponsorship -->
		<div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Sponsor/Contribute </h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
                        <tr>
                        <th>For</th>
                        <th>Charge</th>
                        <th>Sponsored Amount</th>
                        <th>Required Amount</th>
                        <?php if($currentUser == 11 || $currentUser==39) {?>
                         <th>Contractor </th>
                         <?php } ?>
                        </tr>
					    <?php foreach ($sponsors->result() as $s)
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
                            <td><?php  echo $s->title;?></td>
                            <td>Rs. <?php  echo $s->charge;?></td>
                            <td>Rs. <?php  echo $sum;?></td>
                            <td>Rs. <?php  echo $required;?></td>
                        <?php if($currentUser == 11 || $currentUser==39) {?>
                         	<td>
								<?php 
                                $get_name = $this->db->get_where('users', ['id'=>$s->give_to]);
                                foreach($get_name->result() as $gn);
                                echo $give_to = $gn->first_name.' '.$gn->last_name; ?>
                            </td>
                         <?php } ?>
                        </tr>
                        <?php } ?>
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.sponsorship -->
<?php } }?>
    </div>   <!-- /.row -->
</section>

<?php 
if($currentUser == 11 || $currentUser==39) {
if (!empty($contributions) && $contributions->num_rows() > 0) 
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
						foreach ($contributions->result() as $cn)
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
                                <td><?php if($cn->user == $user_id) { echo 'Myself'; } else { echo $spn; }?></td>
                                <td><?php  echo $cn->amount;?></td>
							</tr>
                                    
                        <?php $cnt++; } ?>
                    </table>

                </div><!-- /.box-body -->

               
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        
    </div>   <!-- /.row -->
</section>
<?php } } else { 
if (!empty($my_contributions) && $my_contributions->num_rows() > 0) 
{
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">My Contributions</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                    <tr>
                    <th>Sl No:</th>
                    <th>Sponsored For</th>
                    <th>Sponsored Amount</th>
                    </tr>
					    <?php $cnt =1; 
						foreach ($my_contributions->result() as $cn)
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
                                <td><?php  echo $cn->amount;?></td>
							</tr>
                                    
                        <?php $cnt++; } ?>
                    </table>

                </div><!-- /.box-body -->

               
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        
    </div>   <!-- /.row -->
</section>
<?php } }?>
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
<div class="box-footer">
	<?php 
    if($currentUser ==39 || $currentUser == 11)
    {?>
     <a href="<?php echo base_url('Event_management/event_list/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
     <?php } else { ?>
     <a href="<?php echo base_url('Event_management/events/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
     <?php } ?>
                    </div>
