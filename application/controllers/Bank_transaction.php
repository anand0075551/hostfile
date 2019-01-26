<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_transaction extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Bank_transaction_model');

        check_auth(); //check is logged in.
    }

    public function all_bank_transaction() {

        theme('all_bank_transaction');
    }

    public function add_bank_transaction() {
        permittedArea();
      
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'bank_transaction')
                die('Error! sorry');


            $this->form_validation->set_rules('txn_date', 'transaction date', 'trim|required');
            $this->form_validation->set_rules('value_date', 'value date', 'trim|required');
            $this->form_validation->set_rules('bank_ifsc', 'bank ifsc', 'trim|required');
            $this->form_validation->set_rules('cheque_no', 'cheque no', 'trim|required');
            $this->form_validation->set_rules('branch_code', 'branch code', 'trim|required');
            $this->form_validation->set_rules('debit','debit', 'trim|required');
            $this->form_validation->set_rules('credit','credit', 'trim|required');
            $this->form_validation->set_rules('balance','balance', 'trim|required');
            $this->form_validation->set_rules('status','status', 'trim|required');
           


            if ($this->form_validation->run() == true) {
                $insert = $this->Bank_transaction_model->bank_transaction();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'your transaction Created Success');
                    redirect(base_url('Bank_transaction/all_bank_transaction'));
					
                }
            }
        }

        theme('add_bank_transaction');
    }
	
	 public function deleteAjax() {

        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'bank_ifsc');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} bank_ifsc");
        //Now delete permanently
        $this->db->where('id', $id)->delete('bank_ifsc');
        return true;
    }
	
	  public function view_bank_transaction($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['bank_details'] = $this->db->get_where('bank_ifsc', ['id' => $id]);
        theme('view_bank_transaction', $data);
    }
	
	
		    public function copy_bank_transaction($id) {


				permittedArea();
       
        $data['bank_ifsc'] = singleDbTableRow($id, 'bank_ifsc');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_bank_transaction')
                die('Error! sorry');

            //$this->form_validation->set_rules('txn_date', 'transaction date', 'trim|required');
            //$this->form_validation->set_rules('value_date', 'value date', 'trim|required');
            $this->form_validation->set_rules('bank_ifsc', 'bank ifsc', 'trim|required');
            $this->form_validation->set_rules('cheque_no', 'cheque no', 'trim|required');
            $this->form_validation->set_rules('branch_code', 'branch code', 'trim|required');
            $this->form_validation->set_rules('debit','debit', 'trim|required');
            $this->form_validation->set_rules('credit','credit', 'trim|required');
            $this->form_validation->set_rules('balance','balance', 'trim|required');
            $this->form_validation->set_rules('status','status', 'trim|required');


              if ($this->form_validation->run() == true) {
                $insert = $this->Bank_transaction_model->copy_bank_transaction();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'data copy Success');
                    redirect(base_url('Bank_transaction/all_bank_transaction'));
					
                }
            }
        }

        theme('copy_bank_transaction', $data);
    }
	
	

	
	
	  public function edit_bank_transaction($id) {


        // permittedArea();
        //$data['rolename'] = $this->db->get('role');
		$data['bank_ifsc'] = singleDbTableRow($id, 'bank_ifsc');
        //$data['bank_ifsc'] = $this->db->get('bank_ifsc');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_bank_transaction')
                die('Error! sorry');

           // $this->form_validation->set_rules('txn_date', 'transaction date', 'trim|required');
           // $this->form_validation->set_rules('value_date', 'value date', 'trim|required');
            $this->form_validation->set_rules('bank_ifsc', 'bank ifsc', 'trim|required');
            $this->form_validation->set_rules('cheque_no', 'cheque no', 'trim|required');
            $this->form_validation->set_rules('branch_code', 'branch code', 'trim|required');
            $this->form_validation->set_rules('debit','debit', 'trim|required');
            $this->form_validation->set_rules('credit','credit', 'trim|required');
            $this->form_validation->set_rules('balance','balance', 'trim|required');
            $this->form_validation->set_rules('status','status', 'trim|required');
            $this->form_validation->set_rules('role_id','role id', 'trim|required');
            $this->form_validation->set_rules('user_id','user id', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Bank_transaction_model->edit_bank_transaction($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'data  Updated Successfully...!!!');
                    redirect(base_url('Bank_transaction/all_bank_transaction'));
                }
            }
        }

        theme('edit_bank_transaction', $data);
    }
	
	
	
	   public function getname() {

        $id = $_POST['role'];
        $query = $this->db->get_where('users', ['rolename' => $id]);
        $name = $query->result();
        $data = '<option value=""> Choose option </option>';
        foreach ($name as $st) {
            $data .= "<option value=" . $st->id . ">" . $st->first_name . " " . $st->last_name . "</option>";
        }
        echo $data;
    }
	

     public function Bank_transactionListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');


        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;

        $queryCount = $this->Bank_transaction_model->Bank_transactionListCount();


        $query = $this->Bank_transaction_model->Bank_transactionList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

				



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-info editBtn" href="' . base_url('Bank_transaction/view_bank_transaction/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
				$button .= '<a class="btn btn-warning" href="' . base_url('Bank_transaction/copy_bank_transaction/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-align-justify"></i></a>';
						
						
						
				$user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 


                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
                }
				
				$query = $this->db->get_where('status', ['id' => $r->status,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $status = $row->status;
                    }
                } else {
                    $status = " ";
                }
				
				$query1 = $this->db->get_where('role', ['id' => $r->role_id,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $role = $row->rolename;
                    }
                } else {
                    $role = "no data";
                }
				
				
				
				$query1 = $this->db->get_where('users', ['id' => $r->user_id,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $user = $row->first_name." ".$row->last_name;
                    }
                } else {
                    $user = "no data";
                }
					
				
            


                $data['data'][] = array(
                    $button,
					$r->txn_date,
                    $r->value_date,
					$r->bank_ifsc,
					$r->description,
					$r->cheque_no,
                    $r->branch_code,
					$r->debit,
					$r->credit,
					$r->balance,
					$status,
					$r->remarks,
					$role,
					$user

					
                );
            }
        } else {
            $data['data'][] = array(
                'no data', '', '', '', '', '', '', '','','','','','',''
            );
        }
        echo json_encode($data);
    }
	
	public function Bank_transaction_search_ListJson(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;

        $role_id = $_POST['role_id'];
        $users_id = $_POST['users_id'];
        $txn_date = $_POST['txn_date'];
		$bank_ifsc = $_POST['bank_ifsc'];
		$cheque_no = $_POST['cheque_no'];
		$branch_code = $_POST['branch_code'];
		$credit = $_POST['credit'];
		$debit = $_POST['debit'];
        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];



        $limit = $this->input->post('length');
        $start = $this->input->post('start');


        $queryCount = $this->Bank_transaction_model->search_Bank_transaction_listCount($role_id,$users_id,$txn_date,$credit,$branch_code,$cheque_no,$bank_ifsc,$debit,$sf_time,$st_time);


        $query = $this->Bank_transaction_model->search_Bank_transaction_list($limit,$start,$role_id,$users_id, $txn_date, $credit, $branch_code, $cheque_no ,$bank_ifsc,$debit, $sf_time, $st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

    if($query -> num_rows() > 0)
      {
        foreach($query->result() as $r){

			

                           


									

            //Action Button
            $button = '';
			$button .= '<a class="btn btn-info editBtn" href="' . base_url('Bank_transaction/view_bank_transaction/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
			$button .= '<a class="btn btn-warning" href="' . base_url('Bank_transaction/copy_bank_transaction/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-align-justify"></i></a>';
						
						
				$user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 


                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
							
							
                }
				
			
		$query = $this->db->get_where('status', ['id' => $r->status,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $status = $row->status;
                    }
                } else {
                    $status = " ";
                }
			
           $query1 = $this->db->get_where('role', ['id' => $r->role_id,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $role = $row->rolename;
                    }
                } else {
                    $role = "no data";
                }
				
				
				
				$query1 = $this->db->get_where('users', ['id' => $r->user_id,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $user = $row->first_name." ".$row->last_name;
                    }
                } else {
                    $user = "no data";
                }
					
				
            


                $data['data'][] = array(
                    $button,
					$r->txn_date,
                    $r->value_date,
					$r->bank_ifsc,
					$r->description,
					$r->cheque_no,
                    $r->branch_code,
					$r->debit,
					$r->credit,
					$r->balance,
					$status,
					$r->remarks,
					$role,
					$user

					
                );
            }
        } else {
            $data['data'][] = array(
                'no data', '', '', '', '', '', '', '','','','','','',''
            );

        }
        echo json_encode($data);

    }
	
	
	 public function get_total_amount(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;
		
		
		$role_id =  	$_POST['role_id'];
		$users_id = 	$_POST['users_id'];
		$txn_date = 	$_POST['txn_date'];
		$bank_ifsc =	$_POST['bank_ifsc'];
		$cheque_no =	$_POST['cheque_no'];
		$branch_code =  $_POST['branch_code'];
		$credit = 		$_POST['credit'];
		$debit = 		$_POST['debit'];
        $sf_time = 		$_POST['sf_time'];
        $st_time = 		$_POST['st_time'];

		
		


        $query = $this->Bank_transaction_model->get_total_amount($role_id,$users_id,$txn_date,$credit,$branch_code,$cheque_no,$bank_ifsc,$debit,$sf_time,$st_time);

        if($query -> num_rows() > 0)
      {
          $credit = 0;
         foreach($query->result() as $r)
        {
            $credit = $credit + $r->credit;
        }
      }
      else
      {
          $credit = 0;
      }
	  
	      if($query -> num_rows() > 0)
      {
          $debit = 0;
         foreach($query->result() as $r)
        {
            $debit = $debit + $r->debit;
        }
      }
      else
      {
          $debit = 0;
      }
	  
	      if($query -> num_rows() > 0)
      {
          $balance = 0;
         foreach($query->result() as $r)
        {
            $balance = $balance + $r->balance;
        }
      }
      else
      {
          $balance = 0;
      }
	  
	 

     

      echo "<table class='table table-striped'>
    
      <tr>
      <th>Total Credit</th>
      <td>".$credit."</td>
      </tr>
      
      <tr>
        <th>Total Debit</th>
        <td>".number_format($debit)."</td>
        </tr>
      
            <th>Total Balance:</th>
            <td>".$balance."</td>
      </tr>
      </table> <br><br>
      ";
    }
	
	
		public function bank_transaction_status()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			if($this->input->post())
			{
				if($this->input->post('submit') == 'import_data')
				{
					$this->form_validation->set_rules('fileToUpload','fileToUpload','required');
					
					$target_file = $_FILES["fileToUpload"]["name"];
					$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
					if($fileType != "csv")  //  checking for the file extension.  not allowing othre then (.csv) extension .
					{
						$this->session->set_flashdata('errorMsg', 'Sorry, only CSV file is allowed!');
						redirect(base_url('Bank_transaction/bank_transaction_status'));
						
					}
					else
					{
						$handle = fopen($_FILES['fileToUpload']['tmp_name'], "r");
						if ($handle !== FALSE) 
						{
						   fgetcsv($handle);   
						   while (($data = fgetcsv($handle)) !== FALSE) 
						   {
							 $fieldCount = count($data);
							 for ($c=0; $c < $fieldCount; $c++) 
							 {
							  $columnData[$c] = $data[$c];
							 }
					
							 
							 $txn_date = $columnData[0];
							 $value_date = $columnData[1];
							 $bank_ifsc = $columnData[2];
							 $description = $columnData[3];
							 $cheque_no = $columnData[4];
							 $branch_code = $columnData[5];
							 $debit = $columnData[6];
							 $credit = $columnData[7];
							 $balance = $columnData[8];

							 $exist = $this->db->get_where('bank_ifsc', ['txn_date'=>$txn_date,'value_date'=>$value_date,'bank_ifsc'=>$bank_ifsc,'description'=>$description,'cheque_no'=>$cheque_no,'branch_code'=>$branch_code,'debit'=>$debit,'credit'=>$credit,'balance'=>$balance]);
							if($exist -> num_rows()>0)
							{
							}
							else
							{
							 $create = $this->Bank_transaction_model->import_data($txn_date,$value_date,$bank_ifsc,$description,$cheque_no,$branch_code,$debit,$credit,$balance);// SQL Query to insert data into DataBase
							}
						   }
						 
						 fclose($handle);
					   }
				   }
				}
			}
			
			theme('bank_transaction_status');
		}
	}
	public function accountStatusListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Bank_transaction_model->accountStatusListCount();
		$query = $this->Bank_transaction_model->accountStatusList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 $cnt = 1;
			 foreach ($query->result() as $funds) 
			 {

				 //Action Button
				  $button = '';
				
					  $button2 =  ' <select name="'.$cnt.'status" class="form-control" id="'.$cnt.'status">
									<option value="">-Select status-</option>';
									
									$get_sts = $this->db->get_where('status', ['business_name'=>25]);
									if($get_sts->num_rows() > 0){
										foreach($get_sts->result() as $sts){
											$button2 .=	'<option value="'.$sts->id.'">'.$sts->status.'</option>';
										}
									}
									
							$button2 .=		'</select>';
								$button2 .='<input type="hidden" name ="'.$cnt.'aid" id ="'.$cnt.'aid" value="'.$funds->id.'">';
						
						
						
								$button2 .= '<a class="btn btn-primary btn-xs editBtn" href=""  data-toggle="tooltip" title="Status" onclick="change_status('.$cnt.')"><i class="fa fa-edit"></i> </a> ';
						
				
				
				 
				 
				 $data['data'][] = array(
					
                    $funds->branch_code,
					$funds->bank_ifsc,
					$funds->txn_date,
					$funds->value_date,
					$funds->description,
					//$funds->cheque_no,
					$funds->debit,
					$funds->credit,
					$funds->balance,
					$button2
					
				

                );
				$cnt ++;
			 }
			
		 }
		 else
		 {
			 $data['data'][] = array( 'No data', '', '', '', '','' , '', '', '','',''
			 );
		 }
		  echo json_encode($data); 
	}
	
	
	
	
	
	
	
	
/* ends */

	
	
	
		 
	 	  public function account_status_update()
     {
         $aid=$_POST['aid'];
         $status=$_POST['status'];
        
         $query = $this->Bank_transaction_model->account_status_update($aid,$status);
			if($query)
			{
				echo "Status Update Successfull";
			}
			else
			{
				echo "Sorry...Status Update Failed";
			}

     }


}

//last 
