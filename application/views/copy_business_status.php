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
                    <h3 class="box-title">Copy Status:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                    <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="business_name" id="business_name" class="form-control">
                                <?php
                                if ($status->business_name != '') {
                                    ?> <option value="<?php echo $status->business_name; ?>"> <?php
                                        $status->business_name;
                                        $table_name = 'status';
                                        $where_array = array('id' => $status->business_name);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $state_id = $row1->business_name;

                                                $table_name = 'business_groups';
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
                                <option value=""> Choose option </option>
                                <?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {
                                        // $selected = ($c->id == 105)? 'selected' : '';
                                        //echo '<option value="'.$c->id.'" '.$selected.'> '.$c->consignment_no.'</option>';
                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	
                            <?php echo form_error('business_name') ?>                       
                        </div>				
                    </div>
					
					
					
					
					<div class="form-group <?php if (form_error('to_role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">To Role<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="to_role[]" multiple  id="to_role" class="form-control">
                     <?php
                                    if ($status->to_role != "") {
                                        $pincode_name = explode(",", $status->to_role);
                                        foreach ($pincode_name as $id) {
                                            $query = $this->db->get_where('role', ['id' => $id]);
                                            foreach ($query->result() as $d) {
                                                echo "<option value='" . $id . "' selected>" . $d->rolename . "</option>";
                                            }
                                        }
                                    } else {
                                        echo "<option value=''>Select option</option>";
                                    }
                                    if ($role->num_rows() > 0) {
                                        foreach ($role->result() as $c) {

                                            echo '<option value="' . $c->id . '"> ' . $c->rolename . '</option>';
                                        }
                                    }
                                    ?>
                            </select>	
                            <?php echo form_error('to_role') ?>                       
                        </div>				
                    </div>
                  				                       
						
						
				<div class="form-group <?php if (form_error('transaction_mode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Language
                            <span class="text-red">*</span>
                        </label>

                        <div class="col-md-9">
							
							<select name="language_en" class="form-control">
                                <option value=""> Select  </option>
                                <option value="en" <?php if ($status->lang_en == 'en') echo 'selected'; ?>>english</option>
                               

                            </select>
                            <?php echo form_error('language_en') ?>
                        </div>
                    </div>

					





                    <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Status
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="status" class="form-control" value="<?php echo $status->status; ?>" placeholder="Enter District Name">                                
                            <?php echo form_error('status') ?>

                        </div>
                    </div>




                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="copy_business_status" class="btn btn-primary">
                        <i class="fa fa-edit"></i>Update
                    </button>
                    <a href="<?php echo base_url('business_status/view_business_status/' . $status->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Cancel</a>
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

