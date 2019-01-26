<?php include('header.php'); ?>
  
<?php 

$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];	
		$currentRolename   = singleDbTableRow($user_id)->rolename;

if ($currentRolename == '11')  {  
?>

<div class="wrapper">
    <section class="content">
	
	<div class="row">
		<div class="box box-primary">
			<div class="box-header with-border">
				
				
				<h4 align="center"><b> Shop My Basket </b></h4>
				
			</div>
		</div>
	</div>
	
      <!-- Info boxes -->
	<div class="row">
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="product">
					<?php
						$get_product = $this->db->get_where('smb_product',['business_types'=>3]);
						$count=$get_product->result();	
						echo  count($count);
					?>
			  </h3>

              <p>Products</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a  href="<?php echo base_url('smb_product/physical_products'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
				<?php
					$get_sale = $this->db->get_where('smb_sale',['business'=>3]);
					$count_s=$get_sale->result();	
					echo  count($count_s);
				?>
			  </h3>

              <p>Sales</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <a href="<?php echo base_url('smb_sales/index'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
					<?php
						$vendor=0;
						$get_ven = $this->db->group_by('added_by')->get_where('smb_stock',['business_types'=>3, 'type'=>'add']);
						foreach($get_ven->result()  as $v){
							$vendor++;													
						}
						
						echo $vendor;
					?>
			  </h3>
              <p>Vendors</p>
            </div>
            <div class="icon">
			 <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
					<?php
						$get_con = $this->db->group_by('buyer')->get_where('smb_sale',['business'=>3]);
						$count_c=$get_con->result();	
						echo  count($count_c);
					?>
			  </h3>
              <p>Consumers</p>
            </div>
            <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
	</div>
	 
	 <div class="row">
		<div class="col-sm-6">
			<!-- AREA CHART -->
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Monthly Sales</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <div class="chart">
					<canvas id="areaChart" style="height:250px"></canvas>
				  </div><br>
				  <h4 class="box-title">
					<?php
						$get_total = $this->db->select_sum('grand_total')->get_where('smb_sale', ['business'=>3]);
						foreach($get_total->result() as $d){
						echo "Total :- ".number_format($d->grand_total,2);
						}
					?>
				  </h4>
				</div>
				<!-- /.box-body -->
			
			</div>
			<!-- /.box -->
		</div>
		<div class="col-sm-6">
			  <!-- BAR CHART -->
			  <div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title">Weekly Sales</h3>
				<br><br>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<div class="box-body">
				  <div class="chart">
					<canvas id="barChart" style="height:230px"></canvas>
				  </div>
				</div><br><br>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
		</div>
	  </div>
	  
	  
	   <div class="row"> 
		<div class="col-sm-5">
			<!-- DONUT CHART -->
			  <div class="box box-danger">
				<div class="box-header with-border">
				<h3 class="box-title">Daily Sales</h3>
				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<div class="box-body chart-responsive">
				  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
				</div>
					<!-- /.box-body -->
			  </div>
				  <!-- /.box -->
		
		</div>
		<div class="col-sm-7"></div>
	  </div>
	 
	  <div class="row">
		<div class="col-sm-7">
		 <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Invoice ID</th>
					<th>Date</th>
                    <th>Buyer</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
					  <?php
						$get_order = $this->db->order_by('id','desc')->limit(7,0)->get("smb_sale",['business'=>3]);
						foreach($get_order->result() as $order){
							echo "<tr>";
								echo "<td><a href=''>".$order->sale_code."</a></td>";
								echo "<td>".date('d /M/ Y', $order->sale_datetime)."</td>";
								
								$get_user = $this->db->get_where('users',['id'=>$order->buyer]);
								foreach($get_user->result() as $u);
								
								echo "<td>".$u->first_name.''.$u->last_name."</td>";
								echo "<td>".$order->paybal_amount."</td>";
							echo "</tr>";
						}
					  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a  href="<?php echo base_url('smb_product/order_history'); ?>"  class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
		</div>
		
		<div class="col-sm-5">
		<!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Products</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
				<?php
					$get_product = $this->db->order_by('id','desc')->limit(4,0)->get_where("smb_product",['business_types'=>3]);
					foreach($get_product->result() as $p){
				?>		
					
						<div class="product-info ">
							<img src="<?php echo profile_photo_url($p->main_image) ?>" class="img-thumbnail" alt="product Image" style="width:70px; height:70px;">
					
							<a href="javascript:void(0)" class="product-title"> <?php echo $p->title; ?>
							<span class="label label-success pull-right">
								<?php
									$get_price = $this->db->order_by('id','desc')->get_where("smb_stock",['product'=>$p->id]);
									foreach($get_price->result() as $s);
									if($s->sale_price != "")
									{
										echo $s->sale_price;
									}else{
										echo "0";
									}
								?> 
							</span></a>
						</div>
				<?php		
					}
				?>
                </li>
              </ul>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url('smb_product/physical_products'); ?>" class="uppercase">View All Products</a>
            </div>
            <!-- /.box-footer -->
          </div>
		</div>
	  </div>
	</section>
</div>	


<?php
	
	$jan ="";
	$feb ="";
	$mar ="";
	$apir ="";
	$may ="";
	$Jun ="";
	$jul ="";
	$aug ="";
	$sep ="";
	$oct ="";
	$nov ="";
	$dec ="";
	
	$jan_sale 	="";
	$feb_sale	="";
	$mar_sale 	="";
	$apir_sale 	="";
	$may_sale 	="";
	$jun_sale 	="";
	$jul_sale	="";
	$aug_sale	="";
	$sep_sale 	="";
	$oct_sale 	="";
	$nov_sale 	="";
	$dec_sale 	="";
	
	
	$get_days = $this->db->get_where('smb_sale',['business'=>3]);
	foreach($get_days->result() as $d){
		
		
		if(date('m', $d->sale_datetime) == "01")
		{
			$jan++;
			$jan_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "02")
		{
			$feb++;
			$feb_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "03")
		{
			$mar++;
			$mar_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "04")
		{
			$apir++;
			$apir_sale += $d->grand_total;
		}

		if(date('m', $d->sale_datetime) == "05")
		{
			$may++;
			$may_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "06")
		{
			$Jun++;
			$jun_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "07")
		{
			$jul++;
			$jul_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "08")
		{
			$aug++;
			$aug_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "09")
		{
			$sep++;
			$sep_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "10")
		{
			$oct++;
			$oct_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "11")
		{
			$nov++;
			$nov_sale += $d->grand_total;
		}
		
		if(date('m', $d->sale_datetime) == "12")
		{
			$dec++;
			$dec_sale += $d->grand_total;
		}
		
	}	
	
	
//sale mount	
if($jan_sale !=""){
		$janry_sale = $jan_sale;
	}	
	else{
		$janry_sale = 0;
	}
	
if($feb_sale !=""){
		$febry_sale = $feb_sale;
	}	
	else{
		$febry_sale = 0;
	}
	
if($mar_sale !=""){
		$march_sale = $mar_sale;
	}	
	else{
		$march_sale = 0;
	}
	
if($apir_sale !=""){
		$apirl_sale = $apir_sale;
	}	
	else{
		$apirl_sale = 0;
	}

if($may_sale !=""){
		$maye_sale = $may_sale;
	}	
	else{
		$maye_sale = 0;
	}

if($jun_sale !=""){
		$jun1_sale = $jun_sale;
	}	
	else{
		$jun1_sale = 0;
	}

if($jul_sale !=""){
		$juli_sale = $jul_sale;
	}	
	else{
		$juli_sale = 0;
	}
	
if($aug_sale !=""){
		$augst_sale = $aug_sale;
	}	
	else{
		$augst_sale = 0;
	}	

if($sep_sale !=""){
		$sept_sale = $sep_sale;
	}	
	else{
		$sept_sale = 0;
	}

if($oct_sale !=""){
		$octb_sale = $oct_sale;
	}	
	else{
		$octb_sale = 0;
	}

if($nov_sale !=""){
		$novb_sale = $nov_sale;
	}	
	else{
		$novb_sale = 0;
	}

if($dec_sale !=""){
		$decb_sale = $dec_sale;
	}	
	else{
		$decb_sale = 0;
	}
?>	

<input type="hidden" id="jan_sale" value="<?php echo $janry_sale;?>" /> 
<input type="hidden" id="feb_sale" value="<?php echo $febry_sale;?>" /> 
<input type="hidden" id="march_sale" value="<?php echo $march_sale;?>" /> 
<input type="hidden" id="apir_sale" value="<?php echo $apirl_sale;?>" /> 
<input type="hidden" id="may_sale" value="<?php echo $maye_sale;?>" /> 
<input type="hidden" id="jun_sale" value="<?php echo $jun1_sale;?>" /> 
<input type="hidden" id="juli_sale" value="<?php echo $juli_sale;?>" /> 
<input type="hidden" id="aug_sale" value="<?php echo $augst_sale;?>" /> 
<input type="hidden" id="sep_sale" value="<?php echo $sept_sale;?>" /> 
<input type="hidden" id="oct_sale" value="<?php echo $octb_sale;?>" /> 
<input type="hidden" id="nov_sale" value="<?php echo $novb_sale;?>" /> 
<input type="hidden" id="dec_sale" value="<?php echo $decb_sale;?>" /> 
	
	
<?php	
//sales 	
	
if($jan !=""){
		$janry = $jan;
	}	
	else{
		$janry = 0;
	}

if($feb !=""){
		$febry = $feb;
	}	
	else{
		$febry = 0;
	}
	
if($mar !=""){
		$march = $mar;
	}	
	else{
		$march = 0;
	}

if($apir !=""){
		$apirl = $apir;
	}	
	else{
		$apirl = 0;
	}
	
if($may !=""){
		$may1 = $may;
	}	
	else{
		$may1 = 0;
	}
	
if($Jun !=""){
		$june = $Jun;
	}	
	else{
		$june = 0;
	}	
	
if($jul !=""){
		$julay = $jul;
	}	
	else{
		$julay = 0;
	}	
	
	
if($aug !=""){
		$augst = $aug;
	}	
	else{
		$augst = 0;
	}	
	
if($sep !=""){
		$sepm = $sep;
	}	
	else{
		$sepm = 0;
	}		

if($oct !=""){
		$octm = $oct;
	}	
	else{
		$octm = 0;
	}	

if($nov !=""){
		$novm = $nov;
	}	
	else{
		$novm = 0;
	}	

if($dec !=""){
		$decm = $dec;
	}	
	else{
		$decm = 0;
	}		

	
?>	
 
<input type="hidden" id="jan" value="<?php echo $janry;?>" /> 
<input type="hidden" id="feb" value="<?php echo $febry;?>" /> 
<input type="hidden" id="march" value="<?php echo $march;?>" /> 
<input type="hidden" id="apirl" value="<?php echo $apirl;?>" /> 
<input type="hidden" id="may" value="<?php echo $may1;?>" /> 
<input type="hidden" id="jun" value="<?php echo $june;?>" /> 
<input type="hidden" id="julay" value="<?php echo $julay;?>" /> 
<input type="hidden" id="aug" value="<?php echo $augst;?>" /> 
<input type="hidden" id="sep" value="<?php echo $sepm;?>" /> 
<input type="hidden" id="oct" value="<?php echo $octm;?>" /> 
<input type="hidden" id="nov" value="<?php echo $novm;?>" /> 
<input type="hidden" id="dec" value="<?php echo $decm;?>" /> 


<?php
//weekly sales and daily sales

	$mon = "";
	$tue = "";
	$wed = "";
	$thu = "";
	$fri = "";
	$sat = "";
	$sun = "";
	
	$get_days = $this->db->get_where('smb_sale',['business'=>3]);
	foreach($get_days->result() as $d){
		
	//	echo date('D', $d->sale_datetime).' ,';
		
		if(date('D', $d->sale_datetime) == "Mon")
		{
			$mon ++;
		}
		
		if(date('D', $d->sale_datetime) == "Tue")
		{
			$tue ++;
		}
		
		if(date('D', $d->sale_datetime) == "Wed")
		{
			$wed ++;
		}
		
		if(date('D', $d->sale_datetime) == "Thu")
		{
			$thu ++;
		}
		
		if(date('D', $d->sale_datetime) == "Fri")
		{
			$fri ++;
		}
		
		if(date('D', $d->sale_datetime) == "Sat")
		{
			$sat ++;
		}
		
		if(date('D', $d->sale_datetime) == "Sun")
		{
			$sun ++;
		}
				
	}


?>

<?php 
	if($mon !=""){
		$mday = $mon;
	}	
	else{
		$mday = 0;
	}
	
	if($tue !=""){
		$tuday = $tue;
	}	
	else{
		$tuday = 0;
	}
	
	if($wed !=""){
		$wedday = $wed;
	}	
	else{
		$wedday = 0;
	}
	
	if($thu !=""){
		$thuday = $thu;
	}	
	else{
		$thuday = 0;
	}
	
	if($fri !=""){
		$friday = $fri;
	}	
	else{
		$friday = 0;
	}
	
	if($sat !=""){
		$saterday = $sat;
	}	
	else{
		$saterday = 0;
	}
	
	if($sun !=""){
		$sunday = $sun;
	}	
	else{
		$sunday = 0;
	}
?>

<input type="hidden" id="mon" value="<?php echo $mday;?>" /> 	  
<input type="hidden" id="tue" value="<?php echo $tuday;?>" /> 	  
<input type="hidden" id="wed" value="<?php echo $wedday;?>" /> 	  
<input type="hidden" id="thu" value="<?php echo $thuday;?>" /> 	  
<input type="hidden" id="fri" value="<?php echo $friday;?>" /> 	  
<input type="hidden" id="sat" value="<?php echo $saterday;?>" /> 	  
<input type="hidden" id="sun" value="<?php echo $sunday;?>" /> 	  
	  
</div>


<?php } ?>

<?php function page_js(){ ?>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/chartjs/Chart.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/morris/morris.min.js"></script>
<script>
  $(function () {
		 // Get context with jQuery - using jQuery's .get() method.
			var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
			// This will get the first returned node in the jQuery collection.
			var areaChart = new Chart(areaChartCanvas);
			
			
			var jan = $("#jan").val();
			var feb = $("#feb").val();
			var march = $("#march").val();
			var apirl = $("#apirl").val();
			var may = $("#may").val();
			var may = $("#may").val();
			var jun = $("#jun").val();
			var julay = $("#julay").val();
			var aug = $("#aug").val();
			var sep = $("#sep").val();
			var oct = $("#oct").val();
			var nov = $("#nov").val();
			var dec = $("#dec").val();
			
			
			
			var jan_sale 	= $("#jan_sale").val();
			var feb_sale 	= $("#feb_sale").val();
			var march_sale 	= $("#march_sale").val();
			var apir_sale 	= $("#apir_sale").val();
			var may_sale 	= $("#may_sale").val();
			var jun_sale 	= $("#jun_sale").val();
			var juli_sale 	= $("#juli_sale").val();
			var aug_sale 	= $("#aug_sale").val();
			var sep_sale 	= $("#sep_sale").val();
			var oct_sale 	= $("#oct_sale").val();
			var nov_sale 	= $("#nov_sale").val();
			var dec_sale 	= $("#dec_sale").val();
			
			var areaChartData = {
			  labels: ["Jan", "Feb", "March", "Apr", "May", "June", "July" , "Aug" , "Sep" , "Oct" , "Nov" , "Dec	"],
			  datasets: [
				{
				  label: "Sale Amount",
				  fillColor: "rgba(210, 214, 222, 1)",
				  strokeColor: "rgba(210, 214, 222, 1)",
				  pointColor: "rgba(210, 214, 222, 1)",
				  pointStrokeColor: "#c1c7d1",
				  pointHighlightFill: "#fff",
				  pointHighlightStroke: "rgba(220,220,220,1)",
				  data: [jan_sale, feb_sale, march_sale, apir_sale, may_sale, jun_sale, juli_sale, aug_sale, sep_sale, oct_sale, nov_sale, dec_sale]
				},
				{
				  label: "Invoices",
				  fillColor: "rgba(60,141,188,0.9)",
				  strokeColor: "rgba(60,141,188,0.8)",
				  pointColor: "#3b8bba",
				  pointStrokeColor: "rgba(60,141,188,1)",
				  pointHighlightFill: "#fff",
				  pointHighlightStroke: "rgba(60,141,188,1)",
				  data: [jan, feb, march, apirl, may, jun, julay, aug, sep, oct, nov, dec]
				}
			  ]
			};

			var areaChartOptions = {
			  //Boolean - If we should show the scale at all
			  showScale: true,
			  //Boolean - Whether grid lines are shown across the chart
			  scaleShowGridLines: false,
			  //String - Colour of the grid lines
			  scaleGridLineColor: "rgba(0,0,0,.05)",
			  //Number - Width of the grid lines
			  scaleGridLineWidth: 1,
			  //Boolean - Whether to show horizontal lines (except X axis)
			  scaleShowHorizontalLines: true,
			  //Boolean - Whether to show vertical lines (except Y axis)
			  scaleShowVerticalLines: true,
			  //Boolean - Whether the line is curved between points
			  bezierCurve: true,
			  //Number - Tension of the bezier curve between points
			  bezierCurveTension: 0.3,
			  //Boolean - Whether to show a dot for each point
			  pointDot: false,
			  //Number - Radius of each point dot in pixels
			  pointDotRadius: 4,
			  //Number - Pixel width of point dot stroke
			  pointDotStrokeWidth: 1,
			  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			  pointHitDetectionRadius: 20,
			  //Boolean - Whether to show a stroke for datasets
			  datasetStroke: true,
			  //Number - Pixel width of dataset stroke
			  datasetStrokeWidth: 2,
			  //Boolean - Whether to fill the dataset with a color
			  datasetFill: true,
			  //String - A legend template
			  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			  maintainAspectRatio: true,
			  //Boolean - whether to make the chart responsive to window resizing
			  responsive: true
			};

			//Create the line chart
			areaChart.Line(areaChartData, areaChartOptions);
		
		
		//-------------
		//- BAR CHART -
		//-------------
		
			
			//weekly and daily sales total
			
			var mon = $("#mon").val();
			var tue = $("#tue").val();
			var wed = $("#wed").val();
			var thu = $("#thu").val();
			var fri = $("#fri").val();
			var sat = $("#sat").val();
			var sun = $("#sun").val();
			
		
		
		var barchat = {
			  labels: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
			  datasets: [
				{
				  label: "Sale Amount",
				  fillColor: "rgba(210, 214, 222, 1)",
				  strokeColor: "rgba(210, 214, 222, 1)",
				  pointColor: "rgba(210, 214, 222, 1)",
				  pointStrokeColor: "#c1c7d1",
				  pointHighlightFill: "#fff",
				  pointHighlightStroke: "rgba(220,220,220,1)",
				  data: [0, 0, 0, 0, 0, 0, 0]
				},
				{
				  label: "Invoices",
				  fillColor: "rgba(60,141,188,0.9)",
				  strokeColor: "rgba(60,141,188,0.8)",
				  pointColor: "#3b8bba",
				  pointStrokeColor: "rgba(60,141,188,1)",
				  pointHighlightFill: "#fff",
				  pointHighlightStroke: "rgba(60,141,188,1)",
				  data: [mon, tue, wed, thu, fri, sat, sun]
				}
			  ]
			};
			
		var barChartCanvas = $("#barChart").get(0).getContext("2d");
		var barChart = new Chart(barChartCanvas);
		var barChartData = barchat;
		barChartData.datasets[1].fillColor = "#00a65a";
		barChartData.datasets[1].strokeColor = "#00a65a";
		barChartData.datasets[1].pointColor = "#00a65a";
		var barChartOptions = {
		  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		  scaleBeginAtZero: true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines: true,
		  //String - Colour of the grid lines
		  scaleGridLineColor: "rgba(0,0,0,.05)",
		  //Number - Width of the grid lines
		  scaleGridLineWidth: 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines: true,
		  //Boolean - If there is a stroke on each bar
		  barShowStroke: true,
		  //Number - Pixel width of the bar stroke
		  barStrokeWidth: 2,
		  //Number - Spacing between each of the X value sets
		  barValueSpacing: 5,
		  //Number - Spacing between data sets within X values
		  barDatasetSpacing: 1,
		  //String - A legend template
		  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
		  //Boolean - whether to make the chart responsive
		  responsive: true,
		  maintainAspectRatio: true
		};

		barChartOptions.datasetFill = false;
		barChart.Bar(barChartData, barChartOptions);	
			

		 //DONUT CHART
		
		var donut = new Morris.Donut({
		  element: 'sales-chart',
		  resize: true,
		  colors: ["#3c8dbc", "#f56954", "#00a65a" ,"#66A5AD" ,"#E6D72A" , "#DE7A22" ,"#2D4262"],
		  data: [
			{label: "Monday Sales", value: mon},
			{label: "Tuesday Sales", value: tue},
			{label: "Wednesday Sales", value: wed},
			{label: "Thrusday Sales", value: thu},
			{label: "Friday Sales", value: fri},
			{label: "Saterday Sales", value: sat},
			{label: "Sunday Sales", value: sun}
		  ],
		  hideHover: 'auto'
		});
		
	
	});
</script>

<script type="text/javascript">
	function search_biz()
	{
		var biz_id		 = $("#biz_id").val();
				
	}
</script>




<?php } ?>

