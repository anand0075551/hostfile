<?php include('header.php'); ?>
<?php
foreach ($query->result() as $result)
    
    ?>
<body>
    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <font size="5">User Details</font>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-10" align="right"><br>
                        <a href="<?php echo base_url('referTree/user_report/') ?>" class="btn btn-primary">Go Back</a>
                        <br></br>
                        <table align="center" cellpadding="10" id="myprofiletab" class="table table-responsive">
                            <tr style="display:none;" id="ref_by">
                                <th></th>
                                <th></th>
                                <th align="right" ></th><td>


                                    <table align="center" class="table table-bordered table-hover">
                                        <tr style='background:lavender;'>
                                            <th colspan="4" class="text-center">Referred By</th>
                                        </tr>
                                        <?php
                                        $ref_By_Code = $result->referredByCode;
                                        $ref_code = $this->db->get_where('users', ['referral_code' => $ref_By_Code]);
                                        foreach ($ref_code->result() as $ref)
                                            ;
                                        ?>
                                        <tr>
                                            <th>Person Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                        <tr>
                                            <td><a href="<?php echo base_url('referTree/view_referral_tree/' . $ref->id) ?>"><?php echo $ref->first_name . " " . $ref->last_name ?></a>
                                            </td>
                                            <td><a href="<?php echo base_url('referTree/view_referral_tree/' . $ref->id) ?>"><?php echo $ref->email ?></a>
                                            </td>
                                            <td><a href="<?php echo base_url('referTree/view_referral_tree/' . $ref->id) ?>"><?php
                                                    if ($ref->active == '1') {
                                                        echo "Active";
                                                    } elseif ($ref->active == '2') {
                                                        echo"Deactivate";
                                                    } elseif ($ref->active == '0') {
                                                        echo"Pending";
                                                    } elseif ($ref->active == '3') {
                                                        echo "Deactivate By Admin";
                                                    } else {
                                                        echo $ref->active;
                                                    }
                                                    ?></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left" name="rolename">Role Name</th>
                                <th>:</th>
                                <td><button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-up" onclick="get_ref_by()"></span></button>&nbsp;&nbsp;&nbsp;
                                    <?php
                                    $role = $result->rolename;
                                    if ($role == "11" || $role == "12") {
                                        echo $result->first_name . " " . $result->last_name;
                                    } else {
                                        echo $result->company_name;
                                    }
                                    ?>
                                    &nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-down" onclick="get_my_ref()"></span></button>
                                </td>
                            </tr>
                            <tr style="display:none;" id="my_referrals">
                                <th></th>
                                <th></th>
                                <th align="right" ></th><td>
                                    <table align="center" class="table table-bordered table-hover">

                                        <tr style='background:lavender;'>
                                            <th colspan="5" class="text-center">My Referrals </th>
                                        </tr>	
                                        <tr>
                                            <th>SL No</th>
                                            <th>Person Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                        <?php
                                        $my_ref_code = $result->referral_code;
                                        $my_ref = $this->db->get_where('users', ['referredByCode' => $my_ref_code]);
                                        $i = 1;
                                        if ($my_ref->num_rows() > 0) {
                                            foreach ($my_ref->result() as $row) {

                                                echo "<tr>";
                                                echo "<td>" . $i++ . "</td>";
                                                echo "<td><a href=" . base_url('referTree/view_referral_tree/' . $row->id) . ">" . $row->first_name . " " . $row->last_name . "</a></td>";
                                                echo "<td>" . $row->email . "</td>";
                                                echo"<td>";
                                                if ($row->active == '1') {
                                                    echo "Active";
                                                } elseif ($row->active == '2') {
                                                    echo"Deactivate";
                                                } elseif ($row->active == '0') {
                                                    echo"Pending";
                                                } elseif ($row->active == '3') {
                                                    echo "Deactivate By Admin";
                                                } else {
                                                    echo $row->active;
                                                }
                                                echo"</td>";
                                                echo "<tr>";
                                            }
                                        } else {
                                            echo '<tr><td colspan="4">No referral found</td></tr>';
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left" name="name">Name</th>
                                <th>:</th>
                                <td>
                                    <?php
                                    echo $result->first_name . " " . $result->last_name;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left">Email ID </th>
                                <th>:</th>
                                <td><?php
                                    echo $result->email;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left">Conatct No.</th>
                                <th>:</th>
                                <td><?php
                                    echo $result->contactno;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left">Firm Name</th>
                                <th>:</th>
                                <td><?php
                                    if ($result->company_name != "") {
                                        echo $result->company_name;
                                    } else {
                                        echo "Not applicable";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left">Referral Code</th>
                                <th>:</th>
                                <td><?php
                                    echo $result->referral_code;
                                    ?>

                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left">Active</th>
                                <th>:</th>
                                <td>
                                    <?php
                                    if ($result->active == '1') {
                                        echo "Active";
                                    } elseif ($result->active == '2') {
                                        echo"Deactivate";
                                    } elseif ($result->active == '0') {
                                        echo"Pending";
                                    } elseif ($result->active == '3') {
                                        echo "Deactivate By Admin";
                                    } else {
                                        echo $result->active;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th align="left">Pincode</th>
                                <th>:</th>
                                <td>
                                    <?php
                                    echo $result->postal_code;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="panel-footer" >
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-3">
                                <a href="<?php echo base_url('referTree/edit_referral_tree/' . $result->id) ?>" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>Edit</a>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function get_ref_by()
                {
                    $("#ref_by").toggle(1000);
                }
                function get_my_ref()
                {
                    $("#my_referrals").toggle(1000);
                }
            </script>




            </body>
            </html>
