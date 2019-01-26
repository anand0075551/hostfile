<?php foreach($invoiceQuery ->result() as $invoice); ?>
<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo $title.' | '; ?>  Consumer1st Virtual Personal Assistance [V.P.A] </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<!-- Main content -->

<?php 
	foreach($invoiceItem->result() as $item){
		$pay_type = $item->categoryName;
	}
	
	$get_pay_type = $this->db->get_where('acct_categories', ['name'=>$pay_type]);
	if($get_pay_type->num_rows() > 0){
		foreach($get_pay_type->result() as $p);
		$p_type = $p->id;
		$condition = " pay_type LIKE '%".$p_type."%'";
		$get_lables = $this->db->where($condition)->get('dynamic_invoice');
		if($get_lables->num_rows() > 0){
			foreach($get_lables->result() as $label){
				$title = $label->title;
				$date = $label->date;
				$sender_name = $label->sender_name;
				$receiver_name = $label->receiver_name;
				$invoice_no = $label->invoice_no;
				$sl_no = $label->sl_no;
				$transaction_remarks = $label->transaction_remarks;
				$business_category = $label->business_category;
				$price = $label->price;
				$sub_total = $label->sub_total;
				$total = $label->total;
			}
		}
		else{
			$title = 'Consumer1st Virtual Personal Assistance [V.P.A]';
			$date = 'Date';
			$sender_name = "Sender's Name";
			$receiver_name = "Receiver's Name";
			$invoice_no = "Transaction Reference No";
			$sl_no = "Qty";
			$transaction_remarks = "Transaction Remarks";
			$business_category = "Business Category";
			$price = "Price";
			$sub_total = "Subtotal";
			$total = "Total";
		}
	}
	
	
?>


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <!-- Main content -->
                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-globe"></i> <?php echo $title; ?>
                                    <small class="pull-right"><?php echo $date; ?>: <?php echo date('d/m/Y', $invoice->created_at); ?></small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <h4><?php echo $sender_name; ?></h4>
                                <address>
                                    <strong>
                                        <?php echo $invoice->agentFirstName.' '.$invoice->agentLastName; ?>
                                    </strong><br>

                                    <?php echo nl2br($invoice->agentStreetAddress).'<br/>';
                                    echo 'Phone: '.$invoice->agentContactNo.'<br/>';
                                    echo 'Email: '.$invoice->agentEmail.'<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                               <h4><?php echo $receiver_name; ?></h4>
                                <address>
                                    <strong>
                                        <?php echo $invoice->userFirstName.' '.$invoice->userLastName; ?>
                                    </strong><br>

                                    <?php echo nl2br($invoice->userStreetAddress).'<br/>';
                                    echo 'Phone: '.$invoice->userContactNo.'<br/>';
                                    echo 'Email: '.$invoice->userEmail.'<br/>';
                                    ?>
                                </address>
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b><?php echo $invoice_no; ?> : #<?php echo $invoice->id; ?></b><br/>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th width="5%"><?php echo $sl_no; ?></th>
                                        <th width="50%"><?php echo $transaction_remarks; ?></th>
                                        <th width="25%"><?php echo $business_category; ?></th>
								<!--	<th>Used Vouchers</th>	-->
                                        <th width="10%"><?php echo $price; ?></th>
                                        <th width="10%"><?php echo $sub_total; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($invoiceItem->result() as $item){ ?>
                                    <tr>
                                        <td><?php echo $item->qty; ?></td>
                                        <td><?php echo $item->product_name; ?></td>
                                        <td><?php echo $item->categoryName; ?></td>
                                <!--	<td></td>	-->
                                        <td><?php echo number_format($item->item_price, 2); ?></td>
                                        <td>
                                            <?php echo number_format($item->price, 2);
                                            $totalPrice[] = $item->price;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    <?php echo get_option('invoice_information'); ?>
                                </p>
                            </div><!-- /.col -->
                            <div class="col-xs-6">
                                <br />
                                <div class="table-responsive">
                                    <table class="table" align="center">
                                        <tr>
                                            <th style="width:50%"><?php echo $total; ?>:</th>
                                            <td><?php echo number_format(array_sum($totalPrice), 2); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->


                        <?php echo get_option('invoice_terms') != ''? '<p style="text-align: center">'.get_option('invoice_terms').'</p>' : ''; ?>

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                <a href="<?php echo base_url('product/pdf_invoice/'.$invoice->id) ?>" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download PDF</a>
                            </div>
                        </div>
                    </section><!-- /.content -->


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

</body>
</html>

