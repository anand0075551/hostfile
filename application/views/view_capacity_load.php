
<?php include('header.php'); ?>
<?php
foreach ($capacityload_Details->result() as $load)
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
                            <td>Vehical Tyep</td>
                            <td><?php echo $load->capacityload; ?></td>
                        </tr>
						
						
                    </table>

                </div><!-- /.box-body -->

               <div class="box-footer">
                  <a href="<?php echo base_url('transport/capacityload_index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
                  <a href="<?php echo base_url('transport/edit_capacityload/' . $load->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
				
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
