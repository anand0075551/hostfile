<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <!-- chat -->
   
    
    

<?php } ?>
<script>
setInterval(
function autoRefresh()
{
	$("#latest").load(location.href + " #latest");
	
	$("#chatroom").load(location.href + " #chatroom");
	
	$("#freez_r").load(location.href + " #freez_r");
	$("#online_users").load(location.href + " #online_users");
	$("#my_bidd").load(location.href + " #my_bidd");
},1000);
setInterval(
function autoRefresh2()
{
	
	$("#online_users").load(location.href + " #online_users");
	
},5000);
setInterval(
function autoRefresh3()
{
	
	$("#timing").load(location.href + " #timing");
	
},1000);
</script>
<?php include('header.php'); ?>
 <?php
	foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$balance=$wallet_balance;

?>  
</head>
<body>

<section class="content">
<div class="row">
    <div class="col-md-12">
    <!-- Bidding  Section -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                   <div class="box-body">
                       <!-- Details -->
                       <div id="timing">
                       <?php 
					   $where_array = array( 'event_no' => $ev );
						$table_name="bidding_events";
						$query = $this->db->where($where_array )->get($table_name);
						if($query->num_rows() > 0)
						{
							foreach($query->result() as $row)
							{
								$location=$row->location;
								$start=$row->start_time;
								$end=$row->end_time;
							}
						}
						$today=date('Y/m/d H:i');
						$datetime1 = new DateTime($today);
						$datetime2 = new DateTime($end);
						$interval = $datetime1->diff($datetime2);
						
						
						if($end <= $today)
						{
							$data1 = [
								'status'  	=> 0
								];
								$query3 = $this->db->where('event_no',$ev )->update('bidding_events', $data1);
								
							//redirect(base_url('bidding/my_bidding_events/'));
							echo "<font color='#009900'>Time out</font><br>Thank you ....";?>
							 <script type="text/javascript">
							 document.getElementById("add_chat").disabled = true;
							 $('#chat_now').hide();
                             </script>
					   <a href="<?php echo base_url('bidding/my_bidding_events/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
						<?php }
						else
						{
							echo " <font color='#009900'>Time Left ".$interval->format('%d')." Days ".$interval->format('%h')." Hours ".$interval->format('%i')." Minutes</font>";
					   ?>
                      
                       </div>
                       <div id="my_bidd" class="box-body table-responsive no-padding">
                      
                      
                       		 <?php if(!empty($details)): foreach($details as $view): ?>
                             <h4 style="color:#3c8dbc">I want to <b><?php if($view['type'] =='S') { echo 'SELL'; } else { echo 'BUY'; } ?></b> <?php echo $view['title']; ?></h4>
                               <table class="table table-hover" align="center">
                                <tr>
                                    <td width="20%">Created At</td>
                                    <td><?php echo $timestamp=date('d/m/Y h:i A',$view['created_at']); ?></td>
                                </tr>
                                
                                <tr>
                                    <td width="20%">Category</td>
                                    <td><?php echo $view['category_name']; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%">Sub Category</td>
                                    <td><?php echo $view['sub_category_name']; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%">Product</td>
                                    <td><?php echo $view['title']; ?></td>
                                </tr>
                                <?php if($view['type'] == 'S'){ ?>
                                <tr>
                                    <td width="20%">Amount</td>
                                    <td>
                                   <!-- <input type="text" name="amount" id="amount" value="<?php //echo $view['amount'];?>" class="form-control">-->
									<?php echo $view['amount']; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%">Quantity</td>
                                    <td>
                                   <!--  <input type="text" name="quantity" id="quantity" value="<?php ///echo $view['quantity'];?>" class="form-control">-->
									<?php echo $view['quantity']; ?>
                                    <input type="hidden" name="bbno" value="<?php echo $view['bidding_no'];?>">
                                      <input type="hidden" name="bproduct" value="<?php echo $view['product'];?>">
                                    </td>
                                </tr>
                                <tr>
                                <td>&nbsp;</td>
                                <td><!--<button type="submit" name="update" value="update" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update
                        </button>--></td>
                                </tr>
                                <?php } ?>
                                
                                
                            </table>
                       <?php endforeach; endif;?>
                       </div>
                       <!-- Ends -->
                       <!-- Latest Changes -->
                       <div id="latest" class="box-body table-responsive no-padding">
           
                       <?php if(!empty($changes)):?>
                            <h3>What is happening</h3>
                            
                           <table id="example" class="table table-bordered table-striped table-hover">
                            <tr>
                            <td>From</td>
                            <td>To</td>
                            <td> Amount</td>
                            <td> Quantity</td>
                            <td> Total Amount</td>
                             </tr>
								<?php foreach($changes as $change):
								
									$where_array5 = array( 'bidding_no' => $change['requested_by'] , 'event_no' => $ev );
									$table_name5="bidding_event_users";
									 $query5 = $this->db->where($where_array5 )->get($table_name5); 
									 foreach($query5->result() as $row5);
									 $where_array6 = array( 'bidding_no' => $change['requested_to'] , 'event_no' => $ev );
									$table_name6="bidding_event_users";
									 $query6 = $this->db->where($where_array6 )->get($table_name6); 
									 foreach($query6->result() as $row6);
								 ?>
                                <tr>
                                <td><?php 
								if($view['bidding_no'] ==$change['requested_by'])
								{
									echo '<font color="#FF0000">Me</font>';
								} else{
								echo $row5->bidding_name;
								}
								?></td>
                                <td><?php 
								if($view['bidding_no'] ==$change['requested_to'])
								{
									echo '<font color="#FF0000">Me</font>';
								} else{
								echo $row6->bidding_name; 
								}
								?></td>
                                <td><font color="#009900"><?php echo $change['requested_amount'];?></font></td>
                                <td><?php echo $change['requested_quantity'];?></td>
                                 <td><font color="#FF0000">Rs: <?php echo $change['requested_amount'] * $change['requested_quantity'];?></font></td>
                                </tr>
                                <?php endforeach;?>
                                </table>
							<?php  endif;?>
                       </div>
                       <!-- Ends -->
                       <!-- Freez -->
                       <!-- SELLER -->
                       <div id="freez_r" class="box-body table-responsive no-padding">
                        
                       <?php 
						   $where_array = array( 'requested_to' => $view['bidding_no'] , 'event_no' => $ev, 'request_accept' =>0 );
							$table_name="bidding_freez";
							$query = $this->db->order_by('id','DESC')->where($where_array )->get($table_name);
							if($query->num_rows() > 0)
							{?>
                            <h3>Freez Requests</h3>
                            
                           <table id="example" class="table table-bordered table-striped table-hover">
                            <tr>
                            <td>Action</td>
                            <td>Requested By</td>
                            <td>Requested Amount</td>
                            <td>Requested Quantity</td>
                             <td>Total  Amount</td>
                            <td>Requested At</td>
                            
                            </tr>
								<?php foreach($query->result() as $row)
								{?>
                                <tr>
                                <td><?php 
	 if($view['type'] =='B') {
								if($balance < ($row->requested_amount * $row->requested_quantity) )
								{
									echo 'Please Increase your CPA balance';
								}
								else
								{
								
								 echo ' 
					   <a  class="btn btn-warning blockUnblock" href="'.base_url('bidding/bidding_freez_accept/'. $row->id).'" title="Accept Now">
						<i class="fa fa-thumbs-up" aria-hidden="true"></i>
</a>';?>
                        <?php  echo ' 
					   <a  class="btn btn-primary editBtn" href="'.base_url('bidding/freez_decline/'. $row->id).'" title="Decline Now">
						<i class="fa fa-thumbs-down" aria-hidden="true"></i></a>';
						}
		}
		else
		{
							 echo ' 
					   <a  class="btn btn-warning blockUnblock" href="'.base_url('bidding/bidding_freez_accept/'. $row->id).'" title="Accept Now">
						<i class="fa fa-thumbs-up" aria-hidden="true"></i>
</a>';?>
                        <?php  echo ' 
					   <a  class="btn btn-primary editBtn" href="'.base_url('bidding/freez_decline/'. $row->id).'" title="Decline Now">
						<i class="fa fa-thumbs-down" aria-hidden="true"></i></a>';
		}
						?>
                         </td>
                                <td><?php echo '<a  href="'.base_url('bidding/bidding_view/'. $row->requested_by ).'" data-toggle="modal" data-target="#myModal" title="View">'. $row->requested_by.'</a>' ;?> </td>
                                <td><?php echo $row->requested_amount;?> </td>
                                <td><?php echo $row->requested_quantity;?> </td>
                                 <td><font color="#009900">Rs:<?php echo $row->requested_amount * $row->requested_quantity;?></font> </td>
                                <td><?php echo $timestamp=date('d/m/Y h:i A',$row->requested_at);?> </td>
                                </tr>
								<?php }?>
                                </table>
							<?php }?>
                            </div>
                       <!-- BUYER -->
                       
                       <!-- Ends -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Ends -->
       <!--  Chat Section -->
       <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                   <div class="box-body">
                   <?php if($view['type'] == 'B'){ ?> <!--<button type="submit" name="logout" value="logout" class="btn btn-primary">logout</button><br>-->
                   <font color="#CC0000"><h4>NB: Once the freez request accept, the amount will deduct from your CPA account</h4></font>
				   <?php } ?>
                     	<!-- Users -->
                        <div id="online_users" class="box-body table-responsive no-padding">
                         <?php if($view['type'] == 'S'){ ?>
                          <h3>Buyers</h3>
                          <?php } else { ?>
                          <h3>Sellers</h3>
                          <?php } ?>
                   		 <?php if($users) {?>
						<ul>
						<?php foreach($users->result() as $user) { ?>
                     		<li>
								<?php echo '<a  href="'.base_url('bidding/bidding_view/'. $user->bidding_no ).'" data-toggle="modal" data-target="#myModal" title="View">'. $user->bidding_name.'</a>' ;
								if($user->login_status ==1)
								{
									echo ' (<font color="#00CC00">Online</font>)';
								}
								else
								{
									echo ' (<font color="#FF0000">Offline</font>)';
								}
								
								?>
                                
                            </li>
						<?php } ?>
                        </ul>
						<?php } else { echo 'No users'; }?>
                           </div>
                        <!-- Ends -->
                       <!-- CHATS -->
                       	<div id="chatroom" class="box-body table-responsive no-padding">
                        <h3>Inbox</h3>
                        <?php
							$where =" requested_by_type !='".$view['type']."'  AND event_no ='".$ev."' AND freez =0 ";
							$table_name="bidding_user_chat";
							if($view['type'] =='S')
							{
								$query3 = $this->db->limit(4,0)->order_by('CAST(`requested_quantity` AS UNSIGNED) * `requested_amount`','desc')->where($where)->get($table_name);
							}
							else if($view['type'] =='B')
							{
								$query3 = $this->db->order_by('CAST(`requested_quantity` AS UNSIGNED) * `requested_amount`','asc')->limit(4,0)->where($where)->get($table_name);
							}
							
							if($query3->num_rows() > 0)
							{?>
                            <table id="example" class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th>User</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Deal</th>
                                </tr>
                                <?php foreach($query3->result() as $row3){?>
                                <tr>
                                    <td>
                                    <?php
									$where_array4 = array( 'bidding_no' => $row3->requested_by , 'event_no' => $ev );
	  								$table_name4="bidding_event_users";
									 $query4 = $this->db->where($where_array4 )->get($table_name4); 
									 foreach($query4->result() as $row4);
									?>
                                    <?php echo $row4->bidding_name;?> 
                                    </td>
                                    <td><?php echo $row3->requested_amount;?> </td>
                                    <td><?php echo $row3->requested_quantity;?></td>
                                     <td><font color="#00CC00">Rs: <?php echo $row3->requested_amount * $row3->requested_quantity;?></font></td>
                                    <td>
                                    <?php if($view['type'] =='S'){
										$quantity_int = intval(preg_replace('/[^0-9]+/', '', $row3->requested_quantity), 10);
										if($quantity_int > $view['quantity'])
										{
											echo 'Sorry..You  have only '.$view['quantity'].' products ';
										}
										else
										{?>
											<?php echo '<a href="'.base_url('bidding/bidding_freez_now/'. $row3->id).'" title="Freez Now">';?> <font color="#FF0000">Deal</font></a>
										<?php }
										?>
                                    <?php } else {?>
                                    <?php if($balance < ($row3->requested_amount * $row3->requested_quantity) ) { echo 'Please increase your CPA balance '; } else {?>
									<?php echo '<a href="'.base_url('bidding/bidding_freez_now/'. $row3->id).'" title="Freez Now">';?> <font color="#FF0000">Deal </font></a>
                                    <?php }  }?>
                                    </td>
                                </tr>
                                <?php } ?>
						 </table>
                         <?php } ?>
                         <br><br>
                         <h3>OutBox</h3>
                        <?php
							$where =" requested_by ='".$view['bidding_no']."'  AND event_no ='".$ev."' ";
							$table_name="bidding_user_chat";
							if($view['type'] =='S')
							{
								$query3 = $this->db->limit(4,0)->order_by('CAST(`requested_quantity` AS UNSIGNED) * `requested_amount`','desc')->where($where)->get($table_name);
							}
							else if($view['type'] =='B')
							{
								$query3 = $this->db->order_by('CAST(`requested_quantity` AS UNSIGNED) * `requested_amount`','asc')->limit(4,0)->where($where)->get($table_name);
							}
							
							if($query3->num_rows() > 0)
							{?>
                            <table id="example" class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                   
                                </tr>
                                <?php foreach($query3->result() as $row3){?>
                                <tr>
                                    
                                    <td><?php echo $row3->requested_amount?> </td>
                                    <td><?php echo $row3->requested_quantity;?></td>
                                     <td><font color="#00CC00">Rs: <?php echo $row3->requested_amount * $row3->requested_quantity;?></font></td>
                                    
                                </tr>
                                <?php } ?>
						 </table>
                         <?php } ?>
                         </div>
                         <div id="chat_now">
                         <h3>Chat Now</h3>
                         <?php echo form_open_multipart('', ['confirm' => 'form', 'class' => 'form-horizontal']); ?>
                        <div class="form-group <?php if(form_error('camount')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Amount
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="camount" id="camount" placeholder="Enter Amount">
                               <!-- For :<select name="camount_measure" id="camount_measure">
                                <option value="1Piece" >1Piece</option>
                                <option value="1pack" >1Packs</option>
                                <option value="1kg" >1kilo gram</option>
                                <option value="1g" >1Gram</option>
                                <option value="1ltr" >1Litre</option>
                                <option value="1ml" >1Milli Litre</option>
                                </select>-->
                                <?php echo form_error('famount') ?>
                                
                            </div>
                        </div><br><br>
                        <div class="form-group <?php if(form_error('cquantity')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3"> Quantity
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="cquantity" id="cquantity"  placeholder="Enter Quantity" onChange="get_total(this.value)">
                                <?php echo form_error('cquantity') ?>
                                <!--<select name="cmeasure" id="cmeasure">
                                <option value="Piece">Piece</option>
                                <option value="pack" >Packs</option>
                                <option value="kg" >kilo gram</option>
                                <option value="g" >Gram</option>
                                <option value="ltr" >Litre</option>
                                <option value="ml" >Milli Litre</option>
                                </select>-->
                                <div id="total" style="color:#090;"></div>
                            </div>
                            <input type="hidden" name="cproduct" value="<?php echo $view['product'];?>">
                             <input type="hidden" name="cbno" value="<?php echo $view['bidding_no'];?>">
                              <input type="hidden" name="ctype" value="<?php echo $view['type'];?>">
                             <br> <br><br>
                             <button type="submit" name="add_chat" value="add_chat" id="add_chat" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Enter
                        </button>
                        </div><br><br>
                </div>
            </div>
        </div>
        <!-- Ends -->
   </div>
</div>
<?php } ?>
   <!-- View Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>Slow Internet please wait.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>                
</section>
<script>
   function update_bidding()
   {
	var amount=document.getElementById('amount').value;
	var quantity=document.getElementById('quantity').value;
	var bno="<?php echo $view['bidding_no'];?>";
	var ev="<?php echo $ev;?>";
	var prod="<?php echo $view['product'];?>";
	
	var mydata = {"amount": amount,"quantity": quantity,"bno": bno, "ev" : ev, "prod" : prod};

	$.ajax({
		type: "POST",
		url: "update_bidding",
		data: mydata,
		success: function (response) {
			//$("#sub_cat_id").html(response);
			alert(response);
		}
	});	
	}
</script>
</body>
</html>
	
   <script>
   function freez1()
   {
	  
	   $('#freez1').toggle();
   }
   </script>
   
   <script>
   function logout_user()
   {
	   var ev ="<?php echo $ev;?>";
	   var mydata = {"ev": ev};

	$.ajax({
		type: "POST",
		url: "set_offline_user",
		data: mydata,
		success: function (response) 
		{
			
			alert(response);
		}
	});	
	  
   }
   </script>

   <script>
	function get_total(q)
	{	
		var result = isNaN(q);
		var amount = document.getElementById("camount").value;
            if (!result) 
			{
				<?php if($view['type'] =='S'){?>
			
							if(<?php echo intval(preg_replace('/[^0-9]+/', '', $view['quantity']), 10);?> < q)
							{
								alert('you have only <?php echo $view['quantity'];?> Products left');
								document.getElementById("camount").value='';
								document.getElementById("cquantity").value='';
								return false;
							}
				<?php }?>
				var total = "Total Amount is Rs: " + q * amount ;
				 $('#total').html(total);
				
            } else {
                alert("Please enter a valid number");
            }
		
  	}
 
	</script>
    