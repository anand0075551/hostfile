
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<?php 
	$user_info = $this->session->userdata('logged_user');
    $user_id = $user_info['user_id'];
?>

<!-- Main content -->
<section class="content">
	
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
					
                </div><!-- /.box-header -->
				<?php 
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$query = $this->db->get_where('vouchers', ['user_id' => $user_id, 'paid_by' => 0]);
					if($query->num_rows() > 0){
				?>
				<div class="row" style="padding:20px; margin:auto; border-bottom:1px solid lightgray; border-radius:0px 0px 30px 30px;">
					<div class="row">
					<div class="col-sm-3" style="margin-bottom:10px;">
						<p><label>Voucher Type</label></p>
						<select class="form-control" name="voc_type" id="voc_type" style="width:100% auto;" onchange="get_food_type(this.value)">
							<option value="">Choose Option</option>
							<?php 
								$get_voucher = $this->db->order_by('voucher_name', 'asc')->group_by('voucher_name')->get_where('vouchers', ['user_id'=>$user_id]);
								foreach($get_voucher->result() as $v){
									echo "<option value='".$v->voucher_name."'>".singleDbTableRow($v->voucher_name, 'status')->status."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3" id="voc_name_div" style="margin-bottom:10px; display:none;">
						<p><label>Voucher Name</label></p>
						<select class="form-control" name="voc_name" id="voc_name" style=" width:100% auto; ">
							<option value="">Choose Option</option>
						</select>
					</div>
					<div class="col-sm-3" style="margin-bottom:10px;">
						<p><label>Used/Not Used</label></p>
						<select class="form-control" name="usage" id="usage" style=" width:100% auto; ">
							<option value="">Choose Option</option>
							<option value="yes">Used</option>
							<option value="no">Not Used</option>
						</select>
					</div>
					<div class="col-sm-3" style="margin-bottom:10px;">
						<p><label>Transfarable Type</label></p>
						<select class="form-control" name="transfarable" id="transfarable" style=" width:100% auto; ">
							<option value="">Choose Option</option>
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					</div>
					<div class="row">
					<div class="col-sm-3" style="margin-bottom:10px;">
						<p><label>Date Range</label></p>
						<input type="text" class="some_class form-control" value="" id="from_date" placeholder="From Date" style="height:30px;">
					</div>
					<div class="col-sm-3 text-center" style="margin-bottom:10px;">
						<font color="white"><p><label>Voucher Type</label></p></font>
						<input type="text" class="some_class form-control" value="" id="to_date" placeholder="To Date" style="height:30px;">
					</div>
					<div class="col-sm-6 text-right" style="margin-bottom:20px;">
						<font color="white"><p><label>Voucher Type</label></p></font>
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
					</div>
					<div class="row" style="padding-top:15px; display:none;" id="selection_sts">
						<div class="col-sm-12 text-center">
							<font color="red"><label id="sts">Please Select Any Criteria To Refine Record!</label></font>
						</div>
					</div>
				</div>
					
				<?php } ?>	
				
				
				<div class="row" style="padding:10px; border-bottom:1px solid lightgray; border-radius:0px 0px 30px 30px; margin:auto;">
					<div class="col-lg-6" style="padding-left:20px;">
						<h3 class="box-title">Your Vouchers</h3>
					</div>
					<div class="col-lg-6 text-right" style="padding-right:20px; padding-top:15px;">
						<a class="btn btn-success" href="<?php echo base_url('food_voucher/create_food_voucher/') ?>" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-gift"></i>  Create New Voucher</a>
					</div>
				</div>
					
				
				
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">
						<div class="row">
							<div class="col-md-12">
								<thead>
									<tr>
										<th width="6%">Action</th>
										<th width="10%">Voucher Type</th>       
										<th width="10%">Voucher Name</th>       
										<th width="10%">Voucher ID</th>       										
										<th width="10%">Voucher Points</th>										
										<th width="10%">Valid From</th>		
										<th width="10%">Valid Till</th>	
										<th width="10%">Transferrable</th>											
										<th width="10%">Transferred/Paid</th>											
										<th width="10%">Used</th>											
										<th width="10%">Used By</th>
									</tr>
								</thead>
							</div>
						</div>
<!-- Data is fetching from	app/controller/vouchers.php 
public function vouchersListJson()-->
						<div class="row">
							<div class="col-md-12">
								<tfoot>
									<tr>
										<th>Action</th>
										<th>Voucher Type</th>       
										<th>Voucher Name</th>       
										<th>Voucher ID</th>       										
										<th>Voucher Points</th>										
										<th>Valid From</th>		
										<th>Valid Till</th>	
										<th>Transferrable</th>											
										<th>Transferred/Paid</th>											
										<th>Used</th>											
										<th>Used By</th>
									</tr>
								</tfoot>
							</div>
						</div>
                    </table>
                </div><!-- /.box-body -->
				
				 <div class="box-footer">
                </div>
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->


<?php function page_js(){ ?>

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
                "ajax": "<?php echo base_url('food_voucher/vouchersListJson'); ?>"
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


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<script>
	function search_result(){
		
		var voucher_type = $('#voc_type').val().trim();
		var voc_type = $('#voc_name').val().trim();
		var usage = $('#usage').val().trim();
		var transfarable = $('#transfarable').val().trim();
		
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		
		if(voucher_type=="" && voc_type=="" && usage=="" && transfarable=="" && from_date=="" && to_date==""){
			$('#selection_sts').fadeIn();
			$('#sts').html('Please Select Any Criteria To Refine Search..!');
		}
		else if( (from_date!="" && to_date=="") || (from_date==="" && to_date!="") ){
			$('#selection_sts').fadeIn();
			$('#sts').html('Please Select Date Range Properly..!');
		}
		else{
			$('#selection_sts').fadeOut();
			var mydata = {"voucher_type": voucher_type, "voc_type": voc_type, "usage": usage, "transfarable": transfarable, "from_date": from_date, "to_date": to_date};
			
			$(function() {
				$("#example").dataTable({
					"destroy": true,
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?php echo base_url('food_voucher/voucher_report_ListJson'); ?>",
						"type":"POST",
						"data": mydata
					 }
				});
			});
			
				
		}
	}
</script>

<script>
	function get_food_type(id)
	{
		if(id == ""){
			$('#voc_name_div').hide(1000);
		}
		else{
			$('#voc_name_div').show(1500);
			var mydata = {"voc_type" : id };
			$.ajax({
				type: "POST",
				url:  "<?php echo base_url('Food_voucher/get_voch_type') ?>",
				data: mydata,
				success: function (response) {
				 $("#voc_name").html(response);
				}
			});
		}
	}
</script>

<?php } ?>

