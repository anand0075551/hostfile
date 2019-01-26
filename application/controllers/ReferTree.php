<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReferTree extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('refer_model');

        check_auth(); //check is logged in.
    }

    public function user_report() {
        theme('user_report');
    }

    public function userTrack_index() {
        theme('userTrack_index');
    }

   public function user_report_search_ListJson(){
	
		$user_info     = $this->session->userdata('logged_user');
		$user_id	   = $user_info['user_id'];
		
		$contactno     = $_POST['contactno'];
		$rolename      = $_POST['rolename'];
		$email         = $_POST['email'];
		$referral_code = $_POST['referral_code'];
		$active        = $_POST['active'];
		$assigned_to_name        = $_POST['assigned_to_name'];
		$points_mode        = $_POST['points_mode'];
		$referredByCode= $_POST['referredByCode'];
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		$dob1          = $_POST['dob1'];
		$dob2          = $_POST['dob2'];
		
		$limit         = $this->input->POST('length');
		$start         = $this->input->POST('start');
						

		$queryCount = $this->refer_model->search_user_listCount($contactno, $rolename, $email, $active,$assigned_to_name,$points_mode, $referral_code, $referredByCode, $sf_time, $st_time, $dob1, $dob2);
		
		$query = $this->refer_model->search_user_list($limit, $start, $contactno, $rolename, $email, $active,$assigned_to_name,$points_mode, $referral_code, $referredByCode, $sf_time, $st_time, $dob1, $dob2);
		

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
								
							$query1 = $this->db->get_where('role', ['id' => $r->rolename,]);

                                if ($query1->num_rows() > 0) 
								{
                                foreach ($query1->result() as $row) 
								{
                                        $rolename = $row->rolename;
                                }
                                } else
								{
                                     $rolename =  "";
								}
									  
							$query2 = $this->db->get_where('users', ['created_by' => $r->created_by]);

									if ($query2->num_rows() > 0) 
									{
										foreach ($query2->result() as $row1) 
										{
											$created_by = $row1->first_name.' '.$row1->last_name;
										}
									} else 
									{
										 $created_by = $row1->first_name.' '.$row1->last_name;
									}
									
									  
							$query3 = $this->db->get_where('users', ['modified_by' => $r->modified_by]);

									if ($query3->num_rows() > 0) {
										foreach ($query3->result() as $row2) {
											$modified_by = $row2->first_name.' '.$row2->last_name;
										}
									} else {
										 $modified_by = $row2->first_name.' '.$row2->last_name;
									}

							$activeStatus = $r->active;
							switch($activeStatus){
								case 0:
									$statusBtn = '<small class="label label-default"> Pending </small>';
									break;
								case 1 :
									$statusBtn = '<small class="label label-success"> Active </small>';
									break;
								case 2 :
									$statusBtn = '<small class="label label-danger"> Blocked </small>';
									break;
								case 3 :
									$statusBtn = '<small class="label label-danger"> Blocked by Admin </small>';
									break;
							}
							
						 
						
							
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('referTree/view_referral_tree/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$name = 'Action Bared';



		  $get_balance =$this->db->order_by('id','desc')->limit(1,0)->get_where('accounts',['user_id'=>$r->id]);  
		  if($get_balance->num_rows()>0){
			 foreach($get_balance->result() as $bal){
				
				$balance = number_format($bal->amount,2);
				$points_mode = $bal->points_mode;
			  }	 
		  }
		  else{
			  $points_mode = "N.A";
			  $balance = "N.A";
		  }
		  		   
		/*$points_mode = $this->db->get_where('accounts',['user_id'=>$r->id]);
		foreach($points_mode->result() as $point);
		
		$points_mode = $point->points_mode;*/
			

			
								
			$data['data'][] = array(
				$r->id , //$button, 
				$r->first_name.' '. $r->last_name.'('.$r->company_name.')',
				$statusBtn,
				$rolename,
				$r->email,
				$balance,
				$points_mode,
				$r->contactno,
				$r->referral_code,
				$r->row_pass,
				$r->gender,
				$r->date_of_birth,
				$r->profession,
				$r->street_address,
				$r->area_name,
				$r->area_id,
				$r->city,
				$r->city_id,
				$r->country,
				$r->country_id,
				$r->postal_code,
				$r->id_type,
				$r->adhaar_no,
				$r->pan_no,
				$r->ifsc_code,
				$r->bank_account,
				$r->bank_acc_type,
				$r->bank_name,
				$r->bank_address,
				$r->passport_no,
				$r->company_name,
				$r->licence,
				$r->agreed_per,
				$r->role,
				$r->online_status,
				$r->time,
				$r->cash,
				$r->others,
				date("Y-m-d",$r->user_lastlogin),
				$r->account_no,
				$r->referredByCode,
				$r->photo,
				$created_by,
				date("Y-m-d",$r->created_at),
				$modified_by,
				date("Y-m-d",$r->modified_at),
				$r->referral_code
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Consumers are not Available' , '', '','', '','','','','','','', '', '','', '','','','','','','', '', '','', '','','','','','','', '', '','', '','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	// on change role 

	 public function get_user2()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->refer_model->get_user2($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->id.'-'.$r->rolename."</option>";
         } 

     }
	//
	
	  public function get_user1()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->refer_model->get_user1($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->contactno.'-'.$r->first_name.' '.$r->last_name."</option>";
         } 

     }
	//

    public function userTrackListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $user_info = $this->session->userdata('logged_user');
        $logged_id = $user_info['user_id'];

        $queryCount = $this->refer_model->userTrackListCount();
        $query = $this->refer_model->userTrackList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
                $activeStatus = $r->status;
                switch ($activeStatus) {
                    case 0:
                        $statusBtn = '<small class="label label-default"> Pending </small>';
                        break;
                    case 1 :
                        $statusBtn = '<small class="label label-success"> Active </small>';
                        break;
                    case 2 :
                        $statusBtn = '<small class="label label-danger"> Blocked </small>';
                        break;
                    case 3 :
                        $statusBtn = '<small class="label label-danger"> Blocked by Admin </small>';
                        break;
                }
                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('referTree/view_user/' . $r->user_id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';



                $query = $this->db->get_where('role', ['id' => $r->rolename,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $role_name = $row->rolename;
                    }
                } else {
                    $role_name = " ";
                }


                $query1 = $this->db->get_where('users', ['id' => $r->user_id,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $user_name = $row->first_name . ' ' . $row->last_name;
                    }
                } else {
                    $user_name = " ";
                }
                $query2 = $this->db->get_where('users', ['id' => $logged_id]);

                if ($query2->num_rows() > 0) {
                    foreach ($query2->result() as $row) {
                        $logged_name = $row->first_name . ' ' . $row->last_name;
                    }
                } else {
                    $logged_name = $row->first_name . ' ' . $row->last_name;
                }

                $data['data'][] = array(
                    $button,
                    $user_name,
                    $role_name,
                    $r->referral_code,
                    $statusBtn,
                    $logged_name,
                    date("Y-m-d", $r->action_at)
                );
            }
        } else {
            $data['data'][] = array(
                'Consumers are not Available', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }

    public function view_referral_tree($id) {
        $data['query'] = $this->db->get_where('users', ['id' => $id]);
        theme('view_referral_tree', $data);
    }

    public function edit_referral_tree($id) {
        $data['query'] = $this->db->get_where('users', ['id' => $id]);
        $data['result'] = singleDbTableRow($id, 'users');
        {
            if ($this->input->post('submit') == 'addInfo') {
                // die('Error! sorry');
                $this->form_validation->set_rules('referral_code', 'referral_code', 'required');
                $this->form_validation->set_rules('status', 'status', 'required');
                if ($this->form_validation->run() == true) {
                    $insert = $this->refer_model->edit_referral_tree($id);
                    if ($insert) {
                        $this->session->set_flashdata('successMsg', 'your data saved Successfully');
                        redirect(base_url('referTree/user_report'));
                    }
                }
            }
        }
        theme('edit_referral_tree', $data);
    }

    public function user_search_ListJson() {
        $user_info = $this->session->userdata('logged_user');
        $logged_id = $user_info['user_id'];

        $user_id = $_POST['user_id'];
        $rolename = $_POST['rolename'];
        $status = $_POST['status'];
        $referral_code = $_POST['referral_code'];
        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];

        $limit = $this->input->get('length');
        $start = $this->input->get('start');



        $queryCount = $this->refer_model->search_user_report_ListCount($user_id, $rolename, $status, $referral_code, $sf_time, $st_time);

        $query = $this->refer_model->search_user_report_List($limit, $user_id, $rolename, $status, $start, $referral_code, $sf_time, $st_time);


        echo '<thead>
				<tr class="well">
					<th width="7%">Action</th>
					<th width="10%">User Name</th>
					<th width="10%">Role Name</th>
					<th width="10%">Referral Code</th>
					<th width="10%">Status</th>
					<th width="15%">Action by</th>
					<th width="10%">Action at</th>                          
				</tr>
				</thead>
				<tbody>';


        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

                $query3 = $this->db->get_where('users', ['id' => $r->user_id]);
                if ($query3->num_rows() > 0) {
                    foreach ($query3->result() as $d) {
                        $user_name = $d->first_name . " " . $d->last_name;
                    }
                } else {
                    $user_name = " ";
                }

                $query1 = $this->db->get_where('role', ['id' => $r->rolename,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $rolename = $row->rolename;
                    }
                } else {
                    $rolename = "";
                }

                $query2 = $this->db->get_where('users', ['id' => $logged_id]);

                if ($query2->num_rows() > 0) {
                    foreach ($query2->result() as $row) {
                        $logged_name = $row->first_name . ' ' . $row->last_name;
                    }
                } else {
                    $logged_name = $row->first_name . ' ' . $row->last_name;
                }

                $activeStatus = $r->status;
                switch ($activeStatus) {
                    case 0:
                        $status = '<small class="label label-default"> Pending </small>';
                        break;
                    case 1 :
                        $status = '<small class="label label-success"> Active </small>';
                        break;
                    case 2 :
                        $status = '<small class="label label-danger"> Blocked </small>';
                        break;
                    case 3 :
                        $status = '<small class="label label-danger"> Blocked by Admin </small>';
                        break;
                }

                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary btn-sm" href="' . base_url('referTree/view_user/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                echo '<tr>
						<td>' . $button . '</td>
						<td>' . $user_name . '</td>
						<td>' . $rolename . '</td>
						<td>' . $r->referral_code . '</td>
						<td>' . $status . '</td>
						<td>' . $logged_name . '</td>
						<td>' . date("Y-m-d", $r->action_at) . '</td>
					</tr>';
            }
        } else {
            echo '<tr><td>No results found</td></tr>';
        }
        echo '</tbody>
			<tfoot>
				<tr class="well">
					<th width="7%">Action</th>
					<th width="10%">User Name</th>
					<th width="10%">Role Name</th>
					<th width="10%">Referral Code</th>
					<th width="10%">Status</th>
					<th width="15%">Action by</th>
					<th width="10%">Action at</th>                             
				</tr>
				</tfoot>';
    }

    public function view_user($id) {
        $data['user_details'] = $this->db->get_where('users', ['id' => $id]);

        theme('view_user', $data);
    }

}

?>