
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>


<!-- List content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Events</h3>
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Event</th>
                                <th>Name </th>
								 <th>Budget</th>
                                 <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Registration</th>
                                <th>Image</th>
                             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>Event</th>
                                <th>Name </th>
								<th>Budget</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Registration</th>
                                <th>Image</th>
                            </tr>
                        </tfoot>

                    </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<!-- Form content -->
<section class="content"><!--INVITATION DIV -->
<div class="row" id="upload_form" style="display:none">
    <div class="col-md-12">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Upload Invitation Image</a></li>
          <li><a href="#tab_2" data-toggle="tab">Send SMS</a></li>
          <li><a href="#tab_3" data-toggle="tab">Send Email</a></li>
        </ul>
        <div class="tab-content">
        <!-- -->
          <div class="tab-pane active" id="tab_1"><!-- Upload Invitation Image-->
            <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
                    <div class="form-group">
                        <label for="event" class="col-md-3">Event
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="event" id="event" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('userfile')) echo 'has-error'; ?>">
                            <label for="status" class="col-md-3">Invitation Image
                            <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">  								
                                <input type="file" name="userfile"  class="form-control"/>
                                <?php echo form_error('userfile') ?>                                
                            </div>
                    </div>
                    <div class="box-footer">
                    <button type="submit" name="submit" value="upload_img" class="btn btn-primary">
                        <i class="fa fa-up"></i> Upload Now
                    </button>
                </div>
               </form>
          </div><!-- /.Upload Invitation Image-->
          <!---->
          <div class="tab-pane" id="tab_2"><!-- Send SMS-->
            <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
            	<div id="sms"></div><!-- DO NOT DELETE -->
                    <div class="box-footer">
                    <button type="submit" name="submit" value="send_sms" class="btn btn-primary">
                        <i class="fa fa-up"></i> Send SMS
                    </button>
                </div>
            </form>
          </div><!-- /.Send SMS-->
          <!--  -->
          <div class="tab-pane" id="tab_3"><!-- Send EMAIL-->
            <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
            	<div id="email"></div><!-- DO NOT DELETE -->
                    <div class="box-footer">
                    <button type="submit" name="submit" value="send_email" class="btn btn-primary">
                        <i class="fa fa-up"></i> Send Email
                    </button>
                </div>
            </form>
          </div><!-- /.Send SMS-->
          <!--  -->
        </div>
       
      </div>
     
    </div>
 </div>
</section><!--/.INVITATION DIV -->
<!--Popup --->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
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
<!-- -->
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
                    "ajax": "<?php echo base_url('Event_management/SendListJson'); ?>"
                });
            });

    </script>
<script>
function show_form(events)
{
	
	document.getElementById('event').value =events;
	$("#upload_form").show(1000);
	
	var mydata = {"event": events};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/show_invitation_sms_form') ?>",
		data: mydata,
		success: function (response) {
			$("#sms").html(response);
			//alert(response);
		}
	});
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Event_management/show_invitation_email_form') ?>",
		data: mydata,
		success: function (response) {
			$("#email").html(response);
			//alert(response);
		}
	});
}
</script>

<?php } ?>

