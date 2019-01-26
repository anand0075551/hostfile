<?php 
// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "users";
// Database connecten voor alle services
mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());
					
mysql_select_db($database)
or die ('Could not select database ' . mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$qry = mysql_query("SELECT DISTINCT business_name FROM bg_forms ");
while( $row = mysql_fetch_row( $qry ) )
{
   //loo1
    foreach( $row as $value )
    {
		echo '<font color="#FF0000"><b>'.$value.'</b></font><br>';
			//loo2
			$qry2=mysql_query("SELECT DISTINCT category_name FROM bg_forms WHERE business_name='".$value."'");
			while( $row1 = mysql_fetch_row( $qry2 ) )
			{
				foreach( $row1 as $value2 )
    			{
					echo '<font color="#00CC00"><b>&nbsp;&nbsp;'. $value2.'</b></font><br>';
						//loo3
						$qry3=mysql_query("SELECT form_name,controller,php_file_name FROM bg_forms WHERE business_name='".$value."' AND category_name='".$value2."'");
						while( $row2 = mysql_fetch_row( $qry3 ) )
						{ 
							
							echo '<font color="#009900">&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$row2['1'].'/'.$row2['2'].'.php">'.$row2['0'].'</a></font><br>';
						}
				}
			}
	}
}
?>
</body>
</html>