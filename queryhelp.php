<?php

	

	function nametoNumber()
	{
		$varUname=$_SESSION['UName'];
		$test = "select U_ID from user where UName = '$varUname';";
		$back = mysql_query($test);

		if(!$back)
		{
			$message='Invalid Query ' .mysql_error()."\n";
			$message .= 'Whole Query ' . $back;
			die($message);
		}

		$return = mysql_fetch_array($back);
		return $return['U_ID'];
	}

	function listtoNumber()
	{
		$varUname=$_SESSION['UName'];
		$test = "select U_ID from user where UName = '$varUname';";
		$back = mysql_query($test);

		if(!$back)
		{
			$message='Invalid Query ' .mysql_error()."\n";
			$message .= 'Whole Query ' . $back;
			die($message);
		}

		$return = mysql_fetch_array($back);
		$varUID = $return['U_ID'];
		$test2 = "select UL_ID from userlist where U_ID = '$varUID' and TL_ID = $TL_ID;";
		$back2 = mysql_query($test2);

		if(!$back2)
		{
			$message2 ='Invalid Query ' .mysql_error()."\n";
			$message2 .= 'Whole Query ' . $back2;
			die($message2);
		}

		$return2 = mysql_fetch_array($back2);
		return $return2['UL_ID'];
	}

?>

