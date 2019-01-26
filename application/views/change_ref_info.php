<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
	
	
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
?>
<!-- Main content -->
<section class="content">
<?php
$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$role = singleDbTableRow($user_id)->rolename;
	$currentUser = singleDbTableRow($user_id)->role;
	$current_ref = singleDbTableRow($user_id)->referral_code;
		
?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Change Referral Information</h3>
                </div><!-- /.box-header -->
				
				<div class="row" style="padding:20px;">
					<div class="col-sm-2"></div>
					<div class="col-sm-3">
						<select  class="from-control" name="role_name" id="role_name" style=" width:100% auto;"  onChange="get_users(this.value)" >
							<option value="">Choose Role Name</option>
							<?php 
								
								if($role == 11){
									$get_role = $this->db->group_by('rolename')->get('users');
									foreach($get_role->result() as $r){
										echo "<option value='".$r->rolename."'>".singleDbTableRow($r->rolename,'role')->rolename."</option>";
									}
									
								}else{
									$get_role = $this->db->group_by('rolename')->get_where('users',['referredByCode'=>$current_ref]);
									foreach($get_role->result() as $r){
										echo "<option value='".$r->rolename."'>".singleDbTableRow($r->rolename,'role')->rolename."</option>";
									}
									
								}
								
							?>
						</select>
					</div>
					<div class="col-sm-3" id="user_div" style="display:none;" > 
						<select class="form-control" name="user_name" id="user_name" style=" width:100% auto; ">
							<option value=""> Choose User Name</option>
							
						</select>
					</div>
					<div class="col-sm-2 text-center">
							
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-search"></i> Search </button>
						
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>		
				<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
					<div class="row" style="padding:10px;">
						<div class="col-sm-12 text-right">
							<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
							&nbsp;
							<button type="button" class="btn btn-success btn-sm btn-flat" onclick="CSV.begin('#example').download('Referral_info.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i>  Download CSV</button>
						</div>
					</div>
				</div>
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<div>
						<table id="example" class="table table-bordered table-striped table-hover print_div">
							<thead>
							<tr>
								<th>Action</th>
								<th>Role Name</th>
								<th>Referral ID</th>
								<th>Name</th>
								<th>Contact No.</th>
								<th>Current Root ID</th>
								<th>Assign New Root ID</th>
								<th>Status</th>
								<th>Update	Status</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th>Action</th>
								<th>Role Name</th>
								<th>Referral ID</th>
								<th>Name</th>
								<th>Contact No.</th>
								<th>Current Root ID</th>
								<th>Assign New Root ID</th>
								<th>Status</th>
								<th>Update	Status</th>
							</tr>
							</tfoot>
						</table>
					</div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section><!-- /.content -->
<div class="box-footer" align="right">

</div>


<!---------------Root ID--pop up------------------->
<div class="modal fade" id="root_id" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:50px; margin-top:50px;">
 
		</div>
	</div>
</div>
<!--------------End_Root ID---pop up------------>


<!--End Create Category -->
<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">
	$(function() {
		$("#example").DataTable({
		  "paging": true,
		  "destory": true,
		  "ordering": true,
		  "info": true,
			"ajax": "<?php echo base_url('Ref_info/referral_ListJson'); ?>"
		});
	});

</script>

<script>
function search_result()
	{
		
		
		var role_name         = $("#role_name").val();
		var user_name		  = $("#user_name").val();
		
		var mydata = {"role_name" : role_name, "user_name":user_name};
		
		$(function() {
            $("#example").DataTable({
				 "paging": true,
				  "ordering": true,
				  "destroy": true,
				  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('Ref_info/search_refferal_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });
		
	}
</script>



<script>
	$(document).ready(function(){
	var form = $('.print_div'),
	//	cache_width = form.width(),
		a4  =[ 868,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('Referral_info.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>





<script>
	function get_users(id){
		if(id == ""){
			$("#user_div").fadeOut(1000);
			$("#user_name").val('');
					
		}else{
			
			var mydata = {"rol_id": id};
				$.ajax({
				type: "POST",
				url: "<?php echo base_url('Ref_info/get_ref_info'); ?>",
				data: mydata,
				success: function (response) {
					$("#user_name").html(response);
				}
			});	
			
			$("#user_div").fadeIn(1000);
			
		}	
	}
</script>



<script>
function change_status(cnt)
{
    var status = document.getElementById(cnt+'status').value;
    var aid = document.getElementById(cnt+'aid').value;
	var mydata = {"status": status,"aid": aid};
    	$.ajax({
		type: "POST",
		url: "update_status",
		data: mydata,
		success: function (response) {
			location.reload(); 
		//	alert(response);
		}
	});
}
</script>



</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>

<script>
	$('select').select2();
</script>

<?php } ?>

