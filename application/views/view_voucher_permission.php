
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
                            <td>Voucher Name</td>
                            <td><?php 
								if($profile->voc_name != 0){
									echo singleDbTableRow($profile->voc_name, 'status')->status;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
                        </tr>
						
					   <tr>
                            <td>Business Name</td>
                           <td>
							   <?php 
									$query1 = $this->db->get_where('business_groups', ['id' => $profile->business_name,]);
									
									if ($query1->num_rows() > 0) {
										foreach ($query1->result() as $row) {
											echo  $row->business_name;
										}
									} else {
										 echo  "Not Applicable";
									}
								?>
							</td>
                        </tr>

						
						
						
						
						
						
                        <tr>
                            <td>Pay Type</td>
                           <td><?php 
							$query1 = $this->db->get_where('acct_categories', ['id' => $profile->pay_type,]);
								
								if ($query1->num_rows() > 0) {
									foreach ($query1->result() as $row) {
										echo  $row->name;
									}
								} else {
									 echo  "Not Applicable";
								}?></td>
                        </tr>

                       
                       
                     
                        <tr>
                            <td>Pay Type to</td>
                             <td><?php 
								$query1 = $this->db->get_where('acct_categories', ['id' => $profile->paytype_to,]);
									
									if ($query1->num_rows() > 0) {
										foreach ($query1->result() as $row) {
											echo  $row->name;
										}
									} else {
										 echo  "Not Applicable";
									}?></td>
                        </tr>
                        <tr>
                            <td>To Role</td>
                             <td><?php 
								$query1 = $this->db->get_where('role', ['id' => $profile->to_role,]);
									
									if ($query1->num_rows() > 0) {
										foreach ($query1->result() as $row) {
											echo  $row->rolename;
										}
									} else {
										 echo  "Not Applicable";
									}?></td>
                        </tr>
                        <tr>
                            <td>To User</td>
                            <td><?php 
								$query1 = $this->db->get_where('users', ['id' => $profile->to_user,]);
									
									if ($query1->num_rows() > 0) {
										foreach ($query1->result() as $row) {
											echo  $row->first_name." ".$row->last_name;
										}
									} else {
										 echo  "Not Applicable";
									}?></td>
                        </tr>

                        <tr>
                            <td>Percentage</td>
                            <td><?php echo $profile->percentage; ?></td>
                        </tr>
                        <tr>
                            <td>No Of Split</td>
                            <td><?php echo $profile->no_of_split; ?></td>
                        </tr>
                        <tr>
                            <td>Voucher Type</td>
                            <td><?php
									if($profile->voc_type != ""){
										echo $profile->voc_type."ly";
									}
									else{
										echo "Not Mentioned.";
									}
								?></td>
                        </tr>
						
						<tr>
                            <td>Start Date</td>
                            <td><?php
									if($profile->start_date != "0000-00-00"){
										echo $profile->start_date;
									}
									else{
										echo "Not Mentioned.";
									}
								?></td>
                        </tr>
						
						<tr>
                            <td>End Date</td>
                            <td><?php
									if($profile->end_date != "0000-00-00"){
										echo $profile->end_date;
									}
									else{
										echo "Not Mentioned.";
									}
								?></td>
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
                    <a href="<?php echo base_url('Voucher_permission') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                    <a href="<?php echo base_url('Voucher_permission/edit_voucher/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
