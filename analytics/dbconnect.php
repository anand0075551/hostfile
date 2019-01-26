<?php
	define("DB_HOST", 'localhost');  
    define("DB_USER", 'consucgr_admin');  
    define("DB_PASSWORD", 'test1234');  
    define("DB_DATABSE", 'consucgr_ccb'); 
	
	class dbConnect 
	{  
        function __construct() 
		{  
         //   require_once('config.php');  
            $conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);  
            mysql_select_db(DB_DATABSE, $conn);  
            if(!$conn)// testing the connection  
            {  
                die ("Cannot connect to the database");  
            }   
            return $conn;  
        }  
        public function Close(){  
            mysql_close();  
        }  
    }  
?>