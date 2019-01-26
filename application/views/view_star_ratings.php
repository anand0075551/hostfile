<?php function page_css(){ ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/themes/krajee-fa/theme.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/themes/krajee-svg/theme.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="<?php echo base_url('assets/admin'); ?>/css/themes/krajee-uni/theme.css" rel="stylesheet" media="all" type="text/css"/>
<?php } ?>
<?php include('header.php'); ?>
<?php
foreach ($profile->result() as $star)
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
                            <td>Business</td>
                            <td><?php
							$query = $this->db->get_where('business_groups',['id'=>$star->business_id]);
								     if($query->num_rows()>0)
									 {								
										foreach($query->result() as $d)
										{
											echo $business_group = $d->business_name;
									 	}
									 }
									 else 
									 {
											 echo $business_group =  " ";
									 } 
									 ?></td>
                        </tr>
						<tr>
                            <td>Rate by</td>
                            <td><?php echo $fname = singleDbTableRow($star->rate_by)->first_name . ' ' . singleDbTableRow($star->rate_by)->last_name; ?></td>
                        </tr>
						<tr>
                            <td>Source</td>
                            <td><?php echo $star->source;?></td>
                        </tr>
						<tr>
                            <td>Rate</td>
                            <td><input type="text" name="star" class="rating rating-loading" data-size="xs" title="" value="<?php echo $star->star;?>" readonly></td>
                        </tr>
						<tr>
                            <td>Status</td>
                            <td><?php if($star->status == 1)
							{
								echo "Available";
							}
							else
							{
								echo"Not available";
							}
							?></td>
                        </tr>
						<tr>
                            <td>Comment</td>
                            <td><?php echo $star->comment; ?></td>
                        </tr>
                        <?php
                        $role = $user_info['role'];
                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($star->created_by)->first_name . ' ' . singleDbTableRow($star->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date('Y-m-d',$star->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($star->modified_by == '0')
									{
                                        echo $name = 'New Entry';
                                    }
									else 
									{
                                        echo $fname = singleDbTableRow($star->modified_by)->first_name . ' ' . singleDbTableRow($star->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($star->modified_at == '0') 
									{
                                        echo $name = 'No Modified time';
                                    }
									else 
									{
                                        echo date('Y-m-d',$star->modified_at);
                                    }
                                    ?>
									</td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('Star_ratings/star_ratings_index/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
				<a href="<?php echo base_url('Star_ratings/edit_star_ratings/' . $star->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
                </div>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/jquery/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/star-rating.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/themes/krajee-fa/theme.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/themes/krajee-svg/theme.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/themes/krajee-uni/theme.min.js" type="text/javascript"></script>
<?php }?> 