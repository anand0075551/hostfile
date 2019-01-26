<?php function page_css(){ ?>


<?php } ?>

<?php include('header.php'); ?>
<?php 
	$comm1 = $commissions->slr_ref_pm; 
	$comm2 = $commissions->clt_ref_pm; 
	$comm3 = $commissions->profit_pm; 
	$comm4 = $commissions->deduction_pm; 
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Business Commisions</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
				        <div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Accounts Type</label>
                            <div class="col-md-9">
                                <div class="input-group">   
								<input type="text" readonly name="acct_id" value="<?php echo $pay_spec = ledgerDbTableRow($commissions->acct_id)->name; ?>" class="form-control" >
<!--								
									<select name="acct_id" class="form-control">
										<option value="">Accounts Type </option>
										
										< ?php foreach($main_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>		
				
									</select>		         
-->							   </div>
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>	
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub-Account/Pay Specification</label>
                            <div class="col-md-9">
                                <div class="input-group">  
				<input type="text" readonly name="sub_acct_id" value="<?php echo $pay_spec = ledgerDbTableRow($commissions->sub_acct_id)->name; ?>" class="form-control" >
                              								
								<!--	<select name="sub_acct_id" class="form-control">
										
										<option value="">Sub-Accounts Type </option>
										<?php foreach($sub_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>	
									</select>
-->									
							   </div>
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						<hr />

						<div class="form-group <?php if(form_error('from_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sender Type</label>
                            <div class="col-md-9">
                                <div class="input-group">  
	<input type="text" readonly name="from_role" value="<?php echo $pay_spec = typeDbTableRow($commissions->from_role)->rolename; ?>" class="form-control" >								
		<!--							<select name="from_role" class="form-control">
										<option value=""> Sender - Role Type </option>										
										< ?php foreach($roles->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->rolename.'</option>';
												}                                        
										?>	
									</select>		         
		-->					   </div>
                                <?php echo form_error('from_role') ?>
                            </div>
                        </div>	
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Receiver Type</label>
                            <div class="col-md-9">
                                <div class="input-group">    
<input type="text" readonly name="to_role" value="<?php echo $pay_spec = typeDbTableRow($commissions->to_role)->rolename; ?>" class="form-control" >									
	<!--								<select name="to_role" class="form-control">
										<option value=""> Receiver - Role Type </option>
										<?php foreach($roles->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->rolename.'</option>';
												}                                        
										?>	
									</select>		         
	-->						   </div>
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>
					<hr /> 
					<div class="form-group <?php if(form_error('slr_ref_pm')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Profits in Points Mode </label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<input type="radio" name="slr_ref_pm" <?php if($comm1=="wallet"){ ?> checked <?php } ?> value="wallet" id="wallet" />Wallet        
									<input type="radio" name="slr_ref_pm" <?php if($comm1=="discount"){ ?> checked <?php } ?>  value="discount" id="discount" />Discount	
									<input type="radio" name="slr_ref_pm" <?php if($comm1=="loyality"){ ?> checked <?php } ?> value="loyality" id="loyality" />loyality	
									<input type="radio" name="slr_ref_pm" <?php if($comm1=="bonus"){ ?> checked <?php } ?> value="bonus" id="bonus" />Bonus	     
							<!--	<input type="radio" name="slr_ref_pm" checked value="wallet" id="wallet" />Wallet        
									<input type="radio" name="slr_ref_pm"  value="discount" id="discount" />Discount	
									<input type="radio" name="slr_ref_pm"  value="loyality" id="loyality" />loyality	
									<input type="radio" name="slr_ref_pm"  value="bonus" 	  id="bonus"   />Bonus	        -->           
                            		<?php echo form_error('slr_ref_pm') ?>
								</div>
							</div>
						</div>
						<div class="form-group <?php if(form_error('slr_ref_level1')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Sender Commission for 'Level 1'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level1" step="0.1" min="0" class="form-control" value="<?php echo $commissions->slr_ref_level1; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level1') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('slr_ref_level2')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Sender Commission for 'Level 2'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level2" step="0.1" min="0" class="form-control" value="<?php echo $commissions->slr_ref_level2; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level2') ?>
								</div>
								</div>
						</div>	
												<div class="form-group <?php if(form_error('slr_ref_level3')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Sender Commission for 'Level 3'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level3" step="0.1" min="0" class="form-control" value="<?php echo $commissions->slr_ref_level3; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level3') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('slr_ref_level4')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Sender Commission for 'Level 4'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level4" step="0.1" min="0" class="form-control" value="<?php echo $commissions->slr_ref_level4; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level4') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('slr_ref_level5')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Sender Commission for 'Level 5'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="slr_ref_level5" step="0.1" min="0" class="form-control" value="<?php echo $commissions->slr_ref_level5; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('slr_ref_level5') ?>
								</div>
								</div>
						</div>	
						<hr /> 
							<div class="form-group <?php if(form_error('clt_ref_pm')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Profits in Points Mode </label>
                            <div class="col-md-9">
                                <div class="input-group">
									<input type="radio" name="clt_ref_pm" <?php if($comm2=="wallet"){ ?> checked <?php } ?> value="wallet" id="wallet" />Wallet        
									<input type="radio" name="clt_ref_pm" <?php if($comm2=="discount"){ ?> checked <?php } ?>  value="discount" id="discount" />Discount	
									<input type="radio" name="clt_ref_pm" <?php if($comm2=="loyality"){ ?> checked <?php } ?> value="loyality" id="loyality" />loyality	
									<input type="radio" name="clt_ref_pm" <?php if($comm2=="bonus"){ ?> checked <?php } ?> value="bonus" id="bonus" />Bonus	
							<!--	<input type="radio" name="clt_ref_pm" checked value="wallet" id="wallet" />Wallet        
									<input type="radio" name="clt_ref_pm"  value="discount" id="discount" />Discount	
									<input type="radio" name="clt_ref_pm"  value="loyality" id="loyality" />loyality	
									<input type="radio" name="clt_ref_pm"  value="bonus" 	  id="bonus"   />Bonus	          -->                
									<?php echo form_error('clt_ref_pm') ?>
								</div>
							</div>
						</div>
						<div class="form-group <?php if(form_error('clt_ref_level1')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Receiver Commission for 'Level 1'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level1" step="0.1" min="0" class="form-control" value="<?php echo $commissions->clt_ref_level1; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level1') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('clt_ref_level2')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Receiver Commission for 'Level 2'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level2" step="0.1" min="0" class="form-control" value="<?php echo $commissions->clt_ref_level2; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level2') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('clt_ref_level3')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Receiver Commission for 'Level 3'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level3" step="0.1" min="0" class="form-control" value="<?php echo $commissions->clt_ref_level3; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level3') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('clt_ref_level4')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Receiver Commission for 'Level 4'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level4" step="0.1" min="0" class="form-control" value="<?php echo $commissions->clt_ref_level4; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level4') ?>
								</div>
								</div>
						</div>	
								<div class="form-group <?php if(form_error('clt_ref_level5')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Receiver Commission for 'Level 5'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="clt_ref_level5" step="0.1" min="0" class="form-control" value="<?php echo $commissions->clt_ref_level5; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('clt_ref_level5') ?>
								</div>
								</div>
						</div>	
						<hr /> 
						<div class="form-group <?php if(form_error('points_mode')) echo 'has-error'; ?>">						
                        <label for="firstName" class="col-md-3">Points Mode </label>
                        <div class="col-md-9">
                                <div class="input-group">                          
                            		<input type="text" readonly name="points_mode" value="<?php echo $commissions->points_mode; ?>" class="form-control" >

                            <?php echo form_error('points_mode') ?>
                        </div></div>				 </div>	
						<div class="form-group <?php if(form_error('commission')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Business 'VAT/Commisions' to Organization
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="commission" step="0.1" min="0" class="form-control" value="<?php echo $commissions->commission; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('commission') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('benefits')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Business 'Tax/Benefits' to Organization
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="benefits" step="0.1" min="0" class="form-control" value="<?php echo $commissions->benefits; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('benefits') ?>
								</div>
								</div>
						</div>					
						<hr />	
						
						<div class="form-group <?php if(form_error('profit_pm')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Profits in Points Mode </label>
                            <div class="col-md-9">
                                <div class="input-group">  
									<input type="radio" name="profit_pm" <?php if($comm3=="wallet"){ ?> checked <?php } ?> value="wallet" id="wallet" />Wallet        
									<input type="radio" name="profit_pm" <?php if($comm3=="discount"){ ?> checked <?php } ?>  value="discount" id="discount" />Discount	
									<input type="radio" name="profit_pm" <?php if($comm3=="loyality"){ ?> checked <?php } ?> value="loyality" id="loyality" />loyality	
									<input type="radio" name="profit_pm" <?php if($comm3=="bonus"){ ?> checked <?php } ?> value="bonus" id="bonus" />Bonus	                           
							<!--	<input type="radio" name="profit_pm" checked value="wallet" id="wallet" />Wallet        
									<input type="radio" name="profit_pm"  value="discount" id="discount" />Discount	
									<input type="radio" name="profit_pm"  value="loyality" id="loyality" />loyality	
									<input type="radio" name="profit_pm"  value="bonus" 	  id="bonus"   />Bonus	         -->
									<?php echo form_error('profit_pm') ?>
								</div>
								</div>
						</div>
						
						<div class="form-group <?php if(form_error('sender_profit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Profit to 'Sender'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="sender_profit" step="0.1" min="0" class="form-control" value="<?php echo $commissions->sender_profit; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('sender_profit') ?>
								</div>
								</div>
						</div>	
						<div class="form-group <?php if(form_error('receiver_profit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Profit to 'Receiver'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="receiver_profit" step="0.1" min="0" class="form-control" value="<?php echo $commissions->receiver_profit; ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('receiver_profit') ?>
								</div>
								</div>
						</div>					
						<hr />	
						<div class="form-group <?php if(form_error('deduction_pm')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Deduction in Points Mode </label>
                            <div class="col-md-9">
                                <div class="input-group">   
									<input type="radio" name="deduction_pm" <?php if($comm4=="wallet"){ ?> checked <?php } ?> value="wallet" id="wallet" />Wallet        
									<input type="radio" name="deduction_pm" <?php if($comm4=="discount"){ ?> checked <?php } ?>  value="discount" id="discount" />Discount	
									<input type="radio" name="deduction_pm" <?php if($comm4=="loyality"){ ?> checked <?php } ?> value="loyality" id="loyality" />loyality	
									<input type="radio" name="deduction_pm" <?php if($comm4=="bonus"){ ?> checked <?php } ?> value="bonus" id="bonus" />Bonus	
								<!--	<input type="radio" name="deduction_pm" checked value="wallet" id="wallet" />Wallet        
										<input type="radio" name="deduction_pm"  value="discount" id="discount" />Discount	
										<input type="radio" name="deduction_pm"  value="loyality" id="loyality" />loyality	
										<input type="radio" name="deduction_pm"  value="bonus" 	  id="bonus"   />Bonus	    -->                          
									<?php echo form_error('deduction_pm') ?>
								</div>
								</div>
						</div>
						<div class="form-group <?php if(form_error('sender_deduction')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Deduction to 'Sender'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="sender_deduction" step="0.1" min="0"  class="form-control" value="<?php echo $commissions->sender_deduction; ?>" placeholder="Enter Deduction Percentage Value">
									<?php echo form_error('sender_deduction') ?>
								</div>
								</div>
						</div>							
						<div class="form-group <?php if(form_error('receiver_deduction')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3"> Deduction to 'Receiver'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="receiver_deduction" step="0.1" min="0"   class="form-control" value="<?php echo $commissions->receiver_deduction; ?>" placeholder="Enter Deduction Percentage Value">
									<?php echo form_error('receiver_deduction') ?>
								</div>
								</div>
						</div>					<hr />	
						 <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select the Date range:
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>													
									   <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $commissions->start_date; ?>">
									   <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $commissions->end_date; ?>">
										<?php echo form_error('start_date') ?>
									</div>
							</div>
						</div>				
					    <div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Comments/Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="remarks" class="form-control" value="<?php echo $commissions->remarks; ?>" placeholder="Enter Comments/Remarks">
									<?php echo form_error('remarks') ?>

								</div>
						</div> 
				
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="copy_commissions" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Commissions    </button>                 
					<a href="<?php echo base_url('Comissions_rpt/Comissions_report_list/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>	
					   
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>

