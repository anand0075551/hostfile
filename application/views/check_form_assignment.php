
<?php

function page_css() { ?>

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
                    <h3 class="box-title">Check Role-wise Form Assignment </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                <div class="form-group <?php if (form_error('role_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Role
                            <span class="text-red">*</span>
                        </label>					                
				

                        <div class="col-md-6">  								

                            <select name="role_id"  class="form-control" id="role">
                                <option value=""> Choose Role </option>
                                <?php
                                if ($role->num_rows() > 0) {
                                    foreach ($role->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->roleid . "--" . $c->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('role_id') ?>

                        </div>
                </div>
						<button type="button" name="submit" id="show" class="btn btn-sm btn-primary">
							<i class="fa fa-search"></i>Search  </button>
				<a href="<?php echo base_url('menu/assigned_forms') ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-edit"></i>Back</a>
				
				

	

		
		
					

                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
			<p id="referralCodeStatus"></p>
                            <div id="users" style="display:none"></div>
			
				
				<div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->






<!-- Validation -->





<?php function page_js() { ?>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
        $('select').select2();
    </script> 

	
	
	
	<!--Get user details by refferal code-->
	<script>
$(document).ready(function(){
     $("#show").click(function(){
		var ref_id = $("#role").val();
	//	alert(ref_id);
		if (ref_id!=""){
			var mydata = {"ref_id":ref_id};
			$.ajax({
					type : "POST",
					url : "get_user2",
					data : mydata,
					success : function(response){
						$("#users").html(response);
					}
				})
		}
		else{
			$("#users").html("<font color='red'>Please Enter Consumer ID..!</font>");
		}
		
		$("#users").slideDown();	
	});
});
	 </script> 
<!--Get Vouchers-->
<?php } ?>

