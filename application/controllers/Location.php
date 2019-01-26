<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Location extends CI_Controller {
function __construct(){
parent:: __construct();
$this->load->model('Location_model');
check_auth(); //check is logged in.
}





public function getcountry()
{
$countryid = $_POST['countryid'];
$sql="select * from countries where id='$country_nameid'";
$query = $this->db->query($sql);
$state = $query->result();
$data = '<option value=""> Choose option </option>';
foreach($state as $dt)
{
$data.="<option value=".$dt->id.">".$dt->statename."</option>";
}
echo $data;
}










public function getdistrict()
{
$districtid = $_POST['districtid'];
$sql="select * from district where id='$districtnameid'";
$query = $this->db->query($sql);
$state = $query->result();
$data = '<option value=""> Choose option </option>';
foreach($district as $dt)
{
$data.="<option value=".$dt->id.">".$dt->districtname."</option>";
}
echo $data;
}













public function add_locationid(){
//restricted this area, only for admin
permittedArea();
$data['country'] = $this->db->group_by('country')->get('pincode');
$data['taluk'] = $this->db->group_by('taluk')->get('pincode');
if($this->input->post())
{
if($this->input->post('submit') != 'add_locationid') die('Error! sorry');
$this->form_validation->set_rules('location', 'Location', 'required|trim|is_unique[location_id.location]');
if($this->form_validation->run() == true)
{
$insert = $this->Location_model->add_locationid();
if($insert)
{
$this->session->set_flashdata('successMsg', 'Location Created Success');
redirect(base_url('location/all_locationid'));
}
}
}


theme('add_locationid',$data);
}



public function locationidListJson(){
$limit = $this->input->get('length');
$start = $this->input->get('start');
$queryCount = $this->Location_model->locationidListCount();

$query = $this->Location_model->locationidList($limit, $start);
$draw = $this->input->get('draw');
$data = [];
$data['draw'] = $draw;
$data['recordsTotal'] = $queryCount;
$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) {
foreach($query->result() as $r){
//Action Button
$button = '';
$button .= '<a class="btn btn-primary editBtn"  href="'.base_url('location/view_locationid/'. $r->id).'" data-toggle="tooltip" title="View">
<i class="fa fa-eye"></i> </a>';
$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
<i class="fa fa-trash"></i> </a>';



$data['data'][] = array(
$button,
$r->id,
$r->location,
$r->taluk,
);
}
}
else{
$data['data'][] = array(
'You have no Data' , '', '','',''
);
}
echo json_encode($data);
}






public function all_locationid()
{
//restricted this area, only for admin
//permittedArea();
theme('all_locationid');
}

public function view_locationid($id){
//restricted this area, only for admin
//permittedArea();
$data['location_Details'] = $this->db->get_where('location_id', ['id' => $id]);

theme('view_locationid', $data);
}

public function edit_locationid($id){
//restricted this area, only for admin
//permittedArea();
$data['location_id'] = singleDbTableRow($id,'location_id');

$data['country'] = $this->db->group_by('country')->get('pincode');

$data['taluk'] = $this->db->get('pincode');

if($this->input->post())
{
if($this->input->post('submit') != 'edit_locationid') die('Error! sorry');
$this->form_validation->set_rules('location', 'Location', 'required|trim|is_unique[location_id.location]');

if($this->form_validation->run() == true)
{
$insert = $this->Location_model->edit_locationid($id);
if($insert)
{
$this->session->set_flashdata('successMsg', 'Area Location Updated Successfully...!!!');
redirect(base_url('location/all_locationid'));
}
}
}
theme('edit_locationid', $data);
}

public function deleteAjax6(){
$id = $this->input->post('id');
//get deleted user info
$userInfo = singleDbTableRow($id,'location_id');
$categoryName = $userInfo->name;
// add a activity
create_activity("Deleted {$categoryName} Location");
//Now delete permanently
$this->db->where('id', $id)->delete('location_id');
return true;
}


public function add_area(){
//restricted this area, only for admin
//permittedArea();
$data['country'] = $this->db->group_by('country')->get('pincode');
$data['location'] = $this->db->get('location_id');
$data['business_name'] = $this->db->get('business_groups');
$data['pincode'] = $this->db->group_by('pincode')->where('state','KARNATAKA')->get('pincode');
if($this->input->post())
{
if($this->input->post('submit') != 'add_area') die('Error! sorry');

//  $this->form_validation->set_rules('pincode', 'Pincode ', 'required|trim');
$this->form_validation->set_rules('location', 'Area Location ', 'required|trim');
//  $this->form_validation->set_rules('business_category', 'Business Category ', 'required|trim');
if($this->form_validation->run() == true)
{
$insert = $this->Location_model->add_area();
if($insert)
{
$this->session->set_flashdata('successMsg', 'Area Location Created Successfully');
redirect(base_url('location/all_area'));
}
else{
$this->session->set_flashdata('errorMsg', 'Area Location Already Added');
redirect(base_url('location/all_area'));
}
}
}


theme('add_area',$data);
}


public function all_area()
{
//restricted this area, only for admin
//permittedArea();
theme('all_area');
}
public function areaListJson(){
$limit = $this->input->get('length');
$start = $this->input->get('start');
$queryCount = $this->Location_model->areaListCount();

$query = $this->Location_model->areaList($limit, $start);
$draw = $this->input->get('draw');
$data = [];
$data['draw'] = $draw;
$data['recordsTotal'] = $queryCount;
$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) {
foreach($query->result() as $r){


$business_group_id = $r->location;

$table_name = 'location_id';
$where_array = array('id' => $business_group_id);
$query3 = $this->db->where($where_array)->get($table_name);
foreach($query3->result() as $r3)
{
$business_groups_name = $r3->location;
}

//Action Button
$button = '';
$button .= '<a class="btn btn-primary editBtn" href="'.base_url('location/view_area/'. $r->id).'" data-toggle="tooltip" title="View">
<i class="fa fa-eye"></i> </a>';
/*$button .= '<a class="btn btn-info editBtn"  href="'.base_url('add_shipment/edit_shipment/'. $r->id).'" data-toggle="tooltip" title="Edit">
<i class="fa fa-edit"></i> </a>';*/
$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
<i class="fa fa-trash"></i> </a>';

$pincode="";
if($r->pincode!=""){
$pincode_name = explode("," , $r->pincode);
foreach($pincode_name as $pincode_id){

//$query = $this->db->get_where('pincode', ['id'=>$pincode_id]);
//  foreach($query->result() as $d)
//  {
$pincode.= $pincode_id.", ";
//  }
}
}
else{
$pincode = "";
}

$query2 = $this->db->get_where('business_groups', ['id' => $r->business_name,]);
if ($query2->num_rows() > 0) {
foreach ($query2->result() as $row2) {
$business_name = $row2->business_name;
}
} else {
$business_name =  " ";
}


$data['data'][] = array(
$button,
$r->id,
$r3->location,
$business_name,
$pincode


);
}
}
else{
$data['data'][] = array(
'You have no Data' , '', '','',''
);
}
echo json_encode($data);
}

public function view_area($id){
//restricted this area, only for admin
//permittedArea();
$data['area_Details'] = $this->db->get_where('area', ['id' => $id]);

/*$data['shipment_Details'] = $this->db->query("select * fromshipment.*, count(rerreral.id) as referralCount
from shipment LEFT JOIN
shipment as rerreral on shipment.referral_code = rerreral.referredByCode
where shipment.id = {$id}");*/
theme('view_area', $data);
}

public function edit_area($id){
//restricted this area, only for admin
//permittedArea();
$data['area'] = singleDbTableRow($id,'area');
$data['country'] = $this->db->group_by('country')->get('pincode');
$data['location'] = $this->db->get('location_id');
$data['business_name'] = $this->db->get('business_groups');
$data['pincode'] = $this->db->group_by('pincode')->where('state','KARNATAKA')->get('pincode');
if($this->input->post())
{
if($this->input->post('submit') != 'edit_area') die('Error! sorry');
$this->form_validation->set_rules('pincode', 'Pincode ', 'trim');

if($this->form_validation->run() == true)
{
$insert = $this->Location_model->edit_area($id);
if($insert)
{
$this->session->set_flashdata('successMsg', 'Area Pincode Updated Successfully...!!!');
redirect(base_url('location/all_area'));
}
}
}
theme('edit_area', $data);
}

public function deleteAjax7(){
$id = $this->input->post('id');
//get deleted user info
$userInfo = singleDbTableRow($id,'area');
$categoryName = $userInfo->name;
// add a activity
create_activity("Deleted {$categoryName} Area");
//Now delete permanently
$this->db->where('id', $id)->delete('area');
return true;
}



public function add_pincode(){
//restricted this area, only for admin
//permittedArea();
$data['country'] = $this->db->group_by('country')->get('pincode');
$data['location'] = $this->db->get('location_id');
$data['business_name'] = $this->db->get('business_groups');
$data['pincode'] = $this->db->group_by('pincode')->where('state','KARNATAKA')->get('pincode');
if($this->input->post())
{
if($this->input->post('submit') != 'add_pincode') die('Error! sorry');

$this->form_validation->set_rules('country', 'Country ', 'required|trim|strtoupper');
$this->form_validation->set_rules('state', 'State ', 'required|trim|strtoupper');
//$this->form_validation->set_rules('postal_region', 'Postal Region ', 'required|trim|strtoupper');
//$this->form_validation->set_rules('postal_division', 'Postal Division ', 'required|trim|strtoupper');
$this->form_validation->set_rules('district', 'District ', 'required|trim|strtoupper');
$this->form_validation->set_rules('taluk', 'Taluk ', 'required|trim|strtoupper');
$this->form_validation->set_rules('location', 'Location ', 'required|trim|strtoupper');
$this->form_validation->set_rules('pincode', 'Pincode ', 'required|trim|strtoupper');




if($this->form_validation->run() == true)
{
$insert = $this->Location_model->add_pincode();
if($insert)
{
$this->session->set_flashdata('successMsg', 'Pincode Created Successfully');
redirect(base_url('location/all_pincodes'));
}
else{
$this->session->set_flashdata('errorMsg', 'Pincode Already Added');
redirect(base_url('location/all_pincodes'));
}
}
}


theme('add_pincode',$data);
}
public function all_pincodes()
{
//restricted this area, only for admin
permittedArea();
theme('all_pincodes');
}

public function pincodeListJson(){
$limit = $this->input->get('length');
$start = $this->input->get('start');
$queryCount = $this->Location_model->pincodeidListCount();

$query = $this->Location_model->pincodeidList($limit, $start);
$draw = $this->input->get('draw');
$data = [];
$data['draw'] = $draw;
$data['recordsTotal'] = $queryCount;
$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) {
foreach($query->result() as $r){
//Action Button
$button = '';
$button .= '<a class="btn btn-primary editBtn"  href="'.base_url('location/view_pincode/'. $r->id).'" data-toggle="tooltip" title="View">
<i class="fa fa-eye"></i> </a>';
$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
<i class="fa fa-trash"></i> </a>';



$data['data'][] = array(
$button,
$r->pincode,
$r->location,
$r->taluk,
$r->district,
$r->state,
$r->country,
);
}
}
else{
$data['data'][] = array(
'You have no Data' , '', '','',''
);
}
echo json_encode($data);
}

public function view_pincode($id){
//restricted this area, only for admin
permittedArea();
$data['pincode'] = $this->db->get_where('pincode', ['id' => $id]);

/*$data['shipment_Details'] = $this->db->query("select * fromshipment.*, count(rerreral.id) as referralCount
from shipment LEFT JOIN
shipment as rerreral on shipment.referral_code = rerreral.referredByCode
where shipment.id = {$id}");*/
theme('view_pincode', $data);
}
public function edit_pincode($id){
//restricted this area, only for admin
permittedArea();
$data['pincode'] = singleDbTableRow($id,'pincode');
if($this->input->post())
{
if($this->input->post('submit') != 'edit_pincode') die('Error! sorry');
$this->form_validation->set_rules('country', 'Country ', 'required|trim|strtoupper');
$this->form_validation->set_rules('state', 'State ', 'required|trim|strtoupper');
//$this->form_validation->set_rules('postal_region', 'Postal Region ', 'required|trim|strtoupper');
//$this->form_validation->set_rules('postal_division', 'Postal Division ', 'required|trim|strtoupper');
$this->form_validation->set_rules('district', 'District ', 'required|trim|strtoupper');
$this->form_validation->set_rules('taluk', 'Taluk ', 'required|trim|strtoupper');
$this->form_validation->set_rules('location', 'Location ', 'required|trim|strtoupper');
$this->form_validation->set_rules('pincode', 'Pincode ', 'required|trim|strtoupper');

if($this->form_validation->run() == true)
{
$insert = $this->Location_model->edit_pincode($id);
if($insert)
{
$this->session->set_flashdata('successMsg', 'Pincode Updated Successfully...!!!');
redirect(base_url('location/all_pincodes'));
}
}
}
theme('edit_pincode', $data);
}

public function deleteAjaxPincode(){
$id = $this->input->post('id');
//get deleted user info
$userInfo = singleDbTableRow($id,'pincode');
$categoryName = $userInfo->name;
// add a activity
create_activity("Deleted {$categoryName} Pincode");
//Now delete permanently
$this->db->where('id', $id)->delete('pincode');
return true;
}

























public function get_district()
{
$state=$_POST['state'];

$query = $this->Location_model->district($state);
echo "<option value=''>-Select-</option>";
foreach($query->result() as $r)
{
echo "<option value='".$r->id."'>".$r->districtname."</option>";
}
}




















public function getstate()
{
$country=$_POST['country'];
echo $country;
$query = $this->Location_model->state($country);
echo "<option value=''>-Select-</option>";
foreach($query->result() as $r)
{
echo "<option value='".$r->state."'>".$r->state."</option>";
}
}
public function get_districts()
{
$state=$_POST['state'];

$query = $this->Location_model->districts($state);
echo "<option value=''>-Select-</option>";
foreach($query->result() as $r)
{
echo "<option value='".$r->district."'>".$r->district."</option>";
}
}

public function get_taluk()
{
$district=$_POST['district'];

$query = $this->Location_model->taluk($district);
echo "<option value=''>-Select-</option>";
foreach($query->result() as $r)
{
echo "<option value='".$r->taluk."'>".$r->taluk."</option>";
}
}



public function get_pincode()
{
$taluk=$_POST['taluk'];

$query = $this->Location_model->pincode($taluk);
echo "<option value=''>-Select-</option>";
foreach($query->result() as $r)
{
echo "<option value='".$r->pincode."'>".$r->pincode."--".$r->location."</option>";
}
}


public function get_area()
{
$location_id=$_POST['location_id'];
// echo $categ;
$pincode = $this->Location_model->area($location_id);


if($pincode->num_rows() > 0)
{
foreach($pincode->result() as $c){
$pincode_name = explode("," , $c->pincode);
foreach($pincode_name as $pincode_id){
//$query = $this->db->group_by('pincode')->get_where('pincode', ['pincode'=>$pincode_id]);
$query = $this->db->group_by('pincode')->get_where('pincode', ['pincode'=>$pincode_id]);
foreach($query->result() as $d)
{
echo "<option value='".$pincode_id."' selected>".$d->pincode."-".$d->location."-".$d->state."-".$d->state."</option>";
}
}
}
}
else{
echo "<option value=''>Select option</option>";
}
}


}