<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        <?php echo $c_user->first_name.' '. $c_user->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
										
<div id="datablock">
<table align="center" border="1">
<caption> <h2> userlist </h2> </caption>



	<tr>
		<th> Full name </th>
		<th> Email </th>
		<th> Mobile </th>
		<th> Address </th>
		<th> Edit </th>
		<th> Delete </th>
	</tr>
	
	<?php
	
	foreach ($users as $row) 
	{
		echo"<tr>";
		echo"<td>".$row['name']."</td>";
		echo"<td>".$row['email']."</td>";
		echo"<td>".$row['mobile']."</td>";
		echo"<td>".$row['address']."</td>";
		
		echo"<td> <a href='edit?id=".$row['userid']."'> Edit </a> </td>";
		echo"<td> <a href='delete?id=".$row['userid']."'> Delete </a> </td>";
	}
	
	?>
	
</table>	

	
</div>



 </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('user/bank_acct_edit') ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?php echo base_url('user/log') ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity') ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>

                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
