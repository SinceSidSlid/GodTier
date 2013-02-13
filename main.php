<?php
  session_start();

  include 'dbconnect.php';
  include 'link.php';

?>

<!DOCTYPE html>
<html>

<head>

  <title>GodTier</title>
  <meta charset="UTF-8">

    <!-- Bookmark Icon-->
    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />

    <!-- our stylesheet -->
 		 <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- Attach the Reveal CSS -->
      <link rel="stylesheet" href="css/reveal.css">

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

    <!-- Then just attach the Reveal plugin -->
    <script src="javascript/jquery.reveal.js" type="text/javascript"></script>
    
    
    
    <script type="text/javascript">
         // Additional JS functions here. This connects to the FB app I created in order to use FB logins
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '489924051047502', // App ID
        channelUrl : '//www.sis.pitt.com/~ug37/1059/FP/channel.html', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });

      // Additional init code here. This checks to user's status in regards to logging in

      FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // connected
        testAPI();
      } else if (response.status === 'not_authorized') {
        // not_authorized
        login();
    } else {
        // not_logged_in
        login();
      }
   });

    };
    //This logs the user into FB.
    function login() {
      FB.login(function(response) {
          if (response.authResponse) {
              // connected
              testAPI();
          } else {
              // cancelled
          }
      });
  }

  function testAPI() {
      //This took forever to get this right

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

      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me', function(response) {
          console.log('Good to see you, ' + response.name + '.');
          //So here is my ajax code. I grab the info from the facebook api and put it into login.php to do stuff to it.
          //Not sure why it took me so long to realize the easiest way from javascript to php is ajax but it did.
          //There is a php library available to do some of this stuff and I spent two days on it with no results so I used javascript instead.
          //Once I run the login script it takes the output and inserts it into the h2 tag below.
         ajaxRequest.open('POST','login.php?', true);
         ajaxRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
         ajaxRequest.send('FName=' + response.first_name + '&LName=' + response.last_name + '&UName=' + response.username);

          ajaxRequest.onreadystatechange=function()
          {
              if (ajaxRequest.readyState==4 && ajaxRequest.status==200)
              {
                document.getElementById("test").innerHTML=ajaxRequest.responseText;
              }
          }
      });

      

  }

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
      </script>



  <!-- Site Tree Menu  -->
  <script type="text/javascript">
    $(document).ready(function() {
        $("#root ul").each(function() {$(this).css("display", "none");});
        $("#root .category").click(function() {
          var childid = "#" + $(this).attr("childid");
          if ($(childid).css("display") == "none") {$(childid).css("display", "block");}
          else {$(childid).css("display", "none");}
          if ($(this).hasClass("cat_close")) {$(this).removeClass("cat_close").addClass("cat_open");}
          else{$(this).removeClass("cat_open").addClass("cat_close");}
        });
      });
  </script>

</head>

<body>
<!-- script for fb login-->
    <div id="fb-root"></div>
   
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=489924051047502";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>


<!-- modal reveal code -->
      <div id="myModal" class="reveal-modal">
           <h1>A short message to Bob</h1>
           <p>Readme readme readme readme</p>
           <a class="close-reveal-modal">&#215;</a>
      </div>

<!--  Programmatic Launching Of Reveal -->

<script type="text/javascript">
    $(document).ready(function() {


         $('#myButton').click(function(e) {
              e.preventDefault();
        $('#myModal').reveal();
         });


    });
</script>
    

<!--begining of the official HTML -->
    <div id="header">
            <H1>GodTier</H1>
          </div>


            

    <div id="subheader">
        <h3><a href="profile.php">Profile</a></h3>



      </div>

       <div id="outerwrapper">

          <div id="user">    
             <h2 id="test"></h2>
             <div class="fb-login-button" data-show-faces="false" data-width="400" data-max-rows="1"></div>
             <p>Facebook Login Required</p>
             <a href="#" data-reveal-id="myModal">Click Me For A Modal</a>
             </div> <!-- user -->

  <div id="content-left">


          <div id="highlight">
             <div class="inside">
                 <?php

                $display = 'select TL_ID, TLName from tierlist;';
                $results = mysql_query($display);

                  if(!$results){
                      $message='Invalid Query ' .mysql_errno()."\n";
                      $message .= 'Whole Query ' . $query;
                      die($message);
                  }

                  $count = 1;

                  while($row = mysql_fetch_array($results))
                  {
                    print"<p><a href='rank.php?TL_ID=$count'>".$row['TLName']."</a></p>";
                    $count++;
                  }

                  ?>
             </div>
             </div><!-- highlight -->


          <div id="search">
             <div class="inside">
              <h4>Try searching something you like like "football" for example.</h4>

               <div style="float: left;"><input type="text" id="tipue_search_input"></div>
               <div style="float: left; margin-left: 13px;"><input type="button" id="tipue_search_button"></div>
               <div id="tipue_search_content"></div>

              <h4>Or Browse for content on the site map instead.</h4>

<div class="content">
  <ul id="root" class="menu">
      <li>
          <a href='javascript:void(0);' childid = 'c_12' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
          <a href='javascript:void(0);'>Hobbies</a>
        </li>
        <ul id='c_12'></ul>
        <li>
          <a href='javascript:void(0);' childid = 'c_13' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
          <a href='javascript:void(0);'>Places</a>
        </li>
                  <ul id='c_13'>
                    <li>
                        <a href='javascript:void(0);' class='product'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href='javascript:void(0);'>Pittsburgh</a>
                      </li>
                  </ul>
        <li>
          <a href='javascript:void(0);' childid = 'c_8' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a href='javascript:void(0);'>Sports</a>
        </li>
                    <ul id='c_8'>
                      <li>
                          <a href='javascript:void(0);' childid = 'c_11' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <a href='javascript:void(0);'>Football</a>
                        </li>
                      <ul id='c_11'></ul>
                        <li>
                            <a href='javascript:void(0);' childid = 'c_10' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <a href='javascript:void(0);'>Baseball</a>
                        </li>
                        <ul id='c_10'></ul>
                        <li>
                            <a href='javascript:void(0);' childid = 'c_9' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <a href='javascript:void(0);'>Badminton</a>
                        </li>
                        <ul id='c_9'></ul>
                    </ul>
        <li>
            <a href='javascript:void(0);' childid = 'c_5' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a href='javascript:void(0);'>People</a>
        </li>
        <ul id='c_5'>
                    <li>
                        <a href='javascript:void(0);' childid = 'c_7' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <a href='javascript:void(0);'>Celebrities</a>
                    </li>
                          <ul id='c_7'>
                              <li>
                                  <a href='javascript:void(0);' class='product'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                  <a href='javascript:void(0);'>Male celebrities</a>
                              </li>
                              <li>
                                  <a href='javascript:void(0);' class='product'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                  <a href='javascript:void(0);'>Female celebrities</a>
                              </li>
                        </ul>
                 </ul>
        <li>
            <a href='javascript:void(0);' childid = 'c_3' class='cat_close category'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a href='javascript:void(0);'></a>
        </li>
      
    </ul>
</div>



</div> <!-- sitemap -->






             </div> <!--search -->
</div><!-- content-left -->
        </div> <!-- outerwrapper -->
          
          
  



       <script type="text/javascript">
          $(document).ready(function() {
               $('#tipue_search_input').tipuesearch({
                    'mode': 'live'
               });
          });
      </script>
   

 </body>
</html>