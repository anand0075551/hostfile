<?php function page_css(){ ?>

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
                    <h3 class="box-title">Add Area Location:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		<div class="form-group <?php if(form_error('business_group')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">For Business Group</label>
                            <div class="col-md-9">
                            <select  name="business_name"   class="form-control">
							<option value=""> Choose option </option>
							<?php
                            if($business_name->num_rows() > 0)
                            {
                            foreach($business_name->result() as $c){
							

							echo "<option value=".$c->id.">".$c->business_name."</option>";
						
                            }
                            }
                            ?>
                        </select>	
							<?php echo form_error('business_group') ?>                       
						</div>				
			</div>
					
						<div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                            <label for="status" class="col-md-3">Type
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="type" class="form-control">
									<option value="">-Select Type-</option>
									<option value="1">For Sale</option>
									<option value="2">For Purchase</option>
								</select>
								<?php echo form_error('status') ?>
                            </div>
                        </div>
					 
							<div class="form-group <?php if(form_error('location')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">For Area Location</label>
                            <div class="col-md-9">
                        <select name="location" id="location" class="form-control">
							<option value=""> Choose option </option>
							<?php
                            if($location->num_rows() > 0)
                            {
                            foreach($location->result() as $c){
                           // $selected = ($c->id == 105)? 'selected' : '';
                            //echo '<option value="'.$c->id.'" '.$selected.'> '.$c->consignment_no.'</option>';
							echo "<option value=".$c->id.">".$c->location."</option>";
                            }
                            }
                            ?>
                        </select>	
							<?php echo form_error('location') ?>                       
						</div>				
							</div>
							
							<hr />
                        
						 <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Country <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="country" class="form-control" onchange="get_state(this.value)">
                                    <option value=""> Select Country </option>
                                    <?php
                                    if($country->num_rows() > 0)
                                    {
                                        foreach($country->result() as $c){
                                            //$selected = ($c->id == 105)? 'selected' : '';
                                            echo '<option value="'.$c->country.'"> '.$c->country.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('country') ?>
                            </div>
                        </div>
						
						 <div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="state" id="state" class="form-control" onchange="get_districts(this.value)">
                                    <option value=""> Select State </option>
                                    
                                </select>
                                <?php echo form_error('state') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('district')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="district" id="district" class="form-control" onchange="get_taluk(this.value)">
                                    <option value=""> Select District </option>
                                    
                                </select>
                                <?php echo form_error('district') ?>
                            </div>
                        </div>


		
						<div class="form-group <?php if(form_error('taluk')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Taluk<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="taluk" id="taluk" class="form-control" onchange="get_pincode(this.value)">
                                    <option value=""> Select location </option>
                                   
                                </select>
                                <?php echo form_error('taluk') ?>
                            </div>
                        </div>

		
			
						<div class="form-group <?php if(form_error('pincode')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="location_area[]"  multiple="" id="pincode" class="form-control">
                                    <option value=""> Select Pincode </option>
                                    
                                </select>
                                <?php echo form_error('pincode') ?>
                            </div>
                        </div>
						
													


	
												                        
           

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_area" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Area
                        </button>
						
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->








<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>



	

	    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	<!--pincode search -->
	
	<script>
	function get_state(id)
{
 //   alert(id);
    var mydata = {"country": id};

    $.ajax({
        type: "POST",
        url: "getstate",
        data: mydata,
        success: function (response) {
            $("#state").html(response);
            //alert(response);
        }
    });
}




	function get_districts(id)
{
//  alert(id);
    var mydata = {"state": id};

    $.ajax({
        type: "POST",
        url: "get_districts",
        data: mydata,
        success: function (response) {
            $("#district").html(response);
            //alert(response);
        }
    });
}

function get_taluk(id)
{  //   alert(id);
    var mydata = {"district": id};

    $.ajax({
        type: "POST",
        url: "get_taluk",
        data: mydata,
        success: function (response) {
			$("#taluk").html(response);
        }
    });
}

function get_pincode(id)
{          
    //alert(id);
    var mydata = {"taluk": id};

    $.ajax({
        type: "POST",
        url: "get_pincode",
        data: mydata,
        success: function (response) {
			$("#pincode").html(response);
        }
    });
}







</script>

	<!-- -->
<?php } ?>

