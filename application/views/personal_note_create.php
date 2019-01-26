
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
                   
                   <div class="form-group <?php if(form_error('p_date')) echo 'has-error'; ?>">
                        <label for="location" class="col-md-3">Date : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                         <input type="text" class="some_class"  id="some_class_1" name="p_date" placeholder="select  date" class="form-control"/>
                           <?php echo form_error('p_date') ?>
                        </div>
                    </div>
                     
                     <div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                        <label for="location" class="col-md-3">Title : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter title">
                            <?php echo form_error('title') ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
                        <label for="venue" class="col-md-3">Description : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <textarea name="description" id="description" class="form-control"></textarea>
                            <?php echo form_error('description') ?>
                        </div>
                    </div>
                     
                     <div class="form-group <?php if(form_error('note1')) echo 'has-error'; ?>">
                        <label for="venue" class="col-md-3">Note1 : 
                           
                        </label>
                        <div class="col-md-9">
                            <textarea name="note1" id="note1" class="form-control"></textarea>
                            <?php echo form_error('note1') ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('note2')) echo 'has-error'; ?>">
                        <label for="venue" class="col-md-3">Note2 : 
                            
                        </label>
                        <div class="col-md-9">
                            <textarea name="note2" id="note2" class="form-control"></textarea>
                            <?php echo form_error('note2') ?>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('note3')) echo 'has-error'; ?>">
                        <label for="venue" class="col-md-3">Note3 : 
                            
                        </label>
                        <div class="col-md-9">
                            <textarea name="note3" id="note3" class="form-control"></textarea>
                            <?php echo form_error('note3') ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('note4')) echo 'has-error'; ?>">
                        <label for="venue" class="col-md-3">Note4 : 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <textarea name="note4" id="note4" class="form-control"></textarea>
                            <?php echo form_error('note4') ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('note5')) echo 'has-error'; ?>">
                        <label for="venue" class="col-md-3">Note5 : 
                            
                        </label>
                        <div class="col-md-9">
                            <textarea name="note5" id="note5" class="form-control"></textarea>
                            <?php echo form_error('note5') ?>
                        </div>
                    </div>
                    
                    
                   </div>
					  <div class="box-footer">
                  		<button type="submit" name="submit" value="add" class="btn btn-primary">
                            <i class="fa fa-plus"></i>Add
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->
		 </div><!--/.col (left) -->
     </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

   <!--<script src="< ?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>-->
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
 
<?php } ?>


