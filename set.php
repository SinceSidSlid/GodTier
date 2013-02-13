<?php

	session_start();

	include 'dbconnect.php';
	include 'queryhelp.php';
	include 'link.php';

	$UName = $_SESSION['UName'];

	//Takes Strings from rank and the TierList ID

	$Top = $_POST['Top'];
	$High = $_POST['High'];
	$Low = $_POST['Low'];
	$Shit = $_POST['Shit'];
	$TL_ID = $_POST['TL_ID'];

	$Verify = $Top.$High.$Low.$Shit;

	$check = 0;

	//Make some Arrays from the Strings above
	//Input a string
	//Look for token of , and parse it out
	//Insert each thing into an array
	//return the array
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

	//Call the Function
	$ArrTop = arrayTime($Top);
	$ArrHigh = arrayTime($High);
	$ArrLow = arrayTime($Low);
	$ArrShit = arrayTime($Shit);

	$ArrVerify = arrayTime($Verify);

	$Test1 = array();

	$Test2 = count($ArrVerify);

	foreach ($ArrVerify as $key => $value) {
		
		for ($i=0; $i < $key; $i++) { 

			if ($Test1[$i] == $value) {
				die("<p>You Placed The Same Item Twice!</p>");
			}

		}

		$Test1[$key] = $value;
		echo '<br />';
	}

	if ($Test2 < 32) {
		die("<p>Please place all the teams!</p>");
	}


	//Check and see if the user already submitted a list, if not add one

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

	$UL_ID = listtoNumber($TL_ID);


	//IF A USER LIST WAS FOUND!! UPDATING HERE KIDS!!!
	//RUN THROUGH EACH ARRAY AND ASSIGN THE RIGHT VALUE TO USCORE IN THE USERRANKING TABLE!!!
	if ($check==1) 
	{
		foreach ($ArrTop as $key => $value) {
			//echo "$value";

			//QUERY AND CHECK IF THE QUERY WORKED!

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
		//ONE FOR EACH OF THE FOUR TIERS!!!
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

	//IF YOU DIDN'T MAKE A LIST BEFORE!!!
	//SAME AS ABOVE!!!
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

	//Time to update the RANKING page!!
	$totalorder = "select userlist.TL_ID, userrankings.I_ID, userrankings.UScore from userrankings, userlist where userlist.UL_ID = userrankings.UL_ID and userlist.TL_ID =$TL_ID";
	$totalquery = mysql_query($totalorder);
	$totalarray = array();
	$count = 0;

	//Check if the query worked
	if(!$totalquery)
	{
	    $message='Invalid Query ' .mysql_errno()."\n";
	    $message .= 'Whole Query ' . $display;
	    die($message);
	}

	//While the query still has some rows, make an array with all of the scores from all lists and then add up for each item in the set 
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

	//For all items updat the TSCORE from the array created above
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
echo "<p><a href='show.php?TL_ID=$TL_ID'>Check the Master</a></p>";

?>