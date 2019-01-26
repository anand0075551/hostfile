<?php foreach($invoiceQuery ->result() as $invoice); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)) echo $title.' | '; ?>  Sales agent management software (SAMS) </title>
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <style>
        body{
            font-size: 12px; !important;
            background: #ffffff !important;
        }
    </style>
</head>



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


<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table no-border" style="width: 100%">
                <tr>
                    <td><h3><?php echo $title; ?></h3>  </td>
                    <td><?php echo $date; ?>: <?php echo date('d/m/Y', $invoice->created_at); ?>< </td>
                </tr>
            </table>

        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info" style="border-bottom: 1px solid #f4f4f4; border-top: 1px solid #f4f4f4" >
        <table class="table no-border" style="width: 100%">
            <tr>
                <td>
                    <?php echo $sender_name; ?>
                    <address>
                        <strong>
                            <?php echo $invoice->agentFirstName.' '.$invoice->agentLastName; ?>
                        </strong><br>

                        <?php echo nl2br($invoice->agentStreetAddress).'<br/>';
                        echo 'Phone: '.$invoice->agentContactNo.'<br/>';
                        echo 'Email: '.$invoice->agentEmail.'<br/>';
                        ?>
                    </address>
                </td>

                <td>
                    <?php echo $receiver_name; ?>
                    <address>
                        <strong>
                            <?php echo $invoice->userFirstName.' '.$invoice->userLastName; ?>
                        </strong><br>

                        <?php echo nl2br($invoice->userStreetAddress).'<br/>';
                        echo 'Phone: '.$invoice->userContactNo.'<br/>';
                        echo 'Email: '.$invoice->userEmail.'<br/>';
                        ?>
                    </address>
                </td>
                <td>
                    <b><?php echo $invoice_no; ?>: #<?php echo $invoice->id; ?></b><br/>
                </td>
            </tr>
        </table>

        <br />
    </div><!-- /.row -->


    <br />

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12" >
            <table class="table table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th><?php echo $sl_no; ?></th>
                    <th><?php echo $transaction_remarks; ?></th>
                    <th><?php echo $business_category; ?></th>
                    <th><?php echo $price; ?></th>
                    <th><?php echo $sub_total; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($invoiceItem->result() as $item){ ?>
                    <tr>
                        <td><?php echo $item->qty; ?></td>
                        <td><?php echo $item->product_name; ?></td>
                        <td><?php echo $item->categoryName; ?></td>
                        <td><?php echo number_format($item->item_price, 2); ?></td>
                        <td>
                            <?php echo number_format($item->price, 2);
                            $totalPrice[] = $item->price;
                            ?>
                        </td>
                    </tr>
                <?php } ?>

                    <tr>
                        <th colspan="4" style="text-align: right"><?php echo $total; ?></th>
                        <td  style="text-align: left"><?php echo number_format(array_sum($totalPrice), 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->


    <br>
    <?php echo get_option('invoice_information') != ''? '<p style="text-align: center">'.get_option('invoice_information').'</p><br />' : ''; ?>

    <?php echo get_option('invoice_terms') != ''? '<p style="text-align: center">'.get_option('invoice_terms').'</p>' : ''; ?>

</section><!-- /.content -->



</body>
</html>

