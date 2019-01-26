<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Star_ratings extends CI_Controller
{

	function __construct()
	{
		parent:: __construct();
		$this->load->model('Star_ratings_model');
		check_auth(); //check is logged in.
	}

public function star_ratings()
	{
	 $data['bg'] = $this->db->get('business_groups');
		if ($this->input->post()) {
				if($this->input->post('submit') == 'add_star')
					{	
					$this->form_validation->set_rules('ratings', 'ratings', 'required'); 
					$this->form_validation->set_rules('business_groups', 'business_groups', 'required'); 
					$this->form_validation->set_rules('source', 'source', 'required'); 
					$this->form_validation->set_rules('comment', 'comment', 'required'); 
					if ($this->form_validation->run() == true)
						{
							$insert = $this->Star_ratings_model->star_ratings();
							if ($insert) 
								{
									$this->session->set_flashdata('successMsg', 'Thanks For Rating Us!!!');
									redirect(base_url('dashboard'));
								}
						}
				  }
		      elseif($this->input->post('submit1') == 'not_Int')
			  {
				$insert = $this->Star_ratings_model->star_ratings1();
				if ($insert)
					{
						$messge = array('message' => 'Wrong password enter','class' => 'alert alert-danger fade in');
						$this->session->set_flashdata('successMsg', $messge);
						redirect(base_url('dashboard'));
					}
			   }
			   else
			   {
				   echo("Error while saving");
			   }
			}
		theme('star_ratings',$data);
	}
 public function star_ratings_ListJson() 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$star         = $_POST['star'];
		$business_name= $_POST['business_name'];
		$sf_time      = $_POST['sf_time'];
		$st_time      = $_POST['st_time'];
		$limit        = $this->input->POST('length');
		$start        = $this->input->POST('start');

        $queryCount = $this->Star_ratings_model->star_ratings_ListCount($star,$business_name, $sf_time,$st_time);
        $query = $this->Star_ratings_model->star_ratings_List($limit,$start,$business_name,$star,$sf_time,$st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
							if($r->status == 1)
							{
								$status = "Available";
							}
							else
							{
								$status = "Not available";
							}
			$query1 = $this->db->get_where('users',['id'=>$r->rate_by]);
				foreach($query1->result() as $p)
			{
				$rate_by = $p->first_name. ' ' .$p->last_name;
			}
			$query2 = $this->db->get_where('business_groups',['id'=>$r->business_id]);
				foreach($query2->result() as $q)
			{
				$business_id = $q->business_name;
			}
				//Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Star_ratings/view_star_ratings/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				$button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
				<i class="fa fa-trash"></i> </a>';

                $data['data'][] = array(
                    $button,
					$business_id,
					$rate_by,
					$r->star,
					$status,
					$r->comment
                );
            }
        } else {
            $data['data'][] = array(
                'No Ratings Found' , '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	public function star_ratings_index()
	{
		theme('star_ratings_index');
	}
	public function view_star_ratings($id) 
	{
        $data['profile'] = $this->db->get_where('ratings', ['id' => $id]);
        theme('view_star_ratings', $data);
    }
	public function deleteAjaxstar() {
        $id = $this->input->post('id');
        $userInfo = singleDbTableRow($id, 'ratings');
        $categoryName = $userInfo->name;
        $this->db->where('id', $id)->delete('ratings');
        return true;
    }
	public function edit_star_ratings($id) 
	{
	$data['star'] = singleDbTableRow($id, 'ratings');
	
	if ($this->input->post()) 
		{
			if ($this->input->post('submit') != 'Update_ratings')
				die('Error! sorry');
				$this->form_validation->set_rules('star', 'star', 'required'); 
				$this->form_validation->set_rules('comment', 'comment', 'required');
			if ($this->form_validation->run() == true) {
				$insert = $this->Star_ratings_model->edit_star_ratings($id);
				if ($insert==true) {
					$this->session->set_flashdata('successMsg', 'Ratings Updated Successfully...!!!');
					redirect(base_url('Star_ratings/star_ratings_index'));
				}
			}
		}

        theme('edit_star_ratings', $data);
    }
}