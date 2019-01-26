
<?php

function page_css() { ?>
    <!-- datatable css -->

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
                    <h3 class="box-title">Consumer Support</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                    <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="business_id" id="business_name" class="form-control" onChange="get_business_name(this.value)" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('business_name') ?>

                        </div>
                    </div>


                    <div id="issue_div" class="form-group <?php if (form_error('issue')) echo 'has-error'; ?>" style="display:none" >
                        <label for="firstName" class="col-md-3">Type of Issue</label>
                        <div class="col-md-9">
                            <select name="issue_type" id="issue_type" class="form-control" onChange="get_ticket_no()" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <option value="Techinical"> Techinical </option>
                                <option value="Non Techinical">Non Techinical  </option>
                                <option value="General"> General </option>
                            </select>	
                            <?php echo form_error('issue') ?>
                            <div id="output" >
                            </div>
                        </div>				
                    </div>


                    <div class="form-group <?php if (form_error('ticket_no')) echo 'has-error'; ?>">
                        <label for="ticket_no" class="col-md-3">Ticket No.
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="ticket_no">
                                <input type="text" id="ticket" name="ticket_no" class="form-control" readonly value="<?php echo set_value('ticket_no'); ?>" placeholder="Ticket Number">
                            </div>
                            <?php echo form_error('ticket_no') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('issue_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Issue Details
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <textarea name="issue_details" class="form-control" value="<?php echo set_value('issue_details'); ?>" placeholder=""></textarea>                               
                            <?php echo form_error('issue_details') ?>

                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('comments')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Comments</label>                         
                        <div class="col-md-9">
                            <textarea name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Enter Comments"></textarea>
                            <?php echo form_error('comments') ?>
                        </div>
                    </div> 



                    <div class="form-group <?php // if(form_error('street_address')) echo 'has-error';          ?>">
                        <label for="firstName" class="col-md-3">Upload File
                            <span class="text-aqua"></span>
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
                <button type="submit" id="submit_btn" name="submit" value="add_support" class="btn btn-success" onclick="test()">
                    <i class="fa fa-edit"></i>Submit
                </button>


                <div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
                                        $('select').select2();</script> 



<!-- CREATE Ticket NO: -->
<script type="text/javascript" language="javascript">
	
	

            function get_business_name(id)
            {
            //var biz = $("#business_id").val()
            if (id != ""){
            $("#issue_div").slideDown();
                    $("#ticket").val("");
                    $("#issue_type").val("");
            }
            else{
            $("#issue_div").slideUp();
                    $("#ticket").val("");
            }


            var mydata = {"biz_id":id};
                    $.ajax({
                    type:"POST",
                            data:mydata,
                            //url:"get_business_name",
                            url: "<?php echo base_url('support/get_business_name') ?>",
                            success:function(response){
                            $("#mydiv").html(response);
                            }
                    })
            }


    function get_ticket_no()
    {

    var business_name = document.getElementById("biz_name").value;
            var issue_type = document.getElementById("issue_type").value;
            var bid = document.getElementById("business_name").value;
            var mydata = {"business_name":business_name, "issue_type":issue_type, "bid":bid};
            $.ajax({
            type:"POST",
                    data:mydata,
                    url: "<?php echo base_url('support/get_ticket_no') ?>",
                    //url: "<?php echo base_url('support/get_ticket_no'); ?>",
                    success:function(response){

                    $("#ticket_no").html(response);
                    }
            })

    }
	
	function test(){
		$('#submit_btn').addClass('disabled');
		$('#submit_btn').html('<i class="fa fa-refresh fa-spin"></i>');
	}
</script>

<?php

function page_js() { ?>
    <!-- InputMask -->
    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>


<?php } ?>

