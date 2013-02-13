<?php
	

	include 'dbconnect.php';
	include 'link.php';

	$FName = $_POST['FName'];
	$LName = $_POST['LName'];
	$UName = $_POST['UName'];

	//Checking to see if the facebook user is already in the database
	$query2 = "select FName, LName, UName from user where FName = '$FName' and LName = '$LName' and UName = '$UName';";
	$result2 = mysql_query($query2);
	$c = mysql_num_rows($result2);

	if(!$result2)
	{
		$message='Invalid Query' .mysql_errno()."\n";
		$message .= 'Whole Query' . $query;
		die($message);
	}
	//Here I'm checking to see if the name is already in the database.
	//If it is echo back the name
	if($c == 1)
	{
		echo "Thanks for coming back, $FName";

	}
	//If not enter the user into the database, then echo back a welcome statement
	else
	{
		$query = "insert into user (FName, LName, UName) values ('$FName', '$LName', '$UName');";

		$result = mysql_query($query);

		if(!$result)
		{
			$message='Invalid Query' .mysql_errno()."\n";
			$message .= 'Whole Query' . $query;
			die($message);
		}

		echo "Thanks for Joining Us $FName";

	}

	$_SESSION['UName'] = $_POST['UName'];
	$_SESSION['LName'] = $_POST['LName'];
	$_SESSION['FName'] = $_POST['FName'];

?>