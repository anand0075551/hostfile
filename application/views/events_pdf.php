<?php 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
?>
<?php
if (!empty($event) && $event->num_rows() > 0) 
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
                    
                </div><!-- /.box-header -->
                <div class="box-body">
    
                    <table  class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Name </th>
								 <th>Budget</th>
                                 <!--<th>Contributions</th>
                                 <th>Required</th>-->
                                 <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Registration</th>
                                <th>Sponsorship</th>
                                 <th>Requests</th>
                             </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($event->result() as $events) { 
						//no of registration
						$where_array = " event = '".$events->event."'  ";
						$query = $this->db->where($where_array )->count_all_results('em_users');
				 		$reg_count = $query;
						 //no of sponsorship
						 $where_array2 = " event = '".$events->event."'  ";
						$query2 = $this->db->where($where_array2 )->count_all_results('em_user_sponsorship');
						 $sponsorship_count = $query2;
						 //no of requests
						 $where_array3 = " event = '".$events->event."'  ";
						$query3 = $this->db->where($where_array3 )->count_all_results('em_user_requests');
						 $request_count = $query3;
						 $get_location_name = $this->db->get_where('pincode', ['id'=>$events->location]);
							foreach($get_location_name->result() as $l);
						$location = $l->location;
						//
						/*$where_array4 = " event = '".$events->event."'  ";
						$query4 = $this->db->where($where_array4 )->get('em_user_sponsorship');
						$sum = 0 ;
						if ($query4->num_rows() > 0) 
						{
							foreach ($query4->result() as $r)
							{
								$sum = $sum + $r->amount;
							}
							
						}
						$contributions = $sum;
						
						if($contributions > $events->budget)
						{
							$balance =   $contributions - ($events->budget);
						}
						else
						{
							$balance = ($events->budget) - $contributions ;
						}*/
						//
						?>
                        <tr>
                        <td><?php echo $events->event;?></td>
                         <td><?php echo $events->name;?></td>
                          <td>Rs. <?php echo $events->budget;?></td>
                          <!-- <td>Rs. <?php// echo $contributions;?></td>
                           <td><?php// echo $balance;?></td>-->
                           <td><?php echo $location;?></td>
                            <td><?php echo $events->start_date;?></td>
                             <td><?php echo  $events->end_date;?></td>
                              <td><?php echo $reg_count;?></td>
                               <td><?php echo $sponsorship_count;?></td>
                                <td><?php echo $request_count;?></td>
                                
                        </tr>
                        <?php } ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Event</th>
                                <th>Name </th>
								<th>Budget</th>
                                 <!--<th>Contributions</th>
                                  <th>Required</th>-->
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Registration</th>
                                 <th>Sponsorship</th>
                                 <th>Requests</th>
                            </tr>
                        </tfoot>

                    </table>
    
                </div><!-- /.box-body -->
    
               
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
 <?php }   else { echo 'No events ' ;}?>






