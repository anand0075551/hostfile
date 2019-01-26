<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
    <!-- Date-Time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
    

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
                            <p><label>Select User id</label></p>
                            <select class="form-control" name="user_id" id="user_id" style=" width:100% auto; ">
                                <option value="">Choose User id</option>
                                <?php
                                $user_id = $this->db->group_by('user_id')->get_where('user_track');
                                foreach ($user_id->result() as $u) {
                                    $query = $this->db->get_where('users', ['id' => $u->user_id]);
                                    foreach ($query->result() as $d) {
                                        $user_name = $d->first_name . " " . $d->last_name;
                                        echo "<option value='" . $u->user_id . "'>" . $u->user_id . '-' . $user_name . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <p><label>Select Rolename</label></p>
                            <select class="form-control" name="rolename" id="rolename" style=" width:100% auto; ">
                                <option value="">Choose Rolename</option>
                                <?php
                                $rolename = $this->db->group_by('rolename')->get('user_track');
                                foreach ($rolename->result() as $v) {
                                    $query1 = $this->db->get_where('role', ['id' => $v->rolename,]);
                                    foreach ($query1->result() as $row) {
                                        echo "<option value='" . $v->rolename . "'>" . $v->rolename . '-' . $row->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <p><label>Select Status</label></p>
                            <select class="form-control" name="status" id="status" style=" width:100% auto; ">
                                <option value="">Choose Status</option>
                                <option value="0">Pending</option>
                                <option value="1">Active</option>
                                <option value="2">Blocked</option>
                                <option value="3">Blocked by Admin</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <p><label>Select Referral Code</label></p>
                            <select class="form-control" name="referral_code" id="referral_code" style=" width:100% auto; ">
                                <option value="">Choose Referral Code</option>
                                <?php
                                $referral_code = $this->db->group_by('referral_code')->get('user_track');
                                foreach ($referral_code->result() as $v) {
                                    echo "<option value='" . $v->referral_code . "'>" . $v->referral_code . "</option>";
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
                    </div>
                    <div class="row" style="padding:10px;">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3 text-right">
                            <button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
                            <button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
                        </div>
                    </div>

                </div><!-- /.box-header -->
                <div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
                    <div class="row" style="padding:10px;">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
                            &nbsp;
                            <button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('user_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div  id="excel_table" class="box-body">
                        <table id="example" class="table table-bordered table-striped table-hover print_div">
                            <thead>
                                <tr>
                                    <th  width="7%">Action</th>
                                    <th>User Name</th>
                                    <th>Rolename </th>
                                    <th>Referral Code</th>
                                    <th>Status</th>
                                    <th>Action by</th>
                                    <th>Action at</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr> 
                                    <th  width="7%">Action</th>
                                    <th>User Name</th>
                                    <th>Rolename </th>
                                    <th>Referral Code</th>
                                    <th>Status</th>
                                    <th>Action by</th>
                                    <th>Action at</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</section>
</div>

<?php

function page_js() { ?>

    <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
	<!-- PDF Export -->
    <script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>

    <!-- CSV Export -->
    <script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>



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
                                      
                                        defaultDate: '+03.01.1970', // it's my birthday
                                        defaultTime: '10:00',
                                        timepickerScrollbar: false
                                    });
    </script>

    <script type="text/javascript">
        $(function () {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url('referTree/userTrackListJson'); ?>"
            });
        });

    </script>

    <script type="text/javascript">
        function search_result()
        {
            var user_id = $("#user_id").val();
            var rolename = $("#rolename").val();
            var referral_code = $("#referral_code").val();
            var status = $("#status").val();
            var sf_time = document.getElementById('some_class_1').value;
            var st_time = document.getElementById('some_class_2').value;

            var mydata = {"user_id": user_id, "rolename": rolename, "referral_code": referral_code, "status": status, "sf_time": sf_time, "st_time": st_time};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('referTree/user_search_ListJson'); ?>",
                data: mydata,
                success: function (response)
                {
                    $("#example").html(response);
                }
            });
        }
    </script>


    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>


    <script>
        $(document).ready(function () {
            var form = $('.print_div'),
                    
                    a4 = [868, 841.89];  // for a4 size paper width and height

            $('#create_pdf').on('click', function () {
              
                createPDF();
            });
            //create pdf
            function createPDF() {
                getCanvas().then(function (canvas) {
                    var
                            img = canvas.toDataURL("image/png"),
                            doc = new jsPDF({
                                unit: 'px',
                                format: 'a3'
                            });
                    doc.addImage(img, 'JPEG', 20, 20);
                    doc.save('user_report.pdf');
                   
                });
            }

            // create canvas object
            function getCanvas() {
                form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
                return html2canvas(form, {
                    imageTimeout: 2000,
                    removeContainer: true
                });
            }

        });
    </script>



    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
    <script>
        $('select').select2();
    </script>

<?php } ?>

