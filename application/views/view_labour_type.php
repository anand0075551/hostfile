<?php include('header.php'); ?>
<?php
foreach ($Agri_Details->result() as $profile)
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
                        View Labour Type
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>  <th width="20%">Job Type</th>  <td><?php echo $profile->job_type; ?></td></tr>
                        <tr>  <th width="20%">Skill Level</th>  <td><?php echo $profile->skill_level; ?></td></tr>
                        <tr>  <th width="20%">Sector Type</th>  <td><?php echo $profile->sector_type; ?></td></tr>
                        <tr>  <th width="20%">Payment</th>  <td><?php echo $profile->payment; ?></td></tr>
                        <tr>  <th width="20%">Zone</th>  <td><?php echo $profile->zone; ?></td></tr>
                        <tr>  <th width="20%">Payment Per Hour</th>  <td><?php echo $profile->payment_per_hour; ?></td></tr>
                        <tr>  <th width="20%">Half Day Payment</th>  <td><?php echo $profile->half_day_payment; ?></td></tr>
                        <tr>  <th width="20%">Full Day Payment</th>  <td><?php echo $profile->full_day_payment; ?></td></tr>
                        <tr>  <th width="20%">Overtime Payment</th>  <td><?php echo $profile->overtime_payment; ?></td></tr>
                        <tr>  <th width="20%">Fixed Monthly Payment</th>  <td><?php echo $profile->fixed_monthly_pay; ?></td></tr>
                        <tr>  <th width="20%">incentive</th>  <td><?php echo $profile->incentive; ?></td></tr>
                        <tr>  <th width="20%">Bonus</th>  <td><?php echo $profile->bonus; ?></td></tr>

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
                    <a href="<?php echo base_url('Agriculture/list_labour_type') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                    <a href="<?php echo base_url('Agriculture/edit_labour_type/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
                </div>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->