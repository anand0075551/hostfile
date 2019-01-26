


<?php

function page_css() { ?>

<?php } ?>







<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Post Comment</h3>
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
                        <label for="firstName" class="col-md-3">Raised User Name
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


 <!----------------------------------------------------START USER limitations--------------------------------------------------------->
                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
                    //if ($rolename == '11' || $rolename == '36' ) { 
                    if ($rolename == '12') {
                        ?>




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

                        <input type="hidden" name="current_status" class="form-control" readonly value="<?php echo $ticket_list->current_status; ?>" placeholder="">

                        <div class="form-group <?php if (form_error('raised_by')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Currently Assigned to 
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="raised_by_name"  class="form-control" readonly  value="<?php
                                $query = $this->db->get_where('users', ['id' => $ticket_list->assigned_to]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->first_name . " " . $row->last_name;
                                    }
                                } else {
                                    echo "not assigned";
                                }
                                ?>" placeholder="">

                                <input type="hidden" name="assigned_to" class="form-control"  value="<?php echo $ticket_list->assigned_to; ?>" placeholder="">

                                <input type="hidden" name="consumer_id" class="form-control" readonly  value="<?php
                                $query = $this->db->get_where('users', ['id' => $ticket_list->created_by]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->referral_code;
                                    }
                                } else {
                                    echo "user name not Exist";
                                }
                                ?>" placeholder="">




                                <input type="hidden" name="current_status" class="form-control" readonly value="<?php
                                $query = $this->db->order_by('id', 'asc')->get_where('support_track', ['ticket_no' => $ticket_list->ticket_no]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row)
                                        ;
                                    echo $row->current_status;
                                } else {
                                    echo "";
                                }
                                ?>" placeholder="">

                                <?php echo form_error('raised_by') ?>
                            </div>

                        </div>


                    <?php } ?>

 <!---------------------------------------------------END USER limitations-------------------------------------------------------->




<!---------------------------------------------------ADMIN USER limitations---------------------------------------------------->										

                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
                    //if ($rolename == '11' || $rolename == '36' ) { 
                    if ($rolename == '11' || $rolename == '36' ||  $rolename == '76' ) {
                    
                    
                        ?>
                        <input type="hidden" name="business_id" class="form-control" readonly value="<?php
                        $query = $this->db->get_where('business_groups', ['id' => $ticket_list->business_id]);

                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                                echo $row->business_name;
                            }
                        } else {
                            echo "business name not Exist";
                        }
                        ?>" placeholder="">


                        <input type="hidden" name="consumer_id" class="form-control" readonly  value="<?php
                        $query = $this->db->get_where('users', ['id' => $ticket_list->created_by]);

                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                                echo $row->referral_code;
                            }
                        } else {
                            echo "user name not Exist";
                        }
                        ?>" placeholder="">




                        <input type="hidden" name="issue" class="form-control" readonly value="<?php echo $ticket_list->issue_type; ?>" placeholder="">

                        <div class="form-group <?php if (form_error('comments')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Consumer Issue Detail
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea name="comments" id="comments" class="form-control" readonly  placeholder=""><?php echo $ticket_list->issue_details; ?></textarea>
                                <?php echo form_error('comments') ?>
                            </div>

                        </div>
                        <?php
                        $get_cmnt = $this->db->order_by('id', 'asc')->get_where('support_track', ['ticket_no' => $ticket_list->ticket_no]);
                        foreach ($get_cmnt->result() as $cmnt)
                            ;
                        $last_cmnt = $cmnt->comments;
                        if ($last_cmnt != "") {
                            ?>
                            <div class="form-group">
                                <label for="firstName" class="col-md-3">Last Comment
                                    <span class="text-red"></span>
                                </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" readonly  placeholder=""><?php echo $last_cmnt; ?></textarea>

                                </div>

                            </div>
                        <?php } ?>


                        <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Staus  of ticket
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" readonly value="<?php
                                $query = $this->db->get_where('status', ['id' => $ticket_list->current_status]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->status;
                                    }
                                } else {
                                    echo "status not Exist";
                                }
                                ?>" placeholder="">
                                       <?php echo form_error('status') ?>
                            </div>
                        </div>


                        <input type="hidden" name="assigned_to" class="form-control"  value="<?php echo $ticket_list->assigned_to; ?>" placeholder="">

                        <input type="hidden" name="current_status" class="form-control" readonly value="<?php
                        $query = $this->db->order_by('id', 'asc')->get_where('support_track', ['ticket_no' => $ticket_list->ticket_no]);

                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row)
                                ;
                            echo $row->current_status;
                        } else {
                            echo "";
                        }
                        ?>" placeholder="">

                    <?php } ?>

                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
                     if ($rolename == '36' || $rolename == '11') {
                   //($ticket_list->current_status != '5' || $rolename == '11' || $rolename == '12' OR  $rolename == '76' ) {
                        
                        ?>



                        <div class="form-group <?php if (form_error('raised_by')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Currently Assigned to 
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="raised_by_name" class="form-control" readonly  value="<?php
                                $query = $this->db->get_where('users', ['id' => $ticket_list->assigned_to]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->first_name . " " . $row->last_name;
                                    }
                                } else {
                                    echo "not assigned";
                                }
                                ?>" placeholder="">





                                <?php echo form_error('raised_by') ?>
                            </div>

                        </div>
						
					 <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
					// if ($rolename == '11' AND  ) {
					if (($ticket_list->current_status != '33' && $rolename == '11')){
                   
						
                        ?>
						
					
					
					  <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Role Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">  								

                                <select name="" id="role_id" class="form-control" onchange="get_userid(this.value)">
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
 
                      //  if ($rolename == '11' OR $rolename == '36' ) {
                      // if ($ticket_list->current_status != '5' OR $rolename == '11'AND $rolename == '36'  AND $rolename == '76') {
            if (($ticket_list->current_status != '33' && $rolename == '11') || ($ticket_list->current_status != '33' && $rolename == '36')) {
                            ?>



                            <div class="form-group <?php if (form_error('user_id')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Assigned To 	
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">  								

                                    <select name="assigned_to" id="user_id" class="form-control" >
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
							
                        <?php } ?>

                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $currentUser = singleDbTableRow($user_id)->role;
                        $rolename = singleDbTableRow($user_id)->rolename;
                        $email = singleDbTableRow($user_id)->email;
			
                       if (($ticket_list->current_status != '33' && $rolename == '11') || ($ticket_list->current_status != '33' && $rolename == '36') || ($ticket_list->current_status != '33' && $rolename == '76')) {
                            ?>



                            <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Ticket status
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">  								

                                    <select name="current_status" id="status" class="form-control">
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
                        }
                    }
                    ?>
 <!---------------------------------------------------END ADMIN limitations------------------------------------------------------------------------------>					

                    <div class="form-group <?php if (form_error('comments')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Comments</label>                         
                        <div class="col-md-9">
                            <textarea name="comments"  class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Enter Comments" required></textarea>
                            <?php echo form_error('comments') ?>
                        </div>
                    </div> 


				<?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $currentUser = singleDbTableRow($user_id)->role;
                        $rolename = singleDbTableRow($user_id)->rolename;
                         if (($ticket_list->current_status == '33' && $rolename == '11') || ($ticket_list->current_status == '33' && $rolename == '36')) {
                        //if ($ticket_list->current_status == '5' || $rolename == '11' && $rolename == '36') {
						
                            ?>
							
							
						<div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Complete By
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" readonly value="<?php
                              $query = $this->db->get_where('users', ['id' => $ticket_list->modified_by ]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->first_name.' '.$row->last_name;
                                    }
                                } else {
                                    echo "modified_by not Exist";
                                }
                                ?>" placeholder="">
                                       <?php echo form_error('modified_by') ?>
                            </div>
                        </div>
						

						<?php } ?>









                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" name="submit" value="add_cs_comment" class="btn btn-primary">
                        <i class="fa fa-reply "></i>Comment
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" value="Refresh Page" onClick="window.location.href = window.location.href">Close</button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->


<?php

function page_js() { ?>
    <script>

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




