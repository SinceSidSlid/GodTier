<?php
	session_start();

	include 'dbconnect.php';
	include 'link.php';
  include 'info.php';

  $TL_ID = $_GET['TL_ID'];
  $OU_ID = $_GET['U_ID'];
  $UName = $_SESSION['UName'];

  $U_ID = nametoNumber();

//Query the database and get all of the relevent information for displaying the tierlists

  $displayTotal = "select userrankings.I_ID, userrankings.UScore from userrankings, userlist where userrankings.UL_ID = userlist.UL_ID and userlist.U_ID = $OU_ID and userlist.TL_ID = $TL_ID order by UScore desc";
  $resultsTotal = mysql_query($displayTotal);

  if(!$resultsTotal)
  {
    $message='Invalid Query ' .mysql_errno()."\n";
    $message .= 'Whole Query ' . $displayTotal;
    die($message);
  }


  $displayUser = "select userrankings.I_ID, userrankings.UScore from userrankings, userlist where userrankings.UL_ID = userlist.UL_ID and userlist.U_ID = $U_ID and userlist.TL_ID = $TL_ID order by UScore desc";
  $resultsUser = mysql_query($displayUser);

  if(!$resultsUser)
  {
    $message='Invalid Query ' .mysql_errno()."\n";
    $message .= 'Whole Query ' . $displayUser;
    die($message);
  }

  $arrTotal = array();
  $arrUser = array();

  //Run through the database and then put the I_ID in an array
  //The query puts them in the right order for display
  //Then below I just call the image number the corresponds to the array

  $countUser = 0;

  while($row = mysql_fetch_array($resultsUser))
  {
    $item = $row['I_ID'];
    $arrUser[$countUser] = $item;
    $countUser++;   
  }

  $countTotal = 0;

  while($row = mysql_fetch_array($resultsTotal))
  {
    $item = $row['I_ID'];
    $arrTotal[$countTotal] = $item;
    $countTotal++;   
  }

  //Let's check to see if you made a list?
  $Test = count($arrUser);
?>

<!DOCTYPE html>
<html>




<head>
	<title>GodTier</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />

	<link rel="icon" type="image/vnd.microsoft.icon" media= "screen" href="favicon.ico" />
 	  
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="javascript/jquery.js" type="text/javascript"></script>

    <script src="javascript/jquery-ui.js" type="text/javascript"></script>

    <script src="javascript/tierjunk.js" type="text/javascript"></script>

    <script src="javascript/jquery.overscroll.js" type="text/javascript"></script>

    <script type="text/javascript">
    //Extra Code from rank.php
         $(document).ready(function() {

                $("#fun").hide();

                $(".item").mouseover(function(){
                        $(this).css('cursor', 'pointer');

                });

                //Draggable code and settings
                 $(".item").draggable( {
                            containment: 'window',
                            cursor: 'move',
                            snapMode: "inner",
                            snapTolerance: "30",
                            //revert: "invalid",
                            snap: '.slot, .socket'
                    });    

                
                 //Droppable code and settings
                $(".slot").droppable({
                        accept:".item",
                        tolerance:"touch",
                        //When this thing gets a draggable grab the data attribute and insert it into the div
                        drop: function(event, ui) {
                            console.log('dropped');
                            $(this).html(function()
                              {
                                var draggable=ui.draggable;
                                return draggable.attr('data') + ",";
                              }
                            );
                          }

                });

    </script>

</head>

<body>


	<div id="header">

            <?php
              //Display the tierlist name for the header
              $query = "select TLName from tierlist where TL_ID = $TL_ID;";
              $result = mysql_query($query);
              
              if(!$result)
              {
                $message='Invalid Query ' .mysql_errno()."\n";
                $message .= 'Whole Query ' . $query;
                die($message);
              }
              
              while($row = mysql_fetch_array($result))
              {
                print "<h1>".$row['TLName']."</h1>";
              }
              
            ?>

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

    

    <div id="overrank">
    <h2>Their List
    <hr />
    </h2>
    

    <div>

       <h3>Top
       <hr />
        </h3>

      <table id="top">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[0]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[1]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[2]?>.png' alt='teamname'></div></td>
        </tr>
      </table>
    </div>


    <div>
      <h3>High
        <hr />
      </h3>
      <table id="high">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[3]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[4]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[5]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[6]?>.png' alt='teamname'></div></td>
       </tr>
       <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[7]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[8]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[9]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[10]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[11]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[12]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[13]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[14]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[15]?>.png' alt='teamname'></div></td>
      </tr>
      </table>
    </div>

    <div>
      <h3>Low
      <hr /></h3>
        <table id="low">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[16]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[17]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[18]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[19]?>.png' alt='teamname'></div></td>
       </tr>
       <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[20]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[21]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[22]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[23]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[24]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[25]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[26]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[27]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[28]?>.png' alt='teamname'></div></td>
      </tr>
      </table>
      </div>
      <div>
        <h3>Shit
        <hr /></h3>
        <table id="shit">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[29]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[30]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrTotal[31]?>.png' alt='teamname'></div></td>
        </tr>

      </table>


      </div><!-- end shit -->


  </div> <!-- end overrank" -->


  <div id="rank">
    <h2>Your List
    <hr />
    </h2>
    
    <div>
      <?php
        if ($Test == 0) {
          //If the count of items in the array above was zero then you didn't have a list, so make them fill one out!
          print"<p>You haven't submitted a list!</p>";
          print"<p><a href='rank.php?TL_ID=$TL_ID'>Go here and submit one!</a></p>";
          die();
        }
      ?>
       <h3>Top
       <hr />
        </h3>

      <table id="top">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[0]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[1]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[2]?>.png' alt='teamname'></div></td>
        </tr>
      </table>
    </div>


    <div>
      <h3>High
        <hr />
      </h3>
      <table id="high">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[3]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[4]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[5]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[6]?>.png' alt='teamname'></div></td>
       </tr>
       <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[7]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[8]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[9]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[10]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[11]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[12]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[13]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[14]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[15]?>.png' alt='teamname'></div></td>
      </tr>
      </table>
    </div>

    <div>
      <h3>Low
      <hr /></h3>
        <table id="low">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[16]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[17]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[18]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[19]?>.png' alt='teamname'></div></td>
       </tr>
       <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[20]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[21]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[22]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[23]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[24]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[25]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[26]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[27]?>.png' alt='teamname'></div></td>
      </tr>
      <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[28]?>.png' alt='teamname'></div></td>
      </tr>
      </table>
      </div>
      <div>
        <h3>Shit
        <hr /></h3>
        <table id="shit">
        <tr>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[29]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[30]?>.png' alt='teamname'></div></td>
        <td><div class='slot'><img class='item' src='images/<?=$arrUser[31]?>.png' alt='teamname'></div></td>
        </tr>

      </table>


      </div><!-- end shit -->
 
       


  </div><!-- end rank -->





<!--COMMENTS!! -->

      <div id="comment">
          <h3>Comment
          <hr />
          </h3>
          <form name="comment" action="comment.php" method="post" enctype="multipart/form-data">
            <table>
              <tr>
                <td><textarea name="text" rows="4" cols="43"></textarea></td>
              </tr>
              <tr>
                <td colspan='2'><p><input type="submit" name="Submite" value="Submit" /></p></td>
              </tr>
            </table>
            <input type='hidden' name='tierlist' value='<?=$TL_ID?>' />
          </form>

                  <?php
                  //Query and print the comments
              $display = "select C_ID, Text from comment where TL_ID = $TL_ID;";
              $results = mysql_query($display);

              if(!$results){
                  $message='Invalid Query ' .mysql_errno()."\n";
                  $message .= 'Whole Query ' . $display;
                  die($message);
              }

              print'<table border="1">';
              print'<tr><td width="50px">Post#</td><td width="400px">Comment</td></tr>';

              $count = 1;

                while($row = mysql_fetch_array($results))
                  {
                    print'<tr>';
                    print'<td>'.$count.'</td>';
                    print'<td>'.$row['Text'].'</td>';
                    print "</tr>";
                    $count++;
                  }

              print'</table>';

?>
      </div><!-- end comment-->




</div> <!-- end outterwrapper -->


<div id="fun">

<?php
  /*foreach ($arrTotal as $key => $value) {
    print "<p>".$value."</p>";
  }
  print"<br />";
  foreach ($arrUser as $key => $value) {
    print "<p>".$value."</p>";
  }*/
?>

</div>
  
 </div>


</body>
</html>