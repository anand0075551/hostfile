<?php  
require_once 'dbconnect.php';  
  
    class ReportClass 
	{  
            
        function __construct() 
		{  
              
            // connecting to database  
            $db = new dbConnect();;  
               
        }  
        // destructor  
        function __destruct() {  
              
        }  
        //POINTS MODE 
       public function List_points_mode()
		{
			$query=mysql_query("SELECT DISTINCT points_mode FROM accounts  ORDER BY accounts.points_mode  DESC");
			$result = array();
			while ($record = mysql_fetch_array($query)) 
			{
				
				$result[] = $record;
			}
			return($result);
		}
		//ROLES
		public function List_roles()
		{
			$query=mysql_query("SELECT id,rolename FROM role  ORDER BY rolename  ASC");
			$result = array();
			while ($record = mysql_fetch_array($query)) 
			{
				
				$result[] = $record;
			}
			return($result);
		}
		//PAY TYPE
		public function List_pay_type()
		{
			$query=mysql_query("SELECT id, name FROM acct_categories  ORDER BY name  ASC");
			$result = array();
			while ($record = mysql_fetch_array($query)) 
			{
				
				$result[] = $record;
			}
			return($result);
		}
		//CREATED DATE
		 public function List_created_date()
		{
			$query=mysql_query("SELECT DISTINCT created_at FROM accounts  ORDER BY accounts.created_at  DESC");
			$result = array();
			while ($record = mysql_fetch_array($query)) 
			{
				
				$result[] = $record;
			}
			return($result);
		}
		   //Accounts
		public function List_accounts($condition,$r_user,$f_user,$t_user)
		{
			//SINGLE USER
			if($r_user !='')
			{
				$condition.=($condition !='' ) ? " AND a.user_id = '".$r_user."'" : "WHERE a.user_id = '".$r_user."'" ;
				
			}
			$condition1=$condition;
			if($f_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.user_id = '".$f_user."'" : "WHERE a.user_id = '".$f_user."'" ;
				
			}
			if($t_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.paid_to = '".$t_user."'" : "WHERE a.paid_to = '".$t_user."'" ;
				
			}
		  $query=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition1." ORDER BY a.id DESC LIMIT 50");
		  $result = array();
		if(mysql_num_rows($query) > 0)
		{
			while ($record = mysql_fetch_assoc($query)) 
			{
				
				$result[] = $record;
				
			}
			echo '<div id="dvData">';
			//Show SELECTED USER
			if($r_user !='')
			{
				$this->show_single_user($r_user);
			}
			if($f_user !='' && $t_user !='')
			{
				$this->show_btw_user($f_user,$t_user);
			}
			echo '<br>';
			//Show total table
			$this->show_total($condition,$f_user,$t_user);
			
			//result DIV and csv div
		echo '<br>
		
        <table width="100%" >
        <tr>
			<th>Sl.No</th>
            <th>Name</th>
            <th>Email Id</th>
			<th>Customer Code</th>
			<th>Phone No</th>
			<th>Division Name</th>
			<th>Transaction date</th>
            <th>Points Mode</th>
            <th>Deposit</th>
			<th>Deduction</th>
            <th>Amount</th>
		</tr>';   
		$cnt=1;
		$deposit1=0;
		$deduction1=0;
		$balance1=0;
		foreach($result as $results) 
		{ 
		echo '<tr>';
		 echo '<td>'.$cnt.'</td>';
        echo '<td>'.$results['name'].'</td>';
		echo '<td>'.$results['email'].'</td>';
        echo '<td>'.$results['referral_code'].'</td>'; 
		echo '<td>'.$results['contactno'].'</td>';
		echo '<td>'.$results['division_name'].'</td>';
		$timestamp=date('d/m/Y h:i A',$results['created_at']);
		$splitTimeStamp = explode(" ",$timestamp);
		$date = $splitTimeStamp[0];
		$time = $splitTimeStamp[1].' '.$splitTimeStamp[2];
		echo '<td>'.$date.'</td>';
		echo '<td>'.$results['points_mode'].'</td>';
		echo '<td>'.$results['debit'].'</td>';
		echo '<td>'.$results['credit'].'</td>';
		echo '<td>'.$results['amount'].'</td>'; 
       
		 echo '</tr>';
		 $cnt++;
		 $deposit1 = $deposit1 + $results['debit'];
		 $deduction1 = $deduction1 + $results['credit'];
		 $balance1 = $balance1 + $results['amount'];
		 
		}
		$amount1 = $deposit1 - $deduction1;
		if($f_user !='' && $t_user !='')
		{
			$condition2=$condition;
			$condition2.=($condition2 !='' ) ? " AND a.user_id = '".$t_user."'" : "WHERE a.user_id = '".$t_user."'" ;
			$condition2.=($condition2 !='' ) ? " AND a.paid_to = '".$f_user."'" : "WHERE a.paid_to = '".$f_user."'" ;
			$deposit2=0;
			$deduction2=0;
			$balance2=0;
			 $query2=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition2." ORDER BY a.id DESC LIMIT 50");
			  $result2 = array();
			  if(mysql_num_rows($query2) > 0)
			{
				while ($record2 = mysql_fetch_assoc($query2)) 
				{
					$result2[] = $record2;
				}
				foreach($result2 as $results2) 
				{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$results2['name'].'</td>';
				echo '<td>'.$results2['email'].'</td>';
				echo '<td>'.$results2['referral_code'].'</td>'; 
				echo '<td>'.$results2['contactno'].'</td>';
				echo '<td>'.$results2['division_name'].'</td>';
				$timestamp=date('d/m/Y h:i A',$results2['created_at']);
				$splitTimeStamp = explode(" ",$timestamp);
				$date = $splitTimeStamp[0];
				$time = $splitTimeStamp[1].' '.$splitTimeStamp[2];
				echo '<td>'.$date.'</td>';
				echo '<td>'.$results2['points_mode'].'</td>';
				echo '<td>'.$results2['debit'].'</td>';
				echo '<td>'.$results2['credit'].'</td>';
				echo '<td>'.$results2['amount'].'</td>'; 
				echo'</tr>';
				$cnt++;
				 $deposit2 = $deposit2 + $results2['debit'];
				 $deduction2 = $deduction2 + $results2['credit'];
				 $balance2 = $balance2 + $results2['amount'];
				}
				$amount2 = $deposit2 - $deduction2;
			}
			$deposit1=$deposit1 + $deposit2;
			$deduction1=$deduction1+$deduction2;
			$balance1=$balance1 +$balance2;
		}
		
		echo '<tr>
		<td colspan="8" align="center"><b>Total</b></td>
		<td><b>'.round($deposit1, 3).'</b></td>
		<td><b>'.round($deduction1, 3).'</b></td>
		<td><b>'.round($balance1, 3).'</b></td>
		</tr></table>';
		echo '<br /><br />';
		
		 ?>
         <br /><br />
		<table><tr><td><form  action="csv.php" method="post" name="upload_csv"   
                      enctype="multipart/form-data">
                 <input type="hidden" name="c" value="<?php echo $condition;?>" />
                             <input type="submit" name="Export" class="button" value="Export to CSV"/>
                              
                                           
            </form></td>
           <td> <form  action="xls.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <input type="hidden" name="c" value="<?php echo $condition;?>" />
                            <input type="submit" name="Export_xls" class="button" value="Export to XLS"/>
                                           
            </form> </td>
            <td>
            <form  action="pdf.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <input type="hidden" name="c" value="<?php echo $condition;?>" />
                            <input type="submit" name="Export_pdf" class="button" value="Export to PDF"/>
                                           
            </form>
            </td>
		
 <?php echo '</tr></table></div>'; 
 }
 else
 {
	 echo '<table width="100%">
        <tr>
        <th bgcolor="#CCCCCC">No Accounts Available</th>
        </tr>'; 
 }
		}
 		
 		//EXport USERS
	public function pdf_accounts($condition)
		{
			
		  $query=mysql_query("SELECT CONCAT(u.first_name,' ', u.last_name) AS Name,a.email AS EMAIL,u.referral_code AS CustomerCode,u.contactno AS PhoneNumber,ac.name as DivisionName,a.points_mode AS PointsMode,a.debit AS DEPOSIT,a.credit AS Deduction,a.amount AS Balance FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition." ORDER BY a.id DESC LIMIT 50");
		  
		  $result = array();
		
			while ($record = mysql_fetch_assoc($query)) 
			{
				
				$result[] = $record;
				
			}
		
		return $result;
		}
		//Show Total
		public function show_total($condition,$f_user,$t_user)
		{
			$condition1=$condition;
			if($f_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.user_id = '".$f_user."'" : "WHERE a.user_id = '".$f_user."'" ;
				
			}
			if($t_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.paid_to = '".$t_user."'" : "WHERE a.paid_to = '".$t_user."'" ;
				
			}
		  $query=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition1." ORDER BY a.id DESC LIMIT 50");
		  $result = array();
		
			while ($record = mysql_fetch_assoc($query)) 
			{
				
				$result[] = $record;
				
			}
			$deposit=0;
			$deduction=0;
			$balance=0;
			$deposit2=0;
			$deduction2=0;
			$balance2=0;
			foreach($result as $results) 
			{
				$deposit = $deposit + $results['debit'];
				 $deduction = $deduction + $results['credit'];
				
			}
			$amount = $deposit - $deduction;
			//B/W USER
			if($f_user !='' && $t_user !='')
			{
				$condition2=$condition;
			$condition2.=($condition2 !='' ) ? " AND a.user_id = '".$t_user."'" : "WHERE a.user_id = '".$t_user."'" ;
			$condition2.=($condition2 !='' ) ? " AND a.paid_to = '".$f_user."'" : "WHERE a.paid_to = '".$f_user."'" ;
				$query2=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition2." ORDER BY a.id DESC LIMIT 50");
			  $result2 = array();
			  if(mysql_num_rows($query2) > 0)
			{
				while ($record2 = mysql_fetch_assoc($query2)) 
				{
					$result2[] = $record2;
				}
				foreach($result2 as $results2) 
				{
					 $deposit2 = $deposit2 + $results2['debit'];
					 $deduction2 = $deduction2 + $results2['credit'];
					 
				}
				$amount2 = $deduction2 - $deposit2;
				$deposit=$deposit + $deposit2;
				$deduction=$deduction + $deduction2;
				$amount=$amount - $amount2;
			}
			
			}
			echo '<table width="100%">
			<tr>
        <th bgcolor="#66FFCC"></th>
        <th bgcolor="#66FFCC"><font color="#666666">ACCOUNT LIST</font></th> <th bgcolor="#66FFCC">
		<input type="button" value="RELOAD" class="button" onclick="listUser()"></th>
        </tr>
		<tr>
		<td></td>
		<td align="center"><b>Total Deposit</b></td>
		<td><b>'.round($deposit, 3).'</b></td>
		</tr>
		<tr>
		<td></td>
		<td  align="center"><b>Total Deduction</b></td>
		<td><b>'.round($deduction, 3).'</b></td>
		</tr>
		<tr>
		<td></td>
		<td  align="center"><b>Total Balance Amount</b></td>
		<td><b>'.round($amount, 3).'</b></td>
		</tr>
		</table>';
		}
		//SHOW USERS UNDER GIVEN ROLE
		
		public function Sort_Users($condition)
		{
			
		  $query=mysql_query("SELECT id, CONCAT(first_name,' ', last_name) AS name  FROM users ".$condition."  ORDER BY first_name ASC ");
		  $result = array();
		
			if(mysql_num_rows($query) > 0 )
			{
				while ($record = mysql_fetch_assoc($query)) 
				{
					
					$result[] = $record;
					
				}
				return $result;
			}
			else
			{
				return false;
			}
		}
		//BAR CHART
		
		public function Bar_chart($condition,$f_user,$t_user)
		{
			
		  $condition1=$condition;
			if($f_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.user_id = '".$f_user."'" : "WHERE a.user_id = '".$f_user."'" ;
				
			}
			if($t_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.paid_to = '".$t_user."'" : "WHERE a.paid_to = '".$t_user."'" ;
				
			}
		  $query=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition1." ORDER BY a.id DESC LIMIT 50");
		  $result = array();
		
			while ($record = mysql_fetch_assoc($query)) 
			{
				
				$result[] = $record;
				
			}
			$deposit=0;
			$deduction=0;
			$balance=0;
			$deposit2=0;
			$deduction2=0;
			$balance2=0;
			foreach($result as $results) 
			{
				$deposit = $deposit + $results['debit'];
				 $deduction = $deduction + $results['credit'];
				 
			}
			$amount = $deposit - $deduction;
			
			//B/W USER
			if($f_user !='' && $t_user !='')
			{
				$condition2=$condition;
			$condition2.=($condition2 !='' ) ? " AND a.user_id = '".$t_user."'" : "WHERE a.user_id = '".$t_user."'" ;
			$condition2.=($condition2 !='' ) ? " AND a.paid_to = '".$f_user."'" : "WHERE a.paid_to = '".$f_user."'" ;
				$query2=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition2." ORDER BY a.id DESC LIMIT 50");
			  $result2 = array();
			  if(mysql_num_rows($query2) > 0)
			{
				while ($record2 = mysql_fetch_assoc($query2)) 
				{
					$result2[] = $record2;
				}
				foreach($result2 as $results2) 
				{
					 $deposit2 = $deposit2 + $results2['debit'];
					 $deduction2 = $deduction2 + $results2['credit'];
					 
				}
				$amount2 = $deduction2 - $deposit2;
				$deposit=$deposit + $deposit2;
				$deduction=$deduction + $deduction2;
				$amount=$amount - $amount2;
			}
			
			}
			echo '[["Result","Amount"],["Deposit",'.$deposit.'],["Deduction",'.$deduction.'],["Balance",'.$amount.']]';
		}
		//PIE CHART
		public function Pie_chart($condition,$f_user,$t_user)
		{
			$condition1=$condition;
			if($f_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.user_id = '".$f_user."'" : "WHERE a.user_id = '".$f_user."'" ;
				
			}
			if($t_user !='')
			{
				$condition1.=($condition1 !='' ) ? " AND a.paid_to = '".$t_user."'" : "WHERE a.paid_to = '".$t_user."'" ;
				
			}
		  $query=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition1." ORDER BY a.id DESC LIMIT 50");
		  $result = array();
		
			while ($record = mysql_fetch_assoc($query)) 
			{
				
				$result[] = $record;
				
			}
			$deposit=0;
			$deduction=0;
			$balance=0;
			$deposit2=0;
			$deduction2=0;
			$balance2=0;
			foreach($result as $results) 
			{
				$deposit = $deposit + $results['debit'];
				 $deduction = $deduction + $results['credit'];
				 
			}
			$amount = $deposit - $deduction;
			
			//B/W USER
			if($f_user !='' && $t_user !='')
			{
				$condition2=$condition;
			$condition2.=($condition2 !='' ) ? " AND a.user_id = '".$t_user."'" : "WHERE a.user_id = '".$t_user."'" ;
			$condition2.=($condition2 !='' ) ? " AND a.paid_to = '".$f_user."'" : "WHERE a.paid_to = '".$f_user."'" ;
				$query2=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id)".$condition2." ORDER BY a.id DESC LIMIT 50");
			  $result2 = array();
			  if(mysql_num_rows($query2) > 0)
			{
				while ($record2 = mysql_fetch_assoc($query2)) 
				{
					$result2[] = $record2;
				}
				foreach($result2 as $results2) 
				{
					 $deposit2 = $deposit2 + $results2['debit'];
					 $deduction2 = $deduction2 + $results2['credit'];
					 
				}
				$amount2 = $deduction2 - $deposit2;
				$deposit=$deposit + $deposit2;
				$deduction=$deduction + $deduction2;
				$amount=$amount - $amount2;
			}
			
			}
			
			
			
			if($amount <0)
			{
				$amount=$amount * -1 ;
				
			}
			if($deposit <0)
			{
				$deposit=$deposit * -1 ;
				
			}
			if($deduction <0)
			{
				$deduction=$deduction * -1 ;
				
			}
			
			echo $format = '{
"cols":
[
{"id":"","label":"Debit","pattern":"","type":"string"},
{"id":"","label":"Credit","pattern":"","type":"number"}
],
"rows":[{"c":[{"v":"Deposit","f":null},{"v":'.$deposit.',"f":null}]},{"c":[{"v":"Deduction","f":null},{"v":'.$deduction.',"f":null}]},{"c":[{"v":"Balance","f":null},{"v":'.$amount.',"f":null}]}]}';
		}
		//ACCOUNTS
		public function Accounts($condition)
		{
			
		  $query=mysql_query("SELECT a.id,a.user_id,a.email,a.rolename,a.account_no,a.debit,a.credit,a.amount,a.points_mode,a.challan,a.used,a.paid_to,a.pay_type,a.tranx_id,a.active,a.created_at,a. modified_at,a.tran_count,CONCAT(u.first_name,' ', u.last_name) AS name,u.email,u.referral_code,u.contactno,ac.name as division_name ,r.rolename as rname FROM accounts AS a LEFT JOIN users AS u ON(a.user_id = u.id) LEFT JOIN acct_categories AS ac ON (a.pay_type = ac.id) LEFT JOIN role as r ON (a.rolename=r.id)".$condition." ORDER BY a.id DESC LIMIT 50");
		  $result = array();
		
			while ($record = mysql_fetch_assoc($query)) 
			{
				
				$result[] = $record;
				
			}
			return $result;
		}
		 public function User($keyword,$role)
		{  
		
            $qr = mysql_query("SELECT * FROM users where  ( CONCAT(first_name,' ', last_name) like '".$keyword."%' OR referral_code like'".$keyword."%' ) AND rolename='".$role."'  ORDER BY first_name ASC");  
			
            $row = mysql_num_rows($qr);  
            if($row > 0)
			{  
                while ($record = mysql_fetch_assoc($qr)) 
				{
					$result[] = $record;
				}
				return $result; 
            }
			else 
			{  
                return false;  
            }  
        }
		//USER DETAILS
		public function user_details($id)
		{  
            $qr = mysql_query("SELECT * FROM users WHERE id = '".$id."'");  
            $row = mysql_num_rows($qr);  
            if($row > 0){  
                $result = mysql_fetch_assoc($qr);
			return $result;  
            } else {  
                return false;  
            }  
        }
		//SINGLE USER
		public function show_single_user($id)
		{
		
			echo '<table width="100%">
				<tr>
			<th bgcolor="#66FFCC"></th>
			<th bgcolor="#66FFCC"><font color="#666666">SELECTED USER</font></th>
			</tr>';
			$result=$this-> user_details($id);
			echo '<tr>';
			echo '<td> Name : </td>';
			echo '<td>'.$result['first_name'].' '.$result['last_name'].'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td> Email : </td>';
			echo '<td>'.$result['email'].'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td> Ref:Code : </td>';
			echo '<td>'.$result['referral_code'].'</td>';
			echo '</tr>';
		}
		//B/W USER
		public function show_btw_user($fid,$tid)
		{
		
			echo '<table width="100%">
				<tr>
			<th bgcolor="#66FFCC"></th>
			<th bgcolor="#66FFCC"><font color="#666666">SELECTED USER</font></th>
			</tr>';
			$fresult=$this-> user_details($fid);
			$tresult=$this-> user_details($tid);
			echo '<tr>';
			echo '<td> FROM USER : </td>';
			echo '<td> TO USER : </td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td> Name : '.$fresult['first_name'].' '.$fresult['last_name'].'</td>';
			echo '<td>Name: '.$tresult['first_name'].' '.$tresult['last_name'].'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td> Email : '.$fresult['email'].'</td>';
			echo '<td> Email: '.$tresult['email'].'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td> Ref:Code : '.$fresult['referral_code'].'</td>';
			echo '<td> Ref:Code :'.$tresult['referral_code'].'</td>';
			echo '</tr>';
		}
   }  
?>  