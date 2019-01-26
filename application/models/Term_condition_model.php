<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Term_condition_model extends CI_Model 
{
	public function term_condition_upload()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		/*generationg unique ID*/
		$role = $this->input->post('role');
		$role_name = singleDbTableRow($role, 'role')->rolename;
		$count = $this->db->count_all_results('term_condition');
		$tm_count = $count+1;
		$term_ID = strtoupper(substr($role_name,0,3)).$tm_count;
		/*ends*/
		
		$data = [
			'term_ID'             =>$term_ID,
			'file_name'           => $this->input->post('fname'),
			'otp'                => $this->input->post('otp'),
			'role'                => $this->input->post('role'),
			'valid_from'          => $this->input->post('valid_from'),
			'valid_to'            => $this->input->post('valid_to'),
			'file_data'           =>  $this->input->post('userfile'),
			'status'              =>  $this->input->post('status'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('term_condition', $data);
			$query2 = $this->db->insert('term_condition_track', $data);
			if($query)
        	{
				/* adding labels into term_condition_labels table*/
			if(!empty($_POST['dlabels'])) 
			{
				foreach($_POST['dlabels'] as $cnt => $label) 
				{
					$t_field = $_POST['dfields'][$cnt];
					$data2 = [
								'term_ID'             => $term_ID,
								't_label'             => $label,
								't_field'             => $t_field,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query2 = $this->db->insert('term_condition_labels', $data2);
					
				}
			}
				 return true;
			}
			else
			{
				 return false;
			}
	}
	/*List*/
	public function ListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		$query = $this->db->count_all_results('term_condition');
		return $query;
	}
	public function term_condition_list($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
		if($searchValue != '')																							
		{																												
			$table_name = "term_condition";	
			$where_array = " file_name like '%".$searchValue."%'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('term_condition');
		}
	
	return $query;
	}
	/*/.List*/
	/*Edit*/
	public function term_condition_edit($id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = $this->input->post('role');
		$term_ID = singleDbTableRow($id, 'term_condition')->term_ID;
		
		$data = [
			'file_name'           => $this->input->post('fname'),
			'otp'                => $this->input->post('otp'),
			'role'                => $this->input->post('role'),
			'valid_from'          => $this->input->post('valid_from'),
			'valid_to'            => $this->input->post('valid_to'),
			'file_data'           =>  $this->input->post('userfile'),
			'status'              =>  $this->input->post('status'),
			'modified_by'    	  => $user_id,
			'modified_at'    	  => time()
			];
			$query = $this->db->where('id', $id)->update('term_condition', $data);
			if($query)
        	{
				/*set to unread*/
				$where_array2 = " role = ".$role." ";
				  $user_terms = $this->db->order_by('id', 'asc')->where($where_array2)->get('term_condition_user');
				  if($user_terms->num_rows() >0)
				  {
					  $terms = [
								'terms_read'         	=> 0
								
							];
					$query7 = $this->db->where($where_array2)->update('term_condition_user', $terms);
					
				  }
				  /*inserting into track table*/
				  $data2 = [
				  		'term_ID'             =>$term_ID,
						'file_name'           => $this->input->post('fname'),
			             'otp'                => $this->input->post('otp'),
						'role'                => $this->input->post('role'),
						'valid_from'          => $this->input->post('valid_from'),
						'valid_to'            => $this->input->post('valid_to'),
						'file_data'           =>  $this->input->post('userfile'),
						'status'              =>  $this->input->post('status'),
						'created_by'    	  => $user_id,
						'created_at'    	  => time(),
						'modified_by'    	  => $user_id,
						'modified_at'    	  => time()
						];
						$query2 = $this->db->insert('term_condition_track', $data2);
						//
						/* adding labels into term_condition_labels table*/
						if(!empty($_POST['dlabels'])) 
						{
							//
							$where_array = " term_ID = '".$term_ID."' ";
							$query = $this->db->where($where_array )->count_all_results('term_condition_labels');
							if($query >0)
							{
								$this->db->where('term_ID', $term_ID)->delete('term_condition_labels');
							}
							//
							foreach($_POST['dlabels'] as $cnt => $label) 
							{
								$t_field = $_POST['dfields'][$cnt];
								$data2 = [
											'term_ID'             => $term_ID,
											't_label'             => $label,
											't_field'             => $t_field,
											'created_by'    	  => $user_id,
											'created_at'    	  => time()
										];
								$query2 = $this->db->insert('term_condition_labels', $data2);
								
							}
						}
						//
						
				 return true;
			}
			else
			{
				 return false;
			}
	}
	/*/.Edit*/
	/*Report*/
public function term_search_count($tc,$status,$role,$rsf_time,$rst_time,$ref_time,$ret_time,$otp)
	{
		if($rsf_time !='' && $rst_time !='')
		{
		$start_fdt = new DateTime($rsf_time);
		$regstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($rst_time);
		$regstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ref_time !='' && $ret_time !='')
		{
		$end_fdt = new DateTime($ref_time);
		$regend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($ret_time);
		$regend_to = $end_tdt->format('Y/m/d');
		}
		
		
		
		/* CONDITIONS */
		$condition="";
		
		if($tc !='')
		{
			$condition.="term_ID = '".$tc."'";
		}
		
		if($status !='')
		{
			$condition.=($condition !='' ) ?" AND status = ".$status."" : " status = ".$status."" ;
		}
		if($otp !='')
		{
			$condition.=($condition !='' ) ?" AND otp = ".$otp."" : " otp = ".$otp."" ;
		}
		if($role !='')
		{
			$condition.=($condition !='' ) ?" AND role = ".$role."" : " role = ".$role."" ;
		}
		
		if($rsf_time !='' && $rst_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(valid_from) BETWEEN '".$regstart_from."' AND '".$regstart_to."') " : " (DATE(valid_from) BETWEEN '".$regstart_from."' AND '".$regstart_to."')" ;
		}
		if($ref_time !='' && $ret_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(valid_to) BETWEEN '".$regend_from."' AND '".$regend_to."') " : " (DATE(valid_to) BETWEEN '".$regend_from."' AND '".$regend_to."')" ;
		}
		
		
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('term_condition');
		}
		else
		{
		$query = $this->db->count_all_results('term_condition');
		}
        
        return $query;
    }
	function term_report_search($limit, $start,$tc,$status,$role,$rsf_time,$rst_time,$ref_time,$ret_time,$otp)
    {
		$search = $this->input->POST('search');	
		$searchValue = $search['value'];
		
		$searchByID = '';
		
		if($rsf_time !='' && $rst_time !='')
		{
		$start_fdt = new DateTime($rsf_time);
		$regstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($rst_time);
		$regstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ref_time !='' && $ret_time !='')
		{
		$end_fdt = new DateTime($ref_time);
		$regend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($ret_time);
		$regend_to = $end_tdt->format('Y/m/d');
		}
		
		
		
		/* CONDITIONS */
		$condition="";
		
		if($tc !='')
		{
			$condition.="term_ID = '".$tc."'";
		}
		
		if($status !='')
		{
			$condition.=($condition !='' ) ?" AND status = ".$status."" : " status = ".$status."" ;
		}
		if($otp !='')
		{
			$condition.=($condition !='' ) ?" AND otp = ".$otp."" : " otp = ".$otp."" ;
		}
		if($role !='')
		{
			$condition.=($condition !='' ) ?" AND role = ".$role."" : " role = ".$role."" ;
		}
		
		if($rsf_time !='' && $rst_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(valid_from) BETWEEN '".$regstart_from."' AND '".$regstart_to."') " : " (DATE(valid_from) BETWEEN '".$regstart_from."' AND '".$regstart_to."')" ;
		}
		if($ref_time !='' && $ret_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(valid_to) BETWEEN '".$regend_from."' AND '".$regend_to."') " : " (DATE(valid_to) BETWEEN '".$regend_from."' AND '".$regend_to."')" ;
		}
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			if($searchValue != '')																							
			{																												
				$where_array = $where_array. " AND term_ID like '%".$searchValue."%' ";															
				
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('term_condition'); 	
			}											
			else
			{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('term_condition'); 
			}
		}
		else
		{
			if($searchValue != '')																							
			{																												
				$where_array = "  term_ID like '%".$searchValue."%' ";//array('event_no' => $searchValue );															
				
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('term_condition'); 	
			}											
			else
			{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('term_condition'); 
			}
		}
		
		
		
		
        return $query;
    }
	
//
public function Accepted_ListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		$where_array =" user_id = ".$user_id." AND role = ".$currentUser." AND terms_read =1 ";
		$query = $this->db->where($where_array )->count_all_results('term_condition_user_track');
		
		return $query;
	}
	public function accepted_list($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
		if($searchValue != '')																							
		{																												
			$table_name = "term_condition_user_track";	
			$where_array = " term_ID like '%".$searchValue."%' AND user_id = ".$user_id." AND role = ".$rolename." AND terms_read =1";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{		
		$table_name = "term_condition_user_track";	
			$where_array = " user_id = ".$user_id." AND role = ".$rolename." AND terms_read =1 ";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 								
			
		}
	
	return $query;
	}
//
}
?>