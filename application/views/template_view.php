<html>
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo $title.' | '; ?>  Consumer1st Virtual Personal Assistance [V.P.A] </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

</head>
<body>
<?php foreach($template_details->result() as $template); ?>
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
					<?php echo "Template Name : ".$template->template_name; ?>
					</h3>
				</div><!-- /.box-header -->
				<div class="box-body" style="border-bottom:1px solid lightgray;">

					<table class="table table-striped">
					<tr>
					<td width="20%">Used For</td>
					<td>
						<?php 
							
							echo $template->pay_type."-".singleDbTableRow($template->pay_type, 'acct_categories')->name;
						?>
					</td> 
					</tr>

					<tr>
					<td>Created At</td>
					<td><?php echo date("d M, Y - h:i A", $template->created_at); ?></td>
					</tr>
					<tr>
					<td>Created By</td>
					<td>
					<?php 
						echo singleDbTableRow($template->created_by)->first_name."".singleDbTableRow($template->created_by)->last_name;
					?></td>
					</tr>
					<tr>
					<td>Modified At</td>
					<td>
					<?php 
						if($template->modified_at!="0")
						{
							echo date("d M, Y - h:i A", $template->modified_at); 
						}
						else{
							echo "Not Modified Yet.";
						}
						
					?>
					</td>
					</tr>
					<tr>
					<td>Modified By</td>
					<td>
					<?php 
					if($template->modified_by!="0")
					{
						echo singleDbTableRow($template->modified_by)->first_name."".singleDbTableRow($template->modified_by)->last_name;
					}
					else{
						echo "Not Modified Yet.";
					}
					?></td>
					</tr>

					</table>

				</div><!-- /.box-body -->
				
				
				<div class="box-body">

					<section class="content invoice" id="invoice_area" style="border:1px solid gray; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-globe"></i> <label id="title_label"><?php echo $template->title;?></label>
                                    <small class="pull-right"><label id="date_label"><?php echo $template->date;?></label></label>: <?php echo date('d/m/Y'); ?></small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <h4 id="sender_label"><?php echo $template->sender_name;?></h4>
                                <address>
                                    <strong>
                                        Satish Patil
                                    </strong><br>

                                    <?php echo ''.'<br/>';
                                    echo 'Phone: 9902518232<br/>';
                                    echo 'Email: spremainder@gmail.com<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <h4 id="recv_label"><?php echo $template->receiver_name;?></h4>
                                <address>
                                    <strong>
                                        Anand Sagar
                                    </strong><br>

                                    <?php echo ''.'<br/>';
                                    echo 'Phone: 9980569960<br/>';
                                    echo 'Email: mr.anandsagar@gmail.com<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b><label id="invoice_no_label"><?php echo $template->invoice_no;?></label>: #1234</b><br/>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th id="qty_label"><?php echo $template->sl_no;?></th>
                                        <th id="trans_remark_label"><?php echo $template->transaction_remarks;?></th>
                                        <th id="biz_catg_label"><?php echo $template->business_category;?></th>
                                        <th id="price_label"><?php echo $template->price;?></th>
                                        <th id="subtotal_label"><?php echo $template->sub_total;?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td>1</td>
                                        <td>Product 1</td>
                                        <td>Loyality Product Purchase</td>
                                        <td>100.00</td>
                                        <td>100.00</td>
                                    </tr>
									</tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    Your all payment details are available at My Account section.
                                </p>
                            </div><!-- /.col -->
                            <div class="col-xs-6">
                                <br />
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%" id="total_label"><?php echo $template->total;?>:</th>
                                            <td>100.00</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->


                        <?php echo get_option('invoice_terms') != ''? '<p style="text-align: center">'.get_option('invoice_terms').'</p>' : ''; ?>

                       
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                <button class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download PDF</button>
                            </div>
                        </div>
                    </section>

				</div>
				
				
				<div class="box-footer">
					<a href="<?php echo base_url('dynamic_invoice/all_templates') ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
					<a href="<?php echo base_url('dynamic_invoice/edit_template/'.$template->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit Template</a>
					<a href="<?php echo base_url('dynamic_invoice/copy_template/'.$template->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-copy"></i> Copy Template</a>
				</div>

			</div><!-- /.box -->

		</div><!--/.col (left) -->
	</div>   <!-- /.row -->
</section><!-- /.content -->

</body>
</html>