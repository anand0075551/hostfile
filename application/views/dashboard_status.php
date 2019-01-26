<?php include('header.php'); ?>
<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/dashboard_external/style.css" type="text/css"  rel="stylesheet">
	<link href="<?php echo base_url('assets/admin'); ?>/css/dashboard_external/bootstrap-responsive.min.css" rel="stylesheet">
<?php } ?>
<?php
$deactive  = $this->db->where('current_status',1)->count_all_results('ticket_list');
$active    = $this->db->where('current_status',2)->count_all_results('ticket_list');
$hold      = $this->db->where('current_status',3)->count_all_results('ticket_list');
$pending   = $this->db->where('current_status',4)->count_all_results('ticket_list');
$completed = $this->db->where('current_status',5)->count_all_results('ticket_list');
$total     = $this->db->count_all_results('ticket_list');
?>


<br>
<div class="container-fluid-full">
    <div class="row-fluid">
        <!-- left column -->
        <div class="col-md-12">
		
            <!-- general form elements -->
			<div class="row-fluid">
				
				<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2,9,-2,5,10,20</div>
					<div class="number"><?php echo $completed?></div>
					<div class="title">Completed tickets</div>
					<div class="footer">
						<a href="<?php echo base_url('support/complete_support/') ?>">See Completed ticket list</a>
					</div>	
				</div>
				<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number"><?php echo $total?></div>
					<div class="title">Total tickets</div>
					<div class="footer">
						<a href="<?php echo base_url('support/') ?>">See All ticket list</a>
					</div>
				</div>
				<div class="span3 statbox black noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number"><?php echo $pending?></div>
					<div class="title">Pending tickets</div>
					<div class="footer">
						<a href="<?php echo base_url('support/not_complete/')?>">See pending ticket list</a>
					</div>
				</div>
				<div class="span3 statbox blue" onTablet="span6" onDesktop="span3">
					<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
					<div class="number"><?php echo $active?></div>
					<div class="title">Active tickets</div>
				</div>	
			</div>
				<br><br><br><br>
				
				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header" style="height:35px">
						<h2><i class="glyphicon glyphicon-hand-up"></i><span class="break"></span>Status Bar</h2>
					</div>
					<div class="box-content" style="height:250px">
						<ul class="skill-bar">
				        	<li>
				            	<h5>Deactive(<?php echo $deactive?>)</h5>
				            	<div class="meter red"><span style="width:<?php echo $deactive?>%"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Active(<?php echo $active?>)</h5>
				            	<div class="meter blue"><span style="width: <?php echo $active?>%"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Hold(<?php echo $hold?>)</h5>
				            	<div class="meter orange"><span style="width: <?php echo $hold?>%"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Pending(<?php echo $pending?>)</h5>
				            	<div class="meter black"><span style="width: <?php echo $pending?>%"></span></div><!-- Edite width here -->
				          	</li>
							<li>
				            	<h5>Completed(<?php echo $completed?>)</h5>
				            	<div class="meter green"><span style="width: <?php echo $completed?>%"></span></div><!-- Edite width here -->
				          	</li>
				      	</ul>
					</div>	
				</div><!--/span-->
			</div>
         </div>		
	</div>
</div>
</div>
<?php function page_js(){ ?>
	    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery-migrate-1.0.0.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery-ui-1.10.0.custom.min.js"></script>
		<script src='<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.dataTables.min.js'></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.chosen.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.uniform.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.cleditor.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.elfinder.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.raty.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.uploadify-3.1.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.masonry.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/dashboard_external/custom.js"></script>
		
<?php }?>