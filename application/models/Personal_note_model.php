<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_note_model extends CI_Model 
{
	/*create*/
	public function personal_note_create()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$data = [
			'p_date'              => $this->input->post('p_date'),
			'title'               => $this->input->post('title'),
			'description'         => $this->input->post('description'),
			'note1'               => $this->input->post('note1'),
			'note2'               => $this->input->post('note2'),
			'note3'               => $this->input->post('note3'),
			'note4'               => $this->input->post('note4'),
			'note5'               => $this->input->post('note5'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('personal_note', $data);
			if($query)
        	{
				 return true;
			}
			else
			{
				 return false;
			}
	}
	/*/.create*/
	/*List*/
	public function NoteListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 )
		{
			$query = $this->db->count_all_results('personal_note');
		}else
		{
			$where_array = " created_by = ".$user_id."  ";
			$query = $this->db->where($where_array )->count_all_results('personal_note');
		}
		
		return $query;
	}
	public function NoteList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "personal_note";	
			$where_array = " title like '%".$searchValue."%'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('personal_note');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "personal_note";	
			$where_array = " created_by = ".$user_id." AND title like '%".$searchValue."%'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "personal_note";	
			$where_array = " created_by = ".$user_id."  ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	/*/.List*/
	/*edit*/
	public function personal_note_edit($id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$data = [
			'p_date'              => $this->input->post('p_date'),
			'title'               => $this->input->post('title'),
			'description'         => $this->input->post('description'),
			'note1'               => $this->input->post('note1'),
			'note2'               => $this->input->post('note2'),
			'note3'               => $this->input->post('note3'),
			'note4'               => $this->input->post('note4'),
			'note5'               => $this->input->post('note5'),
			'modified_by'    	  => $user_id,
			'modified_at'    	  => time()
			];
			$query = $this->db->where('id', $id)->update('personal_note', $data);
			if($query)
        	{
				 return true;
			}
			else
			{
				 return false;
			}
	}
	/*/.edit*/
}