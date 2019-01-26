<?php include('header.php'); 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
?>
<?php

foreach ($category->result() as $categ)
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
                    <h3 class="box-title">
                    <?php  
                            $get_cname = $this->db->get_where('users', ['id'=>$categ->created_by]);
                            foreach($get_cname->result() as $h);
                            $createdby = $h->first_name.' '.$h->last_name;?>
                    Name:<?php  echo $categ->name;?> Created By :<?php  echo $createdby;?> Created At : <?php echo date('Y-m-d h:m:i',$categ->created_at);?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <h4>Events</h4>
    <?php if (!empty($events) && $events->num_rows() > 0) {?>
                    <table class="table table-striped">
                       <tr>
                        	 <th>Sl:No</th>
                            <th>Event</th>
                            <th>Name</th>
                            <th>Budget</th>
                            <th>Created By</th>
                             <th>Created At </th>
                        </tr>
                        <?php $cnt = 1 ;
						foreach ($events->result() as $e)
						 {?>
                         <tr>
                         <td><?php echo $cnt;?></td>
                         <td><?php echo '<a  href="' . base_url('Event_management/event_view/' . $e->event) . '" data-toggle="tooltip" title="View"> '.$e->event.'</a>'?></td>
                         <td><?php echo $e->name;?></td>
                         <td><?php echo $e->budget;?></td>
                         <?php  
                            $get_name = $this->db->get_where('users', ['id'=>$e->created_by]);
                            foreach($get_name->result() as $h);
                            $created_by = $h->first_name.' '.$h->last_name;?>
                         <td><?php echo $created_by;?></td>
                         <td><?php echo date('Y-m-d h:m:i',$e->created_at);?></td>
                         </tr>
                         <?php $cnt++; }?>
                      </table>
   <?php }  else echo 'No events ';?>
                </div><!-- /.box-body -->
    
               
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
 <?php } ?>
 <div class="box-footer">
	
     <a href="<?php echo base_url('Event_management/event_sub_category_list/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
     
                    </div>