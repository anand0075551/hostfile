<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
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
		
					
                    <div class="col-sm-3"> 
						<p><label>Select Business Name</label></p>
						<select name="business_group" id="business_group" style="width:100% auto;" class="form-control">
                                    <option value=""> Select Business Name</option>
                                    <option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->group_by('business_name')->get_where('business_groups');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->group_by('business_name')->get_where('business_groups');
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
					
						
					
					<div class="col-sm-3"> 
						<p><label>From Role</label></p>
						<select class="form-control" name="from_role" id="from_role" style=" width:100% auto; ">
							<option value="">Choose RoleName.</option>
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
					
					
					
					
				
					
				<div class="col-sm-3"> 
						<p><label>Select Status</label></p>
						<select class="form-control" name="status" id="status" style=" width:100% auto; ">
							<option value="">Choose Status</option>
							<option value="" >All</option>
							<option value="0" >Not Paid</option>
							<option value="1" >Paid</option>
							
						</select>
					</div>
					
			
					
				 <div class="col-sm-3"> 
						<p><label>Select Beneficiary Name</label></p>
						<select name="to_user" id="to_user" style="width:100% auto;" class="form-control">
                                    <option value=""> Select Beneficiary Name</option>
                                    <option value="" >All</option>
							<?php 
								 $get_users = $this->db->group_by('to_user')->get_where('upper_commission');
                                foreach($get_users->result() as $p){

                                    $name = $p->to_user;
                                    $id = $p->id;
                                    $get_name = $this->db->get_where('users',['id'=>$name]);
                                foreach ($get_name->result() as $u)

                                $fname = $u->first_name.' '.$u->last_name;

                                  echo "<option value='".$name."'>".$name." - ".$fname."</option>";
                                } 
							?>
							
						</select>
                                
					</div>
				
					<div class="col-sm-3">
							<p><label>From Date</label></p>
							<input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sf_time"  placeholder="From"/>
						</div>
						
						<div class="col-sm-3">
							<p><label>To Date</label></p>
							<input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_2" name="st_time"  placeholder="To"/>
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('Distribution Comissions Report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
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
								<th>To Role</th>  
								<th>To User</th>
								<th>Root Id</th>   
								<th>From Role</th>
								<th>From Date</th> 
								<th>End Date</th>
								<th>No. of Users</th>     
								<th>Total sales</th>  
								<th>Total Commissions</th>
								<th>Status</th>   
								<th>Invoice Number</th>
								<th>Business Groups</th> 
								 <th>Created by</th>
								<th>Modified by</th>
								<th>Created at</th>
								<th>Modified at</th>
								
						
								
								
                        </tr>	
						</thead>

						<tfoot>
							<tr>
								<th width="20%">Action</th>
									<th>To Role</th>  
								<th>To User</th>
								<th>Root Id</th>   
								<th>From Role</th>
								<th>From Date</th> 
								<th>End Date</th>
								<th>No. of Users</th>     
								<th>Total sales</th>  
								<th>Total Commissions</th>
								<th>Status</th>   
								<th>Invoice Number</th>
								<th>Business Groups</th> 
								 <th>Created by</th>
								<th>Modified by</th>
								<th>Created at</th>
								<th>Modified at</th>
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

<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>

<script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
</script>



<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
	function search_result()
	{
		$("#example2").show();
		var business_group      			= $("#business_group").val();
		var from_role		 		    = $("#from_role").val();
		var to_user		 	    = $("#to_user").val();
		var status		 			= $("#status").val();
	
		var sf_time                 =document.getElementById('some_class_1').value;
		var st_time                 =document.getElementById('some_class_2').value;
		
		var mydata = {"business_group": business_group,"from_role": from_role,"to_user": to_user,"status": status,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				 "paging": true,
                  "ordering": true,
                  "destroy": true,
                  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('Distribution_comissions_rpt/distribution_comissions_search_ListJson'); ?>",
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
                url: "<?php echo base_url('Distribution_comissions_rpt/deleteAjaxcommissions') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

	
	
</script>


    <script>
       
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
            url: "<?php echo base_url('Distribution_comissions_rpt/setBlockUnblock') ?>",
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
		$('#blockUnblockBtn').click(function(){
		location.reload();
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
			doc.save('Distribution Comissions Report.pdf');
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







</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

