<?php foreach($business_label->result() as $business_label); ?>
<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                       <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">View Business Group</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>

                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Business Group Name</th>
                                                <th><?php echo $business_label->bussiness_name; ?></th>
                                            </tr>
                                            <tr>
                                                <th width="20%">Comments</th>
                                                <th><?php echo $business_label->comments; ?></th>

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('permission/edit_label/'.$business_label->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
