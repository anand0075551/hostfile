

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
                    <h3 class="box-title">Crop Project</h3>
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

                         <!--   <th><h4>Farm Maitenance</h4></th>
<th><h4>Activity</h4></th>
                            <th><h4>Begin date & Time</h4></th>
                            <th><h4>End date & Time</h4></th>
                            <th><h4>Worked Hours</h4></th>
                            <th><h4>Approx Per Person per Hour</h4></th>
                            <th><h4>Labour ID</h4></th>
<th><h4>Person</h4></th>
                            <th><h4>Approximated Price per person</h4></th>
                            <th><h4>Calculated price</h4></th>
                            <th><h4>Expected Price</h4></th>
                            <th><h4>Difference </h4></th> -- >

                            <th><h4>Crop Maintenance</h4></th>
							<th><h4>Begin date & Time</h4></th>
							<th><h4>End date & Time</h4></th>
							<th><h4>Activity</h4></th>
                            <th><h4>No. OF Labours</h4></th>
                            <th><h4>Labour ID's</h4></th>
                            <th><h4>Avearge Worked Hrs A Labour</h4></th>
                            <th><h4>Wages Per Labour</h4></th>
                            <th><h4>Area Coverage Per Labour</h4></th>
                            <th><h4>Total Labour Cost</h4></th>
							<th><h4>Machinary</h4></th>
							<th><h4>Tool</h4></th>
                            <th><h4>Machinnary Charges Per Hour</h4></th>
                            <th><h4>Tool Charges Per Hour</h4></th>
                            <th><h4>Transport Cost</h4></th>
                            <th><h4>Food Cost</h4></th>
                            <th><h4>Used Inputs</h4></th>
                            <th><h4>Inputs Qty</h4></th>
                            <th><h4>Inputs Cost</h4></th>
                            <th><h4>Used Pesticides</h4></th>
                            <th><h4>Pesticides Qty</h4></th>
                            <th><h4>Pesticides Cost</h4></th>
                            <th><h4>Overall Expenditure A day</h4></th>
							-->
							
							

							<th><h4>ಬೆಳೆ ನಿರ್ವಹಣೆ</h4></th>
							<th><h4>ಆರಂಭಿಕ  ದಿನಾಂಕ ಮತ್ತು ಸಮಯ  </h4></th>
							<th><h4>ಅಂತಿಮ ದಿನಾಂಕ ಮತ್ತು ಸಮಯ</h4></th>
							<th><h4>ಚಟುವಟಿಕೆ</h4></th>
                            <th><h4>ಕೆಲಸಗಾರರ  ಸಂಖ್ಯೆ</h4></th>
                            <th><h4>ಕೆಲಸಗಾರರ ಗುರುತು   ಸಂಖ್ಯೆ</h4></th>
                            <th><h4>ಸರಾಸರಿ ಒಬ್ಬ ಕೆಲಸಗಾರನ ಕೆಲಸದ ಅವಧಿ( ಗಂಟೆ)</h4></th>
                            <th><h4>ಒಬ್ಬನ   ಸರಾಸರಿ ಕೂಲಿ  </h4></th>
                            <th><h4>ಒಬ್ಬನ  ಕಾರ್ಯ  ಸ್ಥಳ ವ್ಯಾಪ್ತಿ </h4></th>
                            <th><h4>ಒಟ್ಟು ಕೆಲಸದ ವೆಚ್ಚ</h4></th>
							<th><h4>ಯಂತ್ರೋಪಕರಣಗಳು</h4></th>
							<th><h4>ಉಪಕರಣ</h4></th>
                            <th><h4>ಯಂತ್ರೋಪಕರಣಗಳ  ಗಂಟೆಯ  ವೆಚ್ಚ</h4></th>
                            <th><h4>ಉಪಕರಣಗಳ  ಗಂಟೆಯ  ವೆಚ್ಚ</h4></th>
                            <th><h4>ಸಾರಿಗೆ ವೆಚ್ಚ</h4></th>
                            <th><h4>ಆಹಾರ ವೆಚ್ಚ</h4></th>
                            <th><h4>ಬಳಕೆಯಾದ  ರಸಸಾರಗಳು</h4></th>
                            <th><h4>ರಸಸಾರಗಳ Qty</h4></th>
                            <th><h4>ರಸಸಾರಗಳ ವೆಚ್ಚ</h4></th>
                            <th><h4>ಬಳಕೆಯಾದ ಕೀಟನಾಶಕಗಳು</h4></th>
                            <th><h4>ಕೀಟನಾಶಕಗಳ Qty</h4></th>
                            <th><h4>ಕೀಟನಾಶಕಗಳ ವೆಚ್ಚ</h4></th>
                            <th><h4>ಒಟ್ಟಾರೆ ದಿನದ ಖರ್ಚು </h4></th>

                        </tr>


                        <tr>

                        <input type="hidden"  name="acti_id" id="acti_id" value="<?php echo $aid; ?>">
                        <td>



                            <select name="activity_type" class="form-control" style="width:100% auto;">
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




    <td><input type="text" name="start_Date"  class="form-control some_class" id="start_Date"  class="form-control" ></td>
    <td><input type="text" name="end_Date"  class="form-control some_class" id="end_Date"  class="form-control" ></td>
    <td><input type="text" name="activity"  id="activity" onkeyup="get_total()" class="form-control" ></td>
    <td><input type="text" name="no_labours" id="no_labours" class="form-control" value="<?php echo set_value('no_labours'); ?>" ></td>
    <td><input type="double" name="labours_id" id="labours_id" class="form-control" value="<?php echo set_value('labours_id'); ?>" ></td>
<td><input type="double" name="avg_wrk_lbr" id="avg_wrk_lbr" class="form-control" value="<?php echo set_value('avg_wrk_lbr'); ?>" ></td>
<td><input type="double" name="wages_per_labour" id="wages_per_labour" class="form-control" value="<?php echo set_value('wages_per_labour'); ?>" ></td>
<td><input type="double" name="area_per_labour" id="area_per_labour" class="form-control" value="<?php echo set_value('area_per_labour'); ?>" ></td>
<td><input type="double" name="total_labour" id="total_labour" class="form-control" value="<?php echo set_value('total_labour'); ?>" ></td>
<td><input type="double" name="machinary" id="machinary" class="form-control" value="<?php echo set_value('machinary'); ?>" ></td>
<td><input type="double" name="tool" id="tool" class="form-control" value="<?php echo set_value('tool'); ?>" ></td>
<td><input type="double" name="mch_chg_hrs" id="mch_chg_hrs" class="form-control" value="<?php echo set_value('mch_chg_hrs'); ?>" ></td>
<td><input type="double" name="tool_chg_hrs" id="tool_chg_hrs" class="form-control" value="<?php echo set_value('tool_chg_hrs'); ?>" ></td>
<td><input type="double" name="trnp_cost" id="trnp_cost" class="form-control" value="<?php echo set_value('trnp_cost'); ?>" ></td>
<td><input type="double" name="food_cost" id="food_cost" class="form-control" value="<?php echo set_value('food_cost'); ?>" ></td>
<td><input type="double" name="used_inputs" id="used_inputs" class="form-control" value="<?php echo set_value('used_inputs'); ?>" ></td>
<td><input type="double" name="inputs_qty" id="inputs_qty" class="form-control" value="<?php echo set_value('inputs_qty'); ?>" ></td>
<td><input type="double" name="inputs_cost" id="inputs_cost" class="form-control" value="<?php echo set_value('inputs_cost'); ?>" ></td>
<td><input type="text" name="used_pesticides" id="used_pesticides" class="form-control" value="<?php echo set_value('used_pesticides'); ?>" ></td>
<td><input type="double" name="pesticides_qty" id="pesticides_qty" class="form-control" value="<?php echo set_value('pesticides_qty'); ?>" ></td>
<td><input type="double" name="pesticides_cost" id="pesticides_cost" class="form-control" value="<?php echo set_value('pesticides_cost'); ?>" ></td>
<td><input type="double" name="total_exp_day" id="total_exp_day" class="form-control" value="<?php echo set_value('total_exp_day'); ?>" ></td>

<!-- End of Anand code -->
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
                    <button type="submit" name="submit" id="farm" value="farm" class="btn btn-primary" style="display:none">
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

        var sts = true;

        var start_Date = frm.start_Date.value;
        var end_Date = frm.end_Date.value;
        var activity = frm.activity.value;
        var no_labours = frm.no_labours.value;
        var labours_id = frm.labours_id.value;
        var avg_wrk_lbr = frm.avg_wrk_lbr.value;
        var wages_per_labour = frm.wages_per_labour.value;
        var area_per_labour = frm.area_per_labour.value;
        var total_labour = frm.total_labour.value;
        var wages_per_labour = frm.wages_per_labour.value;
        var machinary = frm.machinary.value;
        var tool = frm.tool.value;
        var mch_chg_hrs = frm.mch_chg_hrs.value;
        var tool_chg_hrs = frm.tool_chg_hrs.value;
        var trnp_cost = frm.trnp_cost.value;
        var food_cost = frm.food_cost.value;
        var used_inputs = frm.used_inputs.value;
        var inputs_qty = frm.inputs_qty.value;
        var inputs_cost = frm.inputs_cost.value;
        var used_pesticides = frm.used_pesticides.value;
        var pesticides_qty = frm.pesticides_qty.value;
        var pesticides_cost = frm.pesticides_cost.value;
        var total_exp_day = frm.total_exp_day.value;


        if(start_Date==""){
            $('#start_Date').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#start_Date').css({"border":"2px solid gray"});
            sts = true;
        }
		
		 if(end_Date==""){
            $('#end_Date').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#end_Date').css({"border":"2px solid gray"});
            sts = true;
        }
		
		if(activity==""){
            $('#activity').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#activity').css({"border":"2px solid gray"});
            sts = true;
        }
		
        if(no_labours==""){
            $('#no_labours').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#no_labours').css({"border":"2px solid gray"});
            sts = true;
        }


        if(labours_id==""){
            $('#labours_id').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#labours_id').css({"border":"2px solid gray"});
            sts = true;
        }

        if(avg_wrk_lbr==""){
            $('#avg_wrk_lbr').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#avg_wrk_lbr').css({"border":"2px solid gray"});
            sts = true;
        }

        if(avg_wrk_lbr==""){
            $('#avg_wrk_lbr').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#avg_wrk_lbr').css({"border":"2px solid gray"});
            sts = true;
        }


        if(area_per_labour==""){
            $('#area_per_labour').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#area_per_labour').css({"border":"2px solid gray"});
            sts = true;
        }

        if(total_labour==""){
            $('#total_labour').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#total_labour').css({"border":"2px solid gray"});
            sts = true;
        }


        if(wages_per_labour==""){
            $('#wages_per_labour').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#wages_per_labour').css({"border":"2px solid gray"});
            sts = true;
        }


        if(machinary==""){
            $('#machinary').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#machinary').css({"border":"2px solid gray"});
            sts = true;
        }


        if(tool==""){
            $('#tool').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#tool').css({"border":"2px solid gray"});
            sts = true;
        }

            if(mch_chg_hrs==""){
            $('#mch_chg_hrs').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#mch_chg_hrs').css({"border":"2px solid gray"});
            sts = true;
        }

            if(tool_chg_hrs==""){
            $('#tool_chg_hrs').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#tool_chg_hrs').css({"border":"2px solid gray"});
            sts = true;
        }


            if(trnp_cost==""){
            $('#trnp_cost').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#trnp_cost').css({"border":"2px solid gray"});
            sts = true;
        }


        if(food_cost==""){
            $('#food_cost').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#food_cost').css({"border":"2px solid gray"});
            sts = true;
        }

        if(used_inputs==""){
            $('#used_inputs').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#used_inputs').css({"border":"2px solid gray"});
            sts = true;
        }


        if(inputs_qty==""){
            $('#inputs_qty').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#inputs_qty').css({"border":"2px solid gray"});
            sts = true;
        }


        if(inputs_cost==""){
            $('#inputs_cost').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#inputs_cost').css({"border":"2px solid gray"});
            sts = true;
        }

        if(used_pesticides==""){
            $('#used_pesticides').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#used_pesticides').css({"border":"2px solid gray"});
            sts = true;
        }

        if(pesticides_qty==""){
            $('#pesticides_qty').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#pesticides_qty').css({"border":"2px solid gray"});
            sts = true;
        }

        if(pesticides_cost==""){
            $('#pesticides_cost').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#pesticides_cost').css({"border":"2px solid gray"});
            sts = true;
        }


        if(total_exp_day==""){
            $('#total_exp_day').css({"border":"2px solid red"});
            sts = false;
        }
        else{
            $('#total_exp_day').css({"border":"2px solid gray"});
            sts = true;
        }


        if(sts==true){
            rowNum++;
            var row = '<p id="rowNum' + rowNum + '"> ' + rowNum + ': <input type="text" name="start_Date[]" size="8" value="' + frm.start_Date.value + '">  &nbsp;&nbsp;&nbsp;<input type="text" name="end_Date[]" size="8" value="' + frm.end_Date.value + '"> &nbsp;&nbsp;&nbsp; <input type="text" name="activity_type[]" size="8" value="' + frm.activity_type.value + '"> &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="acti[]" size="9" value="' + frm.activity.value + '"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="no_labours[]" size="9" value="' + frm.no_labours.value + '"> <input type="text" name="labours_id[]" size="9" value="' + frm.labours_id.value + '">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="avg_wrk_lbr[]" size="9" value="' + frm.avg_wrk_lbr.value + '"> <input type="text" name="wages_per_labour[]" size="9" value="' + frm.wages_per_labour.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="area_per_labour[]" size="9" value="' + frm.area_per_labour.value + '"> &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="total_labour[]" size="4" value="' + frm.total_labour.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="machinary[]" size="4" value="' + frm.machinary.value + '"> <input type="text" name="tool[]" size="4" value="' + frm.tool.value + '"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mch_chg_hrs[]" size="4" value="' + frm.mch_chg_hrs.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="tool_chg_hrs[]" size="5" value="' + frm.tool_chg_hrs.value + '">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="trnp_cost[]" size="5" value="' + frm.trnp_cost.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="food_cost[]" size="5" value="' + frm.food_cost.value + '"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="used_inputs[]" size="5" value="' + frm.used_inputs.value + '"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="inputs_qty[]" size="5" value="' + frm.inputs_qty.value + '"> &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="inputs_cost[]" size="5" value="' + frm.inputs_cost.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="pesticides_qty[]" size="5" value="' + frm.pesticides_qty.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="pesticides_cost[]" size="5" value="' + frm.pesticides_cost.value + '">&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="total_exp_day[]" size="5" value="' + frm.total_exp_day.value + '"><input type="button" value="X" class="btn btn-danger"style="width: 40px;" onclick="removeRow(' + rowNum + ');"></p>';
            jQuery('#itemRows').append(row);
            $("#farm").slideDown(1000);
        }




    }

    function removeRow(rnum) {
        jQuery('#rowNum' + rnum).remove();

    }
</script>



<script src="<?php echo base_url('assets'); ?>/jquery.min.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
    $('select').select2();
</script>

