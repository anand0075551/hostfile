<?php foreach ($status_Details->result() as $status)
    ;
?>


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
                        District Details
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-striped">

                        <tr>
                            <td>Business Category</td>
                            <td><?php
                                $status->business_name;

                                $table_name = 'status';
                                $where_array = array('business_name' => $status->business_name);
                                $query1 = $this->db->where($where_array)->get($table_name);
                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row1) {
                                        $business_groups_id = $row1->business_name;

                                        $table_name = 'business_groups';
                                        $where_array = array('id' => $business_groups_id);
                                        $query2 = $this->db->where($where_array)->get($table_name);
                                        foreach ($query2->result() as $row2) {
                                            $business_groups_name = $row2->business_name;
                                        }
                                    }

                                    echo $business_groups_name;
                                } else {
                                    echo "Pincode Doesnot Exist";
                                }
                                ?></td>
                        </tr>


                        <tr>
                            <td>Status Name</td>
                            <td><?php echo $status->status; ?></td>
                        </tr>
                        <tr>
                            <td>To Role</td>
                            <td><?php
                                //	echo $status->to_role;
								 $to_role = "";
								 
                                if ($status->to_role != 0) 
								{
									
									
                                    $pincode_name = explode(",", $status->to_role);
                                    foreach ($pincode_name as $pincode_id) 
									{

                                        $query = $this->db->get_where('role', ['id' => $pincode_id]);
										foreach ($query->result() as $d) 
										{
											$r = $d->rolename; 
										} 
									
									 $to_role .= $r . ", ";
                                    }
									echo $to_role;
                                 }else 
								{
                                    echo "Data Doesnot Exist";
                                }
                                
								
								
								
                   /*             $to_role = $status->to_role;
                                $query = $this->db->get_where('role', ['id' => $to_role]);
                                foreach ($query->result() as $d) {
                                    echo $d->rolename; } */
                                
                                ?></td>
                        </tr>
                        <tr>
                            <td>View Status</td>
                            <td><?php
                                $stat = $status->view_status;
                                if ($stat == 1) {
                                    echo "Active";
                                } else {
                                    echo "No Active";
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td><?php echo $status->lang_en; ?></td>
                        </tr>
                        <tr>
                            <td>Created By</td>
                            <td><?php
                                if ($status->created_by == '0') {
                                    echo $name = 'New Entry';
                                } else {
                                    echo $users = singleDbTableRow($status->created_by)->first_name;
                                }
                                ?></td>
                        </tr>  
                        <tr>
                            <td>Created At</td>
                            <td><?php echo date("Y-m-d h:i:sa", $status->created_at); ?></td>
                        </tr>       
                        <tr>
                            <td>Modified By</td>
                            <td><?php
                                if ($status->modified_by == '0') {
                                    echo $name = 'New Entry';
                                } else {
                                    echo $users = singleDbTableRow($status->modified_by)->first_name;
                                }
                                ?></td>
                        </tr>   
                        <tr>
                            <td>Modified At</td>
                            <td><?php
                                if ($status->modified_at == '0') {
                                    echo $name = 'No Modified time';
                                } else {
                                    echo date("Y-m-d h:i:s a", $status->modified_at);
                                    ;
                                }
                                ?></td>
                        </tr>    




                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('business_status/edit_business_status/' . $status->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="<?php echo base_url('business_status/all_business_status/' . $status->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>

                </div><!-- /.box -->


            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
</section><!-- /.content -->
