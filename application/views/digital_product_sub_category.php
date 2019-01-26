
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
                    <h3 class="box-title">Manage Sub Categories ( Digital Product )</h3>
                </div><!-- /.box-header -->
				<div class="row">
					<div class="col-lg-12 text-right" style="padding-right:30px;"> 
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#digital_sub_category" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Create Subcategory</a>
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
                            <th>Category </th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr> 
							 <th  width="18%">Action</th>
							<th>Name</th>
                            <th>Banner</th>
                            <th>Category </th>
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
<br>--->
</div>


<!-- Create Category -->
<div class="modal fade" id="digital_sub_category" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px; margin-top:100px;">
			
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					    <div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title"> Add Sub-category ( Digital Product ) </h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
							<div class="box-body">

									<div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
										<label for="firstName" class="col-md-4">Sub Category Name
											<span class="text-red">*</span>
										</label>
										<div class="col-md-8">
											<input type="text" name="category_name" class="form-control"  placeholder="Sub-Category Name">
											<?php echo form_error('category_name') ?>
										</div>
									</div>
									<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';?>">
										<label for="firstName" class="col-md-4">Sub Category Banner
											<span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
										</label>
										<div class="col-md-8">
											<input type="file" name="userfile" class="form-control" size="20" />
											<?php // echo form_error('street_address') ?>
										</div>
									</div> 
									
									<div class="form-group <?php if(form_error('category_id')) echo 'has-error'; ?>">
										<label for="invoiceid" class="col-md-4">Category
											<span class="text-red">*</span>
										</label>							
											<div class="col-md-8">
												<select name="category_id" class="form-control" style="width:100%;">
												<option value=''>Select Category</option>
													<?php
														$query = $this->db->order_by('category_name','asc')->get_where('smb_category', ['digital'=>'ok']);
															foreach($query->result() as $res)
															{
																echo "<option value='$res->id'>" .$res->category_name."</option>";
															}
													?>
												</select>
												<?php echo form_error('category_id') ?>
											</div>
									</div>
									<div class="form-group <?php if(form_error('brand_id')) echo 'has-error'; ?>">
										<label for="invoiceid" class="col-md-4">Brands
											<span class="text-red">*</span>
										</label>							
											<div class="col-md-8">
												<select name="brand_id[]" class="form-control" style="width:100%;" multiple=''>
													<?php
														
														// Get brand  ID
															$query = $this->db->order_by('id','desc')->get('smb_brand');
															foreach($query->result() as $res)
															{
																echo "<option value='$res->id'>" .$res->name."</option>";
															}
													?>
												</select>
												<?php echo form_error('brand_id') ?>
											</div>
									</div>
								</div>
								<div class="box-footer text-right">
									<button type="submit" name="submit" value="digital_sub_category" class="btn btn-primary">
										<i class="fa fa-edit"></i> Add Sub Category
									</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								</div>
							</form>
						</div><!-- /.box -->
					</div><!--/.col (left) -->
				</div> 
			</div>
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
                "ajax": "<?php echo base_url('Smb_product/digital_subcategory_ListJson'); ?>"
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
                url: "<?php echo base_url('Smb_product/delete_digital_sub_category') ?>",
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


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<?php } ?>

