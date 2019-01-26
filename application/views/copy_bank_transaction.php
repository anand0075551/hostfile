
<?php

function page_css() { ?>
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
<?php } ?>

<?php
include('header.php');
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->


            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Edit Bank Transaction </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                    <div class="form-group <?php if (form_error('txn_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Transaction Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="txn_date" class="form-control some_class" value="<?php echo $bank_ifsc->value_date; ?>" placeholder="">
                            <?php echo form_error('txn_date') ?>
                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('value_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Value Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="value_date" class="form-control some_class" value="<?php echo $bank_ifsc->value_date; ?>" placeholder="">
                            <?php echo form_error('value_date') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('bank_ifsc')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Bank IFSC Code
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="bank_ifsc" class="form-control" value="<?php echo $bank_ifsc->bank_ifsc;?>" placeholder="">
																<?php echo form_error('bank_ifsc') ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if (form_error('description')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Description
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" value="" placeholder=""><?php echo $bank_ifsc->description;?></textarea>
																<?php echo form_error('description') ?>
                        </div>
                    </div>
					
					
					<div class="form-group <?php if (form_error('cheque_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Ref No./Cheque No.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="cheque_no" class="form-control" value="<?php echo $bank_ifsc->cheque_no; ?>" placeholder="">
																<?php echo form_error('cheque_no') ?>
                        </div>
                    </div>
					
					
					<div class="form-group <?php if (form_error('branch_code')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Branch Code
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="branch_code" class="form-control" value="<?php echo $bank_ifsc->branch_code;?>" placeholder="">
																<?php echo form_error('branch_code') ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if (form_error('debit')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Debit
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="debit" class="form-control" value="<?php echo $bank_ifsc->debit; ?>" placeholder="">
																<?php echo form_error('debit') ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if (form_error('credit')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Credit
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="credit" class="form-control" value="<?php echo $bank_ifsc->credit;?>" placeholder="">
																<?php echo form_error('credit') ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if (form_error('balance')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Balance
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="balance" class="form-control" value="<?php echo $bank_ifsc->balance; ?>" placeholder="">
																<?php echo form_error('balance') ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Status
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="status" class="form-control" value="<?php echo $bank_ifsc->status; ?>" placeholder="">
							<?php echo form_error('status') ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if (form_error('remarks')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Remarks
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <textarea name="remarks" class="form-control" value="" placeholder=""><?php echo $bank_ifsc->remarks; ?></textarea>
							<?php echo form_error('remarks') ?>
                        </div>
                    </div>






                </div>
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="copy_bank_transaction" class="btn btn-primary">
                    <i class="fa fa-plus"></i>submit
                </button>
                <a href="<?php echo base_url('Bank_transaction/all_bank_transaction') ?>" class="btn btn-info"><i class="fa fa-arrow-edit"></i>Back</a>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>
    <!-- InputMask -->
    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>

     <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>


    <script>
    

        $.datetimepicker.setLocale('en');

        $('#datetimepicker_format').datetimepicker({value: '2015/04/15', format: $("#datetimepicker_format_value").val()});
        console.log($('#datetimepicker_format').datetimepicker('getValue'));

        $("#datetimepicker_format_change").on("click", function (e) {
            $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
        });
        $("#datetimepicker_format_locale").on("change", function (e) {
            $.datetimepicker.setLocale($(e.currentTarget).val());
        });

        $('#datetimepicker').datetimepicker({
            dayOfWeekStart: 1,
            lang: 'en',
            disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
            startDate: '1986/01/05'
        });
        $('#datetimepicker').datetimepicker({value: '2015/04/15', step: 10});


        var startdate = $("#txtstartdate").val();
        $('.some_class').datetimepicker({minDate: startdate});

        $('#default_datetimepicker').datetimepicker({
            //formatTime: 'H:i',
            formatDate: 'd.m.Y',
            defaultDate: '+03.01.1970', // it's my birthday
            //defaultTime: '10:00',
            timepickerScrollbar: false
        });

    </script>








    </script>
<?php } ?>

