<?php
    require('./config.php');
    session_start();

    $user_check_email_id = $_SESSION['login_email_id'];
    $result = mysql_query("select email_id from registered_users where email_id='$user_check_email_id'");
    $num_rows = mysql_num_rows($result);
    
    if($num_rows == 0)
    {
        $error = "invalid session";
        header("location: ../index.php");
    }
?>
