
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Product Stock</h3>
                </div><!-- /.box-header -->
				<div class="box-body">
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
						    <th  width="7%">Action</th>
							<th>Product Title</th>
							<th>Total Added</th>
							<th>Total Sold</th>
							<th>Total Destroyed</th>
							<th>Available Quantity</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr> 
							<th  width="7%">Action</th>
							<th>Product Title</th>
							<th>Total Added</th>
							<th>Total Sold</th>
							<th>Total Destroyed</th>
							<th>Available Quantity</th>
                        </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section>
</div>


<script>
	function get_pincode(pin)
	{
		var mydata = {"pin":pin};
	   
		$.ajax({
		   type:"POST",
		   url:"<?php echo base_url('Smb_product/getpincode') ?>",
		   data:mydata,
		   success:function(response){
			 //alert(response);
			 $("#pincode").html(response);
		   }
	   }); 
	}
</script>

<?php function page_js(){ ?>


    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,	
                "ajax": "<?php echo base_url('Smb_product/physical_stock_ListJson'); ?>"
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
                url: "<?php echo base_url('Smb_product/stock_delete') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<script>		
	function excelData() {
		alert("Download...?");
		var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
		location.href = url;
		return false;
	}
	
</script>




<?php } ?>

