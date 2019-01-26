
<?php

function page_css() { ?>
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
                    <h3 class="box-title">Insert Template & Content</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


             
					<div class="form-group <?php if(form_error('mediam_type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Select mediam</label>
								<div class="col-md-9">
							<select name="mediam_type" id="mediam_type" class="form-control" onChange="get_ticket_no()" style="width:100% auto">
								<option value=""> Choose option </option>
								<option value="SMS">SMS</option>
								<option value="EMAIL">EMAIL</option>
							</select>	
								<?php echo form_error('mediam_type') ?>
							<div id="output" >
							</div>
							</div>				
					</div>
					
					
				<div class="form-group <?php if(form_error('template_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Template name</label>
                            <div class="col-md-9">
                                <input type="text" name="template_name" class="form-control" value="" placeholder="">
                                <?php echo form_error('template_name') ?>
                           </div>
                </div>
				
				
				
				<div class="form-group <?php if(form_error('content_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Content Name</label>
                            <div class="col-md-9">
                                <input type="text" name="content_name" class="form-control" value="" placeholder="">
                                <?php echo form_error('content_name') ?>
                            </div>
                </div>
				
			
					
					
           
			</div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="add_email" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->



</section><!-- /.content -->


<?php

function page_js() { ?>
   
	
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script> 
  

<?php } ?>

