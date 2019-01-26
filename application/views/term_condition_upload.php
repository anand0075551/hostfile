
<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    <!-- select -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">

    <div class="row">
    <div class="col-md-12" id="add_form">

          <div class="box box-primary">
			 <div class="box-header">
                    <h3 class="box-title">&nbsp;</h3>
                </div><!-- /.box-header -->
                  <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
                   <div class="box-body">
                   <!--Role -->
                   <div class="form-group <?php if(form_error('role')) echo 'has-error'; ?>">
                        <label for="location" class="col-md-3">Role : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                         <select name="role" id="role" class="form-control" onChange="check_exist(this.value)">
                                    <option value=""> Choose  </option>
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
                           <?php echo form_error('role') ?>
                        </div>
                    </div>
                    <!--Date -->
                    <div class="form-group <?php if(form_error('valid_from')) echo 'has-error'; ?>">
                            <label for="registration" class="col-md-3">Valid 
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                             From : <input type="text" class="some_class" value="" id="some_class_1" name="valid_from" placeholder="select from date"/>
							To : <input type="text" class="some_class" value="" id="some_class_2" name="valid_to" placeholder="select to date"/>
                               
                                <?php echo form_error('valid_from') ?>
                            </div>
                        </div>
                        <!--File Name -->
                        <div class="form-group <?php if(form_error('fname')) echo 'has-error'; ?>">
								<label for="fname" class="col-md-3">File Name : <span class="text-red">*</span></label>
								<div class="col-md-9"> 
                                <input type="text"   id="fname" name="fname" class="form-control"/> 								
									<?php echo form_error('fname') ?>                              
								</div>
						</div>
                        <!--Labels -->
                        <div class="form-group">
						<label for="upload_file" class="col-md-3">Labels :</label>
                          <div class="col-md-9" id="itemRows">
                             
							<strong>Label : </strong><input type="text" name="dlabel" id="dlabel"/> 
                           <strong> Fields : </strong><select name="dfield" id="dfield" style="width:180px">
                                    <option value=""> Choose  </option>
                                    <?php
                                    $fields = $this->db->list_fields('users');

									foreach ($fields as $field)
									{ ?>
                                    <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
											
									<?php }
                                    ?>
                                    
                                </select>
                          
                            <input onClick="addsponsorRow(this.form);" type="button" value="Add" class="btn btn-warning"/> 
                            (This row will not be saved unless you click on "Add" first)
                               
                            </div>
                         </div>
                    <!--File -->
                   		<div class="form-group <?php if(form_error('userfile')) echo 'has-error'; ?>">
								<label for="upload_file" class="col-md-3">File Content : <span class="text-red">*</span></label>
                               
								<div class="col-md-9"> 
                                <textarea id="editor1" name="userfile" rows="10" cols="80"></textarea> 								
									<?php echo form_error('userfile') ?>                              
								</div>
						</div>
                        <!--Status -->
                        <div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                        <label for="status" class="col-md-3">Status : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                         <select name="status" id="status" class="form-control">
                                    <option value=""> Choose  </option>
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
                           <?php echo form_error('status') ?>
                        </div>
                    </div>
                    <!--OTP Notification -->
                    <div class="form-group <?php if(form_error('otp')) echo 'has-error'; ?>">
                        <label for="status" class="col-md-3">OTP Notification? : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                         <select name="otp" id="otp" class="form-control">
                            <option value="0"> No  </option>
                            <option value="1"> Yes  </option>
                          </select>
                           <?php echo form_error('otp') ?>
                        </div>
                    </div>
                    
                    </div>
					  <div class="box-footer">
                  		<button type="submit" name="submit" value="add" class="btn btn-primary">
                            <i class="fa fa-plus"></i>Upload
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->
		 </div><!--/.col (left) -->
     </div>   <!-- /.row -->
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

    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
  <script>
	function check_exist(role)
{
	//alert(id);
	var mydata = {"role": role};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Term_condition/check_exist') ?>",
		data: mydata,
		success: function (response) {
			if(response == 1)
			{
				alert('Sorry ..Already Uploaded ');
				location.reload();
			}
			
			 
		}
	});   
}

</script>
<!-- Dynamic label -->
<script type="text/javascript">
var rowNum = 0;
function addsponsorRow(frm) {
	var dl = document.getElementById('dlabel').value;
	var df = document.getElementById('dfield').value;
	if(dl !='' && df !='')
	{
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'">Label '+rowNum+': <input type="text" name="dlabels[]"  value="'+frm.dlabel.value+'"> Field: <input type="text" name="dfields[]" value="'+frm.dfield.value+'"><input type="button" value="Remove" class="btn btn-inform" onclick="removeRow('+rowNum+');"></p>';
	jQuery('#itemRows').append(row);
	frm.dlabel.value = '';
	frm.dfield.value = '';
	}
	else
	{
		alert('Please enter label');
		return false;
	}
	
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!--<script src="< ?php echo base_url('assets/admin/js/editor/ckeditor.js') ?>"></script>-->
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
<?php } ?>


