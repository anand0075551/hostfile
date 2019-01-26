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
						<p><label>Select Main Category</label></p>
						<select name="acct_id" id="acct_id" style="width:100% auto;" class="form-control" onchange="get_category(this.value)">
                                    <option value=""> Select Main Category </option>
                                    <option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->order_by('name','asc')->get_where('acct_categories');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->order_by('name','asc')->get_where('acct_categories');
									} 
								foreach($get_users->result() as $p){
									$user_id = $p->id;
									$name = $p->name;
									$id = $p->id;
								
									
									
									
									
									echo "<option value='".$user_id."'>".$id." - ".$name."</option>";
								}
							?>
							
						</select>
                                
					</div>
					
						<div class="col-sm-3" id ="subcategory_div" style="display:none"> 
						<p><label>Select Sub Category</label></p>
						 <select name="sub_acct_id" id="sub_acct_id" style="width:100% auto;" class="form-control">
                                    <option value=""> Select Sub Category</option>
									  <option value="" >All</option>
							<?php 
								$user_info      = $this->session->userdata('logged_user');
								$user_id      = $user_info['user_id'];
								$search = $this->input->get('search');
								$currentUser = singleDbTableRow($user_id)->role;

								if($currentUser=='admin')
								{
									$get_users = $this->db->order_by('name','asc')->get_where('acct_categories');
								}
								
								else
									{
										$where_array = array('created_by' => $user_id);
										$get_users = $this->db->order_by('name','asc')->get_where('acct_categories');
									} 
								foreach($get_users->result() as $p){
									$user_id = $p->id;
									$name = $p->name;
									$id = $p->id;
								
									
									
									
									
									echo "<option value='".$user_id."'>".$id." - ".$name."</option>";
								}
							?>
							
                                    
                                </select>
					</div>
					
					<div class="col-sm-3"> 
						<p><label>Select Sender Role</label></p>
						<select class="form-control" name="from_role" id="from_role" style=" width:100% auto; ">
							<option value="">Choose Sender Role.</option>
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
						<p><label>Select Reciever Role</label></p>
						<select class="form-control" name="to_role" id="to_role" style=" width:100% auto; ">
							<option value="">Choose Reciever Role</option>
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
						<p><label>Select Visible</label></p>
						<select class="form-control" name="visible" id="visible" style=" width:100% auto; ">
							<option value="">Choose Visible</option>
							<option value="" >All</option>
							<?php 
								
								 $get_users = $this->db->group_by('visible')->get_where('commissions');
                                foreach($get_users->result() as $p){

                                    $name = $p->visible;
                                    $id = $p->id;
                                    $get_name = $this->db->get_where('acct_categories',['id'=>$name]);
                                foreach ($get_name->result() as $u)

                                $fname = $u->visible;

                                  echo "<option value='".$name."'>".$name." ".$fname."</option>";
                                } 
							?>
						</select>
					</div>
					
					
					<div class="col-sm-3"> 
						<p><label>Select Deduction paytype</label></p>
						<select class="form-control" name="ded_paytype" id="ded_paytype" style=" width:100% auto; ">
							<option value="">Choose Deduction Type</option>
							<option value="" >All</option>
							<?php 
								$get_nam = $this->db->get_where('commissions');
								foreach($get_nam->result() as $p)
								{
									$name = $p->ded_paytype;
									
									echo "<option value=".$name.">".$name."</option>";
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('Comissions Report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
		
			<!-- Search table-->
			
			 
			<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
					<div id="total"></div>
                    <h3 class="box-title ">Please select by above search criteria</h3>
                    <div id="total_budgt"></div>
					<table id="example2" class="table table-bordered table-striped table-hover " style="display:none">
					<thead>
						<tr>
								<th width="20%">Action</th>
								<th>Identity</th>
								<th>Identity ID</th>  
								<th>Type</th>
								<th>Remarks</th>
								<th>Start Date</th>
								<th>End Date</th>   
								<th>Account ID</th>
								<th>Sub Account ID</th>     
								<th>Deducted Paytype</th>
								<th>Amount</th>  
								<th>Loyality Amount</th>
								<th>Discount Amount</th>   
								<th>From Role</th>
								<th>To Role</th> 
								<th>Comission</th>
								<th>Benefits</th>     
								<th>slr_ref_pm</th>
								<th>slr_ref_level1</th>  
								<th>slr_ref_level2</th>
								<th>slr_ref_level3</th>   
								<th>slr_ref_level4</th>
								<th>slr_ref_level5</th> 
								<th>clt_ref_pm</th>	
								<th>clt_ref_level1</th>     
								<th>clt_ref_level2</th>
								<th>clt_ref_level3</th>  
								<th>clt_ref_level4</th>
								<th>clt_ref_level5</th>   
								<th>points_mode</th>
								<th>profit_pm</th> 
								<th>sender_profit</th>
								<th>receiver_profit</th>     
								<th>deduction_pm</th>
								<th>sender_deduction</th>  
								<th>receiver_deduction</th>
								<th>transferrable</th>   
								<th>period</th>
								<th>tenure</th> 
								<th>Modified by</th>
								<th>Modified at</th>
								<th>Created at</th>
								 <th>Created by</th>
								 <th>Visible</th>
								
								
                        </tr>	
						</thead>

						<tfoot>
							<tr>
								<th width="20%">Action</th>
								<th>Identity</th>
								<th>Identity ID</th>  
								<th>Type</th>
								<th>Remarks</th>
								<th>Start Date</th>
								<th>End Date</th>   
								<th>Account ID</th>
								<th>Sub Account ID</th>     
								<th>Deducted Paytype</th>
								<th>Amount</th>  
								<th>Loyality Amount</th>
								<th>Discount Amount</th>   
								<th>From Role</th>
								<th>To Role</th> 
								<th>Comission</th>
								<th>Benefits</th>     
								<th>slr_ref_pm</th>
								<th>slr_ref_level1</th>  
								<th>slr_ref_level2</th>
								<th>slr_ref_level3</th>   
								<th>slr_ref_level4</th>
								<th>slr_ref_level5</th> 
								<th>clt_ref_pm</th>	
								<th>clt_ref_level1</th>     
								<th>clt_ref_level2</th>
								<th>clt_ref_level3</th>  
								<th>clt_ref_level4</th>
								<th>clt_ref_level5</th>   
								<th>points_mode</th>
								<th>profit_pm</th> 
								<th>sender_profit</th>
								<th>receiver_profit</th>     
								<th>deduction_pm</th>
								<th>sender_deduction</th>  
								<th>receiver_deduction</th>
								<th>transferrable</th>   
								<th>period</th>
								<th>tenure</th> 
								<th>Modified by</th>
								<th>Modified at</th>
								<th>Created at</th>
								 <th>Created by</th>
								 <th>Visible</th>			
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
		var acct_id      			= $("#acct_id").val();
		var sub_acct_id      			= $("#sub_acct_id").val();
		
		var from_role		 		    = $("#from_role").val();
		var to_role		 	    = $("#to_role").val();
		var ded_paytype		 			= $("#ded_paytype").val();
		var visible		 			= $("#visible").val();
		var sf_time                 =document.getElementById('some_class_1').value;
		var st_time                 =document.getElementById('some_class_2').value;
		
		var mydata = {"acct_id": acct_id,"sub_acct_id": sub_acct_id,"from_role": from_role,"to_role": to_role,"ded_paytype": ded_paytype,"visible": visible,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				 "paging": true,
                  "ordering": true,
                  "destroy": true,
                  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('Comissions_rpt/comissions_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Comissions_rpt/get_comission_tot') ?>", 
			data: mydata,
			success: function (response) {
				$("#total_budgt").html(response);
				
				
			}
		});	
		
		
	}
	
</script>


    <script>
       
		
		$('body').on('click', 'button.blockUnblock', function () {
        var agentId = $(this).attr('id');
        var buttonValue = $(this).val();
        //alert(buttonValue);
        //set type of action
        var currentItem = $(this);
        if(buttonValue == 0){
            var visible = 'Unblocked';
        }else if(buttonValue == 1){
            var visible = 'Blocked';
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Comissions_rpt/setBlockUnblock') ?>",
            data: {id: agentId, buttonValue : buttonValue, visible : visible}
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
			doc.save('Comissions Report.pdf');
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
function get_category(id)
{
//   alert(id);
 if(id==""){
        $("#subcategory_div").fadeOut(1000);
    }
    else{ 
    var mydata = {"acct_id": id};

    $.ajax({
        type: "POST",
        "url": "<?php echo base_url('Comissions_rpt/get_category'); ?>",
        data: mydata,
        success: function (response) {
            $("#sub_acct_id").html(response);
            //alert(response);
        }
    });
	 $("#subcategory_div").fadeIn(1000); 
	}
}







</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

