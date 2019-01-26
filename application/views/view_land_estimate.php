
<?php include('header.php'); ?>
<?php
foreach ($agr_estimate->result() as $profile)
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
                            <td>All Working Days</td>
                            <td><?php echo $profile->working_days; ?></td>
                        </tr>
                        <tr>
                            <td>All Working hours</td>
                            <td><?php echo $profile->working_hours; ?></td>
                        </tr>

                        <tr>
                            <td>Start Break time</td>
                            <td><?php echo $profile->start_breaktm; ?></td>
                        </tr>
                        <tr>
                            <td>End Break time</td>
                            <td><?php echo $profile->end_breaktm; ?></td>
                        </tr>
                        <tr>
                            <td>Start working Date</td>
                            <td><?php echo $profile->work_startdt; ?></td>
                        </tr>

                        <tr>
                            <td>End working Date</td>
                            <td><?php echo $profile->work_enddt; ?></td>
                        </tr>
                        <tr>
                            <td>Total Work</td>
                            <td><?php echo $profile->total_work; ?></td>
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

                    <a href="<?php echo base_url('Agriculture/edit_land_estimate/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
