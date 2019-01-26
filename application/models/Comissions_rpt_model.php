	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comissions_rpt_model extends CI_Model 
	{

    /**
     * @return bool
     */
/* Edit Commissions*/
	
	   public function copy_commissions($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
        //set all data for inserting into database
        $data = [
			'identity' 		  => 'Commission',
			'start_date'      => $this->input->post('start_date'),
            'end_date'   	  => $this->input->post('end_date'),	
			
			'slr_ref_pm'	  => $this->input->post('slr_ref_pm'),
			'slr_ref_level1'  => $this->input->post('slr_ref_level1'),	
			'slr_ref_level2'  => $this->input->post('slr_ref_level2'),	
			'slr_ref_level3'  => $this->input->post('slr_ref_level3'),	
			'slr_ref_level4'  => $this->input->post('slr_ref_level4'),	
			'slr_ref_level5'  => $this->input->post('slr_ref_level5'),
			
			'clt_ref_pm'	  => $this->input->post('clt_ref_pm'),			
			'clt_ref_level1'  => $this->input->post('clt_ref_level1'),			
			'clt_ref_level2'  => $this->input->post('clt_ref_level2'),	
			'clt_ref_level3'  => $this->input->post('clt_ref_level3'),	
			'clt_ref_level4'  => $this->input->post('clt_ref_level4'),	
			'clt_ref_level5'  => $this->input->post('clt_ref_level5'),	
			
			'points_mode' 	  => $this->input->post('points_mode'),			
			'commission'      => $this->input->post('commission'),
			'benefits'    	  => $this->input->post('benefits'),
			
			'profit_pm' 	  => $this->input->post('profit_pm'),			
			'sender_profit'   => $this->input->post('sender_profit'),
			'receiver_profit' => $this->input->post('receiver_profit'),
			
			'deduction_pm' 	     => $this->input->post('deduction_pm'),			
			'sender_deduction'   => $this->input->post('sender_deduction'),
			'receiver_deduction' => $this->input->post('receiver_deduction'),
			
			'remarks'     	  => $this->input->post('remarks'),		
			'created_by'	  => $user_id,
            'created_at'      => time(),
			'modified_by'     => $user_id,
            'modified_at'     => time()	
			
        ];
			

        $query = $this->db->where('id', $id)->insert('commissions', $data);

        if($query)
        {
            create_activity('Updated '.$data['remarks'].' commissions'); //create an activity
            return true;
        }
        return false;

    }
	 
	
		/*************************Comissions Report***************************/
	
	public function search_comissions_listCount($acct_id,$sub_acct_id,$ded_paytype,$from_role,$to_role,$visible,$sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($acct_id !='')
		{	
			if($condition != ""){
			$condition.="acct_id = ".$acct_id." ";
			}
			else{
				$condition.="acct_id = '".$acct_id."'";
			}
		}
		
		if($sub_acct_id!='')
		{	
			if($condition != ""){
			$condition.=" AND sub_acct_id = ".$sub_acct_id." ";
			}
			else{
				$condition.="sub_acct_id = '".$sub_acct_id."'";
			}
		}
		
		if($from_role !='')
		{
			if($condition != ""){
				$condition.=" AND from_role = '".$from_role."'";
			}
			else{
				$condition.="from_role = '".$from_role."'";
			}
		}
		
		if($to_role !='')
		{
			if($condition != ""){
				$condition.=" AND to_role = '".$to_role."'";
			}
			else{
				$condition.="to_role = '".$to_role."'";
			}
		}
		
		if($visible !='')
		{
			if($condition != ""){
				$condition.=" AND visible = '".$visible."'";
			}
			else{
				$condition.="visible = '".$visible."'";
			}
		}
		
		if($ded_paytype !='')
		{
			if($condition != ""){
				$condition.=" AND ded_paytype = '".$ded_paytype."'";
			}
			else{
				$condition.="ded_paytype = '".$ded_paytype."'";
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
			$query = $this->db->where($where_array)->count_all_results('commissions');
			}
		
			else
			{
			$query = $this->db->count_all_results('commissions');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('commissions');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('commissions');
        }
        } 
		
        return $query;
		
    }

	
	public function search_comissions_list($limit=10, $start=0,$acct_id,$sub_acct_id,$ded_paytype,$from_role,$to_role,$visible,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($acct_id !='')
		{	
			if($condition != ""){
			$condition.="acct_id = ".$acct_id." ";
			}
			else{
				$condition.="acct_id = '".$acct_id."'";
			}
		}
		
		if($sub_acct_id!='')
		{	
			if($condition != ""){
			$condition.=" AND sub_acct_id = ".$sub_acct_id." ";
			}
			else{
				$condition.="sub_acct_id = '".$sub_acct_id."'";
			}
		}
		
		if($from_role !='')
		{
			if($condition != ""){
				$condition.=" AND from_role = '".$from_role."'";
			}
			else{
				$condition.="from_role = '".$from_role."'";
			}
		}
		
		if($to_role !='')
		{
			if($condition != ""){
				$condition.=" AND to_role = '".$to_role."'";
			}
			else{
				$condition.="to_role = '".$to_role."'";
			}
		}
		
		if($visible !='')
		{
			if($condition != ""){
				$condition.=" AND visible = '".$visible."'";
			}
			else{
				$condition.="visible = '".$visible."'";
			}
		}
		
		if($ded_paytype !='')
		{
			if($condition != ""){
				$condition.=" AND ded_paytype = '".$ded_paytype."'";
			}
			else{
				$condition.="ded_paytype = '".$ded_paytype."'";
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
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('commissions');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
        }
        } 
        return $query;
	}
	
		/*=====================*/
		
		public function get_comission_tot($acct_id,$sub_acct_id,$ded_paytype,$from_role,$to_role,$visible,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
	
		if($acct_id !='')
		{	
			if($condition != ""){
			$condition.="acct_id = ".$acct_id." ";
			}
			else{
				$condition.="acct_id = '".$acct_id."'";
			}
		}
		
		if($sub_acct_id!='')
		{	
			if($condition != ""){
			$condition.=" AND sub_acct_id = ".$sub_acct_id." ";
			}
			else{
				$condition.="sub_acct_id = '".$sub_acct_id."'";
			}
		}
		
		if($from_role !='')
		{
			if($condition != ""){
				$condition.=" AND from_role = '".$from_role."'";
			}
			else{
				$condition.="from_role = '".$from_role."'";
			}
		}
		
		if($to_role !='')
		{
			if($condition != ""){
				$condition.=" AND to_role = '".$to_role."'";
			}
			else{
				$condition.="to_role = '".$to_role."'";
			}
		}
		
		if($visible !='')
		{
			if($condition != ""){
				$condition.=" AND visible = '".$visible."'";
			}
			else{
				$condition.="visible = '".$visible."'";
			}
		}
		
		if($ded_paytype !='')
		{
			if($condition != ""){
				$condition.=" AND ded_paytype = '".$ded_paytype."'";
			}
			else{
				$condition.="ded_paytype = '".$ded_paytype."'";
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
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('commissions');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
        }
        } 
        return $query;
	}

	
	
}//last brace required