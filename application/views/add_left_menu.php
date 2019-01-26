
<?php function page_css(){ ?>


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
                    <h3 class="box-title">Add Left Menu:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
			                <div class="form-group <?php if(form_error('left_menu_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Left Menu Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="left_menu_name" class="form-control" value="<?php echo set_value('left_menu_name'); ?>" placeholder="Enter Left Menu Name">
                                <?php echo form_error('left_menu_name') ?>
                            </div>
                        </div>
								
					 

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_left_menu" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Left Menu
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
</script>


<?php function page_js(){ ?>

<?php } ?>

