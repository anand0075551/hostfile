
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
                            <td>Voucher Name</td>
                            <td><?php 
								$get_food_type = $this->db->get_where('food_voucher_scheme', ['id'=>$profile->food_type]);
								foreach($get_food_type->result() as $food);
								$food_type = $food->food_type;
							echo $food_type; ?></td>
                        </tr>
						<tr>
                            <td>Voucher price</td>
                            <td><?php echo number_format($profile->actual_value,2); ?></td>
                        </tr>
						<tr>
                            <td>Ticket Range</td>
                            <td><?php echo $profile->tickent_no_from." to ".$profile->tickent_no_to; ?></td>
                        </tr>
                       <tr>
                            <td>Discount</td>
                            <td><?php echo $profile->discount_in_per ." %";?></td>
                        </tr>
							
						<tr>
                            <td>Discount Value</td>
                            <td><?php echo number_format($profile->discount_value,2); ?></td>
                        </tr>
                     
                 
                        <tr>
                            <td>Price After Discount</td>
                            <td><?php echo number_format($profile->price_after_discount,2); ?></td>
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
                                    if ($profile->modified_by == 0) {
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
                    <a href="<?php echo base_url('Food_voucher/voucher_discounts') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Food_voucher/edit_food_voucher_discount/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->