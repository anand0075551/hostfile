<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>

<?php } ?>
 <!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
       <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
               <div class="col-md-6">
               <div class="box">
                <div class="box-body">
               
               <table class="table table-striped">
               		<tr>
                    	<td>Location : </td>
                        <td>
                        	<select name="location" id="location" class="form-control">
                            <option value="">All</option>
                            <?php
                            if ($location->num_rows() > 0) 
                            {
                                foreach ($location->result() as $loca) 
                                {
                                    echo '<option value="'.$loca->location.'"> '.singleDbTableRow($loca->location, 'pincode')->location.'</option>';
                                }
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Status : </td>
                        <td>
                        	 <select name="status" id="status" class="form-control" >
                                <option value=""> All</option>
                                <option value="1"> Active</option>
                                <option value="0"> Inactive</option>
                                <option value="2"> Closed</option>	
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Created By :</td>
                        <td>
                        	 <select name="created_by" id="created_by" class="form-control" >
                                <option value="">All</option>
                                    <?php
                                    if ($created_by->num_rows() > 0) 
                                    {
                                        foreach ($created_by->result() as $creat) 
                                        {
                                            echo '<option value="'.$creat->created_by.'"> '.singleDbTableRow($creat->created_by, 'users')->first_name.'</option>';
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td> Organised/Approved By : </td>
                        <td>
                        	  <select name="organised_by" id="organised_by" class="form-control" >
                                <option value="">All</option>
                                    <?php
                                    if ($organised_by->num_rows() > 0) 
                                    {
                                        foreach ($organised_by->result() as $org) 
                                        {
                                            echo '<option value="'.$org->organised_by.'"> '.singleDbTableRow($org->organised_by, 'users')->first_name.'</option>';
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                    </tr>
               </table>
              		
                </div>	
               </div>
               </div>
               <div class="col-md-6">
               <div class="box">
                <div class="box-body">
               
              		<table class="table table-striped">
                    	<tr>
                        	<td>Reg.Start Date</td>
                            <td>
                            	<input type="text" class="some_class"  id="some_class_1" name="rsf_time"  placeholder="From"/>
								<input type="text" class="some_class"  id="some_class_2" name="rst_time"  placeholder="To"/>
                            </td>
                        </tr>
                        <tr>
                        	<td>Reg.End Date</td>
                            <td>
                            	<input type="text" class="some_class" value="" id="some_class_3" name="ref_time"  placeholder="From"/>
								<input type="text" class="some_class" value="" id="some_class_4" name="ret_time"  placeholder="To"/>
                            </td>
                        </tr>
                        <tr>
                        	<td>Event.Start Date</td>
                            <td>
                            	<input type="text" class="some_class"  id="some_class_5" name="esf_time"  placeholder="From"/>
								<input type="text" class="some_class"  id="some_class_6" name="est_time"  placeholder="To"/>
                            </td>
                        </tr>
                        <tr>
                        	<td>Event.End Date</td>
                            <td>
                            	<input type="text" class="some_class" value="" id="some_class_7" name="eef_time"  placeholder="From"/>
								<input type="text" class="some_class" value="" id="some_class_8" name="eet_time"  placeholder="To"/>
                            </td>
                        </tr>
                        <tr>
                        	<td>Budget</td>
                            <td>
                            	<input type="text" name="min_budget" id="min_budget" placeholder="Min">
                                <input type="text" name="max_budget" id="max_budget" placeholder="Max">
                            </td>
                        </tr>
                        
                    </table>
                    </div>
               </div>
                </div>
                <button type="button" name="submit" value="search" class="btn btn-primary" onClick="search_result()" style="margin-left:40%;"><i class="fa fa-search"></i> Search </button>
                <button type="button" class="btn btn-warning " id="create_pdf"><i class="fa fa-file-pdf-o"></i> Export to PDF</button>
                <button type="submit" name="submit" value="csv" class="btn btn-primary"><i class="fa fa-download"></i>Export to CSV</button>
                </form>
                  <br><br>
                <!--Search result table -->
                <div class="col-md-12">
               <div class="box">
                <div class="box-body">
                <div  id="print_div" >
                <div id="total_bud"></div>
                <table id="example2" class="table table-bordered table-striped table-hover" style="display:none;">

                        <thead>
                        <tr>
						    <th>Action</th>
                            <th>Event ID.</th>
                            <th>Budget</th>
                            <th>Location</th>
                            <th>Registration Received</th>
                            <th>Contribution Received</th>
							<th>Contractors Total</th>
                           	<th>Contractors Balance</th>
                            
                        </tr>
                        </thead>
<!-- ListJson -->
                        <tfoot>
                        <tr>
						    <th>Action</th>
                            <th>Event ID.</th>
                            <th>Budget</th>
                            <th>Location</th>
                            <th>Registration Received</th>
                            <th>Contribution Received</th>
							<th>Contractors Total</th>
                           	<th>Contractors Balance</th>

                        </tr>
                        </tfoot>

                    </table>
                    
                    </div>
                  </div>
                  </div>
                  </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    

</section><!-- /.content -->
  
<?php function page_js(){ ?>

<script>
	$(document).ready(function(){
	var form = $('#print_div'),
	//	cache_width = form.width(),
		a4  =[ 830,  841.89];  // for a4 size paper width and height

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
			doc.save('events_report.pdf');
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

    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        function search_result()
		{
			$("#example2").show();
			
			var location =document.getElementById('location').value;
			var status =document.getElementById('status').value;
			var created_by =document.getElementById('created_by').value;
			var organised_by =document.getElementById('organised_by').value;
			var rsf_time=document.getElementById('some_class_1').value;
			var rst_time=document.getElementById('some_class_2').value;
			var ref_time=document.getElementById('some_class_3').value;
			var ret_time=document.getElementById('some_class_4').value;
			var esf_time=document.getElementById('some_class_5').value;
			var est_time=document.getElementById('some_class_6').value;
			var eef_time=document.getElementById('some_class_7').value;
			var eet_time=document.getElementById('some_class_8').value;
			var min_budget =document.getElementById('min_budget').value;
			var max_budget =document.getElementById('max_budget').value;
			//alert(sf_time);alert(st_time);alert(ef_time);alert(et_time);
			var mydata = {"location": location,"status":status,"created_by":created_by,"organised_by":organised_by,"rsf_time" : rsf_time,"rst_time" : rst_time,"ref_time" : ref_time,"ret_time" : ret_time,"esf_time":esf_time,"est_time":est_time,"eef_time":eef_time,"eet_time":eet_time,"min_budget":min_budget,"max_budget":max_budget };
			$(function() {
            $("#example2").dataTable({
				 "destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Event_management/search_report'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });
			
			
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('Event_management/get_total_budget') ?>", 
			data: mydata,
			success: function (response) {
				$("#total_bud").html(response);
				
				
			}
		});	
			
		}
	</script>




<?php } ?>

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