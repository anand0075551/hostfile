
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
                    </h3>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">

                    <table class="table table-striped table-hover">


                        <tr><h2><b>Crop Project Maintenance</h2></b></tr>
                        <tr>

                         <!--   <td><h4>Farm Maintenance</h4></td>
                            <td><h4>Activity</h4></td>
							 <td><h4>Select Machinaries</h4></td>
							  <td><h4>Agri Tools</h4></td>
                            <td><h4>begin_date</h4></td>
                            <td><h4>End Date</h4></td>
                            <td><h4>Expected Work Hours A person</h4></td>
                            <td><h4>Working Hours A Day(A Person)</h4></td>
                            <td><h4>Select Workers(Labour Id)</h4></td>
                            <td><h4>No Of Persons</h4></td>
                            <td><h4>Price Per Hour</h4></td>							  
                            <td><h4>Payment Per Person</h4></td>
							<td><h4>Total Payment </h4></td>
                            <td><h4>Expected Price</h4></td>
                            <td><h4>Difference</h4></td> -->

                            <th><h4>Crop Maintenance</h4></th>
							<th><h4>Begin date & Time</h4></th>
							<th><h4>End date & Time</h4></th>
                            <th><h4>Activity</h4></th>
							<th><h4>No. OF Labours</h4></th>
                            <th><h4>Labour ID's</h4></th>		
                            <th><h4>Avearge Worked Hrs A Labour</h4></th>		
                            <th><h4>Wages Per Labour</h4></th>
                            <th><h4>Area Coverage Per Labour</h4></th>
                            <th><h4>Total Labour Cost</h4></th>
                            <th><h4>Machinary</h4></th>
                            <th><h4>Tool</h4></th>
                            <th><h4>Machinnary Charges Per Hour</h4></th>
                            <th><h4>Tool Charges Per Hour</h4></th>
                            <th><h4>Transport Cost</h4></th>
							<th><h4>Food Cost</h4></th>
							<th><h4>Used Inputs</h4></th>
							<th><h4>Inputs Qty</h4></th>
							<th><h4>Inputs Cost</h4></th>
							<th><h4>Used Pesticides</h4></th>
							<th><h4>Pesticides Qty</h4></th>
							<th><h4>Pesticides Cost</h4></th>
							<th><h4>Overall Expenditure A day</h4></th>


                        </tr>

                        <?php
                        $cnt = 1;
                        $t_cnt = $view_farm_maintenance->num_rows();
						if(!empty($view_farm_maintenance) && $view_farm_maintenance->num_rows() >0)
						{
                        foreach ($view_farm_maintenance->result() as $profile) {
							
                            ?>



                            <tr>


                                <td><?php
                                    $query1 = $this->db->get_where('farm_activity', ['id' => $profile->activity_type,]);

                                    if ($query1->num_rows() > 0) {
                                        foreach ($query1->result() as $row) {
                                            echo $row->farm_activity;
                                        }
                                    } else {
                                        echo "no data";
                                    }
                                    ?>
                                </td>

                                <td><?php echo $profile->activity; ?></td>
                                <td><?php echo $profile->start_Date; ?></td>
                                <td><?php echo $profile->end_Date; ?></td>
								<td><?php echo $profile->no_labours; ?></td>
								<td><?php echo $profile->labours_id; ?></td>
                                <td><?php echo $profile->avg_wrk_lbr; ?></td>
                                <td><?php echo $profile->wages_per_labour; ?></td>
                                <td><?php echo $profile->area_per_labour; ?></td>
                                <td><?php echo $profile->total_labour; ?></td>
                                <td><?php echo $profile->machinary; ?></td>
                                <td><?php echo $profile->tool; ?></td>
                                <td><?php echo $profile->mch_chg_hrs; ?></td>
                                <td><?php echo $profile->tool_chg_hrs; ?></td>
								<td><?php echo $profile->trnp_cost; ?></td>
                                <td><?php echo $profile->food_cost; ?></td>
                                <td><?php echo $profile->used_inputs; ?></td>
								<td><?php echo $profile->inputs_qty; ?></td>
                                <td><?php echo $profile->inputs_cost; ?></td>
                                <td><?php echo $profile->used_pesticides; ?></td>
								<td><?php echo $profile->pesticides_qty; ?></td>
                                <td><?php echo $profile->pesticides_cost; ?></td>
                                <td><?php echo $profile->total_exp_day; ?></td>

                                <?php ?>



                            </tr> 







                            <?php
                            $cnt++;
                        } }
                        ?>
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-2"> <a href="<?php echo base_url('Agriculture/all_agriculture_project/') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>Back To Project List</a></div>
                            <!-- <div class="col-sm-2"><a href="< ?php echo base_url('Agriculture/farm_maitenance2/' . $aid) ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Maintenance</a></div>	-->
							
							<div class="col-sm-2"><a href="<?php echo base_url('Agriculture/view_crop_project/' . $aid) ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Maintenance</a></div>
							
                        </div>



                    </table>


                  



                    <div class="box-footer">

                    </div>
                   
                </div>


            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->


