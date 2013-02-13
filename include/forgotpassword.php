<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ONLINE CHESS</title>
    <link rel="stylesheet" href="../stylesheets/reset.css">
    <link rel="stylesheet" href="../stylesheets/layout.css">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <link rel="icon" href="../favicon.ico">
    <style>
		body {background-image:url('./Chess1.jpg');}
	</style>
</head>
<body>

<div id="register-login-text-wrapper">
<?php
    require("./config.php");
    require("./utility.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['forgot-submit']))
        {
        	  $myemailid = addslashes($_POST['email']);
        	  $sql = "SELECT email_id, username FROM registered_users WHERE email_id='$myemailid'";
						$result = mysql_query($sql) or die(mysql_error());
						$row = mysql_fetch_assoc($result);
						$count = mysql_num_rows($result);
						if ($count == 1) {
							$username = $row['username'];
							$emailNotFound = false;
							$newpass = substr(makeConfirmationMd5(), 0, 10);
							try {
									if (SendNewPassword($myemailid, $name, $newpass)) {
									  	$newpassmd5 = md5($newpass);
											$sql = "UPDATE registered_users SET password = '$newpassmd5' WHERE email_id='$myemailid'";
											$result = mysql_query($sql) or die(mysql_error());
											$confirmationSent = true;
											$emailError = false;
											header("refresh: 15; url=../index.php");
									}	else {
											$emailError = true;
									}
							} catch (phpmailerException $e) {
									$emailError = true;
							}
						}
						else {
							$emailNotFound = true;
						}
				}
        else 
        {
            header( "refresh:15;url=../index.php" );
            $error = "<div id=\"register-login-text\"><p>Invalid Page Requested</p><br /><p>This page will automatically redirect to the <a href=\"../index.php\" >Home page</a> in <span id=\"timer\">15 seconds<span></p></div>";
            echo $error;
        }
    }
?>
</div>
    <div id="forgot-form">
    	<?php if ($confirmationSent) { ?>
    	<div id="forgot-prompt">A new password has been generated and sent to your mail. Please use it for logging in. Redirecting to <a href="./index.php">Home Page</a> in <div id="timer">15 seconds</div>.</div>
    	<?php } else if ($emailError) { ?>
    	<div id="forgot-prompt">The email with the new password could not be sent. Contact <a href="mailto:admin@mkti.in">admin@mkti.in</a>.</div>
    	<?php } else if ($emailNotFound) { ?>
    	<div id="forgot-prompt">This email id does not exist in the database. Please retry with the correct email id.</div>
    	<form action="forgotpassword.php" method="POST">
				<div><input type="text" name="email" id="forgot-email" placeholder="Email id"/></div>
				<div><input type="submit" name="forgot-submit" id="forgot-submit" value="Send new password" /></div>
			</form>
    	<?php } else { ?>
    	<div id="forgot-prompt">Enter your email id. A new password will be sent to your mail.</div>
			<form action="forgotpassword.php" method="POST">
				<div><input type="text" name="email" id="forgot-email" placeholder="Email id"/></div>
				<div><input type="submit" name="forgot-submit" id="forgot-submit" value="Send new password" /></div>
			</form>
			<?php	} ?>
    </div>

    <div id="container">
        <div id="header">
                <div id="banner-text">Mukti '13</div>
        </div>


    </div>

<script type="text/javascript">
  var count = 15, unit;

  var counter = setInterval(timer, 1000);

  function timer()
  {
    count = count - 1;
    if( count <= 0 )
      clearInterval(counter);
    if( count == 1 )
      unit = ' second';
    else
      unit = ' seconds';

    document.getElementById("timer").innerHTML = count + unit;
  }
</script>

<script type="text/javascript">

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html>

