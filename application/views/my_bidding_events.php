<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

<?php } ?>

<?php include('header.php');?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-header">
                   <div class="box-body">
						<?php 
						if(!empty($events) && $events->num_rows() > 0)
						{ 
							foreach($events->result() as $r)
							{
						?>
                                 <div class="col-lg-3 col-xs-6">
                            		<div class="small-box bg-blue" id="events">
                                	<div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        <?php echo 'Event : '.$r->event_no;?>
										</font>
                                    </h3>
                                   
                                    <p>
                                        <?php echo 'Date & Time : '.$r->start_time.' - '.$r->end_time;?>
                                    </p>
                                    <p>
                                        <?php echo 'Product : '.$r->title;?>
                                    </p>
                                    <p>
										<?php $array = explode(',', $r->users);
										$users = count($array);?>
										<font size="4" color=""> <?php echo $users-1; ?> </font>Users are available for this event
                                    </p>
                                    
                                 <p>
                                <?php
								$today=date('Y/m/d H:i');
								$datetime1 = new DateTime($today);
								$datetime2 = new DateTime($r->end_time);
								$interval = $datetime1->diff($datetime2);
								
								echo "You Have ".$interval->format('%d')." Days ".$interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
									?>
									<h4>
                                    <a href="<?php echo base_url('bidding/bidding_event_chat/'. $r->event_no);?>">
                                   <font color="#FFFFFF"> Start Now <i class="fa fa-arrow-circle-right"></i> </font></a></h4>
								</p>
                                   
                                </div>
                                
                            </div>
                            </div>
                            
                            <?php } } else { echo 'You dont have any events right now';}?>
                         </div>
                </div><!-- /.box-header -->
                <!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>
 <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  

<?php } ?>

