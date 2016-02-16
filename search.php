<?php
	include('config.php');

	function search_here()
	{
		$alert = "";
		if(isset($_POST['parent_ministry']) && isset($_POST['ministry_agency']))
		{
			$parent_ministry = $_POST['parent_ministry'];
			$ministry_agency = $_POST['ministry_agency'];
			
			if(empty($parent_ministry))
			{
					$alert .= "Enter Ministry</br>";
			}
			if(empty($ministry_agency))
			{
					$alert .= "Enter Agency";
			}
			if(empty($alert))
			{
				mysql_query("SELECT code,line_item,amount FROM projects WHERE ministry='$parent_ministry' GROUP BY code");
			}
			else
			{
				return ("<label class=txtred>$alert</label>");
			}
		}
		
	}

	function listhere($parent_ministry,$ministry_agency)
	{
		$alert = "";

		$select_agency = mysql_query("SELECT code, line_item, amount FROM projects WHERE ministry = '$parent_ministry' GROUP BY code");
		
		if(mysql_num_rows($select_agency)!=0)
		{
			$alert .="<form method=post action=>
			<thead>
					<tr class=active>
					<td>Code</td>
					<td>Item</td>
					<td>Amount</td></tr></thead>";
					
					while($rows = mysql_fetch_array($select_agency))
					{
						$alert .="<tbody><tr><td>".$rows['code']."</td><td>".$rows['line_item']."</td><td>".$rows['amount']."</td></tr></tbody>";
					}
					$alert .="</form>";
		}
		return $alert;
	}
	
	function getTotal($parent_ministry, $ministry_agency){
		if(isset($_POST['parent_ministry']) && ($_POST['ministry_agency'])){

			$parent_ministry = $_POST['parent_ministry'];
	        $ministry_agency = $_POST['ministry_agency'];
	    }
			$total = "";
			$gamount = "";

			$rdb = mysql_query("select replace(amount,',','') as amount,line_item,code from projects WHERE ministry = '$parent_ministry' GROUP BY code");

			while ($rows=mysql_fetch_array($rdb)) {
				$total += $rows['amount'];
				//$gamount .= $rows['amount'];
			}
			return $total;
	}
	
?>