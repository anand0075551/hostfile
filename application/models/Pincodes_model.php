	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pincodes_model extends CI_Model 
	{

    /**
     * @return bool
     */

	 
	 // add pincode
	 
	  public function add_pincode() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
//set all data for inserting into database
        $data = [
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'postal_region' => $this->input->post('postal_region'),
            'postal_division' => $this->input->post('postal_division'),
            'district' => $this->input->post('district'),
            'taluk' => $this->input->post('taluk'),
            'location' => $this->input->post('location'),
            'pincode' => $this->input->post('pincode'),
            'created_by' => $user_id,
            'created_at' => time(),
        ];
        $query = $this->db->insert('pincode', $data);
        if ($query) {
            create_activity('Added ' . $data['name'] . ' pincode'); //create an activity
            return true;
        }
        return false;
    }
	 
	 //
// coppy function

  public function copy_pincodes() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
//set all data for inserting into database
        $data = [
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'postal_region' => $this->input->post('postal_region'),
            'postal_division' => $this->input->post('postal_division'),
            'district' => $this->input->post('district'),
            'taluk' => $this->input->post('taluk'),
            'location' => $this->input->post('location'),
            'pincode' => $this->input->post('pincode'),
            'created_by' => $user_id,
            'created_at' => time(),
        ];
        $query = $this->db->insert('pincode', $data);
        if ($query) {
            create_activity('Added ' . $data['name'] . ' pincode'); //create an activity
            return true;
        }
        return false;
    }

//
	
	public function search_pincodes_ListCount($pincode,$location_id,$taluk,$district,$state,$sf_time,$st_time)
	{
		
		/*$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;*/
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($pincode !='')
		{	
			if($condition != ""){
			$condition.="pincode = ".$pincode." ";
			}
			else{
				$condition.="pincode = '".$pincode."'";
			}
		}
		
		
		if($taluk !='')
		{
			if($condition != ""){
				$condition.=" AND taluk = '".$taluk."'";
			}
			else{
				$condition.="taluk = '".$taluk."'";
			}
		}
		
			if($location_id !='')
		{
			if($condition != ""){
				$condition.=" AND location = '".$location_id."'";
			}
			else{
				$condition.="location = '".$location_id."'";
			}
		}
		
		if($district !='')
		{
			if($condition != ""){
				$condition.=" AND district = '".$district."'";
			}
			else{
				$condition.="district = '".$district."'";
			}
		}
		
		
		if($state !='')
		{
			if($condition != ""){
				$condition.=" AND state = '".$state."'";
			}
			else{
				$condition.="state = '".$state."'";
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
			$query = $this->db->where($where_array)->count_all_results('pincode');
		}
		else
		{
			$query = $this->db->count_all_results('pincode');
		}
		
        return $query;
	
	}
	
	public function search_pincode_List($limit=10, $start=0, $pincode,$location_id,$taluk,$district,$state,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		//$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		$search = $this->input->get('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
	$searchByID = '';
		$condition="";
		if($pincode !='')
		{	
			if($condition != ""){
			$condition.="pincode = ".$pincode." ";
			}
			else{
				$condition.="pincode = '".$pincode."'";
			}
		}
	
		if($taluk !='')
		{
			if($condition != ""){
				$condition.=" AND taluk = '".$taluk."'";
			}
			else{
				$condition.="taluk = '".$taluk."'";
			}
		}
		
		
			if($location_id !='')
		{
			if($condition != ""){
				$condition.=" AND location = '".$location_id."'";
			}
			else{
				$condition.="location = '".$location_id."'";
			}
		}
		
		if($district !='')
		{
			if($condition != ""){
				$condition.=" AND district = '".$district."'";
			}
			else{
				$condition.="district = '".$district."'";
			}
		}
		
		
		if($state !='')
		{
			if($condition != ""){
				$condition.=" AND state = '".$state."'";
			}
			else{
				$condition.="state = '".$state."'";
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
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('pincode');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('pincode');
		}
        return $query;
	
	}
	
		/*=====================*/
	
	 function district($state)
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
	
	function get_taluk($district)
    {
      $where_array = array( 'district' => $district );
      $table_name="pincode";
       $query = $this->db->order_by('location', 'asc')->group_by('taluk')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
		function location($district)
    {
      $where_array = array( 'taluk' => $district );
      $table_name="pincode";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
   function pincode($location)
    {
      $where_array = array( 'taluk' => $location );
      $table_name="pincode";
       $query = $this->db->order_by('pincode', 'asc')->group_by('pincode')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }	
}//last brace required