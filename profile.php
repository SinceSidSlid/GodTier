<?php

  session_start();

  include 'dbconnect.php';
  include 'link.php';
  include 'info.php';

  //Variables
  $UName = $_SESSION['UName'];
  $LName = $_SESSION['LName'];
  $FName = $_SESSION['FName'];
  $U_ID = nametoNumber();
  $varComm = numComments($UName);
  $varList = numLists($UName);


?>

<!DOCTYPE html>
<html>
<head>
	<title>GodTier</title>
	<meta charset="UTF-8">

	  <!-- microsoft icon for facebook login page-->
    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />

    <!-- our stylesheet -->
 	  <link rel="stylesheet" type="text/css" href="css/style.css" />

 	  <!-- the google font that tipue sheet wants to use --> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">

    <!-- tipiques own stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/tipuesearch.css">

    <!--J query librarys -->
 
    <script src="javascript/jquery.js" type="text/javascript"></script>

    <script src="javascript/jquery-ui.js" type="text/javascript"></script>

    <script src="javascript/tierjunk.js" type="text/javascript"></script>

    <!-- googles hosted jquery library -->
      
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <!-- tipue search guts -->
    <script type="text/javascript" src="javascript/tipuesearch.js"></script>

    <!-- tipuesearch settings file -->
     
    <script type="text/javascript" src="javascript/tipuesearch_set.js"></script>

</head>
<body>
<div id="header">
            <h1>Profile Page</h1>

    
</div>
<div id="subheader">
<ul class="ulnav">
          <li class="linav">
            <h3><a href="main.php">Home</a></h3>
          </li>
          <li class="linav">
            <h3><a href="about.html">About</a></h3>
          </li>
          <li class="linav">
            <h3><a href="tierlist.php">Tierlist</a></h3>
          </li>
          <li class="linav">
            <h3><a href="profile.php">Profile</a></h3>
          </li>
      </ul>
</div>

<div id="outerwrapper">

		<div id="profile">
             <div class="inside">


             	<table>
           			
           			<tr>
                    <td><h2>Username</h2></td><td><h2 class='cent'><?=$UName?></h2></td>
                </tr>

               	<tr>
                    <td><h4>Full Name</h4></td><td><h4 class='cent'><?=$FName?> <?=$LName?></h4></td>
                </tr>

                <tr>
                    <td><h4>Number of Lists</h4></td>
                    <td><h4 class='cent'><?=$varList?></h4></td>
                </tr>  
               	
                <tr>
                    <td><h4>Number of Comments</h4></td>
                    <td><h4 class='cent'><?=$varComm?></h4></td>
                </tr>
               	
               	</table>

                <h2>Lists You've Completed</h2>

                <ul class="biggerer">


                <?php

                    //Query the database and print the lists that a user has completed
                    $display = "select userlist.TL_ID, tierlist.TLName from userlist, tierlist where userlist.TL_ID = tierlist.TL_ID and userlist.U_ID = '$U_ID';";
                    $results = mysql_query($display);

                    if(!$results){
                        $message='Invalid Query ' .mysql_errno()."\n";
                        $message .= 'Whole Query ' . $display;
                        die($message);
                    }

                    $count = 1;

                    while($row = mysql_fetch_array($results))
                    {
                      print"<li><a href='rank.php?TL_ID=$row[TL_ID]'>".$row['TLName']."</a></li>";
                      $count++;
                    }

                ?>
              </ul>
             </div>
        </div><!-- highlight -->





</div><!-- outerwrapper -->

<script type="text/javascript">
          $(document).ready(function() {
               $('#tipue_search_input').tipuesearch({
                    'mode': 'live'
               });
          });
      </script>
</body>
</html>

