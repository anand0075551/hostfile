<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php function page_css(){ ?>

	<style>
		.wish_cart:hover{
			border:1px solid darkblue;
		}
		.menu_btn:hover{
			background:indigo;
			color:white;
		}
		
		input[type=range] {
			-webkit-appearance: none;
			width: 300px;
		}
		input[type=range]::-webkit-slider-runnable-track {
			width: 300px;
			height: 11px;
			background: lightgray;
			border: none;
			border-radius: 3px;
		}
		input[type=range]::-webkit-slider-thumb {
			-webkit-appearance: none;
			border: none;
			height: 20px;
			width: 10px;
			border-radius: 20%;
			background: #337ab7;
			margin-top: -4px;
		}
		input[type=range]:focus {
			outline: none;
		}
		
	</style>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
<?php
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	
	$location = $this->session->userdata('location');
	
	$rolename    = singleDbTableRow($user_id)->rolename;
	
	$biz_id = $this->session->userdata('biz_id');
	if($biz_id !="")
	{
		$business_types = $biz_id;
	}
	else{
		$business_types= 0;
	}
	
	$bg_color = $this->session->userdata('bg_color');
$biz_id = $this->session->userdata('biz_id');
	$get_business_name  = $this->db->get_where('business_groups',['id'=>$biz_id]);
	foreach($get_business_name->result() as $b_name);
	if($b_name->image == "" || $b_name->image == "no_image.jpg"){
		$bg_image = "no_image.jpg";
	}
	else{
		$bg_image = $b_name->image;
	}
	
	if($b_name->search_box_color == ""){
		$search_box_color = $bg_color;
	}
	else{
		$search_box_color = $b_name->search_box_color;
	}
	
$get_item = $this->db->get_where('dynamic_labels', ['business_type'=>$biz_id]);
	if($get_item->num_rows() > 0){
		foreach($get_item->result() as $i);	
		$banner1 		 =  $i->banner1;
		$banner2 		 =  $i->banner2;
		$banner3 		 =  $i->banner3;
	}
	else{
		$banner1 		 =  "defult1.jpg";
		$banner2 		 =  "defult2.jpg";
		$banner3 		 =  "defult3.jpg";
	}	
	
	$get_search_type = $this->db->get_where('business_groups', ['id'=>$biz_id]);
	if($get_search_type->num_rows() > 0){
		foreach($get_search_type->result() as $s_type);
		$search_type = $s_type->search_type;
	}
	
	
	
$category = $_GET['category'];
$sub_category = $_GET['sub_category'];
$tag = $_GET['tag'];
$price_range = $_GET['price_range'];
$pincode = $_GET['pincode'];
$vendor = $_GET['vendor'];


$sale_status = singleDbTableRow($biz_id, 'business_groups')->sale_status;



?>
<body onLoad="myFunction()">
<!-- Main content -->
<section>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="well" style="background:<?php echo $bg_color; ?>; min-height:800px;">
               <?php include('smb_header.php'); ?>
			   
				<input type="hidden" id="search_type" value="<?php echo $search_type; ?>">
			 
			    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); display:none;">
					<!-- Indicators -->
					<ol class="carousel-indicators">
					  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					  <li data-target="#myCarousel" data-slide-to="1"></li>
					  <li data-target="#myCarousel" data-slide-to="2"></li>
					  <li data-target="#myCarousel" data-slide-to="3"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner " role="listbox">
					  
					  <div class="item active">
                     
						<img src ="<?php echo base_url('smb_sales/'.$banner1); ?>" alt="Cfirst" >
					  </div>
					
					  <div class="item">
                      
						<img src ="<?php echo base_url('smb_sales/'.$banner2); ?>" alt="Cfirst" >
					  </div>
					  
					   <div class="item">
                      
						<img src ="<?php echo base_url('smb_sales/'.$banner3); ?>" alt="Cfirst" >
					  </div>
					  
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					  <span class="sr-only">Previous</span>
					</a>	
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					  <span class="sr-only">Next</span>
					</a>
				</div>
				
				
				 <div class="box-header img-responsive" style="background-image: url(<?php echo base_url('assets/theme/img/'.$bg_image) ?>); background-size: cover;background-repeat: no-repeat; background-size: 100% 100%; padding-top:70px;  padding-bottom:70px; border-left: 2px solid <?php echo $search_box_color; ?>; border-right: 2px double <?php echo $search_box_color; ?>; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
					<div class="small-box">
						<div class="small-box-footer">
							<h1 class="text-center" style="font-weight:bold;">
								<?php echo singleDbTableRow($biz_id, 'business_groups')->business_name; ?>
							</h1>
						</div>
					</div>
					
				 </div>
				
				
				
		<!-- Selcetcion Screen Starts Here-->
			 <div class="box-header" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); border:1px solid lightgray; padding-bottom:5px; padding-top:20px; margin-bottom:20px; background:<?php echo $search_box_color; ?>;" id="selection_area">
			 
			
					<div class="row" id="type1_search" style="padding:10px; <?php if($search_type != 2 || $pincode != ''){ ?> display:none;<?php } ?>" >
						
						<div class="col-sm-1"></div>
						<div class="<?php if( $pincode == ''){ echo 'col-sm-8'; } else{ echo 'col-sm-4'; }?>" id="pincode_div" style="margin-bottom:10px;">
							<div class="input-group">
								<div class="input-group-addon referralFa" style="height:27px; border:2px solid lightgray; border-right:none;">
									<i class="fa fa-map-marker"></i>
								</div>
								<input type="number" class="form-control" name="pincode" value="<?php echo $pincode; ?>" id="pincode"  placeholder= "Please Enter Your Pincode" style="border:2px solid lightgray;">
							</div>
							
						</div>
						<div class="col-sm-4" id="vendor_div" style="<?php if( $pincode == ''){ echo 'display:none;'; }?> margin-bottom:10px;">
							<select class="form-control" name="vendor" id="vendor"  style=" width:100% auto; ">
								<option value="<?php echo $vendor; ?>">All Vendors</option>
							</select>
						</div>
						
						<div class="col-sm-2 text-right">
							
							<button type="button" id="pin_btn" name="submit" value="search" class="btn btn-primary btn-sm btn-flat form-control <?php if( $pincode == ''){ echo 'disabled'; }?>" onClick="search_result()" style="height:33px; margin-bottom:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Refine Search </button>
						</div>
						
						<div class="col-sm-1" style="margin-bottom:10px;"></div>
					</div>
			
			 
				<div id="type2_search" <?php if($search_type == 2 && $pincode == ''){ ?> style="display:none;" <?php } ?>>
					<div class="row" style="padding:10px;">
						<!--UPDATED BY rajat -->
							<div class="col-sm-1 text-right" style="margin-bottom:10px;">
							<?php if($search_type == 2 && $vendor == ""){ ?>
								<button type="button" class="btn btn-info btn-circle btn-flat btn-circle" onclick="get_type1()" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-map-marker"></i></button>
							<?php } ?>
							</div>
							<div class="col-sm-6" style="margin-bottom:10px;">
								<input type="text" class="form-control" name="tag" value="<?php echo $tag; ?>" id="tag"  placeholder= "What Are You Looking For ?" style="height:38px; border:2px solid lightgray;">
							</div>
							
							<div class="col-sm-4" >
							<div class="input-group form-control" style="padding:0px;">
								<div class="input-group-addon" style="padding:0px; background:white; width:25%;">
                                   <label><output>Price</output></label>
                                </div>
								<div class="input-group-addon" style="padding:0px; background:white; width:50%;">
								<?php 
									$get_max_price = $this->db->select_max('sale_price')->get_where('smb_stock', ['type'=>'add']);
									foreach($get_max_price->result() as $max_price);
									$max_price = $max_price->sale_price;
								
									$get_min_price = $this->db->select_min('sale_price')->get_where('smb_stock', ['type'=>'add']);
									foreach($get_min_price->result() as $min_price);
									$min_price = $min_price->sale_price;
								?>
								
                                    <input type="range" class="form-control btn btn-default" min="<?php echo $min_price; ?>" value="0" max="<?php echo $max_price; ?>" onchange="price_range.value=value" />
									
                                </div>
								<div class="input-group-addon" style="padding:0px; background:white; width:25%;">
                                    <label><output id="price_range"><?php echo $price_range; ?></output></label>
                                </div>
								
                              
                            </div>
						</div>
						<div class="col-sm-1"></div>
					</div>
					<div class="row" style="padding:10px;">
						
						<div class="col-sm-1"></div>
						<div class="col-sm-6" id="catg_div" style="margin-bottom:10px;">
							<select class="form-control" name="category" id="category" onChange="get_sub_catg(this.value)" style=" width:100% auto; ">
								<option value="<?php echo $category; ?>">All Categories</option>
								<?php 
									$get_category = $this->db->group_by('category')->get_where('smb_stock', ['type'=>'add', 'business_types'=>$biz_id]);
									foreach($get_category->result() as $p){
										echo "<option value='".$p->category."'>".singleDbTableRow($p->category, 'smb_category')->category_name."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-3" id="sub_catg_div" style="display:none; margin-bottom:10px;">
							<select class="form-control" name="sub_category" id="sub_category"  style=" width:100% auto; ">
								<option value="<?php echo $sub_category; ?>">Sub Categories</option>
							</select>
						</div>
						
						<div class="col-sm-2 text-right">
							
							<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat form-control" onClick="search_result()" style="height:28px; margin-bottom:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Refine Search </button>
						</div>
						<div class="col-sm-2 text-right">
							<a href="<?php echo base_url('smb_home?p=1&location='.$location.'&biz_id='.$biz_id.'&pincode='."".'&vendor='."".'&category='."".'&sub_category='."".'&tag='."".'&price_range=0'); ?>" class="btn btn-danger btn-sm btn-flat form-control" style="height:28px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-undo"></i> Reset </a>
							
						</div>
						<div class="col-sm-1" style="margin-bottom:10px;"></div>
					</div>
					
					</div>
			</div>
		 <!-- Selcetcion Screen Ends Here-->
				
		
				<div class="box-body" >
				
				<?php 
					
					$page = $_GET['p'];
					if($page=="" || $page=="1")
					{
						$start = 0;
					}
					else{
						$start = ($page*9)-9;
					}	
				?>
				<div class="text-center" id="product_area">
					<div class="row text-center" <?php if($search_type == 2 && $pincode == ''){ ?> style="display:none;" <?php } ?>>	
					<?php 
					
					if($pincode != ""){
						$table_name = "area";
						$where_array = "business_name = '".$biz_id."' AND type=1 AND find_in_set('".$pincode."',pincode) <> 0  ";
						$query = $this->db->group_by('location', 'desc')->where($where_array )->get($table_name);
						if ($query->num_rows() > 0)
						{
							foreach ($query->result() as $r)
							{
								$location = $r->location;
								$this->session->set_userdata('location', $location);
							}
						} 
						else
						{
							$location = $this->session->userdata('location');
						}
					}
					else{
						$location = $this->session->userdata('location');
					}
					
					$condition = " business_types = '".$biz_id."' AND location = '".$location."' AND to_role LIKE '%".$rolename."%' AND active=1 AND type='add' ";
					if($category != '')
					{
						$condition .=" AND category = '".$category."'";
					}
					
					if($vendor != '')
					{
						$condition .=" AND added_by = '".$vendor."'";
					}
					
					if($sub_category != '')
					{
						$condition .=" AND sub_category = '".$sub_category."'";
					}
					
					if($tag != '')
					{
						$condition .=" AND tag LIKE '%".$tag."%'";
					}
					
					if($price_range != 0)
					{
						$condition .=" AND sale_price <= '".$price_range."'";
					}
					$my_products = $this->db->order_by('current_stock', 'desc')->group_by('product')->group_by('added_by')->limit(9,$start)->where($condition)->get('smb_stock');
					
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
						
					//	if($av_stock >0){
				?>
					<div class="col-sm-1" style="width:70px;"> </div>
					<div class="col-sm-3 w3-card" style="height:600px; margin-bottom:30px;" id="product_box">
															
					<?php
					
						$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$pro->product, 'location'=>$location, 'type'=>'add', 'added_by'=>$pro->added_by]);
						foreach($get_details->result() as $v);
					
					
						$type = $v->discount_type;
					?>
					
					<div class="text-right">
					<?php if($v->discount != ""){ ?>
					<label class="btn-success text-center" style="border-radius:4px;  font-size:15px; padding:3px; width:50%;">
					<?php
						
						if($type == "rupee"){
							echo " &#8377;".$v->discount ." OFF";
						}
						else{
							echo $v->discount."% OFF";
						}
					?>
					</label>
					<?php } else { ?><label class="btn-success text-center" style=" background:none; border-radius:4px;  font-size:15px; padding:3px; width:50%; height:15px;"></label>
					<?php }   ?>
					</div>
					<p class="item"  style=" height:250px; width:100%;"><a href="<?php echo base_url('Smb_home/product_font_view?product='.$pro->product.'&vendor_id='.$pro->added_by) ?>"><img  src="<?php echo base_url('smb_uploads/'.singleDbTableRow($pro->product, 'smb_product')->main_image); ?>"  alt="Cfirst">
					<h4><b><font size="4"><?php echo singleDbTableRow($pro->product, 'smb_product')->title; ?></font></b></h4></a></p>
				<div class="well" style=" height:260px;">
						<font size="3"><b>
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
						<br>
						<?php 
							
							if(singleDbTableRow($pro->added_by)->company_name != ""){
							$name = singleDbTableRow($pro->added_by)->company_name; 
							}
							else{
								$name = singleDbTableRow($pro->added_by)->first_name." ".singleDbTableRow($pro->added_by)->last_name;;
							}
							echo $name;
						?>
							<h5 class="text-center"> 
								<?php 
									$c1 = singleDbTableRow($pro->product, 'smb_product')->custom1; 
									$c2 = singleDbTableRow($pro->product, 'smb_product')->custom2; 
									$c3 = singleDbTableRow($pro->product, 'smb_product')->custom3; 
									$c4 = singleDbTableRow($pro->product, 'smb_product')->custom4; 
									$c5 = singleDbTableRow($pro->product, 'smb_product')->custom5; 
									if($c1 != "" && $c2 != "" && $c3 != "" && $c4 != "" && $c5 != "")
									{
										echo $c1.'<br>';echo $c2.'<br>';echo $c3.'<br>';echo $c4.'<br>';echo $c5.'<br>'; 	 
									}	
									else{
										echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>"; 
									}
								?> 
							</h5>
							
						</font><br>
					<?php if($pro->added_by == $user_id){	?>
						<button  class="btn btn-danger disabled" style="border-radius:100px; border:4px solid lightgray" > You Can't Purcahse <br> Your Own Product..!</button>
					<?php } else{	
					
						//echo $pro->product.'//'.$av_stock.'//'.$pro->added_by;
					
					?>
						<a class="btn btn-primary" style="background:indigo; border-radius:100px; border:4px solid lightgray" href="<?php echo base_url('Smb_home/product_font_view?product='.$pro->product.'&vendor_id='.$pro->added_by) ?>" data-toggle="tooltip" title="Quick View"><i class="fa fa-eye"></i> </a>
						<?php
														
							
							
							
							if($sale_status == 1){
							if($av_stock >0 )
							{
							
								?>
								
						
								<a href="<?php echo base_url('shopping_cart/front_to_cart?product_id='.$pro->product.'&vendor_id='.$pro->added_by.'&p='.$page.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor)?>" class="btn btn-primary" id="add_to_cart" style="background:indigo; border-radius:100px; border:4px solid lightgray" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i> </a>
							<?php
							}
							
							else{?>
								<button  class="btn btn-danger disabled" style="border-radius:100px; border:4px solid lightgray" > Sold Out</button>
							<?php
							}
						}
					}
						?>
						
						</br>
				</div>
				
			</div>
				<?php
						//	}
						}
					}
					
				?>
					</div><hr>	
					<!----Pagenation---------->
					
					<div class="row text-center" id="paging_area" <?php if($search_type == 2 && $pincode == ''){ ?> style="display:none;" <?php } ?>>
						<?php 
							//$condition = " business_types = '".$biz_id."' AND location = '".$location."' AND to_role LIKE '%".$rolename."%' AND active=1 AND type='add' ";
							$get_count = $this->db->group_by('product')->group_by('added_by')->where($condition)->get('smb_stock');
							$num = $get_count -> num_rows();
							//echo $num."//";
							$a = $num/9;
							$a = ceil($a);
							if($page != 1){
								$a1 = $page-1;
						?>
							<a href="<?php echo base_url('smb_home?p='.$a1.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor); ?>" class="btn btn-sm text-purple" style="margin-right:15px;"> <b> <i class="fa fa-hand-o-left"></i>  PREVIOUS </b></a>
						<?php
							}
							for($b=1; $b<=$a; $b++){
						?>
							<a href="<?php echo base_url('smb_home?p='.$b.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor); ?>" class="btn btn-sm btn-circle <?php if($b == $page){echo 'bg-purple';} ?>" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><b><?php echo $b; ?></b></a> 
						<?php
							}
							
							if($page != $a){
								$a2 = $page+1;
						?>
							<a href="<?php echo base_url('smb_home?p='.$a2.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor); ?>" class="btn btn-sm text-purple" style="margin-left:15px;"><b> NEXT <i class="fa fa-hand-o-right"></i> </b></a>
						<?php
							}
						?>
					</div>
				</div>		
				</div>
			<div class="clearfix"></div>
             </div><!-- /.box-body -->
			<div class="box-footer">
				<input type="hidden" value="<?php echo $page ?>" id="page_no">
			</div>
		</form>
        </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->
       <!-- /.row -->
	   
</section><!-- /.content -->
</body>
<?php function page_js(){ ?>



<script>
function myFunction() {
    var product_box = $("#product_box").html();
	var search_type = $("#search_type").val();
	var pincode 	= $("#pincode").val();
	if(search_type == 2 && pincode == ""){
		$("#product_area").html("<div class='row text-center'><h3 class='text-blue'>Please Enter Your Pincode To Get Products.</h3></div>");
		$("#paging_area").html("");
	}
    if(product_box == undefined && search_type!=2){
		$("#product_area").html("<div class='row text-center'><h3 class='text-red'>Sorry..! No Products Are Available For Your Location.</h3></div>");
		$("#paging_area").html("");
		$("#selection_area").html("");
	}
}
</script>

<style>
	* {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.item {
  position: relative;
  margin:auto;
  overflow: hidden;
  width: 750px;
  height: 250px;
}
.item img {
  max-width: 80%;
  
  -moz-transition: all 0.2s;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}
.item:hover img {
  -moz-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>

<script>
	function get_sub_catg(id){
	//	alert(id);
	if(id==""){
		$("#sub_catg_div").hide();
		$("#catg_div").removeClass('col-md-3');
		$("#catg_div").addClass('col-md-6');
	}
	else{
		var mydata = {"category": id};
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('smb_home/get_sub_category'); ?>",
			data: mydata,
			success: function (response) {
				$("#sub_category").html(response);
				//alert(response);
			}
		});	
		
		$("#catg_div").removeClass('col-md-6');
		$("#catg_div").addClass('col-md-3');
		
		$("#sub_catg_div").slideDown(700);
	}
		
		
	}
</script>

<script>

	

	function get_type1(){
		$('#type2_search').slideUp();
		$('#type1_search').slideDown();
	}
	
	function search_result(){
		
		 $('#product_area').html('<label class="text-blue text-center" style="margin-top:50px; font-size:50px; margin-bottom:50px;"><i class="fa fa-spinner fa-spin"></i></label>');
		
		var pincode = $('#pincode').val();
		var vendor = $('#vendor').val();
		var category = $('#category').val();
		var sub_category = $('#sub_category').val();
		var tag = $('#tag').val();
		var price_range = $('#price_range').val();
		var page = 1;
	
		
		var mydata = {"category": category, "pincode": pincode, "sub_category": sub_category, "tag":tag, "vendor":vendor, "price_range": price_range, "p":page};
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('smb_home/filtered_products'); ?>",
				data: mydata,
				success: function (response) {
					$("#product_area").fadeOut();
					$("#product_area").html(response);
					$("#product_area").fadeIn();
				}
			});	
	
		$('#type1_search').slideUp();
		$('#type2_search').slideDown();
			
	}
</script>


<script>
    $(function(){
        $('input[name="pincode"]').keyup(function(){
            var iSelector = $(this);
            var pincode = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('Smb_home/uniquePinCodeApi'); ?>",
                data : { pincode : pincode }
            })
                .done(function(msg){
                    if(msg == 'true'){
						$('.referralFa').css({"color":"#0275d8", "border":"2px solid #0275d8", "border-right":"none"});
						$('#pincode').css({"border":"2px solid #0275d8"});
						$('.referralFa').html('<i class="fa fa-map-marker"></i>');
						
						var mydata = {"pin":pincode}
						$.ajax({
							type: "POST",
							url: "<?php echo base_url('smb_home/get_vendors'); ?>",
							data: mydata,
							success: function (response) {
								$("#vendor").html(response);
								//alert(response);
							}
						});	
						
						$("#pincode_div").removeClass('col-md-8');
						$("#pincode_div").addClass('col-md-4');
						
						$("#vendor_div").slideDown(700);
						
						$("#pin_btn").removeClass('disabled');
						
					}else{
						$('.referralFa').css({"color":"red", "border":"2px solid red"});
						$('#pincode').css({"border":"2px solid red"});
						$('.referralFa').html('<i class="fa fa-map-marker"></i>');
						
						$("#vendor_div").hide();
						$("#pincode_div").removeClass('col-md-4');
						$("#pincode_div").addClass('col-md-8');
						
						$("#pin_btn").addClass('disabled');
                    }
                });


        });
    });
	
	
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>
