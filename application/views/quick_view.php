<?php 
	
	$biz_id = $this->session->userdata('biz_id');
	$sale_status = singleDbTableRow($biz_id, 'business_groups')->sale_status;
	
	$bg_color = $this->session->userdata('bg_color');
	
	$location = $this->session->userdata('location');
	foreach($vender->result() as $vendor_id); 
	$vendor = $vendor_id->id;
	
	foreach($product_view->result() as $product); 
	$p_id = $product->id;
	
	$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$p_id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor]);
	foreach($get_added_stock->result() as $added_stock);
	$total_added = $added_stock->quantity;
	
	$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$p_id, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vendor]);
	foreach($get_sold_stock->result() as $sold_stock);
	$total_sold = $sold_stock->quantity;
	
	$get_sold_destroyed = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$p_id, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$vendor]);
	foreach($get_sold_destroyed->result() as $sold_destroy);
	$total_destroy = $sold_destroy->quantity;
	
	$av_stock = $total_added-($total_sold+$total_destroy);
	
	$sold_by = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$p_id, 'location'=>$location, 'type'=>'add']);
	if($sold_by->num_rows()>0){
	foreach($sold_by->result() as $u);
	$name = singleDbTableRow($vendor)->company_name; 
	}
	else{
		$name = "";
	}
	
	$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$p_id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor]);
	foreach($get_details->result() as $v);
	
?>
<?php include('header.php'); ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<!-- Main content -->
<div class="well" style="background:<?php echo $bg_color; ?>">
	<?php include('smb_header.php'); ?>
	 <!-- /.box-header -->
	<!---------------------------------Product View------------------------------------>
		<section class="page-section light">
			<div class="content" style="background:<?php echo $bg_color; ?>; margin-top:10px;">
			 <div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-md-10 col-sm-10 col-xs-10 ">
								<img src="<?php echo base_url('smb_uploads/'.$product->main_image); ?>" id="zoom"class="img-thumbnail" alt="Cfirst" style ="width:300px; height:270px; border:none; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" data-zoom-image="<?php echo base_url('smb_uploads/'.$product->main_image); ?> ">
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12" style ="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
						<h3 class="product-title"><?php echo $product->title;?></h3>
						<div class="product-info">
							<b style="color:#36a577;font-size:15px;;">Description</b> <P><?php echo $product->description; ?></p>
							<b style="color:#36a577;font-size:15px;;">
								 <?php 
									$biz_id = $this->session->userdata('biz_id');
									
										$get_item  = $this->db->get_where('dynamic_labels', ['business_type'=>$biz_id ]);
										if($get_item->num_rows() > 0){
											foreach($get_item->result() as $i);	
											echo $i->sold_by.' :' ;
										}
										else{
											echo "Sold By : ";
										}
								  ?>
								</b> 
								<?php 
								echo $name;
								?><hr>
							
								<h4> <?php 
									$biz_id = $this->session->userdata('biz_id');
									
										$get_item  = $this->db->get_where('dynamic_labels', ['business_type'=>$biz_id ]);
										if($get_item->num_rows() > 0){
											foreach($get_item->result() as $i);	
											echo $i->price.' :' ;
										}
										else{
											echo "Price : ";
										}
								  ?><b> <?php 
										$biz_id = $this->session->userdata('biz_id');
										
											$get_item  = $this->db->get_where('dynamic_labels', ['business_type'=>$biz_id ]);
											if($get_item->num_rows() > 0){
												foreach($get_item->result() as $i);	
												echo $i->currency_value;
											}
											else{
												echo  "&#8377;" ;
											}
									  ?>
									<?php 
										$type = $v->discount_type;
										if($type == "rupee")
										{
											$discount2 = $v->sale_price - $v->discount;
											echo $discount2 ; 
											?> </b>
											&nbsp;<s> &#8377;<?php echo $v->sale_price; ?></s>&nbsp;
											<div class="label label-success">
											&#8377;<?php 
											echo $v->discount." Off";	
										}
										else{											
											$discount = ($v->sale_price/100)*$v->discount;
											echo $v->sale_price - $discount; 
											?> </b>
											&nbsp;<s> &#8377;<?php echo $v->sale_price; ?></s>&nbsp;
											
											<?php 
											if($v->discount != ''){
												echo '<div class="label label-success">';
												echo $v->discount." %";	
												echo '</div>';
											}
										}
									?>
						</b>
						</div><br>
						<div class="well">
							<!--item_count--->
							 <div class="item_count">
								<div class="col-md-12">
									<label for="quantity">Quantity</label>
								</div>
								<?php echo form_open('shopping_cart/add_to_cart') ?>
								<div class="col-sm-6 col-md-4">
									<div class="input-group">
										  <span class="input-group-btn">
											  <button type="button" class="btn  btn-number"  data-type="minus" data-field="quantity">
												<span class="glyphicon glyphicon-minus"></span>
											  </button>
										  </span>
										  <input type="text" name="quantity" value='1' class="form-control input-number text-center" min="0" max="<?php echo $av_stock; ?>" required>
										  <span class="input-group-btn">
											  <button type="button" class="btn  btn-number" data-type="plus" data-field="quantity">
												  <span class="glyphicon glyphicon-plus"></span>
											  </button>
										  </span>
									</div>
								</div>
								<?php
									if($av_stock > 0){
								?>
								<div class="stock">
									<h4><b><font color="green">
									<?php
										
										$biz_id = $this->session->userdata('biz_id');
									
										$get_item  = $this->db->get_where('dynamic_labels', ['business_type'=>$biz_id ]);
										if($get_item->num_rows() > 0){
											foreach($get_item->result() as $i);	
											$avi =  $i->available;
										}
										else{
											$avi =  "Available";
										}
										
										echo $av_stock." ".$product->unit." ".$avi ;
											
									?></font></b>
								</div>
								<?php
									}else{
								?>
								<div class="out_of_stock">
									<button  class="btn btn-danger disabled" style="border-radius:100px; border:4px solid lightgray" > Sold Out</button>
								</div>
								<?php
									}
								?>
							</div>
							<!--item_count--->
							<!----------------------------------------------------------->
							<?php echo form_hidden('id', $product->id) ?>
							<?php echo form_hidden('thumb', $product->main_image) ?>
							<?php echo form_hidden('title', $product->title) ?>
							<?php 
								$type = $v->discount_type;
								if($type == "percent")
								{
									echo form_hidden('sale_price', $v->sale_price - $discount);
								}
								else{
									echo form_hidden('sale_price', $v->sale_price - $v->discount);
								}
							?>
							<?php echo form_hidden('current_stock', $product->current_stock) ?>
							<?php echo form_hidden('shipping_cost', $v->shipping_cost) ?>
							<?php echo form_hidden('tax_percent', $v->tax) ?>
							<?php echo form_hidden('vendor', $vendor) ?>
							<?php echo form_hidden('url', current_url()) ?>
							<?php 

								$tax_type = $v->tax_type;
								$tax = ($v->sale_price/100)*$v->tax;
								if($tax_type == "rupee")
								{							
									echo form_hidden('tax', $v->tax);	
								}
								else{
									echo form_hidden('tax', $tax);	
								}
							?>
							
							<?php
							if($sale_status == 1){
								if($av_stock > 0){
							?><br><br>
							<button type="submit" class="button" name="to_cart" value="Add to cart" ><span><i class="fa fa-shopping-cart" aria-hidden="true"></i>
							 <?php 
								$biz_id = $this->session->userdata('biz_id');
								
									$get_item  = $this->db->get_where('dynamic_labels', ['business_type'=>$biz_id ]);
									if($get_item->num_rows() > 0){
										foreach($get_item->result() as $i);	
										echo $i->add_to_cart;
									}
									else{
										echo  "Add To Cart" ;
									}
							  ?></span></button>
							<?php }  } ?>
								
							<div id="product_stock_id" style="display:none"><?php echo $product->id ?></div>
							<?php echo form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</section>
<!---------------------------------End Product View------------------------------------>

<!------------------------------------------------------Item slider text------------------------------------------------------------>
<div class="container">
  <div class="row" id="slider-text">
	<div class="col-md-6" >
	  <h2>RELATED PRODUCTS</h2>
	</div>
  </div>
</div>

<div class="row" style="padding:10px;">
	<div class="col-xs-12 col-sm-12 col-md-12">
	  <div class="carousel carousel-showmanymoveone slide" id="itemslider">
		<div class="carousel-inner">
				
				 <?php //Activr Related products 
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];	
					
					$rolename    = singleDbTableRow($user_id)->rolename;
					
					
				?>
				<div class="item active">
	
				</div>
					
				 <?php //Related products 
					$category = $product->category;
					
					$condition = $condition = "category = '".$category."' AND business_types = '".$biz_id."' AND location = '".$location."' AND to_role LIKE '%".$rolename."%' AND active=1 AND type='add' ";
				 
					$my_products = $this->db->order_by('id', 'desc')->group_by('product')->group_by('added_by')->where($condition)->get('smb_stock');
					
					if($my_products->num_rows() > 0){
						foreach($my_products->result() as $pro){
						$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$pro->product, 'location'=>$location, 'type'=>'add', 'added_by'=>$pro->added_by]);
						foreach($get_added_stock->result() as $added_stock);
						$total_added = $added_stock->quantity;
						
						$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$pro->product, 'location'=>$location, 'type'=>'sold', 'added_by'=>$pro->added_by]);
						foreach($get_sold_stock->result() as $sold_stock);
						$total_sold = $sold_stock->quantity;
						
						$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$pro->product, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$pro->added_by]);
						foreach($get_destroyed_stock->result() as $destroyed_stock);
						$total_destroyed = $destroyed_stock->quantity;
						
						$av_stock = $total_added-($total_sold+$total_destroyed);
						
						if($av_stock >0){
								
						$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$pro->product, 'location'=>$location, 'type'=>'add', 'added_by'=>$pro->added_by]);
						foreach($get_details->result() as $v);
				?>
				<div class="item" style="padding-left:70px; padding-right:70px;">
					<div class="col-xs-12 col-sm-6 col-md-2" style="padding:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
					  <a href="<?php echo base_url('Smb_home/product_font_view?product='.$pro->product.'&vendor_id='.$pro->added_by) ?>"><img src="<?php echo base_url('smb_uploads/'.singleDbTableRow($pro->product, 'smb_product')->main_image); ?>" class="img-responsive center-block" style="height:100px;" >
					 <center><font size="3"><?php echo singleDbTableRow($pro->product, 'smb_product')->title; ?></font><center></a>
					  <h5 class="text-center">
						&#8377;<?php  
								$type = $v->discount_type;
								if($type == "rupee")
									{
										$discount = $v->sale_price - $v->discount;
										echo $discount;
									}
								else
									{
										$discount = ($v->sale_price/100)*$v->discount;
										echo $v->sale_price - $discount;
									}
							?> </b>
						&nbsp;<s>&#8377;<?php echo $v->sale_price; ?></s>
					  </h5>
					 </div>
				</div>
					<?php
							} }} 
					?>
		</div>
	   <div id="slider-control">
		<a class="left carousel-control" href="#itemslider" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left text-blue" aria-hidden="true"></span> </a>
		<a class="right carousel-control" href="#itemslider" data-slide="next"><span class="glyphicon glyphicon-chevron-right text-blue" aria-hidden="true"></span> </a>
	  </div>
	  </div>
	</div>
</div>


<!-- Item slider-->
<div class="row" style="display:none;">
	<div class="col-xs-12 col-sm-12 col-md-12">
	  <div class="carousel carousel-showmanymoveone slide" id="itemslider">
		<div class="carousel-inner">
				
				 <?php //Activr Related products 
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];	
					
					$rolename    = singleDbTableRow($user_id)->rolename;
					
					
				?>
				<div class="item active">
	
				</div>
					
				 <?php //Related products 
					$category = $product->category;
					$query = $this->db->get_where('smb_product',['category'=>$category,'business_types'=>$biz_id]);	
					if($query->num_rows()>0){
						foreach($query->result() as $p)
						{
							$to_role = explode(",", $p->to_role);
							foreach($to_role as $t){
								if($rolename==$t){
								$get_availability = $this->db->group_by('added_by')->get_where('smb_stock', ['product'=>$p->id, 'type'=>'add']);
							if($get_availability->num_rows()>0){
								foreach($get_availability->result() as $vndr){
							$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$p->id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vndr->added_by]);
							foreach($get_added_stock->result() as $added_stock);
							$total_added = $added_stock->quantity;
							
							$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$p->id, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vndr->added_by]);
							foreach($get_sold_stock->result() as $sold_stock);
							$total_sold = $sold_stock->quantity;
							
							$av_stock = $total_added-$total_sold;
							
							if($av_stock >0 ){
								
							$get_product_new = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$p->id,'location'=>$location, 'type'=>'add', 'added_by'=>$vndr->added_by]);
							foreach($get_product_new->result() as $v);
				?>
				<div class="item">
					<div class="col-xs-12 col-sm-6 col-md-2">
					  <a href="<?php echo base_url('Smb_home/product_font_view?product='.$p->id.'&vendor_id='.$vndr->added_by) ?>"><img src="<?php echo base_url('smb_uploads/'.$p->main_image); ?>" class="img-responsive center-block" style="height:100px;" >
					 <center><font size="3"><?php echo $p->title; ?></font><center></a>
					  <h5 class="text-center">
						&#8377;<?php  
								$type = $v->discount_type;
								if($type == "rupee")
									{
										$discount = $v->sale_price - $v->discount;
										echo $discount;
									}
								else
									{
										$discount = ($v->sale_price/100)*$v->discount;
										echo $v->sale_price - $discount;
									}
							?> </b>
						&nbsp;<s>&#8377;<?php echo $v->sale_price; ?></s>
					  </h5>
					 </div>
				</div>
					<?php
							} }} } }
					} }
					?>
		</div>
	   <div id="slider-control">
		<a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
		<a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
	  </div>
	  </div>
	</div>
</div>
		
<?php function page_js(){ ?>
<script>
(function(){

  $('#itemslider').carousel({ interval: 3000 });
}());

(function(){
  $('.carousel-showmanymoveone .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<6;i++) {
      itemToClone = itemToClone.next();


      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }


      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());

</script>

<!-----------------Quantity increse----------------->
<script>
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>
