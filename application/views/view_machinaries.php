
<?php include('header.php'); ?>
<?php
foreach ($machinaries->result() as $profile)
    ;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-striped">
                        <tr>
                            <td>Vehicle Type</td>
                            <td><?php echo $profile->type; ?></td>
                        </tr>



                        <tr>
                            <td>Vehicle Name</td>
                            <td><?php echo $profile->name; ?></td>
                        </tr>

                        <tr>
                            <td>Start Date</td>
                            <td><?php echo $profile->bedin_date; ?></td>
                        </tr>



                        <tr>
                            <td>End Date</td>
                            <td><?php echo $profile->end_date; ?></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td><?php echo $profile->current_status; ?></td>
                        </tr>

                        <tr>
                            <td>Vehicle Hire Type</td>
                            <td><?php echo $profile->hire_type; ?></td>
                        </tr>

                        <tr>
                            <td>Vehicle Id</td>
							<td><?php echo $profile->vehicle_id; ?></td>

                        </tr> 


                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $profile->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('machinaries/machinaries_Index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $email = singleDbTableRow($user_id)->email;


                    if ($currentUser == 'admin') {
                        ?>

                        <a href="<?php echo base_url('machinaries/edit_machinaries/' . $profile->id) ?>" class="btn btn-warning"><i class="fa fa-arrow-edit"></i>Edit</a>

                    <?php } ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
