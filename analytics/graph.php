<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="js/loader.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(pie_chart);
    google.charts.setOnLoadCallback(column_chart);
    google.charts.setOnLoadCallback(bar_chart);
    google.charts.setOnLoadCallback(line_chart);
	//CALLED FUNCTION FROM index.php TO CHANGE GRAPH VALUE UPON SEARCH
      function graph_refresh() 
	  {
		  pie_chart(1);
		  column_chart(1);
	  }
    function pie_chart(sch) {
		//WORKING ON SEARCH BUTTON
		if(sch === 1)
		{
			
			 var points_mode=document.getElementById("points_mode").value;
			 var role=document.getElementById("role").value;
			 var pay_type=document.getElementById("pay_type").value;
			 var created_at=document.getElementById("created_at").value;
			 var created_from=document.getElementById("from_date").value;
			 var created_to=document.getElementById("to_date").value;
			 var r_user=document.getElementById("r_user").value;
			 var f_user=document.getElementById("f_user").value;
			 var t_user=document.getElementById("t_user").value;
			 
			
			var jsonData = $.ajax({
            url: "pie_chart_search.php",
			type:'GET',
			data:{ pm: points_mode, r: role, pt: pay_type, cdt: created_at, cf: created_from, ct:created_to, r_user:r_user, f_user:f_user, t_user:t_user },
            dataType: "json",
            async: false
            }).responseText;
			
			
		}
		else
		{
			var jsonData = $.ajax({
            url: "pie_chart.php",
            dataType: "json",
            async: false
            }).responseText;
		}
      
          
      // Create our data table out of JSON data loaded from server.
	 // alert(jsonData);return false;
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
      chart.draw(data, {width: 400, height: 240});
    }

    function column_chart(sch) 
	{
		//WORKING ON SEARCH BUTTON
		if(sch === 1)
		{
			
			 var points_mode=document.getElementById("points_mode").value;
			 var role=document.getElementById("role").value;
			 var pay_type=document.getElementById("pay_type").value;
			 var created_at=document.getElementById("created_at").value;
			 var created_from=document.getElementById("from_date").value;
			 var created_to=document.getElementById("to_date").value;
			 var r_user=document.getElementById("r_user").value;
			 var f_user=document.getElementById("f_user").value;
			 var t_user=document.getElementById("t_user").value;
			 var jsonData = $.ajax({
			url: 'column_chart_search.php',
			type:'GET',
    		dataType:"json",
			data:{ pm: points_mode, r: role, pt: pay_type, cdt: created_at, cf: created_from, ct:created_to, r_user:r_user, f_user:f_user, t_user:t_user },
    		async: false,
			success: function(jsonData)
				{
					var data = new google.visualization.arrayToDataTable(jsonData);	
        			var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
					chart.draw(data);
					
				}	
			}).responseText;
		}
		else
		{
		var jsonData = $.ajax({
			url: 'column_chart.php',
    		dataType:"json",
    		async: false,
			success: function(jsonData)
				{
					var data = new google.visualization.arrayToDataTable(jsonData);	
        			var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
					chart.draw(data);
					
				}	
			}).responseText;
		}
  }
      
	
    </script>
    <script>
	$(document).ready(function() {
   $('input[type="checkbox"]').click(function() {
       if($(this).attr('id') == 'pie') {
            $('#pie_chart').toggle();
			          
       }

       if($(this).attr('id') == 'bar') {
             
			$('#bar_chart').toggle(); 
       }
   });
});
    </script>
    <style>
.example
{
    float:left;
    width: 33%;
    background: lightgrey;
    text-align: center;
}</style>
  </head>

  <body>
  <div style="width:100%;">
 	<input type="checkbox" name="sel_pie" value="pie" id="pie" value="pie">Pie Chart<br>
  	<input type="checkbox" name="sel_bar" value="bar" id="bar" value="bar">Bar Chart
  </div>
<div  style="margin-left:10%;">
   <!--Div that will hold the pie chart-->
   <div id="pie_chart" style="font: 21px arial; padding: 10px 0 0 100px;">
        <div class="example">
         	<div id="piechart_div" ></div>
        </div>
    </div>
    <!--Div that will hold the bar chart-->
    <div id="bar_chart" style="font: 21px arial; padding: 10px 0 0 100px;">
        <div class="example">
        	<div id="columnchart_values"></div>
        </div>
    </div>
</div>	
	
  </body>
</html>