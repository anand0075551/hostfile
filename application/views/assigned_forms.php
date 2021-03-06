<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
	
	
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/datatable.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/datatable_bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/sort.js'); ?>"></script>
	
	
<?php } ?>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
		<div class="box">
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
		
					<!--==============-->
				<div class="col-sm-3"> 
						<p><label>Select Business Name</label></p>
						<select name="bg_id" id="bg_id" style="width:100% auto;" class="form-control" onchange="get_forms(this.value)">
                                    <option value=""> Select Business Name</option>
                                    <option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->order_by('business_name','asc')->get_where('menu_business_groups');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->order_by('business_name','asc')->get_where('menu_business_groups');
									} 
								foreach($get_users->result() as $p){
									$user_id = $p->id;
									$name = $p->business_name;
									$id = $p->id;
								
									
									
									
									
									echo "<option value='".$user_id."'>".$id." - ".$name."</option>";
								}
							?>
							
						</select>
                                
					</div>
					
					<div class="col-sm-3"  > 
						<p><label>Select Display Form Name</label></p>
						<select class="form-control forms" name="bgform_id" id="bgform_id" id="forms" style=" width:100% auto; ">
							<option value="">Choose Display Form Name</option>
							<option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->order_by('displayform_name','asc')->get_where('menu_bg_forms');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->order_by('displayform_name','asc')->get_where('menu_bg_forms');
									} 
								foreach($get_users->result() as $p){
									$user_id = $p->id;
									$name = $p->displayform_name;
									$id = $p->id;
								
									
									
									
									
									echo "<option value='".$user_id."'>".$id." - ".$name."</option>";
								}
							?>
							
					
							
						</select>
					</div>
					
					<div class="col-sm-3"> 
						<p><label>Select  RoleName</label></p>
						<select class="form-control" name="role_id" id="role_id" style=" width:100% auto; ">
							<option value="">Choose RoleName</option>
							<option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->order_by('rolename','asc')->get_where('role');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->order_by('rolename','asc')->get_where('role');
									} 
								foreach($get_users->result() as $p){
									$user_id = $p->id;
									$name = $p->rolename;
									$id = $p->id;
								
									
									
									
									
									echo "<option value='".$user_id."'>".$id." - ".$name."</option>";
								}
							?>
							
					
							
						</select>
					</div>
			
					
				
					
					</div>

				<div class="row" style="padding:10px;">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3 text-right">
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>
				
			</div><!-- /.box-header -->
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('LeftMenu Report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
		
			<!-- Search table-->
			
			 
			<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
					<div id="total"></div>
                    <h3 class="box-title ">Please select by above search criteria</h3>
					<table id="example2" class="table table-bordered table-striped table-hover " style="display:none">
					<thead>
						<tr>
								<th width="20%">Action</th>
								<th>Status</th>
								<th>Role Name</th>
								<th>Left Menu</th>
								<th>Display Form Name</th>
								
								
								 
								
								
                        </tr>	
						</thead>

						<tfoot>
							<tr>
								<th width="20%">Action</th>
								<th>Status</th>
								<th>Role Name</th>
								<th>Left Menu</th>
								<th>Display Form Name</th>
								
								
											
                        </tr>	
						</tfoot>

					
				</table>
				</div>
				</div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section>
</div>

<?php function page_js(){ ?>


<!----Datepiker SCRIPT  Files---->



<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
	function search_result()
	{
		$("#example2").show();
		var bg_id      			= $("#bg_id").val();
		var role_id      			= $("#role_id").val();
		
		var bgform_id      			= $("#bgform_id").val();
		
		//alert(bgform_id);
		
		var mydata = {"bg_id": bg_id,"role_id": role_id,"bgform_id": bgform_id};
		
		$(function() {
            $("#example2").dataTable({
				"paging": true,
                  "ordering": true,
                   "destroy": true,
                  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('menu/leftmenuform_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		
	}
	
</script>


  <script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('menu/deleteAjaxAssignedForms') ?>",
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
        }else if(buttonValue == 0){
            var status = 'Blocked';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('menu/setBlockUnblock2') ?>",
            data: {id: agentId, buttonValue : buttonValue, status : status}
        })
        .done(function (msg) {
            if(buttonValue == 1){
                currentItem.removeClass('btn-success');
                currentItem.addClass('btn-warning');
                currentItem.html('<i class="fa fa-lock"></i>');
                currentItem.attr( 'title','Block');
                currentItem.val(0);
            }else if(buttonValue == 0){
                currentItem.removeClass('btn-warning');
                currentItem.addClass('btn-success');
                currentItem.html('<i class="fa fa-unlock-alt"></i>');
                currentItem.attr( 'title','Unblock');
                currentItem.val(1);
            }
        });
    });


	
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
			doc.save('LeftMenu Report.pdf');
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



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

	
	
<script>
	function get_forms(bgform_id)
{
//    alert(bgform_id);
    var mydata = {"forms": bgform_id};

    $.ajax({
        type: "POST",
        url: "getforms",
        data: mydata,
        success: function (response) {
            $(".forms").html(response);
          //  alert(response);
        }
    });
}
 </script> 

<?php } ?>

