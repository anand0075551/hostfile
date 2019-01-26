


<?php

function page_css() { ?>
  <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

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
                    <h3 class="box-title">Edit Transaction</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('transaction_mode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">transaction_mode
                            <span class="text-red">*</span>
                        </label>

                        <div class="col-md-9">
                            <select name="transaction_mode" class="form-control">
                                <option value=""> Select  </option>
                                <option value="Credit" <?php if ($regular_transaction->transaction_mode == 'Credit') echo 'selected'; ?>>Credit</option>
                                <option value="Debit" <?php if ($regular_transaction->transaction_mode == 'Debit') echo 'selected'; ?>>Debit</option>

                            </select>
                            <?php echo form_error('transaction_mode') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('main_category')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Main Accounts category
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="main_category" id="main_category" class="form-control"  disabled value onchange="get_subcategory(this.value)">

                                <?php
                                if ($regular_transaction->main_category != '') {
                                    ?> <option value="<?php echo $regular_transaction->main_category; ?>"> <?php
                                        $regular_transaction->main_category;
                                        $table_name = 'regular_transaction';
                                        $where_array = array('main_category' => $regular_transaction->main_category);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $state_id = $row1->main_category;

                                                $table_name = 'acct_categories';
                                                $where_array = array('id' => $state_id);
                                                $query2 = $this->db->where($where_array)->get($table_name);
                                                foreach ($query2->result() as $row2) {
                                                    $state_name = $row2->name;
                                                }
                                            }

                                            echo $state_name;
                                        } else {
                                            echo "main category Doesnot Exist";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option disabled value=" "> Choose option </option>

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
                            <input type="text" name="business_name" class="form-control" disabled value="<?php echo $regular_transaction->business_name; ?>" placeholder="">
                            <?php echo form_error('business_name') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('reporting_manager')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Reporting Manager 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="reporting_manager" id="reporting_manager" class="form-control">

                                <?php
                                if ($regular_transaction->reporting_manager != '') {
                                    ?> <option value="<?php echo $regular_transaction->reporting_manager; ?>"> <?php
                                        $regular_transaction->reporting_manager;
                                        $table_name = 'regular_transaction';
                                        $where_array = array('reporting_manager' => $regular_transaction->reporting_manager);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $state_id = $row1->reporting_manager;

                                                $table_name = 'role';
                                                $where_array = array('id' => $state_id);
                                                $query2 = $this->db->where($where_array)->get($table_name);
                                                foreach ($query2->result() as $row2) {
                                                    $state_name = $row2->rolename;
                                                }
                                            }

                                            echo $state_name;
                                        } else {
                                            echo "reporting manager not exit";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option value=" "> Choose option </option>

                                <?php
                                if ($rolename->num_rows() > 0) {
                                    foreach ($rolename->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('reporting_manager') ?>

                        </div>
                    </div> 
					  <div class="form-group <?php if(form_error('trans_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transaction Date</label>
                            <div class="col-md-9">

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control" name="trans_date" type="text" value="<?php echo $regular_transaction->trans_date; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                                </div>
                                <?php echo form_error('trans_date') ?>
                            </div>
                        </div>


                    <!--<div class="form-group < ?php if (form_error('trans_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Transaction Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="trans_date" class="form-control" value="<?php echo $regular_transaction->trans_date; ?>" placeholder="">
                            < ?php echo form_error('trans_date') ?>
                        </div>
                    </div>-->

                    <div class="form-group <?php if (form_error('trans_time')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Transaction time
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="trans_time" class="form-control" disabled value="<?php echo $regular_transaction->trans_time; ?>" placeholder="">
                            <?php echo form_error('trans_time') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('amount')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Amount
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="amount" class="form-control" value="<?php echo $regular_transaction->amount; ?>" placeholder="">
                            <?php echo form_error('amount') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('comments')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Comments
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="comments" class="form-control" value="<?php echo $regular_transaction->comments; ?>" placeholder="">
                            <?php echo form_error('comments') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('receiver_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Receiver Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="receiver_name" class="form-control" value="<?php echo $regular_transaction->receiver_name; ?>" placeholder="">
                            <?php echo form_error('receiver_name') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('sancatie_by')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Sancatie By
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="sancatie_by" class="form-control" value="<?php echo $regular_transaction->sancatie_by; ?>" placeholder="">
                            <?php echo form_error('sancatie_by') ?>
                        </div>
                    </div>

                    <div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload file
                            <span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" size="20" />
                            <?php // echo form_error('street_address')  ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="edit_transaction" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update Transaction
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->

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
<?php function page_js(){ ?>

    <!-- InputMask -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
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
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>

<?php } ?>

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



