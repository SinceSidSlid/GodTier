<?php
  session_start();

  include 'dbconnect.php';
  include 'link.php';
  include 'info.php';

  $TL_ID = $_GET['TL_ID'];

?>

<!DOCTYPE html>
<html>
 <head>
    <title>GodTier</title>
 		<meta charset="UTF-8">
    <link rel="icon" type="image/vnd.microsoft.icon" media= "screen" href="favicon.ico" />
 	  
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="javascript/jquery.js" type="text/javascript"></script>

    <script src="javascript/jquery-ui.js" type="text/javascript"></script>

    <script src="javascript/tierjunk.js" type="text/javascript"></script>

    <script src="javascript/jquery.overscroll.js" type="text/javascript"></script>

      <script type="text/javascript">
        //When the page finishes loading
         $(document).ready(function() {

                $("#fun").hide();

                $(".item").mouseover(function(){
                        $(this).css('cursor', 'pointer');

                });

                  //Make elements of the class "item" draggable
                 $(".item").draggable( {
                            containment: 'window',
                            cursor: 'move',
                            snapMode: "inner",
                            snapTolerance: "30",
                            //revert: "invalid",
                            snap: '.slot, .socket'
                    });    

                
                 //Elements with the class "slot" can have draggables dropped in
                $(".slot").droppable({
                        accept:".item",
                        tolerance:"touch",
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

    

                             
               $(".button").click(function(){
                   var ajaxRequest;  // The variable that makes Ajax possible!
    
                    try{
                      // Opera 8.0+, Firefox, Safari
                      ajaxRequest = new XMLHttpRequest();
                    } catch (e){
                      // Internet Explorer Browsers
                      try{
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                      } catch (e) {
                        try{
                          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                          // Something went wrong
                          alert("Your browser broke!");
                          return false;
                        }
                      }
                    }
                    
                    console.log('clicked');
                    var top =[];
                    var high =[];
                    var low =[];
                    var shit =[];
                    var StrTop = "";
                    var StrHigh = "";
                    var StrLow = "";
                    var StrShit = "";
                    var TL_ID = "<?=$TL_ID?>";

                    //var top = $(".top").html();
                    //$("#testing").html(top);

                    //Run through the tables and add stuff to the arrays
                    $('#top>tbody>tr>td').each( function(){
                         //add item to array
                         top.push( $(this).text() );       
                      });

                    $('#high>tbody>tr>td').each( function(){
                         //add item to array
                         high.push( $(this).text() );       
                      });

                    $('#low>tbody>tr>td').each( function(){
                         //add item to array
                         low.push( $(this).text() );       
                      });

                    $('#shit>tbody>tr>td').each( function(){
                         //add item to array
                         shit.push( $(this).text() );       
                      });

                    //Run through arrays and make strings
                    $.each(top, function(index, val) {
                        console.log(val);
                        StrTop += val;
                        });

                    $.each(high, function(index, val) {
                        console.log(val);
                        StrHigh += val;
                        });

                    $.each(low, function(index, val) {
                        console.log(val);
                        StrLow += val;
                        });

                    $.each(shit, function(index, val) {
                        StrShit += val;
                        console.log(val);
                        });

                    //Send all that stuff to set.php
                    ajaxRequest.open('POST','set.php?', true);
                    ajaxRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    ajaxRequest.send('Top=' + StrTop + '&High=' + StrHigh + '&Low=' + StrLow + '&Shit=' + StrShit + '&TL_ID=' + TL_ID);

                    //When the ajax is ready, put the return into the div with the id of funny
                    ajaxRequest.onreadystatechange=function()
                    {
                        if (ajaxRequest.readyState==4 && ajaxRequest.status==200)
                        {
                          console.log('Back');
                          document.getElementById("funny").innerHTML=ajaxRequest.responseText;
                        }
                    }


                });
                


               });
 
      </script>

 </head>
 <body>
 <div id="header">

            <?php
            //Put the Tierlist Name as the Header
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
    	

     <div id="itemset">
        <h2>DRAG
        <hr />
        </h2>



        <table>
            <tr>
                <td><div class='socket'><img class='item' src='images/1.png' alt='teamname' data='1'></div></t>
                <td><div class='socket'><img class='item' src='images/2.png' alt='teamname' data='2'></div></div></td>
                <td><div class='socket'><img class='item'src='images/3.png' alt='teamname' data='3'></div></div></td>
                <td><div class='socket'><img class='item'src='images/4.png' alt='teamname' data='4'></div></td>
            </tr>

            <tr>
                <td><div class='socket'><img class='item'src='images/5.png' alt='teamname' data='5'></div></td>
                <td><div class='socket'><img class='item'src='images/6.png' alt='teamname' data='6'></div></td>
                <td><div class='socket'><img class="item" src='images/7.png' alt='teamname' data='7'></div></td>
                <td><div class='socket'><img class="item" src='images/8.png' alt='teamname' data='8'></div></td>
            </tr>
            <tr>
                <td><div class='socket'><img class="item" src='images/9.png' alt='teamname' data='9'></div></td>
                 <td><div class='socket'><img class="item" src='images/10.png' alt='teamname' data='10'></div></td>
                <td><div class='socket'><img class="item" src='images/11.png' alt='teamname' data='11'></div></td>
                <td><div class='socket'><img class="item" src='images/12.png' alt='teamname' data='12'></div></td>
            </tr>
            <tr>
                <td><div class='socket'><img class="item" src='images/13.png' alt='teamname' data='13'></div></td>
                <td><div class='socket'><img class="item" src='images/14.png' alt='teamname' data='14'></div></td>
                <td><div class='socket'><img class="item" src='images/15.png' alt='teamname' data='15'></div></td>
                <td><div class='socket'><img class="item" src='images/16.png' alt='teamname' data='16'></div></td>
            </tr>
            <tr>
                <td><div class='socket'><img class="item" src='images/17.png' alt='teamname' data='17'></div></td>
                <td><div class='socket'><img class="item" src='images/18.png' alt='teamname' data='18'></div></td>
                <td><div class='socket'><img class="item" src='images/19.png' alt='teamname' data='19'></div></td>
                <td><div class='socket'><img class="item" src='images/20.png' alt='teamname' data='20'></div></td>
            </tr>
            <tr>
                <td><div class='socket'><img class="item" src='images/21.png' alt='teamname' data='21'></div></td>
                <td><div class='socket'><img class="item" src='images/22.png' alt='teamname' data='22'></div></td>
                <td><div class='socket'><img class="item" src='images/23.png' alt='teamname' data='23'></div></td>
                <td><div class='socket'><img class="item" src='images/24.png' alt='teamname' data='24'></div></td>
            </tr>
            <tr>
                <td><div class='socket'><img class="item" src='images/25.png' alt='teamname' data='25'></div></td>
                <td><div class='socket'><img class="item" src='images/26.png' alt='teamname' data='26'></div></td>
                <td><div class='socket'><img class="item" src='images/27.png' alt='teamname' data='27'></div></td>
                <td><div class='socket'><img class="item" src='images/28.png' alt='teamname' data='28'></div></td>
            </tr>
             <tr>
                <td><div class='socket'><img class="item" src='images/29.png' alt='teamname' data='29'></div></td>
                <td><div class='socket'><img class="item" src='images/30.png' alt='teamname' data='30'></div></td>
                <td><div class='socket'><img class="item" src='images/31.png' alt='teamname' data='31'></div></td>
                <td><div class='socket'><img class="item" src='images/32.png' alt='teamname' data='32'></div></td>
            </tr>

        </table>
         <hr />
        <hr />
     </div>



	<div id="rank">
    <h2>DROP
    <hr />
    </h2>
    
    <div>

       <h3>Top
       <hr /></h3>
      <table id="top">
        <tr>
        <td><div class='slot' id="A1"></div></td>
        <td><div class='slot' id="A2"></div></td>
        <td><div class='slot' id="A3"></div></td>
        </tr>
      </table>
    </div>


    <div>
      <h3>High
        <hr />
      </h3>
      <table id="high">
        <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
       </tr>
       <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
      </tr>
      <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
      </tr>
      <tr>
        <td><div class='slot'></div></td>
      </tr>
      </table>
    </div>

    <div>
      <h3>Low
      <hr /></h3>
        <table id="low">
        <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
       </tr>
       <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
      </tr>
      <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
      </tr>
      <tr>
        <td><div class='slot'></div></td>
      </tr>
      </table>
      </div>
      <div>
        <h3>Shit
        <hr /></h3>
        <table id="shit">
        <tr>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        <td><div class='slot'></div></td>
        </tr>

      </table>


      </div><!-- end shit -->
 
        <button class="button">Confirm Your Selection</button>

        <div id="funny"></div>

        


  </div><!-- end rank -->

 
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
                  //Print the Comments, Query then print out a row of a table at a time
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

      
  </div><!-- end outerwrapper -->



     



  
 </div>


 </body>
</html>