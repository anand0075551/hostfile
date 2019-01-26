<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_home extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Smb_home_model');

		check_auth(); //check is logged in.
	}

	public function uniquePinCodeApi(){
	
		$user_info = $this->session->userdata('logged_user');
		$user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$pincode = $this->input->post('pincode');
		$biz_id = $this->session->userdata('biz_id');
		
		$get_pincode = $this->db->get_where('pincode', ['pincode'=>$pincode]);
		if($get_pincode->num_rows() > 0){
			$condition = " business_name = '".$biz_id."' AND pincode LIKE '%".$pincode."%'";
			$query = $this->db->where($condition)->get('area');
			if($query->num_rows() > 0 )
			{
				$return = 'true';
			}else{
				$return = 'false';
			}
		}
		else{
			$return = 'false';
		}
		
		echo $return;
	}
	
	public function get_vendors(){
		$postal_code = $_POST['pin'];
		$biz_id = $this->session->userdata('biz_id');
		
		$where_array = "business_name = '".$biz_id."' AND type=1 AND find_in_set('".$postal_code."',pincode) <> 0  ";
		$query = $this->db->group_by('location', 'desc')->where($where_array )->get('area');
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $r)
			{
				$location = $r->location;
			}
		} 
		else
		{
		  $location = "";
		}
		echo "<option value=''>All Vendors</option>";
		if($location != ""){
			$get_vendor = $this->db->group_by('added_by')->get_where('smb_stock', ['location'=>$location, 'business_types'=>$biz_id]);
			if($get_vendor->num_rows()>0){
				foreach($get_vendor->result() as $v){
					if(singleDbTableRow($v->added_by)->company_name != ""){
						$vendor = singleDbTableRow($v->added_by)->company_name;
					}
					else{
						$vendor = singleDbTableRow($v->added_by)->first_name." ".singleDbTableRow($v->added_by)->first_name;
					}
					echo "<option value='".$v->added_by."'>".singleDbTableRow($v->added_by)->referral_code."-".$vendor."</option>";
				}
			}
		}
	}
	
	 
	public function index()
	{	
		$biz_id = $_GET['biz_id'];
		$this->session->set_userdata('biz_id', $biz_id);
		
		
		if(singleDbTableRow($biz_id, 'business_groups')->bg_color != ""){
			$bg_color = singleDbTableRow($biz_id, 'business_groups')->bg_color;
		}
		else{
			$bg_color = "white";
		}
		$this->session->set_userdata('bg_color', $bg_color);
		
		theme('shop_my_basket');
	}
	
	public function home()
	{
		$this->session->unset_userdata('location');
		theme('home');
	}

	 public function product_font_view()	
	{
		
		$id = $_GET['product'];
		$vendor_id = $_GET['vendor_id'];
		
		$data['product_view'] = $this->db->get_where('smb_product', ['id' => $id]);
		$data['vender'] = $this->db->get_where('users', ['id' => $vendor_id]);
		
		theme('quick_view', $data);
	}
		
	public function get_voucher_amount(){
		
		$v_id = $_POST['v_id'];
		
		$data = $this->db->get_where('vouchers', ['voucher_id'=>$v_id]);
		foreach($data->result() as $row1)
		{
			$v_amount = $row1->amount;
		}
		echo $v_amount;
	}
	
	public function get_sub_category(){
		$category = $_POST['category'];
		$biz_id = $this->session->userdata('biz_id');
		$get_sub_catg = $this->db->group_by('sub_category')->get_where('smb_stock', ['category'=>$category, 'business_types'=>$biz_id]);
		if($get_sub_catg->num_rows() > 0){
			echo "<option value=''>Choose Sub-Category</option>";
			foreach($get_sub_catg->result() as $c){
				echo "<option value='".$c->sub_category."'>".singleDbTableRow($c->sub_category,'smb_sub_category')->sub_category_name."</option>";
			}
		}
	}
	
	public function filtered_products(){
		
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	
	//$location = $this->session->userdata('location');
	
	$rolename    = singleDbTableRow($user_id)->rolename;
	
	$bg_color = $this->session->userdata('bg_color');
	
	$biz_id = $this->session->userdata('biz_id');
	if($biz_id !="")
	{
		$business_types = $biz_id;
	}
	else{
		$business_types= 0;
	}
	
	
	$biz_id = $this->session->userdata('biz_id');
	
		$category 		= $_GET['category'];
		$sub_category	= $_GET['sub_category'];
		$tag 			= $_GET['tag'];
		$price_range 	= $_GET['price_range'];
		$pincode 		= $_GET['pincode'];
		$vendor 		= $_GET['vendor'];
		
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
		
		$page = $_GET['p'];
		if($page=="" || $page=="1")
		{
			$start = 0;
		}
		else{
			$start = ($page*9)-9;
		}
		
		echo '<div class="row text-center">';
		
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
				
			//	if($av_stock > 0){
				
				echo '<div class="col-sm-1" style="width:70px;"> </div>
					  <div class="col-sm-3 w3-card" style="height:600px; margin-bottom:30px;" id="product_box">';
				$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$pro->product, 'location'=>$location, 'type'=>'add', 'added_by'=>$pro->added_by]);
				foreach($get_details->result() as $v);
				
				$type = $v->discount_type;
				
				echo '<div class="text-right">';
				
				if($v->discount != ""){
					echo '<label class="btn-success text-center" style="border-radius:4px;  font-size:15px; padding:3px; width:50%;">';
					if($type == "rupee"){
							echo " &#8377;".$v->discount ." OFF";
						}
						else{
							echo $v->discount."% OFF";
						}
						echo '</label>';
				} else {
				echo '<label class="btn-success text-center" style=" background:none; border-radius:4px;  font-size:15px; padding:3px; width:50%;"><font style="color:'.$bg_color.'">space</font></label>';
				}
				echo '</div>
					<p class="item"  style=" height:250px;  width:100%;"><a href="'.base_url('Smb_home/product_font_view?product='.$pro->product.'&vendor_id='.$pro->added_by).'"><img  src="'.base_url('smb_uploads/'.singleDbTableRow($pro->product, 'smb_product')->main_image).'"  alt="pepsi">
					<h4><b><font size="4">'.singleDbTableRow($pro->product, 'smb_product')->title.'</font></b></h4></a></p>';
				echo '<div class="well" style=" height:260px;">
						<font size="3"><b>
						&#8377;';
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
				echo '</b>
						&nbsp;<s>&#8377;';
				echo $v->sale_price;
				echo '</s>
						<br>';
				if(singleDbTableRow($pro->added_by)->company_name != ""){
					$name = singleDbTableRow($pro->added_by)->company_name; 
				}
				else{
					$name = singleDbTableRow($pro->added_by)->first_name." ".singleDbTableRow($pro->added_by)->last_name;;
				}
				echo $name;
				echo '<h5 class="text-center"> ';
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
				echo '</h5>
					</font><br>';
				if($pro->added_by == $user_id){
					echo '<button  class="btn btn-danger disabled" style="border-radius:100px; border:4px solid lightgray" > You Can not Purcahse <br> Your Own Product..!</button>';
				}
				else{
					echo '<a class="btn btn-primary" style="background:indigo; border-radius:100px; border:4px solid lightgray" href="'.base_url('Smb_home/product_font_view?product='.$pro->product.'&vendor_id='.$pro->added_by).'" data-toggle="tooltip" title="Quick View"><i class="fa fa-eye"></i> </a>';
					if($av_stock >0 ){
						echo '<a href="'. base_url('shopping_cart/front_to_cart?product_id='.$pro->product.'&vendor_id='.$pro->added_by.'&p='.$page.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor).'" class="btn btn-primary" id="add_to_cart" style="background:indigo; border-radius:100px; border:4px solid lightgray" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i> </a>';
					}
					else{
						echo '<button  class="btn btn-danger disabled" style="border-radius:100px; border:4px solid lightgray" > Sold Out</button>';
					}
				}
				
				echo '</br>
				</div>
				
			</div>';
				
			//	}
			}
		
		
		echo '</div><hr>';
		
		echo '<div class="row text-center" id="paging_area">';
		
		
		$get_count = $this->db->group_by('product')->group_by('added_by')->where($condition)->get('smb_stock');
		$num = $get_count -> num_rows();
		
		$a = $num/9;
		$a = ceil($a);
		if($page != 1){
			$a1 = $page-1;
			
			echo '<a href="'.base_url('smb_home?p='.$a1.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor).'" class="btn btn-sm text-purple" style="margin-right:15px;"> <b> <i class="fa fa-hand-o-left"></i>  PREVIOUS </b></a>';
		}
		for($b=1; $b<=$a; $b++){
			
			
			if($b == $page)
			{
				echo '<a href="'.base_url('smb_home?p='.$b.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor).'" class="btn btn-sm btn-circle bg-purple" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><b>'.$b.'</b></a>';
			}
			
			else{
				echo '<a href="'.base_url('smb_home?p='.$b.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor).'" class="btn btn-sm btn-circle btn-default" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><b>'.$b.'</b></a>';
			}
			
			
			
			
			
		}
		if($page != $a){
			$a2 = $page+1;
			echo '<a href="'.base_url('smb_home?p='.$a2.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor).'" class="btn btn-sm text-purple" style="margin-left:15px;"><b> NEXT <i class="fa fa-hand-o-right"></i> </b></a>';
		}
		echo '</div>';
		}
		else{
			echo "<div class='row text-center'><h3 class='text-red'>Sorry..! No Products Found.</h3></div>";
		}
		
	}
	
	public function send_otp(){
		$this->load->helper('string');
		$otp = random_string('numeric', 5);
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		include_once('sendsms.php');
		$mobile  =  singleDbTableRow($user_id)->contactno;
		$msg = $otp ;
		$uname = singleDbTableRow($user_id)->first_name;
		
		$message="Dear ".$uname.", please share the OTP ".$otp." with us to complete your order -Team Cfirst";
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
		$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');
		
		echo $otp;
	}
	
}