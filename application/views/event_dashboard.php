<?php include('header.php'); 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->rolename;
?>
<section class="content">
                    <div class="row">
					<!----Temp Top row Box----->
					 <?php if($currentUser ==11 || $currentUser==39) { ?>
						  <div  class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div   class="inner">
                                    <h3> <font size="4" color=""> 
                                       <?php echo $all_events;?>
										</font>
                                    </h3>
                                    <p>  
                                        Total Events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_search_report') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                      <?php echo $active_events;?>
										</font>
                                    </h3>
                                    <p>  <font size="4" color=""> 
                                        Active Events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_search_report') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                       <?php echo $inactive_events;?>
										</font>
                                    </h3>
                                    <p>
                                        Inactive Events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_search_report') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						                       <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         <?php echo $closed_events;?>
										</font>
                                    </h3>
                                    <p>
                                        Closed Events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_search_report') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         &nbsp;
										</font>
                                    </h3>
                                    <p>
                                        Add category
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_category') ?>" class="small-box-footer">
                                    Add Now <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         &nbsp;
										</font>
                                    </h3>
                                    <p>
                                        list category
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_category_list') ?>" class="small-box-footer">
                                    List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         &nbsp;
										</font>
                                    </h3>
                                    <p>
                                        Add Subcategory
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_sub_category') ?>" class="small-box-footer">
                                    Add Now <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         &nbsp;
										</font>
                                    </h3>
                                    <p>
                                        List Subcategory
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo base_url('Event_management/event_sub_category_list') ?>" class="small-box-footer">
                                    List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
						
					<?php } ?>
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                        Create event
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div> 
								<?php if($currentUser ==11 || $currentUser==39) { ?>
                                <a href="<?php echo base_url('Event_management/event_create') ?>" class="small-box-footer">
                                <?php } else { ?>
                                 <a href="<?php echo base_url('Event_management/event_create_mine') ?>" class="small-box-footer">
                                <?php } ?>
                                    Create Now <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                       List events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
								<a href="<?php echo base_url('Event_management/event_list') ?>" class="small-box-footer">
                                 List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                       Joined events
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
								<a href="<?php echo base_url('Event_management/event_joined_events') ?>" class="small-box-footer">
                                 List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                       My contributions
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
								<a href="<?php echo base_url('Event_management/event_my_contributions') ?>" class="small-box-footer">
                                 List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                    </div>
                   
<!-- -->
<div class="box-footer"></div>

