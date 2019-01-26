
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css">


    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

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
                    <h3 class="box-title">Edit Agricultural Material</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="type" class="form-control" value="<?php echo $edit_agri->type; ?>" placeholder="Enter Input Material Type">                                
                            <?php echo form_error('type') ?>

                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="name" class="form-control" value="<?php echo $edit_agri->name; ?>" placeholder="Enter Material Name.">                                
                            <?php echo form_error('name') ?>

                        </div>
                    </div>








                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_agri" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
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

    <script>
                        function get_user(id)
                        {
                        //alert(id);
                        var mydata = {"to_role": id};
                                $.ajax({
                                type: "POST",
                                        url: "<?php echo base_url('Voucher_permission/get_user') ?>",
                                        data: mydata,
                                        success: function (response) {
                                        $("#to_user").html(response);
                                                //alert(response);
                                        }
                                });
                        }





    </script>
    <script>
                function get_sub_account(id)
                {
                var parent_id = id;
                        var mydata = {"parent_id":parent_id};
                        $.ajax({
                        type:"POST",
                                url:"<?php echo base_url('Voucher_permission/get_sub_account') ?>",
                                data:mydata,
                                success:function(response){
                                $("#pay_type").html(response);
                                }
                        });
                }
    </script>

    <script>
                function get_account(id)
                {
                var parent_id = id;
                        var mydata = {"parent_id":parent_id};
                        $.ajax({
                        type:"POST",
                                url:"<?php echo base_url('Voucher_permission/get_sub_account') ?>",
                                data:mydata,
                                success:function(response){
                                $("#paytype_to").html(response);
                                }
                        });
                }
    </script>

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


    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
                        $('select').select2();
    </script>
<?php } ?>

