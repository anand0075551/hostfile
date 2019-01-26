<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
	$root_id 			= singleDbTableRow($user_id)->root_id;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Role Transfer</h3>
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
									$get_role = $this->db->group_by('rolename')->get_where('users',['root_id'=>$root_id]);
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
				</div>	
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<div>
						<table id="example" class="table table-bordered table-striped table-hover print_div">
							<thead>
							<tr>
								<th>Role Name</th>
								<th>Referral ID</th>
								<th>Name</th>
								<th>Company Name</th>
								<th>Role Transfer</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th>Role Name</th>
								<th>Referral ID</th>
								<th>Name</th>
								<th>Company Name</th>
								<th>Role Transfer</th>
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


<!-----------Role Transfer--pop up---------->
<div class="modal fade" id="transfer" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content" id="my_modal" style="padding:50px; margin-top:50px;">
 
		</div>
	</div>
</div>
<!----End_Role Transfer---pop up------------>


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
			"ajax": "<?php echo base_url('Ref_info/role_transfer_listjson'); ?>"
		});
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
            		"url": "<?php echo base_url('Ref_info/search_role_transfer'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });
		
	}
</script>





<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>

<script>
	$('select').select2();
</script>

<?php } ?>

