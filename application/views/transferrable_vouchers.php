
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
    $user_id = $user_info['user_id'];
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transferrable Vouchers</h3>
                </div><!-- /.box-header -->
				<div class="row" style="padding:10px;">
					<div class="col-lg-12 text-right" style="padding-right:40px;">
						<a class="btn btn-success" href="#" data-toggle="modal" data-target="#create" data-toggle="modal" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-gift" aria-hidden="true"></i> Transfer Vouchers </a>
					</div>
				</div>
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">
						<div class="row">
							<div class="col-md-12">
								<thead>
									<tr>
										<th width="10%">Action</th>
										<th>Voucher Type</th>       
										<th>Voucher Name</th>       										
										<th>Voucher ID</th>       										
										<th>Value</th>										
										<th>Valid From</th>		
										<th>Valid Till</th>											
									</tr>
								</thead>
							</div>
						</div>
<!-- Data is fetching from	app/controller/vouchers.php 
public function vouchersListJson()-->
						<div class="row">
							<div class="col-md-12">
								<tfoot>
									<tr>
										<th>Action</th>
										<th>Voucher Type</th>       
										<th>Voucher Name</th>       										
										<th>Voucher ID</th>       										
										<th>Value</th>										
										<th>Valid From</th>		
										<th>Valid Till</th>	
									</tr>
								</tfoot>
							</div>
						</div>
                    </table>
                </div><!-- /.box-body -->
				
				 <div class="box-footer">
                  
                </div>
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->


<!----------------------------------------Transfer Vouchers----------------------------------------------->
<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px;">
			<div class="row">
				<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
				<div class="box-header">
					<h3 class="box-title"> Transfer Vouchers </h3>
				</div><!-- /.box-header -->
				<hr>
				<!-- form start -->
				<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
					<div class="box-body">
						
						<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-4">Voucher Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <select name="voucher_type" id="voucher_type" class="form-control" style="width:100% auto;" onchange="get_voc_name(this.value)">
									<option value=""> Choose option </option>
									<?php
										$get_voc_type = $this->db->group_by('voucher_name')->get_where('vouchers', ['user_id' =>$user_id, 'transferrable'=>'yes', 'transferred_to'=>'0']);
										if($get_voc_type->num_rows() > 0){
											foreach($get_voc_type->result() as $voc_type){
												echo "<option value='".$voc_type->voucher_name."'>".singleDbTableRow($voc_type->voucher_name, 'status')->status."</option>";
											}
										}
									?>
								</select>
                                <?php echo form_error('voucher_type') ?>
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Voucher Name
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<select class="form-control" id="voc_name" name="voc_name" style="width: 100% auto;" onchange="get_vouchers(this.value)">
									<?php 
										echo "<option value=''>Choose option</option>";
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Vouchers
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<select class="form-control" name="voucher_id[]" multiple id="voucher_id" style="width: 100% auto;" onchange="getCount(this.value)">
									<option value="">Choose Vouchers</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Number of Vouchers
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<input type="text" name="reciever_name" id="count" class="form-control"  value="" readonly >
							</div>
						</div>
						
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>" >
                            <label for="firstName" class="col-md-4">To Role
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-8" >
								<select name="to_role" id="to_role" class="form-control" onchange="get_user(this.value)" style="width:100% auto;">
                                <option value="">Choose option</option>
								<?php
								$rolename = $this->db->get('role');
								if($rolename->num_rows()>0)
								{
									foreach ($rolename->result() as $c) {

                                        echo '<option value="' . $c->id . '">'.$c->id. '-' . $c->rolename . '</option>';
                                    }
								}
								?>
								</select>
                                <?php echo form_error('to_role') ?>

                            </div>
                        </div> 
						
						<div class="form-group <?php if(form_error('to_user')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-4">To User
                                <span class="text-red">*</span>
                            </label>
                             <div class="col-md-8" value="<?php echo set_value('to_user')?>";>
								<select name="to_user" id="to_user" class="form-control" style="width:100% auto;">
                                <option value="">Choose option</option>
								
								</select>
                                <?php echo form_error('to_user') ?>

                            </div>
                        </div>
						
						<hr>
						
					</div><!--End box body----->
					<!---------------Footer------------>
					<div class="box-footer text-right">
						<button type="submit" name="submit" value="transfer" id="proceed_payment" class="btn btn-success btn-sm">
							<i class="fa fa-gift"></i> Transfer Vouchers
						</button>
						<span id="warn_msg" style="display:none; font-weight:bold;"><font color="red">Please Do Not Reload The Page To Avoid Double Payment.</font></span>
						<a type="button" class="btn btn-danger btn-sm" href="<?php echo base_url('vouchers/transfer_vouchers')  ?>">Cancel</a>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
			</div> 
		</div>
	</div>
	</div>
<!-------------------------------------------Transfer Vouchers --------------------------->

<?php function page_js(){ ?>



<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url('vouchers/transferrable_vouchers_listjson'); ?>"
		});
	});

</script>

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('vouchers/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>

<script>
	function get_voc_name(voc_type){
		var mydata = {"voc_type" : voc_type};
		$.ajax({
			type 	: "POST",
			url  	: "<?php echo base_url('vouchers/get_voc_name'); ?>",
			data 	: mydata,
			success : function(response){
				$("#voc_name").html(response);
			}
		})
	}
	
	function get_vouchers(voc_name){
		var mydata = {"voc_name" : voc_name};
		$.ajax({
			type 	: "POST",
			url  	: "<?php echo base_url('vouchers/get_vouchers'); ?>",
			data 	: mydata,
			success : function(response){
				$("#voucher_id").html(response);
			}
		})
	}
	function getCount(id){
		var comboBoxes = document.querySelectorAll("#voucher_id");
		var selected = [];
		for(var i=0,len=comboBoxes.length;i<len;i++){
			var combo = comboBoxes[i];
			var options = combo.children;
			for(var j=0,length=options.length;j<length;j++){
				 var option = options[j];
				 if(option.selected){
				   selected.push(option.text);
				 }
			}
		}
		document.getElementById("count").value=selected.length;
	}

	function get_user(id)
	{
		var mydata = {"pay_to" : id };

		$.ajax({
			type: "POST",
			url:  "<?php echo base_url('vouchers/getuser') ?>",
			data: mydata,
			success: function (response) {
			 $("#to_user").html(response);
			}
		});
	}
</script>



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

