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
						<p><label>Role</label></p>
						<select class="form-control" name="role_id" id="role_id" style=" width:100% auto; ">
							<option value="">Choose Role</option>
							
							<?php 
								$condition = "role_id != 0";
								$role_nm = $this->db->group_by('role_id')->order_by('id','desc')->where($condition)->get('bank_ifsc');
								foreach($role_nm->result() as $use){
									echo "<option value=".$use->role_id.">".singleDbTableRow($use->role_id,'role')->rolename;"</option>";
								}
							?>
							
                                
						</select>
						
				</div>
					
					
				<div class="col-sm-3">
						<p><label>User Name</label></p>
						<select class="form-control" name="users_id" id="users_id" style=" width:100% auto; ">
							<option value="">Choose USER</option>
							
							<?php 
								$condition = "user_id != 0";
								$get_users = $this->db->group_by('user_id')->order_by('id','desc')->where($condition)->get('bank_ifsc');
								foreach($get_users->result() as $use){
									echo "<option value=".$use->user_id.">".singleDbTableRow($use->user_id)->first_name." ".singleDbTableRow($use->user_id)->last_name,"</option>";
								}
							?>

                                
						</select>
						
				</div>
					
			
					<div class="col-sm-3">
						<p><label>Transaction Date</label></p>
						<select class="form-control" name="txn_date" id="txn_date" style=" width:100% auto; ">
						<option value="">Choose txn date</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id' ,'DESC')->group_by('txn_date')->get('bank_ifsc');
									
                                } else {
                                    $users = $this->db->order_by('id' ,'DESC')->group_by('txn_date')->get_where('bank_ifsc', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $tx) {

                                        $get_user = $this->db->order_by('id' ,'DESC')->group_by('txn_date')->get_where('bank_ifsc', ['txn_date' => $s->txn_date]);
                                        foreach ($get_user->result() as $tx)
                                            ;
                                        echo "<option value=" . $tx->txn_date . ">" .  $tx->txn_date . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No bank ifsc code</option>";
                                }
                                ?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Bank IFSC Code</label></p>
						<select class="form-control" name="bank_ifsc" id="bank_ifsc" style=" width:100% auto; ">
							<option value="">Choose bank ifsc</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id','DESC')->group_by('bank_ifsc')->get('bank_ifsc');
                                } else {
                                    $users = $this->db->group_by('id','DESC')->group_by('bank_ifsc')->get_where('bank_ifsc', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $bnk) {

                                        $get_user = $this->db->get_where('bank_ifsc', ['bank_ifsc' => $bnk->bank_ifsc]);
                                        foreach ($get_user->result() as $bnk)
                                            ;
                                        echo "<option value=" . $bnk->bank_ifsc . ">" . $bnk->bank_ifsc . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No data</option>";
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
						<p><label>Cheque no</label></p>
						<select class="form-control" name="cheque_no" id="cheque_no" style=" width:100% auto; ">
							<option value="">Choose Cheque NO.</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id','DESC')->group_by('cheque_no')->get('bank_ifsc');
                                } else {
                                    $users = $this->db->group_by('id','DESC')->group_by('cheque_no')->get_where('bank_ifsc', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $chk) {

                                        $get_user = $this->db->get_where('bank_ifsc', ['cheque_no' => $chk->cheque_no]);
                                        foreach ($get_user->result() as $chk)
                                            ;
                                        echo "<option value=" . $chk->cheque_no . ">" .$chk->cheque_no . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No cheque no</option>";
                                }
                                ?>
						</select>
						
					</div>
					
					<div class="col-sm-3">
						<p><label>branch code </label></p>
						<select class="form-control" name="branch_code" id="branch_code" style=" width:100% auto; ">
							<option value="">Choose branch code</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id','DESC')->group_by('branch_code')->get('bank_ifsc');
                                } else {
                                    $users = $this->db->group_by('id','DESC')->group_by('branch_code')->get_where('bank_ifsc', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $chk) {

                                        $get_user = $this->db->get_where('bank_ifsc', ['branch_code' => $chk->branch_code]);
                                        foreach ($get_user->result() as $chk)
                                            ;
                                        echo "<option value=" . $chk->branch_code . ">" . $chk->branch_code . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>no data</option>";
                                }
                                ?>
						</select>
						
					</div>
					
				</div>
				<div class="row" style="padding:10px;">
						
						<div class="col-sm-3">
						<p><label>Debit amount </label></p>
						<select class="form-control" name="debit" id="debit" style=" width:100% auto; ">
							<option value="">Choose debit amount</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id','DESC')->group_by('debit')->get('bank_ifsc');
                                } else {
                                    $users = $this->db->group_by('id','DESC')->group_by('debit')->get_where('bank_ifsc', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $debit) {

                                        $get_user = $this->db->get_where('bank_ifsc', ['debit' => $debit->debit]);
                                        foreach ($get_user->result() as $debit)
                                            ;
                                        echo "<option value=" . $debit->debit . ">" . $debit->debit . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>no debit amount</option>";
                                }
                                ?>
						</select>
						
					</div>
					
					<div class="col-sm-3">
						<p><label>Credit amount</label></p>
						<select class="form-control" name="credit" id="credit" style=" width:100% auto; ">
							<option value="">Choose credit amount.</option>
							<?php
								$user_info      = $this->session->userdata('logged_user');
								$user_id     	= $user_info['user_id'];
								$search 		= $this->input->get('search');
								$currentUser    = singleDbTableRow($user_id)->role;
                                if ($currentUser == admin) {
                                    $users = $this->db->order_by('id','DESC')->group_by('credit')->get('bank_ifsc');
                                } else {
                                    $users = $this->db->group_by('id','DESC')->group_by('credit')->get_where('bank_ifsc', ['created_by' => $user_id]);
                                }
                                ?>


                                <?php
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $credit) {

                                        $get_user = $this->db->get_where('bank_ifsc', ['credit' => $credit->credit]);
                                        foreach ($get_user->result() as $credit)
                                            ;
                                        echo "<option value=" . $credit->credit . ">" . $credit->credit . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No credit amount</option>";
                                }
                                ?>
						</select>
						
					</div>
					
					
					
					
				</div>
				<div class="row" style="padding:10px;">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3 text-right">
						<button type="button" name="submit" value="search" class="btn btn-info btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
						<a href="<?php echo base_url('Bank_transaction/bank_transaction_status') ?>" class="btn btn-warning btn-sm btn-flat" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-plus"></i>Import</a>
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>
				
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
					<a href="<?php echo base_url('Bank_transaction/add_bank_transaction') ?>" class="btn btn-warning btn-sm btn-flat" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-plus"></i>Add</a>
						<button type="button" class="btn btn-success btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i>PDF</button>
						
						
						
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('Bank_transaction.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i>CSV</button>
				  </div>
				</div><!-- /.box-header -->
			<!-- Search table-->
			

				<div  id ="excel_table"class="box-body print_div table-responsive" style="overflow-x:scroll">
				<div id="total_amount">
				
				<?php
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$role = singleDbTableRow($user_id)->rolename;
					$currentUser   = singleDbTableRow($user_id)->role;
					
					$role_id = "";          
					$users_id = "";          
					$credit = "";          
					$txn_date = "";       
					$branch_code = "";       
					$cheque_no = "";       
					$bank_ifsc = "";       
					$debit = "";       
					$sf_time = "";       
					$st_time = "";       


        $query = $this->Bank_transaction_model->get_total_amount($role_id,$users_id,$txn_date,$credit,$branch_code,$cheque_no,$bank_ifsc,$debit,$sf_time,$st_time);

        if($query -> num_rows() > 0)
      {
          $credit = 0;
         foreach($query->result() as $r)
        {
            $credit = $credit + $r->credit;
        }
      }
      else
      {
          $credit = 0;
      }
	  
	      if($query -> num_rows() > 0)
      {
          $debit = 0;
         foreach($query->result() as $r)
        {
            $debit = $debit + $r->debit;
        }
      }
      else
      {
          $debit = 0;
      }
	  
	      if($query -> num_rows() > 0)
      {
          $balance = 0;
         foreach($query->result() as $r)
        {
            $balance = $balance + $r->balance;
        }
      }
      else
      {
          $balance = 0;
      }
	  
	 

     

      echo "<table class='table table-striped'>
    
      <tr>
      <th>Total Credit</th>
      <td>".$credit."</td>
      </tr>
      
      <tr>
        <th>Total Debit:</th>
        <td>".number_format($debit)."</td>
        </tr>
      
            <th>Total Balance:</th>
            <td>".$balance."</td>
      </tr>
      </table> <br><br>
      ";
    
				?>
				</div>
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
								<th width="5%">Action</th>
                               
                                <th>Transaction Date</th>
                                <th>Value Date</th>
								<th>Bank IFSC no.</th>
								<th>Description</th>
                                <th>Mode of Transfer</th>
								<th>Branch code</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Role name</th>
                                <th>User name</th>
								 


                            </tr>
                        </thead>
                       

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
		
		//$("#example2").show();
		var  users_id  = $("#users_id").val();
		var  role_id  = $("#role_id").val();
		var  txn_date  = $("#txn_date").val();
		var  bank_ifsc  = $("#bank_ifsc").val();
		var  cheque_no  = $("#cheque_no").val();
		var  branch_code  = $("#branch_code").val();
		var  credit 	  = $("#credit").val();
		var  debit 	  = $("#debit").val();
		
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		//alert(txn_date);
		//alert(bank_ifsc);
		//alert(cheque_no);
		//alert(branch_code);
		//alert(credit);
		//alert(debit);
		 //alert(role_id);
		// alert(users_id);
		
		
		var mydata = {"role_id": role_id,"users_id": users_id,"txn_date": txn_date,"cheque_no": cheque_no,"bank_ifsc": bank_ifsc,"branch_code": branch_code,"credit": credit,"debit": debit,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example").dataTable({
              "paging": true,
                  "ordering": true,
                  "info": true,				  
				  "destroy": true,
				"ajax": {
					"url": "<?php echo base_url('Bank_transaction/Bank_transaction_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Bank_transaction/get_total_amount') ?>", 
			data: mydata,
			success: function (response) {
				$("#total_amount").html(response);
				
				
			}
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
				 "ajax": "<?php echo base_url('Bank_transaction/Bank_transactionListJson'); ?>"
				 
            });
        });

    </script>

    <script>

        $('body').on('click', 'a.deleteBtn', function () {
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you ok?'); //confirm

            if (verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Bank_transaction/deleteAjax') ?>",
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
			doc.save('Bank_transaction.pdf');
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

