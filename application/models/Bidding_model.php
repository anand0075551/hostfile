<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidding_model extends CI_Model 
{
	
	/*
	Biddings 
	*/
	public function get_state($country)
    {
      $where_array = array( 'country' => $country);
      $table_name="pincode";
       $query = $this->db->group_by('state')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_district($state)
    {
      $where_array = array( 'state' => $state);
      $table_name="pincode";
       $query = $this->db->group_by('district')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_location($district)
    {
      $where_array = array( 'district' => $district);
      $table_name="pincode";
       $query = $this->db->order_by('id')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	function my_biddings()
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$this->db->select('bt.id,bt.bidding_no,bt.event_no,bt.product,bt.amount,bt.quantity,b.quantity AS q,b.type,b.created_at,prod.title');
		$this->db->from('bidding_user_track AS bt');// I use aliasing make joins easier
		$this->db->join('smb_product AS prod', 'bt.product = prod.id', 'LEFT');
		$this->db->join('bidding AS b', 'bt.bidding_no = b.bidding_no', 'LEFT');
		$this->db->where(array( 'bt.user_id' => $userID));
		$query = $this->db->get();
		
		 if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	public function bidding_List($limit = 0, $start = 0)
	{
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';
		
		$table_name = "bidding";
		
		if($searchValue != '')																							
		{																												
			
			if($currentRolename == 18 )/* AM  */
			{
				
				$where_array = " approved = 0 AND closed = 0 AND  bidding_no like '%".$searchValue."%'";
				//$this->db->where(array( 'b.approved' => 0,'b.closed' => 0  ));
			}
			else if($currentRolename == 39 )/* EM  */
			{
				$where_array = " approved = 1 AND closed = 0 AND event_manager = ".$userID." AND event_created = 0 AND  bidding_no like '%".$searchValue."%'";
				//$this->db->where(array( 'b.approved' => 1,'b.closed' => 0,'b.event_manager' =>$userID,'b.event_created' =>0  ));
			}
			else
			{	
				$where_array = " bidding_no like '%".$searchValue."%'";	
			}
			$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else
		{
			if($currentRolename == 18 )/* AM  */
			{
				$where_array = " approved = 0 AND closed = 0 ";
				$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
				//$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->where('approved' == 0,'closed' == 0)->get('bidding');
			}
			else if($currentRolename == 39 )/* EM  */
			{
				$where_array = " approved = 1 AND closed = 0 AND event_manager = ".$userID." AND event_created = 0 ";
				$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
				//$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->where('approved' == 0,'closed' == 0)->get('bidding');
				//$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->where('approved' == 1,'closed' == 0,'event_manager' ==$userID,'event_created' ==0)->get('bidding');
			}
			else/* Admin */
			{
				$query = $this->db->order_by('bidding_id', 'desc')->limit($limit, $start)->get('bidding');
			}
			
        	
		}
		return $query;
    }
	//function bidding_list()
//    {
//		//Get Decision who in online?
//		$user = loggedInUserData();
//		$userID = $user['user_id'];
//		$currentRolename   = singleDbTableRow($userID)->rolename;
//		$table_name="bidding";
//		$this->db->select('b.bidding_id,b.created_by,b.created_at,b.type,b.category,b.sub_category,b.product,b.amount,b.amount_msr,b.quantity,b.bidding_no,b.approved,u.first_name,u.last_name,u.email,u.contactno,categ.category_name,sub_categ.sub_category_name,prod.title');
//		$this->db->from('bidding AS b');// I use aliasing make joins easier
//		$this->db->join('users AS u', 'b.created_by = u.id', 'LEFT');
//		$this->db->join('smb_category AS categ', 'b.category = categ.id', 'LEFT');
//		$this->db->join('smb_sub_category AS sub_categ', 'b.sub_category = sub_categ.sub_id', 'LEFT');
//		$this->db->join('smb_product AS prod', 'b.product = prod.id', 'LEFT');
//		/* area manager */
//		if($currentRolename == 18 )
//		{
//		$this->db->where(array( 'b.approved' => 0,'b.closed' => 0  ));
//		}
//		/* EM  */
//		else if($currentRolename == 39 )
//		{
//		$this->db->where(array( 'b.approved' => 1,'b.closed' => 0,'b.event_manager' =>$userID,'b.event_created' =>0  ));
//		}
//		$query = $this->db->get();
//
//	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
//        if($query->num_rows() > 0){
//            $result = $query->result_array();
//            return $result;
//        }else{
//            return false;
//        }
//    }
	/* View */
	function bidding_view($bno)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		$table_name="bidding";
		$this->db->select('b.bidding_id,b.created_by,b.created_at,b.type,b.category,b.sub_category,b.product,b.amount,b.quantity,b.bidding_no,b.approved,b.approved_by,u.first_name,u.last_name,u.email,u.contactno,categ.category_name,sub_categ.sub_category_name,prod.title');
		$this->db->from('bidding AS b');// I use aliasing make joins easier
		$this->db->join('users AS u', 'b.created_by = u.id', 'LEFT');
		$this->db->join('smb_category AS categ', 'b.category = categ.id', 'LEFT');
		$this->db->join('smb_sub_category AS sub_categ', 'b.sub_category = sub_categ.id', 'LEFT');
		$this->db->join('smb_product AS prod', 'b.product = prod.id', 'LEFT');
		
		$this->db->where(array( 'b.bidding_no' => $bno));
		
		$query = $this->db->get();

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function bidding_view_details($bno)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		 $where_array = "bidding_user_seller='".$bno."' OR bidding_user_buyer='".$bno."'";
	  $table_name="bidding_event_track";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
		 if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function event_view($eno)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		$table_name="bidding_events";
		$this->db->select('e.event_no,e.product,e.users,e.start_time,e.end_time,e.status,e.created_by,e.created_at,e.location,prod.title');
		$this->db->from('bidding_events AS e');// I use aliasing make joins easier
		$this->db->join('smb_product AS prod', 'e.product = prod.id', 'LEFT');
		
		$this->db->where(array( 'e.event_no' => $eno));
		
		$query = $this->db->get();

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function list_event_users($eno)
    {
		$this->db->select('eu.id,eu.event_no,eu.bidding_no,eu.bidding_name,eu.user_type,eu.amount,eu.user_id,eu.created_by,b.created_at,b.approved,b.approved_by,b.approved_at,b.quantity,bt.amount AS actual_amount,bt.quantity AS actual_quantity');
		$this->db->from('bidding_event_users AS eu');// I use aliasing make joins easier
		$this->db->join('bidding AS b', 'eu.bidding_no = b.bidding_no', 'LEFT');
		$this->db->join('bidding_user_track AS bt', 'eu.bidding_no = bt.bidding_no', 'LEFT');
		
		$this->db->where(array( 'eu.event_no' => $eno));
		
		$query = $this->db->get();

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function users_chat($eno)
    {
		 $where_array = (array( 'event_no' => $eno));
	  $table_name="bidding_user_chat";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
		 if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function list_freez_request($eno)
    {
		 $where_array = (array( 'event_no' => $eno));
	  $table_name="bidding_freez";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
		 if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function list_event_track($eno)
    {
		$this->db->select('et.id,et.track_id,et.bidding_user_seller,et.bidding_user_buyer,et.confirmed_user,et.confirmed_amount,et.confirmed_quantity,et.confirmed_status,et.confirmed_by,et.cons_no,et.release_fund,br.total_quantity,br.damaged,br.released_amount,br.comments');
		$this->db->from('bidding_event_track AS et');// I use aliasing make joins easier
		$this->db->join('bidding_review AS br', 'et.track_id = br.track_id', 'LEFT');
		
		
		$this->db->where(array( 'et.event_no' => $eno));
		
		$query = $this->db->get();

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	/*
	Confirm order 
	*/
	function confirm_bidding_list()
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		 $where_array = array( 'confirmed_status' => 0 );
	  $table_name="bidding_event_track";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
		 if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	/*
	Confirm order 
	*/
	function fund_release_list()
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		 $where_array = array( 'confirmed_status' => 1 ,'release_fund' => 0 );
	  $table_name="bidding_event_track";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
		 if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }

	/*
	Events 
	*/
	function bidding_events()
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		 //$where_array = array( 'status' => 1 );
	  	$table_name="bidding_events";
	   $query = $this->db->order_by('id', 'desc')->get($table_name); 

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function bidding_event_products()
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		 //$where_array = array( 'status' => 1 );
	  	$table_name="bidding_events";
	   $query = $this->db->group_by('product')->order_by('id', 'desc')->get($table_name); 

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	function export_to_pdf()
    {
		
		/* POST */
		$location=$this->input->post('location');
		
		$sf_time=$this->input->post('sf_time');
		$st_time=$this->input->post('st_time');
		if($sf_time !='' && $st_time !='')
		{
		$start_fdt = new DateTime($sf_time);
		$start_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($st_time);
		$start_to = $start_tdt->format('Y/m/d');
		}
		
		$ef_time=$this->input->post('ef_time');
		$et_time=$this->input->post('et_time');
		
		if($ef_time !='' && $et_time !='')
		{
		$end_fdt = new DateTime($ef_time);
		$end_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($et_time);
		$end_to = $end_tdt->format('Y/m/d');
		}
		
		/* /POST */
		/* CONDITIONS */
		$condition="";
		if($location !='')
		{
			$condition.=" e.location = '".$location."'";
		}
		if($sf_time !='' && $st_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(e.start_time) BETWEEN '".$start_from."' AND '".$start_to."') " : " (DATE(e.start_time) BETWEEN '".$start_from."' AND '".$start_to."')" ;
		}
		if($ef_time !='' && $et_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(e.end_time) BETWEEN '".$end_from."' AND '".$end_to."') " : " (DATE(e.end_time) BETWEEN '".$end_from."' AND '".$end_to."')" ;
		}
		
		/* */
		$this->db->select('e.event_no,e.product,e.users,e.start_time,e.end_time,e.status,e.created_by,e.created_at,e.location,prod.title');
		$this->db->from('bidding_events AS e');
		$this->db->join('smb_product AS prod', 'e.product = prod.id', 'LEFT');
		if($condition !='')
		{
		$this->db->where($condition);
		}
		$query = $this->db->get();
		
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	
	function export_to_csv()
    {
		
		/* POST */
		$location=$this->input->post('location');
		
		$sf_time=$this->input->post('sf_time');
		$st_time=$this->input->post('st_time');
		if($sf_time !='' && $st_time !='')
		{
		$start_fdt = new DateTime($sf_time);
		$start_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($st_time);
		$start_to = $start_tdt->format('Y/m/d');
		}
		
		$ef_time=$this->input->post('ef_time');
		$et_time=$this->input->post('et_time');
		
		if($ef_time !='' && $et_time !='')
		{
		$end_fdt = new DateTime($ef_time);
		$end_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($et_time);
		$end_to = $end_tdt->format('Y/m/d');
		}
		
		/* /POST */
		/* CONDITIONS */
		$condition="";
		if($location !='')
		{
			$condition.=" e.location = '".$location."'";
		}
		if($sf_time !='' && $st_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(e.start_time) BETWEEN '".$start_from."' AND '".$start_to."') " : " (DATE(e.start_time) BETWEEN '".$start_from."' AND '".$start_to."')" ;
		}
		if($ef_time !='' && $et_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(e.end_time) BETWEEN '".$end_from."' AND '".$end_to."') " : " (DATE(e.end_time) BETWEEN '".$end_from."' AND '".$end_to."')" ;
		}
		
		/* */
		$this->db->select('e.event_no,e.product,e.users,e.start_time,e.end_time,e.status,e.created_by,e.created_at,e.location,prod.title');
		$this->db->from('bidding_events AS e');// I use aliasing make joins easier
		$this->db->join('smb_product AS prod', 'e.product = prod.id', 'LEFT');
		if($condition !='')
		{
		$this->db->where($condition);
		}
		$query = $this->db->get();
		
        if($query->num_rows() > 0){
            $result = $query->result_array();
			$filename='bidding_events.csv';
			$csv= "Event No,Event Location,Created By,Product,No: of Users,Start Time,End Time,Status\n";//Column headers
			foreach ($result as $results)
			{
				$users=explode(',',$results['users']); 
				$csv.= $results['event_no'].','.$results['location'].','.singleDbTableRow($results['created_by'])->first_name.' '.singleDbTableRow($results['created_by'])->last_name.','.$results['title'].','.count($users).','. $results['start_time'].','. $results['end_time'].','. $results['status']."\n"; //Append data to csv
			}
	
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$csv";
	exit;
            //return $result;
        }else{
            return false;
        }
    }
	//upadte
	function update_bidding($ev)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$amount=$this->input->post('amount');
		$quantity=$this->input->post('quantity');
		$bno=$this->input->post('bbno');
		$prod=$this->input->post('bproduct');
		$data1 = [
			'amount'  	=> $amount,
			'quantity'  	=> $quantity
			];
		$data2 = [
			'user_id'  	=> $userID,
			'bidding_no'  	=> $bno,
			'event_no'  	=> $ev,
			'product'  	=> $prod,
			'quantity'  	=> $quantity,
			'created_by'  	=> $userID,
			'created_at'  	=> time(),
			'amount'  	=> $amount
			
			];
		$data3 = [
		'amount'  	=> $amount
		
		];
			$query1 = $this->db->where('created_by', $userID,'bidding_no', $bno )->update('bidding', $data1);
			$query2 = $this->db->insert('bidding_user_track', $data2);
			$query3 = $this->db->where('user_id', $userID,'bidding_no', $bno ,'event_no',$ev )->update('bidding_event_users', $data3);
			if($query1 && $query2 && $query2 )
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	function update_event($eno)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$location=$this->input->post('elocation');
		$f_time=$this->input->post('f_time');
		$t_time=$this->input->post('t_time');
		$status=$this->input->post('status');
		
		$data1 = [
			'location'  	=> $location,
			'start_time'  	=> $f_time,
			'end_time'  	=> $t_time,
			'status'  	=> $status,
			'modified_by'  	=> $userID,
			'modified_at'  	=> time()
			];
		
			$query1 = $this->db->where('event_no', $eno )->update('bidding_events', $data1);
			if($query1)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	//online
	function set_online_user($ev)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$data = [
			'login_status'  	=> 1
			];
			$query = $this->db->where('user_id', $userID,'event_no', $ev )->update('bidding_event_users', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	//offline
	function set_offline_user($ev)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$data = [
			'login_status'  	=> 0
			];
			$query = $this->db->where('user_id', $userID,'event_no', $ev )->update('bidding_event_users', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
		
	}
	/*
	User Events 
	*/
	function my_bidding_events()
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$today=date('Y/m/d H:i');
		$where_array = "FIND_IN_SET('".$userID."', users) AND status=1";  
	  	$table_name="bidding_events";
		$this->db->select('be.id,be.event_no,be.product,be.start_time,be.end_time,be.users,prod.title');
		$this->db->from('bidding_events AS be');// I use aliasing make joins easier
		$this->db->join('smb_product AS prod', 'be.product = prod.id', 'LEFT');
		
		$this->db->where("FIND_IN_SET('".$userID."', be.users) AND be.status=1 AND DATE(start_time) <='".$today."' ");
		
		$query = $this->db->get();
		
	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	function get_user_type($ev,$userID)
	{
		$where_array = array( 'user_id' => $userID , 'event_no' => $ev );
	  	$table_name="bidding_event_users";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->user_type;
        }
        return false;
	}
	function event_users($ev)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$user_type=$this->get_user_type($ev,$userID);
		$where_array = "event_no='".$ev."' AND user_id !=".$userID." AND status=1 AND user_type !='".$user_type."'";  
	  	$table_name="bidding_event_users";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
             return $query;
        }else{
            return false;
        }
    }
	function user_event_details($ev)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$where_array = "event_no='".$ev."' AND user_id =".$userID." AND status=1";  
	  	$table_name="bidding_event_users";
	   $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            foreach($query->result() as $row);
            $bno= $row ->bidding_no;
			$details=$this->bidding_view($bno);
			return $details;
        }else{
            return false;
        }
    }
	//What is happening
	function event_changes($ev)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$where_array = "event_no='".$ev."'  AND request_accept=1";  
	  	$table_name="bidding_freez";
	   $query = $this->db->order_by('id', 'desc')->limit(4,0)->where($where_array )->get($table_name); 

	   //$query = $this->db->order_by('bidding_id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
           $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	/*
		Get all categries
	*/
	function get_category()
    {
        $query = $this->db->order_by('category_name', 'asc')->get('smb_category');
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	/*
	Get all sub categries of category
	*/
	function get_subcategory($categ)
    {
      $where_array = array( 'category' => $categ );
	  $table_name="smb_sub_category";
	   $query = $this->db->order_by('sub_category_name', 'asc')->where($where_array )->get($table_name); 
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	/*
	Get all products of sub category
	*/
	function get_product($subcateg)
    {
		//
		 /*$get_bussiness = $this->db->get_where('business_groups', ['business_name'=>'BIDDING']);
		foreach($get_bussiness->result() as $b);
		echo $bussiness = $b->id;*/
		//
     /* $where_array = array( 'sub_category' => $subcateg,'business_types' => $bussiness );*/
	 $where_array = array( 'sub_category' => $subcateg );
	  $table_name="smb_product";
	   $query = $this->db->order_by('title', 'asc')->where($where_array )->get($table_name); 
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	/*
	Get  categriy name
	*/
	function category_name($category)
    {
		$where_array = array( 'id' => $category );
	  	$table_name="smb_category";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->category_name;
        }
        return false;
	}
	/*
	Get  product name
	*/
	function product_name($product)
    {
		$where_array = array( 'id' => $product );
	  	$table_name="smb_product";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->title;
        }
        return false;
	}
	function get_user($bno)
    {
		$where_array = array( 'bidding_no' => $bno );
	  	$table_name="bidding";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->created_by;
        }
        return false;
	}
	/*
	Add bidding
	*/
	//get unique bd
	public function generate_unique_bno($category,$product_id)
    {
		$where_array = array( 'product' => $product_id,'category' => $category);
	  	$table_name="bidding";
		$query = $this->db->where($where_array )->get($table_name);
		if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->bidding_no;
        }
        return false;
	}
	public function add()
	{

        $user_info = $this->session->userdata('logged_user');
        $created_by = $user_info['user_id'];
		$modified_by = $user_info['user_id'];
		$created_at=time();
		$modified_at=time();
		$type='S';
		
		$location = $this->input->post('location');
		$category = $this->input->post('category');
		//$data['categ'] = singleDbTableRow($category,'category');
		$category_name=$this->category_name($category);
		
		$sub_cat_id=$this->input->post('sub_cat_id');
		
		$product_id=$this->input->post('product_id');
		//$data['prod'] = singleDbTableRow($id,'product');
		$product_name=$this->product_name($product_id);
		
		$amount=$this->input->post('amount');
		//$amount_no=$this->input->post('amount_no');
		//$amount_measure=$this->input->post('amount_measure');
		//$amounr_msr=$amount_no.' '.$amount_measure;
		
		//$measure=$this->input->post('measure');
		$quantity=$this->input->post('quantity');
		$unique_bno=$this->generate_unique_bno($category,$product_id);
		if($unique_bno)
		{
			$int = intval(preg_replace('/[^0-9]+/', '', $unique_bno), 10);
			$bd=$int + 1;
            $bidding_no=strtoupper( substr( $category_name, 0, 3 ) ).strtoupper( substr( $product_name, 0, 3 ) ).$bd;
			
		}
		else
		{
			$bidding_no=strtoupper( substr( $category_name, 0, 3 ) ).strtoupper( substr( $product_name, 0, 3 ) ).'1';
		}
		//$no=mt_rand(100, 999);
		//$bidding_no=strtoupper( substr( $category_name, 0, 3 ) ).strtoupper( substr( $product_name, 0, 3 ) ).mt_rand(100, 999);
		
        $data = [
			'created_by' 	=> $created_by,
			'created_at' 	=> $created_at,
			'type' 			=> $type,
			'location' 		=> $location,
            'category'      => $category,
			'sub_category'  => $sub_cat_id,
			'product'  		=> $product_id,
			'amount'  		=> $amount,
			'quantity'  	=> $quantity,
			'bidding_no'  	=> $bidding_no,
			'modified_at'  	=> $modified_at,
			'modified_by'  	=> $modified_by
			];
			$query = $this->db->insert('bidding', $data);
			if($query)
			{
		/* SMS */
			$reg_SMS = $this->notification_model->Bidding_Reg_SMS($created_by,$bidding_no);
		/* /SMS */
	/* EMAIL */
		$user_info = singleDbTableRow($created_by);
		$HTMLrow = '';
		$HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$bidding_no.'</td>
                        <td style="padding:5px;text-align:center;">'.$category_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
						<td style="padding:5px;text-align:center;">'.$amount.'</td>
                    </tr>';
					 $email_data = [
                'userData'     => $user_info,
                'tableRow'      => $HTMLrow
            ];
			$adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($user_info).', your order registered successfully';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($user_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('bidding_add_stock_email',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
			
				return $bidding_no;	
			}
	}
	/*
	Register to bidding
	*/
	public function register()
	{

        $user_info = $this->session->userdata('logged_user');
        $created_by = $user_info['user_id'];
		$modified_by = $user_info['user_id'];
		$created_at=time();
		$modified_at=time();
		$type='B';
		
		$category = $this->input->post('reg_category');
		//$data['categ'] = singleDbTableRow($category,'category');
		$category_name=$this->category_name($category);
		
		$sub_cat_id=$this->input->post('reg_sub_cat_id');
		
		$reg_product_id=$this->input->post('reg_product_id');
		//$data['prod'] = singleDbTableRow($id,'product');
		$product_name=$this->product_name($reg_product_id);;
		
		$reg_amount_min=$this->input->post('reg_amount_min');
		$reg_amount_max=$this->input->post('reg_amount_max');
		$amount=$reg_amount_min.'-'.$reg_amount_max;
		//
		$unique_bno=$this->generate_unique_bno($category,$reg_product_id);
		if($unique_bno)
		{
			$int = intval(preg_replace('/[^0-9]+/', '', $unique_bno), 10);
			$bd=$int + 1;
            $bidding_no=strtoupper( substr( $category_name, 0, 3 ) ).strtoupper( substr( $product_name, 0, 3 ) ).$bd;
			
		}
		else
		{
			$bidding_no=strtoupper( substr( $category_name, 0, 3 ) ).strtoupper( substr( $product_name, 0, 3 ) ).'1';
		}
		//$no=mt_rand(100, 999);
		//$bidding_no=strtoupper( substr( $category_name, 0, 3 ) ).strtoupper( substr( $product_name, 0, 3 ) ).mt_rand(100, 999);
		
        $data = [
			'created_by' 	=> $created_by,
			'created_at' 	=> $created_at,
			'type' 			=> $type,
            'category'      => $category,
			'sub_category'  => $sub_cat_id,
			'product'  		=> $reg_product_id,
			'amount'  		=> $amount,
			'bidding_no'  	=> $bidding_no,
			'modified_at'  	=> $modified_at,
			'modified_by'  	=> $modified_by
			];
			$query = $this->db->insert('bidding', $data);
			if($query)
			{
		/* SMS */
			$reg_SMS = $this->notification_model->Bidding_Reg_SMS($created_by,$bidding_no);	
	/* /SMS */
	/* EMAIL */
		$user_info = singleDbTableRow($created_by);
		$HTMLrow = '';
		$HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$bidding_no.'</td>
                        <td style="padding:5px;text-align:center;">'.$category_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$reg_amount_min.'</td>
						<td style="padding:5px;text-align:center;">'.$reg_amount_max.'</td>
                    </tr>';
					 $email_data = [
                'userData'     => $user_info,
                'tableRow'      => $HTMLrow
            ];
			$adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($user_info).', your order registered successfully';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($user_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('bidding_reg_email',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
			
				return $bidding_no;	
			}
	}
	/*EM*/
	public function get_EM()
    {
        $where_array = array( 'rolename' => 39);
	  	$table_name="users";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
           // $result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	public function bidding_approve($bno)
	{
		$user_info = $this->session->userdata('logged_user');
        $em= $this->input->post('event_manager');
		$data = [
            'approved'      => 1,
			'modified_by'     => $user_info['user_id'],
			'approved_by'     => $user_info['user_id'],
			'event_manager'     => $em,
            'modified_at'     => time(),
			'approved_at'     => time()
        ];
		$query = $this->db->where('bidding_no', $bno)->update('bidding', $data);

        if($query) 
		{ 
		/* SMS */
			$user=$this->get_user($bno);
			$appr_SMS = $this->notification_model->Bidding_Appr_SMS($user,$bno);
		/* /SMS */
		return true; 
		}
        return false;
	}
	public function event_products()
    {
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		$table_name="bidding";
		$this->db->select('DISTINCT(b.product) AS product,prod.title');
		$this->db->from('bidding AS b');// I use aliasing make joins easier
		$this->db->join('smb_product AS prod', 'b.product = prod.id', 'LEFT');
		
		$this->db->where(array( 'b.event_manager' => $userID,'b.approved' => 1,'b.event_created' => 0, 'b.closed' => 0));
		
		$query = $this->db->get();
        if($query->num_rows() > 0){
           // $result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	/*Related*/
	public function related_biddings($bno)
    {
       $results = $this->bidding_view($bno);
	   if(!empty($results)): foreach($results as $result):
	   $categ=$result['category'];
	   endforeach; endif;
	    $where_array = array( 'category' => $categ,'approved'=>1,'closed'=>0);
	  	$table_name="bidding";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
           // $result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	//get_user_count
	public function get_user_count($product)
    {
		$where_array = array( 'product' => $product,'approved'=>1,'closed'=>0,'event_created' =>0);
	  	$table_name="bidding";
		$query = $this->db->where($where_array )->get($table_name);
		return $query->num_rows();
	}
	//get unique event
	public function get_unique_event($product)
    {
		$where_array = array( 'product' => $product);
	  	$table_name="bidding_events";
		$query = $this->db->where($where_array )->get($table_name);
		if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->event_no;
        }
        return false;
	}
	public function create_event()
    {
      	$em = $this->session->userdata('logged_user');
        $em_id = $em['user_id'];
		$created_at=time();
		$modified_at=time();
	  	$product = $this->input->post('product');
	   	$elocation = $this->input->post('elocation');
	    $f_time = $this->input->post('f_time');
		$t_time = $this->input->post('t_time');
		$product_name=$this->product_name($product);
		$unique=$this->get_unique_event($product);
		if($unique)
		{
			$int = intval(preg_replace('/[^0-9]+/', '', $unique), 10);
			$evnt=$int + 1;
            $event_no='EVE'.strtoupper( substr( $product_name, 0, 3 ) ).$evnt;
			
		}
		else
		{
			$event_no='EVE'.strtoupper( substr( $product_name, 0, 3 ) ).'1';
		}
	  	//get data from bidding table having the same product
	   $results = $this->users($product);
	   $users='';
	   $cnt=0;
	   if(!empty($results)): foreach($results as $result):
	   $cnt++;
	   $user=$result['created_by'];
	   $bidding_no=$result['bidding_no'];
	   $name=$result['first_name'].' '.$result['last_name'];
	   $mobile=$result['contactno'];
	   $email=$result['email'];
	   $user_type=$result['type'];
	   $user_amount=$result['amount'];
	   $user_quantity=$result['quantity'];
	   $bidding_name=$event_no.'-'.$cnt;
	   /*SMS */
	   $event_SMS = $this->notification_model->Bidding_Event_SMS($name,$event_no,$bidding_name,$mobile);
		/* /SMS */
	/* EMAIL */
		$user_info = singleDbTableRow($user);
		$HTMLrow = '';
		$HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$bidding_no.'</td>
                        <td style="padding:5px;text-align:center;">'.$event_no.'</td>
                        <td style="padding:5px;text-align:center;">'.$f_time.'</td>
                        <td style="padding:5px;text-align:center;">'.$t_time.'</td>
                        <td style="padding:5px;text-align:center;">'.$edate.'</td>
						
                    </tr>';
					 $email_data = [
                'userData'     => $user_info,
                'tableRow'      => $HTMLrow
            ];
			$adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($user_info).', your event created successfully';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($user_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('bidding_add_event_email',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
			
				/* /EMAIL */
				/* Update bidding Table */
				$data = [
            'modified_by'     => $em_id,
			'modified_at'     => time(),
			'event_created'      =>1
        ];
		$query = $this->db->where('created_by', $user)->update('bidding', $data);
			/* /Update */
			/* insert into bidding_event_users table */
		$data = [
			'created_by' 	=> $em_id,
			'created_at' 	=> time(),
			'status' 			=> 1,
            'event_no'  	=> $event_no,
			'bidding_no'  	=> $bidding_no,
			'bidding_name'  	=> $bidding_name,
			'user_id'  	=> $user,
			'user_type' =>$user_type,
			'amount' =>$user_amount
			];
			$query = $this->db->insert('bidding_event_users', $data);
			/* insert into bidding_user_track table */
		$data = [
			'created_by' 	=> $em_id,
			'created_at' 	=> time(),
			'product'      => $product,
			'user_id'  	=> $user,
			'event_no'  	=> $event_no,
			'bidding_no'  	=> $bidding_no,
			'amount'     => $user_amount,
			'quantity'     => $user_quantity
			
			];
			$query = $this->db->insert('bidding_user_track', $data);
			
			$users.=($users !='' ) ? ",".$user."" : "".$user."" ;
	  	 
	   
	   endforeach; endif;
	    /* insert into bidding event table */
		$data = [
			'created_by' 	=> $em_id,
			'created_at' 	=> time(),
			'status' 			=> 1,
            'product'      => $product,
			'location'  => $elocation,
			'start_time'  		=> $f_time,
			'end_time'  		=> $t_time,
			'users'  	=> $users,
			'event_no'  	=> $event_no
			
			];
			$query = $this->db->insert('bidding_events', $data);
			if($query)
			{
				return true;
			}
			/* /insert */
			
			
    }
	function users($product)
    {
		$this->db->select('b.created_by,b.bidding_no,b.type,b.amount,b.quantity,u.first_name,u.last_name,u.email,u.contactno');
		$this->db->from('bidding AS b');// I use aliasing make joins easier
		$this->db->join('users AS u', 'b.created_by = u.id', 'LEFT');
		
		$this->db->where(array( 'b.product' => $product,'b.approved' => 1,'b.event_created' => 0, 'b.closed' => 0));
		
		$query = $this->db->get();
		
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	/*
	Send  freez request
	
	*/
	public function freez_decline($cid)
	{
		$where_array4 = array( 'id' => $cid );
		$table_name4="bidding_freez";
		 $query4 = $this->db->where($where_array4 )->get($table_name4); 
		 foreach($query4->result() as $row4);
		 $event_no=$row4->event_no;
		 $freez_id=$row4->freez_id;
		//Update chat table 
		$user_info = $this->session->userdata('logged_user');
        $modified_by = $user_info['user_id'];
				$data2 = [
			'modified_by' 	=> $modified_by,
			'modified_at' 	=> time(),
			'freez' 			=> 0
            ];
			$query2 = $this->db->where('id', $freez_id)->update('bidding_user_chat', $data2);
			
			$this->db->where('id', $cid)->delete('bidding_freez');
			if($query2)
			{
				return  $event_no;
			}
	}
	public function bidding_freez_now($cid)
	{

        $user_info = $this->session->userdata('logged_user');
        $created_by = $user_info['user_id'];
		//freez details
		$where_array = array( 'id' => $cid );
		$table_name="bidding_user_chat";
		$query = $this->db->where($where_array )->get($table_name);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$requested_to=$row->requested_by;
				$requested_amount=$row->requested_amount;
				$requested_quantity=$row->requested_quantity;
				$quantity_int = intval(preg_replace('/[^0-9]+/', '', $requested_quantity), 10);
				$requested_product=$row->requested_product;
				$event_no=$row->event_no;
				$where_array4 = array( 'user_id' => $created_by , 'event_no' => $event_no );
				$table_name4="bidding_event_users";
				 $query4 = $this->db->where($where_array4 )->get($table_name4); 
				 foreach($query4->result() as $row4);
				 $requested_by=$row4->bidding_no;
			}
		}
		$user1=$this->list_user_type($requested_to,$event_no);
			$user2=$this->list_user_type($requested_by,$event_no);
			if($user1 =='B')
			{
				$buyer=$this->get_user($requested_to);
				$seller = $requested_by;
			}
			else if($user2 =='B')
			{
				$buyer=$this->get_user($requested_by);
				$seller = $requested_to;
			}
		
		$total_quanity=$this->get_quantity($seller);
		$int1 = intval(preg_replace('/[^0-9]+/', '', $total_quanity), 10);
		if($int1 < $quantity_int)
		{
			return false;
		}
		else
		{
		
		
			$data = [
			'created_by' 	=> $created_by,
			'created_at' 	=> time(),
			'event_no' 			=> $event_no,
			'freez_id' 			=> $cid,
            'requested_by'      => $requested_by,
			'requested_to'  => $requested_to,
			'requested_product'  		=> $requested_product,
			'requested_amount'  		=> $requested_amount,
			'requested_quantity'  	=> $requested_quantity,
			'requested_at'  	=> time()
			];
			$query = $this->db->insert('bidding_freez', $data);
			if($query)
			{
				//Update chat table 
				$data2 = [
			'modified_by' 	=> $created_by,
			'modified_at' 	=> time(),
			'freez' 			=> 1
            ];
			$query2 = $this->db->where('id', $cid)->update('bidding_user_chat', $data2);
			if($query2)
			{
		/* SMS */
			$user1=$this->get_user($requested_by);
			$freez_SMS1 = $this->notification_model->Bidding_Freez_SMS($user1);
			
			$user2=$this->get_user($requested_to);
			$freez_SMS2 = $this->notification_model->Bidding_Freez_SMS($user2);
		/* /SMS */
	
			
				return $event_no;	
			}
			}
		}
		
		
		
	}
	/*
	Accept freez request
	*/
	public function bidding_freez_accept($fid)
	{

        $user_info = $this->session->userdata('logged_user');
        $modified_by = $user_info['user_id'];
		//freez details
		$where_array = array( 'id' => $fid );
		$table_name="bidding_freez";
		$query1 = $this->db->where($where_array )->get($table_name);
		if($query1->num_rows() > 0)
		{
			foreach($query1->result() as $row)
			{
				$event_no=$row->event_no;
				$requested_to=$row->requested_to;
				$requested_by=$row->requested_by;
				$requested_amount=$row->requested_amount;
				$requested_quantity=$row->requested_quantity;
				$quantity_int = intval(preg_replace('/[^0-9]+/', '', $requested_quantity), 10);
				$amount=explode('/',$requested_amount);
				$amount_int =$amount[0];
			}
			$total=$amount_int * $quantity_int;
			$user1=$this->list_user_type($requested_to,$event_no);
			$user2=$this->list_user_type($requested_by,$event_no);
			if($user1 =='B')
			{
				$buyer=$this->get_user($requested_to);
				$seller = $requested_by;
			}
			else if($user2 =='B')
			{
				$buyer=$this->get_user($requested_by);
				$seller = $requested_to;
			}
		}
		$total_quanity=$this->get_quantity($seller);
		$int1 = intval(preg_replace('/[^0-9]+/', '', $total_quanity), 10);
		if($int1 < $quantity_int)
		{
			return false;
		}
		else
		{
		$data = [
			'modified_by' 	=> $modified_by,
			'modified_at' 	=> time(),
			'request_accept' 			=> 1
            ];
			$query = $this->db->where('id', $fid)->update('bidding_freez', $data);
			if($query)
			{
				$track=$this->add_bidding_event_track($fid);
				/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
				//$deduction = $this->account_deduction($buyer,$total,$event_no);
						$reciever_ref   = singleDbTableRow(930)->referral_code;
						$sender_referral_code = singleDbTableRow($buyer)->referral_code;
						//
						$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
						$pay_to_referral_code 	= 	$reciever_ref;// Receiver's referral_code, ex : 5164830972
						$amount_to_pay		  	=	$total;			// Total amont to pay (or) transfer, ex : 100
						$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks	=	" Paid to CMS Account Manager for the  BIDDING Freezing   ID-".$event_no;	
						$pm_mode				=	"wallet";			// points_mode, ex : wallet, loyality, discount.
						
						
						$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);		
				if($track)
				{
					return $track;
				}
				else
				{
					return false;
				}
					
			}
		}
	}
	/*
	chat
	*/
	public function send_chat($ev)
	{

        $user_info = $this->session->userdata('logged_user');
        $created_by = $user_info['user_id'];
		
		$requested_amount=$this->input->post('camount');
		//$camount_measure='/'.$this->input->post('camount_measure');
		//$requested_amount=$camount.'/'.$camount_measure;
		
		$cquantity=$this->input->post('cquantity');
		//$cmeasure=$this->input->post('cmeasure');
		$requested_quantity=$cquantity;
		
		$requested_product=$this->input->post('cproduct');
		
		$requested_user=$this->input->post('cbno');
		
		$requested_user_type=$this->input->post('ctype');
		
		$data = [
			'created_by' 	=> $created_by,
			'created_at' 	=> time(),
			'event_no' 			=> $ev,
            'requested_by'      => $requested_user,
			'requested_product'  		=> $requested_product,
			'requested_amount'  		=> $requested_amount,
			//'amount_measure'  		=> $camount_measure,
			'requested_quantity'  	=> $requested_quantity,
			'requested_at'  	=> time(),
			'requested_by_type'      => $requested_user_type
			];
			$query = $this->db->insert('bidding_user_chat', $data);
			if($query)
			{
				return true;	
			}
	}
	/*
	Send freez request
	*/
	public function send_freez_request($ev)
	{

        $user_info = $this->session->userdata('logged_user');
        $created_by = $user_info['user_id'];
		
		
		$seller = $this->input->post('seller');
		
		$famount=$this->input->post('famount');
		$amount_measure=$this->input->post('amount_measure');
		$requested_amount=$famount.'/'.$amount_measure;
		
		$fquantity=$this->input->post('fquantity');
		$fmeasure=$this->input->post('fmeasure');
		$requested_quantity=$fquantity.' '.$fmeasure;
		
		$requested_product=$this->input->post('product');
		
		$requested_user=$this->input->post('buyer');
		
		$data = [
			'created_by' 	=> $created_by,
			'created_at' 	=> time(),
			'event_no' 			=> $ev,
            'requested_by'      => $requested_user,
			'requested_to'  => $seller,
			'requested_product'  		=> $requested_product,
			'requested_amount'  		=> $requested_amount,
			'requested_quantity'  	=> $requested_quantity,
			'requested_at'  	=> time()
			];
			$query = $this->db->insert('bidding_freez', $data);
			if($query)
			{
		/* SMS */
		
			$user1=$this->get_user($requested_user);
			$freez_SMS1 = $this->notification_model->Bidding_Freez_SMS($user1);
			
			$user2=$this->get_user($seller);
			$freez_SMS2 = $this->notification_model->Bidding_Freez_SMS($user2);
			
				
	/* /SMS */
	
			
				return true;	
			}
	}
	
	/*
	
	*/
	//get 
	public function get_quantity($seller)
    {
		$where_array = array( 'bidding_no' => $seller);
	  	$table_name="bidding";
		$query = $this->db->where($where_array )->get($table_name);
		if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->quantity;
        }
        return false;
	}
	function list_user_type($bno,$ev)
	{
		$where_array = array( 'bidding_no' => $bno , 'event_no' => $ev );
	  	$table_name="bidding_event_users";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->user_type;
        }
        return false;
	}
	function get_user_bno($ev)
	{
		 $user_info = $this->session->userdata('logged_user');
        $userID = $user_info['user_id'];
		
		$where_array = array( 'user_id' => $userID , 'event_no' => $ev );
	  	$table_name="bidding_event_users";
		$query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row);
            return $row ->bidding_no;
        }
        return false;
	}
	public function add_bidding_event_track($fid)
	{


//freez details
		$where_array = array( 'id' => $fid );
		$table_name="bidding_freez";
		$query = $this->db->where($where_array )->get($table_name);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$requested_by=$row->requested_by;
				$requested_to=$row->requested_to;
				$confirmed_amount=$row->requested_amount;
				$confirmed_quantity=$row->requested_quantity;
				$product=$row->requested_product;
				$event_no=$row->event_no;
				$type1=$this->list_user_type($requested_by,$event_no);
				$type2=$this->list_user_type($requested_to,$event_no);
				if($type1 =='S')
				{
					$seller=$requested_by;
					$buyer=$requested_to;
				}
				else if($type2 =='S')
				{
					$seller=$requested_to;
					$buyer=$requested_by;
				}
				$confirmed_user=$this->get_user_bno($event_no);
			}
		}
		$total_quanity=$this->get_quantity($seller);
		$int1 = intval(preg_replace('/[^0-9]+/', '', $total_quanity), 10);
		$int2 = intval(preg_replace('/[^0-9]+/', '', $confirmed_quantity), 10);
		$quantity= ($int1) - ($int2);
        $user_info = $this->session->userdata('logged_user');
        $created_by = $user_info['user_id'];
		
		$track_id='BIDDEVE'.mt_rand(10, 99);
		
        $data = [
			'created_by' 	=> $created_by,
			'created_at' 	=> time(),
			'bidding_user_seller' 			=> $seller,
            'bidding_user_buyer'      => $buyer,
			'event_no'  => $event_no,
			'confirmed_user'  		=> $confirmed_user,
			'confirmed_amount'  		=> $confirmed_amount,
			'confirmed_quantity'  	=> $confirmed_quantity,
			'confirmed_product'  	=> $product,
			'track_id'  	=> $track_id
			];
			$query1 = $this->db->insert('bidding_event_track', $data);
			/* Update bidding Table */
				$data2 = [
            'modified_by'     => $created_by,
			'modified_at'     => time(),
			'quantity'      =>$quantity
        ];
		$query = $this->db->where('bidding_no', $seller)->update('bidding', $data2);
			if($query1)
			{
		/* SMS */
			$user1=$this->get_user($seller);
			$freez_SMS1 = $this->notification_model->Bidding_FreezAcce_SMS($user1);
			
			
			$user2=$this->get_user($buyer);
			$freez_SMS2 = $this->notification_model->Bidding_FreezAcce_SMS($user2);
			
			
				
	/* /SMS */
	
			
				return $event_no;	
			}
	}
	//COurier
	/* View */
	function bidding_track_view($trackid)
    {
		
		$this->db->select('bt.track_id,bt.event_no,bt.bidding_user_seller,bt.bidding_user_buyer,bt.confirmed_user,bt.confirmed_amount,bt.confirmed_quantity,bt.created_at,bt.cons_no,p.title,be.product');
		$this->db->from('bidding_event_track AS bt');// I use aliasing make joins easier
		$this->db->join('bidding_events AS be', 'bt.event_no = be.event_no', 'LEFT');
		$this->db->join('smb_product AS p', 'be.product = p.id', 'LEFT');
		
		$this->db->where(array( 'bt.track_id' => $trackid));
		
		$query = $this->db->get();
		
        if($query->num_rows() > 0){
           $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }
	/*Related*/
	public function bidding_track_user($trackid,$type)
    {
       $results = $this->bidding_track_view($trackid);
	   if(!empty($results)): foreach($results as $result):
	   $ev=$result['event_no'];
	   if($type=='S')
	   {
		   $user=$result['bidding_user_seller'];
	   }
	   else if($type=='B')
	   {
		   $user=$result['bidding_user_buyer'];
	   }
	   endforeach; endif;
	   
	    $this->db->select('beu.event_no,beu.bidding_no,beu.bidding_name,beu.user_id,u.first_name,u.last_name,u.email,u.contactno,u.postal_code,u.referral_code,u.id,p.location,p.district,p.state,c.country_name');
		$this->db->from('bidding_event_users AS beu');// I use aliasing make joins easier
		$this->db->join('users AS u', 'beu.user_id = u.id', 'LEFT');
		$this->db->join('pincode AS p', 'u.postal_code = p.pincode', 'LEFT');
		$this->db->join('countries AS c', 'c.id = p.country', 'LEFT');
		
		
		$this->db->where(array( 'beu.event_no' => $ev, 'beu.bidding_no' => $user));
		
		$query = $this->db->get();
        if($query->num_rows() > 0){
            $result2 = $query->result_array();
            return $result2;
        }else{
            return false;
        }
    }
	//ACCOUNT DEDUCTION
	// Get $tran_count for reciever
	public function account_deduction($user_id,$grand_total,$ev)
    {				
	//
	$get_user = $this->db->get_where('users', ['id' => $user_id]);
		foreach($get_user->result() as $user)
		{
			$user_id = $user->id;
			$user_rolename = $user->rolename;
			$email = $user->email;
			$user_acc_no = $user->account_no;
			$user_name = $user ->first_name;
		}
	//
					$limit = '1';	
					$start = '0';
					
					$result_count = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('accounts', ['account_no' => '105560095305382610497'] );		
					if($result_count -> num_rows() > 0){
						foreach ($result_count->result() as $r){
							$value	= $r->tran_count;  	
							$tran_count = $value + 1;	
						}			
					}
					else{
						$tran_count = '';
					}
					if ($tran_count == null)
					{ $tran_count = '1'; }
					
					// Get available_balance i.e $user_amount for reciever
						// sum of debit
						$user_debit = $this->db->select_sum('debit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>'105560095305382610497']); 
						foreach( $user_debit->result() 		as $user_debit);
						$users_debit			= $user_debit->debit;
						// sum of credit
						$user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>'105570017301783490652']);; 
						foreach( $user_credit->result() 	as $user_credit);		
						$users_credit      	= $user_credit->credit;
						
						$user_balance       = ( $users_debit - $users_credit ) ; //Available balance
						$user_amount = $user_balance + $grand_total;	//total_price
						$cons_no = $this->input->post('consignment_no');
						/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
						
					// Reciever Data..
					$accounts1 = [
							'user_id'      			=> '930',        //To the Recieving Partner  
							'email'         	    => 'cms@cfirst.co.in', //cms@cfirst.co.in
							'account_no'         	=> '105570017301783490652',
							'rolename'  		    => '30',
							'paid_to'         		=> $user_id,      //From the Money sender user 
							'pay_type'         		=> $pay,      //Payspecification ID
							'debit'         		=> $grand_total,
							'credit'         		=> '0',
							'amount'         		=> $user_amount, //$total_price,						
							'tranx_id'				=> 'Paid by '.$user_rolename	.'-'.$user_name.' for the BIDDING  ID-'.$ev,
							'points_mode'           => 'wallet',
							'tran_count'			=> $tran_count,
							'used'					=> 'yes',
							'created_at'            => time(),
							'modified_at'           => time()
						];

					$query3 = $this->db->insert('accounts', $accounts1);
					/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */

					$ledger1 = [
						'user_id'         		=> '930',             		//To the Recieving Partner  
						'pay_type'				=> $pay,  	//Deduction Pay Specification	
						'account_no'         	=> '105560095305382610497',			//Member Account No
						'email'					=> 'cms@cfirst.co.in',
						'rolename'  			=> '30',
						'credit'         		=> $grand_total,
						'debit'         		=> '0', 	
						'amount'         		=> $grand_total, 
						'points_mode'           => 'wallet',
						'invoice_id '  			=> '123456',		
						'challan' 				=> 'no_invoice.jpg',			
						'remarks'         		=> 'Ledger Update: Paid by '.$user_rolename		.'-'.$user_name.' for the BIDDING  ID-'.$ev,
						'start_date'         	=> time(),		
						'created_at'            => time(),
						'modified_at'           => time()
					];

				   $query4 = $this->db->insert('ledger', $ledger1);	

						
					// Get $tran_count for sender
					$u_limit = '1';	
					$u_start = '0';
					
					$user_result_count = $this->db->order_by('id', 'desc')->limit($u_limit, $u_start)->get_where('accounts', ['account_no' => $user_acc_no] );		
					if($user_result_count -> num_rows() > 0){
						foreach ($user_result_count->result() as $c){
							$user_value	= $c->tran_count;  	
							$user_tran_count = $user_value + 1;	
						}			
					}
					else 
					{
						$user_tran_count ='';
					}
					if ($user_tran_count == null)
					{ $user_tran_count = '1'; }
					
					// Get available_balance i.e $user_amount for reciever
						// sum of debit
						$user_debit = $this->db->select_sum('debit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]); 
						foreach( $user_debit->result() 		as $user_debit);
						$users_debit			= $user_debit->debit;
						// sum of credit
						$user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]);; 
						foreach( $user_credit->result() 	as $user_credit);		
						$users_credit      	= $user_credit->credit;
						
						$balance       = ( $users_debit - $users_credit ) ; //Available balance

						$user_av_amount = $balance - $grand_total;	//total_price
						/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */	
					// Logged User/Sender Data..
					$accounts2 = [
							'user_id'      			=> $user_id,        //From the Money sender user
							'email'         	    => $email,
							'account_no'         	=> $user_acc_no,
							'rolename'  			=> $user_rolename,
							'paid_to'         		=> '930',      // To the Recieving Partner  
							'pay_type'         		=> $pay,      //Payspecification ID
							'debit'         		=> '0',
							'credit'         		=> $grand_total,
							'amount'         		=> $user_av_amount, //$total_price,						
							'tranx_id'				=> "Paid to CMS Account Manager for the  BIDDING  ID-".$ev,
							'points_mode'           => 'wallet',
							'tran_count'			=> $user_tran_count, 
							'used'					=> 'yes',
							'created_at'            => time(),
							'modified_at'           => time()
						];

					$query5 = $this->db->insert('accounts', $accounts2);	
					
					
					$ledger2 = [
						'user_id'         		=> $user_id,             		//To the Recieving Partner  
						'pay_type'				=> $pay,  	//Deduction Pay Specification	
						'account_no'         	=> $user_acc_no,			//Member Account No
						'email'					=> $email,
						'rolename'  			=> $user_rolename,
						'credit'         		=> '0',
						'debit'         		=> $grand_total, 	
						'amount'         		=> $grand_total, 
						'points_mode'           => 'wallet',
						'invoice_id '  			=> '12345',		
						'challan' 				=> 'no_invoice.jpg',			
						'remarks'         		=> "Ledger Update: Paid to CMS Account Manager for the  BIDDING  ID-".$ev,
						'start_date'         	=> time(),		
						'created_at'            => time(),
						'modified_at'           => time()
					];

					$query6 = $this->db->insert('ledger', $ledger2);	
					
					
					
		 if( $query3 && $query4 && $query5 && $query6 ) //&& $query7)
        {
           // create_activity('Added '.$data['name'].' Courier'); //create an activity
            return true;
        }
	}
	//
	public function update_track($trackid,$consignment_no)
    {
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$data1 = [
			'confirmed_status'  	=> 1,
			'cons_no'  	=> $consignment_no,
			'confirmed_by'  	=> $userID,
			'modified_by'  	=> $userID,
			'modified_at'  	=> time()
			];
		
	$query1 = $this->db->where('track_id', $trackid)->update('bidding_event_track', $data1);
		if($query1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function add_review($trackid)
    {
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$total_quantity=$this->input->post('total_quantity');
		$damaged=$this->input->post('damaged');
		$fund=$this->input->post('fund');
		$comments=$this->input->post('comments');
		
		$data1 = [
			'track_id'  	=> $trackid,
			'total_quantity'  	=> $total_quantity,
			'damaged'  	=> $damaged,
			'released_amount'  	=> $fund,
			'comments'  	=> $comments,
			'created_by'  	=> $userID,
			'created_at'  	=> time()
			];
		
			$query1 = $this->db->insert('bidding_review', $data1);	
			if($query1)
			{
				
		$data2 = [
			'release_fund'  	=> 1,
			'modified_by'  	=> $userID,
			'modified_at'  	=> time()
			];
		
	$query2 = $this->db->where('track_id', $trackid)->update('bidding_event_track', $data2);
				return true;
			}
			else
			{
				return false;
			}
	}
	
	
	
	/* Report */
	public function bidding_ListCount()
	{
        $query = $this->db->count_all_results('bidding_events');
        return $query;
    }
	/* Bidding List */
	public function bidding_Count()
	{
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		/* area manager */
		if($currentRolename == 18 )
		{
			$where_array = " approved = 0 AND  closed = 0 ";
			$query = $this->db->where($where_array )->count_all_results('bidding');
			//$query = $this->db->where('approved' == 0,'closed' == 0)->count_all_results('bidding_events');
		}
		/* EM  */
		else if($currentRolename == 39 )
		{
			$where_array = " approved = 1 AND closed = 0 AND event_manager = ".$userID." AND event_created = 0 ";
			$query = $this->db->where($where_array )->count_all_results('bidding');
			//$query = $this->db->where('approved' == 1,'closed' == 0,'event_manager' ==$userID,'event_created' ==0)->count_all_results('bidding_events');
		}
		else
		{
			 $query = $this->db->count_all_results('bidding');
		}
		
        return $query;
    }

    public function bidding_event_List($limit = 0, $start = 0)
	{
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		
		$searchByID = '';
		if($searchValue != '')																							
		{																												
			$table_name = "bidding_events";	
			$where_array = " event_no like '%".$searchValue."%' OR location like '%".$searchValue."%'";//array('event_no' => $searchValue );															
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else
		{
        	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bidding_events');
		}
        return $query;
    }
	public function event_search_count($location,$sf_time,$st_time,$ef_time,$et_time)
	{
		if($sf_time !='' && $st_time !='')
		{
		$start_fdt = new DateTime($sf_time);
		$start_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($st_time);
		$start_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ef_time !='' && $et_time !='')
		{
		$end_fdt = new DateTime($ef_time);
		$end_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($et_time);
		$end_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition="";
		if($location !='')
		{
			$condition.="location = '".$location."'";
		}
		if($sf_time !='' && $st_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."') " : " (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."')" ;
		}
		if($ef_time !='' && $et_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."') " : " (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."')" ;
		}
		
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
		}
		$query = $this->db->where($where_array )->count_all_results('bidding_events');
        
        return $query;
    }
	function event_search($limit, $start, $location, $sf_time, $st_time, $ef_time, $et_time)
    {
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		
		$searchByID = '';
		
		if($sf_time !='' && $st_time !='')
		{
		$start_fdt = new DateTime($sf_time);
		$start_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($st_time);
		$start_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ef_time !='' && $et_time !='')
		{
		$end_fdt = new DateTime($ef_time);
		$end_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($et_time);
		$end_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition="";
		if($location !='')
		{
			$condition.="location = '".$location."'";
		}
		if($sf_time !='' && $st_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."') " : " (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."')" ;
		}
		if($ef_time !='' && $et_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."') " : " (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."')" ;
		}
		
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
		}
		
		if($searchValue != '')																							
		{																												
			$where_array = $where_array. " AND event_no like '%".$searchValue."%' OR location like '%".$searchValue."%'";//array('event_no' => $searchValue );															
			
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bidding_events'); 	
		}											
		else
		{
        	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bidding_events'); 
		}
		
		
        return $query;
    }
	function search_productwise($limit, $start,$bev,$bprod)
    {
		
		/* CONDITIONS */
		$condition="";
		if($bev !='all')
		{
			$condition.="event_no = '".$bev."'";
		}
		if($bprod !='all')
		{
			$condition.=($condition !='' ) ? " AND confirmed_product = '".$bprod."' " : " confirmed_product = '".$bprod."'" ;
		}
		
		
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			//$query = $this->db->order_by('id', 'desc')->select_max('confirmed_amount')->limit($limit, $start)->where($where_array )->get('bidding_event_track');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bidding_event_track'); 
		}
		else
		{
		//$query = $this->db->order_by('id', 'desc')->select_max('confirmed_amount')->limit($limit, $start)->get('bidding_event_track');
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bidding_event_track'); 
		}
		
        return $query;
    }
	//
	public function user_search_count($sf_time,$st_time,$ef_time,$et_time)
	{
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		if($sf_time !='' && $st_time !='')
		{
		$start_fdt = new DateTime($sf_time);
		$start_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($st_time);
		$start_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ef_time !='' && $et_time !='')
		{
		$end_fdt = new DateTime($ef_time);
		$end_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($et_time);
		$end_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition=" find_in_set('".$userID."',users) <>0";
		
		if($sf_time !='' && $st_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."') " : " (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."')" ;
		}
		if($ef_time !='' && $et_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."') " : " (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."')" ;
		}
		
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
		}
		$query = $this->db->where($where_array )->count_all_results('bidding_events');
        
        return $query;
    }
	function user_search($limit, $start, $sf_time, $st_time, $ef_time, $et_time)
    {
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		
		$searchByID = '';
		
		if($sf_time !='' && $st_time !='')
		{
		$start_fdt = new DateTime($sf_time);
		$start_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($st_time);
		$start_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ef_time !='' && $et_time !='')
		{
		$end_fdt = new DateTime($ef_time);
		$end_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($et_time);
		$end_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition=" find_in_set('".$userID."',users) <>0";
		
		if($sf_time !='' && $st_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."') " : " (DATE(start_time) BETWEEN '".$start_from."' AND '".$start_to."')" ;
		}
		if($ef_time !='' && $et_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."') " : " (DATE(end_time) BETWEEN '".$end_from."' AND '".$end_to."')" ;
		}
		
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
		}
		
		if($searchValue != '')																							
		{																												
			$where_array = $where_array. " AND event_no like '%".$searchValue."%' OR location like '%".$searchValue."%'";//array('event_no' => $searchValue );															
			
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bidding_events'); 	
		}											
		else
		{
        	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bidding_events'); 
		}
		
		
        return $query;
    }
	//
}
?>