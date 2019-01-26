<?php include('header.php'); ?>

 <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
<?php


foreach ($visitor->result() as $profile);
?>
<!-- Main content -->
<section class="content container print_div">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						
					</div>
		
			
                  <div class="form-group">
                    
                      
                      <div class="col-md-5 col-sm-4 col-xs-12 inputGroupContainer">
                     <img src="<?php echo base_url('assets/admin'); ?>/img/logo.png" class="img-thumbnail"  width="30%" height="60%"> 
                       </div>
                     
                       <label class="col-md-2  col-sm-2 col-xs-7 control-label" >Inward Visitor Photo</label> 
                        <div class="col-md-4 col-sm-5 col-xs-5 inputGroupContainer">
                      
                        <img src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" class="img-thumbnail"  width="30%" height="60%"> 
                    
                      </div>
                  </div>
                   <br> <br>  <br> <br>  <br> <br> <br>  <br>
  	
                <div class="form-group">
                    
                      <label class="col-md-2 col-sm-3 col-xs-7 control-label">Item Name</label>  
                      <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                      <div>
                      <?php echo $profile->item_name; ?>
                       </div>
                       </div>
                     
                       <label class="col-md-2 col-sm-3 col-xs-7 control-label">Type Of Item</label> 
                        <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                        <div>
                        <?php echo $profile->type_of_item; ?>
                        
                         </div>
                      </div>
                  </div>
                   <br>
				       <div class="form-group">
                    
                      <label class="col-md-2 col-sm-3  col-xs-7 control-label">Item No.</label>  
                      <div class="col-md-4 col-sm-3  col-xs-5 inputGroupContainer">
                      <div>
                      <?php echo $profile->item_number; ?>
                       </div>
                       </div>
                      
                       <label class="col-md-2 col-sm-3 col-xs-7  control-label" >Invoice Id</label> 
                        <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                        <div>
                        <?php echo $profile->invoice_id; ?>
                        </div>
                      </div>
                  </div>
								
					 <br>				
								
					<div class="form-group">
                          <label class="col-md-2 col-sm-3 col-xs-7 control-label">Purpose</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                               <?php echo $profile->purpose; ?>
                            </div>
                          </div>
                          <label class="col-md-2 col-sm-3  col-xs-7 control-label">Item Value</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                              <?php echo $profile->item_value; ?>
                            </div>
                          </div>
					</div>
                     <br>
                    <div class="form-group">
                          <label class="col-md-2  col-sm-3 col-xs-7 control-label">from place</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                              <?php echo $profile->from_place; ?>
                            </div>
                          </div>
                          <label class="col-md-2  col-sm-3 col-xs-7 control-label">From whom</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                            <?php echo $profile->from_whom; ?>
                            </div>
                          </div>
					</div>
                     <br>
                    <div class="form-group">
                          <label class="col-md-2 col-sm-3 col-xs-7 control-label">To Reciever</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                              <?php echo $profile->to_reciver; ?>
                            </div>
                          </div>
                          <label class="col-md-2 col-sm-3  col-xs-7 control-label">Mobile No.</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5  inputGroupContainer">
                            <div class="input-group">
                            <?php echo $profile->mobile_no; ?>
                            </div>
                          </div>
					</div>
                     <br>
                      <div class="form-group">
                          <label class="col-md-2 col-sm-3 col-xs-7 control-label">Remarks</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                              <?php echo $profile->remarks; ?>
                            </div>
                          </div>
                          <label class="col-md-2 col-sm-3  col-xs-7 control-label"></label>  
                            <div class="col-md-4 col-sm-3 col-xs-5  inputGroupContainer">
                            <div class="input-group">
                            
                            </div>
                          </div>
					</div>
                     <br>
                    <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                     <div class="form-group">
                          <label class="col-md-2 col-sm-3  col-xs-7 control-label">Created By</label>  
                            <div class="col-md-4 col-sm-3  col-xs-5 inputGroupContainer">
                            <div class="input-group">
                            <?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?>
                            </div>
                          </div>
                          <label class="col-md-2  col-sm-3  col-xs-7 control-label">Created At</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5  inputGroupContainer">
                            <div class="input-group">
                            <?php echo date("Y-m-d", $profile->created_at); ?>
                            </div>
                          </div>
					</div>
                     <br>
                     <div class="form-group">
                          <label class="col-md-2 col-sm-3 col-xs-7 control-label">Modified By</label>  
                            <div class="col-md-4 col-sm-3  col-xs-5 inputGroupContainer">
                            <div class="input-group">

                           <?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'No Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?>
                            </div>
                          </div>
                          <label class="col-md-2 col-sm-3 col-xs-7 control-label">Modified At</label>  
                            <div class="col-md-4 col-sm-3 col-xs-5 inputGroupContainer">
                            <div class="input-group">
                            <?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $profile->modified_at);
                                        ;
                                    }
                                    ?>
                            </div>
                          </div>
					</div>
									
						 <?php } ?>		
									
						
                </div><!-- /.box-body -->

               <div class="box-footer">
                     <a href="<?php echo base_url('Visitor_entry/inward_list') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Visitor_entry/edit_inward_items/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<script>
	$(document).ready(function(){
	var form = $('.print_div'),
	//	cache_width = form.width(),
		a4  =[ 868,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('Visitor Inward Entry Details.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>


<?php } ?>