<?php

	session_start();

	//Input Nothing
	//Using the UName query the database and get the U_ID
	//Return the User ID
	function nametoNumber()
	{
		$varUname=$_SESSION['UName'];
		$test = "select U_ID from user where UName = '$varUname';";
		$back = mysql_query($test);

		if(!$back)
		{
			$message='Invalid Query ' .mysql_errno()."\n";
			$message .= 'Whole Query ' . $back;
			die($message);
		}

		$return = mysql_fetch_array($back);
		return $return['U_ID'];
	}

	//Input the current tierlist
	//Using UName and TL_ID query for the UL_ID
	//Two Step Querying!
	//Return the UL_ID given the U_ID and TL_ID
	function listtoNumber($TL_ID)
	{
		$varUname=$_SESSION['UName'];
		$test = "select U_ID from user where UName = '$varUname';";
		$back = mysql_query($test);

		if(!$back)
		{
			$message='Invalid Query ' .mysql_errno()."\n";
			$message .= 'Whole Query ' . $back;
			die($message);
		}

		$return = mysql_fetch_array($back);
		$varUID = $return['U_ID'];
		$test2 = "select UL_ID from userlist where U_ID = '$varUID' and TL_ID = $TL_ID;";
		$back2 = mysql_query($test2);

		if(!$back2)
		{
			$message2 ='Invalid Query ' .mysql_errno()."\n";
			$message2 .= 'Whole Query ' . $back2;
			die($message2);
		}

		$return2 = mysql_fetch_array($back2);
		return $return2['UL_ID'];
	}

?>

