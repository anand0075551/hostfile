<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
              <div class="col-md-12">
               <div class="box">
                <div class="box-body">
               <div class="row" style="padding:10px;">
			   
			   		<div class="col-sm-3"> 
						<p><label>Select Role Group</label></p>
							<select name="to_user1" id="to_user1" class="form-control" style="width:100% auto;"onchange="get_role(this.value)">
										<option value=""> Choose option </option>
										<option value="1"> Management </option>
										<option value="2"> Managers </option>
										<option value="3"> Business Agents </option>
										<option value="4"> Users </option>
										
									</select>	        
					</div>
					
					<div class="col-sm-3" id ="district_div1" style="display:none"> 
						<p><label>Select Rolename</label></p>
						<select class="form-control" name="rolename" id="rolename" onchange="get_user1(this.value)" style=" width:100% auto; ">
							<option value="">Choose Rolename</option>
							
						</select>
					</div>
						<div class="col-sm-3" id ="district_div12" style="display:none"> 
						<p><label>Select User</label></p>
							<select name="assigned_to_name" style="width:100% auto;"id="assigned_to_name" class="form-control">
										<option value=""> Choose option </option>
										
									</select>	
					</div>
				        
					 <div class="col-sm-3" style="display:none"> 
						<p><label>Select Points Mode</label></p>
						<select name="points_mode" id="points_mode" class="form-control" style="width:100%    auto;">
								<option value="">Choose Points Mode</option>
							<?= 
						
							
								$get_points_mode= $this->db->group_by('points_mode')->get('accounts');
								
								foreach($get_points_mode->result() as $t)
								{
								
								//$points_mode = $t->points_mode;
							
								
								echo "<option value='".$t->points_mode."'>".$t->points_mode."</option>";
							}
							?>
											
										
						</select>	        
					</div>						
					
					
					</div>
					<hr>
					  <div class="row" style="padding:10px;">
					<div class="col-sm-3">
						<p><label>Select Mobile number</label></p>
						<select class="form-control" name="contactno" id="contactno" style=" width:100% auto; ">
							<option value="">Choose Mobile number</option>
							<option value="" >All</option>
							<?php 
								$contactno = $this->db->group_by('contactno')->get('users');
								foreach($contactno ->result() as $u)
								    {
										echo "<option value='".$u->contactno."'>".$u->contactno."</option>";
									}
							?>
						</select>
					</div>
					
			
					<div class="col-sm-3">
						<p><label>Select Email</label></p>
						<select class="form-control" name="email" id="email" style=" width:100% auto; ">
							<option value="">Choose Email</option>
							<option value="">All</option>
							<?php 
								$email = $this->db->group_by('email')->get('users');
								foreach($email->result() as $v){
									echo "<option value='".$v->email."'>".$v->email."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Referral Code</label></p>
						<select class="form-control" name="referral_code" id="referral_code" style=" width:100% auto; ">
							<option value="">Choose Referral Code</option>
							<option value="">All</option>
							<?php 
								$referral_code = $this->db->group_by('referral_code')->get('users');
								foreach($referral_code->result() as $v){
									echo "<option value='".$v->referral_code."'>".$v->referral_code."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Status</label></p>
						<select class="form-control" name="active" id="active" style=" width:100% auto;">
							<option value="">Choose Status</option>
							<option value="">All</option>
							<option value="0">Pending</option>
							<option value="1">Active</option>
							<option value="2">Blocked</option>
							<option value="3">Blocked by Admin</option>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Referred By Code</label></p>
						<select class="form-control" name="referredByCode" id="referredByCode" style="width:100% auto; ">
							<option value="">Choose Referred By Code</option>
							<option value="">All</option>
							<?php 
								$referredByCode = $this->db->group_by('referredByCode')->get('users');
								foreach($referredByCode->result() as $v){
									echo "<option value='".$v->referredByCode."'>".$v->referredByCode."</option>";
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
					<div class="col-sm-3">
						<p><label>From Date of Birth</label></p>
						<input type="text" class="some_class form-control" style="height:30px;" value="" id="dob1" name="dob1"  placeholder="From"/>
					</div>
					
					<div class="col-sm-3">
						<p><label>To Date of Birth</label></p>
						<input type="text" class="some_class form-control" style="height:30px;" value="" id="dob2" name="dob2"  placeholder="To"/>
					</div>
					   </div>	
				<div class="row" style="padding:10px;">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3 text-right"><br><br>
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>
              		<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('user.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				  </div>
             
               </div>
              </div>
                <!--Search result table -->
              <div class="col-md-12">
               <div class="box">
                <div class="box-body print_div" style="overflow-x:scroll">
                <table id="example2" class="table table-bordered table-striped table-hover" style="display:none;">
				
                        <thead>
                        <tr>
						    <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
							<th>Rolename</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Points Mode</th>
                            <th>Contact No.</th>
                            <th>Ref. Code</th>
							<th>Row Password</th>
                            <th>Gender</th>
							<th>Date of Birth</th>
                            <th>Profession</th>
                            <th>Street Address</th>                            
                            <th>Area Name</th>
							<th>Area Id</th>
                            <th>City</th>
							<th>City Id</th>
                            <th>Country</th>					
                            <th>Country Id</th>                            
                            <th>Postal Code</th>
							<th>ID type</th>
                            <th>ADHAAR No.</th>
							<th>Pan No.</th>
                            <th>IFSC code</th>
                            <th>Bank Account</th>                            
                            <th>Bank Account type</th>
							<th>Bank Account name</th>
                            <th>Bank Address</th>
							<th>Passport No.</th>
							<th>Company Name</th>
                            <th>Licence</th>
                            <th>Agreed Per</th>                            
                            <th>Role</th>
							<th>Online Status</th>
                            <th>Time</th>
							<th>Cash</th>
                            <th>Others</th>
                            <th>User Last Login</th>                            
                            <th>Account No.</th>
							<th>Referred By</th>
                            <th>Photo</th>
							<th>Created By</th>
                            <th>Created At</th>
                            <th>Modified By</th>                            
                            <th>Modified At</th>
							<th>Root Id</th>
                            
                        </tr>
                        </thead>
<!-- ListJson -->
                        <tfoot>
                       <tr>
						    <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
							<th>Rolename</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Points Mode</th>
                            <th>Contact No.</th>
                            <th>Ref. Code</th>
							<th>Row Password</th>
                            <th>Gender</th>
							<th>Date of Birth</th>
                            <th>Profession</th>
                            <th>Street Address</th>                            
                            <th>Area Name</th>
							<th>Area Id</th>
                            <th>City</th>
							<th>City Id</th>
                            <th>Country</th>					
                            <th>Country Id</th>                            
                            <th>Postal Code</th>
							<th>ID type</th>
                            <th>ADHAAR No.</th>
							<th>Pan No.</th>
                            <th>IFSC code</th>
                            <th>Bank Account</th>                            
                            <th>Bank Account type</th>
							<th>Bank Account name</th>
                            <th>Bank Address</th>
							<th>Passport No.</th>
							<th>Company Name</th>
                            <th>Licence</th>
                            <th>Agreed Per</th>                            
                            <th>Role</th>
							<th>Online Status</th>
                            <th>Time</th>
							<th>Cash</th>
                            <th>Others</th>
                            <th>User Last Login</th>                            
                            <th>Account No.</th>
							<th>Referred By</th>
                            <th>Photo</th>
							<th>Created By</th>
                            <th>Created At</th>
                            <th>Modified By</th>                            
                            <th>Modified At</th>
							<th>Root Id</th>
                            
                        </tr>
                        </tfoot>

                    </table>
                  </div>
                  </div>
                  </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    

</section><!-- /.content -->
  
<?php function page_js(){ ?>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>	
	
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
    <script type="text/javascript">
        function search_result()
		{
			$("#example2").show();
			
		var contactno        = $("#contactno").val();
		var rolename	     = $("#rolename").val();
		var referral_code	 = $("#referral_code").val();
		var email			 = $("#email").val();
		var active			 = $("#active").val();
		var assigned_to_name			 = $("#assigned_to_name").val();
		var points_mode			 = $("#points_mode").val();
		var referredByCode	 = $("#referredByCode").val();
		var sf_time          = document.getElementById('some_class_1').value;
		var st_time          = document.getElementById('some_class_2').value;
		var dob1          	 = document.getElementById('dob1').value;
		var dob2          	 = document.getElementById('dob2').value;
		var mydata = {"contactno": contactno, "rolename": rolename, "referral_code": referral_code, "email": email, "active": active,"assigned_to_name": assigned_to_name,"points_mode": points_mode, "referredByCode":referredByCode, "sf_time" : sf_time, "st_time" : st_time , "dob1" : dob1, "dob2" : dob2};
			$(function() {
            $("#example2").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('referTree/user_report_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
           
            });
        });
			
			
		}
	</script>
 
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

<script>

	$(document).ready(function(){
	var form = $('.print_div'),
	
		a4  =[ 868,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		
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
			doc.save('user_report.pdf');
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
	function get_role(id)
{
 // alert(id);
 if(id==""){
        $("#district_div1").fadeOut(1000);
    }
    else{ 
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('referTree/get_user2') ?>",
		data: mydata,
		success: function (response) {
			$("#rolename").html(response);
			//alert(response);
		}
	});
	 $("#district_div1").fadeIn(1000); 
	}
}





</script>
<script>
	function get_user1(id)
{
	//alert(id);
	if(id==""){
        $("#district_div12").fadeOut(1000);
    }
    else{ 
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('referTree/get_user1') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_to_name").html(response);
			//alert(response);
		}
	});
	 $("#district_div12").fadeIn(1000); 
	}
}





</script>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
	<script>
		$('select').select2();
	</script>
	
 <?php }?> 