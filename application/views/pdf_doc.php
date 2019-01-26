<?php foreach ($docQuery->result() as $generate_doc)
    ;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php if (isset($title)) echo $title . ' | '; ?>  User Document </title>
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <style>
            body{
                font-size: 12px; !important;
                background: #ffffff !important;
            }
        </style>
    </head>


    <section class="content invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <table class="table no-border" style="width: 100%">
                    <tr>
                        <td><h3>Consumer1st</h3>  </td>
                        <td>Date: <?php echo date('d/m/Y', $generate_doc->created_at); ?>< </td>
                    </tr>
                </table>

            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info" style="border-bottom: 1px solid #f4f4f4; border-top: 1px solid #f4f4f4" >
            <table class="table no-border" style="width: 100%">
                <tr>
                    <td>
                     <b>  <?php echo $generate_doc->file_name; ?></b>
                        <address>
                            <strong>
<?php 
	$currentAuthDta = loggedInUserData();
	$currentUser = $currentAuthDta['role'];
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentRolename = singleDbTableRow($user_id)->rolename;
	
	$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
	$email = singleDbTableRow($user_id)->email;
	$mobile = singleDbTableRow($user_id)->contactno;
	?><?php
	
	  $doc2 = $this->db->order_by('id', 'asc')->get('generate_doc');
  if($doc2->num_rows() >0)
   {
	  foreach ($doc2->result() as $t);
	    $userfile = $t->userfile;
		{
	?>

  
					 <?php  
							$str      =	$generate_doc->userfile;
							$replace  = array($name,$email,$mobile);	
							$find     = array('$name','$email','$mobile');
							$string   = str_replace($find,$replace,$str);
							echo $string;
					?>
						
   <?php } }?>
                            </strong><br>

                          
                        </address>
                    </td>


                </tr>
            </table>

            <br />
        </div><!-- /.row -->


        <br />





      


    </section><!-- /.content -->



</body>
</html>

