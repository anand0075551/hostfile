<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_invoice_model extends CI_Model {

	public function add_template(){

		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];

		//set all data for inserting into database
		$data = [
			'pay_type'        		=> $this->input->post('pay_type'),
			'template_name'     	=> $this->input->post('template_name'),
			'title'         		=> $this->input->post('title'),
			'date'         			=> $this->input->post('date'),
			'sender_name'       	=> $this->input->post('sender'),
			'receiver_name'     	=> $this->input->post('receiver'),
			'invoice_no'       	 	=> $this->input->post('invoice_no'),
			'sl_no'         		=> $this->input->post('qty'),
			'transaction_remarks'   => $this->input->post('trans_remark'),
			'business_category'     => $this->input->post('biz_catg'),
			'price'         		=> $this->input->post('price'),
			'sub_total'         	=> $this->input->post('subtotal'),
			'total'         		=> $this->input->post('total'),
			'created_at'			=> time(),
			'created_by'			=> $user_id
		];

	   $query = $this->db->insert('dynamic_invoice', $data);

		if($query)
		{
			create_activity('Added '.$data['template_name'].' For Dynamic Invoice'); //create an activity
			return true;
		}
		return false;

	}
	
	
	/**
     * @return Agent List
     * Agent List Query
     */

    public function templateListcount(){
		
		$query = $this->db->count_all_results('dynamic_invoice');
		
		return $query; 
		
    }

    public function templateList($limit = 0, $start = 0){
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('dynamic_invoice');
		
        return $query; 
		
    }
	
	
	public function edit_template($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        //set all data for inserting into database
        $data = [
            'pay_type'        		=> $this->input->post('pay_type'),
            'template_name'     	=> $this->input->post('template_name'),
            'title'         		=> $this->input->post('title'),
            'date'         			=> $this->input->post('date'),
            'sender_name'       	=> $this->input->post('sender'),
            'receiver_name'     	=> $this->input->post('receiver'),
            'invoice_no'       	 	=> $this->input->post('invoice_no'),
            'sl_no'         		=> $this->input->post('qty'),
            'transaction_remarks'   => $this->input->post('trans_remark'),
            'business_category'     => $this->input->post('biz_catg'),
            'price'         		=> $this->input->post('price'),
            'sub_total'         	=> $this->input->post('subtotal'),
            'total'         		=> $this->input->post('total'),
            'modified_at'			=> time(),
            'modified_by'			=> $user_id
        ];

        $query = $this->db->where('id', $id)->update('dynamic_invoice', $data);

        if($query)
        {
            create_activity('Updated '.$data['template_name'].' For Dynamic Invoice'); //create an activity
            return true;
        }
        return false;

    }
	
	
	public function copy_template(){

		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];

		//set all data for inserting into database
		$data = [
			'pay_type'        		=> $this->input->post('pay_type'),
			'template_name'     	=> $this->input->post('template_name'),
			'title'         		=> $this->input->post('title'),
			'date'         			=> $this->input->post('date'),
			'sender_name'       	=> $this->input->post('sender'),
			'receiver_name'     	=> $this->input->post('receiver'),
			'invoice_no'       	 	=> $this->input->post('invoice_no'),
			'sl_no'         		=> $this->input->post('qty'),
			'transaction_remarks'   => $this->input->post('trans_remark'),
			'business_category'     => $this->input->post('biz_catg'),
			'price'         		=> $this->input->post('price'),
			'sub_total'         	=> $this->input->post('subtotal'),
			'total'         		=> $this->input->post('total'),
			'created_at'			=> time(),
			'created_by'			=> $user_id
		];

	   $query = $this->db->insert('dynamic_invoice', $data);

		if($query)
		{
			create_activity('Copied '.$data['template_name'].' For Dynamic Invoice'); //create an activity
			return true;
		}
		return false;

	}



}