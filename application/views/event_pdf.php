<?php 
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
                    <h3 class="box-title" style="color:#03F"><strong><?php  echo $e->event;?></strong></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
    
                    <table class="table table-striped" width="100%">
                         <tr>
                            <th>Event</th> <th>: </th>
                            <td> <?php  echo $e->event;?></td>
                            <th>Name </th> <th>: </th>
                            <td> <?php  echo $e->name;?></td>
                         </tr>
                        <tr>
                            <th>Budget </th> <th>: </th>
                            <td><font color="#FF0000"><strong> Rs. <?php  echo $e->budget;?></strong></td>
                       		<th>Location </th> <th>: </th>
                            <td> <font color="#000099"><strong><?php  
                            $get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
                            foreach($get_location_name->result() as $l);
                            echo $location = $l->location;?></strong></font> </td>
                        </tr>
                        <tr>
                            <th>Start date </th> <th>: </th>
                            <td><font color="#009900"><strong><?php  echo $e->start_date;?></strong></font></td>
                        
                            <th>End Date </th> <th>: </th>
                            <td><font color="#009900"><strong><?php  echo $e->end_date;?></font> </td>
                        </tr>
                        <tr>
                            <th>Host </th> <th>: </th>
                            <td><?php  
                            $get_host_name = $this->db->get_where('users', ['id'=>$e->host]);
                            foreach($get_host_name->result() as $h);
                            echo $host = $h->first_name.' '.$h->last_name;?></td>
                        
                            <th>Organiser</th> <th> : </th>
                            <td><?php  
                            $get_org_name = $this->db->get_where('users', ['id'=>$e->organiser]);
                            foreach($get_org_name->result() as $og);
                            echo $organiser = $og->first_name.' '.$og->last_name;?> </td>
                        </tr>
                        <tr>
                       		<th>Guest </th> <th>:</th>
                            <td><?php  
                            $get_guest_name = $this->db->get_where('users', ['id'=>$e->guest]);
                            foreach($get_guest_name->result() as $g);
                            echo $guest = $g->first_name.' '.$g->last_name;?></td>
                            <th>Additional Guest </th> <th>: </th>
                            <td><?php  echo $e->additional_guests;?></td>
                        </tr>
                        <tr>
                        <th>Participants </th> <th>: </th>
                        <td><font color="#FF0000"><strong><?php  echo $e->participants;?></strong></font> </td>
                        <td></td><td></td>
                        </tr>
                         <tr>
                        <th>Regitration :  <font color="#F86105"><strong><?php  echo $reg_count;?></strong></font> </th>
                        <th>Sponsors :   <font color="#F86105"><strong><?php  echo $sponsorship_count;?></strong></font></th>
                        <th>Requets : <font color="#F86105"><strong><?php  echo $request_count;?></strong></font></th>
                        <th></th>
                        </tr>
                      </table>
    
                </div><!-- /.box-body -->
    
               
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
 <?php } ?>
<section class="content">
    <div class="row">
        <!-- Custom labels -->
<?php if (!empty($labels) && $labels->num_rows() > 0) {?>
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Custom labels</h3>
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
		<div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Sponsor/Contribute </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" width="100%">
                        <tr>
                        <th>For</th>
                        <th>Charge</th>
                        <th>Sponsored Amount</th>
                        <th>Required Amount</th>
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
								$required = ($s->charge) - $sum;
								
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
                        </tr>
                        <?php } ?>
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
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Contributions</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-striped" width="100%">
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
                                <td><?php if($cn->user == $user_id) { echo 'Myself'; } else { echo $spn; }?></td>
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
                <div class="box-body">
               
					<table class="table table-striped" width="100%">
                    	<tr>
                        <th>Event</th>
                        <th>Actual Budget</th>
                        <th>Contributions</th>
                        <th>Balance</th>
                        </tr>
                        <tr>
                        <td><?php  echo $e->name;?></td>
                        <td>Rs. <?php  echo $e->budget;?></td>
                        <td>Rs. <?php echo $contributions;?></td>
                        <td><?php 
						if($contributions > $e->budget)
						{
							echo 'Excess amount Rs. <font color="#009900"><strong>'.$balance =   $contributions - ($e->budget).'</strong></font>';
						}
						else
						{
							echo 'Balance amount Rs. <font color="#FF0000"><strong>'.$balance = ($e->budget) - $contributions .'</strong></font>';
						}
						
						?></td>
                        </tr>
                        
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

    </div>   <!-- /.row -->
</section>


