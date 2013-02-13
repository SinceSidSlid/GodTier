<?php
	
	session_start();

	include 'queryhelp.php';

	//Input User Name
	//Queries the database for number of lists by a user
	//Returns the number of lists
	function numLists($UName)
	{
		$U_ID = nametoNumber();

		$query = "select U_ID, TL_ID from userlist where U_ID = '$U_ID';";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);


		if(!$result)
		{
			$message='Invalid Query' .mysql_errno()."\n";
			$message .= 'Whole Query' . $query;
			die($message);
		}

		return $count;
		

	}

	//Input User Name
	//Queries the database for the number of comments by a user
	//Returns the Number of Comments
	function numComments($UName)
	{
		$U_ID = nametoNumber();

		$query = "select U_ID, C_ID from comment where U_ID = '$U_ID';";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);


		if(!$result)
		{
			$message='Invalid Query' .mysql_errno()."\n";
			$message .= 'Whole Query' . $query;
			die($message);
		}

		return $count;
	}



?>