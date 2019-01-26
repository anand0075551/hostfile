
<?php 
	foreach($invoiceQuery ->result() as $cart);
?>


<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Consumer1st LPA Invoice </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
    
</head>

<div id="print_div" class="container" style="border:1px solid gray; background:white;">
<div class="row">
	<div style="width:30%; float:left; padding:25px;">
		<img src="<?php echo base_url('assets/img')?>/cfirst_logo.jpg" class="img-responsive" style="width:170px; height:100px">
	</div>
	<div style="width:30%; float:left;" class="text-center"><br><br> <font size="6">Gift Receipt</font> </div>
	<div style="width:30%; float:right;">
	<br>
		TIN 29401381945<br>
		CONSUMERFIRST TECHNOSERVICES PVT LTD.<br>
		#418, 6th B cross, 6th Block<br>
		KORAMANGALA, BANGLORE-95<br>
		Ph : 080-335-8384
	
	<br><br><b>Invoice ID # : </b><?php echo $cart->transaction_id; ?></div>
</div>
<hr />
<div class="row clearfix">
    <div style="width:47%; height:170px; float:left; padding:25px; border:1px solid gray; margin-top:10px; margin-left:20px;">
        <p><strong>Billing Information</strong></p>
        <p>
            <?php
            echo singleDbTableRow($cart->user_id)->first_name.' '.singleDbTableRow($cart->user_id)->last_name . '<br />' .
                singleDbTableRow($cart->user_id)->email . '<br />'.
                singleDbTableRow($cart->user_id)->contactno . '<br />' ;
               // $cart['paypal_transaction_id'];
            ?>
        </p>
    </div>
    <div style="width:47%; text-align:right; height:170px; float:left; padding:25px; border:1px solid gray; margin-top:10px; margin-left:20px;">
        <p><strong>Shipping Information</strong></p>
        <p>
            <?php
            echo singleDbTableRow($cart->user_id)->first_name.' '.singleDbTableRow($cart->user_id)->last_name . '<br />' .
                $cart->ship_street . '<br />' .
                $cart->ship_city . ', ' . $cart->ship_state . '  ' . $cart->ship_zip . '<br />';
            ?>
        </p>
    </div>
</div>
<br />
<div class="row clearfix">
    <div style="width:47%; height:170px; float:left; padding:25px; border:1px solid gray; margin-top:10px; margin-left:20px;">
        <p><strong>Payment Details</strong></p>
        <p>
            <font size="3"> Payment Status : </font> <i> <?php echo "Paid"; ?> </i> <br>
			<font size="3"> Payment Method : </font> <?php echo $cart->transaction_type; ?>
        </p>
    </div>
    <div style="width:47%; text-align:right; height:170px; float:left; padding:25px; border:1px solid gray; margin-top:10px; margin-left:20px;">
        <p><b>Order Date :</b></p>
		<p><?php echo date('d M, Y', $cart->ref_date); ?></p>
		<p><b>Bill Generated Date :</b></p>
		<p><?php echo date("d M, Y"); ?></p>
    </div>
</div>
<hr />
<div class="row table-responsive" style="padding-left:20px; padding-right:20px;">
<table class="table table-bordered">
    <thead>
    <tr>
        <?php if (isset($cart_item['thumb'])): ?>
        <?php endif ?>
        <th>Image</th>
        <th>Product Name</th>
        <th class="text-center">Unit Price</th>
        <th class="text-center">Quantity</th>
        <th class="text-right">Subotal</th>
    </tr>
    </thead>
    <tbody>
    <?php
	$products = unserialize($cart->cart_data);
    foreach($products as $cart_item) {
        ?>
        <tr>
            <td>
                <?php if (isset($cart_item['thumb'])): ?>
                    <img src="<?php echo $cart_item['thumb']; ?>" alt="" style="width:25px">
                <?php else: ?>
                    <img src="<?php echo base_url() ?>assets/system/no_image.jpg" class="img-responsive" style="width:25px">
                <?php endif ?>
            </td>
            <td>
                <?php echo $cart_item['name']; ?>
            </td>
            <td class="text-center"> LPA <?php echo number_format($cart_item['price'],2); ?></td>
            <td class="text-center"><?php echo $cart_item['qty']; ?></td>
            <td class="text-right"> LPA <?php echo round($cart_item['qty'] * $cart_item['price'],2); ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>
<div class="row clearfix">
    <div class="table-responsive" style="width:40%; float:right; margin-right:30px;">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td><strong> Subtotal</strong></td>
                <td class="text-right"> LPA <?php echo number_format($cart->sub_total,2); ?></td>
            </tr>
            <tr>
                <td><strong>Shipping</strong></td>
                <td class="text-right">LPA <?php echo number_format($cart->handling,2); ?></td>
            </tr>
            <tr>
                <td><strong>Tax</strong></td>
                <td class="text-right">LPA <?php echo number_format($cart->tax,2); ?></td>
            </tr>
            <tr>
                <td><strong>Grand Total</strong></td>
                <td class="text-right">
                    <strong>LPA <?php echo number_format($cart->grand_total,2); ?></strong>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


</div>

<div class="container">
<div class="row text-right no-print" style="padding:25px;">
	<button class="btn btn-primary" id="create_pdf"><i class="fa fa-file-pdf-o"></i>  Download PDF</button>
	<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
</div>
</div>
<br>


</html>

<?php function page_js(){ ?>
<script>
	$(document).ready(function(){
	var form = $('#print_div'),
	//	cache_width = form.width(),
		a4  =[ 830,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('lpa_invoice.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>

<?php } ?>