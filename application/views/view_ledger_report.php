<?php function page_css(){ ?>
   <!-- datatable css -->
   <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
						<p><label>Pay Type</label></p>
						<select class="form-control" name="pay_type" id="pay_type" style=" width:100% auto; ">
							<option value="">Choose Paytype</option>
							<option value="" >All</option>
							<?php
							$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								
								if($currentUser=='admin')
								{
									$get_users = $this->db->group_by('pay_type','asc')->get_where('accounts');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->group_by('pay_type','asc')->get_where('accounts');
									} 
									  foreach($get_users->result() as $p){
								 $name = $p->pay_type;
                                    $id = $p->id;
                                    $get_name = $this->db->get_where('acct_categories',['id'=>$name]);
									 foreach ($get_name->result() as $u)

                                $fname = $u->name;

                                  echo "<option value='".$name."'>".$name." - ".$fname."</option>";
								}
								
						
							?>
						</select>
				</div>
					
						
					<div class="col-sm-3">
						<p><label>Rolename</label></p>
						<select class="form-control" name="rolename" id="rolename" style=" width:100% auto;" onchange="get_forms(this.value)">>
							<option value="">Choose Rolename</option>
							<option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->group_by('rolename')->get_where('accounts');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->group_by('rolename')->get_where('accounts');
									} 
								foreach($get_users->result() as $p){
									
									
                                    $name = $p->rolename;
                                    $id = $p->id;
                                    $get_name = $this->db->get_where('role',['id'=>$name]);
									 foreach ($get_name->result() as $u)

                                $fname = $u->rolename;

                                  echo "<option value='".$name."'>".$name." - ".$fname."</option>";
								}
							?>
							
						</select>
					</div>
                    
                    
                    <div class="col-sm-3"> 
						<p><label>Select User ID</label></p>
							<select name="user_id" id="user_id" class="form-control forms" style="width:100% auto;">
										<option value=""> Choose option </option>
									</select>	        
					</div>
					
					<div class="col-sm-3">
						<p><label>Account No</label></p>
						<select class="form-control" name="account_no" id="account_no" style=" width:100% auto; ">
							<option value="">Choose Account No.</option>
							<option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->group_by('account_no')->get_where('accounts');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->group_by('account_no')->get_where('accounts');
									} 
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->account_no.">".$p->account_no."</option>";
								}
							?>
							
						</select>
					</div>
					
					
					
                    <div class="col-sm-3">
						<p><label>Points Mode</label></p>
						<select class="form-control" name="points_mode" id="points_mode" style=" width:100% auto; ">
							<option value="">Choose Points Mode.</option>
							<option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->group_by('points_mode')->get_where('accounts');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->group_by('points_mode')->get_where('accounts');
									} 
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->points_mode.">".$p->points_mode."</option>";
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('ledger_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			
				<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
                    <h3 class="box-title ">Please select by above search criteria</h3>
					<div id="total_bud"></div>
					<table id="example2" class="table table-bordered table-striped table-hover" style="display:none">
				
                        <thead>
                        <tr>
						    <th width="7%">Action</th>
								
								<th>User ID</th>
								<th>Email</th>  
                                <th>Rolename</th>
								<th>Account No</th>
								<th>Debit</th>   
								<th>Credit</th>
								<th>Amount</th>     
								<th>Points Mode</th>
								 <th>Challan</th>
								<th>Used</th>
								<th>Paid To</th>   
                                <th>Pay type</th> 
								<th>Transaction Id</th>
								<th>Active</th> 
								<th>Created at</th>
								 <th>Modified at</th>
								<th>Trans count</th>
								
                        </tr>
                        </thead>
<!-- ListJson -->
                        <tfoot>
                        <tr>
						   <th width="7%">Action</th>
								
								<th>User ID</th>
								<th>Email</th>  
                                <th>Rolename</th>
								<th>Account No</th>
								<th>Debit</th>   
								<th>Credit</th>
								<th>Amount</th>     
								<th>Points Mode</th>
								 <th>Challan</th>
								<th>Used</th>
								<th>Paid To</th>   
                                <th>Pay type</th> 
								<th>Transaction Id</th>
								<th>Active</th> 
								<th>Created at</th>
								 <th>Modified at</th>
								<th>Trans count</th>
								
                        </tr>
                        </tfoot>

                    </table>
                  </div>
                  </div>
                  </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
			
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



<script type="text/javascript">
	function search_result()
	{
		$("#example2").show();
		
		var pay_type		 = $("#pay_type").val();
		var account_no      = $("#account_no").val();
		var rolename		 = $("#rolename").val();
		var points_mode		 = $("#points_mode").val();
		var user_id			 = $("#user_id").val();
		
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"pay_type": pay_type,"account_no": account_no,"rolename": rolename,"points_mode": points_mode,"user_id": user_id,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				
              "paging": true,
                  "ordering": true,
                
              
                  "info": true,				  
				"destroy": true,
				"ajax": {
            		"url": "<?php echo base_url('Ledgcomrpt/ledger_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
              
            });
        });	
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Ledgcomrpt/get_ledger_total') ?>", 
			data: mydata,
			success: function (response) {
				$("#total_bud").html(response);
				
				
			}
		});	
	}
</script>


	
<script>
	function get_forms(user_id)
{
//    alert(bgform_id);
    var mydata = {"forms":user_id};

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



<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>

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
			doc.save('ledger_reports.pdf');
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
<?php } ?>