<?php

  $link = mysql_connect($host, $username, $password);
  if (!$link) 
  {
    print '<p>' ;
    die('Could not connect '. mysql_error());
    print '</p>' ;
  }

  $db_selected = mysql_select_db('ug37',$link);

  if(!$db_selected)
  {
    die('Can\'t use database: ' . mysql_error());
    print '<br />' ;
  }

?>