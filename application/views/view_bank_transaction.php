
<?php include('header.php'); ?>
<?php
foreach ($bank_details->result() as $profile)
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
                            <td>Transctransaction Date</td>
                            <td><?php echo $profile->txn_date; ?></td>
                        </tr>



                        <tr>
                            <td>Value Date</td>
                            <td><?php echo $profile->value_date; ?></td>
                        </tr>

                        <tr>
                            <td>IFSC CODE</td>
                            <td><?php echo $profile->bank_ifsc; ?></td>
                        </tr>
						
						
						  <tr>
                            <td>Description</td>
                            <td><?php echo $profile->description; ?></td>
                        </tr>


						
                        <tr>
                            <td>Cheque No.</td>
                            <td><?php echo $profile->cheque_no; ?></td>
                        </tr>

                        <tr>
                            <td>Branch code</td>
                            <td><?php echo $profile->branch_code; ?></td>
                        </tr>

                        <tr>
                            <td>Debit</td>
                            <td><?php echo $profile->debit; ?></td>
                        </tr>

                        <tr>
                            <td>Credit</td>
							<td><?php echo $profile->credit; ?></td>

                        </tr> 
						 <tr>
                            <td>Balance</td>
							<td><?php echo $profile->balance; ?></td>

                        </tr> 
						
						<tr>
                            <td>Current Status</td>
                            <td><?php $query1 = $this->db->get_where('status', ['id' => $profile->status,]);
								
								if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo  $row->status;
									}
								} else {
                                     echo  "no status";
                                }?></td>
						</tr>
						
						
						<tr>
                            <td>Remarks</td>
							<td><?php echo $profile->remarks; ?></td>

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
                    <a href="<?php echo base_url('Bank_transaction/all_bank_transaction') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $email = singleDbTableRow($user_id)->email;


                    if ($currentUser == 'admin') {
                        ?>

                        <a href="<?php echo base_url('Bank_transaction/edit_bank_transaction/' . $profile->id) ?>" class="btn btn-warning"><i class="fa fa-arrow-edit"></i>Edit</a>

                    <?php } ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
