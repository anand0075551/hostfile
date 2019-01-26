<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$rolename = singleDbTableRow($user_id)->rolename;

if ($rolename == '11') {
    include('header.php');
}
?>
<?php
foreach ($tid->result() as $sts)
    ;
?>
<?php
$user_id = $sts->created_by;
$user = $this->db->get_where('users', ['id' => $user_id]);
foreach ($user->result() as $u) {
    $name = $u->first_name . " " . $u->last_name;
    $phone = $u->contactno;
    $role = $u->rolename;
    $ref_id = $u->referral_code;
    $email = $u->email;
}
?>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Raised By </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table" align="center">

                        <tr>
                            <td width="40%">Name</td>
                            <td><?php echo $name; ?></td>

                        </tr>
                        <tr>
                            <td>Role Name</td>
                            <td><?php
                                $query = $this->db->get_where('role', ['roleid' => $role]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->rolename;
                                    }
                                } else {
                                    echo "";
                                }
                                ?></td>
                        </tr>




                        <tr>
                            <td width="20%">Consumer ID</td>
                            <td><?php echo $ref_id; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Contact Number</td>
                            <td><?php echo $phone; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Consumer Email</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Ticket Number</td>
                            <td><?php echo $sts->ticket_no; ?></td>
                        </tr>


                        <tr>
                            <td>Ticket Resolved By</td>
                            <td><?php
                                if ($sts->modified_by == '0' || $sts->current_status != 33) {
                                    echo 'Not Resolved Yet ';
                                } else {
                                    echo singleDbTableRow($sts->modified_by)->first_name . ' ' . singleDbTableRow($sts->modified_by)->last_name;
                                }
                                ?></td>
                        </tr>


                        <tr>
                            <td>Ticket Resolved  Date & Time</td>
                            <td><?php
                                if ($sts->modified_at == '0' || $sts->current_status != 33) {
                                    echo 'Not Resolved Yet ';
                                } else {
                                    echo date("h:i a, d-m-y", $sts->modified_at);
                                    ;
                                }
                                ?></td>
                        </tr>



                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>





    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Support Status </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="15%">Ticket Generate Date & Time</th>
                                <th width="15%">Assigned To</th>
                                <th width="15%">Current Status</th>
                                <th width="15%">Comments</th>


                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $ticket_id = $sts->ticket_no;
                            $query = $this->db->order_by('created_at', 'desc')->get_where('support_track', ['ticket_no' => $ticket_id]);
                            foreach ($query->result() as $row) {
                                echo "<tr>";
                                echo "<td>" . date("h:i a,d M-Y", $row->created_at) . "</td>";

                                $as_to = $row->assigned_to;
                                if ($as_to != "0" ) {
                                    $role = $this->db->get_where('users', ['id' => $row->assigned_to]);
                                    foreach ($role->result() as $r) {
                                        $assigned_to = $r->first_name . ' ' . $r->last_name;
                                    }
                                } else {
                                    $assigned_to = "not assined yet";
                                }

                                echo "<td>" . $assigned_to . "</td>";


                                $sts_id = $row->current_status;
                                if ($sts_id != "0") {
                                    $status = $this->db->get_where('status', ['id' => $sts_id]);
                                    foreach ($status->result() as $s) {
                                        $current_status = $s->status;
                                    }
                                } else {
                                    $current_status = "Newly Added Ticket";
                                }

                                echo "<td>" . $current_status . "</td>";


                                $com_t = $row->comments;
                                if ($com_t != "") {
                                    $role = $this->db->get_where('support_track', ['comments' => $com_t]);
                                    foreach ($role->result() as $r) {
                                        $comments = $r->comments;
                                    }
                                } else {
                                    $comments = "";
                                }

                                echo "<td>" . $comments . "</td>";

                                echo "</tr>";
                            }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Ticket Generate Date</th>
                                <th>Assigned To</th>
                                <th>complete Status</th>
                                <th>Comments</th>

                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
//if ($rolename == '11' || $rolename == '36' ) { 
                    if ($rolename != '11') {
                        ?>

                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Refresh Page" onClick="window.location.href = window.location.href">Close</button>

                    <?php } ?>

                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    $email = singleDbTableRow($user_id)->email;
                    //if ($rolename == '11' || $rolename == '36' ) { 
                    if ($rolename == '11') {
                        ?>

                        <?php
                        $query2 = $this->db->get_where('ticket_list', ['ticket_no' => $ticket_id]);
                        foreach ($query2->result() as $profile) {
                            $sts = $profile->current_status;
                        }
                        ?>

                        <a href="<?php echo base_url('support/view_support/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>

                        <?php
                        if ($sts != '33' || $rolename == '36' && $rolename == '11') {
                            ?>



                            <a href="<?php echo base_url('support/edit_support/' . $profile->id) ?>" class="btn btn-info">Ticket assigned</a>






                            <?php
                        }
                    }
                    ?>




                </div>
            </div><!-- /.box -->
        </div>
    </div>


</section><!-- /.content -->

<?php

function page_js() { ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>


    <script>


<?php } ?>

