
<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    <!-- select -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
    <!-- Add Event-->
        <div class="col-md-12" id="add_form">
            <!-- general form elements -->

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3>
                </div><!-- /.box-header -->
                <!-- Add My Stock form start -->
                <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
                    <div class="box-body">
                    <div class="form-group <?php if (form_error('categ')) echo 'has-error'; ?>">
								<label for="country" class="col-md-3">Category
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" id="elocation" >  
                                	<select name="categ" id="categ" class="form-control">
										<option value=""> Choose Category </option>
										<?php
										if ($category->num_rows() > 0) 
										{
											foreach ($category->result() as $categ) 
											{
												echo '<option value="'.$categ->id.'"> '.$categ->name.'</option>';
											}
										}
										?>
									</select>	
                                                                 
									<?php echo form_error('categ') ?>

								</div>
						</div>
                    	
                        <div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="name" class="col-md-3"> Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Event Name">
                                <?php echo form_error('name') ?>
                            </div>
                        </div>
                         <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                  		<button type="submit" name="submit" value="create_subcateg" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add 
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- Register-->
        
        

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
    
   
    
<?php } ?>


