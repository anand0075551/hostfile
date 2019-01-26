<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    <!--<link href="<?php// echo base_url('assets/admin'); ?>/css/seat/bootstrap-responsive.css" rel="stylesheet"/>-->
<?php } ?>

<?php include('header.php'); 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
?>
<?php

foreach ($terms->result() as $t)
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
                <div class="box-body table-responsive no-padding">
    
                    <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <td><?php  echo $t->file_name;?></td>
                        <th>Unique ID</th>
                        <td><?php  echo $t->term_ID;?></td>
                        </tr>
                         <tr>
                          	<th>To Role : </th>
                            <td> <?php  echo singleDbTableRow($t->role, 'role')->rolename;?></td>
                            <th>Status : </th>
                            <td> <?php  echo singleDbTableRow($t->status, 'status')->status;?></td>
                          </tr>
                          <tr>
                          	<th>Valid From : </th>
                            <td> <?php  echo $t->valid_from;?></td>
                            <th>Valid To : </th>
                            <td> <?php  echo $t->valid_to;?></td>
                          </tr>
                         <tr>
                         	<th>Created By : </th>
                            <td> <?php  echo singleDbTableRow($t->created_by, 'users')->first_name.' '.singleDbTableRow($t->created_by, 'users')->last_name;?></td>
                          	<th>Created At : </th>
                            <td> <?php  echo date('y-m-d h:m:i',$t->created_at);?></td>
                          </tr>
                          <tr>
                            <th>Modified By : </th>
                            <td> <?php  if($t->modified_by !=0) { echo  singleDbTableRow($t->modified_by, 'users')->first_name.' '.singleDbTableRow($t->modified_by, 'users')->last_name ; }?></td>
                            <th>Modified At : </th>
                            <td> <?php  if($t->modified_at) { echo date('y-m-d h:m:i',$t->modified_at); }?></td>
                         </tr>
                         <tr>
                         <th>OTP Notification : </th>
                            <td> <?php  if($t->otp == 1) { echo 'Yes'; } else { echo 'No'; }?></td>
                         <th>No: of accepted Users</th>
                         <?php  $where_array =" term_ID = '".$t->term_ID."' AND terms_read =1 ";
				$users_count = $this->db->where($where_array )->count_all_results('term_condition_user')?>
                <td><?php echo $users_count;?></td>
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
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Labels</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php $labels = $this->db->get_where('term_condition_labels', ['term_ID' => $t->term_ID]);
					if($labels ->num_rows() >0)
					{
					?>
                    <div class="box-body table-responsive no-padding">
    
                    <table class="table table-hover">
                    <tr>
                        <th>Sl.No:</th>
                        <th>Label</th>
                        <th>Field</th>
                    </tr>
                    <?php $cnt = 1; foreach ($labels->result() as $l) { ?>
                    <tr>
                    	<td><?php echo $cnt;?></td>
                        <td><?php echo $l->t_label;?></td>
                         <td><?php echo $l->t_field;?></td>
                    </tr>
                    <?php $cnt++; } ?>
					</table>
                    </div>
                    <?php } ?>
                   
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
 <!-- -->
 <section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">File : <?php echo $t->file_name;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php 
					 $labels = $this->db->order_by('id','desc')->get_where('term_condition_labels', ['term_ID' => $t->term_ID]);
					if($labels ->num_rows() >0)
					{
						$replace  = '';
						$find     = '';
						$string = $t->file_data;
						foreach ($labels->result() as $l) 
						{ 
							 
							$field = $l->t_field;
							$field_value =  singleDbTableRow($user_id)->$field;
							$string   = str_replace($l->t_label,$field_value,$string);
						 	
						}
							
					 } 
					 else
					 { 
					 
						$string = $t->file_data;
					 }
					
					$stringCut = substr($string, 0, 500);
					$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="' . base_url('Term_condition/term_condition_pdf/' . $t->id) . '">Read More</a>';
					echo $string;
					
					?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<!-- -->

<?php if($terms_track ->num_rows() >0) { ?>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                        	<th>Action</th>
                            <th>Terms ID.</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                            <th>Status</th>
                            <th>OTP</th>
                          </tr>
                    </thead>
                    <?php foreach ($terms_track->result() as $tt)
					{
					?>
					<tr>
                    <td><a class="btn btn-primary editBtn" href="<?php echo  base_url('Term_condition/term_condition_track_view/' . $tt->id) ;?>" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>&nbsp;
                    <a href="<?php echo  base_url('Term_condition/term_condition_track_pdf_export/' . $tt->id) ;?>" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a> 
                    </td>
                    <td><?php echo $tt->term_ID;?></td>
                    <td><?php echo $tt->file_name;?></td>
                    <td><?php echo singleDbTableRow($tt->role, 'role')->rolename;?></td>
                    <td><?php echo $tt->valid_from;?></td>
                    <td><?php echo $tt->valid_to;?></td>
                    <td><?php echo singleDbTableRow($tt->status, 'status')->status;?></td>
                    <td><?php  if($tt->otp == 1) { echo 'Yes'; } else { echo 'No'; }?></td>
                    </tr>
											
									   
					<?php } ?>
                     </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<?php } ?>
<!-- -->
<?php if($users_track ->num_rows() >0) { ?>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Users Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="example" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                        	<th>Actions</th>
                        	<th>Terms ID.</th>
                            <th>Name.</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Read</th>
                            <th>OTP</th>
                            <th>Read At</th>
                          </tr>
                    </thead>
                    <?php foreach ($users_track->result() as $ut)
					{
					?>
					<tr>
                    <td><a class="btn btn-primary editBtn" href="<?php echo  base_url('Term_condition/term_condition_user_track_view/' . $ut->id) ;?>" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>&nbsp;
                    
                    </td>
                    <td><?php echo $ut->term_ID;?></td>
                    <td><?php echo $ut->file_name;?></td>
                    <td><?php echo singleDbTableRow($ut->user_id, 'users')->first_name.' '.singleDbTableRow($ut->user_id, 'users')->last_name;?></td>
                    <td><?php echo singleDbTableRow($tt->role, 'role')->rolename;?></td>
                    <td><?php echo 'yes';?></td>
                    <td><?php echo $ut->otp;?></td>
                    <td><?php echo $ut->read_at?></td>
                    
                    </tr>
											
									   
					<?php } ?>
                     </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<?php } ?>
<div class="box-footer">
	
     <a href="<?php echo base_url('Term_condition/term_condition_report/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
     
                    </div>
