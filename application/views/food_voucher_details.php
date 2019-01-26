
<?php include('header.php'); ?>
<?php
foreach ($foodvoucher_Details->result() as $profile);
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
                            <th width="30%">Voucher Type</th>
                            <th><?php 
								if($profile->voucher_type != 0){
									echo singleDbTableRow($profile->voucher_type, 'status')->status;
								}
								else{
									echo "Not Mentioned";
								}
							?></th>
                        </tr>
					    <tr>
                            <th width="30%">Voucher Name</th>
                            <th><?php echo $profile->food_type; ?></th>
                        </tr>
						<tr>
                            <td>Voucher price</td>
                            <td><?php echo number_format($profile->actual_value,2); ?></td>
                        </tr>
                        <tr>
                            <td>Pay Type</td>
                            <td>
							<?php 
								$get_role = $this->db->get_where('acct_categories', ['id'=>$profile->pay_type]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->name;
									}
								} else {
									 echo  "Not Mentioned";
								}
							?></td>
                        </tr>
						<tr>
                            <td>Pay Type To</td>
                            <td>
							<?php 
								if($profile->paytype_to != 0){
									echo singleDbTableRow($profile->paytype_to, 'acct_categories')->name;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
                        </tr>
						<tr>
                            <td>Voucher Owner Role</td>
                            <td><?php 
								$get_role = $this->db->get_where('role', ['roleid'=>$profile->pay_to_role]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->rolename;
									}
								} else {
									 echo  "Not Mentioned";
								}
							?></td>
                        </tr>
						<tr style="display:none;">
                            <td>To User</td>
                            <td><?php 
								$get_role = $this->db->get_where('users', ['id'=>$profile->pay_to_user]);
								if ($get_role->num_rows() > 0) {
									foreach ($get_role->result() as $row) {
										echo  $row->first_name." ".$row->last_name;
									}
								} else {
									 echo  "Not Mentioned";
								}
                               ?></td>
                        </tr>
						<tr>
                            <td>Receiver Role</td>
                            <td><?php 
								if($profile->receiver_role != 0){
									echo singleDbTableRow($profile->receiver_role, 'role')->rolename;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
                        </tr>
						<tr>
                            <td>Transferrable</td>
                            <td><?php 
								if($profile->transferrable != ""){
									echo $profile->transferrable; 
								}
								else{
									echo "Not Mentioned";
								}
								
							?></td>
                        </tr>
						<tr>
                            <td>Period</td>
                            <td><?php 
								if($profile->period != ""){
									echo $profile->period."ly";
								}
								else{
									echo "monthly";
								}
								
							?></td>
                        </tr>
						<tr>
                            <td>Validity</td>
                            <td><?php 
								if($profile->validity != 0){
									echo ceil($profile->validity/24)." Day (".$profile->validity." Hours)";
								}
								else{
									echo "Not Mentioned";
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
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
                            </tr>
							<tr>
                                <td>Created At</td>
                                <td><?php echo  date("y-m-d", $profile->created_at); ?></td>
                            </tr>
                           <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '') {
                                        echo  'Not  Modified Yet';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'Not Modified Yet';
                                    } else {
                                        echo date("y-m-d", $profile->modified_at);
                                        
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

               <div class="box-footer">
                    <a href="<?php echo base_url('Food_voucher') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Food_voucher/edit_food_voucher/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->