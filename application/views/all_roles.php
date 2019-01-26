
<?php function page_css(){ ?>

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="callout callout-info">
                <h4>Note: Password not shown due to security issue</h4>
            </div>

            <div class="box box-primary">


                <div class="box-header">
                    <h3 class="box-title">User-Roles List</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
                        <table class="table table-hover">
                            <tr>
                                <th>User Type ID</th>
                                <th>User Type/Role Name</th>
                                <th>permission_id</th>
                                <th>Role Type</th>
								<th>Sponsorship fees</th>
								<th>Fees Ledger Deposit</th>
								<th>Referral Commission Deduction</th>
								<th>Commission Percentage % </th>
                                <th>created_by</th>
                              <!--  <th>Action</th> -->
                            </tr>

                            <?php foreach($role_List->result() as $r){ ?>

                                <?php
                                $activeStatus = $r->active;
                                //Status Button
                                switch($activeStatus){
                                    case 0:
                                        $statusBtn = '<small class="label label-default pull-right"> Pending </small>';
                                        $blockUnblockBtn = '';
                                        break;
                                    case 1 :
                                        $statusBtn = '<small class="label label-success pull-right"> Active </small>';
                                        $blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
                                        break;
                                    case 2 :
                                        $statusBtn = '<small class="label label-danger pull-right"> Blocked </small>';
                                        $blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
                                        break;
                                }
                                ?>


                                <tr>
                                  <!--  <td><?php echo user_full_name($r);
                                        if($r->id == 1)
                                            echo '<span class="label label-success pull-right">Super Admin</span>';
                                        echo $statusBtn;
                                        ?></td> -->
									<td><?php echo $r->id; ?></td>
									<td><?php echo $r->rolename; ?></td>                                    
 									<td><?php echo $r->permission_id; ?></td>									
 									<td><?php echo $r->type; ?></td>
                                    <td><?php echo $r->fees; ?></td>
									
									<td><?php if ($r->dedfees_payspec != '0')
											{	 $name = ledgerDbtablerow($r->dedfees_payspec)->name; 											
												 echo $r->dedfees_payspec.'-'.$name;
											}else{
												echo $name = 'N/A'; 
											}
											?></td>
									
									<td><?php if ($r->comfees_payspec != '0')
											{	 $name = ledgerDbtablerow($r->comfees_payspec)->name; 											
												 echo $r->comfees_payspec.'-'.$name;
											}else{
												 echo $name = 'N/A'; 
											}
											?></td>
								
									<td><?php if ($r->com_per != '0')
											{	 										
												 echo $r->com_per;
											}else{
												echo  'N/A';  
											}
											?></td>
									<td><?php if ($r->created_by != '0')
											{	 $f_name = singleDbtablerow($r->created_by)->first_name; 
												 $l_name = singleDbtablerow($r->created_by)->last_name; 
												 echo $f_name.' '.$l_name;
											}else{
												echo $name = 'System Administrator'; 
											}
											?></td>
                                    <!--<td>< ?php echo $r->active; ?></td>									-->
                                    <td>

                                        <?php


                                        //Action Button
                                        $button = '';
                                      //  $button .= '<a class="btn btn-primary editBtn" href="'.base_url('user/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
					//	<i class="fa fa-eye"></i> </a>';
                     //                   $button .= '<a class="btn btn-info editBtn"  href="'.base_url('agent/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
					// <i class="fa fa-edit"></i> </a>';
                     //                   $button .= $blockUnblockBtn;
                     //                   $button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					//	<i class="fa fa-trash"></i> </a>';

                                        //Determine This is superadmin

                                        if($r->id != 1)
                                        echo $button;

                                        ?>

                                    </td>
                                </tr>
                            <?php } ?>



                        </table>

					</div>
					</div>







                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">


                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <script>

        $('body').on('click', 'a.deleteBtn', function (e) {
            e.preventDefault();
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you sure?'); //confirm

            if(verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('roles/deleteAjax') ?>",
                    data: {id: agentId},
                })
                    .done(function (msg) {
                        currentItem.closest('tr').hide('slow');
                    });
            }
        });


        $('body').on('click', 'button.blockUnblock', function (e) {
            e.preventDefault();
            var agentId = $(this).attr('id');
            var buttonValue = $(this).val();
            //alert(buttonValue);
            //set type of action
            var currentItem = $(this);
            if(buttonValue == 1){
                var status = 'Unblocked';
            }else if(buttonValue == 2){
                var status = 'Blocked';
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('roles/setBlockUnblock') ?>",
                data: {id: agentId, buttonValue : buttonValue, status : status}
            })
                .done(function (msg) {
                    if(buttonValue == 1){
                        currentItem.removeClass('btn-success');
                        currentItem.addClass('btn-warning');
                        currentItem.html('<i class="fa fa-lock"></i>');
                        currentItem.attr( 'title','Block');
                        currentItem.val(2);
                    }else if(buttonValue == 2){
                        currentItem.removeClass('btn-warning');
                        currentItem.addClass('btn-success');
                        currentItem.html('<i class="fa fa-unlock-alt"></i>');
                        currentItem.attr( 'title','Unblock');
                        currentItem.val(1);
                    }
                });
        });



    </script>
<?php } ?>

