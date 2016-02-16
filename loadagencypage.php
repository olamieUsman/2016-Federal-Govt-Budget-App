<?php 
	include('config.php');

	$parent_ministry = $_GET['parent_ministry'];
	 //echo $pministry;
	$query = mysql_query("SELECT agency_name FROM projects WHERE ministry='$parent_ministry' GROUP BY agency_name") or die(mysql_error());
	while($rows = mysql_fetch_array($query)) {
		echo "<option value=".$rows['agency_name'].">".$rows['agency_name']."</option>";
}
?>