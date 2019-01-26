
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
                    <h3 class="box-title">Assign Permission</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
            <div class="form-group <?php if(form_error('userrole')) echo 'has-error'; ?>">
                    <label for="firstName" class="col-md-3">Select User Roles</label>
                    <div class="col-md-9">
                        <select name="userrole" class="form-control"  >
                            <option value=""> Select User Role </option>
                            <?php
                            if($role->num_rows() > 0)
                            {
                            foreach($role->result() as $c){
                            $selected = ($c->id == 105)? 'selected' : '';

						    echo '<option value=" '.$c->roleid.' " '.$selected.'> '.$c->rolename. '</option>';	
								
                            }
                            }
                            ?>
                        </select>
                        <?php echo form_error('userrole') ?>
				
            </div>
						
				</div>	
			
				
    					
            <div class="form-group <?php if(form_error('business_name')) echo 'has-error'; ?>">
                    <label for="firstName" class="col-md-3">Select Left Menu Name</label>
                    <div class="col-md-9">
                        <select name="business_name" class="form-control"  >
                            <option value=""> Select Label</option>
                            <?php
                            if($bussiness_name->num_rows() > 0)
                            {
                            foreach($bussiness_name->result() as $c){
                           

						    echo '<option value=" '.$c->id.' " '.$selected.'>'.$c->id. '- '.$c->bussiness_name. '-'.$c->comments. '</option>';	
								
                            }
                            }
                            ?>
                        </select>
                        <?php echo form_error('business_name') ?>
				
            </div>
						
				</div>
				
				
				
				
				
						
						
					            <div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                <label for="firstName" class="col-md-3"> Permission
                    <span class="text-red">*</span>
                </label>
                <!--                        <div class="col-md-9">
                    <input type="text" name="profession" class="form-control" value="<-?php echo set_value('profession'); ?>" placeholder="Select the Member type">
                    <-?php echo form_error('profession') ?>
                </div>
                **********Profession and Role fields are considered same for time being/Sync with App\view\add_agent***********
                -->                     <div class="col-md-9">
                        <select name="status" class="form-control">
                            <option value="0"> Please Select Your Permission  </option>
                            <option value="1" >Active (1)</option>
                            <option value="0" >InActive (0)</option>
                        </select>
                        <?php echo form_error('status') ?>

                </div>
            </div>	
						
			
			

			
                          <div class="clearfix"></div>
                    </div><!-- /.box-body -->
		
		
		                    <div class="box-footer">
                        <button type="submit" name="submit" value="assign_role_to_group" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Assign Permission
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

