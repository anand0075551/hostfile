<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info 	 = $this->session->userdata('logged_user');
	$user_id 	 = $user_info['user_id'];
	$user_rolename = singleDbTableRow($user_id)->rolename;
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
					<div class="row" style="padding:10px;">
						    <?php 
							$query = $this->db->get_where('user_address',['user_id'=>$user_id, 'address_type'=>'Permanent']);
							if($query->num_rows() > 0)
							{?>
							<div class="col-sm-12 text-right">
								<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('sales_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
							</div>
							 <?php } else
							{
							?>
							
								<div class="col-md-12 text-right">
								<?php if($user_rolename!=11){ ?>
									<a href="<?php echo base_url('user_address/addAddress')?>" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:auto; color:white;" class="btn btn-danger btn-sm btn-flat" >Please Update Your Permanent Address @ My Profile, To Add Shipments.</a>
									&nbsp;
								<?php } ?>
									<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('sales_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
								</div>
							<?php
								
							}
						?>
						
					</div>
                </div><!-- /.box-header -->
				<hr />
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover print_div">
                        <thead>
                        <tr>
							<th width="10%">Action</th>
                            <th width="8%">Invoice ID</th>
                            <th width="15%">Buyer</th>
                            <th width="8%">Date</th>
                            <th width="8%">Total</th>
                            <th width="10%">tax(%)</th>
                            <th width="10%">Shipping Cost</th>
                            <th width="15%">Delivery Status</th>                            
                            <th width="12%">Payment Status</th> 
							<?php if($user_rolename!=11){ ?>
								<th width="15%">Add Shipment</th>                            
							<?php } ?>
                            
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
							<th>Action</th>
                            <th>Invoice ID</th>
                            <th>Buyer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>tax(%)</th>
                            <th>Shipping Cost</th>
                            <th>Delivery Status</th>                            
                            <th>Payment Status</th> 
                            <?php if($user_rolename!=11){ ?>
								<th>Add Shipment</th>                            
							<?php } ?>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,
			"ajax":"<?php echo base_url('smb_sales/saleListJson'); ?>"
		});
	});
</script>



<?php } ?>

