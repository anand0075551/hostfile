
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
                    <h3 class="box-title">Copy Assign Forms</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


 <div class="form-group <?php if (form_error('role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Role
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                          <select name="role_id" class="form-control" style=" width:100% auto; ">
                     <?php
                                    if ($leftmenu->role_id != "") 
										{
                                    ?> <option value="<?php echo $leftmenu->role_id; ?>"> <?php
                                        echo singleDbTableRow($leftmenu->role_id, 'role')->rolename; 
                                        ?></option>
                                    <?php
                                }
										else {
                                        echo "<option value=''>Select option</option>";
                                    }
									$role = $this->db->get('role');
                                    if ($role->num_rows() > 0) {
                                        foreach ($role->result() as $c) {

                                            echo '<option value="' . $c->id . '"> ' . $c->rolename . '</option>';
                                        }
                                    }
                                    ?>
                            </select>	                              
                            <?php echo form_error('role') ?>

                        </div>
                </div>
				
				                <div class="form-group <?php if (form_error('bg_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="bg_id" class="form-control" style=" width:100% auto; ">
								<option value="<?php  echo $leftmenu->bg_id; ?>"><?php echo singleDbTableRow($leftmenu->bg_id, 'menu_business_groups')->business_name; ?> </option>
							
                            </select>	                                
                            <?php echo form_error('bg_id') ?>

                        </div>
                </div>
				
				 <div class="form-group <?php if (form_error('bgform_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Form Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="bgform_id[]" multiple  class="form-control" id="forms">
                                 <?php
                                    if ($leftmenu->bgform_id != "") {
                                        
                                        $query = $this->db->get_where('menu_role_permission', ['bg_id' => $leftmenu->bg_id,'role_id'=>'11']);
                              foreach ($query->result() as $d) {
							$get_form = $this->db->get_where('menu_bg_forms', ['bgform_id'=>$d->bgform_id]);	
							if($get_form->num_rows() > 0){
								foreach($get_form->result() as $form_id);
								$bgform_id = $form_id->displayform_name;
							}
				echo "<option value='". $d->bgform_id."' selected>" . $bgform_id ."</option>";                    
															}
   
                                    } else {
                                        echo "<option value=''>Select option</option>";
                                    }
                                   
                                    ?>
                            </select>	                                
                            <?php echo form_error('bgform_id') ?>

                        </div>
                </div>
				



		
		
					

                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_form_assignment" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Assign Form
                </button>
				<a href="<?php echo base_url('menu/assigned_forms') ?>" class="btn btn-info"><i class="fa fa-arrow-edit"></i>Back</a>
				
				<div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->






<!-- Validation -->





<?php function page_js() { ?>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
        $('select').select2();
    </script> 

	
	
	
	
	<script>
	function get_forms(bgform_id)
{
//    alert(bgform_id);
    var mydata = {"forms": bgform_id};

    $.ajax({
        type: "POST",
        url: "getforms",
        data: mydata,
        success: function (response) {
            $("#forms").html(response);
          //  alert(response);
        }
    });
}
 </script> 

<?php } ?>

