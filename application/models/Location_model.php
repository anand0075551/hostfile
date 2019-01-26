<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Location_model extends CI_Model {
public function add_locationid(){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
//set all data for inserting into database
$data = [
'location'              => $this->input->post('location'),
'taluk'                 => $this->input->post('taluk'),
'created_by'             => $user_id,
'created_at'             => time(),
];
$query = $this->db->insert('location_id', $data);
if($query)
{
create_activity('Added '.$data['name'].' location_id'); //create an activity
return true;
}
return false;
}
public function locationidListCount(){
$query = $this->db->count_all_results('location_id');
return $query;
}
public function locationidList($limit = 0, $start = 0){
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
$table_name = "location_id";
$where_array = array('location' => $searchValue );
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('location_id');
}
return $query;
}
public function edit_locationid($id){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
//set all data for inserting into database
$data = [
'location'           => $this->input->post('location'),
//  'taluk'                 => $this->input->post('taluk'),
'modified_by'           => $user_id,
'modified_at'           => time()
];
$query = $this->db->where('id', $id)->update('location_id', $data);
if($query)
{
create_activity('Updated '.$data['name'].' location_id'); //create an activity
return true;
}
return false;
}
public function check_area($location,$business_id){
$table_name = "area";
$where_array = array('location' => $location,'business_name' => $business_id );

$query = $this->db->where($where_array )->get($table_name);
if($query->num_rows()>0)
{
return true;
}
else
{
return false;}
}
public function add_area(){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$location_area  = implode("," ,$this->input->post('location_area'));
$location               =  $this->input->post('location');
$business_id                =  $this->input->post('business_name');
$type               =  $this->input->post('type');
$check_area = $this->check_area($location,$business_id);
if($check_area)
{
return false;
}
else
{
//set all data for inserting into database
$data = [
'location'              =>  $this->input->post('location'),
'pincode'               =>  $location_area,
'business_name'             =>  $this->input->post('business_name'),
'type'              =>  $type,
'created_by'             => $user_id,
'created_at'             => time(),
];
$query = $this->db->insert('area', $data);
if($query)
{
create_activity('Added '.$data['location'].' area'); //create an activity
return true;
}
return false; }
}
public function areaListCount(){
$query = $this->db->count_all_results('area');
return $query;
}
public function areaList($limit = 0, $start = 0){
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
$table_name = "area";
$where_array = array('pincode' => $searchValue );
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('area');
}
return $query;
}
public function groupedListCount(){
$query = $this->db->count_all_results('area');
return $query;
}
public function groupedList($limit = 0, $start = 0){
$search = $this->input->get('search');
$searchValue = $search['value'];
$searchByID = '';
//Get Decision who in online?
if($searchValue != '')
{
$where_array = array('pincode'=> $searchValue);
$table = "area";
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('area');
}
else{
$query = $this->db->order_by('id', 'desc')->group_by('location')->limit($limit, $start)->get('area');
}
return $query;
}
public function edit_area($id){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$location_area  = implode("," ,$this->input->post('location_area'));
//set all data for inserting into database
$data = [
'pincode'            => $location_area,
'business_name'      =>  $this->input->post('business_name'),
'type'      =>  $this->input->post('type'),
'modified_by'        => $user_id,
'modified_at'        => time()
];
$query = $this->db->where('id', $id)->update('area', $data);
if($query)
{
create_activity('Updated '.$data['pincode'].' area'); //create an activity
return true;
}
return false;
}
function district($state)
{
$where_array = array( 'statename' => $state );
$table_name="district";
$query = $this->db->order_by('districtname', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){
//$result = $query->result_array();
return $query;
}else{
return false;
}
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
function districts($state)
{
$where_array = array( 'state' => $state );
$table_name="pincode";
$query = $this->db->group_by('district')->order_by('district', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){
//$result = $query->result_array();
return $query;
}else{
return false;
}
}
function taluk($district)
{
$where_array = array( 'district' => $district );
$table_name="pincode";
$query = $this->db->group_by('taluk')->order_by('taluk', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){
//$result = $query->result_array();
return $query;
}else{
return false;
}
}
function pincode($taluk)
{
$where_array = array( 'taluk' => $taluk );
$table_name="pincode";
$query = $this->db->order_by('pincode', 'asc')->where($where_array )->get($table_name);
if($query->num_rows() > 0){
//$result = $query->result_array();
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
//$result = $query->result_array();
return $query;
}else{
return false;
}
}
public function add_pincode(){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
//set all data for inserting into database
$data = [
'country'              => $this->input->post('country'),
'state'                 => $this->input->post('state'),
'postal_region'                 => $this->input->post('postal_region'),
'postal_division'                 => $this->input->post('postal_division'),
'district'                 => $this->input->post('district'),
'taluk'                 => $this->input->post('taluk'),
'location'                 => $this->input->post('location'),
'pincode'                 => $this->input->post('pincode'),
'created_by'             => $user_id,
'created_at'             => time(),
];
$query = $this->db->insert('pincode', $data);
if($query)
{
create_activity('Added '.$data['location'].' pincode'); //create an activity
return true;
}
return false;
}
public function pincodeidListCount(){
$query = $this->db->count_all_results('pincode');
return $query;
}
public function pincodeidList($limit = 0, $start = 0){
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
$table_name = "pincode";
$where_array = array('pincode' => $searchValue );
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
}
else{
$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('pincode');
}
return $query;
}
public function edit_pincode($id){
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
//set all data for inserting into database
$data = [
'country'              => $this->input->post('country'),
'state'                 => $this->input->post('state'),
'postal_region'                 => $this->input->post('postal_region'),
'postal_division'                 => $this->input->post('postal_division'),
'district'                 => $this->input->post('district'),
'taluk'                 => $this->input->post('taluk'),
'location'                 => $this->input->post('location'),
'pincode'                 => $this->input->post('pincode'),
'modified_by'             => $user_id,
'modified_at'             => time(),
];
$query = $this->db->where('id', $id)->update('pincode', $data);
if($query)
{
create_activity('Updated '.$data['pincode'].' pincode'); //create an activity
return true;
}
return false;
}
}