<?php
    $mysql_hostname = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "chess_main";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
    or die(mysql_error());
    mysql_select_db($mysql_database, $bd) or die(mysql_error());
?>
