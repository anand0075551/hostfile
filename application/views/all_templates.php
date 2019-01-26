<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Templates</h3>
                </div><!-- /.box-header -->
				<div class="row" style="padding:10px;">
					<div class="col-lg-12 text-right" style="padding-right:40px;">
						<a class="btn btn-success" href="<?php echo base_url('dynamic_invoice'); ?>"  style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-bookmark-o"></i>  Create New Template</a>
					</div>
				</div>
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
							<th>Action</th>
                            <th>Template Name</th>
                            <th>Title</th>
                            <th>Used For</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
							<th>Action</th>
                            <th>Template Name</th>
							<th>Title</th>
                            <th>Used For</th>
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
      <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
				"paging": true,
				"ordering": true,
                "ajax": "<?php echo base_url('dynamic_invoice/templateListJson'); ?>"
            });
        });

    </script>



<?php } ?>

