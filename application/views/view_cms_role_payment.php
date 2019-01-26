<?php include('header.php'); ?>
<?php
foreach ($profile->result() as $cms)
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
                            <td>Transport type</td>
                            <td><?php echo $cms->transport_type; ?></td>
                        </tr>
						<tr>
                            <td>Business group</td>
                            <td><?php
							$query = $this->db->get_where('business_groups',['id'=>$cms->business_groups]);
								     if($query->num_rows()>0)
									 {								
										foreach($query->result() as $d)
										{
											echo $business_group = $d->business_name;
									 	}
									 }
									 else 
									 {
											 echo $business_group =  " ";
									 } 
									 ?></td>
                        </tr>
						<tr>
                            <td>CMS type</td>
                            <td><?php echo $cms->cms_type; ?></td>
                        </tr>
						<tr>
                            <td>For Status</td>
                            <td><?php echo $cms->status; ?></td>
                        </tr>
						<tr>
                            <td>Delivery type</td>
                            <td><?php echo $cms->delivery_type; ?></td>
                        </tr>
			<!--			<tr>
                            <td>Maximum Cost For Vendor Self Delivery</td>
                            <td>< ?php echo $cms->max_cost; ?></td>
                        </tr>-->
						<tr>
                            <td>Parcel type</td>
                            <td><?php echo $cms->parcel_type; ?></td>
                        </tr>
						<tr>
                            <td>Minimum quantity</td>
                            <td><?php echo $cms->min_quantity; ?></td>
                        </tr>
						<tr>
                            <td>Maximum Quantity</td>
                            <td><?php echo $cms->max_quantity; ?></td>
                        </tr>
						<tr>
                            <td>Minimum Volume</td>
                            <td><?php echo $cms->min_volume; ?></td>
                        </tr>
												<tr>
                            <td>Maximum Volume</td>
                            <td><?php echo $cms->max_volume; ?></td>
                        </tr>
						<tr>
                            <td>Minimum KM</td>
                            <td><?php echo $cms->min_km; ?></td>
                        </tr>
						<tr>
                            <td>Maximum KM</td>
                            <td><?php echo $cms->max_km; ?></td>
                        </tr>
						<tr>
                            <td>To role</td>
                            <td><?php
							$query = $this->db->get_where('role',['id'=>$cms->to_role]);
								     if($query->num_rows()>0)
									 {								
										foreach($query->result() as $p)
										{
											echo $rolename = $p->rolename;
									 	}
									 }
									 else 
									 {
											echo $rolename =  " ";
									 } 
									 ?></td>
                        </tr>
						<tr>
                            <td>From role</td>
                            <td><?php
							$query1 = $this->db->get_where('role',['id'=>$cms->from_role]);
								     if($query1->num_rows()>0)
									 {								
										foreach($query1->result() as $q)
										{
											echo $rolename1 = $q->rolename;
									 	}
									 }
									 else 
									 {
											 echo $rolename1 =  " ";
									 }
									 ?></td>
                        </tr>
						<tr>
                            <td>Minimum weight in kg</td>
                            <td><?php echo $cms->min_kg; ?></td>
                        </tr>
						<tr>
                            <td>Maximum eight in kg</td>
                            <td><?php echo $cms->max_kg; ?></td>
                        </tr>
						<tr>
                            <td>Vehicle type</td>
                            <td><?php echo $cms->vehicle_type; ?></td>
                        </tr>
						<tr>
                            <td>Shipment cost</td>
                            <td><?php echo $cms->shipment_cost; ?></td>
                        </tr>
						<tr>
                            <td>Status</td>
                            <td><?php
							$activeStatus = $cms->active;
				switch($activeStatus){
					case 0:
						echo $statusBtn = '<small class="label label-default"> Pending </small>';
						$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$cms->id.'" data-toggle="tooltip" title="Unblock" value="1">
							<i class="fa fa-unlock-alt"></i> </button>';
						break;
					case 1 :
						echo $statusBtn = '<small class="label label-success"> Active </small>';
						$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$cms->id.'" data-toggle="tooltip" title="Block" value="2">
							<i class="fa fa-lock"></i> </button>';
						break;
					case 2 :
						echo $statusBtn = '<small class="label label-danger"> Blocked </small>';
						$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$cms->id.'" data-toggle="tooltip" title="Unblock" value="1">
							<i class="fa fa-unlock-alt"></i> </button>';
						break;
					case 3 :
							if($loggedUser='admin')
							{
							echo $statusBtn = '<small class="label label-danger"> Blocked by Admin </small>';
							$blockUnblockBtn = '<button  class="btn btn-danger blockUnblock" id="'.$cms->id.'" disabled data-toggle="tooltip" title="Unblock User Account" value="1">
							<i class="fa fa-lock"></i> </button>';
							break;
							}else
							{
							echo $statusBtn = '<small class="label label-danger"> Blocked by Admin </small>';
							$blockUnblockBtn = '<button style="display:none" class="btn btn-danger blockUnblock" id="'.$cms->id.'" data-toggle="tooltip" title="Unblock User Account" value="1">
							<i class="fa fa-lock"></i> </button>';
							break;
							}
						}	  ?>
			</td>
                        </tr>
                        <?php
                        $role = $user_info['role'];
                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($cms->created_by)->first_name . ' ' . singleDbTableRow($cms->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date('Y-m-d',$cms->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($cms->modified_by == '0')
									{
                                        echo $name = 'New Entry';
                                    }
									else 
									{
                                        echo $fname = singleDbTableRow($cms->modified_by)->first_name . ' ' . singleDbTableRow($cms->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($cms->modified_at == '0') 
									{
                                        echo $name = 'No Modified time';
                                    }
									else 
									{
                                        echo date('Y-m-d',$cms->modified_at);
                                    }
                                    ?>
									</td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('Courier/cms_role_payment_list/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
				<a href="<?php echo base_url('Courier/edit_cms_role_payment/' . $cms->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
                </div>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
