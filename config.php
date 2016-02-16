<?php
		$hostname="localhost";
		$database_name="budgitsearch";
		$username="root";
		$password="";

		$dbconnection = mysql_connect($hostname,$username,$password);
		$dbconns = mysql_select_db($database_name);

		if(!$dbconnection){
			echo ('Sorry, Cannot Connect to Server!');
		}
		if(!$dbconns){
			echo('Sorry, Cannot Connect to Database');
			die();
		}
?>