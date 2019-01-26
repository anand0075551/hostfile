
<?php

function page_css() { ?>
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
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
                    <h3 class="box-title">Add Ingredients</h3>
                </div><!-- /.box-header -->
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-2"> <a href="<?php echo base_url('Agriculture/all_agriculture_project/') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>Back To Project List</a></div>
					
					
                    <div class="col-sm-2"><a href="<?php echo base_url('Agriculture/view_farm_maitenance/' . $aid) ?>" class="btn btn-primary"><i class="fa fa-plus"></i>View Maintenance</a></div>	
                </div>
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body table-responsive">
                    <table class="table table-striped ">
                        <tr>					

                            <th><h4>Farm Maitenance</h4></th>
                            <th><h4>Activity</h4></th>
                            <th><h4>Begin date & Time</h4></th>		
                            <th><h4>End date & Time</h4></th>		
                            <th><h4>Expected hours</h4></th>
                            <th><h4>Approx Per Person per Hour</h4></th>
                            <th><h4>Labour ID</h4></th>
                            <th><h4>Person</h4></th>
                            <th><h4>Approximated Price per person</h4></th>
                            <th><h4>Calculated price</h4></th>
                            <th><h4>Expected Price</h4></th>
                            <th><h4>Difference </h4></th>
                        </tr>


                        <tr>		

                        <input type="hidden"  name="acti_id" id="acti_id" value="<?php echo $aid; ?>">
                        <td>
						
						
						
                            <select name="activity_type"   class="form-control" style="width:100% auto;">
                                <option value=""> Choose option </option>
                                <?php
                                if ($category_name->num_rows() > 0) {
                                    foreach ($category_name->result() as $c) {

                                        echo '<option value="' . $c->id . '"> ' . $c->id . '-' . $c->farm_activity . '</option>';
                                    }
                                }
                                ?>
                            </select>

                        </td>




                        <td><input type="text" name="activity"  id="activity" onkeyup="get_total()" class="form-control" ></td>
                        <td><input type="text" name="begin_date" id="begin_date" onkeyup="get_total()" class="some_class form-control" value="<?php echo set_value('product_name'); ?>" ></td>
                        <td><input type="text" name="end_date" id="end_date" onkeyup="get_total()" class="some_class form-control" value="<?php echo set_value('product_name'); ?>"></td>
                        <td><input type="text" name="expected_hours" id="expected_hours" class="form-control" value="<?php echo set_value('product_name'); ?>" ></td>
                        <td><input type="double" name="per_person_time" id="per_person_time" class="form-control" value="<?php echo set_value('product_name'); ?>" ></td>

                        <td><input type="double" name="labour_role" id="labour_role"  class="form-control"  ></td>






                        <td><input type="double" name="person_no" id="person_no" onkeyup="get_value()" class="form-control" ></td>
                        <td><input type="double" name="price_per_person" id="price_per_person" onkeyup="get_value()" class="form-control" ></td>
                        <td><input type="double" name="calculated_price" id="calculated_price" onkeyup="get_value()" class="form-control"  ></td>
                        <td><input type="double" name="expected_price" id="expected_price" onkeyup="get_value()" class="form-control"  ></td>
                        <td><input type="double" name="difference" id="difference" class="form-control"  ></td>

                        </tr>


                    </table>


                    <!-- Dynamic -->
                    <div class="col-md-9" id="itemRows">
                        <input onClick="addsponsorRow(this.form);" type="button" id="reset"value="Add" class="btn btn-warning"/>(This row will not be saved unless you click on "Add" first)

                    </div>
                    <!-- Dynamic -->




                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" id="farm" value="farm" class="btn btn-primary">
                        <i class="fa fa-edit"></i>Submit
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<!----Datepiker SCRIPT  Files---->
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>

<script>

                            $.datetimepicker.setLocale('en');

                            $('#datetimepicker_format').datetimepicker({value: '2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
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
                            $('#datetimepicker').datetimepicker({value: '2015/04/15 05:03', step: 10});

                            $('.some_class').datetimepicker();

                            $('#default_datetimepicker').datetimepicker({
                                formatTime: 'H:i',
                                formatDate: 'd.m.Y',
                                //defaultDate:'8.12.1986', // it's my birthday
                                defaultDate: '+03.01.1970', // it's my birthday
                                defaultTime: '10:00',
                                timepickerScrollbar: false
                            });
</script>
<!--This Code Is Given By Akhil-->
<script>
    $("#reset").on("click", function () {
        $('#my_select option').prop('selected', function () {
            return this.defaultSelected;
        });
    });


</script>




<script type="text/javascript">
    var rowNum = 0;
    function addsponsorRow(frm) {
        rowNum++;
        var row = '<p id="rowNum' + rowNum + '"> ' + rowNum + ': <input type="text" name="activity_type[]" size="8" value="' + frm.activity_type.value + '"> &nbsp;&nbsp; <input type="text" name="acti[]" size="9" value="' + frm.activity.value + '"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="beg_date[]" size="9" value="' + frm.begin_date.value + '"> <input type="text" name="en_date[]" size="9" value="' + frm.end_date.value + '">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="expe_hours[]" size="9" value="' + frm.expected_hours.value + '"> <input type="text" name="per_per_time[]" size="9" value="' + frm.per_person_time.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="labour_role[]" size="9" value="' + frm.labour_role.value + '">  <input type="text" name="person_no[]" size="4" value="' + frm.person_no.value + '"> <input type="text" name="pri_pe_persn[]" size="4" value="' + frm.price_per_person.value + '"> <input type="text" name="calcd_pric[]" size="4" value="' + frm.calculated_price.value + '"> <input type="text" name="expe_prce[]" size="4" value="' + frm.expected_price.value + '"> <input type="text" name="diffec[]" size="5" value="' + frm.difference.value + '"> <input type="button" value="X" class="btn btn-danger"style="width: 40px;" onclick="removeRow(' + rowNum + ');"></p>';
        jQuery('#itemRows').append(row);



    }

    function removeRow(rnum) {
        jQuery('#rowNum' + rnum).remove();
    }
</script>

<script>

    function get_userid(id)
    {
        //    alert(id);

        var mydata = {"role": id};

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Agriculture/getname') ?>",
            data: mydata,
            success: function (response) {
                $("#user_id").html(response);

//alert(response);
            }
        });
    }

</script>

<script src="<?php echo base_url('assets'); ?>/jquery.min.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
    $('select').select2();
</script>
