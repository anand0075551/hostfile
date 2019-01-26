
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
                    <h3 class="box-title">Edit Business Forms:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                         <div class="form-group <?php if (form_error('bg_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="bg_id"  class="form-control">
							<?php
                                if ($leftmenu->bg_id != '') {
                                    ?> <option value="<?php echo $leftmenu->bg_id; ?>"> <?php
                                        $leftmenu->bg_id;
                                        $table_name = 'menu_bg_forms';
                                        $where_array = array('bg_id' => $leftmenu->bg_id);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $state_id = $row1->bg_id;

                                                $table_name = 'menu_business_groups';
                                                $where_array = array('id' => $state_id);
                                                $query2 = $this->db->where($where_array)->get($table_name);
                                                foreach ($query2->result() as $row2) {
                                                    $state_name = $row2->business_name;
                                                }
                                            }

                                            echo $state_name;
                                        } else {
                                            echo "reporting manager not exit";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option value=" "> Choose option </option>

                                <?php
                                 if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            <!--    <option value=""> Choose option </option>
                                < ?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>-->
                            </select>	                                
                            <?php echo form_error('bg_id') ?>

                        </div>
                </div>
				
				
				
				                <div class="form-group <?php if (form_error('category_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Category Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="category_name"  class="form-control">
                         							<?php
                                if ($leftmenu->category_name != '') {
                                    ?> <option value="<?php echo $leftmenu->category_name; ?>"> <?php
                                        $leftmenu->category_name;
                                        $table_name = 'menu_bg_forms';
                                        $where_array = array('category_name' => $leftmenu->category_name);
                                        $quer = $this->db->where($where_array)->get($table_name);
                                        if ($quer->num_rows() > 0) {
                                            foreach ($quer->result() as $ro) {
                                                $stat = $ro->category_name;

                                                $table_name = 'menu_business_groups';
                                                $where_array = array('id' => $stat);
                                                $que = $this->db->where($where_array)->get($table_name);
                                                foreach ($que->result() as $r) {
                                                    $state_nam = $r->business_name;
                                                }
                                            }

                                            echo $state_nam;
                                        } else {
                                            echo "reporting manager not exit";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option value=" "> Choose option </option>

                                <?php
                                 if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
								
                               <!-- < ?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>-->
                            </select>	                                
                            <?php echo form_error('category_name') ?>

                        </div>
                </div>
				
				
				
									        <div class="form-group <?php if(form_error('font')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Font
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="font" class="form-control" value="<?php echo $leftmenu->font; ?>" placeholder="Enter Sub Category Name">
                                <?php echo form_error('font') ?>
                            </div>
                        </div>
						
						
					
				<!--	        <div class="form-group < ?php if(form_error('sub_category')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub Category Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="sub_category" class="form-control" value="< ?php echo $leftmenu->sub_category; ?>" placeholder="Enter Sub Category Name">
                                < ?php echo form_error('sub_category') ?>
                            </div>
                        </div>-->
		<div class="form-group <?php if(form_error('displayform_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Display Form Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="displayform_name" class="form-control" value="<?php echo $leftmenu->displayform_name; ?>" placeholder="Enter Display Form Name">
                                <?php echo form_error('displayform_name') ?>
                            </div>
                        </div>
					                        <div class="form-group <?php if(form_error('controller')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Controller
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="controller" class="form-control" value="<?php echo $leftmenu->controller; ?>" placeholder="Enter Controller Name">
                                <?php echo form_error('controller') ?>
                            </div>
                        </div>
					
										                        <div class="form-group <?php if(form_error('phpfile_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">PHP File Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="phpfile_name" class="form-control" value="<?php echo $leftmenu->phpfile_name; ?>" placeholder="Enter PHP File Name ">
                                <?php echo form_error('phpfile_name') ?>
                            </div>
                        </div>
								
					 

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_business_form" class="btn btn-primary">
                            <i class="fa fa-edit"></i>Edit Business Form Details
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->



<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
        $('select').select2();
    </script> 
<?php } ?>

