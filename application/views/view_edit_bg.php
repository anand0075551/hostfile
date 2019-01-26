<?php foreach($profile_Details->result() as $business_groups); ?>
<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                       <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">View Business Group</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>

					<table class="table table-striped">
						<tr>
							<th width="20%">Business Group Name</th>
							<th><?php echo $business_groups->business_name; ?></th>
						</tr>
						<tr>
							<td width="20%">Payment Account</td>
							<td><?php $get = $this->db->get_where('acct_categories', ['id'=>$business_groups->pay_type]);
								if($get->num_rows()>0){
									foreach($get->result() as $g);
									$payment_acc = $g->name;
								}
								else{
									$payment_acc = "Not Mentioned";
								} 
								echo $payment_acc; ?></td>
						</tr>
						
						<tr>
							<td width="20%">Payment Reciever</td>
							<td><?php 
								$get_reciever = $this->db->get_where('users', ['referral_code'=>$business_groups->payment_reciever]);
								if($get_reciever->num_rows()>0){
									foreach($get_reciever->result() as $rr);
									$payment_reciever = $business_groups->payment_reciever.'-'.$rr->first_name.' '.$rr->last_name;
								}
								else{
									$payment_reciever = "Not Mentioned";
								}
								echo $payment_reciever;
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Payment Type</td>
							<td><?php 
								if($business_groups->points_mode == 'wallet'){
									$pt_mode = "CPA";
								}
								elseif($business_groups->points_mode == 'loyality'){
									$pt_mode = "LPA";
								}
								else{
									$pt_mode = "Not Applicable";
								}
								echo $pt_mode;
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Is Voucher Applicable?</td>
							<td><?php 
								if($business_groups->voc_permission != ''){
									echo $business_groups->voc_permission;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Voucher Type</td>
							<td><?php 
								if($business_groups->voc_type != 0){
									echo singleDbTableRow($business_groups->voc_type, 'status')->status;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Voucher Limit</td>
							<td><?php 
								if($business_groups->voc_limit != 0){
									echo $business_groups->voc_limit;
								}
								else{
									echo "Null";
								}
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Business Image</td>
							<td>
								<img src="<?php echo base_url('assets/theme/img/'.$business_groups->image) ?>" class="img-responsive" style="height:100px; width:100px; ">
							</td>
						</tr>
						<tr>
							<td width="20%">Background Color</td>
							<td><?php if($business_groups->bg_color != ""){ ?>
								<span><?php echo $business_groups->bg_color; ?></span> 
								<span style="background:<?php echo $business_groups->bg_color; ?>; color:<?php echo $business_groups->bg_color; ?>; height:35px; width:30px;">@@</span>
								<?php } else{ echo "Not Mentioned"; } ?>
							</td>
						</tr>
						<tr>
							<td width="20%">Search Box Color</td>
							<td><?php if($business_groups->search_box_color != ""){ ?>
								<span><?php echo $business_groups->search_box_color; ?></span> 
								<span style="background:<?php echo $business_groups->search_box_color; ?>; color:<?php echo $business_groups->search_box_color; ?>; height:35px; width:30px;">@@</span>
								<?php } else{ echo "Not Mentioned"; } ?>
							</td>
						</tr>
						<tr>
							<td width="20%">Vendor Role</td>
							<td><?php 
								if($business_groups->vendor_role != 0){
									echo singleDbTableRow($business_groups->vendor_role, 'role')->rolename;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Search Type</td>
							<td><?php 
								if($business_groups->search_type == 1){
									echo "Type 1 - Category, Sub-Category, Tags, Price.";
								}
								elseif($business_groups->search_type == 2){
									echo "Type 2 - Pincode, Vendor.";
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
						</tr>
						
						<tr>
							<td width="20%">Created By</td>
							<td><?php 
								if($business_groups->created_by != 0){
									echo singleDbTableRow($business_groups->created_by)->first_name.' '.singleDbTableRow($business_groups->created_by)->last_name;
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
						</tr>
						<tr>
							<td width="20%">Created At</td>
							<td><?php 
								if($business_groups->created_at != 0){
									echo date("Y-m-d h:i:s a", $business_groups->created_at); 
								}
								else{
									echo "Not Mentioned";
								}
							?></td>
						</tr>
						<tr>
							<td width="20%">Modified By</td>
							<td><?php 
								if($business_groups->modified_by != 0){
									echo singleDbTableRow($business_groups->modified_by)->first_name.' '.singleDbTableRow($business_groups->modified_by)->last_name;
								}
								else{
									echo "Not Modified Yet";
								}
								?></td>
						</tr>
						<tr>
							<td width="20%">Modified At </td>
							<td><?php 
								if($business_groups->modified_at != 0){
									echo date("Y-m-d h:i:s a", $business_groups->modified_at); 
								}
								else{
									echo "Not Modified Yet";
								}
								?></td>
						</tr>
					</table>

					</div><!-- /.box-body -->

					<div class="box-footer">
						<a href="<?php echo base_url('permission/view_bg') ?>" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
						<a href="<?php echo base_url('permission/edit_bg/'.$business_groups->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
						<a href="<?php echo base_url('permission/copy_bg/'.$business_groups->id) ?>" class="btn btn-info"><i class="fa fa-copy"></i> Copy</a>
					</div>
			</div><!-- /.box -->


		</div><!--/.col (left) -->
	</div>   <!-- /.row -->
</section><!-- /.content -->
