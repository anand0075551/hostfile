
<?php include('header.php'); ?>
<?php
 foreach($address_Details->result() as $address); 
    
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
										<td>Country</td>
										<td><?php echo $address->country; ?></td>
                     
                 
									</tr>
						
									<tr>
										<td>State</td>
										<td>
										<?php echo $address->state; ?></td>            
									</tr>
									
									<tr>
										<td>District</td>
										<td><?php echo $address->district; ?></td>            
									</tr>
									

						                                   
                                                                                  
                                            <tr>
                                                <td>Location</td>
                                                <td><?php echo $address->location_id; ?></td>
                                            </tr>
										
									
											<tr>
                                              <td>Pincode   </td>
                                                <td><?php echo $address->pincode; ?></td>
                                            </tr>
											<tr>
											 <td>House/Building No  </td>
                                                <td><?php echo $address->house_buildingno; ?></td>
                                            </tr>
											 <td>Street Name </td>
                                                <td><?php echo $address->street_name; ?></td>
                                            </tr>
											<td> Land Mark  </td>
                                                <td><?php echo $address->land_mark; ?></td>
                                         
                         </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('User_address/address_Index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                   <a href="<?php echo base_url('User_address/edit/' . $address->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->




















