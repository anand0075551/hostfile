
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
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
		 
	$role   = singleDbTableRow($user_id)->rolename;
		
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
           
                    <div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
					<div class="row" style="padding:10px;">
						<div class="col-sm-3">
							<p><label>Select Voucher Type</label></p>
							<select class="form-control" name="voc_type" id="voc_type" style=" width:100% auto; ">
								<option value="">Choose Option</option>
								<?php 
									$get_voucher = $this->db->group_by('voucher_name')->get('vouchers');
									foreach($get_voucher->result() as $v){
										echo "<option value='".$v->voucher_name."'>".$v->voucher_name."</option>";
									}
								?>
							</select>
						</div>
						<?php if($role == 11){ ?>
						<div class="col-sm-3">
							<p><label>Select Maturation Type</label></p>
							<select class="form-control" name="maturation_type" id="maturation_type" style=" width:100% auto; ">
								<option value="">Choose Option</option>
								<option value="matured">Matured</option>
								<option value="not_matured">Not Matured</option>
							</select>
						</div>
						<?php } else{ ?>
						<div class="col-sm-3" style="display:none">
							<p><label>Select Maturation Type</label></p>
							<select class="form-control" name="maturation_type" id="maturation_type" style=" width:100% auto; ">
								<option value="">Choose Option</option>
								
							</select>
						</div>
						<?php } ?>
						<div class="col-sm-3">
							<p><label>Select Used/Not Used</label></p>
							<select class="form-control" name="usage" id="usage" style=" width:100% auto; ">
								<option value="">Choose Option</option>
								<option value="yes">Used</option>
								<?php if($role == 11){ ?>
								<option value="no">Not Used</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-3">
							<p><label>Select Transfarable Type</label></p>
							<select class="form-control" name="transfarable" id="transfarable" style=" width:100% auto; ">
								<option value="">Choose Option</option>
								<option value="yes">Yes</option>
								<option value="no">No</option>
							</select>
						</div>
					</div>
					<div class="row" style="padding:10px;">
						<div class="col-sm-3">
							<p><label>Select Date Range</label></p>
							<input type="text" class="some_class form-control" value="" id="from_date" placeholder="From Date" style="height:30px;">
						</div>
						<div class="col-sm-3 text-center">
							<p style="color:white;"><label>Space</label></p>
							<input type="text" class="some_class form-control" value="" id="to_date" placeholder="To Date" style="height:30px;">
						</div>
						<div class="col-sm-3 text-center">
							
						</div>
						
						<div class="col-sm-3 text-right">
							<p style="color:white;"><label>Space</label></p>
							<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
							<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
						</div>
					</div>
					<br>
					<div class="row" style="padding:10px; display:none;" id="selection_sts">
						
						<div class="col-sm-12 text-center">
							<p id="sts" class="text-red"></p>
						</div>
					
					</div>
                </div><!-- /.box-header -->
                <div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
					<div class="row" style="padding:10px;">
						<div class="col-sm-12">
					<!--	<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
							&nbsp; -->
							<button type="button" class="btn btn-success btn-sm btn-flat" onclick="CSV.begin('#example').download('vouchers_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
						</div>
					</div>
                </div><!-- /.box-header -->
				
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-hover print_div">
					
								<thead>
									<tr class="well">
										<th width="8%">Action</th>
									<?php if($role == 11){	?>
										<th>Voucher Owner</th> 
										<th>User Email</th> 
										<th>User Account No</th> 
									<?php } ?>
										<th>Voucher Type</th>       
										<th>Voucher ID</th>       										
										<th>Voucher Points</th>										
										<th>Valid From</th>		
										<th>Valid Till</th>											
										<th>Transferrable</th>											
										<th>Transferred To</th>											
										<th>Used</th>											
										<th>Used By</th>											
									</tr>
								</thead>
							
<!-- Data is fetching from	app/controller/vouchers.php 
public function vouchersListJson()-->
						
								<tfoot>
									<tr class="well">
										<th>Action</th>
									<?php if($role == 11){	?>
										<th>Voucher Owner</th> 
										<th>User Email</th> 
										<th>User Account No</th> 
									<?php } ?>
										<th>Voucher Type</th>       
										<th>Voucher ID</th>       										
										<th>Voucher Points</th>										
										<th>Valid From</th>	
										<th>Valid Till</th>	
										<th>Transferrable</th>											
										<th>Transferred To</th>
										<th>Used</th>											
										<th>Used By</th>
									</tr>
								</tfoot>
						
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->



<?php function page_js(){ ?>


    <!-- InputMask -->
 <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
   
	
    <script>/*
window.onerror = function(errorMsg) {
    $('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

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
startDate:    '1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});


var startdate = $("#txtstartdate").val();
$('.some_class').datetimepicker({ minDate: startdate });

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
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('vouchers/all_vouchers_ListJson'); ?>"
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
                url: "<?php echo base_url('vouchers/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>

<script>
	function search_result(){
		
		var voc_type = $('#voc_type').val().trim();
		var maturation_type = $('#maturation_type').val().trim();
		var usage = $('#usage').val().trim();
		var transfarable = $('#transfarable').val().trim();
		
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		
	//	alert(from_date);
	//	alert(to_date);
		
		if(voc_type=="" && maturation_type=="" && usage=="" && transfarable=="" && from_date=="" && to_date==""){
			$('#selection_sts').fadeIn();
			$('#sts').html('Please Select Any Criteria To Filter Vouchers..!');
		}
		else if( (from_date!="" && to_date=="") || (from_date==="" && to_date!="") ){
			$('#selection_sts').fadeIn();
			$('#sts').html('Please Select Date Range Properly..!');
		}
		else{
			$('#selection_sts').fadeOut();
			var mydata = {"voc_type": voc_type, "maturation_type": maturation_type, "usage": usage, "transfarable": transfarable, "from_date": from_date, "to_date": to_date};
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('vouchers/voucher_report_ListJson'); ?>",
				data: mydata,
				success: function (response) {
					$("#example").html(response);
					//alert(response);
				}
			});	
		}
	}
</script>




<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<?php } ?>

