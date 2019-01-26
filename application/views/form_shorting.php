<?php function page_css(){ ?>

<link href="<?php echo base_url('assets\admin\css\menu\style.css') ?>" rel="stylesheet" />
<?php } ?>
<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
				 <a href="<?php echo base_url('dashboard') ?>" class="btn btn-primary btn"><i class="fa fa-arrow-left"></i> Back</a>
								<hr>		
							    <div class="container">

								<div class="content">
								<?php if($menus->num_rows()>0) {?>
								<ul id="sortable">
								<?php foreach($menus->result() as $menu){ ?>
								<li id="<?php echo $menu->bgform_id; ?>">
									<span>||</span>
									<div><h2>&nbsp&nbsp&nbsp <b><?php echo $menu->displayform_name; ?></b></h2></div>
								</li>
								<?php } ?>
								</ul>
								<?php }?>
								</div><!-- content -->    

						</div><!-- container -->
                                        

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                         <div class="box-footer">
			 <a href="<?php echo base_url('dashboard') ?>" class="btn btn-primary btn"><i class="fa fa-arrow-left"></i> Back</a>
 </div>
                                      
										 
                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
				
				<?php function page_js(){ ?>
				
<script src="<?php echo base_url('assets\admin\js\menu'); ?>\jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets\admin\js\menu'); ?>\jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
				<script>
				/*
* Author : Ali Aboussebaba
* Email : bewebdeveloper@gmail.com
* Website : http://www.bewebdeveloper.com
* Subject : Dynamic Drag and Drop with jQuery and PHP
*/

$(function() {
    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
    		// change order in the database using Ajax
            $.ajax({
                url: '<?php echo base_url('Menu/set_order2'); ?>',
                type: 'POST',
                data: {list_order:list_sortable},
                success: function(data) {
                    //alert(data);
                }
            });
        }
    }); // fin sortable
});
</script>
				<?php } ?>