
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
                        <label for="location" class="col-md-3"> To Role : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                         <select name="role" id="role" class="form-control" >
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

                        <!--File Name -->
                        <div class="form-group <?php if(form_error('fname')) echo 'has-error'; ?>">
								<label for="fname" class="col-md-3">File Name : <span class="text-red">*</span></label>
								<div class="col-md-9"> 
                                <input type="text"   id="fname" name="fname" class="form-control"/> 								
									<?php echo form_error('fname') ?>                              
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

                    <!--status -->
                    <div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                        <label for="status" class="col-md-3">Status ? : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                         <select name="status" id="status" class="form-control">
                            <option value=""> Select  </option>
                            <option value="1"> Active  </option>
                            <option value="0"> InActive  </option>
                          </select>
                           <?php echo form_error('status') ?>
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


