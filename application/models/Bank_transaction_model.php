<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_transaction_model extends CI_Model {

    /**
     * @return bool
     */
    public function bank_transaction() {
        //$data['referral_code'] = $this->db->get('users');
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $root_id = singleDbTableRow($user_id)->referral_code;

        $data = [
            'txn_date' 		=> $this->input->post('txn_date'),
            'value_date' 	=> $this->input->post('value_date'),
            'description' 	=> $this->input->post('description'),
            'bank_ifsc' 	=> $this->input->post('bank_ifsc'),
            'cheque_no' 	=> $this->input->post('cheque_no'),
            'branch_code' 	=> $this->input->post('branch_code'),
            'debit' 		=> $this->input->post('debit'),
            'credit' 		=> $this->input->post('credit'),
            'balance' 		=> $this->input->post('balance'),
            'status' 		=> $this->input->post('status'),
            'remarks' 		=> $this->input->post('remarks'),
            'created_by' 	=> $user_id,
            'created_at' 	=> time()
        ];

        $query = $this->db->insert('bank_ifsc', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'bank_ifsc'); //create an activity
            return true;
        }
        return false;
    }

    public function copy_bank_transaction($id) {
        //$data['referral_code'] = $this->db->get('users');
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $root_id = singleDbTableRow($user_id)->referral_code;

        $data = [
			'txn_date' 		=> $this->input->post('txn_date'),
            'value_date' 	=> $this->input->post('value_date'),
            'description' 	=> $this->input->post('description'),
            'bank_ifsc' 	=> $this->input->post('bank_ifsc'),
            'cheque_no' 	=> $this->input->post('cheque_no'),
            'branch_code' 	=> $this->input->post('branch_code'),
            'debit' 		=> $this->input->post('debit'),
            'credit' 		=> $this->input->post('credit'),
            'balance' 		=> $this->input->post('balance'),
            'status' 		=> $this->input->post('status'),
            'remarks' 		=> $this->input->post('remarks'),
            'created_by' 	=> $user_id,
            'created_at' 	=> time()
        ];

        $query = $this->db->insert('bank_ifsc', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'bank_ifsc'); //create an activity
            return true;
        }
        return false;
    }

	  public function edit_bank_transaction($id) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        //set all data for inserting into database
        $data = [
            'txn_date' 		=> $this->input->post('txn_date'),
            'value_date' 	=> $this->input->post('value_date'),
            'description' 	=> $this->input->post('description'),
            'bank_ifsc' 	=> $this->input->post('bank_ifsc'),
            'cheque_no' 	=> $this->input->post('cheque_no'),
            'branch_code' 	=> $this->input->post('branch_code'),
            'debit' 		=> $this->input->post('debit'),
            'credit' 		=> $this->input->post('credit'),
            'balance' 		=> $this->input->post('balance'),
            'status' 		=> $this->input->post('status'),
            'role_id' 		=> $this->input->post('role_id'),
            'user_id' 		=> $this->input->post('user_id'),
            'remarks' 		=> $this->input->post('remarks'),
            'modified_by' 	=> $user_id,
            'modified_at' 	=> time()
        ];

        $query = $this->db->where('id', $id)->update('bank_ifsc', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'bank_ifsc'); //create an activity
            return true;
        }
        return false;
    }

    public function Bank_transactionListCount()
	{

        $query = $this->db->count_all_results('bank_ifsc');
        return $query;
    }

    public function Bank_transactionList($limit = 0, $start = 0) 
	{

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;

        if ($currentUser == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bank_ifsc');
            return $query;
        } else {
            $table_name = 'bank_ifsc';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

  


//searching

    public function search_Bank_transaction_listCount($role_id,$users_id,$txn_date,$credit,$branch_code,$cheque_no,$bank_ifsc,$debit,$sf_time,$st_time) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser = singleDbTableRow($user_id)->role;

        $search = $this->input->get('search');

        $searchByID = '';
        $condition = "";

		 if ($role_id != '') {
            if ($condition != "") {
                $condition .= " AND role_id = '" . $role_id . "'";
            } else {
                $condition .= "role_id = '" . $role_id . "'";
            }
        }
		
		 if ($users_id != '') {
            if ($condition != "") {
                $condition .= " AND user_id = '" . $users_id . "'";
            } else {
                $condition .= "user_id = '" . $users_id . "'";
            }
        }
		
        if ($txn_date != '') {
            if ($condition != "") {
                $condition .= " AND txn_date = '" . $txn_date . "'";
            } else {
                $condition .= "txn_date = '" . $txn_date . "'";
            }
        }

		
		if ($bank_ifsc != '') {
            if ($condition != "") {
                $condition .= " AND bank_ifsc = '" . $bank_ifsc . "'";
            } else {
                $condition .= "bank_ifsc = '" . $bank_ifsc . "'";
            }
        }
		
		if ($cheque_no != '') {
            if ($condition != "") {
                $condition .= " AND cheque_no = '" . $cheque_no . "'";
            } else {
                $condition .= "cheque_no = '" . $cheque_no . "'";
            }
        }
		
		
		 if ($branch_code != '') {
            if ($condition != "") {
                $condition .= " AND branch_code = '" . $branch_code . "'";
            } else {
                $condition .= "branch_code = '" . $branch_code . "'";
            }
        }
		
		if ($credit != '') {
            if ($condition != "") {
                $condition .= " AND credit = '" . $credit . "'";
            } else {
                $condition .= "credit = '" . $credit . "'";
            }
        }
		
		if ($debit != '') {
            if ($condition != "") {
                $condition .= " AND debit = '" . $debit . "'";
            } else {
                $condition .= "debit = '" . $debit . "'";
            }
        }
		
	
		

        if ($sf_time != '' && $st_time != '') {
            $start_fdt = new DateTime($sf_time);
            $start_from = $start_fdt->format('Y-m-d');

            $start_tdt = new DateTime($st_time);
            $start_to = $start_tdt->format('Y-m-d');
        }

        if ($sf_time != '' && $st_time != '') {
            if ($condition != "") {

                $condition .= " AND DATE(FROM_UNIXTIME(created_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(created_at)) <= '" . $start_to . "'";
            } else {
                $condition .= "DATE(FROM_UNIXTIME(created_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(created_at)) <= '" . $start_to . "'";
            }
        }
        if ($currentUser == 'admin') {
            if ($condition != '') {
                $where_array = $condition;
                $query = $this->db->where($where_array)->count_all_results('bank_ifsc');
            } else {
                $query = $this->db->count_all_results('bank_ifsc');
            }
        } else {
            if ($condition != '') {
                $where_array = $condition;
                $where_array = $where_array . "AND created_by = '" . $user_id . "'";
                $query = $this->db->where($where_array)->count_all_results('bank_ifsc');
            } else {
                $where = array('created_by' => $user_id);
                $query = $this->db->where($where)->count_all_results('bank_ifsc');
            }
        }

        return $query;
    }

    public function search_Bank_transaction_list($limit,$start,$role_id,$users_id, $txn_date, $credit, $branch_code, $cheque_no ,$bank_ifsc,$debit, $sf_time, $st_time) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser = singleDbTableRow($user_id)->role;
        $search = $this->input->get('search');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');

        $searchByID = '';
        $condition = "";

		 if ($role_id != '') {
            if ($condition != "") {
                $condition .= " AND role_id = '" . $role_id . "'";
            } else {
                $condition .= "role_id = '" . $role_id . "'";
            }
        }
		
		 if ($users_id != '') {
            if ($condition != "") {
                $condition .= " AND user_id = '" . $users_id . "'";
            } else {
                $condition .= "user_id = '" . $users_id . "'";
            }
        }
		
        if ($txn_date != '') {
            if ($condition != "") {
                $condition .= " AND txn_date = '" . $txn_date . "'";
            } else {
                $condition .= "txn_date = '" . $txn_date . "'";
            }
        }
        if ($bank_ifsc != '') {
            if ($condition != "") {
                $condition .= " AND bank_ifsc = '" . $bank_ifsc . "'";
            } else {
                $condition .= "bank_ifsc = '" . $bank_ifsc . "'";
            }
        }
		
		if ($branch_code != '') {
            if ($condition != "") {
                $condition .= " AND branch_code = '" . $branch_code . "'";
            } else {
                $condition .= "branch_code = '" . $branch_code . "'";
            }
        }
		
		if ($credit != '') {
            if ($condition != "") {
                $condition .= " AND credit = '" . $credit . "'";
            } else {
                $condition .= "credit = '" . $credit . "'";
            }
        }
		
		if ($debit != '') {
            if ($condition != "") {
                $condition .= " AND debit = '" . $debit . "'";
            } else {
                $condition .= "debit = '" . $debit . "'";
            }
        }



        if ($sf_time != '' && $st_time != '') {
            $start_fdt = new DateTime($sf_time);
            $start_from = $start_fdt->format('Y-m-d');

            $start_tdt = new DateTime($st_time);
            $start_to = $start_tdt->format('Y-m-d');
        }

        if ($sf_time != '' && $st_time != '') {
            if ($condition != "") {

                $condition .= " AND DATE(FROM_UNIXTIME(created_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(created_at)) <= '" . $start_to . "'";
            } else {
                $condition .= " DATE(FROM_UNIXTIME(created_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(created_at)) <= '" . $start_to . "'";
            }
        }

        if ($currentUser == 'admin') {
            if ($condition != '') {
                $where_array = $condition;
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('bank_ifsc');
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bank_ifsc');
            }
        } else {
            if ($condition != '') {
                $where_array = $condition;
                $where_array = $where_array . " AND created_by = " . $user_id . " ";
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('bank_ifsc');
            } else {
                $where_array = array('created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('bank_ifsc');
            }
        }
        return $query;
    }
	
	
	
	
		public function get_total_amount($role_id,$users_id,$txn_date,$credit,$branch_code,$cheque_no,$bank_ifsc,$debit,$sf_time,$st_time){
			
			
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		if ($role_id != '') {
            if ($condition != "") {
                $condition .= " AND role_id = '" . $role_id . "'";
            } else {
                $condition .= "role_id = '" . $role_id . "'";
            }
        }
		
		 if ($users_id != '') {
            if ($condition != "") {
                $condition .= " AND user_id = '" . $users_id . "'";
            } else {
                $condition .= "user_id = '" . $users_id . "'";
            }
        }
		
		
		 if ($txn_date != '') {
            if ($condition != "") {
                $condition .= " AND txn_date = '" . $txn_date . "'";
            } else {
                $condition .= "txn_date = '" . $txn_date . "'";
            }
        }
        if ($bank_ifsc != '') {
            if ($condition != "") {
                $condition .= " AND bank_ifsc = '" . $bank_ifsc . "'";
            } else {
                $condition .= "bank_ifsc = '" . $bank_ifsc . "'";
            }
        }
		
		if ($branch_code != '') {
            if ($condition != "") {
                $condition .= " AND branch_code = '" . $branch_code . "'";
            } else {
                $condition .= "branch_code = '" . $branch_code . "'";
            }
        }
		
		if ($credit != '') {
            if ($condition != "") {
                $condition .= " AND credit = '" . $credit . "'";
            } else {
                $condition .= "credit = '" . $credit . "'";
            }
        }
		
			if ($debit != '') {
            if ($condition != "") {
                $condition .= " AND debit = '" . $debit . "'";
            } else {
                $condition .= "debit = '" . $debit . "'";
            }
        }
		
	
		
		if ($cheque_no != '') {
            if ($condition != "") {
                $condition .= " AND cheque_no = '" . $cheque_no . "'";
            } else {
                $condition .= "cheque_no = '" . $cheque_no . "'";
            }
        }
		

        if ($sf_time != '' && $st_time != '') {
            $start_fdt = new DateTime($sf_time);
            $start_from = $start_fdt->format('Y-m-d');

            $start_tdt = new DateTime($st_time);
            $start_to = $start_tdt->format('Y-m-d');
        }

        if ($sf_time != '' && $st_time != '') {
            if ($condition != "") {

                $condition .= " AND DATE(FROM_UNIXTIME(created_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(created_at)) <= '" . $start_to . "'";
            } else {
                $condition .= " DATE(FROM_UNIXTIME(created_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(created_at)) <= '" . $start_to . "'";
            }
        }
		
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bank_ifsc');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bank_ifsc');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bank_ifsc');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bank_ifsc');
        }
        } 
        return $query;
	}
	
	
		public function import_data($txn_date,$value_date,$bank_ifsc,$description,$cheque_no,$branch_code,$debit,$credit,$balance)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$data = [
			'txn_date'            	=> $txn_date,
			'value_date'           => $value_date,
			'bank_ifsc'           => $bank_ifsc,
			'description'          => $description,
			'cheque_no'            => $cheque_no,
			'branch_code'          => $branch_code,
			'debit'            		=> $debit,
            'credit'             => $credit,
            'balance'             => $balance,
          //  'status'             => $status,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('bank_ifsc', $data);
			
		/* */
		if($query)
        {
			return true;
        }
        return false;
	}

		public function accountStatusListCount() 
	{
		
		$query = $this->db->count_all_results('bank_ifsc');
		
		return $query;
	}
	public function accountStatusList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	
	
	if($searchValue != '')																							
		{																												
			$table_name = "bank_ifsc";	
			$where_array = "branch_code like '%".$searchValue."%'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('bank_ifsc',['status' => ""]);
		}
	
	return $query;
	}
	
/*ends */	
public function account_status_update($aid,$status) 
	{

		/* update */
		$data2 = [
           	'status'               => $status,
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query2 = $this->db->where('id', $aid)->update('bank_ifsc', $data2);
			if($query2)
			{
				return true;	
			}
			else
			{
				return false;
			}
	}

}

//last brace required
	