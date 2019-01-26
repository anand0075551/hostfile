 <!-- PDF Export -->
 <?php 
foreach ($terms->result() as $ut)
{
	
$user_id = $ut->user_id;
$currentUser = singleDbTableRow($user_id)->rolename;
$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
$track_id = $ut->track_id;
$get_details = $this->db->get_where('term_condition_track', ['id'=>$track_id]);
foreach($get_details->result() as $t);
 ?>

<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
        <h6 align="left">Terms & Conditions</h6>
       
            <table class="table no-border" style="width: 100%">
                <tr align="center">
                    <td><h3><?php  echo $t->file_name;?></h3>  </td>
                 </tr>
                 <tr>
                    <td>From: <?php  echo $t->valid_from;?> &nbsp;&nbsp; To : <?php  echo $t->valid_to;?>< </td>
                </tr>
            </table>

        </div><!-- /.col -->
    </div>
    </section>
    <section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php $labels = $this->db->order_by('id','desc')->get_where('term_condition_labels', ['term_ID' => $t->term_ID]);
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
					echo $string; 
					?>
                   
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>

<?php } ?>
