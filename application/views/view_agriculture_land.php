
<?php include('header.php'); ?>
<?php
foreach ($agr_landid->result() as $profile)
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

                        <tr>
                            <td>Land ID</td>
                            <td><?php echo $profile->land_id; ?></td>
                        </tr>
						
						 <tr>
                            <td>City</td>
                            <td><?php echo $profile->city; ?></td>
                        </tr>


                        <tr>
                            <td>Pincode</td>
                            <td><?php echo $profile->pincode; ?></td>
                        </tr>
                        <tr>
                            <td>usuage type</td>
                            <td><?php
                                $query = $this->db->get_where('agri_use_type', ['id' => $profile->usuage_type]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->usage_type;
                                    }
                                } else {
                                    echo "Doesnot Exist";
                                }
                                ?></td>
							
                        </tr>
                        <tr>
                            <td>land type</td>
							<td><?php
                                $query1 = $this->db->get_where('agri_land_type', ['id' => $profile->land_type]);

                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo $row->land_type;
                                    }
                                } else {
                                    echo "Doesnot Exist";
                                }
                                ?></td>
                        </tr>
						
						

                        <tr>
                            <td>soil type</td>
                            <td><?php echo $profile->soil_type; ?></td>
                        </tr>
                        <tr>
                            <td>start date</td>
                            <td><?php echo $profile->start_date; ?></td>
                        </tr>
                        <tr>
                            <td>end date</td>
                            <td><?php echo $profile->end_date; ?></td>
                        </tr>

                        <tr>
                            <td>land verified</td>
                            <td><?php echo $profile->land_verified; ?></td>
                        </tr>
                        <tr>
                            <td>survey no</td>
                            <td><?php echo $profile->survey_no; ?></td>
                        </tr>
                        <tr>
                            <td>fertility level</td>
                            <td><?php echo $profile->fertility_level; ?></td>
                        </tr>

                        <tr>
                            <td>Weather Map</td>
                            <td><?php
                                $query1 = $this->db->get_where('agri_weather', ['id' => $profile->weather_map]);

                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo $row->weather_type;
                                    }
                                } else {
                                    echo "Doesnot Exist";
                                }
                                ?></td>
							
                        </tr>

                        <tr>
                            <td>Bus Distance</td>
                            <td><?php echo $profile->bus_distance; ?></td>
                        </tr>

                        <tr>
                            <td>Holding</td>
                            <td><?php echo $profile->holdings; ?></td>
                        </tr>

                        <tr>
                            <td>Size Guta</td>
                            <td><?php echo $profile->size_gutas; ?></td>
                        </tr>

                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $profile->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">

                  
					 <a href="<?php echo base_url('Agriculture/all_agriculture_land') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					  <a href="<?php echo base_url('Agriculture/edit_agriculture_land/' . $profile->id) ?>" class="btn btn-warning"><i class="fa fa-arrow-edit"></i>Edit</a>
					 
					 
                    

                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
