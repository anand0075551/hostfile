<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>
 <?php include('header.php'); ?>

<section class="content">
    <div class="row">
   
<?php if ($sponsors->num_rows() > 0){?>
		 <!-- Sponsorship -->
		<div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">Sponsor/Contribute For event <?php echo $event;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
					<table class="table table-hover">
                        <tr>
                        <th>For</th>
                        <th>Charge</th>
                        <th>Required</th>
                        <th>Percentage</th>
                        <th>Amount</th>
                        <th>Pay</th>
                        </tr>
					    <?php 
						$cnt=1;
						foreach ($sponsors->result() as $s) {
							//
							$table_name = "em_user_sponsorship";	
							$where_array = " event ='". $event."' AND sponsorship = '".$s->sponsorship."' ";								
							$query = $this->db->where($where_array )->get($table_name);
							$sum = 0 ;
							if ($query->num_rows() > 0) 
							{
								foreach ($query->result() as $r)
								{
									$sum = $sum + $r->amount;
								}
								if($sum < $s->charge)
								{
									$required = ($s->charge) - $sum;
								}
								else
								{
									$required = 0;
								}
								
								
							}
							else
							{
								$required = $s->charge ;
							}
							//
							?>
                        <tr>
                            <td><?php  echo $s->title;?></td>
                            <td><?php  echo $s->charge;?></td>
                            <input type="hidden" name="<?php echo $cnt;?>charge" id="<?php echo $cnt;?>charge" value="<?php  echo $s->charge;?>">
                            <input type="hidden" name="<?php echo $cnt;?>sponsor" id="<?php echo $cnt;?>sponsor" value="<?php  echo $s->sponsorship;?>">
                            <td><input type="text" name="<?php echo $cnt;?>required" id="<?php echo $cnt;?>required" value="<?php  echo $required;?>"  readonly></td>
                            <td><input type="text" name="<?php echo $cnt;?>perc" id="<?php echo $cnt;?>perc" onChange="get_amount(<?php  echo $cnt;?>)" placeholder="please enter the % amount which you wish to pay"></td>
                            <td><input type="text" name="<?php echo $cnt;?>amount" id="<?php echo $cnt;?>amount" readonly></td>
                            <td>
                            <button type="button" align="center" class="btn btn-primary" id="balance_check_btn<?php  echo $cnt;?>" onClick="take_confirmation(<?php  echo $cnt;?>)" ><i class="fa fa-money"></i> pay</button>
                            <button type="button" align="center" class="btn btn-success" id="complete_order_btn<?php  echo $cnt;?>" onClick="pay_now(<?php  echo $cnt;?>)" style="display:none;"><i class="fa fa-money"></i> pay</button>
                    <a href="<?php echo base_url('Event_management/events/') ?>" class="btn btn-secondary" id="cancel_order<?php  echo $cnt;?>" style="display:none;">Cancel</a>
                            </td>
                        </tr>
                        <?php $cnt++; } ?>
                    </table>
                   <a href="<?php echo base_url('Event_management/events/') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.sponsorship -->
<?php } ?>
    </div>   <!-- /.row -->
</section>
<script>
function get_amount(cnt)
{
	var charge = document.getElementById(cnt+'charge').value;
	var perc = document.getElementById(cnt+'perc').value;
	var amount = (perc/100) * charge;
	var required = charge - amount;
	document.getElementById(cnt+'amount').value = amount;
	document.getElementById(cnt+'required').value = required;
	//alert(required);
}
</script>
<script>
function take_confirmation(cnt)
{
	var amount = document.getElementById(cnt+'amount').value;
	$("#balance_check_btn"+cnt).hide();
	$("#complete_order_btn"+cnt).fadeIn();
	$("#cancel_order"+cnt).fadeIn();
	$("#complete_order_btn"+cnt).html("Comfirm Your Order By Deducting "+amount+" Values");
	
}
</script>
<script>
function pay_now(cnt)
{
	$("#complete_order_btn"+cnt).fadeOut();
	$("#cancel_order"+cnt).fadeOut();
	var amount = document.getElementById(cnt+'amount').value;
	/*if(confirm(amount + "CPA value will deduct from your account"))
	{*/
	var sponsor = document.getElementById(cnt+'sponsor').value;
	var events = "<?php echo $event;?>";
	
	if(amount == '')
	{
		alert('Please enter amount');
	}
	else
	{
		//alert('Please wait..');
		var mydata = {"amount": amount,"sponsor": sponsor,"event": events};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Event_management/pay_now') ?>",
			data: mydata,
			success: function (response) {
				//$("#reg_product_id").html(response);
				alert(response);
				location.reload(); 
			}
		});	
	}
	/*}*/
}
</script>