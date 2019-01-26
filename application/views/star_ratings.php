<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/themes/krajee-fa/theme.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/themes/krajee-svg/theme.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/themes/krajee-uni/theme.css" rel="stylesheet" media="all" type="text/css"/>
<?php } ?>
<?php include('header.php'); ?>
<div class="container">
<br>
<button type="submit" id="myBtn" class="btn btn-primary">Rate Us</button>
		<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" >
		<div class="text-right" >
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
		  </div>
          <h4 class="modal-title">How Did You Like Our Services ?</h4>
        </div>
        <div class="modal-body">
			<div class="form-group <?php if(form_error('ratings')) echo 'has-error'; ?>">
				<label for="first_name" class="col-md-3">Rate
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9" >
				<input type="text" name="ratings" class="rating rating-loading" data-size="xs" title="">		
				</div>
            </div>
			
			            <div class="form-group <?php if (form_error('business_groups')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Business Name</label>
                            <div class="col-md-9">
                                <select name="business_groups"  class="form-control">
                                    <option value=""> Select Business Name </option>
                                    <?php
                                    if ($bg->num_rows() > 0) {
                                        foreach ($bg->result() as $c) {

                                            echo '<option value="' . $c->id . '"> ' . $c->business_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('business_groups') ?>
                            </div>
                        </div>
			                            <div class="form-group <?php if(form_error('source')) echo 'has-error'; ?>">
                                <label for="source" class="col-md-3">Source
                                    <span class="text-red"></span>
                                </label>
                                <div class="col-md-9" >
                                    <select name="source" class="form-control">
                                        <option value="">-Select Source-</option>
										<option value="Tv">Tv</option>
										 <option value="Friends">Friends</option>
                                        
										<option value="Newspaper">Newspaper</option>
                                        <option value="Web">Internet</option>
                                        <option value="Magazine">Magazine</option>
                                       
                                        <option value="Relatives">Relatives</option>
                                        <option value="Retailers">Retailers</option>
                                        <option value="Distributors">Distributors</option>
                                       
                                        <option value="Cfirst Consumer">Cfirst Consumer</option>
										 <option value="Master Distributors">Master Distributors</option>
                                      

                                    </select>
                             </div>
                            </div>
            <div class="form-group <?php if(form_error('comment')) echo 'has-error'; ?>">
				<label for="first_name" class="col-md-3">Add Comment
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9" >
				 <textarea name="comment" title="" width="100%"></textarea>		
				</div>
            </div>
		  
        </div>
        <div class="modal-footer">
		<div class="col-md-12" >
		  
           
           <button type="submit" name="submit" value="add_star" class="btn btn-warning">Submit</button>
           </div>
		   </div>
		   </div>
      </div>
    </div>
  </div>
</form>
</div>
<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/jquery/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/star-rating.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/themes/krajee-fa/theme.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/themes/krajee-svg/theme.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/themes/krajee-uni/theme.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
	$('#myModal').modal('show');
	$("#myBtn").click(function(){
    $('#myModal').modal('show');
    });
});
$(function(){
    $('#myModal').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Star_ratings/star_ratings') ?>", 
            type: "POST",
            data: $('#myModal').serialize(),
            success: function(data){
                 alert('successfully submitted')
            }
        });
    });
});
</script>
<?php }?>