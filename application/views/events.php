
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>
<?php
/*foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$balance=$wallet_balance;*/

?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <!--<h3 class="box-title">Events</h3>-->
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body table-responsive no-padding">
                
               
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="15%">Action</th>
                                <th>Event</th>
                                <th>Name </th>
								 <th>Budget</th>
                                 <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="15%">Action</th>
                                <th>Event</th>
                                <th>Name </th>
								<th>Budget</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
 <!-- Contribute-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:800px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
   <!-- join-->
  
<div class="box-footer" align="center">
    
</div>

<?php

function page_js() { ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(function () {
                $("#example").dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('Event_management/UserEventListJson'); ?>"
                });
            });

    </script>


<?php } ?>

