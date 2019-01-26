<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Star_ratings_model extends CI_Model {
public function star_ratings()
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 $data = [
			'business_id' => $this->input->post('business_groups'),
			'source' => $this->input->post('source'),
			'rate_by'	  => $user_id,
			'star' 		  => $this->input->post('ratings'),
			'status'	  => 1,
			'comment'     => $this->input->post('comment'),
			'created_at'  => time(),
			'created_by'  => $user_id
        ];
		$query = $this->db->insert('ratings', $data);
       if($query)
        {
            return true;
        }
        return false;
    }
	
	
	public function star_ratings1()
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 $data = [
			'business_id' => 0,
			'rate_by'	  => $user_id,
			'status'	  => 0,
			'created_at'  => time(),
			'created_by'  => $user_id
        ];
		$query = $this->db->insert('ratings', $data);
       if($query)
        {
            return true;
        }
        return false;
    }
public function star_ratings_ListCount($star,$business_name,$sf_time,$st_time) 
{
	    $user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$search = $this->input->get('search');	
		$currentUser = singleDbTableRow($user_id)->role;
		
		$condition="";
		if($star !='')
		{
			$condition.=" star = '".$star." '";
		}
		if($business_name !='')
		{
			if($condition != ""){
				$condition.=" AND business_id = '".$business_name."'";
			}
			else{
				$condition.="business_id = '".$business_name."'";
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
		if($currentUser=='admin')
		{			
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('ratings');
		}
		else
		{
			$query = $this->db->count_all_results('ratings'); 
		}
		}
		else
		{
			if($condition !='')
			{
				$where_array= $condition;
				$where_array= $where_array."AND created_by = '".$user_id."'";
				$query = $this->db->where($where_array)->count_all_results('ratings');
			}else
			{
			$where = array('created_by' => $user_id);
			$query = $this->db->where($where)->count_all_results('ratings');
			}
		}
		
		return $query;
}
			
public function star_ratings_List($limit,$start,$star,$business_name,$sf_time,$st_time) 
{
	    $user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$search = $this->input->get('search');	
		$currentUser = singleDbTableRow($user_id)->role;
		
		$condition="";
		if($star !='')
		{
			$condition.=" star = '".$star." '";
		}
		if($business_name !='')
		{
			if($condition != ""){
				$condition.=" AND business_id = '".$business_name."'";
			}
			else{
				$condition.="business_id = '".$business_name."'";
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
		if($currentUser=='admin')
		{			
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->limit($limit, $start)->where($where_array )->get('ratings');
		}
		else
		{
			$query = $this->db->limit($limit, $start)->get('ratings');
		}
		}
		else
		{
			if($condition !='')
			{
			$where_array= $condition;
			$where_array= $where_array."AND created_by = '".$user_id."'";
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('ratings');
			}else
			{
			$where = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where)->get('ratings');
			}			
		}
		return $query;
}
public function edit_star_ratings($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        if($this->input->post('star'))
			{
				$status == 1;
			}
		else
			{
				$status == 0;
			}
        $data = 
			[
		    'star'           => $this->input->post('star'),
			'comment'	     => $this->input->post('comment'),
			'status'		 => $status,
            'modified_by'    => $user_id,
			'modified_at' 	 => time()
			];

        $query = $this->db->where('id', $id)->update('ratings', $data);

        if ($query) 
		{
            return true;
        }
        return false;
    }
}
?>
