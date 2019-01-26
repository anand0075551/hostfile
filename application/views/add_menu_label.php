
<?php function page_css(){ ?>

<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
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
                    <h3 class="box-title">Add New Menu Label</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					

			
				

				
				
				
				
				
				
						
							<div class="form-group <?php if(form_error('bussiness_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Enter Menu Label</label>
                            <div class="col-md-9">
                                <input type="text"  name="bussiness_name"  class="form-control" value="" placeholder="Enter Left Menu Name ">
                                <?php echo form_error('bussiness_name') ?>
                            </div>
                        </div>
						
													<div class="form-group <?php if(form_error('comments')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Enter Comments</label>
                            <div class="col-md-9">
                                <input type="text"  name="comments"  class="form-control" value="" placeholder="Enter Comments ">
                                <?php echo form_error('comments') ?>
                            </div>
                        </div>

						
			
			

			
                          <div class="clearfix"></div>
                    </div><!-- /.box-body -->
		
		
		                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_menu_label" class="btn btn-primary">
                            <i class="fa fa-check"></i> Create Label
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->
			
			
			
			
			
			
			
       </div><!--/.col (left) -->
        <!-- right column -->
 </div>   <!-- /.row -->
</section><!-- /.content -->
<script>
function outputValue(item){
    document.getElementById('container').innerHTML = item.value;

}
	function outputStatus(item){
    document.getElementById('container2').innerHTML = item.value;

}
</script>


<?php function page_js(){ ?>
	    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>

