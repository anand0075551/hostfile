 <?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/seat/bootstrap.css" rel="stylesheet"/>
    <!--<link href="<?php// echo base_url('assets/admin'); ?>/css/seat/bootstrap-responsive.css" rel="stylesheet"/>-->
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
<section class="content">
                    <div class="row">
					<!----Temp Top row Box----->
					 <?php if($currentUser ==11 ) { ?>
						  <div  class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div   class="inner">
                                    <h3> <font size="4" color=""> 
                                       <?php echo $all_agriculture_land;?>
										</font>
                                    </h3>
                                    <p>  
                                        All land
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/all_agriculture_land') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-lime">
                                <div class="inner">
                                    <h3> <font size="4" color=""> 
                                      <?php echo $all_agriculture_project;?>
										</font>
                                    </h3>
                                    <p>  <font size="4" color=""> 
                                     All Project 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/all_agriculture_project') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                       <?php echo $all_land_estimate;?>
										</font>
                                    </h3>
                                    <p>
                                        All Estimate
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/all_land_estimate') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						                       <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         <?php echo $all_labour_account;?>
										</font>
                                    </h3>
                                    <p>
                                        All labour account 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/all_labour_account') ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
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
                                        create new Project
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/add_agriculture_project') ?>" class="small-box-footer">
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
                                        Create agriculture  land
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/agriculture_land') ?>" class="small-box-footer">
                                    Add Now <i class="fa fa-arrow-circle-right"></i>
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
                                        Add labour_account
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/add_labour_account') ?>" class="small-box-footer">
                                    Add Now <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
						
						 <?php if($currentUser ==11 ) { ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                         &nbsp;
										</font>
                                    </h3>
                                    <p>
                                        List labour account
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="<?php echo base_url('Agriculture/all_labour_account') ?>" class="small-box-footer">
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
                                        Add base materials
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div> 
								
                               
                                 <a href="<?php echo base_url('Agriculture/add_base_materials') ?>" class="small-box-footer">
                              
                                    Create Now <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
						 <?php if($currentUser ==11 ) { ?>
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                       List base materials
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
								<a href="<?php echo base_url('Agriculture/list_base_materials') ?>" class="small-box-footer">
                                 List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
						<?php } ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                       Add Agriculture input materials
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
								<a href="<?php echo base_url('Agriculture/add_Agriculture_input_materials') ?>" class="small-box-footer">
                                 List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
						
						 <?php if($currentUser ==11 ) { ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>  <font size="4" color=""> 
                                        &nbsp;
										</font>
                                    </h3>
                                    <p>
                                       list Agriculture input materials
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
								<a href="<?php echo base_url('Agriculture/list_Agriculture_input_materials') ?>" class="small-box-footer">
                                 List <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
							
                        </div>
                    </div>
                   <?php } ?>
<!-- -->
<div class="box-footer"></div>

