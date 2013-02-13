<?php

  session_start();

  include 'dbconnect.php';
  include 'link.php';
  include 'info.php';

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
            <h1>TierList Page</h1>

    
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
              <?php

                //Query the database and print out the tierlists along with links to some other pages
                $display = "select TLName, TL_ID from tierlist;";
                $results = mysql_query($display);

                if(!$results)
                {
                    $message='Invalid Query ' .mysql_errno()."\n";
                    $message .= 'Whole Query ' . $display;
                    die($message);
                }

                $count = 1;

                while($row = mysql_fetch_array($results))
                {
                  print"<tr><td width='370px'><p>".$row['TLName']."</p></td><td width='180px'><p><a href='rank.php?TL_ID=$row[TL_ID]'>Rank Em&#039;</a></p></td><td width='180px'><p><a href='show.php?TL_ID=$row[TL_ID]'>View</a></p></td><td width='180px'><p><a href='others.php?TL_ID=$row[TL_ID]'>Others</a></p></td>";
                  $count++;
                }


              ?>
             </table>
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