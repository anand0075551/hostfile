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
						<p><label>Machine Name</label></p>
						<select class="form-control" name="name" id="name" style=" width:100% auto; ">
						<option value="">Choose Land ID .</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id' ,'DESC')->group_by('name')->get('machinaries');
									
                                } else {
                                    $users = $this->db->order_by('id' ,'DESC')->group_by('name')->get_where('machinaries', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $ss) {

                                        $get_user = $this->db->order_by('id' ,'DESC')->group_by('name')->get_where('machinaries', ['name' => $s->name]);
                                        foreach ($get_user->result() as $ss)
                                            ;
                                        echo "<option value=" . $ss->name . ">" . singleDbTableRow($ss->created_by)->first_name . " " . singleDbTableRow($ss->created_by)->last_name . "--" . $ss->name . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No machinaries</option>";
                                }
                                ?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Vehicle ID</label></p>
						<select class="form-control" name="vehicle_id" id="vehicle_id" style=" width:100% auto; ">
							<option value="">Choose Land ID .</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id','DESC')->group_by('vehicle_id')->get('machinaries');
                                } else {
                                    $users = $this->db->group_by('id','DESC')->group_by('vehicle_id')->get_where('machinaries', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $vv) {

                                        $get_user = $this->db->get_where('machinaries', ['vehicle_id' => $vv->vehicle_id]);
                                        foreach ($get_user->result() as $vv)
                                            ;
                                        echo "<option value=" . $vv->vehicle_id . ">" . singleDbTableRow($vv->created_by)->first_name . " " . singleDbTableRow($vv->created_by)->last_name . "--" . $vv->vehicle_id . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No vehicle id</option>";
                                }
                                ?>
						</select>
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
						<button type="button" name="submit" value="search" class="btn btn-info btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>
				
	<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
					<a href="<?php echo base_url('Machinaries/add_machinaries') ?>" class="btn btn-warning btn-sm btn-flat" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-plus"></i>Add</a>
						<button type="button" class="btn btn-success btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i>PDF</button>
						
						
						
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('machinaries_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i>CSV</button>
				  </div>
				</div><!-- /.box-header -->
			<!-- Search table-->
			

				<div  id ="excel_table"class="box-body print_div table-responsive" style="overflow-x:scroll">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                               <th width="18%">Action</th>
                                <th>Vehicle Type</th>
                                <th>Vehicle Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Hire Type</th>
                                <th>Vehicle Id</th>
								 


                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                               <th width="18%">Action</th>
                                <th>Vehicle Type</th>
                                <th>Vehicle Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Hire Type</th>
                                <th>Vehicle Id</th>
								                                  

                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
           
        </div>
    </div>

</section><!-- /.content -->
<div class="box-footer" align="center">


</div>

<?php

function page_js() { ?>


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

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	function search_result()
	{
		
		$("#example2").show();
		var  name  = $("#name").val();
		var  vehicle_id  = $("#vehicle_id").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		
		var mydata = {"name": name,"vehicle_id": vehicle_id,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example").dataTable({
              "paging": true,
                  "ordering": true,
                  "info": true,				  
				  "destroy": true,
				"ajax": {
					"url": "<?php echo base_url('Machinaries/machinaries_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		
	}
</script>
	
	
    <script type="text/javascript">
        $(function () {
            $("#example").dataTable({
				 "paging": true,
                  "ordering": true,
                  "info": true,				  
				  "destroy": true,
				 "ajax": "<?php echo base_url('Machinaries/machinariesListJson'); ?>"
				 
            });
        });

    </script>

    <script>

        $('body').on('click', 'a.deleteBtn', function () {
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you sure?'); //confirm

            if (verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Agriculture/deleteAjax') ?>",
                    data: {id: agentId},
                })
                        .done(function (msg) {
                            currentItem.closest('tr').hide('slow');
                        });
            }
        });

    </script>
	
<<script>
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
			doc.save('machinaries_land.pdf');
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

