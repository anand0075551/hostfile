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
						<p><label>Select Pincode</label></p>
						<select class="form-control" name="pincode" id="pincode" style=" width:100% auto; ">
							<option value="">Choose Pincode.</option>
							<option value="" >All</option>
							<?php 
								$get_name = $this->db->group_by('pincode')->get_where('pincode');
								foreach($get_name->result() as $p)
								{
									$name = $p->pincode;
									
									echo "<option value=".$name.">".$name."</option>";
								}
							?>
						</select>
					</div>
					
				
					
					<!--==============-->
					
					
					
					

					<!--==============-->
					<div class="col-sm-3"> 
						<p><label>Select State</label></p>
						<select name="state" id="state" style="width:100% auto;" class="form-control" onchange="get_district(this.value)">
                                    <option value=""> Select State </option>
                                      <?php
                                    if($country->num_rows() > 0)
                                    {
                                        foreach($country->result() as $c){
                                            //$selected = ($c->id == 105)? 'selected' : '';
                                            echo '<option value="'.$c->state.'"> '.$c->state.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
					</div>
					
						<div class="col-sm-3" id ="district_div" style="display:none"> 
						<p><label>Select District</label></p>
						 <select name="district" id="district" style="width:100% auto;" class="form-control" onchange="get_taluk(this.value)">
                                    <option value=""> Select District </option>
                                    
                                </select>
					</div>
					
					
					<div class="col-sm-3" id ="taluk_div" style="display:none"> 
						<p><label>Select Taluk</label></p>
						<select class="form-control" name="taluk" onchange="get_location_id(this.value)" id="taluk" style=" width:100% auto; ">
							<option value="">Choose Taluk.</option>
							<option value="" >All</option>
							<?php 
								$get_name = $this->db->group_by('taluk')->get_where('pincode');
								foreach($get_name->result() as $p)
								{
									$name = $p->taluk;
									$id = $p->id;
									echo "<option value=".$name.">".$name."</option>";
								}
							?>
						</select>
					</div>
					
				
						<div class="col-sm-3" id ="location_id_div" style="display:none"> 
						<p><label>Select Location</label></p>
						 <select name="location" style="width:100% auto;" id="location_id" class="form-control" >
                                    <option value=""> Select location </option>
                                   
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('Pincode Report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
		<a class="btn btn-warning btn-lg" href="<?php echo base_url('Pincodes/add_pincode'); ?>" data-toggle="tooltip" title="Add Pincode">
					<i class="fa fa-plus"></i> </a>
					</div>
					</div>
			<!-- Search table-->
			
			 
			<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
					<div id="total"></div>
                    <h3 class="box-title ">Please select by above search criteria</h3>
					<table id="example2" class="table table-bordered table-striped table-hover " style="display:none">
					<thead>
						<tr>
								<th width="20%">Action</th>
								<th>Id</th>   
								<th>Pincode</th> 
								<th>Location</th>  							
								<th>Taluk</th>
								<th>District</th>
								<th>Postal Division</th>
								<th>Postal Region</th>
								<th>State</th>   
								<th>Country</th>
								<th>Created At</th>
								<th>Created By</th>
								<th>Modified At</th>
								<th>Modified By</th>
								
								
                        </tr>	
						</thead>

						<tfoot>
							<tr>
								<th width="20%">Action</th>
								<th>Id</th>   
								<th>Pincode</th> 
								<th>Location</th>  							
								<th>Taluk</th>
								<th>District</th>
								<th>Postal Division</th>
								<th>Postal Region</th>
								<th>State</th>   
								<th>Country</th>
								<th>Created At</th>
								<th>Created By</th>
								<th>Modified At</th>
								<th>Modified By</th>						
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
		var pincode      			= $("#pincode").val();
		var location_id      			= $("#location_id").val();
		
		var taluk		 		    = $("#taluk").val();
		var district		 	    = $("#district").val();
		var state		 			= $("#state").val();
		var sf_time                 =document.getElementById('some_class_1').value;
		var st_time                 =document.getElementById('some_class_2').value;
		
		var mydata = {"pincode": pincode,"taluk": taluk,"location_id": location_id,"district": district,"state": state,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Pincodes/Pincodes_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		/*$.ajax({
			type: "POST",
			url: "<?php echo base_url('vch_food_rpt/get_total') ?>", 
			data: mydata,
			success: function (response) {
				$("#total").html(response);
				
				
			}
		});*/
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
			doc.save('Pincode Report.pdf');
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
function get_district(id)
{
//   alert(id);
 if(id==""){
        $("#district_div").fadeOut(1000);
    }
    else{ 
    var mydata = {"state": id};

    $.ajax({
        type: "POST",
        "url": "<?php echo base_url('Pincodes/get_district'); ?>",
        data: mydata,
        success: function (response) {
            $("#district").html(response);
            //alert(response);
        }
    });
	 $("#district_div").fadeIn(1000); 
	}
}



function get_taluk(id)
{  //   alert(id);
if(id==""){
        $("#taluk_div").fadeOut(1000);
    }
    else{ 
    var mydata = {"district": id};

    $.ajax({
        type: "POST",
       "url": "<?php echo base_url('Pincodes/get_taluk'); ?>",
        data: mydata,
        success: function (response) {
			$("#taluk").html(response);
        }
    });
	
	 $("#taluk_div").fadeIn(1000); 
	}
}

function get_location_id(id)
{  //   alert(id);

if(id==""){
        $("#location_id_div").fadeOut(1000);
    }
    else{ 
    var mydata = {"taluk": id};

    $.ajax({
        type: "POST",
       "url": "<?php echo base_url('Pincodes/get_location_id'); ?>",
        data: mydata,
        success: function (response) {
			$("#location_id").html(response);
        }
    });
	 $("#location_id_div").fadeIn(1000); 
	}

	 $.ajax({
        type: "POST",
       "url": "<?php echo base_url('Pincodes/get_pincode'); ?>",
        data: mydata,
        success: function (response) {
			$("#pincode").html(response);
        }
    });
	
	
}



</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

