<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Transaction_model');

        check_auth(); //check is logged in.
    }

    /**
     * Listing all transaction 
     */
    public function index() {

        theme('all_transaction');
    }

    public function add_transaction() {
        //restricted this area, only for admin
        permittedArea();
        //$data['pay_type'] = $this->db->get('accounts');

        $where_array1 = array('parentid' => '');
        $data['main_category'] = $this->db->where($where_array1)->get('acct_categories');

        //$where_array2 = array('parentid' =>'7');
        //$data['business_name'] = $this->db->where($where_array2)->get('acct_categories');
        $data['rolename'] = $this->db->get('role');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_transaction')
                die('Error! sorry');

            //$this->form_validation->set_rules('business_name', 'business Name ', 'required|trim');
            $this->form_validation->set_rules('transaction_mode', 'Transaction Mode', 'trim|required');
            $this->form_validation->set_rules('main_category', 'Main Category', 'trim|required');
            $this->form_validation->set_rules('business_name', 'Sub-Accounts category', 'trim|required');
            $this->form_validation->set_rules('reporting_manager', 'Reporting Manager', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('receiver_name', 'Receiver Name', 'trim|required');
            $this->form_validation->set_rules('sancatie_by', 'Sancatie By', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Transaction_model->add_transaction();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Transaction Created Success');
                    redirect(base_url('transaction'));
                }
            }
        }

        theme('add_transaction', $data);
    }

    public function getname() {

        $id = $_POST['parentid'];
        $sql = "select * from acct_categories where parentid='$id'";
		
        $query = $this->db->query($sql);
        $name = $query->result();
        $data = '<option value=""> Choose option </option>';
        foreach ($name as $st) {
            $data .= "<option value=" . $st->id . ">" . $st->name . "</option>";
        }
        echo $data;
    }

    //add transaction
    public function transactionListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Transaction_model->transactionListCount();


        $query = $this->Transaction_model->transactionList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('transaction/view_transaction/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

                $data['data'][] = array(
                    $button,
                    //$r->id,
                    $r->receiver_name,
                    $r->amount,
                    $r->trans_date,
                    $r->trans_time
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Transaction list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }

    //view transaction

    public function view_transaction($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['transaction_Details'] = $this->db->get_where('regular_transaction', ['id' => $id]);
        theme('view_transaction', $data);
    }

    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'regular_transaction');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} regular_transaction");
        //Now delete permanently
        $this->db->where('id', $id)->delete('regular_transaction');
        return true;
    }

    //<!-----edit transaction------------->


    public function edit_transaction($id) {
        //restricted this area, only for admin
        //	permittedArea();

        $where_array1 = array('parentid' => '');
        $data['main_category'] = $this->db->where($where_array1)->get('acct_categories');


        $data['rolename'] = $this->db->get('role');
        $data['name'] = $this->db->get('acct_categories');
        //$data['rolename'] = $this->db->get('role');

        $data['regular_transaction'] = singleDbTableRow($id, 'regular_transaction');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transaction')
                die('Error! sorry');
			
			
            $this->form_validation->set_rules('transaction_mode', 'transaction mode', 'required|trim');
			$this->form_validation->set_rules('reporting_manager','Reporting Manager', 'required|trim');
			$this->form_validation->set_rules('amount','Amount','required|trim');
			$this->form_validation->set_rules('receiver_name','Receiver Name', 'required|trim');
			$this->form_validation->set_rules('sancatie_by','Sancatie by', 'required|trim');
			

            if ($this->form_validation->run() == true) {
                $insert = $this->Transaction_model->edit_transaction($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'transaction Updated Successfully...!!!');
                    redirect(base_url('transaction'));
                }
            }
        }

        theme('edit_transaction', $data);
    }

}

//last 
