
<?php include('header.php'); ?>
<?php
foreach ($inventory_stock->result() as $profile)
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
					 <td>Store id</td>
					   <td><?php 
											$query1 = $this->db->get_where('inventory_store_id', ['id' => $profile->store_id,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo    $row->id.'-'.$row->store_name.'-'.$row->area;
													}
												} else {
													 echo  "no data";
												}?></td>
					</tr>
					 <tr>
                            <td>Product</td>
                            <td><?php 
											$query1 = $this->db->get_where('smb_product', ['id' => $profile->product,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->title;
													}
												} else {
													 echo  "no data";
												}?></td>
                        </tr>
						
					   <tr>
                            <td>Category</td>
                           <td>
							   <?php 
											$query1 = $this->db->get_where('smb_category', ['id' => $profile->category,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->category_name;
													}
												} else {
													 echo  "no data";
												}?>
							</td>
                        </tr>

						  <tr>
                            <td>Sub Category</td>
                           <td>
							   <?php 
											$query1 = $this->db->get_where('smb_sub_category', ['id' => $profile->sub_category,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->sub_category_name;
													}
												} else {
													 echo  "no data";
												}?>
							</td>
                        </tr>
						
						 <tr>
                            <td>Brand</td>
                            <td><?php echo $profile->brand; ?></td>
                        </tr>
						
						 <tr>
                            <td>Type</td>
                            <td><?php 
											$query1 = $this->db->get_where('inventory_inward_outward', ['id' => $profile->type,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->inward_outward;
													}
												} else {
													 echo  "no data";
												}?></td>
                        </tr>
						
						 <tr>
                            <td>Product Unique Code</td>
                            <td><?php echo $profile->product_unique_code; ?></td>
                        </tr>
						
						
						 <tr>
                            <td>Product Manufacturing Date</td>
                            <td><?php echo $profile->product_manufacturing_date; ?></td>
                        </tr>
						
						 <tr>
                            <td>Product Expiry Date</td>
                            <td><?php echo $profile->exp_date; ?></td>
                        </tr>
						
						
					    <tr>
                            <td>Inward</td>
                            <td><?php echo $profile->inward; ?></td>
                        </tr>
					
					
					     <tr>
                            <td>Outward</td>
                            <td><?php echo $profile->outward; ?></td>
                        </tr>
					
					
					
					
							 <tr>
                            <td>Weight Per Piece</td>
                            <td><?php echo $profile->weight_per_piece; ?></td>
                        </tr>
					
					
					
							 <tr>
                            <td>Quantity (No. of Pieces)</td>
                            <td><?php echo $profile->quantity; ?></td>
                        </tr>
						
							 <tr>
                            <td>Balance Quantity In Stock</td>
                            <td><?php echo $profile->balance_qty; ?></td>
                        </tr>
					
					
						
							 <tr>
                            <td>Price Per Unit</td>
                            <td><?php echo $profile->price_per_unit; ?></td>
                        </tr>
						
						 <tr>
                            <td>Tax 1 Per Unit</td>
                            <td><?php echo $profile->tax1_per_unit; ?></td>
                        </tr>
						
						 <tr>
                            <td>Tax 2 Per Unit</td>
                            <td><?php echo $profile->tax2_per_unit; ?></td>
                        </tr>
						
						 <tr>
                            <td>Tax 3 Per Unit</td>
                            <td><?php echo $profile->tax3_per_unit; ?></td>
                        </tr>
						
						<tr>
                            <td>Shipping1 Per Unit</td>
                            <td><?php echo $profile->shipping1_per_unit; ?></td>
                        </tr>
						
							
						<tr>
                            <td>Shipping2 Per Unit</td>
                            <td><?php echo $profile->shipping2_per_unit; ?></td>
                        </tr>
						
							
						<tr>
                            <td>Shipping3 Per Unit</td>
                            <td><?php echo $profile->shipping3_per_unit; ?></td>
                        </tr>
						
						<tr>
                            <td>Sub Total Price</td>
                            <td><?php echo $profile->sub_total_price; ?></td>
                        </tr>
						
						<tr>
                            <td>Grand Total</td>
                            <td><?php echo $profile->grand_total; ?></td>
                        </tr>
						
						
						<tr>
                            <td>Area Location Name</td>
                            <td><?php echo $profile->area_location_name; ?></td>
                        </tr>
						<tr>
                            <td>Area Pincode</td>
                            <td><?php echo $profile->pincode; ?></td>
                        </tr>
						
						<tr>
                            <td>Supplier Name</td>
                            <td><?php 
											$query1 = $this->db->get_where('role', ['id' => $profile->supplier_name,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->rolename;
													}
												} else {
													 echo  "no data";
												}?></td>
                        </tr>
						
						<tr>
                            <td>Supplier Id</td>
                            <td><?php 
											$query1 = $this->db->get_where('users', ['id' => $profile->supplier_id,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->first_name.' '.$row->last_name;
													}
												} else {
													 echo  "no data";
												}?></td>
                        </tr>
						
                       
					   
					   	<tr>
                            <td>Supplier Invoice no</td>
                            <td><?php echo $profile->supplier_invoice_no; ?></td>
                        </tr>
						
						
						<tr>
                            <td>Compartment 1</td>
                            <td><?php echo $profile->compartment1; ?></td>
                        </tr>
						
						<tr>
                            <td>Compartment 2</td>
                            <td><?php echo $profile->compartment2; ?></td>
                        </tr>
						
						<tr>
                            <td>Compartment 3</td>
                            <td><?php echo $profile->compartment3; ?></td>
                        </tr>
						
						<tr>
                            <td>Compartment 4</td>
                            <td><?php echo $profile->compartment4; ?></td>
                        </tr>
						
						<tr>
                            <td>Compartment 5</td>
                            <td><?php echo $profile->compartment5; ?></td>
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
                    <a href="<?php echo base_url('Inventory_stocks/report_inventory_stocks') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                   

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
