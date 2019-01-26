<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_entry extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Visitor_entry_model');

		check_auth(); //check is logged in.
	}	
	 
	 public function visitor_Index()
	{
		theme('visitor_Index');
	}
	
	
	public function add_visitors(){
		//restricted this area, only for admin
		//permittedArea();
		if($this->input->post())
		{
			if($this->input->post('submit') != 'visitor') die('Error! sorry');

			$this->form_validation->set_rules('visitor_name', 'visitor_name','required');	
			$this->form_validation->set_rules('type_of_id', 'type_of_id','required');
			$this->form_validation->set_rules('proof_number', 'proof_number','required');
			$this->form_validation->set_rules('email_id', 'email_id','required');
			$this->form_validation->set_rules('purpose', 'purpose','required');
			$this->form_validation->set_rules('from_place', 'from_place','required');
			$this->form_validation->set_rules('refferer', 'refferer','required');
			$this->form_validation->set_rules('whom_to_meet', 'whom_to_meet','required');
			$this->form_validation->set_rules('mobile_no', 'mobile_no','required');
			$this->form_validation->set_rules('remarks', 'remarks','required');
			$this->form_validation->set_rules('custom1', 'custom1');
			$this->form_validation->set_rules('custom2', 'custom2');
			$this->form_validation->set_rules('custom3', 'custom3');
			$this->form_validation->set_rules('custom4', 'custom4');
			$this->form_validation->set_rules('custom5', 'custom5');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Visitor_entry_model->add_visitors();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Visitor entry Created Successfully!');
					redirect(base_url('Visitor_entry/visitor_Index'));
				}

			}
		}
		
		theme('add_visitors');
	}
	 
	public function visitor_entryListJson() {
		
		  $limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Visitor_entry_model->visitor_entryListCount();


        $query = $this->Visitor_entry_model->visitor_entryList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
				
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/copy_visitor/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-copy"></i> </a>';
				
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_visitorentry/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
						/*  $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_visitor_entry/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';*/
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
				
						
			
                $data['data'][] = array(
                    $button,
					$r->visitor_name,
					$r->type_of_id,
					$r->proof_number,
                    $r->email_id,
                    $r->purpose,
                    $r->from_place,
                    $r->refferer,
					$r->whom_to_meet,
					$r->mobile_no,
					$r->remarks,
					$r->custom1,
					$r->custom2,
					$r->custom3,
					$r->custom4,
					$r->custom5,
					
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Visitor entry list', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
public function deleteAjax	() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'visitors_details');
        $categoryName = $userInfo->name;
       
        //Now delete permanently
        $this->db->where('id', $id)->delete('visitors_details');
        return true;
    }
	
	 public function view_visitorentry($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_visitorentry', $data);
    }
	
	/* public function view_visitor_entry($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_visitor_entry', $data);
    }
*/
		
	 public function edit_visitor_entry($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_visitor')
                die('Error! sorry');
			
			$this->form_validation->set_rules('visitor_name', 'visitor_name','required');	
			$this->form_validation->set_rules('type_of_id', 'type_of_id','required');
			$this->form_validation->set_rules('proof_number', 'proof_number','required');
			$this->form_validation->set_rules('email_id', 'email_id','required');
			$this->form_validation->set_rules('purpose', 'purpose','required');
			$this->form_validation->set_rules('from_place', 'from_place','required');
			$this->form_validation->set_rules('refferer', 'refferer','required');
			$this->form_validation->set_rules('whom_to_meet', 'whom_to_meet','required');
			$this->form_validation->set_rules('mobile_no', 'mobile_no','required');
			$this->form_validation->set_rules('remarks', 'remarks','required');
			$this->form_validation->set_rules('custom1', 'custom1');
			$this->form_validation->set_rules('custom2', 'custom2');
			$this->form_validation->set_rules('custom3', 'custom3');
			$this->form_validation->set_rules('custom4', 'custom4');
			$this->form_validation->set_rules('custom5', 'custom5');


            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->edit_visitor_entry($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Visitor entry  Updated Successfully...!!!');
                    redirect(base_url('Visitor_entry/visitor_Index'));
                }
            }
        }

        theme('edit_visitor_entry',$data);
    }
	
	
			
	 public function copy_visitor($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_visitor')
                die('Error! sorry');
			
			$this->form_validation->set_rules('visitor_name', 'visitor_name','required');	
			$this->form_validation->set_rules('type_of_id', 'type_of_id','required');
			$this->form_validation->set_rules('proof_number', 'proof_number','required');
			$this->form_validation->set_rules('email_id', 'email_id','required');
			$this->form_validation->set_rules('purpose', 'purpose','required');
			$this->form_validation->set_rules('from_place', 'from_place','required');
			$this->form_validation->set_rules('refferer', 'refferer','required');
			$this->form_validation->set_rules('whom_to_meet', 'whom_to_meet','required');
			$this->form_validation->set_rules('mobile_no', 'mobile_no','required');
			$this->form_validation->set_rules('remarks', 'remarks','required');
			$this->form_validation->set_rules('custom1', 'custom1');
			$this->form_validation->set_rules('custom2', 'custom2');
			$this->form_validation->set_rules('custom3', 'custom3');
			$this->form_validation->set_rules('custom4', 'custom4');
			$this->form_validation->set_rules('custom5', 'custom5');


            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->copy_visitor($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Visitor entry  Updated Successfully...!!!');
                    redirect(base_url('Visitor_entry/visitor_Index'));
                }
            }
        }

        theme('copy_visitor',$data);
    }
	

	/* inward items */
	
	
	
	 public function inward_list()
	{
		theme('inward_list');
	}
	
	
	
	public function add_inward_items(){         
		//restricted this area, only for admin  
		//permittedArea();
		if($this->input->post())
		{
			if($this->input->post('submit') != 'inward') die('Error! sorry');

		$this->form_validation->set_rules('item Name', 'item Name');	
			$this->form_validation->set_rules('type_of_item', 'type_of_item','required');
			$this->form_validation->set_rules('item_number', 'item_number','required');
			$this->form_validation->set_rules('invoice_id', 'invoice_id','required');
			$this->form_validation->set_rules('purpose', 'purpose','required');
			$this->form_validation->set_rules('item_value', 'item_value','required');
			$this->form_validation->set_rules('from_place', 'from_place','required');
			$this->form_validation->set_rules('from_whom', 'from_whom','required');
			$this->form_validation->set_rules('to_reciver', 'to_reciver','required');
			$this->form_validation->set_rules('mobile_no', 'mobile_no','required');
			$this->form_validation->set_rules('remarks', 'remarks','required');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Visitor_entry_model->add_inward_items();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Inward items Created Successfully!');
					redirect(base_url('Visitor_entry/inward_list'));
				}

			}
		}
		
		theme('add_inward_items');
	}
	
	public function inward_itemListJson() {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Visitor_entry_model->inward_itemListCount();


        $query = $this->Visitor_entry_model->inward_itemList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_inwarditem/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				
				/* $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_inward_item/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';*/
				
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/copy_inward_items/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-copy"></i> </a>';
				
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
						
				$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$created_by =  " ";
					}
			$query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

					if ($query3->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$modified_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$modified_by =  " ";
					}
				
				/*$get_pay_type = $this->db->get_where('users', ['id'=>$r->created_by]);
					foreach($get_pay_type->result() as $p);
				$created_by = $p->first_name;
				
				$get_pay_type = $this->db->get_where('users', ['id'=>$r->modified_by]);
					foreach($get_pay_type->result() as $p);
				$modified_by = $p->first_name;*/
				
                $data['data'][] = array(
                    $button,
					$r->item_name,
					$r->type_of_item,
					$r->item_number,
					$r->invoice_id,
                    $r->purpose,
                    $r->item_value,
                    $r->from_place,
					$r->from_whom,
					$r->to_reciver,
					$r->mobile_no,
					$r->remarks,
					$r->created_at,
					$created_by,
					$r->modified_at,
					$modified_by
					
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Visitor entry list', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	public function deleteAjaxinward	() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'visitors_details');
        $categoryName = $userInfo->name;
       
        //Now delete permanently
        $this->db->where('id', $id)->delete('visitors_details');
        return true;
    }
	
	public function view_inwarditem($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_inwarditem', $data);
    } 
	
/*	public function view_inward_item($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_inward_item', $data);
    } 
	*/
		
	 public function edit_inward_items($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_inward')
                die('Error! sorry');
		
			$this->form_validation->set_rules('item Name', 'item Name');	
			$this->form_validation->set_rules('type_of_item', 'type_of_item');
			$this->form_validation->set_rules('item_number', 'item_number');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('purpose', 'purpose');
			$this->form_validation->set_rules('item_value', 'item_value');
			$this->form_validation->set_rules('from_place', 'from_place');
			$this->form_validation->set_rules('from_whom', 'from_whom');
			$this->form_validation->set_rules('to_reciver', 'to_reciver');
			$this->form_validation->set_rules('mobile_no', 'mobile_no');
			$this->form_validation->set_rules('remarks', 'remarks');
			
            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->edit_inward_items($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Inward item  Updated Successfully...!!!');
                    redirect(base_url('Visitor_entry/inward_list'));
                }
            }
        }

        theme('edit_inward_items',$data);
    }
	
	public function copy_inward_items($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_inward')
                die('Error! sorry');
		
			$this->form_validation->set_rules('item Name', 'item Name');	
			$this->form_validation->set_rules('type_of_item', 'type_of_item');
			$this->form_validation->set_rules('item_number', 'item_number');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('purpose', 'purpose');
			$this->form_validation->set_rules('item_value', 'item_value');
			$this->form_validation->set_rules('from_place', 'from_place');
			$this->form_validation->set_rules('from_whom', 'from_whom');
			$this->form_validation->set_rules('to_reciver', 'to_reciver');
			$this->form_validation->set_rules('mobile_no', 'mobile_no');
			$this->form_validation->set_rules('remarks', 'remarks');
			
            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->copy_inward_items($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'inword item inserted  Successfully...!!!');
                    redirect(base_url('Visitor_entry/inward_list'));
                }
            }
        }

        theme('copy_inward_items',$data);
    }
	
	
	
	/* out ward item */
	
	
	
	
		 public function outward_item_list()
	{
		theme('outward_item_list');
	}

	public function add_outward_items(){         
		//restricted this area, only for admin  
		//permittedArea();
		if($this->input->post())
		{
			if($this->input->post('submit') != 'outward') die('Error! sorry');

			$this->form_validation->set_rules('item Name', 'item Name');	
			$this->form_validation->set_rules('type_of_item', 'type_of_item');
			$this->form_validation->set_rules('item_number', 'item_number');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('purpose', 'purpose');
			$this->form_validation->set_rules('item_value', 'item_value');
			$this->form_validation->set_rules('from_place', 'from_place');
			$this->form_validation->set_rules('to_whom', 'to_whom');
			$this->form_validation->set_rules('from_sender', 'from_sender');
			$this->form_validation->set_rules('mobile_no', 'mobile_no');
			$this->form_validation->set_rules('remarks', 'remarks');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Visitor_entry_model->add_outward_items();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Outward items Created Successfully!');
					redirect(base_url('Visitor_entry/outward_item_list'));
				}

			}
		}
		
		theme('add_outward_items');
	}
	
	public function outward_itemListJson() {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Visitor_entry_model->outward_itemListCount();


        $query = $this->Visitor_entry_model->outward_itemList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_outwarditem/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				
				/*  $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_outward_item/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';*/
				
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/copy_outward_items/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-copy"></i> </a>';
				
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
						
				/*$get_pay_type = $this->db->get_where('users', ['id'=>$r->created_by]);
					foreach($get_pay_type->result() as $p);
				$created_by = $p->first_name;
				
				$get_pay_type = $this->db->get_where('users', ['id'=>$r->modified_by]);
					foreach($get_pay_type->result() as $p);
				$modified_by = $p->first_name;*/
				
				
                $data['data'][] = array(
                    $button,
					$r->item_name,
					$r->type_of_item,
					$r->item_number,
					$r->invoice_id,
                    $r->purpose,
                    $r->item_value,
                    $r->from_place,
					$r->to_whom,
					$r->from_sender,
					$r->mobile_no,
					$r->remarks,
					$r->created_at,
					$r->created_by,
					$r->modified_at,
					$r->modified_by
					
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Outward Items list', '', '', '', '', '', '', '', '', '', '', '', '', '', '',''
            );
        }
        echo json_encode($data);
    }
	
	public function deleteAjaxoutward	() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'visitors_details');
        $categoryName = $userInfo->name;
       
        //Now delete permanently
        $this->db->where('id', $id)->delete('visitors_details');
        return true;
    }
	
	public function view_outwarditem($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_outwarditem', $data);
    } 
	
	/*public function view_outward_item($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_outward_item', $data);
    } */
	
		
	 public function edit_outward_items($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_outward')
                die('Error! sorry');
		$this->form_validation->set_rules('item Name', 'item Name');	
			$this->form_validation->set_rules('type_of_item', 'type_of_item');
			$this->form_validation->set_rules('item_number', 'item_number');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('purpose', 'purpose');
			$this->form_validation->set_rules('item_value', 'item_value');
			$this->form_validation->set_rules('from_place', 'from_place');
			$this->form_validation->set_rules('to_whom', 'to_whom');
			$this->form_validation->set_rules('from_sender', 'from_sender');
			$this->form_validation->set_rules('mobile_no', 'mobile_no');
			$this->form_validation->set_rules('remarks', 'remarks');
			
            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->edit_outward_items($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Outward item  Updated Successfully...!!!');
                    redirect(base_url('Visitor_entry/outward_item_list'));
                }
            }
        }

        theme('edit_outward_items',$data);
    }
	
		
	 public function copy_outward_items($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_outward')
                die('Error! sorry');
		$this->form_validation->set_rules('item Name', 'item Name');	
			$this->form_validation->set_rules('type_of_item', 'type_of_item');
			$this->form_validation->set_rules('item_number', 'item_number');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('purpose', 'purpose');
			$this->form_validation->set_rules('item_value', 'item_value');
			$this->form_validation->set_rules('from_place', 'from_place');
			$this->form_validation->set_rules('to_whom', 'to_whom');
			$this->form_validation->set_rules('from_sender', 'from_sender');
			$this->form_validation->set_rules('mobile_no', 'mobile_no');
			$this->form_validation->set_rules('remarks', 'remarks');
			
            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->copy_outward_items($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Outward item Insert Successfully...!!!');
                    redirect(base_url('Visitor_entry/outward_item_list'));
                }
            }
        }

        theme('copy_outward_items',$data);
    }
	
	
	/* Visito Entry Search  Report */
	
	
	public function visitor_entry_report_list()
	{
		theme('visitor_entry_report_list');
	}
	

		
	
public function visitor_entry_search_ListJson()
	{
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$visitor = $_POST['visitor'];
		$type_of_entry = $_POST['type_of_entry'];
		$mobile_no = $_POST['mobile_no'];
		$purpose = $_POST['purpose'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Visitor_entry_model->search_visitor_ListCount($visitor,$type_of_entry,$mobile_no,$purpose,$sf_time,$st_time);
		

		$query = $this->Visitor_entry_model->search_visitor_List($limit, $start ,$visitor,$type_of_entry,$mobile_no,$purpose,$sf_time,$st_time);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	{
		foreach($query->result() as $r){
		  
				
			$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$created_by =  " ";
					}
			$query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

					if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row1) {
					$modified_by =  $row1->first_name.' '.$row1->last_name;
					}
					} else {
					$modified_by =  " ";
					}
              
			   $button = '';
                $button.= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_visitor_report/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
					
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/copy_visitor_report/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-copy"></i> </a>';
				 $data['data'][] = array(
					$button,
					date('d-m-Y H:i:s', $r->created_at),
					$created_by,
					$modified_by,
					$r->type_of_selection,
					$r->invoice_id,
				    $r->visitor_name,
					$r->item_name,
					$r->purpose,
					$r->email_id,
					$r->mobile_no,
					$r->type_of_id,
					$r->type_of_item,
					$r->item_number,
					$r->proof_number,					
					$r->item_value,
					$r->from_place,
					$r->to_reciver,
					$r->refferer,
					$r->whom_to_meet,
					$r->to_whom,
					$r->from_whom,
					$r->from_sender,
					$r->remarks,
				
					date('d-m-Y H:i:s', $r->modified_at) 
					
			);
		}
	}
		else{
			$data['data'][] = array(
				'Visitors not Available' , '', '','', '','','','','','','','','','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}

	
	 public function view_visitor_report($id) {
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'handover') die('Error! sorry');

				
				$this->form_validation->set_rules('role', 'role','required');
				$this->form_validation->set_rules('user', 'user','required');
				$this->form_validation->set_rules('start_date', 'start_date','required');
				$this->form_validation->set_rules('end_date', 'end_date','required');
				$this->form_validation->set_rules('cost_value_of_asset', 'cost_value_of_asset','required');
				$this->form_validation->set_rules('condition_of_asset', 'condition_of_asset','required');
				$this->form_validation->set_rules('next_renewal_date', 'next_renewal_date','required');
				
			if($this->form_validation->run() == true)
			{
					$insert = $this->Visitor_entry_model->add_assigned_to();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', ' Created Successfully!');
						redirect(base_url('Visitor_entry/assete_history_report'));
					}

			}
		}	
		
        $data['visitor'] = $this->db->get_where('visitors_details', ['id' => $id]);
        theme('view_visitor_report', $data);
    }





	
	 public function copy_visitor_report($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'visitors_details');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_visitor_report')
                die('Error! sorry');
			
			$this->form_validation->set_rules('visitor_name', 'visitor_name');	
			$this->form_validation->set_rules('item_name', 'item_name');	
			$this->form_validation->set_rules('type_of_id', 'type_of_id');
			$this->form_validation->set_rules('type_of_item', 'type_of_item');
			$this->form_validation->set_rules('item_number', 'item_number');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('invoice_id', 'invoice_id');
			$this->form_validation->set_rules('proof_number', 'proof_number');
			$this->form_validation->set_rules('email_id', 'email_id');
			$this->form_validation->set_rules('purpose', 'purpose');
			$this->form_validation->set_rules('item_value', 'item_value');
			$this->form_validation->set_rules('from_place', 'from_place');
			$this->form_validation->set_rules('to_reciver', 'to_reciver');
			$this->form_validation->set_rules('refferer', 'refferer');
			$this->form_validation->set_rules('whom_to_meet', 'whom_to_meet');
			$this->form_validation->set_rules('to_whom', 'to_whom');
			$this->form_validation->set_rules('from_whom', 'from_whom');
			$this->form_validation->set_rules('from_sender', 'from_sender');
			$this->form_validation->set_rules('mobile_no', 'mobile_no');
			$this->form_validation->set_rules('remarks', 'remarks');
			$this->form_validation->set_rules('custom1', 'custom1');
			$this->form_validation->set_rules('custom2', 'custom2');
			$this->form_validation->set_rules('custom3', 'custom3');
			$this->form_validation->set_rules('custom4', 'custom4');
			$this->form_validation->set_rules('custom5', 'custom5');


            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->copy_visitor_report($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Visitor   Insert Successfully...!!!');
                    redirect(base_url('Visitor_entry/visitor_entry_report_list'));
                }
            }
        }

        theme('copy_visitor_report',$data);
    }
	

	
	public function assete_history_report()
	{
		theme('assete_history_report');
	}
	

	public function view_asset_report($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['visitor'] = $this->db->get_where('assests_history', ['id' => $id]);
        theme('view_asset_report', $data);
    } 
	
	
public function asset_search_ListJson()
	{
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$user = $_POST['user'];
		$role = $_POST['role'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Visitor_entry_model->search_asset_ListCount($user,$role,$sf_time,$st_time);
		

		$query = $this->Visitor_entry_model->search_asset_List($limit, $start ,$user,$role,$sf_time,$st_time);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	{
		foreach($query->result() as $r){
		  
				
			 $query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$created_by =  " ";
					}
			
			$query4 = $this->db->get_where('users', ['id' => $r->assigned_to]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$assigned_to =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$assigned_to =  " ";
					}
			
			$query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

					if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row1) {
					$modified_by =  $row1->first_name.' '.$row1->last_name;
					}
					} else {
					$modified_by =  " ";
					} 
			
              
			   $button = '';
                $button.= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/view_asset_report/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
					
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitor_entry/copy_asset_history/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-copy"></i> </a>';
				 $data['data'][] = array(
					$button,
					date('d-m-Y H:i:s', $r->created_at),
					$created_by,
					$modified_by,
					$assigned_to,
					$r->visitor_id,
					$r->role,
				    $r->user,
				    $r->cost_value_of_asset,
				    $r->condition_of_asset,
				    $r->next_renewal_date,
					$r->status,
					$r->start_date,
					$r->end_date,
					date('d-m-Y H:i:s', $r->modified_at) 
					
			);
		}
	}
		else{
			$data['data'][] = array(
				'Visitors not Available' , '', '','', '','','','','','',''
				);
		
		}
		echo json_encode($data);

	}
	
	
	 public function copy_asset_history($id) {
		 
		
      // permittedArea();
		        
		$data['visitor_entry'] = singleDbTableRow($id, 'assests_history');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_asset')
                die('Error! sorry');
			
			$this->form_validation->set_rules('visitor_id', 'visitor_id');	
			$this->form_validation->set_rules('role', 'role');	
			$this->form_validation->set_rules('user', 'user');	
			$this->form_validation->set_rules('status', 'status');	
			$this->form_validation->set_rules('start_date', 'start_date');	
			$this->form_validation->set_rules('end_date', 'end_date');	
			


            if ($this->form_validation->run() == true) {
                $insert = $this->Visitor_entry_model->copy_asset_report($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', ' Insert Successfully...!!!');
                    redirect(base_url('Visitor_entry/assete_history_report'));
                }
            }
        }

        theme('copy_asset_history',$data);
    }
	

}