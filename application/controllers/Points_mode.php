<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Points_mode extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Points_mode_model');

		check_auth(); //check is logged in.
	}
	
	

	public function create_points_mode(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_points_mode') die('Error! sorry');

			$this->form_validation->set_rules('pm_name', 'Points Mode Name', 'required|trim|is_unique[points_mode.pm_name]');
		//	$this->form_validation->set_rules('rolename', 'Role Name', 'required|trim|is_unique[role.rolename]');
         //   $this->form_validation->set_rules('roleid', 'Role Id', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Points_mode_model->create_points_mode();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Points Mode Created Successfully...!!!');
					redirect(base_url('points_mode/points_mode'));
				}
			}
		}
      
       
		theme('create_points_mode');
	}


	
	
	public function points_mode()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('points_mode');
	}
	
public function points_modeListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->Points_mode_model->points_modeListCount();
		$query = $this->Points_mode_model->points_modeList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){



			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('points_mode/view_pointsmode_name/'. $r->id).'" title="View"> 
						<i class="fa fa-eye"></i> </a>';
			
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->id,
				$r->pm_name,
	
			);
		}
}
		else{
			$data['data'][] = array(
				'No Data' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}
	



    public function view_pointsmode_name($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['support_Details'] = $this->db->get_where('points_mode', ['id' => $id]);
        theme('view_pointsmode_name', $data);
    }	
	
	
 public function points_mode_edit($id) {
      
      permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['points_mode'] = singleDbTableRow($id, 'points_mode');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'points_mode_edit')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('pm_name', 'Points Mode Name', 'trim|required'); 

            if ($this->form_validation->run() == true) {
                $insert = $this->Points_mode_model->points_mode_edit($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Points Mode Updated Successfully...!!!');
                    redirect(base_url('points_mode/points_mode'));
                }
            }
        }

        theme('points_mode_edit', $data);
    }
	
	
	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'points_mode');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} Role");
		//Now delete permanently
		$this->db->where('id', $id)->delete('points_mode');
		return true;
	}
	
	
	
	
	
	public function vouchers_epin_index()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('vouchers_epin_index');
	}
		

	

/**
	 * Set block or unblock through this api
	 */

	public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
	//	$button_role_id = $this->input->post('button_role_id');
		$status = $this->input->post('status');

		//get deleted user info
	//	$userInfo = singleDbTableRow($id);
	//	$fullName = user_full_name($userInfo);
		// add a activity
	//	create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('vouchers', ['active' => $buttonValue]);

		
		return true;
		
		/* Anand */
		//$this->db->where('id', $id)->update('role_groups', ['roleid' => $r->id]);
		//return true;
		
		
	}
	
	

	

}
?>