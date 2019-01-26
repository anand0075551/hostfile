<?php
/* echo $ticket->ticket_no;
echo $ticket->business_id;
echo $ticket->issue_type;
echo $ticket->issue_details;
echo $ticket->comments;
echo $ticket->current_status; */

$raised_by = $ticket->created_by;
$assigned_to = $ticket->assigned_to;

?>
 

    <div style="padding:10px 5px 0px; background:purple; color:white; text-align:center;" colspan="2">
            </td>
			 <td align="center" valign="top">
                 <!-- <h2>< ?php echo 'get_option('company_name'); ?></h2> -->
                      <h2><class="text-center; ">Consumerfirst Technoservices</h2>
            </td>
        <center>
            <h2 class="text-center; ">Team Cfirst</h2>
        </center><!--/container-->
    </div><!--/breadcrumbs-->
    <table width="100%" style="background:rgba(212, 224, 212, 0.17); align:center-left;">
 
			
        <td style="padding:60px;">
                <div class="tag-box tag-box-v3">
                    
					 <h2>Currently Assigned To</h2>
                    <table>
                        <tr><td><strong>Ticket NO.</strong>:<?php echo $ticket->ticket_no; ?></td></tr>
						<tr><td><strong>Business Name</strong>:<?php echo singleDbTableRow($ticket->business_id,'business_groups')->business_name; ?></td></tr>
						<tr><td><strong>Status</strong>:<?php echo singleDbTableRow($ticket->current_status,'status')->status; ?></td></tr>
						<tr><td><strong>Issue Type.</strong>:<?php echo $ticket->issue_type; ?></td></tr>
						<tr><td><strong>First Name</strong>:<?php echo singleDbTableRow($assigned_to)->first_name; ?></td></tr>
						<tr><td><strong>Last Name</strong>:<?php echo singleDbTableRow($assigned_to)->last_name; ?></td></tr>
						<tr><td><strong>Email</strong>:<?php echo singleDbTableRow($assigned_to)->email; ?></td></tr>
						<tr><td><strong>Conatct No</strong>:<?php echo singleDbTableRow($assigned_to)->contactno; ?></td></tr>
                  
                        
                    </table>
                </div>        
        </td>
			
			

		<td style="padding:20px;">
                <div class="tag-box tag-box-v3">
                   <h2>Request Details</h2>
                    <table>
						<tr><td><strong>Ticket NO.</strong>:<?php echo $ticket->ticket_no; ?></td></tr>
						<tr><td><strong>First Name</strong>:<?php echo singleDbTableRow($raised_by)->first_name; ?></td></tr>
						<tr><td><strong>Business Name</strong>:<?php echo singleDbTableRow($ticket->business_id,'business_groups')->business_name; ?></td></tr>
						<tr><td><strong>Issue Type.</strong>:<?php echo $ticket->issue_type; ?></td></tr>
						<tr><td><strong>Issue Details.</strong>:<?php echo $ticket->issue_details; ?></td></tr>
						<tr><td><strong>Issue Comments.</strong>:<?php echo $ticket->comments; ?></td></tr>
						<tr><td><strong>Requester Email.</strong>:<?php echo singleDbTableRow($raised_by)->email; ?></td></tr>
							<tr><td><strong>Requester Contact No.</strong>:<?php echo singleDbTableRow($raised_by)->contactno; ?></td></tr>
							
						
                       
                        
                    </table>
                </div>        
        </td>	
			
        
        <tr>
            <td style="padding:10px 5px 0px; background:purple; color:white; text-align:center;" colspan="4" >
            </td>
        </tr>
        <tr>
  
         
        </tr>
		
		
		
		
   
    </table><!--/container-->     
    <!--=== End Content Part ===-->
  