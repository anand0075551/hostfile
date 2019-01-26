 <!-- PDF Export -->
 <?php 
 $user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
 foreach ($terms->result() as $t) { ?>
<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="window.print()">
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <!-- Main content -->
                    <section class="content invoice">
                        <!-- title row -->
                        
                        <!-- info row -->
                        <div class="row">
                            <div class="col-xs-12">
                            <h6 align="left">Terms & Conditions</h6>
                           
                                <table class="table no-border" style="width: 100%">
                                    <tr align="center">
                                        <td><h3><?php  echo $t->file_name;?></h3>  </td>
                                     </tr>
                                     <tr>
                                        <td>From: <?php  echo $t->valid_from;?> &nbsp;&nbsp; To : <?php  echo $t->valid_to;?></td>
                                    </tr>
                                </table>
                    
                            </div><!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
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
                        <!-- /.row -->

                        <!-- /.row -->


                        
                    </section><!-- /.content -->


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

</body>
</html>


<?php } ?>
