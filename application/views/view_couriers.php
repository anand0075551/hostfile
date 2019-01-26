<?php function page_css(){ ?>
<!-- daterange picker -->
<link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Color Picker -->
<link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<!-- Bootstrap time Picker -->
<link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
<?php } ?>
<?php include('header.php'); ?>
<?php
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentRolename   = singleDbTableRow($user_id)->rolename;
foreach($courier_Details->result() as $courier);
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        
        
        
        <!-- form start -->
        <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:red;">
                    Courier  Details
                    </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped" >
						
                            <td><b>Consignment No Barcode</b></td>
											<tr>
                                                
                                                <td><div id="externalbox">
												<div id="inputdata" style="color:red;" ><?php echo $courier->cons_no; ?></div>
												
												
												</div>
											</td>
                                            </tr>                            
                        </table>
                        </div><!-- /.box-body -->
                    </div>
                    </div><!--/.col (left) -->
					
					
					 <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:red;">
                    Courier  Details
                    </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped" >

                                   <td><b>Consignment No QRCode</b></td>
								   <input id="text"  type="text" value="<?php echo $courier->cons_no; ?>" style="display:none;" /><br />
											<tr>  
                                               <td align="center">
													<div  id="qrcode"  style="height:100px;width:100px;" ></div>
												
											</td>
                                            </tr>
                            <br>
                        </table>
                        </div><!-- /.box-body -->
                    </div>
                    </div><!--/.col (left) -->
					
					
					
					
                    
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">
                                Shipper  Details
                                </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-striped">
                                        
                                        <tr>
                                            <td><b>Shipper Name</b></td>
                                            <td><?php
                                                
                                                //  echo $courier->ship_name;
                                                $query = $this->db->get_where('users', ['id' => $courier->ship_name]);
                                                
                                                if ($query->num_rows() > 0) {
                                                foreach ($query->result() as $row) {
                                                echo   $row->first_name." ".$row->last_name;
                                                }
                                                } else {
                                                echo "Pincode Doesnot Exist";
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone </b></td>
                                            <td><?php echo $courier->phone; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Shipper Pincode</b></td>
                                            <td><?php
                                                //echo  $courier->shipper_pincode;
                                                $query = $this->db->get_where('pincode', ['id' => $courier->shipper_pincode]);
                                                
                                                if ($query->num_rows() > 0) {
                                                foreach ($query->result() as $row) {
                                                echo $row->pincode;
                                                }
                                                } else {
                                                echo "Pincode Doesnot Exist";
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Shipper Address</b></td>
                                            <td><?php echo $courier->s_add; ?></td>
                                        </tr>
                                        
                                        
                                    </table>
                                    </div><!-- /.box-body -->
                                </div>
                                </div><!--/.col (left) -->
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">
                                            Reciever  Details
                                            </h3>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-striped">
                                                    
                                                    <tr>
                                                        <td><b>Reciever Name</b></td>
                                                        <td><?php echo $courier->rev_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reciever Phone</b></td>
                                                        <td><?php echo $courier->r_phone; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reciever Pincode</b></td>
                                                        <td><?php
                                                            //echo $courier->receiver_pincode;
                                                            $query2 = $this->db->get_where('pincode', ['id' => $courier->receiver_pincode]);
                                                            
                                                            if ($query2->num_rows() > 0) {
                                                            foreach ($query2->result() as $row2) {
                                                            echo $row2->pincode;
                                                            }
                                                            } else {
                                                            echo "Pincode Doesnot Exist";
                                                            }
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reciever Address</b></td>
                                                        <td><?php echo $courier->r_add; ?></td>
                                                    </tr>
                                                    
                                                </table>
                                                </div><!-- /.box-body -->
                                            </div>
                                            </div><!--/.col (left) -->
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <div class="col-md-12">
                                                <div class="box box-primary">
                                                    <div class="box-header">
                                                        <h3 class="box-title">
                                                        Shippment Info :
                                                        </h3>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <table class="table table-striped">
                                                                <tr>
                                                                    <td>Type </td>
                                                                    <td><?php echo $courier->type; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Amount (Rs.)</td>
                                                                    <td>Rs.&nbsp<?php echo $courier->cost; ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Weight </td>
                                                                    <td><?php echo $courier->smb_weight; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Invoice No.</td>
                                                                    <td><?php echo $courier->invice_no; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Quantity</td>
                                                                    <td><?php echo $courier->qty; ?>&nbsp Pc</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Book Mode</td>
                                                                    <td><?php echo $courier->book_mode; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mode</td>
                                                                    <td><?php echo $courier->mode; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Status</td>
                                                                    <td><?php 
																	
																	
																$query3 = $this->db->get_where('status', ['id' => $courier->status,]);
																if ($query3->num_rows() > 0) {
																foreach ($query3->result() as $row3) {
																echo	$status = $row3->status;
																}
																} else {
																echo	$status =  "NO DATA";
																}
																	
																	
																	
																	?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comments</td>
                                                                    <td><?php echo $courier->comments; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Booking Date</td>
                                                                    <td><?php echo $courier->book_date; ?></td>
                                                                </tr>
																                                                                <tr>
                                                                <td>Delivery Type</td>
                                                                    <td><?php echo $courier->delivery_type; ?></td>
                                                                </tr>
																
<!--- for display of dyanamic delivery charges ------------------------------------------------------------>										
					<?php
					$get = $this->db->get_where('cms_deliver', ['cid',$courier->cons_no])->num_rows();
					if($get > 0){
						foreach($get->reslut() as $role);
						$from_role = singleDbTableRow($role->assigned_by)->rolename;
						$to_role = singleDbTableRow($role->dbid)->rolename;
					}
					else{
						$currentAuthDta = loggedInUserData();
						$currentUser = $currentAuthDta['role'];
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentRolename = singleDbTableRow($user_id)->rolename;
						$from_role = $currentRolename;
						$to_role = 12;
					}
					?>			
					<?php  if ($currentRolename != '12')  {     ?>									
					<tr>
					<td>Shipping Charges</td>
					
					
					<td><?php 

								$courier->business_group;							
								$courier->smb_weight;							
								$courier->qty;							
								$courier->smb_volume;							


								$condition ="business_groups   = '".$courier->business_group."' 	AND 
								from_role          = '".$from_role."'      							AND 
								to_role            = '".$to_role."'         						AND 
								active             = '1'                    						AND 
								min_kg            <= '".$courier->smb_weight."'          			AND 
								max_kg            >= '".$courier->smb_weight."'          			AND 
								min_quantity      <= '".$courier->qty."'             				AND 
								max_quantity      >= '".$courier->qty."'             				AND 
								min_volume        <= '".$courier->smb_volume."'      				AND 
								max_volume        >= '".$courier->smb_volume."'  ";
								
								
								
								$get_cost = $this->db->where($condition)->get('cms_role_payment');


								if($get_cost->num_rows() > 0){
										foreach($get_cost->result() as $c)
										$shipping_cost = $c->shipment_cost;
								}
								else{
										$shipping_cost = 0;
								}
								echo $shipping_cost; ?></td>
								
								
								
								
								
								
								</tr>

						
	<!--- for display of dyanamic delivery charges ------------------------------------------------------------>
                                                                <tr>
                                                                    <td>Created By</td>
                                                                    <td><?php
                                                                        $d_boy = $courier->created_by;
                                                                        $query = $this->db->get_where('users', ['id'=>$d_boy]);
                                                                        foreach($query->result() as $d)
                                                                        {
                                                                        echo $d->first_name.' '.$d->last_name;
                                                                        }
                                                                    ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Assigned to</td>
                                                                    <td><?php
                                                                        $d_boy = $courier->assigned_to;
                                                                        $query = $this->db->get_where('users', ['id'=>$d_boy]);
                                                                        foreach($query->result() as $d)
                                                                        {
                                                                        echo $d->first_name.' '.$d->last_name;
                                                                        }
                                                                    ?></td>
                                                                </tr>
                                                             
                                                                                                
															 														
																<tr>
																	<td><b>   Total Weight</b></td>
                                                                    <td><b><?php
																	if($courier->smb_weight != '')
																	{
																	echo $courier->smb_weight; 
																	}
																	else{
																		echo 'No Data'; 
																	}
																	?>&nbsp Kg</td>
                                                                </tr>
																<tr>
                                                                    <td><b>Total Volume</b></td>
                                                                    <td><b><?php 
																	if($courier->smb_volume != ''){
																	echo $courier->smb_volume;  }
																	else{
																		echo 'No Data'; 
																	}
																	
																	?> &nbsp cm^3</b></td>
                                                                </tr>															
																<tr>
                                                                    <td><b>Self Delivery Charges</b></td>
                                                                    <td><b><?php
																	if($courier->cost != ''){
																	echo $courier->cost; }
																	else{
																		echo 'No Data'; 
																	}
																	
																	?></b></td>
                                                                </tr>
															
																<tr>
                                                                    <td><b> Counter Delivery Charges</b></td>
                                                                    <td><b><?php 
																	if($shipping_cost != '')
																	{
																	echo $shipping_cost;
																	}
																	else{
																	echo 'No Data'; 
																	}
																	?></b></td>
                                                                </tr>
																<?php  }     ?>		
														
																
																
																
																
																
																
																
																
																
																
																
																
																
                                                            </table>
                                                            </div><!-- /.box-body -->
                                                            <div class="box-footer">
                                                                <?php  if ($currentRolename == '11' or $currentRolename == '27')  {     ?>
                                                                <a href="<?php echo base_url('courier/assign_deliveryboy') ?>" class="btn btn-danger"><i class="fa fa-user"></i>Assign Delivery Executive</a>
                                                               <a href="<?php echo base_url('courier/delivered_succesful/'. $courier->cid) ?>" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-thumbs-up"></i>Counter Delivery</a>
                                                                <a href="<?php echo base_url('courier/edit_courier/'.$courier->cid) ?>" class="btn btn-success btn"><i class="fa fa-edit"></i> Edit Weight</a>
                                                                
                                                                <a href="<?php echo base_url('courier/update_status/'.$courier->cons_no) ?>" class="btn btn-primary"><i class="fa fa fa-edit"></i> Change Location/Status</a>
                                                                
                                                               
                                                                
                                                                <?php  } ?>
																
																
																
																
                                                                <?php  if ($currentRolename == '28')  {     ?>
                                                                <a href="<?php echo base_url('courier/courier_delivered') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
																<?php  if ($courier->status != "13")  {     ?>
															
																<a href="<?php echo base_url('courier/cms_pickup_delivery/'. $courier->cid) ?>" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-user"></i>PickUp</a>
																<?php } ?>
																
                                                                <?php } ?>
																
																
																
																
                                                                <?php  if ($currentRolename != '28' )  {     ?> 
                                                                <a href="<?php echo base_url('courier') ?>" class="btn btn-primary btn"><i class="fa fa-arrow-left"></i> Back</a>
                                                                <?php  }?>                                                            
                                                               
                                                                
												
																
																 <?php  if ($currentRolename == '26' && $courier->status != "Delivered")  {     ?>
                                                                
																<a href="<?php echo base_url('courier/cms_self_delivery/'. $courier->cid) ?>" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-user"></i>Self Delivery</a>
																
																
																
																
																<a href="<?php echo base_url('courier/delivered_succesful/'. $courier->cid) ?>" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-thumbs-up"></i>Counter Delivery</a>
															
                                                                <a href="<?php echo base_url('courier/assign_delivery_executive/'.$courier->cid) ?>" class="btn btn-danger"  data-toggle="modal" data-target="#myModa"><i class="fa fa-user"></i>Assign Delivery Executive</a>
                                                                
                                                        <!--        <a href="< ?php echo base_url('courier/edit_courier/'.$courier->cid) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Weight</a>
                                                          -->      
                                                               
                                                            
                                                                <?php  }?>
                                                                </div><!-- /.box -->
                                                                
                                                                </div><!--/.col (left) -->
                                                                <!-- right column -->
                                                                </div>   <!-- /.row -->
                                                                </section><!-- /.content -->
                                                                <div class="modal fade" id="myModal" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Slow Network</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Please Wait..........Thank You !</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>                                                                <div class="modal fade" id="myModa" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Slow Network</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Please Wait..........Thank You !</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <?php function page_js(){ ?>

      
            
                                                                <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
                                                                <script>
                                                                $('select').select2();
                                                                </script>
                                                                <?php } ?>
                                                                <script>
                                                                function get_shipper_location(shipper_pin)
                                                                {
                                                                //alert (shipper_pin);
                                                                
                                                                var mydata = {"shipper_pin":shipper_pin};
                                                                
                                                                $.ajax({
                                                                type:"POST",
                                                                url:"get_shipper_location",
                                                                data:mydata,
                                                                success:function(response){
                                                                $("#shipper_address").html(response);
                                                                }
                                                                });
                                                                
                                                                
                                                                }
                                                                
                                                                
                                                                
                                                                function get_receiver_location(receiver_pin)
                                                                {
                                                                //alert (receiver_pin);
                                                                
                                                                var mydata = {"receiver_pin":receiver_pin};
                                                                
                                                                $.ajax({
                                                                type:"POST",
                                                                url:"get_receiver_location",
                                                                data:mydata,
                                                                success:function(response){
                                                                $("#receiver_address").html(response);
                                                                }
                                                                });
                                                                }
                                                                </script>
																			
<script src="<?php echo base_url('assets/barcode/code39.js') ?>"></script>
<script>
/* <![CDATA[ */
  function get_object(id) {
   var object = null;
   if (document.layers) {
    object = document.layers[id];
   } else if (document.all) {
    object = document.all[id];
   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   return object;
  }
get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML,1);
/* ]]> */
</script>
<script src="<?php echo base_url('assets/barcode/qr.js') ?>"></script>
    <script>
	var qrcode = new QRCode("qrcode");

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
	</script>
