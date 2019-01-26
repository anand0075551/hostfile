 <?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap-responsive.css" rel="stylesheet"/>
<?php } ?>
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
                    <a href="<?php echo  base_url('Event_management/event_invitation/' . $e->invitation) ;?>" data-toggle="modal" data-target="#myModal" title="View"> <img src ="<?php echo profile_photo_url('/invitation/'.$e->invitation); ?>"  width="45" height="45" ></a>
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
                            <td><strong> Rs. <?php  echo $e->budget;?></strong></td>
                       		<th>Location : </th>
                            <td> <strong><?php  
                            $get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
                            foreach($get_location_name->result() as $l);
                            echo $location = $l->location;?></strong> </td>
                        </tr>
                        <tr>
                            <th>Registration Start date : </th>
                            <td><strong><?php  echo $e->regstart_date;?></strong></td>
                        
                            <th>Registration End Date : </th>
                            <td><strong><?php  echo $e->regend_date;?></td>
                        </tr>
                        <tr>
                            <th>Event Start date : </th>
                            <td><strong><?php  echo $e->start_date;?></strong></td>
                        
                            <th>Event End Date : </th>
                            <td><strong><?php  echo $e->end_date;?></td>
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
                        <td><strong><?php  echo $e->participants;?></strong></td>
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
                            Seats Left : <strong>
                            <?php if($e->participants > $seat_count )
							{
								$seat = $e->participants - $seat_count;
								echo $seat;
							}
							else
							{
							echo 0;
							}?>
                            </strong>
                        </th>
                        <th>Regitration :  <strong><?php  echo $reg_count;?></strong> </th>
                        <th>Sponsors :   <strong><?php  echo $sponsorship_count;?></strong></th>
                        <th>Requets :<strong><?php  echo $request_count;?></strong></th>
                        
                        <th></th>
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
			 for ($col = 1; $col <= $col_count; $col++)
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
		</div><!--/.Custom labels -->
<?php } ?>
<!-- -->
<!------------------------------------ -->
<!--JOINED USERS -->
<section class="content">
    <div class="row">
       
<?php if (!empty($seat_cancel) && $seat_cancel->num_rows() > 0) {?>
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Seat Cancel</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
                        <tr>
                        	 <th>Sl:No</th>
                            <th>User</th>
                            <th>Seat Number</th>
                            <th>Reg.Fee</th>
                            <th>Deduction Percentage </th>
                            <th>Deduction Amount </th>
                            <th>Refund Amount </th>
                        </tr>
					    <?php 
						$num =1 ;
						foreach ($seat_cancel->result() as $sc)
						 {
							$user_info = singleDbTableRow($sc->created_by);
							$user_email = $user_info->email;
							$user_name = $user_info->first_name.' '. $user_info->last_name;
							$user_phn = $user_info->contactno;
							$stn =$sc->seat_no;
							//
							$w = " seat_from<=".$stn." AND seat_to >=".$stn." AND event='".$e->event."'";
							$st_d = $this->db->where($w)->get('em_seats');
                          
						    foreach($st_d->result() as $std);
							
                           
							//
						?>
                        <tr>
                            <td><?php echo $num;?></td>
                            <td><?php echo $user_name;?></td>
                            <td><?php echo $sc->seat_no;?></td>
                            <td><?php echo $std->reg_fee;?></td>
                            <td><?php echo $std->refund_perc;?></td>
                             <td><?php $am =(($std->reg_fee)/100) * ($std->refund_perc); echo $am;?></td>
                             <td><?php echo ($std->reg_fee) - $am;?></td>
                        </tr>
                         
                        <?php  $num++; } ?>
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->
<?php } ?>
<!-- -->
<!---------------------------------------- -->
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
<?php if (!empty($sponsors) && $sponsors->num_rows() > 0){?>
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
                        <th>Contractor </th>
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
                            <td><?php  echo $s->title;?></td>
                            <td>Rs. <?php  echo $s->charge;?></td>
                            <td>Rs. <?php  echo $sum;?></td>
                            <td>Rs. <?php  echo $required;?></td>
                            <td>
								<?php 
                                $get_name = $this->db->get_where('users', ['id'=>$s->give_to]);
                                foreach($get_name->result() as $gn);
                                echo $give_to = $gn->first_name.' '.$gn->last_name; ?>
                                </td>
                                <!--<td>
                                < ?php  if($s->transfer ==0) { ?>
                                <input type="hidden" name="< ?php echo $count;?>amount" id="< ?php echo $count;?>amount" value="< ?php  echo $s->charge;?>">
                            <input type="hidden" name="< ?php echo $count;?>sponsor" id="< ?php echo $count;?>sponsor" value="< ?php  echo $s->sponsorship;?>">
                             <input type="hidden" name="< ?php echo $count;?>event" id="< ?php echo $count;?>event" value="< ?php  echo $e->event;?>">
                             <input type="hidden" name="< ?php echo $count;?>give_to" id="< ?php echo $count;?>give_to" value="< ?php  echo $s->give_to;?>">
                                <button type="button" align="center" class="btn btn-primary" onClick="transfer_now(< ?php  echo $count;?>)" ><i class="fa fa-money"></i> Transfer Now</button>
                                < ?php } else { ?>
                                <button type="button" align="center" class="btn btn-primary" disabled="disabled" ><i class="fa fa-thumbs-up"></i> Transferred</button>
                                < ?php }?>
                            </td>-->
                        </tr>
                        <?php $count++; } ?>
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.sponsorship -->
<?php } ?>
    </div>   <!-- /.row -->
</section>
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
<section class="content">
    <div class="row">
        <!-- Report -->

        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#0C0"><strong>Report</strong></h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal']); ?>
					<table class="table table-hover">
                    	<tr>
                        <th>Event</th>
                        <th>Actual Budget</th>
                        <th>Registrations</th>
                        <th>Contributions</th>
                        <th>Balance </th>
                        <th>Excess </th>
                        </tr>
                        <tr>
                        <td><?php  echo $e->name;?></td>
                        <td> <?php  echo $e->budget;?></td>
                        <td> <?php echo $registrations;?></td>
                        <td> <?php echo $contributions;?></td>
                        <td>
                        <?php 
						$total_got = $contributions + $registrations;
						if($total_got < $e->budget)
						{
							 $balance = ($e->budget) - $total_got ;
							echo '<font color="#FF0000"><strong>'.$balance.'</strong></font>';
						}
						else
						{
							echo 0 ;
						}
						
						?>
                        </td>
                        <td><?php 
						if($total_got > $e->budget)
						{
							 $excess =   $total_got - ($e->budget);
							echo '<font color="#0033FF"><strong>'.$excess.'</strong></font>';
						}
						else
						{
							echo 0;
						}
						
						?></td>
                        </tr>
                        
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

    </div>   <!-- /.row -->
</section>
<!-- Update form -->
<section class="content">
    <div class="row">
        <!-- Report -->

        <div class="col-md-12" id="update_form" style="display:none">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" >Update Event<font style="color:#F06"><strong> <?php echo $e->event;?></strong></font></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					 
                     <div class="form-group <?php if(form_error('budget')) echo 'has-error'; ?>">
                            <label for="budget" class="col-md-3">Budget
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="budget" id="budget" class="form-control" placeholder="Enter Amount" value="<?php echo $e->budget;?>">
                                <?php echo form_error('budget') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="location" class="col-md-3">Location
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<select name="location" id="location" class="form-control" >
										<option value=""> Choose Event location </option>
										<?php
										/*if ($locations->num_rows() > 0) 
										{
											foreach ($locations->result() as $location) 
											{
												echo '<option value="'.$location->id.'" ';
												if($e->location == $location->id) 
												{ 
												echo 'selected' ;
												}  
												 echo '> '.$location->id.'-'.$location->location.'</option>';
											}
										}*/
										?>
									</select>	                                
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if(form_error('participants')) echo 'has-error'; ?>">
                            <label for="participants" class="col-md-3">Participants
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="participants" id="participants" class="form-control" placeholder="Enter number of participants" value="<?php echo $e->participants;?>">
                                <?php echo form_error('participants') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('f_time')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Event Date & Time
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                             From : <input type="text" class="some_class"  id="some_class_1" name="f_time" placeholder="select start date" value="<?php echo $e->start_date;?>"/>
							To : <input type="text" class="some_class"  id="some_class_2" name="t_time" placeholder="select end date" value="<?php echo $e->end_date;?>"/>
                               
                                <?php echo form_error('f_time') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
								<label for="status" class="col-md-3">Status
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<select name="status" id="status" class="form-control" >
										<option value="1" <?php if($e->status == 1){ echo 'selected'; } ?>> Active</option>
										<option value="0" <?php if($e->status == 0){ echo 'selected'; } ?>> Inactive</option>
                                        <option value="2" <?php if($e->status == 2){ echo 'selected'; } ?>> Closed</option>	
									</select>	                                
									<?php echo form_error('status') ?>

								</div>
						</div>
                        <div class="box-footer">
                        <input type="hidden" name="event" value="<?php echo $e->event;?>">
                  		<button type="submit" name="submit" value="update_event" class="btn btn-warning">
                            <i class="fa fa-edit"></i> Update Now
                        </button>
                    </div>
                    
                </div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

    </div>   <!-- /.row -->
</section>

</div>
					<table class="table table-hover">

                        <tr>
                        <td> 
                       <!-- <button type="submit" name="submit" value="pdf" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Export to PDF </button>-->
                         <a href="<?php echo base_url('Event_management/event_list/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        </td>
                        <td><button type="button" class="btn btn-warning " id="create_pdf"><i class="fa fa-file-pdf-o"></i> Export to PDF</button></td>
                        <td><button type="submit" name="submit" value="csv" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Export to CSV </button></td>
                        <td>
                       <a href="<?php echo base_url('Event_management/event_edit/' . $e->event);?>"> <input type="button" name="bidding_select" id="s1" class="btn btn-primary form-control" value="Update"></a>
                        <!--<input type="button" name="bidding_select" id="s1" onClick="show_update_form()" class="btn btn-primary form-control" value="Update">-->
                         </td>
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
function show_update_form()
{
	
	$("#update_form").slideToggle(1000);
	
	
}
</script>
<script>
function transfer_now(cnt)
{
	var amount = document.getElementById(cnt+'amount').value;
	var sponsor = document.getElementById(cnt+'sponsor').value;
	var events = document.getElementById(cnt+'event').value;
	var give_to = document.getElementById(cnt+'give_to').value;
	
	
		alert('Please wait..');
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
</script>