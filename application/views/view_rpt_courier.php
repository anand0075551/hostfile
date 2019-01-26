<?php 
	
	foreach($cms_courier->result() as $courier); 
	
?>

<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                       Courier Report Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">

                                        <table class="table table-striped ">
											
        <div class="col-md-6">
                            <td><b>Consignment No</b></td>
											<tr>
                                                
                                                <td>
												<div id="externalbox">
												<div id="inputdata" style="color:red;"><?php echo $courier->cons_no; ?>
												</div>

												</div>
											</td>
                                            </tr>
                            
           </div>    
				<div class="col-md-6">	
  <input id="text"  type="text" value="<?php echo $courier->cons_no; ?>" style="display:none;" /><br />
  <td><b>Consignment No</b></td>
											<tr >
                                                
                                               <td align="center">
											
												<div  id="qrcode"  style="height:100px;width:100px;" ></div>
												
											</td>
                                            </tr>
  											
                       </div>                         
                                               
                                      





											
									<tr>
										<td>Shipper Name</td>
										<td>
											<?php 
											$query1 = $this->db->get_where('users', ['id' => $courier->ship_name]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											} else 
											{
												 echo  "";
											}
											?>
										</td>
									</tr> 
											
											<tr>
                                                <td>Phone </td>
                                                <td><?php echo $courier->phone; ?></td>
                                            </tr>
											
											<tr>
										<!--<td>Pincode</td>
										<td>
											< ?php 
											$query1 = $this->db->get_where('pincode', ['id' => $courier->shipper_pincode]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->pincode;
												}
											} else 
											{
												 echo  "";
											}
											?>
										</td>
									</tr> -->
											<tr>
                                                <td>Shipper Pincode</td>
                                                <td><?php 
												
											//	echo $courier->shipper_pincode; 
						$query2 = $this->db->get_where('pincode', ['id' => $courier->shipper_pincode,]);
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					echo	$pincode = $row2->pincode;
				}
				} else {
			echo		$pincode =  "No Data ";
				}	
												
												
												
												?></td>
                                            </tr>
											<tr>
												<td>Shipper Address</td>
												<td><?php echo $courier->s_add; ?></td>
											</tr>
											<tr>
												<td>Reciever Name</td>
												<td><?php echo $courier->rev_name; ?></td>
											</tr>
											<tr>
												<td>Reciever Phone</td>
												<td><?php echo $courier->r_phone; ?></td>
											</tr>
											<tr>
												<td>Reciever Pincode</td>
												<td><?php 
										//		echo $courier->receiver_pincode; 
									$query3 = $this->db->get_where('pincode', ['id' => $courier->receiver_pincode,]);
							if ($query3->num_rows() > 0) {
								foreach ($query3->result() as $row3) {
								echo	$receiver_pincode = $row3->pincode;
							}
							} else {
							echo	$receiver_pincode =  "No Data ";
							}
												?></td>
											</tr>
											<tr>
												<td>Reciever Address</td>
												<td><?php echo $courier->r_add; ?></td>
											</tr>
											<tr>
												<td>Type </td>
												<td><?php echo $courier->type; ?></td>
											</tr>
											<tr>
												<td>Weight </td>
												<td><?php echo $courier->weight; ?></td>
											</tr>
																						<tr>
												<td>SMB Weight </td>
												<td><?php echo $courier->smb_weight; ?></td>
											</tr>
																						<tr>
												<td>SMB Volume </td>
												<td><?php echo $courier->smb_volume; ?></td>
											</tr>
											<tr>
												<td>Invoice No.</td>
												<td><?php echo $courier->invice_no; ?></td>
											</tr>
											<tr>
												<td>Quantity</td>
												<td><?php echo $courier->qty; ?></td>
											</tr>
											<tr>
												<td>Book Mode</td>
												<td><?php echo $courier->book_mode; ?></td>
											</tr>
											<tr>
												<td>freight</td>
												<td><?php echo $courier->freight; ?></td>
											</tr>
											<tr>
												<td>Mode</td>
												<td><?php echo $courier->mode; ?></td>
											</tr>
											<tr>
												<td>Pickup Date</td>
												<td><?php echo $courier->pick_date; ?></td>
											</tr>
											<tr>
												<td>Pickup Time</td>
												<td><?php echo $courier->pick_time; ?></td>
											</tr>
											<tr>
												<td>Status</td>
												<td><?php echo $courier->status; ?></td>
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
										<td>Assigned To</td>
										<td>
											<?php 
											$query1 = $this->db->get_where('users', ['id' => $courier->assigned_to]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->first_name. ' '.$row->last_name;
												}
											} 
											?>
										</td>
									</tr> 
									<tr>
										<td>Business Name</td>
										<td>
											<?php 
											$query1 = $this->db->get_where('business_groups', ['id' => $courier->business_group]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->business_name;
												}
											} else 
											{
												 echo  "";
											}
											?>
										</td>
									</tr> 
									
									
											<tr>
                                                <td>Created By</td>
                                               <td><?php $query2 = $this->db->get_where('users', ['id' => $courier->created_by]);
											
											if ($query2->num_rows() > 0) 
											{
												foreach ($query2->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											} 
											 ?>
											 </td>
                                            </tr>	
                                           
                                        </table>

                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                       
										<a href="<?php echo base_url('Courier_report_detials/view_courier_report_detials' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
                                     
                            </div><!-- /.box -->
						</div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
				
				
				<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/barcode/code39.js') ?>"></script>

<script type="text/javascript">
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

<?php } ?>
