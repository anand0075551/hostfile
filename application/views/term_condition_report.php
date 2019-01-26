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
               
               <table class="table table-hover">
               		<tr>
                    	<td>Terms & Conditions : </td>
                        <td>
                        	<select name="tc" id="tc" class="form-control">
                            <option value="">All</option>
                            <?php
                            if ($tc->num_rows() > 0) 
                            {
                                foreach ($tc->result() as $tcs) 
                                {
                                    echo '<option value="'.$tcs->term_ID.'"> '.$tcs->term_ID.'</option>';
                                }
                            }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Role : </td>
                        <td>
                        	 <select name="role" id="role" class="form-control" onChange="check_exist(this.value)">
                                    <option value=""> All  </option>
                                    <?php
                                    if ($roles->num_rows() > 0) 
                                    {
                                        foreach ($roles->result() as $role) 
                                        {
                                            echo '<option value="'.$role->id.'"> '.$role->id.' -'.$role->rolename.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Status :</td>
                        <td>
                        	 <select name="status" id="status" class="form-control">
                                    <option value=""> All  </option>
                                    <?php
                                    if ($term_status->num_rows() > 0) 
                                    {
                                        foreach ($term_status->result() as $st) 
                                        {
                                            echo '<option value="'.$st->id.'"> '.$st->id.' -'.$st->status.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                        </td>
                    </tr>
                    <tr>
                        <td>OTP</td>
                        <td>
                        <select name="otp" id="otp" class="form-control">
                        	<option value=""> All  </option>
                            <option value="0"> No  </option>
                            <option value="1"> Yes  </option>
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
                        	<td>Valid.From Date</td>
                            <td>
                            	<input type="text" class="some_class"  id="some_class_1" name="rsf_time"  placeholder="From"/>
								<input type="text" class="some_class"  id="some_class_2" name="rst_time"  placeholder="To"/>
                            </td>
                        </tr>
                        <tr>
                        	<td>Valid.To Date</td>
                            <td>
                            	<input type="text" class="some_class" value="" id="some_class_3" name="ref_time"  placeholder="From"/>
								<input type="text" class="some_class" value="" id="some_class_4" name="ret_time"  placeholder="To"/>
                            </td>
                        </tr>
                         
                    </table>
                    </div>
               </div>
                </div>
                <button type="button" name="submit" value="search" class="btn btn-primary" onClick="search_result()" style="margin-left:40%;"><i class="fa fa-search"></i> Search </button>
                <button type="button" class="btn btn-warning " id="create_pdf"><i class="fa fa-file-pdf-o"></i> Export to PDF</button>
                
                <button type="reset"  class="btn btn-primary">Reset</button>
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
                            <th>Terms ID.</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                            <th>Status</th>
                            <th>OTP</th>
							<th>No: of accepted Users</th>
                          </tr>
                        </thead>
<!-- ListJson -->
                        <tfoot>
                        <tr>
						    <th>Action</th>
                            <th>Terms ID.</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                            <th>Status</th>
                            <th>OTP</th>
							<th>No: of accepted Users</th>
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
			
			var tc =document.getElementById('tc').value;
			var role =document.getElementById('role').value;
			var status =document.getElementById('status').value;
			var otp =document.getElementById('otp').value;
			var rsf_time=document.getElementById('some_class_1').value;
			var rst_time=document.getElementById('some_class_2').value;
			var ref_time=document.getElementById('some_class_3').value;
			var ret_time=document.getElementById('some_class_4').value;
			
			//alert(sf_time);alert(st_time);alert(ef_time);alert(et_time);
			var mydata = {"tc": tc,"status":status,"otp":otp,"role":role,"rsf_time" : rsf_time,"rst_time" : rst_time,"ref_time" : ref_time,"ret_time" : ret_time };
			$(function() {
            $("#example2").dataTable({
				 "destroy": true,
                "processing": true,
                "serverSide": true,
				"aaSorting": [[ 0, "asc" ]],
				"ajax": {
            		"url": "<?php echo base_url('Term_condition/search_report'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
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