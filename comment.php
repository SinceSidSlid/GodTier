<?php
	
	session_start();

	include 'dbconnect.php';
	include 'queryhelp.php';
	include 'link.php';
	//Connect to Database

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Post</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>

<?php

$UName = $_SESSION['UName'];

$U_ID = intval(nametoNumber());
$Text = $_POST['text'];
$TL_ID = $_POST['tierlist'];

//TEST THE USER DATA FOR ELSE
$Text = filter_var($Text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$Text = mysql_real_escape_string($Text);


//THEN INSERT THE COMMENT
$query = "insert into comment (U_ID, TL_ID, Text) values ($U_ID, $TL_ID, '$Text');";

		$result = mysql_query($query);

		if(!$result)
		{
			$message='Invalid Query' .mysql_errno()."\n";
			$message .= 'Whole Query' . $query;
			die($message);
		}
		else
		{
			print"<p>Reply Post Complete</p>";
			print"<p><a href='rank.php?TL_ID=$TL_ID'>Go Back?</a></p>";
		}
	

//I RAN OUT OF TIME TO JQUERY THIS PART, SO IT FEELS ROUGH

?>


</body>

</html>