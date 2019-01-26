<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_address extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Address_model');

        check_auth(); //check is logged in.
    }

    /**
     * home page of settings
     */
    public function address_Index() {
        //restricted this area, only for admin
        //	permittedArea();

        theme('address_Index');
    }

    public function addAddress() {
        //restricted this area, only for admin
        //permittedArea();
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $data['res'] = singleDbTableRow($user_id, 'users');

        $data['country'] = $this->db->group_by('country')->get('pincode');
        $data['bg'] = $this->db->get_where('status',['business_name'=> '19']);
        //	$data['district'] = $this->db->get('district');
        //	$data['taluk'] = $this->db->get('taluk');
        //	$data['location_id'] = $this->db->get('location_id');
        //	$data['pincode'] = $this->db->get('area');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'saveAddress')
                die('Error! sorry');
            $this->form_validation->set_rules('business_groups', 'Business Group');
            $this->form_validation->set_rules('user_id', 'User Id');
            $this->form_validation->set_rules('address_type', 'Address_type', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            //	$this->form_validation->set_rules('taluk', 'Taluk', 'required');
            $this->form_validation->set_rules('location_id', 'Location Id', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('house_buildingno', 'House/Bulding No', 'required');
            $this->form_validation->set_rules('street_name', 'Street Name ', 'required');
            $this->form_validation->set_rules('land_mark', 'Land Mark', 'required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Address_model->addAddress();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'User Address Created Successfully!');
                    redirect(base_url('User_address/address_Index'));
                }
            }
        }

        theme('addAddress', $data);
    }

    public function userAddressListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');


        $queryCount = $this->Address_model->addressListCount();


        $query = $this->Address_model->addressList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {


                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('user_address/address_view/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                $button .= '<a class="btn btn-info editBtn"  href="' . base_url('user_address/edit/' . $r->id) . '" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
                /* 	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
                  <i class="fa fa-trash"></i> </a>'; */


                $data['data'][] = array(
                    $button,
                    $r->address_type,
                    $r->country,
                    $r->state,
                    $r->district,
                    $r->location_id,
                    $r->pincode,
                    $r->house_buildingno,
                    $r->street_name,
                    $r->land_mark
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Data', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }

    // ****** Profile View ******/


    public function address_view($id) {
        //restricted this area, only for admin
        //permittedArea();

        $data['address_Details'] = $this->db->get_where('user_address', ['id' => $id]);

        theme('address_view', $data);
    }

    public function my_address_view() {
        //restricted this area, only for admin
        //permittedArea();
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data['address_Details'] = $this->db->get_where('user_address', ['user_id' => $user_id]);
        //$data['support_Details'] = $this->db->get_where('ticket_list', ['id' => $id]);

        theme('my_address_view', $data);
    }

    //************ address edit ************** //



    public function edit($id) {
        //restricted this area, only for admin
        //	permittedArea();
        //	$data['user_address'] = singleDbTableRow($id,'user_address');

        $data['result'] = singleDbTableRow($id, 'user_address');
        $data['res'] = singleDbTableRow($id, 'users');
        $data['country'] = $this->db->group_by('country')->get('pincode');
        $data['bg'] = $this->db->get_where('status',['business_name'=> '19']);

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'saveAddress')
                die('Error! sorry');
            $this->form_validation->set_rules('business_groups', 'Business Group');
            $this->form_validation->set_rules('user_id', 'User Id');
            $this->form_validation->set_rules('address_type', 'Address_type', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            //	$this->form_validation->set_rules('taluk', 'Taluk', 'required');
            $this->form_validation->set_rules('location_id', 'Location Id', 'required');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required');
            $this->form_validation->set_rules('house_buildingno', 'House/Bulding No', 'required');
            $this->form_validation->set_rules('street_name', 'Street Name ', 'required');
            $this->form_validation->set_rules('land_mark', 'Land Mark', 'required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Address_model->edit_address($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'User Address Updated Successfully...!!!');
                     redirect(base_url('User_address/address_Index'));
                }
            }
        }

        theme('address_edit', $data);
    }

    public function getstate() {
        $country = $_POST['country'];
        //   echo $country;
        $query = $this->Address_model->state($country);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->state . "'>" . $r->state . "</option>";
        }
    }

    public function get_district() {
        $state = $_POST['state'];

        $query = $this->Address_model->district($state);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->district . "'>" . $r->district . "</option>";
        }
    }

    public function get_location_id() {
        $district = $_POST['district'];

        $query = $this->Address_model->location($district);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->location . "'>" . $r->location . "--" . $r->pincode . "</option>";
        }
    }

    public function get_pincode() {
        $location = $_POST['location'];

        $query = $this->Address_model->pincode($location);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->pincode . "'>" . $r->pincode . "</option>";
        }
    }

    public function get_address_type() {
        $address_type = $_POST['type'];

        $query = $this->Address_model->address_type($address_type);
        if ($query) {
            echo 0;
        } else {
            echo 1;
        }
    }

    public function get_area() {
        $location_id = $_POST['location_id'];
        // echo $categ;
        $pincode = $this->Address_model->area($location_id);


        if ($pincode->num_rows() > 0) {
            foreach ($pincode->result() as $c) {
                $pincode_name = explode(",", $c->pincode);
                foreach ($pincode_name as $pincode_id) {
                    //$query = $this->db->group_by('pincode')->get_where('pincode', ['pincode'=>$pincode_id]);
                    $query = $this->db->group_by('pincode')->get_where('pincode', ['pincode' => $pincode_id]);
                    foreach ($query->result() as $d) {
                        echo "<option value='" . $pincode_id . "' selected>" . $d->pincode . "-" . $d->location . "-" . $d->state . "-" . $d->state . "</option>";
                    }
                }
            }
        } else {
            echo "<option value=''>Select option</option>";
        }
    }

}
