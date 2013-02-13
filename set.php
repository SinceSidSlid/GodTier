<?php

	include 'dbconnect.php';
	include 'queryhelp.php';
	include 'link.php';

	$UName = $_SESSION['UName'];

	$Top = $_POST['Top'];
	$High = $_POST['High'];
	$Low = $_POST['Low'];
	$Shit = $_POST['Shit'];
	$TL_ID = $_POST['TL_ID'];

	$check = 0;

	function arrayTime($str)
	{
		$array = array();
		$tok = strtok($str, ",");

		while ($tok !== false) 
		{
			$array[] = $tok;

			$tok = strtok(",");
		}
		return $array;
	}

	$ArrTop = arrayTime($Top);
	$ArrHigh = arrayTime($High);
	$ArrLow = arrayTime($Low);
	$ArrShit = arrayTime($Shit);

	//echo "<p>$TL_ID</p>";

	$U_ID = nametoNumber();

	$query2 = "select U_ID, TL_ID from userlist where U_ID = '$U_ID' and TL_ID = '$TL_ID';";
	$result2 = mysql_query($query2);
	$c = mysql_num_rows($result2);

	if(!$result2)
	{
		$message='Invalid Query' .mysql_errno()."\n";
		$message .= 'Whole Query' . $query2;
		die($message);
	}

	if($c >= 1)
	{
		//echo "<p>User List Found</p>";
		$check = 1;
	}
	else
	{
		$query = "insert into userlist (U_ID, TL_ID) values ($U_ID, $TL_ID);";

		$result = mysql_query($query);

		if(!$result)
		{
			$message='Invalid Query' .mysql_errno()."\n";
			$message .= 'Whole Query' . $query;
			die($message);
		}

		//echo "<p>Added User List</p>";

	}

	$UL_ID = listtoNumber();

	if ($check==1) 
	{
		foreach ($ArrTop as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$update = "update userrankings set UScore = 5 where I_ID = $I_ID and UL_ID = $UL_ID;";
			$final = mysql_query($update);

			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<script type='text/javascript'>console.log('Insert for ".$I_ID." complete');</script>";
				}
		}

		foreach ($ArrHigh as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$update = "update userrankings set UScore = 3 where I_ID = $I_ID and UL_ID = $UL_ID;";
			$final = mysql_query($update);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<script type='text/javascript'>console.log('Insert for ".$I_ID." complete');</script>";
				}
		}

		foreach ($ArrLow as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$update = "update userrankings set UScore = 1 where I_ID = $I_ID and UL_ID = $UL_ID;";
			$final = mysql_query($update);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<script type='text/javascript'>console.log('Insert for ".$I_ID." complete');</script>";
				}
		}

		foreach ($ArrShit as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$update = "update userrankings set UScore = 0 where I_ID = $I_ID and UL_ID = $UL_ID;";
			$final = mysql_query($update);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<script type='text/javascript'>console.log('Insert for ".$I_ID." complete');</script>";
				}
		}
	}


	else
	{
		foreach ($ArrTop as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$insert = "insert into userrankings (UL_ID, I_ID, UScore) values ('$UL_ID', '$I_ID', 5);";
			$final = mysql_query($insert);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<p>Insert for ".$I_ID." complete</p>";
				}
		}
		

		foreach ($ArrHigh as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$insert = "insert into userrankings (UL_ID, I_ID, UScore) values ('$UL_ID', '$I_ID', 3);";
			$final = mysql_query($insert);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<p>Insert for ".$I_ID." complete</p>";
				}
		}

		foreach ($ArrLow as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$insert = "insert into userrankings (UL_ID, I_ID, UScore) values ('$UL_ID', '$I_ID', 1);";
			$final = mysql_query($insert);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<p>Insert for ".$I_ID." complete</p>";
				}
		}

		foreach ($ArrShit as $key => $value) {
			//echo "$value";

			$I_ID = $value;
			$insert = "insert into userrankings (UL_ID, I_ID, UScore) values ('$UL_ID', '$I_ID', 0);";
			$final = mysql_query($insert);
			
			if(!$final)
				{
					$message='Invalid Query ' .mysql_errno()."\n";
					$message .= 'Whole Query ' . $update;
					die($message);
				}
				else
				{
					//echo "<p>Insert for ".$I_ID." complete</p>";
				}
		}	
	}


	$totalorder = "select userlist.TL_ID, userrankings.I_ID, userrankings.UScore from userrankings, userlist where userlist.UL_ID = userrankings.UL_ID";
	$totalquery = mysql_query($totalorder);
	$totalarray = array();
	$count = 0;

	if(!$totalquery)
	{
	    $message='Invalid Query ' .mysql_errno()."\n";
	    $message .= 'Whole Query ' . $display;
	    die($message);
	}


	while($row = mysql_fetch_array($totalquery))
	{
		$score = $row['UScore'];
		$item = $row['I_ID'];
		$aid = $item - 1;
		$totalarray[$aid] += $score;
		//echo "<p>".$item." ".$score." ".$totalarray[$aid]."</p>";
		$count++;   
	}

	/*foreach ($totalarray as $key => $value)
	{
		echo "<p>".$key." ".$value."</p>";
	}*/

	
	foreach ($totalarray as $key => $value) 
	{
		$help = $key + 1;
		$rankings = "update rankings set TScore = $value where TL_ID = $TL_ID and I_ID = $help;";
		$rankquery = mysql_query($rankings);
		if(!$rankquery)
		{
			$message='Invalid Query ' .mysql_errno()."\n";
			$message .= 'Whole Query ' . $rankings;
			die($message);
		}
	}
	

echo "<p>Success!</p>";
echo "<p><a href='tierlist.php?TL_ID=1S';

?>