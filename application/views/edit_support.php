


<?php

function page_css() { ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
                    <h3 class="box-title">Edit Support</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('ticket_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Ticket No.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="ticket_no" id="name" class="form-control" readonly value="<?php echo $ticket_list->ticket_no; ?>" placeholder="">
                            <?php echo form_error('ticket_no') ?>
                        </div>

                    </div>






                    <div class="form-group <?php if (form_error('raised_by')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Raised By
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="raised_by_name" class="form-control" readonly  value="<?php
                            $query = $this->db->get_where('users', ['id' => $ticket_list->created_by]);

                            if ($query->num_rows() > 0) {
                                foreach ($query->result() as $row) {
                                    echo $row->first_name . " " . $row->last_name;
                                }
                            } else {
                                echo "user name not Exist";
                            }
                            ?>" placeholder="">
                            <input type="hidden" name="raised_by" class="form-control"  value="<?php echo $ticket_list->created_by; ?>" placeholder="">
                            <?php echo form_error('raised_by') ?>
                        </div>

                    </div>






                    <div class="form-group <?php if (form_error('consumer_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Consumer Id</label>
                        <div class="col-md-9">

                            <input type="text" name="consumer_id" class="form-control" readonly  value="<?php
                            $query = $this->db->get_where('users', ['id' => $ticket_list->created_by]);

                            if ($query->num_rows() > 0) {
                                foreach ($query->result() as $row) {
                                    echo $row->referral_code;
                                }
                            } else {
                                echo "user name not Exist";
                            }
                            ?>" placeholder="">

                            <?php echo form_error('consumer_id') ?>                       
                        </div>				
                    </div>


                    <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="business_id" class="form-control" readonly value="<?php
                            $query = $this->db->get_where('business_groups', ['id' => $ticket_list->business_id]);

                            if ($query->num_rows() > 0) {
                                foreach ($query->result() as $row) {
                                    echo $row->business_name;
                                }
                            } else {
                                echo "business name not Exist";
                            }
                            ?>" placeholder="">
                                   <?php echo form_error('business_name') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('issue')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Issue
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="issue" class="form-control" readonly value="<?php echo $ticket_list->issue_type; ?>" placeholder="">
                            <?php echo form_error('issue') ?>
                        </div>
                    </div>					

                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
					 if ($rolename == '11' ) {
                   
						
                        ?>
						
					
					
					  <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Role Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">  								

                                <select name="" id="role_id" class="form-control" onchange="get_userid(this.value)" style="width:100% auto">
                                    <option value=""> Choose option </option>
                                    <?php
                                    $users = $this->db->get_where('role', ['id']);
                                    //$users = $this->db->get_where('role', ['id' => '36']);
                                    if ($users->num_rows() > 0) {
                                        foreach ($users->result() as $c) {

                                            echo "<option value=" . $c->id . ">" . $c->rolename . "</option>";
                                        }
                                    }
                                    ?>
                                </select>	                                
                                <?php echo form_error('rolename') ?>

                            </div>
                        </div>
						<?php } ?>
						
						
						
					 <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
                    if ($rolename == '11' OR $rolename == '36' ) {
						
                        ?>
						
					<div class="form-group <?php if (form_error('user_id')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Assigned To 	
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">  								

                                    <select name="assigned_to" id="user_id" class="form-control" style="width:100% auto">
                                        <option value="<?php echo $ticket_list->assigned_to; ?>"> Choose option </option>
                                        <?php
										$condition =" rolename = 36 OR rolename = 76 ";
                                        $users = $this->db->where($condition)->get('users');
                                        if ($users->num_rows() > 0) {
                                            foreach ($users->result() as $c) {

                                                echo "<option value=" . $c->id . ">" . $c->first_name . " " . $c->last_name . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>	                                
                                    <?php echo form_error('user_id') ?>

                                </div>
                    </div> 
					
					

                        <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Ticket status
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">  								

                                <select name="current_status" id="status" class="form-control" onchange="change_resolved_by(this.value)" style="width:100% auto">
                                    <option value="<?php echo $ticket_list->current_status; ?>"> Choose option </option>
                                    <?php
                                    if ($status->num_rows() > 0) {
                                        foreach ($status->result() as $c) {

                                            echo "<option value=" . $c->id . ">" . $c->status . "</option>";
                                        }
                                    }
                                    ?>
                                </select>	                                
                                <?php echo form_error('status') ?>

                            </div>
                        </div>

                        <?php
                    } else {
                        $ticket_no = $ticket_list->ticket_no;
                        $get = $this->db->order_by('id', 'asc')->get_where('support_track', ['ticket_no' => $ticket_no]);
                        foreach ($get->result() as $t)
                            ;
                        $role_id = $t->role_id;
                        $assigned_to = $t->assigned_to;
                        ?>
                        <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
                        <input type="hidden" name="assigned_to" value="<?php echo $assigned_to; ?>">



                        <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Ticket status
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">  								

                                <select name="current_status" id="status" class="form-control"  style="width:100% auto">
                                    <option value=""> Choose option </option>
                                    <?php
                                    if ($status->num_rows() > 0) {
                                        foreach ($status->result() as $c) {

                                            echo "<option value=" . $c->id . ">" . $c->status . "</option>";
                                        }
                                    }
                                    ?>
                                </select>	                                
                                <?php echo form_error('status') ?>

                            </div>
                        </div>

                    <?php } ?>


                    <div class="form-group <?php if (form_error('comments')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Comments</label>                         
                        <div class="col-md-9">
                            <textarea name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Enter Comments" required></textarea>
                            <?php echo form_error('comments') ?>
                        </div>
                    </div> 




                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                                <!--<a href="< ?php echo base_url('support/view_support_status/' . $ticket_list->ticket_no) ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>Back</a>-->

                    <button type="submit" name="submit" value="edit_support" class="btn btn-success">
                        <i class="fa fa-edit"></i> Update
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->



<?php

function page_js() { ?>



    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
                                    function change_resolved_by(id)
                                    {
                                        if (id == "5") {
                                            $("#resolve_date").html('<input type="date" class="form-control" id="end_date" name="resolved_on" placeholder="mm/dd/yyyy">');

                                        }



                                        //document.getElementById("test").value = document.getElementById("user_id").value;
                                    }
    </script>
    <script>
        $('select').select2();

        function get_userid(id)
        {
            //	alert(id);

            var mydata = {"role": id};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('support/getname') ?>",
                data: mydata,
                success: function (response) {
                    $("#user_id").html(response);
                    //$("#resolved_by").html(response);
                    //alert(response);
                }
            });
        }


    </script> 

<?php } ?>





