<?php include('header.php'); ?>
<style>
.item:hover {
	opacity : 0.8;
	color:yellow;
}
</style>

<link href="<?php echo base_url('assets/theme'); ?>/css/biz_galary.css" rel="stylesheet" type="text/css" media="all" />

<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$role = singleDbTableRow($user_id)->rolename;
	
	$get_pincode = $this->db->get_where('user_address',['user_id'=>$user_id,'address_type'=>'Permanent']);
	if($get_pincode->num_rows() > 0)
	{
		foreach($get_pincode->result() as $pin);
		
		$postal_code = $pin->pincode; 
		
	
		$table_name = "area";
		$where_array = "type=1 AND find_in_set('".$postal_code."',pincode) <> 0  ";
		$query = $this->db->group_by('location', 'desc')->where($where_array )->get($table_name);
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
			
		
	}
	else{
		 $location = "";
	}
	
	
	$this->session->set_userdata('location', $location);
?>


<section>
	
	 <div class="row">
	
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="well" style="min-height:600px; background-image: url(<?php echo base_url('assets/theme/img/home_bg.jpg'); ?>); background-size: cover;background-repeat: no-repeat; background-size: 100% 100%;">
               <?php 
						$query = $this->db->get_where('user_address',['user_id'=>$user_id, 'address_type'=>'Permanent']);
						if($query->num_rows() > 0)
						{?>
					
			   <div class="row">
					<?php
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];							
						$rolename    = singleDbTableRow($user_id)->rolename;
						
						$condition = " to_role LIKE '%".$rolename."%'";
						$i=0;
						$query =  $this->db->group_by('business_types')->where($condition)->get('smb_product');
						foreach($query->result() as $b)
						{
							$i++;
							$b_type = $b->business_types;
							$get_business_name  = $this->db->get_where('business_groups',['id'=>$b_type]);
							foreach($get_business_name->result() as $b_name);
							$biz_name = $b_name->business_name;
							$points_mode = $b_name->points_mode;
							if($b_name->points_mode == 'wallet' || $b_name->points_mode == ''){
								$currency = "CPA Paymet";
							}
							elseif($b_name->points_mode == 'loyality'){
								$currency = "LPA Payment";
							}
							elseif($b_name->points_mode == 'voucher'){
								$currency = "Voucher Payment";
							}
							
							if($b_name->image == "" || $b_name->image == "no_image.jpg"){
								$bg_image = "no_image.jpg";
							}
							else{
								$bg_image = $b_name->image;
							}
							
							if($b_name->bg_color != ""){
								$bg_color = $b_name->bg_color;
							}
							else{
								$bg_color = "lavender";
							}
					?>
					<a href="<?php echo base_url('smb_home?p=1&location='.$location.'&biz_id='.$b_type.'&category='."".'&sub_category='."".'&tag='."".'&pincode='."".'&vendor='."".'&price_range=0'); ?>" class="small-box-footer"  style="color:white; font-size:18px;">
					 <div class="col-lg-4">
						<!-- small box -->
						<div class="small-box item"  style="border-radius: 10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); background-image: url(<?php echo base_url('assets/theme/img/'.$bg_image) ?>); background-size: cover;background-repeat: no-repeat; background-size: 100% 100%; padding:0px;">
							
							<div class="inner"><h4 class="text-center"></h4></div>
							
							<div class="inner" style="background:crimson;">
								<h4 class="text-center">
									<?php echo $biz_name; ?>
								</h4>
							</div>
							
							<div class="inner">
								<center>
								<img src="<?php echo base_url('uploads/3d-shopping-icon-silver.gif'); ?>" class="img-circle img-responsive" alt="User Image" />
								</center>
							</div>
							
							<div class="inner"><h4 class="text-center"></h4></div>
							<div class="inner" style="background:crimson; border-radius:0px 0px 10px 10px;">
								<h6 class="text-center">
									<?php echo $currency; ?>
								</h6>
							</div>
						</div>
					</div>
					</a>
					<!-- ./col -->
						<?php  }?>
			   </div>
			   <?php } else
						{
						?>
						<div class="row">
							<div class="col-md-12 text-center" style="padding:50px;">
								<a href="<?php echo base_url('user_address/addAddress')?>" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:auto;" class="btn btn-danger btn-lg btn-flat form-control" ><div class="row"><div class="col-md-12 text-center">Dear Customer Please Update Your Permanent Address @ My Profile, To Purchase Products.</div></div></a>
							</div>
						 
						</div>
							
						<?php
							
						}
					?>
			</div>
		</div>
	</div>
	
	
</section>
