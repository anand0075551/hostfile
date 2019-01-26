
<?php function page_css(){ ?>
    <!-- datatable css -->
   <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section>
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
				<div class="row" style="padding:10px;">
					<div class="col-lg-6" style="padding-right:40px;">
						<h3 class="box-title">Business Groups List</h3>
					</div>
					<div class="col-lg-6 text-right" style="padding-right:40px; padding-top:20px;">
						<a class="btn btn-success" href="<?php echo base_url('permission/create_groups'); ?>"  style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-globe"></i>  Add New Business Name</a>
					</div>
				</div>
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
						    <th width="20%">Action</th>
                            <th>Business Groups</th>
                            <th>Payment Account</th>
                            <th>Payment Reciever</th>
                            <th>Sale Status</th>

                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
							 <th>Action</th>
                            <th>Business Groups</th>
							<th>Payment Account</th>
                            <th>Payment Reciever</th>
							<th>Sale Status</th>

                        </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>
<div class="container">
 



    <!-- DATA TABES SCRIPT -->
   <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
				"paging": true,
				"ordering": true,
                "ajax": "<?php echo base_url('permission/bgListJson'); ?>"
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
                url: "<?php echo base_url('permission/delete2Ajax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });


    $('body').on('click', 'button.blockUnblock', function () {
        var agentId = $(this).attr('id');
        var buttonValue = $(this).val();
        //alert(buttonValue);
        //set type of action
        var currentItem = $(this);
        if(buttonValue == 1){
            var status = 'Unblocked';
        }else if(buttonValue == 2){
            var status = 'Blocked';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('permission/setBlockUnblock') ?>",
            data: {id: agentId, buttonValue : buttonValue, status : status}
        })

        .done(function (msg) {
            if(buttonValue == 1){
                currentItem.removeClass('btn-success');
                currentItem.addClass('btn-warning');
                currentItem.html('<i class="fa fa-lock"></i>');
                currentItem.attr( 'title','Block');
                currentItem.val(2);
            }else if(buttonValue == 2){
                currentItem.removeClass('btn-warning');
                currentItem.addClass('btn-success');
                currentItem.html('<i class="fa fa-unlock-alt"></i>');
                currentItem.attr( 'title','Unblock');
                currentItem.val(1);
            }
        });
    });



</script>


<?php } ?>

