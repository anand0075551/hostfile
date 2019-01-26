
<?php include('header.php'); ?>
<?php
foreach ($transaction_Details->result() as $profile)
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
                            <td>Transaction Reciept ID</td>
                            <td><?php echo $profile->id; ?></td>
                        </tr>
                        <tr>
                            <td>Transaction Mode</td>
                            <td><?php echo $profile->transaction_mode; ?></td>
                        </tr>

                        <tr>
                            <td>Main Category</td>
                            <td><?php
                                $profile->main_category;

                                $table_name = 'regular_transaction';
                                $where_array = array('main_category' => $profile->main_category);
                                $query1 = $this->db->where($where_array)->get($table_name);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $country_id = $row1->main_category;

                                        $table_name = 'acct_categories';
                                        $where_array = array('id' => $country_id);
                                        $query2 = $this->db->where($where_array)->get($table_name);
                                        foreach ($query2->result() as $row2) {
                                            $country_name = $row2->name;
                                        }
                                    }

                                    echo $country_name;
                                } else {
                                    echo "Main Category Doesnot Exist";
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Sub-Accounts category</td>
                            <td><?php
                                $profile->business_name;

                                $table_name = 'regular_transaction';
                                $where_array = array('business_name' => $profile->business_name);
                                $query1 = $this->db->where($where_array)->get($table_name);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $country_id = $row1->business_name;

                                        $table_name = 'acct_categories';
                                        $where_array = array('parentid' => $row1->main_category);
                                        $query2 = $this->db->where($where_array)->get($table_name);
                                        foreach ($query2->result() as $row2) {
                                            $country_name = $row2->name;
                                        }
                                    }

                                    echo $country_name;
                                } else {
                                    echo "sub-accounts category Doesnot Exist";
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Reporting Manager</td>
                            <td><?php
                                $profile->reporting_manager;

                                $table_name = 'regular_transaction';
                                $where_array = array('reporting_manager' => $profile->reporting_manager);
                                $query1 = $this->db->where($where_array)->get($table_name);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $country_id = $row1->reporting_manager;

                                        $table_name = 'role';
                                        $where_array = array('id' => $country_id);
                                        $query2 = $this->db->where($where_array)->get($table_name);
                                        foreach ($query2->result() as $row2) {
                                            $country_name = $row2->rolename;
                                        }
                                    }

                                    echo $country_name;
                                } else {
                                    echo "reporting manager Doesnot Exist";
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Transaction Date</td>
                            <td><?php echo $profile->trans_date; ?></td>
                        </tr>
                        <tr>
                            <td>Transaction time</td>
                            <td><?php echo $profile->trans_time; ?></td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td><?php echo $profile->amount; ?></td>
                        </tr>

                        <tr>
                            <td>Comments</td>
                            <td><?php echo $profile->comments; ?></td>
                        </tr>
                        <tr>
                            <td>Receiver Name</td>
                            <td><?php echo $profile->receiver_name; ?></td>
                        </tr>
                        <tr>
                            <td>Sancatie By</td>
                            <td><?php echo $profile->sancatie_by; ?></td>
                        </tr>
                        <tr>
                            <td>File</td>
                            <td>

                                <img src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" width="18%" height="28%">
                        </tr>
                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name.' '.singleDbTableRow($profile->created_by)->last_name;?></td>
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
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name.' '.singleDbTableRow($profile->modified_by)->last_name;
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
                    <a href="<?php echo base_url('transaction') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                    <a href="<?php echo base_url('transaction/edit_transaction/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
