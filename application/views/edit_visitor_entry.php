


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
                    <h3 class="box-title">Edit Visitor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
					
					<div class="form-group <?php if(form_error('visitor_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Visitor Name

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="visitor_name" class="form-control"  value="<?php echo $visitor_entry->visitor_name; ?>" placeholder="">
                                <?php echo form_error('visitor_name') ?>

                            </div>
                    </div>
					
					
					<!-- <div class="col-md-9">

                                    <select name="type2" id="type" class="form-control" >
                                        <option value="< ?php echo $business->id;?>">

                                        < ?php
                                        $get = $this->db->group_by('type')->get_where('per_business',['id'=> $business->id]);
                                        foreach($get->result() as $ac);
                                        echo $ac->type;
                                    ?>


                                        </option>
                                        <option value=""> Choose Type </option>
                                        <option value="Self">1 - Self</option>
                                        <option value="Spouce">2 - Spouce</option>
                                        <option value="Other 1">3 - Other 1 </option>
                                        <option value="Other 2">4 - Other 2  </option>
                                        <option value="Other 3">5 - Other 3  </option>
                                        <option value="Other 4">6 - Other 4  </option>
                                        <option value="Other 5">7 - Other 5  </option>
                                    </select>
                                    < ?php echo form_error('type') ?>

                                </div>
                    </div> -->
                  
						<div class="form-group <?php if(form_error('type_of_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> <span>Type Of Id*</span></label>
                            <div class="col-md-9"> 
                                <select name="type_of_id" class="form-control" >
								<option value="<?php echo $visitor_entry->type_of_id;?>"> 
									
									<?php
                                        $get = $this->db->get_where('visitors_details',['id'=> $visitor_entry->id]);
                                        foreach($get->result() as $r);
                                        echo $r->type_of_id;
                                    ?>
								</option>
                                    <option value=""> Select Type Of Id </option>
									<option value ="Adhar Card"> Adhar Card </option>
									<option value ="advertisement"> PAN Number </option>
									<option value ="PAN Number"> Driving License </option>	
									<option value ="Passport"> Passport </option>
									<option value ="Voter's Id"> Voter's Id</option>

										
                                </select>
                                <?php echo form_error('type_of_id') ?>
                            </div>
                        </div>
                     
					 
						<div class="form-group <?php if(form_error('proof_number')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Proof Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="proof_number" class="form-control"  value="<?php echo $visitor_entry->proof_number; ?>" placeholder="">
                                <?php echo form_error('proof_number') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('email_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Communication Id/Email

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="email_id" class="form-control"  value="<?php echo $visitor_entry->email_id; ?>" placeholder="">
                                <?php echo form_error('email_id') ?>

                            </div>
                        </div>
						
						
						
						<div class="form-group <?php if(form_error('purpose')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> <span>Purpose*</span></label>
                            <div class="col-md-9"> 
                                <select name="purpose" class="form-control" value="<?php echo $visitor_entry->purpose; ?>" >
								
								<option value="<?php echo $visitor_entry->purpose;?>"> 
									
									<?php
                                        $get = $this->db->get_where('visitors_details',['id'=> $visitor_entry->id]);
                                        foreach($get->result() as $r);
                                        echo $r->purpose;
                                    ?>
								</option>
                                    <option value=""> Select Purpose </option>
                                    <option value ="interview"> Interview </option>
									 <option value ="buisiness proposal"> Buisiness Proposal </option>
									  <option value ="advertisement"> Advertisement </option>
									   <option value ="stock inward"> Stock Inward </option>	
									    <option value ="stock outward"> Stock outward </option>

                                </select>
                                <?php echo form_error('purpose') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('from_place')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> From Place

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="from_place" class="form-control"  value="<?php echo $visitor_entry->from_place; ?>" placeholder="">
                                <?php echo form_error('from_place') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('refferer')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Refferer

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="refferer" class="form-control"  value="<?php echo $visitor_entry->refferer; ?>" placeholder="">
                                <?php echo form_error('refferer') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('whom_to_meet')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Whom To Meet


                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="whom_to_meet" class="form-control"  value="<?php echo $visitor_entry->whom_to_meet; ?>" placeholder="">
                                <?php echo form_error('whom_to_meet') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('mobile_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Moile Number


                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile_no" class="form-control"  value="<?php echo $visitor_entry->mobile_no; ?>" placeholder="">
                                <?php echo form_error('mobile_no') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Remarks

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control"  value="<?php echo $visitor_entry->remarks; ?>" placeholder="">
                                <?php echo form_error('remarks') ?>

                            </div>
                        </div>
						
					<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload Visitor Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
						
						<div class="form-group <?php if(form_error('custom1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom1

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom1" class="form-control"  value="<?php echo $visitor_entry->custom1; ?>" placeholder="">
                                <?php echo form_error('custom1') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom1

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom2" class="form-control"  value="<?php echo $visitor_entry->custom2; ?>" placeholder="">
                                <?php echo form_error('custom2') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom3')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom1

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom3" class="form-control"  value="<?php echo $visitor_entry->custom3; ?>" placeholder="">
                                <?php echo form_error('custom3') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom4')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom4

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom4" class="form-control"  value="<?php echo $visitor_entry->custom4; ?>" placeholder="">
                                <?php echo form_error('custom4') ?>

                            </div>
                        </div>
					
						
						<div class="form-group <?php if(form_error('custom5')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom5

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom5" class="form-control"  value="<?php echo $visitor_entry->custom5; ?>" placeholder="">
                                <?php echo form_error('custom5') ?>

                            </div>
                        </div>
                        
				
			    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
				
                    <button type="submit" name="submit" value="edit_visitor" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update Visitor Entry
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->



<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



