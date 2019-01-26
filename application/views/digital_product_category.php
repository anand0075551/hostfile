<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage Categories ( Digital Product )</h3>
                </div><!-- /.box-header -->
				<div class="row">	
					<div class="col-lg-12 text-right" style="padding-right:30px;"> 
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#create_category" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Create Categories </a>
					</div>
				</div><hr>
				<div class="box-body">
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
						    <th  width="18%">Action</th>
                            <th>Name</th>
                            <th>Banner</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr> 
							<th  width="18%">Action</th>
                            <th>Name</th>
                            <th>Banner</th>
                        </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section><!-- /.content -->
<div class="box-footer" align="right">
<!--<button name="submit" class="btn btn-warning" value="export" onClick="excelData(this)">
<i class fa fa-credit-card"></i> Download  Details </button>
<br>
<br>-->
</div>


<!-- Create Category -->
<div class="modal fade" id="create_category" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px; margin-top:150px;">
			<div class="row">
			 <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add New Category</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
						<div class="box-body">

								<div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
									<label for="firstName" class="col-md-3">Category Name
										<span class="text-red">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" name="category_name" class="form-control"  placeholder=" Category Name">
										<?php echo form_error('category_name') ?>
									</div>
								</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Banner
									<span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
								</label>
								<div class="col-md-9">
									<input type="file" name="userfile" class="form-control" size="20" />
								</div>
							</div>
						</div>
							<div class="box-footer text-right">
								<button type="submit" name="submit" value="digital_category" class="btn btn-primary">
									<i class="fa fa-edit"></i> Add Category
								</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div><!-- /.box -->
				</div><!--/.col (left) -->
			</div>
		</div>
	</div>
<!--End Create Category -->


<?php function page_js(){ ?>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,	
                "ajax": "<?php echo base_url('Smb_product/digital_product_list'); ?>"
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
                url: "<?php echo base_url('Smb_product/deleteAjax') ?>",
                data: {id: agentId},	
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

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

