<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courier_model extends CI_Model {

function __construct(){
parent:: __construct();
$this->load->model('Notification_model');
$this->load->model('payment_model');
check_auth(); //check is logged in.
}
/**
* @return bool
*/
		public function add_shipment_cost(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		//set all data for inserting into database
		$data = [


		'weight'                => $this->input->post('weight'),
		'from_pin'              => $this->input->post('from_pincode'),
		'to_pin'                => $this->input->post('to_pincode'),
		'amount'                => $this->input->post('amount'),
		'created_by'             => $user_id,
		'created_at'             => time(),


		];
		$query = $this->db->insert('cms_shipment_cost', $data);
		if($query)
		{
			create_activity('Added '.$data['created_by'].' cms_shipment_cost'); //create an activity
			return true;
		}
		return false;
		}
		
		
		
		public function edit_courier_cost($id){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		//set all data for inserting into database
		$data = [


			'weight'                => $this->input->post('weight'),
			'from_pin'              => $this->input->post('from_pincode'),
			'to_pin'                => $this->input->post('to_pincode'),
			'amount'                => $this->input->post('amount'),
			'modified_by'            => $user_id,
			'modified_at'            => time(),


		];
			$query = $this->db->where('id', $id)->update('cms_shipment_cost', $data);
		if($query)
		{
			create_activity('Updated '.$data['modified_by'].' role'); //create an activity
			return true;
		}
		return false;
		}
public function add_courier(){

		$grand_total = $this->input->post('cost');


		$id     = $this->input->post('shipper_name');
		$get_user = $this->db->get_where('users', ['id' => $id]);
		foreach($get_user->result() as $user)
		{
		$user_id = $user->id;
		$user_rolename = $user->rolename;
		$email = $user->email;
		$user_acc_no = $user->account_no;
		$user_name = $user ->first_name;
		}


		$s_location     = $this->input->post('shipper_location');
		$s_district     = $this->input->post('shipper_district');
		$s_state        = $this->input->post('shipper_state');
		$s_add          =  $s_location.", ".$s_district.", ".$s_state;

		$r_location     = $this->input->post('reciever_location');
		$r_district     = $this->input->post('reciever_district');
		$r_state        = $this->input->post('reciever_state');
		$r_add          =  $r_location.", ".$r_district.", ".$r_state;

		$weight = $this->input->post('weight');
		if($weight == '')  {$weight = '0';}

		$invoice_no = $this->input->post('invoice_no');
		if($invoice_no == '')  {$invoice_no = '0';}

		$quantity = $this->input->post('quantity');
		if($quantity == '')  {$quantity = '0';}

		$booking_mode = $this->input->post('booking_mode');
		if($booking_mode == '')  {$booking_mode = '0';}

		$mode = $this->input->post('mode');
		if($mode == '')  {$mode = '0';}

		$status = $this->input->post('status');
		if($status == '')  {$status = '18';}

		$comments = $this->input->post('comments');
		if($comments == '')  {$comments = '0';}

		$smb_weight = $this->input->post('smb_weight');
		if($smb_weight == '')  {$smb_weight = '0';}
		$smb_volume = $this->input->post('smb_volume');
		if($smb_volume == '')  {$smb_volume = '0';}
		
	    $business_group = $this->input->post('business_group');
		if($business_group == '')  {$business_group = '0';}
		
		$cost = $this->input->post('cost');
		if($cost == '')  {$cost = '0';}
		
		
		//set all data for inserting into database
		$data = [
		'ship_name'             => $this->input->post('shipper_name'),
		'phone'                 => $this->input->post('shipper_phone'),
		'shipper_pincode'       => $this->input->post('shipper_pincode'),
		's_add'                 => $s_add,
		'rev_name'              => $this->input->post('reciever_name'),
		'r_phone'               => $this->input->post('reciever_phone'),
		'receiver_pincode'      => $this->input->post('reciever_pincode'),
		'r_add'                 => $r_add,
		'type'                  => $this->input->post('shipment_type'),
		'delivery_type'                  => $this->input->post('delivery_type'),
		'cons_no'               => $this->input->post('consignment_no'),
		'business_group'        => $business_group,
		'cost'                  => $cost,
		'weight'                => $weight,
		'smb_weight'            => $smb_weight,
		'smb_volume'            => $smb_volume,
		'invice_no'             => $invoice_no,
		'qty'                   =>$quantity,
		'book_mode'             =>$booking_mode,
		'mode'                  =>$mode,
		'status'                =>$status,
		'comments'              => $comments,
		'book_date'             => date('Y-m-d'),
		//       'created_at'            => time(),
		'created_by'            => $user_id,
		'created_at'            => time()

		];
		$data2 = [
		'cons_no'           => $this->input->post('consignment_no'),
		'current_pincode'               => $this->input->post('shipper_pincode'),
		'receiver_pincode'              => $this->input->post('reciever_pincode'),
		'current_location'      =>  $s_add,
		'receiver_location'         => $r_add,
		'status'    => $status,
		'comments'      => $comments,

		'done_by'            => $user_id,
		'created_at'            => time(),
		'modified_at'            => time(),
		'created_by'            => $user_id

		];
		$query = $this->db->insert('cms_courier', $data);

		$query2 = $this->db->insert('cms_courier_status', $data2);




		if($query && $query2)
		{
	
		return true;
		}
		return false;


		}

	public function edit_courier($cid){
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];

	//set all data for inserting into database
	$data = [
	'smb_weight'            => $this->input->post('weight'),
	'invice_no'             => $this->input->post('invoice_no'),
	'qty'                   => $this->input->post('quantity'),
	'book_mode'             => $this->input->post('booking_mode'),
	'mode'                  => $this->input->post('mode'),
	'cost'                  => $this->input->post('shipping_cost'),
	'smb_volume'            => $this->input->post('smb_volume'),

	'status'                => '150',
    'modified_at'           => time(),
	'modified_by'           => $user_id

	];
		$data2 = [
		'cons_no'                       => $this->input->post('cons_no'),
		'current_pincode'               => $this->input->post('shipper_pincode'),
		'receiver_pincode'              => $this->input->post('receiver_pincode'),
		'current_location'     		    =>  $this->input->post('s_add'),
		'receiver_location'             => $this->input->post('r_add'),
		'status'    					=> '150',
		'comments'      				=> 'Pickup Successful',
		'modified_at'           		=> time(),
		'done_by'           		    => $user_id,
		'modified_by'           		    => $user_id
		

		];
		$cons_no = $this->input->post('cid');
		$query = $this->db->where('cons_no', $cons_no)->update('cms_courier', $data);


	$query2 = $this->db->insert('cms_courier_status', $data2);
	if($query && $query2)
	{
		
		return true;
	}
		return false;
	}








	public function courier_ListCount2(){

	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename = singleDbTableRow($user_id)->rolename;
	$email = singleDbTableRow($user_id)->email;
	if ($rolename == '11' || $rolename == '27' ) {
		$query = $this->db->count_all_results('cms_courier');
	} else {
		$query = $this->db->where('assigned_to', $user_id)->count_all_results('cms_courier');
	}
		return $query;
	}



	public function courier_List2($limit = 0, $start = 0){
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename = singleDbTableRow($user_id)->rolename;

	if ($rolename == '11' || $rolename == '27'|| $rolename == '26' ) {
		if ($rolename == '11' || $rolename == '27'){
	$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get('cms_courier');
		}else{
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier',['created_by' => $user_id ,'status' => "18",]);
		}
	} else {
	$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['assigned_to' => $user_id ,'cms_courier', 'status' => "8"]);
	}


	return $query;
	}

	public function courier_ListCount3(){

	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename = singleDbTableRow($user_id)->rolename;
	$email = singleDbTableRow($user_id)->email;
	if ($rolename == '11' || $rolename == '27' ) {
		$query = $this->db->count_all_results('cms_courier');
	} else {
		$query = $this->db->where('assigned_to', $user_id)->count_all_results('cms_courier');
	}
		return $query;
	}



	public function courier_List3($limit = 0, $start = 0){
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename = singleDbTableRow($user_id)->rolename;
	$email = singleDbTableRow($user_id)->email;
		if ($rolename == '11' || $rolename == '27' ) {
	$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get('cms_courier');
	} else {
		$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['assigned_to' => $user_id , 'status' => "13"]);
	}
		return $query;
	}

/**
* @param $id
* @return bool
* Update Category
*/

		public function update_status(){

		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];

		//$identity_id = $this->input->post('identity_id');
		$s_location     = $this->input->post('location');
		$s_district     = $this->input->post('district');
		$s_state        = $this->input->post('state');
		$s_add          =  $s_location.", ".$s_district.", ".$s_state;

		$new_status = $this->input->post('new_status');
		if($new_status == '8')
		{
		//set all data for inserting into database
		$data = [
		'cons_no'               => $this->input->post('cid'),
		'current_pincode'           => $this->input->post('pincode'),

		'receiver_pincode'           => $this->input->post('receiver_pincode'),
		'current_location'              => $s_add,
		'receiver_location'             => $this->input->post('r_add'),
		'status'        => $this->input->post('new_status'),
		'comments'          => $this->input->post('comment'),
		//  'currently_with'    => $this->input->post('currently_with'),
		      'modified_by'        => $user_id,

		'modified_at'       => time()
		];
		}
		else{
		$data = [
		'cons_no'               => $this->input->post('cid'),
		'current_pincode'           => $this->input->post('pincode'),

		'receiver_pincode'           => $this->input->post('receiver_pincode'),
		'current_location'              => $s_add,
		'receiver_location'             => $this->input->post('r_add'),
		'status'        => $this->input->post('new_status'),
		'comments'          => $this->input->post('comment'),
		//  'currently_with'    => $this->input->post('currently_with'),
		      'modified_by'        => $user_id,
		'done_by'       => $user_id,
		'modified_at'       => time()
		];
		}

		$query = $this->db->insert('cms_courier_status', $data);
		$cons_no = $this->input->post('cid');
		$data2 = [
		'status' => $this->input->post('new_status'),
		'comments'   => $this->input->post('comment')

		];

		$query2 = $this->db->where('cons_no', $cons_no)->update('cms_courier', $data2);

		if ($query) {
			
			return true;
		}
			return false;
		}



		public function assign_deliveryboy(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$c =        $this->input->post('consignment_no');
		$count=count($c);
		$cid  = implode("," ,$this->input->post('consignment_no'));

		//set all data for inserting into database
		$data = [
		'cid'                     => $cid,
		'dbid'                    => $this->input->post('delivery_boy'),
		'assigned_by'             => $user_id,
		'assigned_at'              => time(),
		'created_at'              => time(),
		'created_by'              => $user_id
		];
		$query = $this->db->insert('cms_deliver', $data);

		$data2 = [
		'assigned_to' => $this->input->post('delivery_boy')
		];

		$test = explode("," , $cid);
		foreach($test as $t){
	
		$query2 = $this->db->where('cons_no', $t)->update('cms_courier', $data2);
		}

			$dbid = $this->input->post('delivery_boy');
			$get = $this->db->get_where('users', ['id' => $dbid]);
			foreach($get->result() as $d){
			$delivery_boy_phone = $d->contactno;
			$delivery_boy_name = $d->first_name.'  '.$d->last_name ;
		}




if ($query && $query2) {

	include_once('sendsms.php');
	//  $cid =     $cons_no;

	$mobile  =  $delivery_boy_phone;
	$cnt = $count ;
	$uname = $delivery_boy_name;

	//  $userid=$this->input->post('user_id');
	//  $uname=$this->user_name($userid);

	$message="Dear ".$uname.", ".$cnt." couriers assigned to you .  Please Collect Your couriers  -Team Cfirst";
	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
	$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');




		
		return true;
	}
		return false;
	}

public function delivered_self(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$user_rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
$user_acc_no = singleDbTableRow($user_id)->account_no;
$user_name = singleDbTableRow($user_id)->first_name;
$referral_code = singleDbTableRow($user_id)->referral_code;





$this->load->helper('string'); //load string helper
$otp  = random_string('numeric',5);
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
if($getvouchers -> num_rows() > 0)
{
for($i= 0; $getvouchers -> num_rows() > 0; $i++){
$otp  = strtoupper(random_string());
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
}
}
//set all data for inserting into database
$data = [
'cid'                        => $this->input->post('cons_no'),
'reciever_phn'               => $this->input->post('receiver_phone'),
'shipper_phn'                => $this->input->post('phone'),
'otp'                        =>  $otp,
'generated_by'               => $user_id,
'owner_name'                 => $this->input->post('ship_name'),
'reciever_name'              => $this->input->post('name'),
'type'                       => $this->input->post('type'),
//  'id_no'                      => $this->input->post(''),
//  'id_type'                    => $this->input->post(''),
'status'                     => $this->input->post('status'),
'generated_at'               => time(),
'relation'                   => $this->input->post('relation'),
'remark'                     =>  $this->input->post('comment'),
		'created_at'              => time(),
		'created_by'              => $user_id
];
$data2 = [
'cons_no'                    => $this->input->post('cons_no'),
'current_pincode'            => $this->input->post('receiver_pincode'),
'receiver_pincode'           => $this->input->post('receiver_pincode'),
'current_location'           => $this->input->post('r_add'),
'receiver_location'          => $this->input->post('r_add'),
'status'                     => $this->input->post('status'),
'comments'                   => $this->input->post('comment'),
'modified_at'                 => time(),
'done_by'                    => $user_id,
'modified_by'              => $user_id
];
$cons_no = $this->input->post('cons_no');



$status = $this->input->post('status');
if($status == '150')
{
$data3 = [
	'smb_weight'                => $this->input->post('weight'),
	'qty'                       => $this->input->post('quantity'),
	'cost'                      => $this->input->post('shipping_cost'),
	'smb_volume'           	    => $this->input->post('smb_volume'),
	'status'                     => $this->input->post('status'),
	'comments'                   => $this->input->post('comment'),
	'assigned_to'                => 0,
	'modified_at'                 => time(),
	'modified_by'              => $user_id
];

}

elseif($status == '15')
{
$data3 = [
'status'                     => $this->input->post('status'),
'comments'                   => $this->input->post('comment'),
'assigned_to'                => 0

];





}

else{
$data3 = [
'status'                     => $this->input->post('status'),
'comments'                   => $this->input->post('comment'),
'assigned_to'                => $user_id

];
}

$query = $this->db->where('cid', $cons_no)->update('cms_delivery_status', $data);
//     $query = $this->db->insert('delivery_status', $data);
$query2 = $this->db->insert('cms_courier_status', $data2);
$query3 = $this->db->where('cons_no', $cons_no)->update('cms_courier', $data3);


$status = $this->input->post('status');
if($status == '15' || $status == '150')
{









if($query && $query2 && $query3)
{
$status                     =  $this->input->post('status');
if($status == '15') {
include_once('sendsms.php');
$reciever_phn               =  $this->input->post('receiver_phone');
$shipper_phn                 = $this->input->post('phone');
$owner_name                 = $this->input->post('ship_name');
$reciever_name             =  $this->input->post('name');

$cid =     $cons_no;
$mobiler  = $reciever_phn;
$mobiles  = $shipper_phn;

$query2 = $this->db->get_where('users', ['id' => $owner_name]);
if ($query2->num_rows() > 0) {
foreach ($query2->result() as $row2) {
$un = $row2->first_name." ".$row2->last_name;
}
} else {
$un =  " ";
}

$sname = $un;
$rname = $reciever_name;



$message="Dear ".$sname.", we confirm the delivery of the Order No ".$cid." with reciever name ".$rname."  by Our representitive  -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobiles, $message, 'http://www.consumer1st.in', 'xml');
$message="Dear ".$rname.", we confirm the delivery of the Order No ".$cid." with sender name ".$sname."  by Our representitive  -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobiler, $message, 'http://www.consumer1st.in', 'xml');

}

return true;
}}
return false;

}

public function delivered_others(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$user_rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
$user_acc_no = singleDbTableRow($user_id)->account_no;
$user_name = singleDbTableRow($user_id)->first_name;
$referral_code = singleDbTableRow($user_id)->referral_code;
//$identity_id = $this->input->post('identity_id');
$this->load->helper('string'); //load string helper
$otp  = random_string('numeric',5);
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
if($getvouchers -> num_rows() > 0)
{
for($i= 0; $getvouchers -> num_rows() > 0; $i++){
$otp  = strtoupper(random_string());
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
}
}
//set all data for inserting into database
$data = [
'cid'                        => $this->input->post('cons_no'),
'reciever_phn'               => $this->input->post('receiver_phone'),
'shipper_phn'                => $this->input->post('phone'),
'otp'                        =>  $otp,
'generated_by'               => $user_id,
'owner_name'                 => $this->input->post('ship_name'),
'reciever_name'              => $this->input->post('name'),
'type'                       => $this->input->post('type'),
'id_no'                      => $this->input->post('id_number'),
'id_type'                    => $this->input->post('id_type'),
'status'                     => $this->input->post('status'),
'generated_at'               => time(),
'relation'                   => $this->input->post('relation'),
'remark'                     =>  $this->input->post('comment'),
'created_by'                     =>  $user_id,
'created_at'                     =>  time()
];
$data2 = [
'cons_no'                    => $this->input->post('cons_no'),
'current_pincode'            => $this->input->post('receiver_pincode'),
'receiver_pincode'           => $this->input->post('receiver_pincode'),
'current_location'           => $this->input->post('r_add'),
'receiver_location'          => $this->input->post('r_add'),
'status'                     => $this->input->post('status'),
'comments'                   => $this->input->post('comment'),
'modified_at'                => time(),
'done_by'                    => $user_id,
'modified_by'                =>  $user_id

];
$cons_no = $this->input->post('cons_no');



$status = $this->input->post('status');
if($status == '150')
{
$data3 = [
'status'                     => $this->input->post('status'),
'comments'                   => $this->input->post('comment'),
'assigned_to'                => 0,
'modified_by'                =>  $user_id,
'modified_at'                =>  time()
];
}
else{
$data3 = [
'status'                     => $this->input->post('status'),
'comments'                   => $this->input->post('comment'),
'assigned_to'                => $user_id

];
}
$query = $this->db->where('cid', $cons_no)->update('cms_delivery_status', $data);
//     $query = $this->db->insert('delivery_status', $data);
$query2 = $this->db->insert('cms_courier_status', $data2);
$query3 = $this->db->where('cons_no', $cons_no)->update('cms_courier', $data3);

$status = $this->input->post('status');
if($status == '15' || $status == '150')
{


if($query && $query2 && $query3)
{


$status                     =  $this->input->post('status');
if($status == '15') {
include_once('sendsms.php');
$reciever_phn               =  $this->input->post('receiver_phone');
$shipper_phn                 = $this->input->post('phone');
$owner_name                 = $this->input->post('ship_name');
$reciever_name             =  $this->input->post('name');
$cid =     $cons_no;
$mobiler  = $reciever_phn;
$mobiles  = $shipper_phn;

$query9 = $this->db->get_where('users', ['id' => $owner_name]);
if ($query9->num_rows() > 0) {
foreach ($query9->result() as $row29) {
$un = $row29->first_name." ".$row2->last_name;
}
} else {
$un =  " ";
}


$rev_name             =  $this->input->post('rev_name');
$sname = $un;
$rname = $reciever_name;



$message="Dear ".$sname.", we confirm the delivery of the Order No ".$cid." with reciever name ".$rname."  by Our representitive  -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobiles, $message, 'http://www.consumer1st.in', 'xml');
$message="Dear ".$rname.", we confirm the delivery of the Order No ".$cid." with sender name ".$sname."  by Our representitive  -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobiler, $message, 'http://www.consumer1st.in', 'xml');

$message="Dear ".$rev_name.", we confirm the delivery of the Order No ".$cid." with sender name ".$sname." and receiver ".$rev_name." by Our representitive  -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobiler, $message, 'http://www.consumer1st.in', 'xml');
}


return true;
}}
return false;
}

/**
* @return menu List
* role menu List Query
*/
	public function addusersmenuListCount(){
		$query = $this->db->count_all_results('role');
		return $query;
	}
	public function courier_track_ListCount(){
		$query = $this->db->count_all_results('tbl_courier_track');

		return $query;
	}
	public function courier_List($limit = 0, $start = 0){


	$search = $this->input->get('search');
	$searchValue = $search['value'];
	$searchByID = '';

	if($searchValue != '')
	{
		$table_name = "tbl_courier_track";
		$where_array = array('cons_no' => $searchValue );
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
	}
	else{
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('tbl_courier_track');
	}

	return $query;
	}


//--------------------------------------------------------------------
	public function courier_ListCount(){

	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename = singleDbTableRow($user_id)->rolename;
	$email = singleDbTableRow($user_id)->email;
	if ($rolename == '11' || $rolename == '27' ) {
		$query = $this->db->count_all_results('cms_courier');
	}
	 else {
			$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
	}
		return $query;
	}



	public function courier_D_List($limit = 0, $start = 0){

	$search = $this->input->get('search');
	$searchValue = $search['value'];
	$searchByID = '';
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename = singleDbTableRow($user_id)->rolename;
	$email = singleDbTableRow($user_id)->email;
	if ($rolename == '11' || $rolename == '27' ) {
	if($searchValue != '')
	{
		$table_name = "cms_courier";
		$where_array = array('cons_no' => $searchValue );
		$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
	}
	else{
		$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get('cms_courier');
	}
	}else {
		if($searchValue != '')
		{
			$table_name = "cms_courier";
			$where_array = array('cons_no' => $searchValue );
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
		}
		else{
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['created_by' => $user_id]);
		}
	}
		return $query;
	}
//--------------------------------------------------------------------
	public function delivery_ListCount(){
		$query = $this->db->count_all_results('cms_delivery_status');
		return $query;
	}
	public function delivery_List($limit = 0, $start = 0){

	$search = $this->input->get('search');
	$searchValue = $search['value'];
	$searchByID = '';

	if($searchValue != '')
	{
		$table_name = "cms_delivery_status";
		$where_array = array('cid' => $searchValue );
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
	}
	else{
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('cms_delivery_status');
	}
		return $query;
	}
//--------------------------------------------------------------------
public function courier_st_ListCount(){

$query = $this->db->count_all_results('cms_courier_status');
return $query;
}
public function courier_st_List($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';

if($searchValue != '')
{
$table_name = "cms_courier_status";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('cms_courier_status');
}

return $query;
}

public function save_otp($cons_no, $phone, $ship_name, $type, $receiver_pincode, $r_add, $name, $receiver_phone, $relation, $status, $referredByCode, $comment )
{

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];


$this->load->helper('string'); //load string helper
$otp  = random_string('numeric',5);
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
if($getvouchers -> num_rows() > 0)
{
for($i= 0; $getvouchers -> num_rows() > 0; $i++){
$otp  = strtoupper(random_string());
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
}
}
$data = [

'cid'                       => $cons_no,
'reciever_phn'               => $receiver_phone,
'shipper_phn'                => $phone,
'otp'                        =>  $otp,
'generated_by'               => $user_id,
'owner_name'                 => 0 ,
'reciever_name'              => $name ,
'type'                       => $type,
'generated_at'               => time(),
'relation'                   => $relation,
'remark'                     =>  $comment,
'created_by'                     =>  $user_id,
'created_at'                     =>  time()
];

$query = $this->db->insert('cms_delivery_status', $data);
if($query){

include_once('sendsms.php');
$cid =     $cons_no;
$mobile  =  $receiver_phone;
$msg = $otp ;
$uname = $name;



$message="Dear ".$uname.", please share the OTP ".$otp." for Order No ".$cid."  with Our representitive  to confirm the receiving order -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');
return true;
}

}



public function save_otp_others($cons_no, $phone, $ship_name, $type, $receiver_pincode,$id_type,$id_number, $r_add, $name, $receiver_phone, $relation, $status, $referredByCode, $comment )
{

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];

//$identity_id = $this->input->post('identity_id');
$this->load->helper('string'); //load string helper
$otp  = random_string('numeric',5);
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
if($getvouchers -> num_rows() > 0)
{
for($i= 0; $getvouchers -> num_rows() > 0; $i++){
$otp  = strtoupper(random_string());
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
}
}

$data = [

'cid'                        => $cons_no,
'reciever_phn'               => $receiver_phone,
'shipper_phn'                => $phone,
'otp'                        =>  $otp,
'generated_by'               => $user_id,
'owner_name'                 => 0 ,
'reciever_name'              => $name ,
'type'                       => $type,
'id_no'                      => $id_number,
'id_type'                    => $id_type,
//  'status'                     => $this->input->post('status'),
'generated_at'               => time(),
'relation'                   => $relation,
'remark'                     =>  $comment,
'created_by'                     =>  $user_id,
'created_at'                     =>  time()

];

$query = $this->db->insert('cms_delivery_status', $data);
if($query){
include_once('sendsms.php');
$cid =     $cons_no;
$mobile  =  $receiver_phone;
$msg = $otp ;
$uname = $name;



$message="Dear ".$uname.", please share the OTP ".$otp." for Order No ".$cid."  with Our representitive  to confirm the receiving order -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');

return true;
}


}



public function pendingListCount(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
$query = $this->db->count_all_results('cms_courier');
}
 else{
$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
}
return $query;
}

public function pendingList($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier',['status' => "18"]);
}}
else{
	if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier',['status' => "18",'created_by' => $user_id]);
}
	
}
return $query;
}


public function dpendingListCount(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
$query = $this->db->count_all_results('cms_courier');
}
 else {
$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
}
return $query;
}


public function dpendingList($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get('cms_courier');
}}else{
	if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['created_by' => $user_id]);
}
	
}
return $query;
}

public function cpendingListCount(){
$query = $this->db->count_all_results('cms_courier');

return $query;
}
public function cpendingList($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier',['status' => "15"]);
}}else{
	if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier',['status' => "15",'created_by' => $user_id]);
}
}
return $query;
}
public function shipmentCostListCount(){
$query = $this->db->count_all_results('cms_shipment_cost');

return $query;
}
public function shipmentCostList($limit = 0, $start = 0){


$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('cms_shipment_cost');


return $query;
}



public function pickup_assigned_shipment_ListCount(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
$query = $this->db->count_all_results('cms_courier');
} else {
$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
}
return $query;
}



public function pickup_assigned_shipment_D_List($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "8"]);
}}

else{
	if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "8",'created_by' => $user_id]);
}
}

return $query;
}




public function in_transit_shipment_ListCount(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
$query = $this->db->count_all_results('cms_courier');
} else {
$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
}
return $query;
}



public function in_transit_shipment_D_List($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "9"]);
}}
else{
	if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "9",'created_by' => $user_id]);
}
}

return $query;
}


public function pickup_successful_shipment_ListCount(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
$query = $this->db->count_all_results('cms_courier');
} else {
$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
}
return $query;
}



public function pickup_successful_shipment_D_List($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "150"]);
}}else{if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "150",'created_by' => $user_id]);
}}

return $query;
}


public function delivery_assigned_shipment_ListCount(){

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if ($rolename == '11' || $rolename == '27' ) {
$query = $this->db->count_all_results('cms_courier');
} else {
$query = $this->db->where('created_by', $user_id)->count_all_results('cms_courier');
}
return $query;
}



public function delivery_assigned_shipment_D_List($limit = 0, $start = 0){

$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentUser = singleDbTableRow($user_id)->role;
$rolename = singleDbTableRow($user_id)->rolename;
$email = singleDbTableRow($user_id)->email;
if($searchValue != '')
{
$table_name = "cms_courier";
$where_array = array('cons_no' => $searchValue );
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get_where('cms_courier', ['status' => "13"]);
}

return $query;
}









/*
Get state
*/
function state($country)
{
$where_array = array( 'country' => $country );
$table_name="pincode";
$query = $this->db->group_by('state')->order_by('state', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){
//$result = $query->result_array();
return $query;
}else{
return false;
}
}




function district($state)
{
$where_array = array( 'state' => $state );
$table_name="pincode";
$query = $this->db->group_by('district')->order_by('district', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){

return $query;
}else{
return false;
}
}

function location($district)
{
$where_array = array( 'district' => $district );
$table_name="pincode";
$query = $this->db->order_by('location', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){

return $query;
}else{
return false;
}
}


function pincode($location)
{
$where_array = array( 'location' => $location );
$table_name="pincode";
$query = $this->db->order_by('pincode', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){

return $query;
}else{
return false;
}
}

function area($location_id)
{
$where_array = array( 'location' => $location_id );
$table_name="area";
$query = $this->db->group_by('location')->where($where_array )->get($table_name);
if($query->num_rows() > 0){

return $query;
}else{
return false;
}
}

function address_type($address_type)
{
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$where_array = array( 'user_id' => $user_id, 'address_type' => $address_type );
$table_name="user_address";
$query = $this->db->where($where_array )->get($table_name);
if($query->num_rows() > 0){

return true;
}else{
return false;
}
}


public function add_receiver(){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
//set all data for inserting into database
$data = [


'cons_no'                => $this->input->post('cons_no'),
'ship_name'                => $this->input->post('ship_name'),
'name'                => $this->input->post('name'),
'receiver_phone'              => $this->input->post('receiver_phone'),
'relation'                => $this->input->post('relation'),
'id_type'                => $this->input->post('id_type'),
'id_number'                => $this->input->post('id_number'),

'created_by'             => $user_id,
'created_at'             => time(),


];
$query = $this->db->insert('cms_add_receiver', $data);
if($query)
{

return true;
}
return false;
}



public function assign_delivery_executive($cid)
{
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];


		$c      = $this->input->post('consignment_no');
		$count  = count($c);
		$cid    = $this->input->post('consignment_no');

		//set all data for inserting into database
					$data = [
					'cid'                     => $cid,
					'dbid'                    => $this->input->post('delivery_boy'),
					'assigned_by'             => $user_id,
					'assigned_at'              => time()
					];
					
					$query = $this->db->insert('cms_deliver', $data);

					$data2 = [
					'status'      => '13',
					'assigned_to' => $this->input->post('delivery_boy')
					];

					
	
							$query2 = $this->db->where('cons_no', $cid)->update('cms_courier', $data2);
					
					
					
					$data3 = [
					'cons_no'                   => $cid,
					'current_pincode'           => $this->input->post('shipper_pincode'),
					'receiver_pincode'          => $this->input->post('receiver_pincode'),
					'current_location'          => $this->input->post('s_add'),
					'receiver_location'         => $this->input->post('r_add'),
					'status'                    => '13',
					'comments'                  => 'Out For Delivery',
					'done_by'                   => $user_id,
					'modified_at'               => time()
					];
					$query3 = $this->db->insert('cms_courier_status', $data3);
					

					
					
					
					

						$dbid = $this->input->post('delivery_boy');
						$get = $this->db->get_where('users', ['id' => $dbid]);
						foreach($get->result() as $d){
								$delivery_boy_phone = $d->contactno;
								$delivery_boy_name = $d->first_name.'  '.$d->last_name ;
						}




		if ($query && $query2 && $query3) {

		include_once('sendsms.php');


		$mobile  =  $delivery_boy_phone;
		$cnt = $count ;
		$uname = $delivery_boy_name;



		$message="Dear ".$uname.", ".$cnt." couriers assigned to you .  Please Collect Your couriers  -Team Cfirst";
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
		$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');




		
		return true;
		}
		return false;
}

//Anuja----------------------------------------------------------------------------------------------------------------------------------------------

 public function add_cms_role_payment()
    {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $data = [
			'transport_type'    => $this->input->post('transport_type'),
			'business_groups'	=> $this->input->post('business_group'),
			'cms_type'         	=> $this->input->post('cms_type'),
			'delivery_type'     => $this->input->post('delivery_type'),
			'status'     => $this->input->post('status'),
			'parcel_type'       => $this->input->post('parcel_type'),
			'min_quantity'  	=> $this->input->post('min_quantity'),
			'max_quantity'      => $this->input->post('max_quantity'),
			'min_km'         	=> $this->input->post('min_km'),
			'max_km'      		=> $this->input->post('max_km'),
			'vehicle_type'      => $this->input->post('vehicle_type'),
            'to_role'        	=> $this->input->post('to_role'),
			'from_role'     	=> $this->input->post('from_role'),
			'min_kg'         	=> $this->input->post('min_kg'),
			'max_kg'         	=> $this->input->post('max_kg'),
			'shipment_cost'  	=> $this->input->post('shipment_cost'),
		//	'max_cost'  	=> $this->input->post('max_cost'),
		    'min_volume'         	=> $this->input->post('min_volume'),
			'max_volume'         	=> $this->input->post('max_volume'),
            'created_at'     	=> time(),
            'created_by'     	=> $user_id
        ];
		$query = $this->db->insert('cms_role_payment', $data);
       if($query)
        {
            return true;
        }
        return false;
	}
	
public function cms_role_payment_ListCount($transport_type,$business_group,$cms_type,$parcel_type,$sf_time,$st_time) 
{
	    $user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($transport_type !='')
		{
			$condition.=" transport_type = '".$transport_type." '";
		}
		
		if($business_group !='')
		{
			if($condition != ""){
				$condition.=" AND business_groups = '".$business_group."'";
			}
			else{
				$condition.="business_groups = '".$business_group."'";
			}
		}
		
		if($cms_type !='')
		{
			if($condition != ""){
				$condition.=" AND cms_type = '".$cms_type."'";
			}
			else{
				$condition.="cms_type = '".$cms_type."'";
			}
		}
		
		if($parcel_type !='')
		{
			if($condition != ""){
				$condition.=" AND parcel_type = '".$parcel_type."'";
			}
			else{
				$condition.="parcel_type = '".$parcel_type."'";
			}
		}
			
		
	if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('cms_role_payment');
		}
		else
		{
			$query = $this->db->count_all_results('cms_role_payment'); 
		}
		return $query;
}
			
public function cms_role_payment_List($limit=10, $start=0,$transport_type,$business_group,$cms_type,$parcel_type,$sf_time,$st_time) 
{
	$user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($transport_type !='')
		{
			$condition.="transport_type = '".$transport_type." '";
		}
		
		if($business_group !='')
		{
			if($condition != ""){
				$condition.=" AND business_groups = '".$business_group."'";
			}
			else{
				$condition.="business_groups = '".$business_group."'";
			}
		}
		
		if($cms_type !='')
		{
			if($condition != ""){
				$condition.=" AND cms_type = '".$cms_type."'";
			}
			else{
				$condition.="cms_type = '".$cms_type."'";
			}
		}
		
		if($parcel_type !='')
		{
			if($condition != ""){
				$condition.=" AND parcel_type = '".$parcel_type."'";
			}
			else{
				$condition.="parcel_type = '".$parcel_type."'";
			}
		}
			
		
	if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->limit($limit, $start)->where($where_array )->get('cms_role_payment');
		}
		else
		{
			$query = $this->db->limit($limit, $start)->get('cms_role_payment');
		}
		return $query;
}

public function edit_cms_role_payment($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        
        $data = 
			[
		    'transport_type'    => $this->input->post('transport_type'),
			'business_groups'	=> $this->input->post('business_group'),
			'cms_type'         	=> $this->input->post('cms_type'),
			'delivery_type'         	=> $this->input->post('delivery_type'),
			'parcel_type'       => $this->input->post('parcel_type'),
			'min_quantity'  	=> $this->input->post('min_quantity'),
			'max_quantity'      => $this->input->post('max_quantity'),
			'min_km'         	=> $this->input->post('min_km'),
			'max_km'      		=> $this->input->post('max_km'),
			'vehicle_type'      => $this->input->post('vehicle_type'),
            'to_role'        	=> $this->input->post('to_role'),
			'from_role'     	=> $this->input->post('from_role'),
			'min_kg'         	=> $this->input->post('min_kg'),
			'max_kg'         	=> $this->input->post('max_kg'),
			'min_volume'         	=> $this->input->post('min_volume'),
			'max_volume'         	=> $this->input->post('max_volume'),
			'shipment_cost'  	=> $this->input->post('shipment_cost'),
			//			'max_cost'  	=> $this->input->post('max_cost'),
				'status'     => $this->input->post('status'),
            'modified_by'       => $user_id,
			'modified_at' 	    => time()
			];

        $query = $this->db->where('id', $id)->update('cms_role_payment', $data);

        if ($query) 
		{
            return true;
        }
        return false;
    }
	
	
	
	
	
	
	public function save_otpauth($cons_no, $phone, $ship_name)
{

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];

//$identity_id = $this->input->post('identity_id');
$this->load->helper('string'); //load string helper
$otp  = random_string('numeric',5);
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
if($getvouchers -> num_rows() > 0)
{
for($i= 0; $getvouchers -> num_rows() > 0; $i++){
$otp  = strtoupper(random_string());
$getvouchers = $this->db->get_where('cms_delivery_status', ['otp'=> $otp]);
}
}
$data = [

'cid'                       => $cons_no,
'shipper_phn'                => $phone,
'otp'                        =>  $otp,
'generated_by'               => $user_id,
'owner_name'                 => $ship_name,

'generated_at'               => time()
];

$query = $this->db->insert('cms_delivery_status', $data);
if($query){

include_once('sendsms.php');
$cid =     $cons_no;
$mobile  =  $phone;
$msg = $otp ;
			$query = $this->db->get_where('users', ['id' => $ship_name,]);
			if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$pm = $row->first_name." ".$row->last_name;
			}
			} else {
				$pm =  " ";
			}

$uname = $pm;



$message="Dear ".$uname.", please share the OTP ".$otp." for Order No ".$cid."  with Our representitive  to confirm the receiving order -Team Cfirst";
$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');
return true;
}

}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}