<?php

  session_start();

  include 'dbconnect.php';
  include 'link.php';
  include 'info.php';

  $UName = $_SESSION['UName'];
  $LName = $_SESSION['LName'];
  $FName = $_SESSION['FName'];
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
 
    <script src="javascript\jquery.js" type="text/javascript"></script>

    <script src="javascript\jquery-ui.js" type="text/javascript"></script>

    <script src="javascript\tierjunk.js" type="text/javascript"></script>



    <!-- googles hosted jquery library -->
      
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>




    <!-- tipue search guts -->
    <script type="text/javascript" src="javascript/tipuesearch.js"></script>


    <!-- tipuesearch settings file -->
     
    <script type="text/javascript" src="javascript/tipuesearch_set.js"></script>

</head>
<body>
<div id="header">
            <h1><?=$FName?></h1>

            <div id="nav">

            	<img src="images/signpost.png" alt="woops" >

        	</div>
</div>
<div id="subheader">

        <h3><a href="main.php">Main</a></h3>


</div>

<div id="outerwrapper">

		<div id="profile">
             <div class="inside">


             	<table>
           			
           			<tr colspan="2">
                    <td><h2><?=$UName?></h2></td>
                </tr>

               	<tr>
                    <td><h4><?=$FName?></h4></td>
                    <td><h4><?=$LName?></h4></td>
                </tr>

                <tr>
                    <td><h4>Number of Lists</h4></td>
                    <td><h4><?=$varList?></h4></td>
                </tr>  
               	
                <tr>
                    <td><h4>Number of Comments</h4></td>
                    <td><h4><?=$varComm?></h4></td>
                </tr>
               	
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

