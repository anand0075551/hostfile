
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
                    <br>
                </div><!-- /.box-header -->
				<div class="row">
					<div class="col-lg-12 text-right" style="padding-right:30px;"> 
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#create" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Create Dynamic </a>
					</div>
				</div><hr>
				<div class="box-body">
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
						    <th width="5%">Action</th>
                            <th>Business Name</th>
                            <th>Sold By Label</th>
                            <th>Price Label</th>
                            <th>Currency Value</th>
                            <th>Add To Cart Label</th>
                            <th>Items Label</th>
                            <th>Invoice Heading</th>
                            <th>Sub Heading 1</th>
                            <th>Sub Heading 2</th>
                            <th>Available</th>
							
                        </tr>
                        </thead>

                        <tfoot>
                        <tr> 
							<th width="5%">Action</th>
							<th>Business Name</th>
							<th>Sold By Label</th>
							<th>Price Label</th>
							<th>Currency Value</th>
							<th>Add To Cart Label</th>
							<th>Items Label</th>
							<th>Invoice Heading</th>
                            <th>Sub Heading 1</th>
                            <th>Sub Heading 2</th>
							<th>Available</th>
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
<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px; margin-top:150px;">
			
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Create Dynamic Labels</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					<div class="form-group <?php if(form_error('business_type')) echo 'has-error'; ?>">
						<label for="firstName" class="col-md-4">Business Type
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<select name="business_types" id="business_types" class="form-control" style="width:100%;">
								<option value=>Choose Option</option>
								<?php
									$query = $this->db->order_by('business_name','asc')->get('business_groups');
										foreach($query->result() as $res)
										{
											echo "<option value='$res->id'>" .$res->business_name."</option>";
										}
								?>
							</select>
							<?php echo form_error('business_type') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Banner 1
							<span class="text-aqua">(Min 3 Banner , Max size 2MB )</span>
						</label>
						<div class="col-md-8">
							<input type="file" class="form-control" name="userfile[]" multiple="multiple">
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sold By Label
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="sold_by" class="form-control"  placeholder="Sold By">
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Price Label
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="price" class="form-control"  placeholder="Price Label">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Currency Value
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="currency" class="form-control"  placeholder="Currency Value e.g CPA, LPA">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Add To Cart Label
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="add_to_cart" class="form-control"  placeholder="Add To Cart Label">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Items Label
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="items" class="form-control"  placeholder="Items Label">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Stock Available Label
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="available" class="form-control"  placeholder="Product Available Label">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Invoice Heading
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="heading" class="form-control"  placeholder="Invoice Heading">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Invoice Sub Heading 1
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="sub_heading1" class="form-control"  placeholder="Invoice Sub Heading 1">
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Invoice Sub Heading 2
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="text" name="sub_heading2" class="form-control"  placeholder="Invoice Sub Heading 2">
						</div>
					</div>
			</div>
					<div class="box-footer text-right">
                        <button type="submit" name="submit" value="dynamic_data" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Save
                        </button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->

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
                "ajax": "<?php echo base_url('Smb_product/dynamic_smb_ListJson'); ?>"
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

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<?php } ?>

