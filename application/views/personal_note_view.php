<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    <!--<link href="<?php// echo base_url('assets/admin'); ?>/css/seat/bootstrap-responsive.css" rel="stylesheet"/>-->
<?php } ?>

<?php include('header.php'); 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
?>
<?php

foreach ($notes->result() as $n)
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
    
                    <table class="table table-striped">
                         <tr>
                          	<th>Date : </th>
                            <td> <?php  echo $n->p_date;?></td>
                            <th>Title : </th>
                            <td> <?php  echo $n->title;?></td>
                            <th>Created By : </th>
                            <td> <?php  echo singleDbTableRow($n->created_by, 'users')->first_name.' '.singleDbTableRow($n->created_by, 'users')->last_name;?></td>
                         </tr>
                         <tr>
                          	<th>Created At : </th>
                            <td> <?php  echo date('y-m-d h:m:i',$n->created_at);?></td>
                            <th>Modified By : </th>
                            <td> <?php  if($n->modified_by !=0) { echo  singleDbTableRow($n->modified_by, 'users')->first_name.' '.singleDbTableRow($n->modified_by, 'users')->last_name ; }?></td>
                            <th>Modified At : </th>
                            <td> <?php  if($n->modified_at) { echo date('y-m-d',$n->modified_at); }?></td>
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
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Description</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $n->description;?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Note1</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $n->note1;?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Note2</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $n->note2;?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Note3</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $n->note3;?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Note4</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $n->note4;?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Note5</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $n->note5;?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
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
                <div class="box-body">

                    <table class="table table-striped">
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

<?php } }?>

<div class="box-footer">
	
     <a href="<?php echo base_url('Personal_note/personal_note_list/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
     
                    </div>
