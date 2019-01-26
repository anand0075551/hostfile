
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css">

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daily Transaction</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('transaction_mode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Transaction Mode

                        </label>
                        <div class="col-md-9">  

                            <input type="radio" name="transaction_mode" id="Credit" value="Credit">Credit                             
                            <input type="radio" name="transaction_mode" id="Debit" value="Debit" >Debit                        
                            <?php echo form_error('transaction_mode') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('main_category')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Main Accounts category
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="main_category" id="main_category" class="form-control" onchange="get_subcategory(this.value)">
                                <option value=""> Choose option </option>
                                <?php
                                if ($main_category->num_rows() > 0) {
                                    foreach ($main_category->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->name . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('main_category') ?>

                        </div>
                    </div> 

                    <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Sub-Accounts category
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="business_name" id="location" class="form-control">
                                <option value=""> Choose option </option>
								

                            </select>	                                
                            <?php echo form_error('business_name') ?>

                        </div>
                    </div> 

                    <div class="form-group <?php if (form_error('rolename')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Reporting Manager
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="reporting_manager" id="rolename" class="form-control">
                                <option value=""> Choose option </option>
                                <?php
                                if ($rolename->num_rows() > 0) {
                                    foreach ($rolename->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('rolename') ?>

                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('dob')) echo 'has-error'; ?>">

                        <label  class="col-md-3">Transaction Date</label>
                        <div class="col-md-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control pull-right" name="trans_date" type="text" id="datepicker" value="<?php echo set_value('trans_date'); ?>">
                            </div>
                            <?php echo form_error('trans_date') ?>

                        </div>
                    </div>  
                    <div class="form-group bootstrap-timepicker <?php if (form_error('trans_time')) echo 'has-error'; ?>">						 
                        <label  class="col-md-3">Transaction Time</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input class="form-control timepicker" name="trans_time" type="text"  value="<?php echo set_value('trans_time'); ?>">
                            </div>
                            <?php echo form_error('trans_time') ?>

                        </div>
                    </div>  

                    <div class="form-group <?php if (form_error('amount')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Amount
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="amount" class="form-control" value="<?php echo set_value('amount'); ?>" placeholder="Enter amount.">                                
                            <?php echo form_error('amount') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('comments')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Comments</label>                         
                        <div class="col-md-9">
                            <textarea name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Enter Comments"></textarea>
                            <?php echo form_error('comments') ?>
                        </div>
                    </div> 

                    <div class="form-group <?php if (form_error('receiver_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Receiver Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="receiver_name" class="form-control" value="<?php echo set_value('receiver_name'); ?>" placeholder="Enter receiver name.">                                
                            <?php echo form_error('receiver') ?>

                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('sancatie_by')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Sancatie By
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="sancatie_by" class="form-control" value="<?php echo set_value('sancatie_by'); ?>" placeholder="Enter sancatie name.">                                
                            <?php echo form_error('sancatie_by') ?>

                        </div>
                    </div>
                    <div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload File
                            <span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" size="20" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="add_transaction" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Transaction Now
                </button>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->
</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>
<script>
                                function get_subcategory(id)
                                {
                                    var mydata = {"parentid": id};

                                    $.ajax({
                                        type: "POST",
                                        url: "getname",
                                        data: mydata,
                                        success: function (response) {
                                            $("#location").html(response);
                                            //alert(response);
                                        }
                                    });
                                }


</script>


<script type="text/javascript">
    $(function() {
//Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
//Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
//Money Euro
            $("[data-mask]").inputmask();
//Date range picker
            $('#reservation').daterangepicker();
//Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//Date range as a button
            $('#daterange-btn').daterangepicker(
    {
    ranges: {
    'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
    },
            startDate: moment().subtract('days', 29),
            endDate: moment()
    },
            function(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
    );
//iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
    });
//Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
    });
//Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
    });
//Colorpicker
            $(".my-colorpicker1").colorpicker();
//color picker with addon
            $(".my-colorpicker2").colorpicker();
//Timepicker
            /*$(".timepicker").timepicker({
             showInputs: false
             });
             });*/
</script>
<!-- Validation -->

<!-- Mobile number Validation -->
<script>
                    function maxLengthCheck(object)
                    {
                    if (object.value.length > object.maxLength)
                            object.value = object.value.slice(0, object.maxLength)
                    }
</script>
<script type="text/javascript">
            $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
            });</script>


<?php

function page_js() { ?>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
                        $(function() {
                        var oTable = $("#example").dataTable({
                        "processing": true,
                                "serverSide": true,
                                "ajax": {
                                "url": "<?php echo base_url('vouchers/vouchersListJson'); ?>",
                                        "data": function (d) {
                                        d.dateRange = $('[name="searchByNameInput"]').val();
                                        }
                                }
                        });
                                $('button#searchByDateBtn').on('click', function(){
                        oTable.fnDraw();
                        });
                        });</script>


    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->

    <!-- Page script -->
    <script type="text/javascript">
                        $(function() {
                        //Date range picker
                        $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
                                //Date range picker with time picker
                                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                        });
                        //Date picker
                        $('#datepicker').datepicker({
                autoclose: true
                });
                        //Timepicker
                        $(".timepicker").timepicker({
                showInputs: false
                });</script>
    <!--for multiplication-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php } ?>

