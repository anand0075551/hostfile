
<?php include('header.php'); ?>
<?php
foreach ($address_Details->result() as $address)
    ;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $currentUser = singleDbTableRow($user_id)->role;
                        $rolename = singleDbTableRow($user_id)->rolename;
                        $email = singleDbTableRow($user_id)->email;

                        if ($rolename == '11') {
                            ?>
                            <tr>
                                <td width="20%">Referral Code</td>
                                <th><?php echo $address->root_id; ?></th>
                            </tr>

                        <?php } ?>
                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $currentUser = singleDbTableRow($user_id)->role;
                        $rolename = singleDbTableRow($user_id)->rolename;
                        $email = singleDbTableRow($user_id)->email;
                        if($currentRolename == '13' || $currentRolename == '41') {
                            ?>
                            <tr>
                                <td width="20%">Business Groups</td>
                                <th><?php
                                    //	echo $address->business_name; 
                                    $business_name = "";
                                    if ($address->business_name != "") {
                                        $pincode_name = explode(",", $address->business_name);
                                        foreach ($pincode_name as $pincode_id) {
                                            $get_biz = $this->db->get_where('status', ['id' => $pincode_id]);
                                            foreach ($get_biz->result() as $biz) {
                                                $business_name .= $biz->status . ", ";
                                            }
                                        }
                                    } else {
                                        $business_name = "Business Group Doesnot Exist";
                                    }
                                    echo $business_name;
                                    ?></th>
                            </tr>

                        <?php } ?>
                        <tr>
                            <th width="20%">Address Type</th>
                            <th><?php echo $address->address_type; ?></th>
                        </tr>

                        <tr>
                            <td>Country</td>
                            <td><?php echo $address->country; ?></td>


                        </tr>

                        <tr>
                            <td>State</td>
                            <td><?php echo $address->state; ?></td>            
                        </tr>

                        <tr>
                            <td>District</td>
                            <td><?php echo $address->district; ?></td>            
                        </tr>


                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $currentUser = singleDbTableRow($user_id)->role;
                        $rolename = singleDbTableRow($user_id)->rolename;
                        $email = singleDbTableRow($user_id)->email;

                        if ($rolename != '12') {
                            ?>
                            <tr>
                                <td>Location </td>
                                <td><?php echo $address->location_id; ?></td>
                            </tr>
                        <?php } ?>   





                        <tr>
                            <td>Pincode   </td>
                            <td><?php echo $address->pincode; ?></td>
                        </tr>
                        <tr>
                            <td>House/Building No  </td>
                            <td><?php echo $address->house_buildingno; ?></td>
                        </tr>
                        <td>Street Name </td>
                        <td><?php echo $address->street_name; ?></td>
                        </tr>
                        <td> Land Mark  </td>
                        <td><?php echo $address->land_mark; ?></td>

                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $currentUser = singleDbTableRow($user_id)->role;
                        $rolename = singleDbTableRow($user_id)->rolename;
                        $email = singleDbTableRow($user_id)->email;

                        if ($rolename == '11') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo singleDbTableRow($address->created_by)->first_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $address->created_at); ?></td>
                            </tr>       
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($address->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo singleDbTableRow($address->modified_by)->first_name;
                                    }
                                    ?></td>
                            </tr>   
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($address->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $address->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>  

                        <?php } ?>											 
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('User_address/address_Index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                    <a href="<?php echo base_url('User_address/edit/' . $address->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->




















